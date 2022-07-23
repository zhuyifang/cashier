<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/15 11:57
 */


namespace app\forms\admin\mall;


use app\core\response\ApiCode;
use app\forms\common\CommonUser;
use app\models\Mall;
use app\models\Model;
use app\models\User;

class MallCreateForm extends Model
{
    public $id;
    public $name;
    public $expired_at;
    public $is_check_expired;

    public function rules()
    {
        return [
            [['name'], 'trim'],
            [['name', 'expired_at', 'is_check_expired'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['id'], 'integer'],
            [['is_check_expired'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '商城名称',
            'expired_at' => '商城有效期'
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse($this);
        }
        try {
            $adminInfo = CommonUser::getAdminInfo();
            if ($this->id) {
                $model = Mall::findOne($this->id);
            } else {
                $count = Mall::find()->where([
                    'user_id' => \Yii::$app->user->id,
                    'is_delete' => 0,
                ])->count();
                if ($adminInfo->app_max_count >= 0 && $count >= $adminInfo->app_max_count) {
                    throw new \Exception('超出创建小程序最大数量');
                }
                
                $model = new Mall();
                $model->user_id = \Yii::$app->user->id;
            }
            
            if ($adminInfo->expired_at != '0000-00-00 00:00:00' && strtotime($this->expired_at) > strtotime($adminInfo->expired_at)) {
                throw new \Exception('商城有效期不能超过' . $adminInfo->expired_at);
            }

            $model->name = $this->name;
            $model->expired_at = $this->is_check_expired == 'true' ? '0000-00-00 00:00:00' : $this->expired_at;
            if (!$model->save()) {
                return $this->getErrorResponse($model);
            }
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功。',
                'data' => $model,
            ];
        } catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
            ];
        }
    }
}
