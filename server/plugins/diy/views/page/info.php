<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/4/23
 * Time: 15:09
 */
?>
<style type="text/css">
    @import "<?= \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/statics/css/element/table.css' ?>";
</style>
<style>
    .table-body {
        padding: 20px;
        background-color: #fff;
    }

    .diy-info-style {
        min-height: 40px;
        background: #ffffff;
        border-radius: 3px;
    }

    .diy-info-style:nth-child(2n+1) {
        background: #F1F5F7;
    }

    .input-item {
        display: inline-block;
        width: 290px;
        margin: -2px 70px 18px 0;
    }
    .show-send {
        width: 90px;
        height: 25px;
        border: 1px solid #409EFF;
        border-radius: 3px;
        color: #409EFF;
        font-size: 14px;
        cursor: pointer;
    }
    .show-send+div>div {
        margin-top: 10px;
    }
    .send-label {
        width: 100px;
        flex-shrink: 0;
        vertical-align: top;
    }
    .reply-content {
        width: 100%;
        padding: 20px 43px;
        background-color: #F1F5F7;
        color: #545B60;
        font-size: 14px;
        position: relative;
    }
    .reply-content::before {
        content: '' !important;
        position: absolute;
        top: -10px;
        left: 40px;
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-bottom: 10px solid #F1F5F7;
    }
    .edit-btn {
        width: 70px;
        height: 25px;
        border-radius: 3px;
        color: #FFFFFF;
        background-color: #409EFF;
        font-size: 14px;
        cursor: pointer;
    }
    .edit-btn img {
        width: 20px;
        height: 20px;
    }
    .diy-info-style .el-icon-circle-close {
        color: #fff;
    }
    .send-data>div {
        margin: 5px 0;
    }
