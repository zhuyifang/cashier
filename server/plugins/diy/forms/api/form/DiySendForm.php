<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\plugins\diy\forms\api\form;

use app\core\mail\SendMail;
use app\forms\common\card\CommonCard;
use app\forms\common\coupon\CommonCoupon;
use app\forms\common\coupon\CouponMallRelation;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\template\TemplateList;
use app\models\Coupon;
use app\models\GoodsCards;
use app\models\MailSetting;
use app\models\Mall;
use app\models\MallMembers;
use app\plugins\diy\forms\common\message\FormSubmitInfo;
use app\plugins\diy\forms\common\message\MessageService;


class DiySendForm
{
    public function getSendData($buttonData, $num = 1)
    {
        $sendData = [];
        $permission = \Yii::$app->mall->role->permission;
        // 开启赠送
        if ($buttonData['after_trigger'] == 'event' && $buttonData['after_send_status'] == 1) {
            foreach ($buttonData['after_send_type'] as $item) {
                switch ($item) {
                    // 余额
                    case 1:
                        $sendData['send_balance'] = price_format($buttonData['after_send_price']) * $num;
                        break;
                    // 积分
                    case 2:
                        $sendData['send_integral'] = $buttonData['after_send_integral'] * $num;
                        break;
                    // 优惠券
                    case 8:
                        if (in_array('coupon', $permission)) {
                            foreach ($buttonData['after_send_coupon'] as &$item) {
                                $item['send_num'] = $item['send_num'] * $num;
                            }
                            unset($item);
                            $sendData['send_coupon_list'] = $buttonData['after_send_coupon'];
                        }
                        break;
                    // 卡券
                    case 16:
                        foreach ($buttonData['after_send_card'] as &$item) {
                            $item['num'] = $item['num'] * $num;
                        }
                        unset($item);
                        $sendData['send_card_list'] = $buttonData['after_send_card'];
                        break;
                    // 会员
                    case 4:
                        $member = MallMembers::findOne([
                            'id' => $buttonData['after_send_member_id'],
                            'status' => 1,
                            'is_delete' => 0,
                        ]);
                        $sendData['send_member'] = $buttonData['after_send_member_id'];
                        $sendData['send_member_name'] = $member ? $member->name : $buttonData['after_send_member_name'];
                        break;
                    // 抽奖
                    case 32:
                        if ($buttonData['after_send_plugin'] == 'scratch' && in_array('scratch', $permission)) {
                            $sendData['send_scratch'] = $buttonData['after_send_lottery_limit'] * $num;
                        }

                        if ($buttonData['after_send_plugin'] == 'pond' && in_array('pond', $permission)) {
                            $sendData['send_pond'] = $buttonData['after_send_lottery_limit'] * $num;
                        }
                        break;
                    default:
                        throw new OrderException('赠送状态异常');
                        break;
                }
            }
        }

        return $sendData;
    }

    public function sendCard($snedCardList, $user)
    {
        $newSendCardList = [];
        try {
            $cards = $snedCardList;
            foreach ($cards as $card) {
                try {
                    $cardId = $card['id'];
                    $num = $card['num'];
                    $goodsCard = GoodsCards::find()->where(['id' => $cardId, 'is_delete' => 0])->one();
                    if (!$goodsCard) {
                        throw new \Exception('赠送卡券不存在, ID:' . $cardId);
                    }

                    $class = new CommonCard();
                    $class->user = $user;
                    $class->user_id = $user->id;
                    $res = $class->receive($goodsCard, 0, 0, '表单订单赠送', $num);

                    if (!$res) {
                        throw new \Exception(sprintf('%s(%s) 卡券赠送失败', $goodsCard->name, $goodsCard->id));
                    }
                    $newSendCardList[] = $card;
                }catch(\Exception $exception) {
                    \Yii::warning('赠送卡券异常');
                    \Yii::error($exception);
                }
            }
            \Yii::warning('赠送卡券完成');
        } catch (\Exception $e) {
            \Yii::warning('赠送卡券异常');
            \Yii::error($e->getMessage());
        }

        return $newSendCardList;
    }

    /**
     * @return array
     * 向用户发送优惠券（自动发送方案--订单支付成功发送优惠券）
     */
    public function sendCoupon($sendCouponList, $user)
    {
        $newSendCouponList = [];
        try {
            foreach ($sendCouponList as $item) {
                try {
                    $commonCoupon = new CommonCoupon();
                    $commonCoupon->mall = Mall::findOne($user->mall_id);
                    $commonCoupon->user = $user;

                    $coupon = Coupon::findOne([
                        'id' => $item['coupon_id'],
                        'is_delete' => 0,
                    ]);

                    if (!$coupon) {
                        throw new \Exception('优惠券不存在');
                    }

                    $relation = new CouponMallRelation($coupon);
                    $result = $commonCoupon->receive($coupon, $relation, 'diyForm表单赠送', $item['send_num']) === true;

                    if (!$result) {
                        throw new \Exception('赠送优惠券失败');
                    }
                    $newSendCouponList[] = $item;
                }catch(\Exception $exception) {
                    \Yii::error('赠送优惠券异常');
                    \Yii::error($exception);
                }
            }
            \Yii::warning('赠送优惠券完成');
        } catch (\Exception $exception) {
            \Yii::error('赠送优惠券异常');
            \Yii::error($exception);
        }

        return $newSendCouponList;
    }

