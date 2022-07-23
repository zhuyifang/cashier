<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/8
 * Time: 2:56 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\controllers\mall;

use app\plugins\Controller;
use app\plugins\weekly_buy\forms\mall\GoodsEditForm;
use app\plugins\weekly_buy\forms\mall\GoodsForm;
use app\plugins\weekly_buy\forms\mall\GoodsListForm;
use app\plugins\weekly_buy\forms\mall\OperateForm;
use yii\helpers\Json;

class ActivityController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isGet) {
                $form = new GoodsListForm();
                $form->attributes = \Yii::$app->request->get();
                return $this->asJson($form->getList());
            }
        } else {
            return $this->render('index');
        }
    }
    public function actionEdit()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new GoodsEditForm();
                $data = \Yii::$app->request->post();
                $form->attributes = Json::decode($data['form'], true);
                $form->attrGroups = Json::decode($data['attrGroups'], true);
                return $this->asJson($form->save());
            } else {
                $form = new GoodsForm();
                $form->attributes = \Yii::$app->request->get();
                return $this->asJson($form->search());
            }
        } else {
            return $this->render('edit');
        }
    }

    public function actionOperate()
    {
        $form = new OperateForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->execute());
    }
}
