<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/14
 * Time: 10:33 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api;

use app\forms\api\order\OrderException;
use app\forms\common\CommonMallMember;
use app\models\GoodsAttr;
use app\plugins\weekly_buy\forms\common\CommonSetting;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\common\week_status\WeekStatusFactory;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyGroups;
use app\plugins\weekly_buy\models\WeeklyBuyOrderDetail;
use app\plugins\weekly_buy\Plugin;

class OrderSubmitForm extends \app\forms\api\order\OrderSubmitForm
{
    /**
     * @var WeeklyBuyGoods $weeklyBuyGoods
     */
    protected $weeklyBuyGoods;
    // 期数
    protected $week_number;

    public function setPluginData()
    {
        $setting = CommonSetting::getInstance()->getSetting();
        $mallPaymentTypes = \Yii::$app->mall->getMallSettingOne('payment_type');
        if (($balanceKey = array_search('huodao', $mallPaymentTypes)) !== false) {
            unset($mallPaymentTypes[$balanceKey]);
        }
        $this->setSign((new Plugin())->getName())->setEnableMemberPrice($setting['is_member_price'])
            ->setEnableAddressEnable($setting['is_territorial_limitation'])->setEnableIntegral($setting['is_integral'])
            ->setEnableCoupon($setting['is_coupon'])->setEnableFullReduce($setting['is_full_reduce'])
            ->setEnableVipPrice($setting['svip_status'])->setSupportPayTypes($mallPaymentTypes);
        return $this;
    }

    public function getGoodsItemData($item)
    {
        $itemData = parent::getGoodsItemData($item);
        $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstance();
        $commonWeeklyBuyGoods->weeklyBuyGoods = $this->weeklyBuyGoods;
        $weekStatus = WeekStatusFactory::create($this->weeklyBuyGoods->week_type);
        $itemData['goods_attr']->week_key = $weekStatus->getWeekKey($commonWeeklyBuyGoods, $item['week_key']);
        $leastTime = $weekStatus->leastTime($commonWeeklyBuyGoods, $itemData['goods_attr']->week_key);
        $sendTimeTip = sprintf('%s首次配送', date('Y-m-d', $leastTime));
        if ($commonWeeklyBuyGoods->isBeforeTime()) {
            $sendTimeTip = sprintf('%d点前付款 %s', $this->weeklyBuyGoods->last_time, $sendTimeTip);
        }
        $itemData['plugin'] = [
            'send_week' => sprintf('%s，共%d期', $weekStatus->typeName($this->weeklyBuyGoods), $this->week_number),
            'send_time' => $weekStatus->orderText($commonWeeklyBuyGoods, $itemData['goods_attr']->week_key),
            'send_time_tip' => $sendTimeTip,
            'week_number' => $this->week_number,
            'type_list' => explode(',', $itemData['goods_attr']->week_key),
            'week_val' => $weekStatus->getItem($commonWeeklyBuyGoods, $itemData['goods_attr']->week_key),
            'week_type' => $this->weeklyBuyGoods->week_type
        ];
        return $itemData;
    }

    public function checkGoods($goods, $item)
    {
        $this->weeklyBuyGoods = WeeklyBuyGoods::findOne([
            'goods_id' => $item['id'], 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id
        ]);
        if (!$this->weeklyBuyGoods) {
            throw new OrderException('商品有更新，请重新选择');
        }
        if ($this->weeklyBuyGoods->start_time > mysql_timestamp()) {
            throw new OrderException('商品未开始售卖');
        }
        if ($this->weeklyBuyGoods->is_no_end_time == 0 && $this->weeklyBuyGoods->end_time < mysql_timestamp()) {
            throw new OrderException('商品已结束售卖');
        }
        $group = WeeklyBuyGroups::findOne([
            'is_delete' => 0, 'goods_id' => $this->weeklyBuyGoods->goods_id
        ]);
        if (!$group) {
            throw new OrderException('商品期数选择错误，请重新选择');
        }
        $this->week_number = $group->number;
        return true;
    }

    public function whiteList()
    {
        return [(new Plugin())->getName()];
    }

    public function getGoodsAttrClass()
    {
        $form = new OrderGoodsAttr();
        $form->weeklyBuyGoods = $this->weeklyBuyGoods;
        $form->week_number = $this->week_number;
        return $form;
    }

    public function getNeedPostageGoodsList($mchItem)
    {
        $needPostageGoodsList = [];
        switch ($this->weeklyBuyGoods->shipping_type) {
            case 2:
                if ($mchItem['goods_list'][0]['total_original_price'] < $this->weeklyBuyGoods->shipping_price) {
                    $needPostageGoodsList[] = $mchItem['goods_list'][0];
                }
                break;
            case 1:
                if ($this->week_number < $this->weeklyBuyGoods->shipping_number) {
                    $needPostageGoodsList[] = $mchItem['goods_list'][0];
                }
                break;
            default:
                $needPostageGoodsList[] = $mchItem['goods_list'][0];
        }
        return $needPostageGoodsList;
    }

