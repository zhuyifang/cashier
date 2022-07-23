<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/15
 * Time: 3:47 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\common\message;

use app\core\newsms\Sms;
use app\forms\common\CommonAppConfig;
use app\forms\common\CommonSms;
use Overtrue\EasySms\Message;

class MessageService extends \app\forms\common\message\MessageService
{
    /**
     * @var string 短信发送的id
     */
    public $template;

    public function sms()
    {
        $mobile = $this->user->mobile;
        $content = $this->content;
        if (!$mobile || empty($mobile)) {
            throw new \Exception('手机号不存在，无法发送');
        }
        if (is_string($mobile)) {
            $mobile = [$mobile];
        }
        if (!isset($content['mch_id'])) {
            $content['mch_id'] = 0;
        }
        $smsConfig = CommonAppConfig::getSmsConfig($content['mch_id']);
        if ($smsConfig['status'] != 1) {
            throw new \Exception('短信未配置');
        }
        if (!$this->check($smsConfig['allow_platform'])) {
            throw new \Exception('暂不支持发送短信');
        }
        $data = [];
        foreach ($mobile as $item) {
            \Yii::$app->sms->module(Sms::MODULE_MALL)->send($item, new Message([
                'content' => null,
                'template' => $this->template,
                'data' => $data,
            ]));
        }
        return true;
    }
}
