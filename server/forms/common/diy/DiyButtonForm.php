<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\forms\common\diy;

use app\models\MallMembers;
use app\models\Model;
use app\plugins\diy\forms\api\form\GoodsEditForm;
use app\plugins\diy\models\DiyFormList;

class DiyButtonForm extends Model
{
    public function getNewData($data, $formId)
    {
        $diyFormList = DiyFormList::find()->andWhere(['id' => $formId])->one();

        $data['time_at'] = $diyFormList->time_at;
        $data['time_status'] = $diyFormList->time_status;
        $data = $this->getMemberPrice($data);

        $form = new GoodsEditForm();
        $goods = $form->save();
        $data['goods'] = [
            'id' => $goods->id,
            'attr_id' => $goods->attr[0]->id,
            'attrs' => [
                'attr_id' => 2,
                'attr_group_id' => 1
            ]
        ];
        
        return $data;
    }

    public function getMemberPrice($data)
    {
        $userLevel = !\Yii::$app->user->isGuest ? \Yii::$app->user->identity->identity->member_level : 0;
        switch ($data['pay_status']) {
            case 'alone':
                $memberPrice = $this->getAttrMemberPrice($data['pay_price'], $userLevel, $data['is_level'], $data['is_level_alone'], $data['member_price'], 0);
                $data['user_member_price'] = $memberPrice;
                break;
            case 'much':
                foreach ($data['pay_price_list'] as &$item) {
                    $memberPrice = $this->getAttrMemberPrice($item['pay_price'], $userLevel, $data['is_level'], $data['is_level_alone'], $item['member_price'], 0);

                    $item['user_member_price'] = $memberPrice;
                }
                unset($item);
                break;
            default:
                throw new \Exception('未知价格类型');
                break;
        }

        return $data;
    }

    public function getAttrMemberPrice($payPrice, $userLevel, $isLevel, $isLevelAlone, $memberPriceList, $newPrice)
    {
        $memberPrice = $payPrice;
        if ($isLevel) {
            if ($isLevelAlone && !$newPrice) {
                // 单独设置会员价
                $key = 'level' . $userLevel;
                if (!isset($memberPriceList[$key]) || !$memberPriceList[$key]) {
                    $memberPrice = '0.00';
                }

                if (isset($memberPriceList[$key]) && $memberPriceList[$key]) {
                    $memberPrice = $memberPriceList[$key];
                }
            } else {
                $member = MallMembers::find()->andWhere([
                    'mall_id' => \Yii::$app->mall->id,
                    'is_delete' => 0,
                    'level' => $userLevel
                ])->one();

                if ($member) {
                    $memberPrice = price_format($payPrice * ($member->discount / 10));
                }
            }
        }

        return $memberPrice;
    }
}
