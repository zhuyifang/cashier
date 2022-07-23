<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\ttapp\handler;

use app\handlers\orderHandler\OrderSalesHandlerClass;
use app\plugins\ttapp\models\TtappOrder;


class OrderSalesHandler extends OrderSalesHandlerClass
{
    public function handle()
    {
        parent::handle();
        $this->settle();
    }

    protected function settle()
    {
        try {
            $ttOrder = TtappOrder::find()->andWhere(['order_no' => $this->event->order->order_no])->one();
            if (!$ttOrder) {
                throw new \Exception('订单不存在');
            }

            $plugin = \Yii::$app->plugin->getPlugin('ttapp');
            $plugin->settle($ttOrder);
        }catch(\Exception $exception) {
            \Yii::error('分账异常');
            \Yii::error($exception);
        }
    }
}
