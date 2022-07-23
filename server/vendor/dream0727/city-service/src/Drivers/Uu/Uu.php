<?php

namespace CityService\Drivers\Uu;

use CityService\AbstractCityService;
use CityService\CityServiceInterface;
use CityService\Drivers\Uu\Exceptions\UuException;
use CityService\Drivers\Uu\Response\UuResponse;
use CityService\Exceptions\HttpException;
use CityService\ResponseInterface;
use GuzzleHttp\Client;

class Uu extends AbstractCityService implements CityServiceInterface
{
    /**
     * 预创建订单
     * http://open.uupt.com/Doc/wordshow.html?code=getorderprice
     */
    public function preAddOrder(array $data = []): \CityService\ResponseInterface
    {
        $path = 'getorderprice.ashx';

        $result = $this->post($path, $data);

        return new UuResponse(json_decode($result, true));
    }

    /**
     * 创建订单
     * http://open.uupt.com/Doc/wordshow.html?code=addorder
     */
    public function addOrder(array $data = []): \CityService\ResponseInterface
    {
        $path = 'addorder.ashx';

        $result = $this->post($path, $data);

        return new UuResponse(json_decode($result, true));
    }

    /**
    * 取消订单
    * http://open.uupt.com/Doc/wordshow.html?code=cancelorder
    */
    public function cancelOrder(array $data = []): \CityService\ResponseInterface
    {
        $path = 'cancelorder.ashx';

        $result = $this->post($path, $data);

        return new UuResponse(json_decode($result, true));
    }

    /**
     * 模拟配送测试
     * https://peisong.meituan.com/open/doc#section3-2
     * @param  [type] $mockType [description]
     * @param  array  $data     [description]
     * @return [type]           [description]
     */
    public function mockUpdateOrder(array $data = [], array $params = []): \CityService\ResponseInterface
    {
        
    }

    private function post($path, array $data = [])
    {
        try {
            $client = new Client([
                'verify' => false,
                'timeout' => 30,
            ]);

            $url = $this->getConfig('base_url') . $path;

            return $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => $data,
            ])->getBody();

        } catch (GuzzleException $e) {
            throw new HttpException($e->getMessage());
        }
    }
}
