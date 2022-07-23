<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/7 18:17
 */


namespace app\plugins\teller\controllers\web;

use app\models\Mall;
use app\models\StatisticsDataLog;
use app\models\StatisticsUserLog;
use app\models\User;
use app\models\We7App;
use app\plugins\Controller;
use app\plugins\teller\controllers\web\filter\LoginFilter;
use stdClass;
use yii\db\Exception;

class WebController extends Controller
{
    /**
     * @var Mall|mixed|object
     */
    public $mall;

    public function init()
    {

        $this->enableCsrfValidation = false;
        if (property_exists(\Yii::$app, 'appIsRunning') === false) {
            exit('property not found.');
        }
    }

    public $layout = '/main';

    public function login(): WebController
    {

        $headers = \Yii::$app->request->headers;
        $accessToken = empty($headers['x-access-token']) ? null : $headers['x-access-token'];

        if (!$accessToken) {
            $accessToken = \Yii::$app->user->identity->access_token;
        }

        //访问量记录
        $this->setVisits();
        if (\Yii::$app->user->identity) {
            return $this;
        }
        if (!$accessToken) {
            \Yii::$app->user->logout();
            return $this;
        }
        $user = User::findOne([
            'access_token' => $accessToken,
            'mall_id' => $this->mall->id,
            'is_delete' => 0,
        ]);


        if ($user) {
            \Yii::$app->user->login($user);
            //访问人数记录
            $this->setUserLog();
        } else {
            \Yii::$app->user->logout();
        }
        return $this;
    }

    public function setMall(): WebController
    {

        $acid = \Yii::$app->request->get('_acid');
        if ($acid && $acid > 0) {
            $we7app = We7App::findOne([
                'acid' => $acid,
                'is_delete' => 0,
            ]);
            $mallId = $we7app ? $we7app->mall_id : null;
        } else {
            $mallId = \Yii::$app->request->get('_mall_id');
        }

        if (!$mallId) {
            $mallId = \Yii::$app->getSessionMallId();
        }


        $mall = Mall::findOne([
            'id' => $mallId,
            'is_delete' => 0,
            'is_recycle' => 0,
        ]);
        $url = \Yii::$app->urlManager->createUrl('plugin/teller/web/passport/login');

        if (!$mall || ($mall->is_delete !== 0 || $mall->is_recycle !== 0)) {
            if (!\Yii::$app->request->isAjax) {
                return $this->redirect($url)->send();
            } else {
                throw new \Exception('发生错误');
            }
        }


        $newOptions = [];
        foreach ($mall['option'] as $item) {
            $newOptions[$item['key']] = $item['value'];
        }
        $mall->options = (object)$newOptions;

        \Yii::$app->setMall($mall);
        \Yii::$app->setMallId($mall->id);
        $this->mall = \Yii::$app->mall;


        return $this;
    }

    public function behaviors()
    {
        return [
            'loginFilter' => [
                'class' => LoginFilter::class,
                'safeRoutes' => [
                    'plugin/teller/web/passport/login',
                    'plugin/teller/web/passport/setting',
                ],
            ]
        ];
    }

    public function render($view, $params = [])
    {
        if (mb_stripos($view, '@') !== 0 && mb_stripos($view, '/') !== 0) {
            $view = '@app/plugins/' . $this->module->id . '/views/web/' . mb_strtolower($this->id) . '/' . $view;
        }
        return parent::render($view, $params);
    }

    private $second = 5;//记录间隔秒

    //记录访问数
    private function setVisits()
    {
        $data_log = StatisticsDataLog::find()
            ->andWhere(['and', ['mall_id' => $this->mall->id], ['like', 'created_at', date('Y-m-d')], ['key' => 'visits']])
            ->one();
        if (empty($data_log)) {
            $data_log = new StatisticsDataLog();
            $data_log->mall_id = $this->mall->id;
            $data_log->key = 'visits';
            $data_log->value = 1;
            $data_log->time_stamp = time();
            $data_log->save();
        } elseif (bcsub(time(), $data_log->time_stamp) > $this->second) {
            $data_log->updateCounters(['value' => 1]);
            $data_log->time_stamp = time();
            $data_log->save();
        }
    }

    //记录访客数
    private function setUserLog()
    {
        $user_log = StatisticsUserLog::find()
            ->andWhere(['mall_id' => $this->mall->id, 'user_id' => \Yii::$app->user->id, 'is_delete' => 0])
            ->andWhere(['like', 'created_at', date('Y-m-d')])
            ->one();
        if (empty($user_log)) {
            $user_log = new StatisticsUserLog();
            $user_log->mall_id = $this->mall->id;
            $user_log->user_id = \Yii::$app->user->id;
            $user_log->num = 1;
            $user_log->time_stamp = time();
            $user_log->save();
        } elseif (bcsub(time(), $user_log->time_stamp) > $this->second) {
            $user_log->updateCounters(['num' => 1]);
            $user_log->time_stamp = time();
            $user_log->save();
        }
    }
}
