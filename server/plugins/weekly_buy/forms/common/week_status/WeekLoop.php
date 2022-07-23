<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/11
 * Time: 9:32 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

use app\helpers\Json;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;

class WeekLoop extends BaseWeekStatus
{
    public function init()
    {
        parent::init();
        $this->default = [0, 1, 2, 3, 4, 5, 6];
        $this->list = array_map(function ($item) {
            return '每' . $item;
        }, $this->week);
        $this->key = 'week_loop';
    }

    public function checkDataMsg()
    {
        return '按周循环的循环时间错误';
    }

    public function typeName($weeklyBuyGoods)
    {
        return '每周定期发货';
    }

    public function leastTime($commonWeeklyBuyGoods, $type)
    {
        $time = $commonWeeklyBuyGoods->beforeTime();
        $arr = explode(',', $type);
        $week = date('w', $time);
        // 方法一暴力法：最多循环7次
        while (!in_array($week, $arr)) {
            $time = strtotime('+1 day', $time);
            $week = date('w', $time);
        }
        return $time;
    }

    public function orderText($commonWeeklyBuyGoods, $type)
    {
        return '每周定期发货';
    }

    public function nextTime($leastTime, $type, $commonWeeklyBuyGoods)
    {
        $arr = explode(',', $type);
        do {
            $leastTime = strtotime('+1 day', $leastTime);
            $week = date('w', $leastTime);
        } while (!in_array($week, $arr));
        return $leastTime;
    }

    public function getWeekKey($commonWeeklyBuyGoods, $type)
    {
        $arr = Json::decode($commonWeeklyBuyGoods->weeklyBuyGoods->week_loop, true);
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
        foreach ($item as $value) {
            $weekVal[] = $this->week[$value];
        }
        return [
            'week_key' => 0,
            'week_val' => sprintf('每周%s配送', implode('、', $weekVal)),
            'least_time' => sprintf('预计%s配送（%s）', date('Y.m.d', $newTime), $this->week[date('w', $newTime)])
        ];
    }
}
