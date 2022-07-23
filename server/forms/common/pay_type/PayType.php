<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/7/22
 * Time: 9:56 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\pay_type;

use app\models\Mall;
use app\models\Model;

class PayType extends Model
{
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

    public function getInfo()
    {
        return [
            '未支付',
            '线上支付',
            '余额支付',
            '货到付款',
            '现金',
            'pos机',
        ];
    }

    public function getPayText($payType)
    {
        return $this->getInfo()[$payType];
    }
}
