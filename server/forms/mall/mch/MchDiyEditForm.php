<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\mch;

use app\core\response\ApiCode;
use app\forms\common\CommonOption;
use app\models\Model;
use app\models\Option;

class MchDiyEditForm extends Model
{
    public $data;

    public function rules()
    {
        return [
            [['data'], 'required'],
            [['data'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $this->checkData();

            $res = CommonOption::set(Option::NAME_MCH_DIY, $this->data, \Yii::$app->mall->id, Option::GROUP_APP, \Yii::$app->user->identity->mch_id);


            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功'
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    private function checkData()
    {
        $this->data = json_decode($this->data, true);
        $mchShareCount = 0;
        foreach ($this->data['home'] as $key => $value) {
            if ($value['id'] == 'mch-share') {
                $mchShareCount += 1;
            }
        }

        if ($mchShareCount > 1) {
            throw new \Exception('分享浮窗组件最多添加一个');
        }
    }
}
