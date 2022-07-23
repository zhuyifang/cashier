<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/1/29
 * Time: 9:33
 */

namespace app\forms\common\share;


use app\helpers\Json;
use app\models\Model;
use app\models\ShareCash;
use app\models\ShareSetting;

class CommonShareConfig extends Model
{
    public static function config()
    {
        $time = strtotime(date('Y-m-d'));
        $config = ShareSetting::getDefaultList(\Yii::$app->mall->id);
        if (isset($config[ShareSetting::CASH_MAX_DAY]) && $config[ShareSetting::CASH_MAX_DAY] > -1) {
            $applyCash = ShareCash::find()
                ->where(['is_delete' => 0, 'mall_id' => \Yii::$app->mall->id, 'status' => [0, 1, 2]])
                ->andWhere(['>=', 'created_at', date('Y-m-d H:i:s', $time)])
                ->andWhere(['<=', 'created_at', date('Y-m-d H:i:s', $time + 86400)])
                ->sum('price');
            $surplusCash = $config[ShareSetting::CASH_MAX_DAY] - ($applyCash ? $applyCash : 0);
            $config['surplusCash'] = price_format(max($surplusCash, 0));
        }
        $config['last_cash_list'] = [];
        if (!\Yii::$app->user->isGuest) {
            $list = ShareCash::find()->alias('a')->select('a.type,a.extra,a.use_qrcode')
                ->where([
                    'a.mall_id' => \Yii::$app->mall->id,
                    'a.is_delete' => 0,
                    'a.user_id' => \Yii::$app->user->id
                ])->andWhere(['a.type' => ['wechat', 'alipay', 'bank']])
                ->leftJoin(
                    ['b' => ShareCash::tableName()],
                    'a.type=b.type and a.id < b.id and b.mall_id = :mall_id and b.user_id = :user_id',
                    [':mall_id' => \Yii::$app->mall->id, ':user_id' => \Yii::$app->user->id]
                )
                ->groupBy('a.type,a.extra,a.use_qrcode')
                ->having('count(b.id) < 1')
                ->all();
            foreach ($list as $item) {
                $item['extra'] = Json::decode($item['extra'], true);
                $config['last_cash_list'][$item['type']] = $item;
            }
        }

        return $config;
    }
}
