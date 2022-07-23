<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\topic;

use app\forms\common\goods\CommonGoodsList;
use app\models\Model;
use app\models\Topic;
use app\models\TopicType;

class CommonTopicForm extends Model
{
    public $keyword;
    public $type;
    public $page_size;
    public $page;
    public $topics_ids;
    public $is_show;
    public $search_type;

    public function getList()
    {
        $query = Topic::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0,
        ])->with('topicType');

        if ($this->keyword) {
            $condition = [
                'or',
                ['like', 'title', $this->keyword],
                ['like', 'id', $this->keyword]
            ];
            if ($this->search_type === 'link') {
                $condition[] = [
                    'type' => TopicType::find()->where(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0])
                    ->andWhere(['like', 'name', $this->keyword])->select('id')
                ];
            }
            $query->keyword($this->keyword, $condition);
        }

        $list = $query->keyword($this->type, ['type' => $this->type])
            ->keyword($this->is_show, ['is_show' => $this->is_show])
            ->keyword($this->topics_ids, ['id' => $this->topics_ids])
            ->page($pagination, $this->page_size, $this->page)
            ->orderBy('created_at DESC')
            ->all();

        return [
            'list' => $list,
            'pagination' => $pagination
        ];
    }

    /**
     * @param Topic[] $list
     * @throws \Exception
     * @return array
     */
    public function resetTopicList($list)
    {
        if (!is_array($list)) {
            throw new \Exception('传入的参数不是数组');
        }
        $newList = [];
        foreach ($list as $topic) {
            if (!($topic instanceof Topic)) {
                throw new \Exception('无效的参数');
            }
            $readNumber = $topic->read_number + $topic->virtual_read_count;
            $readNumber = $readNumber > 100000 ? '10w+' : $readNumber;

            $tag = null;
            if ($topic->topicType) {
                $tag = [
                    'id' => $topic->topicType->id,
                    'name' => $topic->topicType->name,
                    'extra_attributes' => $topic->topicType && $topic->topicType->extra_attributes ? json_decode($topic->topicType->extra_attributes, true) : [
                        'color' => '#ff4544'
                    ]
                ];
            }

            $layoutType = $topic->layout;
            $picList = $topic->pic_list ? json_decode($topic->pic_list, true) : [];
            if ($topic->is_old == 1) {
                foreach ($picList as &$pItem) {
                    $pItem['pic_url'] = $pItem['url'];
                }

                if ($topic->layout == 1 || $topic->layout == 0) {
                    $picList[] = ['pic_url' => $topic->cover_pic];
                }

                $layoutType = $topic->layout == 1 ? 1 : 2;
            }

            $newItem = [
                'id' => $topic->id,
                'title' => $topic->title,
                'layout_type' => $layoutType,
                'pic_url' => $picList,
                'tag' => $tag,
                'abstract' => $topic->abstract,
                'read_number' => $readNumber,
                'proportion' => $topic->proportion,
                'goods_list' => $this->getGoodsList($topic)
            ];
            $newList[] = $newItem;
        }
        return $newList;
    }

    /**
     * @return array
     */
    public function getListByType()
    {
        $list = TopicType::find()->with(['topics' => function ($query) {
            $query->andwhere(['is_delete' => 0, 'is_show' => 1])
                ->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
        }])
            ->where(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'status' => 1])
            ->keyword($this->type, ['id' => $this->type])
            ->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC])
            ->page($pagination, $this->page_size, $this->page)
            ->all();
        return [
            'list' => $list,
            'pagination' => $pagination
        ];
    }

    // 专题商品列表
    public function getGoodsList($item)
    {
        if ($item->add_goods_type == 1 && $item->add_goods_number <= 0) {
            return null;
        }

        $form = new CommonGoodsList();
        $form->sort = 1;
        $form->page = 1;
        $form->limit = $item->add_goods_number;
        $form->status = 1;
        $relations = ['goodsWarehouse', 'attr'];
        try {
            $plugin = \Yii::$app->plugin->getPlugin('mch');
            $relations[] = 'mchGoods';
        }catch(\Exception $exception) {

        }

        $form->relations = $relations;

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
}
