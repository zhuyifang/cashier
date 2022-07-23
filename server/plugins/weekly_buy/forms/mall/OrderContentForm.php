<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/27
 * Time: 3:49 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\plugins\weekly_buy\exceptions\WeeklyBuyException;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyExpress;

class OrderContentForm extends Model
{
    public $order_id;
    public $week_number;
    public $express_content;

    public function rules()
    {
        return [
            [['order_id', 'week_number', 'express_content'], 'required'],
            [['order_id', 'week_number'], 'integer'],
            [['express_content',], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'order_id' => '订单号',
            'week_number' => '周期',
            'express_content' => '备注'
        ];
    }

    public function execute()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $express = WeeklyBuyExpress::findOne([
                'order_id' => $this->order_id,
                'week_number' => $this->week_number,
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0
            ]);
            if (!$express) {
                throw new WeeklyBuyException('所选周期不存在或被删除，请刷新后重试');
            }
            $express->express_content = $this->express_content;
            if (!$express->save()) {
                throw new WeeklyBuyException($this->getErrorMsg($express));
            }
            return $this->success([
                'msg' => '保存成功'
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
