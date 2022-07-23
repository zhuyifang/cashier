<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/14
 * Time: 10:33 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\controllers\api;

use app\controllers\api\filters\LoginFilter;
use app\plugins\weekly_buy\forms\api\DelayForm;
use app\plugins\weekly_buy\forms\api\ExpressDetailForm;
use app\plugins\weekly_buy\forms\api\OrderConfirmForm;
use app\plugins\weekly_buy\forms\api\OrderSubmitForm;

class OrderController extends ApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginFilter::class
            ],
        ]);
    }

    public function actionPreview()
    {
        $form = new OrderSubmitForm();
        $form->form_data = \Yii::$app->serializer->decode(\Yii::$app->request->post('form_data'));
        return $this->asJson($form->setPluginData()->preview());
    }

    public function actionSubmit()
    {
        $form = new OrderSubmitForm();
        $form->form_data = \Yii::$app->serializer->decode(\Yii::$app->request->post('form_data'));
        return $this->asJson($form->setPluginData()->submit());
    }

    public function actionDelay()
    {
        $form = new DelayForm();
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
