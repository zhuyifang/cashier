<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/14
 * Time: 5:05 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api;

use app\models\GoodsAttr;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;

class OrderGoodsAttr extends \app\forms\api\order\OrderGoodsAttr
{
    /**
     * @var WeeklyBuyGoods $weeklyBuyGoods
     */
    public $weeklyBuyGoods;
    // 期数
    public $week_number;
    // 选择的配送周期
    public $week_key;

    // 主商品的规格id
    public $mainGoodsAttrId;
    // 主商品id
    public $mainGoodsId;

    public function setGoodsAttr($goodsAttr)
    {
        $goodsId = WeeklyBuyGoods::find()->select('goods_id')
            ->where([
                'id' => $this->weeklyBuyGoods->weekly_buy_goods_id
            ]);
        $mainGoodsAttr = GoodsAttr::findOne([
            'goods_id' => $goodsId,
            'sign_id' => $goodsAttr->sign_id,
            'is_delete' => 0
        ]);
        $this->mainGoodsAttrId = $mainGoodsAttr->id;
        $this->mainGoodsId = $mainGoodsAttr->goods_id;
        $goodsAttr->stock = $mainGoodsAttr->stock;
        $goodsAttr->price = $goodsAttr->price * $this->week_number;
        parent::setGoodsAttr($goodsAttr);
    }
}
