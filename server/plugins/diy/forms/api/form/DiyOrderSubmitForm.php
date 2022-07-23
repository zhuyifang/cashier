<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\plugins\diy\forms\api\form;


use app\core\payment\PaymentOrder;
use app\core\response\ApiCode;
use app\events\OrderEvent;
use app\forms\api\order\OrderException;
use app\forms\api\order\OrderSubmitForm;
use app\forms\api\order\OrderSubmitJob;
use app\forms\common\diy\DiyButtonForm;
use app\forms\common\mptemplate\MpTplMsgDSend;
use app\forms\common\mptemplate\MpTplMsgSend;
use app\helpers\PluginHelper;
use app\models\Goods;
use app\models\MallMembers;
use app\models\Order;
use app\models\OrderDetail;
use app\models\User;
use app\plugins\diy\Plugin;
use app\plugins\diy\forms\api\form\DiyOrderGoodsAttr;
use app\plugins\diy\forms\api\form\DiySendForm;
use app\plugins\diy\models\DiyForm;
use app\plugins\diy\models\DiyFormList;
use app\plugins\diy\models\DiyPage;

class DiyOrderSubmitForm extends OrderSubmitForm
{
    private $buttonData;
    private $diyFormList;
    private $diyPage;
    private $dbDiyFormData; // 数据库存储的
    private $appDiyFormData; // 小程序端上传的
    private $payData;

    // form_list_id
    // page_id
    private $new_price;
    private $attr_key;
    private $num = 1;
    private $day = 1;

    public function setPluginData()
    {
        $this->setSign((new Plugin())->getName());
        $this->setEnableFullReduce(false);
        $this->setEnableOrderForm(false);
        $this->setEnableAddressEnable(false);
        $this->setEnablePriceEnable(false);


        // 优惠券列表接口也走这里
        if (isset($this->form_data['list'][0]['form_list_id'])) {
            $formListId = $this->form_data['list'][0]['form_list_id'];
            $pageId = $this->form_data['list'][0]['page_id'];
        } else {
            $formListId = $this->form_data['form_list_id'];
            $pageId = $this->form_data['page_id'];
        }

        $diyFormList = DiyFormList::findOne($formListId);
        $this->diyFormList = $diyFormList;
        if (!$diyFormList) {
            throw new OrderException('表单不存在');
        }

        $diyPage = DiyPage::find()->andWhere(['id' => $pageId, 'is_delete' => 0])
                ->one();
        $this->diyPage = $diyPage;
        if (!$diyPage) {
            throw new OrderException('微页面不存在');
        }

        $key = 'FORM_USER_' . \Yii::$app->user->id;
        $arrayData = json_decode(\Yii::$app->redis->get($key), true);
        if (!$arrayData) {
            throw new OrderException('请返回上一页重新提交');
        }
        $this->appDiyFormData = $arrayData['form_data'];
        $this->new_price = $arrayData['new_price'];

        foreach ($this->appDiyFormData as $item) {
            if ($item['key'] == 'button') {
                $this->attr_key = $item['value']['attr_key'];
                $this->num = $item['value']['num'];
            }
        }

        $dbFormData = json_decode($diyFormList->form_data, true);
        $this->dbDiyFormData = $dbFormData;
        foreach ($dbFormData as $item) {
            if ($item['id'] == 'button') {
                $this->buttonData = $item['data'];
            }
        }

        $buttonData = $this->buttonData;
        // 联动日期组件
        if ($buttonData['has_calendar']) {
            $key = $buttonData['calendar_key'];

            $dbCalendar = null;
            foreach ($dbFormData as $value) {
                if ($value['id'] == 'calendar' && $value['data']['key'] == $key) {
                    $dbCalendar = $value['data'];
                }
            }

            foreach ($this->appDiyFormData as $value) {
                if ($value['key'] == 'calendar' && $value['value']['s']['key'] == $key && isset($value['value']['data']) && !empty($value['value']['data'])) {

                    if ($dbCalendar) {
                        if ($dbCalendar['has_kuatian'] == 0) {
                            // 当天
                            $this->day = count($value['value']['data']);
                        } else {
                            // 跨天
                            $this->day = (count($value['value']['data']) - 1);
                        }
                    }
                }
            }
        }

        if ($this->buttonData['discount_type'] && is_array($this->buttonData['discount_type'])) {
            $this->setEnableIntegral(in_array('integral', $this->buttonData['discount_type']));
            $this->setEnableCoupon(in_array('coupon', $this->buttonData['discount_type']));
            $this->setEnableVipPrice(in_array('vip-card', $this->buttonData['discount_type']));
        }

        return $this;
    }

