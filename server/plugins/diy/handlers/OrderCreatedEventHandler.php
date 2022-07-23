<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\diy\handlers;

use app\forms\common\message\MessageService;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\share\CommonShare;
use app\forms\common\template\TemplateList;
use app\forms\common\template\order_pay_template\AccountChangeInfo;
use app\handlers\orderHandler\BaseOrderCreatedHandler;
use app\handlers\orderHandler\OrderCreatedHandlerClass;
use app\jobs\ChangeShareOrderJob;
use app\jobs\OrderCancelJob;
use app\models\Model;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Share;
use app\models\ShareOrder;
use app\models\ShareSetting;
use app\models\User;
use app\plugins\diy\models\DiyForm;
use app\plugins\scan_code_pay\forms\common\CommonScanCodePaySetting;

class OrderCreatedEventHandler extends OrderCreatedHandlerClass
{
    private $diyFormList;

    public function handle()
    {
        $diyForm = DiyForm::find()->andWhere(['order_no' => $this->event->order->order_no])->with('diyFormList')->one();

        if ($diyForm && $diyForm->diyFormList) {
            $this->diyFormList = $diyForm->diyFormList;
        }

        parent::handle();
    }

    protected function setAutoCancel()
    {
        // 订单自动取消任务
        $orderAutoCancelMinute = 5;
        \Yii::$app->queue->delay($orderAutoCancelMinute * 60)->push(new OrderCancelJob([
            'orderId' => $this->event->order->id,
        ]));
        $autoCancelTime = strtotime($this->event->order->created_at) + $orderAutoCancelMinute * 60;
        $this->event->order->auto_cancel_time = mysql_timestamp($autoCancelTime);
        $this->event->order->save();
        return $this;
    }

    protected function setPrint()
    {
        \Yii::warning('diyForm订单无需小票打印');
        return $this;
    }

    protected function setShareUser()
    {
        try {
            if ($this->diyFormList->is_share != 1) {
                throw new \Exception('diy表单未开启分销');
            }
            $commonShare = new CommonShare();
            $commonShare->mall = \Yii::$app->mall;
            $commonShare->user = \Yii::$app->user->identity;
            $commonShare->bindParent($commonShare->user->userInfo->temp_parent_id, 2);
        } catch (\Exception $exception) {
            \Yii::error('首次下单成为下级：' . $exception->getMessage());
        }
        return $this;
    }

    protected function setShareMoney()
    {
        try {
            if ($this->diyFormList->is_share != 1) {
                throw new \Exception('diy表单未开启分销');
            }
            $this->saveShareMoney();
        } catch (\Exception $exception) {
            \Yii::error('分销佣金记录失败：' . $exception->getMessage());
        }
        return $this;
    }

    /**
     * 购物车商品购买后删除
     */
    protected function deleteCartGoods()
    {
        \Yii::warning('diyForm订单 无购物车商品');
    }
}