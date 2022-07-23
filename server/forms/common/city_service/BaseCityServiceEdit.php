<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\city_service;

use app\core\response\ApiCode;
use app\forms\common\city_service\BaseCityService;
use app\models\CityService;

class BaseCityServiceEdit extends BaseCityService
{
    public $id;
    public $name;
    public $distribution_corporation;
    public $plugin;
    public $service_type;
    public $shop_no;
    public $status;
    public $data;

    public function rules()
    {
        return [
            [['name', 'distribution_corporation', 'service_type'], 'required'],
            [['id', 'distribution_corporation', 'status'], 'integer'],
            [['name', 'shop_no', 'service_type'], 'string'],
            [['name'], 'string', 'max' => '20'],
            [['data'], 'safe'],
            [['status'], 'default', 'value' => 1],
            [['plugin'], 'default', 'value' => 'mall'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '即时配送商家ID',
            'name' => '配送名称',
            'distribution_corporation' => '配送公司',
            'shop_no' => '门店ID',
            'service_type' => '第三方平台接口',
            'plugin' => '插件名称',
            'status' => '状态',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $this->checkData();

            if ($this->id) {
                $cityService = CityService::find()->andWhere([
                    'id' => $this->id,
                    'mall_id' => \Yii::$app->mall->id,
                    'is_delete' => 0,
                ])->one();
                if (!$cityService) {
                    throw new \Exception('配送商家不存在');
                }
            } else {
                $cityService = new CityService();
                $cityService->mall_id = \Yii::$app->mall->id;
                $cityService->platform = $this->platform;
            }

            $cityService->name = $this->name;
            $cityService->distribution_corporation = $this->distribution_corporation;
            $cityService->shop_no = $this->shop_no;
            $cityService->service_type = $this->service_type;
            $cityService->plugin = $this->plugin;
            $cityService->status = $this->status;

            $cityService->data = json_encode($this->data);
            $res = $cityService->save();
            if (!$res) {
                throw new \Exception($this->getErrorMsg($cityService));
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
            ];
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'error' => [
                    'line' => $exception->getLine(),
                ],
            ];
        }
    }

    private function checkData()
    {
        if (!in_array($this->distribution_corporation, $this->getCorporationValueList())) {
            throw new \Exception('配送公司数据异常');
        }
    }
}