    /**
     * 设置支持的支付方式,支付方式见readme->支付
     * @param null|array $supportPayTypes
     * @return $this
     */
    public function setSupportPayTypes($supportPayTypes = null)
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

        $this->supportPayTypes = $arr;
        return $this;
    }

    public function whiteList()
    {
        return [(new Plugin())->getName()];
    }

    protected function getGoodsItemData($item)
    {
        $itemData = parent::getGoodsItemData($item);

        $priceData = $this->getPayPrice($this->buttonData, $this->appDiyFormData);
        $itemData['attr_list'][0]['attr_name'] = $priceData['pay_title'];

        $newNum = $this->num * $this->day;

        $foreheadIntegral = $this->buttonData['integral_max'] ?: 0;
        if ($this->buttonData['integral_diejia']) {
            $foreheadIntegral = (int)$this->buttonData['integral_max'] * $newNum;
        }

        $itemData['num'] = $this->num;
        $itemData['forehead_integral'] = $this->buttonData['integral_max'] ?: 0;
        $itemData['forehead_integral_type'] = 1;
        $itemData['accumulative'] = $this->buttonData['integral_diejia'];
        $itemData['is_level_alone'] = $this->buttonData['is_level_alone'];
        $itemData['is_level'] = $this->buttonData['is_level'];
        $itemData['unit_price'] = price_format($priceData['pay_price'] * $this->day);
        $itemData['total_original_price'] = price_format($priceData['pay_price'] * $newNum);
        $itemData['total_price'] = price_format($priceData['pay_price'] * $newNum);
        $itemData['name'] = $this->diyFormList ? $this->diyFormList->name : $itemData['name'];

        return $itemData;
    }

    private function getPayPrice($buttonData, $formData, $memberLevel = null)
    {
        $payPrice = $buttonData['pay_price'];
        $payTitle = '';
        $memberPrice = 0;

        switch ($buttonData['pay_status']) {
            // 单个价格
            case 'alone':
                $payPrice = $buttonData['pay_price'];
                // 用户自定义价格
                if ($buttonData['pay_update'] == 1 && $this->new_price) {
                    $payPrice = $this->new_price;
                    $memberPriceList = [];
                } else {
                    $memberPriceList = $buttonData['member_price'];
                }

                $payTitle = $buttonData['pay_title'];

                break;
            // 多个价格
            case 'much':
                $payList = $buttonData['pay_price_list'];
                $sign = false;
                foreach ($payList as $pItem) {
                    if ($this->attr_key == $pItem['key']) {
                        $sign = true;
                        $payTitle = $pItem['title'];
                        $payPrice = $pItem['pay_price'];
                        $memberPriceList = $pItem['member_price'];
                        break;
                    }
                }

                if (!$sign) {
                    throw new OrderException('支付价格异常');
                }

                break;
            default:
                throw new OrderException('未知价格类型');
                break;
        }

        $memberPrice = (new DiyButtonForm())->getAttrMemberPrice($payPrice, $memberLevel, $buttonData['is_level'], $buttonData['is_level_alone'], $memberPriceList, $this->new_price);

        return [
            'pay_price' => $payPrice,
            'pay_title' => $payTitle,
            'member_price' => $memberPrice
        ];
    }

    /**
     * @return array
     * @throws \yii\base\Exception
     */
    public function submit()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse($this);
        }

        try {
            $this->changeParam();
            $data = $this->getAllData();
        } catch (OrderException $orderException) {
            return [
                'code' => 1,
                'msg' => $orderException->getMessage(),
                'line' => $orderException->getLine()
            ];
        }

        $token = $this->getToken();
        $dataArr = [
            'mall' => \Yii::$app->mall,
            'user' => $this->getUser(),
            'form_data' => $this->form_data,
            'token' => $token,
            'sign' => $this->sign,
            'supportPayTypes' => $this->supportPayTypes,
            'enableMemberPrice' => $this->getMemberPrice(),
            'enableFullReduce' => $this->getFullReduce(),
            'enableCoupon' => $this->getEnableCoupon(),
            'enableIntegral' => $this->getEnableIntegral(),
            'enableOrderForm' => $this->getEnableOrderForm(),
            'enablePriceEnable' => $this->getEnablePriceEnable(),
            'enableVipPrice' => $this->getEnableVipPrice(),
            'enableAddressEnable' => $this->getEnableAddressEnable(),
            'OrderSubmitFormClass' => static::class,
            'status' => $this->status,
            'appVersion' => \Yii::$app->appVersion,
            'platform' => \Yii::$app->appPlatform
        ];
        $class = new OrderSubmitJob($dataArr);
        $queueId = \Yii::$app->queue->delay(0)->push($class);

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

        return [
            'code' => 0,
            'data' => [
                'token' => $token,
                'queue_id' => $queueId,
            ],
        ];
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

    /**
     * 获取1个或多个订单的数据，按商户划分
     * @return array ['mch_list'=>'商户列表', 'total_price' => '多个订单的总金额（含运费）']
     * @throws OrderException
     * @throws \yii\db\Exception
     * @throws \app\core\exceptions\ClassNotFoundException
     */
    public function getAllData()
    {
        $data = parent::getAllData();

        $data['hasCity'] = false;
        $data['allZiti'] = false;
        $data['hasRecipient'] = false;
        return $data;
    }

    public function hasRecipient()
    {
        return false;
    }

    public function getIsECardGoods($mchItem)
    {
        return true;
    }

    /**
     * @param array $data
     * @return array
     * 发货方式兼容全平台之前的传出参数
     */
    protected function changeData($data)
    {
        return $data;
    }

    /**
     *
     * @param $mchItem
     * @return mixed
     */
    public function afterGetMchItem(&$mchItem)
    {
        // 订单预览不显示买家留言
        $mchItem['show_remark'] = false;
        // 订单预览不显示商城名称
        $mchItem['mch']['name'] = '';
        return $mchItem;
    }

    public function extraOrder($order, $mchItem)
    {
        $model = new DiyForm();
        $model->mall_id = \Yii::$app->mall->id;
        $model->user_id = \Yii::$app->user->id;
        $model->form_data = json_encode($this->appDiyFormData);
        $model->is_delete = 0;
        $model->is_old = 0;
        $model->form_list_id = $this->diyFormList->id;
        $model->form_list_name = $this->diyFormList->name;
        $model->pay_price = $order->total_pay_price;
        $model->order_no = $order->order_no;

        $buttonData = $this->buttonData;
        $extra = [];
        $extra['pay_title'] = '';// TODO
        $extra['send_data'] = (new DiySendForm())->getSendData($buttonData, $this->num);
        if ($buttonData['after_trigger'] == 'event' && $buttonData['after_jump_status'] == 1 && $buttonData['after_jump_link']) {
            $extra['after_jump_link'] = $buttonData['after_jump_link'];
        }
        $extra['diy_page'] = $this->diyPage->attributes;
        $extra['button_data'] = $buttonData;
        $model->extra_attributes = json_encode($extra, JSON_UNESCAPED_UNICODE);

        $res = $model->save();

        if (!$res) {
            throw new OrderException($this->getErrorMsg($model));
        }
    }

    /**
     * 商品库存操作
     * @param OrderGoodsAttr $goodsAttr
     * @param int $subNum
     * @param array $goodsItem
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function subGoodsNum($goodsAttr, $subNum, $goodsItem)
    {
        $diyFormList = DiyFormList::findOne($this->diyFormList->id);
        $formData = json_decode($diyFormList->form_data, true);

        foreach ($formData as &$item) {
            // 不限制库存状态下 不需要减库存
            if ($item['id'] == 'button' && $item['data']['has_limit_stock_num'] == 0) {
                switch ($item['data']['pay_status']) {
                    // 单个价格
                    case 'alone':
                        if ($item['data']['stock_num'] < $this->num) {
                            throw new \Exception('库存不足3');
                        }
                        $item['data']['stock_num'] = $item['data']['stock_num'] - $this->num;
                        break;
                    // 多个价格
                    case 'much':
                        $sign = false;
                        foreach ($item['data']['pay_price_list'] as $key => $pItem) {
                            if ($this->attr_key == $pItem['key']) {
                                if ($pItem['stock_num'] < $this->num) {
                                    throw new \Exception('库存不足1');
                                }
                                $sign = true;
                                $item['data']['pay_price_list'][$key]['stock_num'] = $pItem['stock_num'] - $this->num;
                                break;
                            }
                        }

                        if (!$sign) {
                            throw new OrderException('支付价格异常');
                        }

                        break;
                    default:
                        throw new OrderException('未知价格类型');
                        break;
                }
            }
        }

        $diyFormList->form_data = json_encode($formData);
        $res = $diyFormList->save();

        if (!$res) {
            throw new \Exception($this->getErrorMsg($diyFormList));
        }
    }

    /**
     * @return OrderGoodsAttr OrderGoodsAttr
     * 商品规格类
     */
    public function getGoodsAttrClass()
    {
        $form = new DiyOrderGoodsAttr();
        $form->attr_key = $this->attr_key;
        $form->buttonData = $this->buttonData;
        $form->new_price = $this->new_price;
        $form->day = $this->day;
        return $form;
    }

    /**
     * 获取指定规格指定会员等级的会员价
     * @param $goodsAttr
     * @param $memberLevel
     * @return GoodsMemberPrice|null
     * @throws \Exception
     */
    protected function getGoodsAttrMemberPrice($goodsAttr, $memberLevel)
    {
        if ($this->buttonData['is_level_alone'] != 1) {
            return parent::getGoodsAttrMemberPrice($goodsAttr, $memberLevel);
        }

        $priceData = $this->getPayPrice($this->buttonData, $this->appDiyFormData, $memberLevel);

        return $priceData['member_price'];
    }

    public function setVipDiscountData($mchItem)
    {
        //权限判断
        $permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
        if (!in_array('vip_card', $permission)) {
            return $mchItem;
        }
        try {
            $isTrue = in_array('vip-card', $this->buttonData['discount_type']);
            if ($isTrue) {
                $user = $this->getUser();
                $plugin = \Yii::$app->plugin->getPlugin('vip_card');
                $mchItem = $plugin->vipDiscount($mchItem, false, $this, $user);
                if ($this->isTestUseVipCard && isset($mchItem['has_vip_card']) && !$mchItem['has_vip_card']) {
                    $mchItemWithTempVip = $plugin->vipDiscount($mchItem, true, $this, $user);
                    if (isset($mchItemWithTempVip['vip_discount'])) {
                        $mchItem['temp_vip_discount'] = $mchItemWithTempVip['vip_discount'];
                    }
                    if (!empty($mchItem['form_data']['vip_card_detail_id'])) {
                        $vipCardDetail = $plugin->getCardDetail($mchItem['form_data']['vip_card_detail_id']);
                        if ($vipCardDetail) {
                            $mchItem['vip_card_detail'] = $vipCardDetail;
                        }
                    }
                }
            }
            return $mchItem;
        } catch (\Exception $e) {
            return $mchItem;
        }
    }

    // 商品表单不显示
    protected function setGoodsForm($mchItem)
    {
        $mchItem = parent::setGoodsForm($mchItem);
        $mchItem['has_goods_form'] = false;
        return $mchItem;
    }

    public function extraGoodsDetail($order, $goodsItem)
    {
        $orderDetail = parent::extraGoodsDetail($order, $goodsItem);

        $goodsInfo = json_decode($orderDetail->goods_info, true);
        $goodsInfo['goods_attr']['name'] = $this->diyFormList ? $this->diyFormList->name : $goodsInfo['goods_attr']['name'];

        $orderDetail->goods_info = json_encode($goodsInfo);

        if (!$orderDetail->save()) {
            throw new \Exception((new Model())->getErrorMsg($orderDetail));
        }
        return $orderDetail;
    }
}
