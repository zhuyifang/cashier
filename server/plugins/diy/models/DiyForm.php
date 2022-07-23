<?php

namespace app\plugins\diy\models;

use Yii;
use app\models\User;
use app\plugins\diy\models\DiyFormList;

/**
 * This is the model class for table "{{%diy_form}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $user_id
 * @property string $form_data
 * @property string $created_at
 * @property int $is_delete
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_old 是否为旧数据
 * @property int $form_list_id 自定义表单ID
 * @property string $order_no 订单号
 * @property int $is_pay 是否支付
 * @property string $pay_price 支付金额
 * @property string $pay_time 支付时间
 * @property string $extra_attributes 其它信息
 * @property string $form_list_name 自定义表单名称
 * @property string $reply 回复信息
 * @property string $reply_time 回复时间
 * @property User $user
 */
class DiyForm extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%diy_form}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'user_id', 'form_data', 'created_at', 'is_delete', 'updated_at', 'deleted_at'], 'required'],
            [['mall_id', 'user_id', 'is_delete', 'is_old', 'form_list_id', 'is_pay'], 'integer'],
            [['form_data', 'extra_attributes'], 'string'],
            [['created_at', 'updated_at', 'deleted_at', 'pay_time', 'reply_time'], 'safe'],
            [['pay_price'], 'number'],
            [['order_no', 'form_list_name', 'reply'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'form_data' => 'Form Data',
            'created_at' => 'Created At',
            'is_delete' => 'Is Delete',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'is_old' => '是否为旧数据',
            'form_list_id' => '自定义表单ID',
            'order_no' => '订单号',
            'is_pay' => '是否支付',
            'pay_price' => '支付金额',
            'pay_time' => '支付时间',
            'extra_attributes' => '其它信息',
            'form_list_name' => '自定义表单名称',
            'reply' => '回复信息',
            'reply_time' => '回复时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDiyFormList()
    {
        return $this->hasOne(DiyFormList::className(), ['id' => 'form_list_id']);
    }
}
