<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/29
 * Time: 2:13 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\mall\pay_type;

use app\models\Model;

class PayTypeListForm extends Model
{
    public function getList()
    {
        $list = [
            [
                'key' => 1,
                'value' => '微信'
            ]
        ];
        $permission = \Yii::$app->mall->role->permission;
        if (!empty(array_diff($permission, ['wechat', 'aliapp', 'mobile', 'teller']))) {
            $list[] = [
                'key' => 2,
                'value' => '支付宝'
            ];
        }
        return $this->success([
            'list' => $list
        ]);
    }
}
