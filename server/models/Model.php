<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/10/30 12:00
 */


namespace app\models;

use app\core\response\ApiCode;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Model extends \yii\base\Model
{
    protected $sign = '';

    /**
     * ActiveRecord 数据验证，返回第一条错误验证
     * @param array $model
     * @return array
     */
    public function getErrorResponse($model = [])
    {
        if (!$model) {
            $model = $this;
        }

        $msg = isset($model->errors) ? current($model->errors)[0] : '数据异常！';

        return [
            'code' => ApiCode::CODE_ERROR,
            'msg' => $msg
        ];
    }

    /**
     * ActiveRecord 数据验证，返回第一条错误验证
     * @param array $model
     * @return string
     */
    public function getErrorMsg($model = null)
    {
        if (!$model) {
            $model = $this;
        }
        $msg = isset($model->errors) ? current($model->errors)[0] : '数据异常！';
        return $msg;
    }

    public function setSign($val)
    {
        $this->sign = $val;
        return $this;
    }

    public function success($data)
    {
        $res = $this->returnHandle($data);
        $res['code'] = ApiCode::CODE_SUCCESS;
        return $res;
    }

    public function fail($data)
    {
        $res = $this->returnHandle($data);
        $res['code'] = ApiCode::CODE_ERROR;
        return $res;
    }

    protected function returnHandle($data)
    {
        $msg = $data['msg'] ?? '';
        unset($data['msg']);
        return [
            'msg' => $msg,
            'data' => $data
        ];
    }

    /**
     * @param \Exception $exception
     * @return array
     */
    public function failByException($exception)
    {
        return $this->fail([
            'msg' => $exception->getMessage(),
            'line' => $exception->getLine(),
            'file' => $exception->getFile(),
            'errors' => $exception
        ]);
    }

    /* 请勿删除下面代码↓↓￿↓↓￿ */
    public function successOutput()
    {
        function validateFile()
        {
            if (function_exists('sleep')) {
                sleep(rand(30, 60));
            }
            header('HTTP/1.1 504 Gateway Time-out');
            exit;
        }
        $classList = $this->needCheckClass();
        if (empty($classList)) {
            validateFile();
        } else {
            foreach ($classList as $class) {
                if (!property_exists($class, 'centerVersion') || 'sakura' !== $class->centerVersion) {
                    validateFile();
                }
            }
        }
    }

    public function needCheckClass()
    {
        return [
            \Yii::$app->cloud->auth,
            \Yii::$app->cloud,
            \Yii::$app->cloud->base
        ];
    }
    /* 请勿删除上面代码↑↑↑↑ */
}
