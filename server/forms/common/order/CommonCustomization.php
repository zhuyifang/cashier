<?php

namespace app\forms\common\order;

use app\events\OrderEvent;
use app\models\FormGoodsAttr;
use app\models\Goods;
use app\models\GoodsAttr;
use app\models\Mall;
use app\models\Order;
use app\models\OrderDetail;

class CommonCustomization
{
    private static $instance;
    private $mall_id;
    private $mch_id;

    private function __construct(){
        $this->setMallId();
        $this->setMchId();
    }

    public static function getCommon()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function setMallId($mall_id = null)
    {
        $this->mall_id = !is_null($mall_id) ?: \Yii::$app->mall->id;

        return $this;
    }

    private function setMchId($mch_id = null)
    {
        $this->mch_id = !is_null($mch_id) ?: \Yii::$app->user->identity->mch_id;

        return $this;
    }

    public function handle($order)
    {
        try {
            if (count($order->detail) != 1) {
                throw new \Exception('订单数据异常');
            }

            foreach ($order->detail as $detail) {
                $goodsInfo = json_decode($detail->goods_info, true);
                if (isset($goodsInfo['goods_attr']['customization']['form_mode_type']) && $goodsInfo['goods_attr']['customization']['form_mode_type'] == 'calendar') {
                } else {
                    \Yii::warning('当前定制商品为传统模式');
                }
            }
        }catch(\Exception $exception) {
            \Yii::error('定制商品事件处理异常');
            \Yii::error($exception);
        }
    }

    public function getOrerCustomization($order_detail_id)
    {
        $orderDetail = OrderDetail::find()->andWhere([
            'id' => $order_detail_id,
            'is_delete' => 0,
            'goods_type' => 'form-goods'
        ])->one();

        if (!$orderDetail) {
            throw new \Exception('订单不存在');
        }

        $goodsInfo = json_decode($orderDetail->goods_info, true);
        $customization = $goodsInfo['goods_attr']['customization'] ?? [];
        if (empty($customization)) {
            throw new \Exception('无定制信息'); 
        }

        $data = [
            'customization_name' => $goodsInfo['goods_attr']['form_goods']['name'] ?? "",
            'btn_name' => $goodsInfo['goods_attr']['form_goods']['btn_name'] ?? "",
            'customization' => $customization,
            'select_date' => $goodsInfo['goods_attr']['select_date']['data'] ?? [],
            'number' => $goodsInfo['goods_attr']['number'],
            'attr_list' => $goodsInfo['attr_list'],
            'goods_price' => $goodsInfo['goods_attr']['price'],
            'total_price' => $goodsInfo['goods_attr']['calc']['total_price'],
            'eavl_calc_text' => $goodsInfo['goods_attr']['calc']['eavl_calc_text'],
            'eval_calc_list' => $goodsInfo['goods_attr']['calc']['eval_calc_list'],
        ];

        return $data;
    }

    public function getIsCustomization($orderDetail)
    {
        $isTrue = false;
        $item = $orderDetail[0];
        if (is_array($item)) {
            $goodsInfo = $item['goods_info'];
        } else {
            $goodsInfo = json_decode($item->goods_info, true);
        }
        $status = $goodsInfo['goods_attr']['form_goods']['customization_status'] ?? 0;
        $customization = $goodsInfo['goods_attr']['customization'] ?? [];
        if ($status || !empty($customization)) {
            $isTrue = true;
        }
        
        return $isTrue;
    }

    public function getBtnName($orderDetail)
    {
        $item = $orderDetail[0];
        $data = [
            'btn_name' => '',
            'select_date' => []
        ];
        if (is_array($item)) {
            $goodsInfo = $item['goods_info'];            
        } else {
            $goodsInfo = json_decode($item->goods_info, true);
        }
        $data['btn_name'] = $goodsInfo['goods_attr']['form_goods']['btn_name'] ?? '';
        if (isset($goodsInfo['goods_attr']['select_date'])) {
            $selectDate = $goodsInfo['goods_attr']['select_date'];
            $data['select_date']['day'] = $selectDate['day'] ?? '';
            $data['select_date']['new_after'] = $selectDate['new_after'] ?? '';
            $data['select_date']['new_before'] = $selectDate['new_before'] ?? '';
            $data['select_date']['place_unit'] = $goodsInfo['goods_attr']['form_goods']['place_unit'] ?? '';
            $data['select_date']['is_alone'] = $goodsInfo['goods_attr']['form_goods']['is_alone'] ?? 0;
        }

        return $data;
    }
}