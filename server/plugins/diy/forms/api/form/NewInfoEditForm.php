<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/7/6
 * Time: 9:57
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\api\form;


use app\core\payment\PaymentOrder;
use app\core\response\ApiCode;
use app\forms\api\order\OrderPayNotify;
use app\forms\common\diy\ValueValidateForm;
use app\forms\common\mptemplate\MpTplMsgDSend;
use app\forms\common\mptemplate\MpTplMsgSend;
use app\models\CoreValidateCode;
use app\models\MallMembers;
use app\models\Model;
use app\models\Order;
use app\models\OrderDetail;
use app\models\User;
use app\plugins\diy\forms\api\form\DiySendForm;
use app\plugins\diy\forms\api\form\GoodsEditForm;
use app\plugins\diy\models\DiyForm;
use app\plugins\diy\models\DiyFormList;
use app\plugins\diy\models\DiyPage;

class NewInfoEditForm extends Model
{
    public $form_data;
    public $form_list_id;
    public $page_id;
    public $new_price;

    private $attr_key;
    private $num = 1;
    private $diyFormList;

    public function rules()
    {
        return [
            [['form_data', 'form_list_id', 'page_id'], 'required'],
            [['form_list_id', 'page_id'], 'integer'],
            [['form_data'], 'string'],
            [['new_price'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'form_data' => '表单提交数据',
            'form_list_id' => '表单ID',
            'page_id' => '微页面ID',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $goods = new GoodsEditForm();
        $goods->save();

        $transaction = \Yii::$app->db->beginTransaction();
        try {

            $this->diyFormList = DiyFormList::find()
                ->andWhere(['id' => $this->form_list_id, 'is_delete' => 0])
                ->one();

            if (!$this->diyFormList) {
                throw new \Exception('表单不存在');
            }

            $diyPage = DiyPage::find()->andWhere(['id' => $this->page_id, 'is_delete' => 0])
                ->one();

            if (!$diyPage) {
                throw new \Exception('微页面不存在');
            }

            $formData = json_decode($this->form_data, true);
            // 校验表单
            $validate = new ValueValidateForm();
            foreach ($formData as $item) {
                if (isset($item['key']) && $item['key'] == 'button') {
                    $this->attr_key = $item['value']['attr_key'];
                    $this->num = $item['value']['num'];
                }
                $method = 'check' . hump($item['key'], '-');
                if (method_exists($validate, $method)) {
                    $validate->$method($item);
                }
            }

            // 提交周期次数验证
            $this->checkStatus($this->diyFormList);
            $buttonData = $this->getFormItem('button');

            // 验证库存
            $this->checkStock($buttonData, $diyPage);

            $key = 'FORM_USER_' . \Yii::$app->user->id;
            \Yii::$app->redis->set($key, json_encode(['form_data' => $formData, 'new_price' => $this->new_price]));
            \Yii::$app->redis->expire($key, 10 * 60);

            $diyForm = $this->submit($buttonData, $diyPage);

            $transaction->commit();
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'is_pay' => $buttonData['data']['is_pay'],
                    'form_id' => $diyForm ? $diyForm->id : 0
                ]
            ];
        }catch(\Exception $exception) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine()
            ];
        }
    }

    private function submit($buttonData, $diyPage)
    {
        $buttonData = $buttonData['data'];
        if ($buttonData['is_pay'] == 1) {
            return false;
        }

        $model = new DiyForm();
        $model->mall_id = \Yii::$app->mall->id;
        $model->user_id = \Yii::$app->user->id;
        $model->form_data = $this->form_data;
        $model->is_delete = 0;
        $model->is_old = 0;
        $model->form_list_id = $this->diyFormList->id;
        $model->form_list_name = $this->diyFormList->name;
        $model->is_pay = 1;
        $model->pay_time = date('Y-m-d H:i:s', time());

        $extra = [];
        $extra['pay_title'] = '';// TODO
        $extra['send_data'] = (new DiySendForm())->getSendData($buttonData, $this->num);
        if ($buttonData['after_trigger'] == 'event' && $buttonData['after_jump_status'] == 1 && $buttonData['after_jump_link']) {
            $extra['after_jump_link'] = $buttonData['after_jump_link'];
        }
        $extra['diy_page'] = $diyPage->attributes;
        $extra['button_data'] = $buttonData;

        $newSendData = $this->submitSend($extra);
        $extra['new_send_data'] = $newSendData;

        $model->extra_attributes = json_encode($extra, JSON_UNESCAPED_UNICODE);
        $res = $model->save();

        if (!$res) {
            throw new OrderException($this->getErrorMsg($model));
        }

        try {
            $tplMsg = new MpTplMsgSend();
            $tplMsg->method = 'applySubmitTpl';
            $tplMsg->params = [
                'time' => $model->attributes['created_at'],
            ];
            $tplMsg->sendTemplate(new MpTplMsgDSend());
        } catch (\Exception $e) {
            \Yii::error('表单提醒发送失败 =>' . $e->getMessage());
        }

        return $model;
    }

    public function submitSend($extra)
    {
        $user = User::findOne(\Yii::$app->user->id);
        $newSendData = [];
        // 赠送卡券
        $sendCardList = isset($extra['send_data']['send_card_list']) ? $extra['send_data']['send_card_list'] : [];
        $newSendCardList = (new DiySendForm())->sendCard($sendCardList, $user);
        if (!empty($newSendCardList)) {
            $newSendData['send_card_list'] = $newSendCardList;
        }

        // 赠送优惠券
        $sendCouponList = isset($extra['send_data']['send_coupon_list']) ? $extra['send_data']['send_coupon_list'] : [];
        $newSendCouponList = (new DiySendForm())->sendCoupon($sendCouponList, $user);
        if (!empty($newSendCouponList)) {
            $newSendData['send_coupon_list'] = $newSendCouponList;
        }

        $buttonData = isset($extra['button_data']) ? $extra['button_data'] : [];
        $sendData = isset($extra['send_data']) ? $extra['send_data'] : [];

        // 赠送积分
        $integral = (new DiySendForm())->giveIntegral($sendData, $user);
        if ($integral) {
            $newSendData['send_integral'] = $integral;
        }

        // 赠送余额
        $balance = (new DiySendForm())->giveBalance($sendData, $user);
        if ($balance) {
            $newSendData['send_balance'] = $balance;
        }

        // 赠送会员
        $sendMember = (new DiySendForm())->sendDiyMember($sendData, $user);
        if ($sendMember) {
            $newSendData['send_member'] = $sendMember;
        }

        // 赠送抽奖
        if (isset($sendData['send_pond']) && $sendData['send_pond']) {

            $limit = (new DiySendForm())->sendLottery($user, 'pond', $sendData['send_pond']);

            if ($limit) {
                $newSendData['send_pond'] = $limit;
            }
        }
        if (isset($sendData['send_scratch']) && $sendData['send_scratch']) {

            $limit = (new DiySendForm())->sendLottery($user, 'scratch', $sendData['send_scratch']);

            if ($limit) {
                $newSendData['send_scratch'] = $limit;
            }
        }

        // 发送模板消息
        (new DiySendForm())->sendTemplate($buttonData, $user, date('Y-m-d H:i:s', time()));

        // 发送短信
        (new DiySendForm())->sendSmsToUser($buttonData, $user);

        // 发送邮件
        (new DiySendForm())->sendMail(\Yii::$app->mall);

        return $newSendData;
    }

    private function checkStock($buttonData)
    {
        // 兼容
        if (!isset($buttonData['data']['has_limit_stock_num'])) {
            return false;
        }

        if ($buttonData['data']['is_pay'] == 0) {
            return false;
        }

        switch ($buttonData['data']['pay_status']) {
            // 单个价格
            case 'alone':
                if ($buttonData['data']['has_limit_stock_num'] != 1) {
                    $stock = $buttonData['data']['stock_num'];

                    if ($this->num > $stock) {
                        throw new \Exception('库存不足4');
                    }
                }
                break;
            // 多个价格
            case 'much':
                if (!$this->attr_key) {
                    throw new \Exception('规格key异常');
                }

                $payList = $buttonData['data']['pay_price_list'];
                $sign = false;
                foreach ($payList as $pIndex => $pItem) {
                    if ($this->attr_key == $pItem['key']) {
                        $stock = $pItem['stock_num'];
                        $sign = true;

                        if ($this->num > $stock && $buttonData['data']['has_limit_stock_num'] != 1) {
                            throw new \Exception($pItem['title'] . '库存不足');
                        }
                        break;
                    }
                }

                if (!$sign) {
                    throw new \Exception('支付规格key异常');
                }

                break;
            default:
                throw new \Exception('未知价格类型');
                break;
        }
    }

    private function getSupportPayTypes()
    {
        $arr = [];
        $payTypes = \Yii::$app->mall->getMallSettingOne('payment_type');
        foreach ($payTypes as $item) {
            if ($item == 'online_pay') {
                $arr[] = \app\core\payment\Payment::PAY_TYPE_WECHAT;
                $arr[] = \app\core\payment\Payment::PAY_TYPE_ALIPAY;
                $arr[] = \app\core\payment\Payment::PAY_TYPE_BAIDU;
                $arr[] = \app\core\payment\Payment::PAY_TYPE_TOUTIAO;
                $arr[] = \app\core\payment\Payment::PAY_TYPE_WECHAT_H5;
                $arr[] = \app\core\payment\Payment::PAY_TYPE_ALIPAY_H5;
            }
            if ($item == 'balance') {
                $arr[] = \app\core\payment\Payment::PAY_TYPE_BALANCE;
            }
        }

        return $arr;
    }

    private function getFormItem($id)
    {
        $diyFormList = $this->diyFormList;
        $formData = json_decode($diyFormList->form_data, true);
        foreach ($formData as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }

        throw new \Exception('表单数据异常' . $id);
    }

    private function checkStatus(DiyFormList $diyFormList)
    {
        $status = $diyFormList->status;
        $limit = $diyFormList->limit;
        $query = DiyForm::find()->andWhere([
            'mall_id' => \Yii::$app->mall->id,
            'user_id' => \Yii::$app->user->id,
            'is_delete' => 0,
            'is_pay' => 1,
            'form_list_id' => $diyFormList->id
        ]);

        switch ($status) {
            // 不限制
            case 0:
                $count = $query->count();
                if ($count >= $limit) {
                    throw new \Exception($diyFormList->tip);
                }
                break;
            // 每天
            case 1:
                $day = date('Y-m-d', time());
                $query->andWhere(['>=', 'created_at', $day . ' 00:00:00']);
                $query->andWhere(['<=', 'created_at', $day . ' 23:59:59']);
                $count = $query->count();
                if ($count >= $limit) {
                    throw new \Exception($diyFormList->tip);
                }
                break;
            // 每周
            case 2:
                $lastday = date("Y-m-d",strtotime('Sunday'));
                $firstday = date("Y-m-d",strtotime("$lastday - 6 days"));
                $query->andWhere(['>=', 'created_at', $firstday . ' 00:00:00']);
                $query->andWhere(['<=', 'created_at', $lastday . ' 23:59:59']);
                $count = $query->count();
                if ($count >= $limit) {
                    throw new \Exception($diyFormList->tip);
                }
                break;
            // 每月
            case 3:
                $firstday = date('Y-m-01', strtotime(date('Y-m-d')));
                $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
                $query->andWhere(['>=', 'created_at', $firstday . ' 00:00:00']);
                $query->andWhere(['<=', 'created_at', $lastday . ' 23:59:59']);
                $count = $query->count();
                if ($count >= $limit) {
                    throw new \Exception($diyFormList->tip);
                }
                break;
            // 每年
            case 4:
                $firstday = date('Y-12-01', strtotime(date('Y-m-d')));
                $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
                $query->andWhere(['>=', 'created_at', date('Y-01-01') . ' 00:00:00']);
                $query->andWhere(['<=', 'created_at', $lastday . ' 23:59:59']);
                $count = $query->count();
                if ($count >= $limit) {
                    throw new \Exception($diyFormList->tip);
                }
                break;
            default:
                throw new \Exception('未知状态:' . $status);
                break;
        }

        if ($diyFormList->time_status && time() > strtotime($diyFormList->time_at)) {
            throw new Exception('已超过表单可提交时间,无法提交');
        }
    }
}
