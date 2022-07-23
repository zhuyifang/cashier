<?php

namespace app\plugins\weekly_buy\models;

use app\models\ClerkUser;
use app\models\OrderClerk;
use app\models\OrderDetailExpress;
use Yii;

/**
 * This is the model class for table "{{%weekly_buy_express}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $order_id
 * @property int $order_detail_id
 * @property int $order_detail_express_id
 * @property int $week_number 第几期
 * @property int $is_send 是否发货
 * @property int $is_confirm 是否确认收货
 * @property int $is_delay 是否延期 0--不延期 1--用户延期 2--商家手动延期 4--未发货自动延期
 * @property string $send_time 预约发货时间
 * @property string $delay_time 延期时间
 * @property int $is_delete
 * @property int $order_clerk_id 核销信息表id
 * @property int $clerk_id 核销员id
 * @property int $delay_week_number 顺延至
 * @property string $confirm_time 确认收货时间
 * @property string $express_content 备注
 * @property string $updated_at
 * @property string $created_at
 * @property string $deleted_at
 * @property OrderDetailExpress $orderDetailExpress
 * @property OrderClerk $orderClerk
 * @property ClerkUser $clerkUser
 * @property WeeklyBuyExpress $delayExpress
 */
class WeeklyBuyExpress extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%weekly_buy_express}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'order_id', 'order_detail_id', 'order_detail_express_id', 'week_number', 'is_send',
                'is_confirm', 'is_delay', 'is_delete', 'order_clerk_id', 'clerk_id', 'delay_week_number'], 'integer'],
            [['send_time', 'delay_time', 'confirm_time', 'updated_at', 'created_at', 'deleted_at'], 'safe'],
            [['express_content'], 'string'],
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
            'order_id' => 'Order ID',
            'order_detail_id' => 'Order Detail ID',
            'order_detail_express_id' => 'Order Detail Express ID',
            'week_number' => '第几期',
            'is_send' => '是否发货',
            'is_confirm' => '是否确认收货',
            'is_delay' => '是否延期 0--不延期 1--用户延期 2--商家手动延期 4--未发货自动延期',
            'send_time' => '预约发货时间',
            'delay_time' => '延期时间',
            'is_delete' => 'Is Delete',
            'order_clerk_id' => '核销信息表id',
            'clerk_id' => '核销员id',
            'delay_week_number' => '顺延至',
            'confirm_time' => '确认收货时间',
            'express_content' => '备注',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function getOrderDetailExpress()
    {
        return $this->hasOne(OrderDetailExpress::className(), ['id' => 'order_detail_express_id']);
    }

    public function getOrderClerk()
    {
        return $this->hasOne(OrderClerk::className(), ['id' => 'order_clerk_id']);
    }

    public function getClerkUser()
    {
        return $this->hasOne(ClerkUser::className(), ['id' => 'clerk_id']);
    }

    public function getDelayExpress()
    {
        return $this->hasOne(WeeklyBuyExpress::className(), ['delay_week_number' => 'week_number', 'order_id' => 'order_id'])
            ->andWhere(['is_delete' => 0]);
    }

    /**
     * @return bool
     * 是否完成
     */
    public function isFinish()
    {
        return strtotime($this->send_time) < strtotime(date('Y-m-d')) || $this->is_confirm == 1;
    }
}
