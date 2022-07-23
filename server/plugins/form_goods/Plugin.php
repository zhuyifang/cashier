<?php
/**
 * @copyright ©2019 浙江禾匠信息科技
 * @author jack_guo
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2019年10月11日 14:15:22
 */


namespace app\plugins\form_goods;


use app\forms\OrderConfig;
use app\forms\common\goods\GoodsAuth;
use app\handlers\HandlerBase;
use app\helpers\PluginHelper;
use app\plugins\form_goods\models\FormGoodsTemplate;

class Plugin extends \app\plugins\Plugin
{
    public function getMenus()
    {
        return [
            [
                'name' => '定制模板',
                'route' => 'plugin/form_goods/mall/index/index',
                'icon' => 'el-icon-star-on',
                'action' => [
                    [
                        'name' => '模板编辑',
                        'route' => 'plugin/form_goods/mall/index/edit',
                        'icon' => 'el-icon-star-on',
                    ]
                ]
            ],
        ];
    }

    /**
     * 插件唯一id，小写英文开头，仅限小写英文、数字、下划线
     * @return string
     */
    public function getName()
    {
        return 'form_goods';
    }

    /**
     * 插件显示名称
     * @return string
     */
    public function getDisplayName()
    {
        return '定制商品';
    }

    public function getAppConfig()
    {
        $imageBaseUrl = PluginHelper::getPluginBaseAssetsUrl($this->getName()) . '/img';
        return [
            'app_image' => [],
        ];
    }


    public function getIndexRoute()
    {
        return 'plugin/form_goods/mall/index/index';
    }

    public function getGoodsConfig()
    {
        return [
            'is_form_goods' => 1
        ];
    }

    public function install()
    {
        try {
            $path = \Yii::$app->basePath . '/web/statics/img/plugins/form_goods';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            // 更新模板
            $updatePath = \Yii::$app->basePath . '/web/statics/img/plugins/form_goods/update.json';
            if (file_exists($updatePath)) {
                $updateList = json_decode(file_get_contents($updatePath), true);
                foreach ($updateList as $item) {
                    $template = FormGoodsTemplate::find()->andWhere(['default_version' => $item])->one();
                    if (!$template) {
                        continue;
                    }

                    $fileItemPath = $path . '/' . $item;
                    $jsonDataPath = $fileItemPath . '/' . 'data.json';
                    $jsonData = json_decode(file_get_contents($jsonDataPath), true);

                    $template->name = $jsonData['name'];
                    $template->form_data = json_encode($jsonData['form_data']);
                    $template->save();
                }
            }

            return true;
        }catch(\Exception $exception) {
            \Yii::error('定制商品插件更新模板失败');
            \Yii::error($exception);
            return false;
        }
    }
}
