<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/3/26
 * Time: 10:04 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\form_goods\forms\mall;

use app\forms\admin\mall\MallOverrunForm;
use app\forms\common\diy\CommonTemplate;
use app\forms\common\diy\DiyTimeForm;
use app\forms\common\goods\CommonCustomization;
use app\forms\common\share\CommonShare;
use app\models\Coupon;
use app\models\GoodsCards;
use app\models\Model;
use app\plugins\diy\models\DiyFormList;
use app\plugins\form_goods\Plugin;
use app\plugins\form_goods\forms\mall\TemplateEditForm;
use app\plugins\form_goods\models\FormGoodsTemplate;
use yii\helpers\Json;

class TemplateForm extends Model
{
    public $keyword;
    public $id;
    public $logic_data;
    public $goods_id;
    public $is_show_default = 0;

    private $path;

    public function rules()
    {
        return [
            [['keyword', 'logic_data'], 'string'],
            [['id', 'goods_id', 'is_show_default'], 'integer']
        ];
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $mallIds[] = \Yii::$app->mall->id;
            if ($this->is_show_default) {
                $this->checkDefault();
                $mallIds[] = 0;
            }

            // 多商户只显示默认模板
            if (\Yii::$app->user->identity->mch_id > 0) {
                $mallIds = [0];
            }

            $query = FormGoodsTemplate::find()->andWhere([
                'mall_id' => $mallIds,
                'mch_id' => 0,
                'is_delete' => 0
            ]);

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'id', $this->keyword],
                    ['like', 'name', $this->keyword]
                ]);
            }

            $list = $query->select(['id', 'name', 'created_at', 'updated_at', 'logic_data', 'default_version'])->orderBy(['default_version' => SORT_ASC, 'created_at' => SORT_DESC])
                ->page($pagination)
                ->all();

            $newList = array_map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->default_version ? sprintf('%s（系统模板）', $item->name) : $item->name,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'logic_data' => $item->logic_data ? json_decode($item->logic_data) : [],
                    'default_version' => $item->default_version
                ];
            }, $list);


            return $this->success([
                'msg' => '请求成功',
                'list' => $newList,
                'pagination' => $pagination
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $info = [];
            if ($this->id) {
                $template = FormGoodsTemplate::find()->andWhere([
                    'mall_id' => \Yii::$app->mall->id,
                    'mch_id' => 0,
                    'id' => $this->id,
                    'is_delete' => 0
                ])->one();

                if (!$template) {
                    throw new \Exception('模板不存在');
                }

                $info = [
                    'id' => $template->id,
                    'name' => $template->name,
                    'form_data' => json_decode($template->form_data),
                ];
            }

            // -_- 商品编辑那边也用到这个接口
            if ($this->goods_id) {
                $info = CommonCustomization::getCommon()->getGoodsCustomization($this->goods_id);
            }

            $common = CommonTemplate::getCommon();
            $removeList = ['phone', 'button', 'time', 'banner', 'video', 'copyright'];
            
            return $this->success([
                'info' => $info,
                'allComponents' => $common->allFormComponents($removeList),
                'overrun' => (new MallOverrunForm())->getSetting(),
                'is_share' => CommonShare::getCommon()->getIsShare(),
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function destroy()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $template = FormGoodsTemplate::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => 0,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$template) {
                throw new \Exception('模板不存在');
            }

            $template->is_delete = 1;
            $res = $template->save();
            if (!$res) {
                throw new \Exception($this->getErrorMsg($template));
            }
            return $this->success([
                'msg' => '删除成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function updateLogic()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $template = FormGoodsTemplate::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => 0,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$template) {
                throw new \Exception('模板不存在');
            }

            if (!$this->logic_data || !is_array(json_decode($this->logic_data))) {
                throw new \Exception('logic_data参数格式异常');
            }

            $template->logic_data = $this->logic_data;
            $res = $template->save();
            if (!$res) {
                throw new \Exception($this->getErrorMsg($template));
            }
            return $this->success([
                'msg' => '更新成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function getDefaultTemplate()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $list = $this->checkDefault();
            $newList = [];
            $host = \Yii::$app->defaultDomain . '/web/statics/img/plugins/form_goods';
            foreach ($list as $key => $item) {
                $newItem = [
                    'cover_pic' => $host . '/' . $item->default_version . '/cover_pic.png',
                    'id' => $item->id,
                    'name' => $item->name,
                    'created_at' => $item->created_at,
                ];
                $newList[] = $newItem;
            }

            return $this->success([
                'msg' => '请求成功',
                'list' =>  $newList
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    // 检测默认模板是否保存
    private function checkDefault()
    {
        $path = \Yii::$app->basePath . '/web/statics/img/plugins/form_goods';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fileList = scandir($path);
        $newVersions = [];
        foreach ($fileList as $item) {
            $array = explode('_', $item);
            if (isset($array[0]) && is_numeric($array[0])) {
                $newVersions[] = $item;
            }
        }

        $query = FormGoodsTemplate::find()->andWhere([
            'mall_id' => 0,
            'mch_id' => 0,
            'is_delete' => 0,
        ])
            ->andWhere(['!=', 'default_version', ''])
            ->select(['id', 'name', 'default_version', 'created_at']);
        $deleteQuery = clone $query;
        $list = $deleteQuery->orderBy(['created_at' => SORT_DESC])->all();
        $dbVersions = [];
        foreach ($list as $item) {
            // 删除不需要的模板
            if (!in_array($item->default_version, $newVersions)) {
                $res = $item->delete();
            } else {
                $dbVersions[] = $item->default_version;
            }
        }

        // 新增模板
        $newList = [];
        foreach ($newVersions as $vItem) {
            if (!in_array($vItem, $dbVersions)) {
                $fileItemPath = $path . '/' . $vItem;
                $jsonDataPath = $fileItemPath . '/' . 'data.json';
                $jsonData = json_decode(file_get_contents($jsonDataPath), true);

                $newItem = [
                    'mall_id' => 0,
                    'mch_id' => 0,
                    'name' => $jsonData['name'],
                    'form_data' => json_encode($jsonData['form_data']),
                    'logic_data' => json_encode($jsonData['logic_data']),
                    'default_version' => $vItem,
                    'created_at' => mysql_timestamp(),
                    'updated_at' => mysql_timestamp(),
                ];
                $newList[] = $newItem;
            }
        }

        if (!empty($newList)) {
            \Yii::$app->db->createCommand()->batchInsert(
                FormGoodsTemplate::tableName(),
                ['mall_id', 'mch_id', 'name', 'form_data', 'logic_data', 'default_version', 'created_at', 'updated_at'],
                $newList
            )->execute();
        }

        $list = $query->orderBy(['created_at' => SORT_DESC])->all();

        return $list;
    }

    // 加载模板
    public function loadTemplate()
    {
        try {
            $template = FormGoodsTemplate::find()->andWhere([
                'mall_id' => [\Yii::$app->mall->id, 0],
                'mch_id' => 0,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$template) {
                throw new \Exception('模板不存在');
            }

            $form = new TemplateEditForm();
            $form->data = $template->form_data;
            $form->name = $template->name;
            $form->logic_data = $template->logic_data;
            $template = $form->loadTemplate();

            return $this->success([
                'msg' => '请求成功',
                'id' =>  $template->id
            ]);

        }catch(\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function templateDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $template = FormGoodsTemplate::find()->andWhere([
                'mall_id' => [\Yii::$app->mall->id, 0],
                'mch_id' => 0,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$template) {
                throw new \Exception('模板不存在');
            }

            $template->form_data = json_decode($template->form_data, true);
            $template->logic_data = json_decode($template->logic_data, true);
            
            return $this->success([
                'template' => $template,
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function console()
    {
        $ids = [];
        $list = FormGoodsTemplate::find()->andWhere([
            'id' => $ids,
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0
        ])->all();

        $newList = [];
        $idKeyList = [];
        foreach ($list as $item) {
            $formData = json_decode($item->form_data, true);
            $newFormData = [];
            $idKey = $item->id . '_' . substr(md5($item->name), 0, 5);
            $idKeyList[] = $idKey;
            $this->path = '/web/statics/img/plugins/form_goods/' . $idKey  . '/';
            foreach ($formData as $formItem) {
                $newFormData[] = $this->setData($formItem);
            }

            $newItem = [
                'name' => $item->name,
                'logic_data' => json_decode($item->logic_data, true),
                'form_data' => $newFormData
            ];
            $this->saveFile($newItem, $item->name);
            $newList[] = $newItem;
        }

        $path = \Yii::$app->basePath . '/web/statics/img/plugins/form_goods/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $localUrl = $path . 'update.json';
        file_put_contents($localUrl, json_encode($idKeyList, JSON_UNESCAPED_UNICODE));

        return $this->success([
            'list' => $newList,
        ]);
    }

    private function saveFile($data, $name)
    {
        $path = \Yii::$app->basePath . $this->path;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $localUrl = $path . 'data.json';
        file_put_contents($localUrl, json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    private function setData($list) {
        foreach ($list as $key => $value) {
            if (is_array($value)) {
                $list[$key] = $this->setData($value);
                continue;
            }

            if ($key && in_array($key, ['pic_url', 'img']) && $value) {
                $list[$key] = $this->getImage($value);
                continue;
            }
            if ($key && $key == 'backgroundImage') {
                $newValue = substr($value, 5);
                $newValue = substr($newValue, 0, -2);
                $newValue = $this->getImage($newValue);
                $list[$key] = sprintf("url('%s')", $newValue);
                continue;
            }
        }

        return $list;
    }

    private function getImage(string $imageUrl)
    {
        try {
            $content = $this->getCurlContents($imageUrl);
            $path = \Yii::$app->basePath . $this->path;
            $filename = md5($imageUrl) . '.png';
            $localUrl = $path . $filename;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (!file_exists($localUrl)) {
                $fp = fopen($localUrl, "a"); //将文件绑定到流
                fwrite($fp, $content); //写入文件
            }

            $host = \Yii::$app->defaultDomain . $this->path . $filename;

            return $host;
        } catch(\Exception $exception) {
            dd($exception);
        } catch(\Error $error) {
            dd($error);
        }
    }

    private function getCurlContents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        ob_start();
        curl_exec($ch);
        $returnContent = ob_get_contents();
        ob_end_clean();

        $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($returnCode != 200) {
            $returnContent = file_get_contents($url);
            if (!$returnContent) {
                throw new \Exception('图片异常');
            }
        }

        return $returnContent;
    }

    public function consoleUpdate()
    {
        $plugin = new Plugin();
        $data = $plugin->install();

        return $data;
    }
}
