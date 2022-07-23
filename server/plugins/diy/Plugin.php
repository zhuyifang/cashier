<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/10/30 14:42
 */


namespace app\plugins\diy;

use app\forms\common\diy\CommonAlonePage;
use app\forms\common\diy\CommonPage;
use app\forms\OrderConfig;
use app\forms\PickLinkForm;
use app\forms\common\diy\CommonPageTwo;
use app\helpers\PluginHelper;
use app\models\Model;
use app\plugins\diy\forms\common\message\FormSubmitInfo;
use app\plugins\diy\forms\common\message\ReplyFormInfo;
use app\plugins\diy\forms\mall\TemplateForm;
use app\plugins\diy\forms\mall\market\CommonTemplateCenter;
use app\plugins\diy\handlers\OrderCancelEventHandler;
use app\plugins\diy\handlers\OrderCreatedEventHandler;
use app\plugins\diy\handlers\OrderPayEventHandler;
use app\plugins\diy\handlers\OrderSalesEventHandler;
use app\plugins\diy\models\CoreTemplate;
use app\plugins\diy\models\DiyForm;
use app\plugins\diy\models\DiyPage;
use app\plugins\diy\models\DiyTemplate;

class Plugin extends \app\plugins\Plugin
{
    public function getMenus()
    {
        return [
            [
                'name' => '模板市场',
                'route' => 'plugin/diy/mall/market/list',
                'icon' => 'el-icon-star-on',
            ],
//            [
//                'name' => 'DIY首页',
//                'route' => 'plugin/diy/mall/home/index',
//                'icon' => 'el-icon-star-on',
//            ],
            [
                'name' => '微页面',
                'route' => 'plugin/diy/mall/template/index',
                'icon' => 'el-icon-star-on',
                'action' => [
                    [
                        'name' => '微页面编辑',
                        'route' => 'plugin/diy/mall/template/edit',
                    ],
                ]
            ],
            [
                'name' => '自定义模块',
                'route' => 'plugin/diy/mall/module/index',
                'icon' => 'el-icon-star-on',
                'action' => [
                    [
                        'name' => '自定义模块编辑',
                        'route' => 'plugin/diy/mall/module/edit',
                    ],
                ]
            ],
            [
                'name' => '自定义表单',
                'route' => 'plugin/diy/mall/diy-form/index',
                'icon' => 'el-icon-star-on',
                'action' => [
                    [
                        'name' => '自定义表单编辑',
                        'route' => 'plugin/diy/mall/diy-form/edit',
                    ],
                ]
            ],
            [
                'name' => '授权页面',
                'route' => 'plugin/diy/mall/page/auth',
                'icon' => 'el-icon-star-on',
            ],
            [
                'name' => '表单提交信息',
                'route' => 'plugin/diy/mall/page/info',
                'icon' => 'el-icon-star-on',
            ],
        ];
    }

    public function handler()
    {
    }

    public function getOrderCreatedHandleClass()
    {
        return new OrderCreatedEventHandler();
    }

    public function getOrderPayedHandleClass()
    {
        return new OrderPayEventHandler();
    }

    public function getOrderCanceledHandleClass()
    {
        return new OrderCancelEventHandler();
    }

    public function getOrderSalesHandleClass()
    {
        return new OrderSalesEventHandler();
    }

    /**
     * 插件唯一id，小写英文开头，仅限小写英文、数字、下划线
     * @return string
     */
    public function getName()
    {
        return 'diy';
    }

    /**
     * 插件显示名称
     * @return string
     */
    public function getDisplayName()
    {
        return 'DIY装修';
    }

