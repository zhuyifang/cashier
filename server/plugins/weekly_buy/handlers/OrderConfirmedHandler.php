<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/7
 * Time: 3:17 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\handlers;

use app\events\OrderEvent;
use app\handlers\HandlerBase;
use app\models\Order;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;
use app\plugins\weekly_buy\Plugin;

class OrderConfirmedHandler extends HandlerBase
{
    public function register()
    {
        \Yii::$app->on(Order::EVENT_CONFIRMED, function ($event) {
            /** @var OrderEvent $event */
            if ($event->order->sign != (new Plugin())->getName()) {
                return true;
            }
            try {
                \Yii::error('周期购确认收货事件');
                /** @var WeeklyBuyExpress $weeklyBuyExpress */
                $weeklyBuyExpress = WeeklyBuyExpress::find()->where([
                    'mall_id' => \Yii::$app->mall->id,
                    'order_id' => $event->order->id,
                    'is_delete' => 0
                ])->orderBy(['week_number' => SORT_DESC])->one();
                if (!$weeklyBuyExpress) {
                    throw new WeeklyBuyException('无效的订单');
                }
                if ($weeklyBuyExpress->is_send == 0) {
                    throw new WeeklyBuyException('周期未发货');
                }
                $weeklyBuyExpress->is_confirm = 1;
                $weeklyBuyExpress->confirm_time = mysql_timestamp();
                $weeklyBuyExpress->save();
            } catch (\Exception $exception) {
                \Yii::error($exception);
            }
        });
    }
}
