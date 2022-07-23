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
trait CustomizationFormGoodsAttrMinPrice
{
    /**
    * 获取日历最低价
    */
    public function getDateMinPrice($goods)
    {
        $data = $this->getFormGoods($goods->id);
        $formModeType = isset($data['form_mode_type']) ? $data['form_mode_type'] : null;
        if ($formModeType == 'calendar') {
            $minPrice = FormGoodsAttr::find()->andWhere(['goods_id' => $goods->id])->min('price');
            if (!$minPrice) {
                $minPrice = $this->getAttrMinPrice($goods);
            }
        } else {
            $minPrice = $this->getAttrMinPrice($goods);
        }

        return $minPrice;
    }

    private function getAttrMinPrice($goods)
    {
        $minPrice = $goods->attr[0]->price ?? 0;
        foreach ($goods->attr as $key => $value) {
            $minPrice = min($minPrice, $value->price);
        }

        return $minPrice;
    }

    public function getFormGoodsAttrMinPriceKey($goodsId)
    {
        $key = 'form_goods_attr_min_price_' . $goodsId;
        return $key;
    }

    public function setFormGoodsAttrMinPrice($minPrice, $goodsId)
    {
        $key = $this->getFormGoodsAttrMinPriceKey($goodsId);
        \Yii::$app->redis->set($key, $minPrice);
    }
}
