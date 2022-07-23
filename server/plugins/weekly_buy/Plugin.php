<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/10/30 14:42
 */


namespace app\plugins\weekly_buy;

use app\forms\mall\statistics\DataForm;
use app\forms\OrderConfig;
use app\handlers\HandlerBase;
use app\helpers\PluginHelper;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\api\ListForm;
use app\plugins\weekly_buy\forms\common\CommonOrderClerk;
use app\plugins\weekly_buy\forms\common\CommonSetting;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\common\statistics\TableSearch;
use app\plugins\weekly_buy\forms\mall\SendOrderForm;
use app\plugins\weekly_buy\forms\mall\StatisticsForm;
use app\plugins\weekly_buy\handlers\HandlerRegister;
use app\plugins\weekly_buy\handlers\OrderCanceledHandler;
use app\plugins\weekly_buy\handlers\OrderPayedHandler;
use app\plugins\weekly_buy\handlers\OrderSaledHandlerClass;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;

class Plugin extends \app\plugins\Plugin
{
    public function getMenus()
    {
        return [
            [
                'name' => '设置',
                'route' => 'plugin/weekly_buy/mall/index',
                'icon' => 'el-icon-star-on',
            ],
            [
                'name' => '周期购活动',
                'route' => 'plugin/weekly_buy/mall/activity/index',
                'icon' => 'el-icon-star-on',
                'action' => [
                    [
                        'name' => '活动编辑',
                        'route' => 'plugin/weekly_buy/mall/activity/edit',
                    ],
                ],
            ],
            $this->getStatisticsMenus(false)
        ];
    }


    /**
     * 插件唯一id，小写英文开头，仅限小写英文、数字、下划线
     * @return string
     */
    public function getName()
    {
        return 'weekly_buy';
    }

    /**
     * 插件显示名称
     * @return string
     */
    public function getDisplayName()
    {
        return '周期购';
    }

    public function getAppConfig()
    {
        $imageBaseUrl = PluginHelper::getPluginBaseAssetsUrl($this->getName()) . '/img';
        return [
            'app_image' => [
                'banner_image' => $imageBaseUrl . '/banner.jpg'
            ],
        ];
    }

    //商品详情路径
    public static function getGoodsUrl($item)
    {
        /** @var WeeklyBuyGoods $ptGoods */
        $ptGoods = WeeklyBuyGoods::find()->where(['goods_id' => $item['id']])->one();
        if ($ptGoods->weekly_buy_goods_id != 0) {
            $ptGoods = WeeklyBuyGoods::find()->where(['id' => $ptGoods->weekly_buy_goods_id])->one();
        }

        return sprintf("/plugins/weekly_buy/goods/goods?goods_id=%u", $ptGoods ? $ptGoods->goods_id : $item['id']);
    }

    public function getIndexRoute()
    {
        return 'plugin/weekly_buy/mall/index';
    }

    /**
     * 插件小程序端链接
     * @return array
     */
    public function getPickLink()
    {
        $iconBaseUrl = PluginHelper::getPluginBaseAssetsUrl($this->getName()) . '/img/pick-link';

        return [
            [
                'key' => 'weekly_buy',
                'name' => '周期购',
                'open_type' => '',
                'icon' => $iconBaseUrl . '/icon-weekly.png',
                'value' => '/plugins/weekly_buy/index/index',
            ]
        ];
    }

    /**
     * 返回实例化后台统计数据接口
     * @return StatisticsForm
     */
    public function getApi()
    {
        return new StatisticsForm();
    }

    public function getStatisticsMenus($bool = true)
    {
        return [
            'is_statistics_show' => $bool,
            'name' => $bool ? $this->getDisplayName() : '插件统计',
            'key' => $this->getName(),
            'pic_url' => $this->getStatisticIconUrl(),
            'route' => 'plugin/weekly_buy/mall/statistics/index',
        ];
    }

    public function goodsAuth()
    {
        $config = parent::goodsAuth();
        $config['is_time'] = false;
        return $config;
    }

    public function getOrderCanceledHandleClass()
    {
        return new OrderCanceledHandler();
    }

    public function getOrderPayedHandleClass()
    {
        return new OrderPayedHandler();
    }

    public function getOrdersalesHandleClass()
    {
        return new OrderSaledHandlerClass();
    }

    public function getOrderInfo($orderId, $order)
    {
        if ($order['sign'] != $this->getName()) {
            return [];
        }
        $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstance();
        $commonWeeklyBuyGoods->order = $order;
        return $commonWeeklyBuyGoods->orderInfo();
    }

    public function sendOrder($sender)
    {
        $form = new SendOrderForm();
        $form->attributes = \Yii::$app->request->post();
        $form->sender = $sender;
        return $form->send();
    }

    public function handler()
    {
        $register = new HandlerRegister();
        $HandlerClasses = $register->getHandlers();
        foreach ($HandlerClasses as $HandlerClass) {
            $handler = new $HandlerClass();
            if ($handler instanceof HandlerBase) {
                /** @var HandlerBase $handler */
                $handler->register();
            }
        }
        return $this;
    }

    public function getClerkClass($config = [])
    {
        $clerkClass = new CommonOrderClerk($config);
        $clerkClass->week_number = \Yii::$app->request->get('week_number') ?: \Yii::$app->request->post('week_number');
        return $clerkClass;
    }

    public function getHomePage($type)
    {
        if ($type == 'mall') {
            $baseUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl;
            return [
                'list' => [
                    [
                        'key' => $this->getName(),
                        'name' => $this->getDisplayName(),
                        'relation_id' => 0,
                        'is_edit' => 1,
                    ],
                ],
                'bgUrl' => [
                    $this->getName() => [
                        'bg_url' => $baseUrl . '/statics/img/mall/home_block/yushou-bg.png',
                    ],
                ],
                'key' => $this->getName(),
            ];
        } elseif ($type == 'api') {
            $form = new ListForm();
            return ($form->getList())['data'];
        } else {
            throw new WeeklyBuyException('错误的参数');
        }
    }

    public function getGoodsData($array)
    {
        $form = new ListForm();
        $form->attributes = $array;
        return ($form->getList())['data'];
    }

    public function getEnableVipDiscount()
    {
        $setting = CommonSetting::getInstance()->getSetting();
        return $setting['svip_status'] == 1;
    }

    public function getOrderConfig()
    {
        $setting = CommonSetting::getInstance()->getSetting();

        return new OrderConfig([
            'is_sms' => 1,
            'is_print' => 1,
            'is_mail' => 1,
            'is_share' => $setting['is_share'],
            'support_share' => 1,
            'is_member_price' => $setting['is_member_price'],
        ]);
    }

    /**
     * 获取图标数据统计
     * @param DataForm $dataForm
     * @param array $list
     * @return array
     */
    public function getTableSearch($dataForm, $list)
    {
        $form = new TableSearch();
        $form->dataForm = $dataForm;
        return $form->search($list);
    }
}
