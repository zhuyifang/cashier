<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/16
 * Time: 4:28 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\common\message;

use app\forms\common\template\order_pay_template\BaseInfo;

class ReplyFormInfo extends BaseInfo
{
    public const TPL_NAME = 'reply_form_tpl';
    protected $key = 'diy';
    protected $chineseName = '反馈结果通知';

    public function getSendClass()
    {
        return new ReplyForm();
    }

    public function configAll()
    {
        $iconUrlPrefix = './statics/img/mall/tplmsg/';
        return [
            'wxapp' => [
                'config' => [
                    'id' => '9885',
                    'keyword_id_list' => [1, 3],
                    'title' => '反馈结果通知',
                    'categoryId' => '307',
                    'type' => 2,
                    'data' => [
                        'time1' => '',
                        'thing3' => '',
                    ],
                ],
                'local' => [
                    'name' => '反馈结果通知(类目: 服装/鞋/箱包 )',
                    'img_url' => $iconUrlPrefix . 'wxapp/reply_form_tpl.png',
                ]
            ]
        ];
    }
}
