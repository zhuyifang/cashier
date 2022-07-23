<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/4/24
 * Time: 15:44
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\diy;


use app\models\Mall;
use app\models\Model;
use app\plugins\diy\models\DiyTemplate;

/**
 * Class CommonTemplate
 * @package app\plugins\diy\forms\common
 * @property Mall $mall
 */
class CommonTemplate extends Model
{
    public $mall;

    public static function getCommon($mall = null)
    {
        $instance = new self();
        if (!$mall) {
            $mall = \Yii::$app->mall;
        }
        $instance->mall = $mall;
        return $instance;
    }

    /**
     * @param $pagination
     * @param array $search
     * @return array|\yii\db\ActiveRecord[]
     * 获取模板列表
     */
    public function getList(&$pagination, $search = [])
    {
        $query = DiyTemplate::find()->where([
            'mall_id' => $this->mall->id,
            'is_delete' => 0,
        ]);
        isset($search['type']) && $query->andWhere(['type' => $search['type']]);
        isset($search['keyword']) && $query->keyword($search['keyword'], ['like', 'name', $search['keyword']]);

        return $query->page($pagination, 10)->orderBy(['created_at' => SORT_DESC])->all();
    }

    /**
     * @param $id
     * @return DiyTemplate|null
     */
    public function getTemplate($id)
    {
        return DiyTemplate::findOne([
            'mall_id' => $this->mall->id,
            'id' => $id
        ]);
    }

    /**
     * @param $id
     * @return DiyTemplate|null
     * @throws \Exception
     */
    public function destroy($id)
    {
        $template = $this->getTemplate($id);
        if (!$template) {
            throw new \Exception('模板不存在');
        }
        if ($template->is_delete == 1) {
            throw new \Exception('模板已删除');
        }
        $template->is_delete = 1;
        if (!$template->save()) {
            throw new \Exception($this->getErrorMsg($template));
        }
        return $template;
    }

