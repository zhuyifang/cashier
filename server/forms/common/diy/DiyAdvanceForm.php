<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\diy;

use app\models\Model;
use app\plugins\advance\models\Goods;

class DiyAdvanceForm extends Model
{
    use TraitGoods;

    public function getGoodsIds($data)
    {
        $goodsIds = [];
        foreach ($data['list'] as $item) {
            $goodsIds[] = $item['id'];
        }

        return $goodsIds;
    }

    public function getGoodsById($goodsIds)
    {
        if (!$goodsIds) {
            return [];
        }
        $list = Goods::find()->where([
            'id' => $goodsIds,
            'is_delete' => 0
        ])->with(['goodsWarehouse.cats', 'advanceGoods'])->all();
        return $this->getGoodsList($list);
    }

    public function getNewGoods($data, $goods)
    {
        $newArr = [];
        foreach ($data['list'] as &$item) {
            foreach ($goods as $gItem) {
                //商品下架
                if ($gItem['status'] == 0) {
                    continue;
                }
                //已过定金时间
                if (strtotime($gItem['end_prepayment_at']) < time()) {
                    continue;
                }
                if ($item['id'] == $gItem['id']) {
                    $newArr[] = $gItem;
                    break;
                }
            }
        }

        $data['list'] = $newArr;

        return $data;
    }

    /**
     * @param $arr
     * @param Goods $goods
     * @return array
     */
    public function extraGoods($arr, $goods)
    {
        $deposit = [];
        $swellDeposit = 0;
        if ($goods->use_attr == 1) {
            foreach ($goods->advanceGoods->attr as $item) {
                $deposit[] = $item->attr->deposit;
                if ($item->attr->deposit <= min($deposit)) {
                    $swellDeposit = $item->attr->swell_deposit;
                }
            }
        } else {
            $deposit[] = $goods->advanceGoods->deposit;
            $swellDeposit = $goods->advanceGoods->swell_deposit;
        }
        return array_merge($arr, $goods->advanceGoods->toArray([
            'ladder_rules',
            'start_prepayment_at',
            'end_prepayment_at',
            'pay_limit',
        ]), [
            'end_prepayment_time' => strtotime($goods->advanceGoods->end_prepayment_at) - time(),
            'deposit' => min($deposit),
            'swell_deposit' => $swellDeposit,
        ]);
    }
}
