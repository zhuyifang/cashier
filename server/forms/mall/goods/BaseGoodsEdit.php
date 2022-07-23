<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/3/13
 * Time: 15:08
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\mall\goods;

use app\events\GoodsEvent;
use app\forms\common\CommonMallMember;
use app\forms\common\diy\ValidateForm;
use app\forms\common\goods\CommonGoods;
use app\forms\common\goods\GoodsAuth;
use app\models\FormGoods;
use app\models\Goods;
use app\models\GoodsAttr;
use app\models\GoodsCardRelation;
use app\models\GoodsCouponRelation;
use app\models\GoodsMemberPrice;
use app\models\GoodsServiceRelation;
use app\models\GoodsShare;
use app\models\GoodsWarehouse;
use app\models\MallMembers;
use app\models\Model;
use app\plugins\mch\models\Mch;
use yii\db\Exception;
use yii\helpers\Html;

/**
 * @property Goods $goods
 * @property GoodsWarehouse $goodsWarehouse
 */
abstract class BaseGoodsEdit extends Model
{
    public $id;
    public $goods_warehouse_id;
    public $status;
    public $price;
    public $use_attr;
    public $attr;
    public $goods_num;
    public $virtual_sales;
    public $cats;
    public $mchCats;
    public $services;
    public $goods_no;
    public $goods_weight;
    public $sort;
    public $is_level;
    public $confine_count;
    public $give_integral;
    public $give_integral_type;
    public $give_balance;
    public $give_balance_type;
    public $forehead_integral;
    public $forehead_integral_type;
    public $accumulative;
    public $is_negotiable;
    public $freight_id;
    public $is_shipping;
    public $shipping_id;
    public $pieces;
    public $forehead;
    public $app_share_title;
    public $app_share_pic;
    public $pic_url;
    public $is_area_limit;
    public $area_limit;
    public $attr_default_name;
    public $confine_order_count;
    public $form_mode_type;
    public $cost_price;

    //分销
    public $is_share;
    public $individual_share;
    public $share_type;
    public $shareLevelList;
    public $rebate;
    public $attr_setting_type;
    public $cards;
    public $coupons;
    public $attrGroups;

    public $isNewRecord;
    public $goods;
    public $goodsWarehouse;
    public $member_price;
    public $diffAttrIds = [];

    public $is_level_alone;
    public $is_default_services;
    public $select_attr_groups;
    public $form_id;

    public $mch_id;

    protected $newAttrs;
    protected $attrSignList;
    protected $sign;
    /** @var  Mch */
    protected $mch;

    public $is_vip_card_goods;
    public $plugin_data;
    public $guarantee_title;
    public $guarantee_pic;

    private $maxNum = 9999999;

    public $param_name;
    public $param_content;
    public $limit_buy_status;
    public $limit_buy_type;
    public $limit_buy_value;
    public $limit_buy_order;
    public $min_number;
    public $is_setting_show_and_buy_auth;
    public $show_goods_auth;
    public $buy_goods_auth;
    public $is_setting_send_type;
    public $send_type;
    public $is_time;
    public $sell_time;

    public $bar_code;

    // 定制商品
    public $customization_data;
    public $customization_status;
    public $date;// 单规格日期数据
    public $calendar_start;
    public $calendar_end;
    public $is_today;
    public $after_day;
    public $is_alone;
    public $has_kuatian;
    public $is_day;
    public $day_max;
    public $place_unit;

