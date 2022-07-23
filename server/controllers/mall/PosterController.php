<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\controllers\mall;


use app\forms\mall\poster\MchPosterForm;
use app\forms\mall\poster\PosterEditForm;
use app\forms\mall\poster\PosterForm;

class PosterController extends MallController
{
    public function actionSetting()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isGet) {
                $form = new PosterForm();
                $res = $form->getDetail();

                return $this->asJson($res);
            } else {
                $form = new PosterEditForm();
                $form->data = \Yii::$app->request->post('form');
                return $form->save();
            }
        }

        return $this->render('setting');
    }

    public function actionMch()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isGet) {
                $form = new MchPosterForm();
                return $this->asJson($form->get());
            } else {
                $form = new MchPosterForm();
                $form->data = \Yii::$app->request->post('form');
                return $form->save();
            }
        }
        return $this->render('mch');
    }
}
