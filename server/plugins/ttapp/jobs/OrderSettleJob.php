<?php

namespace app\plugins\ttapp\jobs;

use app\jobs\BaseJob;
use app\models\Mall;
use app\models\Model;
use app\plugins\ttapp\models\TtappOrder;
use yii\queue\JobInterface;

class OrderSettleJob extends BaseJob implements JobInterface
{
    public $ttapp_order_id;

    public function execute($queue)
    {
        \Yii::warning('订单分账开始');
        $this->setRequest();

        try {
            $ttOrder = TtappOrder::find()->andWhere([
                'is_delete' => 0,
                'id' => $this->ttapp_order_id,
            ])
                ->with('paymentOrder')
                ->one();

            if (!$ttOrder) {
                throw new \Exception('分账订单不存在');
            }

            switch ($ttOrder->order_type) {
                case 'order':
                    if ($ttOrder->order->is_sale == 0) {
                        throw new \Exception('订单未过售后');
                    }
                    break;
                
                default:
                    # code...
                    break;
            }

            \Yii::$app->setMall(Mall::findOne($ttOrder->mall_id));

            $plugin = \Yii::$app->plugin->getPlugin('ttapp');
            /** @var TtPay $ttPay */
            $ttPay = $plugin->getTtPay($ttOrder->mall_id);

            $res = $ttPay->settle([
                'out_settle_no' => $ttOrder->out_settle_no,
                'out_order_no' => $ttOrder->paymentOrder->paymentOrderUnion->order_no,
                'settle_desc' => '订单结算',
                'notify_url' => \Yii::$app->hostInfo . \Yii::$app->baseUrl . '/pay-notify/toutiao-settle.php'
            ]);

            $ttOrder->extra_attributes = json_encode([
                'result' => $res
            ], JSON_UNESCAPED_UNICODE);

            $res = $ttOrder->save();
            \Yii::warning('订单分账结束');
        }catch(\Exception $exception) {
            \Yii::error('订单分账异常');
            \Yii::error($exception);
        }
    }
}
