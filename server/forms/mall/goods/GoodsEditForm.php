<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\goods;

use app\core\response\ApiCode;
use app\events\GoodsEvent;
use app\events\GoodsStatusEvent;
use app\forms\common\diy\ValidateForm;
use app\forms\common\ecard\CommonEcard;
use app\forms\common\goods\CommonCustomization;
use app\forms\common\goods\CommonGoods;
use app\forms\common\goods\GoodsAuth;
use app\forms\common\mch\MchSettingForm;
use app\models\FormGoods;
use app\models\FormGoodsAttr;
use app\models\Goods;
use app\models\GoodsAttr;
use app\models\GoodsCatRelation;
use app\models\GoodsMemberPrice;
use app\models\GoodsWarehouse;
use app\models\MallGoods;
use app\plugins\mch\models\MchGoods;
use yii\helpers\ArrayHelper;

/**
 * @property MallGoods $mallGoods;
 */
class GoodsEditForm extends BaseGoodsEdit
{
    // 商品库商品字段
    public $name;
    public $subtitle;
    public $keyword;
    public $original_price;
    public $cost_price;
    public $detail;
    public $video_url;
    public $unit;
    public $pic_url;
    public $type;

    // 商城商品字段
    public $is_negotiable;
    public $is_quick_shop;
    public $is_sell_well;

