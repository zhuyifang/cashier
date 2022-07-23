<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2020/12/18
 * Time: 3:19 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
$permission = Yii::$app->branch->childPermission(Yii::$app->mall->user->adminInfo);
$is_pond = array_search('pond', $permission) !== false;
$is_scratch = array_search('scratch', $permission) !== false;
$is_plugin_show = $is_pond || $is_scratch;
Yii::$app->loadViewComponent('diy/diy-rubik');
Yii::$app->loadViewComponent('app-radio');
Yii::$app->loadViewComponent('app-hotspot');
?>
<style>
    .mobile-framework {
        width: 375px;
        height: 100%;
    }

    .mobile-framework-header {
        position: relative;
        height: 60px;
        /*line-height: 60px;*/
        background: #333;
        color: #fff;
        text-align: center;
        font-size: 15px;
        padding-top: 20px;
        cursor: pointer;
        background: url('statics/img/mall/head-diy.png') no-repeat;
    }

    .mobile-framework-header .search div {
        position: absolute;
        top: 7px;
        line-height: 1;
        left: 12px;
        font-size: 11px;
        max-width: 110px;
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
    }

    .mobile-framework-body {
        min-height: 645px;
        border: 1px solid #e2e2e2;
        /* background: #f5f7f9; */
    }

    .mobile-framework .diy-component-preview {
        del-cursor: pointer;
        position: relative;
        zoom: 0.5;
        -moz-transform: scale(0.5);
        -moz-transform-origin: top left;
        font-size: 28px;
    }

    @-moz-document url-prefix() {
        .mobile-framework .diy-component-preview {
            cursor: pointer;
            position: relative;
            -moz-transform: scale(0.5);
            -moz-transform-origin: top left;
            font-size: 28px;
            width: 200% !important;
            height: 100%;
            margin-bottom: auto;
        }
        .mobile-framework .active .diy-component-preview {
            border: 2px dashed #409EFF;
            left: -2px;
            right: -2px;
            width: calc(200% + 4px) !important;
        }
    }

    .mobile-framework .diy-component-preview:hover {
        box-shadow: inset 0 0 10000px rgba(0, 0, 0, .03);
    }

    .mobile-framework .diy-component-edit {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 500px;
        right: 0;
        background: #fff;
        padding: 20px;
        display: none;
        cursor: default;
        overflow: auto;
    }

    .diy-component-options {
        position: relative;
    }

    .diy-component-options .el-button {
        height: 25px;
        line-height: 25px;
        width: 25px;
        padding: 0;
        text-align: center;
        border: none;
        border-radius: 0;
        position: absolute;
        margin-left: 0;
    }

    .mobile-framework .active .diy-component-preview {
        border: 2px dashed #409EFF;
        left: -2px;
        right: -2px;
        width: calc(100% + 4px);
    }

    .mobile-framework .active .diy-component-edit {
        display: block;
        del-padding-right: 20%;
        min-width: calc(650px - 20%);
    }

    .all-components {
        max-height: 725px;
        overflow-y: auto;
    }

    .el-dialog {
        min-width: 800px;
    }

    #ggg div, span {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Chrome/Safari/Opera */
        -khtml-user-select: none; /* Konqueror */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently */
    }
</style>
<style>
    .diy-model-style .diy-component-edit .el-slider__button {
        background-color: #409EFF;
    }
