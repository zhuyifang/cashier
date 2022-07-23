<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/8
 * Time: 4:21 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\forms\mall\goods\BaseGoodsEdit;
use app\plugins\weekly_buy\jobs\FavoriteAutoDelJob;
use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\common\week_status\WeekStatusFactory;
use app\plugins\weekly_buy\jobs\GoodsJob;
use app\plugins\weekly_buy\models\Goods;
use app\plugins\weekly_buy\models\WeeklyBuyGoods;
use app\plugins\weekly_buy\models\WeeklyBuyGroups;
use app\plugins\weekly_buy\Plugin;

class GoodsEditForm extends BaseGoodsEdit
{
    public $start_time;
    public $end_time;
    public $week_type;
    public $week_status_day;
    public $week_status_week;
    public $week_status_month;
    public $week_status_customize;
    public $week_status_customize_day;
    public $before_day;
    public $last_time;
    public $delay;
    public $delay_limit_type;
    public $delay_limit_number;
    public $freight_type;
    public $freight_price;
    public $city_freight_type;
    public $city_freight_price;
    public $shipping_type;
    public $shipping_number;
    public $shipping_price;
    public $group_list;
    public $city_shipping_type;
    public $city_shipping_number;
    public $city_shipping_price;
    public $is_no_end_time;
    public $week_custom;
    public $week_mode;
    public $week_loop;
    public $month_loop;

