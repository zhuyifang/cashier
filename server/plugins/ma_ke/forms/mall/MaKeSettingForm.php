<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\ma_ke\forms\mall;

use app\core\response\ApiCode;
use app\models\CityService;
use app\models\Model;
use app\plugins\ma_ke\forms\common\MaKeSetting;
use yii\helpers\ArrayHelper;

class MaKeSettingForm extends Model
{
    public function getSetting()
    {
        $cityService = CityService::find()->andWhere([
            'plugin' => 'ma_ke',
            'mall_id' => \Yii::$app->mall->id,
        ])->one();

        $default = MaKeSetting::getInstance()->getDefault();
        if ($cityService) {
            $array = ArrayHelper::toArray($cityService);
            $array['data'] = json_decode($array['data'], true);

            $cityService = $cityService->checkData($array, $default);

            // 兼容旧数据
            $cityService['data']['token'] = $cityService['data']['token'] ?: $cityService['data']['appsecret'];
            $cityService['data']['app_id'] = $cityService['data']['app_id'] ?: $cityService['data']['appkey'];
        } else {
            $cityService = $default;
        }

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '请求成功',
            'data' => [
                'setting' => $cityService
            ]
        ];
    }
}
