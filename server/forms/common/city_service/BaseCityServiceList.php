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
use yii\helpers\ArrayHelper;

class BaseCityServiceList extends BaseCityService
{
    public $id;
    public $page;
    public $keyword;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['page'], 'default', 'value' => 1],
            [['keyword'], 'default', 'value' => ''],
            [['keyword'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '即时配送商家ID',
        ];
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $query = CityService::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'platform' => $this->platform,
            'is_delete' => 0,
            'plugin' => 'mall' 
        ]);

        $list = $query->keyword($this->keyword, ['like', 'name', $this->keyword])
            ->orderBy(['created_at' => SORT_DESC])
            ->page($pagination)
            ->all();

        $newList = [];
        foreach ($list as $key => $value) {
            $newList[] = $this->transformData($value);
        }

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '请求成功',
            'data' => [
                'list' => $newList,
                'pagination' => $pagination,
            ],
        ];
    }

    private function transformData($item)
    {
        $corporation = $this->getCorporation($item->distribution_corporation);

        $newItem = ArrayHelper::toArray($item);
        $newItem['data'] = json_decode($newItem['data'], true);
        $newItem = $item->checkData($newItem, $corporation['default']);

        $newItem['data']['shop_no'] = $newItem['data']['shop_no'] ?: $newItem['shop_no'];
        $newItem['corporation_name'] = $this->getCorporationName($item->distribution_corporation);
        $newItem['new_service_type'] = $item->service_type == '微信' ? '腾讯即时配送接口' : '配送公司自带接口';

        return $newItem;
    }

    public function getDetail()
    {
        try {
            $cityService = CityService::find()->where([
                'mall_id' => \Yii::$app->mall->id,
                'platform' => $this->platform,
                'is_delete' => 0,
                'id' => $this->id,
            ])->one();

            if (!$cityService) {
                throw new \Exception('配送商家不存在');
            }

            $cityService = $this->transformData($cityService);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'city_service' => $cityService,
                ],
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

    public function getOption()
    {
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '请求成功',
            'data' => [
                'corporation_list' => $this->getCorporationList(),
            ],
        ];
    }

    public function delete()
    {
        try {
            $cityService = CityService::find()->where([
                'mall_id' => \Yii::$app->mall->id,
                'platform' => $this->platform,
                'is_delete' => 0,
                'id' => $this->id,
            ])->one();

            if (!$cityService) {
                throw new \Exception('配送商家不存在');
            }

            $cityService->is_delete = 1;
            $res = $cityService->save();
            if (!$res) {
                throw new \Exception($this->getErrorMsg($cityService));
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '删除成功',
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
}
