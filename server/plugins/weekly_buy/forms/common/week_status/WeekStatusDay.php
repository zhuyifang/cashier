<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 9:46 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

class WeekStatusDay extends BaseWeekStatus
{
    public function init()
    {
        parent::init();
        $this->list = [
            1 => '每日配送',
            2 => '工作日每天配送',
            3 => '周末每天配送',
            4 => '隔天配送'
        ];
        $this->default = [1, 2, 3, 4];
        $this->key = 'week_status_day';
    }

    public function checkDataMsg()
    {
        return '每日一期的配送日期选择错误';
    }

    public function typeName($weeklyBuyGoods)
    {
        return '每日一期';
    }

    public function leastTime($commonWeeklyBuyGoods, $type)
    {
        $time = $commonWeeklyBuyGoods->beforeTime();
        $week = date('w', $time);
        $isWeek = $week == 0 || $week == 6;
        switch ($type) {
            case 2:
                $newTime = $isWeek ? strtotime('next Monday', $time) : $time;
                break;
            case 3:
                $newTime = $isWeek ? $time : strtotime('next Saturday', $time);
                break;
            default:
                $newTime = $time;
        }
        return $newTime;
    }

    public function orderText($commonWeeklyBuyGoods, $type)
    {
        return $this->list[$type];
    }

    public function nextTime($leastTime, $type, $commonWeeklyBuyGoods)
    {
        $week = date('w', $leastTime);
        switch ($type) {
            case 2:
                $string = $week == 5 ? 'next Monday' : 'tomorrow';
                break;
            case 3:
                $string = $week == 0 ? 'next Saturday' : 'tomorrow';
                break;
            case 4:
                $string = '+2 day';
                break;
            default:
                $string = 'tomorrow';
        }
        return strtotime($string, $leastTime);
    }

    public function getWeekKey($commonWeeklyBuyGoods, $type)
    {
        return $type;
    }
}