    public function getAppConfig()
    {
        $imageBaseUrl =  \Yii::$app->defaultDomain . '/web/statics/img/mall';
        return [
            'app_image' => [
                'uimage_photo' => $imageBaseUrl . '/form/uimage-photo.png',
                'uimage_close' => $imageBaseUrl . '/form/uimage-close.png',
                'uimage_idcard_l' => $imageBaseUrl . '/form/uimage-idcard-l.png',
                'uimage_idcard_r' => $imageBaseUrl . '/form/uimage-idcard-r.png',
                'uimage_license' => $imageBaseUrl . '/form/uimage-license.png',
                'uimage_photo_white' => $imageBaseUrl . '/form/uimage-photo-white.png',
                'uvideo_photo' => $imageBaseUrl . '/form/uvideo-photo.png',
                'menu_date' => $imageBaseUrl . '/form/menu-date.png',
                'app_submit_ok' => $imageBaseUrl . '/form/app-submit-ok.png',
                'app_submit_success' => $imageBaseUrl . '/form/app-submit-success1.png',
                'app_diy_success' => $imageBaseUrl . '/form/app-diy-success.png',
                'app_diy_error' => $imageBaseUrl . '/form/app-diy-error.png',
            ],
        ];
    }

    public function getIndexRoute()
    {
        return 'plugin/diy/mall/template/index';
    }

    /**
     * 插件小程序端链接
     * @return array
     */
    public function getPickLink()
    {
        $iconBaseUrl = PluginHelper::getPluginBaseAssetsUrl($this->getName()) . '/images/pick-link';
        $pageList = CommonPage::getCommon(\Yii::$app->mall)->getPageList();
        $list = [];
        foreach ($pageList as $page) {
            $list[] = [
                'key' => $this->getName(),
                'type' => 'diy',
                'name' => $page->title,
                'open_type' => '',
                'icon' => $iconBaseUrl . '/tpl.png',
                'value' => '/pages/index/index?page_id=' . $page->id,
                'ignore' => [PickLinkForm::IGNORE_TITLE],
            ];
        }
        array_push($list, [
            'key' => 'diy',
            'name' => '提交记录',
            'open_type' => 'navigate',
            'icon' => $iconBaseUrl . '/log.png',
            'value' => '/plugins/diy/list/list',
        ]);
        return $list;
    }

    /**
     * @param string $type
     * @return array
     * 获取单页的配置例如授权页面(auth)
     */
    public function getAlonePage($type)
    {
        $commonAlonePage = CommonAlonePage::getCommon(\Yii::$app->mall);
        return $commonAlonePage->getPage($type);
    }

    /**
     * @param @pageId integer
     * @return array
     * @throws \Exception
     * 获取自定义页面
     */
    public function getPage($pageId = null)
    {
        $data = \Yii::$app->request->get();
        $common = CommonPage::getCommon(\Yii::$app->mall, $data['longitude'] ?? '', $data['latitude'] ?? '');
        return $common->getPage($pageId, true);
    }


    public function getTemplatePage($templateId = null)
    {
        $data = \Yii::$app->request->get();
        $common = CommonPageTwo::getCommon(\Yii::$app->mall, $data['longitude'] ?? '', $data['latitude'] ?? '');
        $common->hasLog(true);
        return $common->getPageFormat($templateId, true);
    }

    /**
     * @param @pageId integer
     * @return array
     * @throws \Exception
     * 获取自定义页面
     */
    public function getNewPage($pageId = null)
    {
        $common = CommonPage::getCommon(\Yii::$app->mall);
        return $common->getNewPage($pageId, true);
    }

    public function getIndexExtra($array)
    {
        $longitude = $array['longitude'] ?? null;
        $latitude = $array['latitude'] ?? null;
        $common = CommonPage::getCommon(\Yii::$app->mall, $longitude, $latitude);
        return $common->getIndexExtra($array);
    }

    /**
     * @param $mallId
     * @return mixed
     * 暂时这么处理
     */
    public function getTemplate($mallId)
    {
        $search = \Yii::$app->request->get('search');
        $search = json_decode($search, true);
        $keyword = trim($search['keyword']);
        $list = DiyTemplate::find()->where([
            'mall_id' => $mallId,
            'is_delete' => 0,
            'type' => DiyTemplate::TYPE_PAGE
        ])->keyword($keyword, ['like', 'name', $keyword])
            ->page($pagination, 10)
            ->orderBy(['created_at' => SORT_DESC])
            ->select('id,name')
            ->all();
        return [
            'list' => $list,
            'pagination' => $pagination
        ];
    }

