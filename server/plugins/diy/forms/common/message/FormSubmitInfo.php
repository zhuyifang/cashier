<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/15
 * Time: 4:24 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\common\message;

use app\forms\common\template\order_pay_template\BaseInfo;

class FormSubmitInfo extends BaseInfo
{
    public const TPL_NAME = 'form_submit_tpl';
    protected $key = 'diy';
    protected $chineseName = '表单提交成功通知';

    public function getSendClass()
    {
        return new FormSubmit();
    }

    public function configAll()
    {
        $iconUrlPrefix = './statics/img/mall/tplmsg/';
        return [
            'wxapp' => [
                'config' => [
                    'id' => '3096',
                    'keyword_id_list' => [1, 9],
                    'title' => '预约成功通知',
                    'categoryId' => '307',
                    'type' => 2,
                    'data' => [
                        'date1' => '',
                        'thing9' => '',
                    ],
                ],
                'local' => [
                    'name' => '预约成功通知(类目: 服装/鞋/箱包 )',
                    'img_url' => $iconUrlPrefix . 'wxapp/form_submit_tpl.png',
                ]
            ]
        ];
    }
}
