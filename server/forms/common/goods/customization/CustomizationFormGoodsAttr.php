<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 15:00
 */

namespace app\forms\common\goods\customization;

use app\forms\common\CommonMallMember;
use app\models\FormGoods;
use app\models\FormGoodsAttr;
use app\models\Model;

/**
 * @property Mall $mall
 * @property Goods $goods
 * @property User $user
 */
trait CustomizationFormGoodsAttr
{
    /**
    * 获取规格
    */
    public function getCalendarData($goodsId)
    {
        $mallMembers = CommonMallMember::getAllMember();
        // 会员有变动时数据要刷新
        $count = \Yii::$app->redis->get($this->getFormGoodsMemberCountKey($goodsId));

        $newList = \Yii::$app->redis->get($this->getFormGoodsAttrKey($goodsId));
        if ($newList && count($mallMembers) == $count && !env('YII_DEBUG')) {
            return json_decode($newList, true);
        }

        $list = FormGoodsAttr::find()->andWhere([
            'and',
            ['goods_id' => $goodsId]
        ])->all();
        $newList = [];
        foreach ($list as $item) {
            $array = explode('-', $item['date']);
            $newItem = $this->transformDate($item, $mallMembers);
            $newList[$item->attr_id][] = $newItem;
        }

        $this->setFormGoodsAttr($newList, $goodsId);
        $this->setFormGoodsMemberCount(count($mallMembers), $goodsId);

        return $newList;
    }

    private function transformDate($formGoodsAttr, $mallMembers)
    {
        $array = explode('-', $formGoodsAttr->date);

        $memberPrice = json_decode($formGoodsAttr->member_price, true);
        foreach ($mallMembers as $member) {
            if (isset($memberPrice['level' . $member['level']]) === false) {
                $memberPrice['level' . $member['level']] = 0;
            }
            $memberPrice['level' . $member['level']] = (float)$memberPrice['level' . $member['level']];
        }
        $newItem = [
            'date' => [
                'year' => (int)$array[0],
                'month' => (int)$array[1],
                'day' => (int)$array[2],
                'value' => $formGoodsAttr->date
            ],
            'value' => [
                'price' => $formGoodsAttr->price,
                'stock' => $formGoodsAttr->stock,
                'member_price' => $memberPrice,
                'shareLevelList' => json_decode($formGoodsAttr->share_level_list, true),
                'has_type' => json_decode($formGoodsAttr->has_type, true)
            ]
        ];

        return $newItem;
    }

    public function getFormGoodsAttrKey($goodsId)
    {
        $key = 'form_goods_attr_' . $goodsId;
        return $key;
    }

    public function setFormGoodsAttr(array $list, int $goodsId)
    {
        $key = $this->getFormGoodsAttrKey($goodsId);
        \Yii::$app->redis->set($key, json_encode($list));
    }

    // 刷新缓存
    public function refreshFormGoodsAttr($goodsId)
    {
        $key = $this->getFormGoodsAttrKey($goodsId);
        \Yii::$app->redis->del($key);
        $this->getCalendarData($goodsId);
    }

    public function getFormGoodsMemberCountKey($goodsId)
    {
        $key = 'form_goods_member_' . $goodsId;
        return $key;
    }

    public function setFormGoodsMemberCount(int $count, int $goodsId)
    {
        $key = $this->getFormGoodsMemberCountKey($goodsId);
        \Yii::$app->redis->set($key, $count);
    }
}
