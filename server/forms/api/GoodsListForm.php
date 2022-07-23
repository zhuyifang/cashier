<?php

namespace app\forms\api;

use app\core\exceptions\ClassNotFoundException;
use app\core\response\ApiCode;
use app\forms\common\coupon\CommonCoupon;
use app\forms\common\goods\CommonGoodsList;
use app\models\Mall;
use app\models\Model;
use app\plugins\flash_sale\models\FlashSaleActivity;
use app\plugins\flash_sale\models\FlashSaleGoods;
use app\plugins\pintuan\models\PintuanGoods;

class GoodsListForm extends Model
{
    public $cat_id;
    public $sort;
    public $sort_type;
    public $keyword;
    public $page;
    public $mch_id;
    public $coupon_id;
    public $is_search;

    public function rules()
    {
        return [
            [['page'], 'default', 'value' => 1],
            [['is_search'], 'default', 'value' => 0],
            [['mch_id'], 'integer'],
        ];
    }

    public function search()
    {
        try {
            $form = new class extends CommonGoodsList {
                //持续改进
                public function pluginWhere()
                {
                    $sign = $this->sign;
                    if ($sign) {
                        $andWhere = [];
                        if ((is_array($sign) && false !== array_search('flash_sale', $sign)) || (
                                is_string($sign) && $sign === 'flash_sale'
                            )) {
                            if ((is_array($sign) && false !== $k = array_search('flash_sale', $sign))) {
                                unset($sign[$k]);
                                sort($sign);
                            }

                            try {
                                \Yii::$app->plugin->getPlugin('flash_sale');

                                $activeIds = FlashSaleActivity::find()->select('id')->where([
                                    'AND',
                                    ['status' => 1],
                                    ['is_delete' => 0],
                                    ['<', 'start_at', date('Y-m-d H:i:s')],
                                    ['>', 'end_at', date('Y-m-d H:i:s')],
                                ])->asArray()->column();
                                $goodsIds = FlashSaleGoods::find()->select('goods_id')->where(['activity_id' => $activeIds])->asArray()->column();
                                array_push($andWhere, ['g.sign' => 'flash_sale', 'g.id' => $goodsIds]);
                            } catch (\Exception $e) {
                            }
                        }
                        if ((is_array($sign) && false !== array_search('pintuan', $sign)) || (
                                is_string($sign) && $sign === 'pintuan'
                            )) {
                            if (is_array($sign) && false !== $k = array_search('pintuan', $sign)) {
                                unset($sign[$k]);
                                sort($sign);
                            }
                            try {
                                \Yii::$app->plugin->getPlugin('pintuan');
                                $ptIds = PintuanGoods::find()->select('goods_id')->where(['is_delete' => 0])->asArray()->column();
                                array_push($andWhere, ['g.sign' => 'pintuan', 'g.id' => $ptIds]);
                            } catch (\Exception $e) {
                            }
                        }
                        if (
                            (is_array($sign) && false !== array_search('weekly_buy', $sign))
                            || (is_string($sign) && $sign === 'weekly_buy')
                        ) {
                            if (is_array($sign) && false !== $k = array_search('weekly_buy', $sign)) {
                                unset($sign[$k]);
                                sort($sign);
                            }
                            try {
                                \Yii::$app->plugin->getPlugin('weekly_buy');
                                $weeklyBuyGoodsIds = \app\plugins\weekly_buy\models\WeeklyBuyGoods::find()
                                    ->select('goods_id')
                                    ->where([
                                        'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'weekly_buy_goods_id' => 0
                                    ])->andWhere(['<=', 'start_time', mysql_timestamp()])
                                    ->andWhere(['>', 'end_time', mysql_timestamp()])
                                    ->column();
                                array_push($andWhere, ['g.sign' => 'weekly_buy', 'g.id' => $weeklyBuyGoodsIds]);
                            } catch (ClassNotFoundException $e) {
                                \Yii::error($e);
                            }
                        }
                        if (empty($andWhere)) {
                            $this->query->andWhere(['g.sign' => $sign]);
                        } else {
                            $this->query->andWhere(array_merge(['OR'], $andWhere, [['g.sign' => $sign]]));
                        }
                    } else {
                        $this->query->andWhere(['g.sign' => $sign]);
                    }
                }
            };
            /////////////////////////////////////////////////////////////
            if ($this->coupon_id && is_numeric($this->coupon_id)) {
                $commonCoupon = new CommonCoupon([
                    'mall' => \Yii::$app->mall,
                ], false);
                $commonCoupon->coupon_id = $this->coupon_id;
                $coupon = $commonCoupon->getDetail();
                if ($coupon->appoint_type == 2) {
                    $goodsWarehouseList = $coupon->goods;
                    $goodsWarehouseId = [];
                    foreach ($goodsWarehouseList as $goodsWarehouse) {
                        $goodsWarehouseId[] = $goodsWarehouse->id;
                    }
                    $form->goodsWarehouseId = $goodsWarehouseId;
                } elseif ($coupon->appoint_type == 1) {
                    $catList = $coupon->cat;
                    $this->cat_id = [];
                    foreach ($catList as $cats) {
                        $this->cat_id[] = $cats->id;
                    }
                }
                $form->cat_id = $this->cat_id;
            } else {
                $form->cat_id = is_numeric($this->cat_id) ? $this->cat_id : 0;
            }
            $form->sort = $this->sort;
            $form->status = 1;
            $form->sort_type = $this->sort_type;
            $form->keyword = $this->keyword;
            $form->page = $this->page;
            $form->mch_id = $this->mch_id ?: 0;
            $form->is_array = true;
            $form->mch_id && $this->sign = 'mch';
            $form->sign = $this->sign ? $this->sign === 'mall' ? [''] : $this->sign : ['mch', ''];
            if ($this->is_search == 1 && is_array($form->sign)) {
                array_push($form->sign, 'pintuan', 'wholesale', 'flash_sale', 'exchange', 'booking', 'advance', 'weekly_buy');
            }
            $form->isSignCondition = true;
            $form->is_sales = (new Mall())->getMallSettingOne('is_sales');
            $form->relations = ['goodsWarehouse', 'mallGoods', 'attr'];
            $form->deleteAttr = true;
            $form->is_show = 1;
            $list = $form->getList();
            $pintuanGoodsId = '';
            foreach ($list as $item) {
                if($item['sign'] == 'pintuan') {
                    if($pintuanGoodsId == $item['goods_warehouse_id']) {
                        $re = array_search($item, $list);
                        unset($list[$re]);
                    }else {
                        $pintuanGoodsId = $item['goods_warehouse_id'];
                    }
                }
            };
            $pintuanGoodsId = '';
            foreach ($list as $item) {
                if($item['sign'] == 'advance') {
                    if($pintuanGoodsId == $item['goods_warehouse_id']) {
                        $re = array_search($item, $list);
                        unset($list[$re]);
                    }else {
                        $pintuanGoodsId = $item['goods_warehouse_id'];
                    }
                }
            };
            $list = array_values($list);
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'data' => [
                    'list' => $list,
                    'pagination' => $form->pagination,
                ]
            ];
        } catch (\Exception $e) {
            dd($e);
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage()
            ];
        }
    }
}
