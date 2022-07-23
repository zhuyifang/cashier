<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\diy\handlers;

use app\handlers\orderHandler\OrderCanceledHandlerClass;
use app\models\Model;
use app\plugins\diy\models\DiyForm;


class OrderCancelEventHandler extends OrderCanceledHandlerClass
{
    protected function cardResume()
    {
        // TODO
        return $this;
    }

    protected function sendTemplate()
    {
    	// TODO
        return $this;
    }

    protected function sendSmsToUser()
    {
        // TODO
        return $this;
    }

    /**
     * @param Order $order
     * @throws Exception
     */
    protected function goodsAddStock($order)
    {
        try {
            $diyForm = DiyForm::find()->andWhere(['order_no' => $order->order_no, 'is_pay' => 0])->one();
            $orderFormData = json_decode($diyForm->form_data, true);
            $orderButton = null;
            foreach ($orderFormData as $item) {
                if ($item['key'] == 'button') {
                    $orderButton = $item;
                }
            }
            $attrKey = $orderButton['value']['attr_key'];
            $num = $orderButton['value']['num'];

            $dbFormData = json_decode($diyForm->diyFormList->form_data, true);
            $dbButton = null;
            foreach ($dbFormData as &$item) {
                if ($item['id'] == 'button') {
                    // 多规格
                    if ($attrKey) {
                        foreach ($item['data']['pay_price_list'] as &$priceItem) {
                            if ($priceItem['key'] == $attrKey) {
                                $priceItem['stock_num'] += $num;
                            }
                        }
                    } else {
                        $item['data']['stock_num'] += $num;
                    }
                }
            }

            $diyForm->diyFormList->form_data = json_encode($dbFormData);
            $res = $diyForm->diyFormList->save();
            if (!$res) {
                throw new \Exception((new Model())->getErrorMsg($diyForm->diyFormList));
            }

        }catch(\Exception $exception) {
            \Yii::error('diy自定义表单库存退回异常');
            \Yii::error($exception);
        }
        return $this;
    }
}