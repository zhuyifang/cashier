<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/15
 * Time: 3:59 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\handlers;

use app\handlers\orderHandler\BaseOrderCanceledHandler;
use app\models\GoodsAttr;
use app\models\Order;
use app\models\OrderDetail;
use app\plugins\weekly_buy\forms\common\CommonGoods;
use yii\db\Exception;

class OrderCanceledHandler extends BaseOrderCanceledHandler
{
    /**
     * @param Order $order
     * @throws Exception
     */
    protected function goodsAddStock($order)
    {
        /* @var OrderDetail[] $orderDetail */
        $orderDetail = $order->detail;
        $goodsAttrIdList = [];
        $goodsNum = [];
        foreach ($orderDetail as $item) {
            $goodsInfo = \Yii::$app->serializer->decode($item->goods_info);
            $mainGoodsAttrId = $goodsInfo['goods_attr']['mainGoodsAttrId'];
            $goodsAttrIdList[] = $mainGoodsAttrId;
            $goodsNum[$mainGoodsAttrId] = $item->num * $goodsInfo['goods_attr']['week_number'];
        }
        $goodsAttrList = GoodsAttr::find()->where(['id' => $goodsAttrIdList])->all();
        /* @var GoodsAttr[] $goodsAttrList */
        foreach ($goodsAttrList as $goodsAttr) {
            $goodsAttr->updateStock($goodsNum[$goodsAttr->id], 'add');
        }

        return $this;
    }

    protected function updateGoodsInfo()
    {
        // 修改商品支付信息
        CommonGoods::getCommon()->setGoodsPayment($this->event->order, 'sub');
        CommonGoods::getCommon()->setGoodsSales($this->event->order);

        return $this;
    }
}