    public function rules()
    {
        return [
            [['status', 'use_attr', 'goods_num', 'price'], 'required'],
            [['use_attr', 'goods_num', 'virtual_sales', 'goods_weight', 'individual_share',
                'share_type', 'attr_setting_type', 'sort', 'is_level',
                'confine_count', 'give_integral', 'give_integral_type', 'forehead_integral_type',
                'accumulative', 'freight_id', 'shipping_id', 'pieces', 'is_level_alone', 'is_default_services',
                'goods_warehouse_id', 'mch_id', 'form_id', 'is_area_limit', 'confine_order_count', 'is_vip_card_goods',
                'give_balance_type', 'limit_buy_status', 'limit_buy_value', 'min_number','is_shipping', 'is_share',
                'is_setting_show_and_buy_auth', 'is_setting_send_type', 'is_time', 'limit_buy_order', 'customization_status', 'after_day', 'is_alone', 'has_kuatian', 'is_day', 'day_max'], 'integer'],
            [['goods_no', 'rebate', 'app_share_title', 'app_share_pic', 'attr_default_name',
                'guarantee_title', 'guarantee_pic', 'param_name', 'limit_buy_type', 'show_goods_auth',
                'buy_goods_auth', 'bar_code', 'calendar_start', 'calendar_end', 'is_today', 'place_unit', 'form_mode_type'], 'string'],
            [['forehead', 'id'], 'number'],
            [['cats', 'mchCats', 'services', 'cards', 'attr', 'attrGroups', 'member_price',
                'select_attr_groups', 'shareLevelList', 'plugin_data', 'coupons', 'send_type', 'sell_time', 'customization_data', 'date'], 'safe'],
            [['virtual_sales', 'freight_id', 'is_level', 'is_level_alone', 'forehead', 'forehead_integral',
                'give_integral', 'individual_share', 'is_level_alone', 'pieces', 'share_type', 'accumulative',
                'attr_setting_type', 'goods_weight', 'is_area_limit', 'form_id',
                'give_balance', 'shipping_id', 'is_setting_send_type', 'is_time'], 'default', 'value' => 0],
            [['app_share_title', 'app_share_pic', 'attr_default_name', 'guarantee_title',
                'guarantee_pic', 'param_name'], 'default', 'value' => ''],
            [['sort'], 'default', 'value' => 100],
            [['sort'], 'integer', 'max' => 9999999],
            [['area_limit', 'param_content'], 'trim'],
            [['confine_count', 'confine_order_count', 'limit_buy_value', 'limit_buy_order'], 'default', 'value' => -1],
            [['forehead_integral_type', 'give_integral_type', 'is_level',
                'is_default_services', 'give_balance_type', 'limit_buy_status', 'min_number',
                'is_setting_show_and_buy_auth', 'is_shipping', 'is_share'], 'default', 'value' => 1],
            [['price', 'forehead_integral', 'give_integral', 'give_balance', 'cost_price'], 'number', 'min' => 0],
            [['price', 'forehead_integral'], 'number', 'max' => 99999999],
            [['price', 'pieces', 'forehead', 'give_integral', 'give_balance', 'forehead_integral', 'confine_count',
                'confine_order_count', 'goods_weight', 'virtual_sales'], 'number', 'max' => 9999999],
            ['limit_buy_type', 'default', 'value' => 'day'],
            [['limit_buy_value', 'limit_buy_order'], 'number', 'max' => 9999],
            [['show_goods_auth', 'buy_goods_auth'], 'default', 'value' => '-1']
        ];
    }

    public function attributeLabels()
    {
        return [
            'status' => '商品上架状态',
            'price' => '商品售价',
            'use_attr' => '是否使用规格',
            'attr' => '商品规格',
            'goods_num' => '商品总库存',
            'goods_weight' => '商品重量',
            'virtual_sales' => '已出售量',
            'sort' => '排序',
            'is_share' => '是否允许分销',
            'is_shipping' => '是否允许包邮',
            'is_level' => '是否会员价购买',
            'is_level_alone' => '是否单独设置会员价格',
            'app_share_title' => '自定义分享标题',
            'app_share_pic' => '自定义分享图片',
            'pieces' => '单品满件包邮',
            'forehead' => '单品满额包邮',
            'give_integral' => '积分赠送',
            'forehead_integral' => '积分抵扣',
            'confine_count' => '限购数量（商品）',
            'confine_order_count' => '限购数量（订单）',
            'give_balance' => '余额赠送',
            'param_name' => '参数名称',
            'param_content' => '参数内容',
            'limit_buy_status' => '限购状态0--关闭 1--开启',
            'limit_buy_type' => '限购类型 day--每天 week--每周 month--每月 all--永久',
            'limit_buy_value' => '限购数量',
            'min_number' => '起售数量',
        ];
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if (!parent::validate($attributeNames, $clearErrors)) {
            return false;
        }
        try {
            $this->attrValidator();
            $this->attrGroupNameValidator();
            return true;
        } catch (\Exception $exception) {
            $this->addError('attr', $exception->getMessage());
            return false;
        }
    }

