<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 9:56 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

use yii\helpers\Json;

class WeekStatusCustom extends BaseWeekStatus
{
    public function init()
    {
        parent::init();
        $this->default = array_keys($this->month);
        $this->list = array_map(function ($item) {
            return '每月' . $item;
        }, $this->month);
        $this->key = 'week_status_customize';
    }

    public function checkDataMsg()
    {
        return '自定义的配送日期选择错误';
    }

    public function setWeeklyBuyGoods($weeklyBuyGoods, $array)
    {
        $key = $this->key;
        $weeklyBuyGoods->$key = Json::encode($this->getData($array), JSON_UNESCAPED_UNICODE);
        $weeklyBuyGoods->week_status_customize_day = $array['week_status_customize_day'];
        return $weeklyBuyGoods;
    }

    public function typeName($weeklyBuyGoods)
    {
        return $weeklyBuyGoods->week_status_customize_day . '日一期';
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
        return strtotime('+' . $commonWeeklyBuyGoods->weeklyBuyGoods->week_status_customize_day . ' day', $leastTime);
    }

    public function orderText($commonWeeklyBuyGoods, $type)
    {
        return sprintf('每%s日配送一期', $commonWeeklyBuyGoods->weeklyBuyGoods->week_status_customize_day);
    }

    public function getWeekKey($commonWeeklyBuyGoods, $type)
    {
        return $type;
    }
}
