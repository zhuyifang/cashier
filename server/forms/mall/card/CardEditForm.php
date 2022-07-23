<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\card;


use app\core\response\ApiCode;
use app\models\GoodsCardStoreRelation;
use app\models\GoodsCards;
use app\models\Model;

class CardEditForm extends Model
{
    public $name;
    public $pic_url;
    public $description;
    public $id;
    public $expire_type;
    public $time;
    public $expire_day;
    public $total_count;
    public $number;
    public $app_share_title;
    public $app_share_pic;
    public $use_type;
    public $store_ids;
    public $is_allow_send;

    public function rules()
    {
        return [
            [['name', 'pic_url', 'description', 'expire_day', 'time', 'expire_type', 'use_type'], 'required'],
            [['pic_url', 'name', 'description', 'app_share_title', 'app_share_pic'], 'string'],
            [['id', 'expire_type', 'expire_day', 'total_count', 'number', 'use_type', 'is_allow_send'], 'integer'],
            [['total_count'], 'default', 'value' => -1],
            [['expire_day'], 'integer', 'max' => 2000,],
            [['store_ids'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'expire_day' => '有效天数',
            'number' => '核销总次数',
            'total_count' => '可发放数量',
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            if ($this->number < 1 || $this->number > 400) {
                throw new \Exception('核销总次数限制为：1~400');
            }

            if ($this->expire_type == 1 && ($this->expire_day < 1 || $this->expire_day > 9999999)) {
                throw new \Exception('有效天数限制为：1~999999');
            }

            if ($this->expire_type == 2 && strtotime($this->time[0]) < strtotime('1970-01-01') || strtotime($this->time[1]) > strtotime('2038-01-01')) {
                throw new \Exception('有效日期限制为:1970-01-01 ~ 2038-01-01');
            }

            if ($this->total_count != -1 && ($this->total_count < 1 || $this->total_count > 9999999)) {
                throw new \Exception('可发放数量限制为：1~999999');
            }

            if ($this->use_type == 1 && count($this->store_ids) == 0) {
                throw new \Exception('请选择卡券可使用门店');
            }

            $transaction = \Yii::$app->db->beginTransaction();
            if ($this->id) {
                $card = GoodsCards::findOne(['mall_id' => \Yii::$app->mall->id, 'id' => $this->id]);
                if (!$card) {
                    throw new \Exception('数据异常,该条数据不存在');
                }
                GoodsCardStoreRelation::deleteAll(['card_id' => $card->id]);
            } else {
                $card = new GoodsCards();
                $card->mall_id = \Yii::$app->mall->id;
                $card->is_allow_send = 0;
            }

            $card->name = $this->name;
            $card->expire_type = $this->expire_type;
            $card->expire_day = $this->expire_day;
            $card->begin_time = $this->time[0];
            $card->end_time = $this->time[1];
            $card->pic_url = $this->pic_url;
            $card->description = $this->description;
            $card->total_count = $this->total_count;
            $card->number = $this->number;
            $card->app_share_pic = $this->app_share_pic;
            $card->app_share_title = $this->app_share_title;
            $card->use_type = $this->use_type;
            $card->is_allow_send = $this->is_allow_send;
            $res = $card->save();
            
            if ($this->use_type == 1 && is_array($this->store_ids)) {
                $newList = [];
                foreach ($this->store_ids as $storeId) {
                    $newList[] = [
                        'mall_id' => \Yii::$app->mall->id,
                        'card_id' => $card->id,
                        'store_id' => $storeId
                    ];
                }

                \Yii::$app->db->createCommand()->batchInsert(GoodsCardStoreRelation::tableName(), [
                    'mall_id', 'card_id', 'store_id'
                ], $newList)->execute();
            }

            if (!$res) {
                throw new \Exception($this->getErrorMsg($card));
            }

            $transaction->commit();

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功',
            ];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'error' => [
                    'line' => $e->getLine()
                ]
            ];
        }
    }
}
