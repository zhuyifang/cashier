<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\form_goods\controllers\mall;


use app\plugins\Controller;
use app\plugins\form_goods\forms\mall\TemplateEditForm;
use app\plugins\form_goods\forms\mall\TemplateForm;


class IndexController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $form = new TemplateForm();
            $form->attributes = \Yii::$app->request->get();
            return $this->asJson($form->getList());
        } else {
            return $this->render('index');
        }
    }

    public function actionEdit()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new TemplateEditForm();
                $form->attributes = \Yii::$app->request->post();
                return $this->asJson($form->save());
            } else {
                $form = new TemplateForm();
                $form->attributes = \Yii::$app->request->get();
                return $this->asJson($form->getDetail());
            }
        } else {
            return $this->render('edit');
        }
    }

    public function actionUpdateLogic()
    {
        $form = new TemplateForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->updateLogic());
    }

    public function actionDestroy()
    {
        $form = new TemplateForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->destroy());
    }

    public function actionDefaultTemplate()
    {
        $form = new TemplateForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getDefaultTemplate());
    }

    public function actionLoadTemplate()
    {
        $form = new TemplateForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->loadTemplate());
    }

    public function actionTemplateDetail()
    {
        $form = new TemplateForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->templateDetail());
    }

    public function actionConsole()
    {
        $form = new TemplateForm();
        return $this->asJson($form->console());
    }

    public function actionConsoleUpdate()
    {
        $form = new TemplateForm();
        return $this->asJson($form->consoleUpdate());
    }
}
