<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/10
 * Time: 3:28 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\jobs;

use app\jobs\BaseJob;
use app\models\Favorite;
use yii\queue\JobInterface;

class FavoriteAutoDelJob extends BaseJob implements JobInterface
{
    public $goods_id;
    public function execute($queue)
    {
        \Yii::error('周期购商品自动删除收藏开始，ID:' . $this->goods_id);
        if (!$this->goods_id) {
            return;
        }
        $t = \Yii::$app->db->beginTransaction();
        try {
            $count = Favorite::updateAll(['is_delete' => 1], ['goods_id' => $this->goods_id]);
            \Yii::error('周期购商品收藏删除' . $count, '条');
            $t->commit();
        } catch (\Exception $exception) {
            $t->rollBack();
            \Yii::error("周期购商品到期自动删除收藏夹:" . $exception->getMessage() . $exception->getFile() . $exception->getLine());
        }
    }
}
