<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/16
 * Time: 4:29 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\common\message;

use app\forms\common\template\tplmsg\BaseTemplate;

class ReplyForm extends BaseTemplate
{
    public $date; // 反馈时间
    public $content; // 回复内容
    protected $templateTpl = 'reply_form_tpl';

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
        $this->date = '2021年04月15日 14:00';
        $this->content = '亲，感谢您这边的提交';
        return $this->send();
    }
}
