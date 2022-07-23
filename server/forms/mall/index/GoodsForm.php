<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2020/12/18
 * Time: 3:36 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\mall\index;

use app\core\response\ApiCode;
use app\models\Mall;
use app\models\MallSetting;
use app\models\Model;

class GoodsForm extends Model
{
    public $show_contact_type;
    public $show_goods_auth;
    public $buy_goods_auth;
    public $is_remind_sell_time;
    public $negotiable_text;
    public $buy_goods_auth_text;
    public $buy_goods_auth_link;
    public $new_customer;
    public $new_good_negotiable;
    public $contact_type;
    public $contact_customer;

    public function rules()
    {
        return [
            [['show_contact_type', 'is_remind_sell_time'], 'integer'],
            [['show_goods_auth', 'buy_goods_auth', 'negotiable_text', 'buy_goods_auth_text', 'buy_goods_auth_link', 'contact_type'], 'trim'],
            [['show_goods_auth', 'buy_goods_auth', 'negotiable_text', 'buy_goods_auth_text', 'contact_type'], 'string'],
            [['is_remind_sell_time'], 'default', 'value' => 0],
            [['negotiable_text'], 'string', 'max' => 4],
            [['new_good_negotiable', 'buy_goods_auth_link', 'new_customer', 'contact_customer'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'show_contact_type' => '商品详情底部客服导航',
            'new_good_negotiable' => '商品面议联系方式',
            'show_goods_auth' => '会员等级浏览权限',
            'buy_goods_auth' => '会员等级购买权限',
            'is_remind_sell_time' => '是否开启开售时间',
            'negotiable_text' => '商品价格面议文案',
            'buy_goods_auth_text' => '无权限购买文案',
            'buy_goods_auth_link' => '无权限购买跳转路径',
            'new_customer' => '选择客服',
            'contact_type' => '选择客服',
            'contact_customer' => '在线客服',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($this->attributes as $k => $item) {
                if ($k == 'new_good_negotiable' && empty($item)) {
                    $item = ['contact'];
                }

                if (in_array($k, ['new_good_negotiable', 'buy_goods_auth_link', 'new_customer', 'contact_customer'])) {
                    $newItem = json_encode($item, true);
                } else {
                    $newItem = $item;
                }

                $mallSetting = MallSetting::findOne(['key' => $k, 'mall_id' => \Yii::$app->mall->id]);
                if ($mallSetting) {
                    $mallSetting->value = (string)$newItem;
                    $res = $mallSetting->save();
                } else {
                    $mallSetting = new MallSetting();
                    $mallSetting->key = $k;
                    $mallSetting->value = (string)$newItem;
                    $mallSetting->mall_id = \Yii::$app->mall->id;
                    $res = $mallSetting->save();
                }

                if (!$res) {
                    throw new \Exception($this->getErrorMsg($mallSetting));
                }
            }
            $transaction->commit();
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功。',
            ];
        } catch (\Exception $exception) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'error' => $exception
            ];
        }
    }

    public function getDetail()
    {
        $mall = new Mall();
        $setting = $mall->getMallSetting(array_keys($this->attributeLabels()));
        return [
            'code' => 0,
            'data' => [
                'detail' => $setting,
                'is_qy' => in_array('customer_service', \Yii::$app->mall->role->permission)
            ]
        ];
    }
}