    public function allComponents()
    {
        $pluginUrl = \app\helpers\PluginHelper::getPluginBaseAssetsUrl();
        $result = [
            [
                'groupName' => '基础组件',
                'list' => [
                    [
                        'id' => 'search',
                        'name' => '搜索',
                        'icon' => $pluginUrl . '/images/new-tpl/form_search_icon.png',
                    ],
                    [
                        'id' => 'nav',
                        'name' => '图文导航',
                        'icon' => $pluginUrl . '/images/new-tpl/form_nav_icon.png',
                    ],
                    [
                        'id' => 'banner',
                        'name' => '轮播广告',
                        'icon' => $pluginUrl . '/images/new-tpl/form_banner_icon.png',
                    ],
                    [
                        'id' => 'notice',
                        'name' => '公告',
                        'icon' => $pluginUrl . '/images/new-tpl/form_notice_icon.png',
                    ],
                    [
                        'id' => 'topic',
                        'name' => '专题',
                        'icon' => $pluginUrl . '/images/new-tpl/form_topic_icon.png',
                        'key' => 'topic'
                    ],
                    [
                        'id' => 'link',
                        'name' => '标题',
                        'icon' => $pluginUrl . '/images/new-tpl/form_title_icon.png',
                    ],
                    [
                        'id' => 'rubik',
                        'name' => '图片广告',
                        'icon' => $pluginUrl . '/images/new-tpl/form_rubik_icon.png',
                    ],
                    [
                        'id' => 'video',
                        'name' => '视频',
                        'icon' => $pluginUrl . '/images/new-tpl/form_video_icon.png',
                        'key' => 'video'
                    ],
                    [
                        'id' => 'goods',
                        'name' => '商品',
                        'icon' => $pluginUrl . '/images/new-tpl/form_goods_icon.png',
                    ],
                    [
                        'id' => 'store',
                        'name' => '门店',
                        'icon' => $pluginUrl . '/images/new-tpl/form_mch_icon.png',
                    ],
                    [
                        'id' => 'copyright',
                        'name' => '版权',
                        'icon' => $pluginUrl . '/images/new-tpl/form_copyright_icon.png',
                        'key' => 'copyright'
                    ],
                    [
                        'id' => 'check-in',
                        'name' => '签到',
                        'icon' => $pluginUrl . '/images/new-tpl/form_checkin_icon.png',
                        'key' => 'check_in'
                    ],
                    [
                        'id' => 'user-info',
                        'name' => '用户信息',
                        'icon' => $pluginUrl . '/images/new-tpl/form_userinfo_icon.png',
                    ],
                    [
                        'id' => 'user-order',
                        'name' => '订单入口',
                        'icon' => $pluginUrl . '/images/new-tpl/form_userorder_icon.png',
                    ],
                    [
                        'id' => 'map',
                        'name' => '地图',
                        'icon' => $pluginUrl . '/images/new-tpl/form_map_icon.png',
                    ],
                    [
                        'id' => 'mp-link',
                        'name' => '微信公众号',
                        'icon' => $pluginUrl . '/images/new-tpl/form_mplink_icon.png',
                        'single' => true,
                    ],
//                    [
//                        'id' => 'form',
//                        'name' => '自定义表单',
//                        'icon' => $pluginUrl . '/images/new-tpl/form_form_icon.png',
//                    ],
                    [
                        'id' => 'image-text',
                        'name' => '图文详情',
                        'icon' => $pluginUrl . '/images/new-tpl/form_imgtext_icon(1).png',
                    ]
                ]
            ],
            [
                'groupName' => '营销组件',
                'list' => [
                    [
                        'id' => 'coupon',
                        'name' => '优惠券',
                        'icon' => $pluginUrl . '/images/new-tpl/form_imgtext_icon.png',
                        'key' => 'coupon'
                    ],
                    [
                        'id' => 'timer',
                        'name' => '倒计时',
                        'icon' => $pluginUrl . '/images/new-tpl/form_time_icon.png',
                    ],
                    [
                        'id' => 'mch',
                        'name' => '好店推荐',
                        'icon' => $pluginUrl . '/images/new-tpl/form_shop_icon.png',
                        'key' => 'mch'
                    ],
                    [
                        'id' => 'pintuan',
                        'name' => '拼团',
                        'icon' => $pluginUrl . '/images/new-tpl/form_assemble_icon.png',
                        'key' => 'pintuan'
                    ],
                    [
                        'id' => 'booking',
                        'name' => '预约',
                        'icon' => $pluginUrl . '/images/new-tpl/form_appointment_icon.png',
                        'key' => 'booking'
                    ],
                    [
                        'id' => 'miaosha',
                        'name' => '秒杀',
                        'icon' => $pluginUrl . '/images/new-tpl/form_flashsale_icon.png',
                        'key' => 'miaosha'
                    ],
                    [
                        'id' => 'bargain',
                        'name' => '砍价',
                        'icon' => $pluginUrl . '/images/new-tpl/form_bargain_icon.png',
                        'key' => 'bargain'
                    ],
                    [
                        'id' => 'integral-mall',
                        'name' => '积分商城',
                        'icon' => $pluginUrl . '/images/new-tpl/form_integral_icon.png',
                        'key' => 'integral_mall'
                    ],
                    [
                        'id' => 'lottery',
                        'name' => '抽奖',
                        'icon' => $pluginUrl . '/images/new-tpl/form_lottery_icon.png',
                        'key' => 'lottery'
                    ],
                    [
                        'id' => 'advance',
                        'name' => '预售',
                        'icon' => $pluginUrl . '/images/new-tpl/form_advaance_icon.png',
                        'key' => 'advance'
                    ],
                    [
                        'id' => 'vip-card',
                        'name' => '超级会员卡',
                        'icon' => $pluginUrl . '/images/new-tpl/form_svip_icon.png',
                        'key' => 'vip_card'
                    ],
                    [
                        'id' => 'pick',
                        'name' => 'N元任选',
                        'icon' => $pluginUrl . '/images/new-tpl/form_pick_icon.png',
                        'key' => 'pick'
                    ],
                    [
                        'id' => 'live',
                        'name' => '微信直播',
                        'icon' => $pluginUrl . '/images/new-tpl/form_live_icon.png',
                        'key' => 'live',
                    ],
                    [
                        'id' => 'composition',
                        'name' => '套餐组合',
                        'icon' => $pluginUrl . '/images/new-tpl/form_combination_icon.png',
                        'key' => 'composition',
                    ],
                    [
                        'id' => 'gift',
                        'name' => '社交送礼',
                        'icon' => $pluginUrl . '/images/new-tpl/form_socialgifts_icon.png',
                        'key' => 'gift',
                    ],
                    [
                        'id' => 'flash-sale',
                        'name' => '限时抢购',
                        'icon' => $pluginUrl . '/images/live.png',
                        'key' => 'flash_sale'
                    ],
                    [
                        'id' => 'exchange',
                        'name' => '礼品卡',
                        'icon' => $pluginUrl . '/images/new-tpl/form_exchange_icon.png',
                        'key' => 'exchange',
                    ],
                    [
                        'id' => 'wholesale',
                        'name' => '商品批发',
                        'icon' => $pluginUrl . '/images/new-tpl/form_wholesale_icon.png',
                        'key' => 'wholesale',
                    ],
                    [
                        'id' => 'step',
                        'name' => '步数宝',
                        'icon' => $pluginUrl . '/images/new-tpl/form_step_icon.png',
                        'key' => 'step',
                    ],
                    [
                        'id' => 'weekly-buy',
                        'name' => '周期购',
                        'icon' => $pluginUrl . '/images/new-tpl/form_weekly_buy_icon.png',
                        'key' => 'weekly_buy',
                    ]
                ]
            ],
            [
                'groupName' => '其他组件',
                'list' => [
                    [
                        'id' => 'empty',
                        'name' => '空白块',
                        'icon' => $pluginUrl . '/images/new-tpl/form_empty_icon.png',
                    ],
                    [
                        'id' => 'ad',
                        'name' => '流量主广告',
                        'icon' => $pluginUrl . '/images/new-tpl/form_ad_icon.png',
                        'single' => true,
                    ],
                    [
                        'id' => 'modal',
                        'name' => '弹窗广告',
                        'icon' => $pluginUrl . '/images/new-tpl/form_Popupads_icon.png',
                        'single' => true,
                    ],
                    [
                        'id' => 'quick-nav',
                        'name' => '快捷导航',
                        'icon' => $pluginUrl . '/images/new-tpl/form_float_icon.png',
                        'single' => true,
                    ],
                    [
                        'id' => 'module',
                        'name' => '自定义模块',
                        'icon' => $pluginUrl . '/images/new-tpl/form_custom_icon.png',
                    ],
                    [
                        'id' => 'customer',
                        'name' => '自定义客服',
                        'icon' => $pluginUrl . '/images/new-tpl/form_customer.png',
                    ],
                    [
                        'id' => 'form-module',
                        'name' => '自定义表单',
                        'icon' => $pluginUrl . '/images/new-tpl/form_form_module_icon.png',
                        'single' => true,
                    ],
                ]
            ]
        ];
        return CheckComponent::check($result);
    }

