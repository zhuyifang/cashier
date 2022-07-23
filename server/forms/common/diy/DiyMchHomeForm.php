<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\diy;


use app\forms\common\CommonQrCode;
use app\forms\common\goods\CommonGoodsStatistic;
use app\forms\common\order\CommonOrderStatistic;
use app\models\Favorite;
use app\models\Model;
use app\models\Order;
use app\models\OrderComments;
use app\plugins\mch\Plugin;
use app\plugins\mch\models\Mch;
use yii\helpers\ArrayHelper;

class DiyMchHomeForm extends Model
{
    public function getData($mchId, $user)
    {
    	$data = [];
        $mch = Mch::find()->where(['id' => $mchId])->with('mchSetting', 'store', 'category')->one();

        if (!$mch) {
            throw new \Exception('商户不存在');
        }

        $data['mch'] = [
            'mch_id' => $mch->id,
            'name' => $mch->store->name,
            'mobile' => $mch->mobile,
            'service_mobile' => $mch->store->mobile,
            'longitude' => $mch->store->longitude,
            'latitude' => $mch->store->latitude,
            'cover_url' => $mch->store->cover_url,
            'pic_url' => json_decode($mch->store->pic_url, true),
            'address' => $mch->store->address,
            'description' => $mch->store->description,
            'scope' => $mch->store->scope,
            'category' => $mch->category->name,
            'is_web_service' => $mch->mchSetting->is_web_service,
            'web_service_url' => $mch->mchSetting->web_service_url,
            'web_service_pic' => $mch->mchSetting->web_service_pic,
            'service_type' => $mch->mchSetting->service_type,
        ];

        $extra = [];
        if ($mch->store->extra_attributes) {
            $extra = json_decode($mch->store->extra_attributes, true);
        }

        $qrCodeUrl = \Yii::$app->appPlatform . 'qr_code_url';
        $qrCodeBaseUrl = \Yii::$app->appPlatform . 'qr_code_base_url';
        $qrcodeUrl = isset($extra[$qrCodeUrl]) ? $extra[$qrCodeUrl] : '';
        $baseQrcodeUrl = isset($extra[$qrCodeBaseUrl]) ? $extra[$qrCodeBaseUrl] : '';
        if (!file_exists($baseQrcodeUrl)) {
            try {
                $commonQrCode = new CommonQrCode();
                $code = $commonQrCode->getQrCode(['mch_id' => $mch->id], 124, 'plugins/mch/shop/shop');
                $extra[$qrCodeUrl] = $code['file_path'];
                $extra[$qrCodeBaseUrl] = $commonQrCode->qrcode_save_path;
                $mch->store->extra_attributes = json_encode($extra);
                $res = $mch->store->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($mch->store));
                }

                $qrcodeUrl = $extra[$qrCodeUrl];
            }catch(\Exception $exception) {
                
            }
        }      
        $data['mch']['qr_code_url'] =  $qrcodeUrl;

        // 商户商品统计
        $form = new CommonGoodsStatistic();
        $form->mch_id = $mchId;
        $form->sign = (new Plugin())->getName();
        $res = $form->getAll(['goods_count']);
        $data['mch']['goods_count'] = $res['goods_count'];

        // 商户订单统计
        $form = new CommonOrderStatistic();
        $form->mch_id = $mchId;
        $form->sign = (new Plugin())->getName();
        $form->is_user = 1;
        $res = $form->getAll(['order_goods_count']);
        $data['mch']['order_goods_count'] = $res['order_goods_count'];

        $orderIds =Order::find()->andWhere(['mch_id' => $mchId])->select('id');
        $commentCount = OrderComments::find()->andWhere(['order_id' => $orderIds])->count();
        $data['mch']['comment_count'] = $commentCount;

        $favorite = Favorite::find()->andWhere(['mall_id' => \Yii::$app->mall->id, 'user_id' => $user->id, 'favorite_mch_id' => $mchId, 'is_delete' => 0])->one();

        $data['mch']['is_favorite'] = $favorite ? 1 : 0;

        return $data;
    }

    public function getNewData($data, $mch)
    {
        if ($data['service_type'] == 1 && $mch->mchSetting->is_web_service == 0) {
            $data['service_type'] = 2;
        }

        return $data;
    }
}
