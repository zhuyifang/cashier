<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\plugins\mch\forms\api\diy;

use app\core\response\ApiCode;
use app\forms\common\CommonAppConfig;
use app\forms\common\CommonOption;
use app\forms\common\diy\CommonPageTwo;
use app\forms\common\diy\DiyMchHomeForm;
use app\forms\common\goods\CommonGoods;
use app\forms\common\goods\CommonGoodsDetail;
use app\forms\common\goods\CommonGoodsList;
use app\forms\common\goods\CommonGoodsStatistic;
use app\forms\common\goods\GoodsAuth;
use app\forms\common\mch\SettingForm;
use app\forms\common\order\CommonOrderStatistic;
use app\forms\mall\mch\diy\CommonMchDiy;
use app\forms\mall\navbar\NavbarForm;
use app\models\Favorite;
use app\models\GoodsCats;
use app\models\Model;
use app\models\Option;
use app\models\ShareSetting;
use app\models\User;
use app\plugins\mch\Plugin;
use app\plugins\mch\models\Goods;
use app\plugins\mch\models\Mch;
use app\plugins\mch\models\MchMallSetting;
use app\plugins\mch\models\MchSetting;

class IndexForm extends Model
{
    public $mch_id;

    public function rules()
    {
        return [
            [['mch_id'], 'required'],
            [['mch_id'], 'integer']
        ];
    }

    public function getIndex()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $default = (new CommonMchDiy())->getDefault();
            $data = CommonOption::get(
                Option::NAME_MCH_DIY,
                \Yii::$app->mall->id,
                Option::GROUP_APP,
                $default,
                $this->mch_id
            );

            foreach ($data['home'] as $key => &$value) {
                if ($value['id'] == 'goods') {
                    $value['data']['mch_id'] = $this->mch_id;
                    if ($value['data']['showCat'] && empty($value['data']['catList'])) {
                        $cats = GoodsCats::find()->andWhere([
                            'mall_id' => \Yii::$app->mall->id,
                            'mch_id' => $this->mch_id,
                            'is_delete' => 0,
                            'status' => 1
                        ])->orderBy(['sort' => SORT_ASC])->all();

                        $newList = [];
                        foreach ($cats as $cat) {
                            $newItem = [
                                'goodsList' => [],
                                'goodsNum' => 30,
                                'id' => $cat->id,
                                'menuName' => $cat->name,
                                'name' => $cat->name,
                                'staticGoods' => false,
                            ];
                            $newList[] = $newItem;
                        }
                        $value['data']['catList'] = $newList;
                    }
                }
            }

            $mch = Mch::findOne($this->mch_id);
            $commonPageTwo = CommonPageTwo::getCommon(\Yii::$app->mall, null, null, $mch);
            $home = $commonPageTwo->getPage(null, null, json_encode($data['home']));

            $mchData = (new DiyMchHomeForm())->getData($this->mch_id, \Yii::$app->user);

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'data' => $home,
                    'mch' => $mchData['mch']
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

    public function getNavbar()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $navbar = CommonOption::get(
                Option::NAME_NAVBAR,
                \Yii::$app->mall->id,
                Option::GROUP_APP,
                (new NavbarForm())->getMchDefault($this->mch_id),
                $this->mch_id
            );

