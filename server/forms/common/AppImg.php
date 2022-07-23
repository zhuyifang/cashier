<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/27
 * Time: 9:40
 */

namespace app\forms\common;


class AppImg
{
    public static function search()
    {
        $url = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/statics/img/app';
        return [
            'common' => [
                'address_bottom' => $url . '/common/address-bottom.png',
                'payment_alipay' => $url . '/common/payment-alipay.png',
                'payment_balance' => $url . '/common/payment-balance.png',
                'payment_huodao' => $url . '/common/payment-huodao.png',
                'payment_wechat' => $url . '/common/payment-wechat.png'
            ],
            'mall' => [
                'close' => $url . '/mall/icon-close.png',
                'order' => [
                    'status_bar' => $url . '/mall/order/status-bar.png'
                ],
                'balance' => $url . '/mall/icon-balance.png',
                'huodao' => $url . '/mall/icon-huodao.png',
                'online' => $url . '/mall/icon-online.png',
                'coupon_enable_bg' => $url . '/mall/img-coupon-enable-bg.png',
                'coupon_disable_bg' => $url . '/mall/img-coupon-disable-bg.png',
                'order_pay_success' => $url . '/mall/img-order-pay-success.png',
                'order_pay_result_coupon' => $url . '/mall/img-order-pay-result-coupon.png',
                'icon_wechat' => $url . '/mall/icon-wechatapp.png',
                'icon_alipay' => $url . '/mall/icon-alipay.png',
                'icon_ttapp' => $url . '/mall/icon-ttapp.png',
                'disabled' => $url . '/mall/img-disabled.png',
                'binding' => $url . '/mall/binding_pic.png',
                'list_out' => $url . '/mall/list-out.png',
                'book_out' => $url . '/mall/book-out.png',
                'rate_out' => $url . '/mall/rate-out.png',
                'one_out' => $url . '/mall/one-out.png',
                'plugins_out' => $url . '/mall/plugins-out.png',
                'balance_recharge' => $url . '/mall/icon-balance-recharge-bg.png',
                'balance_recharge_search' => $url . '/mall/icon-balance-recharge-search.png',
                'loading' => $url . '/mall/loading.gif',
                'advance' => $url . '/mall/advance.png',
                'flash_sale' => $url . '/mall/flash_sale.png',
                'pick' => $url . '/mall/pick.png',
                'icon_home_booking' => $url . '/mall/icon-home-booking.png',
                'icon_home_miaosha' => $url . '/mall/icon-home-miaosha.png',
                'icon_home_pintuan' => $url . '/mall/icon-home-pintuan.png',
                'icon_home_miaosha' => $url . '/mall/icon-home-miaosha.png',
                'icon_home_advance' => $url . '/mall/icon-home-advance.png',
                'icon_home_flash_sales' => $url . '/mall/icon-home-flash-sales.png',
                'icon_home_pick' => $url . '/mall/icon-home-pick.png',
                'icon_home_wholesale' => $url . '/mall/icon-home-wholesale.png',
                'icon_home_weekly' => $url . '/mall/icon-home-weekly.png',
                'score_1' => $url . '/mall/score-1.png',
                'score_2' => $url . '/mall/score-2.png',
                'score_3' => $url . '/mall/score-3.png',
                'score_1_active' => $url . '/mall/score-1-active.png',
                'score_2_active' => $url . '/mall/score-2-active.png',
                'score_3_active' => $url . '/mall/score-3-active.png',
                'head_nav_bar_mall' => $url . '/mall/head-nav-bar-mall.png',
                'head_nav_bar_search' => $url . '/mall/head-nav-bar-ssss.png',
                'style_two_end_shadow' => $url . '/mall/style-two-end-shadow.png',
                'icon_member' => $url . '/balance/icon-member.png',
                'icon_integral' => $url . '/balance/icon-integral.png',
                'icon_balance' => $url . '/balance/icon-balance.png',
                'icon_lottery' => $url . '/balance/icon-lottery-2.png',
                'icon_timer_bg' => $url . '/mall/icon-timer-bg.png',
                'flash_sale_gif' => $url . '/mall/flash-sale.gif',
                'video_number' => $url . '/mall/video-number.png',
            ],
            'share' => [
                'apply' => $url . '/share/img-share-apply.png',
                'status' => $url . '/share/img-share-status.png',
                'poster_load' => $url . '/share/loading.gif',
                'sharebg' => $url . '/share/sharebg.png',
                'level_btn' => $url . '/share/level-btn.png',
                'dialog_success' => $url . '/share/dialog-success.png',
                'dialog_error' => $url . '/share/dialog-error.png',
                'no_level_bg' => $url . '/share/no-level-bg.png',
            ],
            'user_center' => [
                'arrow' => $url . '/user-center/arrow.png',
                'white_arrow' => $url . '/user-center/white-arrow.png',
            ],
            'foot' => [
                'total_bg' => $url . '/footprint/total.png',
                'buy_bg' => $url . '/footprint/buy.png',
                'coupon_bg' => $url . '/footprint/coupon.png',
                'day_bg' => $url . '/footprint/day.png',
                'high_bg' => $url . '/footprint/high.png',
                'member_bg' => $url . '/footprint/member.png',
                'open_bg' => $url . '/footprint/open.png',
                'total' => $url . '/footprint/total.gif',
                'buy' => $url . '/footprint/buy.gif',
                'coupon_icon' => $url . '/footprint/coupon-icon.png',
                'index' => $url . '/footprint/index.png',
                'member_icon' => $url . '/footprint/member-icon.png',
                'rate_icon' => $url . '/footprint/rate-icon.png',
                'day_icon' => $url . '/footprint/day-icon.png',
                'high_icon' => $url . '/footprint/high-icon.png',
                'hycyj' => $url . '/footprint/hycyj.ttf',
            ],
            'coupon' => [
                'get_coupon_bg' => $url . '/coupon/img-get-coupon-bg.png',
                'get_coupon_item_bg' => $url . '/coupon/img-get-coupon-item-bg.png',
                'get_coupon_title' => $url . '/coupon/img-get-coupon-title.png',
                'get_coupon_share' => $url . '/coupon/img-get-coupon-share.png',
                'get_coupon_receive' => $url . '/coupon/img-get-coupon-receive.png',
                'get_coupon_award' => $url . '/coupon/img-get-coupon-award.png',
                'coupon_disabled' => $url . '/coupon/icon-coupon-disabled.png',
                'coupon_enabled' => $url . '/coupon/icon-coupon-enabled.png',
                'discount_coupon' => $url . '/coupon/discount-coupon.png',
                'discount_receive' => $url . '/coupon/discount-receive.png',
                'img_coupon_2' => $url . '/coupon/img_coupon_2.png',
            ],
            'member' => [
                'bg' => $url . '/member/BG.png',
                'card' => $url . '/member/card-1.png',
                'coupon' => $url . '/member/coupon.png',
                'goods' => $url . '/member/goods.png',
                'coupon_index' => $url . '/member/icon-coupon-index.png',
                'coupon_received' => $url . '/member/icon-coupon-received.png',
                'more' => $url . '/member/more.png',
                'up' => $url . '/member/up.png',
                'banner' => $url . '/member/banner.png',
                'card_bottom' => $url . '/member/card-bottom.png',
                'icon_user_level' => $url . '/member/icon-user-level.png',
                'member_left' => $url . '/member/member-left.png',
                'member_right' => $url . '/member/member-right.png',
                'one' => $url . '/member/one.png',
                'two' => $url . '/member/two.png',
            ],
            'bonus' => [
                'banner' => $url . '/bonus/banner.png',
                'right' => $url . '/bonus/right.png',
                'wait' => $url . '/bonus/wait.png',
                'progress' => $url . '/bonus/progress.png',
                'member' => $url . '/bonus/member.png',
                'order' => $url . '/bonus/order.png',
                'success' => $url . '/bonus/success.png',
            ],
            'app_admin' => [
                'bg' => $url . '/app_admin/bg.png',
                'line' => $url . '/app_admin/line.png',
                'cash' => $url . '/app_admin/cash.png',
                'comment' => $url . '/app_admin/comment.png',
                'msg' => $url . '/app_admin/msg.png',
                'user' => $url . '/app_admin/user.png',
                'order' => $url . '/app_admin/order.png',
                'detail_bg' => $url . '/app_admin/detail-bg.png',
                'no_order' => $url . '/app_admin/no-order.png',
                'no_comment' => $url . '/app_admin/no-comment.png',
                'no_goods' => $url . '/app_admin/no-goods.png',
                'no_apply' => $url . '/app_admin/no-apply.png',
                'no_message' => $url . '/app_admin/no-message.png',
                'no_user' => $url . '/app_admin/no-user.png'
            ],
            'clerk' => [
                'detail' => $url . '/clerk/detail.png',
                'qr' => $url . '/clerk/qr.png',
                'un_qr' => $url . '/clerk/un-qr.png',
                'order' => $url . '/clerk/order.png',
                'card' => $url . '/clerk/card.png',
                'scan_code_pay' => $url . '/clerk/scan_code_pay.png',
                'clerk' => $url . '/clerk/clerk.png',
                'edit' => $url . '/clerk/edit.png',
            ],
            'mch' => [
                'detail_bg' => $url . '/mch/detail-bg.png',
                'no_order' => $url . '/mch/no-order.png',
                'no_comment' => $url . '/mch/no-comment.png',
                'no_goods' => $url . '/mch/no-goods.png',
                'no_apply' => $url . '/mch/no-apply.png',
                'no_message' => $url . '/mch/no-message.png',
                'no_user' => $url . '/mch/no-user.png'
            ],
            'vip_card' => [
                'logo' => $url . '/vip_card/logo.png',
                'icon1' => $url . '/vip_card/icon1.png',
                'icon2' => $url . '/vip_card/icon2.png',
                'icon3' => $url . '/vip_card/icon3.png',
                'icon4' => $url . '/vip_card/icon4.png',
                'icon5' => $url . '/vip_card/icon5.png',
                'icon6' => $url . '/vip_card/icon6.png',
                'icon7' => $url . '/vip_card/icon7.png',
                'balance' => $url . '/vip_card/balance.png',
                'card' => $url . '/vip_card/card.png',
                'coupon' => $url . '/vip_card/coupon.png',
                'integral' => $url . '/vip_card/integral.png',
                'left' => $url . '/vip_card/left.png',
                'right' => $url . '/vip_card/right.png',
                'shipping' => $url . '/vip_card/free-shipping.png',
                'off' => $url . '/vip_card/off.png',
                'card_bottom' => $url . '/vip_card/card-bottom.png',
                'buy_bg' => $url . '/vip_card/buy_bg.png',
                'default_card' => $url . '/vip_card/default-card.png',
                'image_share' => $url . '/vip_card/image_share.jpg',
            ],
            'diy' => [
                'line' => $url . '/diy/line-style.png',
                'star' => $url . '/diy/star-style.png',
                'star_right' => $url . '/diy/star-style-right.png',
                'div' => $url . '/diy/div-style.png',
                'radius' => $url . '/diy/radius-style.png',
                'access_limit' => $url . '/diy/access-limit.png',
                'advance' => $url . '/diy/advance.png',
                'advance_end' => $url . '/diy/advance.png',
                'bargain' => $url . '/diy/bargain.png',
                'bargain_end' => $url . '/diy/bargain-end.png',
                'flash_sale' => $url . '/diy/flash-sale.png',
                'flash_sale_end' => $url . '/diy/flash-sale-end.png',
                'lottery' => $url . '/diy/lottery.png',
                'lottery_end' => $url . '/diy/lottery-end.png',
                'miaosha' => $url . '/diy/miaosha.png',
                'miaosha_end' => $url . '/diy/miaosha-end.png',
                'fire' => $url . '/diy/fire.png',
                'small_end' => $url . '/diy/small-end.png',
                'middle_end' => $url . '/diy/middle-end.png',
                'big_end' => $url . '/diy/big-end.png',
                'announcement' =>  $url . '/diy/announcement.png',
            ],
            'stock' => [
                'index' => $url . '/stock/index.png',
                'success' => $url . '/stock/success.png',
                'bonus' => $url . '/stock/bonus.png',
                'banner' => $url . '/stock/banner.png',
                'foot' => $url . '/stock/foot.png',
                'get' => $url . '/stock/get.png',
                'max' => $url . '/stock/max.png',
                'update' => $url . '/stock/update.png',
                'stock' => $url . '/stock/stock.png',
                'cash' => $url . '/stock/cash.png',
                'detail' => $url . '/stock/detail.png',
            ],
            'region' => [
                'index' => $url . '/region/index.png',
                'bonus' => $url . '/region/bonus.png',
                'cash' => $url . '/region/cash.png',
                'detail' => $url . '/region/detail.png',
                'banner' => $url . '/region/banner.png',
                'stock' => $url . '/region/stock.png',
                'get' => $url . '/region/get.png'
            ],
            'composition' => [
                'banner' => $url . '/composition/banner.png',
            ],
            'order_submit' => [
                'coupon_bg' => $url . '/order_submit/coupon_bg.png',
                'coupon_bg_disable' => $url . '/order_submit/coupon_bg_disable.png',
                'svip_bg' => $url . '/order_submit/svip_bg.png',
            ],
            'poster' => [
                'bg_time' => $url . '/poster/bg_time.png',
                'card_bg' => $url . '/poster/card_bg.png',
                'card_bg_time' => $url . '/poster/card_bg_time.png',
                'coupon_bg' => $url . '/poster/coupon_bg.png',
                'img_card' => $url . '/poster/img_card.png',
                'img_coupon' => $url . '/poster/img_coupon.png',
                'pic_one' => $url . '/poster/pic-one.png',
                'pic_two' => $url . '/poster/pic-two.png',
                'pic_three' => $url . '/poster/pic-three.png',
                'pic_four' => $url . '/poster/pic-four.png',
                'pic_five' => $url . '/poster/pic-five.png',
            ],
            'card' => [
                'img_card_2' => $url . '/card/img_card_2.png',
                'img_seal' => $url . '/card/img_seal.png',
            ],
            'community' => [
                'index' => $url . '/community/index.png',
                'log' => $url . '/community/log.png',
                'bg' => $url . '/community/bg.png',
                'apply' => $url . '/community/apply.png',
                'style1' => $url . '/community/style1.png',
                'style2' => $url . '/community/style2.png',
                'style3' => $url . '/community/style3.png',
                'style4' => $url . '/community/style4.png',
            ],
            'exchange' => [
                'bg' => $url . '/exchange/bg.png',
            ],
            'lottery' => [
                'bg' => $url . '/lottery/integral-bg.png',
            ],
            'sph' => [
                'loading' => $url . '/sph/loading.gif'
            ],
            'goods' => [
                'limit_buy' => $url . '/bd-info/limit-buy.png',
                'min_number' => $url . '/bd-info/min-number.png',
                'cart' => $url . '/goods/cart.png',
                'add' => $url . '/goods/add.png',
            ],
            'cats' => [
                'cats' => $url . '/cats/cats.png',
                'expand' => $url . '/cats/expand.png',
                'ollapse' => $url . '/cats/ollapse.png',
            ],
        ];
    }
}
