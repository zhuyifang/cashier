<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\diy\forms\mall;

use app\forms\mall\export\BaseExport;
use app\plugins\diy\models\DiyForm;

class InfoExport extends BaseExport
{

    public function fieldsList()
    {
        return [
            [
                'key' => 'id',
                'value' => '用户ID',
            ],
            [
                'key' => 'nickname',
                'value' => '用户昵称',
            ],
            [
                'key' => 'form_name',
                'value' => '表单名称',
            ],
            [
                'key' => 'form_data',
                'value' => '表单信息',
            ],
            [
                'key' => 'pay_price',
                'value' => '支付价格',
            ],
            [
                'key' => 'source',
                'value' => '来源',
            ],
            [
                'key' => 'created_at',
                'value' => '提交时间',
            ],
            [
                'key' => 'reply',
                'value' => '回复内容',
            ],
            
        ];
    }

    public function export($query = null)
    {
        $query = $this->query;
        $query->orderBy('created_at desc');

        $this->exportAction($query);

        return true;
    }

    /**
     * 获取csv名称
     * @return string
     */
    public function getFileName()
    {
        $fileName = 'diy表单';

        return $fileName;
    }

    protected function transform($list)
    {
        $newList = [];
        /** @var DiyForm $item */
        foreach ($list as $item) {

            $formData = json_decode($item->form_data, true);
            // 新增图片上传数据格式转换
            if (is_array($formData) || $formData instanceof \ArrayObject) {
                foreach ($formData as &$_item) {
                    if (!isset($_item['key']) || $_item['key'] !== 'img_upload') {
                        continue;
                    }
                    if (!isset($_item['value'])) {
                        continue;
                    }
                    if (is_string($_item['value'])) {
                        $_item['value'] = [$_item['value']];
                    }
                }
            }

            $source = '';
            if ($item->extra_attributes) {
                $extra = json_decode($item->extra_attributes, true);
                if (isset($extra['diy_page'])) {
                    $diyPage = $extra['diy_page'];
                    $source = sprintf('%s(%s)', $diyPage['title'], $diyPage['id']);
                }
            }

            $arr = [];
            $arr['id'] = $item->user_id;
            $arr['nickname'] = $item->user->nickname;
            $arr['form_name'] = $item->form_list_name;
            $arr['form_data'] = $this->handleFormData($formData, $item->is_old, json_decode($item->extra_attributes, true));
            $arr['pay_price'] = floatval($item->pay_price);
            $arr['source'] = $source;
            $arr['created_at'] = $item->created_at;
            $arr['reply'] = $item->reply;
            $newList[] = $arr;
        }
        $this->dataList = $newList;
    }