    /**
     * 规格名称特殊符验证
     */
    protected function attrGroupNameValidator()
    {
        $preg = "/[\'=]|\\\|\"|\|/";

        if ((int)$this->use_attr === 1 && !$this->attrGroups) {
            throw new Exception('请添加规格组信息');
        }

        $arrGroups = [];
        foreach ($this->attrGroups as $item) {
            if (trim($item['attr_group_name']) == '') {
                throw new \Exception('规则组名称不能为空');
            }

            if (preg_match($preg, $item['attr_group_name'])) {
                throw new Exception('商品规格组、规格名称、规格详情不能包含 \' " \\ = 等特殊符');
            }

            if (!isset($item['attr_list']) || count($item['attr_list']) == 0) {
                throw new Exception('请完善规格组（' . $item['attr_group_name'] . '）的规格值');
            }
            // 规格组名称 不能重复
            if (in_array(trim($item['attr_group_name']), $arrGroups)) {
                throw new \Exception('规格组名称不能重复');
            }
            $arrGroups[] = trim($item['attr_group_name']);

            $arrAttr = [];
            foreach ($item['attr_list'] as $item2) {
                if (trim($item2['attr_name']) == '') {
                    throw new \Exception('规则值名称不能为空');
                }

                if (preg_match($preg, $item2['attr_name'])) {
                    throw new Exception('商品规格组、规格名称、规格详情不能包含 \' " \\ = 等特殊符');
                }

                if (in_array(trim($item2['attr_name']), $arrAttr)) {
                    throw new \Exception('同一规格组下,规格名称不能重复');
                }
                $arrAttr[] = trim($item2['attr_name']);
            }
        }
    }


    /**
     * 商品规格数据验证
     */
    protected function attrValidator()
    {
        $allMembers = CommonMallMember::getAllMember();
        $memberList = ['level0'];
        /** @var MallMembers $item */
        foreach ($allMembers as $item) {
            $memberList[] = 'level' . $item->level;
        }
        // 多规格检查
        if ((int)$this->use_attr === 1) {
            if (!$this->attr || !is_array($this->attr)) {
                throw new Exception('请完善商品规格信息');
            }

            $goodsNum = 0;
            $num = $this->maxNum;
            foreach ($this->attr as $k => &$item) {
                if ($item['stock'] > $num) {
                    throw new \Exception('商品库存不能大于' . $num);
                }
                if ($item['price'] > $num) {
                    throw new \Exception('商品价格不能大于' . $num);
                }
                if ($item['weight'] > $num) {
                    throw new \Exception('商品重量不能大于' . $num);
                }

                if (!isset($item['cost_price'])) {
                    $item['cost_price'] = 0;
                }

                if ($item['cost_price'] > $num) {
                    throw new \Exception('商品成本价不能大于' . $num);
                }
                // 多规格计算商品库存总数
                $goodsNum += (int)$item['stock'];

                if (!isset($item['stock']) || (int)$item['stock'] < 0) {
                    throw new Exception('规格库存必须大于0');
                }
                if (!isset($item['price']) || (int)$item['price'] < 0) {
                    throw new Exception('规格价格必须大于0');
                }
                if ((int)$item['weight'] < 0) {
                    throw new Exception('规格重量不能小于0');
                }

                if ((int)$item['cost_price'] < 0) {
                    throw new Exception('规格成本价不能小于0');
                }

//                if (mb_strlen($item['no']) > 60) {
//                    throw new \Exception('货号不能越过60个字符');
//                }


                $this->checkExtra($item);

                // 没有会员价时、不需要验证会员价
                if (isset($item['member_price']) && $this->is_level_alone == 1) {
                    foreach ($item['member_price'] as $key => $memberItem) {
                        if (!isset($memberList[$key])) {
                            continue;
                        }

                        if ((int)$memberItem < 0) {
                            throw new Exception('多规格会员价不能小于0');
                        }
                        if ((doubleval($memberItem)) > doubleval($item['price'])) {
                            throw new \Exception('会员价不能大于商品售价');
                        }
                    }
                }
            }

            if ($goodsNum > $num) {
                throw new Exception('商品总库存的值必须不大于' . $this->maxNum);
            }
        } else {
            $this->attr_setting_type = 0;
            if ($this->goods_num > $this->maxNum) {
                throw new \Exception('商品总库存不能大于' . $this->maxNum);
            }

            if ($this->goods_weight > $this->maxNum) {
                throw new \Exception('商品重量不能大于' . $this->maxNum);
            }
        }

        // 默认规格下会员价检查
        if ((int)$this->use_attr === 0 && (int)$this->is_level === 1) {
            foreach ($this->member_price as $key => $item) {
                if (!isset($memberList[$key])) {
                    continue;
                }
                if ($item < 0) {
                    throw new Exception('会员价不能小于0');
                }

                if (doubleval($item) > doubleval($this->price)) {
                    throw new \Exception('会员价不能大于商品售价');
                }
            }
        }
    }

