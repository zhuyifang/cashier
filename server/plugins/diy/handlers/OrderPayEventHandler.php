<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\diy\handlers;


use app\core\mail\SendMail;
use app\events\OrderEvent;
use app\forms\common\card\CommonCard;
use app\forms\common\card\CommonSend;
use app\forms\common\coupon\CommonCoupon;
use app\forms\common\coupon\CommonCouponGoodsSend;
use app\forms\common\coupon\CouponMallRelation;
use app\forms\common\message\MessageService;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\share\AddShareOrder;
use app\forms\common\template\TemplateList;
use app\handlers\orderHandler\BaseOrderPayedHandler;
use app\handlers\orderHandler\OrderPayedHandlerClass;
use app\jobs\UserCardCreatedJob;
use app\models\Coupon;
use app\models\GoodsCards;
use app\models\MailSetting;
use app\models\Mall;
use app\models\MallMembers;
use app\models\Model;
use app\models\Order;
use app\models\OrderPayResult;
use app\models\User;
use app\models\UserCard;
use app\models\UserCoupon;
use app\plugins\diy\forms\api\form\DiySendForm;
use app\plugins\diy\forms\common\message\FormSubmitInfo;
use app\plugins\diy\models\DiyForm;
use yii\helpers\ArrayHelper;

class OrderPayEventHandler extends OrderPayedHandlerClass
{
    public $extra_attributes = [];
    public $new_send_data = [];
    public $diy_form;

    public function handle()
    {
        $this->updateDiyForm();
        parent::handle();
    }

    protected function pay()
    {
        \Yii::warning('--diyForm表单订单 pay--');
        parent::pay();

        try {
            $this->extra_attributes['new_send_data'] = $this->new_send_data;
            $this->diy_form->extra_attributes = json_encode($this->extra_attributes);
            $res = $this->diy_form->save();
            if (!$res) {
                throw new \Exception((new Model())->getErrorMsg($this->diy_form));
            }
        }catch(\Exception $exception) {
            \Yii::error('支付保存赠送信息异常');
            \Yii::error($exception);
        }

        $this->updateDiyOrder();
        
        return $this;
    }

    /**
     * @return $this
     * 保存支付完成处理结果
     */
    protected function saveResult()
    {
        $this->sendCard();
        $this->sendCoupon();
        return $this;
    }

    /**
     * @return array
     * 向用户发送商品卡券
     */
    protected function sendCard()
    {
        $sendCardList = isset($this->extra_attributes['send_data']['send_card_list']) ? $this->extra_attributes['send_data']['send_card_list'] : [];

        $newSendCardList = (new DiySendForm())->sendCard($sendCardList, $this->user);

        if (!empty($newSendCardList)) {
            $this->new_send_data['send_card_list'] = $newSendCardList;
        }
    }

    /**
     * @return array
     * 向用户发送优惠券（自动发送方案--订单支付成功发送优惠券）
     */
    protected function sendCoupon()
    {
        $sendCouponList = isset($this->extra_attributes['send_data']['send_coupon_list']) ? $this->extra_attributes['send_data']['send_coupon_list'] : [];

        $newSendCouponList = (new DiySendForm())->sendCoupon($sendCouponList, $this->user);

        if (!empty($newSendCouponList)) {
            $this->new_send_data['send_coupon_list'] = $newSendCouponList;
        }
    }


    /**
     * @return $this
     * 通过小程序模板消息发送给用户支付成功通知
     */
    protected function sendTemplate()
    {
        $buttonData = $this->extra_attributes ? $this->extra_attributes['button_data'] : [];

        (new DiySendForm())->sendTemplate($buttonData, $this->user, $this->event->order->created_at);

        return $this;
    }


    protected function sendTemplateMsgToMch()
    {
        \Yii::warning('diy表单订单无需发送多商户公众号模板消息');

        return $this;
    }

    /**
     * @return $this
     * 向用户发送短信提醒
     */
    protected function sendSmsToUser()
    {
        $buttonData = $this->extra_attributes ? $this->extra_attributes['button_data'] : [];
        
        (new DiySendForm())->sendSmsToUser($buttonData, $this->user);

        return $this;
    }

    public function updateDiyForm() 
    {
        try {
            \Yii::warning('DiyForm订单状态更新开始');
            $order = $this->event->order;
            $diyForm = DiyForm::find()->andWhere(['order_no' => $order->order_no])->one();
            if (!$diyForm) {
                throw new \Exception('form订单不存在');
            }

            if ($diyForm->is_pay == 1) {
                throw new \Exception('form订单已处理');
            }

            $this->extra_attributes = json_decode($diyForm->extra_attributes, true);
            $this->diy_form = $diyForm;

            $diyForm->is_pay = 1;
            $diyForm->pay_time = $order->pay_time;
            $res = $diyForm->save();
            if (!$res) {
                throw new \Exception((new Model())->getErrorMsg($diyForm));
            }
        } catch(\Exception $exception) {
            \Yii::error('diy订单更新异常');
            \Yii::error($exception);
        }
    }

    public function updateDiyOrder()
    {
        \Yii::warning('DIY订单状态更新开始');
        $order = $this->event->order;
        $order->is_sale = 1;
        $order->auto_sales_time = mysql_timestamp();
        $order->is_confirm = 1;
        $order->confirm_time = mysql_timestamp();
        $order->is_send = 1;
        $order->send_time = mysql_timestamp();
        $order->comment_time = mysql_timestamp();
        $res = $order->save();
        if (!$res) {
            \Yii::error('DIY下单状态更新失败');
            \Yii::error((new Model())->getErrorMsg($order));
        }

        $event = new OrderEvent();
        $event->order = $order;
        \Yii::$app->trigger(Order::EVENT_SALES, $event);
    }


    /**
     * @return $this
     * 邮件发送--新订单通知
     */
    protected function sendMail()
    {
        (new DiySendForm())->sendMail($this->mall);
        
        return $this;
    }

    public function addShareOrder($isSendTemplate = true)
    {
        try {
            if ($this->diy_form->diyFormList->is_share != 1) {
                throw new \Exception('未开启分销');
            }
            (new AddShareOrder())->save($this->event->order, $isSendTemplate);
        } catch (\Exception $exception) {
            \Yii::error('分销佣金记录失败：' . $exception->getMessage());
            \Yii::error($exception);
        }
        return $this;
    }
}