    /**
     * @param $mallId
     * @param $templateId
     * @return array|\yii\db\ActiveRecord|null|DiyTemplate
     */
    public function getTemplateOne($mallId, $templateId)
    {
        $list = DiyTemplate::find()->where([
            'mall_id' => $mallId,
            'is_delete' => 0,
            'id' => $templateId,
        ])->one();
        return $list;
    }

    /**
     * @param CoreTemplate $coreTemplate
     * @return array
     * @throws \Exception
     * 加载模板到diy模板
     */
    public function loadTemplate($coreTemplate)
    {
        $template = new DiyTemplate();
        $template->mall_id = \Yii::$app->mall->id;
        $template->name = $coreTemplate->name;
        $template->data = $coreTemplate->data;
        $template->is_delete = 0;
        if (!$template->save()) {
            throw new \Exception((new Model())->getErrorMsg($template));
        }
        return [
            'id' => $template->id
        ];
    }

    /**
     * @param $params
     * @return array|\yii\db\ActiveRecord[]
     * 获取已安装的模板
     */
    public function getLocalList($params = [])
    {
        $common = CommonTemplateCenter::getInstance();
        $common->page = isset($params['page']) ? $params['page'] : 1;
        $list = $common->getList();
        return $list;
    }

    /**
     * @param $idList
     * @return array|\yii\db\ActiveRecord[]
     * 获取已选中的已安装模板
     */
    public function getLocalListById($idList)
    {
        $list = CommonTemplateCenter::getInstance()
            ->getListById($idList);
        return $list;
    }

    /**
     * @param $params
     * @return array|\yii\db\ActiveRecord[]
     * @throws \app\core\cloud\CloudException
     * 获取模板市场列表
     */
    public function getMarketList($params)
    {
        $common = CommonTemplateCenter::getInstance();
        $common->page = isset($params['page']) ? $params['page'] : 1;
        $common->is_buy = isset($params['is_buy']) ? $params['is_buy'] : '';
        return $common->getCloudList();
    }

    /**
     * @param $idList
     * @return array|\yii\db\ActiveRecord[]
     * @throws \app\core\cloud\CloudException
     * 获取已选中的模板市场列表
     */
    public function getMarketListById($idList)
    {
        $common = CommonTemplateCenter::getInstance();
        return $common->getCloudListById($idList);
    }

    public function getHasPage()
    {
        return ((new TemplateForm())->getHome())['data'] ? true : false;
    }

    public function templateRegister()
    {
        return [
            FormSubmitInfo::TPL_NAME => FormSubmitInfo::class,
            ReplyFormInfo::TPL_NAME => ReplyFormInfo::class,
        ];
    }

    public function getOrderConfig()
    {
        return new OrderConfig([
            'is_sms' => 0,
            'is_print' => 0,
            'is_mail' => 1,
            'is_share' => 1,
            'support_share' => 1,
            'is_member_price' => 1,
        ]);
    }

    public function getOrderInfo($orderId, $order)
    {
        $diyForm = DiyForm::find()->andWhere(['order_no' => $order['order_no']])->one();

        return [
            'diy_form_id' => $diyForm ? $diyForm->id : null
        ];
    }

    public function getEnableVipDiscount()
    {
        return true;
    }

    public function afterUpdate()
    {
        $sql = <<<EOF
ALTER TABLE `zjhj_bd_diy_form_list` ADD COLUMN `time_at` timestamp NULL COMMENT '定时时间';
EOF;
        sql_execute($sql);
    }

    public function afterInstall()
    {
        $sql = <<<EOF
ALTER TABLE `zjhj_bd_diy_form_list` ADD COLUMN `time_at` timestamp NULL COMMENT '定时时间';
EOF;
        sql_execute($sql);
    }
}