    public function allFormComponents($removeList = ['form-goods-button'])
    {
        $host = PHP_SAPI != 'cli' ? \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" : '';

        $result = [
            [
                'groupName' => '基础组件',
                'list' => [
                    [
                        'id' => 'input',
                        'name' => '单行文本',
                        'icon' => $host . 'statics/img/mall/form/input_icon.png',
                    ],
                    [
                        'id' => 'text',
                        'name' => '多行文本',
                        'icon' => $host . 'statics/img/mall/form/text_icon.png',
                    ],
                    [
                        'id' => 'menu',
                        'name' => '下拉菜单',
                        'icon' => $host . 'statics/img/mall/form/menu_icon.png',
                    ],
                    [
                        'id' => 'switch',
                        'name' => '开关',
                        'icon' => $host . 'statics/img/mall/form/switch_icon.png',
                    ],
                    [
                        'id' => 'radio',
                        'name' => '单选框',
                        'icon' => $host . 'statics/img/mall/form/radio_icon.png',
                    ],
                    [
                        'id' => 'select',
                        'name' => '复选框',
                        'icon' => $host . 'statics/img/mall/form/select_icon.png',
                    ],
                    [
                        'id' => 'number-in',
                        'name' => '纯数字输入',
                        'icon' => $host . 'statics/img/mall/form/calc.png',
                    ],
                    [
                        'id' => 'phone',
                        'name' => '手机验证',
                        'icon' => $host . 'statics/img/mall/form/phone_icon.png',
                    ],
                    [
                        'id' => 'position',
                        'name' => '定位',
                        'icon' => $host . 'statics/img/mall/form/position_icon.png',
                    ],
                    [
                        'id' => 'uimage',
                        'name' => '上传图片',
                        'icon' => $host . 'statics/img/mall/form/uimage_icon.png',
                    ],
                    [
                        'id' => 'uvideo',
                        'name' => '上传视频',
                        'icon' => $host . 'statics/img/mall/form/uvideo_icon.png',
                    ],
                    [
                        'id' => 'calendar',
                        'name' => '日历',
                        'icon' => $host . 'statics/img/mall/form/calendar_icon.png',
                    ],
                    [
                        'id' => 'agreement',
                        'name' => '协议',
                        'icon' => $host . 'statics/img/mall/form/agreement_icon.png',
                    ],
                    [
                        'id' => 'calc',
                        'name' => '公式计算',
                        'icon' => $host . 'statics/img/mall/form/number-in.png',
                    ],
                ]
            ],
            [
                'groupName' => '唯一组件',
                'list' => [
                    [
                        'id' => 'button',
                        'name' => '提交按钮',
                        'icon' => $host . 'statics/img/mall/form/button_icon.png',
                        'single' => true,
                    ],
                    [
                        'id' => 'time',
                        'name' => '实时动态',
                        'icon' => $host . 'statics/img/mall/form/diy-form-time.png',
                        'single' => true,
                    ],
                    [
                        'id' => 'form-goods-button',
                        'name' => '提交按钮',
                        'icon' => $host . 'statics/img/mall/form/button_icon.png',
                        'single' => true,
                    ]
                ]
            ],
            [
                'groupName' => '其他组件',
                'list' => [
                    [
                        'id' => 'banner',
                        'name' => '轮播图片',
                        'icon' => $host . 'statics/img/mall/new-tpl/form_banner_icon.png',
                    ],
                    [
                        'id' => 'rubik',
                        'name' => '图片广告',
                        'icon' => $host . 'statics/img/mall/new-tpl/form_rubik_icon.png',
                    ],
                    [
                        'id' => 'link',
                        'name' => '标题',
                        'icon' => $host . 'statics/img/mall/new-tpl/form_title_icon.png',
                    ],
                    [
                        'id' => 'video',
                        'name' => '视频',
                        'icon' => $host . 'statics/img/mall/new-tpl/form_video_icon.png',
                        'key' => 'video'
                    ],
                    [
                        'id' => 'copyright',
                        'name' => '版权',
                        'icon' => $host . 'statics/img/mall/new-tpl/form_copyright_icon.png',
                        'key' => 'copyright'
                    ],
                    [
                        'id' => 'image-text',
                        'name' => '图文详情',
                        'icon' => $host . 'statics/img/mall/new-tpl/form_imgtext_icon(1).png',
                    ],
                    [
                        'id' => 'empty',
                        'name' => '空白块',
                        'icon' => $host . 'statics/img/mall/new-tpl/form_empty_icon.png',
                    ],
                ]
            ],
        ];

        foreach ($result as &$item) {
            foreach ($item['list'] as $lKey => $lItem) {
                if (in_array($lItem['id'], $removeList)) {
                    unset($item['list'][$lKey]);
                }
            }
            $item['list'] = array_values($item['list']);
        }
        return $result;
    }