    abstract public function save();

    abstract protected function setGoodsSign();

    /**
     * @return Goods
     */
    protected function getGoods()
    {
        return $this->goods;
    }

    /**
     * @throws \Exception
     * 设置商品
     */
    protected function setGoods()
    {
        $this->setMch();

        $common = CommonGoods::getCommon();
        if (!$this->goods_warehouse_id) {
            throw new \Exception('请先选择商品');
        }
        $goodsWarehouse = $common->getGoodsWarehouse($this->goods_warehouse_id);
        if (!$goodsWarehouse) {
            throw new \Exception('商品以删除，请重新选择商品');
        }
        if ($this->id) {
            $this->isNewRecord = false;
            $goods = $this->getGoodsData($common);
        } else {
            $goods = new Goods();
            $goods->mall_id = \Yii::$app->mall->id;
            $goods->is_delete = 0;
            $this->isNewRecord = true;
        }
        $this->attrGroups = $goods->handleAttrGroups($this->attrGroups);
        $this->goodsWarehouse = $goodsWarehouse;
        if ($goodsWarehouse->type == 'ecard') {
            $this->is_area_limit = 0;
            $this->area_limit = [['list' => []]];
            if ($this->use_attr != 0) {
                throw new \Exception('卡密类商品不使用选择规格');
            }
        }

        // 商品
        $goods->goods_warehouse_id = $this->goods_warehouse_id;
        $goods->virtual_sales = $this->virtual_sales;
        $goods->price = $this->price;
        $goods->use_attr = $this->use_attr;
        $goods->attr_groups = \Yii::$app->serializer->encode($this->attrGroups);
        $goods->app_share_title = $this->app_share_title;
        $goods->app_share_pic = $this->app_share_pic;
        $goods->status = $this->status;
        $goods->confine_count = $this->confine_count;
        $goods->confine_order_count = $this->confine_order_count;
        $goods->pieces = $this->pieces;
        $goods->forehead = $this->forehead;
        $goods->freight_id = $this->freight_id;
        $goods->is_shipping = $this->is_shipping;
        $goods->shipping_id = $this->shipping_id;
        $goods->give_integral = $this->give_integral;
        $goods->give_integral_type = $this->give_integral_type;
        $goods->give_balance = $this->give_balance;
        $goods->give_balance_type = $this->give_balance_type;
        $goods->forehead_integral = $this->forehead_integral;
        $goods->forehead_integral_type = $this->forehead_integral_type;
        $goods->accumulative = $this->accumulative;
        $goods->is_share = $this->is_share;
        if ($this->mch_id > 0) {
            $goods->is_share = $this->individual_share;
        }
        $goods->individual_share = $this->individual_share;
        $goods->attr_setting_type = $this->attr_setting_type;
        $goods->form_id = $this->form_id;
        $goods->is_area_limit = $this->is_area_limit;
        $goods->area_limit = \Yii::$app->serializer->encode($this->area_limit);
        $goods->guarantee_title = $this->guarantee_title;
        $goods->guarantee_pic = $this->guarantee_pic;
        if ($this->mch_id) {
            $goods->is_level = 0;
        } else {
            $goods->is_level = $this->is_level;
            $goods->sort = $this->sort;
        }
        $goods->is_level_alone = $this->is_level_alone;
        $goods->share_type = $this->share_type;
        $goods->sign = $this->setGoodsSign();
        $goods->mch_id = $this->mch_id;
        $goods->is_default_services = $this->is_default_services;
        $goods->param_name = $this->param_name;
        $goods->param_content = \yii\helpers\BaseJson::encode($this->param_content);
        $goods->limit_buy_status = $this->limit_buy_status;
        $goods->limit_buy_type = $this->limit_buy_type;
        if ($goods->sign == 'miaosha') {
            $this->limit_buy_value = -1;
        }
        $goods->limit_buy_value = $this->limit_buy_value;
        $goods->limit_buy_order = $this->limit_buy_order;
        $goods->min_number = $this->min_number;
        $goodsAuth = $this->getGoodsAuth();
        if ($goodsAuth->is_show_and_buy_auth) {
            $goods->is_setting_show_and_buy_auth = $this->is_setting_show_and_buy_auth;
            $goods->show_goods_auth = $this->show_goods_auth;
            $goods->buy_goods_auth = $this->buy_goods_auth;
        }
        if ($goodsAuth->is_setting_send_type && !in_array($goodsWarehouse->type, ['ecard'])) {
            $goods->is_setting_send_type = $this->is_setting_send_type;
            if (empty($this->send_type)) {
                $this->send_type = ['express'];
            }
            $goods->send_type = implode(',', $this->send_type);
        }
        if ($goodsAuth->is_time) {
            $goods->is_time = $this->is_time;
            if ($this->is_time == 1 && (empty($this->sell_time) || count($this->sell_time) < 2)) {
                throw new \Exception('销售时间不能为空');
            }
            $sellBeginTime = $this->sell_time[0] ?? '0000-00-00 00:00:00';
            if ($sellBeginTime !== $goods->sell_begin_time) {
                $goods->sell_begin_time = $sellBeginTime;
                $goodsAuth->pushRemind($goods);
            }
            $sellEndTime = $this->sell_time[1] ?? '0000-00-00 00:00:00';
            if ($sellEndTime !== $goods->sell_end_time) {
                $goods->sell_end_time = $sellEndTime;
                $goodsAuth->pushDown($goods);
            }
        }
        $res = $goods->save();

        if (!$res) {
            throw new Exception($this->getErrorMsg($goods));
        }

        $this->setExtraGoods($goods);

        $this->goods = $goods;
    }

