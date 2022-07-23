<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/6
 * Time: 3:46 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\customer_service\forms\mall;

use app\plugins\customer_service\forms\Model;
use app\plugins\customer_service\models\CustomerServiceQy;
use app\plugins\customer_service\models\CustomerServiceRole;

class ListForm extends Model
{
    public $page;
    public $keyword;
    public $qy_id;
    public $is_all;

    public function rules()
    {
        return [
            [['page', 'qy_id', 'is_all'], 'integer'],
            [['page'], 'default', 'value' => 1],
            [['keyword'], 'trim'],
            [['keyword'], 'string'],
            [['qy_id', 'is_all'], 'default', 'value' => 0]
        ];
    }

    public function getList()
    {
        try {
            if (!$this->validate()) {
                throw new \Exception($this->getErrorMsg());
            }
            $pagination = null;
            /** @var CustomerServiceQy[] $list */
            $query = CustomerServiceQy::find()->where(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0])
                ->keyword($this->keyword, [
                    'or',
                    ['like', 'enterprise_id', $this->keyword],
                    ['like', 'name', $this->keyword],
                ]);
            if (!$this->is_all) {
                $query->page($pagination);
            }
            $list = $query->all();
            $newList = [];
            foreach ($list as $qy) {
                $newList[] = [
                    'id' => $qy->id,
                    'name' => $qy->name,
                    'enterprise_id' => $qy->enterprise_id,
                ];
            }
            return $this->success([
                'list' => $newList,
                'pagination' => $pagination
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function getCustomer()
    {
        try {
            if (!$this->validate()) {
                throw new \Exception($this->getErrorMsg());
            }
            /** @var CustomerServiceRole[] $list */
            $list = CustomerServiceRole::find()->with('qy')
                ->where(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0])
                ->keyword($this->qy_id, ['qy_id' => $this->qy_id])
                ->keyword($this->keyword, [
                    'or',
                    ['like', 'name', $this->keyword],
                    ['qy_id' => CustomerServiceQy::find()
                        ->andWhere(['mall_id' => \Yii::$app->mall->id, 'is_delete' => 0])
                        ->andWhere(['like', 'name', $this->keyword])->select('id')]
                ])
                ->page($pagination)->all();
            $newList = [];
            foreach ($list as $role) {
                $newList[] = [
                    'id' => $role->id,
                    'name' => $role->name,
                    'url' => $role->url,
                    'qy_name' => $role->qy->name,
                    'qy_id' => $role->qy->id,
                    'enterprise_id' => $role->qy->enterprise_id
                ];
            }
            return $this->success([
                'list' => $newList,
                'pagination' => $pagination
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
