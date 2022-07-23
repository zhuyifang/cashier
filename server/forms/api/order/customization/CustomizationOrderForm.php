<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\api\order\customization;

use app\core\response\ApiCode;
use app\forms\common\diy\ValueValidateForm;
use app\models\Goods;
use app\models\Model;

class CustomizationOrderForm extends Model
{
    public $goods_id;
    public $mch_id;
    public $form_data;

    public function rules()
    {
        return [
            [['form_data', 'goods_id'], 'required'],
            [['goods_id', 'mch_id'], 'integer'],
            [['form_data'], 'safe']
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $goods = Goods::find()->where([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => $this->mch_id ?: 0,
                'id' => $this->goods_id,
                'is_delete' => 0
            ])
                ->with('formGoods')
                ->one();

            if (!$goods) {
                throw new \Exception('商品不存在');
            }

            if (!$goods->formGoods) {
                throw new \Exception('定制数据不存在');
            }

            if ($goods->formGoods->customization_status == 0) {
                throw new \Exception('商品未开启规格化设置');
            }

            // 校验表单
            $validate = new ValueValidateForm();
            $formData = json_decode($this->form_data, true);
            if (!is_array($formData)) {
                throw new \Exception('form_data数据异常');
            }

            foreach ($formData as  $datum) {
                $method = 'check' . hump($datum['key'], '-');
                if (method_exists($validate, $method)) {
                    $validate->$method($datum);
                }
            }

            $key = 'GOODS_FORM_' . \Yii::$app->user->id;
            \Yii::$app->redis->set($key, json_encode(['form_data' => $formData]));
            \Yii::$app->redis->expire($key, 60 * 60);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [],
            ];
        } catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
            ];
        }
    }
}