    public function setDefault(array $formData)
    {
        $default = $this->getDefault();
        foreach ($formData as $dataKey => &$dataItem) {
            if (isset($default[$dataItem['id']])) {
                foreach ($default[$dataItem['id']] as $key => $value) {
                    // 追加新字段
                    if (!isset($dataItem['data'][$key])) {
                        $dataItem['data'][$key] = $value;
                    }
                }
            }

            if ($dataItem['id'] == 'button') {
                $newPriceList = $default['button']['pay_price_list'][0];
                $oldPriceList = $dataItem['data']['pay_price_list'];
                foreach ($newPriceList as $nKey => $nValue) {
                    foreach ($oldPriceList as $oKey => &$oValue) {
                        if (!isset($oValue[$nKey])) {
                            $oValue[$nKey] = $nValue;
                        }

                        // 添加默认值key
                        if (!$oValue['key']) {
                            $oValue['key'] = $this->msectime() . $dataKey;
                        }
                    }
                }
                $dataItem['data']['pay_price_list'] = $oldPriceList;
            }

            if ($dataItem['id'] == 'calendar') {
                if (!$dataItem['data']['key']) {
                    $dataItem['data']['key'] = $this->msectime() . $dataKey;
                }
            }

            if ($dataItem['id'] == '') {
                # code...
            }
        }

        return $formData;
    }

