<?php

namespace app\plugins\ttapp\forms\pay;

use GuzzleHttp\Client;

class NewTtPay {
	private $salt;
	private $app_id;
	private $valid_time = 3600;

	public function __construct(array $config)
	{
		$this->app_id = $config['app_id'];
		$this->salt = $config['salt'];
	}

	// 预下单
	public function createOrder($params)
	{
		$url = 'https://developer.toutiao.com/api/apps/ecpay/v1/create_order';
		return $this->post($url, $params);
	}

	// 退款
	public function refund($params)
	{
		$url = 'https://developer.toutiao.com/api/apps/ecpay/v1/create_refund';
		return $this->post($url, $params);
	}

	public function settle($params)
	{
		$url = 'https://developer.toutiao.com/api/apps/ecpay/v1/settle';
		return $this->post($url, $params);
	}

	public function querySettle($params)
	{
		$url = 'https://developer.toutiao.com/api/apps/ecpay/v1/query_settle';
		return $this->post($url, $params);
	}

	private function post($url, $body = array())
    {
    	$body['app_id'] = $this->app_id;
    	$body['valid_time'] = $this->valid_time;
    	$body['sign'] = $this->getSign($body);

        $response = $this->getClient()->post($url, [
            'body' => json_encode($body, JSON_UNESCAPED_UNICODE),
        ]);

        $data = $response->getBody()->getContents();

        return json_decode($data, true);
    }

    private function getClient()
    {
        return new Client([
            'verify' => false,
            'Content-Type' => 'application/json; charset=UTF-8',
        ]);
    }

    /**
	 * 计算签名
	 */
	private function getSign($params)
	{
		$params['salt'] = $this->salt;
		$params['valid_time'] = $this->valid_time;

		unset($params["sign"]);
		unset($params["app_id"]);
		unset($params["thirdparty_id"]);
		$paramArray = [];
		foreach ($params as $param) {
			$paramArray[] = trim($param);
		}
		sort($paramArray,2);
		$signStr = trim(implode('&', $paramArray));
		return md5($signStr);
	}
}