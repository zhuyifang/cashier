<?php


namespace app\forms\api\poster;

use app\forms\common\CommonOption;
use app\forms\common\grafika\GrafikaOption;
use app\models\Goods;
use app\models\Option;

class GoodsPosterForm extends GrafikaOption implements BasePoster
{
    public $goods_id;

    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
        ];
    }

    public function get()
    {
        $default = (new \app\forms\mall\poster\PosterForm())->getDefault()['goods'];
        $option = CommonOption::get(Option::NAME_POSTER, \Yii::$app->mall->id, Option::GROUP_APP)['goods'];
        $option = $this->optionDiff($option, $default);

        $goods = Goods::find()->where([
            'is_delete' => 0,
            'id' => $this->goods_id,
        ])->with(['goodsWarehouse', 'attr', 'mallGoods'])->one();
        if (!$goods) {
            throw new \Exception('商品不存在');
        }

        isset($option['pic']) && $option['pic']['file_path'] = $goods->goodsWarehouse->cover_pic;
        isset($option['desc']) && $option['desc']['text'] = self::autowrap($option['desc']['font'], 0, $this->font_path, $option['desc']['text'], $option['desc']['width']);
        isset($option['name']) && $option['name']['text'] = self::autowrap($option['name']['font'], 0, $this->font_path, $goods->goodsWarehouse->name, 750 - (float)$option['name']['left'] - 40, 2);
        isset($option['nickname']) && $option['nickname']['text'] = \Yii::$app->user->identity->nickname;

        if (isset($option['price'])) {
            $price = array_column($goods->attr, 'price');
            $price_str = $goods->mallGoods['is_negotiable'] ? \Yii::$app->mall->getMallSettingOne('negotiable_text') : (max($price) > min($price) ? '￥' . min($price) . '~' . max($price) : '￥' . min($price));
            $option['price']['text'] = $price_str;
        }

        if (isset($option['price']) && isset($option['name'])) {
            //自适应
            $nameSize = any2eucjp($option['name']['font'], 0, $this->font_path, $option['name']['text']);
            $nameHeight = $option['name']['top'] + $nameSize[1] - $nameSize[7];

            $priceSize = any2eucjp($option['price']['font'], 0, $this->font_path, $option['price']['text']);
            $priceHeight = $option['price']['top'] + $priceSize[1] - $priceSize[7];

            //compare
            if ($nameHeight > $option['price']['top'] && $priceHeight > $option['name']['top']) {
                $option['price']['top'] = $nameHeight + 25;
            }
        }

        $cache = $this->getCache($option);
        if ($cache) {
            return ['pic_url' => $cache . '?v=' . time()];
        }

        isset($option['qr_code']) && $option['qr_code']['file_path'] = self::qrcode($option, [
            ['id' => $goods->id, 'user_id' => \Yii::$app->user->id],
            240,
            'pages/goods/goods'
        ], $this);
        isset($option['head']) && $option['head']['file_path'] = self::head($this);

        $editor = $this->getPoster($option);
        return ['pic_url' => $editor->qrcode_url . '?v=' . time()];
    }
}