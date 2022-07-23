<?php
/**
 * Created by PhpStorm
 * User: 风哀伤
 * Date: 2020/12/18
 * Time: 3:19 下午
 * @copyright: ©2020 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
?>
<style>
    .form-body {
        padding: 20px 0;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .button-item {
        padding: 9px 25px;
    }
</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;"
             v-loading="loading">
        <div slot="header">
            <span>基础设置</span>
        </div>
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="172px" size="small">
            <div class="form-body">
                <el-form-item prop="status" label="同城速送">
                    <el-switch v-model="ruleForm.status" :active-value="1" :inactive-value="0"></el-switch>
                    <div style="color: #b4bccc;">开启后,同城配送订单的配送方式可选择“同城速送”</div>
                </el-form-item>
                <template v-if="ruleForm.status == 1">
                    <el-form-item prop="data.app_id" label="APPID">
                        <el-input style="width: 500px;" v-model="ruleForm.data.app_id" placeholder="请输入 APPID"></el-input>
                    </el-form-item>
                    <el-form-item prop="data.token" label="Token">
                        <el-input style="width: 500px;" v-model="ruleForm.data.token" placeholder="请输入 Token"></el-input>
                    </el-form-item>
                    <el-form-item prop="data.domain" label="域名">
                        <el-input style="width: 500px;" v-model="ruleForm.data.domain" placeholder="请输入 域名"></el-input>
                    </el-form-item>
                </template>
            </div>
            <el-button :loading="submitLoading" class="button-item" size="small" type="primary"
                       @click="store('ruleForm')">保存
            </el-button>
        </el-form>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                ruleForm: {},
                rules: {
                    'data.app_id': [
                        {required: true, message: '请填写 app_id', trigger: 'change'},
                    ],
                    'data.token': [
                        {required: true, message: '请填写 token', trigger: 'change'},
                    ],
                    'data.domain': [
                        {required: true, message: '请填写 域名', trigger: 'change'},
                    ],
                },
                loading: false,
                submitLoading: false
            };
        },
        created() {
            this.loadData();
        },
        methods: {
            loadData() {
                this.loading = true;
                request({
                    params: {
                        r: 'plugin/ma_ke/mall/setting/index',
                    },
                }).then(e => {
                    this.loading = false;
                    if (e.data.code === 0) {
                        this.ruleForm = e.data.data.setting;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                });
            },
            store(formName) {
                let self = this;
                this.$refs[formName].validate((valid) => {
                    let self = this;
                    if (valid) {
                        self.submitLoading = true;
                        request({
                            params: {
                                r: 'mall/city-service/edit'
                            },
                            method: 'post',
                            data: {
                                form: this.ruleForm,
                            }
                        }).then(e => {
                            self.submitLoading = false;
                            if (e.data.code == 0) {
                                self.$message.success(e.data.msg);
                            } else {
                                self.$message.error(e.data.msg);
                            }
                        }).catch(e => {
                            self.$message.error(e.data.msg);
                            self.submitLoading = false;
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
        }
    });
</script>

