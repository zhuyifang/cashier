<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */
?>

<style>
    .form-body {
        padding: 20px 0;
        background-color: #fff;
        margin-bottom: 20px;
        padding-right: 50%;
    }

    .form-button {
        margin: 0 !important;
    }

    .form-button .el-form-item__content {
        margin-left: 0 !important;
    }

    .button-item {
        padding: 9px 25px;
    }

    .app-share {
        padding-top: 12px;
        border-top: 1px solid #e2e2e2;
        margin-top: -20px;
    }

    .app-share .app-share-bg {
        position: relative;
        width: 403px;
        height: 319px;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center
    }

    .app-share .app-share-bg .title {
        width: 160px;
        height: 29px;
        line-height: 1;
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }

    .customize-share-title {
         margin-top: 10px;
         width: 80px;
         height: 80px;
         position: relative;
         cursor: move;
     }

    .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }
</style>
<div id="app" v-cloak>
    <el-card class="box-card" shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;"
             v-loading="cardLoading">
        <div slot="header">
            <div>
                <span></span>
            </div>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><span style="color: #409EFF;cursor: pointer"
                                          @click="$navigate({r:'mall/card/index'})">卡券</span></el-breadcrumb-item>
                <el-breadcrumb-item>卡券{{id > 0 ? '编辑' : '新建'}}</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="form-body">
            <el-form :model="ruleForm" :rules="rules" size="small" ref="ruleForm" label-width="130px">
                <el-form-item label="卡券名称" prop="name">
                    <el-input v-model="ruleForm.name" placeholder="请输入卡券名称"></el-input>
                </el-form-item>
                <el-form-item label="卡券图标" prop="pic_url">
                    <app-attachment :multiple="false" :max="1" @selected="picUrl">
                        <el-tooltip class="item" effect="dark" content="建议尺寸88*88" placement="top">
                            <el-button size="mini">选择文件</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <app-image width="80px" height="80px" mode="aspectFill" :src="ruleForm.pic_url"></app-image>
                </el-form-item>
                <el-form-item label="卡券有效期" prop="expire_type">
                    <el-radio v-model="ruleForm.expire_type" :label="1">领取后N天内有效</el-radio>
                    <el-radio v-model="ruleForm.expire_type" :label="2">时间段</el-radio>
                </el-form-item>
                <el-form-item label="有效天数" v-if="ruleForm.expire_type == 1" prop="expire_day">
                    <el-input size="small"
                              oninput="this.value = this.value.match(/[1-9]\d*|/)"
                              v-model.number="ruleForm.expire_day" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item label="有效期范围" v-if="ruleForm.expire_type == 2" prop="time">
                    <el-date-picker
                            size='small'
                            v-model="ruleForm.time"
                            value-format="yyyy-MM-dd HH:mm:ss"
                            type="datetimerange"
                            range-separator="至"
                            start-placeholder="开始日期"
                            end-placeholder="结束日期"
                    >
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="选择门店" prop="use_type">
                    <el-radio v-model="ruleForm.use_type" :label="0">所有门店可用</el-radio>
                    <el-radio v-model="ruleForm.use_type" :label="1">自定义门店</el-radio>
                </el-form-item>
                <el-form-item label="自定义门店" prop="store" v-if="ruleForm.use_type == 1">
                   <div flex="dir:top">
                       <div>
                           <el-tag v-for="(item, index) in ruleForm.store"
                                   @close="storeDelete(index)"
                                   :key="index" :disable-transitions="true"
                                   style="margin: 0 10px 10px 0;" closable>
                               {{item.name}}
                           </el-tag>
                       </div>
                   </div>
                    <el-button type="button" size="mini" @click="storeDialogVisible = true">选择门店
                    </el-button>
                </el-form-item>
                <el-form-item label="核销总次数" prop="number">
                    <el-input placeholder="请输入整数"
                              oninput="this.value = this.value.match(/[1-9]\d*|/)"
                              v-model.number="ruleForm.number"></el-input>
                    <div style="color: #c9c9c9;">注：400≥核销总次数≥1</div>
                </el-form-item>
                <el-form-item label="可发放数量" prop="total_count">
                    <label slot="label" style="padding-right: 12px">可发放数量
                        <el-tooltip class="item" effect="dark"
                                    content="卡券可发放数量，-1表示不限制发放数量"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </label>
                    <el-input placeholder="请输入卡券可发放数量"
                              type="number" :min="-1"
                              oninput="this.value = this.value.match(/[1-9]\d*|/)"
                              :disabled="ruleForm.total_count == -1"
                              v-model="ruleForm.total_count"></el-input>
                    <el-checkbox v-model="ruleForm.total_count" :true-label="-1" :false-label="0">无限制</el-checkbox>
                </el-form-item>
