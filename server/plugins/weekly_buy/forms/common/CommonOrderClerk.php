<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/24
 * Time: 2:06 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common;

use app\events\OrderSendEvent;
use app\models\OrderClerk;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\handlers\HandlerRegister;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;

class CommonOrderClerk extends \app\forms\common\order\CommonOrderClerk
{
    public $week_number;
    protected $is_finish = false;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['week_number'], 'integer']
        ]);
    }

    public function clerk($clerkUser)
    {
        $express = WeeklyBuyExpress::findOne([
            'week_number' => $this->week_number,
            'order_id' => $this->order->id,
            'is_delete' => 0,
            'mall_id' => \Yii::$app->mall->id,
        ]);
        $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($this->order);
        $delayCount = $commonWeeklyBuyGoods->getDelayCountSuccess();
        if (!$express) {
            if ($delayCount + $commonWeeklyBuyGoods->week_number < $this->week_number) {
                throw new WeeklyBuyException('提交的期数超过总期数');
            }
            $express = $commonWeeklyBuyGoods->createExpress($this->week_number, $commonWeeklyBuyGoods->week_key);
        }
        if ($express->is_delay > 0) {
            throw new WeeklyBuyException('本期已顺延，不需要核销');
        }
        $currentExpress = $commonWeeklyBuyGoods->getCurrentExpress($express->week_number - 1);
        if ($currentExpress && strtotime($currentExpress->send_time) >= strtotime(date('Y-m-d'))) {
            throw new WeeklyBuyException('未到发货时间，不能核销');
        }

        if ($express->is_send == 1) {
            throw new WeeklyBuyException('本期订单已核销');
        }

        $orderClerk = new OrderClerk();
        $orderClerk->mall_id = \Yii::$app->mall->id;
        $orderClerk->affirm_pay_type = $this->action_type;
        $orderClerk->order_id = $this->order->id;
        $orderClerk->clerk_remark = $this->clerk_remark ?: '';
        $orderClerk->clerk_type = $this->clerk_type;

        if (!$orderClerk->save()) {
            throw new WeeklyBuyException($this->getErrorMsg($orderClerk));
        }

        $express->is_send = 1;
        $express->is_confirm = 1;
        $express->order_detail_express_id = 0;
        $express->order_clerk_id = $orderClerk->id;
        $express->clerk_id = $clerkUser->id;
        $express->confirm_time = mysql_timestamp();
        if (!$express->save()) {
            throw new WeeklyBuyException($this->getErrorMsg($express));
        }
        $commonWeeklyBuyGoods->createNextExpress($this->week_number + 1, function ($res) {
            $this->is_finish = !$res;
        });
        // 第一期核销之后，变更订单为待收货状态
        if ($this->week_number == 1) {
            $this->order->is_send = 1;
            $this->order->send_time = mysql_timestamp();
        }
        // 全部核销之后，变更订单为已收货状态
        if ($this->is_finish) {
            $this->order->is_confirm = 1;
            $this->order->confirm_time = mysql_timestamp();
        }
        $this->order->clerk_id = $clerkUser->id;
        if (!$this->order->save()) {
            throw new WeeklyBuyException($this->getErrorMsg($this->order));
        }
        return $this->updateClerk($clerkUser);
    }

    public function updateClerk($clerkUser)
    {
        return true;
    }

    public function triggerEvent()
    {
        \Yii::$app->trigger(HandlerRegister::EVENT_WEEKLY_BUY_SENT, new OrderSendEvent(['order' => $this->order]));
        if ($this->is_finish) {
            parent::triggerEvent();
        }
    }
}
