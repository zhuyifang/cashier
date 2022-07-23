<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/3/25
 * Time: 2:42 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\mall;

use app\forms\common\share\CommonShare;
use app\models\Model;
use app\plugins\diy\models\DiyFormList;
use yii\helpers\Json;

class FormListForm extends Model
{
    public $keyword;
    public $page;
    public $limit;

    public function rules()
    {
        return [
            [['keyword'], 'trim'],
            [['keyword'], 'string'],
            [['page', 'limit'], 'integer'],
            [['page'], 'default', 'value' => 1],
            [['limit'], 'default', 'value' => 20],
        ];
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $pagination = null;
            $list = DiyFormList::find()->where([
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0
            ])->keyword($this->keyword !== 0, [
                'or',
                ['like', 'name', $this->keyword],
                ['id' => $this->keyword]
            ])->orderBy(['id' => SORT_DESC])
                ->page($pagination, $this->limit, $this->page)
                ->all();
            $newList = [];
            // 判断分销是否开启 -1表示未开启分销
            $isShare = CommonShare::getCommon()->getIsShare();
            /* @var DiyFormList[] $list */
            foreach ($list as $item) {
                $newList[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'status' => $item->status,
                    'limit' => $item->limit,
                    'tip' => $item->tip,
                    'time' => $item->updated_at,
                    'data' => Json::decode($item->form_data, true),
                    'is_share' => $isShare != -1 ? $item->is_share : -1,
                    'time_status' => $item->time_status,
                    'time_at' => $item->time_at,
                ];
            }
            return $this->success([
                'list' => $newList,
                'pagination' => $pagination,
                'is_share' => $isShare
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
