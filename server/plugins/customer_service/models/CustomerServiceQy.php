<?php

namespace app\plugins\customer_service\models;

use Yii;

/**
 * This is the model class for table "{{%customer_service_qy}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property string $created_at
 * @property string $update_at
 * @property string $deleted_at
 * @property int $is_delete
 * @property string $enterprise_id 企业id
 * @property string $name 企业名称
 * @property CustomerServiceRole[] $role
 */
class CustomerServiceQy extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer_service_qy}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'is_delete'], 'integer'],
            [['created_at', 'update_at', 'deleted_at'], 'safe'],
            [['enterprise_id', 'name'], 'string', 'max' => 255],
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
            'enterprise_id' => '企业id',
            'name' => '企业名称',
        ];
    }

    public function getRole()
    {
        return $this->hasMany(CustomerServiceRole::className(), ['qy_id' => 'id'])->andWhere(['is_delete' => 0]);
    }
}