<!--                 <el-form-item prop="app_share_title" v-if="false">
                    <label slot="label">
                        <span>自定义分享标题</span>
                        <el-tooltip class="item" effect="dark" content="分享给好友时，作为商品名称"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </label>
                    <el-input placeholder="请输入分享标题" size="small"
                              v-model="ruleForm.app_share_title"></el-input>
                    <el-button @click="app_share.dialog = true;app_share.type = 'name_bg'"
                               type="text">查看图例
                    </el-button>
                </el-form-item>

                <el-form-item  prop="app_share_pic" v-if="false">
                    <label slot="label">
                        <span>自定义分享图片</span>
                        <el-tooltip class="item" effect="dark" content="分享给好友时，作为分享图片"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </label>
                    <app-attachment v-model="ruleForm.app_share_pic" :multiple="false" :max="1">
                        <el-tooltip class="item" effect="dark" content="建议尺寸:420 * 336"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div class="customize-share-title">
                        <app-image mode="aspectFill" width='80px' height='80px'
                                   :src="ruleForm.app_share_pic ? ruleForm.app_share_pic : ''"></app-image>
                        <el-button v-if="ruleForm.app_share_pic" class="del-btn" size="mini"
                                   type="danger" icon="el-icon-close" circle
                                   @click="ruleForm.app_share_pic = ''"></el-button>
                    </div>
                    <el-button @click="app_share.dialog = true;app_share.type = 'pic_bg'"
                               type="text">查看图例
                    </el-button>
                </el-form-item> -->
                <el-dialog :title="app_share['type'] == 'pic_bg' ? `查看自定义分享图片图例`:`查看自定义分享标题图例`"
                           :visible.sync="app_share.dialog" width="30%">
                    <div flex="dir:left main:center" class="app-share">
                        <div class="app-share-bg"
                             :style="{backgroundImage: 'url('+app_share[app_share.type]+')'}"></div>
                    </div>
                    <div slot="footer" class="dialog-footer">
                        <el-button @click="app_share.dialog = false" type="primary">我知道了</el-button>
                    </div>
                </el-dialog>
                <el-form-item label="卡券描述" prop="description">
                    <el-input
                            type="textarea"
                            :rows="4"
                            placeholder="请输入卡券描述"
                            v-model="ruleForm.description">
                    </el-input>
                </el-form-item>
                <el-form-item label="是否允许转赠" prop="is_allow_send">
                    <el-switch
                            :active-value="1"
                            :inactive-value="0"
                            v-model="ruleForm.is_allow_send">
                    </el-switch>
                </el-form-item>
                <el-form-item prop="app_share_title" v-if="ruleForm.is_allow_send">
                    <label slot="label">
                        <span>转赠标题</span>
                        <el-tooltip class="item" effect="dark" content="分享给好友时，作为商品名称"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </label>
                    <el-input placeholder="请输入分享标题" size="small"
                              v-model="ruleForm.app_share_title"></el-input>
                    <el-button @click="send.dialog = true;send.type = 'name_bg'"
                               type="text">查看图例
                    </el-button>
                </el-form-item>
                <el-form-item  prop="app_share_pic" v-if="ruleForm.is_allow_send">
                    <label slot="label">
                        <span>转赠图片</span>
                        <el-tooltip class="item" effect="dark" content="分享给好友时，作为分享图片"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </label>
                    <app-attachment v-model="ruleForm.app_share_pic" :multiple="false" :max="1">
                        <el-tooltip class="item" effect="dark" content="建议尺寸:420 * 336"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div class="customize-share-title">
                        <app-image mode="aspectFill" width='80px' height='80px'
                                   :src="ruleForm.app_share_pic ? ruleForm.app_share_pic : ''"></app-image>
                        <el-button v-if="ruleForm.app_share_pic" class="del-btn" size="mini"
                                   type="danger" icon="el-icon-close" circle
                                   @click="ruleForm.app_share_pic = ''"></el-button>
                    </div>
                    <el-button @click="send.dialog = true;send.type = 'pic_bg'"
                               type="text">查看图例
                    </el-button>
                </el-form-item>
                <el-dialog :title="send['type'] == 'pic_bg' ? `查看转赠图片图例`:`查看转赠标题图例`"
                           :visible.sync="send.dialog" width="30%">
                    <div flex="dir:left main:center" class="app-share">
                        <div class="app-share-bg"
                             :style="{backgroundImage: 'url('+send[send.type]+')'}"></div>
                    </div>
                    <div slot="footer" class="dialog-footer">
                        <el-button @click="send.dialog = false" type="primary">我知道了</el-button>
                    </div>
                </el-dialog>
            </el-form>
        </div>
        <el-button class="button-item" :loading="btnLoading" type="primary" @click="submit('ruleForm')" size="small">保存
        </el-button>
        <el-dialog
            title="选择门店"
            :visible.sync="storeDialogVisible"
            width="30%"
            >
            <div style="margin-bottom: 20px">
                <el-input @keyup.enter.native="clerkUser" clearable @clear="clerkUser" placeholder="请输入门店名称" v-model="storeKeyword">
                    <el-button slot="append" @click="clerkUser">搜索</el-button>
                </el-input>
            </div>
            <el-table
                    ref="multipleTable"
                    :data="store"
                    border
                    v-loading="storeLoading"
                    @selection-change="handleSelectionChange"
                    style="width: 100%">
                <el-table-column
                        type="selection"
                        :selectable="checkSelectable"
                        width="55">
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="门店名称"
                        >
                </el-table-column>

            </el-table>

            <span slot="footer" flex="main:justify cross:center" class="dialog-footer">
                    <div v-if="pageCount > 0">
                        <el-pagination
                                @current-change="pagination"
                                background
                                :current-page="current_page"
                                layout="prev, pager, next, jumper"
                                :page-count="pageCount">
                        </el-pagination>
                    </div>
                <div>
                    <el-button type="primary" @click="sureStore()">确 定</el-button>
                </div>
            </span>
        </el-dialog>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            var validDate = (rule, value, callback) => {
                if (!value) {
                    return callback(new Error('有效天数不能为空'));
                }
                if (value < 0.01) {
                    callback(new Error('有效天数需大于零'));
                } else if (value > 2000) {
                    callback(new Error('有效天数不能大于2000'));
                } else {
                    callback();
                }
            };

            var storeRule = (rule, value, callback) => {
                if(this.ruleForm.use_type == 1) {
                    if(this.ruleForm.store) {
                        if(this.ruleForm.store.length == 0) {
                            callback(new Error('请选择门店'));
                        }else {
                            callback();
                        }
                    }else {
                        callback(new Error('请选择门店'));
                    }
                }
            };
            var isDecimal = (rule, value, callback) => {
                setTimeout(() => {
                    if (value < 1 || value > 400) {
                        callback(new Error('请输入大于等于 1 且小于等于 400 的整数'));
                    } else {
                        callback();
                    }
                }, 100);
            }

            return {
                store: [],
                storeKeyword: '',
                storeDialogVisible: false,
                storeLoading: false,
                pageCount: 1,
                current_page: 1,
                page: 1,
                chooseStore: [],
                ruleForm: {
                    pic_url: '',
                    description: '',
                    expire_type: 1,
                    expire_day: '',
                    begin_time: '',
                    end_time: '',
                    time: [],
                    total_count: -1,
                    app_share_title: '',
                    app_share_pic: '',
                    use_type: 0,
                    store: [],
                    number: 0,
                },
                rules: {
                    name: [
                        {required: true, message: '请输入卡券名称', trigger: 'change'},
                    ],
                    description: [
                        {required: true, message: '请输入卡券描述', trigger: 'change'},
                    ],
                    pic_url: [
                        {required: true, message: '请选择卡券图标', trigger: 'change'},
                    ],
                    expire_type: [
                        {required: true, message: '请选择卡券有效期', trigger: 'change'},
                    ],
                    use_type: [
                        {required: true, message: '请选择门店', trigger: 'change'},
                    ],
                    expire_day: [
                        {required: true, message: '请输入有效天数', trigger: 'change'},
                        {validator: validDate, trigger: 'change'},
                    ],
                    time: [
                        {required: true, message: '请选择有效时间范围', trigger: 'change'},
                    ],
                    number: [
                        {required: true, message: '请输入可核销总次数', trigger: 'change'},
                        {validator: isDecimal, trigger: 'change'},
                    ],
                    total_count: [
                        {required: true, message: '请输入可发放数量', trigger: 'change'},
                    ],
                    store: [
                        {required: true,validator: storeRule, trigger: 'change'}
                    ],
                },
                btnLoading: false,
                cardLoading: false,
                app_share: {
                    dialog: false,
                    type: '',
                    bg: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/app-share.png",
                    name_bg: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/card/app-share-name.png",
                    pic_bg: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/card/app-share-pic.png",
                },
                send: {
                    dialog: false,
                    type: '',
                    bg: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/app-share.png",
                    name_bg: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/card/send-name.png",
                    pic_bg: "<?= \Yii::$app->request->baseUrl?>/statics/img/mall/card/send-pic.png",
                },
                id: 0,
            };
        },
        methods: {
            submit(formName) {
                if (this.ruleForm.expire_type == 1) {
                    this.ruleForm.time = ['0000-00-00', '0000-00-00']
                } else {
                    this.ruleForm.expire_day = 0
                }
                this.$refs[formName].validate((valid) => {
                    let self = this;
                    if (valid) {
                        self.btnLoading = true;
                        if(this.ruleForm.use_type == 1 && this.ruleForm.store && this.ruleForm.store.length > 0) {
                            this.ruleForm.store_ids = [];
                            for(let item of this.ruleForm.store) {
                                this.ruleForm.store_ids.push(item.id)
                            }
                        }
                        request({
                            params: {
                                r: 'mall/card/edit'
                            },
                            method: 'post',
                            data: {
                                form: self.ruleForm,
                            }
                        }).then(e => {
                            self.btnLoading = false;
                            if (e.data.code == 0) {
                                self.$message.success(e.data.msg);
                                navigateTo({
                                    r: 'mall/card/index'
                                })
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
                        r: 'mall/card/edit',
                        id: getQuery('id')
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
            picUrl(e) {
                if (e.length) {
                    this.ruleForm.pic_url = e[0].url;
                    this.$refs.ruleForm.validateField('pic_url');
                }
            },
            clerkUser() {
                this.storeLoading = true;
                request({
                    params: {
                        r: 'mall/store/index',
                        keyword: this.storeKeyword,
                        page: this.page
                    },
                }).then(e => {
                    this.storeLoading = false;
                    if (e.data.code === 0) {
                        this.store = e.data.data.list;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                });
            },
            storeDelete(index) {
                this.ruleForm.store.splice(index, 1);
            },
            handleSelectionChange(index) {
                this.chooseStore = index;
            },
            checkSelectable(row) {
                if(this.ruleForm.store) {
                    for (let i = 0; i < this.ruleForm.store.length; i++) {
                        if (this.ruleForm.store[i].id == row.id) {
                            return false;
                        }
                    }
                }else {
                    this.ruleForm.store = [];
                }
                return true;
            },
            pagination(e) {
                this.page = e;
                this.clerkUser();
            },
            sureStore() {
                this.storeDialogVisible = false;
                let choose = [];
                let newChoose = JSON.parse(JSON.stringify(this.ruleForm.store));
                choose = newChoose.concat(this.chooseStore);
                let obj = {};
                choose = choose.reduce(function(item, next) {
                   obj[next.id] ? '' : obj[next.id] = true && item.push(next);
                      return item;
                }, []);
                this.ruleForm.store = choose;
            }
        },
        mounted: function () {
            if (getQuery('id')) {
                this.getDetail();
                this.id = getQuery('id');
            }
            this.clerkUser();
        }
    });
</script>
