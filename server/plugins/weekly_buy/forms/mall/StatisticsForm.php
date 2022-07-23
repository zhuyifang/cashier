<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/5/26
 * Time: 1:55 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\mall;

use app\forms\mall\export\CommonExport;
use app\models\Goods;
use app\models\GoodsWarehouse;
use app\models\OrderDetail;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\Order;
use app\plugins\weekly_buy\models\WeeklyBuyOrderDetail;
use app\plugins\weekly_buy\Plugin;

class StatisticsForm extends Model
{
    public $name;

    public $date_start;
    public $date_end;

    public $order;

    public $page;
    public $flag;
    public $limit;

    public function rules()
    {
        return [
            [['page', 'limit'], 'integer'],
            [['page',], 'default', 'value' => 1],
            [['name', 'order', 'flag'], 'string'],
            [['date_start', 'date_end'], 'trim'],
        ];
    }

    public function search()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $query = $this->where();
        $query->select([
            'wbod.main_goods_id as goods_id',
            'sum(wbod.num) as goods_num',
            'sum(od.total_price) as total_price',
            'sum(wbod.week_number) as week_number',
            'COUNT(DISTINCT o.user_id) as user_num'
        ])->groupBy('wbod.main_goods_id');

        if ($this->flag == "EXPORT") {
            $new_query = clone $query;
            return $this->export($new_query);
        }

        $list = $query
            ->page($pagination)
            ->asArray()
            ->all();

        foreach ($list as &$item) {
            $item['name'] = $item['goods']['goodsWarehouse']['name'];
            $item['cover_pic'] = $item['goods']['goodsWarehouse']['cover_pic'];
        }

        return $this->success([
            'pagination' => $pagination,
            'list' => $list,
        ]);
    }

    protected function where()
    {
        $query = Order::find()->alias('o')
            ->rightJoin(['od' => OrderDetail::tableName()], 'od.order_id = o.id')
            ->where([
                'o.mall_id' => \Yii::$app->mall->id, 'o.sign' => (new Plugin())->getName(), 'o.is_delete' => 0,
                'o.is_recycle' => 0, 'o.is_pay' => 1, 'od.is_delete' => 0
            ])->rightJoin(['wbod' => WeeklyBuyOrderDetail::tableName()], 'wbod.order_detail_id=od.id')
            ->with(['goods.goodsWarehouse']);

        if ($this->name) {
            $goods_query = Goods::find()->alias('g')
                ->leftJoin(['gw' => GoodsWarehouse::tableName()], 'gw.id = g.goods_warehouse_id')
                ->where(['g.sign' => (new Plugin())->getName(), 'g.is_delete' => 0])
                ->andWhere(['like', 'gw.name', $this->name])->select('g.id');
            $query->andWhere(['in', 'wbod.main_goods_id', $goods_query]);
        }
        //时间查询
        if ($this->date_start) {
            $query->andWhere(['>=', 'o.created_at', $this->date_start . ' 00:00:00']);
        }

        if ($this->date_end) {
            $query->andWhere(['<=', 'o.created_at', $this->date_end . ' 23:59:59']);
        }

        $query->orderBy(!empty($this->order) ? $this->order : 'wbod.`main_goods_id` desc');

        return $query;
    }


    protected function export($query)
    {
        $queueId = CommonExport::handle([
            'export_class' => 'app\\plugins\\weekly_buy\\forms\\mall\\StatisticsExport',
            'params' => [
                'query' => $query
            ]
        ]);

        return $this->success([
            'msg' => '请求成功',
            'queue_id' => $queueId
        ]);
    }
}
