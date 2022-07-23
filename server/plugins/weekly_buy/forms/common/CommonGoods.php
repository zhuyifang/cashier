<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/4
 * Time: 5:57 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common;

use app\helpers\Json;
use app\plugins\weekly_buy\models\Goods;
use app\plugins\weekly_buy\models\Order;
use app\plugins\weekly_buy\models\WeeklyBuyOrderDetail;

class CommonGoods extends \app\forms\common\goods\CommonGoods
{
    public static function getCommon()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function getGoodsList($order)
    {
        \Yii::error('商品支付信息获取统计数据');
        $goodsList = [];
        foreach ($order->detail as $detail) {
            $weeklyBuyOrderDetail = WeeklyBuyOrderDetail::findOne([
                'order_detail_id' => $detail->id, 'mall_id' => \Yii::$app->mall->id
            ]);
            if (!isset($goodsList[$weeklyBuyOrderDetail->main_goods_id])) {
                $goodsList[$weeklyBuyOrderDetail->main_goods_id] = [
                    'goods' => $weeklyBuyOrderDetail->mainGoods,
                    'num' => 0,
                    'total_price' => 0,
                    'goods_id' => $weeklyBuyOrderDetail->main_goods_id
                ];
            }
            $goodsList[$weeklyBuyOrderDetail->main_goods_id]['num'] += $weeklyBuyOrderDetail->num;
            $goodsList[$weeklyBuyOrderDetail->main_goods_id]['total_price'] += floatval($detail->total_price);
        }
        return array_values($goodsList);
    }

    public function setGoodsSales($order)
    {
        try {
            \Yii::error('更新销量');
            $goodsIdList = [];
            foreach ($order->detail as $detail) {
                $goodsInfo = Json::decode($detail->goods_info, true);
                $goodsAttr = $goodsInfo['goods_attr'];
                $goodsIdList[] = $goodsAttr['mainGoodsId'];
            }
            $orderIds = Order::find()->where([
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0,
            ])->andWhere([
                'or',
                ['is_pay' => 1],
                ['pay_type' => 2]
            ])->andWhere(['!=', 'cancel_status', 1])
                ->select('id');

            $sales = WeeklyBuyOrderDetail::find()->where(['main_goods_id' => $goodsIdList, 'order_id' => $orderIds])
                ->select(['IF(sum(num), sum(num), 0) as count', 'main_goods_id'])
                ->asArray()
                ->groupBy('main_goods_id')
                ->all();
            $sales = array_combine(array_column($sales, 'main_goods_id'), array_column($sales, 'count'));
            $goodsList = Goods::findAll([
                'mall_id' => \Yii::$app->mall->id, 'id' => $goodsIdList
            ]);
            $ignore = [];
            foreach ($goodsList as $goods) {
                if (in_array($goods->id, $ignore)) {
                    continue;
                }
                $goods->sales = (isset($sales[$goods->id]) && $sales[$goods->id]) ? $sales[$goods->id] : 0;
                $goods->save();
            }
        } catch (\Exception $exception) {
            \Yii::warning('更新商品销量出错');
            \Yii::warning($exception);
        }
        return true;
    }
}
