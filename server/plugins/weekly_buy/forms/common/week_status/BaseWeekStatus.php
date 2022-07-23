<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 9:42 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\week_status;

use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\helpers\Json;

abstract class BaseWeekStatus extends Model
{
    /**
     * @var array
     * 默认可选配送日期
     */
    public $default = [];

    /**
     * @var string
     * 配送方式的键名称
     */
    public $key = '';
    public $data;
    // 可选项
    public $list = [];

    /**
     * @var string[]
     * 周数组
     */
    public $week = ['周日', '周一', '周二', '周三', '周四', '周五', '周六'];

    /**
     * @var array
     * 月数组
     */
    public $month = [];

    public function init()
    {
        parent::init();
        for ($i = 1; $i <= 31; $i++) {
            $this->month[$i] = $i . '号';
        }
    }

    /**
     * 检测配送日期的数值是否正确
     * @param $data
     * @throws WeeklyBuyException
     */
    public function checkData($data)
    {
        if (array_intersect($data, $this->default) !== $data) {
            throw new WeeklyBuyException($this->checkDataMsg());
        }
    }

    /**
     * 配送日期错误提示文本
     * @return mixed
     */
    abstract public function checkDataMsg();

    /**
     * 获取配送方式的可选配送日期
     * @param $array
     * @return array
     */
    public function getData($array)
    {
        return $array[$this->key] ?? [];
    }

    /**
     * 设置配送方式的配送日期
     * @param WeeklyBuyGoods $weeklyBuyGoods
     * @param array $array
     * @return WeeklyBuyGoods
     */
    public function setWeeklyBuyGoods($weeklyBuyGoods, $array)
    {
        $key = $this->key;
        $weeklyBuyGoods->$key = Json::encode($this->getData($array), JSON_UNESCAPED_UNICODE);
        return $weeklyBuyGoods;
    }

    /**
     * 获取配送名称
     * @param WeeklyBuyGoods $weeklyBuyGoods
     * @return string
     */
    abstract public function typeName($weeklyBuyGoods);

    /**
     * 最近的配送时间
     * @param CommonWeeklyBuyGoods $commonWeeklyBuyGoods
     * @param string $type 类型
     * @return string
     */
    abstract public function leastTime($commonWeeklyBuyGoods, $type);

    /**
     * 获取所有配送日期的配送文本
     * @param WeeklyBuyGoods $weeklyBuyGoods
     * @return array
     */
    public function getContent($weeklyBuyGoods)
    {
        $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstance();
        $commonWeeklyBuyGoods->weeklyBuyGoods = $weeklyBuyGoods;
        $typeList = Json::decode($weeklyBuyGoods[$this->key], true);
        sort($typeList);
        return [
            'type' => $this->typeName($weeklyBuyGoods),
            'list' => $this->getList($commonWeeklyBuyGoods, $typeList),
            'before_day' => $weeklyBuyGoods->before_day,
            'type_list' => $typeList,
        ];
    }

    /**
     * 获取小程序端配送时间可选项
     * @param CommonWeeklyBuyGoods $commonWeeklyBuyGoods
     * @param array $typeList
     * @return array
     */
    public function getList($commonWeeklyBuyGoods, $typeList)
    {
        $res = [];
        foreach ($typeList as $item) {
            $res[$item] = $this->getItem($commonWeeklyBuyGoods, $item);
        }
        return $res;
    }

    /**
     * 获取指定可选项说明
     * @param CommonWeeklyBuyGoods $commonWeeklyBuyGoods
     * @param array|string $item
     * @return array
     */
    public function getItem($commonWeeklyBuyGoods, $item)
    {
        $newTime = $this->leastTime($commonWeeklyBuyGoods, $item);
        return [
            'week_key' => $item,
            'week_val' => $this->list[$item],
            'least_time' => sprintf('预计%s配送（%s）', date('Y.m.d', $newTime), $this->week[date('w', $newTime)])
        ];
    }

    /**
     * 下单预览中配送日期说明
     * @param CommonWeeklyBuyGoods $commonWeeklyBuyGoods
     * @return string
     */
    abstract public function orderText($commonWeeklyBuyGoods, $type);

    /**
     * 下一周期发货时间
     * @param int $leastTime
     * @param string $type
     * @param CommonWeeklyBuyGoods $commonWeeklyBuyGoods
     * @return mixed
     */
    abstract public function nextTime($leastTime, $type, $commonWeeklyBuyGoods);

    /**
     * 获取下个月的同一天，如果是29、30、31这些日期下个月没有，则获取下个月的最后一天
     * @param $leastTime
     * @return false|int
     */
    public function getNextMonth($leastTime)
    {
        $now = date('n', $leastTime);
        $typeTime = strtotime('next Month', $leastTime);
        if (date('n', $typeTime) > $now + 1) {
            $typeTime = strtotime('last day of next Month', $leastTime);
        }
        return $typeTime;
    }

    /**
     * 获取选择的配送时间
     * @param CommonWeeklyBuyGoods $commonWeeklyBuyGoods
     * @param string $type 类型
     * @return string
     */
    abstract public function getWeekKey($commonWeeklyBuyGoods, $type);
}
