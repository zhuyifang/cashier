<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/4/19
 * Time: 9:29 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\diy;

use app\forms\common\diy\BaseValidate;
use app\forms\common\diy\CommonTemplate;
use app\models\Model;

class ValidateForm extends BaseValidate
{
    public $submitCount = 0;
    public $formComponents = [];
    public $data = [];

    public function init()
    {
        parent::init();
        $components = CommonTemplate::getCommon()->allFormComponents([]);
        foreach ($components as $item) {
            foreach ($item['list'] as $value) {
                $this->formComponents[$value['id']] = $value['name'];
            }
        }
    }

    /**
     * @param $data
     * @throws \Exception
     * 校验协议内容
     */
    public function checkAgreement($data)
    {
        $name = '协议内容';
        if ($data['content'] === '') {
            throw new \Exception($name . '不能为空');
        }
    }

    /**
     * @param $data
     * @throws \Exception
     * 提交按钮
     */
    public function checkFormGoodsButton($data)
    {
        $this->submitCount++;
        $name = '提交按钮组件';
        if ($data['btn_title'] === '') {
            throw new \Exception($name . '按钮文字不能为空');
        }

        $calcs = $this->getNewCalc($this->data);

        $eavlCalc = $this->checkCalcItem($calcs);
    }

    public function checkCalc($data)
    {
        $name = '公式计算组件';
        if (empty($data['calc'])) {
            throw new \Exception($name . '公式编辑不能为空');
        }

        $this->checkCalcItem($data['calc']);
    }

    public function checkCalcItem($calcs)
    {
        $symbol = $this->symbol();

        $valueList = [];
        foreach ($this->data as $item) {
            if ($item['id'] == 'number-in') {
                $valueList[$item['data']['key']] = $item['data']['default_var'];
            }
            if ($item['id'] == 'radio' || $item['id'] == 'select') {
                $valueList[$item['data']['key']] = $item['data']['default_var'];
            }
        }
        $eavlCalc = '';
        foreach ($calcs as $calc) {
            switch ($calc['type']) {
                // 运算符号
                case 'operation':
                    $newEavlCalc = $symbol[$calc['ignore']]['value'];
                    break;
                // 常量
                case 'const':
                    $newEavlCalc = $calc['label'];
                    break;
                // 其它变量
                case 'variable':
                    // 商品价格
                    if ($calc['ignore'] == 'goods-price') {
                        $newEavlCalc = 1;
                    } else if ($calc['ignore'] == 'alone-price') {
                        $newEavlCalc = 1;
                    } else if ($calc['ignore'] == 'alone-num') {
                        $newEavlCalc = 1;
                    } else {
                        if (!isset($valueList[$calc['ignore']])) {
                            throw new \Exception('公式计算“' . $calc['label'] . '”值不存在,请重新设置公式逻辑');
                        }
                        $newEavlCalc = $valueList[$calc['ignore']];
                    }
                    break;
                default:
                    throw new \Exception('公式计算异常');
                    break;
            }

            $eavlCalc .= $eavlCalc ? " " . $newEavlCalc : $newEavlCalc;
        }

        try {
            $value = eval("return " . $eavlCalc . ';');
            if ($eavlCalc && $value < 0) {
                throw new \Exception('公式计算异常');
            }
        } catch(\Exception $exception) {
            throw new \Exception('公式计算异常:' . $exception->getMessage());
        } catch(\Error $error) {
            throw new \Exception('公式计算异常:' . $exception->getMessage());
        }

        return $eavlCalc;
    }

