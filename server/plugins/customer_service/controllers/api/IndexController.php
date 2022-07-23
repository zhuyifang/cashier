<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/10
 * Time: 11:46 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\customer_service\controllers\api;

use app\controllers\api\ApiController;
use app\plugins\customer_service\forms\api\IndexForm;

class IndexController extends ApiController
{
    public function actionUrl()
    {
        $form = new IndexForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getUrl());
    }
}
