<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\ma_ke\controllers\mall;


use app\plugins\Controller;
use app\plugins\ma_ke\forms\mall\MaKeSettingForm;
use app\plugins\ma_ke\forms\mall\MakeSettingEditForm;

class SettingController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                
            } else {
                $form = new MaKeSettingForm();
                return $this->asJson($form->getSetting());
            }
        } else {
            return $this->render('index');
        }
    }
}
