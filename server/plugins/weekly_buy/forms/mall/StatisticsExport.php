<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/26
 * Time: 3:11 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\forms\mall\export\BaseExport;

class StatisticsExport extends BaseExport
{
    public function fieldsList()
    {
        return [
            [
                'key' => 'name',
                'value' => '商品名称',
            ],
            [
                'key' => 'goods_num',
                'value' => '支付件数',
            ],
            [
                'key' => 'total_price',
                'value' => '支付金额',
            ],
            [
                'key' => 'user_num',
                'value' => '支付人数',
            ],
            [
                'key' => 'week_number',
                'value' => '支付期数',
            ],
        ];
    }

    public function export($query = null)
    {
        $query = $this->query;

        $this->fieldsKeyList = array_column($this->fieldsList(), 'key');

        $this->exportAction($query, ['is_array' => true]);

        return true;
    }

    public function getFileName()
    {
        return '周期购统计';
    }

    protected function transform($list)
    {
        $this->dataList = array_map(function ($item) {
            return array_merge([
                'name' => $item['goods']['goodsWarehouse']['name']
            ], array_map(function ($value) {
                return is_numeric($value) ? floatval($value) : $value;
            }, $item));
        }, $list);
    }
}
