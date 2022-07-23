<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/28
 * Time: 3:19 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\scrm\forms\common;

use app\forms\common\coupon\UserCouponData;

class ScrmUserCouponData extends UserCouponData
{
    public function save()
    {
        if ($this->check($this->coupon)) {
            $this->coupon->updateCount(1, 'sub');
        }
        $userCouponCenter = new UserCouponAuto();
        $userCouponCenter->user_coupon_id = $this->userCoupon->id;
        $userCouponCenter->auto_coupon_id = $this->autoSend->id;
        return $userCouponCenter->save();
    }
}
