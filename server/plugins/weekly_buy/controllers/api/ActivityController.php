<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/11
 * Time: 4:27 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\controllers\api;

use app\plugins\weekly_buy\forms\api\ConfigForm;
use app\plugins\weekly_buy\forms\api\DetailForm;
use app\plugins\weekly_buy\forms\api\ListForm;

class ActivityController extends ApiController
{
    public function actionList()
    {
        $form = new ListForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getList());
    }

    public function actionDetail()
    {
        $form = new DetailForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getDetail());
    }

    public function actionConfig()
    {
        $form = new ConfigForm();
        return $this->asJson($form->getConfig());
    }
}
