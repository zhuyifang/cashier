<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/22
 * Time: 2:23 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\template\tplmsg;

class ChangeIdentityTemplate extends BaseTemplate
{
    public $remark; // 备注说明
    public $time; // 变更时间
    protected $templateTpl = 'change_identity_tpl';

    public function msg()
    {
        return [
            'keyword1' => [
                'value' => $this->remark,
                'color' => '#333333',
            ],
            'keyword2' => [
                'value' => $this->time,
                'color' => '#333333',
            ],
        ];
    }

    public function test()
    {
        $this->remark = '业绩不达标，你的分销商身份已变更';
        $this->time = '2019年10月10日 10:10';
        return $this->send();
    }

    protected function wechatMsg()
    {
        return [
            'keyword1' => [
                'value' => $this->user->nickname,
                'color' => '#333333',
            ],
            'keyword2' => [
                'value' => $this->remark,
                'color' => '#333333',
            ],
        ];
    }
}
