<?php
/**
 * @copyright ©2019 浙江禾匠信息科技
 * Created by PhpStorm.
 * User: Andy - Wangjie
 * Date: 2019/5/31
 * Time: 14:02
 */

namespace app\controllers\api\master;

use app\core\response\ApiCode;
use app\models\Mall;
use app\forms\admin\mall\MallForm;
use app\plugins\teller\forms\mall\TellerSettingForm;

class MallController extends MasterController
{


    /**
     * @return array
     */
    public function actionIndex(): array
    {
        $query = Mall::find()->where([
            'is_recycle' => 0,
            'is_delete' => 0,
        ]);

        //未到期
        $query->andWhere([
            'or',
            ['=', 'expired_at', '0000-00-00 00:00:00'],
            ['>', 'expired_at', date('Y-m-d H:i:s')],
        ]);
        $user = \Yii::$app->user->identity;
        if ($user->identity->is_super_admin != 1) {
            $query->andWhere(['user_id' => $user->id,]);
        }
        $list = $query->orderBy('id DESC')
            ->asArray()
            ->all();
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => $list
        ];
    }

    public function actionSetting()
    {
        $form = new TellerSettingForm();
        return $this->asJson($form->getSetting());

    }
}
