<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/10/19
 * Time: 14:35
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace app\forms\common\share;


use app\forms\common\CommonMallMember;
use app\forms\common\message\MessageService;
use app\forms\common\platform\PlatformConfig;
use app\forms\common\template\order_pay_template\ChangeIdentityInfo;
use app\forms\common\template\TemplateList;
use app\helpers\ArrayHelper;
use app\models\Mall;
use app\models\Model;
use app\models\Share;
use app\models\ShareCash;
use app\models\ShareLevel;
use app\models\ShareSetting;
use app\models\User;
use app\models\UserInfo;

/**
 * Class CommonShareLevel
 * @package app\forms\common\share
 * @property Mall $mall
 * @property User $user
 * @property Share $share
 */
class CommonShareLevel extends Model
{
    private static $instance;
    public $mall;
    public $user;
    public $userId;
    public $share;

    public const CHILDREN_COUNT = 1; // 下线用户数
    public const TOTAL_MONEY = 2; // 累计佣金
    public const TOTAL_CASH = 3; // 已提现佣金
    public const TOTAL_CONSUME = 4; // 累计消费
    public const CHILDREN_SHARE = 5; // 下线分销商人数

    public static function getInstance($mall = null)
    {
        if (!self::$instance) {
            self::$instance = new self();
            if (!$mall) {
                $mall = \Yii::$app->mall;
            }
            self::$instance->mall = $mall;
        }
        return self::$instance;
    }

    public function getOptions()
    {
        $list = ShareLevel::find()->select('level')->where([
            'mall_id' => \Yii::$app->mall->id,
            'is_delete' => 0
        ])->column();

        $newList = [];
        for ($i = 1; $i <= 10; $i++) {
            $newList[] = [
                'name' => '等级' . $i,
                'level' => $i,
                'disabled' => in_array($i, $list),
            ];
        }

        return $newList;
    }

    /**
     * @param $id
     * @return ShareLevel|null
     */
    public function getDetail($id)
    {
        if (!$id) {
            return null;
        }
        /* @var ShareLevel $shareLevel */
        $shareLevel = ShareLevel::find()->where([
            'id' => $id,
            'mall_id' => $this->mall->id,
            'is_delete' => 0
        ])->one();
        return $this->changeV1($shareLevel);
    }

    public function destroy($id)
    {
        $shareLevel = $this->getDetail($id);
        if (!$shareLevel) {
            throw new \Exception('所选择的分销商等级不存在或已删除，请刷新后重试');
        }
        $shareExists = Share::find()->where([
            'mall_id' => $this->mall->id, 'is_delete' => 0, 'status' => 1, 'level' => $shareLevel->level
        ])->exists();
        if ($shareExists) {
            throw new \Exception('该分销商等级下还有分销商存在，暂时不能删除');
        }
        $shareLevel->new_condition_type = implode(',', $shareLevel->new_condition_type);
        $shareLevel->is_delete = 1;
        if (!$shareLevel->save()) {
            throw new \Exception($this->getErrorMsg($shareLevel));
        }
        return true;
    }

    public function switchStatus($id)
    {
        $shareLevel = $this->getDetail($id);
        if (!$shareLevel) {
            throw new \Exception('所选择的分销商等级不存在或已删除，请刷新后重试');
        }
        $shareExists = Share::find()->where([
            'mall_id' => $this->mall->id, 'is_delete' => 0, 'status' => 1, 'level' => $shareLevel->level
        ])->exists();
        if ($shareExists) {
            throw new \Exception('该分销商等级下还有分销商存在，暂时不能关闭');
        }
        $shareLevel->new_condition_type = implode(',', $shareLevel->new_condition_type);
        $shareLevel->status = $shareLevel->status ? 0 : 1;
        if (!$shareLevel->save()) {
            throw new \Exception($this->getErrorMsg($shareLevel));
        }
        return true;
    }

    /**
     * @param integer $conditionType 升级方式1--下线用户数|2--累计佣金|3--已提现佣金|4--累计消费金额|5--下线分销商人数
     * @return bool
     * @throws \Exception
     * 分销商升级等级
     */
    public function levelShare($conditionType)
    {
        $share = $this->getShare();
        if (!$share) {
            throw new \Exception('分销商不存在');
        }
        $condition = $this->getCondition($conditionType, $share);
        \Yii::error($condition);
        $configArr = array_column($this->config(), null, 'key');
        $shareLevel = $this->getCanLevel($configArr[$conditionType], $condition, $share->level);
        if (!$shareLevel) {
            \Yii::error('没有更高分销等级可升级');
            return false;
        }
        return $this->changeLevel($shareLevel->level);
    }

