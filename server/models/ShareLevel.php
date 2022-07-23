<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%share_level}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $level 分销等级1~100
 * @property string $name 分销等级名称
 * @property int $condition_type 升级条件：1--下线用户数|2--累计佣金|3--已提现佣金
 * @property string $condition 下线用户数（人）|累计佣金数（元）|已提现佣金数（元）
 * @property int $price_type 分销佣金类型：1--百分比|2--固定金额
 * @property string $first 一级分销佣金数（元）
 * @property int $status 是否启用
 * @property int $is_delete
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $second 二级分销佣金数（元）
 * @property string $third 三级分销佣金数（元）
 * @property int $is_auto_level 是否启用自动升级
 * @property string $rule 等级说明
 * @property string $new_condition_type 新版升级条件：1--下线用户数|2--累计佣金|3--已提现佣金|4—累计消费|5—下线分销商人数
 * @property int $condition_user 下线用户数
 * @property string $condition_total_share_money 累计佣金
 * @property string $condition_cash 已提现佣金
 * @property string $condition_total_consume 累计消费金额
 * @property int $condition_share 下线分销商数
 */
class ShareLevel extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%share_level}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'created_at', 'updated_at', 'deleted_at'], 'required'],
            [['mall_id', 'level', 'condition_type', 'price_type', 'status', 'is_delete', 'is_auto_level', 'condition_user', 'condition_share'], 'integer'],
            [['condition', 'first', 'second', 'third', 'condition_total_share_money', 'condition_cash', 'condition_total_consume'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'rule', 'new_condition_type'], 'string', 'max' => 255],
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
            'level' => '分销等级1~100',
            'name' => '分销等级名称',
            'condition_type' => '升级条件：1--下线用户数|2--累计佣金|3--已提现佣金',
            'condition' => '下线用户数（人）|累计佣金数（元）|已提现佣金数（元）',
            'price_type' => '分销佣金类型：1--百分比|2--固定金额',
            'first' => '一级分销佣金数（元）',
            'status' => '是否启用',
            'is_delete' => 'Is Delete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'second' => '二级分销佣金数（元）',
            'third' => '三级分销佣金数（元）',
            'is_auto_level' => '是否启用自动升级',
            'rule' => '等级说明',
            'new_condition_type' => '新版升级条件：1--下线用户数|2--累计佣金|3--已提现佣金|4—累计消费|5—下线分销商人数',
            'condition_user' => '下线用户数',
            'condition_total_share_money' => '累计佣金',
            'condition_cash' => '已提现佣金',
            'condition_total_consume' => '累计消费金额',
            'condition_share' => '下线分销商数',
        ];
    }
}
