<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/4/13
 * Time: 17:55
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\handlers\orderHandler;


use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use app\core\mail\SendMail;
use app\core\sms\Sms;
use app\forms\common\CommonAppConfig;
use app\forms\common\CommonBuyPrompt;
use app\forms\common\card\CommonSend;
use app\forms\common\coupon\CommonCouponAutoSend;
use app\forms\common\coupon\CommonCouponGoodsSend;
use app\forms\common\goods\CommonGoods;
use app\forms\common\message\MessageService;
use app\forms\common\mptemplate\MpTplMsgDSend;
use app\forms\common\mptemplate\MpTplMsgSend;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\share\CommonShare;
use app\forms\common\template\TemplateList;
use app\forms\common\template\order_pay_template\OrderPayInfo;
use app\models\CouponAutoSend;
use app\models\Order;
use app\models\OrderPayResult;
use app\models\User;
use app\models\UserCard;
use app\models\UserCoupon;
use app\plugins\mch\forms\common\MchSuccessInfo;
use app\plugins\mch\models\Mch;
use app\plugins\ttapp\models\TtappOrder;

/**
 * @property User $user
 */
abstract class BaseOrderPayedHandler extends BaseOrderHandler
{
    public $user;

    /**
     * @return $this
     * 保存支付完成处理结果
     */
    protected function saveResult()
    {
        $cardList = $this->sendCard();
        $userCouponList = $this->sendCoupon();
        $userCouponList = array_merge($userCouponList, $this->sendCouponUse(), $this->sendCouponByGoods());
        $data = [
            'card_list' => $cardList,
            'user_coupon_list' => $userCouponList,
        ];

        $sendData = $this->setSendData();
        $data = array_merge($data, $sendData);


        $orderPayResult = new OrderPayResult();
        $orderPayResult->order_id = $this->event->order->id;
        $orderPayResult->data = $orderPayResult->encodeData($data);
        $orderPayResult->save();
        return $this;
    }

    protected function setSendData()
    {
        try {
            $setting = \Yii::$app->mall->getMallSetting([
                'has_send',
                'give_type',
                'send_bg',
                'send_text_color',
                'send_num_type',
                'send_num_money_max',
                'send_num_overlapping',
                'send_num',
                'send_limit',
                'has_rubik',
                'rubik_data',
            ]);

            $newData = [];
            // 抽奖设置
            if ($setting['has_send']) {
                $data['give_type'] = $setting['give_type'];
                $data['send_bg'] = $setting['send_bg'];
                $data['send_text_color'] = $setting['send_text_color'];
                $data['send_num'] = 0;
                // 按金额赠送
                if ($setting['send_num_type'] == 'money') {
                    $price = $this->event->order->total_pay_price;
                    // 叠加
                    if ($setting['send_num_overlapping'] == 1) {
                        $data['send_num'] = floor($price / $setting['send_num_money_max']) * $setting['send_num'];
                    } else {
                        $data['send_num'] = $price > $setting['send_num_money_max'] ? $setting['send_num'] : 0;
                    }  
                } else {
                    $data['send_num'] = $setting['send_num'];
                }

                $startTime = date('Y-m-d', time()) . ' 00:00:00';
                $endTime = date('Y-m-d', time()) . ' 23:59:59';
                $orderIds = Order::find()->andWhere([
                    'mall_id' => \Yii::$app->mall->id, 
                    'is_delete' => 0, 
                    'is_pay' => 1,
                    'user_id' => $this->event->order->user_id
                ])
                    ->andWhere(['>=', 'created_at', $startTime])
                    ->andWhere(['<=', 'created_at', $endTime])
                    ->select('id');
                $list = OrderPayResult::find()->andWhere(['order_id' => $orderIds])->all();

                $oldSendNum = 0;
                foreach ($list as $item) {
                    $itemData = json_decode($item->data, true);
                    if (isset($itemData['pay_send_data']['send_num'])) {
                        $oldSendNum += $itemData['pay_send_data']['send_num'];
                    }
                }

                $number = $oldSendNum + $data['send_num'];
                if ($oldSendNum > $setting['send_limit']) {
                    $data['send_num'] = 0;
                } else if ($number > $setting['send_limit']) {
                    $data['send_num'] = $setting['send_limit'] - $oldSendNum;
                } 

                $permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
                if ($data['send_num'] > 0 && is_array($permission) && in_array($data['give_type'], $permission)) {
                    $newData['pay_send_data'] = $data;
                    $this->sendLottery($this->event->order->user, $data['give_type'], $data['send_num']);
                }
            }

            if ($setting['has_rubik']) {
                $newData['rubik_data'] = $setting['rubik_data'];
            }
            return $newData;
        }catch(\Exception $exception) {
            \Yii::error('订单赠送数据异常');
            \Yii::error($exception);
            return [];
        }
    }

