<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/7
 * Time: 3:44 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\customer_service\forms\mall;

use app\plugins\customer_service\forms\Model;
use app\plugins\customer_service\models\CustomerServiceRole;

class CustomerForm extends Model
{
    public $qy_id;
    public $name;
    public $url;
    public $id;

    public function rules()
    {
        return [
            [['qy_id', 'id'], 'integer'],
            [['qy_id', 'name', 'url'], 'required'],
            [['name', 'url'], 'trim'],
            [['name', 'url'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '客服名称',
            'url' => '客服链接',
            'qy_id' => '所属企业'
        ];
    }

    public function save()
    {
        try {
            if (!$this->validate()) {
                throw new \Exception($this->getErrorMsg());
            }
            $model = CustomerServiceRole::findOne([
                'id' => $this->id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0
            ]);
            if (!$model) {
                $model = new CustomerServiceRole();
                $model->mall_id = \Yii::$app->mall->id;
                $model->is_delete = 0;
            }
            $model->qy_id = $this->qy_id;
            $model->name = $this->name;
            $model->url = $this->url;
            if (!$model->save()) {
                throw new \Exception($this->getErrorMsg($model));
            }
            return $this->success([
                'msg' => '保存成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function destroy()
    {
        try {
            $id = \Yii::$app->request->get('id');
            $model = CustomerServiceRole::findOne(['id' => $id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0]);
            if (!$model) {
                throw new \Exception('客服不存在或已被删除');
            }
            $model->is_delete = 1;
            if (!$model->save()) {
                throw new \Exception($this->getErrorMsg($model));
            }
            return $this->success([
                'msg' => '删除成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
