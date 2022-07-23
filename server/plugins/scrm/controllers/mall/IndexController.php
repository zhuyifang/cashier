<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/21
 * Time: 1:45 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\scrm\controllers\mall;

use app\plugins\scrm\forms\mall\ConfigForm;
use app\plugins\scrm\forms\mall\IndexForm;

class IndexController extends MallController
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $form = new IndexForm();
            if (\Yii::$app->request->isPost) {
                return $this->asJson($form->reset());
            } else {
                return $this->asJson($form->getDetail());
            }
        } else {
            return $this->render('index');
        }
    }

    public function actionSubmit()
    {
        $form = new ConfigForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->save());
    }
}
