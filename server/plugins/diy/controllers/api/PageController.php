<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/4/23
 * Time: 17:04
 */

namespace app\plugins\diy\controllers\api;


use app\controllers\api\ApiController;
use app\controllers\behaviors\LoginFilter;
use app\core\response\ApiCode;
use app\plugins\diy\forms\api\InfoForm;
use app\plugins\diy\forms\api\form\DiyOrderSubmitForm;
use app\plugins\diy\forms\api\form\NewInfoEditForm;
use app\plugins\diy\forms\api\form\NewInfoForm;
use app\plugins\diy\models\DiyPage;

class PageController extends ApiController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginFilter::class,
                'safeActions' => ['detail']
            ]
        ]);
    }

    public function actionDetail($id)
    {
        $page = DiyPage::find()->select('id,title,show_navs')
            ->where([
                'id' => $id,
                'mall_id' => \Yii::$app->mall->id,
                'is_disable' => 0,
                'is_delete' => 0,
            ])->with(['navs' => function ($query) {
                $query->select('id,name,page_id,template_id')->with(['template' => function ($query) {
                    $query->select('id,name,data');
                }]);
            }])->asArray()->one();
        if (!$page) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => '页面不存在。',
            ];
        }
        if (!empty($page['navs'])) {
            foreach ($page['navs'] as &$nav) {
                if (!empty($nav['template']['data'])) {
                    $nav['template']['data'] = json_decode($nav['template']['data']);
                }
            }
        }
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => $page,
        ];
    }

    public function actionStore()
    {
        $form = new InfoForm();
        $form->form_data = json_decode(\Yii::$app->request->post('form_data'), true);
        return $this->asJson($form->save());
    }

    public function actionNewForm()
    {
        $form = new NewInfoEditForm();
        $form->attributes = \Yii::$app->request->post();
        $res = $form->save();

        return $this->asJson($res);
    }

    public function actionSubmitResult()
    {
        $form = new NewInfoForm();
        $form->attributes = \Yii::$app->request->get();
        $res = $form->getSubmitResult();

        return $this->asJson($res);
    }

    public function actionOrderPreview()
    {
        $form = new DiyOrderSubmitForm();
        $form->form_data = \Yii::$app->serializer->decode(\Yii::$app->request->post('form_data'));
        return $this->asJson($form->setPluginData()->preview());
    }

    public function actionOrderSubmit()
    {
        $form = new DiyOrderSubmitForm();
        $form->form_data = \Yii::$app->serializer->decode(\Yii::$app->request->post('form_data'));
        return $this->asJson($form->setPluginData()->submit());
    }

    public function actionUsableCouponList()
    {
        $form = new DiyOrderSubmitForm();
        $form_data = \Yii::$app->serializer->decode(\Yii::$app->request->post('form_data'));
        $form->isCheckWhite = false;
        $form->form_data = $form_data;
        $list = $form->setPluginData()->getUsableCouponList($form_data);
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => [
                'list' => $list,
            ],
        ];
    }

    public function actionFormDetail()
    {
        $form = new NewInfoForm();
        $form->attributes = \Yii::$app->request->get();
        $res = $form->getDetail();

        return $this->asJson($res);
    }

    public function actionFormList()
    {
        $form = new NewInfoForm();
        $form->attributes = \Yii::$app->request->get();
        $res = $form->getList();

        return $this->asJson($res);
    }

    public function actionFormCancel()
    {
        $form = new NewInfoForm();
        $form->attributes = \Yii::$app->request->post();
        $res = $form->orderCancel();

        return $this->asJson($res);
    }
}
