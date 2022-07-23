<?php

namespace app\plugins\mch\forms\api;

use app\forms\api\poster\common\StyleGrafika;
use app\forms\api\poster\parts\Arc;
use app\forms\api\poster\style\BaseStyle;
use app\forms\api\poster\style\TraitStyle;
use app\forms\common\CommonQrCode;
use Grafika\Color;
use Grafika\Grafika;
use Yii;

class SelfPosterModel extends StyleGrafika implements BaseStyle
{
    use TraitStyle;

    public $config;
    public $mch;

    private $reverseArr = [];
    private $posterCode = ['left' => 0, 'top' => 0];

    public function build()
    {
        $this->getBg()->getCard();
        $this->endBg($this->getCode($this->shopInfo()));
        $this->poster_arr = array_merge($this->poster_arr, array_reverse($this->reverseArr));

        if ($file = $this->setFile($this->taskHash())) {
                return ['pic_url' => $file . '?v=' . time()];
        }
        $this->getDrawing();
        $editor = $this->getPoster($this->poster_arr);
        return ['pic_url' => $editor->qrcode_url];
    }

    public function getCard(): SelfPosterModel
    {
        $arc= new Arc();
        $arc->angle = ['left-top','right-top'];
        $this->config['is_card'] == 1 && array_push($this->poster_arr, $this->setImage($arc->drawImage(self::saveTempImage($this->config['card_pic']), 32), 654, 654, 48, 174));
        return $this;
    }

    public function getBg()
    {
        $config = $this->config;
        if ($config["bg_default"] === 'color') {
            $dest_path = "./temp/" . uniqid('r', true) . '.png';
            $rgb = array_values(hex2rgb($config["bg_color"]));
            $bgPic = @imagecreate(750, 1334) or die("创建图像资源失败");
            imagecolorallocate($bgPic, ...$rgb);
            imagepng($bgPic, $dest_path);
            array_push($this->destroy_list, $dest_path);
            $this->poster_arr = [$this->setBg($dest_path)];
        } else {
            $this->poster_arr = [$this->setBg($config['card_pic'])];
        }
        return $this;
    }

    public function endBg($height)
    {
        $bg = Yii::$app->basePath . '/web/statics/img/mall/mch/poster/43.png';
        array_push($this->reverseArr,
            $this->setImage($bg, 654, max(100, $height - 792), 48, 792)
        );
    }

    public function getCode($top)
    {
        $top = max($top, 792);

        $titleSize = 32;
        $t = any2eucjp($titleSize / self::FONT_FORMAT, 0, $this->font_path, $this->config['code_title']);
        $t_height = abs($t[7] - $t[1]);
        $t_width = abs($t[2] - $t[0]);

        $subTitleSize = 24;
        $s = any2eucjp($subTitleSize / self::FONT_FORMAT, 0, $this->font_path, $this->config['code_sub_title']);
        $s_height = abs($s[7] - $s[1]);
        $s_width = abs($s[2] - $s[0]);

        if ($this->config['code_pos'] === 'left' || $this->config['code_pos'] === 'right') {
            $leftHeight = $t_height + $s_height + $this->config['code_title_padding'] + 40;
            $rightHeight = $this->config['code_size'] + 40;
            $commonHeight = max($leftHeight, $rightHeight);

            if ($this->config['code_pos'] === 'left') {
                $this->posterCode = [
                    'left' => 750 - 48 - 30 - $this->config['code_size'],
                    'top' => $top + ($commonHeight - $this->config['code_size']) / 2
                ];
                array_push($this->reverseArr,
                    $this->setText($this->config['code_title'], 48 + 30, $top + ($commonHeight - $this->config['code_title_padding']) / 2 - $t_height, $titleSize, '#000000'),
                    $this->setText($this->config['code_sub_title'], 48 + 30, $top + ($commonHeight - $this->config['code_title_padding']) / 2 + $this->config['code_title_padding'], $subTitleSize, '#999999')
                );
            } else {
                $this->posterCode = [
                    'left' => 48 + 30,
                    'top' => $top + ($commonHeight - $this->config['code_size']) / 2
                ];
                array_push($this->reverseArr,
                    $this->setText($this->config['code_title'], 48 + 30 + $this->config['code_size'] + 20, $top + ($commonHeight - $this->config['code_title_padding']) / 2 - $t_height, $titleSize, '#000000'),
                    $this->setText($this->config['code_sub_title'], 48 + 30 + $this->config['code_size'] + 20, $top + ($commonHeight - $this->config['code_title_padding']) / 2 + $this->config['code_title_padding'], $subTitleSize, '#999999')
                );
            }
            return $commonHeight + $top;
        }

        if ($this->config['code_pos'] === 'center') {
            $this->posterCode = [
                'left' => (750 - $this->config['code_size']) / 2,
                'top' => $top + 20
            ];
            array_push($this->reverseArr,
                $this->setText($this->config['code_title'], (750 - $t_width) / 2, $top + 20 + $this->config['code_size'] + 20, $titleSize, '#000000'),
                $this->setText($this->config['code_sub_title'], (750 - $s_width) / 2, $top + 20 + $this->config['code_size'] + 20 + $t_height + 20, $subTitleSize, '#999999')
            );
            return $top + 20 + $this->config['code_size'] + 20 + $t_height + 20 + $s_height + 20;
        }
    }

