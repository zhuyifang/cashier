<?php
/**
 * 本项目所有web端控制器的基类
 *
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/10/30 12:00
 */


namespace app\controllers;

use app\helpers\Json;
use yii\web\NotFoundHttpException;

class Controller extends \yii\web\Controller
{
    public function init()
    {
        parent::init();
        if (\Yii::$app->request->get('_layout')) {
            $layout = \Yii::$app->request->get('_layout');
            if (!in_array($layout, ['admin', 'mall', 'plugin', 'main', 'install', 'mall-header'])) {
                throw new NotFoundHttpException('无效的页面');
            }
            $this->layout = $layout;
        }
    }

    public function asJson($data)
    {
        return parent::asJson(\Yii::$app->str2url($data));
    }
}
