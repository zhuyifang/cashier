<?php

namespace app\forms\api;

use app\core\response\ApiCode;
use app\forms\common\CommonOption;
use app\forms\common\CommonQrCode;
use app\forms\common\diy\CommonPageTwo;
use app\forms\common\goods\CommonGoodsList;
use app\forms\common\video\Video;
use app\forms\mall\topic\CommonTopicForm;
use app\models\Model;
use app\models\Option;
use app\models\Topic;
use app\models\TopicFavorite;
use app\models\TopicType;
use app\utils\GetInfo;
use yii\helpers\ArrayHelper;

class TopicForm extends Model
{
    public $page;
    public $limit;
    public $id;
    public $tag_id;
    public $is_favorite;
    public $keyword;

    public function rules()
    {
        return [
            [['id', 'limit', 'tag_id'], 'integer',],
            [['limit',], 'default', 'value' => 10],
            [['is_favorite', 'keyword'], 'string'],
        ];
    }

    public function type()
    {
        if (!$this->validate()) {
            return $this->errorResponse;
        }

        $list = TopicType::find()->where([
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0,
            'status' => 1
        ])
            ->orderBy('sort ASC,id DESC')
            ->all();

        $newList = array_map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'extra_attributes' => $item->extra_attributes ? json_decode($item->extra_attributes, true) : [
                    'color' => '#ff4544'
                ],
            ];
        }, $list);
        return [
            'code' => ApiCode::CODE_SUCCESS,
            'data' => [
                'list' => $newList
            ]
        ];
    }

    public function search()
    {
        if (!$this->validate()) {
            return $this->errorResponse;
        }

        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {

            $query = Topic::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0,
                'is_show' => 1,
            ]);

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'title', $this->keyword],
                    ['like', 'abstract', $this->keyword]
                ]);
            }

            if ($this->tag_id) {
                $query->andWhere(['type' => $this->tag_id]);
            }

            $tagIds = TopicType::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0,
                'status' => 1
            ])->select('id');


            $list = $query->with('topicType')
                ->andWhere(['type' => $tagIds])
                ->orderBy(['sort' => SORT_ASC, 'created_at' => SORT_DESC])
                ->page($pagination, 10)
                ->all();

            $newList = array_map(function($item) {
                $readNumber = $item->read_number + $item->virtual_read_count;
                $readNumber = $readNumber > 100000 ? '10w+' : $readNumber;

                $tag = null;
                if ($item->topicType) {
                    $tag = [
                        'id' => $item->topicType->id,
                        'name' => $item->topicType->name,
                        'extra_attributes' => $item->topicType && $item->topicType->extra_attributes ? json_decode($item->topicType->extra_attributes, true) : [
                            'color' => '#ff4544'
                        ]
                    ];
                }

                $layoutType = $item->layout;
                $picList = $item->pic_list ? json_decode($item->pic_list, true) : [];
                if ($item->is_old == 1) {
                    foreach ($picList as &$pItem) {
                        $pItem['pic_url'] = $pItem['url'];
                    }

                    if ($item->layout == 1 || $item->layout == 0) {
                        $picList[] = ['pic_url' => $item->cover_pic];
                    }

                    $layoutType = $item->layout == 1 ? 1 : 2;
                }

                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'layout_type' => $layoutType,
                    'pic_url' => $picList,
                    'tag' => $tag,
                    'abstract' => $item->abstract,
                    'read_number' => $readNumber,
                    'proportion' => $item->proportion,
                    'goods_list' => (new CommonTopicForm())->getGoodsList($item)
                ];
            }, $list);
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'list' => $newList,
                    'pagination' => $pagination
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function detail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $detail = Topic::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'is_delete' => 0,
                'is_show' => 1,
                'id' => $this->id
            ])
                ->with('topicType')
                ->one();

            if (!$detail) {
                throw new \Exception('专题不存在');
            }

            $detail->read_number = $detail->read_number + 1;
            $res = $detail->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($detail));
            }

            $readNumber = $detail->read_number + $detail->virtual_read_count;
            $readNumber = $readNumber > 100000 ? '10w+' : $readNumber;

            $tag = null;
            if ($detail->topicType) {
                $tag = [
                    'id' => $detail->topicType->id,
                    'name' => $detail->topicType->name,
                    'extra_attributes' => json_decode($detail->topicType->extra_attributes, true)
                ];
            }

            $favorite = TopicFavorite::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'user_id' => \Yii::$app->user->id,
                'topic_id' => $detail->id,
                'is_delete' => 0
            ])->one();

            $extra = [];
            if(!empty($detail->detail)){
                $commonPageTwo = CommonPageTwo::getCommon(\Yii::$app->mall);
                $extra = $commonPageTwo->getPage(null, null, $detail->detail);
            }


            $picList = $detail->pic_list ? json_decode($detail->pic_list, true) : [];
            if ($detail->is_old == 1) {
                foreach ($picList as &$pItem) {
                    $pItem['pic_url'] = $pItem['url'];
                }

                if ($detail->layout == 1 || $detail->layout == 0) {
                    $picList[] = ['pic_url' => $detail->cover_pic];
                }

                $extra[] = [
                    'id' => 'image-text',
                    'data' => [
                        'content' => $detail->content,
                        'bg' => '#FFFFFF'
                    ],
                    'active' => false,
                    'key' => time(),
                    'permission_key' => ''
                ];
            }

            foreach ($extra as $key => $value) {
                if ($value['id'] == 'image-text') {
                    $extra[$key]['data']['content'] = $this->transTxvideo($value['data']['content']);
                }
            }

            $newItem = [
                'id' => $detail->id,
                'title' => $detail->title,
                'layout_type' => $detail->layout,
                'pic_url' => $picList,
                'abstract' => $detail->abstract,
                'share_title' => $detail->app_share_title,
                'share_pic_url' => $detail->qrcode_pic,
                'tag' => $tag,
                'read_number' => $readNumber,
                'add_goods_list' => (new CommonTopicForm())->getGoodsList($detail),
                'detail' => $extra,
                'is_favorite' => $favorite ? 1 : 0,
                'qr_code_url' => $this->getQrcodeUrl()
            ];

            $transaction->commit();
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'detail' => $newItem,
                ]
            ];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    private function getQrcodeUrl()
    {
        $extra = CommonOption::get(Option::NAME_TOPIC_QRCODE, \Yii::$app->mall->id, Option::GROUP_APP);

        $qrcodeUrl = isset($extra['qr_code_url']) ? $extra['qr_code_url'] : '';
        $baseQrcodeUrl = isset($extra['base_qr_code_url']) ? $extra['base_qr_code_url'] : '';
        if (!file_exists($baseQrcodeUrl)) {
            try {
                $commonQrCode = new CommonQrCode();
                $code = $commonQrCode->getQrCode([], 124, 'pages/index/index');
                $extra['qr_code_url'] = $code['file_path'];
                $extra['base_qr_code_url'] = $commonQrCode->qrcode_save_path;
                
                CommonOption::set(OPtion::NAME_TOPIC_QRCODE, $extra, \Yii::$app->mall->id, Option::GROUP_APP);

                $qrcodeUrl = $extra['qr_code_url'];
            }catch(\Exception $exception) {
                
            }
        }      
        return $qrcodeUrl;
    }

    public function favorite()
    {
        if (!$this->validate()) {
            return $this->errorResponse;
        }

        $form = TopicFavorite::findOne([
            'user_id' => \Yii::$app->user->identity->id,
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0,
            'topic_id' => $this->id,
        ]);

        if ($this->is_favorite == 'no_love' && $form) {
            $form->is_delete = 1;
            $form->deleted_at = date('Y-m-d');
            $form->save();
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '取消成功'
            ];
        }

        if ($this->is_favorite == 'love') {
            if ($form) {
                return [
                    'code' => ApiCode::CODE_SUCCESS,
                    'msg' => '收藏成功'
                ];
            }

            $favorite = new TopicFavorite();
            $favorite->mall_id = \Yii::$app->mall->id;
            $favorite->user_id = \Yii::$app->user->identity->id;
            $favorite->topic_id = $this->id;
            if ($favorite->save()) {
                return [
                    'code' => ApiCode::CODE_SUCCESS,
                    'msg' => '收藏成功',
                ];
            }
            return $this->getErrorResponse($favorite);
        }
    }

    private function transTxvideo($content)
    {
        preg_match_all("/https\:\/\/v\.qq\.com[^ '\"]+\.html/i", $content, $match_list);
        if (!is_array($match_list) || count($match_list) == 0) {
            return $content;
        }
        $url_list = $match_list[0];
        foreach ($url_list as $url) {
            $res = GetInfo::getVideoInfo($url);
            if ($res['code'] == 0) {
                $new_url = $res['url'];
                $content = str_replace('src="' . $url . '"', 'src="' . $new_url . '"', $content);
            }
        }
        return $content;
    }

    public function poster()
    {
        try {
            $form = new TopicPosterForm();
            $form->id = $this->id;
            $poster = $form->build();

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'pic_url' => $poster['qrcode_url']
                ]
            ];
        } catch(\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage(),
                'line' => $exception->getLine(),
            ];
        }
    }
}
