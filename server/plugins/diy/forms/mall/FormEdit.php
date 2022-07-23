<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/3/26
 * Time: 10:04 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\mall;

use app\forms\admin\mall\MallOverrunForm;
use app\forms\common\diy\CommonTemplate;
use app\forms\common\diy\DiyTimeForm;
use app\forms\common\diy\ValidateForm;
use app\forms\common\share\CommonShare;
use app\models\Coupon;
use app\models\GoodsCards;
use app\models\Model;
use app\plugins\diy\models\DiyFormList;
use yii\helpers\Json;

class FormEdit extends Model
{
    public $id;
    public $data;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['data'], 'string']
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $model = DiyFormList::findOne([
                'mall_id' => \Yii::$app->mall->id,
                'id' => $this->id,
                'is_delete' => 0
            ]);
            if (!$model) {
                throw new \Exception('所选的自定义表单不存在或已被删除');
            }
            $this->data = Json::decode($this->data, true);
            // 校验表单
            $validate = new ValidateForm();
            foreach ($this->data as $key => $datum) {
                $method = 'check' . hump($datum['id']);
                // 校验组件中的内容标题
                $validate->checkTitle($datum['id'], $datum['data']);
                if (method_exists($validate, $method)) {
                    $validate->$method($datum['data']);
                }
            }
            if ($validate->submitCount == 0) {
                throw new \Exception('提交按钮组件必须选择一个');
            }
            if ($validate->submitCount > 1) {
                throw new \Exception('提交按钮组件最多选择一个');
            }
            $model->form_data = Json::encode($this->data, JSON_UNESCAPED_UNICODE);
            if (!$model->save()) {
                throw new \Exception($this->getErrorMsg($model));
            }
            return $this->success([
                'msg' => '保存成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function get()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $model = DiyFormList::findOne([
                'mall_id' => \Yii::$app->mall->id,
                'id' => $this->id,
                'is_delete' => 0
            ]);
            if (!$model) {
                throw new \Exception('所选的自定义表单不存在或已被删除');
            }

            $data = Json::decode($model->form_data, true);
            $button = null;
            foreach ($data as $datum) {
                if ($datum['id'] == 'button') {
                    $button = $datum;
                }
            }

            foreach ($data as &$datum) {
                if ($datum['id'] == 'button') {
                    $temp = $datum['data'];
                    if (count($temp['after_send_coupon']) > 0) {
                        $couponId = array_column($temp['after_send_coupon'], 'coupon_id');
                        $num = array_column($temp['after_send_coupon'], 'send_num', 'coupon_id');
                        $couponList = Coupon::findAll([
                            'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'id' => $couponId
                        ]);
                        $sendCoupon = [];
                        foreach ($couponList as $coupon) {
                            $sendCoupon[] = [
                                'id' => '',
                                'coupon_id' => $coupon->id,
                                'name' => $coupon->name,
                                'send_num' => $num[$coupon->id]
                            ];
                        }
                        $datum['data']['after_send_coupon'] = $sendCoupon;
                    }
                    if (count($temp['after_send_card']) > 0) {
                        $cardId = array_column($temp['after_send_card'], 'id');
                        $num = array_column($temp['after_send_card'], 'num', 'id');
                        $cardList = GoodsCards::findAll([
                            'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'id' => $cardId
                        ]);
                        $sendCard = [];
                        foreach ($cardList as $card) {
                            $sendCard[] = [
                                'id' => $card->id,
                                'name' => $card->name,
                                'num' => $num[$card->id]
                            ];
                        }
                        $datum['data']['after_send_card'] = $sendCard;
                    }
                }

                if ($datum['id'] == 'time') {
                    $timeData = (new DiyTimeForm())->getNewData($datum['data'], $model->id, $button);
                    $datum['data'] = $timeData;
                }
            }
            unset($datum);

            $common = CommonTemplate::getCommon();
            $data = $common->setDefault($data);

            $model->form_data = json_encode($data);
            $res = $model->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($model));
            }
            
            return $this->success([
                'info' => [
                    'id' => $model->id,
                    'data' => $data,
                    'time_status' => $model->time_status,
                    'time_at' => $model->time_at
                ],
                'allComponents' => $common->allFormComponents(['calc', 'number-in', 'form-goods-button']),
                'overrun' => (new MallOverrunForm())->getSetting(),
                'is_share' => CommonShare::getCommon()->getIsShare(),
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function destroy()
    {
        try {
            $model = DiyFormList::findOne([
                'mall_id' => \Yii::$app->mall->id,
                'id' => $this->id,
                'is_delete' => 0
            ]);
            if (!$model) {
                throw new \Exception('所选的自定义表单不存在或已被删除');
            }
            $model->is_delete = 1;
            if (!$model->save()) {
                throw new \Exception($this->getErrorMsg($model));
            }
            return $this->success([
                'msg' => '删除成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
