<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/17
 * Time: 5:26 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\balance;

use app\forms\common\CommonOption;
use app\forms\mall\recharge\RechargeSettingForm;
use app\models\Mall;
use app\models\Model;
use app\models\Option;

class BalanceCreate extends Model
{
    /**
     * @var Mall $mall
     */
    public $mall;

    public static function create($mall = null)
    {
        if (!$mall) {
            $mall = \Yii::$app->mall;
        }
        $instance = new self();
        $instance->mall = $mall;
        return $instance;
    }

    public function isBalance()
    {
        $rechargeForm = new RechargeSettingForm();
        $setting = $rechargeForm->setting();
        return $setting['status'] == 1;
    }

    public function unsetPayType($supportPayTypes, $type)
    {
        if ($supportPayTypes && isset($supportPayTypes[$type])) {
            unset($supportPayTypes[$type]);
        }
        if (($balanceKey = array_search($type, (array)$supportPayTypes)) !== false) {
            unset($supportPayTypes[$balanceKey]);
        }
        return $supportPayTypes;
    }
}
