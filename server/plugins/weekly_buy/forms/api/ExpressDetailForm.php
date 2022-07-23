<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/21
 * Time: 10:41 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api;

use app\helpers\Json;
use app\models\Order;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;

class ExpressDetailForm extends Model
{
    public $order_id;

    public $week_number;

    public function rules()
    {
        return [
            [['order_id', 'week_number'], 'integer']
        ];
    }

    public function execute()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            /** @var WeeklyBuyExpress $express */
            $express = WeeklyBuyExpress::find()->with(['orderDetailExpress'])
                ->andWhere(['mall_id' => \Yii::$app->mall->id, 'order_id' => $this->order_id,
                    'week_number' => $this->week_number, 'is_delete' => 0])
                ->one();
            if (!$express) {
                throw new WeeklyBuyException('错误的发货信息');
            }
            /** @var Order $order */
            $order = Order::find()->with('detail')->where([
                'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'id' => $this->order_id
            ])->one();
            if (!$order) {
                throw new WeeklyBuyException('订单不存在');
            }
            if ($order->is_recycle == 1 || $order->is_delete == 1) {
                throw new WeeklyBuyException('订单不存在或已被删除');
            }
            $goodsInfo = Json::decode($order->detail[0]->goods_info, true);
            $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($order);

            $count = WeeklyBuyExpress::find()->where([
                'mall_id' => \Yii::$app->mall->id, 'order_id' => $this->order_id, 'is_delete' => 0
            ])->orderBy(['week_number' => SORT_DESC])->select('week_number')->scalar();
            return $this->success(array_merge($commonWeeklyBuyGoods->expressInfo($express), [
                'goods_info' => $goodsInfo,
                'count' => $count,
                'send_type' => $order->send_type,
                'order' => [
                    'new_status' => $order->new_status,
                    'is_confirm' => $order->is_confirm,
                    'is_sale' => $order->is_sale
                ]
            ]));
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
