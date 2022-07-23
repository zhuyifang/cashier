<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\navbar;


use app\core\response\ApiCode;
use app\forms\common\CommonAppConfig;
use app\forms\common\CommonOption;
use app\models\Model;
use app\models\Option;

class NavbarForm extends Model
{
    public function getDetail()
    {
        $mchId = \Yii::$app->user->identity->mch_id;
        if ($mchId) {
            $navbar = CommonOption::get(
                Option::NAME_NAVBAR,
                \Yii::$app->mall->id,
                Option::GROUP_APP,
                $this->getMchDefault($mchId),
                $mchId
            );
            if (gettype($navbar['shadow']) === 'string') {
                $navbar['shadow'] = json_decode($navbar['shadow']);
            }
        } else {
            $navbar = CommonAppConfig::getNavbar();
        }

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '请求成功',
            'data' => [
                'detail' => $navbar,
            ]
        ];
    }

    public function restoreDefault()
    {
        $mchId = \Yii::$app->user->identity->mch_id;
        if ($mchId) {
            $res = CommonOption::set(Option::NAME_NAVBAR, $this->getMchDefault($mchId), \Yii::$app->mall->id, Option::GROUP_APP, $mchId);
        } else {
            $res = CommonOption::set(Option::NAME_NAVBAR, $this->getDefault(), \Yii::$app->mall->id, Option::GROUP_APP);
        }

        if (!$res) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => '恢复失败',
            ];
        }

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '恢复成功',
        ];
    }

    public function getDefault()
    {
        $iconUrlPrefix = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl .
            '/statics/img/mall/navbar/';
        return [
            'bottom_background_color' => '#FFFFFF',
            'top_background_color' => '#FFFFFF',
            'top_text_color' => '#000000',
            'shadow' => true,
            'navs' => [
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'nav-icon-index.active.png',
                    'color' => '#888',
                    'text' => '首页',
                    'icon' => $iconUrlPrefix . 'nav-icon-index.png',
                    'url' => '/pages/index/index',
                    'open_type' => 'redirect',
                ],
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'nav-icon-cat.active.png',
                    'color' => '#888',
                    'text' => '分类',
                    'icon' => $iconUrlPrefix . 'nav-icon-cat.png',
                    'url' => '/pages/cats/cats',
                    'open_type' => 'redirect',
                ],
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'nav-icon-cart.active.png',
                    'color' => '#888',
                    'text' => '购物车',
                    'icon' => $iconUrlPrefix . 'nav-icon-cart.png',
                    'url' => '/pages/cart/cart',
                    'open_type' => 'redirect',
                ],
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'nav-icon-user.active.png',
                    'color' => '#888',
                    'text' => '我',
                    'icon' => $iconUrlPrefix . 'nav-icon-user.png',
                    'url' => '/pages/user-center/user-center',
                    'open_type' => 'redirect',
                ],
            ]
        ];
    }

    public function getMchDefault($mchId = 0)
    {
        $iconUrlPrefix = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl .
            '/statics/img/mall/mch/navbar/';
        return [
            'bottom_background_color' => '#FFFFFF',
            'shadow' => true,
            'navs' => [
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'index-active.png',
                    'color' => '#888',
                    'text' => '首页',
                    'icon' => $iconUrlPrefix . 'index.png',
                    'url' => '/plugins/mch/shop/shop',
                    'open_type' => 'redirect',
                ],
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'goods-active.png',
                    'color' => '#888',
                    'text' => '全部商品',
                    'icon' => $iconUrlPrefix . 'goods.png',
                    'url' => '/pages/goods/list',
                    'is_show' => 1,
                    'open_type' => 'redirect',
                ],
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'weitao-active.png',
                    'color' => '#888',
                    'text' => '店铺微淘',
                    'icon' => $iconUrlPrefix . 'weitao.png',
                    'url' => '/plugins/mch/shop/weitao',
                    'is_show' => 1,
                    'open_type' => 'redirect',
                ],
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'cat-active.png',
                    'color' => '#888',
                    'text' => '分类',
                    'icon' => $iconUrlPrefix . 'cat.png',
                    'url' => '/plugins/mch/cat/cat',
                    'is_show' => 1,
                    'open_type' => 'redirect',
                ],
                [
                    'active_color' => '#ff4544',
                    'active_icon' => $iconUrlPrefix . 'info-active.png',
                    'color' => '#888',
                    'text' => '店铺印象',
                    'icon' => $iconUrlPrefix . 'info.png',
                    'url' => '/plugins/mch/shop/summary',
                    'is_show' => 1,
                    'open_type' => 'redirect',
                ],
            ]
        ];
    }
}
