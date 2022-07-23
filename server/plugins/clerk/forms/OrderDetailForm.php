<?php

namespace app\plugins\clerk\forms;

use app\core\response\ApiCode;
use app\forms\api\goods\MallGoods;
use app\forms\common\order\CommonCustomization;
use app\models\Model;
use app\models\Order;
use app\models\OrderDetail;
use app\models\OrderRefund;
use app\plugins\mch\models\Mch;
use yii\helpers\ArrayHelper;

class OrderDetailForm extends Model
{
    public $order_id;

    public function rules()
    {
        return [
            [['order_id'], 'required'],
        ];
    }


    public function search()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $order = Order::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'id' => $this->order_id,
            'is_delete' => 0,
        ])
            ->with('user')
            ->with('detail.goods.goodsWarehouse')
            ->with('refund')
            ->with('clerk')
            ->with('orderClerk')
            ->with('store')
            ->one();


        if (!$order) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => '订单不存在',
            ];
        }
        $newOrder = ArrayHelper::toArray($order);

        // 兼容
        $newOrder['user'] = $order->user;
        $newOrder['refund'] = $order->refund;
        $newOrder['clerk'] = $order->clerk;
        $newOrder['orderClerk'] = $order->orderClerk;
        $newOrder['store'] = $order->store;

        $newOrder['refund_info'] = [];
        if ($order->refund) {
            $newOrder['refund_info'] = $order->refund[0];
            $newOrder['refund'] = (new OrderRefund())->statusText_business($order->refund[0]);
        }

        $priceList = [];
        foreach ($order->detail as $key => $item) {
            $newOrder['detail'][$key] = ArrayHelper::toArray($item);
            $newOrder['detail'][$key]['goods'] = ArrayHelper::toArray($item->goods);
            $newOrder['detail'][$key]['goods']['goodsWarehouse'] = ArrayHelper::toArray($item->goods->goodsWarehouse);

            if (is_string($item->goods->goodsWarehouse->pic_url)) {
                $newOrder['detail'][$key]['goods']['pic_url'] = [$item->goods->goodsWarehouse->pic_url];
            } else {
                $newOrder['detail'][$key]['goods']['pic_url'] =json_encode($item->goods->goodsWarehouse->pic_url);
            }
            $newOrder['detail'][$key]['goods']['cover_pic'] = $item->goods->goodsWarehouse->cover_pic;
            $newOrder['detail'][$key]['attr_list'] = json_decode($item->goods_info, true)['attr_list'];
            $newOrder['detail'][$key]['form_data'] = \yii\helpers\BaseJson::decode($item->form_data);
            $newOrder['detail'][$key]['goods_info'] = MallGoods::getGoodsData(OrderDetail::findOne($item->id));
            $priceList[] = [
                'label' => '小计',
                'value' => $item->total_price,
            ];
        }

        $newOrder['order_form'] = json_decode($order->order_form, true);

        //倒计时秒
        $newOrder['auto_cancel'] = strtotime($order->auto_cancel_time) - time();
        $newOrder['auto_confirm'] = strtotime($order->auto_confirm_time) - time();
        $newOrder['auto_sales'] = strtotime($order->auto_sales_time) - time();
        $newOrder['plugin_data'] = (new Order())->getPluginData($order, $priceList);
        $newOrder['customization_status'] = CommonCustomization::getCommon()->getIsCustomization($order->detail);
        $newOrder = array_merge($newOrder, CommonCustomization::getCommon()->getBtnName($order->detail));
        $newOrder['sign_name'] = $order->getSignName();
        $mch = [];
        // 多商户
        if ($order->mch_id > 0) {
            $mch = Mch::findOne(['mall_id' => \Yii::$app->mall->id, 'id' => $order->mch_id]);
        }

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => [
                'order' => $newOrder,
                'mch' => $mch,
            ]
        ];
    }
}
