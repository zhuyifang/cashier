<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2021/3/26
 * Time: 10:04 上午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\mall;

use app\forms\admin\mall\MallOverrunForm;
use app\forms\common\diy\CommonTemplate;
use app\forms\common\diy\DiyTimeForm;
use app\forms\common\share\CommonShare;
use app\models\Coupon;
use app\models\GoodsCards;
use app\models\Model;
use app\plugins\diy\models\DiyFormList;
use yii\helpers\Json;

class TimeDataForm extends Model
{
    public $time;
    public $button;
    public $form_id;

    public function rules()
    {
        return [
            [['form_id'], 'integer'],
            [['time', 'button'], 'safe']
        ];
    }

    public function search()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $data = (new DiyTimeForm())->getNewData($this->time, $this->form_id, ['data' => $this->button]);
            
            return $this->success([
                'msg' => '请求成功',
                'data' => $data
            ]);
        } catch (\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
