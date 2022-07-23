<?php

namespace app\forms\common\order\send\city_service;

use CityService\Factory;
use app\forms\common\order\send\city_service\CityServiceForm;
use app\forms\common\order\send\city_service\ModelInterface;
use app\forms\common\order\send\city_service\ResponseInterface;

abstract class BaseCityService implements ResponseInterface, ModelInterface
{
    public $cityServiceForm;

    public function __construct(CityServiceForm $cityServiceForm)
    {
        $this->cityServiceForm = $cityServiceForm;
    }

    /**
     * 腾讯地图---->百度地图
     * @param double $lat 纬度
     * @param double $lng 经度
     */
    protected function Convert_GCJ02_To_BD09($lat, $lng)
    {
        $x_pi = 3.14159265358979324 * 3000.0 / 180.0;
        $x = $lng;
        $y = $lat;
        $z = sqrt($x * $x + $y * $y) + 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) + 0.000003 * cos($x * $x_pi);
        $lng = $z * cos($theta) + 0.0065;
        $lat = $z * sin($theta) + 0.006;
        return array('lng' => $lng, 'lat' => $lat);
    }

    /**
     * 转换腾讯地图坐标为百度坐标
     * @param $data
     */
    protected function dealPos(&$data)
    {
        $receiverPos = $this->Convert_GCJ02_To_BD09($data['receiver']['lat'], $data['receiver']['lng']);
        $data['receiver']['lat'] = $receiverPos['lat'];
        $data['receiver']['lng'] = $receiverPos['lng'];
        $senderPos = $this->Convert_GCJ02_To_BD09($data['sender']['lat'], $data['sender']['lng']);
        $data['sender']['lat'] = $senderPos['lat'];
        $data['sender']['lng'] = $senderPos['lng'];
    }
}
