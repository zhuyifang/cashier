<?php

namespace app\plugins\form_goods\models;

use Yii;

/**
 * This is the model class for table "{{%form_goods_template}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $mch_id
 * @property string $name 模板名称
 * @property string $form_data
 * @property string $logic_data 逻辑数据
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_delete
 * @property string $default_version 默认模板版本
 */
class FormGoodsTemplate extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%form_goods_template}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'mch_id', 'is_delete'], 'integer'],
            [['form_data', 'logic_data'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'default_version'], 'string', 'max' => 255],
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
            'name' => '模板名称',
            'form_data' => 'Form Data',
            'logic_data' => '逻辑数据',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'is_delete' => 'Is Delete',
            'default_version' => '默认模板版本',
        ];
    }
}