    protected function sendLottery($user, $type, $limit)
    {
        $newLimit = 0;
        try {
            switch ($type) {
                case 'pond':
                    $className = '\app\plugins\pond\models\PondBout';
                    $pluginName = (new \app\plugins\pond\Plugin())->getDisplayName();
                    break;
                case 'scratch':
                    $className = '\app\plugins\scratch\models\ScratchBout';
                    $pluginName = (new \app\plugins\scratch\Plugin())->getDisplayName();
                    break;
                default:
                    throw new \Exception('未知类型{$type}');
            }
            $sql = sprintf(
                'insert into %s(mall_id, user_id, bout, updated_at) VALUES(%s, %s, %s, "%s") ON DUPLICATE KEY UPDATE bout = %d + bout',
                $className::tableName(),
                $user->mall_id,
                $user->id,
                $limit,
                date('Y-m-d H:i:s'),
                $limit
            );
            $res = \Yii::$app->db->createCommand($sql)->execute();
            if (!$res) {
                throw new \Exception('赠送抽奖次数失败');
            }

            $newLimit = $limit;
            \Yii::warning('赠送抽奖次数完成');
        } catch(\Exception $exception) {
            \Yii::warning('赠送抽奖次数异常');
            \Yii::error($exception);
        }

        return $newLimit;
    }

    /**
     * @return array
     * 向用户发送商品卡券
     */
    protected function sendCard()
    {
        try {
            $cardSendForm = new CommonSend();
            $cardSendForm->mall_id = \Yii::$app->mall->id;
            $cardSendForm->user_id = $this->event->order->user_id;
            $cardSendForm->order_id = $this->event->order->id;
            /** @var UserCard[] $userCardList */
            $userCardList = $cardSendForm->save();
            $cardList = [];
            foreach ($userCardList as $userCard) {
                $cardList[] = $userCard->attributes;
            }
        } catch (\Exception $exception) {
            \Yii::error('卡券发放失败: ' . $exception->getMessage());
            $cardList = [];
        }
        return $cardList;
    }

    /**
     * @return array
     * 向用户发送优惠券（自动发送方案--订单支付成功发送优惠券）
     */
    protected function sendCoupon()
    {
        try {
            $couponSendForm = new CommonCouponAutoSend();
            $couponSendForm->event = CouponAutoSend::PAY;
            $couponSendForm->user = $this->user;
            $couponSendForm->mall = $this->mall;
            $userCouponList = $couponSendForm->send();
        } catch (\Exception $exception) {
            \Yii::error('优惠券发放失败: ' . $exception->getMessage());
            $userCouponList = [];
        }
        return $userCouponList;
    }

    /**
     * @return array
     * 向用户发送优惠券（购买商品赠送--订单支付成功发送优惠券）
     */
    protected function sendCouponByGoods()
    {
        try {
            $couponSendForm = new CommonCouponGoodsSend();
            $couponSendForm->user = $this->user;
            $couponSendForm->mall = $this->mall;
            $couponSendForm->order_id = $this->event->order->id;
            $userCouponList = $couponSendForm->send();
            \Yii::warning('购买商品赠送优惠券发放数据');
            \Yii::warning($userCouponList);
        } catch (\Exception $exception) {
            \Yii::error('商品赠送优惠券发放失败: ' . $exception->getMessage());
            $userCouponList = [];
        }
        return $userCouponList;
    }

    /**
     * 优惠券自动赠送规则
     * @return array
     */
    protected function sendCouponUse()
    {
        try {
            if ($this->event->order->use_user_coupon_id && $userCoupon = UserCoupon::findOne($this->event->order->use_user_coupon_id)) {
                $couponUseSendForm = new CommonCouponGoodsSend();
                $couponUseSendForm->user = $this->user;
                $couponUseSendForm->mall = $this->mall;
                $couponUseSendForm->order_id = $this->event->order->id;
                $couponData = $couponUseSendForm->useSend($userCoupon->coupon_id);
                return [$couponData];
            }
            throw new \Exception('订单或优惠券问题');
        } catch (\Exception $e) {
            \Yii::error('优惠券购赠失败：' . $e->getMessage());
            return [];
        }
    }

