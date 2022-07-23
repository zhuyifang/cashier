<?php

namespace app\models;

use Yii;
use app\models\Goods;

/**
 * This is the model class for table "{{%form_goods}}".
 *
 * @property int $id
 * @property int $mall_id
 * @property int $mch_id
 * @property int $goods_id
 * @property string $calendar_start 开始时间
 * @property string $calendar_end 结束时间
 * @property string $is_today 时间类型none无限制|today当天|after延后天数
 * @property int $after_day 推迟预订天数
 * @property int $is_alone 天数计算1.单日期|0.时间段
 * @property int $has_kuatian 日期选项0.当天|1.跨天
 * @property int $is_day 限制天数量状态
 * @property int $day_max 限定天数
 * @property string $place_unit 提示单位
 * @property string $form_mode_type 商品规格模式basic传统模式|calendar日历模式
 * @property string $customization_data 定制模板数据
 * @property int $customization_status 定制模板状态0.关闭|1.开启
 * @property string $date_share_data 商品分销普通设置
 */
class FormGoods extends \app\models\ModelActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%form_goods}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mall_id', 'goods_id'], 'required'],
            [['mall_id', 'mch_id', 'goods_id', 'after_day', 'is_alone', 'has_kuatian', 'is_day', 'day_max', 'customization_status'], 'integer'],
            [['calendar_start', 'calendar_end'], 'safe'],
            [['customization_data', 'date_share_data'], 'string'],
            [['is_today', 'place_unit', 'form_mode_type'], 'string', 'max' => 255],
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
            'goods_id' => 'Goods ID',
            'calendar_start' => '开始时间',
            'calendar_end' => '结束时间',
            'is_today' => '时间类型none无限制|today当天|after延后天数',
            'after_day' => '推迟预订天数',
            'is_alone' => '天数计算1.单日期|0.时间段',
            'has_kuatian' => '日期选项0.当天|1.跨天',
            'is_day' => '限制天数量状态',
            'day_max' => '限定天数',
            'place_unit' => '提示单位',
            'form_mode_type' => '商品规格模式basic传统模式|calendar日历模式',
            'customization_data' => '定制模板数据',
            'customization_status' => '定制模板状态0.关闭|1.开启',
            'date_share_data' => '商品分销普通设置',
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
