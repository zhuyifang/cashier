<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%form_goods_attr}}".
 *
 * @property int $id
 * @property int $goods_id 商品ID
 * @property int $attr_id 商品规格ID
 * @property string $date 日期
 * @property int $stock 库存
 * @property string $price 价格
 * @property string $member_price 会员价
 * @property string $share_level_list 分销价
 */
class FormGoodsAttr extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%form_goods_attr}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_id', 'attr_id'], 'required'],
            [['goods_id', 'attr_id', 'stock'], 'integer'],
            [['date'], 'safe'],
            [['price'], 'number'],
            [['member_price', 'share_level_list'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品ID',
            'attr_id' => '商品规格ID',
            'date' => '日期',
            'stock' => '库存',
            'price' => '价格',
            'member_price' => '会员价',
            'share_level_list' => '分销价',
        ];
    }
}