    /**
     * 通过小程序模板消息发送给用户支付成功通知
     */
    public function sendTemplate($buttonData, $user, $created_at)
    {
        \Yii::warning('订阅消息');
        if (isset($buttonData['message_status']) && $buttonData['message_status']) {
            $delay = 0;
            if ($buttonData['m_send_type'] == 'date') {
                $delay = price_format(strtotime($buttonData['m_send_date']) - time());
            }
            if (isset($buttonData['m_subscribe']) && $buttonData['m_subscribe']) {
                $args = [
                    'path' => isset($buttonData['m_subscribe_link']) ? $buttonData['m_subscribe_link']['url'] : '',
                    'content' => $buttonData['m_subscribe_content'],
                    'created_at' => $created_at,
                    'delay' => $delay
                ];

                try {
                    if ($args['delay'] < 0) {
                        throw new \Exception('超过发送时间，不发了');
                    }
                    TemplateList::getInstance()->getTemplateClass(FormSubmitInfo::TPL_NAME)->send([
                        'user' => $user,
                        'page' => $args['path'],
                        'content' => $args['content'],
                        'date' => $args['created_at'],
                        'delay' => $args['delay']
                    ]);
                } catch (\Exception $exception) {
                    \Yii::warning('订阅消息发送异常');
                    \Yii::warning($exception);
                }
            }
        }
    }

    /**
     * 向用户发送短信提醒
     */
    public function sendSmsToUser($buttonData, $user)
    {
        \Yii::warning('短信');
        if (isset($buttonData['message_status']) && $buttonData['message_status']) {
            $delay = 0;
            if ($buttonData['m_send_type'] == 'date') {
                $delay = price_format(strtotime($buttonData['m_send_date']) - time());
            }

            if (
                isset($buttonData['m_sms'])
                && $buttonData['m_sms']
                && isset($buttonData['m_sms_tempid'])
                && $buttonData['m_sms_tempid']
            ) {
                try {
                    $args = [
                        'template' => $buttonData['m_sms_tempid'],
                        'delay' => $delay
                    ];
                    
                    if ($args['delay'] < 0) {
                        throw new \Exception('超过发送时间，不发了');
                    }
                    if (!$user->mobile) {
                        throw new \Exception('用户未绑定手机号无法发送');
                    }
                    $messageService = new MessageService();
                    $messageService->user = $user;
                    $messageService->content = [
                        'mch_id' => 0,
                        'args' => []
                    ];
                    $messageService->platform = PlatformConfig::getInstance()->getPlatform($user);
                    $messageService->tplKey = 'diy';
                    $messageService->delay = $args['delay'];
                    $messageService->template = $args['template'];
                    $messageService->templateSend();
                } catch (\Exception $exception) {
                    \Yii::warning('短信消息发送异常');
                    \Yii::warning($exception);
                }
            }
        }
    }

    // 积分发放
    public function giveIntegral($sendData, $user)
    {
        $sendIntegral = 0;
        if (isset($sendData['send_integral']) && $sendData['send_integral']) {
            $integral = $sendData['send_integral'];
            try {
                \Yii::$app->currency->setUser($user)->integral->add(
                    $integral,
                    "DIY订单,赠送积分{$integral}"
                );
                \Yii::warning('赠送积分完成');
                $sendIntegral = $integral;
            } catch(\Exception $exception) {
                \Yii::error('赠送积分异常');
                \Yii::error($exception);
            }
        }

        return $sendIntegral;
    }

    // 余额发放
    public function giveBalance($sendData, $user)
    {
        $sendBalance = 0;
        if (isset($sendData['send_balance']) && $sendData['send_balance']) {
            $balance = $sendData['send_balance'];
            try {
                \Yii::$app->currency->setUser($user)->balance->add(
                    (float)$balance,
                    "DIY订单,赠送余额{$balance}"
                );
                \Yii::warning('赠送余额完成');
                $sendBalance = $balance;
            } catch(\Exception $exception) {
                \Yii::error('赠送余额异常');
                \Yii::error($exception);
            }
        }

        return $sendBalance;
    }

    public function sendDiyMember($sendData, $user)
    {
        $snedMember = 0;
        if (isset($sendData['send_member']) && $sendData['send_member']) {
            $memberId = $sendData['send_member'];
            try {
                $member = MallMembers::findOne([
                    'id' => $memberId,
                    'status' => 1,
                    'is_delete' => 0,
                ]);

                if (!$member) {
                    throw new \Exception('会员不存在或未开启');
                }

                $snedMember = $member->name;
                if ($user->identity->member_level >= $member->level) {
                    throw new \Exception('用户会员等级高于或等于赠送等级');
                }

                $desc = sprintf('赠送会员成功：%s(%s)', $member->name, $member->id);
                $user->identity->member_level = $member->level;
                $user->identity->save();

                \Yii::warning('赠送会员完成');
            } catch(\Exception $exception) {
                \Yii::error('赠送会员异常');
                \Yii::error($exception);
            }
        }

        return $snedMember;
    }

    public function sendLottery($user, $type, $limit)
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

    public function sendMail($mall)
    {
        // 发送邮件
        try {
            $model = MailSetting::findOne([
                'mall_id' => $mall->id,
                'is_delete' => 0,
                'mch_id' => 0
            ]);

            if ($model->status != 1) {
                throw new \Exception('邮件未开启');
            }
            
            $mailer = new SendMail();
            $mailer->mall = $mall;
            $mailer->mailSetting = $model;
            $mailer->diyForm();
        } catch (\Exception $exception) {
            \Yii::error('邮件发送: ' . $exception->getMessage());
        }
    }
}