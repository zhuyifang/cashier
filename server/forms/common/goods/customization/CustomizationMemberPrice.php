<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 15:00
 */

namespace app\forms\common\goods\customization;

use app\models\FormGoods;
use app\models\FormGoodsAttr;
use app\models\Model;

/**
 * @property Mall $mall
 * @property Goods $goods
 * @property User $user
 */
trait CustomizationMemberPrice
{
    /**
    * 获取日历最低会员价
    */
    public function getMinMemberPrice($goodsId)
    {
        $minPrice = \Yii::$app->redis->get($this->getMinMemberPriceKey($goodsId));
        if ($minPrice && !env('YII_DEBUG')) {
            return $minPrice;
        }
        
        $minPrice = 0;
        $formGoods = FormGoods::find()->andWhere(['goods_id' => $goodsId])
            ->select(['form_mode_type'])
            ->one();

        if ($formGoods->form_mode_type == 'calendar') {
            $formGoodsAttr =  FormGoodsAttr::find()->andWhere(['goods_id' => $goodsId])
                    ->select(['member_price', 'has_type'])
                    ->all();

            foreach ($formGoodsAttr as $item) {
                $hasType = json_decode($item->has_type, true);
                if ($hasType['memberPrice']) {
                    $memberPrice = json_decode($item->member_price, true);
                    foreach ($memberPrice as $price) {
                        $minPrice = $minPrice ? min($minPrice, $price) : $price;
                    }
                }
            }

            $this->setMinMemberPrice($minPrice, $goodsId);
        }

        return $minPrice;
    }

    public function getMinMemberPriceKey($goodsId)
    {
        $key = 'goods_min_member_price_' . $goodsId;
        return $key;
    }

    public function setMinMemberPrice($minMemberPrice, $goodsId)
    {
        $minMemberPrice = !is_null($minMemberPrice) ? $minMemberPrice : -1;
        $key = $this->getMinMemberPriceKey($goodsId);
        \Yii::$app->redis->set($key, $minMemberPrice);
    }
}
