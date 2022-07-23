<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/13
 * Time: 11:01 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api;

use app\core\response\ApiCode;
use app\forms\common\goods\CommonGoodsDetail;
use app\forms\common\goods\GoodsAuth;
use app\models\CityDeliverySetting;
use app\models\Goods;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\CommonSetting;
use app\plugins\weekly_buy\forms\common\week_status\WeekStatusFactory;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyGroups;

class DetailForm extends Model
{
    public $goods_id;

    public function rules()
    {
        return [
            [['goods_id'], 'integer']
        ];
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $form = new CommonGoodsDetail();
            $form->user = \Yii::$app->user->identity;
            $form->mall = \Yii::$app->mall;
            $form->setIsLimitBuy(true);
            $goods = $form->getGoods($this->goods_id);
            if (!$goods) {
                throw new WeeklyBuyException('商品不存在');
            }
            if (!GoodsAuth::create($goods->sign)->checkShowAuth($goods)) {
                throw new WeeklyBuyException('您暂无权限查看商品');
            }

            $form->goods = $goods;
            $setting = CommonSetting::getInstance()->getSetting();
            $form->setMember($setting['is_member_price'] == 1);
            $form->setShare($setting['is_share'] == 1);
            $form->setIsLimit($setting['is_territorial_limitation'] == 1);
            $res = $form->getAll();
            $weeklyBuyGoods = WeeklyBuyGoods::findOne(['goods_id' => $goods->id, 'mall_id' => \Yii::$app->mall->id]);
            if ($weeklyBuyGoods->freight_type == 1) {
                $res['express'] = $weeklyBuyGoods->freight;
            }
            switch ($weeklyBuyGoods->shipping_type) {
                case 1:
                    $res['goods_marketing']['shipping'] = sprintf('订单满%s期包邮', $weeklyBuyGoods->shipping_number);
                    break;
                case 2:
                    $res['goods_marketing']['shipping'] = sprintf('订单满%s额包邮', $weeklyBuyGoods->shipping_price);
                    break;
                default:
                    $res['goods_marketing']['shipping'] = '';
            }
            $weekStatus = WeekStatusFactory::create($weeklyBuyGoods->week_type);
            $res['plugin'] = [
                'start_time' => $weeklyBuyGoods->start_time,
                'end_time' => $weeklyBuyGoods->end_time,
                'week_type' => $weeklyBuyGoods->week_type,
                'reset_time' => $weeklyBuyGoods->is_no_end_time == 0 ? strtotime($weeklyBuyGoods->end_time) - time() : 0,
                'is_no_end_time' => $weeklyBuyGoods->is_no_end_time,
                'week_custom' => $weeklyBuyGoods->week_custom ?: '期数'
            ];
            $content = $weekStatus->getContent($weeklyBuyGoods);
            // 调整成数组
            $content['list'] = array_values($content['list']);
            $res['plugin'] = array_merge($res['plugin'], $content);
            $weeklyBuyGroups = WeeklyBuyGroups::find()
                ->with(['goods.attr', 'goods.share', 'goods.attr.memberPrice'])
                ->andWhere([
                    'is_delete' => 0, 'weekly_buy_goods_id' => $weeklyBuyGoods->id
                ])->all();

            $stockList = [];
            foreach ($res['attr'] as $attr) {
                $stockList[$attr['sign_id']] = $attr['stock'];
            }
            /* @var WeeklyBuyGroups[] $weeklyBuyGroups */
            foreach ($weeklyBuyGroups as $weeklyBuyGroup) {
                $form->goods = $weeklyBuyGroup->goods;
                $groupGoods = $form->getAll(['attr', 'price_min', 'price_max', 'share']);
                $res['share'] = max($groupGoods['share'], $res['share']);
                $priceList = [];
                foreach ($groupGoods['attr'] as &$gAttr) {
                    $priceList[] = $gAttr['price_member'];
                    $gAttr['stock'] = $stockList[$gAttr['sign_id']];
                }
                unset($gAttr);
                $res['groups'][] = [
                    'group_id' => $weeklyBuyGroup->id,
                    'goods_id' => $weeklyBuyGoods->goods_id,
                    'number' => $weeklyBuyGroup->number,
                    'attr' => $groupGoods['attr'],
                    'price_min' => $groupGoods['price_min'],
                    'price_max' => $groupGoods['price_max'],
                    'member_price_min' => min($priceList),
                    'member_price_max' => max($priceList),
                    'title' => $weeklyBuyGroup->title,
                ];
            }
            $res['price_min'] = min(array_column($res['groups'], 'price_min'));
            $res['price_max'] = max(array_column($res['groups'], 'price_max'));
            $res['price_member_max'] = max(array_column($res['groups'], 'member_price_max'));
            $res['price_member_min'] = min(array_column($res['groups'], 'member_price_min'));
            $model = CityDeliverySetting::findOne([
                'key' => 'address', 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id
            ]);
            $this->setLog($goods);
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => 'success',
                'data' => [
                    'goods' => $res,
                    'delivery' => !empty($model) ? $model->value : ''
                ]
            ];
        } catch (\Exception $e) {
            \Yii::error($e);
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'errors' => $e->getLine()
            ];
        }
    }

    /**
     * @param Goods $goods
     */
    private function setLog($goods)
    {
        $goods->detail_count += 1;
        $goods->save();
    }
}
