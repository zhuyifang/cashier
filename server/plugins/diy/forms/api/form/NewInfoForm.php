<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\plugins\diy\forms\api\form;


use app\core\response\ApiCode;
use app\helpers\ArrayHelper;
use app\jobs\OrderCancelJob;
use app\models\Model;
use app\models\Order;
use app\models\PaymentOrder;
use app\plugins\diy\models\DiyForm;

class NewInfoForm extends Model
{
    public $form_id;
    public $pay_id;
    public $token;// 下单后查询订单信息

    public function rules()
    {
        return [
            [['form_id', 'pay_id'], 'integer'],
            [['token'], 'string'],
        ];
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $list = DiyForm::find()->andWhere([
                'is_delete' => 0,
                'is_pay' => 1,
                'user_id' => \Yii::$app->user->id,
                'mall_id' => \Yii::$app->mall->id
            ])
                ->orderBy(['created_at' => SORT_DESC])
                ->page($pagination)
                ->all();

            $newList = [];
            foreach ($list as $item) {
                $newItem = [];
                $newItem['id'] = $item->id;
                $newItem['created_at'] = $item->created_at;
                $newItem['is_old'] = $item->is_old;
                $newItem['form_list_id'] = $item->form_list_id;
                $newItem['form_list_name'] = $item->form_list_name;
                $newItem['order_no'] = $item->order_no;
                $newItem['is_pay'] = $item->is_pay;
                $newItem['pay_price'] = $item->pay_price;
                $newItem['pay_time'] = $item->pay_time;
                $newItem['reply'] = $item->reply;
                $newItem['reply_time'] = $item->reply_time;
                $newList[] = $newItem;
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'list' => $newList
                ],
            ];
        } catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $diyForm = DiyForm::find()->andWhere([
                'id' => $this->form_id,
                'is_delete' => 0,
                'mall_id' => \Yii::$app->mall->id,
                'user_id' => \Yii::$app->user->id
            ])->one();

            if (!$diyForm) {
                throw new \Exception('订单不存在');
            }

            $data = ArrayHelper::toArray($diyForm);
            $data['form_data'] = json_decode($data['form_data'], true);
            $data['extra_attributes'] = json_decode($data['extra_attributes'], true);

            $extra = json_decode($diyForm->extra_attributes, true);
            $extra['new_send_data'] = empty($extra['new_send_data']) ? null : $extra['new_send_data'];

            $data = [
                'id' => $diyForm->id,
                'form_data' => json_decode($diyForm->form_data, true),
                'created_at' => $diyForm->created_at,
                'is_old' => $diyForm->is_old,
                'form_list_id' => $diyForm->form_list_id,
                'form_list_name' => $diyForm->form_list_name,
                'order_no' => $diyForm->order_no,
                'is_pay' => $diyForm->is_pay,
                'pay_price' => $diyForm->pay_price,
                'pay_time' => $diyForm->pay_time,
                'reply' => $diyForm->reply,
                'reply_time' => $diyForm->reply_time,
                'extra_attributes' => $extra,
            ];

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'detail' => $data
                ],
            ];
        } catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine()
            ];
        }
    }


    public function getSubmitResult()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {

            // 兼容diy表单下单
            if ($this->token && !$this->form_id) {
                $order = Order::find()->andWhere([
                    'mall_id' => \Yii::$app->mall->id,
                    'is_delete' => 0,
                    'token' => $this->token,
                    'sign' => 'diy'
                ])->one();
                if (!$order) {
                    throw new \Exception('订单不存在');
                }

                $diyForm = DiyForm::find()->andWhere(['order_no' => $order->order_no, 'is_delete' => 0])->one();
            } else {
                $diyForm = DiyForm::find()->andWhere(['id' => $this->form_id, 'is_delete' => 0])->one();
            }

            if (!$diyForm) {
                throw new \Exception('表单不存在');
            }

            $extra = \yii\helpers\BaseJson::decode($diyForm->extra_attributes);
            $send_data = isset($extra['new_send_data']) ? $extra['new_send_data'] : [];

            $r = [];
            if (!empty($send_data)) {
                isset($send_data['send_balance']) && array_push($r, [
                    'label' => '赠送金额',
                    'type' => 'balance',
                    'value' => $send_data['send_balance'] . '元'
                ]);
                isset($send_data['send_integral']) && array_push($r, [
                    'label' => '赠送积分',
                    'key' => 'integral',
                    'value' => $send_data['send_integral'] . '积分'
                ]);
                isset($send_data['send_member']) && array_push($r, [
                    'label' => '赠送会员',
                    'type' => 'member',
                    'value' => $send_data['send_member']
                ]);
                isset($send_data['send_coupon_list']) && array_push($r, [
                    'label' => '赠送优惠券',
                    'type' => 'coupon',
                    'value' => array_map(function ($coupon) {
                        return $coupon['send_num'] . '张' . $coupon['name'];
                    }, $send_data['send_coupon_list'])
                ]);
                isset($send_data['send_card_list']) && array_push($r, [
                    'label' => '赠送卡券',
                    'type' => 'card',
                    'value' => array_map(function ($card) {
                        return $card['num'] . '张' . $card['name'];
                    }, $send_data['send_card_list'])
                ]);
                isset($send_data['send_pond']) && array_push($r, [
                    'label' => '赠送抽奖',
                    'type' => 'lottery',
                    'value' => $send_data['send_pond'] . '次九宫格抽奖'
                ]);
                isset($send_data['send_scratch']) && array_push($r, [
                    'label' => '赠送抽奖',
                    'type' => 'lottery',
                    'value' => $send_data['send_scratch'] . '次刮刮卡抽奖'
                ]);
            }
            $data['send_data'] = $r ?? null;
            $data['after_jump_link'] = $extra['after_jump_link'] ?? null;
            $title = isset($extra['pay_title']) ? $extra['pay_title'] : '';
            $data['place_text'] = $extra['button_data']['is_pay'] == 1 ? '感谢您购买' . $title : '感谢您的提交';
            $data['pay_price'] = $diyForm->pay_price;
            $data['is_pay'] = $extra['button_data']['is_pay'];
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => $data,
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function orderCancel()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            /** @var PaymentOrder $paymentOrder */
            $paymentOrder = PaymentOrder::find()->where(['payment_order_union_id' => $this->pay_id])->one();
            if (!$paymentOrder) {
                throw new \Exception($this->getErrorMsg($paymentOrder));
            }
            /** @var Order $order */
            $order = Order::find()->where(['order_no' => $paymentOrder->order_no])->one();
            if (!$order) {
                throw new \Exception('订单不存在');
            }

            $queueId = \Yii::$app->queue->delay(0)->push(new OrderCancelJob([
                'orderId' => $order->id
            ]));

            $isDone = true;
            while ($isDone) {
                if (\Yii::$app->queue->isDone($queueId)) {
                    $isDone = false;
                }
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '取消成功'
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage()
            ];
        }
    }
}