    /**
     * @param $data
     * 校验提交按钮
     * @throws \Exception
     */
    public function checkButton($data)
    {
        $this->submitCount++;
        $name = '提交按钮组件';
        if ($data['btn_title'] === '') {
            throw new \Exception($name . '按钮文字不能为空');
        }
        if ($data['after_trigger'] == 'event' && $data['after_send_status'] == 1) {
            if (count($data['after_send_type']) === 0) {
                throw new \Exception($name . '赠送信息不能为空');
            }
            $balance = 0b000001;
            $integral = 0b000010;
            $member = 0b000100;
            $coupon = 0b001000;
            $card = 0b010000;
            $lottery = 0b100000;
            $afterSend = array_sum($data['after_send_type']);
            foreach ($data['after_send_type'] as $datum) {
                switch ($datum) {
                    case 1:
                        if ($data['after_send_price'] === '') {
                            throw new \Exception($name . '赠送余额不能为空');
                        }
                        if (!is_numeric($data['after_send_price'])) {
                            throw new \Exception($name . '赠送余额必须是数字');
                        }
                        if ($data['after_send_price'] < 0.01) {
                            throw new \Exception($name . '赠送余额不能小于0.01');
                        }
                        break;
                    case 2:
                        if ($data['after_send_integral'] === '') {
                            throw new \Exception($name . '赠送积分不能为空');
                        }
                        if ($data['after_send_integral'] < 1) {
                            throw new \Exception($name . '赠送积分不能小于1');
                        }
                        break;
                    case 4:
                        if ($data['after_send_member_id'] === '') {
                            throw new \Exception($name . '赠送会员不能为空');
                        }
                        break;
                    case 8:
                        if (count($data['after_send_coupon']) == 0) {
                            throw new \Exception($name . '赠送优惠券不能为空');
                        }
                        break;
                    case 16:
                        if (count($data['after_send_card']) == 0) {
                            throw new \Exception($name . '赠送卡券不能为空');
                        }
                        break;
                    case 32:
                        $permission = \Yii::$app->mall->role->permission;
                        if (!in_array('pond', $permission) && !in_array('scratch', $permission)) {
                            break;
                        }
                        if ($data['after_send_plugin'] === '') {
                            throw new \Exception($name . '请选择赠送抽奖方式');
                        }
                        if ($data['after_send_lottery_limit'] === '') {
                            throw new \Exception($name . '赠送抽奖的抽奖次数不能为空');
                        }
                        if ($data['after_send_lottery_limit'] < 1) {
                            throw new \Exception($name . '赠送抽奖的抽奖次数不能小于1');
                        }
                        break;
                    default:
                        throw new \Exception($name . '赠送方式不正确');
                }
            }
        }
        if ($data['message_status'] == 1) {
            if ($data['m_sms'] == 1 && $data['m_sms_tempid'] === '') {
                throw new \Exception($name . '消息提醒短信模版id不能为空');
            }
            if ($data['m_subscribe'] == 1 && $data['m_subscribe_content'] === '') {
                throw new \Exception($name . '消息提醒订阅消息内容不能为空');
            }
        }

        if ($data['has_calendar'] == 1 && !$data['calendar_key']) {
            throw new \Exception($name . '请选择日期组件');
        }
    }

    public function checkRadio($data)
    {
        $name = '单选框组件';
        if (count($data['list']) == 0) {
            throw new \Exception($name . '至少需要一个选项');
        }
        $list = [];
        $defaultNumber = 0;
        foreach ($data['list'] as $datum) {
            if (in_array($datum['label'], $list)) {
                throw new \Exception($name . '选项名称重复：' . $datum['label']);
            }
            $list[] = $datum['label'];
            if ($data['mode'] == 4 && $datum['img'] === '') {
                throw new \Exception($name . '图文模式需要上传图片');
            }
            if ($datum['label'] === '') {
                throw new \Exception($name . '选项需要填写内容');
            }
            // var default default_var 参数只有定制组件有
            if (isset($datum['var']) && $datum['var'] === '') {
                throw new \Exception($name . '变量值需要填写内容');
            }
            if (isset($datum['default']) && $datum['default']) {
                $defaultNumber++;
                if ($defaultNumber > 1) {
                    throw new \Exception($name . '默认选中最多选择1个');
                }
            }
        }
        

        if (isset($data['default_var']) && $data['default_var'] === '') {
            throw new \Exception($name . '未选中变量值需要填写内容');
        }
    }

    public function checkSelect($data)
    {
        $name = '复选框组件';
        if (count($data['list']) == 0) {
            throw new \Exception($name . '至少需要一个选项');
        }
        $labelList = [];
        $defaultNumber = 0;
        foreach ($data['list'] as $datum) {
            if (in_array($datum['label'], $labelList)) {
                throw new \Exception($name . '选项名称重复：' . $datum['label']);
            }
            $labelList[] = $datum['label'];

            if ($data['mode'] == 4 && $datum['img'] === '') {
                throw new \Exception($name . '图文模式需要上传图片');
            }
            if ($datum['label'] === '') {
                throw new \Exception($name . '选项需要填写内容');
            }
            // var default default_var 参数只有定制组件有
            if (isset($datum['var']) && $datum['var'] === '') {
                throw new \Exception($name . '变量值需要填写内容');
            }
            if (isset($datum['default']) && $datum['default']) {
                $defaultNumber++;
                if ($defaultNumber > $data['max']) {
                    throw new \Exception($name . '默认选中最多选择' . $data['max'] . '个');
                }
            }
        }
        if (isset($data['default_var']) && $data['default_var'] === '') {
            throw new \Exception($name . '未选中变量值需要填写内容');
        }
        if ($data['min'] > $data['max']) {
            throw new \Exception($name . '最少选择不能大于最多选择');
        }
        if ($data['max'] > count($data['list'])) {
            throw new \Exception($name . '最多选择不能大于选项总数');
        }
    }

    public function checkUimage($data)
    {
        if ($data['min_num'] > $data['max_num']) {
            throw new \Exception('上传图片组件最少上传不能大于最大上传');
        }
    }

    public function checkUVideo($data)
    {
        if ($data['min_num'] > $data['max_num']) {
            throw new \Exception('上传视频组件最少上传不能大于最大上传');
        }
    }

