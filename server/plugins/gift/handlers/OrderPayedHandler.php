<?php


namespace app\plugins\gift\handlers;

use app\plugins\gift\events\OrderEvent;
use app\plugins\gift\models\GiftOrder;
use app\plugins\gift\models\GiftUserOrder;

/**
 * Class OrderPayedHandler
 * @package app\plugins\gift\handlers
 * @property OrderEvent $event
 */
class OrderPayedHandler extends \app\handlers\orderHandler\OrderPayedHandlerClass
{
    public $event;

    public function handle()
    {
        $this->user = $this->event->order->user;
        $this->sendTemplate()->becomeJuniorByFirstPay()->becomeShare();
        if (isset($this->event->type) && $this->event->type == 2) {
            $this->buy();
        } else {
            $this->receive();
        }
    }

    /**
     * 买礼物的支付事件
     */
    protected function buy()
    {
        $this->setGoods()->sendBuyPrompt()->addShareOrder();
        // 买礼物触发优惠券发放
        parent::sendCoupon();
    }

    /**
     * 收礼物的支付事件
     * @throws \Exception
     */
    protected function receive()
    {
        \Yii::error('订单付款礼物领取回调开始：');
        $event = $this->event;
        /** @var OrderEvent $event */
        \Yii::$app->setMchId($event->order->mch_id);
        $t = \Yii::$app->db->beginTransaction();
        try {
            $user_order = GiftUserOrder::findOne(['token' => $event->order->token]);
            if (empty($user_order)) {
                \Yii::error('非礼物兑换订单NO:' . $event->order->order_no);
                return;
            }
            $user_order->is_receive = 1;
            if (!$user_order->save()) {
                throw new \Exception($user_order->errors[0]);
            }
            //记录订单ID
            if (GiftOrder::updateAll(['order_id' => $event->order->id], ['user_order_id' => $user_order->id]) <= 0) {
                throw new \Exception('记录订单ID失败');
            }

            $this->sendSms()->sendMail()->saveResult()->sendMpTemplate();
            $t->commit();
        } catch (\Exception $exception) {
            $t->rollBack();
            \Yii::error('订单付款礼物领取事件：');
            \Yii::error($exception);
            throw $exception;
        }
    }

    protected function sendCoupon()
    {
        // 收礼物不触发优惠券发放
        return [];
    }

    public function addShareOrder($isSendTemplate = true)
    {
        if (GiftOrder::findOne(['order_id' => $this->event->order->id])) {
            return $this;
        }
        return parent::addShareOrder(); // TODO: Change the autogenerated stub
    }
}