    protected function getGoodsData($common)
    {
        if ($this->mch_id) {
            $mchId = $this->mch_id;
        } elseif (\Yii::$app->mchId) {
            $mchId = \Yii::$app->mchId;
        } elseif (isset(\Yii::$app->user->identity) && \Yii::$app->user->identity->mch_id > 0) {
            $mchId = \Yii::$app->user->identity->mch_id;
        } else {
            $mchId = 0;
        }

        $goods = Goods::find()->andWhere(['id' => $this->id, 'mch_id' => $mchId, 'is_delete' => 0])->with('goodsWarehouse')->one();

        return $goods;
    }

    /**
     * 商品规格设置
     * @throws Exception
     */
    protected function setAttr()
    {
        if ((int)$this->use_attr === 0) {
            // 未使用规格就添加默认规格
            $this->setDefaultAttr();
            $attrPicList = [];
        } else {
            $this->attr = $this->goods->handleAttr($this->attr);
            // 多规格数据处理
            $this->newAttrs = $this->attr;
            $attrPicList = array_column($this->attrGroups[0]['attr_list'], 'pic_url', 'attr_id');
        }

        $this->handleNewAttr($attrPicList);

        // 用户插件处理规格
        $attrList = GoodsAttr::find()->where(['goods_id' => $this->goods->id, 'is_delete' => 0])->select(['id', 'sign_id'])->all();
        $list = [];
        foreach ($attrList as $attrItem) {
            $list[$attrItem->sign_id] = $attrItem->id;
        }
        $this->attrSignList = $list;

        // 开放自定义处理规格接口
        $this->setExtraAttr();
    }

