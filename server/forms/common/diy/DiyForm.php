<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/3/26
 * Time: 4:21 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\diy;


use app\models\Model;

class DiyForm extends Model
{
    public static function getInstance()
    {
        return new self();
    }
}
