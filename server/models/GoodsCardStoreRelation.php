<?php

namespace app\models;

use Yii;
use app\models\Store;

/**
 * This is the model class for table "{{%goods_card_store_relation}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $mch_id
 * @property int $card_id 商品卡券ID
 * @property int $store_id 门店ID
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_delete
 */
class GoodsCardStoreRelation extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%goods_card_store_relation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mall_id', 'card_id', 'store_id'], 'required'],
            [['id', 'mall_id', 'mch_id', 'card_id', 'store_id', 'is_delete'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['id'], 'unique'],
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
            'card_id' => '商品卡券ID',
            'store_id' => '门店ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'is_delete' => 'Is Delete',
        ];
    }

    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }
}
