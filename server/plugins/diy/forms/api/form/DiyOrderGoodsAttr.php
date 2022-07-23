<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/5/8
 * Time: 17:08
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\api\form;

use app\forms\api\order\OrderException;
use app\forms\api\order\OrderGoodsAttr;
use app\forms\common\ecard\CommonEcard;
use app\models\GoodsAttr;


class DiyOrderGoodsAttr extends OrderGoodsAttr
{
    public $buttonData;
    public $attr_key;
    public $new_price;
    public $day;

    /**
     * @param GoodsAttr $goodsAttr
     * @throws \Exception
     */
    public function setGoodsAttr($goodsAttr)
    {
        if (!$goodsAttr instanceof GoodsAttr) {
            throw new \Exception('参数$goodsAttr必须是app\models\GoodsAttr的一个实例');
        }

        $priceData = $this->getDiyPriceData();
        $goodsAttr->stock = $priceData['stock_num'];
        $goodsAttr->price = $priceData['pay_price'];
        $goodsAttr->pic_url = $this->cover_pic;


        $this->goodsAttr = $goodsAttr;
        $this->attributes = $goodsAttr->attributes;
        $this->original_price = $priceData['pay_price'] * $this->day;
        $this->discount = [];
        $this->extra = $this->getAttrExtra();
        $this->setShare();
        $this->stock = CommonEcard::getCommon()->getEcardStock($this->stock, $this->goods);
    }

    public function setShare()
    {
        $goodsAttr = $this->goodsAttr;
        $this->is_share = 1;
        $this->individual_share = $this->buttonData['individual_share'];
        $this->attr_setting_type = $this->buttonData['attr_setting_type'];
        $this->share_type = $this->buttonData['share_type'];
        $shareLevelList = $this->getDiyPriceData()['share_level_list'];
        foreach ($shareLevelList as $item) {
            $this->goods_share_level[] = [
                'share_commission_first' => $item['share_commission_first'],
                'share_commission_second' => $item['share_commission_second'],
                'share_commission_third' => $item['share_commission_third'],
                'level' => $item['level'],
            ];
        }
    }

    private function getDiyPriceData()
    {
        $shareLevelList = $this->buttonData['shareLevelList'];
        switch ($this->buttonData['pay_status']) {
            case 'alone':
                $payPrice = $this->buttonData['pay_price'];
                // 自定义价格
                if ($this->buttonData['pay_update'] == 1 && $this->new_price) {
                    $payPrice = $this->new_price;
                }
                $stockNum = $this->buttonData['stock_num'];
                break;
            case 'much':
                $sign = false;
                foreach ($this->buttonData['pay_price_list'] as $pItem) {
                    if ($this->attr_key == $pItem['key']) {
                        $sign = true;
                        $payPrice = $pItem['pay_price'];
                        $stockNum = $pItem['stock_num'];

                        break;
                    }
                }

                if (!$sign) {
                    throw new OrderException('支付价格异常');
                }
                break;
            
            default:
                throw new \Exception('未知价格类型');
                
                break;
        }

        return [
            'share_level_list' => $shareLevelList,
            'pay_price' => $payPrice,
            'stock_num' => $stockNum
        ];
    }
}