    protected $mallGoods;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name', 'cost_price', 'detail'
                , 'unit',], 'required'],
            [['is_quick_shop', 'is_sell_well', 'is_negotiable'], 'integer'],
            [['video_url', 'type', 'subtitle', 'keyword'], 'trim'],
            [['video_url', 'type', 'subtitle', 'keyword'], 'string'],
            ['type', 'default', 'value' => 'goods'],
            [['type'], 'in', 'range' => ['goods', 'ecard', 'form-goods']], // 商品类型
            [['original_price', 'cost_price'], 'number', 'min' => 0],
            [['pic_url'], 'safe'],
            [['is_quick_shop', 'is_sell_well', 'is_negotiable', 'original_price'], 'default', 'value' => 0],
            [['cost_price', 'original_price'], 'number', 'max' => 9999999]
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => '商品名称',
            'subtitle' => '副标题',
            'keyword' => '关键词',
            'original_price' => '商品原价',
            'cost_price' => '商品成本价',
            'detail' => '商品详情',
            'cover_pic' => '商品缩略图',
            'video_url' => '商品视频',
            'unit' => '商品单位',
            'is_quick_shop' => '是否快速购买',
            'is_sell_well' => '是否热销',
            'type' => '商品类型',
        ]);
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            
            $this->setEcard();
            $this->checkData();

            if (!$this->id) {
                $this->add();
            } else {
                $this->update();
            }

            $this->setAttr();
            $this->setFormGoods();
            $this->setGoodsCat();

            $this->setGoodsShare();
            $this->setGoodsMemberPrice();
            $this->setGoodsService();
            $this->setCard();
            $this->setCoupon();
            $this->setListener();
            $this->setGoodsStatusEvent();

            $transaction->commit();

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
            ];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    protected function getAttrItemData($newAttr)
    {
        if ($this->type != 'form-goods' || $this->form_mode_type == 'basic') {
            return parent::getAttrItemData($newAttr);
        }
        // 日历化模式
        if (!isset($newAttr['date'])) {
            throw new \Exception('请设置日历规格信息');
        }

        $maxNumber = 9999999;
        $goodsStock = 0;
        foreach ($newAttr['date'] as $attrDate) {
            if (!isset($attrDate['value']['stock'])) {
                throw new \Exception('日期stock字段不存在');
            }
            if (!isset($attrDate['value']['price'])) {
                throw new \Exception('日期price字段不存在');
            }
            $stock = $attrDate['value']['stock'];
            $price = $attrDate['value']['price'];
            $goodsStock += $stock;
        }

        if ($newAttr['stock'] > $maxNumber) {
            throw new \Exception('商品规格库存不能大于' . $maxNumber);
        }

        if ($goodsStock > $maxNumber) {
            throw new \Exception('商品总库存不能大于' . $maxNumber);
        }

        return [
            'stock' => $goodsStock,
        ];
    }

    protected function setExtraAttr()
    {
        if ($this->type != 'form-goods' || $this->form_mode_type == 'basic') {
            return parent::setExtraAttr();
        }
        $res = FormGoodsAttr::deleteAll(['goods_id' => $this->goods->id]);
        $minMemberPrice = null;
        if ($this->form_mode_type == 'calendar') {
            $newList = [];
            $deleteList = [];
            $dateAttrList = [];
            foreach ($this->newAttrs as $newAttr) {
                $dateAttrList[$this->attrSignList[$newAttr['sign_id']]] = $newAttr['date'];
                foreach ($newAttr['date'] as $date) {
                    $newList[] = [
                        'goods_id' => $this->goods->id,
                        'attr_id' => $this->attrSignList[$newAttr['sign_id']],
                        'date' => $date['date']['value'],
                        'stock' => $date['value']['stock'],
                        'price' => $date['value']['price'],
                        'member_price' => json_encode($date['value']['member_price']),
                        'share_level_list' => json_encode($date['value']['shareLevelList']),
                        'has_type' => json_encode($date['value']['has_type'])
                    ];

                    // 判断是否设置过会员信息
                    if (isset($date['value']['has_type']['memberPrice']) && $date['value']['has_type']['memberPrice']) {
                        foreach ($date['value']['member_price'] as $memberPrice) {
                            $minMemberPrice = $minMemberPrice ? min($minMemberPrice, $memberPrice) : $memberPrice;
                        }
                    }
                }
            }

            \Yii::$app->db->createCommand()->batchInsert(
                FormGoodsAttr::tableName(),
                ['goods_id', 'attr_id', 'date', 'stock', 'price', 'member_price', 'share_level_list', 'has_type'],
                $newList
            )->execute();

            CommonCustomization::getCommon()->setFormGoodsAttr($dateAttrList, $this->goods->id);
        }

        CommonCustomization::getCommon()->setMinMemberPrice($minMemberPrice, $this->goods->id);
    }

    /**
     * @param integer $goodsAttrId 商品规格
     * @param integer $level 会员等级
     * @param int $price
     * @throws Exception
     */
    protected function setGoodsMemberPrice()
    {
        if ($this->type != 'form-goods' || $this->form_mode_type == 'basic') {
            return parent::setGoodsMemberPrice();
        }
    }

    /**
     * @param $goodsAttrId
     * @param array $shareLevelList
     * @return boolean
     * @throws \Exception
     */
    protected function setGoodsShare()
    {
        if ($this->type != 'form-goods' || $this->form_mode_type == 'basic') {
            return parent::setGoodsShare();
        }
    }

    protected function setFormGoods()
    {
        if ($this->type == 'form-goods') {
            $formGoods = FormGoods::find()->andWhere(['goods_id' => $this->goods->id])->one();
            if (!$formGoods) {
                $formGoods = new FormGoods();
                $formGoods->mall_id = \Yii::$app->mall->id;
                $formGoods->mch_id = \Yii::$app->user->identity->mch_id;
                $formGoods->goods_id = $this->goods->id;
            }

            if ($this->form_mode_type == 'calendar') {
                if (strtotime($this->calendar_start) > strtotime($this->calendar_end)) {
                    throw new \Exception('日历化开始时间段不能大于结束时间段');
                }

                if ((strtotime($this->calendar_end) - strtotime($this->calendar_start)) / 86400 > 180) {
                    throw new \Exception('日历化时间段不能大于180天');
                }

                if (!$this->is_alone) {
                    if (!$this->place_unit) {
                        throw new \Exception('日历化提示单位不能为空');
                    }
                    if ($this->is_day && !$this->day_max) {
                        throw new \Exception('日历化限定天数不能为空');
                    }
                }
            }

            $formGoods->calendar_start = $this->calendar_start;
            $formGoods->calendar_end = $this->calendar_end;
            $formGoods->is_today = $this->is_today;
            $formGoods->after_day = $this->after_day;
            $formGoods->is_alone = $this->is_alone;
            $formGoods->has_kuatian = $this->has_kuatian;
            $formGoods->is_day = $this->is_day;
            $formGoods->day_max = $this->day_max;
            $formGoods->place_unit = $this->place_unit;
            $formGoods->customization_data = $this->getCustomizationData();
            $formGoods->customization_status = $this->customization_status;
            $formGoods->form_mode_type = $this->form_mode_type;
            $formGoods->date_share_data = $this->date ? json_encode($this->date) : json_encode([]);
            $res = $formGoods->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($formGoods));
            }

            $data = ArrayHelper::toArray($formGoods);
            $data['customization_data'] = json_decode($data['customization_data'], true);
            $data['date_share_data'] = json_decode($data['date_share_data'], true);
            unset($data['id']);// 不去除会覆盖商品id
            CommonCustomization::getCommon()->setFormGoods($data, $this->goods->id);
        }
    }

    protected function getCustomizationData()
    {
        if ($this->customization_status == 1 && $this->customization_data) {
            if (!isset($this->customization_data['name']) || !$this->customization_data['name']) {
                throw new \Exception('请填写定制模板名称');
            }
            if (!isset($this->customization_data['btn_name']) || !$this->customization_data['btn_name']) {
                throw new \Exception('请填写定制文字');
            }
            // 校验表单
            $validate = new ValidateForm();
            $validate->data = $this->customization_data['form_data'];
            foreach ($this->customization_data['form_data'] as $key => $datum) {
                $method = 'check' . hump($datum['id'], '-');
                // 校验组件中的内容标题
                $validate->checkTitle($datum['id'], $datum['data']);
                if (method_exists($validate, $method)) {
                    $validate->$method($datum['data']);
                }
            }
            if ($validate->submitCount == 0) {
                throw new \Exception('定制设置->提交按钮组件必须选择一个');
            }
            if ($validate->submitCount > 1) {
                throw new \Exception('定制设置->提交按钮组件最多选择一个');
            }
        }

        // TODO 验证逻辑数据

        return $this->customization_data ? json_encode($this->customization_data): json_encode([]);
    }

    protected function setEcard()
    {
        if ($this->type == 'ecard') {
            $this->use_attr = 0;
            $this->attr_setting_type = 0;
        }
    }

    protected function checkData()
    {
        if (count($this->pic_url) <= 0) {
            throw new \Exception('请上传商品轮播图');
        }
    }

    /**
     * 触发商品上下架
     */
    protected function setGoodsStatusEvent()
    {
        \Yii::$app->trigger(Goods::EVENT_STATUS, new GoodsStatusEvent([
            'id' => $this->goods->id,
            'status_after' => $this->goods->status
        ]));
    }

    protected function setGoodsSign()
    {
        return $this->mch_id > 0 ? 'mch' : '';
    }

    /**
     * @throws \Exception
     * 新增商品库商品
     */
    private function add()
    {
        $goodsWarehouse = $this->editGoodsWarehouse();
        $this->goods_warehouse_id = $goodsWarehouse->id;
        $this->setGoods();
        $this->editMallGoods();
        $this->editMchGoods();
    }

    /**
     * @throws \Exception
     * 修改商品库商品
     */
    private function update()
    {
        $common = CommonGoods::getCommon();
        $this->setGoods();
        if (!$this->goods->goodsWarehouse) {
            throw new \Exception('商品库错误：查找不到id为' . $this->goods->goods_warehouse_id . '的商品');
        }
        $this->editGoodsWarehouse($this->goods->goodsWarehouse);

        $mallGoods = $common->getMallGoods($this->goods->id);
        if (!$mallGoods) {
            throw new \Exception('mall_goods商品不存在或者已删除');
        }
        $this->editMallGoods($mallGoods);
        $this->editMchGoods($this->goods->id);
    }

    /**
     * @param null|GoodsWarehouse $goodsWarehouse
     * @return GoodsWarehouse|null
     * @throws \Exception
     * 编辑商品库
     */
    private function editGoodsWarehouse($goodsWarehouse = null)
    {
        if (!$goodsWarehouse) {
            $goodsWarehouse = new GoodsWarehouse();
            $goodsWarehouse->mall_id = \Yii::$app->mall->id;
            $goodsWarehouse->is_delete = 0;
            $goodsWarehouse->type = $this->type;
            $goodsWarehouse->ecard_id = $this->plugin_data['ecard']['ecard_id'] ?? 0;
            if ($goodsWarehouse->type == 'ecard' && $goodsWarehouse->ecard_id == 0) {
                throw new \Exception('卡密类商品需要选择卡密');
            }
        }
        $goodsWarehouse->name = $this->name;
        $goodsWarehouse->subtitle = $this->subtitle;
        $goodsWarehouse->keyword = $this->keyword;
        $goodsWarehouse->original_price = $this->original_price;
        $goodsWarehouse->cost_price = $this->cost_price;
        $goodsWarehouse->detail = $this->detail;
        $goodsWarehouse->cover_pic = $this->pic_url[0]['pic_url'];
        $goodsWarehouse->pic_url = \Yii::$app->serializer->encode($this->pic_url);
        $goodsWarehouse->video_url = $this->video_url;
        $goodsWarehouse->unit = $this->unit;
        if (!$goodsWarehouse->save()) {
            throw new \Exception('商品保存失败：' . $this->getErrorMsg($goodsWarehouse));
        }
        $this->goodsWarehouse = $goodsWarehouse;
        return $goodsWarehouse;
    }

    /**
     * @param null|MallGoods $mallGoods
     * @return MallGoods|null
     * @throws \Exception
     * 编辑商城商品
     */
    private function editMallGoods($mallGoods = null)
    {
        if (!$mallGoods) {
            $mallGoods = new MallGoods();
            $mallGoods->is_delete = 0;
            $mallGoods->mall_id = \Yii::$app->mall->id;
            $mallGoods->goods_id = $this->goods->id;
        }

        $mallGoods->is_quick_shop = $this->is_quick_shop;
        $mallGoods->is_sell_well = $this->is_sell_well;
        $mallGoods->is_negotiable = $this->is_negotiable;

        if (in_array($this->type, ['form-goods', 'ecard'])) {
            $mallGoods->is_quick_shop = 0;
            $mallGoods->is_negotiable = 0;
        }

        if (!$mallGoods->save()) {
            throw new \Exception('商品保存失败：' . $this->getErrorMsg($mallGoods));
        }
        return $mallGoods;
    }

    /**
     * @return MchGoods|null
     * @throws \Exception
     * 编辑多商户商品
     */
    private function editMchGoods($goodsId = null)
    {
        if ($this->mch_id <= 0) {
            return false;
        }
        $mchGoods = null;
        if ($goodsId) {
            $mchGoods = MchGoods::findOne(['goods_id' => $goodsId]);
            if (!$mchGoods) {
                throw new \Exception('商户商品不存在');
            }
        }

        if (!$mchGoods) {
            $mchGoods = new MchGoods();
            $mchGoods->is_delete = 0;
            $mchGoods->mall_id = \Yii::$app->mall->id;
            $mchGoods->mch_id = $this->mch_id;
            $mchGoods->goods_id = $this->goods->id;
        }

        // 多商户开启商品上架审核,每次编辑都需下架
        $form = new MchSettingForm();
        $setting = $form->search();
        if ($setting['is_goods_audit'] == 1) {
            $this->goods->status = 0;
            $res = $this->goods->save();
            if (!$res) {
                throw new \Exception($this->goods);
            }
            $mchGoods->status = 0;
            $mchGoods->remark = '';
        } else {
            $mchGoods->status = 2;
        }

        $mchGoods->sort = $this->sort;
        if (!$mchGoods->save()) {
            throw new \Exception('商品保存失败：' . $this->getErrorMsg($mchGoods));
        }

        return $mchGoods;
    }

    /**
     * 商品分类
     */
    protected function setGoodsCat()
    {
        if (!is_array($this->cats) || !is_array($this->mchCats)) {
            throw new \Exception('分类必须为数组');
        }

        GoodsCatRelation::deleteAll(['goods_warehouse_id' => $this->goods->goodsWarehouse->id]);

        $cats = array_merge($this->cats, $this->mchCats);
        $newList = [];
        foreach ($cats as $item) {
            $newList[] = [
                'cat_id' => $item,
                'goods_warehouse_id' => $this->goods->goodsWarehouse->id
            ];
        }
        \Yii::$app->db->createCommand()->batchInsert(
            GoodsCatRelation::tableName(),
            ['cat_id', 'goods_warehouse_id'],
            $newList
        )->execute();
    }

    public function getPermission($sign)
    {
        $permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
        $list = [];
        if ($sign == 'mall' || in_array($sign, $permission)) {
            $goodsAuth = GoodsAuth::create($sign);
            $list = $goodsAuth->toArray();
        }
        foreach ($permission as $item) {
            try {
                $plugin = \Yii::$app->plugin->getPlugin($item);
                if (!method_exists($plugin, 'getGoodsConfig')) {
                    continue;
                }
                $list = array_merge($list, $plugin->getGoodsConfig());
            } catch (\Exception $exception) {
                continue;
            }
        }
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '',
            'data' => $list
        ];
    }
}
