<?php

namespace app\plugins\weekly_buy\models;

use Yii;

/**
 * This is the model class for table "{{%weekly_buy_goods}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $goods_id
 * @property string $start_time 开始时间
 * @property string $end_time 结束时间
 * @property int $week_type 配送周期 1--每日一期 2--每周一期 3--每月一期 4--自定义（天/期）5--按周循环 6--按月循环
 * @property string $week_status_day 每日一期的配送日期 1--每天配送 2--工作日每日配送 3--周末每天配送 4—隔天配送
 * @property string $week_status_week 每周一期的配送日期 1—周一 2—周二 3—周三 4—周四 5—周五 6—周六 0—周日
 * @property string $week_status_month 每月一期的配送日期 1～31
 * @property string $week_status_customize 自定义的配送日期1～31
 * @property int $week_status_customize_day 自定义配送的天数
 * @property int $before_day 支付提前的天数
 * @property int $last_time 一天的截止时间 0~23
 * @property int $delay 顺延提前的天数
 * @property int $delay_limit_type 顺延限制类型 0--不限制 1--每个周期购活动，每人每月顺延次数限制
 * @property int $delay_limit_number 可顺延次数
 * @property int $freight_type 运费类型0--适用商城运费 1--固定运费
 * @property string $freight 固定运费（元）
 * @property int $shipping_type 包邮类型0--不包邮 1--满期包邮 2--满额包邮
 * @property int $shipping_number 包邮的期数
 * @property string $shipping_price 包邮的金额（元）
 * @property int $weekly_buy_goods_id 主商品id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_delete
 * @property int $city_freight_type 同城配送运费类型0--适用商城运费 1--固定运费
 * @property string $city_freight 同城配送固定运费（元）
 * @property int $city_shipping_type 同城配送包邮类型0--不包邮 1--满期包邮 2--满额包邮
 * @property int $city_shipping_number 同城配送包邮的期数
 * @property string $city_shipping_price 同城配送包邮的金额（元）
 * @property int $is_no_end_time 结束时间是否无限制0--不无限1--无限
 * @property string $week_custom 周期选项名称
 * @property int $week_mode 周期方式0--周期模式1--循环模式
 * @property string $week_loop 按周循环的配送日期
 * @property string $month_loop 按月循环的配送日期
 * @property WeeklyBuyGoods[] $groups
 * @property Goods $goods
 */
class WeeklyBuyGoods extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%weekly_buy_goods}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'goods_id', 'week_type', 'week_status_customize_day', 'before_day', 'last_time', 'delay', 'delay_limit_type', 'delay_limit_number', 'freight_type', 'shipping_type', 'shipping_number', 'weekly_buy_goods_id', 'is_delete', 'city_freight_type', 'city_shipping_type', 'city_shipping_number', 'is_no_end_time', 'week_mode'], 'integer'],
            [['start_time', 'end_time', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['freight', 'shipping_price', 'city_freight', 'city_shipping_price'], 'number'],
            [['shipping_type'], 'required'],
            [['week_status_day', 'week_status_week', 'week_status_month', 'week_status_customize', 'week_custom', 'week_loop', 'month_loop'], 'string', 'max' => 255],
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
            'goods_id' => 'Goods ID',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'week_type' => '配送周期 1--每日一期 2--每周一期 3--每月一期 4--自定义（天/期）5--按周循环 6--按月循环',
            'week_status_day' => '每日一期的配送日期 1--每天配送 2--工作日每日配送 3--周末每天配送 4—隔天配送',
            'week_status_week' => '每周一期的配送日期 1—周一 2—周二 3—周三 4—周四 5—周五 6—周六 0—周日',
            'week_status_month' => '每月一期的配送日期 1～31',
            'week_status_customize' => '自定义的配送日期1～31',
            'week_status_customize_day' => '自定义配送的天数',
            'before_day' => '支付提前的天数',
            'last_time' => '一天的截止时间 0~23',
            'delay' => '顺延提前的天数',
            'delay_limit_type' => '顺延限制类型 0--不限制 1--每个周期购活动，每人每月顺延次数限制',
            'delay_limit_number' => '可顺延次数',
            'freight_type' => '运费类型0--适用商城运费 1--固定运费',
            'freight' => '固定运费（元）',
            'shipping_type' => '包邮类型0--不包邮 1--满期包邮 2--满额包邮',
            'shipping_number' => '包邮的期数',
            'shipping_price' => '包邮的金额（元）',
            'weekly_buy_goods_id' => '主商品id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'is_delete' => 'Is Delete',
            'city_freight_type' => '同城配送运费类型0--适用商城运费 1--固定运费',
            'city_freight' => '同城配送固定运费（元）',
            'city_shipping_type' => '同城配送包邮类型0--不包邮 1--满期包邮 2--满额包邮',
            'city_shipping_number' => '同城配送包邮的期数',
            'city_shipping_price' => '同城配送包邮的金额（元）',
            'is_no_end_time' => '结束时间是否无限制0--不无限1--无限',
            'week_custom' => '周期选项名称',
            'week_mode' => '周期方式0--周期模式1--循环模式',
            'week_loop' => '按周循环的配送日期',
            'month_loop' => '按月循环的配送日期',
        ];
    }

    public function getGroups()
    {
        return $this->hasMany(WeeklyBuyGoods::className(), ['weekly_buy_goods_id' => 'id'])
            ->andWhere(['is_delete' => 0]);
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
