<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\diy;


use app\forms\api\goods\ApiGoods;
use app\forms\common\diy\TraitGoods;
use app\forms\common\goods\CommonGoodsList;
use app\models\Goods;
use app\models\Model;

class DiyMchGoodsForm extends Model
{
    use TraitGoods;

    public function getGoodsIds($data)
    {
        $goodsIds = [];
        foreach ($data['data']['list'] as $key => $value) {
            $goodsIds[] = $value['id'];
        }
        
        return $goodsIds;
    }

    public function getGoodsById($goodsIds)
    {

        $form = new CommonGoodsList();
        $form->goods_id = $goodsIds;
        $form->sign = ['mch', ''];
        $form->relations = ['goodsWarehouse'];
        $form->status = 1;
        $form->is_show = 1;
        $form->sort = 2;
        $form->limit = count($goodsIds);
        $list = $form->search();
        $newList = $this->getGoodsList($list);

        return $newList;
    }

    public function getNewGoods($data, $diyGoods)
    {
        $data['list'] = $this->setGoodsList($data['list'], $diyGoods);

        return $data;
    }

    private function setGoodsList($goodsList, $diyGoods)
    {
        $newArr = [];
        foreach ($goodsList as $item) {
            foreach ($diyGoods as $dItem) {
                if ($item['id'] == $dItem['id']) {
                    $newArr[] = $dItem;
                    break;
                }
            }
        }

        return $newArr;
    }
}
