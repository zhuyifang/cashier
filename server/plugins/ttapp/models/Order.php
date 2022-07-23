<?php

namespace app\plugins\ttapp\models;

use Yii;
use app\models\Order as MallOrder;
use app\plugins\ttapp\models\TtappOrder;

class Order extends MallOrder
{
	public function getTtOrder()
	{
		return $this->hasOne(TtappOrder::className(), ['order_id' => 'id']);
	}
}
