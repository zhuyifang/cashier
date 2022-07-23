<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/22
 * Time: 2:08 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\controllers\mall;

use app\plugins\Controller;
use app\plugins\weekly_buy\forms\api\OrderConfirmForm;
use app\plugins\weekly_buy\forms\mall\DelayForm;
use app\plugins\weekly_buy\forms\mall\OrderContentForm;
use app\plugins\weekly_buy\forms\mall\OrderDetailForm;
use app\plugins\weekly_buy\forms\mall\OrderStopForm;

class OrderController extends Controller
{
    public function actionConfirm()
    {
        $form = new OrderConfirmForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->confirm());
    }

    public function actionDetail()
    {
        $form = new OrderDetailForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->detail());
    }

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

    public function actionContent()
    {
        $form = new OrderContentForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->execute());
    }
}
