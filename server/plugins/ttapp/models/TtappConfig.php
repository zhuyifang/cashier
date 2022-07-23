<?php

namespace app\plugins\ttapp\models;

use Yii;

/**
 * This is the model class for table "{{%ttapp_config}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property string $mch_id 商户号
 * @property string $app_key
 * @property string $app_secret
 * @property string $pay_app_secret
 * @property string $pay_app_id
 * @property string $alipay_app_id
 * @property string $alipay_public_key
 * @property string $alipay_private_key
 * @property string $created_at
 * @property string $updated_at
 * @property string $salt salt
 * @property string $token 回调token
 */
class TtappConfig extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ttapp_config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id'], 'required'],
            [['mall_id'], 'integer'],
            [['alipay_public_key', 'alipay_private_key'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['mch_id', 'app_key', 'app_secret', 'pay_app_id'], 'string', 'max' => 64],
            [['pay_app_secret', 'alipay_app_id'], 'string', 'max' => 128],
            [['salt', 'token'], 'string', 'max' => 255],
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
            'mch_id' => '商户号',
            'app_key' => 'App Key',
            'app_secret' => 'App Secret',
            'pay_app_secret' => 'Pay App Secret',
            'pay_app_id' => 'Pay App ID',
            'alipay_app_id' => 'Alipay App ID',
            'alipay_public_key' => 'Alipay Public Key',
            'alipay_private_key' => 'Alipay Private Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'salt' => 'salt',
            'token' => '回调token',
        ];
    }
}
