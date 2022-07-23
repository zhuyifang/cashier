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
use app\plugins\mch\models\MchTags;

class MchTagEditForm extends Model
{
    public $id;
    public $name;
    public $status;
    public $sort;
    public $extra_attributes;

    public function rules()
    {
        return [
            [['name', 'status', 'sort', 'extra_attributes'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['status', 'sort', 'id'], 'integer'],
            [['extra_attributes'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '标签名',
            'status' => '标签状态',
            'sort' => '排序',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $this->checkData();

            if ($this->id) {
                $mchTag = MchTags::find()->andWhere([
                    'mall_id' => \Yii::$app->mall->id,
                    'mch_id' => \Yii::$app->user->identity->mch_id,
                    'id' => $this->id,
                    'is_delete' => 0
                ])->one();

                if (!$mchTag) {
                    throw new \Exception('标签不存在');
                }
            } else {
                $mchTag = new MchTags();
                $mchTag->mall_id = \Yii::$app->mall->id;
                $mchTag->mch_id = \Yii::$app->user->identity->mch_id;
            }

            $mchTag->name = $this->name;
            $mchTag->status = $this->status;
            $mchTag->sort = $this->sort;
            $mchTag->extra_attributes = json_encode($this->extra_attributes);
            $res = $mchTag->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($mchTag));
            }
            
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
        if (!isset($this->extra_attributes['color'])) {
            throw new \Exception('参数异常');
        }
    }
}
