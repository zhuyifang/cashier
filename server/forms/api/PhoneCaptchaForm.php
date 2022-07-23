<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/4/8
 * Time: 5:43 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\api;

use app\core\newsms\Sms;
use app\core\response\ApiCode;
use app\forms\common\CommonAppConfig;
use app\models\CoreValidateCode;
use app\models\Model;
use Overtrue\EasySms\Message;

class PhoneCaptchaForm extends Model
{
    public $mobile;

    public function rules()
    {
        return [
            [['mobile'], 'required'],
        ];
    }

    public function sendSmsCaptcha()
    {
        try {
            if (!$this->validate()) {
                throw new \Exception($this->getErrorMsg());
            }
            $code = '' . rand(100000, 999999);
            $smsConfig = CommonAppConfig::getSmsConfig();
            if (!$smsConfig
                || empty($smsConfig['status'])
                || $smsConfig['status'] == 0
                || empty($smsConfig['captcha']['template_id'])) {
                throw new \Exception('短信信息尚未配置');
            }
            $coreValidateCode = new CoreValidateCode();
            $coreValidateCode->target = $this->mobile;
            $coreValidateCode->code = $code;
            if (!$coreValidateCode->save()) {
                throw new \Exception($this->getErrorMsg($coreValidateCode));
            }
            \Yii::$app->sms->module(Sms::MODULE_MALL)->send($this->mobile, new Message([
                'content' => null,
                'template' => $smsConfig['captcha']['template_id'],
                'data' => [
                    $smsConfig['captcha']['template_variable'] => $code,
                ],
            ]));
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '短信验证码已发送。',
                'data' => [
                    'validate_code_id' => $coreValidateCode->id,
                ],
            ];
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
            ];
        }
    }
}
