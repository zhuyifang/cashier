<?php
/**
 * @copyright ©2019 浙江禾匠信息科技
 * Created by PhpStorm.
 * User: Andy - Wangjie
 * Date: 2019/5/30
 * Time: 9:11
 */

namespace app\controllers\api\master;

use app\controllers\Controller;
use app\controllers\api\filters\LoginFilter;
use app\core\cloud\CloudException;
use app\core\exceptions\ClassNotFoundException;
use app\core\response\ApiCode;
use app\models\Mall;
use app\models\User;
use app\models\UserIdentity;
use app\models\We7App;
use yii\web\NotFoundHttpException;

/**
 * 小程序管理后台基类
 * Class AdminController
 * @package app\controllers\api\admin
 */
class MasterController extends Controller
{
    /**
     * @var mixed
     */
    public $mall_id;
    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginFilter::class,
            ],
        ]);
    }

    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;
        $this->setMall()->autoLogin();
    }

    public function beforeAction($action)
    {
        if (\Yii::$app->requestedRoute === 'api/master/passport/login') {
            return true;
        }
        $user_id = \Yii::$app->user->id;
        if (empty($user_id)) {
            throw new NotFoundHttpException('非法操作');
        }

        try {
            \Yii::$app->plugin->getPlugin('app_admin');
        } catch (ClassNotFoundException | CloudException $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }

        $identity = UserIdentity::find()->where([
            'user_id' => $user_id,
            'is_admin' => 1,
            'is_delete' => 0
        ])->one();
        if (empty($identity)) {
            throw new NotFoundHttpException('该帐号无管理员权限');
        }

        $permission = \Yii::$app->role->permission;

        if (!in_array('app_admin', $permission)) {
            throw new NotFoundHttpException('该帐号无此插件权限');
        }

        return true;

    }

    public function setMall()
    {
        $acid = \Yii::$app->request->get('_acid');
        if ($acid && $acid > 0) {
            $we7app = We7App::findOne([
                'acid' => $acid,
                'is_delete' => 0,
            ]);
            $mallId = $we7app ? $we7app->mall_id : null;
        } else {
            $mallId = \Yii::$app->request->get('_mall_id');
        }
        if ($mallId) {
            $mall = Mall::findOne([
                'id' => $mallId,
                'is_delete' => 0,
                'is_recycle' => 0,
            ]);


            \Yii::$app->setMall($mall);
            \Yii::$app->setMallId($mall->id);
            $this->mall = \Yii::$app->mall;
        }
        return $this;
    }

    private function autoLogin()
    {
        $headers = \Yii::$app->request->headers;
        $accessToken = empty($headers['x-access-token']) ? null : $headers['x-access-token'];


        if (!$accessToken) {
            \Yii::$app->user->logout();
            return $this;
        }
        $user = User::findOne([
            'access_token' => $accessToken,
            'is_delete' => 0,
        ]);
        if ($user) {
            \Yii::$app->user->login($user);
        } else {
            \Yii::$app->user->logout();
        }
        return $this;
    }
}
