<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/10/19
 * Time: 13:53
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\mall\share;


use app\core\response\ApiCode;
use app\forms\common\share\CommonShareLevel;
use app\models\Model;
use app\models\ShareLevel;
use app\models\ShareSetting;

class LevelForm extends Model
{
    public $keyword;
    public $page;

    public function rules()
    {
        return [
            [['keyword'], 'string'],
            [['keyword'], 'trim'],
            [['page'], 'integer'],
            [['page'], 'default', 'value' => 1]
        ];
    }

    public function getList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        $list = ShareLevel::find()->where([
            'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0
        ])->keyword($this->keyword, ['like', 'name', $this->keyword])
            ->page($pagination, 20, $this->page)->orderBy(['level' => SORT_ASC])->all();
        $level = ShareSetting::get(\Yii::$app->mall->id, ShareSetting::LEVEL, 0);
        $common = CommonShareLevel::getInstance();
        $config = $common->config();
        $newList = [];
        /** @var ShareLevel[] $list */
        foreach ($list as &$item) {
            $item = $common->changeV1($item);
            switch ($level) {
                case 0:
                    $item->first = -1;
                    $item->second = -1;
                    $item->third = -1;
                    break;
                case 1:
                    $item->second = -1;
                    $item->third = -1;
                    break;
                case 2:
                    $item->third = -1;
                    break;
                default:
            }
            $newItem = $item->toArray();
            $newItem['condition_list'] = [];
            foreach ($config as $value) {
                if (in_array($value['key'], $newItem['new_condition_type'])) {
                    $newItem['condition_list'][] = [
                        'key' => $value['name'],
                        'value' => $newItem[$value['value']]
                    ];
                }
            }
            $newList[] = $newItem;
        }
        unset($item);
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '',
            'data' => [
                'list' => $newList,
                'pagination' => $pagination
            ]
        ];
    }
}
