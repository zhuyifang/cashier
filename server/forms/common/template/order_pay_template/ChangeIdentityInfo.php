<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/22
 * Time: 2:19 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\template\order_pay_template;

use app\forms\common\template\tplmsg\ChangeIdentityTemplate;

class ChangeIdentityInfo extends BaseInfo
{
    public const TPL_NAME = 'change_identity_tpl';
    protected $key = 'member';
    protected $chineseName = '用户身份变更';

    public function getSendClass()
    {
        return new ChangeIdentityTemplate();
    }

    public function configAll()
    {
        $iconUrlPrefix = './statics/img/mall/tplmsg/';
        return [
            'wechat' => [
                'config' => [
                    'id' => 'OPENTM406524975',
                    'keyword_id_list' => 'OPENTM406524975',
                    'title' => '等级变更通知'
                ],
                'local' => [
                    'name' => '用户身份变更',
                    'img_url' => $iconUrlPrefix . 'wechat/remove_identity_tpl.png'
                ]
            ],
            'mobile' => [
                'local' => [
                    'title' => '用户身份变更',
                    'content' => '例如：您好，您的会员身份身份已变更成普通会员',
                    'support_mch' => false,
                    'loading' => false,
                    'variable' => [
                        [
                            'key' => 'name1',
                            'value' => '模板变量',
                            'desc' => '例如：您好，您的${name1}身份已变更成${name2}。则填写name1'
                        ],
                        [
                            'key' => 'name2',
                            'value' => '模板变量',
                            'desc' => '例如：您好，您的${name1}身份已变更成${name2}。则填写name2'
                        ],
                    ],
                    'key' => 'user'
                ],
            ]
        ];
    }
}
