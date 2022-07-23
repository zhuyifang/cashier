<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/2
 * Time: 5:41 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\handlers;

use app\handlers\orderHandler\OrderSalesHandlerClass;
use app\helpers\Json;

class OrderSaledHandlerClass extends OrderSalesHandlerClass
{
    protected function action()
    {
        \Yii::error('周期购过售后');
        foreach ($this->orderDetailList as &$orderDetail) {
            $goodsInfo = Json::decode($orderDetail->goods_info, true);
            $goodsAttr = $goodsInfo['goods_attr'];
            $orderDetail->num = $orderDetail->num * $goodsAttr['week_number'];
        }
        unset($orderDetail);
        parent::action();
    }
}
