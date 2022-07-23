<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2020/12/18
 * Time: 3:19 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
Yii::$app->loadViewComponent('app-member-auth');
Yii::$app->loadViewComponent('pick-link/app-customer');
?>
<style>
    .form-body {
        padding: 20px 0;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .button-item {
        /*margin-top: 12px;*/
        padding: 9px 25px;
    }
    .app-share img {
        position: relative;
        width: 466px;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        min-height: 100%;
        height: 457px;
    }
</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;"
             v-loading="loading">
        <div slot="header">
            <span>商品设置</span>
        </div>
        <el-form @submit.native.prevent :model="ruleForm" :rules="rules" ref="ruleForm" label-width="172px" size="small">
            <div class="form-body">
                <el-form-item label="会员等级浏览权限" prop="show_goods_auth">
                    <app-member-auth v-model="ruleForm.show_goods_auth" :members="members"></app-member-auth>
                </el-form-item>
                <el-form-item label="会员等级购买权限" prop="buy_goods_auth">
                    <app-member-auth v-model="ruleForm.buy_goods_auth" :members="members"></app-member-auth>
                </el-form-item>
                <el-form-item label="无购买权限按钮文案" prop="buy_goods_auth_text">
                    <div>
                        <el-input maxlength="12" show-word-limit style="max-width: 720px;width: 70%" v-model="ruleForm.buy_goods_auth_text" placeholder="例：仅限特定会员购买"></el-input>
                    </div>
                    <el-button type="text" @click="example.dialog = true;example.type = 'buy_goods_auth_text';example.text = '无购买权限按钮文案图例'">查看图例
                    </el-button>
                </el-form-item>
                <el-form-item style="margin-top: -10px;" label="无购买权限跳转链接" prop="buy_goods_auth_link">
                    <el-switch v-model="buy_goods_auth_link" :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item label="无购买权限点击跳转页面" v-if="buy_goods_auth_link == 1">
                    <div style="max-width: 720px;width: 70%">
                        <!--                    <el-input style="max-width: 720px;width: 70%" size="small" v-model="ruleForm.buy_goods_auth_link.new_link_url">-->
                        <app-pick-link @selected="selectLink" :show-customer="false"
                                       :link="ruleForm.buy_goods_auth_link">
                            <!--                            <el-button size="mini">选择链接</el-button>-->
                        </app-pick-link>
                        <!--                    </el-input>-->
                    </div>
                </el-form-item>
                <el-form-item label="开售提醒" prop="is_remind_sell_time">
                    <div>
                        <el-switch v-model="ruleForm.is_remind_sell_time" :active-value="1"
                                   :inactive-value="0"></el-switch>
                        <div style="color: #cccccc">开启后，定时开售的商品在开售前5分钟，买家可订阅开售提醒消息
                            <el-button type="text" @click="example.dialog = true;example.type = 'sell_time_tip';example.text = '查看开售提醒示例图'">查看示例</el-button>
                        </div>
                    </div>
                </el-form-item>
                <el-form-item>
                    <template slot='label'>
                        <span>商品详情底部客服导航</span>
                    </template>
                    <div>
                        <el-radio-group v-model="ruleForm.show_contact_type">
                            <el-radio :label="0">关闭</el-radio>
                            <el-radio :label="1">官方客服</el-radio>
                            <el-radio :label="2">外链客服</el-radio>
                            <el-radio :label="3">联系电话</el-radio>
                            <el-radio :label="4" v-if="is_qy">企业微信客服</el-radio>
                        </el-radio-group>
                    </div>
                </el-form-item>
                <el-form-item label="选择客服" v-if="ruleForm.show_contact_type === 4 && is_qy">
                    <div>
                        <app-customer @confirm="customer" :value="ruleForm.new_customer ? {show_name: ruleForm.new_customer.qy_name, second_name: ruleForm.new_customer.name} : ''"></app-customer>
                    </div>
                </el-form-item>
                <el-form-item prop="good_negotiable">
                    <template slot='label'>
                        <span>商品面议联系方式</span>
                        <el-tooltip effect="dark" placement="top">
                            <div slot="content">若客服和外链客服两者都不勾选，默认勾选在线客服；客服和外链客服前端统一显示为客服
                            </div>
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </template>
                    <el-checkbox-group v-model="ruleForm.new_good_negotiable" size="mini">
                        <el-checkbox label="contact" size="mini">在线客服</el-checkbox>
                        <el-checkbox label="contact_tel" size="mini">联系电话</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
                <template v-if="ruleForm.new_good_negotiable.indexOf('contact') !== -1">
                    <el-form-item prop="new_good_negotiable">
                        <template slot='label'>
                            <span>在线客服</span>
                        </template>
                        <el-radio-group v-model="ruleForm.contact_type" size="mini">
                            <el-radio label="contact" size="mini">官方客服</el-radio>
                            <el-radio label="contact_web" size="mini">外链客服</el-radio>
                            <el-radio label="contact_qy" size="mini">企业微信客服</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="选择客服" v-if="ruleForm.contact_type === 'contact_qy'">
                        <div>
                            <app-customer @confirm="contact_customer" :value="ruleForm.contact_customer ? {show_name: ruleForm.contact_customer.qy_name, second_name: ruleForm.contact_customer.name} : ''"></app-customer>
                        </div>
                    </el-form-item>
                </template>
                <el-form-item label="商品价格面议文案自定义" prop="negotiable_text">
                    <div>
                        <el-input maxlength="4" show-word-limit style="max-width: 720px;width: 70%" v-model="ruleForm.negotiable_text" placeholder="请输入自定义文案，例：价格面议"></el-input>
                    </div>
                    <el-button  type="text" @click="example.dialog = true;example.type = 'negotiable_text';example.text = '商品价格面议文案自定义图例'">查看图例
                    </el-button>
                </el-form-item>
            </div>
            <el-button :loading="submitLoading" class="button-item" size="small" type="primary"
                       @click="submit('ruleForm')">保存
            </el-button>
        </el-form>
        <!-- 自定义 -->
        <el-dialog :title="example.text"
                   :visible.sync="example.dialog" width="30%">
            <div flex="dir:left main:center" class="app-share">
                <img :style="{height: example.text === '查看开售提醒示例图' ? '457px': '667px',width:  example.text === '查看开售提醒示例图' ? '466px': '350px' }" :src="example[example.type]" alt="">
            </div>
            <div slot="footer" class="dialog-footer">
                <el-button size="small" @click="example.dialog = false" type="primary">我知道了</el-button>
            </div>
        </el-dialog>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                ruleForm: {
                    new_good_negotiable: [],
                    show_contact_type: 0,
                    show_goods_auth: '-1',
                    buy_goods_auth: '-1',
                    buy_goods_auth_text: '',
                    buy_goods_auth_link: {
                        name: ''
                    },
                    negotiable_text: '',
                    is_remind_sell_time: 0,
                    new_customer: null,
                    contact_customer: null,
                },
                buy_goods_auth_link: 0,
                rules: {},
                loading: false,
                submitLoading: false,
                members: [],
                example: {
                    dialog: false,
                    type: '',
                    text: '',
                    sell_time_tip: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/sell_time_tip.png",
                    buy_goods_auth_text: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/buy_goods_auth_text.png",
                    negotiable_text: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/negotiable_text.png",
                },
                is_qy: false
            };
        },
        created() {
            this.loadData();
            this.getMembers();
        },
        methods: {
            selectLink(e) {
                this.ruleForm.buy_goods_auth_link = e[0];
            },
            loadData() {
                this.loading = true;
                request({
                    params: {
                        r: 'mall/index/goods',
                    },
                }).then(e => {
                    this.loading = false;
                    if (e.data.code === 0) {
                        this.ruleForm = e.data.data.detail;
                        this.is_qy = e.data.data.is_qy;
                        if(this.ruleForm.buy_goods_auth_link && this.ruleForm.buy_goods_auth_link.id > 0) {
                            this.buy_goods_auth_link = 1;
                        }
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                });
            },
            submit(formName) {
                this.$refs[formName].validate((valid, mes) => {
                    if (valid) {
                        this.submitLoading = true;
                        this.ruleForm.buy_goods_auth_link = this.buy_goods_auth_link == 1 ? this.ruleForm.buy_goods_auth_link : {};
                        request({
                            params: {
                                r: 'mall/index/goods',
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
                        this.$message.error(Object.values(mes).shift().shift().message);
                    }
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
                        self.members = e.data.data.list;
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    self.loading = false;
                });
            },
            customer(param) {
                this.ruleForm.new_customer = param
            },
            contact_customer(param) {
                this.ruleForm.contact_customer = param
            }
        },
        watch: {
            'ruleForm.new_good_negotiable': function () {
                if (this.ruleForm.new_good_negotiable.length === 0) {
                    this.ruleForm.new_good_negotiable.push('contact');
                }
            }
        }
    });
</script>

