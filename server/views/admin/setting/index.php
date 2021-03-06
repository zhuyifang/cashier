<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/3/22
 * Time: 16:23
 */
Yii::$app->loadViewComponent('app-rich-text');
?>
<style>
    .my-img {
        height: 50px;
        border: 1px solid #d7dae2;
        border-radius: 2px;
        margin-top: 10px;
        background-color: #e2e2e2;
        overflow: hidden;
    }

    .form-body {
        display: flex;
        justify-content: center;
    }

    .form-body .el-form {
        width: 450px;
        margin-top: 10px;
    }

    .currency-width {
        width: 300px;
    }

    .currency-width .el-input__inner {
        height: 35px;
        line-height: 35px;
        border-radius: 8px;
    }

    .isAppend .el-input__inner {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .form-body .currency-width .el-input-group__append {
        width: 80px;
        background-color: #2E9FFF;
        color: #fff;
        padding: 0;
        line-height: 35px;
        height: 35px;
        text-align: center;
        border-radius: 8px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border: 0;
    }

    .preview {
        height: 75px;
        line-height: 75px;
        text-align: center;
        width: 200px;
        background-color: #F7F7F7;
        color: #BBBBBB;
        margin-top: 10px;
        font-size: 12px;
    }

    .qr-title:first-of-type {
        margin-top: 0;
    }

    .qr-title {
        color: #BBBBBB;
        font-size: 13px;
        margin-top: 10px;
    }

    .line {
        border: none;
        border-bottom: 1px solid #e2e2e2;
        margin: 40px 0;
    }

    .title {
        margin-bottom: 20px;
    }

    .submit-btn {
        height: 32px;
        width: 65px;
        line-height: 32px;
        text-align: center;
        border-radius: 16px;
        padding: 0;
    }



    .check-title {
        background-color: #F3F5F6;
        width: 100%;
        padding: 0 20px;
    }

    .check-list {
        display: flex;
        flex-wrap: wrap;
        padding: 0 20px;
    }

    .check-list .el-checkbox {
        width: 145px;
    }

    .el-checkbox {
        height: 50px;
        line-height: 50px;
    }

    .window {
        border: 1px solid #EBEEF5;
    }

    .check-title .el-checkbox__label {
        font-size: 16px;
    }
</style>
<div id="app" v-cloak>
    <el-card shadow="never" v-loading="loading">
        <div style="margin-bottom: 20px">????????????</div>
        <div class='form-body' ref="body">
            <el-form @submit.native.prevent label-position="left" label-width="150px">
                <el-form-item label="??????logo">
                    <el-input disabled class="currency-width isAppend">
                        <template slot="append">
                            <app-upload @complete="updateSuccess" accept="image/vnd.microsoft.icon" :params="params" :simple="true">
                                <el-button size="small">??????logo</el-button>
                            </app-upload>
                        </template>
                    </el-input>
                    <div style="height: 40px;line-height: 40px" class="preview">??????????????? .ico ????????????</div>
                </el-form-item>
            </el-form>
        </div>
        <div style="margin-bottom: 20px">????????????</div>
        <div class='form-body' ref="body">
            <el-form @submit.native.prevent label-position="left" label-width="150px" :model="form" ref="form">
                <!-- ???????????? -->
                <el-form-item label="????????????">
                    <el-input class="currency-width" v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item label="????????????">
                    <el-input class="currency-width" v-model="form.description"></el-input>
                </el-form-item>
                <el-form-item label="???????????????">
                    <el-input type="textarea" class="currency-width" v-model="form.keywords"></el-input>
                    <div style="color: #909399;font-size: 12px;line-height: 1;margin-top: 10px">
                        ????????????????????????,????????? ??????: ??????,??????,??????
                    </div>
                </el-form-item>
                <el-form-item label="LOGO??????URL">
                    <el-input class="currency-width isAppend" v-model="form.logo">
                        <template slot="append">
                            <app-attachment v-model="form.logo" :simple="true">
                                <el-button>????????????</el-button>
                            </app-attachment>
                        </template>
                    </el-input>
                    <img class="my-img" style="background-color: #100a46;border-color: #100a46; height: 36px;"
                         v-if="form.logo" :src="form.logo">
                    <div v-else class="preview">????????????98*50</div>
                </el-form-item>
                <el-form-item label="??????????????????">
                    <el-input class="currency-width" v-model="form.copyright"></el-input>
                </el-form-item>
                <el-form-item label="????????????url">
                    <el-input class="currency-width" v-model="form.copyright_url"
                              placeholder="??????:https://www.baidu.com">
                    </el-input>
                </el-form-item>
                <el-form-item label="??????????????????">
                    <el-input class="currency-width isAppend" v-model="form.passport_bg">
                        <template slot="append">
                            <app-attachment v-model="form.passport_bg" :simple="true">
                                <el-button>????????????</el-button>
                            </app-attachment>
                        </template>
                    </el-input>
                    <img class="my-img" style="background-color: #100a46;border-color: #100a46; height: 108px;"
                         v-if="form.passport_bg" :src="form.passport_bg">
                    <div v-else class="preview">????????????1920*1080</div>
                </el-form-item>
                <el-form-item label="??????????????????">
                    <el-input class="currency-width isAppend" v-model="form.manage_bg">
                        <template slot="append">
                            <app-attachment v-model="form.manage_bg" :simple="true">
                                <el-button>????????????</el-button>
                            </app-attachment>
                        </template>
                    </el-input>
                    <img class="my-img" style="background-color: #100a46;border-color: #100a46; height: 100px;"
                         v-if="form.manage_bg" :src="form.manage_bg">
                    <div v-else style="height: 40px;line-height: 40px" class="preview">????????????1920*200</div>
                </el-form-item>
                <el-form-item label="??????????????????" :style="{'margin-bottom': form.open_register == 0 ? '20px' : 0}">
                    <el-radio v-model="form.open_register" label="1">???</el-radio>
                    <el-radio v-model="form.open_register" label="0">???</el-radio>
                </el-form-item>
                <template v-if="form.open_register == 1">
                    <el-form-item label="??????????????????" style="margin-bottom: 0">
                        <div>
                            <el-radio v-model="form.open_verify" label="1">???</el-radio>
                            <el-radio v-model="form.open_verify" label="0">???</el-radio> 
                        </div>
                    </el-form-item>
                    <template v-if="form.open_verify == 0">
                        <el-form-item label="?????????????????????" style="margin-bottom: 0;margin-bottom: 10px;">
                            <el-autocomplete size="small" v-model="form.user_group_name" value-key="name" :fetch-suggestions="querySearchAsync" placeholder="?????????????????????" @select="selectUserGroup">
                            </el-autocomplete>
                        </el-form-item>
                        <el-form-item label="????????????????????????">
                            <div flex="dir:left cross:center" style="margin-bottom: 10px;">
                                <div style="width: 85px;color: #606266;line-height: 0">???????????????</div>
                                <div style="line-height: 0;">
                                    <el-input type="number" size="small" placeholder="???????????????" v-model="form.use_days">
                                        <template slot="append">???</template>
                                    </el-input>
                                </div>
                            </div>
                            <div flex="dir:left cross:center" style="margin-bottom: 10px;">
                                <div style="width: 85px;color: #606266;line-height: 0">???????????????</div>
                                <div style="line-height: 0;">
                                    <el-input type="number" size="small" placeholder="???????????????" v-model="form.create_num">
                                        <template slot="append">???</template>
                                    </el-input>
                                </div>
                            </div>
                        </el-form-item>
                    </template>
                    <el-form-item label="????????????????????????">
                        <div>
                            <el-radio v-model="form.open_sms" label="1">???</el-radio>
                            <el-radio v-model="form.open_sms" label="0">???</el-radio>
                        </div>
                        <div style="color: #BBBBBB;font-size: 12px;line-height: 20px;">???????????????????????????????????????</div>
                    </el-form-item>
                </template>
                <el-form-item label="????????????????????????">
                    <el-radio v-model="form.is_required" label="1">???</el-radio>
                    <el-radio v-model="form.is_required" label="0">???</el-radio>
                </el-form-item>
                <el-form-item label="??????????????????">
                    <el-input class="currency-width isAppend" v-model="form.registered_bg">
                        <template slot="append">
                            <app-attachment v-model="form.registered_bg" :simple="true">
                                <el-button>????????????</el-button>
                            </app-attachment>
                        </template>
                    </el-input>
                    <img class="my-img" style="background-color: #100a46;border-color: #100a46; height: 100px;"
                         v-if="form.registered_bg" :src="form.registered_bg">
                    <div v-else style="height: 40px;line-height: 40px" class="preview">????????????1920*200</div>
                </el-form-item>
                <el-form-item label="??????????????????">
                    <div class="qr-title">??????1</div>
                    <el-input style="margin-bottom: 10px;" class="currency-width" placeholder="??????????????????"
                              v-model="form.qr1_about"></el-input>
                    <el-input class="currency-width isAppend" v-model="form.qr1">
                        <template slot="append">
                            <app-attachment v-model="form.qr1" :simple="true">
                                <el-button>????????????</el-button>
                            </app-attachment>
                        </template>
                    </el-input>
                    <img class="my-img" style="background-color: #100a46;border-color: #100a46; height: 70px;"
                         v-if="form.qr1" :src="form.qr1">
                    <div v-else style="height: 140px;line-height: 140px" class="preview">????????????140*140</div>
                    <div class="qr-title">??????2</div>
                    <el-input style="margin-bottom: 10px;" class="currency-width" placeholder="??????????????????"
                              v-model="form.qr2_about"></el-input>
                    <el-input class="currency-width isAppend" v-model="form.qr2">
                        <template slot="append">
                            <app-attachment v-model="form.qr2" :simple="true">
                                <el-button>????????????</el-button>
                            </app-attachment>
                        </template>
                    </el-input>
                    <img class="my-img" style="background-color: #100a46;border-color: #100a46; height: 70px;"
                         v-if="form.qr2" :src="form.qr2">
                    <div v-else style="height: 140px;line-height: 140px" class="preview">????????????140*140</div>
                </el-form-item>
                <el-form-item label="????????????" style="width: 600px;">
                    <app-rich-text :simple-attachment="true" v-model="form.register_protocol"></app-rich-text>
                </el-form-item>
                <!-- ????????? -->
                <hr :style="line" class="line">
                <!-- ???????????? -->
                <!-- <el-form-item> -->
                <div :style="line" class="title">
                    <span style="font-size: 15px;">???????????????????????????</span>
                    <span style="color: #909399;font-size: 12px;">????????????????????????????????????????????????????????????????????????????????????</span>
                </div>
                <!-- </el-form-item> -->

                <el-form-item label="AccessKeyId">
                    <el-input class="currency-width" v-model="form.ind_sms.aliyun.access_key_id"></el-input>
                </el-form-item>
                <el-form-item label="AccessKeySecret">
                    <el-input class="currency-width" v-model="form.ind_sms.aliyun.access_key_secret"></el-input>
                </el-form-item>
                <el-form-item label="????????????">
                    <el-input class="currency-width" v-model="form.ind_sms.aliyun.sign"></el-input>
                </el-form-item>
                <el-form-item label="???????????????ID">
                    <el-input class="currency-width" v-model="form.ind_sms.aliyun.tpl_id"></el-input>
                    <div style="color: #909399;font-size: 12px;line-height: 1;margin-top: 10px">????????????: ??????????????????${code}
                    </div>
                </el-form-item>
                <el-form-item label="????????????????????????ID">
                    <el-input class="currency-width" v-model="form.ind_sms.aliyun.register_success_tpl_id"></el-input>
                    <div style="color: #909399;font-size: 12px;line-height: 1;margin-top: 10px">
                        ???????????????????????????????????????????????????????????????????????????${name}??????????????????
                    </div>
                </el-form-item>
                <el-form-item label="????????????????????????ID">
                    <el-input class="currency-width" v-model="form.ind_sms.aliyun.register_fail_tpl_id"></el-input>
                    <div style="color: #909399;font-size: 12px;line-height: 1;margin-top: 10px">
                        ???????????????????????????????????????????????????????????????????????????${name}??????????????????
                    </div>
                </el-form-item>
                <el-form-item v-if="form.open_sms == 1" label="????????????????????????">
                    <el-input class="currency-width" v-model="form.ind_sms.aliyun.register_apply_tpl_id"></el-input>
                    <div style="color: #909399;font-size: 12px;line-height: 1;margin-top: 10px">
                        ???????????????????????????????????????????????????????????????????????????????????????????????????????????????
                    </div>
                </el-form-item>

                <el-form-item>
                    <el-button class="submit-btn" type="primary" @click="submit" :loading="submitLoading">??????</el-button>
                </el-form-item>
            </el-form>
        </div>
    </el-card>
</div>
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                loading: false,
                submitLoading: false,
                line: {
                    width: '450px',
                    marginLeft: '-150px'
                },
                form: {
                    name: '',
                    logo: '',
                    copyright: '',
                    passport_bg: '',
                    open_register: '0',
                    open_verify: '1',
                    open_sms: '0',
                    is_required: '1',
                    register_protocol: '',
                    ind_sms: {
                        aliyun: {
                            access_key_id: '',
                            access_key_secret: '',
                            sign: '',
                            tpl_id: '',
                            register_success_tpl_id: '',
                            register_fail_tpl_id: '',
                            register_apply_tpl_id: ''
                        }
                    },
                    use_days: 0,
                    create_num: 0,
                    user_group_name: '',
                    user_group_id: null
                },
                params: {
                    r: 'admin/setting/upload-logo'
                },
            };
        },
        created() {
            this.loadData();
            this.$nextTick(function () {
                this.line.width = this.$refs.body.clientWidth + 'px';
                this.line.marginLeft = -(this.$refs.body.clientWidth - 450) / 2 + 'px';
            })
        },
        computed: {
            
        },
        methods: {
            loadData() {
                this.loading = true;
                this.$request({
                    params: {
                        r: 'admin/setting/index',
                    },
                }).then(e => {
                    this.loading = false;
                    if (e.data.code === 0) {
                        if (e.data.data.setting) {
                            this.form = e.data.data.setting;
                        }
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                });
            },
            submit() {
                this.submitLoading = true;
                this.$request({
                    params: {
                        r: 'admin/setting/index',
                    },
                    method: 'post',
                    data: {
                        setting: JSON.stringify(this.form),
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
            },
            updateSuccess(e) {
                this.$message.success('????????????')
            },
            querySearchAsync(query, cb) {
                let self = this;
                if (query == '') {
                    this.form.user_group_id = null;
                }
                request({
                    params: {
                        r: 'admin/user/user-group',
                        keyword_name: 'name',
                        keyword_value: query,
                    },
                    method: 'get',
                }).then(e => {
                    if (e.data.code === 0) {
                        let list = e.data.data.list;
                        let newList = [];
                        list.forEach(function(item) {
                            newList.push({
                                id: item.id.toString(),
                                name: item.name
                            })
                        })
                        cb(newList);
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            selectUserGroup(row) {
                this.form.user_group_id = row.id
                this.form.user_group_name = row.name
            },
        }
    });
</script>