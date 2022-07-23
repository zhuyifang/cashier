<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/4
 * Time: 5:21 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\customer_service;

use app\forms\PickLinkForm;
use app\helpers\PluginHelper;

class Plugin extends \app\plugins\Plugin
{

    public function getName()
    {
        return 'customer_service';
    }

    public function getDisplayName()
    {
        return '企业微信客服';
    }

    public function getMenus()
    {
        return [
            [
                'name' => '企业列表',
                'route' => 'plugin/customer_service/mall/index/index',
                'icon' => 'el-icon-star-on',
                'action' => [
                    [
                        'name' => '客服详情',
                        'route' => 'plugin/customer_service/mall/index/detail'
                    ]
                ]
            ],
            [
                'name' => '客服列表',
                'route' => 'plugin/customer_service/mall/index/customer',
                'icon' => 'el-icon-star-on',
            ],
        ];
    }

    public function getPickLink()
    {
        $iconBaseUrl = PluginHelper::getPluginBaseAssetsUrl($this->getName()) . '/img/pick-link';

        return [
            [
                'key' => $this->getName(),
                'name' => '企业微信客服',
                'open_type' => 'customer_service',
                'icon' => $iconBaseUrl . '/customer.png',
                'value' => 'customer_service',
                'params' => [
                    [
                        'key' => 'id',
                        'value' => '',
                        'desc' => '请填写企业id',
                        'is_required' => false,
                        'data_type' => 'number',
                    ],
                    [
                        'key' => 'enterprise_id',
                        'value' => '',
                        'desc' => '请填写企业id',
                        'is_required' => false,
                        'data_type' => 'text',
                        'page_url' => 'plugin/customer_service/mall/index/index',
                        'page_url_text' => '企业列表',
                    ],
                    [
                        'key' => 'url',
                        'value' => '',
                        'desc' => '请选择客服链接',
                        'is_required' => true,
                        'data_type' => 'text',
                        'page_url' => 'plugin/customer_service/mall/index/customer',
                        'page_url_text' => '客服列表',
                    ],
                ],
                'ignore' => [PickLinkForm::IGNORE_TITLE, PickLinkForm::IGNORE_NAVIGATE],
                'button_text' => ''
            ],
        ];
    }
}
