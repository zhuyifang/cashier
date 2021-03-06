<?php

namespace app\plugins\stock\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "{{%stock_cash}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $user_id
 * @property string $order_no 订单号
 * @property string $price 提现金额
 * @property string $service_charge 提现手续费（%）
 * @property string $type 提现方式 auto--自动打款 wechat--微信打款 alipay--支付宝打款 bank--银行转账 balance--打款到余额
 * @property string $extra 额外信息 例如微信账号、支付宝账号等
 * @property int $status 提现状态 0--申请 1--同意 2--已打款 3--驳回
 * @property int $is_delete
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $content
 * @property int $use_qrcode 是否使用收款码0--不使用 1--使用
 * @property StockUser stock
 * @property StockUserInfo stockUser
 * @property User user
 */
class StockCash extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stock_cash}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'], 'required'],
            [['mall_id', 'user_id', 'status', 'is_delete', 'use_qrcode'], 'integer'],
            [['price', 'service_charge'], 'number'],
            [['extra', 'content'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['order_no', 'type'], 'string', 'max' => 255],
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
            'order_no' => '订单号',
            'price' => '提现金额',
            'service_charge' => '提现手续费（%）',
            'type' => '提现方式 auto--自动打款 wechat--微信打款 alipay--支付宝打款 bank--银行转账 balance--打款到余额',
            'extra' => '额外信息 例如微信账号、支付宝账号等',
            'status' => '提现状态 0--申请 1--同意 2--已打款 3--驳回',
            'is_delete' => 'Is Delete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'content' => 'Content',
            'use_qrcode' => '是否使用收款码0--不使用 1--使用',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStock()
    {
        return $this->hasOne(StockUser::className(), ['user_id' => 'user_id']);
    }

    public function getStockUser()
    {
        return $this->hasOne(StockUserInfo::className(), ['user_id' => 'user_id']);
    }

    public function getStatusText($status)
    {
        $text = ['待审核', '待打款', '已打款', '已驳回'];
        return isset($text[$status]) ? $text[$status] : '未知状态' . $status;
    }

    public function getTypeText($type)
    {
        $typeList = [
            'auto' => '自动打款',
            'wechat' => '微信打款',
            'alipay' => '支付宝打款',
            'bank' => '银行转账',
            'balance' => '打款到余额'
        ];
        return isset($typeList[$type]) ? $typeList[$type] : '未知类型：' . $type;
    }

    public function getTypeText2($type)
    {
        $typeList = [
            'auto' => '自动打款',
            'wechat' => '微信钱包',
            'alipay' => '支付宝',
            'bank' => '银行卡',
            'balance' => '余额'
        ];
        return isset($typeList[$type]) ? $typeList[$type] : '未知类型：' . $type;
    }
}