    /**
     * @return $this
     * 短信发送--新订单通知
     */
    protected function sendSms()
    {
        try {
            if ($this->orderConfig->is_sms != 1) {
                throw new \Exception('未开启短信提醒');
            }
            $sms = new Sms(['mch_id' => $this->event->order->mch_id]);
            $smsConfig = CommonAppConfig::getSmsConfig($this->event->order->mch_id);
            if ($smsConfig['status'] == 1 && $smsConfig['mobile_list']) {
                $sms->sendOrderMessage($smsConfig['mobile_list'], $this->event->order->order_no);
            }
        } catch (NoGatewayAvailableException $exception) {
            \Yii::error('短信发送: ' . $exception->getExceptions());
        } catch (\Exception $exception) {
            \Yii::error('短信发送: ' . $exception->getMessage());
        }
        return $this;
    }

    /**
     * @return $this
     * 邮件发送--新订单通知
     */
    protected function sendMail()
    {
        // 发送邮件
        try {
            if ($this->orderConfig->is_mail != 1) {
                throw new \Exception('未开启邮件提醒');
            }
            $mailer = new SendMail();
            $mailer->mall = $this->mall;
            $mailer->mch_id = $this->event->order->mch_id;
            $mailer->order = $this->event->order;
            $mailer->orderPayMsg();
        } catch (\Exception $exception) {
            \Yii::error('邮件发送: ' . $exception->getMessage());
        }
        return $this;
    }

    /**
     * @return $this
     * 首次付款成为下级
     */
    protected function becomeJuniorByFirstPay()
    {
        try {
            $commonShare = new CommonShare();
            $commonShare->mall = $this->mall;
            $commonShare->user = $this->user;
            $commonShare->bindParent($this->user->userInfo->temp_parent_id, 3);
        } catch (\Exception $exception) {
            \Yii::error('首次付款成为下级：' . $exception->getMessage());
        }
        return $this;
    }

    /**
     * @return $this
     * 下单成为分销商
     */
    protected function becomeShare()
    {
        try {
            $commonShare = new CommonShare();
            $commonShare->mall = $this->mall;
            $commonShare->becomeShareByAuto($this->event->order);
        } catch (\Exception $exception) {
            \Yii::error('下单成为分销商: ' . $exception->getMessage());
        }
        return $this;
    }

    /**
     * @return $this
     * 通过小程序模板消息发送给用户支付成功通知
     */
    protected function sendTemplate()
    {
        try {
            $order = $this->event->order;
            $goodsName = '';
            foreach ($order->detail as $orderDetail) {
                $goodsName .= $orderDetail->goods->name;
            }
            TemplateList::getInstance()->getTemplateClass(OrderPayInfo::TPL_NAME)->send([
                'order_no' => $order->order_no,
                'pay_time' => $order->pay_time,
                'price' => $order->total_pay_price,
                'goodsName' => $goodsName,
                'user' => $order->user,
                'page' => 'pages/order/index/index'
            ]);
        } catch (\Exception $exception) {
            \Yii::error('模板消息发送: ' . $exception->getMessage());
        }
        return $this;
    }

    /**
     * @return $this
     * 通过公众号向商家发送公众号消息
     */
    protected function sendMpTemplate()
    {
        if ($this->event->order->mch_id > 0) {
            \Yii::warning('多商户订单无需向平台管理员发送模板消息');
            return $this;
        }

        $goodsName = '';
        foreach ($this->event->order->detail as $detail) {
            $goodsInfo = json_decode($detail->goods_info, true);
            $goodsName .= isset($goodsInfo['goods_attr']['name']) ? $goodsInfo['goods_attr']['name'] : '';
        }
        try {
            $tplMsg = new MpTplMsgSend();
            $tplMsg->method = 'newOrderTpl';
            $tplMsg->params = [
                'sign' => $this->event->order->sign,
                'goods' => $goodsName,
                'time' => date('Y-m-d H:i:s'),
                'user' => $this->user->nickname,
                'total_pay_price' => $this->event->order->total_pay_price,
            ];
            $tplMsg->sendTemplate(new MpTplMsgDSend());
        } catch (\Exception $exception) {
            \Yii::error('公众号模板消息发送: ' . $exception->getMessage());
        }
        return $this;
    }


