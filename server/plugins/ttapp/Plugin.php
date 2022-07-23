<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/8/2
 * Time: 9:37
 */

namespace app\plugins\ttapp;

use Alipay\AopClient;
use Alipay\Key\AlipayKeyPair;
use app\helpers\CurlHelper;
use app\helpers\PluginHelper;
use app\models\Model;
use app\models\PaymentOrder;
use app\plugins\ttapp\forms\Decrypt;
use app\plugins\ttapp\forms\OrderForm;
use app\plugins\ttapp\forms\TemplateInfo;
use app\plugins\ttapp\forms\TemplateSendForm;
use app\plugins\ttapp\forms\pay\NewTtPay;
use app\plugins\ttapp\forms\pay\TtPay;
use app\plugins\ttapp\handler\OrderSalesHandler;
use app\plugins\ttapp\jobs\OrderSettleJob;
use app\plugins\ttapp\models\Order;
use app\plugins\ttapp\models\TtappConfig;
use app\plugins\ttapp\models\TtappOrder;
use app\plugins\ttapp\models\TtappTemplate;

class Plugin extends \app\plugins\Plugin
{
    private $xTtPay;

    public function getMenus()
    {
        return [
            [
                'name' => '基础配置',
                'route' => 'plugin/ttapp/index/setting',
                'icon' => 'el-icon-setting',
            ],
//            [
//                'name' => '消息通知',
//                'route' => 'plugin/ttapp/template-msg/setting',
//                'icon' => 'el-icon-star-on',
//            ],
            [
                'name' => '分账结算',
                'route' => 'plugin/ttapp/index/order',
                'icon' => 'el-icon-setting',
            ],
            [
                'name' => '小程序发布',
                'route' => 'plugin/ttapp/index/package',
                'icon' => 'el-icon-setting',
            ],
        ];
    }

    public function getIndexRoute()
    {
        return 'plugin/ttapp/index/setting';
    }

    /**
     * 插件唯一id，小写英文开头，仅限小写英文、数字、下划线
     * @return string
     */
    public function getName()
    {
        return 'ttapp';
    }

    /**
     * 插件显示名称
     * @return string
     */
    public function getDisplayName()
    {
        return '抖音/头条小程序';
    }

    public function getIsPlatformPlugin()
    {
        return true;
    }

    /**
     * @return OrderSalesHandlerClass
     * 重改订单售后事件
     */
    public function getOrderSalesHandleClass()
    {
        return new OrderSalesHandler();
    }

    public function getTtPay()
    {
        if ($this->xTtPay) {
            return $this->xTtPay;
        }
        $ttappConfig = TtappConfig::findOne([
            'mall_id' => \Yii::$app->mall->id,
        ]);
        if (!$ttappConfig || !$ttappConfig->app_key || !$ttappConfig->app_secret || !$ttappConfig->salt) {
            throw new \Exception('头条小程序支付尚未配置。');
        }

        $config = [
            'app_id' => $ttappConfig->app_key,
            'salt' => $ttappConfig->salt,
        ];

        $this->xTtPay = new NewTtPay($config);
        return $this->xTtPay;
    }

    public function checkSign($params)
    {
        $config = TtappConfig::findOne(['mall_id' => \Yii::$app->mall->id]);
        $token = $config->token;
        $sign = $params['msg_signature'];

        unset($params["msg_signature"]);
        unset($params['type']);
        $paramArray = [];
        foreach ($params as $param) {
            if ($param) {
                $paramArray[] = trim($param);
            }
        }
        $paramArray[] = $token;
        \Yii::warning($paramArray);
        sort($paramArray,2);
        $signStr = trim(implode('', $paramArray));
        $newSign = sha1($signStr);

        return $sign == $newSign;
    }

    /**
     * 获取access_token
     * @return mixed
     * @throws \Exception
     * https://developer.toutiao.com/docs/server/auth/accessToken.html
     */
    public function getAccessToken()
    {
        $config = $this->getTtConfig();
        $cacheKey = 'TOUTIAO_APP_ACCESS_TOKEN_' . $config->app_key;
        $cacheDuration = 7000;
        $accessToken = \Yii::$app->cache->get($cacheKey);
        if ($accessToken) {
            return $accessToken;
        }
        $api = 'https://developer.toutiao.com/api/apps/token';
        $params = [
            'appid' => $config->app_key,
            'secret' => $config->app_secret,
            'grant_type' => 'client_credential',
        ];
        $url = $api . "?" . http_build_query($params);
        $data = CurlHelper::getInstance()->httpGet($url);
        \Yii::$app->cache->set($cacheKey, $data['access_token'], $cacheDuration);
        return $data['access_token'];
    }

    public function getTtConfig()
    {
        $config = $config = TtappConfig::findOne([
            'mall_id' => \Yii::$app->mall->id,
        ]);
        if (!$config  || !$config->app_key || !$config->app_secret) {
            throw new \Exception('小程序信息尚未配置。');
        }
        return $config;
    }

    public function decryptData($data, $iv, $code)
    {
        $config = $config = TtappConfig::findOne([
            'mall_id' => \Yii::$app->mall->id,
        ]);
        $params = [
            'appid' => $config->app_key,
            'secret' => $config->app_secret,
            'code' => $code,
        ];
        $url = "https://developer.toutiao.com/api/apps/jscode2session";
        $url = $url . "?" . http_build_query($params);
        $session_key = CurlHelper::getInstance()->httpGet($url);
        if ($session_key['error'] != 0) {
            throw new \Exception('获取session_key失败');
        }
        $content = json_decode(Decrypt::decrypt($data, $iv, $session_key['session_key']), true);
        return $content;
    }

