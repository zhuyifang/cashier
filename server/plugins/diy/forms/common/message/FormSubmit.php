<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/15
 * Time: 4:26 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\common\message;

use app\forms\common\template\tplmsg\BaseTemplate;

class FormSubmit extends BaseTemplate
{
    public $date; // 预约时间
    public $content; // 温馨提示
    protected $templateTpl = 'form_submit_tpl';

    public function msg()
    {
        return [
            'keyword1' => [
                'value' => $this->date,
                'color' => '#333333',
            ],
            'keyword2' => [
                'value' => $this->content,
                'color' => '#333333',
            ],
        ];
    }

    public function test()
    {
        $this->date = '2021年04月15日14:00';
        $this->content = '亲爱的用户，您的表单提交成功';
        return $this->send();
    }
}
