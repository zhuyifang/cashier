<?php


namespace app\forms\common\diy;

use app\models\Model;
use app\models\Store;
use app\plugins\diy\models\DiyFormList;

class CommonFormModule extends Model
{
    public function getFormById($formIds)
    {
        if (empty($formIds)) {
            return [];
        }
        $list = DiyFormList::find()->where([
            'id' => $formIds,
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0
        ])->asArray()->all();
        $newList = [];
        foreach ($list as $item) {
            extract($item);
            $form_data = \yii\helpers\BaseJson::decode($form_data);
            foreach ($form_data as $key => $formItem) {
                if ($formItem['id'] === 'menu'
                    && $formItem['data']['type'] === 'store'
                    && isset($formItem['data']['type_data']['store'])
                    && !empty($formItem['data']['type_data']['store'])
                ) {
                    $store = Store::find()->select('id,name')->where([
                        'id' => $formItem['data']['type_data']['store'],
                        'is_delete' => 0,
                        'status' => 1
                    ])->asArray()->all();

                    $form_data[$key]['data']['type_data']['store'] = array_map(function ($item) {
                        return [
                            'label' => $item['name'],
                            'value' => $item['id']
                        ];
                    }, $store);
                }
            }
            array_push($newList, [
                'form_id' => $id,
                'name' => $name,
                'status' => $status,
                'limit' => $limit,
                'tip' => $tip,
                'list' => $form_data,
            ]);
        }
        return $newList;
    }

    public function getNewForm($data, $allData)
    {
        $data['name'] = '';
        $data['list'] = [];
        foreach ($allData as $form) {
            if ($form['form_id'] == $data['form_id']) {
                $data = $form;
            }
        }
        return $data;
    }

}