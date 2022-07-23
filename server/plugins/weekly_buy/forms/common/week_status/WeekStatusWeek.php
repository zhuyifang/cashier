<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 9:49 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

class WeekStatusWeek extends BaseWeekStatus
{
    public $nextWeek = [];

    public function init()
    {
        parent::init();
        $this->default = [0, 1, 2, 3, 4, 5, 6];
        $this->list = array_map(function ($item) {
            return '每' . $item;
        }, $this->week);
        $this->key = 'week_status_week';
        $this->nextWeek = [
            'next Sunday',
            'next Monday',
            'next Tuesday',
            'next Wednesday',
            'next Thursday',
            'next Friday',
            'next Saturday'
        ];
    }

    public function checkDataMsg()
    {
        return '每周一期的配送日期选择错误';
    }

    public function typeName($weeklyBuyGoods)
    {
        return '每周一期';
    }

    public function leastTime($commonWeeklyBuyGoods, $type)
    {
        $time = $commonWeeklyBuyGoods->beforeTime();
        return date('w', $time) == $type ? $time : strtotime($this->nextWeek[$type], $time);
    }

    public function nextTime($leastTime, $type, $commonWeeklyBuyGoods)
    {
        return strtotime($this->nextWeek[$type], $leastTime);
    }

    public function orderText($commonWeeklyBuyGoods, $type)
    {
        return sprintf('每%s配送', $this->week[$type]);
    }

    public function getWeekKey($commonWeeklyBuyGoods, $type)
    {
        return $type;
    }
}
