<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 9:52 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

class WeekStatusMonth extends BaseWeekStatus
{
    public function init()
    {
        parent::init();
        $this->default = array_keys($this->month);
        $this->list = array_map(function ($item) {
            return '每月' . $item;
        }, $this->month);
        $this->key = 'week_status_month';
    }

    public function checkDataMsg()
    {
        return '每月一期的配送日期选择错误';
    }

    public function typeName($weeklyBuyGoods)
    {
        return '每月一期';
    }

    public function leastTime($commonWeeklyBuyGoods, $type)
    {
        $time = $commonWeeklyBuyGoods->beforeTime();
        $time = strtotime(date('Y-m-d', $time));
        $month = date('m', $time);
        $lastDay = strtotime('+1 month -1 day', strtotime(date('Y-' . $month . '-01')));
        $typeTime = min(strtotime(date('Y-' . $month . '-' . $type)), $lastDay);
        while ($time > $typeTime) {
            $typeTime = $this->getNextMonth($typeTime);
        }
        return $typeTime;
    }

    public function nextTime($leastTime, $type, $commonWeeklyBuyGoods)
    {
        return $this->getNextMonth($leastTime);
    }

    public function orderText($commonWeeklyBuyGoods, $type)
    {
        return sprintf('每月%s配送', $this->month[$type]);
    }

    public function getWeekKey($commonWeeklyBuyGoods, $type)
    {
        return $type;
    }
}
