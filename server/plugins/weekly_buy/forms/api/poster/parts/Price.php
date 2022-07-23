<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/10
 * Time: 11:25 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api\poster\parts;

use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyGroups;

class Price extends \app\forms\api\poster\parts\Price
{
    protected function isNegotiable($goods)
    {
        return 0;
    }

    protected function getPrices($goods)
    {
        $weeklyBuyGoods = WeeklyBuyGoods::findOne(['goods_id' => $goods->id, 'mall_id' => \Yii::$app->mall->id]);
        $weeklyBuyGroups = WeeklyBuyGroups::find()
            ->with(['goods.attr'])
            ->andWhere([
                'is_delete' => 0, 'weekly_buy_goods_id' => $weeklyBuyGoods->id
            ])->all();
        $prices = [];
        /* @var WeeklyBuyGroups[] $weeklyBuyGroups */
        foreach ($weeklyBuyGroups as $weeklyBuyGroup) {
            $prices = array_merge($prices, array_column($weeklyBuyGroup->goods->attr, 'price'));
        }
        if (empty($prices)) {
            throw new WeeklyBuyException('海报-规格数据异常');
        }
        return [
            'min_price' => min($prices),
            'max_price' => max($prices),
        ];
    }
}
