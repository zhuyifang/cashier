<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 10:10 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\Model;

class WeekStatusFactory extends Model
{
    /**
     * @throws WeeklyBuyException
     */
    public static function create($type, $config = [])
    {
        switch ($type) {
            case 1:
                $class = new WeekStatusDay($config);
                break;
            case 2:
                $class = new WeekStatusWeek($config);
                break;
            case 3:
                $class = new WeekStatusMonth($config);
                break;
            case 4:
                $class = new WeekStatusCustom($config);
                break;
            case 5:
                $class = new WeekLoop($config);
                break;
            case 6:
                $class = new MonthLoop($config);
                break;
            default:
                throw new WeeklyBuyException('配送周期类型错误');
        }
        return $class;
    }
}