    protected function handleNewAttr($attrPicList)
    {
        $goodsStock = 0;
        $newList = [];
        $maxNumber = 9999999;
        foreach ($this->newAttrs as $key => $newAttr) {
            if ($newAttr['stock'] > $maxNumber) {
                throw new \Exception('商品规格库存不能大于' . $maxNumber);
            }

            $attrItemData = $this->getAttrItemData($newAttr);

            $goodsStock += $attrItemData['stock'];
            if ($goodsStock > $maxNumber) {
                throw new \Exception('商品总库存不能大于' . $maxNumber);
            }

            // 记录规格ID数组
            $signIds = '';
            foreach ($newAttr['attr_list'] as $aLItem) {
                $signIds .= $signIds ? ':' . (int)$aLItem['attr_id'] : (int)$aLItem['attr_id'];
            }
            $this->newAttrs[$key]['sign_id'] = $signIds;

            $key = strstr($signIds, ':', true) ?: $signIds;
            $newList[$signIds] = array_merge([
                'goods_id' => $this->goods->id,
                'sign_id' => $signIds,
                'pic_url' => $attrPicList[$key] ?? '',
            ], $this->getAttrItem($newAttr));
        }
        $oldGoodsAttr = GoodsAttr::findAll(['goods_id' => $this->goods->id, 'is_delete' => 0]);
        $temp = [];
        foreach ($oldGoodsAttr as $goodsAttr) {
            if (isset($newList[$goodsAttr->sign_id])) {
                $goodsAttr->attributes = $newList[$goodsAttr->sign_id];
                unset($newList[$goodsAttr->sign_id]);
            } else {
                $goodsAttr->is_delete = 1;
            }
            foreach ($goodsAttr->getDirtyAttributes() as $name => $value) {
                $temp[$name][$goodsAttr->id] = $value;
            }
        }
        if (!empty($temp)) {
            $params = [];
            $table = GoodsAttr::tableName();
            $ids = implode(',', array_column($oldGoodsAttr, 'id'));
            $sql = "UPDATE {$table} SET";
            $count = 0;
            foreach ($temp as $key => $item) {
                $sql .=  " `$key` = CASE `id` ";
                foreach ($item as $id => $value) {
                    $tempId = ':' . $key . $count;
                    $params[$tempId] = $value;
                    $count++;
                    $sql .= sprintf(" WHEN %d THEN %s ", $id, $tempId);
                }
                $sql .= " ELSE `$key` END, ";
            }
            $sql = rtrim($sql, ', ');
            $sql .= " WHERE `id` IN ($ids)";
            \Yii::$app->db->createCommand($sql, $params)->execute();
            $newList = array_values($newList);
        }

        \Yii::$app->db->createCommand()->batchInsert(
            GoodsAttr::tableName(),
            ['goods_id', 'sign_id', 'pic_url', 'stock', 'price', 'no', 'weight', 'cost_price', 'bar_code'],
            $newList
        )->execute();

        // 更新商品总库存信息
        $this->goods->goods_stock = $goodsStock;
        $res = $this->goods->save();
        if (!$res) {
            throw new \Exception($this->getErrorMsg($this->goods));
        }
    }

    protected function getAttrItemData($newAttr)
    {
        return [
            'stock' => $newAttr['stock'],
        ];
    }

    protected function getAttrItem($newAttr)
    {
        return [
            'stock' => $newAttr['stock'],
            'price' => $newAttr['price'],
            'no' => $newAttr['no'],
            'weight' => $newAttr['weight'] ?: 0,
            'cost_price' => $newAttr['cost_price'] ?: 0,
            'bar_code' => isset($newAttr['bar_code']) ? $newAttr['bar_code'] : '',
        ];
    }

    /**
     * @throws Exception
     * 添加默认规格
     */
    protected function setDefaultAttr()
    {
        if ($this->select_attr_groups) {
            $attrList = $this->select_attr_groups;
        } else {
            $attrList = [
                [
                    'attr_group_name' => '规格',
                    'attr_group_id' => 1,
                    'attr_id' => 1,
                    'attr_name' => $this->attr_default_name ?: '默认',
                ]
            ];
        }
        $count = 1;
        $attrGroups = [];
        foreach ($attrList as &$item) {
            $item['attr_group_id'] = $count;
            $count++;
            $item['attr_id'] = $count;
            $count++;
            $newItem = [
                'attr_group_id' => $item['attr_group_id'],
                'attr_group_name' => $item['attr_group_name'],
                'attr_list' => [
                    [
                        'attr_id' => $item['attr_id'],
                        'attr_name' => $item['attr_name']
                    ]
                ]
            ];
            $attrGroups[] = $newItem;
        }
        unset($item);

        // 未使用规格 就添加一条默认规格
        $newAttrs = [
            [
                'attr_list' => $attrList,
                'stock' => $this->goods_num,
                'price' => $this->price,
                'no' => $this->goods_no ? $this->goods_no : '',
                'weight' => $this->goods_weight ? $this->goods_weight : 0,
                'pic_url' => '',
                'bar_code' => $this->bar_code ?: '',
                'date' => $this->date ?: [],
                'member_price' => $this->member_price,
                'cost_price' => $this->cost_price ?: 0
            ]
        ];

        $this->goods->attr_groups = \Yii::$app->serializer->encode($attrGroups);
        $res = $this->goods->save();
        if (!$res) {
            throw new Exception($this->getErrorMsg($this->goods));
        }

        $this->newAttrs = $newAttrs;
    }

