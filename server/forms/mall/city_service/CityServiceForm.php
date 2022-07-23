<?php

namespace app\forms\mall\city_service;

use app\core\response\ApiCode;
use app\forms\common\city_service\BaseCityServiceList;

class CityServiceForm extends BaseCityServiceList
{
	protected $platform = 'wxapp';

	public $type;

	public function rules()
    {
        return array_merge(parent::rules(), [
        	[['type'], 'string']
        ]);
    }

	public function getTestSetting()
	{
		try {
			$tabs = [
				['label' => '顺丰', 'value' => 'SF'],
				['label' => '闪送', 'value' => 'SS'],
				['label' => '美团', 'value' => 'MT'],
				['label' => '达达', 'value' => 'DD'],
			];
			$permission = \Yii::$app->mall->role->permission;
			if (in_array('uu', $permission)) {
				$tabs[] = ['label' => 'UU跑腿', 'value' => 'UU'];
				$tabs[] = ['label' => '同城速送', 'value' => 'MK'];
			}

			return [
	            'code' => ApiCode::CODE_SUCCESS,
	            'msg' => '请求成功',
	            'data' => [
	                'tabs' => $tabs,
	            ],
	        ];
		}catch(\Exception $exception) {
			return [
	            'code' => ApiCode::CODE_ERROR,
	            'msg' => $exception->getMessage()
	        ];
		}
	}

	public function addOrder()
	{
		try {
			

			return [
	            'code' => ApiCode::CODE_SUCCESS,
	            'msg' => '请求成功',
	            'data' => [
	                'tabs' => $tabs,
	            ],
	        ];
		}catch(\Exception $exception) {
			return [
	            'code' => ApiCode::CODE_ERROR,
	            'msg' => $exception->getMessage()
	        ];
		}
	}
}