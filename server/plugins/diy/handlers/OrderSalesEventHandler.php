<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\diy\handlers;

use app\core\payment\PaymentNotify;
use app\forms\common\card\CommonCard;
use app\forms\common\coupon\CommonCoupon;
use app\forms\common\coupon\CouponMallRelation;
use app\forms\common\message\MessageService;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\template\TemplateList;
use app\handlers\orderHandler\BaseOrderSalesHandler;
use app\handlers\orderHandler\OrderSalesHandlerClass;
use app\models\Coupon;
use app\models\GoodsCards;
use app\models\Mall;
use app\models\MallMembers;
use app\models\User;
use app\plugins\diy\forms\api\form\DiySendForm;
use app\plugins\diy\forms\common\message\FormSubmitInfo;
use app\plugins\diy\models\DiyForm;
use app\plugins\scan_code_pay\Plugin;

class OrderSalesEventHandler extends OrderSalesHandlerClass
{
    private $extra_attributes = [];
    public $new_send_data = [];

    protected function action()
    {    
        $diyForm = DiyForm::find()->andWhere(['order_no' => $this->event->order->order_no])->one();
        if (!$diyForm) {
            throw new \Exception('form订单不存在');
        }

        $this->extra_attributes = json_decode($diyForm->extra_attributes, true);

        parent::action();
        
        $this->sendDiyMember();
        $this->sendLotteryNumber();

        try {
            \Yii::warning($this->new_send_data);
            if (isset($this->extra_attributes['new_send_data'])) {
                $this->extra_attributes['new_send_data'] = array_merge($this->extra_attributes['new_send_data'], $this->new_send_data);
            } else {
                $this->extra_attributes['new_send_data'] = $this->new_send_data;
            }
            $diyForm->extra_attributes = json_encode($this->extra_attributes);
            $res = $diyForm->save();
            if (!$res) {
                throw new \Exception((new Model())->getErrorMsg($this->diy_form));
            }
        }catch(\Exception $exception) {
            \Yii::error('过售后保存赠送信息异常');
            \Yii::error($exception);
        }
    }

    // 积分发放
    protected function giveIntegral()
    {
        $sendData = $this->extra_attributes ? $this->extra_attributes['send_data'] : [];

        $integral = (new DiySendForm())->giveIntegral($sendData, $this->user);

        if ($integral) {
            $this->new_send_data['send_integral'] = $integral;
        }
    }

    // 余额发放
    protected function giveBalance()
    {
        $sendData = $this->extra_attributes ? $this->extra_attributes['send_data'] : [];

        $balance = (new DiySendForm())->giveBalance($sendData, $this->user);

        if ($balance) {
            $this->new_send_data['send_balance'] = $balance;
        }
    }

    protected function transferToMch($res)
    {
        \Yii::warning('diy订单无多商户结算');
    }

    protected function sendDiyMember()
    {
        $sendData = $this->extra_attributes ? $this->extra_attributes['send_data'] : [];

        $sendMember = (new DiySendForm())->sendDiyMember($sendData, $this->user);

        if ($sendMember) {
            $this->new_send_data['send_member'] = $sendMember;
        }
    }

    protected function sendLotteryNumber()
    {
        $sendData = $this->extra_attributes ? $this->extra_attributes['send_data'] : [];
        if (isset($sendData['send_pond']) && $sendData['send_pond']) {

            $limit = (new DiySendForm())->sendLottery($this->user, 'pond', $sendData['send_pond']);

            if ($limit) {
                $this->new_send_data['send_pond'] = $limit;
            }
        }
        if (isset($sendData['send_scratch']) && $sendData['send_scratch']) {

            $limit = (new DiySendForm())->sendLottery($this->user, 'scratch', $sendData['send_scratch']);

            if ($limit) {
                $this->new_send_data['send_scratch'] = $limit;
            }
        }
    }
}
