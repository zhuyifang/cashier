<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\ma_ke\forms\common;


use app\forms\common\city_service\BaseCityService;
use app\models\Mall;
use app\models\Model;
use app\models\Option;
use yii\helpers\ArrayHelper;

/**
 * @property Mall $mall
 */
class MaKeSetting extends BaseCityService
{
    private static $instance;

    protected function __construct() {}

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new MaKeSetting();
        }

        return self::$instance;
    }

    public function getDefault()
    {
        return [
            'id' => null,
            'name' => '同城速送',
            'plugin' => 'ma_ke',
            'status' => 0,
            'distribution_corporation' => $this->mk,
            'service_type' => '第三方',
            'data' => [
                'app_id' => '',
                'token' => '',
                'domain' => ''
            ],
        ];
    }
}
