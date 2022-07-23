<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\forms\mall\topic;

use Yii;
use app\core\response\ApiCode;
use app\forms\common\diy\DiyTopicsForm;
use app\models\Model;
use app\models\Option;
use app\models\Topic;
use app\models\TopicType;
use yii\helpers\ArrayHelper;

class TopicForm extends Model
{
    public $model;
    public $page;
    public $page_size;
    public $search;
    public $type;

    public $id;
    public $title;
    public $layout_type;
    public $pic_url;
    public $abstract;
    public $share_title;
    public $share_pic_url;
    public $tag_id;
    public $is_show;
    public $virtual_read_number;
    public $sort;
    public $add_goods_type;
    public $add_goods_number;
    public $add_goods_list;
    public $components;
    public $proportion;

    public function rules()
    {
        return [
            [['title', 'abstract', 'share_title', 'share_pic_url', 'type'], 'string', 'max' => 255],
            [['id', 'layout_type', 'tag_id', 'is_show', 'virtual_read_number', 'sort', 'add_goods_type', 'add_goods_number', 'is_show', 'proportion'], 'integer', 'max' => 9999999],
            [['add_goods_list', 'components', 'pic_url', 'search'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '分类',
            'title' => '标题',
            'layout_type' => '专题列表布局方式',
            'pic_url' => '封面图',
            'abstract' => '摘要',
            'share_title' => '自定义分享标题',
            'share_pic_url' => '自定义分享图片',
            'tag_id' => '标签',
            'is_show' => '是否显示',
            'virtual_read_number' => '虚拟阅读量',
            'sort' => '排序',
            'add_goods_type' => '商品添加类型',
            'add_goods_number' => '商品数量',
            'add_goods_list' => '商品列表',
            'components' => '详情设置',
            'proportion' => '封面图比例',
        ];
    }

    //GET
    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        };

        try {

            try {
                $transaction = \Yii::$app->db->beginTransaction();
                // 兼容 把旧专题数据改为显示
                $isExist = Option::find()->andWhere([
                    'mall_id' => 0,
                    'mch_id' => 0,
                    'name' => 'topic_update'
                ])->one();

                if (!$isExist) {
                    $option = new Option();
                    $option->mall_id = 0;
                    $option->mch_id = 0;
                    $option->name = 'topic_update';
                    $option->value = 'topic_update';
                    $res = $option->save();
                    if (!$res) {
                        throw new \Exception($this->getErrorMsg($option));
                    }

                    Topic::updateAll([
                        'is_show' => 1
                    ], [
                        'is_old' => 1,
                        'is_delete' => 0
                    ]);
                }
                $transaction->commit();
            }catch(\Exception $e) {
                $transaction->rollBack();
            }

            $form = new CommonTopicForm();
            if ($this->search) {
                $search = json_decode($this->search, true);
                $form->keyword = $search['keyword'];
                $form->search_type = $this->type;
                $form->type = isset($search['tag_id']) ? $search['tag_id'] : '';
            }
            $form->is_show = $this->is_show;
            $form->page_size = $this->page_size;
            $form->page = $this->page;
            $res = $form->getList();

            $newList = [];
            /** @var Topic $item */
            foreach ($res['list'] as $item) {

                $arr = [];
                $arr['id'] = $item->id;
                $arr['title'] = $item->title;
                $arr['tag_name'] = $item->topicType->name;
                $arr['sort'] = $item->sort;
                $arr['is_show'] = $item->is_show;
                $arr['created_at'] = $item->created_at;

                $layout = $item->layout;
                $picList = $item->pic_list ? json_decode($item->pic_list, true) : [];
                if ($item->is_old == 1) {
                    $arr['pic_url'] = $item->cover_pic;

                    if (!is_array($picList)) {
                        $picList = [];
                    }

                    foreach ($picList as &$pItem) {
                        $pItem['pic_url'] = $pItem['url'];
                    }

                    if ($item->layout == 1 || $item->layout == 0) {
                        $picList[] = ['pic_url' => $item->cover_pic];
                    }

                    $layout = $item->layout == 1 ? 1 : 2;
                    $item->layout = $layout;
                    $arr['layout_type'] = $item->getLayoutTypeText($item);
                } else {
                    $arr['layout_type'] = $item->getLayoutTypeText($item);
                    $arr['pic_url'] = is_array($picList) && count($picList) ? $picList[0]['pic_url'] : '';
                }

                // TODO DIY专题需要用到
                $arr['layout'] = $layout;
                $arr['abstract'] = $item->abstract;

                $readNumber = $item->read_number + $item->virtual_read_count;
                $readNumber = $readNumber > 100000 ? '10w+' : $readNumber;
                $arr['read_number'] = $readNumber;

                $arr['goods_list'] = $form->getGoodsList($item);
                $arr['pic_list'] = $picList;
                $arr['proportion'] = $item->proportion;

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
                $arr['tag'] = $tag;
                $newList[] = $arr;
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'data' => [
                    'list' => $newList,
                    'tag_list' => $this->getTypeOption(),
                    'pagination' => $res['pagination']
                ]
            ];
        }catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine()
            ];
        }
    }

    private function getTypeOption()
    {
        $select = TopicType::find()->select('id,name')->where([
            'mall_id' => Yii::$app->mall->id,
            'is_delete' => 0
        ])->all();
        $newSelect = array_map(function($item){
            return [
                'label' => $item->name,
                'value' => $item->id
            ];
        }, $select);

        return $newSelect;
    }

    //DELETE
    public function destroy()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $model = Topic::findOne([
                'id' => $this->id,
                'mall_id' => Yii::$app->mall->id,
                'is_delete' => 0
            ]);
            if (!$model) {
                return [
                    'code' => ApiCode::CODE_ERROR,
                    'msg' => '数据不存在或已删除',
                ];
            }
            $model->is_delete = 1;
            $model->deleted_at = date('Y-m-d H:i:s');
            $res = $model->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($model));
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '删除成功'
            ];
        }catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }
    }

    public function editSort()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $model = Topic::findOne([
            'id' => $this->id,
            'mall_id' => Yii::$app->mall->id,
            'is_delete' => 0
        ]);
        if (!$model) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => '数据不存在或已删除',
            ];
        }
        $model->sort = $this->sort;
        $model->save();
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '处理成功'
        ];
    }
    public function editShow()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $model = Topic::findOne([
            'id' => $this->id,
            'mall_id' => Yii::$app->mall->id,
            'is_delete' => 0
        ]);
        if (!$model) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => '专题不存在',
            ];
        }
        $model->is_show = $this->is_show;
        $model->save();
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '处理成功'
        ];
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {

            $newTopic = null;
            if ($this->id) {
                $topic = Topic::find()->where([
                    'mall_id' => Yii::$app->mall->id,
                    'is_delete' => 0,
                    'id' => $this->id
                ])->one();

                if (!$topic) {
                    throw new \Exception('专题不存在');
                }

                $detail = $topic->detail ? \yii\helpers\BaseJson::decode($topic->detail) : [];
                $newDetail = [];
                // 兼容
                foreach ($detail as $key => $value) {
                    $value['active'] = false;
                    if ($key == 0) {
                        $value['active'] = true;
                    }

                    $value['key'] = isset($value['key']) ? $value['key'] : time() . $key;
                    $value['permission_key'] = isset($value['permission_key']) ? $value['permission_key'] : '';

                    $newDetail[] = $value;
                }

                $newTopic['abstract'] = $topic->abstract;
                $newTopic['add_goods_list'] = $topic->add_goods_list ? json_decode($topic->add_goods_list, true) : [];
                $newTopic['add_goods_number'] = $topic->add_goods_number;
                $newTopic['add_goods_type'] = $topic->add_goods_type;
                $newTopic['created_at'] = $topic->created_at;
                $newTopic['deleted_at'] = $topic->deleted_at;
                $newTopic['detail'] = $newDetail;
                $newTopic['id'] = $topic->id;
                $newTopic['is_delete'] = $topic->is_delete;
                $newTopic['is_show'] = $topic->is_show;
                $newTopic['mall_id'] = $topic->mall_id;
                $newTopic['read_number'] = $topic->read_number;
                $newTopic['share_pic_url'] = $topic->qrcode_pic;
                $newTopic['share_title'] = $topic->app_share_title;
                $newTopic['sort'] = $topic->sort;
                $newTopic['tag_id'] = $topic->type;
                $newTopic['title'] = $topic->title;
                $newTopic['updated_at'] = $topic->updated_at;
                $newTopic['virtual_read_number'] = $topic->virtual_read_count;
                $newTopic['proportion'] = $topic->proportion;

                if ($topic->is_old == 1) {
                    $picList = $topic->pic_list ? json_decode($topic->pic_list, true) : [];
                    if (!is_array($picList)) {
                        $picList = [];
                    }
                    $newPicList = [];
                    foreach ($picList as $item) {
                        $newitem = [];
                        $newitem['pic_url'] = $item['url'];
                        $newPicList[] = $newitem;
                    }

                    if ($topic->layout == 1 || $topic->layout == 0) {
                        $newPicList[] = ['pic_url' => $topic->cover_pic];
                    }

                    $newTopic['detail'][] = [
                        'id' => 'image-text',
                        'data' => [
                            'content' => $topic->content,
                            'bg' => '#FFFFFF'
                        ],
                        'active' => true,
                        'key' => time(),
                        'permission_key' => ''
                    ];

                    $newTopic['pic_url'] = $newPicList;
                    $newTopic['layout_type'] = $topic->layout == 1 ? 1 : 2;
                } else {
                    $newTopic['pic_url'] = json_decode($topic->pic_list, true);
                    $newTopic['layout_type'] = $topic->layout;
                }
            }
                
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'data' => [
                    'topic' => $newTopic,
                    'tag_list' => $this->getTypeOption(),
                ]
            ];
        }catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine()
            ];
        }
    }

    //SAVE
    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {

            if ($this->id) {
                $model = Topic::findOne([
                    'mall_id' => Yii::$app->mall->id,
                    'id' => $this->id,
                    'is_delete' => 0
                ]);

                if (!$model) {
                    throw new \Exception('专题内容不存在');
                }
            } else {
                $model = new Topic();
                $model->mall_id = \Yii::$app->mall->id;
            }

            $model->is_old = 0;
            $model->title = $this->title;
            $model->layout = $this->layout_type;
            $model->pic_list = json_encode($this->pic_url, JSON_UNESCAPED_UNICODE);
            $model->abstract = $this->abstract;
            $model->app_share_title = $this->share_title;
            $model->qrcode_pic = $this->share_pic_url;
            $model->type = $this->tag_id;
            $model->is_show = $this->is_show;
            $model->virtual_read_count = $this->virtual_read_number ?: 0;
            $model->sort = $this->sort;
            $model->add_goods_type = $this->add_goods_type;
            $model->add_goods_number = $this->add_goods_number;
            $model->add_goods_list = json_encode($this->add_goods_list, JSON_UNESCAPED_UNICODE);
            $model->detail = json_encode($this->components, JSON_UNESCAPED_UNICODE);
            $model->content = '';
            $model->cover_pic = '';
            $model->proportion = $this->proportion;
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
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine()
            ];
        }
    }

    private function checkData()
    {
        if ($this->virtual_read_number < 0) {
            throw new \Exception('虚拟阅读量不能小于0');
        }

        if ($this->sort < 0) {
            throw new \Exception('排序不能小于0');
        }

        if ($this->add_goods_type == 1) {
            if ($this->add_goods_number < 0 || $this->add_goods_number > 10) {
                throw new \Exception("最大只能添加10个商品");
            }
        } else {
            if (count($this->add_goods_list) > 10) {
                throw new \Exception("商品列表最多添加10个");
            }
        }
    }
}
