<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/8/5
 * Time: 11:23 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\link;

use app\models\Model;

class LinkAuth extends Model
{
    public static $list = [];

    public static function push($path, $link)
    {
        self::$list[$path] = $link['value'];
    }
}
