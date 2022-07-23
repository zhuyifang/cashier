<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/3
 * Time: 11:17 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\platform;

use app\models\Model;

class CashPayType extends Model
{
    /**
     * @param $setting
     * @param $key
     * @return mixed
     * h5商城提现方式去掉自动打款
     */
    public static function change($setting, $key)
    {
        $list = (array)$setting[$key];
        if (\Yii::$app->appPlatform == 'mobile' && ($index = array_search('auto', $list)) !== false) {
            unset($list[$index]);
            $setting[$key] = array_values($list);
        }
        return $setting;
    }
}