</style>
<div id="app" v-cloak>
    <el-card class="info" shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <div slot="header">
            <span>表单提交信息</span>
            <app-new-export-dialog-2
                    style="float: right;margin-top: -5px"
                    text='批量导出'
                    :params="search"
                    :field_list='export_list'
                    action_url="plugin/diy/mall/page/info">
            </app-new-export-dialog-2>
        </div>
        <div style="padding: 20px;background-color: #fff">
            <div flex="dir:left cross:center">
                <div class="input-item">
                    <el-input @keyup.enter.native="searchList" prefix-icon="el-icon-search"size="small" placeholder="请输入表单ID、名称、用户名称搜索" v-model="search.keyword" clearable @clear="searchList">
                        <!-- <el-button slot="append" icon="el-icon-search" @click="search"></el-button> -->
                    </el-input>
                </div>
                <el-date-picker size="small" style="margin-bottom: 20px;" @change="changeTime" v-model="time"
                                type="datetimerange" value-format="yyyy-MM-dd HH:mm:ss" range-separator="至"
                                start-placeholder="开始日期" end-placeholder="结束日期">
                </el-date-picker>
                <el-button style="margin: -2px 0 18px 60px;width: 85px" size="small" type="primary" @click="searchList">查  询</el-button>
            </div>

            <el-table v-loading="loading" border :data="list" style="margin-bottom: 15px;">
                <el-table-column prop="id" label="ID" width="150px"></el-table-column>
                <el-table-column prop="nikename" label="用户">
                    <template slot-scope="scope">
                        <div flex="dir:left">
                            <app-image mode="aspectFill" style="margin: 5px 8px 5px 30px;border-radius: 5px"
                                       :src="scope.row.avatar"></app-image>
                            <div style="text-align: left;padding-top: 5px">
                                <div>{{scope.row.nickname}}</div>
                                <div style="color: #99A1AA;font-size: 12px;margin-top: 2px;">来源于{{scope.row.platform}}</div>
                            </div>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column prop="form_list_name" label="表单名称" width="300px"></el-table-column>
                <el-table-column prop="source" label="来源" width="300px"></el-table-column>
                <el-table-column prop="created_at" label="提交时间">
                </el-table-column>
                <el-table-column prop="form_data" label="操作">
                    <template slot-scope="scope">
                        <el-tooltip class="item" effect="dark" content="查看详情" placement="top">
                            <img style="cursor: pointer" @click="toDetail(scope.row)"
                                 src="statics/img/mall/list/info.png"
                                 alt="">
                        </el-tooltip>
                        <el-tooltip class="item" effect="dark" content="删除" placement="top">
                            <img style="cursor: pointer;margin-left: 10px;" @click="toDelete(scope.row.id)"
                                 src="statics/img/mall/list/del.png"
                                 alt="">
                        </el-tooltip>
                    </template>
                </el-table-column>
            </el-table>
            <div flex="dir:right">
                <div></div>
                <div>
                    <el-pagination
                            background
                            :page-size="pagination.pageSize"
                            @current-change="pageChange"
                            layout="total,prev, pager, next, jumper" :current-page="pagination.current_page"
                            :total="pagination.totalCount">
                    </el-pagination>
                </div>
            </div>
        </div>
    </el-card>
    <el-dialog :title="formName" :visible.sync="dialogTableVisible">
        <el-dialog width="50%" :visible.sync="videoForm.status" append-to-body>
            <div style="text-align: center">
                <video autoplay
                       controls
                       width="700"
                       :src="videoForm.src"
                ></video>
            </div>
        </el-dialog>

        <div style="width: 100%;padding: 0 20px 28px">
            <el-row :gutter="20" class="diy-info-style" style="font-weight: bold" flex="dir:left cross:center">
                <el-col :span="10" style="padding: 15px 0 15px 20px">表单名称</el-col>
                <el-col :span="10" style="padding: 15px 0 15px 20px">填写内容</el-col>
            </el-row>
            <el-row v-for="(info,i) of detail" :key="i" :gutter="20" class="diy-info-style" flex="dir:left cross:center" v-if="!(info.key === 'button' && info.value.is_pay == 0)">
                <el-col :span="10" style="padding: 15px 0 15px 20px">{{info.key === 'button' ? '支付信息' : info.label}}</el-col>
                <el-col :span="10" style="padding: 15px 0 15px 20px">
                    <div v-if="info.value && [`,`,``].indexOf(info.value.toString()) === -1">
                        <template v-if="info.key=== 'uvideo'">
                            <div v-for="(item,index) in info.value" :key="index" style="position: relative;display: inline-block">
                                <video :src="item"
                                       style="height: 50px;width: 50px;border-radius: 5px;margin-right: 5px"
                                ></video>
                                <el-image
                                        style="position:absolute;height: 30px;width: 30px;
                                    border-radius: 5px;margin-right: 5px;left: 10px;top: 10px;cursor:pointer"
                                        src="statics/img/mall/diy/play.png"
                                        @click="playVideo(item)"
                                ></el-image>
                            </div>
                        </template>
                        <template v-else-if="info.key === 'img_upload' || info.key === 'uimage'">
                            <el-image v-for="img in info.value"
                                      :preview-src-list="[img]"
                                      :src="img"
                                      style="height: 50px;width: 50px;border-radius: 5px;margin-right: 5px"
                            ></el-image>
                        </template>
                        <template v-else-if="info.key === 'button' && info.value.is_pay == 1">
                            <div>
                                <span v-if="info.value.title">感谢您购买{{info.value.title}}</span>
                            </div>
                            <div>
                                <div v-if="info.value.title" style="height: 10px;"></div>
                                已成功支付{{pay_price}}元  
                            </div>
                        </template>
                        <template v-else-if="info.key === 'calendar'">
                            <div v-if="info.value.before && info.value.after">{{info.value.before}}~{{info.value.after}}</div>
                            <div v-else-if="info.value.fulldate">{{info.value.fulldate}}</div>
                            <div v-else>{{info.value ? info.value : '未填写'}}</div>
                        </template>
                        <template v-else-if="info.key === 'calendar'">
                            <div v-if="info.value.before && info.value.after">{{info.value.before}}~{{info.value.after}}</div>
                            <div v-else-if="info.value.fulldate">{{info.value.fulldate}}</div>
                            <div v-else>{{info.value ? info.value : '未填写'}}</div>
                        </template>
                        <template v-else-if="info.key === 'menu'">

                            <div v-if="info.value.type == 'date' && info.value.begin_at && info.value.end_at">{{info.value.begin_at}}~{{info.value.end_at}}</div>
                            <div v-else-if="info.value.type == 'date' && info.value.alone_at">{{info.value.alone_at}}</div>
                            <div v-else>{{info.value.text ? info.value.text : '未填写'}}</div>
                        </template>
                        <template v-else-if="info.key === 'agreement'">
                            {{info.value.is_check ? '同意' : '未同意'}}
                        </template>
                        <template v-else-if="info.key === 'phone'">
                            {{info.value ? info.value.mobile : '未验证'}}
                        </template>
                        <template v-else-if="info.key === 'switch'">
                            {{info.value ? '开启' : '关闭'}}
                        </template>
                        <template v-else-if="info.key === 'input'">
                            {{info.value.text ? info.value.text : '未填写'}}
                        </template>
                        <template v-else-if="info.key === 'send_data'">
                            <div class="send-data" style="font-size: 14px;">
                                <div v-if="info.value.send_balance > 0" flex="dir:left cross:top">
                                    <div class="send-label">赠送金额</div>
                                    <div>{{info.value.send_balance}}元</div>
                                </div>
                                <div v-if="info.value.send_integral > 0" flex="dir:left cross:top">
                                    <div class="send-label">赠送积分</div>
                                    <div>{{info.value.send_integral}}积分</div>
                                </div>
                                <div v-if="info.value.send_member_name" flex="dir:left cross:top">
                                    <div class="send-label">赠送会员</div>
                                    <div>{{info.value.send_member_name}}</div>
                                </div>
                                <div v-if="info.value.send_coupon_list && info.value.send_coupon_list.length > 0" flex="dir:left cross:top">
                                    <div class="send-label">赠送优惠券</div>
                                    <div>
                                        <div :key="idx" v-for="(coupon,idx) in info.value.send_coupon_list">{{coupon.send_num}}张{{coupon.name}}</div>
                                    </div>
                                </div>
                                <div v-if="info.value.send_card_list && info.value.send_card_list.length > 0" flex="dir:left cross:top">
                                    <div class="send-label">赠送卡券</div>
                                    <div>
                                        <div :key="idx" v-for="(card,idx) in info.value.send_card_list">{{card.num}}张{{card.name}}</div>
                                    </div>
                                </div>
                                <div v-if="info.value.send_scratch > 0" flex="dir:left cross:top">
                                    <div class="send-label">赠送抽奖机会</div>
                                    <div>刮刮卡抽奖机会{{info.value.send_scratch}}次</div>
                                </div>
                                <div v-if="info.value.send_pond > 0" flex="dir:left cross:top">
                                    <div class="send-label">赠送抽奖机会</div>
                                    <div>九宫格抽奖机会{{info.value.send_pond}}次</div>
                                </div>
                            </div>
                        </template>
                        <div v-else>{{info.value ? info.value : '未填写'}}</div>
                    </div>
                    <div v-else>{{info.value ? info.value : '未填写'}}</div>
                </el-col>
            </el-row>
            <div style="margin-top: 50px">
                <div flex="main:justify cross:center" style="margin-bottom: 20px;">
                    <div flex="dir:left cross:center">
                        <img style="cursor: pointer" src="statics/img/mall/list/info.png" alt="">
                        <div>回复</div>
                    </div>
                    <div v-if="!edit_reply" @click="edit_reply = true" class="edit-btn" flex="main:center cross:center">
                        <img src="statics/img/mall/icon_reply_edit.png" alt="">
                        <div>修改</div>
                    </div>
                </div>
                <div class="reply-content" v-if="!edit_reply"><pre>{{reply_content}}</pre></div>
                <el-input v-else type="textarea" placeholder="请输入回复内容" :row="30"
                          v-model="reply_content"
                          :autosize="{ minRows: 6}">
                </el-input>
            </div>
            <div style="margin-top: 20px" v-if="edit_reply" flex="main:center">
                <el-button :loading="btnLoading" size="small" type="primary" @click="dialogTableVisible = false;reply_content=''" style="padding: 9px 29px">取消</el-button>
                <el-button :loading="btnLoading" size="small" type="primary" @click="tabSubmit" style="margin-left: 30px;padding: 9px 29px">确定</el-button>
            </div>
        </div>
    </el-dialog>
