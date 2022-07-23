<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/10
 * Time: 4:34 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\forms\common\goods\CommonGoods;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyGroups;
use app\helpers\Json;

class GoodsForm extends Model
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '活动ID'
        ];
    }

    public function search()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $common = CommonGoods::getCommon();
            $goods = $common->getGoodsDetail($this->id);
            if (!$goods) {
                throw new WeeklyBuyException('商品不存在');
            }

            /** @var WeeklyBuyGoods $weeklyBuyGoods */
            $weeklyBuyGoods = WeeklyBuyGoods::findOne([
                'goods_id' => $this->id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0
            ]);
            if (!$weeklyBuyGoods) {
                throw new WeeklyBuyException('商品不存在');
            }

            $weeklyBuyGroups = WeeklyBuyGroups::find()->with(['goods.attr', 'goods.shareLevel'])
                ->where([
                    'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'weekly_buy_goods_id' => $weeklyBuyGoods->id
                ])->all();
            $groupList = [];
            /**  @var WeeklyBuyGroups[] $weeklyBuyGroups */
            foreach ($weeklyBuyGroups as $weeklyBuyGroup) {
                $newGoods = $common->transformAttr($weeklyBuyGroup->goods);
                $newItem = [
                    'number' => $weeklyBuyGroup->number,
                    'attr' => $newGoods['attr'],
                    'shareLevelList' => $common->getGoodsShare($weeklyBuyGroup->goods_id, true),
                    'title' => $weeklyBuyGroup->title,
                ];
                if ($weeklyBuyGroup->goods->use_attr != 1) {
                    $newItem['member_price'] = $newItem['attr'][0]['member_price'];
                }
                $groupList[] = $newItem;
            }
            $jsonArr = [
                'week_status_day', 'week_status_week', 'week_status_month', 'week_status_customize', 'week_loop',
                'month_loop'
            ];
            foreach ($jsonArr as $item) {
                $weeklyBuyGoods->$item = Json::decode($weeklyBuyGoods->$item, true, []);
            }
            $goods['plugin'] = $weeklyBuyGoods->toArray();
            $goods['group_list'] = $groupList;

            return $this->success([
                'detail' => $goods
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
