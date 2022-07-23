<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2020 浙江禾匠信息科技有限公司
 * author: xay
 */

namespace app\plugins\diy\forms\api\form;


use app\core\response\ApiCode;
use app\forms\api\order\OrderSubmitForm;

class FormOrderSubmitForm extends OrderSubmitForm
{
    public function setPluginData()
    {
        $this->setSign((new Plugin())->getName());

        return $this;
    }
}