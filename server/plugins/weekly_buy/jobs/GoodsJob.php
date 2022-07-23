<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/10
 * Time: 3:49 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\jobs;

use app\jobs\BaseJob;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\Goods;
use yii\queue\JobInterface;

class GoodsJob extends BaseJob implements JobInterface
{
    public $goodsId;
    public $mall_id;

    public function execute($queue)
    {
        $this->setRequest();
        \Yii::warning('周期购商品自动下架开始');
        $goods = Goods::findOne([
            'id' => $this->goodsId
        ]);
        if (!$goods) {
            \Yii::warning('商品不存在');
            return false;
        }
        if ($goods->weeklyBuyGoods && strtotime($goods->weeklyBuyGoods->end_time) <= time()) {
            $goods->status = 0;
            $res = $goods->save();
            if (!$res) {
                \Yii::warning((new Model())->getErrorMsg($goods));
                return false;
            }
            \Yii::warning('拼团商品自动下架执行完成');
        }
    }
}
