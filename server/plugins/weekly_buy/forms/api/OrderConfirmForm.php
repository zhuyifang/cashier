<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/22
 * Time: 11:11 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api;

use app\models\Order;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;

class OrderConfirmForm extends Model
{
    public $week_number;
    public $order_id;

    public function rules()
    {
        return [
            [['week_number', 'order_id'], 'required'],
            [['week_number', 'order_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'week_number' => '期数',
            'order_id' => '订单id'
        ];
    }

    public function confirm()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $weeklyBuyExpress = WeeklyBuyExpress::findOne([
                'week_number' => $this->week_number,
                'order_id' => $this->order_id,
                'is_delete' => 0,
                'mall_id' => \Yii::$app->mall->id,
            ]);
            $order = Order::findOne([
                'id' => $this->order_id,
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0,
            ]);
            $order = Order::checkOrder($order);
            $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($order);
            $commonWeeklyBuyGoods->confirm($weeklyBuyExpress);
            return $this->success([
                'msg' => '确认收货成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
