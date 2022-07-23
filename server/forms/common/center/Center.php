<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/7/7
 * Time: 2:52 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\center;

use app\core\cloud\Cloud;
use app\core\cloud\CloudException;
use app\core\cloud\CloudPlugin;
use app\core\cloud\CloudUpdate;
use app\core\cloud\CloudWxapp;
use yii\web\ForbiddenHttpException;

/**
 * Class Center
 * @package app\forms\common\center
 * 核心文件 如没有必要不要修改
 */
class Center extends Cloud
{
    public $centerVersion = '4.4.57';

    /** @var BaseCenter $auth */
    public $bdbase;

    /** @var CenterAuth $auth */
    public $bdauth;

    /** @var CloudPlugin $plugin */
    public $bdplugin;

    /** @var CloudUpdate $update */
    public $bdupdate;

    /** @var CloudWxapp $wxapp */
    public $bdwxapp;

    public function init()
    {
        parent::init();
        $this->bdbase = new BaseCenter();
        $this->bdauth = new CenterAuth();
        $this->bdplugin = new class extends CloudPlugin {

        };
        $this->bdupdate = new class extends CloudUpdate {

        };
        $this->bdwxapp = new class extends CloudWxapp {

        };
    }

    public function checkAuth($type = 'ip')
    {
        $checkPrefixList = [
            'mall/index', 'mall/index/index', 'admin/mall/create', 'mall/goods/edit',
            'mall/order/index', 'mall/order'
        ];
        $route = \Yii::$app->request->get('r', '');
        if ($route) {
            $route = trim(mb_strtolower(urldecode($route)), '/');
        }
        if (!in_array($route, $checkPrefixList)) {
            return true;
        }
        if ($type === 'ip') {
            $cacheKey = md5('CENTER_CHECK_IP_AUTH_CACHE_' . \Yii::$app->request->hostName);
            $cloudApi = '/mall/site/check-ip';
        } else {
            $cacheKey = md5('CENTER_CHECK_DOMAIN_AUTH_CACHE_' . \Yii::$app->request->hostName);
            $cloudApi = '/mall/site/check-domain';
        }
        $result = \Yii::$app->cache->get($cacheKey);
        if (!$result) {
            try {
                $cloudBase = new BaseCenter();
                $result = $cloudBase->xHttpGet($cloudApi);
                \Yii::$app->cache->set($cacheKey, $result, 60 * 60);
            } catch (CloudException $exception) {
                $result = $exception->raw;
                \Yii::$app->cache->set($cacheKey, $result, 10);
            }
        }
        if (isset($result['code']) && $result['code'] !== 0) {
            $msg = $result['msg'] ?? '检查服务器授权出错。';
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->data = [
                    'code' => 1,
                    'msg' => $msg
                ];
                return false;
            }
            throw new ForbiddenHttpException($msg);
        }
        return true;
    }
}
