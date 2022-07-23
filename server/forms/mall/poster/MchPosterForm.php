<?php

namespace app\forms\mall\poster;

use app\core\response\ApiCode;
use app\forms\common\CommonOption;
use app\forms\mall\theme_color\ThemeColorForm;
use app\models\Model;
use app\models\Option;

class MchPosterForm extends Model
{
    public $data;

    public function get()
    {
        $res = CommonOption::get(Option::NAME_MCH_POSTER, \Yii::$app->mall->id, Option::GROUP_APP, $this->defaultConfig(), \Yii::$app->getMchId());
        //THEME
        $list = (new ThemeColorForm())->getThemeData();
        $list = array_filter($list, function ($item) {
            return $item['is_select'];
        });
        if (!empty($list)) {
            $themeColor = array_shift($list)['color']['main'];
        }
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => [
                'config' => $res,
                'themeColor' => $themeColor ?? '',
            ]
        ];
    }

    public function save()
    {
        try {
            $json = \yii\helpers\BaseJson::decode($this->data);
            $mch_id = \Yii::$app->getMchId();
            if (empty($mch_id)) die('商户未登录');
            CommonOption::set(Option::NAME_MCH_POSTER, $json, \Yii::$app->mall->id, Option::GROUP_APP, $mch_id);
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
            ];
        }
    }

    public function defaultConfig()
    {
        return [
            'btn_title' => '保存店铺名片',
            'card_pic' => ['DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/mch/poster/welcome.png'],
            'bg_default' => 'image',
            'bg_color' => '#FFFFFF',
            'code_size' => 128,
            'code_title' => '扫一扫，查看店铺',
            'code_sub_title' => '和我一起查看店铺优质商品吧！',
            'is_card' => 1,
            'code_title_padding' => 12,
            'logo_show' => 1,
            'shop_name_show' => 1,
            'code_pos' => 'left',
            'shop_info_top' => 548,
            'is_shop' => 1,
            'btn_bg' => '#FF4544',
            'btn_theme' => 1,
        ];
    }
}