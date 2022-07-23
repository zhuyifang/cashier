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

use app\models\Model;

class BaseValidate extends Model
{
    public function symbol()
    {
    	return [
	        'bracket-left' => [
	            'label' => '左括号',
	            'value' => '(',
	        ],
	        'bracket-right' => [
	            'label' => '右括号',
	            'value' => ')'
	        ],
	        'add' => [
	            'label' => '加',
	            'value' => '+'
	        ],
	        'sub' => [
	            'label' => '减',
	            'value' => '-'
	        ],
	        'multiply' => [
	            'label' => '乘',
	            'value' => '*'
	        ],
	        'except' => [
	            'label' => '除',
	            'value' => '/'
	        ],
	    ];
    }

    /**
    * 将按钮公式与公式计算组件 拼接组装
    */
    public function getNewCalc($formData)
    {
        // TODO 是否开启组件
    	$allCalc = [];
        $button = null;
        foreach ($formData as $item) {
            if ($item['id'] == 'calc') {
                $allCalc[$item['data']['key']] = $item['data'];
            }

            if ($item['id'] == 'form-goods-button') {
                $button = $item;
            }
        }

        // 处理公式计算
        $newCalc = [];
        foreach ($button['data']['calc'] as $item) {
            if (isset($item['id']) && $item['id'] == 'calc') {
                if (!isset($allCalc[$item['ignore']])) {
                    throw new \Exception(sprintf('公式计算组件`%s`不存在', $item['label']));
                }
                $newCalc[] = [
                    'ignore' => 'bracket-left',
                    'type' => 'operation'
                ];

                foreach ($allCalc[$item['ignore']]['calc'] as $calcItem) {
                    $newCalc[] = $calcItem;
                }

                $newCalc[] = [
                    'ignore' => 'bracket-right',
                    'type' => 'operation'
                ];
            } else {
                $newCalc[] = $item;
            }
        }

        return $newCalc;
    }
}
