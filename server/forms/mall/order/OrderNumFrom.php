<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/7/8
 * Time: 5:20 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\mall\order;

class OrderNumFrom extends BaseOrderForm
{
    public function getNumList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $numList = [];
        for ($i = 0; $i <= 10; $i++) {
            $this->status = $i;
            $numList[$i] = (int)$this->getAllQuery()->count();
        }
        return $this->success([
            'numList' => $numList
        ]);
    }
}
