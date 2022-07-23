<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/22
 * Time: 5:16 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\helpers\Json;
use app\models\Order;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonWeeklyBuyGoods;
use app\plugins\weekly_buy\forms\common\week_status\WeekStatusFactory;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;

class OrderDetailForm extends Model
{
    public $order_id;
    public $page;

    public function rules()
    {
        return [
            [['order_id', 'page'], 'integer'],
            [['page'], 'default', 'value' => 1],
        ];
    }

    public function detail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $order = Order::findOne(['id' => $this->order_id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id]);
            if (!$order) {
                throw new WeeklyBuyException('订单不存在');
            }

            $commonWeeklyBuyGoods = CommonWeeklyBuyGoods::getInstanceByOrder($order);

            $expressList = WeeklyBuyExpress::find()->with(['orderDetailExpress', 'orderClerk', 'clerkUser'])->where([
                'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'order_id' => $order->id
            ])->orderBy(['week_number' => SORT_DESC])->page($pagination, 3, $this->page)->all();
            $newExpressList = [];
            /** @var WeeklyBuyExpress $item */
            foreach ($expressList as $item) {
                $newExpressList[] = $commonWeeklyBuyGoods->expressInfo($item);
            }
            return $this->success([
                'express_list' => $newExpressList,
                'now_express' => $commonWeeklyBuyGoods->nowExpress(),
                'pagination' => $pagination
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
