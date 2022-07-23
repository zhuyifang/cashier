<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\diy;

use app\models\Model;
use app\plugins\diy\models\DiyForm;
use app\plugins\diy\models\DiyFormList;
use yii\helpers\ArrayHelper;

class DiyTimeForm extends Model
{
    public function getNewData($data, $formId, $button)
    {
        $diyFormList = DiyFormList::find()->andWhere(['id' => $formId])->one();
        $query = DiyForm::find()->andWhere([
            'mall_id' => \Yii::$app->mall->id, 
            'is_delete' => 0,
            'form_list_id' => $formId,
            'is_pay' => 1,
        ]);

        $stock = $this->getStock($data, $button);

        $data['user_count'] = $this->getUserCount($query, $data);
        $data['user_list'] = $this->getBuyUser($query, $data);
        $data['time_at'] = $diyFormList ? $diyFormList->time_at : '';
        $data['time_status'] = $diyFormList ? $diyFormList->time_status : 0;
        $data['buy_list'] = $this->getBuyUserList($query, $data);
        $data['has_progress_bar'] = $this->getProgressBar($data, $button, $stock);
        $data['progress_item'] = $this->getProgressItem($query, $data);
        $data['progress_count'] = $this->getProgressCount($query, $data, $stock);

        return $data;
    }



    private function getProgressItem($query, $data)
    {
        $userQuery = clone $query;
        $count = $userQuery->count();

        if ($data['has_virtual']) {
            $count += (int)$data['virtual_num'];
            $count += count($data['virtual_list']);
        }

        return $count;
    }

    private function getProgressCount($query, $data, $stock)
    {
        $userQuery = clone $query;
        $count = $userQuery->count();

        $count += (int)$stock;

        if ($data['has_virtual']) {
            $count += (int)$data['virtual_num'];
            $count += count($data['virtual_list']);
        }

        return $count;
    }

    // 同一用户 多个订单算一个用户
    private function getUserCount($query, $data)
    {
        $userQuery = clone $query;
        $count = $userQuery->groupBy('user_id')->count();

        if ($data['has_virtual']) {
            $count += (int)$data['virtual_num'];
            $count += count($data['virtual_list']);
        }

        return $count;
    }

    private function getStock($data, $button)
    {
        $stockCount = 0;
        if ($button['data']) {
            if ($button['data']['pay_status'] == 'alone') {
                $stockCount = $data['has_virtual'] ? (int)$data['virtual_num'] + $button['data']['stock_num'] : $button['data']['stock_num'];
            } else {
                foreach ($button['data']['pay_price_list'] as $item) {
                    if ($item['has_limit_stock_num'] == 0) {
                        $stockCount += $item['stock_num'];
                    }
                }
                $stockCount = $data['has_virtual'] ? (int)$data['virtual_num'] + $stockCount : $stockCount;
            }
        }

        return $stockCount;
    }

    private function getProgressBar($data, $button, $stock)
    {
        $isShow = 0;
        if ($button['data']) {
            if ($button['data']['has_limit_stock_num'] == 0) {
                return $stock ? 1 : 0;
            } else {
                return 0;
            }
        }
    }

    private function getBuyUser($query, $data)
    {
        $max = 8;
        $lQuery = clone $query;
        $list = $lQuery->orderBy(['created_at' => SORT_DESC])
            ->groupBy('user_id')
            ->with('user.userInfo')
            ->limit($max)
            ->all();

        $newList = [];
        foreach ($list as $key => $item) {
            $newList[strtotime($item->pay_time) + $key] = [
                'icon' => $item->user->userInfo->avatar,
                'time' => $item->pay_time
            ];
        }

        foreach ($data['virtual_list'] as $key => $item) {
            if ($data['has_virtual']) {
                if (count($newList) >= $max) {
                    break;
                }
                $newList[strtotime($item['time']) + $key] = [
                    'icon' => $item['icon'],
                    'time' => $item['time']
                ];
            }
        }
        krsort($newList);
        $newList = array_values($newList);

        return $newList;
    }

    private function getBuyUserList($query, $data)
    {
        $buyQuery = clone $query;
        $list = $buyQuery->orderBy(['created_at' => SORT_DESC])
            ->groupBy('user_id')
            ->with('user.userInfo')
            ->limit(50)
            ->all();

        $newList = [];
        foreach ($list as $key => $value) {
            $newItem = [];
            $newItem['user_icon'] = $value->user->userInfo->avatar;
            $newItem['user_text'] = $this->getTime(strtotime($value->pay_time)) . $data['text'];
            $newList[strtotime($value->pay_time) + $key] = $newItem;
        }

        if ($data['has_virtual']) {
            foreach ($data['virtual_list'] as $key => $value) {
                if (count($newList) < 50) {
                    $newList[strtotime($value['time']) + $key] = [
                        'user_icon' => $value['icon'],
                        'user_text' => $this->getTime(strtotime($value['time'])) . $data['text']
                    ];
                }
            }
        }
        krsort($newList);
        $newList = array_values($newList);

        return $newList;
    }

    private function getTime($time)
    {
        $time = $time ?: time() - 60;
        $newTime = time() - $time;

        $text = '';
        if ($newTime <= 60) {
            $text = sprintf('1分钟前');
        } else if ($newTime > 60 && $newTime < 3600) {
            $text = sprintf('%s分钟前', floor($newTime / 60));
        } else if ($newTime > 3600 && $newTime < 86400) {
            $text = sprintf('%s小时前', floor($newTime / 3600));
        } else if ($newTime > 86400 && $newTime < (86400 * 30)) {
            $text = sprintf('%s天前', floor($newTime / 86400));
        } else if ($newTime > (86400 * 30) && $newTime < (86400 * 30 * 12)) {
            $text = sprintf('%s月前', floor($newTime / (86400 * 30)));
        } else {
            $text = sprintf('%s年前', floor($newTime / (86400 * 30 * 12)));
        }

        return $text;
    }
}
