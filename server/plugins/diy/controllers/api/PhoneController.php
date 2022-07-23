<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/22
 * Time: 3:06 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\controllers\api;

use app\controllers\api\ApiController;
use app\plugins\diy\forms\api\form\PhoneCaptchaForm;

class PhoneController extends ApiController
{

    public function actionSendCaptcha()
    {
        $form = new PhoneCaptchaForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->sendSmsCaptcha());
    }
}
