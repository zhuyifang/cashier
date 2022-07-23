<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/8
 * Time: 2:59 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\models;

/**
 * Class Goods
 * @package app\plugins\weekly_buy\models
 * @property WeeklyBuyGoods $weeklyBuyGoods
 */
class Goods extends \app\models\Goods
{
    public function getWeeklyBuyGoods()
    {
        return $this->hasOne(WeeklyBuyGoods::className(), ['goods_id' => 'id']);
    }
}
