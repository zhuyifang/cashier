<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\mch;

use app\core\response\ApiCode;
use app\forms\common\CommonOption;
use app\forms\mall\mch\diy\CommonMchDiy;
use app\forms\mall\mch\diy\MchComponents;
use app\models\Model;
use app\models\Option;
use app\plugins\mch\models\MchTags;
use app\plugins\mch\models\MchWeitao;
use yii\helpers\ArrayHelper;

class MchWeiTaoForm extends Model
{
    public $search;
    public $id;
    public $sort;
    public $type;

    public function rules()
    {
        return [
            [['id', 'sort'], 'integer'],
            [['search'], 'safe'],
            [['type'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [];
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $query = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'is_delete' => 0
            ]);

            $search = json_decode($this->search, true);
            if (isset($search['keyword']) && $search['keyword']) {
                if ($this->type === 'link') {
                    $query->andWhere([
                        'or',
                        ['id' => $search['keyword']],
                        [
                            'tag_id' => MchTags::find()->andWhere([
                                'mall_id' => \Yii::$app->mall->id,
                                'mch_id' => \Yii::$app->user->identity->mch_id,
                                'is_delete' => 0
                            ])->andWhere(['like', 'name', $search['keyword']])->select('id'),
                        ]
                    ]);
                } else {
                    $query->andWhere(['like', 'title', $search['keyword']]);
                }
            }

            if (isset($search['tag_id']) && $search['tag_id']) {
                $query->andWhere(['tag_id' => $search['tag_id']]);
            }

            $list = $query->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])
                ->with('tag')
                ->page($pagination)
                ->all();

            $newList = [];
            /** @var MchWeitao $item */
            foreach ($list as $item) {
                $picList = json_decode($item->pic_url, true);
                $newItem = [];
                $newItem['id'] = $item->id;
                $newItem['tag_name'] = $item->tag->name;
                $newItem['pic_url'] = count($picList) ? $picList[0]['pic_url'] : '';
                $newItem['title'] = $item->title;
                $newItem['created_at'] = $item->created_at;
                $newItem['layout_type'] = $item->getLayoutTypeText($item);
                $newItem['is_show'] = $item->is_show;
                $newItem['sort'] = $item->sort;
                $newItem['proportion'] = $item->proportion;
                $newItem['mch_id'] = $item->mch_id;
                $newList[] = $newItem;
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
                'data' => [
                    'list' => $newList,
                    'pagination' => $pagination,
                    'tag_list' => $this->getTagList()
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

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $detail = null;
        if ($this->id) {
            $weitao = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$weitao) {
                throw new \Exception('店铺内容不存在');
            }

            $detail = ArrayHelper::toArray($weitao);
            $detail['add_goods_list'] = $detail['add_goods_list'] ? json_decode($detail['add_goods_list'], true) : [];
            $detail['detail'] = $detail['detail'] ? json_decode($detail['detail'], true) : [];
            $detail['pic_url'] = json_decode($detail['pic_url'], true);
        }

        try {
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
                'data' => [
                    'detail' => $detail,
                    'tag_list' => $this->getTagList(),
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

    private function getTagList()
    {
        // 查询是否添加过默认标签 没有再添加
        $isExist = MchTags::find()->andWhere([
            'mall_id' => \Yii::$app->mall->id,
            'mch_id' => \Yii::$app->user->identity->mch_id,
            'is_default' => 1
        ])->one();

        if (!$isExist) {
            $transaction = \Yii::$app->db->beginTransaction();
            $tagList = [
                [
                    'name' => '上新',
                    'extra_attributes' => [
                        'color' => '#FF4544'
                    ]
                ],
                [
                    'name' => '活动',
                    'extra_attributes' => [
                        'color' => '#FE547B'
                    ]
                ],
                [
                    'name' => '通知',
                    'extra_attributes' => [
                        'color' => '#FCC602'
                    ]
                ],
            ];

            foreach ($tagList as $key => $value) {
                $tag = new MchTags();
                $tag->mall_id = \Yii::$app->mall->id;
                $tag->mch_id = \Yii::$app->user->identity->mch_id;
                $tag->name = $value['name'];
                $tag->status = 1;
                $tag->is_default = 1;
                $tag->extra_attributes = json_encode($value['extra_attributes']);
                $res = $tag->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($tag));
                }
            }

            $transaction->commit();
        }


        $list = MchTags::find()->andWhere([
            'mall_id' => \Yii::$app->mall->id,
            'mch_id' => \Yii::$app->user->identity->mch_id,
            'is_delete' => 0,
            'status' => 1
        ])->all();

        $newList = array_map(function($item) {
            return [
                'label' => $item->name,
                'value' => $item->id
            ];
        }, $list);

        return $newList;
    }

    public function delete()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $weitao = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$weitao) {
                throw new \Exception('店铺内容不存在');
            }

            $weitao->is_delete = 1;
            $res = $weitao->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($weitao));
            }
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '删除成功'
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function changeStatus()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $weitao = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$weitao) {
                throw new \Exception('店铺内容不存在');
            }

            $weitao->is_show = $weitao->is_show ? 0 : 1;
            $res = $weitao->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($weitao));
            }
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '更新成功'
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function changeSort()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $weitao = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$weitao) {
                throw new \Exception('店铺内容不存在');
            }

            $weitao->sort = $this->sort;
            $res = $weitao->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($weitao));
            }
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '更新成功'
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }
}
