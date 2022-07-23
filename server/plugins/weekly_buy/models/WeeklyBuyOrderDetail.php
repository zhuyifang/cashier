<?php

namespace app\plugins\weekly_buy\models;

use Yii;

/**
 * This is the model class for table "{{%weekly_buy_order_detail}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $order_id
 * @property int $order_detail_id
 * @property int $week_number 周期数
 * @property int $num 商品总数量
 * @property string $week_key 初始配送日期
 * @property int $actual_week_number 已配送周期
 * @property int $sent_num 已配送数量
 * @property int $main_goods_id 主商品id
 * @property int $main_goods_attr_id 主商品规格id
 * @property Goods $mainGoods
 */
class WeeklyBuyOrderDetail extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%weekly_buy_order_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'order_id'], 'required'],
            [['mall_id', 'order_id', 'order_detail_id', 'week_number', 'num', 'actual_week_number', 'sent_num', 'main_goods_id', 'main_goods_attr_id'], 'integer'],
            [['week_key'], 'string', 'max' => 255],
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
            'week_number' => '周期数',
            'num' => '商品总数量',
            'week_key' => '初始配送日期',
            'actual_week_number' => '已配送周期',
            'sent_num' => '已配送数量',
            'main_goods_id' => '主商品id',
            'main_goods_attr_id' => '主商品规格id',
        ];
    }

    public function getMainGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'main_goods_id']);
    }
}
