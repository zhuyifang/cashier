<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\diy\forms\api\form;


use app\forms\mall\goods\BaseGoodsEdit;
use app\helpers\PluginHelper;
use app\models\Goods;
use app\models\GoodsAttr;
use app\models\GoodsWarehouse;
use app\models\Model;
use app\plugins\diy\Plugin;
use app\plugins\vip_card\models\VipCardAppointGoods;

class GoodsEditForm extends BaseGoodsEdit
{
    public $goods;

    private $diy_goods_pic;

    public function rules()
    {
        return [];
    }

    protected function setGoodsSign()
    {
        // TODO: Implement setGoodsSign() method.
    }

    public function save()
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $pluginName = (new Plugin())->getName();
            $baseUrl = PluginHelper::getPluginBaseAssetsUrl($pluginName) . '/images/';
            $this->diy_goods_pic = $baseUrl . 'goods/new-goods-pic.png';

            try {
                $shareData = \Yii::$app->serializer->decode($this->goods);
            } catch (\Exception $exception) {
                $shareData = [];
            }

            $goods = Goods::find()->where([
                'sign' => $pluginName, 
                'mall_id' => \Yii::$app->mall->id, 
                'is_delete' => 0
            ])
                ->with('shareLevel')
                ->one();

            // 兼容数据
            if ($goods && $goods->status == 0) {
                $goods->status = 1;
                $res = $goods->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($goods));
                }
            }

            if (!$goods) {
                $goodsWarehouse = new GoodsWarehouse();
                $goodsWarehouse->mall_id = \Yii::$app->mall->id;
                $goodsWarehouse->name = 'DIY表单';
                $goodsWarehouse->detail = 'DIY表单';
                $goodsWarehouse->cover_pic = $this->diy_goods_pic;
                $goodsWarehouse->pic_url = json_encode([
                    [
                        'id' => 0,
                        'pic_url' => $this->diy_goods_pic
                    ]
                ]);
                $res = $goodsWarehouse->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($goodsWarehouse));
                }

                $attr = $this->defaultAttr();
                $goods = new Goods();
                $goods->mall_id = \Yii::$app->mall->id;
                $goods->goods_warehouse_id = $goodsWarehouse->id;
                $goods->attr_groups = \Yii::$app->serializer->encode($attr['attr_groups']);
                $goods->freight_id = 0;
                $goods->individual_share = 0;
                $goods->use_attr = 0;
                $goods->sign = $pluginName;
                $goods->status = 1;

                $res = $goods->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($goods));
                }

                $goodsAttr = new GoodsAttr();
                $goodsAttr->goods_id = $goods->id;
                $goodsAttr->sign_id = $attr['sign_id'];
                $res = $goodsAttr->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($goodsAttr));
                }
            }

            try {
                $permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
                if (in_array('vip_card', $permission)) {
                    $exist = VipCardAppointGoods::findOne(['goods_id' => $goods->id]);
                    if (!$exist) {
                        $vModel = new VipCardAppointGoods();
                        $vModel->goods_id = $goods->id;
                        $vModel->save();
                    }
                }
            }catch(\Exception $exception) {

            }

            $goods = $this->updateGoodsPic($goods);

            $transaction->commit();
            return $goods;

        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::error('DIY商品异常----->' . $e->getMessage());
            // TODO 可不抛出异常
            throw $e;
        }
    }

    private function updateGoodsPic($goods)
    {
        if (substr($goods->goodsWarehouse->cover_pic, -13, 13) == 'goods-pic.png') {
            try {
                $baseUrl = PluginHelper::getPluginBaseAssetsUrl('diy') . '/images/';
                $imageUrl = $baseUrl . 'goods/new-goods-pic.png';

                $goods->goodsWarehouse->cover_pic = $imageUrl;
                $picUrl = json_decode($goods->goodsWarehouse->pic_url, true);
                foreach ($picUrl as $key => &$value) {
                    $value['pic_url'] = $imageUrl;
                }
                $goods->goodsWarehouse->pic_url = json_encode($picUrl);
                $goods->goodsWarehouse->save();
            }catch(\Exception $exception) {

            }
        }

        return $goods;
    }

    private function defaultAttr()
    {
        $attrList = [
            [

                'attr_group_name' => '规格',
                'attr_group_id' => 1,
                'attr_id' => 1,
                'attr_name' => '默认',
            ]
        ];

        $count = 1;
        $attrGroups = [];
        foreach ($attrList as &$item) {
            $item['attr_group_id'] = $count;
            $count++;
            $item['attr_id'] = $count;
            $count++;
            $newItem = [
                'attr_group_id' => $item['attr_group_id'],
                'attr_group_name' => $item['attr_group_name'],
                'attr_list' => [
                    [
                        'attr_id' => $item['attr_id'],
                        'attr_name' => $item['attr_name']
                    ]
                ]
            ];
            $attrGroups[] = $newItem;
        }
        unset($item);

        // 未使用规格 就添加一条默认规格
        $newAttrs = [
            [
                'attr_list' => $attrList,
                'stock' => 0,
                'price' => 0,
                'no' => '',
                'weight' => 0,
                'pic_url' => $this->diy_goods_pic,
            ]
        ];

        $signIds = '';
        foreach ($attrList as $aLItem) {
            $signIds .= $signIds ? ':' . (int)$aLItem['attr_id'] : (int)$aLItem['attr_id'];
        }

        return [
            'attr_groups' => $attrGroups,
            'attrs' => $newAttrs,
            'sign_id' => $signIds,
        ];
    }
}