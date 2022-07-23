<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/18
 * Time: 9:54 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\handlers;

use app\handlers\orderHandler\OrderPayedHandlerClass;
use app\plugins\weekly_buy\forms\common\CommonGoods;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;

class OrderPayedHandler extends OrderPayedHandlerClass
{
    public function pay()
    {
        parent::pay()->createFirst();
        return $this;
    }

    /**
     * @return array
     * 调整到每期发货时赠送
     */
    public function sendCard()
    {
        return [];
    }

    /**
     * @return array
     * 调整到每期发货时赠送
     */
    public function sendCouponByGoods()
    {
        return [];
    }

    /**
     * @return $this
     * @throws \Exception
     * 创建第一期信息
     */
    public function createFirst()
    {
        $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($this->event->order);
        $express = $commonWeeklyBuyGoods->createExpress(1, $commonWeeklyBuyGoods->week_key);
        $express->save();
        return $this;
    }

    protected function setGoods()
    {
        \Yii::warning('商品支付信息设置');
        try {
            CommonGoods::getCommon()->setGoodsPayment($this->event->order, 'add');
            CommonGoods::getCommon()->setGoodsSales($this->event->order);
        } catch (\Exception $exception) {
            \Yii::error('商品支付信息设置');
            \Yii::error($exception);
        }
        return $this;
    }
}