    private function msectime() 
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);

        return $msectime;
    }

    private function getDefault()
    {
        $diyBaseUrl = \app\helpers\PluginHelper::getPluginBaseAssetsUrl('diy') . '/images/form/';
        $permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
        $is_pond_show = array_search('pond', $permission) !== false;
        $is_scratch_show = array_search('scratch', $permission) !== false;

        $afterSendPlugin = '';
        if (array_search('pond', $permission) !== false) {
            $afterSendPlugin = 'pond';
        }
        if (array_search('scratch', $permission) !== false) {
            $afterSendPlugin = 'scratch';
        }

        $list = [
            'button' => [
                'title' => '支付收款',
                'is_pay' => 0,
                'pay_status' => 'alone',//much
                'pay_update' => 0,
                'pay_update_icon' => $diyBaseUrl . 'button-update.png',
                'pay_title' => '付款金额',
                'btn_title' => '提交',
                'pay_price' => 0.01,
                'stock_num' => 200,
                'has_limit_stock_num' => 0,
                'has_stock' => 1,
                'goods_unit' => '',
                'discount_type' => ['coupon', 'integral', 'vip-card'],
                'integral_max' => '',
                'integral_diejia' => 0,
                'is_level' => 0,
                'member_price' => [],
                'is_level_alone' => 0,
                //分销价
                'shareLevelList' => [],
                'individual_share' => 0,
                'attr_setting_type' => 0,
                'share_type' => 0,
                'pay_price_list' => [
                    [
                        'key' => '',
                        'title' => '标准版',
                        'pay_price' => 0,
                        'stock_num' => 200,
                        'member_price' => [],
                        'shareLevelList' => [],
                    ]
                ],
                'before_status' => 1,
                'before_text' => '是否确认提交',
                'after_trigger' => 'none',//event
                'after_send_status' => 0,
                'after_send_type' => [1, 2, 4, 8, 16, 32],
                'after_send_plugin' => $afterSendPlugin,
                'after_send_lottery_limit' => 1,
                'after_send_price' => 0.01,
                'after_send_integral' => 1,
                'after_send_member_id' => '',
                'after_send_member_name' => '',
                'after_send_coupon' => [],
                'after_send_card' => [],
                'after_jump_status' => 0,
                'after_jump_link' => null,
                'message_status' => 0,
                'm_subscribe' => 1,
                'm_subscribe_content' => '',
                'm_subscribe_link' => null,
                'm_sms' => 1,
                'm_sms_tempid' => '',
                'm_send_type' => 'submit',
                'm_send_date' => '',
                'btn_height' => 84,
                'btn_padding' => 24,
                'box_padding' => 24,
                'btn_radius' => 24,
                'btn_color' => '#FFFFFF',
                'btn_bg' => '#FF4544',
                'btn_border_color' => '#FF4544',
                'bg_color' => "#FFFFFF",
                'title_color' => '#545B60',
                'select_bg' => '#FF4544',
                'noselect_bg' => '#E5E7EC',
                'label_color' => '#242424',
                'has_calendar' => 0,
                'calendar_key' => '',
            ],
            'calendar' => [
                'is_required' => 0,
                'title' => '日历',
                'place_text' => '请选择',
                'list_style' => 1,
                'is_now' => 1,
                'start_at' => null,
                'end_at' => null,
                'is_alone' => 1,
                'is_day' => 0,
                'day_max' => 5,
                'place_unit' => '天',
                'end_title' => '请选择结束时间',
                'input_padding' => 24,
                'input_radius' => 24,
                'box_padding' => 24,
                'box_radius' => 24,
                'has_kuatian' => 0,
                'title_color' => '#545B60',
                'place_color' => '#BEC3C7',
                'in_color' => '#242424',
                'border_color' => '#E5E7EC',
                'padding_color' => '#F1F5F7',
                'active_color' => '#242424',
                'noactive_color' => '#C2C7CA',
                'select_color' => '#FF4544',
                'bg_color' => '#FFFFFF',
                'key' => ''
            ],
            'menu' => [
                'is_required' => 1,
                'title' => '',
                'place_text' => '请选择',
                'type' => 'basic',
                'type_data' => [
                    'basic' => [],
                    'date' => [
                        'is_now' => 0,
                        'start_at' => '',
                        'end_at' => '',
                        'is_alone' => 1,
                        'type' => 'date',
                    ],
                    'store' => [],
                    'address' => [],
                    'time' => [

                    ],
                ],
                'input_padding' => 24,
                'input_radius' => 24,
                'list_style' => 1,
                'border_color' => '#F1F5F7',
                'title_color' => '#545B60',
                'place_color' => '#BEC3C7',
                'in_color' => '#242424',
                'bg_color' => '#FFFFFF',
                'padding_color' => '#F1F5F7',
                'key' => time(),
            ]
        ];

        return $list;
    }
}
