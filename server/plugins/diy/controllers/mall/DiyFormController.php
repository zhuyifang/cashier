<?php


namespace app\plugins\diy\controllers\mall;


use app\forms\common\diy\DiyTimeForm;
use app\plugins\Controller;
use app\plugins\diy\forms\mall\FormCreate;
use app\plugins\diy\forms\mall\FormEdit;
use app\plugins\diy\forms\mall\FormListForm;
use app\plugins\diy\forms\mall\TimeDataForm;

class DiyFormController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isGet) {
                $form = new FormListForm();
                $form->attributes = \Yii::$app->request->get();
                return $this->asJson($form->getList());
            } else {
                $form = new FormCreate();
                $form->attributes = \Yii::$app->request->post();
                return $this->asJson($form->save());
            }
        } else {
            return $this->render('index');
        }
    }

    public function actionEdit()
    {
        if (\Yii::$app->request->isAjax) {
            $form = new FormEdit();
            if (\Yii::$app->request->isPost) {
                $form->attributes = \Yii::$app->request->post();
                return $this->asJson($form->save());
            } else {
                $form->attributes = \Yii::$app->request->get();
                return $this->asJson($form->get());
            }
        } else {
            return $this->render('edit');
        }
    }

    public function actionDestroy()
    {
        $form = new FormEdit();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->destroy());
    }

    public function actionTimeData()
    {
        $form = new TimeDataForm();
        $form->time = json_decode(\Yii::$app->request->post('time'), true);
        $form->button = json_decode(\Yii::$app->request->post('button'), true);
        $form->form_id = \Yii::$app->request->post('form_id') ?: 0;
        $res = $form->search();

        return $this->asJson($res);
    }
}