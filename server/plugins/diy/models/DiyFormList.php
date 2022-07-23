<?php

namespace app\plugins\diy\models;

use Yii;

/**
 * This is the model class for table "{{%diy_form_list}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property string $name
 * @property int $status 提交周期0--不限制1--每天2--每周3--每月4--每年
 * @property int $limit 可提交次数
 * @property string $tip 超出可提交次数提示
 * @property string $form_data 表单内容
 * @property int $is_delete
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_share 是否开启分销0--关闭 1--开启
 * @property int $time_status 定时状态0.关闭|1.开启
 * @property string $time_at 定时时间
 */
class DiyFormList extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%diy_form_list}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'form_data', 'created_at', 'updated_at', 'deleted_at'], 'required'],
            [['mall_id', 'status', 'limit', 'is_delete', 'is_share', 'time_status'], 'integer'],
            [['form_data'], 'string'],
            [['created_at', 'updated_at', 'deleted_at', 'time_at'], 'safe'],
            [['name', 'tip'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'status' => '提交周期0--不限制1--每天2--每周3--每月4--每年',
            'limit' => '可提交次数',
            'tip' => '超出可提交次数提示',
            'form_data' => '表单内容',
            'is_delete' => 'Is Delete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'is_share' => '是否开启分销0--关闭 1--开启',
            'time_status' => '定时状态0.关闭|1.开启',
            'time_at' => '定时时间',
        ];
    }
}
