<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/6/21
 * Time: 1:45 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
?>
<style>
    .el-tabs__header {
        padding: 0 20px;
        height: 56px;
        line-height: 56px;
        background-color: #fff;
        margin-bottom: 0;
    }
</style>
<div id="app" v-cloak>
    <el-card v-loading="loading" style="border:0" shadow="never"
             body-style="background-color: #f3f3f3;padding: 10px 0 0 0;">
        <el-tabs v-model="activeName">
            <el-tab-pane label="密钥管理" name="first">
                <el-card shadow="never" style="margin-top: 10px">
                    <el-form :model="ruleForm" size="small" ref="ruleForm1" label-width="150px">
                        <el-form-item label="商城ID：" prop="mall_id">
                            <span>{{ruleForm.mall_id}}</span>
                        </el-form-item>
                        <el-form-item label="小程序appid：" prop="wx_appid">
                            <span>{{ruleForm.wx_appid}}</span>
                        </el-form-item>
                        <el-form-item label="app_key：" prop="app_key">
                            <span>{{ruleForm.app_key}}</span>
                        </el-form-item>
                        <el-form-item label="app_secret：" prop="app_secret">
                            <label slot="label">
                                <el-tooltip class="item" effect="dark"
                                            content="为保障安全不在存储app_secret；如果遗忘，请重置"
                                            placement="top">
                                    <i class="el-icon-info"></i>
                                </el-tooltip>app_secret：
                            </label>
                            <el-button type="text" v-if="!ruleForm.app_secret" @click="reset">重置</el-button>
                            <span v-else>{{ruleForm.app_secret}}</span>
                        </el-form-item>
                    </el-form>
                </el-card>
            </el-tab-pane>
            <el-tab-pane label="推送管理" name="second">
                <el-card shadow="never" style="margin-top: 10px">
                    <el-form :model="ruleForm" size="small" ref="ruleForm2" label-width="150px">
                        <el-form-item>
                            <div>企业微信客户管理系统中的配置信息</div>
                        </el-form-item>
                        <el-form-item label="appid：" prop="app_key">
                            <el-input v-model="ruleForm.appid" placeholder="企业微信客户管理系统中的appid"></el-input>
                        </el-form-item>
                        <el-form-item label="secret：" prop="secret">
                            <el-input v-model="ruleForm.secret" placeholder="企业微信客户管理系统中的secret"></el-input>
                        </el-form-item>
                        <el-form-item label="域名：" prop="domain">
                            <el-input v-model="ruleForm.domain" placeholder="企业微信客户管理系统的域名，需要带上http://或者https://"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" size="mini" @click="submit" :loading="btnLoading">保存</el-button>
                        </el-form-item>
                    </el-form>
                </el-card>
            </el-tab-pane>
        </el-tabs>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                loading: false,
                ruleForm: {
                    mall_id: '',
                    wx_appid: '',
                    app_secret: '',
                    app_key: '',
                    appid: '',
                    secret: '',
                    domain: '',
                },
                hidden: {
                    app_secret: true,
                },
                activeName: 'first',
                btnLoading: false
            };
        },
        created() {
            this.loading = true;
            this.$request({
                method: 'get',
                params: {
                    r: 'plugin/scrm/mall/index/index',
                }
            }).then(e => {
                this.loading = false;
                if (e.data.code === 0) {
                    this.ruleForm = e.data.data
                } else {
                    this.$message.error(e.data.msg);
                }
                console.log(e)
            }).catch(e => {
                console.log(e)
            });
        },
        methods: {
            reset() {
                this.loading = true;
                this.$request({
                    method: 'post',
                    params: {
                        r: 'plugin/scrm/mall/index/index',
                    },
                    data: {
                        _csrf: _csrf
                    }
                }).then(e => {
                    this.loading = false;
                    if (e.data.code === 0) {
                        this.ruleForm.app_secret = e.data.data.app_secret
                    } else {
                        this.$message.error(e.data.msg);
                    }
                    console.log(e)
                }).catch(e => {
                    console.log(e)
                });
            },
            submit() {
                this.btnLoading = true;
                this.$request({
                    method: 'post',
                    params: {
                        r: 'plugin/scrm/mall/index/submit',
                    },
                    data: {
                        _csrf: _csrf,
                        appid: this.ruleForm.appid,
                        secret: this.ruleForm.secret,
                        domain: this.ruleForm.domain
                    }
                }).then(e => {
                    this.btnLoading = false;
                    if (e.data.code === 0) {
                        this.$message.success(e.data.msg);
                    } else {
                        this.$message.error(e.data.msg);
                    }
                    console.log(e)
                }).catch(e => {
                    this.btnLoading = false;
                });
            }
        }
    });
</script>
