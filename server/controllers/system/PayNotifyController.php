<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/16 16:11
 */


namespace app\controllers\system;

use Alipay\AopClient;
use Alipay\Key\AlipayKeyPair;
use app\controllers\Controller;
use app\core\payment\PaymentNotify;
use app\models\AdminInfo;
use app\models\AppOrder;
use app\models\Mall;
use app\models\Model;
use app\models\PaymentOrder;
use app\models\PaymentOrderUnion;
use app\plugins\bdapp\models\BdappOrder;
use app\plugins\ttapp\models\TtappOrder;
use app\plugins\wxapp\forms\Enum;
use luweiss\Wechat\WechatHelper;
use luweiss\Wechat\WechatPay;
use yii\web\Response;

class PayNotifyController extends Controller
{
    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;
    }

    public function actionWechat()
    {
        return $this->notifyWechat();
    }

    public function actionWechatMobile()
    {
        return $this->notifyWechat('mobile');
    }

    public function actionWechatMp()
    {
        return $this->notifyWechat('wechat');
    }

    private function notifyWechat($type = 'wxapp')
    {
        \Yii::$app->setAppPlatform($type);
        \Yii::$app->response->format = Response::FORMAT_XML;
        $xml = \Yii::$app->request->rawBody;
        $res = WechatHelper::xmlToArray($xml);
        if (!$res) {
            throw new \Exception('请求数据错误: ' . $xml);
        }
        if (empty($res['out_trade_no'])
            || empty($res['sign'])
            || empty($res['total_fee'])
            || empty($res['result_code'])
            || empty($res['return_code'])
        ) {
            throw new \Exception('请求数据错误: ' . $xml);
        }

        if ($res['result_code'] !== 'SUCCESS' || $res['return_code'] !== 'SUCCESS') {
            throw new \Exception('订单尚未支付: ' . $xml);
        }

        $paymentOrderUnion = PaymentOrderUnion::findOne([
            'order_no' => $res['out_trade_no'],
        ]);
        if (!$paymentOrderUnion) {
            throw new \Exception('订单不存在: ' . $res['out_trade_no']);
        }
        if ($paymentOrderUnion->app_version) {
            \Yii::$app->setAppVersion($paymentOrderUnion->app_version);
        }
        if ($paymentOrderUnion->is_pay === 1) {
            $responseData = [
                'return_code' => 'SUCCESS',
                'return_msg' => 'OK',
            ];
            \Yii::$app->response->format = Response::FORMAT_XML;
            echo WechatHelper::arrayToXml($responseData);
            return;
        }
        $mall = Mall::findOne($paymentOrderUnion->mall_id);
        if (!$mall) {
            throw new \Exception('未查询到id=' . $paymentOrderUnion->id . '的商城。 ');
        }
        \Yii::$app->setMall($mall);

        $this->checkWechatSign($res, $type);

        $paymentOrderUnionAmount = (doubleval($paymentOrderUnion->amount) * 100) . '';
        if (intval($res['total_fee']) !== intval($paymentOrderUnionAmount)) {
            throw new \Exception('支付金额与订单金额不一致。');
        }

        $paymentOrders = PaymentOrder::findAll(['payment_order_union_id' => $paymentOrderUnion->id]);
        $paymentOrderUnion->is_pay = 1;
        $paymentOrderUnion->pay_type = $this->wechatPayType()[\Yii::$app->appPlatform];
        if (!$paymentOrderUnion->save()) {
            throw new \Exception($paymentOrderUnion->getFirstErrors());
        }
        foreach ($paymentOrders as $paymentOrder) {
            $Class = $paymentOrder->notify_class;
            if (!class_exists($Class)) {
                continue;
            }
            $paymentOrder->is_pay = 1;
            $paymentOrder->pay_type = 1;
            if (!$paymentOrder->save()) {
                throw new \Exception($paymentOrder->getFirstErrors());
            }
            /** @var PaymentNotify $notify */
            $notify = new $Class();
            try {
                $po = new \app\core\payment\PaymentOrder([
                    'orderNo' => $paymentOrder->order_no,
                    'amount' => (float)$paymentOrder->amount,
                    'title' => $paymentOrder->title,
                    'notifyClass' => $paymentOrder->notify_class,
                    'payType' => \app\core\payment\PaymentOrder::PAY_TYPE_WECHAT
                ]);
                $notify->notify($po);
            } catch (\Exception $e) {
            }
        }
        $responseData = [
            'return_code' => 'SUCCESS',
            'return_msg' => 'OK',
        ];
        \Yii::$app->response->format = Response::FORMAT_XML;
        echo WechatHelper::arrayToXml($responseData);
        return;
    }

    private function wechatPayType()
    {
        return [
            'wechat' => 7,
            'mobile' => 7,
            'wxapp' => 1,
        ];
    }

    private function checkWechatsign($res, $type)
    {
        if ($type == 'wxapp') {
            /** @var WechatPay $wechatPay */
            $wechatPay = \Yii::$app->plugin->getPlugin($type)->getWechatPay(Enum::WECHAT_PAY_SERVICE);
        } else {
            $wechatPay = \Yii::$app->plugin->getPlugin($type)->getWechatPay(\Yii::$app->appPlatform);
        }
        $truthSign = $wechatPay->makeSign($res);
        if ($truthSign !== $res['sign']) {
            throw new \Exception('签名验证失败。');
        }
    }

    public function actionAlipay()
    {
        return $this->notifyAlipay();
    }

    public function actionAlipayMobile()
    {
        return $this->notifyAlipay('mobile');
    }

    public function actionAlipayMp()
    {
        return $this->notifyAlipay('wechat');
    }

    private function notifyAlipay($type = 'aliapp')
    {
        \Yii::$app->setAppPlatform($type);
        $res = \Yii::$app->request->post();
        if (!$res) {
            throw new \Exception('请求数据错误');
        }
        if (empty($res['out_trade_no'])
            || empty($res['sign'])
            || empty($res['total_amount'])
        ) {
            throw new \Exception('请求数据错误');
        }

        $paymentOrderUnion = PaymentOrderUnion::findOne([
            'order_no' => $res['out_trade_no'],
        ]);
        if (!$paymentOrderUnion) {
            throw new \Exception('订单不存在: ' . $res['out_trade_no']);
        }
        if ($paymentOrderUnion->app_version) {
            \Yii::$app->setAppVersion($paymentOrderUnion->app_version);
        }
        if ($paymentOrderUnion->is_pay === 1) {
            return;
        }
        $mall = Mall::findOne($paymentOrderUnion->mall_id);
        if (!$mall) {
            throw new \Exception('未查询到id=' . $paymentOrderUnion->id . '的商城。 ');
        }
        \Yii::$app->setMall($mall);

        $passed = $this->checkAlipaySign($type);

        if ($passed) {
            $paymentOrders = PaymentOrder::findAll(['payment_order_union_id' => $paymentOrderUnion->id]);
            $paymentOrderUnion->is_pay = 1;
            $paymentOrderUnion->pay_type = $this->aliPayType()[\Yii::$app->appPlatform];
            if (!$paymentOrderUnion->save()) {
                throw new \Exception($paymentOrderUnion->getFirstErrors());
            }
            foreach ($paymentOrders as $paymentOrder) {
                $Class = $paymentOrder->notify_class;
                if (!class_exists($Class)) {
                    continue;
                }
                $paymentOrder->is_pay = 1;
                $paymentOrder->pay_type = $this->aliPayType()[\Yii::$app->appPlatform];
                if (!$paymentOrder->save()) {
                    throw new \Exception($paymentOrder->getFirstErrors());
                }
                /** @var PaymentNotify $notify */
                $notify = new $Class();
                try {
                    $po = new \app\core\payment\PaymentOrder([
                        'orderNo' => $paymentOrder->order_no,
                        'amount' => (float)$paymentOrder->amount,
                        'title' => $paymentOrder->title,
                        'notifyClass' => $paymentOrder->notify_class,
                        'payType' => \app\core\payment\PaymentOrder::PAY_TYPE_ALIPAY
                    ]);
                    $notify->notify($po);
                } catch (\Exception $e) {
                    \Yii::error($e);
                }
            }
            echo "success";
            return;
        }
    }

    private function checkAlipaySign($type)
    {
        if ($type == 'aliapp') {
            return \Yii::$app->plugin->getPlugin($type)->checkSign();
        }
        return \Yii::$app->plugin->getPlugin($type)->checkSign(\Yii::$app->appPlatform);
    }

    private function aliPayType()
    {
        return [
            'wechat' => 8,
            'mobile' => 8,
            'aliapp' => 4,
        ];
    }

    public function actionBaidu()
    {
        \Yii::error('百度支付回调');
        $res = \Yii::$app->request->post();
        if (!$res) {
            throw new \Exception('请求数据错误');
        }
        if (empty($res['tpOrderId'])
            || empty($res['rsaSign'])
            || empty($res['totalMoney'])
            || empty($res['orderId'])
        ) {
            throw new \Exception('请求数据错误');
        }

        if ($res['status'] != 2) {
            throw new \Exception('订单尚未支付');
        }

        $paymentOrderUnion = PaymentOrderUnion::findOne([
            'order_no' => $res['tpOrderId'],
        ]);
        if (!$paymentOrderUnion) {
            throw new \Exception('订单不存在: ' . $res['tpOrderId']);
        }
        if ($paymentOrderUnion->app_version) {
            \Yii::$app->setAppVersion($paymentOrderUnion->app_version);
        }

        $bdAppOrder = BdappOrder::findOne(['order_no' => $res['tpOrderId']]);
        if (!$bdAppOrder) {
            $bdAppOrder = new BdappOrder();
            $bdAppOrder->order_no = $res['tpOrderId'];
            $bdAppOrder->bd_order_id = $res['orderId'];
            $bdAppOrder->bd_user_id = $res['userId'];
            $bdAppOrder->save();
        } else {
            $bdAppOrder->bd_user_id = $res['userId'];
            $bdAppOrder->save();
        }

        if ($paymentOrderUnion->is_pay === 1) {
            $responseData = [
                'errno' => 0,
                'msg' => 'success',
                'data' => ['isConsumed' => 2]
            ];
            \Yii::$app->response->data = $responseData;
            return;
        }
        $mall = Mall::findOne($paymentOrderUnion->mall_id);
        if (!$mall) {
            throw new \Exception('未查询到id=' . $paymentOrderUnion->id . '的商城。 ');
        }
        \Yii::$app->setMall($mall);

        $res['sign'] = $res['rsaSign'];
        unset($res['rsaSign']);
        $truthSign = \Yii::$app->plugin->getPlugin('bdapp')->checkSignWithRsa($res);

        if (!$truthSign) {
            throw new \Exception('签名验证失败。');
        }

        $paymentOrderUnionAmount = (doubleval($paymentOrderUnion->amount) * 100) . '';
        if (intval($res['totalMoney']) !== intval($paymentOrderUnionAmount)) {
            throw new \Exception('支付金额与订单金额不一致。');
        }

        $paymentOrders = PaymentOrder::findAll(['payment_order_union_id' => $paymentOrderUnion->id]);
        $paymentOrderUnion->is_pay = 1;
        $paymentOrderUnion->pay_type = 5;
        if (!$paymentOrderUnion->save()) {
            throw new \Exception($paymentOrderUnion->getFirstErrors());
        }
        foreach ($paymentOrders as $paymentOrder) {
            $Class = $paymentOrder->notify_class;
            if (!class_exists($Class)) {
                continue;
            }
            $paymentOrder->is_pay = 1;
            $paymentOrder->pay_type = 5;
            if (!$paymentOrder->save()) {
                throw new \Exception($paymentOrder->getFirstErrors());
            }
            /** @var PaymentNotify $notify */
            $notify = new $Class();
            try {
                $po = new \app\core\payment\PaymentOrder([
                    'orderNo' => $paymentOrder->order_no,
                    'amount' => (float)$paymentOrder->amount,
                    'title' => $paymentOrder->title,
                    'notifyClass' => $paymentOrder->notify_class,
                    'payType' => \app\core\payment\PaymentOrder::PAY_TYPE_BAIDU
                ]);
                $notify->notify($po);
            } catch (\Exception $e) {
                \Yii::error($e);
            }
        }
        $responseData = [
            'errno' => 0,
            'msg' => 'success',
            'data' => ['isConsumed' => 2]
        ];
        \Yii::$app->response->data = $responseData;
        return;
    }

    public function actionBaiduRefundVerify()
    {
        \Yii::error('百度退款审核');
        $res = \Yii::$app->request->post();
        if (!$res) {
            throw new \Exception('请求数据错误');
        }
        if (empty($res['orderId'])
            || empty($res['userId'])
            || empty($res['tpOrderId'])
            || empty($res['refundBatchId'])
        ) {
            throw new \Exception('请求数据错误');
        }

        $paymentOrderUnion = PaymentOrderUnion::findOne([
            'order_no' => $res['tpOrderId'],
        ]);
        if (!$paymentOrderUnion) {
            throw new \Exception('订单不存在: ' . $res['tpOrderId']);
        }
        if ($paymentOrderUnion->app_version) {
            \Yii::$app->setAppVersion($paymentOrderUnion->app_version);
        }
        $mall = Mall::findOne($paymentOrderUnion->mall_id);
        if (!$mall) {
            throw new \Exception('未查询到id=' . $paymentOrderUnion->id . '的商城。 ');
        }
        \Yii::$app->setMall($mall);

        $res['sign'] = $res['rsaSign'];
        unset($res['rsaSign']);
        $truthSign = \Yii::$app->plugin->getPlugin('bdapp')->checkSignWithRsa($res);

        if (!$truthSign) {
            throw new \Exception('退款查询签名验证失败。');
        }

        $bdAppOrder = BdappOrder::findOne(['bd_order_id' => $res['orderId']]);
        if (!$bdAppOrder) {
            throw new \Exception('退款订单错误.');
        }

        \Yii::error('百度退款审核成功');
        $responseData = [
            'errno' => 0,
            'msg' => 'success',
            'data' => ['auditStatus' => 1,
                'calculateRes' => [
                    'refundPayMoney' => $res['applyRefundMoney']
                ]]
        ];
        \Yii::$app->response->data = $responseData;
        return;
    }

    public function actionBaiduRefund()
    {
        \Yii::error('百度退款回调');
        $res = \Yii::$app->request->post();
        if (!$res) {
            throw new \Exception('请求数据错误');
        }
        try {
            $bdAppOrder = BdappOrder::findOne(['bd_order_id' => $res['orderId']]);
            if (!$bdAppOrder) {
                throw new \Exception('百度订单号获取失败');
            }
            $bdAppOrder->is_refund = 1;
            $res = $bdAppOrder->save();
            if (!$res) {
                throw new \Exception((new Model())->getErrorMsg($bdAppOrder));
            }
        } catch (\Exception $e) {
            \Yii::error($e);
        }
        $responseData = [
            'errno' => 0,
            'msg' => 'success',
            'data' => (object)null,
        ];
        \Yii::$app->response->data = $responseData;
        return;
    }

    public function actionToutiao()
    {
        $res = \Yii::$app->request->rawBody;
        \Yii::warning($res);
        if (!$res) {
            throw new \Exception('请求数据错误');
        }
        $notifyData = json_decode($res, true);
        $orderInfo = json_decode($notifyData['msg'], true);

        $paymentOrderUnion = PaymentOrderUnion::findOne([
            'order_no' => $orderInfo['cp_orderno'],
        ]);
        if (!$paymentOrderUnion) {
            throw new \Exception('订单不存在: ' . $orderInfo['cp_orderno']);
        }
        if ($paymentOrderUnion->app_version) {
            \Yii::$app->setAppVersion($paymentOrderUnion->app_version);
        }

        if ($paymentOrderUnion->is_pay === 1) {
            return [
                'err_no' => 0,
                'err_tips' => 'success'
            ];
        }

        $mall = Mall::findOne($paymentOrderUnion->mall_id);
        if (!$mall) {
            throw new \Exception('未查询到id=' . $paymentOrderUnion->id . '的商城。 ');
        }
        \Yii::$app->setMall($mall);

        $passed = \Yii::$app->plugin->getPlugin('ttapp')->checkSign($notifyData);

        if ($passed) {
            $paymentOrders = PaymentOrder::findAll(['payment_order_union_id' => $paymentOrderUnion->id]);
            $paymentOrderUnion->is_pay = 1;
            // way 1.微信 2.支付宝
            $paymentOrderUnion->pay_type = 6;
            if (!$paymentOrderUnion->save()) {
                throw new \Exception($paymentOrderUnion->getFirstErrors());
            }
            foreach ($paymentOrders as $paymentOrder) {
                $Class = $paymentOrder->notify_class;
                if (!class_exists($Class)) {
                    continue;
                }
                $paymentOrder->is_pay = 1;
                $paymentOrder->pay_type = 6;
                if (!$paymentOrder->save()) {
                    throw new \Exception($paymentOrder->getFirstErrors());
                }
                /** @var PaymentNotify $notify */
                $notify = new $Class();
                try {
                    $po = new \app\core\payment\PaymentOrder([
                        'orderNo' => $paymentOrder->order_no,
                        'amount' => (float)$paymentOrder->amount,
                        'title' => $paymentOrder->title,
                        'notifyClass' => $paymentOrder->notify_class,
                        'payType' => \app\core\payment\PaymentOrder::PAY_TYPE_TOUTIAO
                    ]);
                    $notify->notify($po);
                } catch (\Exception $e) {
                    \Yii::error($e);
                }
            }
            \Yii::$app->response->data = true;
            return [
                'err_no' => 0,
                'err_tips' => 'success'
            ];
        } else {
            \Yii::warning('签名验证不通过');
        }
    }

    public function actionCityService()
    {
        \Yii::warning('同城配送接口回调测试');
    }

    public function actionWechatNative()
    {
        $xml = \Yii::$app->request->rawBody;
        $res = WechatHelper::xmlToArray($xml);
        if (!$res) {
            throw new \Exception('请求数据错误: ' . $xml);
        }

        \Yii::warning($res);

        if ($res['result_code'] == 'SUCCESS' && $res['return_code'] == 'SUCCESS') {
            $order = AppOrder::find()->andWhere(['out_trade_no' => $res['out_trade_no']])->one();
            if (!$order) {
                throw new \Exception('native订单不存在');
            }

            $order->is_pay = 1;
            $order->pay_time = date('Y-m-d H:i:s', time());

            $extraAttributes = json_decode($order->extra_attributes, true);
            $extraAttributes['notify_result'] = $res;
            $order->extra_attributes = json_encode($extraAttributes);

            $order->save();

            $adminInfo = AdminInfo::findOne(['user_id' => $order->user_id]);
            $this->setPermission($adminInfo, $order->name, $order->app_name);

            return 'success';
        }
    }

    public function actionAlipayNative()
    {
        $res = \Yii::$app->request->post();
        if (!$res) {
            throw new \Exception('请求数据错误');
        }

        \Yii::warning($res);

        if ($res['trade_status'] == 'TRADE_SUCCESS') {
            $order = AppOrder::find()->andWhere(['out_trade_no' => $res['out_trade_no']])->one();
            if (!$order) {
                throw new \Exception('native订单不存在');
            }

            $order->is_pay = 1;
            $order->pay_time = date('Y-m-d H:i:s', time());

            $extraAttributes = json_decode($order->extra_attributes, true);
            $extraAttributes['notify_result'] = $res;
            $order->extra_attributes = json_encode($extraAttributes);

            $order->save();

            $adminInfo = AdminInfo::findOne(['user_id' => $order->user_id]);
            $this->setPermission($adminInfo, $order->name, $order->app_name);

            echo "success";
        }
    }

    private function setPermission(AdminInfo $adminInfo, $name, $displayName)
    {
        $subjoinPermissions = json_decode($adminInfo->subjoin_permissions, true);
        if (!$subjoinPermissions) {
            $subjoinPermissions = [
                'mall' => [],
                'plugin' => [],
                'secondary' => [
                    'attachment' => [],
                    'template' => [
                        'is_all' => '0',
                        'use_all' => '0',
                        'list' => [],
                        'use_list' => []
                    ]
                ],
                'list' => []
            ];
        }

        $subjoinPermissions['plugin'][] = $name;
        $subjoinPermissions['list'][] = $displayName;

        $subjoinPermissions['plugin'] = array_unique($subjoinPermissions['plugin']);
        $subjoinPermissions['list'] = array_unique($subjoinPermissions['list']);

        $adminInfo->subjoin_permissions = json_encode($subjoinPermissions);
        $adminInfo->save();
    }

    public function actionToutiaoSettle()
    {
        try {
            $res = \Yii::$app->request->rawBody;
            if (!$res) {
                throw new \Exception('请求数据错误');
            }

            $notifyData = json_decode($res, true);
            $orderInfo = json_decode($notifyData['msg'], true);

            $ttappOrder = TtappOrder::findOne([
                'out_settle_no' => $orderInfo['cp_settle_no'],
            ]);

            if (!$ttappOrder) {
                throw new \Exception('订单不存在: ' . $orderInfo['cp_settle_no']);
            }

            $mall = Mall::findOne($ttappOrder->mall_id);
            if (!$mall) {
                throw new \Exception('未查询到id=' . $ttappOrder->id . '的商城。 ');
            }
            \Yii::$app->setMall($mall);

            $ttPay = \Yii::$app->plugin->getPlugin('ttapp');
            $passed = $ttPay->checkSign($notifyData);

            if (!$passed) {
                throw new \Exception('签名验证不通过');
            }

            if ($orderInfo['status'] == 'SUCCESS') {
                $res = $ttPay->querySettle([
                    'out_settle_no' => $ttappOrder->out_settle_no
                ]);

                if ($res['err_no'] != 0) {
                    throw new \Exception($res['err_tips']);
                }

                $ttappOrder->money = $res['settle_info']['settle_amount'];
                $ttappOrder->status = 1;
                
                $res = $ttappOrder->save();
                if (!$res) {
                    throw new \Exception((new Model())->getErrorMsg($ttappOrder));
                }
            }
            \Yii::$app->response->data = true;

        }catch(\Exception $exception) {
            \Yii::error($exception);
        }

        return [
            'err_no' => 0,
            'err_tips' => 'success'
        ];
    }
}
