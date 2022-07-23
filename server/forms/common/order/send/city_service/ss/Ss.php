<?php

namespace app\forms\common\order\send\city_service\ss;

use app\forms\common\order\send\city_service\BaseCityService;

class Ss extends BaseCityService
{
    public function getDivers()
    {
        return 'ss';
    }

    public function getName()
    {
        return '闪送';
    }

    public function getConfig()
    {
        $cityService = $this->cityServiceForm->getCityService();
        $data = json_decode($cityService->data, true);
        return [
            'clientId' => $data['appkey'],
            'secret' => $data['appsecret'],
            'shopId' => $cityService->shop_no,
            'debug' => isset($data['is_debug']) && $data['is_debug'] ? true : false,
        ];
    }

    public function preOrderResult(array $result)
    {
    	$result = $result['data'];
        $result['fee'] = number_format($result['totalFeeAfterSave'] / 100, 2);

    	return $result;
    }
    
    public function addOrderResult(array $result)
    {
    	return $result;
    }

    public function preOrderData($data): array
    {
        $data['order_info']['is_direct_delivery'] = 1;

        $this->dealPos($data);
        $receiver = [
            "orderNo" => $data['shop_order_id'],
            "toAddress" => $data['receiver']['address'] ?? '',
            "toAddressDetail" => $data['receiver']['address_detail'],
            "toLatitude" => $data['receiver']['lat'],
            "toLongitude" => $data['receiver']['lng'],
            "toReceiverName" => $data['receiver']['name'],
            "toMobile" => $data['receiver']['phone'],
            "goodType" => $data['product_type'] ?: 10,
            "weight" => $data['cargo']['goods_weight'] > 1 ? ceil($data['cargo']['goods_weight']) : 1,
        ];

        $json = [
            "cityName" => $data['sender']['city'],
            "sender" => [
                "fromAddress" => $data['sender']['address'],
                "fromAddressDetail" => $data['sender']['address_detail'],
                "fromSenderName" => $data['sender']['name'],
                "fromMobile" => $data['sender']['phone'],
                "fromLatitude" => $data['sender']['lat'],
                "fromLongitude" => $data['sender']['lng'],
            ],
            "receiverList" => [
                $receiver,
            ],
            "appointType" => 0,
        ];

        // 测试模式下参数修改
        if ($this->cityServiceForm->getEnabledDebug()) {
            $json['cityName'] = '上海市';
        }

        return [
            'data' => json_encode($json, JSON_UNESCAPED_UNICODE),
        ];
    }

    public function addOrderData($cityPreviewOrder): array
    {
        $resultData = json_decode($cityPreviewOrder->result_data, true);
        $allOrderInfo = json_decode($cityPreviewOrder->all_order_info, true);
    	$array = [
            'issOrderNo' => $resultData['orderNumber'],
        ];

        return [
            'shop_order_id' => $allOrderInfo['shop_order_id'],
            'data' => json_encode($array, JSON_UNESCAPED_UNICODE),
        ];
    }

    public function handleNotify($cityPreviewOrder)
    {
        
    }

    public function handleNotifyData(array $data)
    {

    }
}