    /**
     * @param $id
     * @param $data
     * @throws \Exception
     * 校验组件中的内容标题
     */
    public function checkTitle($id, $data)
    {
        $name = $this->formComponents[$id];
        if (isset($data['title']) && $data['title'] === '') {
            throw new \Exception($name . '内容标题不能为空');
        }
    }

    public function checkCalendar($data)
    {
        $startAt = strtotime($data['is_now'] == 1 ? date('Y-m-d') : $data['start_at']);

        if ($data['end_at']) {
            $endAt = strtotime($data['end_at']) + 86400;
            if ($endAt < $startAt) {
                throw new \Exception('日历组件的结束时间不能小于开始时间');
            }
            if ($data['is_alone'] == 0 && $data['is_day'] == 1) {
                if ($endAt - $startAt < ($data['day_max'] - 1) * 86400) {
                    throw new \Exception('日历组件的限定天数不能大于开始和结束时间的天数');
                }
            }
        }


    }

    public function checkMenu($data)
    {
        $name = '下拉菜单组件';
        switch ($data['type']) {
            case 'basic':
                break;
            case 'address':
                break;
            case 'time':
                $list = $data['type_data'][$data['type']]['start_list'];
                $newList = [];
                foreach ($list as $item) {
                    if (!$item['time'][0] || !$item['time'][1]) {
                        throw new \Exception($name . '时间选择不能为空');
                    }

                    $key = date('Y-m-d', time()) . ' ' . $item['time'][0];
                    $value = date('Y-m-d', time()) . ' ' . $item['time'][1];
                    if (isset($newList[$key . $value])) {
                        throw new \Exception($name . '时间段选择重复');
                    }
                    $newList[$key . $value] = [$key, $value];
                }
                ksort($newList);
                $newList = array_values($newList);
                foreach ($newList as $key => $value) {
                    if ($key != 0) {
                        if (strtotime($value[0]) < strtotime($newList[$key - 1][1])) {
                            throw new \Exception($name . '时间选择重叠');
                        }
                    }
                }
                break;
            case 'store':
                if (count($data['type_data'][$data['type']]) == 0) {
                    throw new \Exception($name . '下拉选项不能为空');
                }
                break;
            case 'date':
                $typeData = $data['type_data']['date'];
                if ($typeData['is_now'] == 0 && $typeData['start_at'] === '') {
                    throw new \Exception($name . '开始日期不能为空');
                }
                $startAt = strtotime($typeData['is_now'] == 1 ? date('Y-m-d') : $typeData['start_at']);
                if (isset($typeData['end_at']) && $typeData['end_at']) {
                    $endAt = strtotime($typeData['end_at']) + 86400;
                    if ($startAt > $endAt) {
                        throw new \Exception($name . '结束日期不能小于开始日期');
                    }
                }
                break;
            default:
                throw new \Exception($name . '预设类型错误');
        }
    }

    public function checkInput($data)
    {
        switch ($data['mode']) {
            case 1:
            case 3:
            case 4:
                break;
            case 2:
                if ($data['default'] && (!is_numeric($data['default']) || strpos($data['default'], '.'))) {
                    throw new \Exception('单行文本组件预设类型为手机号时，预填内容必须是数字');
                }
                break;
            default:
        }
    }

    public function checkTime($data)
    {
        if ($data['has_virtual']) {
            foreach ($data['virtual_list'] as $item) {
                if (!$item['icon'] || !$item['time']) {
                    throw new \Exception('虚拟用户头像/时间必填');
                }
            }
        }
    }

    public function checkNumberIn($data)
    {
        $name = '纯数字输入组件';

        if (!$data['unit']) {
            throw new \Exception($name . '单位不能为空');
        }

        if (!$data['default_var']) {
            throw new \Exception($name . '默认值需要填写内容');
        }

        if ($data['number_type'] == 'float') {
            if (($data['number_min'] < 0.01 || $data['number_min'] > 99999999) || ($data['number_max'] < 0.01 || $data['number_max'] > 99999999)) {
                throw new \Exception($name . '数字范围值最小为0.01最大为99999999');
            }
            if ($data['default_var'] < 0.01 || $data['default_var'] > 99999999) {
                throw new \Exception($name . '默认值最小为0.01最大为99999999');
            }
        } else {
            if (($data['number_min'] < 1 || $data['number_min'] > 99999999) || ($data['number_max'] < 1 || $data['number_max'] > 99999999)) {
                throw new \Exception($name . '数字范围值最小为1最大为99999999');
            }

            if ($data['default_var'] < 1 || $data['default_var'] > 99999999) {
                throw new \Exception($name . '默认值最小为1最大为99999999');
            }
        }

        if ($data['number_min'] > $data['number_max']) {
            throw new \Exception($name . '数字范围应从小到大');
        }
    }
}
