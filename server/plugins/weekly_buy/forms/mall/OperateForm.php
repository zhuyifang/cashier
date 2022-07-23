<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/12
 * Time: 9:52 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\Goods;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyGroups;

class OperateForm extends Model
{
    public $is_all;
    public $batch_ids;
    public $activity_status;

    public function rules()
    {
        return [
            [['is_all'], 'integer'],
            [['is_all'], 'default', 'value' => 0],
            [['activity_status'], 'default', 'value' => -1],
            [['batch_ids'], 'safe']
        ];
    }

    public function execute()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            if (!is_array($this->batch_ids)) {
                $this->batch_ids = [$this->batch_ids];
            }
            if ($this->is_all == 1) {
                $this->batch_ids = WeeklyBuyGoods::find()->where([
                    'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0
                ])->select('goods_id')->column();
            } else {
                $query = WeeklyBuyGoods::find()->where([
                    'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0,
                    'goods_id' => $this->batch_ids
                ])->select('id');
                $this->batch_ids = WeeklyBuyGoods::find()->where([
                    'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0
                ])->andWhere([
                    'or',
                    ['id' => $query],
                    ['weekly_buy_goods_id' => $query]
                ])->select('goods_id')->column();
            }
            switch ($this->activity_status) {
                case -1:
                    $this->delete();
                    break;
                case 0:
                    $this->down();
                    break;
                case 1:
                    $this->up();
                    break;
                default:
            }
            return $this->success([
                'msg' => '操作成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    protected function delete()
    {
        Goods::updateAll(['is_delete' => 1], ['is_delete' => 0, 'id' => $this->batch_ids]);
        WeeklyBuyGoods::updateAll(['is_delete' => 1], ['is_delete' => 0, 'goods_id' => $this->batch_ids]);
        WeeklyBuyGroups::updateAll(['is_delete' => 1], ['is_delete' => 0, 'goods_id' => $this->batch_ids]);
    }

    protected function down()
    {
        Goods::updateAll(['status' => 0], ['status' => 1, 'id' => $this->batch_ids]);
    }

    protected function up()
    {
        Goods::updateAll(['status' => 1], ['status' => 0, 'id' => $this->batch_ids]);
    }
}