    protected function setExpressData($mchItem)
    {
        $mchItem['single_express_price'] = 0;
        $mchItem['express_price'] = 0;
        $mchItem['freight_type'] = $this->weeklyBuyGoods->freight_type;
        $mchItem['city_freight_type'] = $this->weeklyBuyGoods->city_freight_type;
        return parent::setExpressData($mchItem);
    }

    protected function setExpressExpressData($mchItem)
    {
        if ($this->weeklyBuyGoods->freight_type == 1) {
            $address = $this->getAddress();
            $mchItem['address'] = $address;
            if (!$address) {
                $mchItem['city']['error'] = '未选择收货地址';
                return $mchItem;
            }
            /** @var array 需要计算运费的商品列表 */
            $needPostageGoodsList = $this->getNeedPostageGoodsList($mchItem);
            if (!empty($needPostageGoodsList)) {
                $mchItem['express_price'] = $this->weeklyBuyGoods->freight;
                $mchItem['single_express_price'] = $this->weeklyBuyGoods->freight;
            }
        } else {
            $mchItem = parent::setExpressExpressData($mchItem);
            $mchItem['single_express_price'] = floatval($mchItem['express_price']);
            $mchItem['express_price'] = price_format(floatval($mchItem['express_price']) * $this->week_number);
        }
        return $mchItem;
    }

    protected function setCityExpressData($mchItem)
    {
        $mchItem = parent::setCityExpressData($mchItem);
        if ($this->weeklyBuyGoods->city_freight_type == 1) {
            $mchItem['single_express_price'] = $this->weeklyBuyGoods->city_freight;
            $mchItem['express_price'] = $this->weeklyBuyGoods->city_freight;
        } else {
            $mchItem['single_express_price'] = floatval($mchItem['express_price']);
            $mchItem['express_price'] = price_format(floatval($mchItem['express_price']) * $this->week_number);
        }
        if (
            (
                $this->weeklyBuyGoods->city_shipping_type == 1
                && $this->weeklyBuyGoods->city_shipping_number < $this->week_number
            )
            ||
            (
                $this->weeklyBuyGoods->city_shipping_type == 2
                && $mchItem['goods_list'][0]['total_original_price'] >= $this->weeklyBuyGoods->city_shipping_price
            )
        ) {
            $mchItem['single_express_price'] = 0;
            $mchItem['express_price'] = 0;
        }
        return $mchItem;
    }

    /**
     * @param OrderGoodsAttr $goodsAttr
     * @param int $subNum
     * @param array $goodsItem
     * @throws \yii\db\Exception
     */
    public function subGoodsNum($goodsAttr, $subNum, $goodsItem)
    {
        $subNum = $goodsAttr->week_number * $subNum;
        (new GoodsAttr())->updateStock($subNum, 'sub', $goodsAttr->mainGoodsAttrId);
    }

    protected function getGoodsAttrMemberPrice($goodsAttr, $memberLevel)
    {
        $goodsMemberPrice = CommonMallMember::getGoodsAttrMemberPrice($goodsAttr->goodsAttr, $memberLevel);
        // $goodsMemberPrice 有可能为空
        return $goodsMemberPrice ? $goodsMemberPrice->price * $this->week_number : null;
    }

    public function extraGoodsDetail($order, $goodsItem)
    {
        $orderDetail = parent::extraGoodsDetail($order, $goodsItem);
        $model = new WeeklyBuyOrderDetail();
        $model->mall_id = \Yii::$app->mall->id;
        $model->order_id = $orderDetail->order_id;
        $model->order_detail_id = $orderDetail->id;
        $model->week_number = $this->week_number;
        $model->week_key = (string)$goodsItem['goods_attr']['week_key'];
        $model->actual_week_number = 0;
        $model->num = $this->week_number * $orderDetail->num;
        $model->sent_num = 0;
        $model->main_goods_id = $goodsItem['goods_attr']['mainGoodsId'];
        $model->main_goods_attr_id = $goodsItem['goods_attr']['mainGoodsAttrId'];
        if (!$model->save()) {
            throw new OrderException($this->getErrorMsg($model));
        }
        return $orderDetail;
    }

    public function checkGoodsStock($goodsList)
    {
        foreach ($goodsList as $goods) {
            if ($goods['num'] <= 0) {
                throw new OrderException('商品' . $goods['name'] . '数量不能小于0');
            }
            if (!empty($goods['goods_attr'])) {
                /** @var GoodsAttr $goodsAttr */
                $goodsAttr = $goods['goods_attr'];
                if ($goods['num'] * $this->week_number > $goodsAttr->stock) {
                    throw new OrderException('商品库存不足: ' . $goods['name']);
                }
            }
        }
    }
}
