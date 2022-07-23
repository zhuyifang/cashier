<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/10/19
 * Time: 14:17
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\mall\share;


use app\core\response\ApiCode;
use app\forms\common\share\CommonShareLevel;
use app\models\Model;
use app\models\ShareLevel;

class LevelEditForm extends Model
{
    public $id;
    public $level;
    public $name;
    public $price_type;
    public $first;
    public $second;
    public $third;
    public $status;
    public $is_auto_level;
    public $rule;
    public $new_condition_type;
    public $condition_user;
    public $condition_total_share_money;
    public $condition_cash;
    public $condition_total_consume;
    public $condition_share;

    public function rules()
    {
        return [
            [['level', 'name', 'price_type', 'first', 'status', 'rule'], 'required'],
            [['level', 'name', 'price_type', 'first', 'status', 'rule'], 'trim'],
            [['level', 'price_type', 'status', 'id', 'is_auto_level', 'condition_user', 'condition_share'], 'integer'],
            [['name'], 'string'],
            [['first', 'second', 'third', 'condition_total_share_money', 'condition_cash',
                'condition_total_consume'], 'number', 'min' => 0],
            [['price_type', 'is_auto_level'], 'default', 'value' => 1],
            [[ 'status', 'second', 'third', 'condition_total_share_money', 'condition_cash', 'condition_user',
                'condition_total_consume', 'condition_share'], 'default', 'value' => 0],
            [[ 'rule'], 'string', 'max' => 80],
            [['new_condition_type'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'level' => '分销商等级',
            'name' => '分销商等级名称',
            'first' => '一级分销佣金数（元）',
            'second' => '二级分销佣金数（元）',
            'third' => '三级分销佣金数（元）',
            'condition_user' => '下线用户数',
            'condition_total_share_money' => '累计佣金',
            'condition_cash' => '已提现佣金',
            'condition_total_consume' => '累计消费金额',
            'condition_share' => '下线分销商数',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            if ($this->is_auto_level == 1 && (!$this->new_condition_type || empty($this->new_condition_type))) {
                throw new \Exception('开启自动升级时，升级条件不能为空');
            }
            if ($this->price_type == 1) {
                if ($this->first > 100 || $this->second > 100 || $this->third > 100) {
                    throw new \Exception('分销佣金百分比不能大于100%');
                }
            }
            $commonShareLevel = CommonShareLevel::getInstance();
            $shareLevel = $commonShareLevel->getDetail($this->id);
            if ($this->new_condition_type) {
                $this->new_condition_type = implode(',', $this->new_condition_type);
            } else {
                $this->new_condition_type = '';
            }
            if (!$shareLevel) {
                $shareLevel = new ShareLevel();
                $shareLevel->is_delete = 0;
                $shareLevel->mall_id = \Yii::$app->mall->id;
            }
            $shareLevel->attributes = $this->attributes;
            if (!$shareLevel->save()) {
                throw new \Exception($this->getErrorMsg($shareLevel));
            } else {
                return [
                    'code' => ApiCode::CODE_SUCCESS,
                    'msg' => '保存成功'
                ];
            }
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }
    }
}
