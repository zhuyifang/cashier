<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\diy;

use app\models\Model;
use app\models\Store;


class DiyMenuForm extends Model
{
    public function getNewData($data)
    {
        if ($data['type'] === 'store'
            && isset($data['type_data']['store'])
            && !empty($data['type_data']['store'])
        ) {
            $storeIds = [];
            foreach ($data['type_data']['store'] as $item) {
                $storeIds[] = $item['id'];
            }
            $store = Store::find()->select('id,name')->where([
                'id' => $storeIds,
                'is_delete' => 0,
                'status' => 1
            ])->asArray()->all();

            $data['type_data']['store'] = array_map(function ($item) {
                return [
                    'label' => $item['name'],
                    'value' => $item['id']
                ];
            }, $store);
        }

        return $data;
    }
}
