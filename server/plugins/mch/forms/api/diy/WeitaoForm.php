<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\mch\forms\api\diy;

use app\core\response\ApiCode;
use app\forms\common\CommonAppConfig;
use app\forms\common\CommonOption;
use app\forms\common\diy\CommonModule;
use app\forms\common\diy\CommonPageTwo;
use app\forms\common\diy\DiyMchHomeForm;
use app\forms\common\goods\CommonGoods;
use app\forms\common\goods\CommonGoodsDetail;
use app\forms\common\goods\CommonGoodsList;
use app\forms\common\goods\GoodsAuth;
use app\forms\common\mch\SettingForm;
use app\models\Favorite;
use app\models\Model;
use app\models\Option;
use app\models\ShareSetting;
use app\models\User;
use app\plugins\diy\forms\common\DiyMchGoodsForm;
use app\plugins\mch\models\Goods;
use app\plugins\mch\models\MchMallSetting;
use app\plugins\mch\models\MchSetting;
use app\plugins\mch\models\MchTags;
use app\plugins\mch\models\MchWeitao;
use yii\helpers\ArrayHelper;

class WeitaoForm extends Model
{
    public $mch_id;
    public $page = 1;
    public $tag_id;
    public $keyword;
    public $id;

    public function rules()
    {
        return [
            [['mch_id'], 'required'],
            [['mch_id', 'page', 'tag_id', 'id'], 'integer'],
            [['keyword'], 'string'],
        ];
    }

    public function getTagList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $query = MchTags::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => $this->mch_id,
                'status' => 1,
                'is_delete' => 0
            ]);

            $list = $query->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])->all();

            $newList = array_map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'extra_attributes' => json_decode($item->extra_attributes, true)
                ];
            }, $list);
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'list' => $newList,
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {

            $query = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => $this->mch_id,
                'is_delete' => 0,
                'is_show' => 1,
            ]);

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'title', $this->keyword],
                    ['like', 'abstract', $this->keyword]
                ]);
            }

            if ($this->tag_id) {
                $query->andWhere(['tag_id' => $this->tag_id]);
            }

            $tagIds = MchTags::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => $this->mch_id,
                'is_delete' => 0,
                'status' => 1
            ])->select('id');


            $list = $query->with('tag')
                ->andWhere(['tag_id' => $tagIds])
                ->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])
                ->page($pagination, 10)
                ->all();

            $newList = array_map(function($item) {
                $readNumber = $item->read_number + $item->virtual_read_number;
                $readNumber = $readNumber > 100000 ? '10w+' : $readNumber;

                $tag = null;
                if ($item->tag) {
                    $tag = [
                        'id' => $item->tag->id,
                        'name' => $item->tag->name,
                        'extra_attributes' => json_decode($item->tag->extra_attributes, true)
                    ];
                }

                return [
                    'id' => $item->id,
                    'proportion' => $item->proportion,
                    'title' => $item->title,
                    'layout_type' => $item->layout_type,
                    'pic_url' => json_decode($item->pic_url, true),
                    'tag' => $tag,
                    'abstract' => $item->abstract,
                    'read_number' => $readNumber,
                    'goods_list' => $this->getGoodsList($item)
                ];
            }, $list);
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'list' => $newList,
                    'pagination' => $pagination
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    private function getGoodsList($item)
    {
        if ($item->add_goods_type == 1 && $item->add_goods_number <= 0) {
            return null;
        }

        $form = new CommonGoodsList();
        $form->mch_id = $this->mch_id;
        $form->sort = 1;
        $form->page = $this->page;
        $form->limit = $item->add_goods_number;
        $form->status = 1;
        $form->sign = \Yii::$app->plugin->getCurrentPlugin()->getName();
        $form->relations = ['goodsWarehouse', 'attr', 'mchGoods'];

        if ($item->add_goods_type == 2) {
            $goodsIds = [];
            $addGoodsList = json_decode($item->add_goods_list, true);
            foreach ($addGoodsList as $glItem) {
                $goodsIds[] = $glItem['id'];
            }
            $form->goods_id = $goodsIds;
        }
        $list = $form->search();

        $goodsList = array_map(function($goods) use($form) {
            return $form->getDiyBack($goods);
        }, $list);

        // 自定义商品当商品ID重复时 商品数据会少 所以需要再循环一遍
        if ($item->add_goods_type == 2) {
            $newGoodsList = [];
            foreach ($addGoodsList as $glItem) {
                foreach ($goodsList as $gItem) {
                    if ($gItem['id'] == $glItem['id']) {
                        $newGoodsList[] = $gItem;
                    }
                }
            }
            $goodsList = $newGoodsList;
        }

        return $goodsList;
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $detail = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => $this->mch_id,
                'is_delete' => 0,
                'is_show' => 1,
                'id' => $this->id
            ])
                ->with('tag')
                ->one();

            if (!$detail) {
                throw new \Exception('微淘不存在');
            }

            $detail->read_number = $detail->read_number + 1;
            $res = $detail->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($detail));
            }

            $readNumber = $detail->read_number + $detail->virtual_read_number;
            $readNumber = $readNumber > 100000 ? '10w+' : $readNumber;

            $tag = null;
            if ($detail->tag) {
                $tag = [
                    'id' => $detail->tag->id,
                    'name' => $detail->tag->name,
                    'extra_attributes' => json_decode($detail->tag->extra_attributes, true)
                ];
            }

            $favorite = Favorite::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'user_id' => \Yii::$app->user->id,
                'favorite_mch_id' => $this->mch_id,
                'is_delete' => 0
            ])->one();

            $mchData = (new DiyMchHomeForm())->getData($this->mch_id, \Yii::$app->user);

            $extra = [];
            if ($detail->detail) {
                $commonPageTwo = CommonPageTwo::getCommon(\Yii::$app->mall);
                $extra = $commonPageTwo->getPage(null, null, $detail->detail);
            }

            $newItem = [
                'id' => $detail->id,
                'title' => $detail->title,
                'layout_type' => $detail->layout_type,
                'pic_url' => json_decode($detail->pic_url, true),
                'abstract' => $detail->abstract,
                'share_title' => $detail->share_title,
                'share_pic_url' => $detail->share_pic_url,
                'tag' => $tag,
                'read_number' => $readNumber,
                'add_goods_list' => $this->getGoodsList($detail),
                'detail' => $extra,
                'is_favorite' => $favorite ? 1 : 0,
                'mch_id' => $detail->mch_id,
                'qr_code_url' => $mchData['mch']['qr_code_url']
            ];

            $transaction->commit();
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'detail' => $newItem,
                ]
            ];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function poster()
    {
        try {
            $form = new WeitaoPosterForm();
            $form->mch_id = $this->mch_id;
            $form->id = $this->id;
            $poster = $form->build();

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'pic_url' => $poster['qrcode_url']
                ]
            ];
        } catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine(),
            ];
        }
    }
}
