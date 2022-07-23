<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/6
 * Time: 9:56 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common;

use app\forms\common\CommonOption;
use app\helpers\PluginHelper;
use app\models\Mall;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\Plugin;
use yii\helpers\ArrayHelper;

class CommonSetting extends Model
{
    const SETTING = 'weekly_buy_setting';

    /**
     * @var Mall $mall
     */
    public $mall;

    public static function getInstance($mall = null)
    {
        if (!$mall) {
            $mall = \Yii::$app->mall;
        }
        $instance = new self();
        $instance->mall = $mall;
        return $instance;
    }

    public function getDefault()
    {
        $Plugin = new Plugin();
        $host = PHP_SAPI != 'cli' ? PluginHelper::getPluginBaseAssetsUrl($Plugin->getName()) : '';
        return [
            'is_share' => 1,
            'is_territorial_limitation' => 1,
            'is_coupon' => 1,
            'svip_status' => 1, // -1.未安装超级会员卡 1.开启 0.关闭
            'is_member_price' => 1,
            'is_integral' => 1,
            'is_full_reduce' => 1,
            'banner' => '',
            'default_banner' => $host . '/img/banner.png',
            'is_show_share' => 1,
            'is_show_svip_status' => 1,
            'is_show_coupon' => 1,
            'detail' => '',
        ];
    }

    /**
     * @param false $isSetting 是否后台设置
     * @return array|int[]
     */
    public function getSetting($isSetting = false)
    {
        $setting = CommonOption::get(self::SETTING, $this->mall->id, 'plugin', []);
        $setting = ArrayHelper::toArray($setting);

        $default = $this->getDefault();

        // 将新加的字段合并到setting数据中
        $diffSetting = array_diff_key($default, $setting);
        $setting = array_merge($setting, $diffSetting);

        // 调整数字为整型
        $setting = array_map(function ($item) {
            return is_numeric($item) ? (int)$item : $item;
        }, $setting);

        $permission = \Yii::$app->mall->role->permission;
        $permissionFlip = array_flip($permission);
        // 后台设置与其他地方使用区分开
        if ($isSetting) {
            // 默认图片
            $setting['default_banner'] = $default['default_banner'];

            // 判断权限
            $setting['is_show_share'] = isset($permissionFlip['share']) ? 1 : 0;
            $setting['is_show_svip_status'] = isset($permissionFlip['vip_card']) ? 1 : 0;
            $setting['is_show_coupon'] = isset($permissionFlip['coupon']) ? 1 : 0;
        } else {
            $setting['banner'] = $setting['banner'] ?: $default['default_banner'];
            $setting['is_share'] = isset($permissionFlip['share']) ? $setting['is_share'] : 0;
            $setting['svip_status'] = isset($permissionFlip['vip_card']) ? $setting['svip_status'] : 0;
            $setting['is_coupon'] = isset($permissionFlip['coupon']) ? $setting['is_coupon'] : 0;
        }
        return $setting;
    }
}
