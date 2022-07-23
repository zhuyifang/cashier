<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/17
 * Time: 5:21 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\forms\common\order\send\BaseSend;
use app\models\Order;
use app\plugins\weekly_buy\events\OrderSendEvent;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\handlers\HandlerRegister;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;

class SendOrderForm extends Model
{
    public $week_number;

    /**
     * @var BaseSend $sender
     */
    public $sender;

    public function rules()
    {
        return [
            [['week_number'], 'required'],
            [['week_number'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'week_number' => '发货的期数'
        ];
    }

    public function send()
    {
        if ($this->sender->express_id) {
            $this->sender->update_send = false;
            return $this->sender;
        }
        if (!$this->validate()) {
            throw new WeeklyBuyException($this->getErrorMsg());
        }
        $express = WeeklyBuyExpress::findOne([
            'week_number' => $this->week_number,
            'order_id' => $this->sender->order_id,
            'is_delete' => 0,
            'mall_id' => \Yii::$app->mall->id,
        ]);
        $order = Order::checkOrder($this->sender->order);
        $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($order);
        $delayCount = $commonWeeklyBuyGoods->getDelayCountSuccess();
        if (!$express) {
            if ($delayCount + $commonWeeklyBuyGoods->week_number < $this->week_number) {
                throw new WeeklyBuyException('提交的期数超过总期数');
            }
            $express = $commonWeeklyBuyGoods->createExpress($this->week_number, $commonWeeklyBuyGoods->week_key);
        }
        if ($express->is_delay > 0) {
            throw new WeeklyBuyException('本期已顺延，不需要发货');
        }
        if (strtotime($express->send_time) < strtotime(date('Y-m-d'))) {
            throw new WeeklyBuyException('超过发货时间，不能发货');
        }
        $currentExpress = $commonWeeklyBuyGoods->getCurrentExpress($express->week_number - 1);
        if ($currentExpress) {
            try {
                if ($currentExpress->is_send == 1 && $currentExpress->is_confirm == 0) {
                    $commonWeeklyBuyGoods->confirm($currentExpress);
                }
            } catch (\Exception $exception) {
                \Yii::error('自动确认收货');
            }
            if (!$currentExpress->isFinish()) {
                throw new WeeklyBuyException('未到发货时间，不能发货');
            }
        }
        $express->is_send = 1;
        $express->order_detail_express_id = $this->sender->orderDetailExpress->id;
        if (!$express->save()) {
            throw new WeeklyBuyException($this->getErrorMsg($express));
        }
        // 第一期发货时变更订单为待收货状态
        $this->sender->update_send = $this->week_number == 1;
        $commonWeeklyBuyGoods->createNextExpress($this->week_number + 1, function ($result) {
            // 下一周期创建成功，则不触发发货完成事件
            $this->sender->is_trigger_event = !$result;
        });
        \Yii::$app->trigger(HandlerRegister::EVENT_WEEKLY_BUY_SENT, new OrderSendEvent([
            'order' => $order, 'week_number' => $this->week_number
        ]));

        return $this->sender;
    }
}
