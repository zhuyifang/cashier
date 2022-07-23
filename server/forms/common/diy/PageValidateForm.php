<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/19
 * Time: 9:29 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\diy;

use app\models\Model;

class PageValidateForm extends Model
{
    /**
     * @param $data
     * @throws \Exception
     * 校验倒计时组件
     */
    public function checkTimer($data)
    {
        if ($data['data']) {
            $name = '倒计时组件 ';
            if (!$data['data']['startDateTime']) {
                throw new \Exception($name. '开始时间必填');
            }

            if (!$data['data']['endDateTime']) {
                throw new \Exception($name. '结束时间必填');
            }

            if (strtotime($data['data']['startDateTime']) > strtotime($data['data']['endDateTime'])) {
                throw new \Exception($name. '开始时间不能大于结束时间');
            }
        }
    }
}
