<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */
?>

<style>
    .nav-box {
        width: 220px;
        height: 45px;
        line-height: 45px;
        border: 1px solid #000000;
        text-align: center;
    }

    .bottom-icon {
        width: 80px;
        height: 80px;
        margin-right: 10px;
        border: 1px solid #eeeeee;
        cursor: move;
    }

    .nav-action {
        cursor: pointer;
    }

    .nav-icon {
        width: 22px;
        height: 22px;
    }

    .nav-add {
        border: 1px dashed #eeeeee;
        cursor: pointer;
    }

    .nav-add-icon {
        font-size: 50px;
        color: #eeeeee;
    }

    .form-body {
        padding: 20px 0;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .button-item {
        padding: 9px 25px;
    }

    .mobile {
        width: 419px;
        height: 825px;
        border-radius: 30px;
        /*background-color: #fff;*/
        padding: 33px 12px;
        margin-right: 10px;
        background-image:url('statics/img/mall/mch/navbar/mobile-bg.png');
        position: relative;
    }

    .foot {
        border: 2px solid #F3F5F6;
        height: 50px;
        width: 375px;
        position: absolute;
        top: 683px;
        left: 20px;
        padding-top: 5px;
    }

    .foot .nav-icon {
        height: 20px;
        width: 20px;
    }

    .foot .nav-icon + div {
        margin-top: -10px;
    }

    .title {
        padding: 18px 20px;
        border-bottom: 1px solid #F3F3F3;
        background-color: #fff;
    }

    .hide-icon {
        width: 31px;
        height: 31px;
        position: absolute;
        right: 0;
        top: 0;
    }
</style>

<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;"
             v-loading="cardLoading">
        <div slot="header">
            <div>
                <span>标签栏设置</span>
            </div>
        </div>
        <div flex="dir:left">
            <div class="mobile">
                <div 
                    class="foot"
                    v-if="isShow"
                    :style="{backgroundColor: ruleForm.bottom_background_color, color: ruleForm.bottom_text_color}">
                    <div flex="dir:left box:mean">
                        <div v-if="item.is_show == 1 || item.url == '/plugins/mch/shop/shop'" flex="dir:top cross:center" v-for="(item, index) in ruleForm.navs" @click="navClick(index)">
                            <div>
                                <img :src="navCurrent == index ? item.active_icon : item.icon" class="nav-icon">
                            </div>
                            <div style="font-size: 11px;" :style="{color:navCurrent == index ? item.active_color : item.color}">
                                {{item.text}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div flex-box="1">
                <el-form :model="ruleForm" :rules="rules" size="small" ref="ruleForm" label-width="120px">
                    <div class="title">底部标签栏</div>
                    <div class='form-body'>
                        <el-form-item label="背景颜色" prop="bottom_background_color">
                            <div flex="dir:left">
                                <el-color-picker v-model="ruleForm.bottom_background_color"></el-color-picker>
                                <el-input style="margin-left: 10px;width: 400px;" v-model="ruleForm.bottom_background_color"></el-input>
                            </div>
                        </el-form-item>
                        <!-- <el-form-item label="导航阴影效果">
                            <el-switch
                                    v-model="ruleForm.shadow"
                                    active-color="#3399ff">
                            </el-switch>
                        </el-form-item> -->
                        <el-form-item label="底部导航图标">
                            <draggable flex="main:left" style="flex-wrap: wrap" v-model="ruleForm.navs" id="box">
                                <div @mouseenter="navIconEnter(index)"
                                     @mouseleave="navIconAway"
                                     style="position: relative;border-radius: 3px;"
                                     flex="dir:top box:mean"
                                     v-for="(item, index) in ruleForm.navs"
                                     class="bottom-icon">
                                    <div flex="main:center cross:center">
                                        <img v-if="item.is_show == 0" src="statics/img/mall/mch/navbar/hide.png" class="hide-icon">
                                        <img :src="item.icon" class="nav-icon" style="margin-top: 10px;">
                                    </div>
                                    <div style="color: #999999;" flex="main:center cross:center">{{item.text}}</div>
                                    <div v-show="navIconIndex == index"
                                         style="position: absolute;bottom: 0;width: 100%;height: 30px;"
                                         class="nav-action"
                                         flex="box:mean">
                                        <span @click="navIconEdit(index)" style="background: rgba(64, 158, 255, 0.9);color: #ffffff"
                                              flex="main:center cross:center">
                                            编辑
                                        </span>
                                        <span v-if="item.is_show == 0 || item.is_show == 1" @click="hide(item)"
                                              style="background: rgba(245, 108, 108, 0.9);color: #ffffff"
                                              flex="main:center cross:center">
                                            {{item.is_show == 1 ? '隐藏' : '显示'}}
                                        </span>
                                    </div>
                                </div>
                            </draggable>
                        </el-form-item>
                    </div>
                    <el-button class="button-item" :loading="btnLoading" type="primary" @click="store('ruleForm')"
                               size="small">保存
                    </el-button>
                    <el-button class="button-item" :loading="btnLoading" size="small" plain @click="restoreDefault">
                        恢复默认
                    </el-button>
                </el-form>
            </div>
        </div>
        <el-dialog @close="dialogColse" title="导航菜单编辑" :visible.sync="dialogFormVisible">
            <el-form :model="dialogRuleForm" :rules="dialogRules" size="small" ref="dialogRuleForm" label-width="120px">
                <el-row>
                    <el-col :span="18">
                        <el-form-item label="图标" prop="icon">
                            <app-attachment :multiple="false" :max="1" @selected="iconUrl">
                                <el-tooltip effect="dark" content="建议尺寸64*64" placement="top">
                                    <el-button size="mini">选择文件</el-button>
                                </el-tooltip>
                            </app-attachment>
                            <app-image mode="aspectFill" width="80px" height="80px"
                                       :src="dialogRuleForm.icon"></app-image>
                        </el-form-item>
                        <el-form-item label="选择状态图标" prop="active_icon">
                            <app-attachment :multiple="false" :max="1" @selected="activeIconUrl">
                                <el-tooltip effect="dark" content="建议尺寸64*64" placement="top">
                                    <el-button size="mini">选择文件</el-button>
                                </el-tooltip>
                            </app-attachment>
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height="80px"
                                       :src="dialogRuleForm.active_icon">
                            </app-image>
                        </el-form-item>
                        <el-form-item label="名称" prop="text">
                            <el-input v-model.trim="dialogRuleForm.text" maxlength="5" show-word-limit></el-input>
                        </el-form-item>
                        <el-form-item label="文字颜色" prop="color">
                            <div flex="dir:left">
                                <el-color-picker
                                    v-model="dialogRuleForm.color">
                                </el-color-picker>
                                <el-input style="margin-left: 10px;" v-model="dialogRuleForm.color"></el-input>
                            </div>
                        </el-form-item>
                        <el-form-item label="选中文字颜色" prop="active_color">
                            <div flex="dir:left">
                                <el-color-picker
                                    v-model="dialogRuleForm.active_color">
                                </el-color-picker>
                                <el-input style="margin-left: 10px;" v-model="dialogRuleForm.active_color"></el-input>
                            </div>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="footer">
                <el-button size="small" @click="dialogFormVisible = false">取 消</el-button>
                <el-button size="small" type="primary" @click="dialogFormSubmit('dialogRuleForm')">提 交</el-button>
            </div>
        </el-dialog>
    </el-card>
</div>
<script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.3/Sortable.min.js"></script>
<!-- CDNJS :: Vue.Draggable (https://cdnjs.com/) -->
<script src="<?= Yii::$app->request->baseUrl ?>/statics/unpkg/vuedraggable@2.18.1/dist/vuedraggable.umd.min.js"></script>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                ruleForm: {
                    bottom_background_color: '#ffffff',
                    top_background_color: '#ffffff',
                    top_text_color: '#000000',
                    navs: [],
                },
                rules: {
                    bottom_background_color: [
                        {required: true, message: '请选择底栏背景颜色', trigger: 'change'},
                    ],
                },
                btnLoading: false,
                cardLoading: false,

                activeName: 'first',
                isNavAction: false,//编辑删除框是否显示
                navIconIndex: -1,//控制导航编辑隐藏显示
                navEditIndex: -1, //当前编辑的导航索引
                dialogFormVisible: false,
                dialogRuleForm: {
                    active_color: '#ff4544',
                    active_icon: '',
                    color: '#888',
                    text: '',
                    icon: '',
                    url: '',
                },
                navMaxCount: 5, // 导航最大数量限制
                dialogRules: {
                    icon: [
                        {required: true, message: '请选择图标', trigger: 'change'},
                    ],
                    active_icon: [
                        {required: true, message: '请选择选中状态图标', trigger: 'change'},
                    ],
                    color: [
                        {required: true, message: '请选择文字颜色', trigger: 'change'},
                    ],
                    active_color: [
                        {required: true, message: '请选择文字选中状态颜色', trigger: 'change'},
                    ],
                    text: [
                        {required: true, message: '请输入导航名称', trigger: 'change'},
                    ],
                    url: [
                        {required: true, message: '请选择导航链接', trigger: 'change'},
                    ],
                },
                navCurrent: 0,
            };
        },
        computed: {
            isShow() {
                let num = 0;
                this.ruleForm.navs.forEach(function(item) {
                    if (item.is_show == 1) {
                        num += 1;
                    }

                    if (item.url == '/plugins/mch/shop/shop') {
                        num += 1;
                    }
                })

                return num > 1 ? true : false;
            }
        },
        methods: {
            store(formName) {
                this.$refs[formName].validate((valid) => {
                    let self = this;
                    if (valid) {
                        self.btnLoading = true;
                        request({
                            params: {
                                r: 'mall/navbar/setting'
                            },
                            method: 'post',
                            data: {
                                form: self.ruleForm,
                            }
                        }).then(e => {
                            self.btnLoading = false;
                            if (e.data.code == 0) {
                                self.$message.success(e.data.msg);
                            } else {
                                self.$message.error(e.data.msg);
                            }
                        }).catch(e => {
                            self.$message.error(e.data.msg);
                            self.btnLoading = false;
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            getDetail() {
                let self = this;
                self.cardLoading = true;
                request({
                    params: {
                        r: 'mall/navbar/setting',
                    },
                    method: 'get',
                }).then(e => {
                    self.cardLoading = false;
                    if (e.data.code == 0) {
                        self.ruleForm = e.data.data.detail;
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            handleClick(tab, event) {
                console.log(tab, event);
            },
            // 鼠标移入事件
            navIconEnter(index) {
                this.navIconIndex = index;
            },
            // 鼠标离开事件
            navIconAway() {
                this.navIconIndex = -1;
            },
            // 导航图标编辑
            navIconEdit(index) {
                this.dialogFormVisible = true;
                if (index != -1) {
                    this.navEditIndex = index;
                    this.dialogRuleForm = JSON.parse(JSON.stringify(this.ruleForm.navs[index]))
                }
            },
            // 弹框关闭事件回调
            dialogColse() {
                this.navEditIndex = -1;
                this.clearDialogData();
            },
            clearDialogData() {
                this.dialogRuleForm = {
                    active_color: '#ff4544',
                    active_icon: '',
                    color: '#888',
                    text: '',
                    icon: '',
                    url: '',
                    params: [],
                };
            },
            // 导航图标删除
            hide(navbar) {
                navbar.is_show = navbar.is_show == 1 ? 0 : 1;
            },
            dialogFormSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    let self = this;
                    if (valid) {
                        self.dialogFormVisible = false;
                        if (self.navEditIndex != -1) {
                            self.ruleForm.navs[self.navEditIndex] = self.dialogRuleForm;
                        } else {
                            self.ruleForm.navs.push(self.dialogRuleForm)
                        }
                        self.navEditIndex = -1;
                        this.clearDialogData();
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            // 添加图标
            iconUrl(e) {
                if (e.length) {
                    this.dialogRuleForm.icon = e[0].url
                    this.$refs.dialogRuleForm.validateField('icon');
                }
            },
            // 添加选择状态图标
            activeIconUrl(e) {
                if (e.length) {
                    this.dialogRuleForm.active_icon = e[0].url
                    this.$refs.dialogRuleForm.validateField('active_icon');
                }
            },
            // 导航链接选择
            selectNavUrl(e) {
                let self = this;
                e.forEach(function (item, index) {
                    self.dialogRuleForm.url = item.new_link_url;
                    self.dialogRuleForm.open_type = !item.open_type || item.open_type === 'navigate' ? 'redirect' : item.open_type;
                    self.dialogRuleForm.params = item.params;
                    self.dialogRuleForm.key = item.key ? item.key : '';
                })
            },
            // 恢复默认
            restoreDefault() {
                let self = this;
                self.$confirm('恢复默认, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    self.btnLoading = true;
                    request({
                        params: {
                            r: 'mall/navbar/default',
                        },
                        method: 'post',
                        data: {}
                    }).then(e => {
                        self.btnLoading = false;
                        if (e.data.code === 0) {
                            self.$message.success(e.data.msg);
                            self.getDetail();
                        } else {
                            self.$message.error(e.data.msg);
                        }
                    }).catch(e => {
                        console.log(e);
                    });
                }).catch(() => {
                    self.$message.info('已取消')
                });
            },
            navClick(index) {
                this.navCurrent = index
            }
        },
        mounted: function () {
            this.getDetail();
        }
    });
</script>
