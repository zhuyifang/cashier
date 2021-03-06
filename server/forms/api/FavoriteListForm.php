<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 16:51
 */

namespace app\forms\api;


use app\core\response\ApiCode;
use app\forms\api\goods\ApiGoods;
use app\forms\common\goods\CommonGoodsList;
use app\forms\common\goods\CommonGoodsMember;
use app\forms\common\goods\CommonGoodsStatistic;
use app\forms\common\order\CommonOrderStatistic;
use app\forms\mall\topic\CommonTopicForm;
use app\models\Favorite;
use app\models\Goods;
use app\models\GoodsCatRelation;
use app\models\GoodsCats;
use app\models\GoodsWarehouse;
use app\models\Model;
use app\models\Topic;
use app\models\TopicFavorite;
use app\models\User;
use app\plugins\mch\Plugin;
use app\plugins\mch\models\Mch;
use app\plugins\mch\models\MchGoods;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class FavoriteListForm extends Model
{
    public $page;
    public $limit;
    public $status;
    public $cat_id;

    public function rules()
    {
        return [
            [['page', 'limit', 'cat_id', 'status'], 'integer'],
            ['page', 'default', 'value' => 1],
            ['limit', 'default', 'value' => 20],
        ];
    }

    /**
     * @return array
     * @deprecated
     */
    public function goods()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $query = Favorite::find()
                ->where(['user_id' => \Yii::$app->user->id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id])
                ->select('goods_id');
            $list = Goods::find()->with('goodsWarehouse')
                ->where(['is_delete' => 0, 'status' => 1, 'mall_id' => \Yii::$app->mall->id])
                ->andWhere(['id' => $query])->apiPage($this->limit, $this->page)->all();
            $oldList = [];
            $newList = [];
            foreach ($list as $item) {
                $apiGoods = ApiGoods::getCommon();
                $apiGoods->goods = $item;
                $apiGoods->isSales = 0;
                $goods = $apiGoods->getDetail();
                $goods['is_sales'] = 0;
                $newItem = [];
                $newItem['goods'] = $goods;

                $oldList[] = $newItem;
                $newList[] = $goods;
            }
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => 'success',
                'data' => [
                    'list' => $oldList,
                    'new_list' => $newList,
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage()
            ];
        }
    }

    public function newGoods()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $favorite = $query = Favorite::find()
                ->select(['goods_id', 'mirror_price'])
                ->where(['user_id' => \Yii::$app->user->id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id])
                ->all();
            $favorite = array_column(ArrayHelper::toArray($favorite), null, 'goods_id');
            $model = Goods::find()
                ->alias('g')
                ->with(['attr'])
                ->rightJoin(['f' => Favorite::tableName()], 'g.id = f.goods_id')
                ->leftJoin(['gw' => GoodsWarehouse::tableName()], 'g.goods_warehouse_id = gw.id')
                ->leftJoin(['gcr' => GoodsCatRelation::tableName()], 'gw.id = gcr.goods_warehouse_id')
                ->leftJoin(['gc' => GoodsCats::tableName()], 'gcr.cat_id = gc.id')
                ->where(['g.mall_id' => \Yii::$app->mall->id])
                ->andWhere([
                    'f.user_id' => \Yii::$app->user->id,
                    'f.is_delete' => 0,
                    'f.mall_id' => \Yii::$app->mall->id
                ])->andWhere(CommonGoodsList::showAuthCondition('g'))
                ->groupBy(['g.id'])
                ->apiPage($this->limit, $this->page);
            if ($this->cat_id) {
                $catSecond = GoodsCats::find()->select('id')->andWhere([
                    'is_delete' => 0,
                    'mall_id' => \Yii::$app->mall->id,
                    'status' => 1,
                    'parent_id' => $this->cat_id,
                ]);
                $model = $model->andWhere([
                    'or',
                    ['gc.id' => $this->cat_id],
                    ['in', 'gc.parent_id', $catSecond],
                    ['in', 'gc.id', $catSecond],
                ]);
            }
            if ($this->status) {
                switch ($this->status) {
                    case 1:
                        $model = $model->andWhere(['<', 'g.goods_stock', 50]);
                        break;
                    case 2:
                        $model = $model->andWhere(
                            [
                                'OR',
                                ['!=', 'g.is_delete', 0],
                                ['!=', 'g.status', 1]
                            ]
                        );
                        break;
                    case 3:
                        $model = $model->andWhere(['<', 'g.price', new Expression('f.mirror_price')]);
                        break;
                        break;
                    default:
                        break;
                }
            }
            $list = $model->all();
            $newList = [];
            foreach ($list as $item) {
                $apiGoods = ApiGoods::getCommon();
                $apiGoods->goods = $item;
                $apiGoods->isSales = 1;
                $goods = $apiGoods->getDetail();
                $newItem = $goods;
                $newItem['show'] = false;
                $newItem['touch'] = false;
                $newItem['status_type'] = 0;
                if ($favorite[$item->id]['mirror_price'] > $item->price) {
                    $newItem['status_type'] = 1;
                    $newItem['low_price'] = price_format(
                        $favorite[$item->id]['mirror_price'] - $item->price,
                        PRICE_FORMAT_FLOAT
                    );
                }
                if ($goods['is_negotiable'] == 1) {
                    $newItem['status_type'] = 0;
                }
                if ($item->goods_stock < 50) {
                    $newItem['status_type'] = 2;
                }
                if ($item->is_delete != 0 || $item->status != 1) {
                    $newItem['status_type'] = 3;
                }
                $newItem['status_type_text'] = $this->parseStatusType($newItem['status_type']);
                $newList[] = $newItem;
            }
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => 'success',
                'data' => [
                    'list' => $newList,
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage()
            ];
        }
    }

    private function parseStatusType($type)
    {
        switch ($type) {
            case 1:
                return '??????';
            case 2:
                return '????????????';
            case 3:
                return '??????';
            default:
                return '';
        }
    }

    public function cats()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $query = Favorite::find()
                ->where(['user_id' => \Yii::$app->user->id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id])
                ->select('goods_id');
            $list = Goods::find()->with([
                'goodsWarehouse.cats' => function ($query) {
                    $query->select(['id', 'name', 'parent_id']);
                },
                'goodsWarehouse.cats.parent.parent'
            ])
                ->where(['mall_id' => \Yii::$app->mall->id])
                ->andWhere(['id' => $query])->all();
            $newList[] = [
                'id' => 0,
                'name' => '????????????'
            ];
            foreach ($list as $item) {
                foreach ($item->goodsWarehouse->cats as $cat) {
                    if (empty($cat)) {
                        continue;
                    }
                    if ($cat->parent_id == 0) {
                        $newCat = [
                            'id' => $cat->id,
                            'name' => $cat->name
                        ];
                        $newList[] = $newCat;
                    } elseif (!is_null($cat->parent) && $cat->parent->parent_id == 0) {
                        $newCat = [
                            'id' => $cat->parent->id,
                            'name' => $cat->parent->name
                        ];
                        $newList[] = $newCat;
                    } elseif (!is_null($cat->parent->parent) && $cat->parent->parent->parent_id == 0) {
                        $newCat = [
                            'id' => $cat->parent->parent->id,
                            'name' => $cat->parent->parent->name
                        ];
                        $newList[] = $newCat;
                    }
                }
            }
            $newList = array_unique($newList, SORT_REGULAR);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => 'success',
                'data' => [
                    'list' => array_merge($newList)
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage()
            ];
        }
    }

    public function topic()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $mall = \Yii::$app->mall;
        /* @var User $user */
        $user = \Yii::$app->user->identity;
        $favoriteQuery = TopicFavorite::find()->where([
            'mall_id' => $mall->id,
            'user_id' => $user->id,
            'is_delete' => 0
        ])
            ->select('topic_id');

        $list = Topic::find()->where(['is_delete' => 0, 'mall_id' => $mall->id, 'id' => $favoriteQuery])
            ->apiPage($this->limit, $this->page)
            ->orderBy(['sort' => SORT_ASC])
            ->all();

        $newList = array_map(function($item) {
            $readNumber = $item->read_number + $item->virtual_read_count;
            $readNumber = $readNumber > 100000 ? '10w+' : $readNumber;

            $tag = null;
            if ($item->topicType) {
                $tag = [
                    'id' => $item->topicType->id,
                    'name' => $item->topicType->name,
                    'extra_attributes' => $item->topicType && $item->topicType->extra_attributes ? json_decode($item->topicType->extra_attributes, true) : [
                        'color' => '#ff4544'
                    ]
                ];
            }

            $layoutType = $item->layout;
            $picList = $item->pic_list ? json_decode($item->pic_list, true) : [];
            if ($item->is_old == 1) {
                foreach ($picList as &$pItem) {
                    $pItem['pic_url'] = $pItem['url'];
                }

                if ($item->layout == 1 || $item->layout == 0) {
                    $picList[] = ['pic_url' => $item->cover_pic];
                }

                $layoutType = $item->layout == 1 ? 1 : 2;
            }

            return [
                'id' => $item->id,
                'title' => $item->title,
                'layout_type' => $layoutType,
                'pic_url' => $picList,
                'tag' => $tag,
                'abstract' => $item->abstract,
                'read_number' => $readNumber,
                'goods_list' => (new CommonTopicForm())->getGoodsList($item)
            ];
        }, $list);

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '',
            'data' => [
                'list' => $newList
            ]
        ];
    }

    public function myFavoriteMch()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $mchIds = Favorite::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'user_id' => \Yii::$app->user->id,
                'is_delete' => 0
            ])
                ->andWhere(['>', 'favorite_mch_id', 0])
                ->orderBy(['created_at' => SORT_DESC])
                ->select('favorite_mch_id');

            $list = Mch::find()->andWhere(['id' => $mchIds])->with('store')->page($pagination, 10)->all();

            $newList = array_map(function($item) {
                $count = Favorite::find()->andWhere(['favorite_mch_id' => $item->id, 'is_delete' => 0])->count();

                // ??????????????????
                $form = new CommonGoodsStatistic();
                $form->mch_id = $item->id;
                $form->sign = (new Plugin())->getName();
                $res = $form->getAll(['goods_count']);
                $goodsCount = $res['goods_count'];

                // ??????????????????
                $form = new CommonOrderStatistic();
                $form->mch_id = $item->id;
                $form->sign = (new Plugin())->getName();
                $form->is_user = 1;
                $res = $form->getAll(['order_goods_count']);
                $orderGoodsCount = $res['order_goods_count'];

                $goodsIds = MchGoods::find()->where([
                    'mch_id' => $item->id
                ])->orderBy(['sort' => SORT_ASC])->select('goods_id');

                $limit = 3;
                $list = Goods::find()->where([
                    'id' => $goodsIds,
                    'status' => 1,
                    'is_delete' => 0,
                    'mall_id' => \Yii::$app->mall->id,
                ])->with('goodsWarehouse')->page($pagination, $limit)
                    ->andWhere(CommonGoodsList::showAuthCondition())->all();

                $newGoodsList = [];
                /** @var Goods $lItem */
                foreach ($list as $lItem) {
                    $arr['id'] = $lItem->id;
                    $arr['name'] = $lItem->getName();
                    $arr['picUrl'] = $lItem->getCoverPic();
                    $arr['price'] = $lItem->getPrice();
                    $arr['goodsWarehouse']['video_url'] = $lItem->getVideoUrl();
                    $newGoodsList[] = $arr;
                }

                return [
                    'id' => $item->id,
                    'name' => $item->store->name,
                    'pic_url' => $item->store->cover_url,
                    'longitude' => $item->store->longitude,
                    'latitude' => $item->store->latitude,
                    'favorite_num' => $count,
                    'goods_num' => $goodsCount,
                    'order_num' => $orderGoodsCount,
                    'goodsList' => $newGoodsList
                ];
            }, $list);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '',
                'data' => [
                    'list' => $newList,
                ]
            ];
        }catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }
    }
}
