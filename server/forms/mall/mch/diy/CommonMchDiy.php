<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\mch\diy;


use app\forms\common\diy\CheckComponent;

class CommonMchDiy
{
    public function getZsMenus()
    {
        $baseUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl;
        $result = [
            [
                'groupName' => '基础组件',
                'list' => [
                    [
                        'id' => 'search',
                        'name' => '搜索',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_search_icon.png',
                    ],
                    [
                        'id' => 'nav',
                        'name' => '图文导航',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_nav_icon.png',
                    ],
                    [
                        'id' => 'banner',
                        'name' => '轮播广告',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_banner_icon.png',
                    ],
                    [
                        'id' => 'notice',
                        'name' => '公告',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_notice_icon.png',
                    ],
                    [
                        'id' => 'image-text',
                        'name' => '图文详情',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_imgtext_icon(1).png',
                    ],
                    [
                        'id' => 'link',
                        'name' => '标题',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_title_icon.png',
                    ],
                    [
                        'id' => 'rubik',
                        'name' => '图片广告',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_rubik_icon.png',
                    ],
                    [
                        'id' => 'video',
                        'name' => '视频',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_video_icon.png',
                        'key' => 'video'
                    ],
                    [
                        'id' => 'goods',
                        'name' => '商品',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_goods_icon.png',
                    ]
                ]
            ],
            [
                'groupName' => '其他组件',
                'list' => [
                    [
                        'id' => 'empty',
                        'name' => '空白块',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_empty_icon.png',
                    ],
                    [
                        'id' => 'customer',
                        'name' => '自定义客服',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/form_customer.png',
                    ],
                    [
                        'id' => 'mch-home',
                        'name' => '店铺信息',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/store.png',
                        'single' => true
                    ],
                    [
                        'id' => 'mch-share',
                        'name' => '分享浮窗',
                        'icon' => $baseUrl . '/statics/img/mall/mch/zs/share.png',
                        'single' => true
                    ],
                ]
            ]
        ];
        return CheckComponent::check($result);
    }

    public function getDefault()
    {
        $baseUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl;
        $baseUrl = str_replace('http://', 'https://', $baseUrl);

        $default = [
            "home" => [
                [
                    "id" => "mch-home",
                    "permission_key" => "",
                    "data" => [
                        "bg_color" => "#ffffff",
                        "has_bg" => 1,
                        "bg_type" => "pure",
                        "title_color" => "#333333",
                        "title_size" => 40,
                        "place_color" => "#999999",
                        "place_size" => 28,
                        "logo_size" => 128,
                        "box_access_style" => "around",
                        "box_placed_style" => 1,
                        "box_radius" => 40,
                        "basic_top" => 24,
                        "basic_left" => 24,
                        "basic_center" => 24,
                        "gk_color" => "#999999",
                        "gk_top" => 270,
                        "gk_left" => 526,
                        "gk_cen" => 10,
                        "gk_margin" => 10,
                        "nolove_pic" => $baseUrl . "/statics/img/mall/mch/home-nolove_pic-y.png",
                        "love_pic" => $baseUrl . "/statics/img/mall/mch/home-love_pic-y.png",
                        "tel_pic" => $baseUrl . "/statics/img/mall/mch/home-tel_pic-y.png",
                        "has_goods_num" => 1,
                        "has_shop_num" => 1,
                        "has_assess_num" => 1,
                        "service_type" => 2
                    ]
                ],
                [
                    "id" => "goods",
                    "permission_key" => "",
                    "data" => [
                        "showCat" => true,
                        "catPosition" => "top",
                        "catStyle" => 1,
                        "catList" => [],
                        "list" => [],
                        "addGoodsType" => 0,
                        "goodsLength" => 10,
                        "listStyle" => 2,
                        "goodsCoverProportion" => "1-1",
                        "fill" => 1,
                        "goodsStyle" => 1,
                        "textStyle" => 1,
                        "showGoodsName" => true,
                        "showGoodsPrice" => true,
                        "showBuyBtn" => true,
                        "buyBtn" => "cart",
                        "buyBtnStyle" => 1,
                        "buyBtnText" => "购买",
                        "buttonColor" => "#ff4544",
                        "showGoodsTag" => false,
                        "customizeGoodsTag" => false,
                        "goodsTagPicUrl" => $baseUrl . "/statics/img/mall/goods//images/goods-tag-rx.png",
                        "showImg" => false,
                        "backgroundColor" => "#fff",
                        "backgroundPicUrl" => "",
                        "position" => 5,
                        "mode" => 1,
                        "backgroundHeight" => 100,
                        "backgroundWidth" => 100,
                        "isUnderLinePrice" => true,
                        "tagColor" => "#FF4040",
                        "catSelectedColor" => "#ff4040",
                        "catUnselectedColor" => "#353535",
                        "catBgColor" => "#FFFFFF",
                        "c_padding_top" => 0,
                        "c_padding_lr" => 24,
                        "c_padding_bottom" => 24,
                        "c_border_top" => 16,
                        "c_border_bottom" => 16,
                        "bg" => "#FFFFFF"
                    ]
                ],
                [
                    "id" => "mch-share",
                    "permission_key" => "",
                    "data" => [
                        "is_open" => 1,
                        "share_btn_pic" => $baseUrl . "/statics/img/mall/mch/share_btn_pic-1.png",
                        "share_bottom" => 70,
                        "share_right" => 0,
                        "is_float" => 1
                    ]
                ]
            ],
            "remake" => [
                "basic_style" => 1,
                "bg_color" => "#ff4544",
                "has_bg" => 1,
                "bg_pic" => "",
                "card_top" => 150,
                "card_left_right" => 24,
                "card_padding" => 24,
                "card_radius" => 16,
                "bg_style" => "top",
                "shop_title_color" => "#333333",
                "shop_logo_font" => 40,
                "shop_logo_size" => 150,
                "shop_logo_radius" => 100,
                "info_title_color" => "#333333",
                "info_title_font" => 28,
                "info_content_color" => "#999999",
                "info_content_font" => 28,
                "has_shop_phone" => 1,
                "has_contact_customer" => 0,
                "customer_top" => 20,
                "customer_left_right" => 24,
                "customer_height" => 80,
                "is_customer_wechat" => 0,
                "customer_wechat_place" => "复制微信号",
                "is_customer_phone" => 0,
                "customer_phone_place" => "拨打电话",
                "is_web_service" => 0,
                "web_server_place" => "客服外链"
            ]
        ];

        return $default;
    }
}
