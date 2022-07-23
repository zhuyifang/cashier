<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/4
 * Time: 9:55 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common;

use app\models\Order;
use app\models\OrderDetail;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyOrderDetail;

class LimitBuy extends \app\forms\common\goods\LimitBuy
{
    /**
     * @var WeeklyBuyGoods $weeklyBuyGoods
     */
    public $weeklyBuyGoods;

    public $week_number;

    public function getOrderNum($time)
    {
        if ($time == 0) {
            $num = OrderDetail::find()->alias('od')
                ->leftJoin(['o' => Order::tableName()], 'od.order_id=o.id')
                ->leftJoin(['wbod' => WeeklyBuyOrderDetail::tableName()], 'wbod.order_detail_id = od.id')
                ->where([
                    'od.goods_id' => $this->goods->id,
                    'od.is_delete' => 0,
                    'o.user_id' => $this->user_id,
                    'o.is_delete' => 0,
                ])
                ->keyword($time, ['between', 'o.created_at', $time, mysql_timestamp()])
                ->andWhere(['!=', 'o.cancel_status', 1])
                ->sum('wbod.num');
        } else {
            $num = parent::getOrderNum($time);
        }
        return $num;
    }
}