    /**
     * @throws Exception
     * 设置卡券数据
     */
    protected function setCard()
    {
        GoodsCardRelation::deleteAll(['goods_id' => $this->goods->id]);
        if ($this->cards && is_array($this->cards) && \Yii::$app->getMchId() == 0) {
            $newList = [];
            foreach ($this->cards as $item) {
                $newList[] = [
                    'num' => $item['num'],
                    'goods_id' => $this->goods->id,
                    'card_id' => $item['id'],
                ];
            }

            \Yii::$app->db->createCommand()->batchInsert(
                GoodsCardRelation::tableName(),
                ['num', 'goods_id', 'card_id'],
                $newList
            )->execute();
        }
    }

    /**
     * @throws Exception
     * 设置优惠券数据
     */
    protected function setCoupon()
    {
        GoodsCouponRelation::deleteAll(['goods_id' => $this->goods->id]);

        if ($this->coupons && is_array($this->coupons) && \Yii::$app->getMchId() == 0) {
            $newList = [];
            foreach ($this->coupons as $item) {
                $newList[] = [
                    'coupon_id' => $item['id'],
                    'goods_id' => $this->goods->id,
                    'num' => $item['num']
                ];
            }

            \Yii::$app->db->createCommand()->batchInsert(
                GoodsCouponRelation::tableName(),
                ['coupon_id', 'goods_id', 'num'],
                $newList
            )->execute();
        }
    }

