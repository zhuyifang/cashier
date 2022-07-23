<?php
/**
* link: http://www.zjhejiang.com/
* copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
* author: xay
*/
namespace app\forms\mall\topic;

use app\core\response\ApiCode;
use app\models\Model;
use app\models\Topic;
use app\models\TopicType;

class TopicTypeForm extends Model
{
    public $model;
    public $page;
    public $page_size;

    public $id;
    public $name;
    public $sort;
    public $status;
    public $is_delete;
    public $keyword;
    public $extra_attributes;
    public $type;

    public function rules()
    {
        return [
            [['sort', 'is_delete','id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['is_delete', 'sort','status'], 'default', 'value' => 0],
            [['sort'], 'integer', 'min' => 0, 'max' => 999999999],
            [['page'], 'default', 'value' => 1],
            [['page_size'], 'default', 'value' => 10],
            [['keyword', 'type'], 'string'],
            [['keyword'], 'default', 'value' => ''],
            [['extra_attributes'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'status' => '状态',
            'sort' => '排序',
            'is_delete' => 'Is Delete',
        ];
    }

    //GET
    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $query = TopicType::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0,
        ]);

        $list = $query->keyword($this->keyword, [
            'or',
            ['like', 'name', $this->keyword],
            ['like', 'id', $this->keyword]
        ])
            ->keyword($this->type === 'link', ['status' => 1])
                ->page($pagination, $this->page_size)
                ->orderBy('sort ASC,id DESC')
                ->all();

        $newList = array_map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'sort' => $item->sort,
                'status' => $item->status,
                'extra_attributes' => $item->extra_attributes ? json_decode($item->extra_attributes, true) : [
                    'color' => '#FF4544'
                ]
            ];
        }, $list);


        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => [
                'list' => $newList,
                'pagination' => $pagination
            ]
        ];
    }

    public function switchStatus()
    {
        $model = TopicType::findOne([
            'id' => $this->id,
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0
        ]);

        if (!$model) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => '数据不存在或已删除',
            ];
        }
        $model->status = $this->status;
        $model->save();
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '切换成功'
        ];
    }

    //DELETE
    public function destroy()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $model = TopicType::findOne([
                'id' => $this->id,
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0
            ]);
            if (!$model) {
                throw new \Exception('数据不存在或已删除');
            }
            $topic = Topic::find()->where([
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0,
                'type' => $this->id,
            ])->count();
            if ($topic > 0) {
                throw new \Exception(sprintf('%s个专题使用该分类，无法删除', $topic));
            }
            $model->is_delete = 1;
            $model->deleted_at = date('Y-m-d H:i:s');
            $model->save();
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '删除成功'
            ];

        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage()
            ];
        }
    }

    //DELETE
    public function changeSort()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $model = TopicType::findOne([
                'id' => $this->id,
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0
            ]);
            if (!$model) {
                throw new \Exception('专题标签不存在');
            }

            $model->sort = $this->sort;
            $model->save();
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '更新成功'
            ];

        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage()
            ];
        }
    }

    //DETAIL
    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $topicType = TopicType::findOne(['mall_id' => \Yii::$app->mall->id,'id' => $this->id]);
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => (object)$topicType
        ];
    }

    //SAVE
    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        };

        try {
            $model = TopicType::findOne([
                'mall_id' => \Yii::$app->mall->id,
                'id' => $this->id,
            ]);
            if (!$model) {
                $model = new TopicType();
                $model->mall_id = \Yii::$app->mall->id;
            }

            if (!is_array($this->extra_attributes) || !isset($this->extra_attributes['color'])) {
                throw new \Exception('参数异常');
            }

            $model->attributes = $this->attributes;
            $model->extra_attributes = json_encode($this->extra_attributes);
            $res = $model->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($model));
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功'
            ];
        }catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }
    }
}
