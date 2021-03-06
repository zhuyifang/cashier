<?php

namespace app\plugins\community\forms\mall;

use app\core\response\ApiCode;
use app\forms\mall\goods\BaseGoodsEdit;
use app\plugins\community\models\CommunityActivity;
use app\plugins\community\models\CommunityGoods;
use app\plugins\community\models\CommunityGoodsAttr;
use app\plugins\community\Plugin;
use yii\db\Exception;

class GoodsEditForm extends BaseGoodsEdit
{
    public $goods_id;
    public $supply_price;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['supply_price'], 'number', 'min' => 0],
            [['supply_price'], 'number', 'max' => 9999999]
        ]);
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
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
            $this->setCard();
            $this->setCoupon();

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'data' => $e->getTraceAsString()
            ];
        }
    }

    public function setExtraGoods($goods)
    {
        $this->goods_id = $goods->id;

    }

    protected function setGoodsSign()
    {
        return (new Plugin())->getName();
    }

    /**
     * 供货价表数据比对操作
     * @throws Exception
     */
    protected function setAttr()
    {
        //判断供货价是否大于售价
        if ((int)$this->use_attr === 0) {
            if ($this->price < $this->supply_price) {
                throw new Exception('供货价不能大于购买价');
            }
        }

        parent::setAttr(); // TODO: Change the autogenerated stub
    }

    protected function setDefaultAttr()
    {
        parent::setDefaultAttr(); // TODO: Change the autogenerated stub
        //判断供货价是否大于售价
        if ($this->price < $this->supply_price) {
            $this->supply_price = $this->price;
//            throw new Exception('供货价不能大于售价');
        }
        $this->newAttrs[0]['supply_price'] = empty($this->supply_price) ? $this->price : $this->supply_price;
    }

    /**
     * 添加/修改供货价
     * @param $goodsAttr
     * @param $newAttr
     * @return array|bool
     */

    protected function setExtraAttr()
    {
        try {
            CommunityGoodsAttr::deleteAll(['goods_id' => $this->goods->id]);

            $newList = [];
            foreach ($this->newAttrs as $newAttr) {
                //判断供货价是否大于售价
                if ((!$this->isNewRecord && $newAttr['price'] < $newAttr['supply_price']) || ($this->isNewRecord && !isset($newAttr['supply_price']))) {
                    $newAttr['supply_price'] = $newAttr['price'];
                }
                $newList[] = [
                    'goods_id' => $this->goods->id,
                    'attr_id' => $this->attrSignList[$newAttr['sign_id']],
                    'supply_price' => $newAttr['supply_price']
                ];
            }

            \Yii::$app->db->createCommand()->batchInsert(
                CommunityGoodsAttr::tableName(),
                ['goods_id', 'attr_id', 'supply_price'],
                $newList
            )->execute();

            return true;
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
            ];
        }
    }
}
