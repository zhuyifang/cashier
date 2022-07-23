<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\plugins\mch\forms\api\diy;

use Grafika\Color;
use Grafika\Grafika;
use app\core\response\ApiCode;
use app\forms\api\poster\common\StyleGrafika;
use app\forms\api\poster\style\BaseStyle;
use app\forms\common\CommonQrCode;
use app\forms\common\goods\CommonGoodsStatistic;
use app\forms\common\order\CommonOrderStatistic;
use app\plugins\mch\Plugin;
use app\plugins\mch\models\Mch;

class MchPosterForm extends StyleGrafika implements BaseStyle
{
    public $mch_id;

    public $mWidth = 560;
    public $mHeight = 598;

    public function build()
    {
        try {
            $mch = Mch::find()->andWhere(['id' => $this->mch_id])->with('store')->one();

            $bg = \Yii::$app->basePath . '/web/statics/img/mall/mch/poster-bg.png';
            $headBg = \Yii::$app->basePath . '/web/statics/img/mall/mch/head-bg.png';
            $config = [
                $this->setBg($bg),
            ];

            $code = (new CommonQrCode())->getQrCode(['mch_id' => $mch->id], 124, 'plugins/mch/shop/shop');
            $config[] = $this->setImage($code['file_path'], 124 , 124, 94, 450);

            $picUrl = json_decode($mch->store->pic_url, true);
            if (is_array($picUrl) && count($picUrl) > 0) {
                $config[] = $this->setImage($picUrl[0]['pic_url'], $this->mWidth, 224, 0, 0);
            }

            $config[] = $this->setImage($headBg, 144, 144, ($this->mWidth / 2 - 72), 162);

            if ($mch->store->cover_url) {
                $config[] = $this->setImage($mch->store->cover_url, 114, 114, ($this->mWidth / 2 - 57), 177);
            }

            if ($mch->store->name) {
                $newConfig = $this->setText($mch->store->name, 0, 318, 32, '#333333');
                $arr = any2eucjp($newConfig['font'], 0, $this->font_path, $mch->store->name);
                $width = $arr[2] - $arr[0];
                $left = $this->mWidth / 2 - $width / 2;

                $newConfig['left'] = $left;
                $config[] = $newConfig;
            }

            // 商户商品统计
            $form = new CommonGoodsStatistic();
            $form->mch_id = $mch->id;
            $form->sign = (new Plugin())->getName();
            $res = $form->getAll(['goods_count']);
            $goodsCount = sprintf('商品：%s', $res['goods_count']);

            $gNewConfig = $this->setText($goodsCount, 0, 369, 24, '#999999');
            $gArr = any2eucjp($gNewConfig['font'], 0, $this->font_path, $goodsCount);
            $gWidth = $gArr[2] - $gArr[0];

            // 商户订单统计
            $form = new CommonOrderStatistic();
            $form->mch_id = $mch->id;
            $form->sign = (new Plugin())->getName();
            $form->is_user = 1;
            $res = $form->getAll(['order_goods_count']);
            $orderCount = sprintf('已售：%s', $res['order_goods_count']);

            $oNewConfig = $this->setText($orderCount, 0, 369, 24, '#999999');
            $oArr = any2eucjp($oNewConfig['font'], 0, $this->font_path, $orderCount);
            $oWidth = $oArr[2] - $oArr[0];
            
            $left = $this->mWidth / 2 - ($gWidth + $oWidth) / 2;
            
            $gNewConfig['left'] = $left - 15;
            $oNewConfig['left'] = $left + $gWidth + 15;
            $config[] = $gNewConfig;
            $config[] = $oNewConfig;

            $config[] = $this->setLine([24, 426], [$this->mWidth - 24, 426], '#EBEEF5');
            $config[] = $this->setText('长按识别小程序码', 242, 472, 28, '#333333');
            $config[] = $this->setText('查看更多精彩内容', 242, 518, 24, '#999999');

            $this->setFile($config);

            $poster = $this->getPoster($config);

            return $poster;
        } catch(\Exception $exception) {
            throw $exception;
        }
    }

    public function resizeExact(&$goods_qrcode)
    {
        $this->model->resizeExact($goods_qrcode, $this->mWidth, $this->mHeight);
    }

    public function extraSetting(&$goods_qrcode)
    {

    }
}