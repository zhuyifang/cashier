<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/21
 * Time: 4:23 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\scrm\controllers\api;

use app\plugins\scrm\filter\LoginFilter;
use app\plugins\scrm\forms\api\CodeForm;
use app\plugins\scrm\forms\api\TokenForm;

class IndexController extends ApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginFilter::class,
                'ignore' => ['token']
            ],
        ]);
    }

    public function actionToken()
    {
        $form = new TokenForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->getToken());
    }

    public function actionCode()
    {
        $form = new CodeForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getCode());
    }
}
