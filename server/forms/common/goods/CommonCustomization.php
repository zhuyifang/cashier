<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 15:00
 */

namespace app\forms\common\goods;

use app\forms\common\goods\customization\CustomizationFormGoods;
use app\forms\common\goods\customization\CustomizationFormGoodsAttr;
use app\forms\common\goods\customization\CustomizationFormGoodsAttrMinPrice;
use app\forms\common\goods\customization\CustomizationMemberPrice;
use app\models\FormGoods;
use app\models\FormGoodsAttr;
use app\models\Goods;
use app\models\Model;

/**
 * @property Mall $mall
 * @property Goods $goods
 * @property User $user
 */
class CommonCustomization extends Model
{
    use CustomizationFormGoods, CustomizationMemberPrice, CustomizationFormGoodsAttr, CustomizationFormGoodsAttrMinPrice;

    private static $instance;

    private $goodsList;
    private $form_mode_type;

    public static function getCommon()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getGoodsCustomization($goodsId)
    {
        $customization = [];
        $data = $this->getFormGoods($goodsId);
        if ($data) {
            $customization = $data['customization_data'];
        }
        
        return $customization;
    }

    // 处理日历规格数据
    public function handleDate($attrs, $member, $goods, $user)
    {
        $calendarData = $this->getCalendarData($goods->id);
        foreach ($attrs as &$attr) {
            $attr['date'] = isset($calendarData[$attr['id']]) ? $calendarData[$attr['id']] : [];
            $attr['calc_price'] = $attr['price'];
            if ($attr['date']) {
                $stock = 0;
                foreach ($attr['date'] as &$item) {
                    $stock += $item['value']['stock'];
                    if ($goods->mch_id) {
                        // 多商户没有会员价 直接显示售价
                        $item['value']['price_member'] = $item['value']['price'];
                    } else {
                        if ($goods->is_level_alone == 1) {
                            if ($user && $user->identity->member_level > 0) {
                                if (isset($item['value']['member_price']['level' . $user->identity->member_level]) && $item['value']['has_type']['memberPrice']) {
                                    $memberPrice = $item['value']['member_price']['level' . $user->identity->member_level];
                                } else {
                                    $memberPrice = $item['value']['price'];
                                }
                                $item['value']['price_member'] = $memberPrice;
                            } else {
                                $item['value']['price_member'] = $item['value']['price'];
                            }
                        } else {
                            if ($member && $goods->is_level) {
                                $item['value']['price_member'] = round($item['value']['price'] * $member->discount / 10, 2);
                            } else {
                                $item['value']['price_member'] = $item['value']['price'];
                            }
                        }
                    }
                    $item['value']['calc_price'] = $item['value']['price_member'];
                }
                $attr['stock'] = $stock;
                unset($item);
            } else {
                // 没有日期情况下计算会员价
                if ($user && $user->identity->member_level > 0) {
                    if (isset($item['member_price_' . $user->identity->member_level])) {
                        $item['calc_price'] = $item['member_price_' . $user->identity->member_level];
                    }
                }
            }
        }
        unset($attr);

        return $attrs;
    }

    /**
     * @param $num integer 需要改变的数量
     * @param $type string 增加add|减少sub
     * @param $dateList array|[] 已选日期列表
     * @return bool
     * @throws Exception
     */
    public function updateStock($num, $type, $dateList = [], $goodsId)
    {
        try {
            $transaction = \Yii::$app->db->beginTransaction();
            foreach ($dateList as $item) {
                $formGoodsAttr = FormGoodsAttr::findOne(['attr_id' => $item['attr']['attr_id'], 'date' => $item['date']]);
                if (!$formGoodsAttr) {
                    throw new \Exception('定制规格ID错误' . $item['attr']['attr_id']);
                }

                // 商品总库存也需要减掉
                /** @var Goods $goods */
                $goods = Goods::findOne($formGoodsAttr->goods_id);
                if (!$goods) {
                    throw new \Exception('库存操作：商品ID(' . $formGoodsAttr->goods_id . ')不存在');
                }

                if ($type === 'add') {
                    $formGoodsAttr->stock += $num;
                    $goods->goods_stock += $num;
                } elseif ($type === 'sub') {
                    if ($num > $item['attr']['stock']) {
                        throw new \Exception('日期库存不足');
                    }

                    if ($num > $goods->goods_stock) {
                        throw new \Exception('商品库存不足');
                    }

                    $formGoodsAttr->stock -= $num;
                    $goods->goods_stock -= $num;
                } else {
                    throw new \Exception('错误$type');
                }

                if (!$formGoodsAttr->save()) {
                    throw new \Exception((new Model())->getErrorMsg($formGoodsAttr));
                }

                if (!$goods->save()) {
                    throw new \Exception((new Model())->getErrorMsg($goods));
                }
            }
            $transaction->commit();

            // 刷新缓存
            $this->refreshFormGoodsAttr($goodsId);
        }catch(\Exception $exception) {
            \Yii::error('定制商品库存操作异常');
            \Yii::error($exception);
        }
    }
}
