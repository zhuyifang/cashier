<?php
/**
 * @copyright ©2019 浙江禾匠信息科技
 * Created by PhpStorm.
 * User: Andy - Wangjie
 * Date: 2019/9/29
 * Time: 16:43
 */

namespace app\plugins\advance\forms\mall;

use app\plugins\advance\models\AdvanceOrder;


class OrderExport extends \app\forms\mall\export\OrderExport
{
    public function getFileName()
    {
        return '预售订单-订单列表';
    }

    public function fieldsList()
    {
        $fieldsList = parent::fieldsList();

        $fieldsList[] = [
            'key' => 'deposit',
            'value' => '定金',
        ];

        return $fieldsList;
    }

    protected function setPluginData($item)
    {
    	$order = AdvanceOrder::findOne(['order_id' => $item->id]);
    	return [
    		'deposit' => $order ? $order->deposit : 0
    	];
    }
}
