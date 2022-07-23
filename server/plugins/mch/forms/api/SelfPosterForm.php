<?php

namespace app\plugins\mch\forms\api;

use app\forms\common\CommonOption;
use app\forms\mall\poster\MchPosterForm;
use app\models\Model;
use app\models\Option;
use app\plugins\mch\models\Mch;
use Yii;
use yii\db\Exception;

class SelfPosterForm extends Model
{
    public $mch_id;
    public $pic_url;

    public function rules()
    {
        return [
            [['mch_id'], 'required'],
            [['mch_id'], 'number'],
            ['pic_url', 'string'],
        ];
    }

    public function getPoster()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $config = CommonOption::get(Option::NAME_MCH_POSTER, Yii::$app->mall->id, Option::GROUP_APP,  (new MchPosterForm())->get()['data']['config'], $this->mch_id);
        $config['card_pic'] = $this->pic_url;
        $m  = new SelfPosterModel();
        $m->config = $config;
        $m->mch = $this->getMch();
        return $this->success($m->build());
    }
    public function getMch(){
        $mch = Mch::find()->where([
            'id' => $this->mch_id,
            'is_delete' => 0,
            'review_status' => 1,
        ])->with('store')->asArray()->one();
        if (!$mch) {
            throw new \Exception('店铺不存在');
        }
        $mch['store']['pic_url'] = \Yii::$app->serializer->decode($mch['store']['pic_url']);
        return $mch;
    }
    public function config()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            {
                $config = CommonOption::get(Option::NAME_MCH_POSTER, Yii::$app->mall->id, Option::GROUP_APP, (new MchPosterForm())->get()['data']['config'], $this->mch_id);
                $config['card_pic'] = $config['card_pic'][array_rand($config['card_pic'])];
                $config['customize_poster'] = $this->getQrcode();
                $config['line_pic'] = 'DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/mch/poster/44.png';
            }
            return $this->success([
                'config' => $config,
                'mch' => $this->getMch(),
            ]);
        } catch (\Exception $e) {
            return $this->failByException($e);
        }
    }
    private function getQrcode()
    {
        switch (\Yii::$app->appPlatform) {
            case APP_PLATFORM_WXAPP:
                $qrcodeUrl = 'DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/poster/default_wxapp_qr_code.png';
                break;
            case APP_PLATFORM_ALIAPP:
                $qrcodeUrl = 'DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/poster/default_aliapp_qr_code.png';
                break;
            case APP_PLATFORM_TTAPP:
                $qrcodeUrl = 'DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/poster/default_ttapp_qr_code.png';
                break;
            case APP_PLATFORM_BDAPP:
                $qrcodeUrl = 'DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/poster/default_bdapp_qr_code.png';
                break;
            case APP_PLATFORM_MOBILE:
                $qrcodeUrl = 'DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/poster/default_mobile_qr_code.png';
                break;
            case APP_PLATFORM_WECHAT:
                $qrcodeUrl = 'DEFAULT_DOMAIN_NEW_MALL/web/statics/img/mall/poster/default_mobile_qr_code.png';
                break;
            default:
                $qrcodeUrl = '';
                break;
        }
        return $qrcodeUrl;
    }
}