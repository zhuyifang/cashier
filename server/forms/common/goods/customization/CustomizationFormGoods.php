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
use yii\helpers\ArrayHelper;

/**
 * @property Mall $mall
 * @property Goods $goods
 * @property User $user
 */
trait CustomizationFormGoods
{
    /**
    * 获取规格
    */
    public function getFormGoods($goodsId)
    {
        $data = \Yii::$app->redis->get($this->getFormGoodsKey($goodsId));
        if ($data && !env('YII_DEBUG')) {
            return json_decode($data, true);
        }

        $data = [];
        $formGoods = FormGoods::find()->andWhere(['goods_id' => $goodsId])->one();
        if ($formGoods) {
            $data = ArrayHelper::toArray($formGoods);
            $data['date_share_data'] = json_decode($formGoods->date_share_data, true);
            $data['customization_data'] = json_decode($formGoods->customization_data, true);
            unset($data['id']);
        }

        $this->setFormGoods($data, $goodsId);
        
        return $data;
    }

    public function getFormGoodsKey($goodsId)
    {        
        $key = 'form_goods_' . $goodsId;
        return $key;
    }

    public function setFormGoods(array $data, int $goodsId)
    {
        $key = $this->getFormGoodsKey($goodsId);
        \Yii::$app->redis->set($key, json_encode($data));
    }
}
