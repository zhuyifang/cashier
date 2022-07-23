<?php

namespace app\plugins\weekly_buy\models;

use Yii;

/**
 * This is the model class for table "{{%weekly_buy_groups}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $goods_id
 * @property int $weekly_buy_goods_id
 * @property int $number 周期
 * @property int $is_delete
 * @property string $title 标题
 * @property Goods $goods
 */
class WeeklyBuyGroups extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%weekly_buy_groups}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'goods_id', 'weekly_buy_goods_id', 'number', 'is_delete'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'weekly_buy_goods_id' => 'Weekly Buy Goods ID',
            'number' => '周期',
            'is_delete' => 'Is Delete',
            'title' => '标题',
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
