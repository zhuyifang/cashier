<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: zbj
 */

namespace app\plugins\wholesale\controllers\api;


use app\core\response\ApiCode;

class ApiController extends \app\controllers\api\ApiController
{
    public function beforeAction($action)
    {
        //权限判断
        $permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
        if (!in_array('wholesale', $permission)) {
            \Yii::$app->response->data = ['code' => ApiCode::CODE_ERROR, 'msg' => '无商品批发权限'];
            return false;
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}
