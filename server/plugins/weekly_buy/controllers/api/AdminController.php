<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/27
 * Time: 3:30 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\controllers\api;

use app\plugins\weekly_buy\forms\api\ExpressDetailForm;
use app\plugins\weekly_buy\forms\api\OrderConfirmForm;
use app\plugins\weekly_buy\forms\mall\DelayForm;
use app\plugins\weekly_buy\forms\mall\OrderStopForm;

class AdminController extends \app\controllers\api\admin\AdminController
{
    public function actionDelay()
    {
        $form = new DelayForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->execute());
    }

    public function actionStop()
    {
        $form = new OrderStopForm();
        $form->attributes = \Yii::$app->request->post();

        return $this->asJson($form->execute());
    }

    public function actionExpressDetail()
    {
        $form = new ExpressDetailForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->execute());
    }

    public function actionConfirm()
    {
        $form = new OrderConfirmForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->confirm());
    }
}
