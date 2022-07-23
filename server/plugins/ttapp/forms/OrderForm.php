<?php
/**
 * @copyright ©2019 浙江禾匠信息科技
 * Created by PhpStorm.
 * User: Andy - Wangjie
 * Date: 2019/8/14
 * Time: 9:22
 */

namespace app\plugins\ttapp\forms;

use app\core\response\ApiCode;
use app\models\MallMemberOrders;
use app\models\Model;
use app\models\PaymentOrder;
use app\models\PaymentOrderUnion;
use app\models\RechargeOrders;
use app\plugins\ttapp\Plugin;
use app\plugins\ttapp\jobs\OrderSettleJob;
use app\plugins\ttapp\models\Order;
use app\plugins\ttapp\models\TtappOrder;

class OrderForm extends Model
{
    public $search;
    public $id;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['search'], 'safe'],
        ];
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        // 兼容旧数据
        $this->handleOldOrder();

        $query = $this->getQuery();

        $list = $query->orderBy(['created_at' => SORT_DESC])->page($pagination)->all();
        $newList = [];
        foreach ($list as $item) {
            switch ($item->order_type) {
                case 'order':
                    $payPrice = $item->order->total_pay_price;
                    $isSale = $item->order->is_sale;
                    break;
                case 'balance':
                    $payPrice = $item->reOrder->pay_price;
                    $isSale = 1;
                    break;
                case 'member':
                    $payPrice = $item->memberOrder->pay_price;
                    $isSale = 1;
                    break;
                default:
                    $payPrice = 0;
                    $isSale = 1;
                    break;
            }

            // 兼容旧数据
            if ($item->status && $item->money == 0) {
                try {
                    $plugin = \Yii::$app->plugin->getPlugin('ttapp');
                    /** @var TtPay $ttPay */
                    $ttPay = $plugin->getTtPay($item->mall_id);
                    $res = $ttPay->querySettle([
                        'out_settle_no' => $item->out_settle_no
                    ]);

                    if ($res['err_no'] != 0) {
                        throw new \Exception($res['err_tips']);
                    }
                    $item->money = $res['settle_info']['settle_amount'];
                    $item->save();
                }catch(\Exception $exception) {

                }
            }
            $newList[] = [
                'id' => $item->id,
                'created_at' => $item->created_at,
                'order_no' => $item->order_no,
                'pay_price' => $payPrice,
                'price' => $item->money > 0 ? $item->money / 100 : 0,
                'status' => $item->status,
                'sub_account_at' => $item->created_at,
                'is_sale' => $isSale
            ]; 
        }

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '请求成功',
            'data' => [
                'list' => $newList,
                'pagination' => $pagination
            ]
        ];
    }

    private function getQuery()
    {
        $search = json_decode($this->search, true);
        $query = TtappOrder::find()->andWhere([
            'mall_id' => \Yii::$app->mall->id, 
            'is_delete' => 0,
            'order_type' => $search['order_type']
        ]);

        if ($search['sub_account_type'] == 1) {
            $query->andWhere(['status' => 1]);
        } else {
            $query->andWhere(['status' => 0]);
        }

        if ($search['keyword']) {
            switch ($search['keyword_1']) {
                case 'order_no':
                    $query->andWhere(['order_no' => $search['keyword']]);
                    break;
                default:
                    # code...
                    break;
            }
        }

        if (isset($search['date_start']) && $search['date_end'] && $search['date_start'] && $search['date_end']) {
            $query->andWhere(['>=', 'created_at', $search['date_start']]);
            $query->andWhere(['<=', 'created_at', $search['date_end']]);
        }

        $query->andWhere(['<=', 'DATE_ADD(`created_at`, INTERVAL 7 DAY)', date('Y-m-d H:i:s', time())]);

        return $query;
    }

    private function handleOldOrder()
    {
        $key = 'MALL_SEETLE_' . \Yii::$app->mall->id;
        if (\Yii::$app->redis->get($key)) {
            return false;
        }

        $orderNos = TtappOrder::find()->andWhere(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0])->select('order_no');


        // 余额充值订单
        $reOrderList = RechargeOrders::find()->alias('ro')->andWhere([
            'ro.mall_id' => \Yii::$app->mall->id,
            'ro.is_delete' => 0,
            'ro.is_pay' => 1,
        ])
            ->andWhere(['not in', 'ro.order_no', $orderNos])
            ->leftJoin(['po' => PaymentOrder::tableName()], 'po.order_no = ro.order_no')
            ->andWhere(['po.pay_type' => 6, 'po.is_pay' => 1])
            ->all();

        // 商城订单
        $orderList = Order::find()->alias('o')->andWhere([
            'o.mall_id' => \Yii::$app->mall->id,
            'o.is_delete' => 0,
            'o.is_pay' => 1,
        ])
            ->andWhere(['not in', 'o.order_no', $orderNos])
            ->leftJoin(['po' => PaymentOrder::tableName()], 'po.order_no = o.order_no')
            ->andWhere(['po.pay_type' => 6, 'po.is_pay' => 1])
            ->all();

        // 商城订单
        $memberOrderList = MallMemberOrders::find()->alias('mo')->andWhere([
            'mo.mall_id' => \Yii::$app->mall->id,
            'mo.is_delete' => 0,
            'mo.is_pay' => 1,
        ])
            ->andWhere(['not in', 'mo.order_no', $orderNos])
            ->leftJoin(['po' => PaymentOrder::tableName()], 'po.order_no = mo.order_no')
            ->andWhere(['po.pay_type' => 6, 'po.is_pay' => 1])
            ->all();

        $newList = [];
        foreach ($reOrderList as $item) {
            $newList[] = [
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => 0,
                'order_type' => 'balance',
                'order_no' => $item->order_no,
                'out_settle_no' => generate_order_no(),
                'created_at' => $item->pay_time,
            ];
        }

        foreach ($orderList as $item) {
            $newList[] = [
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => 0,
                'order_type' => 'order',
                'order_no' => $item->order_no,
                'out_settle_no' => generate_order_no(),
                'created_at' => $item->pay_time,
            ];
        }

        foreach ($memberOrderList as $item) {
            $newList[] = [
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => 0,
                'order_type' => 'member',
                'order_no' => $item->order_no,
                'out_settle_no' => generate_order_no(),
                'created_at' => $item->pay_time,
            ];
        }

        \Yii::$app->db->createCommand()->batchInsert(
            TtappOrder::tableName(),
            ['mall_id', 'mch_id', 'order_type', 'order_no', 'out_settle_no', 'created_at'],
            $newList
        )->execute();

        \Yii::$app->redis->set($key, 1);
    }

    public function subAccount()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $queueId = \Yii::$app->queue->delay(0)->push(new OrderSettleJob([
                'ttapp_order_id' => $this->id,
            ]));

            $isDone = true;
            while ($isDone) {
                if (\Yii::$app->queue->isDone($queueId)) {
                    $isDone = false;
                }
            }

            $ttOrder = TtappOrder::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id, 
                'id' => $this->id
            ])
                ->one();

            if (!$ttOrder) {
                throw new \Exception('订单不存在');
            }

            $extra = $ttOrder->extra_attributes ? json_decode($ttOrder->extra_attributes, true) : [];

            if (isset($extra['result']['err_no']) && $extra['result']['err_no'] != 0) {
                throw new \Exception($extra['result']['err_tips']);
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '分账成功'
            ];
        }catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine()
            ];
        }
    }

    public function batchSubAccount()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $query = $this->getQuery();

            $list = $query->orderBy(['created_at' => SORT_DESC])->all();

            foreach ($list as $key => $item) {
                $queueId = \Yii::$app->queue->delay(0)->push(new OrderSettleJob([
                    'ttapp_order_id' => $item->id,
                ]));
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '分账中，请稍后刷新查看'
            ];
        }catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine()
            ];
        }
    }
}