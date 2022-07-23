<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/9
 * Time: 10:21 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\weekly_buy\forms\common\statistics;

use app\forms\mall\statistics\DataForm;
use app\plugins\weekly_buy\forms\Model;
use app\plugins\weekly_buy\models\WeeklyBuyOrderDetail;

class TableSearch extends Model
{
    /**
     * @var DataForm $dataForm
     */
    public $dataForm;

    public function search($list)
    {
        if (
            $this->dataForm->mch_id
            || ($this->dataForm->sign && $this->dataForm->sign != 'all' && $this->dataForm->sign != 'advance')
        ) {
            return $list;
        }
        if ($this->dataForm->type == 1) {
            $query = WeeklyBuyOrderDetail::find()->alias('wbod')
                ->leftJoin(['o' => $this->dataForm->table_where()], 'o.id=wbod.order_id')
                ->andWhere(['wbod.mall_id' => \Yii::$app->mall->id]);

            //天的数据需要按小时分组
            if (empty($this->dataForm->date_start) || $this->dataForm->date_start == $this->dataForm->date_end) {
                $query->select("DATE_FORMAT(`o`.`created_at`, '%H') AS `time`,
                COUNT(DISTINCT `o`.`user_id`) AS `user_num`,
                COALESCE(COUNT(DISTINCT `o`.`id`),0) AS `order_num`,
                SUM(`o`.`total_pay_price`) AS `total_pay_price`,
                SUM(`wbod`.`num` - `o`.`num`) AS `goods_num`");
            } else {
                $query->select("DATE_FORMAT(`o`.`created_at`, '%Y-%m-%d') AS `time`,
                COUNT(DISTINCT `o`.`user_id`) AS `user_num`,
                COALESCE(COUNT(DISTINCT `o`.`id`),0) AS `order_num`,
                SUM(`o`.`total_pay_price`) AS `total_pay_price`,
                SUM(`wbod`.`num` - `o`.`num`) AS `goods_num`");
            }
            $list = $query->groupBy('time')
                ->orderBy('time')
                ->asArray()
                ->all();

            if (empty($this->dataForm->date_start) || $this->dataForm->date_start == $this->dataForm->date_end) {
                $list = $this->dataForm->hour_24($list);
            } else {
                $day = floor((strtotime($this->dataForm->date_end) - strtotime($this->dataForm->date_start)) / 86400) + 1;
                $list = $this->dataForm->day_data($list, $day);
            }
        }
        return $list;
    }
}
