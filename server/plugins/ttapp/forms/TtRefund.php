<?php
/**
 * @copyright ©2019 浙江禾匠信息科技
 * Created by PhpStorm.
 * User: Andy - Wangjie
 * Date: 2019/9/6
 * Time: 16:28
 */

namespace app\plugins\ttapp\forms;

use Alipay\AlipayRequestFactory;
use Alipay\AopClient;
use Alipay\Key\AlipayKeyPair;
use app\core\payment\PaymentException;
use app\forms\common\refund\BaseRefund;
use app\helpers\CurlHelper;
use app\models\Model;
use app\models\PaymentRefund;
use app\plugins\bdapp\models\BdappConfig;
use app\plugins\bdapp\models\BdappOrder;
use app\plugins\bdapp\Plugin;
use app\plugins\ttapp\models\TtappConfig;

class TtRefund extends BaseRefund
{
    public function refund($paymentRefund, $paymentOrderUnion)
    {
        $t = \Yii::$app->db->beginTransaction();
        try {
            $plugin = \Yii::$app->plugin->getPlugin('ttapp');
            $ttPay = $plugin->getTtPay();

            $refundAmount = $paymentRefund->amount * 100;
            // 部分客户服务器 * 100 不是整数 会有小数精度问题1.999999999
            if (!is_int($refundAmount)) {
                $refundAmount = round($paymentRefund->amount * 100);
                $refundAmount = (int)$refundAmount;
            }

            $res = $ttPay->refund([
                'out_order_no' => $paymentOrderUnion->order_no,
                'out_refund_no' => $paymentRefund->order_no,
                'refund_amount' => $refundAmount,
                'reason' => $paymentRefund->title
            ]);

            \Yii::warning($res);
            if ($res['err_no'] != 0) {
                throw new PaymentException($res['err_tips']);
            }

            $this->save($paymentRefund);
            $t->commit();
            return true;
        } catch (\Exception $e) {
            $t->rollBack();
            throw new PaymentException($e->getMessage());
        }
    }

    /**
     * @param PaymentRefund $paymentRefund
     * @throws \Exception
     */
    private function save($paymentRefund)
    {
        $paymentRefund->is_pay = 1;
        $paymentRefund->pay_type = 6;
        if (!$paymentRefund->save()) {
            throw new \Exception($this->getErrorMsg($paymentRefund));
        }
    }
}