    protected function sendTemplateMsgToMch()
    {
        if ($this->event->order->mch_id == 0) {
            return $this;
        }
        \Yii::warning('多商户发送商家模板消息');

        try {
            /** @var Mch $mch */
            $mch = Mch::find()->where(['id' => $this->event->order->mch_id])->with('user')->one();
            if (!$mch) {
                throw new \Exception('商户不存在,商户审核订阅消息发送失败');
            }

            if (!$mch->user) {
                throw new \Exception('用户不存在,商户审核订阅消息发送失败');
            }

            TemplateList::getInstance()->getTemplateClass(MchSuccessInfo::TPL_NAME)->send([
                'order_no' => $this->event->order->order_no,
                'price' => $this->event->order->total_pay_price,
                'time' => $this->event->order->created_at,
                'remark' => $this->event->order->remark ? '备注:' . $this->event->order->remark : '有用户下单,请尽快处理',
                'user' => $mch->user,
                'page' => 'plugins/mch/mch/order/order?mch_id=' . $this->event->order->mch_id
            ]);
        } catch (\Exception $exception) {
            \Yii::error('模板消息发送: ' . $exception->getMessage());
        }
        try {
            \Yii::warning('----消息发送提醒----');
            if (!$mch->user->mobile) {
                throw new \Exception('用户未绑定手机号无法发送');
            }
            $messageService = new MessageService();
            $messageService->user = $mch->user;
            $messageService->content = [
                'mch_id' => $this->event->order->mch_id,
                'args' => [\Yii::$app->mall->name]
            ];
            $messageService->platform = PlatformConfig::getInstance()->getPlatform($mch->user);
            $messageService->tplKey = OrderPayInfo::TPL_NAME;
            $res = $messageService->templateSend();
        } catch (\Exception $exception) {
            \Yii::error('向用户发送短信消息失败');
            \Yii::error($exception);
        }

        return $this;
    }

    /**
     * @return $this
     * 向小程序端发送购买提示消息
     */
    protected function sendBuyPrompt()
    {
        \Yii::warning('购买提示消息');
        if (count($this->event->order->detail) > 0) {
            $details = $this->event->order->detail;
            $goods = $details[0]->goods;
            $goodsId = $goods->id;
            $goodsName = $goods->name;
        } else {
            $goodsId = 0;
            $goodsName = '';
        }
        try {
            $buy_data = new CommonBuyPrompt();
            $buy_data->nickname = $this->user->nickname;
            $buy_data->avatar = $this->user->userInfo->avatar;
            $buy_data->url = '/pages/goods/goods/id=' . $goodsId;
            $buy_data->goods_name = $goodsName;
            $buy_data->set();
        } catch (\Exception $exception) {
            \Yii::error('首页购买提示失败: ' . $exception->getMessage());
        }
        return $this;
    }

    protected function setGoods()
    {
        \Yii::warning('商品支付信息设置');
        try {
            CommonGoods::getCommon()->setGoodsPayment($this->event->order, 'add');
            CommonGoods::getCommon()->setGoodsSales($this->event->order);
        } catch (\Exception $exception) {
            \Yii::error('商品支付信息设置');
            \Yii::error($exception);
        }
        return $this;
    }

    /**
     * @return $this
     * 向用户发送短信提醒
     */
    protected function sendSmsToUser()
    {
        try {
            \Yii::warning('----消息发送提醒----');
            $order = $this->event->order;
            if (!$order->user->mobile) {
                throw new \Exception('用户未绑定手机号无法发送');
            }
            $messageService = new MessageService();
            $messageService->user = $order->user;
            $messageService->content = [
                'mch_id' => $order->mch_id,
                'args' => [\Yii::$app->mall->name]
            ];
            $messageService->platform = PlatformConfig::getInstance()->getPlatform($order->user);
            $messageService->tplKey = OrderPayInfo::TPL_NAME;
            $res = $messageService->templateSend();
        } catch (\Exception $exception) {
            \Yii::error('向用户发送短信消息失败');
            \Yii::error($exception);
        }
        return $this;
    }

    // 保存需要分账的订单
    protected function saveTtOrder()
    {
        try {
            $plugin = \Yii::$app->plugin->getPlugin('ttapp');
            $plugin->saveTtOrder($this->event->order->order_no, 'order');
        }catch(\Exception $exception) {
            \Yii::error('分账订单创建异常');
            \Yii::error($exception);
        }
    }
}
