    <?php
/**
 * Created by PhpStorm.
 * User: fjt
 * Date: 2019/12/7
 * Time: 11:46
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
Yii::$app->loadViewComponent('app-goods');
Yii::$app->loadViewComponent('goods/app-attr');
?>
<style>
    .active-color {
        color: #409eff;
    }
    .el-switch__label {
        color: #c6c6c6;
    }

    #pane-four .el-card>.el-card__body>.el-form-item>.el-form-item__content {
        margin-left: 0 !important;
    }

    .header-require:before {
        content: '*';
        color: #F56C6C;
        margin-right: 2px;
    }
    .robot_time .el-input-group--append{
        width: 130px;
    }
    .robot_text {
        color: #c6c6c6;
    }
    .time-select {
        min-height: 64px;
        padding: 10px;
        border: 1px solid #EBEEF5;
        border-radius: 3px;
        max-width: 910px;
        margin-bottom: 15px;
    }
    .time-select>div {
        min-height: 44px;
        padding: 0 10px;
        background: #f8f8f8;
    }
    .time-select .box-grow-0 {
        margin-right: 10px;
        height: 44px;
        line-height: 44px;
    }
    .week-item {
        width: 54px;
        height: 28px;
        border: 1px solid #DCDFE6;
        border-radius: 3px;
        margin-right: 20px;
        position: relative;
        color: #606266;
        text-align: center;
        line-height: 26px;
        font-size: 12px;
        cursor: pointer;
    }
    .week-item.active {
        border-color: transparent;
        color: #409EFF;
    }
    .week-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .choose-day-list {
        width: 625px;
        border: 1px solid #DCDFE6;
        border-radius: 3px;
        padding: 5px 16px 0;
        font-size: 12px;
        cursor: pointer;
    }
    .choose-day-list .choose-day {
        height: 22px;
        line-height: 22px;
        margin-bottom: 5px;
        width: 47px;
        text-align: center;
        margin-left: 8px;
        background-color: #F5F7FA;
        color: #606266;
    }
    .day-item {
        margin-bottom: 20px;
        width: 46px;
    }
    .choose-type {
        color: #606266;
    }
    .choose-type .el-radio__input.is-checked .el-radio__inner {
        background: #fff;
    }
    .choose-type .el-radio__inner::after {
        background-color: #409EFF;
        width: 8px;
        height: 8px;
    }
    .cishu .el-radio__input.is-checked+.el-radio__label {
        color: #606266;
    }
    .cishu .el-radio {
        margin-right: 0;
    }
    .time-list {
        display: inline-block;
        margin: 5px 20px 5px 0;
        position: relative;
    }
    .time-list div {
        padding: 0 15px;
        background-color: #fff;
        height: 32px;
        line-height: 30px;
        border-radius: 3px;
        border: 1px solid #DCDFE6;
        font-size: 14px;
        color: #606266;
        cursor: pointer;
    }
    .time-list:hover .close {
        display: block;
    }
    .time-list .close {
        position: absolute;
        top: -4px;
        right: -4px;
        font-size: 16px;
        cursor: pointer;
        color: #ff4544;
        z-index: 2;
        display: none;
    }
    .goods-name {
        margin-bottom: 20px;
    }
    .required-icon.flex .el-form-item__content {
        margin-left: 0!important;
    }
    .required-icon .el-form-item__label:before {
        content: '*';
        color: #F56C6C;
        margin-right: 4px;
    }
    .goods .el-card__header {
        background-color: #F9F9F9;
    }
    .radio-flex .el-radio__input {
        height: 32px;
        line-height: 32px;
    }
    .mobile-show {
        width: 375px;
        height: 667px;
        margin: 0 auto;
        border: 1px solid #DCDFE6;
    }
    .mobile-show>img {
        width: 375px;
        height: 64px;
    }
    .mobile-show .mobile-body {
        position: relative;
        background-color: rgba(0, 0, 0, .5);
        height: 603px;
    }
    .mobile-show .mobile-body .mobile-attr {
        background-color: #fff;
        border-radius: 8px 8px 0 0;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        min-height: 440px;
        padding: 0 12px;
    }
    .mobile-show .mobile-body .mobile-attr-head {
        height: 60px;
        border-bottom: 1px solid #e2e2e2;
    }
    .mobile-show .mobile-body .mobile-attr-head .mobile-attr-pic {
        width: 60px;
        height: 60px;
        margin-top: -20px;
        margin-right: 10px;
        text-align: center;
        line-height: 60px;
        border-radius: 8px;
        background-color: #D8D8D8;
        color: #7C7D80;
    }
    .mobile-show .mobile-body .mobile-attr-head .mobile-attr-price {
        color: #ff4544;
        width: 267px;
        font-size: 18px;
    }
    .mobile-show .mobile-body .mobile-attr-head .mobile-attr-price span {
        font-size: 13px;
        margin: 0 2px;
    }
    .mobile-show .mobile-body .mobile-attr-head img {
        width: 12px;
        height: 12px;
        margin-top: -20px;
    }
    .mobile-show .mobile-body .mobile-attr-list {
        font-size: 12px;
    }
    .mobile-show .mobile-body .mobile-attr-list .mobile-attr-label {
        font-weight: 600;
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .mobile-show .mobile-body .mobile-attr-info {
        max-height: 234px;
        overflow-y: auto;
    }
    .mobile-show .mobile-body .mobile-attr-list .mobile-attr-item {
        margin-left: -10px;
    }
    .mobile-show .mobile-body .mobile-attr-list .mobile-attr-item div {
        padding: 0 10px;
        height: 32px;
        border-radius: 4px;
        margin-left: 10px;
        background: #F6F6F6;
        color: #333333;
        border: 1px solid transparent;
        margin-bottom: 10px;
    }
    .mobile-show .mobile-body .mobile-attr-list .mobile-attr-item div:first-of-type {
        color: #ff4544;
        border-color: #ff4544;
        background: rgba(255, 69, 68, 0.1);
    }
    .mobile-show .mobile-body .mobile-attr-bottom {
        height: 137px;
        width: 100%;
        position: absolute;
        bottom: 0;
        left: 0;
    }
</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 0 0;">
        <div slot="header">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><span style="color: #409EFF;cursor: pointer" @click="$navigate({r:'plugin/weekly_buy/mall/activity/index'})">周期购活动</span></el-breadcrumb-item>
                <el-breadcrumb-item v-if="is_edit">编辑活动</el-breadcrumb-item>
                <el-breadcrumb-item v-else>新建活动</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <app-goods ref="appGoods"
                   :is_info="0"
                   :is_show="0"
                   :is_cats="0"
                   :is_display_setting="0"
                   sign="weekly_buy"
                   :is_detail="0"
                   :url="url"
                   :form="form"
                   :rule="rule"
                   :is_edit="is_edit"
                   :is_form="0"
                   :is_virtual_sales="1"
                   :referrer="referrerUrl"
                   get_goods_url="plugin/weekly_buy/mall/activity/edit"
                   :preview-info="previewInfo"
                   @handle-preview="handlePreview"
                   @set-attr="setAttr"
                   @goods-success="childrenGoods">

            <template slot="before_info">
                <el-card class="goods" shadow="never" style="margin-bottom: 24px">
                    <div slot="header">活动设置</div>
                    <el-col :span="24">
                        <el-form-item class="required-icon" v-if="is_add == 1" label="开始时间">
                            <el-date-picker
                              v-model="form.start_time"
                              type="datetime"
                              :disabled="is_edit == 1 && form.activity_status == 1"
                              value-format="yyyy-MM-dd HH:mm:ss"
                              placeholder="选择开始时间">
                            </el-date-picker>
                        </el-form-item>
                        <el-form-item class="required-icon" v-if="is_add == 1" label="结束时间">
                            <el-date-picker
                              v-model="form.end_time"
                              type="datetime"
                              value-format="yyyy-MM-dd HH:mm:ss"
                              placeholder="选择结束时间">
                            </el-date-picker>
                            <el-checkbox style="margin-left: 20px;" :true-label="1" :false-label="0" v-model="form.is_no_end_time">无限制</el-checkbox>
                        </el-form-item>
                    </el-col>
                </el-card>
            </template>
            <template slot="member_route_setting">
                 <span class="red">注：必须在“
                    <el-button type="text" @click="$navigate({r: 'plugin/weekly_buy/mall/index'}, true)">设置=>基本设置=>优惠叠加设置</el-button>
                    ”中开启，才能使用
                </span>
            </template>
            <template slot="before_attr">
                <el-card class="choose-type" shadow="never" style="margin-bottom: 24px">
                    <div slot="header">周期购设置</div>
                    <el-col :span="24">
                        <el-form-item label="周期方式设置">
                            <div>
                                <el-radio-group v-model="form.week_mode" @change="changeMode">
                                    <el-radio style="margin-right: 60px;" :label="0">周期设置</el-radio>
                                    <el-radio :label="1">固定日期循环设置</el-radio>
                                </el-radio-group>
                            </div>
                        </el-form-item>
                        <el-form-item label="循环时间设置" v-if="form.week_mode == 1" class="required-icon">
                            <div>
                                <el-radio-group v-model="form.week_type">
                                    <el-radio style="margin-right: 40px;" :label="5">按周循环</el-radio>
                                    <el-radio :label="6">按月循环</el-radio>
                                </el-radio-group>
                            </div>
                            <div v-if="form.week_type == 5" style="margin-top: 10px" flex="dir:left cross:center">
                                <div @click="item.is_choose = !item.is_choose" v-for="item in week_list" :key="item.id" class="week-item" :class="{'active': item.is_choose}">
                                    <img v-if="item.is_choose" src="statics/img/mall/select.png" alt="">
                                    <div>{{item.name}}</div>
                                </div>
                            </div>
                            <div v-if="form.week_type == 6" style="margin-top: 10px">
                                <el-button @click="openChooseDay" v-if="form.month_loop.length == 0" plain>选择日期</el-button>
                                <div @click="openChooseDay" class="choose-day-list" v-else flex="dir:left cross:top">
                                    <div style="margin-right: 5px;height: 22px;line-height: 22px;flex-shrink: 0">日期：</div>
                                    <div flex="dir:left cross:center" style="flex-wrap: wrap;">
                                        <div class="choose-day" v-for="item in form.month_loop" :key="item">
                                            {{item}}号
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="font-size: 12px;color: #C0C4CC;margin-top: 5px;">注：商家可选择每周/每月的固定日期进行配送</div>
                        </el-form-item>
                        <el-form-item v-if="form.week_mode == 0" label="配送周期" class="required-icon">
                            <div flex="dir:left cross:center">
                                <el-radio-group v-model="form.week_type">
                                    <el-radio style="margin-right: 40px;" :label="1">每日一期</el-radio>
                                    <el-radio style="margin-right: 40px;" :label="2">每周一期</el-radio>
                                    <el-radio style="margin-right: 40px;" :label="3">每月一期</el-radio>
                                    <el-radio :label="4">自定义</el-radio>
                                </el-radio-group>
                                <div>
                                    <el-input oninput="this.value = this.value.replace(/[^0-9]/g, '');" :min="0" type="number" style="width: 186px;margin-left: 10px" v-model="form.week_status_customize_day">
                                        <template slot="append">日/期</template>
                                    </el-input>
                                </div>
                                <span style="font-size: 12px;color: #C0C4CC;margin-left: 10px;">注：商家可自定义配送周期，例如半月一期即为15日/期</span>
                            </div>
                            <div v-if="form.week_type == 1" style="margin-top: 10px">
                                <el-checkbox-group v-model="form.week_status_day">
                                    <el-checkbox :label="1">每天配送</el-checkbox>
                                    <el-checkbox :label="2">工作日配送</el-checkbox>
                                    <el-checkbox :label="3">周末配送</el-checkbox>
                                    <el-checkbox :label="4">隔天配送</el-checkbox>
                                </el-checkbox-group>
                            </div>
                            <div v-if="form.week_type == 2" style="margin-top: 10px" flex="dir:left cross:center">
                                <div @click="item.is_choose = !item.is_choose" v-for="item in week_list" :key="item.id" class="week-item" :class="{'active': item.is_choose}">
                                    <img v-if="item.is_choose" src="statics/img/mall/select.png" alt="">
                                    <div>{{item.name}}</div>
                                </div>
                            </div>
                            <div v-if="form.week_type > 2" style="margin-top: 10px">
                                <el-button @click="openChooseDay" v-if="(form.week_type == 3 && form.week_status_month.length == 0) || (form.week_type == 4 && form.week_status_customize.length == 0)" plain>选择日期</el-button>
                                <div @click="openChooseDay" class="choose-day-list" v-if="(form.week_type == 3 && form.week_status_month.length > 0) || (form.week_type == 4 && form.week_status_customize.length > 0)" flex="dir:left cross:top">
                                    <div style="margin-right: 5px;height: 22px;line-height: 22px;flex-shrink: 0">日期：</div>
                                    <div flex="dir:left cross:center" style="flex-wrap: wrap;" v-if="form.week_type == 3">
                                        <div class="choose-day" v-for="item in form.week_status_month" :key="item">
                                            {{item}}号
                                        </div>
                                    </div>
                                    <div flex="dir:left cross:center" style="flex-wrap: wrap;" v-if="form.week_type == 4">
                                        <div class="choose-day" v-for="item in form.week_status_customize" :key="item">
                                            {{item}}号
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="font-size: 12px;color: #C0C4CC;margin-top: 5px;">注：商家可选择多个日期，买家从中选择一个</div>
                        </el-form-item>
                        <el-form-item label="提前支付" class="required-icon flex" flex="dir:left corss:center">
                            买家需提前
                            <el-input oninput="this.value = this.value.replace(/[^0-9]/g, '');" :min="0" type="number" style="width: 165px;margin: 0 10px;" v-model="form.before_day">
                                <template slot="append">天</template>
                            </el-input>
                            并在
                            <el-input oninput="this.value = this.value.replace(/[^0-9]/g, '');" :min="0" type="number" style="width: 165px;margin: 0 10px;" v-model="form.last_time">
                                <template slot="append">时</template>
                            </el-input>
                            前下单支付，才能在最近的配送时间配送
                            <div style="font-size: 12px;color: #C0C4CC;margin-top: 8px;">例：最近配送时间为4月20日，买家需提前3天并在22时前下单支付即表示买家需在4月17日22：00前下单支付</div>
                        </el-form-item>
                        <el-form-item label="提前顺延" class="required-icon flex" flex="dir:left corss:center">
                            买家需提前
                            <el-input oninput="this.value = this.value.replace(/[^0-9]/g, '');" :min="0" type="number" style="width: 532px;margin: 0 10px;" v-model="form.delay">
                                <template slot="append">天</template>
                            </el-input>
                            顺延或取消顺延
                        </el-form-item>
                        <el-form-item class="cishu required-icon" label="顺延次数">
                            <div flex="dir:left corss:center" class="radio-flex">
                                <el-radio v-model="form.delay_limit_type" :label="1">每个周期购活动，每人每月可顺延或取消顺延</el-radio>
                                <div>
                                    <el-input oninput="this.value = this.value.replace(/[^0-9]/g, '');" :min="0" type="number" style="width: 406px;margin: 0 10px;" v-model="form.delay_limit_number">
                                        <template slot="append">次</template>
                                    </el-input>
                                </div>
                            </div>
                            <div>
                                <el-radio style="margin-right: 40px;" v-model="form.delay_limit_type" :label="0">不限制</el-radio>
                            </div>
                        </el-form-item>
                    </el-col>
                </el-card>
            </template>


            <template slot="before_basic_tab_pane">
                <el-tab-pane label="周期设置" name="four"  class="app-attr">
                    <el-form-item label-width="0px" prop="desc">
                        <div style="margin-bottom: 20px;font-size: 18px;color: #606266;font-weight: 600;">周期设置</div>
                        <el-form-item label-width="104px" label="周期选项名称">
                            <div>
                                <el-input size="small" style="width: 810px;" v-model="form.week_custom" placeholder="请输入自定义的周期选项名称，例：订几个月"></el-input>
                            </div>
                            <el-button type="text" @click="showVisible = true;">查看图例</el-button>
                        </el-form-item>
                        <div class="time-select">
                            <div flex="dir:left cross:top">
                                <div class="box-grow-0">期数选择:</div>
                                <div flex="dir:left cross:center" style="flex-wrap: wrap;min-height: 44px;">
                                    <div class="time-list" v-for="(item, j) in time_list" :key="j">
                                        <div @click="changeTime(item,j)">{{item.number}}期</div>
                                        <i class="el-icon-error close" @click="deleteTime(item,j)"></i>
                                    </div>
                                    <div slot="footer">
                                        <el-button plain @click="addTime">添加期数选择</el-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </el-form-item>

                    <el-card v-for="(item, index) in form.group_list" :key="index" style="margin-top: 24px;max-width: 910px;" shadow="never">
                        <div slot="header">
                            <el-tag type="danger">{{item.number}}期</el-tag>
                            <el-tag style="margin-left: 10px;" v-if="item.title" type="danger">{{item.title}}</el-tag>
                        </div>
                        <el-form-item v-if="new_attr_groups.length" >
                            <app-attr :attr-groups="new_attr_groups" default_param="price" v-model="item.attr"
                                      :list="{price: '商品单价'}" price_append="元" price_width="126px"></app-attr>
                        </el-form-item>
                    </el-card>
                </el-tab-pane>
            </template>

            <template slot="preview">
                <div v-if="previewData" flex="dir:top">
                    <el-image style="height:50px"
                              src="<?= \app\helpers\PluginHelper::getPluginBaseAssetsUrl() ?>/img/goods.png"></el-image>
                    <div class="goods">
                        <div class="goods-name">{{previewData.name}}</div>
                        <div flex="dir:left" style="font-size:14px">
                            <div flex="dir:top" style="font-size: 10px">
                                <div style="font-size:26px;color:#ff4544;" :class="previewData.t_type">{{previewData.actualPrice}}</div>
                                <div flex="dir:left">
                                    <div style="color: #999999;margin-left: 6px">销量{{previewData.virtual_sales}}{{previewData.unit}}</div>
                                </div>
                            </div>
                            <div class="share" flex="dir:top main:center cross:center">
                                <el-image src="statics/img/mall/goods/icon-share.png"></el-image>
                                <div>分享</div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </app-goods>
        <el-dialog title="选择配送日期" :visible.sync="dialogVisible" width="997px">
            <el-checkbox-group v-model="choose_day" @change="handleCheckeddayChange">
                <el-checkbox class="day-item" v-for="item in day" :label="item" :key="item">{{item}}号</el-checkbox>
            </el-checkbox-group>
            <div style="margin-top: 20px;" flex="cross:center main:justify">
                <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleCheckAllChange">全选</el-checkbox>
                <div>
                    <el-button size="small" @click="dialogVisible = false">取消</el-button>
                    <el-button size="small" type="primary" @click="submitChooseDay">保存</el-button>
                </div>
            </div>
        </el-dialog>
        <el-dialog title="添加期数选择" :visible.sync="weekVisible" width="689px">
            <el-form :model="newWeek" label-width="110px" size="small">
                <el-form-item label="期数" class="required-icon">
                    <el-input size="small" style="width: 520px;margin-left: 15px;" v-model="newWeek.number" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        <template slot="append">期</template>
                    </el-input>
                </el-form-item>
                <el-form-item label="期数名自定义">
                    <el-input size="small" style="width: 520px;margin-left: 15px;" v-model="newWeek.title" placeholder="请输入期数名"></el-input>
                    <div style="font-size: 12px;color: #C0C4CC;margin-left: 15px;">注：若期数名未自定义即默认显示期数</div>
                </el-form-item>
            </el-form>
            <span slot="footer" style="margin-top: -20px">
                <el-button size="small" @click="weekVisible = false">取消</el-button>
                <el-button size="small" type="primary" @click="submitNewWeek">确认</el-button>
            </span>
        </el-dialog>
        <!-- 自定义 -->
        <el-dialog title="图例" :visible.sync="showVisible">
            <div class="mobile-show">
                <img src="statics/img/plugins/goods.png" alt="">
                <div class="mobile-body">
                    <div class="mobile-attr">
                        <div class="mobile-attr-head" flex="dir:left cross:center">
                            <div class="mobile-attr-pic">商品图</div>
                            <div class="mobile-attr-price">
                                <div><span>￥</span>23<span>x</span>6<span>期</span></div>
                                <div style="color: #999999;font-size: 12px;">库存：333</div>
                            </div>
                            <img src="statics/img/mall/wechat/icon-close.png" alt="">
                        </div>
                        <div class="mobile-attr-info">
                            <div class="mobile-attr-list">
                                <div class="mobile-attr-label">规格</div>
                                <div class="mobile-attr-item" flex="dir:left cross:center" style="flex-wrap: wrap;">
                                    <div flex="main:center cross:center">默认规格</div>
                                </div>
                            </div>
                            <div class="mobile-attr-list">
                                <div class="mobile-attr-label">{{form.week_custom ? form.week_custom : '周期选项名称'}}</div>
                                <div class="mobile-attr-item" flex="dir:left cross:center" style="flex-wrap: wrap;" v-if="time_list.length > 0">
                                    <div v-for="(item,idx) in time_list" :key="idx" flex="main:center cross:center">{{item.title ? item.title : item.number + '期'}}</div>
                                </div>
                                <div class="mobile-attr-item" flex="dir:left cross:center" style="flex-wrap: wrap;" v-else>
                                    <div flex="main:center cross:center">期数名</div>
                                </div>
                            </div>
                            <div class="mobile-attr-list">
                                <div class="mobile-attr-label">配送时间<span style="font-size: 12px;color: #999999;margin-left: 10px;">{{mobile_attr_name}}</span></div>
                                <div class="mobile-attr-item" flex="dir:left cross:center" style="flex-wrap: wrap;" v-if="mobile_attr_list.length < 8">
                                    <div v-for="(item,idx) in mobile_attr_list" :key="idx" flex="main:center cross:center">{{item}}</div>
                                </div>
                                <div class="mobile-attr-item" flex="dir:left cross:center" style="flex-wrap: wrap;" v-else>
                                    <div flex="main:center cross:center">
                                        <div>选择配送日期</div>
                                        <img style="height: 28px;width: 19px;margin-left: 10px;" src="statics/img/plugins/right-arrow.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img class="mobile-attr-bottom" src="statics/img/plugins/weekly-bottom.png" alt="">
                    </div>
                </div>
            </div>
            <div slot="footer" class="dialog-footer">
                <el-button @click="showVisible = false" type="primary">我知道了</el-button>
            </div>
        </el-dialog>
    </el-card>
</div>

<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                newWeek: {
                    number: '',
                    title: '',
                },
                weekIndex: -1,
                weekVisible: false,
                showVisible: false,
                time_list: [],

                memberLevel: [],
                attr: [],
                use_attr: 0,
                attr_groups: [],
                newAttr: [],
                new_attr_groups: [],
                goods_stock: 0,
                price: 0,
                goods_no: '',
                goods_weight: '',
                attr_default_name: '',
                loading: false,
                is_edit: 0,
                attr_groups: [],
                goods_id: -1,
                previewInfo: {
                    is_head: false,
                    is_cart: false,
                    is_attr: false,
                },
                dialogVisible: false,
                checkAll: false,
                isIndeterminate: false,
                day: [],
                choose_day: [],
                week_list: [
                    {id: 1, name: '周一', is_choose: false},
                    {id: 2, name: '周二', is_choose: false},
                    {id: 3, name: '周三', is_choose: false},
                    {id: 4, name: '周四', is_choose: false},
                    {id: 5, name: '周五', is_choose: false},
                    {id: 6, name: '周六', is_choose: false},
                    {id: 0, name: '周日', is_choose: false},
                ],
                previewData: null,
                is_add: 1,
                form: {
                    status: 0,
                    start_time: '',
                    end_time: '',
                    week_mode: 0,
                    week_type: 1,
                    week_status_day: [1,2,3,4],
                    week_status_week: [],
                    week_status_month: [],
                    week_loop: [],
                    month_loop: [],
                    week_status_customize: [],
                    week_status_customize_day: '',
                    before_day: '',
                    last_time: '',
                    delay: '',
                    delay_limit_type: 0,
                    delay_limit_number: '',
                    freight_type: 0,
                    freight_price: '',
                    shipping_type: 0,
                    shipping_number: '',
                    shipping_price: '',
                    group_list: [],
                    unit: '件',
                    id: 0,
                    activity_status: 1,
                    is_no_end_time: false,
                    week_custom: ''
                },
                rule: {
                    // price: [
                    //     {required: true, message: '请输入商品价格', trigger: 'change'}
                    // ]
                },
                referrerUrl: 'plugin/weekly_buy/mall/activity/index',
                url: 'plugin/weekly_buy/mall/activity/edit',
                get_goods_url: 'plugin/weekly_buy/mall/goods/edit',
                is_edit: 0
            };
        },

        methods: {
            changeMode(e) {
                this.form.week_type = e == 0 ? this.form.week_type < 5 ? this.form.week_type : 1 : this.form.week_type > 4 ? this.form.week_type : 5;
                for(let item of this.week_list) {
                    item.is_choose = false;
                }
                this.choose_day = [];
            },
            openChooseDay() {
                if(this.form.week_type == 3) {
                    this.choose_day = this.form.week_status_month
                }else if(this.form.week_type == 4) {
                    this.choose_day = this.form.week_status_customize
                }else if(this.form.week_type == 6) {
                    this.choose_day = this.form.month_loop
                }
                let checkedCount = this.choose_day.length;
                this.checkAll = checkedCount === this.day.length;
                this.isIndeterminate = checkedCount > 0 && checkedCount < this.day.length;
                this.dialogVisible = true;
            },
            submitChooseDay()  {
                if(this.form.week_type == 3) {
                    this.form.week_status_month = this.choose_day
                }else if(this.form.week_type == 4) {
                    this.form.week_status_customize = this.choose_day
                }else if(this.form.week_type == 6) {
                    this.form.month_loop = this.choose_day
                }
                this.dialogVisible = false;
            },
            addTime() {
                this.weekIndex = this.time_list.length;
                this.newWeek = {
                    number: '',
                    title: ''
                }
                this.weekVisible = !this.weekVisible;
            },
            deleteTime(e,i) {
                if(this.time_list.length == 1) {
                    return false;
                }
                this.time_list.splice(i,1)
                this.form.group_list.splice(i,1)
            },
            changeTime(e,j) {
                this.newWeek = JSON.parse(JSON.stringify(e));
                this.weekIndex = j;
                this.weekVisible = !this.weekVisible;
            },
            submitNewWeek() {
                for(let index in this.time_list) {
                    if(this.time_list[index].number == this.newWeek.number && index != this.weekIndex) {
                        this.$message.error('输入的期数不能与现有的期数相同');
                        return false;
                    }
                }
                if(this.weekIndex > this.time_list.length - 1) {
                    this.time_list.push(this.newWeek);
                }else {
                    this.time_list[this.weekIndex] = this.newWeek;
                }
                if(this.weekIndex > this.form.group_list.length - 1) {
                    this.makeAttrGroup(this.time_list[this.weekIndex])
                }else {
                    this.form.group_list[this.weekIndex].number = this.time_list[this.weekIndex].number
                    this.form.group_list[this.weekIndex].title = this.time_list[this.weekIndex].title
                }
                this.newWeek = {
                    number: '',
                    title: ''
                }
                this.weekVisible = !this.weekVisible;
            },
            handleCheckAllChange(val) {
                this.choose_day = val ? this.day : [];
                this.isIndeterminate = false;
            },
            handleCheckeddayChange(value) {
                let checkedCount = value.length;
                this.checkAll = checkedCount === this.day.length;
                this.isIndeterminate = checkedCount > 0 && checkedCount < this.day.length;
            },
            // 预览
            handlePreview(e) {
                const price = Number(e.price);
                const attr = e.attr;
                let arr = [];
                attr.map(v => {
                    arr.push(Number(v.price));
                });
                let max = Math.max.apply(null, arr);
                let min = Math.min.apply(null, arr);

                let actualPrice = -1;
                let type = 'text-price';
                if (max > min && min >= 0 && e.use_attr == 1) {
                    actualPrice = min + '-' + max;
                } else if (max == min && min >= 0 && e.use_attr == 1) {
                    actualPrice = min;
                } else if (price > 0) {
                    actualPrice = price;
                } else if (price == 0) {
                    actualPrice = '免费';
                    type = '';
                }

                this.previewData = Object.assign({},e,{
                    actualPrice,
                    t_type:type,
                });
            },

            // 监听子组件事件
            childrenGoods(e) {
                let { attr, use_attr, attr_groups, goods_stock, price, goods_no, goods_weight, attr_default_name } = this.$refs.appGoods.cForm;
                this.attr = attr;
                this.use_attr = use_attr;
                this.attr_groups = attr_groups;
                this.form.goods_warehouse_id = e.goods_warehouse_id;
                this.goods_id = e.goods_warehouse.goods_id;
                this.goods_stock = goods_stock;
                this.price = price;
                this.goods_weight = goods_weight;
                this.goods_no = goods_no;
                this.attr_default_name = attr_default_name;
                if (getQuery('id')) {
                    let { start_time, end_time, is_auto_add_robot, add_robot_time } = e.plugin;
                    this.form.start_time = start_time;
                    this.form.end_time = end_time;
                    if (end_time === '0000-00-00 00:00:00') {
                        this.form.end_time = '';
                    }
                    this.form.virtual_sales = e.virtual_sales;
                    this.form.week_mode = e.plugin.week_mode;
                    this.form.week_type = e.plugin.week_type;
                    this.form.week_status_day = e.plugin.week_status_day;
                    this.form.week_status_week = e.plugin.week_status_week;
                    this.form.week_loop = e.plugin.week_loop;
                    this.form.month_loop = e.plugin.month_loop;
                    this.form.week_status_month = e.plugin.week_status_month;
                    this.form.week_status_customize = e.plugin.week_status_customize;
                    this.form.week_status_customize_day = e.plugin.week_status_customize_day;
                    this.form.before_day = e.plugin.before_day;
                    this.form.last_time = e.plugin.last_time;
                    this.form.delay = e.plugin.delay;
                    this.form.delay_limit_type = e.plugin.delay_limit_type;
                    this.form.delay_limit_number = e.plugin.delay_limit_number;
                    this.form.shipping_type = e.plugin.shipping_type;
                    this.form.shipping_number = e.plugin.shipping_number;
                    this.form.shipping_price = e.plugin.shipping_price;
                    this.form.freight_type = e.plugin.freight_type;
                    this.form.freight_price = e.plugin.freight;
                    this.form.group_list = e.group_list;
                    this.form.is_no_end_time = e.plugin.is_no_end_time;
                    this.form.week_custom = e.plugin.week_custom;
                    this.time_list = [];
                    for(let item of this.form.group_list) {
                        this.time_list.push({number:item.number, title: item.title})
                    }
                    if(this.form.week_type == 2 || this.form.week_type == 5) {
                        let weekList = this.form.week_type == 5 ? this.form.week_loop : this.form.week_status_week;
                        for(let item of weekList) {
                            for(let week of this.week_list) {
                                if(item == week.id) {
                                    week.is_choose = true;
                                }
                            }
                        }
                    }
                    this.new_attr_groups = attr_groups;
                    this.referrerUrl = {
                        r: 'plugin/weekly_buy/mall/activity/index',
                        id: e.goods_warehouse_id
                    };
                    this.form.activity_status = e.status;
                }
            },
            filter_color(item) {
                let active = false;
                this.form.start_time.map((it) => {
                    if (item.value === it) {
                        active = true;
                    }
                });
                return active;
            },


            makeAttrGroup(newWeek) {
                let data = {};
                if (this.newAttr.length === 0) {
                    data = [
                        {
                            attr_list: [
                                {
                                    attr_group_id: -1,
                                    attr_group_name: '规格',
                                    attr_name: this.attr_default_name ? this.attr_default_name : '默认',
                                    attr_id: -1,
                                }
                            ],
                            stock: this.goods_stock,
                            price: this.price,
                            no: this.goods_no,
                            weight: this.goods_weight,
                            pic_url: '',
                            goodsAttr: {
                                id: undefined
                            }
                        }
                    ];
                } else {
                    data = JSON.parse(JSON.stringify(this.newAttr));
                    data.forEach((item) => {
                        item.goodsAttr = {
                            id: item.id
                        }
                    });
                }
                this.form.group_list.push({
                    number: newWeek.number,
                    title: newWeek.title,
                    goods_id: 0,
                    attr: JSON.parse(JSON.stringify(data)),
                    member_price: JSON.parse(JSON.stringify(this.defaultMemberPrice)),
                    shareLevelList: {
                        share_commission_first: 0,
                        share_commission_second: 0,
                        share_commission_third: 0,
                    },
                });
            },
            // 获取会员列表
            getMembers() {
                let self = this;
                request({
                    params: {
                        r: 'mall/mall-member/all-member'
                    },
                    method: 'get',
                    data: {}
                }).then(e => {
                    if (e.data.code === 0) {
                        self.memberLevel = e.data.data.list;
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                });
            },

            setAttr(attr, attrGroups) {
                this.form.group_list = [];
                this.time_list = []
                this.attr = attr;
                this.attr_groups = attrGroups;
            },
        },
        created() {
            for(let i = 1;i < 32;i++) {
                let index = i.toString()
                this.day.push(index);
            }
        },
        mounted() {
            let id = getQuery('id');
            this.getMembers();
            if (id) {
                this.get_goods_url = 'plugin/weekly_buy/mall/activity/edit';
                this.is_edit = 1;
            } else {
                this.get_goods_url = 'mall/goods/edit';
            }
        },
        computed: {
            mobile_attr_name() {
                let str = this.form.week_type == 1 ? '每日一期' : this.form.week_type == 2 ? '每周一期' : this.form.week_type == 3 ? '每月一期' : this.form.week_status_customize_day + '月一期';
                return str;
            },
            mobile_attr_list() {
                let list = [];
                if(this.form.week_type == 1) {
                    for(let item of this.form.week_status_day) {
                        if(item == 1) {
                            list.push('每天配送');
                        }else if(item == 2) {
                            list.push('工作日每日配送');
                        }else if(item == 3) {
                            list.push('周末每天配送');
                        }else if(item == 4) {
                            list.push('隔天配送');
                        }
                    }
                }else if(this.form.week_type == 2) {
                    for(let item of this.form.week_status_week) {
                        if(item == 1) {
                            list.push('每周一');
                        }else if(item == 2) {
                            list.push('每周二');
                        }else if(item == 3) {
                            list.push('每周三');
                        }else if(item == 4) {
                            list.push('每周四');
                        }else if(item == 5) {
                            list.push('每周五');
                        }else if(item == 6) {
                            list.push('每周六');
                        }else if(item == 0) {
                            list.push('每周日');
                        }
                    }
                }else if(this.form.week_type == 5) {
                    let text = '每周';
                    for(let index in this.form.week_loop) {
                        if(this.form.week_loop[index] == 1) {
                            text += '周一'
                        }else if(this.form.week_loop[index] == 2) {
                            text += '周二';
                        }else if(this.form.week_loop[index] == 3) {
                            text += '周三';
                        }else if(this.form.week_loop[index] == 4) {
                            text += '周四';
                        }else if(this.form.week_loop[index] == 5) {
                            text += '周五';
                        }else if(this.form.week_loop[index] == 6) {
                            text += '周六';
                        }else if(this.form.week_loop[index] == 0) {
                            text += '周日';
                        }
                        if(index != this.form.week_loop) {
                            text += '、'
                        }
                    }
                    setTimeout(()=>{
                        list.push(text + '配送')
                    })
                }else if(this.form.week_type == 6) {
                }else {
                    let dayList = this.form.week_type == 3 ? this.form.week_status_month : this.form.week_status_customize;
                    for(let item of dayList) {
                        list.push('每月' + item + '号')
                    }
                }
                return list;
            },
            defaultMemberPrice() {
                let self = this;
                let defaultMemberPrice = {};
                // 以下数据用于默认规格情况下的 会员价设置
                self.memberLevel.forEach(function (item, index) {
                    // let obj = {};
                    // obj['id'] = index;
                    // obj['name'] = item.name;
                    // obj['level'] = parseInt(item.level);
                    //
                    // let memberPriceValue = 0;
                    // if (self.form.use_attr == 0 && self.form.attr.length > 0) {
                    //     let key = 'level' + item.level;
                    //     let value = self.form.attr[0]['member_price'][key];
                    //     memberPriceValue = value ? value : memberPriceValue;
                    // }
                    // obj['value'] = memberPriceValue;
                    defaultMemberPrice['level' + (index + 1)]  = 0;
                });
                return defaultMemberPrice;
            },

        },

        watch: {
            week_list: {
                handler: function(data) {
                    this.form.week_status_week = [];
                    this.form.week_loop = [];
                    for(let item of data) {
                        if(item.is_choose) {
                            if(this.form.week_type == 2) {
                                this.form.week_status_week.push(item.id);
                            }
                            if(this.form.week_type == 5) {
                                this.form.week_loop.push(item.id);
                            }
                        }
                    }
                },
                deep: true,
                immediate: true
            },
            attr: {
                handler: function(data) {
                    if(data) {
                        this.newAttr = JSON.parse(JSON.stringify(data));
                    }
                },
                deep: true,
                immediate: true
            },
            attr_groups: {
                handler: function(data) {
                    if(data) {
                        this.new_attr_groups = JSON.parse(JSON.stringify(data));
                        if (this.new_attr_groups.length === 0 ) {
                            this.new_attr_groups = [
                                {
                                    attr_group_id: 1,
                                    attr_group_name: "规格",
                                    attr_list: {
                                        attr_id: 0,
                                        attr_name: '默认',
                                        pic_url: '',
                                    },
                                }
                            ]
                        }
                    }
                },
                deep: true,
                immediate: true
            }
        },

    });
</script>
