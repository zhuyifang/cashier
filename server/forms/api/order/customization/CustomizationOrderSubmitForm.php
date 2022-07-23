<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\forms\api\order\customization;

use app\forms\api\order\OrderException;
use app\forms\api\order\OrderSubmitForm;
use app\forms\api\order\customization\CustomizationOrderGoodsAttr;
use app\forms\common\diy\ValueValidateForm;
use app\forms\common\goods\CommonCustomization;
use app\models\FormGoodsAttr;
use app\models\GoodsAttr;
use app\models\MallMembers;
use yii\helpers\ArrayHelper;

class CustomizationOrderSubmitForm extends OrderSubmitForm
{
	private $date = []; // 规格日期
    private $dateList = []; // 需要计算的日期
    private $goods;
    private $appCustomization = [];
    private $dbCustomization = [];
    private $dbButton = [];
    private $memberPriceCalcData = [];
    private $priceData = [];

    private $goodsTotalPrice = 0;
    private $goodsMemberTotalPrice = 0;

    public function setPluginData()
    {
        $this->setEnableFullReduce(true);
        $mallPaymentTypes = \Yii::$app->mall->getMallSettingOne('payment_type');
        $this->setSupportPayTypes($mallPaymentTypes);
        $num = 0;
        $goodsAttrId = 0;
        $goodsId = 0;
        $goodsNumber = 0;// 购买商品的数量
        foreach ($this->form_data['list'] as $item) {
            foreach ($item['goods_list'] as $gItem) {
                if ($num > 1) {
                    throw new \Exception('定制商品只能单独购买');
                }
                $num++;

                $goodsAttrId = $gItem['goods_attr_id'];
                $goodsId = $gItem['id'];
                $this->goods = $this->getGoods($gItem);
                $goodsNumber = $gItem['num'];
            }

            if (!$this->isBasic()) {
                $this->date = json_decode($item['date'], true);
                $dateList = [];
                foreach ($this->date['data'] as $dateItem) {
                    foreach ($dateItem as $key => $value) {
                        $formGoodsAttr = FormGoodsAttr::find()->andWhere([
                            'goods_id' => $goodsId,
                            'attr_id' => $goodsAttrId,
                            'date' => $key
                        ])->one();

                        if (!$formGoodsAttr) {
                            throw new \Exception('定制规格不存在');
                        }

                        $formGoodsAttr->member_price = json_decode($formGoodsAttr->member_price, true);
                        $formGoodsAttr->share_level_list = json_decode($formGoodsAttr->share_level_list, true);
                        $formGoodsAttr->has_type = json_decode($formGoodsAttr->has_type, true);

                        $dateList[] = [
                            'date' => $key,
                            'price' => $formGoodsAttr->price,
                            'attr' => ArrayHelper::toArray($formGoodsAttr)
                        ];
                    }
                }

                $formGoods = $this->goods->formGoods;
                // 跨天去除最后一天
                if ($formGoods->has_kuatian) {
                    array_pop($dateList);
                    // 最后一天价格改为0
                    $item = $this->date['data'][count($this->date['data']) - 1];
                    foreach ($item as $key => $value) {
                        $item[$key] = 0;
                    }
                    $this->date['data'][count($this->date['data']) - 1] = $item;
                }
                $after = (int)date('m', strtotime($this->date['after'])) . '月';
                $afterDay = (int)date('d', strtotime($this->date['after'])) . '号';
                $before = (int)date('m', strtotime($this->date['before'])) . '月';
                $beforeDay = (int)date('d', strtotime($this->date['before'])) . '号';


                $this->date['new_after'] = $after . $afterDay;
                $this->date['new_before'] = $before . $beforeDay;
                $this->date['day'] = count($dateList);
                $this->date['place_unit'] = $formGoods->place_unit;
                $this->date['is_alone'] = $formGoods->is_alone;

                $this->dateList = $dateList;
            }
        }

        // 日期商品单价
        $priceData = $this->getFormGoodsUnitPrice($goodsAttrId);
        $this->priceData = $priceData;

        if (!$this->isBasic()) {
            $this->goodsTotalPrice = $priceData['godos_unit_price'] * $goodsNumber;
            $this->goodsMemberTotalPrice = $priceData['godos_unit_member_price'] * $goodsNumber;
        }

        if ($this->isCustomization()) {
            // 数据库表单数据
            $this->dbCustomization = json_decode($this->goods->formGoods->customization_data, true)['form_data'];
            foreach ($this->dbCustomization as $key => $value) {
                if ($value['id'] == 'form-goods-button') {
                    $this->dbButton = $value['data'];
                }
            }

            // 小程序端表单数据
            $key = 'GOODS_FORM_' . \Yii::$app->user->id;
            $customization = json_decode(\Yii::$app->redis->get($key), true);
            if (!$customization) {
                throw new OrderException('请返回上一页重新提交'); 
            }
            $this->appCustomization = $customization['form_data'];

            $calcData = (new ValueValidateForm())->getCalcData(
                $priceData['godos_unit_price'] * $goodsNumber,
                $priceData['godos_unit_price'],
                $goodsNumber,
                $this->appCustomization, 
                $this->dbCustomization
            );

            // 处理公式计算价格
            $memberPriceCalcData = (new ValueValidateForm())->getCalcData(
                $priceData['godos_unit_member_price'] * $goodsNumber,
                $priceData['godos_unit_member_price'],
                $goodsNumber,
                $this->appCustomization, 
                $this->dbCustomization
            );
            $this->memberPriceCalcData = $memberPriceCalcData;
            $this->goodsTotalPrice = $calcData['total_price'];
            $this->goodsMemberTotalPrice = $memberPriceCalcData['total_price'];
        }
        
        return $this;
    }

