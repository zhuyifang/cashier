<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/24
 * Time: 2:18 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\models\Order;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;

class DelayForm extends Model
{
    public $week_number;

    public $order_id;

    public $operate;

    public function rules()
    {
        return [
            [['week_number', 'order_id'], 'required'],
            [['week_number', 'order_id'], 'integer'],
            [['operate'], 'in', 'range' => ['delay', 'cancel']]
        ];
    }

    public function activeAttributes()
    {
        return [
            'week_number' => '当前的期数',
            'order_id' => '订单id'
        ];
    }

    public function execute()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $express = WeeklyBuyExpress::findOne([
                'order_id' => $this->order_id, 'week_number' => $this->week_number, 'is_delete' => 0,
                'mall_id' => \Yii::$app->mall->id
            ]);
            $order = Order::findOne(['id' => $this->order_id, 'mall_id' => \Yii::$app->mall->id]);
            $order = Order::checkOrder($order);
            $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($order);

            if (!$express) {
                $express = $commonWeeklyBuyGoods->createExpress($this->week_number, $commonWeeklyBuyGoods->week_key);
            }
            switch ($this->operate) {
                case 'delay':
                    if ($express->is_delay > 0) {
                        throw new WeeklyBuyException('当前周期已顺延，请不要重复操作');
                    }
                    $express->is_delay = 2;
                    $express = $commonWeeklyBuyGoods->delay($express, $this->week_number);
                    break;
                case 'cancel':
                    $express = $commonWeeklyBuyGoods->cancelDelay($express, $this->week_number);
                    break;
                default:
                    throw new WeeklyBuyException('无效的操作');
            }

            if (!$express->save()) {
                throw new WeeklyBuyException($this->getErrorMsg($express));
            }
            $commonWeeklyBuyGoods->createNextExpress($this->week_number + 1);
            $transaction->commit();
            return $this->success([
                'msg' => '操作成功'
            ]);
        } catch (\Exception $exception) {
            $transaction->rollBack();
            return $this->failByException($exception);
        }
    }
}
