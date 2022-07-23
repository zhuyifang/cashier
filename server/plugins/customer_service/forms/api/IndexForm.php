<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/10
 * Time: 11:49 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\customer_service\forms\api;

use app\plugins\customer_service\forms\Model;
use app\plugins\customer_service\models\CustomerServiceRole;

class IndexForm extends Model
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'integer']
        ];
    }

    public function getUrl()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            /** @var CustomerServiceRole $detail */
            $detail = CustomerServiceRole::find()->with('qy')
                ->where(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'id' => $this->id])
                ->one();
            if (!$detail) {
                throw new \Exception('客服已被删除');
            }
            return $this->success([
                'url' => $detail->url,
                'enterprise_id' => $detail->qy->enterprise_id,
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
