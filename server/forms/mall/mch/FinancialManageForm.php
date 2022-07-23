<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\mall\mch;


use app\core\response\ApiCode;
use app\forms\common\mch\MchSettingForm;
use app\forms\mall\export\CommonExport;
use app\forms\mall\export\jobs\ExportJob;
use app\helpers\Json;
use app\models\Model;
use app\models\Order;
use app\plugins\mch\forms\mall\SettingForm;
use app\plugins\mch\models\Mch;
use app\plugins\mch\models\MchAccountLog;
use app\plugins\mch\models\MchCash;
use app\plugins\mch\models\MchOrder;


class FinancialManageForm extends Model
{
    public $is_transfer;
    public $pagination;
    public $mch_id;
    public $keyword;
    public $start_date;
    public $end_date;

    public $flag;
    public $fields;

    public function rules()
    {
        return [
            [['flag',], 'trim'],
            [['is_transfer'], 'integer'],
            [['is_transfer'], 'default', 'value' => -1],
            [['keyword', 'start_date', 'end_date',], 'string'],
            [['fields'], 'safe']
        ];
    }

    public function getAccountLog()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $query = MchAccountLog::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'mch_id' => \Yii::$app->user->identity->mch_id,
        ]);

        if ($this->keyword) {
            $query->where(['like', 'desc', $this->keyword]);
        }

        if ($this->start_date && $this->end_date) {
            $query->andWhere(['<', 'created_at', $this->end_date])
                ->andWhere(['>', 'created_at', $this->start_date]);
        }

        if ($this->keyword) {
            $query->where(['like', 'desc', $this->keyword]);
        }

        if ($this->flag == "EXPORT") {
            $new_query = clone $query;
            $queueId = CommonExport::handle([
                'export_class' => 'app\\forms\\mall\\mch\\AccountLogExport',
                'params' => [
                    'query' => $new_query,
                    'fieldsKeyList' => $this->fields,
                ]
            ]);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'queue_id' => $queueId
                ]
            ];
        }

        $list = $query->page($pagination)->orderBy(['created_at' => SORT_DESC])->asArray()->all();

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => "请求成功",
            'data' => [
                'list' => $list,
                'export_list' => (new AccountLogExport())->fieldsList(),
                'pagination' => $pagination
            ]
        ];
    }

    public function getCashLog()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $query = MchCash::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'mch_id' => \Yii::$app->user->identity->mch_id,
        ]);

        if ($this->keyword) {
            $query->where(['like', 'order_no', $this->keyword]);
        }

        if ($this->start_date && $this->end_date) {
            $query->andWhere(['<', 'created_at', $this->end_date])
                ->andWhere(['>', 'created_at', $this->start_date]);
        }

        if ($this->flag == "EXPORT") {
            $new_query = clone $query;

            $queueId = CommonExport::handle([
                'export_class' => 'app\\forms\\mall\\mch\\CashLogExport',
                'params' => [
                    'query' => $new_query,
                    'fieldsKeyList' => $this->fields,
                ]
            ]);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'queue_id' => $queueId
                ]
            ];
        }

        $list = $query->page($pagination)->orderBy(['created_at' => SORT_DESC])->asArray()->all();
        $mch = Mch::findOne(\Yii::$app->user->identity->mch_id);

        foreach ($list as &$item) {
            $item['type_data'] = \Yii::$app->serializer->decode($item['type_data']);
        }
        unset($item);

        $form = new MchSettingForm();
        $setting = $form->search();
        $setting['last_cash_list'] = [];
        if (!\Yii::$app->user->isGuest) {
            $cashList = MchCash::find()->alias('a')->select('a.type,a.type_data,a.use_qrcode')
                ->where([
                    'a.mall_id' => \Yii::$app->mall->id,
                    'a.is_delete' => 0,
                    'a.mch_id' => \Yii::$app->user->identity->mch_id
                ])->andWhere(['a.type' => ['wx', 'alipay', 'bank']])
                ->leftJoin(['b' => MchCash::tableName()], 'a.type=b.type and a.id < b.id')
                ->groupBy('a.type,a.type_data,a.use_qrcode')
                ->having('count(b.id) < 1')
                ->all();
            foreach ($cashList as $item) {
                $item['type_data'] = Json::decode($item['type_data'], true);
                $setting['last_cash_list'][$item['type']] = $item;
            }
        }

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => "请求成功",
            'data' => [
                'list' => $list,
                'setting' => $setting,
                'export_list' => (new CashLogExport())->fieldsList(),
                'pagination' => $pagination,
                'mch' => $mch
            ]
        ];
    }

    public function getOrderCloseLog()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $query = Order::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'mch_id' => \Yii::$app->user->identity->mch_id,
            'is_delete' => 0
        ])->andWhere(['!=', 'cancel_status', 1]);

        if ($this->is_transfer != -1) {
            $orderIds = MchOrder::find()->where([
                'is_transfer' => $this->is_transfer
            ])->select('order_id');
            $query->andWhere(['id' => $orderIds]);
        }

        if ($this->keyword) {
            $query->andWhere(['like', 'order_no', $this->keyword]);
        }

        if ($this->start_date && $this->end_date) {
            $query->andWhere(['<', 'created_at', $this->end_date])
                ->andWhere(['>', 'created_at', $this->start_date]);
        }

        if ($this->flag == "EXPORT") {
            $new_query = clone $query;
            $queueId = CommonExport::handle([
                'export_class' => 'app\\forms\\mall\\mch\\OrderCloseLogExport',
                'params' => [
                    'query' => $new_query,
                    'fieldsKeyList' => $this->fields,
                ]
            ]);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'queue_id' => $queueId
                ]
            ];
        }

        $list = $query->select('id,order_no,total_pay_price,created_at')
            ->with('mchOrder', 'detail.goods.goodsWarehouse')
            ->orderBy(['created_at' => SORT_DESC])
            ->page($pagination)
            ->asArray()
            ->all();

        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => "请求成功",
            'data' => [
                'list' => $list,
                'export_list' => (new OrderCloseLogExport())->fieldsList(),
                'pagination' => $pagination
            ]
        ];
    }
}
