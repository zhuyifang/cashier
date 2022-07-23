<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\plugins\weekly_buy\forms\api\poster;

use app\core\response\ApiCode;
use app\forms\common\poster\PosterConfigTrait;

use app\helpers\Json;
use app\models\Model;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\models\Goods;
use app\plugins\weekly_buy\models\WeeklyBuyGroups;
use app\plugins\weekly_buy\Plugin;

class PosterConfigForm extends Model
{
    use PosterConfigTrait;

    public $goods_id;

    public function rules()
    {
        return [
            [['goods_id'], 'required'],
            [['goods_id'], 'integer'],
        ];
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'data' => [
                    'config' => $this->getConfig(),
                    'info' => $this->getAll(),
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
            ];
        }
    }

    public function getPlugin(): array
    {
        return [
            'sign' => (new Plugin())->getName(),
        ];
    }

    public function getGoods(): array
    {
        /** @var Goods $goods */
        $goods = Goods::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'id' => $this->goods_id,
        ])->with(['weeklyBuyGoods'])->one();
        if (empty($goods)) {
            throw new WeeklyBuyException('海报商品不存在');
        }

        $weeklyBuyGroups = WeeklyBuyGroups::find()
            ->with(['goods.attr'])
            ->andWhere([
                'is_delete' => 0, 'weekly_buy_goods_id' => $goods->weeklyBuyGoods->id
            ])->all();
        $prices = [];
        /* @var WeeklyBuyGroups[] $weeklyBuyGroups */
        foreach ($weeklyBuyGroups as $weeklyBuyGroup) {
            $prices = array_merge($prices, array_column($weeklyBuyGroup->goods->attr, 'price'));
        }
        if (empty($prices)) {
            throw new WeeklyBuyException('海报-规格数据异常');
        }

        $picUrl = Json::decode($goods->picUrl);
        $pic_list = array_column($picUrl, 'pic_url');
        if (empty($pic_list)) {
            throw new WeeklyBuyException('图片不能为空');
        }
        while (count($pic_list) < 5) {
            $pic_list = array_merge($pic_list, $pic_list);
        }

        return [
            'goods_name' => $goods->name,
            'is_negotiable' => 0,
            'min_price' => min($prices),
            'max_price' => max($prices),
            'multi_map' => $pic_list,
        ];
    }
}
