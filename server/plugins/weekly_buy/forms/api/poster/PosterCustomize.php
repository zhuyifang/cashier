<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\plugins\weekly_buy\forms\api\poster;

use app\forms\api\poster\common\BaseConst;
use app\forms\api\poster\common\CommonFunc;
use app\models\Model;
use app\plugins\weekly_buy\forms\api\poster\parts\Price;

class PosterCustomize extends Model implements BaseConst
{
    use CommonFunc;

    public function traitQrcode($class)
    {
        return [
            ['goods_id' => $class->goods->id, 'user_id' => \Yii::$app->user->id],
            240,
            'plugins/weekly_buy/goods/goods',
        ];
    }

    public function traitPrice($model, $left, $top, $has_center, $color)
    {
        $priceModel = new Price($left, $top, $has_center, $color);
        return $priceModel->create($model->goods);
    }
}
