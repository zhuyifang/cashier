<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\city_service;

use app\models\CityService;
use app\models\Model;

class BaseCityService extends Model
{
    public $sf = 1; // 顺丰
    public $ss = 2; // 闪送
    public $mt = 3; // 美团
    public $dd = 4; // 达达
    public $mk = 5; // 同城速送
    public $uu = 6; // UU跑腿

    private $delivery_sf = 'SFTC';
    private $delivery_ss = 'SS';
    private $delivery_mtps = 'MTPS';
    private $delivery_dada = 'DADA';

    protected $platform;

    protected function getCorporationValueList()
    {
        return [
            $this->sf,
            $this->ss,
            $this->mt,
            $this->dd,
            $this->mk,
            $this->uu,
        ];
    }
    /**
     * 获取配送公司名称
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getCorporationName($value)
    {
        foreach ($this->getCorporationList() as $key => $item) {
            if ($value == $item['value']) {
                return $item['name'];
            }
        }
    }

    /**
     * 获取配送公司ID
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getDeliveryId($value)
    {
        foreach ($this->getCorporationList() as $key => $item) {
            if ($value == $item['value']) {
                return $item['delivery_id'];
            }
        }
    }

    /**
     * 获取配送公司信息
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getCorporation($value)
    {
        foreach ($this->getCorporationList() as $key => $item) {
            if ($value == $item['value']) {
                return $item;
            }
        }
    }

    protected function getCorporationList()
    {
        $url = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl;
        return [
            [
                'name' => '顺丰同城急送',
                'icon' => $url . '/statics/img/mall/city_service/sf.png',
                'value' => $this->sf,
                'delivery_id' => $this->delivery_sf,
                'default' => [
                    'id' => null,
                    'name' => '',
                    'plugin' => 'mall',
                    'distribution_corporation' => $this->sf,
                    'service_type' => '第三方',
                    'data' => [
                        'appkey' => '',
                        'appsecret' => '',
                        'product_type' => null,
                        'wx_product_type' => null,
                        'is_debug' => 1,
                        'shop_no' => '',
                    ],
                ],
                'goods_type' => [
                    ['value'=> 1, 'label'=> '快餐'],
                    ['value'=> 2, 'label'=> '送药'],
                    ['value'=> 3, 'label'=> '百货'],
                    ['value'=> 4, 'label'=> '脏衣服收'],
                    ['value'=> 5, 'label'=> '干净衣服派'],
                    ['value'=> 6, 'label'=> '生鲜'],
                    ['value'=> 7, 'label'=> '保单'],
                    ['value'=> 8, 'label'=> '高端饮品'],
                    ['value'=> 9, 'label'=> '现场勘验'],
                    ['value'=> 10, 'label'=> '快递'],
                    ['value'=> 12, 'label'=> '文件'],
                    ['value'=> 13, 'label'=> '蛋糕'],
                    ['value'=> 14, 'label'=> '鲜花'],
                    ['value'=> 15, 'label'=> '电子数码'],
                    ['value'=> 16, 'label'=> '服装鞋帽'],
                    ['value'=> 17, 'label'=> '汽车配件'],
                    ['value'=> 18, 'label'=> '珠宝'],
                    ['value'=> 20, 'label'=> '披萨'],
                    ['value'=> 21, 'label'=> '中餐'],
                    ['value'=> 22, 'label'=> '水产'],
                    ['value'=> 27, 'label'=> '专人直送'],
                    ['value'=> 32, 'label'=> '中端饮品'],
                    ['value'=> 33, 'label'=> '便利店'],
                    ['value'=> 34, 'label'=> '面包糕点'],
                    ['value'=> 35, 'label'=> '火锅'],
                    ['value'=> 36, 'label'=> '证照'],
                    ['value'=> 99, 'label'=> '其他'],
                ]
            ],
            [
                'name' => '闪送',
                'icon' => $url . '/statics/img/mall/city_service/ss.png',
                'value' => $this->ss,
                'delivery_id' => $this->delivery_ss,
                'default' => [
                    'id' => null,
                    'name' => '',
                    'plugin' => 'mall',
                    'distribution_corporation' => $this->ss,
                    'service_type' => '第三方',
                    'data' => [
                        'appkey' => '',
                        'app_secret' => '',
                        'shop_no' => '',
                        'product_type' => null,
                        'wx_product_type' => null,
                        'is_debug' => 1,
                        'good_type' => ''
                    ],
                ],
                'goods_type' => [
                    ['value'=> 1, 'label'=> '文件广告'],
                    ['value'=> 3, 'label'=> '电子产品'],
                    ['value'=> 5, 'label'=> '蛋糕'],
                    ['value'=> 6, 'label'=> '快餐水果'],
                    ['value'=> 7, 'label'=> '鲜花绿植'],
                    ['value'=> 8, 'label'=> '海鲜水产'],
                    ['value'=> 9, 'label'=> '汽车配件'],
                    ['value'=> 10, 'label'=> '其他'],
                    ['value'=> 11, 'label'=> '宠物'],
                    ['value'=> 12, 'label'=> '母婴'],
                    ['value'=> 13, 'label'=> '医药健康'],
                    ['value'=> 14, 'label'=> '教育'],
                ],
            ],
            [
                'name' => '美团配送',
                'icon' => $url . '/statics/img/mall/city_service/mt.png',
                'value' => $this->mt,
                'delivery_id' => $this->delivery_mtps,
                'default' => [
                    'id' => null,
                    'name' => '',
                    'plugin' => 'mall',
                    'distribution_corporation' => $this->mt,
                    'service_type' => '第三方',
                    'data' => [
                        'appkey' => '',
                        'appsecret' => '',
                        'is_debug' => 1,
                        'shop_no' => '',
                        'wx_product_type' => null,
                        'delivery_service_code' => null,
                        'pay_type_code' => 0
                    ],
                ],
            ],
            [
                'name' => '达达',
                'icon' => $url . '/statics/img/mall/city_service/dd.png',
                'value' => $this->dd,
                'delivery_id' => $this->delivery_dada,
                'default' => [
                    'id' => null,
                    'name' => '',
                    'plugin' => 'mall',
                    'distribution_corporation' => $this->dd,
                    'service_type' => '第三方',
                    'data' => [
                        'appkey' => '',
                        'appsecret' => '',
                        'product_type' => null,
                        'wx_product_type' => null,
                        'is_debug' => 1,
                        'shop_no' => '',
                        'shop_id' => '',
                    ],
                ],
                'goods_type' => [
                    ['value'=> 1, 'label'=> '食品小吃'],
                    ['value'=> 2, 'label'=> '饮料'],
                    ['value'=> 3, 'label'=> '鲜花'],
                    ['value'=> 8, 'label'=> '文印票务'],
                    ['value'=> 9, 'label'=> '便利店'],
                    ['value'=> 13, 'label'=> '水果生鲜'],
                    ['value'=> 19, 'label'=> '同城电商'],
                    ['value'=> 20, 'label'=> '医药'],
                    ['value'=> 21, 'label'=> '蛋糕'],
                    ['value'=> 24, 'label'=> '酒品'],
                    ['value'=> 25, 'label'=> '小商品市场'],
                    ['value'=> 26, 'label'=> '服装'],
                    ['value'=> 27, 'label'=> '汽修零配'],
                    ['value'=> 28, 'label'=> '数码'],
                    ['value'=> 29, 'label'=> '小龙虾'],
                    ['value'=> 51, 'label'=> '火锅'],
                    ['value'=> 5, 'label'=> '其他'],
                ]
            ],
        ];
    }
}
