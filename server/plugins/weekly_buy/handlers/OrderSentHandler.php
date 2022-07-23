<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/22
 * Time: 2:10 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\handlers;

use app\forms\common\card\CommonSend;
use app\forms\common\coupon\CommonCouponGoodsSend;
use app\forms\common\message\MessageService;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\template\order_pay_template\OrderSendInfo;
use app\handlers\HandlerBase;
use app\models\Order;
use app\models\UserCard;
use app\plugins\weekly_buy\events\OrderSendEvent;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyOrderDetail;

class OrderSentHandler extends HandlerBase
{
    public $user;
    public $mall;
    /** @var OrderSendEvent $event */
    public $event;
    public function register()
    {
        \Yii::$app->on(HandlerRegister::EVENT_WEEKLY_BUY_SENT, function ($event) {
            \Yii::error('周期购发货事件');
            /** @var OrderSendEvent $event */
            $this->user = $event->order->user;
            $this->mall = \Yii::$app->mall;
            $this->event = $event;
            $this->sendCouponByGoods();
            $this->sendCard();
            $this->sendSmsToUser($event->order);
            WeeklyBuyOrderDetail::updateAllCounters(
                ['actual_week_number' => 1, 'sent_num' => $this->event->order->detail[0]->num],
                ['order_id' => $this->event->order->id]
            );
        });
    }

    /**
     * @return array
     * 向用户发送优惠券（购买商品赠送--订单支付成功发送优惠券）
     */
    protected function sendCouponByGoods()
    {
        try {
            $couponSendForm = new CommonCouponGoodsSend();
            $couponSendForm->user = $this->user;
            $couponSendForm->mall = $this->mall;
            $couponSendForm->order_id = $this->event->order->id;
            $userCouponList = $couponSendForm->send();
            \Yii::warning('购买商品赠送优惠券发放数据');
            \Yii::warning($userCouponList);
        } catch (\Exception $exception) {
            \Yii::error('商品赠送优惠券发放失败: ' . $exception->getMessage());
            $userCouponList = [];
        }
        return $userCouponList;
    }

    /**
     * @return array
     * 向用户发送商品卡券
     */
    protected function sendCard()
    {
        try {
            $cardSendForm = new CommonSend();
            $cardSendForm->mall_id = \Yii::$app->mall->id;
            $cardSendForm->user_id = $this->event->order->user_id;
            $cardSendForm->order_id = $this->event->order->id;
            /** @var UserCard[] $userCardList */
            $userCardList = $cardSendForm->save();
            $cardList = [];
            foreach ($userCardList as $userCard) {
                $cardList[] = $userCard->attributes;
            }
        } catch (\Exception $exception) {
            \Yii::error('卡券发放失败: ' . $exception->getMessage());
            $cardList = [];
        }
        return $cardList;
    }

    /**
     * @param Order $order
     * @return $this
     * 向用户发送短信提醒
     */
    protected function sendSmsToUser($order)
    {
        try {
            \Yii::warning('----消息发送提醒----');
            if (!$order->user->mobile) {
                throw new \Exception('用户未绑定手机号无法发送');
            }
            $messageService = new MessageService();
            $messageService->user = $order->user;
            $messageService->content = [
                'mch_id' => $order->mch_id,
                'args' => [substr($order->order_no, -6)]
            ];
            $messageService->platform = PlatformConfig::getInstance()->getPlatform($order->user);
            $messageService->tplKey = OrderSendInfo::TPL_NAME;
            $messageService->templateSend();
        } catch (\Exception $exception) {
            \Yii::error('向用户发送短信消息失败');
            \Yii::error($exception);
        }
        return $this;
    }
}