</div>
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                edit_reply: true,
                form_id: 0,
                reply_content: '',
                formName: '',
                pay_price: 0,
                loading: false,
                innerVisible: false,
                btnLoading: false,
                list: [],
                img: '',
                detail: [],
                time: [],
                page: 1,
                pagination: [],
                dialogTableVisible: false,
                export_list: [],
                search: {
                    keyword: '',
                    date_start: '',
                    date_end: ''
                },
                videoForm: {
                    status: false,
                    src: '',
                }
            };
        },
        created() {
            if (getQuery('diy_form_id')) {
                this.search.keyword = getQuery('diy_form_id');
            }
            this.searchList();
        },
        methods: {
            playVideo(e) {
                this.videoForm = {
                    status: true,
                    src: e
                };
            },
            tabSubmit() {
                this.btnLoading = true;
                this.$request({
                    params: {
                        r: 'plugin/diy/mall/page/info-reply',
                    },
                    data: {
                        id: this.form_id,
                        content: this.reply_content
                    },
                    method: 'post'
                }).then(response => {
                    console.log(response.data.code == 0)
                    this.btnLoading = false;
                    if (response.data.code == 0) {
                        for(let item of this.list) {
                            if(item.id == this.form_id) {
                                item.reply = this.reply_content
                            }
                        }
                        this.dialogTableVisible = false;
                        this.$message({
                          message: response.data.msg,
                          type: 'success'
                        });
                    } else {
                        this.$message.error(response.data.msg);
                    }
                }).catch(e => {
                });
            },
            pageChange(e) {
                this.page = e;
                this.loadData();
            },

            changeTime(page) {
                this.page = 1;
                this.searchList();
            },

            toDetail(e) {
                this.dialogTableVisible = !this.dialogTableVisible;
                this.formName = e.form_list_name;
                this.pay_price = e.pay_price;
                this.reply_content = e.reply ? e.reply : '';
                this.edit_reply = e.reply ? false : true;
                this.detail = JSON.parse(JSON.stringify(e.form_data));
                let send_data = e.extra && e.extra.new_send_data  && e.extra.new_send_data != [] ?e.extra.new_send_data : null;
                if(send_data) {
                    this.detail.push({
                        label: '赠送信息',
                        key: 'send_data',
                        value: send_data
                    })
                }
                this.form_id = e.id;
            },

            toLook(e) {
                this.innerVisible = !this.innerVisible;
                this.img = e;
            },

            toDelete(res) {
                let id = res;
                this.$confirm('是否删除该条记录？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning',
                    center: true,
                    beforeClose: (action, instance, done) => {
                        if (action === 'confirm') {
                            instance.confirmButtonLoading = true;
                            instance.confirmButtonText = '执行中...';
                            request({
                                params: {
                                    r: 'plugin/diy/mall/page/info-del',
                                },
                                data: {
                                    id: id,
                                },
                                method: 'post'
                            }).then(e => {
                                done();
                                instance.confirmButtonLoading = false;
                                if (e.data.code == 0) {
                                    this.loadData();
                                } else {
                                    this.$message.error(e.data.msg);
                                }
                            }).catch(e => {
                                done();
                                instance.confirmButtonLoading = false;
                                this.$message.error(e.data.msg);
                            });
                        } else {
                            done();
                        }
                    }
                }).then(() => {
                }).catch(e => {
                    this.$message({
                        type: 'info',
                        message: '取消了操作'
                    });
                });
            },

            searchList() {
                this.loading = true;
                if (this.time) {
                    this.search.date_start = this.time[0];
                    this.search.date_end = this.time[1];
                } else {
                    this.search.date_start = '';
                    this.search.date_end = '';
                }
                this.$request({
                    params: {
                        r: 'plugin/diy/mall/page/info',
                        page: this.page,
                        keyword: this.search.keyword,
                        date_start: this.search.date_start,
                        date_end: this.search.date_end,
                    }
                }).then(response => {
                    this.loading = false;
                    if (response.data.code === 0) {
                        this.list = response.data.data.list;
                        this.pagination = response.data.data.pagination;
                        this.export_list = response.data.data.export_list;
                    }
                }).catch(e => {
                });
            },
            loadData() {
                this.loading = true;
                this.$request({
                    params: {
                        r: 'plugin/diy/mall/page/info',
                        page: this.page,
                    }
                }).then(response => {
                    this.loading = false;
                    if (response.data.code === 0) {
                        this.list = response.data.data.list;
                        this.pagination = response.data.data.pagination;
                        this.export_list = response.data.data.export_list;
                    }
                }).catch(e => {
                });
            }
        },
    });
</script>