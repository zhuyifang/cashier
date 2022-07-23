<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/4
 * Time: 5:26 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\customer_service\controllers\mall;

use app\plugins\Controller;
use app\plugins\customer_service\forms\mall\CustomerForm;
use app\plugins\customer_service\forms\mall\EditForm;
use app\plugins\customer_service\forms\mall\ListForm;
use yii\helpers\Json;

class IndexController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new EditForm();
                $form->attributes = \Yii::$app->request->post();
                return $this->asJson($form->save());
            } else {
                $form = new ListForm();
                $form->attributes = \Yii::$app->request->get();
                $form->attributes = Json::decode(\Yii::$app->request->get('search'), true);
                return $this->asJson($form->getList());
            }
        } else {
            return $this->render('index');
        }
    }

    public function actionDestroy()
    {
        $form = new EditForm();
        return $this->asJson($form->destroy());
    }

    public function actionCustomer()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new CustomerForm();
                $form->attributes = \Yii::$app->request->post();
                return $this->asJson($form->save());
            } else {
                $form = new ListForm();
                $form->attributes = \Yii::$app->request->get();
                $form->attributes = Json::decode(\Yii::$app->request->get('search'), true);
                return $this->asJson($form->getCustomer());
            }
        } else {
            return $this->render('customer');
        }
    }

    public function actionCustomerDestroy()
    {
        $form = new CustomerForm();
        return $this->asJson($form->destroy());
    }

    public function actionDetail()
    {
        $form = new EditForm();
        return $this->asJson($form->getDetail());
    }
}
