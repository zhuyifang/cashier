<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/3/25
 * Time: 3:23 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\mall;

use app\models\Model;
use app\plugins\diy\models\DiyFormList;
use yii\helpers\Json;

class FormCreate extends Model
{
    public $name;
    public $status;
    public $limit;
    public $tip;
    public $id;
    public $is_share;
    public $time_status;
    public $time_at;

    public function rules()
    {
        return [
            [['name', 'tip', 'time_status'], 'required'],
            [['name', 'tip'], 'trim'],
            [['name', 'tip', 'time_at'], 'string'],
            [['status', 'limit', 'id', 'is_share'], 'integer'],
            [['status'], 'in', 'range' => [0, 1, 2, 3, 4]],
            [['is_share'], 'in', 'range' => [-1, 0, 1]],
            [['tip'], 'string', 'max' => 32],
            [['limit'], 'integer', 'min' => 1]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '表单名称',
            'status' => '提交周期',
            'limit' => '总可提交次数',
            'tip' => '超出提示',
            'time_status' => '活动定时结束',
            'time_at' => '活动结束时间'
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $model = DiyFormList::findOne([
                'mall_id' => \Yii::$app->mall->id,
                'id' => $this->id,
                'is_delete' => 0
            ]);
            if (!$model) {
                $model = new DiyFormList();
                $model->mall_id = \Yii::$app->mall->id;
                $model->is_delete = 0;
                $model->form_data = Json::encode([], JSON_UNESCAPED_UNICODE);
            }
            $model->name = $this->name;
            $model->status = $this->status;
            $model->tip = $this->tip;
            $model->limit = $this->limit;
            $model->time_status = $this->time_status;
            $model->time_at = $this->time_at;
            if ($this->is_share != -1) {
                $model->is_share = $this->is_share;
            }
            if (!$model->save()) {
                throw new \Exception($this->getErrorMsg($model));
            }
            return $this->success([
                'msg' => '操作成功',
                'id' => $model->id
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    private function checkData()
    {
        if ($this->time_status && !$this->time_at) {
            throw new \Exception('需设置表单结束时间');
        }
    }
}
