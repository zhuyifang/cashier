<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/26
 * Time: 4:01 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\models;

class Order extends \app\models\Order
{
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
