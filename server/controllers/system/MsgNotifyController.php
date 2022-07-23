<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/16 16:11
 */

namespace app\controllers\system;

use app\controllers\Controller;
use app\forms\common\order\send\OrderCancelForm;
use app\forms\common\order\send\city_service\CityServiceForm;
use app\forms\common\order\send\city_service\mk\Mk;
use app\forms\common\wechat\WechatFactory;
use app\models\CityService;
use app\models\Mall;
use app\models\Model;
use app\models\OrderDetailExpress;
use app\models\UserPlatform;
use app\models\VideoNumber;
use luweiss\Wechat\WechatHelper;
use yii\helpers\Json;
use yii\web\Response;

class MsgNotifyController extends Controller
{
    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;
    }

    public function actionCityService()
    {
        \Yii::error('微信事件推送接口回调');
        if (isset($_GET['mall_id'])) {
            $mall = Mall::findOne($_GET['mall_id']);
            \Yii::$app->setMall($mall);
        }

        // 验签
        if (!$this->checkSignature()) {
            return 'success';
        }

        // 微信第一次配置时需校验
        if (isset($_GET["echostr"]) && $_GET["echostr"]) {
            return $_GET['echostr'];
        }

        // yii 框架方式处理方式 | php获取json数据方式 file_get_contents('php://input')
        $rawBody = \Yii::$app->request->rawBody;

        $xmlDataArray = $this->getXmlData($rawBody);
        $app = WechatFactory::create();

        if (isset($xmlDataArray['Event'])) {
            \Yii::error($xmlDataArray);
            switch ($xmlDataArray['Event']) {
                // 群发回调事件
                case 'MASSSENDJOBFINISH':
                    $this->updateSph($xmlDataArray);
                    break;
                // 用户关注事件
                case 'subscribe':
                    $res = UserPlatform::updateAll(['subscribe' => 1], ['platform_id' => $xmlDataArray['FromUserName']]);
                    \Yii::warning($res);
                    if ($messageArr = $app->subscribeReply($xmlDataArray)) {
                        \Yii::$app->response->format = Response::FORMAT_XML;
                        \Yii::warning(Json::encode($messageArr, JSON_UNESCAPED_UNICODE));
                        echo WechatHelper::arrayToXml($messageArr);
                        return 'success';
                    }
                    break;
                // 用户取消关注事件
                case 'unsubscribe':
                    $res = UserPlatform::updateAll(['subscribe' => 0], ['platform_id' => $xmlDataArray['FromUserName']]);
                    \Yii::warning($res);
                    break;
                // 自定义菜单点击事件
                case 'CLICK':
                    $res = $app->menuReply($xmlDataArray);
                    \Yii::warning($res);
                    break;
            }
        }

        $jsonDataArray = json_decode($rawBody, true);
        if (isset($jsonDataArray['Event'])) {
            \Yii::error($jsonDataArray);
            switch ($jsonDataArray['Event']) {
                // 同城配送推送事件
                case 'update_waybill_status':
                    $this->updateExpress($jsonDataArray);
                    break;
                // 自定义版交易组件类目审核回调
                case 'open_product_category_audit':
                    \app\plugins\minishop\forms\common\CommonRegister::getInstance()->eventChangeCatStatus([
                        'audit_id' => $jsonDataArray['audit_id'],
                        'status' => $jsonDataArray['status'],
                        'reject_reason' => $jsonDataArray['reject_reason'],
                        'audit_type' => $jsonDataArray['audit_type']
                    ]);
                    break;
                // 自定义版交易组件品牌审核回调
                case 'open_product_brand_audit':
                    \app\plugins\minishop\forms\common\CommonRegister::getInstance()->eventChangeBrandStatus([
                        'audit_id' => $jsonDataArray['audit_id'],
                        'status' => $jsonDataArray['status'],
                        'reject_reason' => $jsonDataArray['reject_reason'],
                        'audit_type' => $jsonDataArray['audit_type'],
                        'brand_id' => $jsonDataArray['brand_id']
                    ]);
                    break;
            }
        }
        if (isset($xmlDataArray['MsgType'])) {
            switch ($xmlDataArray['MsgType']) {
                case 'text':
                    $res = $app->keywordReply($xmlDataArray);
                    \Yii::warning($res);
                    break;
                default:
            }
        }

        return "success";
    }

    private function getXmlData($xml)
    {
        $obj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $data = json_decode(json_encode($obj), true);

        return $data;
    }

    private function checkSignature()
    {
        $signature = isset($_GET["signature"]) ? $_GET["signature"] : '';
        $timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : '';
        $nonce = isset($_GET["nonce"]) ? $_GET["nonce"] : '';

        if (!\Yii::$app->mall) {
            return false;
        }
        $config = WechatFactory::create()->getServer();
        if (!$config) {
            return false;
        }
        $token = $config['token'];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            \Yii::error('验签通过');
            return true;
        } else {
            \Yii::error('验签不通过');
            return false;
        }
    }

    // 更新视频号数据
    private function updateSph($data)
    {
        try {
            $videoNumber = VideoNumber::find()
                ->andWhere(['msg_id' => $data['MsgID']])
                ->andWhere(['>=', 'created_at', date('Y-m-d H:i:s', $data['CreateTime'] - 600)])
                ->andWhere(['<=', 'created_at', date('Y-m-d H:i:s', $data['CreateTime'] + 600)])
                ->one();

            if ($videoNumber) {
                $extraAttributes = json_decode($videoNumber->extra_attributes, true);
                $extraAttributes['event_result'] = $data;
                $videoNumber->extra_attributes = json_encode($extraAttributes);
                $videoNumber->status = $data['Status'];
                $videoNumber->save();
            }
        } catch (\Exception $exception) {
            \Yii::error('群发消息回调出错');
            \Yii::error($exception);
        }
    }

    // 更新快递小哥信息
    private function updateExpress($data)
    {
        try {
            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['shop_order_id']])->one();
            if ($express) {
                // 骑手接单
                if ($data['order_status'] == 102) {
                    $express->city_name = $data['agent']['name'];
                    $express->city_mobile = $data['agent']['phone'];
                }
                $cityInfo = json_decode($express->city_info, true);
                $cityInfo[$data['order_status']] = $data;
                $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
                $express->status = $data['order_status'];
                $res = $express->save();
                if (!$res) {
                    throw new \Exception((new Model)->getErrorMsg($express));
                }
            }
        } catch (\Exception $exception) {
            \Yii::error('同城配送回调出错');
            \Yii::error($exception);
        }
    }

    public function actionSf()
    {
        try {
            \Yii::warning('顺丰接口回调');
            $data = \Yii::$app->request->post();
            \Yii::warning($data);

            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['shop_order_id']])->one();
            if (!$express) {
                throw new \Exception('订单物流不存在');
            }

            $status = $data['order_status'];
            switch ($status) {
                case 10:
                    $status = 102;
                    $express->city_name = $data['operator_name'];
                    $express->city_mobile = $data['operator_phone'];
                    break;
                case 15:
                    $status = 202;
                    break;
                case 17:
                    $status = 302;
                    break;
                case 2 || 22:
                    $status = 502;
                    $form = new OrderCancelForm();
                    $form->id = $express->id;
                    $form->cancel();
                    break;
                default:
                    # code...
                    break;
            }

            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$status] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $status;
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

            return [
                'error_code' => 0,
                'error_msg' => 'success',
            ];
        } catch (\Exception $exception) {
            \Yii::error('顺丰同城配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    public function actionSs()
    {
        try {
            \Yii::warning('闪送接口回调');
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            \Yii::warning($data);

            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['orderNo']])->one();

            if (!$express) {
                throw new \Exception('订单物流不存在');
            }

            $status = $data['status'];
            switch ($status) {
                case 30:
                    $status = 102;
                    $express->city_name = $data['courier']['name'];
                    $express->city_mobile = $data['courier']['mobile'];
                    break;
                case 40:
                    $status = 202;
                    break;
                case 50:
                    $status = 302;
                    break;
                case 60:
                    $status = 502;
                    $form = new OrderCancelForm();
                    $form->id = $express->id;
                    $form->cancel();
                    break;
                default:
                    # code...
                    break;
            }

            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$status] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $status;
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

            return 'success';
        } catch (\Exception $exception) {
            \Yii::error('闪送同城配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    // 达达接口回调
    public function actionDadaCityService()
    {
        try {
            \Yii::warning('达达接口回调');
            $data = json_decode(\Yii::$app->request->rawBody, true);
            \Yii::warning($data);

            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['order_id']])->one();
            if (!$express) {
                throw new \Exception('订单物流不存在');
            }

            $status = $data['order_status'];
            switch ($status) {
                case 2:
                    $status = 102;
                    $express->city_name = $data['dm_name'];
                    $express->city_mobile = $data['dm_mobile'];
                    break;
                case 3:
                    $status = 202;
                    break;
                case 4:
                    $status = 302;
                    break;
                case 5:
                    $status = 502;
                    $form = new OrderCancelForm();
                    $form->id = $express->id;
                    $form->cancel();
                    break;
                default:
                    # code...
                    break;
            }

            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$status] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $status;
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

            return "success";
        } catch (\Exception $exception) {
            \Yii::error('达达配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    // 美团接口回调
    public function actionMtCityService()
    {
        try {
            \Yii::warning('美团接口回调');
            $data = \Yii::$app->request->post();
            \Yii::warning($data);

            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['order_id']])->one();

            if (!$express) {
                throw new \Exception('订单物流不存在');
            }

            $status = $data['status'];
            switch ($status) {
                case 20:
                    $status = 102;
                    $express->city_name = $data['courier_name'];
                    $express->city_mobile = $data['courier_phone'];
                    break;
                case 30:
                    $status = 202;
                    break;
                case 50:
                    $status = 302;
                    break;
                case 99:
                    $status = 502;
                    $form = new OrderCancelForm();
                    $form->id = $express->id;
                    $form->cancel();
                    break;
                default:
                    # code...
                    break;
            }

            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$status] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $status;
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

            return "success";
        } catch (\Exception $exception) {
            \Yii::error('美团配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    public function actionMk()
    {
        try {
            \Yii::warning('同城速送接口回调');
            $data = json_decode(\Yii::$app->request->rawBody, true);
            \Yii::warning($data);

            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['order_no']])->one();

            if (!$express) {
                throw new \Exception('物流订单不存在');
            }

            $cityService = CityService::findOne($express->city_service_id);
            if (!$cityService) {
                throw new \Exception('同城速送同城配送配置不存在');
            }

            $cityServiceForm =  new CityServiceForm($cityService);
            $model = $cityServiceForm->getModel();
            $config = $model->getConfig();


            $result = $cityServiceForm->getInstance()->getOrder([
                'token' => $config['token'],
                'order_num' => $data['order_no']
            ]);

            if (!$result->isSuccessful()) {
                throw new \Exception($result->getMessage());
            }

            $res = $result->getOriginalData();
            if ($res['error_code'] != 0) {
                throw new \Exception($res['msg']);
            }

            $status = $data['status'];

            switch ($status) {
                case 'accepted':
                    $status = 102;
                    $express->city_name = $data['rider_name'];
                    $express->city_mobile = $data['rider_mobile'];
                    break;
                case 'geted':
                    $status = 202;
                    break;
                case 'gotoed':
                    $status = 302;
                    break;
                case 'cancel':
                    $status = 502;
                    $form = new OrderCancelForm();
                    $form->id = $express->id;
                    $form->cancel();
                    break;
                default:
                    $status = 444;
                    break;
            }
            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$status] = $res;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $status;
            $res = $express->save();

            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

            return 'success';
        }catch(\Exception $exception) {
            \Yii::error($exception);
        }
    }

    public function actionUu()
    {
        try {
            \Yii::warning('uu跑腿接口回调');
            $data = json_decode(\Yii::$app->request->post('data'), true);
            \Yii::warning($data);

            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['order_code']])
                ->one();

            if (!$express) {
                throw new \Exception('订单物流不存在');
            }

            $status = $data['state'];
            switch ($data['state']) {
                case 3:
                    $status = 102;
                    $express->city_name = $data['driver_name'];
                    $express->city_mobile = $data['driver_mobile'];
                    break;
                case 5:
                    $status = 202;
                    break;
                case 10:
                    $status = 302;
                    break;
                case -1:
                    $status = 502;
                    $form = new OrderCancelForm();
                    $form->id = $express->id;
                    $form->cancel();
                    break;
                default:
                    # code...
                    break;
            }

            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$status] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $status;
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }
            
            return 'success';
        }catch(\Exception $exception) {
            \Yii::error($exception);
        }
    }
}