    // 获取商品单价
    public function getFormGoodsUnitPrice($goodsAttrId)
    {
        $user = $this->getUser();
        $member = MallMembers::findOne([
            'level' => $user->identity->member_level,
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0,
        ]);
        $goodsUnitMemberPrice = 0;
        $goodsUnitPrice = 0;
        $discountName = null;
        if (!$this->isBasic()) {
            foreach ($this->dateList as $dItem) {
                if ($member && $this->goods->is_level_alone && $this->goods->is_level) {
                    $key = sprintf('level%s', $member->level);
                    if (isset($dItem['attr']['has_type']['memberPrice']) && $dItem['attr']['has_type']['memberPrice'] && isset($dItem['attr']['member_price'][$key])) {

                        $goodsUnitMemberPrice += $dItem['attr']['member_price'][$key];
                    }
                    $discountName = '会员价优惠';
                } elseif ($this->goods->is_level && $member && $member->discount) {
                    if (!($member->discount >= 0.1 && $member->discount <= 10)) {
                        throw new OrderException('会员折扣率不合法，会员折扣率必须在1折~10折。');
                    }
                    $goodsPrice = $dItem['price'];
                    if (!is_numeric($goodsPrice) || $goodsPrice < 0) {
                        throw new OrderException('商品金额不合法，商品金额必须是数字且大于等于0元。');
                    }
                    $goodsUnitMemberPrice += $goodsPrice * $member->discount / 10;
                    $discountName = '会员折扣优惠';
                } else {
                    $goodsUnitMemberPrice += $dItem['price'];
                }
                $goodsUnitPrice += $dItem['price'];
            }
        } else {
            /* @var GoodsAttr $goodsAttr */
            $goodsAttr = GoodsAttr::find()->with('share')
                ->where(['id' => $goodsAttrId, 'goods_id' => $this->goods->id, 'is_delete' => 0])
                ->with('memberPrice')
                ->one();
            if (!$goodsAttr) {
                throw new \Exception('无法查询到规格信息。');
            }

            if ($member && $this->goods->is_level_alone && $this->goods->is_level) {
                foreach ($goodsAttr->memberPrice as $memberItem) {
                    if ($member->level == $memberItem->level) {
                        $goodsUnitMemberPrice = $memberItem->price;
                    }
                }
                $discountName = '会员价优惠';
            } elseif ($this->goods->is_level &&$member && $member->discount) {
                if (!($member->discount >= 0.1 && $member->discount <= 10)) {
                    throw new OrderException('会员折扣率不合法，会员折扣率必须在1折~10折。');
                }
                $goodsPrice = $goodsAttr->price;
                if (!is_numeric($goodsPrice) || $goodsPrice < 0) {
                    throw new OrderException('商品金额不合法，商品金额必须是数字且大于等于0元。');
                }
                $goodsUnitMemberPrice = $goodsPrice * $member->discount / 10;
                $discountName = '会员折扣优惠';
            } else {
                $goodsUnitMemberPrice = $goodsAttr->price;
            }
            $goodsUnitPrice = $goodsAttr->price;
        }

        return [
            'discount_name' => $discountName,
            'godos_unit_price' => $goodsUnitPrice,
            'godos_unit_member_price' => $goodsUnitMemberPrice,
        ];
    }

