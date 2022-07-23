<?php
/**
 * @copyright ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 * Created by PhpStorm.
 * User: Andy - Wangjie
 * Date: 2020/5/11
 * Time: 15:30
 */

namespace app\plugins\flash_sale\forms\mall;

use app\core\response\ApiCode;
use app\forms\mall\goods\BaseGoodsEdit;
use app\models\GoodsAttr;
use app\plugins\flash_sale\models\FlashSaleGoodsAttr;
use app\plugins\flash_sale\Plugin;
use Exception;
use Yii;

class GoodsEditForm extends BaseGoodsEdit
{
    public $goods_id;
    public $discount;
    public $cut;
    public $type = 1;
    public $isGoodsDetail = false;

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [

            ]
        );
    }

    public function setGoodsSign()
    {
        return (new Plugin())->getName();
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $this->checkData();
                $this->attrValidator();
                $this->attrGroupNameValidator();
                $this->setGoods();
                $this->setAttr();
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

            $this->setGoodsShare();
            $this->setGoodsMemberPrice();         
            $this->setGoodsService();
            $this->setCard();
            $this->setCoupon();
            $this->setListener();

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功'
            ];
        } catch (Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'error' => [
                    'line' => $e->getLine(),
                ]
            ];
        }
    }

    private function checkData()
    {
        if (!$this->goods_warehouse_id) {
            throw new Exception('请先拉取商城商品');
        }

        if ($this->use_attr == 1) {
            $goodsStock = 0;
            foreach ($this->attr as $item) {
                if (!isset($item['price']) || $item['price'] < 0) {
                    throw new Exception('请填写规格价格');
                }
                $goodsStock += $item['stock'];
            }
            if ($goodsStock === '') {
                throw new Exception('请填写规格库存');
            }
        } else {
            if ($this->price < 0 || $this->price === '') {
                throw new Exception('请填写价格');
            }
            $this->discount = $this->attr[0]['extra']['discount'] ?? 10;
            $this->cut = $this->attr[0]['extra']['cut'] ?? 0;
            $this->type = $this->attr[0]['extra']['type'] ?? 1;
        }
    }

    /**
     * @param GoodsAttr $goodsAttr
     * @param $newAttr
     * @throws Exception
     */
    protected function setExtraAttr()
    {
        /**@var FlashSaleGoodsAttr $flashAttr**/
        $flashAttr = FlashSaleGoodsAttr::find()
            ->where(['goods_id' => $this->goods->id, 'is_delete' => 0])
            ->orderBy('id desc')
            ->limit(1)
            ->one();

        FlashSaleGoodsAttr::deleteAll(['goods_id' => $this->goods->id]);

        $newList = [];
        foreach ($this->newAttrs as $newAttr) {
            $discount = $this->use_attr && isset($newAttr['extra']['discount']) ? $newAttr['extra']['discount'] : $this->discount;
            $cut = $this->use_attr && isset($newAttr['extra']['cut']) ? $newAttr['extra']['cut'] : $this->cut;
            $type = $this->use_attr && isset($newAttr['extra']['type']) ? $newAttr['extra']['type'] : $this->type;

            if (!$this->isGoodsDetail) {
                if ($type == 1) {
                    if (!($discount >= 0.1 && $discount <= 10)) {
                        throw new Exception('折扣不合法，折扣必须在0.1折~10折。');
                    }
                } elseif ($type == 2) {
                    if (!is_numeric($cut) || $cut < 0) {
                        throw new Exception('减钱不合法，减钱必须大于等于0。');
                    }
                    if ($cut > $newAttr['price']) {
                        throw new Exception('减钱不合法，减钱不能大于规格价');
                    }
                }
            } else {
                $type = $flashAttr->type;
                if ($type == 1) {
                    $discount = $flashAttr->discount;
                    $cut = $newAttr['price'] - ($newAttr['price'] * $discount / 10);
                } elseif ($type == 2) {
                    $cut = $flashAttr->cut;
                    if ($newAttr['price'] != 0) {
                        $discount = price_format((($newAttr['price'] - $cut) / $newAttr['price']) * 10, 1);
                    } else {
                        $discount = 0;
                    }
                }
            }

            $newList[] = [
                'goods_attr_id' => $this->attrSignList[$newAttr['sign_id']],
                'goods_id' => $this->goods->id,
                'discount' => $discount,
                'cut' => $cut,
                'type' => $type
            ];
        }

        \Yii::$app->db->createCommand()->batchInsert(
            FlashSaleGoodsAttr::tableName(),
            ['goods_attr_id', 'goods_id', 'discount', 'cut', 'type'],
            $newList
        )->execute();
    }

    public function setExtraGoods($goods)
    {
        $this->goods_id = $goods->id;
    }
}
