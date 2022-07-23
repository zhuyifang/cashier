<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/7/9
 * Time: 2:08 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\center;

class CenterAuth extends BaseCenter
{
    public $centerVersion = '4.4.57';
    private $authInfo;

    public function getAuthInfo($refreshCache = false)
    {
        if ($this->authInfo) {
            return $this->authInfo;
        }
        $this->authInfo = $this->xHttpGet('/mall/site/info');
        return $this->authInfo;
    }
}
