<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/14
 * Time: 3:09 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common;

use app\forms\common\order\CommonOrder;
use app\helpers\Json;
use app\models\Mall;
use app\models\Order;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\week_status\WeekStatusFactory;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\jobs\AutoDelayJob;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;

class CommonWeeklyBuyGoods extends Model
{
    /**
     * @var Mall $mall
     */
    public $mall;

    /**
     * @var WeeklyBuyGoods $weeklyBuyGoods
     */
    public $weeklyBuyGoods;

    /**
     * @var array|Order $order
     */
    public $order;

    /**
     * @var integer $week_number
     * 总期数
     */
    public $week_number;

    /**
     * @var integer $week_key
     * 配送方式
     */
    public $week_key;

    public static function getInstance($mall = null)
    {
        if (!$mall) {
            $mall = \Yii::$app->mall;
        }
        $instance = new self();
        $instance->mall = $mall;
        return $instance;
    }

    /**
     * @param Order $order
     * @return CommonWeeklyBuyGoods
     * 根据订单创建
     */
    public static function getInstanceByOrder($order, $mall = null)
    {
        $goodsInfo = $order->detail[0]->goods_info;
        $goodsInfo = Json::decode($goodsInfo, true);
        $goodsAttr = $goodsInfo['goods_attr'];
        $instance = CommonWeeklyBuyGoods::getInstance($mall);
        $instance->order = $order;
        $instance->weeklyBuyGoods = new WeeklyBuyGoods();
        $instance->weeklyBuyGoods->attributes = $goodsAttr['weeklyBuyGoods'];
        $instance->week_number = $goodsAttr['week_number'];
        $instance->week_key = $goodsAttr['week_key'];
        return $instance;
    }

    /**
     * @return false|float|int
     * 提前的时间
     */
    public function beforeTime()
    {
        $beforeDay = $this->weeklyBuyGoods->before_day;
        if (!$this->isBeforeTime()) {
            $beforeDay++;
        }
        return $this->time() + $beforeDay * 86400;
    }

    /**
     * @return bool
     * 是否是提前支付
     */
    public function isBeforeTime()
    {
        return date('H', $this->time()) < $this->weeklyBuyGoods->last_time;
    }

    /**
     * @return false|int
     * 计算提前的当前时间
     */
    public function time()
    {
        $time = time();
        if (!empty($this->order) && $this->order['is_pay'] == 1) {
            $time = strtotime($this->order['pay_time']);
        }
        return $time;
    }

    /**
     * @param $weekNumber
     * @param $weekKey
     * @return WeeklyBuyExpress
     * @throws WeeklyBuyException
     * 生成周期信息
     */
    public function createExpress($weekNumber, $weekKey)
    {
        $express = new WeeklyBuyExpress();
        $express->week_number = $weekNumber;
        $express->order_id = $this->order->id;
        $express->mall_id = \Yii::$app->mall->id;
        $express->order_detail_id = $this->order->detail[0]->id;
        $express->order_detail_express_id = 0;
        $express->is_delete = 0;
        $weekStatus = WeekStatusFactory::create($this->weeklyBuyGoods->week_type);
        if ($weekNumber == 1) {
            $sendTime = $weekStatus->leastTime($this, $weekKey);
        } else {
            $last = WeeklyBuyExpress::findOne([
                'order_id' => $this->order->id, 'week_number' => $weekNumber - 1, 'is_delete' => 0
            ]);
            $sendTime = $weekStatus->nextTime(strtotime($last->send_time), $weekKey, $this);
        }

        $express->send_time = date('Y-m-d', $sendTime);
        $delay = strtotime('+1 day', strtotime($express->send_time)) - time();
        \Yii::$app->queue3->delay($delay > 0 ? $delay : 0)->push(new AutoDelayJob([
            'week_number' => $express->week_number,
            'order_id' => $express->order_id,
            'mall_id' => \Yii::$app->mall->id
        ]));
        return $express;
    }

