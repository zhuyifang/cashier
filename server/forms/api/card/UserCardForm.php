<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/2/15
 * Time: 14:58
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\api\card;


use app\core\response\ApiCode;
use app\forms\common\CommonQrCode;
use app\forms\common\card\CommonUserCard;
use app\forms\common\platform\PlatformConfig;
use app\models\ClerkUser;
use app\models\GoodsCardStoreRelation;
use app\models\GoodsCards;
use app\models\Model;
use app\models\QrCodeParameter;
use app\models\Store;
use app\models\User;
use app\models\UserCard;
use app\models\UserInfo;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class UserCardForm extends Model
{
    public $cardId;
    public $mall;
    public $user;

    public $is_clerk;
    public $clerk_id;
    public $keyword;
    public $use_number;
    public $qr_code_id;

    public $card_id;
    public $longitude;
    public $latitude;

    public function rules()
    {
        return [
            [['cardId', 'is_clerk', 'clerk_id', 'use_number', 'qr_code_id', 'card_id'], 'integer'],
            [['keyword', 'longitude', 'latitude'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'use_number' => '核销次数'
        ];
    }

    public function getList()
    {
        try {
            $query = UserCard::find()->with(['user.userPlatform', 'user.userInfo'])
                ->andWhere(['is_delete' => 0, 'mall_id' => \Yii::$app->mall->id]);

            $otherWhere = [];
            if ($this->is_clerk && $this->is_clerk == 1) {
                $otherWhere[] = ['is_use' => 1]; 
            }

            if ($this->is_clerk && $this->is_clerk == 2) {
                $otherWhere[] = ['is_use' => 0];
            }


            if ($this->clerk_id) {
                $otherWhere[] = ['clerk_id' => $this->clerk_id];
            } else {
                $otherWhere[] = ['>', 'end_time', date('Y-m-d H:i:s', time())];
            }

            if ($this->is_clerk == 2) {
                // 筛选当前核销员可核销的卡券
                $clerkUser = ClerkUser::find()->andWhere([
                    'mall_id' => \Yii::$app->mall->id,
                    'mch_id' => \Yii::$app->user->identity->mch_id,
                    'user_id' => \Yii::$app->user->id,
                    'is_delete' => 0
                ])
                    ->with('storeRelation')
                    ->one();
                $cardIds = GoodsCardStoreRelation::find()->andWhere([
                    'store_id' => $clerkUser->storeRelation->store_id,
                    'is_delete' => 0,
                    'mall_id' => \Yii::$app->mall->id,
                    'mch_id' => \Yii::$app->user->identity->mch_id,
                ])->select('card_id');

               $cardIds = GoodsCards::find()->andWhere([
                    'or',
                    ['use_type' => 0],
                    ['id' => $cardIds]
                ])->select('id');
               $query->andWhere(['card_id' => $cardIds, 'receive_id' => 0]);

                array_unshift($otherWhere, 'and');
                $query->andWhere($otherWhere);
            } else {
                array_unshift($otherWhere, 'and');
                $query->andWhere([
                    'or',
                    $otherWhere,
                    ['>', 'receive_id', 0]
                ]);
            }
            
            if ($this->keyword) {
                $userIds = UserInfo::find()->andWhere(['like', 'remark_name', $this->keyword])->select('user_id');
                $userIds = User::find()
                    ->andWhere([
                        'or',
                        ['like', 'nickname', $this->keyword],
                        ['like', 'mobile', $this->keyword],
                        ['id' => $userIds],
                    ])
                    ->andWhere(['mall_id' => \Yii::$app->mall->id])
                    ->select('id');

                $query->andWhere(['or', ['user_id' => $userIds], ['like', 'name', $this->keyword]]);
            }

            $list = $query
                ->orderBy('id desc')
                ->with('user.userInfo', 'store')
                ->page($pagination)
                ->all();

            $newList = [];
            /** @var UserCard $item */
            foreach ($list as $item) {
                $userPlatformDetail = PlatformConfig::getInstance()->getPlatformDetail($item->user);
                $newItem = [];
                $newItem['id'] = $item->id;
                $newItem['card_id'] = $item->card_id;
                $newItem['is_use'] = $item->is_use;
                $newItem['name'] = $item->name;
                $newItem['nickname'] = $item->user->nickname;
                $newItem['remark_name'] = $item->user->userInfo->remark_name;
                $newItem['pic_url'] = $item->pic_url;
                $newItem['platform'] = $userPlatformDetail['platform'];
                $newItem['platform_icon'] = $userPlatformDetail['platform_icon'];
                $newItem['store_id'] = $item->store_id;
                $newItem['store_name'] = $item->store ? $item->store->name : '';
                $newItem['user_id'] = $item->user_id;
                $newItem['number'] = $item->number;
                $newItem['use_number'] = $item->use_number;
                $newItem['receive_id'] = $item->receive_id;
                $newItem = array_merge($newItem, $item->getNewItem($item));
                $newList[] = $newItem;
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '',
                'data' => [
                    'pagination' => $pagination,
                    'list' => $newList
                ]
            ];
        } catch (Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'error' => $e
            ];
        }
    }

    public function getDetail()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $common = new CommonUserCard();
            $common->mall = $this->mall;
            $common->user = $this->user;
            $common->cardId = $this->cardId;
            $common->userId = $this->user->id;
            /** @var UserCard $card */
            $card = $common->detail();

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'card' => $this->getUserCard($card)
                ]
            ];
        } catch (Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'error' => $e
            ];
        }
    }

    /**
     * @param UserCard $card
     * @return array
     * @throws \Exception
     */
    public function getUserCard($card)
    {
        $newCard = ArrayHelper::toArray($card);
        $newCard['card_name'] = $card->name;
        $newCard['endTime'] = strtotime($card->end_time);
        $newCard['cancel_status'] = $card->order ? $card->order->cancel_status : 0;
        $newCard['name'] = $card->order ? $card->order->name : '';
        $newCard['mobile'] = $card->order ? $card->order->mobile : '';
        $newCard['start_time'] = new_date($card->start_time);
        $newCard['end_time'] = new_date($card->end_time);
        $newCard['clerked_at'] = new_date($card->clerked_at);
        $newCard['created_at'] = new_date($card->created_at);
        $newCard['receive_id'] = $card->receive_id;
        $newCard['receive_user_name'] = '';
        $newCard['nickname'] = $card->user ? $card->user->nickname : '';
        $newCard['platform_icon'] = $card->user ? PlatformConfig::getInstance()->getPlatformIcon($card->user) : '';
        $newCard['remark_name'] = $card->user && $card->user->userInfo ? $card->user->userInfo->remark_name : '';
        if ($card->receive_id > 0) {
            $receive = User::findOne(['id' => $card->receive_id]);
            $newCard['receive_user_name'] = $receive->nickname;
            $newCard['status'] = 0; // 卡券已转赠
        } elseif ($card->is_use == 0 && $card->end_time > mysql_timestamp()) {
            $newCard['status'] = 1; // 卡券未使用
        } elseif ($card->is_use == 1) {
            $newCard['status'] = 2; // 卡券已使用
        } else {
            $newCard['status'] = 3; // 卡券已过期
        }
        $newItem = $card->getNewItem($card);
        $newCard = array_merge($newCard, $newItem);

        // 用户卡券详情页面有用到
        if (isset($this->qr_code_id) && $this->qr_code_id != -1 && $card->receive_id == 0) {
            $qrCodeParameter = QrCodeParameter::find()->andWhere(['id' => $this->qr_code_id, 'mall_id' => \Yii::$app->mall->id])->one();
            if (!$qrCodeParameter) {
                throw new \Exception("数据异常");
            }
            $newCard['clerk_number'] = $qrCodeParameter->use_number;
        }
        $newCard['app_share_title'] = $card->card->app_share_title;
        $newCard['app_share_pic'] = $card->card->app_share_pic;
        $newCard['is_allow_send'] = $card->card->is_allow_send;


        $query = Store::find()->andWhere([
            'mall_id' => \Yii::$app->mall->id,
            'mch_id' => \Yii::$app->user->identity->mch_id,
            'is_delete' => 0,
            'status' => 1,
        ]);
        // 自定义可使用门店
        if ($card->card->use_type == 1) {
            $storeIds = [];
            foreach ($card->card->storeRelation as $item) {
                $storeIds[] = $item->store_id;
            }
            $query->andWhere(['id' => $storeIds]);
        }

        $query2 = clone $query;
        $storeCount = $query->count();
        $storeList = $query2->orderBy(['created_at' => SORT_DESC])->limit(2)->all();
        $newCard['store_list'] = $storeList;
        $newCard['store_count'] = (int)$storeCount;
        $newCard['is_store_permission'] = $this->checkStorePermission($card);

        return $newCard;
    }

    private function checkStorePermission($card)
    {
        $isTrue = 1;
        try {
            $clerkUser = ClerkUser::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'user_id' => \Yii::$app->user->id,
                'is_delete' => 0
            ])
                ->with('storeRelation')
                ->one();
            $cardIds = GoodsCardStoreRelation::find()->andWhere([
                'store_id' => $clerkUser->storeRelation->store_id,
                'is_delete' => 0,
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
            ])->select('card_id');

           $card = GoodsCards::find()->andWhere([
                'or',
                ['use_type' => 0],
                ['id' => $cardIds]
            ])->andWhere(['id' => $card->card_id])->one();

           $isTrue = $card ? 1 : 0;
        }catch(\Exception $exception) {
            \Yii::error($exception);
        }

        return $isTrue;
    }

    public function clerk()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($this->qr_code_id != -1) {
                $qrCodeParameter = QrCodeParameter::find()->andWhere(['id' => $this->qr_code_id, 'mall_id' => \Yii::$app->mall->id, 'use_number' => 0])->one();
                if (!$qrCodeParameter) {
                    throw new \Exception("核销码已失效");
                }

                $qrCodeParameter->use_number = $qrCodeParameter->use_number + 1;
                $res = $qrCodeParameter->save();
                if (!$res) {
                    throw new \Exception($this->getErrorMsg($qrCodeParameter));
                }
            }

            if (!$this->use_number || $this->use_number < 1) {
                throw new \Exception('请输入核销次数');
            }



            $common = new CommonUserCard();
            $common->mall = $this->mall;
            $common->user = $this->user;
            $common->cardId = $this->cardId;
            $common->user = \Yii::$app->user->identity;
            $common->use_number = $this->use_number;
            $res = $common->clerk();

            //权限判断，用以核销后返回的页面判断
            $is_clerk = 1;
            $permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
            if (empty(\Yii::$app->plugin->getInstalledPlugin('clerk')) || !in_array('clerk', $permission) || empty(ClerkUser::findOne(['user_id' => \Yii::$app->user->id, 'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0]))) {
                $is_clerk = 0;
            }
            $msg = $res['surplus_number'] > 0 ? '核销成功(剩余' . $res['surplus_number'] . '次)' : '核销成功';

            $transaction->commit();
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => $msg,
                'data' => [
                    'is_clerk' => $is_clerk,
                    'surplus_number' => $res['surplus_number']
                ]
            ];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'errors' => $e
            ];
        }
    }

    public function qrcode()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }
        try {
            $commonCard = new CommonUserCard();
            $commonCard->cardId = $this->cardId;
            $commonCard->mall = \Yii::$app->mall;
            $userCard = $commonCard->detail();
            if ($userCard->receive_id > 0) {
                throw new \Exception('卡券已转赠，无法生成核销码');
            }
            $common = new CommonQrCode();
            $img = $common->getQrCode(['cardId' => $this->cardId], 430, 'pages/card/clerk/clerk');
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '',
                'data' => $img
            ];
        } catch (\Exception $exception) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $exception->getMessage()
            ];
        }
    }

    public function getCardStoreList()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $card = GoodsCards::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'is_delete' => 0,
                'id' => $this->card_id
            ])->one();

            if (!$card) {
                throw new \Exception('卡券不存在');
            }

            $query = Store::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'mch_id' => \Yii::$app->user->identity->mch_id,
                'is_delete' => 0,
                'status' => 1,
            ]);
            // 自定义可使用门店
            if ($card->use_type == 1) {
                $storeIds = [];
                foreach ($card->storeRelation as $item) {
                    $storeIds[] = $item->store_id;
                }
                $query->andWhere(['id' => $storeIds]); 
            }

            $storeList = $query->orderBy(['created_at' => SORT_DESC])->select(['*', "(st_distance(point(longitude, latitude), point($this->longitude, $this->latitude)) * 111195) as distance"])
                ->page($pagination)
                ->asArray()
                ->all();

            $newList = [];
            foreach ($storeList as $item) {
                if ($item['distance'] >= 1000) {
                    $distance = round($item['distance'] / 1000, 2) . 'km';
                } else {
                    $distance = round($item['distance'], 2) . 'm';
                }

                $newList[] = [
                    'id' => (int)$item['id'],
                    'name' => $item['name'],
                    'score' => $item['score'],
                    'cover_url' => $item['cover_url'],
                    'mobile' => $item['mobile'],
                    'longitude' => $item['longitude'],
                    'latitude' => $item['latitude'],
                    'distance' => $distance,
                ];
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'list' => $newList,
                    'pagination' => $pagination
                ]
            ];
        }catch(\Exception $exception) {
            return $this->failByException($exception);
        }
    }
}
