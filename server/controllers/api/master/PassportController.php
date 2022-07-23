<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/13 14:13
 */


namespace app\controllers\api\master;


use app\forms\admin\passport\PassportForm;
use app\forms\api\LoginForm;

class PassportController extends MasterController
{


    /**
     * @return array
     */
    public function actionLogin(): array
    {
        $form = new PassportForm();
        $form->attributes = \Yii::$app->request->post('form');
        $form->user_type = 1;
        return $form->login();
    }

    /**
     * @return LoginForm
     * @throws \Exception
     */
    private function getLoginForm()
    {
        $appPlatform = \Yii::$app->appPlatform;
        $Class = null;
        if ($appPlatform === APP_PLATFORM_WXAPP) {
            $Class = 'app\\plugins\\wxapp\\models\\LoginForm';
        }
        if ($appPlatform === APP_PLATFORM_ALIAPP) {
            $Class = 'app\\plugins\\aliapp\\models\\LoginForm';
        }
        if ($appPlatform === APP_PLATFORM_BDAPP) {
            $Class = 'app\\plugins\\bdapp\\models\\LoginForm';
        }
        if ($appPlatform === APP_PLATFORM_TTAPP) {
            $Class = 'app\\plugins\\ttapp\\models\\LoginForm';
        }
        if ($appPlatform === APP_PLATFORM_MOBILE) {
            $Class = 'app\\plugins\\mobile\\models\\LoginForm';
        }
        if ($appPlatform === APP_PLATFORM_WECHAT) {
            $Class = 'app\\plugins\\wechat\\models\\LoginForm';
        }
        if (!$Class || !class_exists($Class)) {
            throw new \Exception('未安装相关平台的插件或未知的客户端平台，平台标识`' . ($appPlatform ? $appPlatform : 'null') . '`');
        }
        return new $Class();
    }
}
