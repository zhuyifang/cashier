<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\controllers\mall;


use app\forms\mall\mch\CashEditForm;
use app\forms\mall\mch\FinancialManageForm;
use app\forms\mall\mch\MchDiyEditForm;
use app\forms\mall\mch\MchDiyForm;
use app\forms\mall\mch\MchEditForm;
use app\forms\mall\mch\MchSettingEditForm;
use app\forms\mall\mch\MchSettingForm;
use app\forms\mall\mch\MchTagEditForm;
use app\forms\mall\mch\MchTagForm;
use app\forms\mall\mch\MchWeiTaoEditForm;
use app\forms\mall\mch\MchWeiTaoForm;

class MchController extends MallController
{
    public function actionHome()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new MchDiyEditForm();
                $form->attributes = \Yii::$app->request->post();

                return $this->asJson($form->save());
            } else {
                $form = new MchDiyForm();
                return $this->asJson($form->search());
            }
        } else {
            return $this->render('home');
        }
    }

    public function actionManage()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new MchEditForm();
                $form->attributes = \Yii::$app->request->post('form');

                return $this->asJson($form->save());
            } else {
            }
        } else {
            return $this->render('manage');
        }
    }

    public function actionSetting()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new MchSettingEditForm();
                $form->attributes = \Yii::$app->request->post();

                return $this->asJson($form->save());
            } else {
                $form = new MchSettingForm();
                return $this->asJson($form->getSetting());
            }
        } else {
            return $this->render('setting');
        }
    }

    public function actionAccountLog()
    {
        if (\Yii::$app->request->isAjax) {
            $form = new FinancialManageForm();
            $form->attributes = \Yii::$app->request->get();
            $form->attributes = \Yii::$app->request->post();
            return $this->asJson($form->getAccountLog());
        } else {
            return $this->render('account-log');
        }
    }

    public function actionCashLog()
    {
        if (\Yii::$app->request->isAjax) {
            $form = new FinancialManageForm();
            $form->attributes = \Yii::$app->request->get();
            $form->attributes = \Yii::$app->request->post();
            return $this->asJson($form->getCashLog());
        } else {
            return $this->render('cash-log');
        }
    }

    public function actionOrderCloseLog()
    {
        if (\Yii::$app->request->isAjax) {
            $form = new FinancialManageForm();
            $form->attributes = \Yii::$app->request->get();
            $form->attributes = \Yii::$app->request->post();
            return $this->asJson($form->getOrderCloseLog());
        } else {
            return $this->render('order-close-log');
        }
    }

    public function actionCashSubmit()
    {
        $form = new CashEditForm();
        $data = \Yii::$app->request->post('form');
        $form->attributes = $data;
        $form->mch_id = \Yii::$app->user->identity->mch_id;
        $form->type_data = \Yii::$app->serializer->encode($data['type_data']);

        return $this->asJson($form->save());
    }

    public function actionMchMallSetting()
    {
        $form = new MchSettingForm();
        return $this->asJson($form->getMchMallSetting());
    }

    public function actionMchSetting()
    {
        $form = new MchSettingForm();
        return $this->asJson($form->getMchSetting());
    }

    public function actionShareOrder()
    {
        return $this->render('/mall/share/order');
    }

    public function actionNavbar()
    {
        return $this->render('navbar');
    }

    public function actionWeitao()
    {
        if (\Yii::$app->request->isAjax) {
            $form = new MchWeiTaoForm();
            $form->attributes = \Yii::$app->request->get();
            return $this->asJson($form->getList());
        } else {
            return $this->render('weitao');
        }
    }

    public function actionWeitaoEdit()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new MchWeiTaoEditForm();
                $form->attributes = json_decode(\Yii::$app->request->post('form'), true);

                return $this->asJson($form->save());
            } else {
                $form = new MchWeiTaoForm();
                $form->attributes = \Yii::$app->request->get();
                return $this->asJson($form->getDetail());
            }
        } else {
            return $this->render('weitao-edit');
        }
    }

    public function actionUpdateWeitaoStatus()
    {
        $form = new MchWeiTaoForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->changeStatus());
    }

    public function actionUpdateWeitaoSort()
    {
        $form = new MchWeiTaoForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->changeSort());
    }

    public function actionDeleteWeitao()
    {
        $form = new MchWeiTaoForm();
        $form->attributes = \Yii::$app->request->post();

        return $this->asJson($form->delete());
    }

    public function actionTag()
    {
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $form = new MchTagEditForm();
                $form->attributes = \Yii::$app->request->post();

                return $this->asJson($form->save());
            } else {
                $form = new MchTagForm();
                $form->attributes = \Yii::$app->request->get();
                return $this->asJson($form->getList());
            }
        } else {
            return $this->render('tag');
        }
    }

    public function actionDeleteTag()
    {
        $form = new MchTagForm();
        $form->attributes = \Yii::$app->request->post();

        return $this->asJson($form->deleteTag());
    }
}