    /**
     * @return bool|int|string|null
     * 获取已延期数量
     */
    public function getDelayCount()
    {
        return WeeklyBuyExpress::find()->where([
            'order_id' => $this->order->id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id
        ])->andWhere(['>', 'is_delay', 0])
            ->count();
    }

    /**
     * @return bool|int|string|null
     * 获取成功顺延数量
     */
    public function getDelayCountSuccess()
    {
        return WeeklyBuyExpress::find()->where([
            'order_id' => $this->order->id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id
        ])->andWhere(['>', 'is_delay', 0])->andWhere(['<', 'send_time', date('Y-m-d')])
            ->count();
    }

    /**
     * @return bool|int|string|null
     * 获取用户已延期数量
     */
    public function getDelayCountByUser()
    {
        return WeeklyBuyExpress::find()->where([
            'order_id' => $this->order->id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id, 'is_delay' => 1
        ])->andWhere(['<', 'send_time', date('Y-m-d')])
            ->andWhere(['MONTH(delay_time)' => date('m')])
            ->count();
    }

    /**
     * @return float|int
     * 获取可延期的时间
     */
    public function getDelayTime()
    {
        return strtotime(date('Y-m-d')) + $this->weeklyBuyGoods->delay * 86400;
    }

    /**
     * @return \array[][]
     * @throws \app\plugins\weekly_buy\exceptions\WeeklyBuyException
     * 订单信息
     */
    public function orderInfo()
    {
        $goodsInfo = $this->order['detail'][0]['goods_info'];
        if (!is_array($goodsInfo) && !is_object($goodsInfo)) {
            $goodsInfo = Json::decode($goodsInfo, true);
        }
        $goodsAttr = $goodsInfo['goods_attr'];
        if (!$this->order instanceof Order) {
            $newOrder = new Order();
            $newOrder->id = $this->order['id'];
            $newOrder->attributes = $this->order;
            $this->order = $newOrder;
        }
        $this->weeklyBuyGoods = new WeeklyBuyGoods();
        $this->weeklyBuyGoods->attributes = $goodsAttr['weeklyBuyGoods'];
        $weekStatus = WeekStatusFactory::create($this->weeklyBuyGoods->week_type);
        $sendTime = $weekStatus->orderText($this, $goodsAttr['week_key']);
        $this->week_number = $goodsAttr['week_number'];
        $expressList = WeeklyBuyExpress::find()->with(['orderDetailExpress', 'orderClerk', 'clerkUser'])->where([
            'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'order_id' => $this->order['id']
        ])->orderBy(['week_number' => SORT_DESC])->limit(3)->all();
        krsort($expressList);
        $expressList = array_values($expressList);
        $newExpressList = [];
        $canShow = 1;
        $weekNumber = $this->week_number;
        $delayCount = $this->getDelayCount();
        $weekContent = '';
        if ($delayCount > 0) {
            $weekNumber += $delayCount;
            $weekContent = sprintf('您已顺延%d期，现配送周期共%d期', $delayCount, $weekNumber);
        }
        /** @var WeeklyBuyExpress $item */
        foreach ($expressList as $key => $item) {
            if ($canShow <= 0) {
                continue;
            }
            if ($item->is_confirm == 1 && $this->week_number != $item->week_number) {
                $newExpressList = [];
                continue;
            }
            if ($item->is_send == 1) {
                $canShow = 1;
            }
            if ($item->is_delay > 0) {
                $canShow -= 0.5;
            } else {
                $canShow = 0;
            }
            if ($key == count($expressList) - 1 && count($newExpressList) >= 1 && $item->is_send == 1) {
                array_pop($newExpressList);
            }
            array_unshift($newExpressList, $this->expressInfo($item));
        }
        return [
            'extra' => [
                $this->order['sign'] => [
                    'week_number' => $weekNumber,
                    'send_week' => sprintf('%s，共%d期', $weekStatus->typeName($this->weeklyBuyGoods), $weekNumber),
                    'send_time' => $sendTime,
                    'express_list' => $newExpressList,
                    'week_content' => $weekContent,
                    'origin_week_number' => $this->week_number,
                    'now_express' => $this->nowExpress(),
                    'freight_type' => $this->weeklyBuyGoods->freight_type
                ]
            ]
        ];
    }