    /**
     * @throws Exception
     * 设置商品服务
     */
    protected function setGoodsService()
    {
        GoodsServiceRelation::deleteAll(['goods_id' => $this->goods->id]);

        if ($this->services && is_array($this->services)) {
            $newList = [];
            foreach ($this->services as $item) {
                $newList[] = [
                    'service_id' => $item['id'],
                    'goods_id' => $this->goods->id,
                ];
            }

            \Yii::$app->db->createCommand()->batchInsert(
                GoodsServiceRelation::tableName(),
                ['service_id', 'goods_id'],
                $newList
            )->execute();
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
        GoodsShare::deleteAll(['goods_id' => $this->goods->id]);
        $newList = [];
        // 是否开启单独分销设置
        if ($this->individual_share == 1) {
            // 普通设置
            if ($this->attr_setting_type == 0) {
                $this->checkMchSharePrice($this->shareLevelList, $this->price, $this->share_type);
                // 默认分销价的商品规格ID为 0
                foreach ($this->shareLevelList as $item) {
                    $newList[] = [
                        'goods_id' => $this->goods->id,
                        'goods_attr_id' => 0,
                        'level' => $item['level'],
                        'share_commission_first' => $item['share_commission_first'] ?: 0,
                        'share_commission_second' => $item['share_commission_second'] ?: 0,
                        'share_commission_third' => $item['share_commission_third'] ?: 0,
                    ];
                }
            } elseif ($this->attr_setting_type == 1) {
                if ($this->use_attr == 1) {
                    // 详细设置 
                    foreach ($this->newAttrs as $attrItem) {
                        $this->checkMchSharePrice($attrItem['shareLevelList'], $attrItem['price'], $this->share_type);
                        foreach ($attrItem['shareLevelList'] as $item) {
                            $newList[] = [
                                'goods_id' => $this->goods->id,
                                'goods_attr_id' => $this->attrSignList[$attrItem['sign_id']],
                                'level' => $item['level'],
                                'share_commission_first' => $item['share_commission_first'] ?: 0,
                                'share_commission_second' => $item['share_commission_second'] ?: 0,
                                'share_commission_third' => $item['share_commission_third'] ?: 0,
                            ];
                        }
                    }
                }
            }
        }

        \Yii::$app->db->createCommand()->batchInsert(
            GoodsShare::tableName(),
            ['goods_id', 'goods_attr_id', 'level', 'share_commission_first', 'share_commission_second', 'share_commission_third'],
            $newList
        )->execute();
    }

    /**
     * @param integer $goodsAttrId 商品规格
     * @param integer $level 会员等级
     * @param int $price
     * @throws Exception
     */
    protected function setGoodsMemberPrice()
    {
        GoodsMemberPrice::deleteAll(['goods_id' => $this->goods->id]);
        $newList = [];
        foreach ($this->newAttrs as $attrItem) {
            if (isset($attrItem['member_price']) && is_array($attrItem['member_price'])) {
                foreach ($attrItem['member_price'] as $key => $memberPrice) {
                    try {
                        $memberLevel = (int)substr($key, 5);
                        $newList[] = [
                            'goods_id' => $this->goods->id,
                            'goods_attr_id' => $this->attrSignList[$attrItem['sign_id']],
                            'level' => $memberLevel,
                            'price' => $memberPrice ?: 0
                        ]; 
                    }catch(\Exception $exception) {
                        \Yii::error($exception);
                    }
                }
            }
        }

        \Yii::$app->db->createCommand()->batchInsert(
            GoodsMemberPrice::tableName(),
            ['goods_id', 'goods_attr_id', 'level', 'price'],
            $newList
        )->execute();
    }

    /**
     * 多商户商品分销价 总和不能大于商品销售价 + 商城提成
     * @param array $shareLevelList
     * @param $goodsPrice
     * @param $shareType
     * @throws \Exception
     */
    private function checkMchSharePrice($shareLevelList, $goodsPrice, $shareType)
    {
        if (\Yii::$app->mchId) {
            if (empty($shareLevelList)) {
                return;
            }
            $first = max(0, max(array_column($shareLevelList, 'share_commission_first')));
            $second = max(0, max(array_column($shareLevelList, 'share_commission_second')));
            $third = max(0, max(array_column($shareLevelList, 'share_commission_third')));
            // 商城提成
            $deductMoney = $goodsPrice * ($this->mch->transfer_rate / 1000);
            // 分销佣金类型。0.固定 | 1.百分比
            if ($shareType == 1) {
                $newFirst = $goodsPrice * ($first / 100);
                $newSecond = $goodsPrice * ($second / 100);
                $newThird = $goodsPrice * ($third / 100);
                $shareMoney = $newFirst + $newSecond + $newThird;
            } else {
                // 分销总金额
                $shareMoney = $first + $second + $third;
            }
            $moneyCount = price_format($deductMoney + $shareMoney);

            if ($moneyCount > $goodsPrice) {
                throw new \Exception('分销佣金不能大于商品金额');
            }
        }
    }

    protected function setExtraAttr()
    {
        return true;
    }

    protected function setExtraGoods($goods)
    {
        return true;
    }

    protected function checkExtra($goodsAttr)
    {
        return true;
    }

    private function setMch()
    {
        if (!$this->mch_id) {
            if (\Yii::$app->mchId) {
                $this->mch_id = \Yii::$app->mchId;
            }
            if (isset(\Yii::$app->user->identity) && \Yii::$app->user->identity->mch_id > 0) {
                $this->mch_id = \Yii::$app->user->identity->mch_id;
            }
        }

        if ($this->mch_id) {
            $this->mch = Mch::findOne($this->mch_id);
        } else {
            $this->mch_id = 0;
        }
    }

    /**
     * 触发商品编辑事件
     * @param bool $isVipCardGoods
     * @param bool $diffAttrIds
     */
    protected function setListener($isVipCardGoods = true, $diffAttrIds = true)
    {
        $event['goods'] = $this->goods;
        $diffAttrIds && $event['diffAttrIds'] = $this->diffAttrIds;
        $isVipCardGoods && $event['isVipCardGoods'] = $this->is_vip_card_goods;
        \Yii::$app->trigger(Goods::EVENT_EDIT, new GoodsEvent($event));
    }

    protected function getGoodsAuth()
    {
        return GoodsAuth::create($this->setGoodsSign());
    }
}
