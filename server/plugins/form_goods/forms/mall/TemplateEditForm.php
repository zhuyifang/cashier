<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/3/26
 * Time: 10:04 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\form_goods\forms\mall;

use app\forms\common\diy\ValidateForm;
use app\models\Model;
use app\plugins\form_goods\models\FormGoodsTemplate;

class TemplateEditForm extends Model
{
    public $id;
    public $data;
    public $name;
    public $logic_data;

    public function rules()
    {
        return [
            [['data', 'name'], 'required'],
            [['id'], 'integer'],
            [['data', 'name', 'logic_data'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '表单名称',
            'data' => '表单组件'
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $template = $this->loadTemplate();
            return $this->success([
                'msg' => '保存成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }

    public function loadTemplate()
    {
        if ($this->id) {
            $template = FormGoodsTemplate::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'id' => $this->id,
                'is_delete' => 0
            ])->one();

            if (!$template) {
                throw new \Exception('模板不存在');
            }
        } else {
            $template = new FormGoodsTemplate();
            $template->mall_id = \Yii::$app->mall->id;
            $template->mch_id = \Yii::$app->user->identity->mch_id;
        }

        $this->data = json_decode($this->data, true);
        // 校验表单
        $validate = new ValidateForm();
        $validate->data = $this->data;
        foreach ($this->data as $key => $datum) {
            $method = 'check' . hump($datum['id'], '-');
            // 校验组件中的内容标题
            $validate->checkTitle($datum['id'], $datum['data']);
            if (method_exists($validate, $method)) {
                $validate->$method($datum['data']);
            }
        }
        if ($validate->submitCount == 0) {
            throw new \Exception('提交按钮组件必须选择一个');
        }
        if ($validate->submitCount > 1) {
            throw new \Exception('提交按钮组件最多选择一个');
        }

        $template->form_data = json_encode($this->data, JSON_UNESCAPED_UNICODE);
        $template->logic_data = $this->logic_data ?: json_encode([], JSON_UNESCAPED_UNICODE);
        $template->name = $this->name;
        if (!$template->save()) {
            throw new \Exception($this->getErrorMsg($template));
        }

        return $template;
    }
}
