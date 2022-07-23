<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\mch;

use app\core\response\ApiCode;
use app\forms\admin\mall\MallOverrunForm;
use app\forms\common\CommonOption;
use app\forms\common\diy\DiyMchHomeForm;
use app\forms\mall\mch\diy\CommonMchDiy;
use app\models\Model;
use app\models\Option;
use app\plugins\mch\forms\api\diy\IndexForm;
use app\plugins\mch\models\Mch;

class MchDiyForm extends Model
{
    public function rules()
    {
        return [];
    }

    public function attributeLabels()
    {
        return [];
    }

    public function search()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $default = (new CommonMchDiy())->getDefault();

            $data = CommonOption::get(
                Option::NAME_MCH_DIY,
                \Yii::$app->mall->id,
                Option::GROUP_APP,
                $default,
                \Yii::$app->user->identity->mch_id
            );

            foreach ($default['home'] as $key => $item) {
                foreach ($item['data'] as $dKey => $dItem) {
                    if (!isset($data['home'][$key]['data'][$dKey])) {
                        $data['home'][$key]['data'][$dKey] = $dItem;
                    }
                }
            }

            $defaultData = (new DiyMchHomeForm())->getData(\Yii::$app->user->identity->mch_id, \Yii::$app->user);
            $baseUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl;
            $defaultData['mch']['default_goods_image'] =  $baseUrl . '/statics/img/mall/mch/default-goods.png';
            $mch = Mch::findOne($defaultData['mch']['mch_id']);
            $defaultData['mch']['business_hours'] = (new IndexForm())->getBusinessHours($mch);
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'data' => $data,
                    'allComponents' => $this->allComponents(),
                    'overrun' => $this->getOverrun(),
                    'default_data' => [
                        'mch' => $defaultData['mch']
                    ]
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    private function getOverrun()
    {
        $overrun = (new MallOverrunForm())->getSetting();

        return $overrun;
    }

    private function allComponents()
    {
        $allComponents = (new CommonMchDiy())->getZsMenus();

        return $allComponents;
    }
}