    public function handleFormData($formData, $isOld, $extra)
    {
        $string = '';
        foreach ($formData as $key => $item) {
            try {
                if ($isOld) {
                    if (isset($item['key']) && !in_array($item['key'], ['radio', 'checkbox', 'img_upload'])) {
                        if (isset($item['value']) && is_string($item['value'])) {
                            $string .= $item['name'] . ':' . $item['value'] . '； ';
                        } else {
                            $string .= $item['name'] . ':' . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'radio') {
                        if (isset($item['value'])) {
                            $string .= $item['name'] . ":" . $item['value'] . '； ';
                        } else {
                            $string .= $item['name'] . ":" . '； ';
                        }
                    }
                    if (isset($item['key']) && $item['key'] == 'checkbox') {
                        $str = '';
                        if (isset($item['value'])) {
                            if (is_array($item['value'])) {
                                foreach ($item['value'] as $valItem) {
                                    $str .= $valItem . '|';
                                }
                                $str = substr($str, 0, strlen($str) - 1);
                            } else {
                                $str = $item['value'];
                            }

                            $string .= $item['name'] . ':' . $str . '； ';
                        } else {
                            $string .= $item['name'] . ':' . '； ';
                        }
                    }
                    if (isset($item['key']) && $item['key'] == 'img_upload') {
                        $str = '';
                        if (isset($item['value'])) {
                            if (is_array($item['value'])) {
                                foreach ($item['value'] as $valItem) {
                                    $str .= $valItem . '|';
                                }
                                $str = substr($str, 0, strlen($str) - 1);
                            } else {
                                $str = $item['value'];
                            }
                            $string .= $item['name'] . ':' . $str . '； ';
                        } else {
                            $string .= $item['name'] . ':' . '； ';
                        }
                    }
                } else {
                    if (isset($item['key']) && $item['key'] == 'input') {
                        if (isset($item['value']['text']) && strlen($item['value']['text'])) {
                            $string .= $item['label'] . ":" . $item['value']['text'] . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }
    
                    if (isset($item['key']) && $item['key'] == 'text') {
                        if (isset($item['value']) && strlen($item['value'])) {
                            $string .= $item['label'] . ":" . $item['value'] . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }
    
                    if (isset($item['key']) && $item['key'] == 'menu') {
                        if (isset($item['value']['text']) && strlen($item['value']['text'])) {
                            $string .= $item['label'] . ":" . $item['value']['text'] . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'menu' && $item['value']['type'] == 'date') {
                        if (isset($item['value']['alone_at']) && $item['value']['alone_at']) {
                            $string .= $item['label'] . ":" . $item['value']['alone_at'] . '； ';
                        } else {
                            $string .= $item['label'] . ":" . $item['value']['begin_at'] . '-' . $item['value']['end_at'] . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'switch') {
                        $string .= $item['label'] . ":" . ($item['value'] ? '开启' : '关闭') . '； ';
                    }

                    if (isset($item['key']) && $item['key'] == 'radio') {
                        if (isset($item['value']) && $item['value']) {
                            $string .= $item['label'] . ":" . $item['value'] . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'select') {
                        if (isset($item['value']) && is_array($item['value'])) {
                            $selectText = '';
                            foreach ($item['value'] as $key => $selectItem) {
                                $selectText .= $selectItem . '|';
                            }
                            $selectText = substr($selectText,0,strlen($selectText)-1);
                            $string .= $item['label'] . ":" . $selectText . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'position') {
                        if (isset($item['value']) && $item['value']) {
                            $string .= $item['label'] . ":" . $item['value'] . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'uimage') {
                        if (isset($item['value']) && is_array($item['value'])) {
                            $text = '';
                            foreach ($item['value'] as $key => $imageIten) {
                                $text .= $imageIten . '|';
                            }
                            $text = substr($text,0,strlen($text)-1);
                            $string .= $item['label'] . ":" . $text . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }   
                    }

                    if (isset($item['key']) && $item['key'] == 'uvideo') {
                        if (isset($item['value']) && is_array($item['value'])) {
                            $text = '';
                            foreach ($item['value'] as $key => $videoItem) {
                                $text .= $videoItem . '|';
                            }
                            $text = substr($text,0,strlen($text)-1);
                            $string .= $item['label'] . ":" . $text . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'calendar') {
                        if (isset($item['value'])) {
                            if (isset($item['value']['fulldate']) && $item['value']['fulldate']) {
                                $string .= $item['label'] . ":" . $item['value']['fulldate'] . '； ';
                            }
                            if (isset($item['value']['data']) && $item['value']['data']) {
                                $text = '';
                                foreach ($item['value']['data'] as $key => $dateItem) {
                                    $text .= $dateItem . '|';
                                }
                                $text = substr($text,0,strlen($text)-1);
                                $string .= $item['label'] . ":" . $text . '； ';
                            }
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }

                    if (isset($item['key']) && $item['key'] == 'phone') {
                        if (isset($item['value']['mobile']) && strlen($item['value']['mobile'])) {
                            $string .= $item['label'] . ":" . $item['value']['mobile'] . '； ';
                        } else {
                            $string .= $item['label'] . ":" . '； ';
                        }
                    }
                }
            } catch (\Exception $exception) {
                \Yii::error('formData数据处理异常');
                \Yii::error($exception);
            }
        }

        try {
            $snedData = isset($extra['new_send_data']) ? $extra['new_send_data'] : [];
            if (isset($snedData['send_card_list']) && is_array($snedData['send_card_list']) && $snedData['send_card_list']) {
                $text = '赠送卡券:';
                foreach ($snedData['send_card_list'] as $card) {
                    $text .=  $card['num'] . '张' . $card['name'] . '|';
                }

                $text = substr($text,0,strlen($text)-1);
                $string .= $text . '； ';
            }

            if (isset($snedData['send_coupon_list']) && is_array($snedData['send_coupon_list']) && $snedData['send_coupon_list']) {
                $text = '赠送优惠券:';
                foreach ($snedData['send_coupon_list'] as $coupon) {
                    $text .=  $coupon['send_num'] . '张' . $coupon['name'] . '|';
                }

                $text = substr($text,0,strlen($text)-1);
                $string .= $text . '； ';
            }

            if (isset($snedData['send_balance']) && $snedData['send_balance']) {
                $string .= '赠送金额:' . $snedData['send_balance'] . '； ';
            }

            if (isset($snedData['send_integral']) && $snedData['send_integral']) {
                $string .= '赠送积分:' . $snedData['send_integral'] . '； ';
            }

            if (isset($snedData['send_member']) && $snedData['send_member']) {
                $string .= '赠送会员:' . $snedData['send_member'] . '； ';
            }

            if (isset($snedData['send_pond']) && $snedData['send_pond']) {
                $string .= '赠送抽奖:' . $snedData['send_pond'] . '次九宫格抽奖； ';
            }

            if (isset($snedData['send_scratch']) && $snedData['send_scratch']) {
                $string .= '赠送抽奖:' . $snedData['send_scratch'] . '次刮刮卡抽奖； ';
            }
            $string = $string ? substr($string,0,strlen($string)-1) : $string;
        } catch (\Exception $exception) {
            \Yii::error('formData赠送数据处理异常');
            \Yii::error($exception);
        }

        return $string;
    }
}
