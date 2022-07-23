<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/7/6
 * Time: 13:48
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\plugins\diy\forms\mall;


use app\core\response\ApiCode;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\template\TemplateList;
use app\forms\mall\export\CommonExport;
use app\models\Model;
use app\models\User;
use app\plugins\diy\forms\common\message\ReplyFormInfo;
use app\plugins\diy\models\DiyForm;

class InfoForm extends Model
{
    public $page;
    public $limit;
    public $keyword;
    public $date_start;
    public $date_end;
    public $fields;
    public $flag;

    public $id;
    public $content;

    public function rules()
    {
        return [
            [['page', 'limit', 'id'], 'integer'],
            [['page'], 'default', 'value' => 1],
            [['limit'], 'default', 'value' => 20],
            [['date_start', 'date_end', 'flag', 'content'], 'string'],
            [['date_start', 'date_end', 'keyword'], 'trim'],
            [['fields'], 'safe'],
        ];
    }

    public function search()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        /* @var DiyForm[] $list */
        $query = DiyForm::find()->with('user.userInfo')
            ->where(['is_delete' => 0, 'mall_id' => \Yii::$app->mall->id])
            ->andWhere([
                'or',
                ['is_pay' => 1],
                ['is_old' => 1],
            ])
            ->keyword($this->date_start, ['>=', 'created_at', $this->date_start])
            ->keyword($this->date_end, ['<=', 'created_at', $this->date_end]);

        if ($this->keyword) {
            $userIds = User::find()->andWhere(['like', 'nickname', $this->keyword])->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0
            ])->select('id');
            $query->andWhere([
                'or',
                ['id' => $this->keyword],
                ['like', 'form_list_name', $this->keyword],
                ['user_id' => $userIds]
            ]);
        }

        if ($this->flag == "EXPORT") {
            $new_query = clone $query;
            $queueId = CommonExport::handle([
                'export_class' => 'app\\plugins\\diy\\forms\\mall\\InfoExport',
                'params' => [
                    'fieldsKeyList' => $this->fields,
                    'query' => $new_query,
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

        $list = $query->page($pagination, $this->limit, $this->page)
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        $newList = [];
        foreach ($list as $item) {
            $formData = \Yii::$app->serializer->decode($item->form_data);

            // 新增图片上传数据格式转换
            if (is_array($formData) || $formData instanceof \ArrayObject) {
                foreach ($formData as &$_item) {
                    if (!isset($_item['key']) || $_item['key'] !== 'img_upload') {
                        continue;
                    }
                    if (!isset($_item['value'])) {
                        continue;
                    }
                    if (is_string($_item['value'])) {
                        $_item['value'] = [$_item['value']];
                    }
                }
            }

            $source = '';
            if ($item->extra_attributes) {
                $extra = json_decode($item->extra_attributes, true);
                if (isset($extra['diy_page'])) {
                    $diyPage = $extra['diy_page'];
                    $source = sprintf('%s(%s)', $diyPage['title'], $diyPage['id']);
                }
            }

            $extra = json_decode($item->extra_attributes, true);
            $extra['new_send_data'] = empty($extra['new_send_data']) ? null : $extra['new_send_data'];

            $newList[] = [
                'form_data' => $formData,
                'user_id' => $item->user_id,
                'nickname' => $item->user->nickname,
                'avatar' => $item->user->userInfo->avatar,
                'platform' => $value = (new PlatformConfig())->getPlatformText($item->user),
                'created_at' => $item->created_at,
                'id' => $item->id,
                'form_list_name' => $item->form_list_name,
                'form_list_id' => $item->form_list_id,
                'reply' => $item->reply,
                'reply_time' => $item->reply_time,
                'source' => $source,
                'extra' => $extra,
                'pay_price' => $item->pay_price
            ];
        }
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'msg' => '',
            'data' => [
                'list' => $newList,
                'pagination' => $pagination,
                'export_list' => (new InfoExport())->fieldsList()
            ]
        ];
    }

    public function delete()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $info = DiyForm::findOne(['id' => $this->id, 'mall_id' => \Yii::$app->mall->id]);
            if (!$info) {
                throw new \Exception('所选信息不存在');
            }
            if ($info->is_delete == 1) {
                throw new \Exception('所选信息已删除');
            }
            $info->is_delete = 1;
            if (!$info->save()) {
                throw new \Exception($this->getErrorMsg($info));
            }
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '删除成功'
            ];
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'error' => $exception
            ];
        }
    }

    public function reply()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            if (!$this->content) {
                throw new \Exception('请填写回复内容');
            }

            $info = DiyForm::findOne(['id' => $this->id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0]);
            if (!$info) {
                throw new \Exception('所选信息不存在');
            }

            $info->reply = $this->content;
            $info->reply_time = date('Y-m-d H:i:s', time());
            if (!$info->save()) {
                throw new \Exception($this->getErrorMsg($info));
            }
            try {
                TemplateList::getInstance()->getTemplateClass(ReplyFormInfo::TPL_NAME)->send([
                    'user' => $info->user,
                    'path' => '/plugins/diy/detail/detail?id=' . $info->id,
                    'date' => $info->reply_time,
                    'content' => $info->reply
                ]);
            } catch (\Exception $exception) {
                \Yii::warning($exception);
            }
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '回复成功'
            ];
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'error' => $exception
            ];
        }
    }
}
