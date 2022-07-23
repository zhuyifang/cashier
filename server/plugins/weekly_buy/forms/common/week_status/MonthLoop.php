<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/11
 * Time: 11:09 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

use app\helpers\Json;

class MonthLoop extends BaseWeekStatus
{
    public function init()
    {
        parent::init();
        $this->default = array_keys($this->month);
        $this->list = array_map(function ($item) {
            return '每月' . $item;
        }, $this->month);
        $this->key = 'month_loop';
    }

    public function checkDataMsg()
    {
        return '按月循环的循环时间错误';
    }

    public function typeName($weeklyBuyGoods)
    {
        return '每月定期发货';
    }

    public function leastTime($commonWeeklyBuyGoods, $type)
    {
        $time = $commonWeeklyBuyGoods->beforeTime();
        $arr = explode(',', $type);
        $day = date('j', $time);
        // 方法一暴力法：最多循环31次
        while (!in_array($day, $arr)) {
            $time = strtotime('+1 day', $time);
            $day = date('j', $time);
        }
        return $time;
    }

    public function orderText($commonWeeklyBuyGoods, $type)
    {
        return '每月定期发货';
    }

    public function nextTime($leastTime, $type, $commonWeeklyBuyGoods)
    {
        $arr = explode(',', $type);
        do {
            $leastTime = strtotime('+1 day', $leastTime);
            $day = date('j', $leastTime);
        } while (!in_array($day, $arr));
        return $leastTime;
    }

    public function getWeekKey($commonWeeklyBuyGoods, $type)
    {
        $arr = Json::decode($commonWeeklyBuyGoods->weeklyBuyGoods->month_loop, true);
        return implode(',', $arr);
    }

    public function getList($commonWeeklyBuyGoods, $typeList)
    {
        return [
            $this->getItem($commonWeeklyBuyGoods, $typeList)
        ];
    }

    public function getItem($commonWeeklyBuyGoods, $item)
    {
        if (!is_array($item)) {
            $item = explode(',', $item);
        }
        $type = $this->getWeekKey($commonWeeklyBuyGoods, '');
        $newTime = $this->leastTime($commonWeeklyBuyGoods, $type);
        $weekVal = [];
        $string = '';
        foreach ($item as $value) {
            $weekVal[] = $this->month[$value];
            if (count($weekVal) <= 4) {
                $string .= $this->month[$value] . '、';
            }
        }
        if (count($weekVal) > 6) {
            $string = rtrim($string, '、');
            $string .= '...' . $weekVal[count($weekVal) - 1];
        } else {
            $string = implode(',', $weekVal);
        }
        return [
            'week_key' => 0,
            'week_val' => sprintf('每月%s配送', $string),
            'least_time' => sprintf('预计%s配送（%s）', date('Y.m.d', $newTime), $this->week[date('w', $newTime)])
        ];
    }
}
