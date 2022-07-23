<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/11/1
 * Time: 15:58
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\api\share;


use app\core\response\ApiCode;
use app\forms\common\share\CommonShareLevel;
use app\models\Model;
use app\models\ShareLevel;
use app\models\User;

class ShareLevelForm extends Model
{
    /**
     * 获取升级条件
     */
    public function getLevelCondition()
    {
        try {
            /* @var User $user */
            $user = \Yii::$app->user->identity;
            if ($user->identity->is_distributor != 1) {
                throw new \Exception('用户不是分销商');
            }

            $list = ShareLevel::find()->andWhere(['>', 'level', $user->share->level])
                ->andWhere(['is_delete' => 0, 'status' => 1, 'mall_id' => \Yii::$app->mall->id, 'is_auto_level' => 1])
                ->all();
            $common = CommonShareLevel::getInstance();
            $config = $common->configWithCondition($user->share);
            $newList = [];
            /** @var ShareLevel[] $list */
            foreach ($list as $item) {
                $item = $common->changeV1($item);
                $newItem = $item->toArray();
                $newItem['condition_list'] = [];
                foreach ($config as $value) {
                    if (in_array($value['key'], $newItem['new_condition_type'])) {
                        $newItem['condition_list'][] = [
                            'key' => $value['name'],
                            'value' => $newItem[$value['value']],
                            'now' => $value['condition']
                        ];
                    }
                }
                $newList[] = $newItem;
            }
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '',
                'data' => [
                    'list' => $newList
                ]
            ];
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }
    }

    public function levelUp()
    {
        try {
            $commonShareLevel = CommonShareLevel::getInstance();
            $commonShareLevel->user = \Yii::$app->user->identity;
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '',
                'data' => $commonShareLevel->levelUp()
            ];
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }
    }
}
