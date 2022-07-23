<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%topic}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $type 分类
 * @property string $title 名称
 * @property string $sub_title 副标题（未用）
 * @property string $content 专题内容
 * @property int $layout 布局方式：0=小图，1=大图模式
 * @property int $sort 排序：升序
 * @property string $cover_pic 封面图
 * @property int $read_count 阅读量
 * @property int $agree_count 点赞数（未用）
 * @property int $virtual_read_count 虚拟阅读量
 * @property int $virtual_agree_count 虚拟点赞数（未用）
 * @property int $virtual_favorite_count 虚拟收藏量
 * @property string $qrcode_pic 自定义分享图片(海报图)
 * @property string $app_share_title 自定义分享标题
 * @property int $is_chosen 是否精选
 * @property int $is_delete 删除
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $pic_list
 * @property string $detail
 * @property string $abstract 摘要
 * @property int $is_old 是否为旧数据
 * @property int $add_goods_type 添加商品类型1.自动添加 2.手动添加
 * @property int $add_goods_number 添加商品数量
 * @property string $add_goods_list 商品列表
 * @property int $read_number 阅读量
 * @property int $is_default 是否默认
 */
class Topic extends ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%topic}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'deleted_at', 'created_at', 'updated_at'], 'required'],
            [['mall_id', 'type', 'layout', 'sort', 'read_count', 'agree_count', 'virtual_read_count', 'virtual_agree_count', 'virtual_favorite_count', 'is_chosen', 'is_delete', 'is_old', 'add_goods_type', 'add_goods_number', 'read_number', 'is_default'], 'integer'],
            [['content', 'pic_list', 'detail', 'add_goods_list'], 'string'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'sub_title', 'cover_pic', 'qrcode_pic', 'abstract'], 'string', 'max' => 255],
            [['app_share_title'], 'string', 'max' => 65],
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
            'type' => '分类',
            'title' => '名称',
            'sub_title' => '副标题（未用）',
            'content' => '专题内容',
            'layout' => '布局方式：0=小图，1=大图模式',
            'sort' => '排序：升序',
            'cover_pic' => '封面图',
            'read_count' => '阅读量',
            'agree_count' => '点赞数（未用）',
            'virtual_read_count' => '虚拟阅读量',
            'virtual_agree_count' => '虚拟点赞数（未用）',
            'virtual_favorite_count' => '虚拟收藏量',
            'qrcode_pic' => '自定义分享图片(海报图)',
            'app_share_title' => '自定义分享标题',
            'is_chosen' => '是否精选',
            'is_delete' => '删除',
            'deleted_at' => 'Deleted At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'pic_list' => '封面图',
            'detail' => 'Detail',
            'abstract' => '摘要',
            'is_old' => '是否为旧数据',
            'add_goods_type' => '添加商品类型1.自动添加 2.手动添加',
            'add_goods_number' => '添加商品数量',
            'add_goods_list' => '商品列表',
            'read_number' => '阅读量',
            'is_default' => '是否默认',
        ];
    }

    public function getTopicType()
    {
        return $this->hasOne(TopicType::className(), ['id' => 'type']);
    }

    public function getFavorite()
    {
        return $this->hasOne(TopicFavorite::className(), ['topic_id' => 'id']);
    }

    public function getLayoutTypeText($topic)
    {
        $text = '';
        switch ($topic->layout) {
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
