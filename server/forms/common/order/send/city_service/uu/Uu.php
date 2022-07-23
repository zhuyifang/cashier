<?php

namespace app\forms\common\order\send\city_service\uu;

use GuzzleHttp\Client;
use app\forms\common\order\send\city_service\BaseCityService;
use app\models\Order;

class Uu extends BaseCityService
{
    public function getDivers()
    {
        return 'uu';
    }

    public function getName()
    {
        return '同城速送';
    }

    public function getConfig()
    {
        $cityService = $this->cityServiceForm->getCityService();
        $data = json_decode($cityService->data, true);
        $isDebug = isset($data['is_debug']) && $data['is_debug'] ? true : false;
        $baseUrl = $isDebug ? 'http://openapi.test.uupt.com/v2_0/' : 'https://openapi.uupt.com/v2_0/';
        $notifyUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/msg-notify/uu.php';
        return [
            'appkey' => $data['appkey'],
            'appid' => $data['appid'],
            'openid' => $data['openid'],
            'base_url' => $baseUrl,
            'notify_url' => $notifyUrl,
            'pay_type' => $data['pay_type']
        ];
    }

    public function preOrderResult(array $result)
    {
    	$result['fee'] = number_format($result['need_paymoney'], 2);

    	return $result;
    }
    
    public function addOrderResult(array $result)
    {
    	return $result;
    }

    public function preOrderData($data): array
    {
        $this->dealPos($data);
        $data['sender']['lat'] = '30.27625';
        $data['sender']['log'] = '120.179487';
        $data['receiver']['lat'] = '30.161275';
        $data['receiver']['log'] = '120.272369';
        $data['receiver']['city'] = '杭州市';

        $data =  [
            'origin_id' => $data['shop_order_id'],
            'from_address' => $data['sender']['address'],
            'from_usernote' => $data['sender']['address_detail'],
            'to_address' => $data['receiver']['address'],
            'to_usernote' => $data['receiver']['address_detail'],
            'city_name' => $data['receiver']['city'],
            'subscribe_type' => 0,
            'send_type' => 0,
            'to_lat' => $data['receiver']['lat'],
            'to_lng' => $data['receiver']['lng'],
            'from_lat' => $data['sender']['lat'],
            'from_lng' => $data['sender']['lng'],
        ];

        return $this->addBaseParams($data);
    }

    public function cancelOrderData($data): array
    {
        return [];
    }

    public function addOrderData($cityPreviewOrder): array
    {
        $resultData = json_decode($cityPreviewOrder->result_data, true);
        $orderInfo = json_decode($cityPreviewOrder->all_order_info, true);
        $config = $this->getConfig();
        
        $data = [
            'price_token' => $resultData['price_token'], // 金额令牌
            'order_price' => $resultData['total_money'], // 订单金额
            'balance_paymoney' => $resultData['need_paymoney'], // 实际余额支付金额
            'receiver' => $orderInfo['receiver']['name'], // 收件人姓名
            'receiver_phone' => $orderInfo['receiver']['phone'], // 收件人手机号
            'note' => '',// 订单备注
            'callback_url' =>  $config['notify_url'],// 回调地址
            'push_type' =>  0,// 推送方式（0 开放订单，2测试订单）默认传0即可
            'special_type' =>  0,// 特殊处理类型，是否需要保温箱 1需要 0不需要
            'callme_withtake' =>  0,// 取件是否给我打电话 1需要 0不需要
            'pubusermobile' =>  $orderInfo['sender']['phone'],// 发件人电话
            'pay_type' =>  $config['pay_type'],// 支付方式：1=企业支付 0账户余额支付（企业余额不足自动转账户余额支付）
            'ordersource' =>  3,// 订单来源标示,示例（1=美团 2=饿了么 3=其他）
            // 'shortordernum' =>  0,// 订单平台短单号（0-10000），该单号会展示给骑手突出展示：“美团 #1”
        ];

    	return $this->addBaseParams($data);
    }

    public function handleNotify($cityPreviewOrder)
    {
        
    }

    public function handleNotifyData(array $data)
    {

    }


    private function addBaseParams($data)
    {
        $config = $this->getConfig();
        $data['nonce_str'] = $this->getrandstr(30);
        $data['timestamp'] = time();
        $data['openid'] = $config['openid'];
        $data['appid'] = $config['appid'];
        $data['sign'] = $this->makeSign($data);

        return $data;
    }

    /**
     * 生成签名
     * http://open.uupt.com/Doc/wordshow.html?code=sgintoken
     */
    private function makeSign($data)
    {
        $config = $this->getConfig();

        //1.升序排序
        ksort($data);

        //2.字符串拼接
        $args = "";
        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $args .= $args ? sprintf('&%s=%s', $key, $value) : sprintf('%s=%s', $key, $value); 
        }
        // 字符串尾部加上appkey
        $args = $args . '&key=' . $config['appkey'];
        // 所有字母转大写
        $args = strtoupper($args);
        // md5加密
        $sign = strtoupper(md5($args));

        return $sign;
    }

    /**
    * 随机字符串
    */
    private function getrandstr($length)
    {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $randStr = str_shuffle($str);// 打乱字符串
        $rands= substr($randStr, 0, $length);// 返回字符串的一部分

        return $rands;
    }
}
