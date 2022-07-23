<?php

namespace app\plugins\customer_service\models;

use Yii;

/**
 * This is the model class for table "{{%customer_service_role}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property string $created_at
 * @property string $update_at
 * @property string $deleted_at
 * @property int $is_delete
 * @property int $qy_id
 * @property string $name
 * @property string $url
 * @property CustomerServiceQy $qy
 */
class CustomerServiceRole extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer_service_role}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'is_delete', 'qy_id'], 'integer'],
            [['created_at', 'update_at', 'deleted_at'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'update_at' => 'Update At',
            'deleted_at' => 'Deleted At',
            'is_delete' => 'Is Delete',
            'qy_id' => '企业id',
            'name' => '客服名称',
            'url' => '客服链接',
        ];
    }

    public function getQy()
    {
        return $this->hasOne(CustomerServiceQy::className(), ['id' => 'qy_id'])->andWhere(['is_delete' => 0]);
    }
}
