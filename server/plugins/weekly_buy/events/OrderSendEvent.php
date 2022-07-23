<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/28
 * Time: 9:29 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\events;

class OrderSendEvent extends \app\events\OrderSendEvent
{
    public $week_number;
}
