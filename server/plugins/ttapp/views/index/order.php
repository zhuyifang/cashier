<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */
Yii::$app->loadViewComponent('order/app-search');
?>
<style>
    .table-body {
        padding: 20px 20px 0 20px;
        background-color: #fff;
    }

    .input-item {
        display: inline-block;
        width: 290px;
        margin: 0 0 20px;
    }

    .input-item .el-input__inner {
        border-right: 0;
    }

    .input-item .el-input__inner:hover{
        border: 1px solid #dcdfe6;
        border-right: 0;
        outline: 0;
    }

    .input-item .el-input__inner:focus{
        border: 1px solid #dcdfe6;
        border-right: 0;
        outline: 0;
    }

    .input-item .el-input-group__append {
        background-color: #fff;
        border-left: 0;
        width: 10%;
        padding: 0;
    }

    .input-item .el-input-group__append .el-button {
        padding: 0;
    }

    .input-item .el-input-group__append .el-button {
        margin: 0;
    }

    .order-type-list .el-tabs__nav-wrap::after {
        height: 0;
    }
    .order-type-list .el-tabs__header {
        margin: 0;
    }

</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <div slot="header">
            <div flex="dir:left">
                <div class="order-type-list" flex="cross:center" flex-box="1">
                    <el-tabs v-model="searchData.order_type" @tab-click="search">
                    <el-tab-pane label="订单" name="order"></el-tab-pane>
                    <el-tab-pane label="余额充值" name="balance"></el-tab-pane>
                    <el-tab-pane label="会员等级购买" name="member"></el-tab-pane>
                  </el-tabs>
                </div>
                <div>
                    <el-button v-if="searchData.sub_account_type == '2'" :loading="btnLoading" @click="batchSettle" type="primary" size="small">批量分账</el-button>
                </div>
            </div>
        </div>
        <div class="table-body">
            <el-tabs v-model="searchData.sub_account_type" @tab-click="search">
                <app-search @search="search" :select-list="selectList" :is-show-platform="false" :is-show-order-type="false" :tabs="tabs" :new-search="searchData"></app-search>
                <el-tab-pane label="已分账" name="1">
                    <el-table
                    ref="multipleTable1"
                    :data="list"
                    border
                    style="width: 100%"
                    v-loading="listLoading">
                        <el-table-column prop="created_at" label="下单时间" width="220"></el-table-column>
                        <el-table-column prop="order_no" label="订单号" width="220"></el-table-column>
                        <el-table-column prop="price" label="分账金额"></el-table-column>
                        <el-table-column prop="sub_account_at" label="分账时间" width="220"></el-table-column>
                    </el-table>
                </el-tab-pane>
                <el-tab-pane label="未分账" name="2">
                    <el-table
                    ref="multipleTable2"
                    :data="list"
                    border
                    style="width: 100%"
                    v-loading="listLoading">
                        <el-table-column prop="created_at" label="下单时间" width="220"></el-table-column>
                        <el-table-column prop="order_no" label="订单号" width="250"></el-table-column>
                        <el-table-column prop="pay_price" label="订单金额"></el-table-column>
                        <el-table-column label="操作" width="320">
                            <template slot-scope="scope">
                                <el-tooltip class="item" effect="dark" content="分账" placement="top">
                                    <el-button v-if="scope.row.is_sale" @click="subAccount(scope.row)" circle type="text" size="mini">
                                        <img src="statics/img/mall/order/sub-account.png" alt="">
                                    </el-button>
                                    <div style="color: #ff4544;" v-else >订单未过售后</div>
                                </el-tooltip>
                            </template>
                        </el-table-column>
                    </el-table>
                </el-tab-pane>
            </el-tabs>
            
            <div flex="dir:right" style="margin-top: 20px;">
                <el-pagination 
                    @current-change="pagination" 
                    hide-on-single-page 
                    background 
                    layout="total, prev, pager, next, jumper"
                    :total="pageCount">  
                </el-pagination>
            </div>
        </div>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                tabs: [],
                searchData: {
                    time: null,
                    keyword: '',
                    keyword_1: '1',
                    date_start: null,
                    date_end: null,
                    date_type: 'created_time',
                    plugin: 'all',
                    platofrm: '',
                    send_type: -1,
                    page: 1,
                    order_type: 'order',
                    sub_account_type: '1'
                },
                listLoading: false,
                btnLoading: false,
                list: [],
                page: 1,
                pageCount: null,
                selectList: [
                    {value: 'order_no', name: '订单号'}
                ]
            };
        },
        methods: {
            search() {
                this.page = 1;
                this.getList();
            },
            pagination(currentPage) {
                this.page = currentPage;
                this.getList();
            },
            getList() {
                this.listLoading = true;
                let searchData = JSON.parse(JSON.stringify(this.searchData));
                request({
                    params: {
                        r: 'plugin/ttapp/index/order',
                        page: this.page,
                        search: searchData
                    },
                }).then(e => {
                    if (e.data.code === 0) {
                        this.list = e.data.data.list;
                        this.pageCount = e.data.data.pagination.pageCount;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                    this.listLoading = false;
                }).catch(e => {
                    this.listLoading = false;
                });
            },
            subAccount(item) {
                this.$confirm('是否对订单号 ' + item.order_no + ' 进行分账', '分账', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.listLoading = true;
                    request({
                        params: {
                            r: 'plugin/ttapp/index/sub-account',
                        },
                        data: {
                            id: item.id
                        },
                        method: 'post',
                    }).then(e => {
                        if (e.data.code === 0) {
                            this.$message.success(e.data.msg);
                            this.getList()
                        } else {
                            this.$message.error(e.data.msg);
                        }
                        this.listLoading = false;
                    }).catch(e => {
                        this.listLoading = false;
                    });
                }).catch(() => {

                });
            },
            batchSettle() {
                this.$confirm('是否对全部未分账订单进行分账', '批量分账', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'warning'
                }).then(() => {
                    this.btnLoading = true;
                    let searchData = JSON.parse(JSON.stringify(this.searchData));
                    request({
                        params: {
                            r: 'plugin/ttapp/index/batch-sub-account',
                        },
                        data: {
                            search: JSON.stringify(searchData)
                        },
                        method: 'post',
                    }).then(e => {
                        if (e.data.code === 0) {
                            this.$message.success(e.data.msg);
                            this.getList()
                        } else {
                            this.$message.error(e.data.msg);
                        }
                        this.btnLoading = false;
                    }).catch(e => {
                        this.btnLoading = false;
                    });
                }).catch(() => {

                });
            }
        },
        mounted: function () {
            this.getList();
        }
    });
</script>
