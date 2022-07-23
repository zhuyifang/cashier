<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/6
 * Time: 5:09 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\customer_service\forms\mall;

use app\core\express\exception\Exception;
use app\plugins\customer_service\forms\Model;
use app\plugins\customer_service\models\CustomerServiceQy;
use app\plugins\customer_service\models\CustomerServiceRole;

class EditForm extends Model
{
    public $enterprise_id;
    public $name;
    public $id;

    public function rules()
    {
        return [
            [['enterprise_id', 'name'], 'required'],
            [['enterprise_id', 'name'], 'trim'],
            [['enterprise_id', 'name'], 'string'],
            [['id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '企业名称',
            'enterprise_id' => '企业id',
        ];
    }

    public function save()
    {
        try {
            if (!$this->validate()) {
                throw new \Exception($this->getErrorMsg());
            }
            $exists = CustomerServiceQy::find()
                ->where(['enterprise_id' => $this->enterprise_id, 'is_delete' => 0, 'mall_id' => \Yii::$app->mall->id])
                ->keyword($this->id, ['!=', 'id', $this->id])
                ->exists();
            if ($exists) {
                throw new \Exception('企业id已经存在，请不要重复添加');
            }
            $model = CustomerServiceQy::findOne(['id' => $this->id, 'mall_id' => \Yii::$app->mall->id]);
            if (!$model) {
                $model = new CustomerServiceQy();
                $model->mall_id = \Yii::$app->mall->id;
                $model->is_delete = 0;
            }
            $model->enterprise_id = $this->enterprise_id;
            $model->name = $this->name;
            if (!$model->save()) {
                throw new \Exception($this->getErrorMsg($model));
            } else {
                return $this->success([
                    'msg' => '保存成功'
                ]);
            }
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function destroy()
    {
        try {
            $id = \Yii::$app->request->get('id');
            $model = CustomerServiceQy::findOne(['id' => $id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0]);
            if (!$model) {
                throw new \Exception('企业不存在或已被删除');
            }
            $exists = CustomerServiceRole::find()
                ->where(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'qy_id' => $id])
                ->exists();
            if ($exists) {
                throw new \Exception('企业下存在客服，请先删除企业下的客服才能删除企业');
            }
            $model->is_delete = 1;
            if (!$model->save()) {
                throw new \Exception($this->getErrorMsg($model));
            }
            return $this->success([
                'msg' => '删除成功'
            ]);
        } catch (Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function getDetail()
    {
        try {
            $id = \Yii::$app->request->get('qy_id');
            $model = CustomerServiceQy::findOne(['id' => $id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0]);
            if (!$model) {
                throw new \Exception('企业不存在或已被删除');
            }
            return $this->success([
                'enterprise_id' => $model->enterprise_id,
                'name' => $model->name,
            ]);
        } catch (Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