    /**
     * @param $level
     * @return bool
     * @throws \Exception
     */
    public function changeLevel($level)
    {
        $share = $this->getShare();
        if (!$share) {
            throw new \Exception('分销商不存在');
        }
        $change = $share->level != $level;
        $share->level = $level;
        $share->level_at = mysql_timestamp();
        if (!$share->save()) {
            \Yii::error('升级分销商等级出错');
            \Yii::error($this->getErrorMsg($share));
            return false;
        }
        if ($change) {
            $shareLevel = $this->getShareLevelByLevel($level);
            if (!$shareLevel) {
                $levelName = ShareSetting::get(\Yii::$app->mall->id, ShareSetting::DEFAULT_LEVEL_NAME, ShareSetting::INFO[ShareSetting::DEFAULT_LEVEL_NAME]);
            } else {
                $levelName = $shareLevel->name;
            }
            $this->sendTemplate($share->user, $levelName);
            $this->sendSmsToUser($share->user, '分销商', $levelName);
        }
        return true;
    }

    /**
     * @return Share|null
     * @throws \Exception
     * 获取分销商
     */
    private function getShare()
    {
//        if ($this->share) {
//            return $this->share;
//        }
        $share = null;
        if ($this->user) {
            $share = $this->user->share;
        } elseif ($this->userId) {
            $share = Share::find()->with('firstChildren')->where([
                'user_id' => $this->userId, 'is_delete' => 0, 'mall_id' => $this->mall->id, 'status' => 1
            ])->one();
        } elseif ($this->share) {
            $share = $this->share;
        }
        if (!$share) {
            throw new \Exception('不存在分销商');
        }
//        $this->share = $share;
        return $share;
    }

    /**
     * @param int $conditionType
     * @param Share $share
     * @return float
     * 获取升级条件
     */
    private function getCondition($conditionType, $share)
    {
        $condition = 0;
        switch ($conditionType) {
            case self::CHILDREN_COUNT:
                $condition = $share->all_children;
                break;
            case self::TOTAL_MONEY:
                $condition = $share->total_money;
                break;
            case self::TOTAL_CASH:
                $condition = ShareCash::find()->where([
                    'mall_id' => $this->mall->id, 'user_id' => $share->user_id, 'is_delete' => 0, 'status' => 2,
                ])->select('SUM(price)')->scalar() ?: 0;
                break;
            case self::TOTAL_CONSUME:
                $commonMallMember = new CommonMallMember();
                $mallId = $this->mall->id;
                $userId = $share->user_id;
                $orderPrice = $commonMallMember->getOrderMoneyCount($mallId, $userId);
                $condition = round($orderPrice, 2);
                break;
            case self::CHILDREN_SHARE:
                $level = ShareSetting::get($this->mall->id, 'level', 0);
                /** @var UserInfo[] $childrenList */
                $childrenList = [];
                if ($level >= 1) {
                    $childrenList = array_merge($childrenList, $share->userInfo->firstChildren);
                }
                if ($level >= 2) {
                    $childrenList = array_merge($childrenList, $share->userInfo->secondChildren);
                }
                if ($level >= 3) {
                    $childrenList = array_merge($childrenList, $share->userInfo->thirdChildren);
                }
                foreach ($childrenList as $userInfo) {
                    $condition += $userInfo->identity->is_distributor == 1 ? 1 : 0;
                }
                break;
            default:
                break;
        }
        return $condition;
    }

    protected $shareLevelList;

    /**
     * @param $level
     * @return ShareLevel|null
     * 通过分销商等级来获取分销等级
     */
    public function getShareLevelByLevel($level)
    {
        if (!$level) {
            return null;
        }
        if (isset($this->shareLevelList[$level]) && $this->shareLevelList[$level]) {
            return $this->shareLevelList[$level];
        }
        /* @var ShareLevel $shareLevel */
        $shareLevel = ShareLevel::find()->where([
            'level' => $level,
            'mall_id' => $this->mall->id,
            'is_delete' => 0
        ])->one();
        $this->shareLevelList[$level] = $this->changeV1($shareLevel);
        return $this->shareLevelList[$level];
    }

    /**
     * 手动升级到可升级的最高等级
     * @return array
     * @throws \Exception
     */
    public function levelUp()
    {
        $share = $this->getShare();
        if (!$share) {
            throw new \Exception('用户不是分销商，无法升级分销商等级');
        }
        /* @var ShareLevel $shareLevel */
        $shareLevel = null;
        $contentText = null;
        $config = $this->config();
        foreach ($config as $item) {
            $condition = $this->getCondition($item['key'], $share);
            $temp = $this->getCanLevel($item, $condition, $share->level);
            if ($temp && (!$shareLevel || ($shareLevel->level < $temp->level))) {
                $shareLevel = $temp;
                $contentText = $item['name'] . '达到' . $shareLevel[$item['value']] . $item['unit'];
            }
        }
        if (!$shareLevel) {
            return [
                'status' => 0,
                'level_name' => '未达成条件',
                'condition_text' => '未满足升级条件'
            ];
        } else {
            $this->changeLevel($shareLevel->level);
            return [
                'status' => 1,
                'level_name' => '成功升级为' . $shareLevel->name,
                'condition_text' => $contentText,
            ];
        }
    }

