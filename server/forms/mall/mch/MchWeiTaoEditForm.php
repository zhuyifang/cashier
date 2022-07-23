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

class MchWeiTaoEditForm extends Model
{
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
            [['title', 'layout_type', 'tag_id', 'proportion'], 'required'],
            [['title', 'abstract', 'share_title', 'share_pic_url'], 'string', 'max' => 255],
            [['id', 'layout_type', 'tag_id', 'is_show', 'virtual_read_number', 'sort', 'add_goods_type', 'add_goods_number', 'proportion'], 'integer', 'max' => 9999999],
            [['add_goods_list', 'components', 'pic_url'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
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
            'proportion' => '图片比例',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $this->checkData();

            if ($this->id) {
                $weitao = MchWeitao::find()->andWhere([
                    'mall_id' => \Yii::$app->mall->id,
                    'mch_id' => \Yii::$app->user->identity->mch_id,
                    'id' => $this->id,
                    'is_delete' => 0
                ])->one();

                if (!$weitao) {
                    throw new \Exception('内容不存在');
                }
            } else {
                $weitao = new MchWeitao();
                $weitao->mall_id = \Yii::$app->mall->id;
                $weitao->mch_id = \Yii::$app->user->identity->mch_id;
            }

            $weitao->title = $this->title;
            $weitao->layout_type = $this->layout_type;
            $weitao->pic_url = json_encode($this->pic_url, JSON_UNESCAPED_UNICODE);
            $weitao->abstract = $this->abstract;
            $weitao->share_title = $this->share_title;
            $weitao->share_pic_url = $this->share_pic_url;
            $weitao->tag_id = $this->tag_id;
            $weitao->is_show = $this->is_show;
            $weitao->virtual_read_number = $this->virtual_read_number;
            $weitao->sort = $this->sort;
            $weitao->add_goods_type = $this->add_goods_type;
            $weitao->add_goods_number = $this->add_goods_number;
            $weitao->add_goods_list = json_encode($this->add_goods_list, JSON_UNESCAPED_UNICODE);
            $weitao->detail = json_encode($this->components, JSON_UNESCAPED_UNICODE);
            $weitao->proportion = $this->proportion;
            $res = $weitao->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($weitao));
            }
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功'
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
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
