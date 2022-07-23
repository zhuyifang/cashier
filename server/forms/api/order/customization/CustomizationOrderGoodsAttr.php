<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/5/8
 * Time: 10:59
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\api\order\customization;

use app\forms\api\order\OrderGoodsAttr;
use app\models\FormGoods;
use app\models\FormGoodsAttr;
use app\models\GoodsShare;

/**
 * @property sring $customization
 */
class CustomizationOrderGoodsAttr extends OrderGoodsAttr
{
    public $dateList;
    public $customization;
    public $form_goods;
    public $select_date;
    public $calc;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['customization', 'select_date', 'calc', 'form_goods'], 'safe']
        ]);
    }

    public function setFormGoods($formGoods)
    {
        $customizationData = json_decode($formGoods->customization_data, true);
        $this->form_goods = [];
        $this->form_goods['name'] = $customizationData['name'] ?? '';
        $this->form_goods['btn_name'] = $customizationData['btn_name'] ?? '';
        $this->form_goods['customization_status'] = $formGoods->customization_status;
        $this->form_goods['is_today'] = $formGoods->is_today;
        $this->form_goods['after_day'] = $formGoods->after_day;
        $this->form_goods['is_alone'] = $formGoods->is_alone;
        $this->form_goods['has_kuatian'] = $formGoods->has_kuatian;
        $this->form_goods['is_day'] = $formGoods->is_day;
        $this->form_goods['day_max'] = $formGoods->day_max;
        $this->form_goods['place_unit'] = $formGoods->place_unit;
        $this->form_goods['form_mode_type'] = $formGoods->form_mode_type;
    }

    public function setShare()
    {
        $goodsAttr = $this->goodsAttr;
        $goods = $this->goods;

        if ($goods->formGoods->form_mode_type == 'basic') {
            parent::setShare();
        } else {
            $shareLevelList = [];
            if ($this->goods->use_attr && $this->goods->attr_setting_type == 0) {
                // 普通设置
                $date = json_decode($goods->formGoods->date_share_data, true);
                $shareList = [];
                foreach ($date as $item) {
                    if ($item['value']['has_type']['sharePrice']) {
                        $shareList[$item['date']['value']] = $item['value']['shareLevelList'];
                    } else {
                        $shareList[$item['date']['value']] = [];
                    }
                }
                foreach ($this->dateList as &$dateItem) {
                    $dateItem['attr']['share_level_list'] = $shareList[$dateItem['date']];
                }
                unset($dateItem);
            }

            $array = ['first', 'second', 'third'];
            $list = [];
            // 佣金固定配比
            if ($goods->share_type == 0) {
                // 详细设置
                foreach ($this->dateList as $dateItem) {
                    if (isset($dateItem['attr']['has_type']['sharePrice']) && $dateItem['attr']['has_type']['sharePrice'] && $dateItem['attr']['attr_id'] == $goodsAttr->id) {
                        foreach ($dateItem['attr']['share_level_list'] as $share) {
                            foreach ($array as $arrayItem) {
                                if (!isset($list[$share['level']][$arrayItem])) {
                                    $list[$share['level']][$arrayItem] = 0;
                                }
                            }

                            $list[$share['level']]['first'] += $share['share_commission_first'];
                            $list[$share['level']]['second'] += $share['share_commission_second'];
                            $list[$share['level']]['third'] += $share['share_commission_third'];
                        }
                    }
                }
            } else {
                // 百分比 
                // 这个计算是在公式计算好后 再交计算分销价
                if ($this->calc && $this->calc['total_price'] > 0) {
                    $totalPrice = 0;
                    foreach ($this->dateList as $dateItem) {
                        $totalPrice += $dateItem['price'] * $this->calc['goods_num'];
                    }

                    foreach ($this->dateList as $dateItem) {
                        if (isset($dateItem['attr']['has_type']['sharePrice']) && $dateItem['attr']['has_type']['sharePrice'] && $dateItem['attr']['attr_id'] == $goodsAttr->id) {
                            foreach ($dateItem['attr']['share_level_list'] as $share) {
                                foreach ($array as $arrayItem) {
                                    if (!isset($list[$share['level']][$arrayItem])) {
                                        $list[$share['level']][$arrayItem] = 0;
                                    }
                                }

                                $totalPayPrice = $dateItem['price'] / $totalPrice * $this->calc['total_price'];

                                if ($share['share_commission_first'] > 0) {
                                    $firstPrice = price_format($totalPayPrice * ($share['share_commission_first'] / 100));
                                    $list[$share['level']]['first'] += $firstPrice;
                                }

                                if ($share['share_commission_second'] > 0) {
                                    $secondPrice = price_format($totalPayPrice * ($share['share_commission_second'] / 100));
                                    $list[$share['level']]['second'] += $secondPrice;
                                }

                                if ($share['share_commission_third'] > 0) {
                                    $thirdPrice = price_format($totalPayPrice * ($share['share_commission_third'] / 100));
                                    $list[$share['level']]['third'] += $thirdPrice;
                                }
                            }
                        }
                    }
                }
            }

            foreach ($list as $key => $item) {
                $shareLevelList[] = [
                    'level' => $key,
                    'share_commission_first' => $item['first'],
                    'share_commission_second' => $item['second'],
                    'share_commission_third' => $item['third'],
                ];
            }

            $this->individual_share = $this->goods->individual_share;
            $this->attr_setting_type = $this->goods->attr_setting_type;
            $this->share_type = 0; // 定制商品只能是固定金额
            foreach ($shareLevelList as $item) {
                $this->goods_share_level[] = [
                    'share_commission_first' => $item['share_commission_first'],
                    'share_commission_second' => $item['share_commission_second'],
                    'share_commission_third' => $item['share_commission_third'],
                    'level' => $item['level'],
                ];
            }
        }
    }
}
