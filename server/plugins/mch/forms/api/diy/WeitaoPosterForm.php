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
use app\forms\common\grafika\CommonFunction;
use app\plugins\mch\models\Mch;
use app\plugins\mch\models\MchWeitao;

class WeitaoPosterForm extends StyleGrafika implements BaseStyle
{
    public $mch_id;
    public $id;

    public $mWidth = 560;
    public $mHeight = 643;
    public $weitao;

    public function build()
    {
        try {
            $mch = Mch::find()->andWhere(['id' => $this->mch_id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0])->with('store')->one();
            if (!$mch) {
                throw new \Exception('商户不存在');
            }
            $weitao = MchWeitao::find()->where(['id' => $this->id, 'mall_id' => \Yii::$app->mall->id, 'mch_id' => $this->mch_id, 'is_delete' => 0])->with('tag')->one();
            $this->weitao = $weitao;

            if (!$weitao) {
                throw new \Exception('微淘内容不存在');
            }

            $bg = \Yii::$app->basePath . '/web/statics/img/mall/mch/poster-bg.png';
            $config = [
                $this->setBg($bg),
            ];

            $code = (new CommonQrCode())->getQrCode(['mch_id' => $mch->id, 'id' => $this->id, 'user_id' => \Yii::$app->user->id], 124, 'plugins/mch/shop/weitao-detail');
            $config[] = $this->setImage($code['file_path'], 124 , 124, 94, 495);

            $newConfig = $this->setText($weitao->title, 0, 40, 28, '#333333');
            $arr = any2eucjp($newConfig['font'], 0, $this->font_path, $newConfig['text']);
            $commonFun = new CommonFunction();
            $newConfig['left'] = 24;
            $newConfig['text'] = $commonFun::autowrap($newConfig['font'], 0, $this->font_path, $newConfig['text'], 512, 2);
            $config[] = $newConfig;

            

            $readNumber = $weitao->read_number + $weitao->virtual_read_number;
            $readNumber = $readNumber > 100000 ? '10w+人浏览' : $readNumber . '人浏览';
            $config[] = $this->setText($readNumber, 24, 130, 28, '#999999');

            $newConfig = $this->setText('打开小程序阅读全文', 0, 380, 28, '#FF812D');
            $arr = any2eucjp($newConfig['font'], 0, $this->font_path, '打开小程序阅读全文');
            $width = $arr[2] - $arr[0];
            $left = $this->mWidth / 2 - $width / 2;
            $newConfig['left'] = $left;
            $config[] = $newConfig;

            $down = \Yii::$app->basePath . '/web/statics/img/mall/mch/down.png';
            $config[] = $this->setImage($down, 35, 35, ($this->mWidth / 2 - 17.5), 412);

            $picUrl = json_decode($weitao->pic_url, true);
            foreach ($picUrl as $key => $value) {
                if ($key == 0) {
                    $config[] = $this->setImage($value['pic_url'], 160, 160, 24, 190);
                }
                if ($key == 1) {
                    $config[] = $this->setImage($value['pic_url'], 160, 160, ($this->mWidth / 2 - 80), 190);
                }
                if ($key == 2) {
                    $config[] = $this->setImage($value['pic_url'], 160, 160, $this->mWidth - 24 - 160, 190);
                }
            }

            $config[] = $this->setLine([24, 471], [$this->mWidth - 24, 471], '#EBEEF5');
            $config[] = $this->setText('长按识别小程序码', 242, 517, 28, '#333333');
            $config[] = $this->setText('查看更多精彩内容', 242, 563, 24, '#999999');

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
        $tagName = $this->weitao->tag->name;
        $newConfig = $this->setText($tagName, 0, 130, 24, '#FFFFFF');
        $arr = any2eucjp($newConfig['font'], 0, $this->font_path, $tagName);
        $width = $arr[2] - $arr[0];
        $left = $this->mWidth - 40  - $width;
        $newConfig['left'] = $left;

        $extra = json_decode($this->weitao->tag->extra_attributes, true);
        $zWidth = $width + 32;
        $this->model->draw($goods_qrcode, Grafika::createDrawingObject('Rectangle', $zWidth, 36, [$this->mWidth - 24 - $zWidth, 119], 0, null, $extra['color']));

        $this->apiText($goods_qrcode
            , $newConfig['text']
            , $newConfig['font']
            , $newConfig['left']
            , $newConfig['top']
            , $newConfig['color']
            , $this->font_path
        );
    }
}