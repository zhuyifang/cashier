<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\mch\controllers\api;

use app\controllers\api\filters\LoginFilter;
use app\plugins\mch\controllers\api\filter\MchLoginFilter;
use app\plugins\mch\forms\api\diy\IndexForm;
use app\plugins\mch\forms\api\diy\WeitaoForm;


class DiyController extends ApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginFilter::class,
                'ignore' => ['index', 'weitao-list', 'weitao-detail', 'tags', 'nav', 'store-reflection', 'mch-poster', 'weitao-poster']
            ],
            'mchLogin' => [
                'class' => MchLoginFilter::class,
                'ignore' => [
                    'plugin/mch/api/diy/index',
                    'plugin/mch/api/diy/tags',
                    'plugin/mch/api/diy/weitao-list',
                    'plugin/mch/api/diy/weitao-detail',
                    'plugin/mch/api/diy/nav',
                    'plugin/mch/api/diy/favorite',
                    'plugin/mch/api/diy/cancel-favorite',
                    'plugin/mch/api/diy/store-reflection',
                    'plugin/mch/api/diy/mch-poster',
                    'plugin/mch/api/diy/weitao-poster',
                ]
            ]
        ]);
    }

    // 首页导航
    public function actionNav()
    {
        $form = new IndexForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getNavbar());
    }

    // 收藏店铺
    public function actionFavorite()
    {
        $form = new IndexForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->favorite());
    }

    // 取消收藏店铺
    public function actionCancelFavorite()
    {
        $form = new IndexForm();
        $form->attributes = \Yii::$app->request->post();
        return $this->asJson($form->cancelfavorite());
    }

    // 装修首页
    public function actionIndex()
    {
        $form = new IndexForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getIndex());
    }

    // 标签列表
    public function actionTags()
    {
        $form = new WeitaoForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getTagList());
    }

    // 微淘列表
    public function actionWeitaoList()
    {
        $form = new WeitaoForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getList());
    }

    // 微淘详情
    public function actionWeitaoDetail()
    {
        $form = new WeitaoForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->getDetail());
    }

    // 店铺印象
    public function actionStoreReflection()
    {
        $form = new IndexForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->storeReflection());
    }

    // 店铺海报
    public function actionMchPoster()
    {
        $form = new IndexForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->mchPoster());
    }

    // 微淘海报
    public function actionWeitaoPoster()
    {
        $form = new WeitaoForm();
        $form->attributes = \Yii::$app->request->get();
        return $this->asJson($form->poster());
    }
}
