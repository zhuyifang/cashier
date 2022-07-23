<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/21
 * Time: 4:45 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\jobs;

use app\jobs\BaseJob;
use app\models\Mall;
use app\models\Model;
use app\models\Order;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;
use yii\queue\JobInterface;

class AutoDelayJob extends BaseJob implements JobInterface
{
    public $week_number;
    public $order_id;
    public $mall_id;

    public function execute($queue)
    {
        \Yii::warning('---自动延期---' . $this->order_id);
        $mall = Mall::findOne($this->mall_id);
        \Yii::$app->setMall($mall);
        $this->setRequest();
        try {
            $order = Order::findOne([
                'id' => $this->order_id,
                'mall_id' => $this->mall_id,
                'is_delete' => 0,
                'is_recycle' => 0
            ]);
            if (!$order) {
                throw new WeeklyBuyException('订单不存在或已删除');
            }
            if ($order->new_status & 2) {
                throw new WeeklyBuyException('订单已关闭，不可操作');
            }
            $express = WeeklyBuyExpress::findOne([
                'week_number' => $this->week_number,
                'order_id' => $this->order_id,
                'mall_id' => $this->mall_id,
                'is_delete' => 0
            ]);
            if (!$express) {
                throw new WeeklyBuyException('不存在该期数');
            }
            if ($express->is_send == 1) {
                throw new WeeklyBuyException('已发货，无需延期');
            }
            if ($express->is_delay > 0) {
                throw new WeeklyBuyException('已延期，无需操作');
            }
            $delay = strtotime('+1 day', strtotime(date('Y-m-d', strtotime($express->send_time))));
            if ($delay > time()) {
                $reset = $delay - time();
                \Yii::$app->queue3->delay($reset > 0 ? $reset : 0)->push(new AutoDelayJob([
                    'week_number' => $express->week_number,
                    'order_id' => $express->order_id,
                    'mall_id' => \Yii::$app->mall->id
                ]));
                throw new WeeklyBuyException('未到自动顺延时间，无需顺延');
            }
            $common = CommonWeeklyBuyGoods::getInstanceByOrder($order);
            if ($order->send_type != 1) {
                // 非到店自提订单 超时未发货则自动顺延
                $express->is_delay = 4;
                $express->delay_time = mysql_timestamp();
                $express->delay_week_number = $common->getDelayCountSuccess() + $common->week_number + 1;
                if (!$express->save()) {
                    throw new WeeklyBuyException((new Model())->getErrorMsg($express));
                }
            }
            $common->createNextExpress($express->week_number + 1);
            try {
                $currentExpress = $common->getCurrentExpress($express->week_number - 1);
                if ($currentExpress && $currentExpress->is_send == 1 && $currentExpress->is_confirm == 0) {
                    $common->confirm($currentExpress);
                }
            } catch (\Exception $exception) {
                \Yii::error('自动确认收货');
                \Yii::error($exception);
            }
        } catch (\Exception $exception) {
            \Yii::warning($exception);
        }
        return true;
    }
}
