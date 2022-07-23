<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/26
 * Time: 10:31 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\diy;

use app\models\Model;
use app\plugins\weekly_buy\forms\api\ListForm;

class DiyWeeklyBuyForm extends Model
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
        $form = new ListForm();
        $res = $form->getList($goodsIds);

        return $res['data']['list'];
    }

    public function getNewGoods($data, $goods)
    {
        $newGoodsList = [];
        foreach ($data['list'] as $item) {
            foreach ($goods as $gItem) {
                if ($item['id'] == $gItem['id']) {
                    $newGoodsList[] = $gItem;
                    break;
                }
            }
        }
        $data['list'] = $newGoodsList;
        return $data;
    }
}
