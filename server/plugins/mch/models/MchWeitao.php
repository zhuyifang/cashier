<?php

namespace app\plugins\mch\models;

use Yii;
use app\plugins\mch\models\MchTags;

/**
 * This is the model class for table "{{%mch_weitao}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $mch_id
 * @property string $title 标题
 * @property int $layout_type 布局类型1.大图2.宫格
 * @property string $pic_url 封面图
 * @property string $abstract 摘要
 * @property string $share_title 分享标题
 * @property string $share_pic_url 分享图片
 * @property int $tag_id 标签ID
 * @property int $is_show 是否显示
 * @property int $read_number 阅读量
 * @property int $virtual_read_number 虚拟阅读量
 * @property int $sort 排序
 * @property int $add_goods_type 添加商品类型1.自动添加 2.手动添加
 * @property int $add_goods_number 添加商品数量
 * @property string $add_goods_list
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $is_delete
 * @property string $detail
 */
class MchWeitao extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mch_weitao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'mch_id', 'layout_type', 'tag_id', 'is_show', 'read_number', 'virtual_read_number', 'sort', 'add_goods_type', 'add_goods_number', 'is_delete'], 'integer'],
            [['add_goods_list', 'detail', 'pic_url'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title', 'abstract', 'share_title', 'share_pic_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mall_id' => 'Mall ID',
            'mch_id' => 'Mch ID',
            'title' => '标题',
            'layout_type' => '布局类型1.大图2.宫格',
            'pic_url' => '封面图',
            'abstract' => '摘要',
            'share_title' => '分享标题',
            'share_pic_url' => '分享图片',
            'tag_id' => '标签ID',
            'is_show' => '是否显示',
            'read_number' => '阅读量',
            'virtual_read_number' => '虚拟阅读量',
            'sort' => '排序',
            'add_goods_type' => '添加商品类型1.自动添加 2.手动添加',
            'add_goods_number' => '添加商品数量',
            'add_goods_list' => 'Add Goods List',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'is_delete' => 'Is Delete',
            'detail' => 'Detail',
        ];
    }

    public function getTag()
    {
        return $this->hasOne(MchTags::className(), ['id' => 'tag_id']);
    }

    public function getLayoutTypeText($weitao)
    {
        $text = '';
        switch ($weitao->layout_type) {
            case 1:
                $text = '大图模式';
                break;
            case 2:
                $text = '宫格模式';
                break;
            case 3:
                $text = '列表模式';
                break;
            default:
                $text = '未知';
                break;
        }

        return $text;
    }
}
