<?php defined('YII_ENV') or exit('Access Denied');
Yii::$app->loadViewComponent('app-poster');
$imageUrl = \app\helpers\PluginHelper::getPluginBaseAssetsUrl() . '/img/';
?>
<style>
    .el-tabs__header {
        padding: 0 20px;
        height: 56px;
        line-height: 56px;
        background-color: #fff;
        margin-bottom: 10px;
    }

    .button-item {
        margin-top: 12px;
        padding: 9px 25px;
    }

    .mobile-box {
        width: 400px;
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
        height: calc(667px - 20px);;
        width: 375px;
        overflow: auto;
        font-size: 12px;
        position: relative;
        background: #f7f7f7;
        overflow-x: hidden;
    }

    .mobile-box .show-box .bg {
        height: 350px;
        width: 263px;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    .mobile-box .show-box .btn {
        height: 33.5px;
        width: 212px;
        background-color: #FDD88A;
        border-radius: 16px;
        bottom: 23px;
        font-size: 15px;
        color: #cb0908;
        text-align: center;
        margin-left: 29px;
        position: absolute;
    }

    .event-step {
        margin-left: 5px;
        pointer-events: none !important;
    }

    .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }

    .reset {
        position: absolute;
        top: 7px;
        left: 90px;
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
</style>
<section id="app" v-cloak>
    <el-card style="border:0" shadow="never" body-style="background-color: #f3f3f3;padding: 0 0;"
             v-loading="listLoading">
        <el-form @submit.native.prevent :model="ruleForm" label-width="150px" :rules="ruleFormRules" ref="ruleForm"
                 style="width: 100%">
            <el-tabs v-model="activeName">
                <el-tab-pane label="????????????" name="first"></el-tab-pane>
                <el-tab-pane label="??????????????????" name="second"></el-tab-pane>
                <el-tab-pane label="?????????????????????" name="three"></el-tab-pane>
                <el-tab-pane label="??????????????????" name="four"></el-tab-pane>
            </el-tabs>
            <!-- ???????????? -->
            <div v-if="activeName === 'first'" style="display: flex;">
                <div class="mobile-box">
                    <div class="show-box">
                        <div style="margin: 150px auto 0;width: 263.5px;height:350px;position: relative">
                            <div class="bg" :style="{backgroundImage:'url(' + ruleForm.bg_pic + ')'}"></div>
                            <div style="position: absolute;top: 0;height: 100%;width: 100%;text-align: center">
                                <app-image v-if="ruleForm.contact_list && ruleForm.contact_list.length"
                                           :src="ruleForm.contact_list[0]['qrcode']"
                                           style="position:absolute;top:79px;left:74px;height: 115px !important;width: 115px !important;"
                                           class="code"></app-image>
                                <div style="color: #353535 !important;font-size: 10px;margin-top: 197px">?????????????????????????????????
                                </div>
                                <div style="word-break: break-all;text-align: justify;padding: 17px 18px 0;"
                                     :style="{color: ruleForm.custom_color}"
                                     v-text="ruleForm.custom"></div>
                                <div class="btn" flex="cross:center main:center">???????????????</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 100%">
                    <el-card shadow="never">
                        <div slot="header">
                            <span>???????????????</span>
                        </div>
                        <div>
                            <el-form-item label="?????????" prop="bg_pic">
                                <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                                @selected="selectBgPic">
                                    <el-tooltip effect="dark"
                                                content="????????????:650 * 700"
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
                                                   :src="ruleForm.bg_pic">
                                        </app-image>
                                    </app-attachment>
                                </div>
                                <el-button size="mini" @click="resetImg('bg_pic')"
                                           style="position: absolute;top: 7px;left: 90px" type="primary">????????????
                                </el-button>
                            </el-form-item>
                        </div>
                    </el-card>
                    <el-card shadow="never" style="margin-top: 12px">
                        <div slot="header">
                            <span>???????????????</span>
                        </div>
                        <el-form-item label="?????????????????????" prop="contact_list">
                            <el-tooltip effect="dark"
                                        content="????????????:200 * 200"
                                        placement="top">
                                <el-button size="mini" @click="wechatAdd"
                                           :disabled="ruleForm.contact_list.length >= 10">??????
                                </el-button>
                            </el-tooltip>
                            <div flex="dir:left cross:center" style="flex-wrap: wrap">
                                <div v-for="(item,index) of ruleForm.contact_list" @click="wechatEdit(item,index)"
                                     style="margin:0 5px 5px;cursor: pointer;flex-shrink: 0;position: relative">
                                    <div>
                                        <app-image mode="aspectFill"
                                                   width="200px"
                                                   height='200px'
                                                   :src="item['qrcode']"
                                        ></app-image>
                                        <div class="wechat-end-box" style="padding-left: 12px">???????????? {{item['name']}}
                                        </div>
                                    </div>

                                    <el-button class="del-btn"
                                               size="mini" type="danger" icon="el-icon-close"
                                               circle
                                               @click.stop="wechatDel(index)"
                                    ></el-button>
                                </div>
                            </div>
                            <div style="color:#909399">???????????????????????????10??????????????????????????????</div>
                        </el-form-item>
                    </el-card>
                    <el-card shadow="never" style="margin-top: 12px">
                        <div slot="header">
                            <span>???????????????</span>
                        </div>
                        <div>
                            <el-form-item label="????????????" prop="custom_color">
                                <div flex="dir:left cross:center">
                                    <el-color-picker
                                            @change="(row) => {row == null ? ruleForm.custom_color = '#ffffff' : ''}"
                                            size="small"
                                            v-model="ruleForm.custom_color"></el-color-picker>
                                    <el-input size="small" style="width: 90px;margin-left: 5px;"
                                              v-model="ruleForm.custom_color"></el-input>
                                </div>
                            </el-form-item>
                            <el-form-item label="????????????" prop="custom">
                                <el-input size="small"
                                          placeholder="????????????50??????"
                                          v-model="ruleForm.custom"
                                          autocomplete="off"
                                          maxlength="50"
                                ></el-input>
                            </el-form-item>
                        </div>
                    </el-card>
                </div>
            </div>
            <!-- ?????????????????? -->
            <div v-if="activeName === 'second'">
                <div style="background: #FFFFFF" flex="dir:left">
                    <div style="margin: 12px;background: #f3f5f6;width: 400px;border-radius: 24px"
                         flex="cross:center main:center">
                        <app-image :src="styleList[ruleForm.style - 1].picUrl"
                                   style="height: 314px;width:256px"></app-image>
                    </div>
                    <div style="margin-left: 80px;margin-top: 12px">
                        <el-form-item prop="style">
                            <label slot="label">??????????????????
                                <el-tooltip class="item" effect="dark"
                                            content="???????????????????????????????????????"
                                            placement="top">
                                    <i class="el-icon-info"></i>
                                </el-tooltip>
                            </label>
                            <div flex="dir:left" style="margin-top: 12px;width: 350px;flex-wrap: wrap">
                                <el-card :body-style="{ padding: '0px'}" shadow="never"
                                         style="cursor: pointer;margin: 0 5px 14px"
                                         v-for="style of styleList"
                                         :style="{'border-color': ruleForm.style == style.value ? '#409eff': '' }"
                                >
                                    <div flex="dir:top" @click="handleStyle(style.value)"
                                         style="height: 208px;width: 160px;">
                                        <div style="height: 30px">
                                            <el-radio v-model="ruleForm.style" class="event-step"
                                                      :label="parseInt(style.value)">
                                                {{style.name}}
                                            </el-radio>
                                        </div>
                                        <app-image :src="style.picUrl"
                                                   style="height: 136px;width: 112px;margin: 20px auto 0"
                                        ></app-image>
                                    </div>
                                </el-card>
                            </div>
                        </el-form-item>
                    </div>
                </div>
            </div>
            <!-- ????????????????????? -->
            <div v-if="activeName === 'three'" style="display: flex;">
                <div class="mobile-box">
                    <div class="show-box" flex="dir:top">
                        <app-image :src="ruleForm.activity_bg_pic"
                                   style="flex-shrink:0;height: 240px;width: 100%"></app-image>
                        <div style="flex-shrink: 1;background: red;height: 100%"
                             :style="{background: 'linear-gradient(' + ruleForm.activity_bg_color +', '+ (ruleForm.activity_bg_style === 'gradient' ? ruleForm.activity_bg_gradient_color: ruleForm.activity_bg_color) + ')'}">
                        </div>
                    </div>
                </div>
                <div style="width: 100%">
                    <el-card shadow="never">
                        <div slot="header">
                            <span>???????????????</span>
                        </div>
                        <div>
                            <el-form-item label="?????????" prop="activity_bg_pic">
                                <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                                @selected="selectActivityBgPic">
                                    <el-tooltip effect="dark"
                                                content="????????????:750 * 480"
                                                placement="top">
                                        <el-button size="mini">????????????</el-button>
                                    </el-tooltip>
                                </app-attachment>
                                <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                                    <app-attachment :multiple="false" :max="1"
                                                    @selected="selectActivityBgPic">
                                        <app-image mode="aspectFill"
                                                   width="80px"
                                                   height='80px'
                                                   :src="ruleForm.activity_bg_pic">
                                        </app-image>
                                    </app-attachment>
                                    <el-button v-if="ruleForm.activity_bg_pic" class="del-btn"
                                               size="mini" type="danger" icon="el-icon-close"
                                               circle
                                               @click="ruleForm.activity_bg_pic = ''"
                                    ></el-button>
                                </div>
                                <el-button size="mini" @click="resetImg('activity_bg_pic')" class="reset"
                                           type="primary">????????????
                                </el-button>
                            </el-form-item>
                            <el-form-item label="?????????????????????" prop="activity_bg_style">
                                <el-radio v-model="ruleForm.activity_bg_style" label="pure">??????</el-radio>
                                <el-radio v-model="ruleForm.activity_bg_style" label="gradient">??????</el-radio>
                            </el-form-item>
                            <el-form-item label="?????????????????????" prop="activity_bg_color">
                                <div flex="dir:left cross:center">
                                    <el-color-picker
                                            @change="(row) => {row == null ? ruleForm.activity_bg_color = '#f12416' : ''}"
                                            size="small"
                                            v-model="ruleForm.activity_bg_color"></el-color-picker>
                                    <el-input size="small" style="width: 90px;margin-left: 5px;"
                                              v-model="ruleForm.activity_bg_color"></el-input>
                                </div>
                            </el-form-item>
                            <el-form-item v-if="ruleForm.activity_bg_style === 'gradient'" label="???????????????????????????"
                                          prop="activity_bg_gradient_color">
                                <div flex="dir:left cross:center">
                                    <el-color-picker
                                            @change="(row) => {row == null ? ruleForm.activity_bg_gradient_color = '#f12416' : ''}"
                                            size="small"
                                            v-model="ruleForm.activity_bg_gradient_color"></el-color-picker>
                                    <el-input size="small" style="width: 90px;margin-left: 5px;"
                                              v-model="ruleForm.activity_bg_gradient_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-card>
                </div>
            </div>
            <!-- ?????????????????? -->
            <div v-show="activeName === 'four'">
                <app-poster :rule_form="ruleForm.poster" :goods_component="goodsComponent">
                    <el-button slot="more-button" size="mini" @click="reset('poster')" style="margin-left: 10px">
                        ????????????
                    </el-button>

                </app-poster>
            </div>
            <el-button class="button-item" type="primary" :loading="btnLoading" @click="onSubmit">??????</el-button>
        </el-form>
        <!--????????????-->
        <el-dialog title="????????????" :visible.sync="wechatVisible" width="30%" :close-on-click-modal="false">
            <el-form :model="wechatForm" label-width="150px" :rules="wechatRules" ref="wechatForm"
                     @submit.native.prevent>
                <el-form-item label="?????????????????????" prop="qrcode">
                    <div style="margin-bottom:10px;">
                        <app-attachment style="display:inline-block;margin-right: 10px" :multiple="false" :max="1"
                                        @selected="wechatSelect">
                            <el-tooltip effect="dark" content="????????????:360 * 360" placement="top">
                                <el-button size="mini">????????????</el-button>
                            </el-tooltip>
                        </app-attachment>
                    </div>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1" @selected="wechatSelect">
                            <app-image mode="aspectFill" width="80px" height='80px'
                                       :src="wechatForm.qrcode"></app-image>
                        </app-attachment>
                        <el-button v-if="wechatForm.qrcode" class="del-btn" size="mini" type="danger"
                                   icon="el-icon-close" circle @click="wechatForm.qrcode = ''"></el-button>
                    </div>
                </el-form-item>
                <el-form-item label="???????????????" prop="name">
                    <el-input size="small" v-model="wechatForm.name" maxlength="20" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button size="small" @click="wechatVisible = false">??????</el-button>
                <el-button size="small" type="primary" @click.native="wechatSubmit">??????</el-button>
            </div>
        </el-dialog>
    </el-card>
</section>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            let styleList = [
                {
                    name: '?????????',
                    value: 1,
                    picUrl: "<?= $imageUrl ?>" + 'default_a.png',
                }, {
                    name: '?????????',
                    value: 2,
                    picUrl: "<?= $imageUrl ?>" + 'default_b.png',
                }, {
                    name: '?????????',
                    value: 3,
                    picUrl: "<?= $imageUrl ?>" + 'default_c.png',
                }, {
                    name: '?????????',
                    value: 4,
                    picUrl: "<?= $imageUrl ?>" + 'default_d.png',
                }];
            return {
                wechatVisible: false,
                wechatForm: {
                    qrcode: '',
                    name: '',
                },
                wechatRules: {
                    qrcode: [
                        {required: true, message: '?????????????????????', trigger: 'blur'},
                    ],
                    name: [
                        {required: true, message: '???????????????????????????', trigger: 'blur'},
                    ],
                },

                activeName: 'first',
                styleList,
                defaultImage: {
                    bg_pic: "<?= $imageUrl . 'bg-f.png' ?>",
                    activity_bg_pic: "<?= $imageUrl . 'image-normal.png' ?>",
                },
                ruleForm: {
                    bg_pic: "",
                    contact_list: [],
                    custom: "",
                    style: 1,
                    activity_bg_color: "#990f18",
                    activity_bg_pic: "",
                    activity_bg_style: "pure",
                    activity_bg_gradient_color: "#990f18",
                    poster: null,
                },

                listLoading: false,
                btnLoading: false,
                ruleFormRules: {
                    type: [
                        {required: true, message: '??????????????????', trigger: 'blur'},
                    ]
                },
                goodsComponent: [
                    {
                        key: 'head',
                        icon_url: 'statics/img/mall/poster/icon_head.png',
                        title: '??????',
                        is_active: true,
                    },
                    {
                        key: 'nickname',
                        icon_url: 'statics/img/mall/poster/icon_nickname.png',
                        title: '??????',
                        is_active: true
                    },
                    {
                        key: 'remake',
                        icon_url: 'statics/img/mall/poster/icon_content.png',
                        title: '????????????',
                        is_active: true
                    },
                    {
                        key: 'desc',
                        icon_url: 'statics/img/mall/poster/icon_desc.png',
                        title: '????????????',
                        is_active: true
                    },
                    {
                        key: 'qr_code',
                        icon_url: 'statics/img/mall/poster/icon_qr_code.png',
                        title: '?????????',
                        is_active: true
                    },
                ],
            };
        },
        methods: {
            wechatDel(index) {
                this.ruleForm.contact_list.splice(index, 1);
            },
            wechatSelect(e) {
                if (e.length) this.wechatForm.qrcode = e[0]['url'];
            },
            wechatAdd() {
                this.wechatForm = {qrcode: '', name: '', index: this.ruleForm.contact_list.length};
                this.wechatVisible = true;
            },
            wechatEdit(column, index) {
                this.wechatForm = Object.assign({index}, column);
                this.wechatVisible = true;
            },
            wechatSubmit() {
                this.$refs.wechatForm.validate((valid) => {
                    if (valid) {
                        let {index, qrcode, name} = this.wechatForm;
                        this.ruleForm.contact_list.splice(index, index === this.ruleForm.contact_list.length ? 0 : 1, {
                            qrcode,
                            name
                        });
                        this.wechatVisible = false;
                    }
                });
            },
            selectBgPic(e) {
                if (e.length) this.ruleForm.bg_pic = e[0]['url'];
            },
            selectActivityBgPic(e) {
                if (e.length) this.ruleForm.activity_bg_pic = e[0]['url'];
            },
            handleStyle(style) {
                this.ruleForm.style = style;
            },
            reset(data) {
                if (data === 'poster') {
                    this.ruleForm.poster = JSON.parse(JSON.stringify(this.ruleForm.default_poster));
                }
            },
            resetImg(type) {
                switch (type) {
                    case 'bg_pic':
                        Object.assign(this.ruleForm, {bg_pic: this.defaultImage.bg_pic})
                        break;
                    case 'activity_bg_pic':
                        Object.assign(this.ruleForm, {activity_bg_pic: this.defaultImage.activity_bg_pic})
                        break;
                    default:
                        break;
                }
            },

            onSubmit() {
                this.$refs.ruleForm.validate((valid) => {
                    if (valid) {
                        this.btnLoading = true;
                        let para = Object.assign({}, this.ruleForm);
                        request({
                            params: {
                                r: 'plugin/fission/mall/setting/index',
                            },
                            data: para,
                            method: 'post'
                        }).then(e => {
                            if (e.data.code === 0) {
                                this.$message.success(e.data.msg)
                            } else {
                                this.$message.error(e.data.msg);
                            }
                            this.btnLoading = false;
                        }).catch(e => {
                            this.$message.error(e.data.msg);
                            this.btnLoading = false;
                        });
                    }
                });
            },

            getList() {
                this.listLoading = true;
                request({
                    params: {
                        r: 'plugin/fission/mall/setting/setting-data',
                    },
                }).then(e => {
                    if (e.data.code === 0) {
                        if (e.data.data) {
                            let data = e.data.data;
                            data.bg_pic = data.bg_pic || this.defaultImage.bg_pic;
                            data.activity_bg_pic = data.activity_bg_pic || this.defaultImage.activity_bg_pic;
                            data.style = parseInt(data.style);
                            this.ruleForm = data;
                        }
                    }
                    this.listLoading = false;
                }).catch(e => {
                    this.$message.error(e.data.msg);
                    this.listLoading = false;
                });
            },
        },

        mounted: function () {
            this.getList();
        }
    })
</script>