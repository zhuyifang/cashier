<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\mch;

use app\core\response\ApiCode;
use app\forms\common\CommonOption;
use app\models\Model;
use app\models\Option;
use app\plugins\mch\models\MchTags;
use app\plugins\mch\models\MchWeitao;

class MchTagForm extends Model
{
    public $search;
    public $id;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['search'], 'safe'],
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
            $query = MchTags::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'is_delete' => 0
            ]);

            $search = json_decode($this->search, true);
            if (isset($search['keyword']) && $search['keyword']) {
                $query->andWhere(['like', 'name', $search['keyword']]);
            }

            $list = $query->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])->page($pagination)->all();

            $newList = [];
            foreach ($list as $item) {
                $newItem = [];
                $newItem['id'] = $item->id;
                $newItem['name'] = $item->name;
                $newItem['status'] = $item->status;
                $newItem['sort'] = $item->sort;
                $newItem['extra_attributes'] = json_decode($item->extra_attributes, true);
                $newList[] = $newItem;
            }
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
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

    public function deleteTag()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $mchTag = MchTags::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$mchTag) {
                throw new \Exception('标签不存在');
            }

            $isExist = MchWeitao::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'is_delete' => 0,
                'tag_id' => $this->id
            ])->one();

            if ($isExist) {
                throw new \Exception('该标签下有微淘内容,不可删除');
            }

            $mchTag->is_delete = 1;
            $res = $mchTag->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($mchTag));
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
}