    /**
     * @var WeeklyBuyGoods $weeklyBuyGoods
     */
    protected $weeklyBuyGoods;
    protected $isAddGroups = false;
    /**
     * @var Goods $groupGoods
     */
    protected $groupGoods;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['start_time', 'before_day', 'last_time', 'delay'], 'required'],
            [['start_time', 'end_time', 'week_custom'], 'trim'],
            [['start_time', 'end_time'], 'string'],
            [['week_custom'], 'string', 'max' => 255],
            [['week_type'], 'in', 'range' => [1, 2, 3, 4, 5, 6]],
            [['week_status_customize_day', 'delay'], 'integer', 'min' => 1, 'max' => 365],
            [['week_status_customize_day', 'delay'], 'default', 'value' => 1],
            [['last_time'], 'integer', 'min' => 1, 'max' => 24],
            [['delay_limit_number', 'shipping_number', 'before_day', 'city_shipping_number'], 'integer', 'min' => 0],
            [['shipping_number', 'city_shipping_number'], 'integer', 'max' => 999999],
            [['before_day'], 'integer', 'max' => 999999],
            [['delay_limit_number'], 'integer', 'max' => 31],
            [['delay_limit_number', 'shipping_number', 'freight_price', 'city_freight_price', 'shipping_price',
                'before_day', 'city_freight_type', 'shipping_type', 'city_shipping_type', 'city_shipping_number',
                'city_shipping_price', 'is_no_end_time'], 'default', 'value' => 0],
            [['freight_price', 'city_freight_price', 'shipping_price', 'city_shipping_price'],
                'number', 'min' => 0, 'max' => 999999],
            [['shipping_type', 'city_shipping_type'], 'in', 'range' => [0, 1, 2]],
            [['delay_limit_type', 'freight_type', 'city_freight_type', 'is_no_end_time',
                'week_mode'], 'in', 'range' => [0, 1]],
            [['group_list', 'week_status_day', 'week_status_month', 'week_status_customize',
                'week_status_week', 'week_loop', 'month_loop'], 'safe']
        ]);
    }

    public function attributeLabels()
    {
        return [
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'week_type' => '配送周期',
            'week_status_day' => '每日一期的配送日期',
            'week_status_week' => '每周一期的配送日期',
            'week_status_month' => '每月一期的配送日期',
            'week_status_customize' => '自定义的配送日期',
            'week_status_customize_day' => '自定义配送的天数',
            'before_day' => '支付提前的天数',
            'last_time' => '一天的截止时间',
            'delay' => '顺延提前的天数',
            'delay_limit_type' => '顺延限制类型',
            'delay_limit_number' => '可顺延次数',
            'freight_type' => '运费类型',
            'freight_price' => '固定运费（元）',
            'shipping_type' => '包邮类型',
            'shipping_number' => '包邮的期数',
            'shipping_price' => '包邮的金额（元）',
            'city_freight_type' => '同城配送运费类型',
            'city_freight_price' => '同城配送固定运费（元）',
            'city_shipping_type' => '同城配送包邮类型',
            'city_shipping_number' => '同城配送包邮的期数',
            'city_shipping_price' => '同城配送包邮的金额（元）',
            'is_no_end_time' => '不设结束时间开关',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            // 同城配送的运费设置和包邮设置暂时和快递的一直
            $this->city_freight_type = $this->freight_type;
            $this->city_shipping_type = $this->shipping_type;
            $this->is_shipping = 1;


            $this->attrValidator();
            $this->checkData();
            $this->checkGroupsData();
            $this->setGoods();
            $this->setAttr();
            $this->setGoodsShare();
            $this->setGoodsMemberPrice();
            $this->setCard();
            $this->setCoupon();
            $this->setGoodsService();
            $this->setListener();
            $actualGoodsIds = [];
            foreach ($this->group_list as $item) {
                $this->isAddGroups = true;
                $groupData = WeeklyBuyGroups::findOne([
                    'mall_id' => \Yii::$app->mall->id, 'weekly_buy_goods_id' => $this->weeklyBuyGoods->id,
                    'number' => $item['number'], 'is_delete' => 0
                ]);
                $this->id = $groupData ? $groupData->goods_id : 0;

                $this->shareLevelList = isset($item['shareLevelList']) && $item['shareLevelList'] ? $item['shareLevelList'] : [];
                $this->member_price = isset($item['member_price']) && $item['member_price'] ? $item['member_price'] : [];
                $this->attr = $item['attr'];
                if ($this->use_attr == 0) {
                    $this->price = $item['attr'][0]['price'];
                    $this->goods_num = $item['attr'][0]['stock'];
                }

                $this->setGoods();
                $this->setAttr();
                $this->setGoodsShare();
                $this->setGoodsMemberPrice();
                $this->setGoodsService();
                $this->setCard();
                $this->setCoupon();
                $this->setListener();
                if (!$groupData) {
                    $groupData = new WeeklyBuyGroups();
                    $groupData->goods_id = $this->goods->id;
                    $groupData->weekly_buy_goods_id = $this->weeklyBuyGoods->id;
                    $groupData->number = $item['number'];
                    $groupData->mall_id = \Yii::$app->mall->id;
                }
                $groupData->is_delete = 0;
                $groupData->title = $item['title'];
                if (!$groupData->save()) {
                    throw new WeeklyBuyException($this->getErrorMsg($groupData));
                }
                $actualGoodsIds[] = $groupData->goods_id;
            }
            $this->deleteGoods($actualGoodsIds);

            //自动删除到期的商品收藏
            $class = new FavoriteAutoDelJob(['goods_id' => $this->goods->id]);
            $time = strtotime($this->end_time) - time() > 0 ? strtotime($this->end_time) - time() : 0;
            \Yii::$app->queue->delay($time)->push($class);

            $transaction->commit();
            return $this->success([
                'msg' => '保存成功'
            ]);
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $this->failByException($e);
        }
    }

    protected function setGoodsSign()
    {
        return (new Plugin())->getName();
    }

    public function setExtraGoods($goods)
    {
        // 主商品
        $weeklyBuyGoods = WeeklyBuyGoods::findOne([
            'goods_id' => $goods->id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0
        ]);
        if (!$weeklyBuyGoods) {
            $weeklyBuyGoods = new WeeklyBuyGoods();
            $weeklyBuyGoods->is_delete = 0;
            $weeklyBuyGoods->goods_id = $goods->id;
            $weeklyBuyGoods->mall_id = \Yii::$app->mall->id;
            $weeklyBuyGoods->start_time = $this->start_time;
        }
        if ($this->is_no_end_time == 0) {
            $weeklyBuyGoods->end_time = $this->end_time;
        }
        $weeklyBuyGoods->is_no_end_time = $this->is_no_end_time;
        $weeklyBuyGoods->week_type = $this->week_type;
        $weekStatus = WeekStatusFactory::create($this->week_type);
        $weeklyBuyGoods = $weekStatus->setWeeklyBuyGoods($weeklyBuyGoods, (array)$this);
        $weeklyBuyGoods->before_day = $this->before_day;
        $weeklyBuyGoods->last_time = $this->last_time;
        $weeklyBuyGoods->delay = $this->delay;
        $weeklyBuyGoods->delay_limit_type = $this->delay_limit_type;
        if ($this->delay_limit_type == 1) {
            $weeklyBuyGoods->delay_limit_number = $this->delay_limit_number;
        }
        $weeklyBuyGoods->freight_type = $this->freight_type;
        if ($this->freight_type == 1) {
            $weeklyBuyGoods->freight = $this->freight_price;
        }
        $weeklyBuyGoods->city_freight_type = $this->city_freight_type;
        if ($this->city_freight_type == 1) {
            $weeklyBuyGoods->city_freight = $this->city_freight_price;
        }
        $weeklyBuyGoods->shipping_type = $this->shipping_type;
        if ($this->shipping_type == 1) {
            $weeklyBuyGoods->shipping_number = $this->shipping_number;
        }
        if ($this->shipping_type == 2) {
            $weeklyBuyGoods->shipping_price = $this->shipping_price;
        }
        $weeklyBuyGoods->city_shipping_type = $this->city_shipping_type;
        if ($this->city_shipping_type == 1) {
            $weeklyBuyGoods->city_shipping_number = $this->city_shipping_number;
        }
        if ($this->city_shipping_type == 2) {
            $weeklyBuyGoods->city_shipping_price = $this->city_shipping_price;
        }
        if ($this->isAddGroups) {
            $weeklyBuyGoods->weekly_buy_goods_id = $this->weeklyBuyGoods->id;
        }
        $weeklyBuyGoods->week_custom = $this->week_custom;
        $weeklyBuyGoods->week_mode = $this->week_mode;
        if (!$weeklyBuyGoods->save()) {
            throw new WeeklyBuyException($this->getErrorMsg($weeklyBuyGoods));
        }

        if (!$this->isAddGroups) {
            $time = strtotime($this->end_time) - time();
            \Yii::$app->queue3->delay($time > 0 ? $time : 0)->push(new GoodsJob([
                'goodsId' => $goods->id, 'mall_id' => \Yii::$app->mall->id
            ]));

            $this->weeklyBuyGoods = $weeklyBuyGoods;
        }
        return parent::setExtraGoods($goods);
    }

    /**
     * @throws WeeklyBuyException
     */
    public function checkData()
    {
        $startTime = strtotime($this->start_time);
        if ($this->is_no_end_time == 0 && !$this->end_time) {
            throw new WeeklyBuyException('结束时间不能为空');
        }
        $endTime = strtotime($this->end_time);
        if ($this->is_no_end_time == 0 && $this->end_time && $startTime > $endTime) {
            throw new WeeklyBuyException('开始时间不能小于结束时间');
        }

        if ($startTime < strtotime('1970-01-05 00:00:00')) {
            throw new WeeklyBuyException('开始时间不能小于1970-01-05 00:00:00');
        }

        if ($this->is_no_end_time == 0 && $endTime > strtotime('2038-01-01 00:00:00')) {
            throw new WeeklyBuyException('结束时间不能大于2038-01-01 00:00:00');
        }

        if ($this->week_mode == 0 && !in_array($this->week_type, [1, 2, 3, 4])) {
            throw new WeeklyBuyException('配送周期选择不正确');
        }

        if ($this->week_mode == 1 && !in_array($this->week_type, [5, 6])) {
            throw new WeeklyBuyException('循环时间设置选择不正确');
        }

        // 校验配送周期可选参数的正确性
        $weekStatus = WeekStatusFactory::create($this->week_type);
        $weekStatus->checkData($weekStatus->getData($this));
    }

    /**
     * @throws WeeklyBuyException
     */
    public function checkGroupsData()
    {
        if (empty($this->group_list)) {
            throw new WeeklyBuyException('周期购期数不能为空');
        }
        $people = [];
        foreach ($this->group_list as &$item) {
            $item['number'] = isset($item['number']) ? (int)$item['number'] : 2;

            $people[] = $item['number'];

            if ($item['number'] <= 0) {
                throw new WeeklyBuyException('请填写期数');
            }

            if ($item['number'] < 2) {
                throw new WeeklyBuyException('期数不能小于2');
            }

            if ($item['number'] > 999999) {
                throw new WeeklyBuyException('期数不能大于999999');
            }

            foreach ($item['attr'] as &$aItem) {
                $aItem['price'] = isset($aItem['price']) ? (float)$aItem['price'] : 0;
                if ($aItem['price'] < 0) {
                    throw new WeeklyBuyException('单个商品价格不能小于0');
                }
            }
            unset($aItem);
        }
        unset($item);

        if (count($people) != count(array_unique($people))) {
            throw new WeeklyBuyException('不能设置两个相同的期数');
        }
    }

    public function deleteGoods($actualGoodsIds)
    {
        if ($this->id) {
            // 编辑时先删除原先设置的附属商品及相应的规格
            $goodsIds = WeeklyBuyGroups::find()->where([
                'mall_id' => \Yii::$app->mall->id, 'weekly_buy_goods_id' => $this->weeklyBuyGoods->id,
                'is_delete' => 0
            ])->select('goods_id')->column();
            $goodsIds = array_values(array_diff($goodsIds, $actualGoodsIds));
            Goods::updateAll(['is_delete' => 1], ['is_delete' => 0, 'id' => $goodsIds]);
            WeeklyBuyGoods::updateAll(['is_delete' => 1], ['is_delete' => 0, 'goods_id' => $goodsIds]);
            WeeklyBuyGroups::updateAll(['is_delete' => 1], ['is_delete' => 0, 'goods_id' => $goodsIds]);
        }
    }
}