    /**
     * @param WeeklyBuyExpress $express
     */
    public function expressInfo($express)
    {
        $clerkInfo = [];
        if ($express->orderClerk) {
            $clerkInfo['clerk_mark'] = $express->orderClerk->clerk_remark;
        }
        if ($express->clerkUser) {
            $clerkInfo['clerk_name'] = $express->clerkUser->user->nickname;
            $clerkInfo['store_name'] = $this->order->store->name;
        }
        $content = '';
        if ($express->is_delay & 7 && $express->send_time < date('Y-m-d')) {
            if ($express->delay_week_number > 0) {
                $content .= sprintf('注：已顺延至第%d期', $express->delay_week_number);
            }
            if ($express->week_number > $this->week_number && $express->delayExpress) {
                $content .= sprintf('注：由第%d期产生', $express->delayExpress->week_number);
            }
        }
        $delay = strtotime($express->send_time) < strtotime(date('Y-m-d'));
        return [
            'week_number' => $express->week_number,
            'is_send' => $express->is_send,
            'is_delay' => $express->is_delay,
            'is_confirm' => $express->is_confirm,
            'send_time' => date('Y-m-d', strtotime($express->send_time)),
            'express' => $this->order->send_type == 1 ? $clerkInfo : $express->orderDetailExpress,
            'confirm_url' => $express->is_send ? 'plugin/weekly_buy/mall/order/confirm' : '',
            'content' => $content,
            'confirm_time' => $express->confirm_time,
            'express_content' => $express->express_content,
            'is_exception' => $this->order->send_type == 1 && !$express->is_send && !$express->is_delay && $delay
        ];
    }

    public function nowExpress()
    {
        /** @var WeeklyBuyExpress $nowExpress */
        $nowExpress = WeeklyBuyExpress::find()->where([
            'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'order_id' => $this->order->id, 'is_confirm' => 0
        ])->andWhere(['>=', 'send_time', date('Y-m-d', time())])->orderBy(['week_number' => SORT_ASC])
            ->limit(1)->one();
        if (!$nowExpress) {
            $nowExpress = WeeklyBuyExpress::find()->where([
                'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'order_id' => $this->order->id,
            ])->orderBy(['week_number' => SORT_DESC])
                ->limit(1)->one();
        }
        if (!$nowExpress) {
            return null;
        }
        $nowSendTime = date('Y.m.d', strtotime($nowExpress->send_time));

        $weekStatus = WeekStatusFactory::create($this->weeklyBuyGoods->week_type);
        $nowWeek = $weekStatus->week[date('w', strtotime($nowExpress->send_time))];
        return [
            'week_number' => $nowExpress->week_number,
            'is_send' => $nowExpress->is_send,
            'is_delay' => $nowExpress->is_delay,
            'is_confirm' => $nowExpress->is_confirm,
            'send_time' => $nowSendTime,
            'send_content' => sprintf('预定%s发货（%s）', $nowSendTime, $nowWeek),
            'is_can_send' => $nowExpress->is_send == 0 && $nowExpress->is_delay == 0,
            'delay_url' => 'plugin/weekly_buy/api/admin/delay',
        ];
    }

    /**
     * @param WeeklyBuyExpress $express
     * @param integer $week_number 需要顺延的周期
     * 顺延操作
     */
    public function delay($express, $week_number)
    {
        if ($express->is_send == 1) {
            throw new WeeklyBuyException('当前期数已发货无法顺延或取消');
        }
        $delayTime = $this->getDelayTime();
        $delayCount = $this->getDelayCountSuccess();

        if ($delayCount + $this->week_number < $week_number) {
            throw new WeeklyBuyException('提交的期数超过总期数');
        }
        $currentExpress = $this->getCurrentExpress($week_number - 1);
        if ($currentExpress) {
            try {
                if ($currentExpress->is_send == 1 && $currentExpress->is_confirm == 0) {
                    $this->confirm($currentExpress);
                }
            } catch (\Exception $exception) {
                \Yii::error('自动确认收货');
            }
            if (!$currentExpress->isFinish()) {
                throw new WeeklyBuyException('上一期未完结，本期无法操作');
            }
        }
        if (strtotime($express->send_time) <= $delayTime && $express->is_delay & 1) {
            throw new WeeklyBuyException('超过可顺延时间，当前无法顺延');
        }
        if (
            $this->weeklyBuyGoods->delay_limit_type == 1
            && $this->getDelayCountByUser() >= $this->weeklyBuyGoods->delay_limit_number
            && $express->is_delay & 1
        ) {
            throw new WeeklyBuyException('本月已达到可顺延次数，当前无法顺延');
        }
        $express->delay_week_number = $delayCount + $this->week_number + 1;
        $express->delay_time = mysql_timestamp();
        return $express;
    }