    /**
     * 会员优惠（会员价和会员折扣）
     * @param $mchItem
     * @return mixed
     * @throws OrderException
     */
    protected function setMemberDiscountData($mchItem)
    {
        $memberDiscount = price_format($this->goodsTotalPrice - $this->goodsMemberTotalPrice);
        $mchItem['member_discount'] = $memberDiscount;

        if ($memberDiscount > 0) {
            $mchItem['goods_list'][0]['discounts'][] = [
                'name' => $this->priceData['discount_name'],
                'value' => $memberDiscount >= 0 ?
                    ('-' . price_format($memberDiscount))
                    : ('+' . price_format(0 - $memberDiscount))
            ];
            $mchItem['goods_list'][0]['member_discount'] = price_format($memberDiscount);
        }
        
        return $mchItem;
    }

    // 传统模式 | 日历模式
    private function isBasic()
    {
        if ($this->goods->formGoods->form_mode_type == 'basic') {
            return true;
        } else {
            return false;
        }
    }

    private function isCustomization()
    {
        if ($this->goods->formGoods->customization_status == 1) {
            return true;
        } else {
            return false;
        }
    }

    protected function getGoodsItemData($item)
    {
        $itemData = parent::getGoodsItemData($item);

        $itemData['total_original_price'] = $this->goodsTotalPrice;
        $itemData['total_price'] = $this->goodsMemberTotalPrice;

        return $itemData;
    }

    /**
     * @return OrderGoodsAttr OrderGoodsAttr
     * 商品规格类
     */
    public function getGoodsAttrClass()
    {
        $attrClass = new CustomizationOrderGoodsAttr();
        $attrClass->dateList = $this->dateList;
        $attrClass->select_date = $this->date;
        $attrClass->customization = $this->appCustomization;
        $attrClass->calc = $this->memberPriceCalcData;
        $attrClass->setFormGoods($this->goods->formGoods);

        return $attrClass;
    }

    /**
     * 商品库存操作
     * @param OrderGoodsAttr $goodsAttr
     * @param int $subNum
     * @param array $goodsItem
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function subGoodsNum($goodsAttr, $subNum, $goodsItem)
    {
        if ($this->isBasic()) {
            parent::subGoodsNum($goodsAttr, $subNum, $goodsItem);
        } else {
            CommonCustomization::getCommon()->updateStock($subNum, 'sub', $this->dateList, $this->goods->id);
        }
    }

    /**
     * 检查商品库存是否充足
     * @param array $goodsList [ ['id','name',''] ]
     * @throws OrderException
     */
    public function checkGoodsStock($goodsList)
    {
        if ($this->isBasic()) {
            parent::checkGoodsStock($goodsList);
        } else {
            foreach ($goodsList as $goods) {
                if ($goods['num'] <= 0) {
                    throw new OrderException('商品' . $goods['name'] . '数量不能小于0');
                }
                if (!empty($goods['goods_attr'])) {
                    foreach ($goods['goods_attr']['dateList'] as $item) {
                        if ($goods['num'] > $item['attr']['stock']) {
                            throw new OrderException('商品库存不足: ' . $goods['name']);
                        }
                    }
                }
            }
        }
    }
}