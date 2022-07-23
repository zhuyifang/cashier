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

use app\forms\api\order\OrderException;
use app\forms\common\diy\BaseValidate;
use app\forms\common\diy\CommonTemplate;
use app\models\CoreValidateCode;
use app\models\Model;

class ValueValidateForm extends BaseValidate
{
    /**
     * @param $data
     * @throws \Exception
     * 校验协议内容
     */
    public function checkAgreement($data)
    {
        if ($data['value']) {
            if ($data['required'] && !$data['value']['is_check']) {
                throw new \Exception('请先勾选协议');
            }
        }
    }

    /**
     * @param $data
     * @throws \Exception
     * 校验手机号
     */
    public function checkPhone($data)
    {
        if ($data['value']) {
            $id = $data['value']['id'];
            $mobile = $data['value']['mobile'];
            $code = $data['value']['check'];
            if ($code) {
                $validate = CoreValidateCode::find()->andWhere([
                    'id' => $id,
                    'target' => $mobile,
                    'is_validated' => 0,
                ])->one();

                if (!$validate) {
                    throw new \Exception('短信验证码不存在或已失效');
                }

                if ($validate->code != $code) {
                    throw new \Exception('验证码错误');
                }

                $validate->is_validated = 1;
                $res = $validate->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($validate));
                }
            }
        }
    }

    /**
     * @param $data
     * @throws \Exception
     * 校验文本框
     */
    public function checkInput($data)
    {
        if ($data['value']) {
            // 普通文本
            if ($data['value']['type'] == 1) {
                $allow = [
                    '1' => [
                        'preg' => '/[\x7f-\xff]+/',
                        'msg' => '不允许输入中文'
                    ],
                    '2' => [
                        'preg' => '/[A-Za-z]/',
                        'msg' => '不允许输入英文'
                    ],
                    '3' => [
                        'preg' => '/[0-9]/',
                        'msg' => '不允许输入数字'
                    ],
                    '4' => [
                        'preg' => '/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/',
                        'msg' => '不允许输入特殊符号'
                    ]
                ];
                $aList = array_diff([1, 2, 3, 4], $data['value']['allow']);
                foreach ($aList as $aItem) {
                    if (isset($allow[$aItem]) && preg_match($allow[$aItem]['preg'], $data['value']['text'])) {
                        throw new \Exception($data['label'] . $allow[$aItem]['msg']);
                    }
                }
            }

            // 验证邮箱
            if ($data['value']['type'] == 3 && $data['value']['text']) {
                if (!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $data['value']['text'])) {
                    throw new \Exception('请输入正确的邮箱地址');
                }
            }
            // 验证手机号
            if ($data['value']['type'] == 2 && $data['value']['text']) {
                if (strlen($data['value']['text']) != 11 || substr($data['value']['text'], 0, 1) != 1) {
                    throw new \Exception('请输入正确的手机号');
                }
            }

            // 验证身份证
            if ($data['value']['type'] == 4 && $data['value']['text']) {
                if (!preg_match('/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/', $data['value']['text'])) {
                    throw new \Exception('请输入正确的身份证号');
                }
            }
        }
    }

    // 获取计算公式
    public function getCalcData($price, $unitPrice, $num, $appCustomization, $dbCustomization)
    {
        $symbol = $this->symbol();
        $eavlCalc = '';
        $eavlCalcText = '';
        $evalCalcList = [];
        $calc = $this->getNewCalc($dbCustomization);

        if (!empty($calc)) {
            $valueList = [];
            foreach ($appCustomization as $item) {
                if (in_array($item['key'], ['number-in', 'radio', 'select'])) {
                    if (isset($valueList[$item['unique']])) {
                        throw new \Exception('公式组件key重复');
                    }
                    $valueList[$item['unique']] = $item['value'];
                }
            }
            $dbValueList = [];
            foreach ($dbCustomization as $item) {
                if ($item['id'] == 'radio' || $item['id'] == 'select') {
                    $dbValueList[$item['data']['key']]['default_var'] = $item['data']['default_var'];
                    foreach ($item['data']['list'] as $lItem) {
                        $dbValueList[$item['data']['key']][$lItem['label']] = $lItem['var'];
                    }
                }
                if ($item['id'] == 'number-in') {
                    $dbValueList[$item['data']['key']]['default_var'] = $item['data']['default_var'];
                }
            }
            foreach ($calc as $key => $value) {
                if ($value['type'] == 'operation' && $symbol[$value['ignore']]) {
                    $newEavlCalc = $symbol[$value['ignore']]['value'];
                    $newEavlCalcText = $symbol[$value['ignore']]['value'];
                } else if ($value['type'] == 'const') {
                    $newEavlCalc = $value['label'];
                    $newEavlCalcText = $value['label'];
                } else if ($value['type'] == 'variable' && !in_array($value['ignore'], ['goods-price', 'alone-price', 'alone-num'])) {
                    // 未选中情况下 使用默认值
                    if ($value['id'] == 'radio') {
                        $newEavlCalc = $valueList[$value['ignore']] ? $dbValueList[$value['ignore']][$valueList[$value['ignore']]] : $dbValueList[$value['ignore']]['default_var'];
                        $newEavlCalcText = $value['label'];
                    } else if($value['id'] == 'select') {
                        if ($valueList[$value['ignore']]) {
                            $selectValue = 0;
                            foreach ($valueList[$value['ignore']] as $ignoreItem) {
                                $selectValue += $dbValueList[$value['ignore']][$ignoreItem];
                            }
                        } else {
                            $selectValue = $dbValueList[$value['ignore']]['default_var'];
                        }
                        $newEavlCalc = $selectValue;
                        $newEavlCalcText = $value['label'];
                    } else {
                        $newEavlCalc = $valueList[$value['ignore']] ?: $dbValueList[$value['ignore']]['default_var'];
                        $newEavlCalcText = $value['label'];
                    }

                } else if (isset($value['ignore']) && $value['ignore'] == 'goods-price') {
                    $value['type'] = 'goods-price';
                    $newEavlCalc = $price;
                    $newEavlCalcText = '商品总价';
                    
                } else if (isset($value['ignore']) && $value['ignore'] == 'alone-price') {
                    $value['type'] = 'alone-price';
                    $newEavlCalc = $unitPrice;
                    $newEavlCalcText = '商品单价';
                    
                } else if (isset($value['ignore']) && $value['ignore'] == 'alone-num') {
                    $value['type'] = 'alone-num';
                    $newEavlCalc = $num;
                    $newEavlCalcText = '商品数量';
                    
                } else {
                    throw new \Exception('公式数据异常');
                }

                $eavlCalc .= $eavlCalc ? " " . $newEavlCalc : $newEavlCalc;
                $eavlCalcText .= $eavlCalcText ? " " . $newEavlCalcText : $newEavlCalcText;
                $evalCalcList[] = [
                    'type' => $value['type'],
                    'label' => $newEavlCalcText,
                    'value' => $newEavlCalc
                ];
            }
        }

        try {
            if ($eavlCalc) {
                $totalPrice = eval("return " . $eavlCalc . ';');
            } else {
                $totalPrice = $price;
            }
            
        } catch(\Exception $exception) {
            throw new OrderException('公式计算异常:' . $eavlCalc);
        } catch(\Error $error) {
            throw new OrderException('公式计算异常:' . $eavlCalc);
        }

        return [
            'total_price' => price_format($totalPrice),
            'eavl_calc' => $eavlCalc,
            'eavl_calc_text' => $eavlCalcText,
            'eval_calc_list' => $evalCalcList,
            'goods_num' => $num
        ];
    }
}
