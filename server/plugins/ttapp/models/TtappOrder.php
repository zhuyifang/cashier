<?php

namespace app\plugins\ttapp\models;

use Yii;
use app\models\MallMemberOrders;
use app\models\Order;
use app\models\PaymentOrder;
use app\models\RechargeOrders;

/**
 * This is the model class for table "{{%ttapp_order}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $mch_id
 * @property int $order_id
 * @property int $status
 * @property string $out_settle_no
 * @property int $money
 * @property int $is_delete
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class TtappOrder extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ttapp_order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'mch_id', 'order_id', 'is_delete', 'status', 'money'], 'integer'],
            [['out_settle_no'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mall_id' => 'Mall ID',
            'mch_id' => 'Mch ID',
            'order_id' => 'Order ID',
            'status' => 'Status',
            'out_settle_no' => 'Out Settle No',
            'money' => 'money',
            'is_delete' => 'Is Delete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function getPaymentOrder()
    {
        return $this->hasOne(PaymentOrder::className(), ['order_no' => 'order_no']);
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_no' => 'order_no']);
    }

    public function getReOrder()
    {
        return $this->hasOne(RechargeOrders::className(), ['order_no' => 'order_no']);
    }

    public function getMemberOrder()
    {
        return $this->hasOne(MallMemberOrders::className(), ['order_no' => 'order_no']);
    }
}
