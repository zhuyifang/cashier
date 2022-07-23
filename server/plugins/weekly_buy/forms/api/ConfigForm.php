<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/2
 * Time: 9:35 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api;

use app\plugins\weekly_buy\forms\common\CommonSetting;
use app\plugins\weekly_buy\forms\Model;

class ConfigForm extends Model
{
    public function getConfig()
    {
        $setting = CommonSetting::getInstance()->getSetting();
        return $this->success([
            'rule' => $setting['detail']
        ]);
    }
}
