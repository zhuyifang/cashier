<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/21
 * Time: 10:35
 */

namespace app\forms\api;


use app\core\response\ApiCode;
use app\forms\common\diy\CommonPageTwo;
use app\forms\common\goods\CommonGoods;
use app\forms\common\goods\CommonGoodsDetail;
use app\forms\common\goods\GoodsAuth;
use app\forms\common\goods\LimitBuy;
use app\models\CityDeliverySetting;
use app\models\FormGoods;
use app\models\Goods;
use app\models\Mall;
use app\models\Model;
use app\models\User;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * @property Mall $mall;
 * @property User $user;
 */
class GoodsForm extends Model
{
    public $id;
    public $mall;
    public $user;
    public $plugin;
    public $goods_num;

    public function rules()
    {
        return [
            [['id', 'goods_num'], 'integer'],
            [['plugin'], 'trim'],
            [['plugin'], 'string'],
            [['plugin'], 'default', 'value' => 'mall'],
        ];
    }

    /**
     * @param $goods
     * @return array|null
     */
    public function shareQuick($goods, $sales)
    {
        $plugin = 'quick_share';
        if (\Yii::$app->plugin->getInstalledPlugin($plugin)) {
            return \app\plugins\quick_share\forms\common\CommonQuickShare::getExtraInfo($goods, $sales);
        } else {
            return null;
        }
    }

    private function setLog(Goods $goods)
    {
        $goods->detail_count += 1;
        $goods->save();
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $form = new CommonGoodsDetail();
            $form->user = \Yii::$app->user->identity;
            $form->mall = \Yii::$app->mall;
            $form->setIsLimitBuy($this->plugin == 'mall');
            $goods = $form->getGoods($this->id);
            if (!$goods) {
                throw new Exception('商品不存在');
            }
            if ($this->plugin == 'mall' && !GoodsAuth::create($goods->sign)->checkShowAuth($goods)) {
                throw new \Exception('您暂无权限查看商品');
            }

            $form->goods = $goods;
            $mallGoods = CommonGoods::getCommon()->getMallGoods($goods->id);
            $form->setMember($mallGoods->is_negotiable == 0);
            $form->setShare($mallGoods->is_negotiable == 0);
            $cats = array_column(ArrayHelper::toArray($goods->goodsWarehouse->cats), 'id');
            $cats = array_map(function ($v) {
                return (string)$v;
            }, $cats);
            $res = $form->getAll();
            $res = array_merge($res, [
                'extra_quick_share' => $this->shareQuick($goods, $res['sales']),
                'is_quick_shop' => $mallGoods->is_quick_shop,
                'is_sell_well' => $mallGoods->is_sell_well,
                'is_negotiable' => $mallGoods->is_negotiable,
                //商品分类
                'cats' => $cats
            ]);
            //图片替换
            $temp = [];
            foreach ($res['attr'] as $v) {
                foreach ($v['attr_list'] as $w) {
                    if (!isset($temp[$w['attr_id']])) {
                        $temp[$w['attr_id']] = $v['pic_url'];
                    }
                }
            }

            foreach ($res['attr_groups'] as $k => $v) {
                foreach ($v['attr_list'] as $l => $w) {
                    $res['attr_groups'][$k]['attr_list'][$l]['pic_url'] = $temp[$w['attr_id']] ?: "";
                }
            }

            $model = CityDeliverySetting::findOne(['key' => 'address', 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id]);
            $this->setLog($goods);
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => 'success',
                'data' => [
                    'goods' => $res,
                    'delivery' => !empty($model) ? $model->value : ''
                ]
            ];
        } catch (\Exception $e) {
            \Yii::error($e);
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'errors' => $e->getLine()
            ];
        }
    }

    public function getFormData()
    {
        try {
            $formGoods = FormGoods::find()->andWhere(['goods_id' => $this->id])->with('goods')->one();
            if (!$formGoods) {
                throw new \Exception('商品定制数据不存在');
            }

            if (!$formGoods->customization_status) {
                throw new \Exception('商品未开启定制');
            }

            $customizationData = json_decode($formGoods->customization_data, true);
            $commonPageTwo = CommonPageTwo::getCommon(\Yii::$app->mall);
            $formData = $commonPageTwo->getPage(null, null, json_encode($customizationData['form_data']));
            $customizationData['form_data'] = $formData;

            if (!$this->goods_num) {
                throw new \Exception('请传参数goods_num');
            }

            $goods = $formGoods->goods;
            $limitBuyClass = LimitBuy::create($goods->sign, ['user_id' => \Yii::$app->user->id]);
            $limitBuyClass->goods = $goods;
            if (!$limitBuyClass->checkLimitBuy($this->goods_num) || !$limitBuyClass->checkMinNumber($this->goods_num)) {
                throw new \Exception($limitBuyClass->errorMsg);
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'customization_data' => $customizationData
                ]
            ];
        } catch(\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }
}