            foreach ($navbar['navs'] as $key => $value) {
                if (isset($value['is_show']) && $value['is_show'] == 0) {
                    unset($navbar['navs'][$key]);
                }
            }
            $navbar['navs'] = array_values($navbar['navs']);
            $navbar['navs'] = count($navbar['navs']) > 1 ? $navbar['navs'] : [];
            
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => [
                    'navbar' => $navbar,
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

    public function favorite()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $favorite = Favorite::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'user_id' => \Yii::$app->user->id,
                'favorite_mch_id' => $this->mch_id,
                'is_delete' => 0
            ])->one();

            if ($favorite) {
                throw new \Exception('已收藏过该店铺');
            }

            $favorite = new Favorite();
            $favorite->mall_id = \Yii::$app->mall->id;
            $favorite->user_id = \Yii::$app->user->id;
            $favorite->favorite_mch_id = $this->mch_id;
            $res = $favorite->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($favorite));
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '收藏成功',
                'data' => []
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function cancelfavorite()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $favorite = Favorite::find()->andWhere([
                'mall_id' => \Yii::$app->mall->id,
                'user_id' => \Yii::$app->user->id,
                'favorite_mch_id' => $this->mch_id,
                'is_delete' => 0
            ])->one();

            if (!$favorite) {
                throw new \Exception('未收藏该店铺');
            }

            $favorite->is_delete = 1;
            $res = $favorite->save();

            if (!$res) {
                throw new \Exception($this->getErrorMsg($favorite));
            }

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '取消成功',
                'data' => []
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function storeReflection()
    {
        if (!$this->validate()) {
            return $this->getErrorResponse();
        }

        try {
            $default = (new CommonMchDiy())->getDefault();
            $data = CommonOption::get(
                Option::NAME_MCH_DIY,
                \Yii::$app->mall->id,
                Option::GROUP_APP,
                $default,
                $this->mch_id
            );

            $remake = $data['remake'];
            $mch = Mch::find()->where(['id' => $this->mch_id])->with('store', 'category', 'mchSetting')->one();
            
            $data = [
                'name' => $mch->store->name,
                'mobile' => $mch->mobile,
                'service_mobile' => $mch->store->mobile,
                'longitude' => $mch->store->longitude,
                'latitude' => $mch->store->latitude,
                'cover_url' => $mch->store->cover_url,
                'pic_url' => json_decode($mch->store->pic_url, true),
                'address' => $mch->store->address,
                'description' => $mch->store->description,
                'scope' => $mch->store->scope,
                'category' => $mch->category->name,
                'wechat' => $mch->wechat,
                'business_hours' => $this->getBusinessHours($mch),
                'is_web_service' => $mch->mchSetting->is_web_service,
                'web_service_url' => $mch->mchSetting->web_service_url,
                'web_service_pic' => $mch->mchSetting->web_service_pic
            ];
            $remake['mch'] = $data;

            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '请求成功',
                'data' => $remake
            ];
        } catch (\Exception $e) {
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'line' => $e->getLine()
            ];
        }
    }

    public function getBusinessHours($mch)
    {
        $extra = json_decode($mch->store->extra_attributes, true);
        $businessHours = '';

        try {
            if ($extra['is_open'] == 1) {
                if ($extra['open_type'] == 1) {
                    $businessHours = '全天24小时营业';
                } else {
                    sort($extra['week_list']);
                    $newTime = '';
                    foreach ($extra['time_list'] as $time) {
                        $newTime .= $newTime ? sprintf('、%s-%s', substr($time['value'][0], 0, 5), substr($time['value'][1], 0, 5)) : sprintf('%s-%s', substr($time['value'][0], 0, 5), substr($time['value']['1'], 0, 5));
                    }

                    if (count($extra['week_list']) == 1) {
                        $businessHours = sprintf('%s %s', $extra['week_list'][0], $newTime);
                    } else {
                        $array = ['周日', '周一', '周二', '周三', '周四', '周五', '周六'];
                        $string = '';
                        $isSunday = false;
                        foreach ($extra['week_list'] as $week) {
                            if ($week != 0) {
                                $string .= $array[$week] . '/';
                            } else {
                                $isSunday = true;
                            }
                        }
                        $string = $string ? substr($string,0,strlen($string)-1) : $string;

                        if ($isSunday) {
                            $string .= '/' . $array[0];
                        }

                        $businessHours = sprintf('%s %s', $string, $newTime);
                    }
                }
            } else {
                $businessHours = '已打烊';
            }
        }catch(\Exception $exception) {
            \Yii::error($exception);
        }

        return $businessHours;
    }

    public function mchPoster()
    {
        try {
            $form = new MchPosterForm();
            $form->mch_id = $this->mch_id;
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
