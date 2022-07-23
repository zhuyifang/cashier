<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/8
 * Time: 2:56 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\forms\mall\goods\BaseGoodsList;
use app\plugins\weekly_buy\models\Goods;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\Plugin;

class GoodsListForm extends BaseGoodsList
{
    public function __construct($config = [])
    {
        parent::__construct($config);
        $plugin = new Plugin();
        $this->plugin = $plugin->getName();
        $this->goodsModel = Goods::className();
    }

    public function setQuery($query)
    {
        $query->leftJoin(['wbg' => WeeklyBuyGoods::tableName()], 'wbg.goods_id=g.id')->andWhere([
            'g.sign' => $this->plugin, 'wbg.weekly_buy_goods_id' => 0
        ])->with('weeklyBuyGoods');
        return parent::setQuery($query);
    }

    protected function timeSearch($query, $search)
    {
        if (
            isset($search['date_start']) && $search['date_start']
            && isset($search['date_end']) && $search['date_end']
        ) {
            $condition = [
                'or',
                ['between', 'wbg.start_time', $search['date_start'], $search['date_end']],
                [
                    'and',
                    ['between', 'wbg.end_time', $search['date_start'], $search['date_end']],
                    ['wbg.is_no_end_time' => 0]
                ],
                [
                    'and',
                    ['<=', 'wbg.start_time', $search['date_start']],
                    ['>=', 'wbg.end_time', $search['date_end']],
                    ['wbg.is_no_end_time' => 0]
                ],
                [
                    'and',
                    ['wbg.is_no_end_time' => 1],
                    ['<=', 'wbg.start_time', $search['date_end']],
                ]
            ];
            $query->andWhere($condition);
        }
        return $query;
    }

    /**
     * @param Goods $goods
     * @return array
     */
    public function handleGoodsData($goods)
    {
        if ($goods->status == 1) {
            if (strtotime($goods->weeklyBuyGoods->start_time) > time()) {
                $status = 2;
            } elseif ($goods->weeklyBuyGoods->is_no_end_time == 0 && strtotime($goods->weeklyBuyGoods->end_time) <= time()) {
                $status = 4;
            } else {
                $status = 3;
            }
        } else {
            $status = 5;
        }
        return [
            'start_time' => $goods->weeklyBuyGoods->start_time,
            'end_time' => $goods->weeklyBuyGoods->end_time,
            'week_type' => $goods->weeklyBuyGoods->week_type,
            'week_status_customize_day' => $goods->weeklyBuyGoods->week_status_customize_day,
            'status' => $status
        ];
    }

    public function setStatus($query, $search)
    {
        if (isset($search['status']) && $search['status'] != 1) {
            $status = 1;
            switch ($search['status']) {
                case 2:
                    $query->andWhere(['>', 'wbg.start_time', mysql_timestamp()]);
                    break;
                case 3:
                    $query->andWhere([
                        'and',
                        ['<=', 'wbg.start_time', mysql_timestamp()],
                        [
                            'or',
                            ['>', 'wbg.end_time', mysql_timestamp()],
                            ['wbg.is_no_end_time' => 1]
                        ]
                    ]);
                    break;
                case 4:
                    $query->andWhere(['<=', 'wbg.end_time', mysql_timestamp()])->andWhere(['wbg.is_no_end_time' => 0]);
                    break;
                case 5:
                    $status = 0;
                    break;
                default:
                    return $query;
            }
            $query->andWhere(['g.status' => $status]);
        }
        return $query;
    }
}
