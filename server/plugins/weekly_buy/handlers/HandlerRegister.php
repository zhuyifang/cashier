<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/22
 * Time: 2:19 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\handlers;

use yii\base\BaseObject;

class HandlerRegister extends BaseObject
{
    const EVENT_WEEKLY_BUY_SENT = 'weekly_buy_sent';
    public function getHandlers()
    {
        return [
            OrderSentHandler::class,
            OrderConfirmedHandler::class,
        ];
    }
}