    /**
     * @param string|array $param
     * @return array|\yii\db\ActiveRecord[]
     * 获取所有模板消息
     */
    public function getTemplateList($param = '*')
    {
        $list = TtappTemplate::find()->where(['mall_id' => \Yii::$app->mall->id])->select($param)->all();

        return $list;
    }

    /**
     * @param array $attributes
     * @return bool
     * @throws \Exception
     * 后台保存模板消息
     */
    public function addTemplateList($attributes)
    {
        foreach ($attributes as $item) {
            if (!isset($item['tpl_name'])) {
                throw new \Exception('缺少必要的参数tpl_name');
            }
            if (!isset($item[$item['tpl_name']])) {
                throw new \Exception("缺少必要的参数{$item['tpl_name']}");
            }
            $tpl = TtappTemplate::findOne(['mall_id' => \Yii::$app->mall->id, 'tpl_name' => $item['tpl_name']]);
            $tplId = $item[$item['tpl_name']];
            if ($tpl) {
                if ($tpl->tpl_id != $tplId) {
                    $tpl->tpl_id = $tplId;
                    if (!$tpl->save()) {
                        throw new \Exception((new Model())->getErrorMsg($tpl));
                    } else {
                        continue;
                    }
                } else {
                    continue;
                }
            } else {
                $tpl = new TtappTemplate();
                $tpl->mall_id = \Yii::$app->mall->id;
                $tpl->tpl_name = $item['tpl_name'];
                $tpl->tpl_id = $tplId;
                if (!$tpl->save()) {
                    throw new \Exception((new Model())->getErrorMsg($tpl));
                } else {
                    continue;
                }
            }
        }
        return true;
    }

    public function templateSender()
    {
        return new TemplateSendForm();
    }

    public function getHeaderNav()
    {
        return [
            'name' => $this->getDisplayName(),
            'url' => \Yii::$app->urlManager->createUrl([$this->getIndexRoute()]),
            'new_window' => true,
        ];
    }

    public function getNotSupport()
    {
        return [
            'navbar' => [
                '/plugins/step/index/index',
                '/plugins/scratch/index/index',
                '/pages/live/index',
                'plugin-private://wx2b03c6e691cd7370/pages/live-player-plugin',
                '/plugins/community/list/list',
                '/plugins/community/recruit/recruit',
                '/plugins/community/index/index',
            ],
            'home_nav' => [
                '/plugins/step/index/index',
                '/plugins/scratch/index/index',
                '/pages/live/index',
                'plugin-private://wx2b03c6e691cd7370/pages/live-player-plugin',
                '/plugins/community/list/list',
                '/plugins/community/recruit/recruit',
                '/plugins/community/index/index',
            ],
            'user_center' => [
                '/plugins/step/index/index',
                '/plugins/scratch/index/index',
                '/pages/live/index',
                'plugin-private://wx2b03c6e691cd7370/pages/live-player-plugin',
                '/plugins/community/list/list',
                '/plugins/community/recruit/recruit',
                '/plugins/community/index/index',
            ],
        ];
    }

    public function getTemplateData($type, $data)
    {
        return (new TemplateInfo($type, $data))->getData();
    }

    public function install()
    {
        $sql = <<<EOF
-- v1.0.5
CREATE TABLE `zjhj_bd_ttapp_jump_appid` ( `id` int(11) NOT NULL AUTO_INCREMENT, `mall_id` int(11) NOT NULL, `appid` varchar(64) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
EOF;
        sql_execute($sql);
        return parent::install();
    }

    // 获取平台图标
    public function getPlatformIconUrl()
    {
        return [
            [
                'key' => $this->getName(),
                'name' => $this->getDisplayName(),
                'icon' => PluginHelper::getPluginBaseAssetsUrl($this->getName()) . '/img/ttapp.png'
            ]
        ];
    }

    public function settle($ttOrder)
    {
        // 定时结算任务
        $settleTime = strtotime($ttOrder->created_at) + 7 * 24 * 60 * 60;
        $delay = time() > $settleTime ? 0 : ($settleTime - time());

        $queueId = \Yii::$app->queue->delay($delay)->push(new OrderSettleJob([
            'ttapp_order_id' => $ttOrder->id,
        ]));
    }

    // 保存需要分账的订单
    public function saveTtOrder($orderNo, $orderType)
    {
        try {
            $paymentOrder = PaymentOrder::find()->andWhere(['order_no' => $orderNo])->with('paymentOrderUnion')->one();
            if ($paymentOrder && $paymentOrder->paymentOrderUnion->platform == $this->getName() && $paymentOrder->pay_type == 6) {

                $mchId = 0;
                if ($orderType == 'order') {
                    $mchId = $paymentOrder->order->mch_id;
                }
                
                $ttOrder = new TtappOrder();
                $ttOrder->mall_id = $paymentOrder->paymentOrderUnion->mall_id;
                $ttOrder->mch_id = $mchId;
                $ttOrder->order_type = $orderType;
                $ttOrder->order_no = $paymentOrder->order_no;
                $ttOrder->out_settle_no = generate_order_no();
                $res = $ttOrder->save();

                if ($orderType != 'order') {
                    $this->settle($ttOrder);
                }
            }
        }catch(\Exception $exception) {
            \Yii::error('头条分账订单异常');
            \Yii::error($exception);
        }
    }
}
