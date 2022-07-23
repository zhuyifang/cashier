<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/24
 * Time: 4:03 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\events\OrderEvent;
use app\events\OrderRefundEvent;
use app\forms\common\share\AddShareOrder;
use app\models\Order;
use app\models\OrderRefund;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;

class OrderStopForm extends Model
{
    public $order_id;

    public function rules()
    {
        return [
            [['order_id'], 'integer']
        ];
    }

    public function execute()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $t = \Yii::$app->db->beginTransaction();
        try {
            $order = Order::findOne([
                'id' => $this->order_id,
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0,
                'is_recycle' => 0
            ]);
            $order = Order::checkOrder($order);
            $order->new_status = 3;
            if (!$order->save()) {
                throw new WeeklyBuyException($this->getErrorMsg($order));
            }
            $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($order);
            $sendCount = WeeklyBuyExpress::find()->where([
                'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'is_send' => 1,
                'order_id' => $order->id
            ])->count();
            $reset = ($commonWeeklyBuyGoods->week_number - $sendCount) / $commonWeeklyBuyGoods->week_number;
            // 快递发货且为固定运费时不退运费
            $expressPrice = 0;
            if ($commonWeeklyBuyGoods->weeklyBuyGoods->freight_type == 1 && $order->send_type == 0) {
                $price = $order->total_goods_price * $reset;
            } else {
                $price = $order->total_pay_price * $reset;
                $expressPrice = $order->express_price * $reset;
            }
            $orderRefund = new OrderRefund();
            $orderRefund->mall_id = $order->mall_id;
            $orderRefund->user_id = $order->user_id;
            $orderRefund->order_id = $order->id;
            $orderRefund->order_detail_id = $order->detail[0]->id;
            $orderRefund->type = 3;
            $orderRefund->order_no = Order::getOrderNo('RE');
            $orderRefund->refund_price = $price;
            $orderRefund->reality_refund_price = $price;
            $orderRefund->status = 2;
            $orderRefund->status_time = mysql_timestamp();
            $orderRefund->is_confirm = 1;
            $orderRefund->confirm_time = mysql_timestamp();
            $orderRefund->is_refund = 1;
            $orderRefund->refund_time = mysql_timestamp();
            $orderRefund->is_send = 1;
            $orderRefund->send_time = mysql_timestamp();
            $orderRefund->remark = '商家中断交易，剩余期数退款';
            $orderRefund->pic_list = json_encode([]);
            $orderRefund->mobile = '';
            $orderRefund->refund_data = json_encode([]);
            $orderRefund->reality_refund_express_price = $expressPrice;
            if (!$orderRefund->save()) {
                throw new WeeklyBuyException($this->getErrorMsg($orderRefund));
            }
            \Yii::$app->payment->refund($order->order_no, $price);
            \Yii::$app->trigger(OrderRefund::EVENT_REFUND, new OrderRefundEvent([
                'order_refund' => $orderRefund,
                'is_destroy_card' => false
            ]));
            $t->commit();
            return $this->success([
                'msg' => '操作成功'
            ]);
        } catch (\Exception $exception) {
            $t->rollBack();
            return $this->failByException($exception);
        }
    }
}