    public function shopInfo()
    {
        $top = 174;
        if ($this->config['is_shop']) {
            $top += $this->config['shop_info_top'];
            if ($this->config['logo_show'] == 1) {
                $mchPic = $this->mch['store']['cover_url'];
                array_push($this->reverseArr,
                    $this->setImage(self::avatar(self::saveTempImage($mchPic),$this->temp_path), 140, 140, (750 - 140) / 2, (152 - 140) / 2 + $top),
                    $this->setImage(Yii::$app->basePath . '/web/statics/img/mall/mch/poster/yuan.png', 152, 152, (750 - 152) / 2, $top)
                );
                $top += 140 + 20;
            }
            if ($this->config['shop_name_show'] == 1) {
                $mchName = $this->mch['store']['name'];
                $fontSize = 36;
                $after_text = self::autowrap($fontSize / self::FONT_FORMAT, 0, $this->font_path, $mchName, 620, 1);
                $t = any2eucjp($fontSize / self::FONT_FORMAT, 0, $this->font_path, $after_text);
                $t_width = abs($t[2] - $t[0]);
                array_push($this->reverseArr,
                    $this->setText($after_text, (750 - $t_width) / 2, $top += 24, $fontSize, '#333333')
                );
                $top += 24;
            }
            $line = Yii::$app->basePath . '/web/statics/img/mall/mch/poster/44.png';

            array_push($this->reverseArr,
                $this->setImage($line, 594, 48, (750 - 594) / 2, $top)
            );
            $top += 48;
        }
        return $top;
    }

    protected function taskHash()
    {
        return array_merge(['mch_id' => $this->mch['id'], $this->poster_arr]);
    }

    protected function getDrawing()
    {
        array_push($this->poster_arr
            , $this->setImage($this->takeQrcode($this), $this->config['code_size'], $this->config['code_size'], $this->posterCode['left'], $this->posterCode['top'])
        );
        return $this;
    }

    protected function takeQrcode($class)
    {
        if (($params = $this->selectPlugin('traitQrcode')) === false) {
            $params = [
                ['mch_id' => $this->mch['id'], 'user_id' => Yii::$app->user->id],
                240,
                'plugins/mch/shop/shop'
            ];
        }

        $code = (new CommonQrCode())->getQrCode($params[0], $params[1], $params[2]);
        //转本地读取 无后缀
        $path = parse_url($code['file_path'])['path'];
        $arr = explode('/', $path);
        $code_path = Yii::$app->basePath . '/web/temp/' . end($arr);
        //$code_path = self::saveTempImage($code['file_path']);
        if (Yii::$app->appPlatform === APP_PLATFORM_WXAPP) {
            $code_path = self::wechatCode($code_path, $class->temp_path, 10);
        }
        return $class->destroyList($code_path);
    }

    //速度测试
    public function getPoster(array $option)
    {
        /** var $goods_qrcode */
        foreach ($option as $item) {
            if (!isset($item['file_type'])) {
                throw new \Exception('格式错误');
            }

            if ($item['file_type'] === self::TYPE_BG) {
                if ($this->isUrl($item['image_url'])) {
                    $item['image_url'] = self::saveTempImage($this->destroyList($item['image_url']));
                }
                $this->model->open($goods_qrcode, $item['image_url']);
                $this->resizeExact($goods_qrcode);
                if($this->config['bg_default'] === 'image'){

                    $filter = Grafika::createFilter('Blur', 40); // Apply a blur of 10. Possible values 1-100
                    $this->model->apply( $goods_qrcode, $filter );
                }
            }

            if ($item['file_type'] === self::TYPE_IMAGE) {
                if (array_key_exists('size', $item)) {
                }
                if ($this->isUrl($item['image_url'])) {
                    $item['image_url'] = self::saveTempImage($this->destroyList($item['image_url']));
                }
                $this->apiBlend($goods_qrcode
                    , $xx
                    , $item['image_url']
                    , $item['width']
                    , $item['height']
                    , 'normal'
                    , 1
                    , 'top-left'
                    , $item['left']
                    , $item['top']
                    , $item['mode']
                );
            }
            if ($item['file_type'] === self::TYPE_TEXT) {
                $this->apiText($goods_qrcode
                    , $item['text']
                    , $item['font']
                    , $item['left']
                    , $item['top']
                    , $item['color']
                    , $item['font_path'] ?? ''
                );
            };
            if ($item['file_type'] === self::TYPE_LINE) {
                $this->model->draw($goods_qrcode, Grafika::createDrawingObject('Line'
                    , array($item['start_x'], $item['start_y'])
                    , array($item['end_x'], $item['start_y'])
                    , $item['height']
                    , new Color($item['color'])
                ));
            };
            if ($item['file_type'] === self::TYPE_ELLIPSE) {
                $this->model->draw($goods_qrcode, Grafika::createDrawingObject('Ellipse'
                    , $item['width']
                    , $item['height']
                    , array($item['left']
                    , $item['top'])
                    , 0
                    , null
                    , new Color($item['color'])
                ));
            };
            if ($item['file_type'] === self::TYPE_RECTANGLE) {
                //radius
                $this->model->draw($goods_qrcode, Grafika::createDrawingObject('Rectangle'
                    , $item['width']
                    , $item['height']
                    , array($item['left']
                    , $item['top'])
                    , 0
                    , null
                    , new Color($item['color'])
                ));
            }
        }
        $this->extraSetting($goods_qrcode);
        $this->apiSave($goods_qrcode);
        return $this;
    }

}