    public function getList()
    {
        $shareLevelList = ShareLevel::find()->where([
            'mall_id' => \Yii::$app->mall->id, 'is_delete' => 0, 'status' => 1,
        ])->select(['id', 'level', 'name'])->orderBy(['level' => SORT_ASC])->all();
        array_unshift($shareLevelList, [
            'id' => 0,
            'level' => 0,
            'name' => ShareSetting::get(\Yii::$app->mall->id, ShareSetting::DEFAULT_LEVEL_NAME, ShareSetting::INFO[ShareSetting::DEFAULT_LEVEL_NAME])
        ]);
        return $shareLevelList;
    }

    public function config()
    {
        return [
            [
                'key' => self::CHILDREN_COUNT,
                'name' => '下线用户数',
                'unit' => '人',
                'value' => 'condition_user'
            ],
            [
                'key' => self::TOTAL_MONEY,
                'name' => '累计佣金',
                'unit' => '元',
                'value' => 'condition_total_share_money'
            ],
            [
                'key' => self::TOTAL_CASH,
                'name' => '已提现佣金',
                'unit' => '元',
                'value' => 'condition_cash'
            ],
            [
                'key' => self::TOTAL_CONSUME,
                'name' => '累计消费',
                'unit' => '元',
                'value' => 'condition_total_consume'
            ],
            [
                'key' => self::CHILDREN_SHARE,
                'name' => '下线分销商人数',
                'unit' => '人',
                'value' => 'condition_share'
            ],
        ];
    }

    public function sendTemplate($user, $remark)
    {
        try {
            TemplateList::getInstance()->getTemplateClass(ChangeIdentityInfo::TPL_NAME)->send([
                'remark' => $remark,
                'time' => date('Y-m-d H:i:s', time()),
                'user' => $user,
                'page' => 'pages/user-center/user-center'
            ]);
        } catch (\Exception $exception) {
            \Yii::error('模板消息发送: ' . $exception->getMessage());
        }
    }

    /**
     * @param User $user
     * @param $remark
     * @return $this
     * 向用户发送短信提醒
     */
    protected function sendSmsToUser($user, $remark, $name)
    {
        try {
            \Yii::warning('----消息发送提醒----');
            if (!$user->mobile) {
                throw new \Exception('用户未绑定手机号无法发送');
            }
            $messageService = new MessageService();
            $messageService->user = $user;
            $messageService->content = [
                'mch_id' => 0,
                'args' => [$remark, $name]
            ];
            $messageService->platform = PlatformConfig::getInstance()->getPlatform($user);
            $messageService->tplKey = ChangeIdentityInfo::TPL_NAME;
            $messageService->templateSend();
        } catch (\Exception $exception) {
            \Yii::error('向用户发送短信消息失败');
            \Yii::error($exception);
        }
        return $this;
    }

    /**
     * 兼容之前单选条件 将condition_type值转化为new_condition_type值，将condition值转化为相应的条件值
     * @param ShareLevel $shareLevel
     * @retrun ShareLevel
     */
    public function changeV1($shareLevel)
    {
        if (!$shareLevel) {
            return $shareLevel;
        }
        if ($shareLevel->new_condition_type) {
            $shareLevel->new_condition_type = ArrayHelper::explode(',', $shareLevel->new_condition_type, true);
            return $shareLevel;
        }
        // 将condition_type值转化为new_condition_type值
        $shareLevel->new_condition_type = [$shareLevel->condition_type];
        // 根据旧版的condition_type值，将condition转化为新版的条件值
        switch ($shareLevel->condition_type) {
            case self::CHILDREN_COUNT:
                $shareLevel->condition_user = intval($shareLevel->condition);
                break;
            case self::TOTAL_MONEY:
                $shareLevel->condition_total_share_money = $shareLevel->condition;
                break;
            case self::TOTAL_CASH:
                $shareLevel->condition_cash = $shareLevel->condition;
                break;
            case self::TOTAL_CONSUME:
                $shareLevel->condition_total_consume = $shareLevel->condition;
                break;
            default:
        }
        return $shareLevel;
    }

    /**
     * 根据指定条件获取可升级的分销等级
     * @param array $item getConfig()的子数组
     * @param string $condition 判断的条件
     * @param integer $level 现在的分销等级
     * @return ShareLevel
     */
    public function getCanLevel($item, $condition, $level)
    {
        /* @var ShareLevel $temp */
        $temp = ShareLevel::find()->where([
            'mall_id' => $this->mall->id, 'is_delete' => 0, 'status' => 1,
            'is_auto_level' => 1
        ])->andWhere([
            'or',
            [
                'and',
                ['condition_type' => $item['key'], 'new_condition_type' => ''],
                ['<=', 'condition', $condition],
            ],
            [
                'and',
                ['<=', $item['value'], $condition],
                'find_in_set(\'' . $item['key'] . '\',`new_condition_type`)'
            ]
        ])
            ->andWhere(['>', 'level', $level])
            ->orderBy(['level' => SORT_DESC])
            ->one();
        return $temp;
    }

    /**
     * 携带当前值的升级条件配置
     * @param Share $share
     * @return array[]
     */
    public function configWithCondition($share)
    {
        $config = $this->config();
        foreach ($config as &$item) {
            $item['condition'] = $this->getCondition($item['key'], $share);
        }
        unset($item);
        return $config;
    }
}