</style>
<style>
    .form-body {
        padding: 20px;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .button-item {
        /*margin-top: 12px;*/
        padding: 9px 25px;
    }

    .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }

    .wechat-image {
        height: 232px;
        width: 200px;
        cursor: pointer;
        position: relative;
    }

    .wechat-end-box {
        height: 32px;
        line-height: 32px;
        width: 200px;
        padding: 0 12px;
        color: #606266;
        border-left: 1px solid #e2e2e2;
        border-right: 1px solid #e2e2e2;
        border-bottom: 1px solid #e2e2e2;
        word-break: break-all;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .order-label {
        font-size: 16px;
        color: #303133;
        padding-bottom: 20px;
        padding-top: 10px;
        padding-left: 12px;
        font-weight: 500;
    }

    .reset {
        position: absolute;
        top: 3px;
        left: 90px;
    }

    .el-color-picker {
        height: 30px;
    }

    .el-color-picker .el-color-picker__trigger {
        width: 55px;
        height: 30px;
        border-radius: 3px;
        border: 1px solid #E5E7EC;
        padding: 6px 7px 5px;
    }

    .el-color-picker .el-color-picker__color {
        width: 17px;
        height: 17px;
        border: 1px solid #E5E7EC;
        border-radius: 3px;
    }

    .el-color-picker .el-color-picker__color .el-color-picker__color-inner {
        border-radius: 3px;
    }

    .el-color-picker .el-color-picker__icon:before {
        content: "\e790";
    }

    .el-color-picker .el-color-picker__icon {
        left: 70%;
        font-size: 22px;
        color: #888F9A;
    }
</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;"
             v-loading="loading">
        <div slot="header">
            <span>订单设置</span>
        </div>
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="172px" size="small">
            <div class="form-body">
                <div class="order-label">基础设置</div>
                <el-form-item prop="over_time">
                    <template slot='label'>
                        <span>未支付订单超时时间</span>
                        <el-tooltip effect="dark" content="注意：如设置为0分，则未支付订单将不会被取消，不能超过999999"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </template>
                    <el-input style="width: 150px;" v-model="ruleForm.setting.over_time" type="number">
                        <template slot="append">分</template>
                    </el-input>
                </el-form-item>
                <el-form-item prop="delivery_time">
                    <template slot='label'>
                        <span>自动确认收货时间</span>
                        <el-tooltip effect="dark" content="从发货到自动确认收货的时间，不能超过30"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </template>
                    <el-input style="width: 150px;" v-model="ruleForm.setting.delivery_time"
                              type="number">
                        <template slot="append">天</template>
                    </el-input>
                </el-form-item>
                <el-form-item prop="after_sale_time">
                    <template slot='label'>
                        <span>售后时间</span>
                        <el-tooltip effect="dark" placement="top">
                            <div slot="content">可以申请售后的时间<br/>
                                注意：分销订单中的已完成订单，只有订单已确认收货，并且时间超过设置的售后天数之后才计入其中！不能超过30
                            </div>
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </template>
                    <el-input style="width: 150px;" v-model="ruleForm.setting.after_sale_time"
                              type="number">
                        <template slot="append">天</template>
                    </el-input>
                </el-form-item>
                <el-form-item prop="payment_type">
                    <template slot='label'>
                        <span>支付方式</span>
                        <el-tooltip effect="dark" content="若都不勾选，默认选中线上支付"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </template>
                    <el-checkbox-group v-model="ruleForm.setting.payment_type" size="mini">
                        <el-checkbox label="online_pay" size="mini">线上支付</el-checkbox>
                        <el-checkbox label="huodao" size="mini">货到付款</el-checkbox>
                        <el-checkbox label="balance" size="mini">余额支付</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
                <el-form-item prop="send_type">
                    <template slot='label'>
                        <span>发货方式</span>
                        <el-tooltip effect="dark" content="需添加门店，到店自提方可生效"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </template>
                    <div>
                        <el-checkbox-group v-model="ruleForm.setting.send_type" :min="1">
                            <el-checkbox v-for="(item, index) in ruleForm.setting.send_type_desc" :label="item.key" :key="item.key">
                                <template v-if="item.origin !== item.modify && item.modify">
                                    {{item.modify}}({{item.origin}})
                                </template>
                                <template v-else>
                                    {{item.origin}}
                                </template>
                                <el-button style="padding: 0;" type="text" @click="set_send_type(item, index)">
                                    <img src="statics/img/mall/order/edit.png" alt="">
                                </el-button>
                            </el-checkbox>
                        </el-checkbox-group>
                        <div style="color: #CCCCCC;">注：手机端显示排序（<span v-for="(item, index) in send_type_list" :key="index">{{index + 1}}.{{item}} </span>）</div>
                        <el-dialog
                                :visible.sync="send_type_dialogVisible"
                                width="30%"
                        >
                            <el-row>
                                <el-col :span="3">
                                    <span>{{send_type_item.item.origin}}</span>
                                </el-col>
                                <el-col :span="20" :offset="1">
                                    <el-input type="text" v-model="send_type_item.item.modify" maxLength="4">
                                    </el-input>
                                </el-col>
                            </el-row>

                            <span slot="footer" class="dialog-footer">
                                <el-button @click="send_type_dialogVisible = false">取 消</el-button>
                                <el-button type="primary" @click="sureSendType()">确 定</el-button>
                              </span>
                        </el-dialog>
                    </div>
                </el-form-item>
                <el-form-item label="余额功能" prop="status">
                    <el-switch v-model="ruleForm.recharge.status"
                               :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item label="余额支付密码开关" prop="is_pay_password">
                    <el-switch v-model="ruleForm.recharge.is_pay_password"
                               :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item v-if="ruleForm.recharge.is_pay_password == 1" label="修改余额密码客服" prop="list">
                    <el-button size="mini" @click="addWechat">选择</el-button>
                    <div flex="dir:left" style="flex-wrap:wrap">
                        <div v-for="(value,index) in ruleForm.setting.customer_service_list" style="margin-right: 24px;margin-top: 12px">
                            <div class="wechat-image" flex="dir:top"
                                 @click="editWechat(value,index)">
                                <el-image :src="value.qrcode_url" style="height: 200px;width:100%"></el-image>
                                <el-tooltip class="v" effect="dark" :content="'微信号'+ value.name" placement="top">
                                    <div class="wechat-end-box">微信号：{{value.name}}</div>
                                </el-tooltip>
                                <el-button class="del-btn" size="mini" type="danger"
                                           icon="el-icon-close" circle @click.stop="picClose(index)"></el-button>
                            </div>
                        </div>
                    </div>
                    <div style="color:#909399">注意：最多允许上传10张，前端随机展示一张</div>
                </el-form-item>
                <el-form-item label="收货人手机号校验开关" prop="is_verify_mobile">
                    <el-switch v-model="ruleForm.setting.is_verify_mobile"
                               :active-value="1" :inactive-value="0"></el-switch>
                    <div style="color: rgb(144, 147, 153);">开启后，则校验收货人手机号。校验规则：1开头的11位数字。</div>
                </el-form-item>
                <div class="order-label">下单后设置</div>
                <template v-if="is_plugin_show">
                    <el-form-item prop="has_send" label="抽奖设置">
                        <el-switch v-model="ruleForm.setting.has_send" :active-value="1"
                                   :inactive-value="0"></el-switch>
                    </el-form-item>
                    <template v-if="ruleForm.setting.has_send == 1">
                        <el-form-item prop="give_type" label="抽奖类型">
                            <app-radio v-if="is_pond" v-model="ruleForm.setting.give_type" label="pond" turn>
                                九宫格
                            </app-radio>
                            <app-radio v-if="is_scratch" v-model="ruleForm.setting.give_type" label="scratch"
                                       turn>刮刮卡
                            </app-radio>
                        </el-form-item>
                        <el-form-item label="抽奖背景" prop="send_bg">
                            <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                            @selected="selectSendBg">
                                <el-tooltip effect="dark"
                                            content="建议尺寸:702 * 160"
                                            placement="top">
                                    <el-button size="mini">选择图标</el-button>
                                </el-tooltip>
                            </app-attachment>
                            <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                                <app-attachment :multiple="false" :max="1"
                                                @selected="selectSendBg">
                                    <app-image mode="aspectFill"
                                               width="80px"
                                               height='80px'
                                               :src="ruleForm.setting.send_bg">
                                    </app-image>
                                </app-attachment>
                                <el-button v-if="ruleForm.setting.send_bg" class="del-btn"
                                           size="mini" type="danger" icon="el-icon-close"
                                           circle
                                           @click="removeSendBg"></el-button>
                            </div>
                            <el-button size="mini" @click="resetImg('send_bg')" class="reset" type="primary">
                                恢复默认
                            </el-button>
                        </el-form-item>
                        <el-form-item prop="send_text_color" label="抽奖文字颜色">
                            <div flex="dir:left cross:center">
                                <el-color-picker size="small"
                                                 v-model="ruleForm.setting.send_text_color"></el-color-picker>
                                <el-input size="small" style="width: 85px;margin-left: 9px;"
                                          v-model="ruleForm.setting.send_text_color"
                                ></el-input>
                            </div>
                        </el-form-item>
                        <el-form-item prop="send_num_type" label="抽奖赠送次数">
                            <div style="padding-bottom: 5px">
                                <app-radio v-model="ruleForm.setting.send_num_type" label="order">订单</app-radio>
                                <app-radio v-model="ruleForm.setting.send_num_type" label="money">金额</app-radio>
                            </div>
                            <div v-if="ruleForm.setting.send_num_type === 'money'" flex="dir:left cross:center">
                                <div style="padding-right: 9px">满</div>
                                <div>
                                    <el-input size="small" oninput="this.value = this.value.match(/^\d+(\.)?\d{0,2}/g)"
                                              v-model="ruleForm.setting.send_num_money_max" style="width:150px">
                                        <template slot="append">元</template>
                                    </el-input>
                                </div>
                                <div style="padding: 0 10px">赠送</div>
                                <div>
                                    <el-input
                                            oninput="this.value = this.value > 99 ? 99: this.value.match(/10|[1-9]\d?/)"
                                            size="small"
                                            v-model="ruleForm.setting.send_num" style="width:150px">
                                        <template slot="append">次</template>
                                    </el-input>
                                </div>
                                <div style="padding:0 10px">抽奖机会</div>
                            </div>
                            <div v-if="ruleForm.setting.send_num_type === 'order'" flex="dir:left cross:center">
                                <div style="padding-right:10px">每个订单赠送</div>
                                <div>
                                    <el-input
                                            oninput="this.value = this.value  > 99 ? 99: this.value.match(/10|[1-9]\d?/)"
                                            size="small"
                                            v-model="ruleForm.setting.send_num" style="width:150px">
                                        <template slot="append">次</template>
                                    </el-input>
                                </div>
                                <div style="padding-left: 10px">抽奖机会</div>
                            </div>
                            <el-checkbox v-if="ruleForm.setting.send_num_type === 'money'"
                                         style="margin-top: 5px" v-model="ruleForm.setting.send_num_overlapping"
                                         :true-label="1"
                                         :false-label="0">赠送次数可叠加
                            </el-checkbox>
                        </el-form-item>
                        <el-form-item prop="send_limit" label="抽奖赠送次数限制">
                            <div flex="dir:left cross:center">
                                <div>每个账号每天最多赠送</div>
                                <div style="padding:0 10px">
                                    <el-input size="small"
                                              oninput="this.value = this.value  > 99 ? 99: this.value.match(/10|[1-9]\d?/)"
                                              v-model="ruleForm.setting.send_limit" style="width: 150px">
                                        <template slot="append">次</template>
                                    </el-input>
                                </div>
                                <div>抽奖机会</div>
                            </div>
                        </el-form-item>
                    </template>
                </template>
                <el-form-item prop="has_rubik" label="广告设置">
                    <el-switch v-model="ruleForm.setting.has_rubik" :active-value="1"
                               :inactive-value="0"></el-switch>
                    <div v-if="ruleForm.setting.has_rubik == 1" style="margin-top: 6px">
                        <el-button @click="openRubik" size="small" plain>设置图片魔方</el-button>
                    </div>
                </el-form-item>
                <el-form-item prop="has_order_evaluate" label="默认好评功能">
                    <el-switch v-model="ruleForm.setting.has_order_evaluate" :active-value="1"
                               :inactive-value="0"></el-switch>
                    <div v-if="ruleForm.setting.has_order_evaluate == 1" style="color:#606266">
                        <span style="flex-grow: 1">买家购买商品过售后</span>
                        <el-input size="small" style="width: 150px;margin: 0 5px"
                                  oninput="this.value = this.value.match(/^\d{0,3}/g)"
                                  v-model="ruleForm.setting.order_evaluate_day">
                            <template slot="append">天</template>
                        </el-input>
                        <span style="flex-grow: 1">后，若没有主动评论，系统将自动默认好评</span>
                    </div>
                </el-form-item>
            </div>
            <el-button :loading="submitLoading" class="button-item" size="small" type="primary"
                       @click="submit('ruleForm')">保存
            </el-button>
        </el-form>

        <el-dialog title="设置图片魔方" :visible.sync="rubikModel" width="1300px" :close-on-click-modal="false">
            <div class="diy-model-style" flex="box:first" style="margin-bottom: 10px;min-width: 1280px;height: 725px;">
                <div style="padding-left: 2px;position: relative;overflow-y: auto;width:100%">
                    <div id="ggg" style="overflow-y: auto;padding: 0 60px;height: 705px;">
                        <div class="mobile-framework" style="height: 705px;">
                            <div class="mobile-framework-header"
                                 flex="dir:left main:center"
                                 style="color: #242424;background-color: #FFFFFF">
                                <div flex="cross:center">
                                    <div style="font-size: 15px;font-weight: bold">
                                        商城首页
                                    </div>
                                </div>
                            </div>
                            <div id="mobile-framework-body" class="mobile-framework-body">
                                <div style="cursor:pointer;" class="active">
                                    <diy-rubik ref="rubikref" v-model="rubikForm" :active="true">
                                        <template slot="clickset">
                                            <el-button size="small" type="primary" @click="handleSave">保存</el-button>
                                            <el-button size="small" v-on:click="handleReset">重置</el-button>
                                        </template>
                                    </diy-rubik>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </el-dialog>
        <!--客服微信-->
        <el-dialog title="客服微信" :visible.sync="wechatVisible" width="30%" :close-on-click-modal="false">
            <el-form :model="wechatForm" label-width="150px" :rules="wechatRules" ref="wechatForm"
                     @submit.native.prevent>
                <el-form-item label="客服微信二维码" prop="qrcode_url">
                    <div style="margin-bottom:10px;">
                        <app-attachment style="display:inline-block;margin-right: 10px" :multiple="false" :max="1"
                                        @selected="wechatSelect">
                            <el-tooltip effect="dark" content="建议尺寸:360 * 360" placement="top">
                                <el-button size="mini">选择文件</el-button>
                            </el-tooltip>
                        </app-attachment>
                    </div>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1" @selected="wechatSelect">
                            <app-image mode="aspectFill" width="80px" height='80px'
                                       :src="wechatForm.qrcode_url"></app-image>
                        </app-attachment>
                        <el-button v-if="wechatForm.qrcode_url" class="del-btn" size="mini" type="danger"
                                   icon="el-icon-close" circle @click="wechatClose"></el-button>
                    </div>
                </el-form-item>
                <el-form-item label="客服微信号" prop="name">
                    <el-input size="small" v-model="wechatForm.name" maxlength="20" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button size="small" @click="wechatVisible = false">取消</el-button>
                <el-button size="small" type="primary" @click.native="wechatSubmit">提交</el-button>
            </div>
        </el-dialog>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            let noPay = (rule, value, callback) => {
                let reg = /^[1-9]\d*$/;
                if (!reg.test(this.ruleForm.setting.over_time) && this.ruleForm.setting.over_time != 0) {
                    callback(new Error('未支付订单超时时间必须为整数'))
                } else if (this.ruleForm.setting.over_time > 999999) {
                    callback(new Error('未支付订单超时时间不能大于999999'))
                } else {
                    callback()
                }
            };
            let after_sale = (rule, value, callback) => {
                let reg = /^[1-9]\d*$/;
                if (!reg.test(this.ruleForm.setting.after_sale_time) && this.ruleForm.setting.after_sale_time != 0) {
                    callback(new Error('售后时间时间必须为整数'))
                } else if (this.ruleForm.setting.after_sale_time > 30) {
                    callback(new Error('售后时间不能大于30天'))
                } else {
                    callback()
                }
            };
            let delivery = (rule, value, callback) => {
                let reg = /^[1-9]\d*$/;
                if (!reg.test(this.ruleForm.setting.delivery_time) && this.ruleForm.setting.delivery_time != 0) {
                    callback(new Error('收货时间必须为整数'))
                } else if (this.ruleForm.setting.delivery_time > 30) {
                    callback(new Error('收货时间不能大于30天'))
                } else {
                    callback()
                }
            };
            return {
                is_pond: "<?= $is_pond ?>",
                is_scratch: "<?= $is_scratch ?>",
                is_plugin_show: "<?= $is_plugin_show ?>",
                rubikForm: {
                    style: -1,
                    space: 0,
                    height: 0,
                    w: 1,
                    h: 1,
                    list: [],
                    hotspot: [],
                },
                rubikModel: false,
                ruleForm: {
                    name: '',
                    setting: {
                        payment_type: [],
                        send_type: [],
                        good_negotiable: [],
                        video_number_template_list: [],

                        has_send: 0, //抽奖设置
                        send_type: 'pond', //类型
                        send_bg: "<?= Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . "/statics/img/mall/order/order-send_bg.gif" ?>",
                        send_text_color: '#FFFFFF',
                        send_num_type: 'money',//次数
                        send_num_money_max: 100,//满
                        send_num_overlapping: 1,//是否叠加
                        send_num: 1,//赠送次数
                        send_limit: 10,//限制
                        has_rubik: 0,//是否广告
                        rubik_data: {
                            style: -1,
                            space: 0,
                            height: 0,
                            w: 1,
                            h: 1,
                            list: [],
                            hotspot: [],
                        },//广告数据
                    },
                    recharge: {},
                    permission: []
                },
                rules: {
                    over_time: [
                        {validator: noPay, trigger: 'blur'}
                    ],
                    delivery_time: [
                        {validator: delivery, trigger: 'blur'}
                    ],
                    after_sale_time: [
                        {validator: after_sale, trigger: 'blur'}
                    ]
                },
                loading: false,
                submitLoading: false,

                send_type_dialogVisible: false,
                send_type_item: {
                    item: {},
                    index: 0
                },

                wechatVisible: false,
                wechatForm: {
                    qrcode_url: '',
                    name: '',
                },
                wechatRules: {
                    qrcode_url: [
                        {required: true, message: '图片不能为空', trigger: 'blur'},
                    ]
                },
            };
        },
        created() {
            this.loadData();
        },
        methods: {
            handleReset() {
                this.$refs.rubikref.data = {
                    style: -1,
                    space: 0,
                    height: 0,
                    w: 1,
                    h: 1,
                    list: [],
                    hotspot: [],
                }
            },
            handleSave() {
                this.ruleForm.setting.rubik_data = JSON.parse(JSON.stringify(this.rubikForm));
                console.log('rubik-data => ', this.ruleForm.setting.rubik_data);
                this.rubikModel = false;
            },
            openRubik() {
                const self = this;
                self.rubikModel = true;
                self.$nextTick(() => {
                    self.$refs.rubikref.data = JSON.parse(JSON.stringify(this.ruleForm.setting.rubik_data));
                })
            },
            selectSendBg(e) {
                if (e.length)
                    this.ruleForm.setting.send_bg = e[0].url;
            },
            removeSendBg() {
                this.ruleForm.setting.send_bg = '';
            },
            resetImg(type) {
                const host = "<?= Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . "/" ?>";
                this.ruleForm.setting[type] = host + 'statics/img/mall/order/order-' + type + '.gif';
            },
            loadData() {
                this.loading = true;
                request({
                    params: {
                        r: 'mall/index/setting',
                    },
                }).then(e => {
                    this.loading = false;
                    if (e.data.code === 0) {
                        this.ruleForm = e.data.data.detail;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                });
            },
            submit(formName) {
                this.$refs[formName].validate((valid,mes) => {
                    if (valid) {
                        this.submitLoading = true;
                        request({
                            params: {
                                r: 'mall/index/setting',
                            },
                            method: 'post',
                            data: {
                                ruleForm: JSON.stringify(this.ruleForm)
                            },
                        }).then(e => {
                            this.submitLoading = false;
                            if (e.data.code === 0) {
                                this.$message.success(e.data.msg);
                            } else {
                                this.$message.error(e.data.msg);
                            }
                        }).catch(e => {
                        });
                    } else {
                        //test
                        this.$message.error(Object.values(mes).shift().shift().message);
                    }
                });
            },
            set_send_type(data, index) {
                this.send_type_dialogVisible = true;
                this.send_type_item = {
                    item : JSON.parse(JSON.stringify(data)),
                    index: index
                };
            },
            sureSendType() {
                this.send_type_dialogVisible = false;
                this.ruleForm.setting.send_type_desc[this.send_type_item.index].modify = this.send_type_item.item.modify;
            },

            editWechat(item, index) {
                this.index = index;
                this.wechatForm = Object.assign({}, item);
                this.wechatVisible = true;
            },
            picClose(index) {
                this.ruleForm.setting.customer_service_list.splice(index, 1);
            },
            wechatSelect(e) {
                if (e.length) {
                    this.wechatForm.qrcode_url = e[0].url;
                }
            },

            wechatClose() {
                this.wechatForm.qrcode_url = '';
            },
            wechatSubmit() {
                this.$refs.wechatForm.validate((valid) => {
                    if (valid) {
                        if (this.index === -1) {
                            this.ruleForm.setting.customer_service_list.push(Object.assign({}, this.wechatForm));
                        } else {
                            this.ruleForm.setting.customer_service_list.splice(this.index, 1, this.wechatForm);
                        }
                        this.wechatVisible = false;
                    }
                });
            },
            addWechat() {
                this.index = -1;
                this.wechatForm = {
                    qrcode_url: '',
                    name: '',
                };
                this.wechatVisible = true
            },
        },
        computed: {
            send_type_list() {
                let list = [];
                for (let i in this.ruleForm.setting.send_type) {
                    if (this.ruleForm.setting.send_type[i] == 'express') {
                        list.push('快递配送');
                    }
                    if (this.ruleForm.setting.send_type[i] == 'offline') {
                        list.push('到店自提');
                    }
                    if (this.ruleForm.setting.send_type[i] == 'city') {
                        list.push('同城配送');
                    }
                }
                return list;
            }
        },
    });
</script>

