<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/6
 * Time: 11:29 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\forms\common\CommonOption;
use app\plugins\weekly_buy\forms\common\CommonSetting;
use app\plugins\weekly_buy\forms\Model;

class SettingForm extends Model
{
    public $is_share;
    public $is_territorial_limitation;
    public $is_coupon;
    public $svip_status;
    public $is_member_price;
    public $is_integral;
    public $banner;
    public $detail;
    public $is_full_reduce;

    public function rules()
    {
        return [
            [['is_share', 'is_coupon', 'is_territorial_limitation', 'svip_status', 'is_member_price'
                , 'is_integral', 'is_full_reduce'], 'integer'],
            [['banner', 'detail'], 'string']
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        CommonOption::set(CommonSetting::SETTING, $this->attributes, \Yii::$app->mall->id, 'plugin');
        return $this->success([
            'msg' => '保存成功'
        ]);
    }

    public function getSetting()
    {
        $setting = CommonSetting::getInstance()->getSetting(true);

        return $this->success($setting);
    }
}
