<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/26
 * Time: 11:37 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\controllers\mall;

use app\plugins\Controller;

class StatisticsController extends Controller
{
    public $layout = '/mall';

    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $plugin = \Yii::$app->plugin->getPlugin('weekly_buy');
            $form = $plugin->getApi();
            $form->attributes = \Yii::$app->request->get();
            $form->attributes = \Yii::$app->request->post();
            return $this->asJson($form->search());
        } else {
            return $this->render('index');
        }
    }
}
