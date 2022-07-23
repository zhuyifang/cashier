<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%form_goods_orders}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $mch_id
 * @property string $form_data
 * @property int $order_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_delete
 */
class FormGoodsOrders extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%form_goods_orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'order_id'], 'required'],
            [['mall_id', 'mch_id', 'order_id', 'is_delete'], 'integer'],
            [['form_data'], 'string'],
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
            'form_data' => 'Form Data',
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'is_delete' => 'Is Delete',
        ];
    }
}
