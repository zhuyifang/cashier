<?php
defined('YII_ENV') or exit('Access Denied');
Yii::$app->loadViewComponent('app-setting');
?>
<style>
    .form-body {
        padding: 20px 50% 20px 20px;
        background-color: #fff;
        margin-bottom: 20px;
        min-width: 1000px;
    }

    .form-button {
        margin: 0;
    }

    .form-button .el-form-item__content {
        margin-left: 0 !important;
    }

    .button-item {
        padding: 9px 25px;
    }

    .mobile-box {
        pointer-events: none !important;
        width: 400px;
        height: calc(800px - 55px);
        padding: 35px 11px;
        background-color: #fff;
        border-radius: 30px;
        background-size: cover;
        position: relative;
        font-size: .85rem;
        float: left;
        margin-right: 1rem;
    }

    .mobile-box .show-box {
        height: calc(667px - 55px);
        width: 375px;
        overflow: auto;
        font-size: 12px;
    }

    .show-box.scratch-bg {
        text-align: center;
        background-image: url(<?= \app\helpers\PluginHelper::getPluginBaseAssetsUrl() ?>/img/scratch-bg-two.png);
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    .menus-box .menu-item {
        cursor: move;
        background-color: #fff;
        margin: 5px 0;
    }

    .head-bar {
        width: 378px;
        height: 64px;
        position: relative;
        background: url('statics/img/mall/home_block/head.png') center no-repeat;
    }

    .head-bar div {
        position: absolute;
        text-align: center;
        width: 378px;
        font-size: 16px;
        font-weight: 600;
        height: 64px;
        line-height: 88px;
    }

    .head-bar img {
        width: 378px;
        height: 64px;
    }

    .el-tabs__header {
        padding: 0 20px;
        height: 56px;
        line-height: 56px;
        background-color: #fff;
        margin-bottom: 10px;
    }

    .bg-rule {
        color: #FFFFFF;
        font-size: 12px;
        text-align: center;
        background: rgba(0, 0, 0, 0.4);
        line-height: 24px;
        width: 46px;
        border-radius: 12px 0 0 12px;
        position: absolute;
        right: 0;
        top: 20px;
    }

    .bg-rule:nth-child(2) {
        top: 56px;
    }
</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <el-tabs v-model="activeName">
            <el-tab-pane label="?????????????????????" name="setting"></el-tab-pane>
            <el-tab-pane label="???????????????" name="bg"></el-tab-pane>
        </el-tabs>
        <el-form v-loading="loading" :model="form" label-width="120px" ref="form" size="small"
                 :rules="FormRules">
            <template v-if="activeName === 'setting'">
                <app-setting v-model="form" :is_discount="false " :is_share="false"
                             :is_territorial_limitation="false"></app-setting>
                <div class="form-body">
                    <el-form-item label="????????????" prop="probability">
                        <el-input size="small" v-model="form.probability" autocomplete="off"
                                  oninput="this.value = this.value.match(/10000|\d{0,4}/)">
                            <template slot="prepend">?????????</template>
                        </el-input>
                    </el-form-item>
                    <el-form-item label="????????????" prop="time">
                        <el-date-picker v-model="form.time" unlink-panels type="datetimerange" size="small"
                                        value-format="yyyy-MM-dd HH:mm:ss" range-separator="???" start-placeholder="????????????"
                                        end-placeholder="????????????"></el-date-picker>
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="????????????" prop="type">
                        <el-radio v-model="form.type" :label="1">??????{{ form.oppty }}???</el-radio>
                        <el-radio v-model="form.type" :label="2">??????{{ form.oppty }}???</el-radio>
                    </el-form-item>
                    <el-form-item label="????????????" prop="oppty">
                        <el-input size="small" v-model="form.oppty" autocomplete="off"
                                  oninput="this.value = this.value.match(/\d{0,8}/)">></el-input>
                    </el-form-item>
                    <el-form-item v-if="false" label="???????????????" prop="title">
                        <el-input size="small" v-model="form.title" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="????????????" prop="deplete_integral_num">
                        <el-input size="small" v-model="form.deplete_integral_num" autocomplete="off"
                                  oninput="this.value = this.value.match(/\d{0,8}/)">
                            ></el-input>
                    </el-form-item>
                    <el-form-item label="????????????" prop="rule">
                        <el-input rows="15" type="textarea" v-model="form.rule" autocomplete="off"></el-input>
                    </el-form-item>
                </div>
                <el-button type="primary" class="button-item" size="small" :loading=btnLoading @click="onSubmit">??????
                </el-button>
            </template>
            <template v-if="activeName === 'bg'">
                <div style="display: flex;">
                    <div class="mobile-box">
                        <div class="head-bar" flex="main:center cross:center">
                            <div>?????????</div>
                        </div>
                        <div class="show-box scratch-bg" :style="{backgroundImage: 'url(' + form.bg_pic + ')'}">
                            <div style="position: relative">
                                <div class="bg-rule">??????</div>
                                <div class="bg-rule">??????</div>
                            </div>
                            <div style="line-height: 28px;font-size: 14px;margin-top: 190px;text-align: center;">
                                <div style="color: #FFFFFF;padding: 0 15px;display: inline-block;background: rgba(0,0,0,0.3);border-radius: 14px">
                                    ?????????<span style="color: #ffb92a">3</span>?????????
                                </div>
                            </div>
                            <el-image
                                    src="<?= \app\helpers\PluginHelper::getPluginBaseAssetsUrl() ?>/img/scratch-bg-2.png"
                                    style="width:327px;height: 180px;margin-top: 20px;margin-bottom: 24px"
                            ></el-image>
                            <div flex="dir:left cross:center main:center"
                                 style="font-size: 14px;color: #FFFFFF">
                                <div flex="dir:left cross:center">
                                    <i class="el-icon-house"></i>
                                    <span style="margin-left: 10px">????????????</span>
                                </div>
                                <div flex="dir:left cross:center" style="margin-left: 90px">
                                    <span style="margin-right: 10px">??????????????????</span>
                                    <i class="el-icon-arrow-right"></i>
                                </div>
                            </div>
                            <el-image
                                    src="<?= \app\helpers\PluginHelper::getPluginBaseAssetsUrl() ?>/img/scratch-bg-3.png"
                                    style="width:327px;height: 93px;margin-top: 20px;margin-bottom: 24px"
                            ></el-image>
                        </div>
                    </div>
                    <div style="width: 100%;">
                        <div style="background: #FFFFFF;padding: 24px">
                            <el-form-item label="?????????" prop="bg_pic">
                                <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                                @selected="selectBgPic">
                                    <el-tooltip effect="dark"
                                                content="????????????:750 * 1334"
                                                placement="top">
                                        <el-button size="mini">????????????</el-button>
                                    </el-tooltip>
                                </app-attachment>
                                <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                                    <app-attachment :multiple="false" :max="1"
                                                    @selected="selectBgPic">
                                        <app-image mode="aspectFill"
                                                   width="80px"
                                                   height='80px'
                                                   :src="form.bg_pic">
                                        </app-image>
                                    </app-attachment>
                                </div>
                                <el-button size="mini" @click="resetImg('bg_pic')"
                                           style="position: absolute;top: 3px;left: 90px" type="primary">????????????
                                </el-button>
                            </el-form-item>
                        </div>
                        <el-button style="margin-top: 20px"
                                   type="primary"
                                   class="button-item"
                                   size="small"
                                   :loading=btnLoading
                                   @click="onSubmit">??????
                        </el-button>
                    </div>
                </div>
            </template>
        </el-form>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                activeName: 'setting',
                loading: false,
                time: null,
                btnLoading: false,
                form: {
                    is_sms: 0,
                    is_mail: 0,
                    is_print: 0,
                    payment_type: ['online_pay'],
                    send_type: ['express', 'offline'],
                    bg_pic: "<?= \app\helpers\PluginHelper::getPluginBaseAssetsUrl('scratch') . '/img/scratch-bg.png' ?>",
                },
                FormRules: {
                    probability: [
                        {required: true, message: '??????????????????', trigger: 'blur'},
                    ],
                    oppty: [
                        {required: true, message: '????????????????????????', trigger: 'blur'},
                    ],
                    type: [
                        {required: true},
                    ],
                    time: [
                        {required: true, message: '????????????????????????', trigger: 'blur'},
                        {
                            validator(rule, value, callback, source, options) {
                                let status = value.some(item => {
                                    let date = new Date(item).getTime();
                                    if (date / 1000 > 2145974400) {
                                        return true;
                                    }
                                    return false;
                                });
                                status ? callback("????????????") : callback();
                            }
                        }
                    ],
                },
            };
        },

        methods: {
            selectBgPic(e) {
                if (e.length) {
                    this.form.bg_pic = e.shift()['url'];
                }
            },
            resetImg(type) {
                if (type === 'bg_pic') {
                    this.form.bg_pic = "<?= \app\helpers\PluginHelper::getPluginBaseAssetsUrl('scratch') . '/img/scratch-bg.png' ?>";
                }
            },
            onSubmit() {
                this.$refs.form.validate((valid) => {
                    if (valid) {
                        this.form.start_at = this.form.time[0];
                        this.form.end_at = this.form.time[1];

                        this.btnLoading = true;
                        let para = Object.assign(this.form);
                        request({
                            params: {
                                r: 'plugin/scratch/mall/setting',
                            },
                            data: para,
                            method: 'post'
                        }).then(e => {
                            this.btnLoading = false;
                            if (e.data.code === 0) {
                                this.$message({
                                    message: e.data.msg,
                                    type: 'success'
                                });
                            } else {
                                this.$message.error(e.data.msg);
                            }
                        }).catch(e => {
                            this.btnLoading = false;
                            this.$message.error(e.data.msg);
                        });
                    }
                });
            },
            getList() {
                this.loading = true;
                request({
                    params: {
                        r: 'plugin/scratch/mall/setting',
                    },
                }).then(e => {
                console.log(e);
                this.loading = false;
                if (e.data.code === 0) {
                    if (!e.data.data) {
                        return ;
                    }
                    let time = [];
                    time.unshift(e.data.data.start_at);
                    time.push(e.data.data.end_at);
                    e.data.data.time = time;
                    this.form = e.data.data;
                } else {
                    this.$message.error(e.data.msg);
                }
            }).catch(e => {
                this.loading = false;
            });
        },
    },
    mounted: function() {
        this.getList();
    }
})
</script>