    /**
     * @param WeeklyBuyExpress $express
     * @param integer $week_number 需要顺延的周期
     * 取消顺延操作
     */
    public function cancelDelay($express, $week_number)
    {
        if ($express->is_send == 1) {
            throw new WeeklyBuyException('当前期数已发货无法顺延或取消');
        }
        $delayTime = $this->getDelayTime();
        if (strtotime($express->send_time) <= $delayTime && $express->is_delay & 1) {
            throw new WeeklyBuyException('超过可取消顺延时间，当前无法取消');
        }
        $delayExpress = WeeklyBuyExpress::findOne([
            'order_id' => $this->order->id, 'week_number' => $express->delay_week_number, 'is_delete' => 0,
            'mall_id' => \Yii::$app->mall->id
        ]);
        if ($delayExpress) {
            $delayExpress->is_delete = 1;
            $delayExpress->save();
        }
        $express->is_delay = 0;
        $express->delay_week_number = 0;
        return $express;
    }

    /**
     * @param integer $next
     * @param callable|null $callback
     * @return bool true--下一周期创建成功 false--没有下一周期
     * @throws WeeklyBuyException
     * 创建下一周期
     */
    public function createNextExpress($next, $callback = null)
    {
        $result = false;
        if ($this->getDelayCount() + $this->week_number >= $next) {
            $nextExpress = WeeklyBuyExpress::findOne([
                'order_id' => $this->order->id, 'week_number' => $next, 'is_delete' => 0,
                'mall_id' => \Yii::$app->mall->id
            ]);
            if (!$nextExpress) {
                $nextExpress = $this->createExpress($next, $this->week_key);
                if (!$nextExpress->save()) {
                    throw new WeeklyBuyException($this->getErrorMsg($nextExpress));
                }
            }
            $result = true;
        }
        if (is_callable($callback)) {
            $callback($result);
        }
        return $result;
    }

    /**
     * @param $current
     * @return WeeklyBuyExpress|null
     * 获取上一期次
     */
    public function getCurrentExpress($current)
    {
        return WeeklyBuyExpress::findOne([
            'order_id' => $this->order->id, 'week_number' => $current, 'is_delete' => 0,
            'mall_id' => \Yii::$app->mall->id
        ]);
    }

    /**
     * @param WeeklyBuyExpress $weeklyBuyExpress
     * @throws WeeklyBuyException
     * 确认收货
     */
    public function confirm($weeklyBuyExpress)
    {
        if (!$weeklyBuyExpress) {
            throw new WeeklyBuyException('发货期数不存在，请刷重试');
        }
        if ($weeklyBuyExpress->is_send != 1) {
            throw new WeeklyBuyException('该周期订单尚未发货');
        }
        $weeklyBuyExpress->is_confirm = 1;
        $weeklyBuyExpress->confirm_time = mysql_timestamp();
        if (!$weeklyBuyExpress->save()) {
            throw new WeeklyBuyException($this->getErrorMsg($weeklyBuyExpress));
        }
        $delayCount = $this->getDelayCountSuccess();
        if ($delayCount + $this->week_number <= $weeklyBuyExpress->week_number) {
            CommonOrder::getCommonOrder($this->order->sign)->confirm($this->order);
        }
        return true;
    }
}
