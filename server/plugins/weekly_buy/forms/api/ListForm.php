<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 5:01 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\api;

use app\forms\api\goods\ApiGoods;
use app\forms\common\goods\CommonGoodsList;
use app\forms\common\goods\CommonGoodsMember;
use app\plugins\weekly_buy\forms\common\CommonSetting;
use app\plugins\weekly_buy\forms\common\week_status\WeekStatusFactory;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\Goods;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\Plugin;

class ListForm extends Model
{
    public $page;
    public $keyword;

    public function rules()
    {
        return [
            [['page'], 'integer'],
            [['page'], 'default', 'value' => 1],
            [['keyword'], 'trim'],
            [['keyword'], 'string'],
        ];
    }

    public function getList($diyGoodsIds = null)
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $setting = CommonSetting::getInstance()->getSetting();
            $form = new CommonGoodsList();
            $form->model = Goods::className();
            $form->status = 1;
            if ($diyGoodsIds) {
                $form->limit = 9999;
                $form->goods_id = $diyGoodsIds;
            } else {
                $goodsIds = WeeklyBuyGoods::find()->where([
                    'mall_id' => \Yii::$app->mall->id, 'weekly_buy_goods_id' => 0,
                    'is_delete' => 0
                ])->andWhere(['<=', 'start_time', mysql_timestamp()])
                    ->andWhere([
                        'or',
                        [
                            'and',
                            ['>', 'end_time', mysql_timestamp()],
                            ['is_no_end_time' => 0]
                        ],
                        ['is_no_end_time' => 1]
                    ])
                    ->select('goods_id');
                $form->goods_id = $goodsIds;
            }
            $form->keyword = $this->keyword;
            $form->page = $this->page;
            $form->mch_id = 0;
            $form->is_array = false;
            $form->sign = (new Plugin())->getName();
            $form->isSignCondition = true;
            $form->is_sales = \Yii::$app->mall->getMallSettingOne('is_sales');
            $form->relations = ['goodsWarehouse', 'mallGoods', 'attr', 'weeklyBuyGoods.groups.goods'];
            $form->deleteAttr = true;
            $form->is_show = 1;
            $list = $form->search();
            $newList = [];
            $apiGoods = ApiGoods::getCommon();
            $user = null;
            if (!\Yii::$app->user->isGuest) {
                $user = \Yii::$app->user->identity;
            }
            /** @var Goods $goods */
            foreach ($list as $goods) {
                $weekStatus = WeekStatusFactory::create($goods->weeklyBuyGoods->week_type);
                $item = array_merge($form->getGoodsData($goods), [
                    'type_name' => $weekStatus->typeName($goods->weeklyBuyGoods)
                ]);
                $levelPrice = [];
                $priceList = [];
                foreach ($goods->weeklyBuyGoods->groups as $weeklyBuyGoods) {
                    $apiGoods->goods = $weeklyBuyGoods->goods;
                    if ($item['level_price'] !== -1) {
                        $levelPrice[] = $apiGoods->getGoodsMember($user);
                    }
                    $priceList[] = $apiGoods->getMinPrice();
                }
                if ($item['level_price'] !== -1) {
                    $item['level_price'] = min($levelPrice);
                }
                $item['price'] = min($priceList);
                $item['price_content'] = $apiGoods->getPriceContent($item['is_negotiable'], $item['price']);
                $newList[] = $item;
            }
            return $this->success([
                'list' => $newList,
                'banner' => $setting['banner']
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
