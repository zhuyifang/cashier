<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/22
 * Time: 3:07 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\api\form;

use app\core\newsms\Sms;
use app\core\response\ApiCode;
use app\forms\common\CommonAppConfig;
use app\models\CoreValidateCode;
use app\models\Model;
use app\plugins\diy\models\DiyFormList;
use Overtrue\EasySms\Message;
use yii\helpers\Json;

class PhoneCaptchaForm extends Model
{
    public $mobile;
    public $form_id;
    public $index;

    public function rules()
    {
        return [
            [['mobile', 'form_id', 'index'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'mobile' => '手机号',
            'form_id' => '自定义表单id',
            'index' => '手机验证组件index'
        ];
    }

    public function sendSmsCaptcha()
    {
        try {
            if (!$this->validate()) {
                throw new \Exception($this->getErrorMsg());
            }

            $form = DiyFormList::findOne([
                'id' => $this->form_id,
                'is_delete' => 0,
                'mall_id' => \Yii::$app->mall->id
            ]);
            if (!$form) {
                throw new \Exception('自定义表单不存在');
            }
            $formData = Json::decode($form->form_data, true);

            $key = $this->mobile . '_' . \Yii::$app->mall->id . '_' . $this->form_id . '_' . $this->index;
            $count = \Yii::$app->cache->get($key) ?: 0;
            if (!isset($formData[$this->index])) {
                throw new \Exception('自定义表单有变更，刷新页面重试');
            }
            if ($formData[$this->index]['id'] != 'phone') {
                throw new \Exception('自定义表单有变更，刷新页面重试');
            }
            if ($count >= $formData[$this->index]['data']['error_limit']) {
                throw new \Exception('手机号发送次数已达上限，当天无法获取验证码');
            }

            $code = '' . rand(100000, 999999);
            $smsConfig = CommonAppConfig::getSmsConfig();
            if (
                !$smsConfig
                || empty($smsConfig['status'])
                || $smsConfig['status'] == 0
                || empty($smsConfig['captcha']['template_id'])
            ) {
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
            $count++;
            $time = strtotime(date('Y-m-d 23:59:59')) - time();
            \Yii::$app->cache->set($key, $count, $time);
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
