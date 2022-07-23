<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

?>
<style>
    .table-body {
        padding: 20px;
        background-color: #fff;
    }

    .input-item {
        display: inline-block;
        width: 410px;
        margin: 0 0 20px 20px;
    }

    .input-item .el-input__inner {
        border-right: 0;
    }

    .input-item .el-input__inner:hover {
        border: 1px solid #dcdfe6;
        border-right: 0;
        outline: 0;
    }

    .input-item .el-input__inner:focus {
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
        padding: 15px;
    }

    .table-body .el-button {
        padding: 0 !important;
        border: 0;
        margin: 0 5px;
    }
</style>
<div id="app" v-cloak>
    <el-card v-loading="listLoading" shadow="never" style="border:0"
             body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <div slot="header">
            <div flex="dir:left">
                <div flex="cross:center" flex-box="1">店铺微淘</div>
                <div flex-box="0">
                    <el-button type="primary" size="small" @click="edit({})">新增</el-button>
                </div>
            </div>
        </div>
        <div class="table-body">
            <span>标签</span>
            <el-select @change="search" style="width: 150px;" size="small" v-model="searchData.tag_id" placeholder="请选择">
                <el-option
                  v-for="item in tagList"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value">
                </el-option>
            </el-select>
            <div class="input-item">
                <el-input @keyup.enter.native="search" size="small" placeholder="请输入微淘标题名称搜索" v-model="searchData.keyword" clearable @clear="search">
                    <el-button slot="append" icon="el-icon-search" @click="search"></el-button>
                </el-input>
            </div>
            <span v-if="isShow" @click="clearSearchData" style="font-size: 14px;color: #C0C4CC;margin-left: 20px;cursor: pointer;">清除</span>
            <el-table :data="list" border style="width: 100%">
                <el-table-column prop="id" label="ID" width="80"></el-table-column>
                <el-table-column label="标签" prop="tag_name"></el-table-column>
                <el-table-column label="微淘内容" width="400px">
                    <template slot-scope="scope">
                        <div flex="dir:left">
                            <img :src="scope.row.pic_url" style="width: 50px;height: 50px;margin-right: 10px;">
                            <div flex="dir:top">
                                <app-ellipsis :line="1">{{scope.row.title}}</app-ellipsis>
                                <span>{{scope.row.created_at}}</span>
                            </div>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column label="布局方式" prop="layout_type" width="100px"></el-table-column>
                <el-table-column label="是否显示" prop="content" width="100px">
                    <template slot-scope="scope">
                        <el-switch @change="changeStatus(scope.row)" v-model="scope.row.is_show" :active-value="1" :inactive-value="0"></el-switch>
                    </template>
                </el-table-column>
                <el-table-column label="排序" prop="content" width="150">
                    <template slot-scope="scope">
                        <div v-if="sort_weitao_id != scope.row.id" flex="dir:left cross:center">
                            <span>{{scope.row.sort}}</span>
                            <el-button type="text" @click="editSort(scope.row)">
                                <img src="statics/img/mall/order/edit.png" alt="">
                            </el-button>
                        </div>
                        <div style="display: flex;align-items: center" v-else>
                            <el-input style="min-width: 70px" type="number" size="mini"
                                      v-model="sort"
                                      autocomplete="off"></el-input>
                            <el-button 
                                type="text" 
                                style="color: #F56C6C;padding: 0 5px"
                                icon="el-icon-error"
                                circle @click="quit()">
                            </el-button>
                            <el-button 
                                type="text"
                                style="margin-left: 0;color: #67C23A;padding: 0 5px"
                                icon="el-icon-success" 
                                circle 
                                @click="changeSortSubmit(scope.row)">
                            </el-button>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column label="操作" prop="content" fixed="right">
                    <template slot-scope="scope">
                        <el-button class="set-el-button" type="text" size="mini" circle @click="edit(scope.row)">
                            <el-tooltip class="item" effect="dark" content="编辑" placement="top">
                                <img src="statics/img/mall/edit.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button size="mini" type="text" circle>
                            <a @click="deleteWeitao(scope.row)">
                                <el-tooltip class="item" effect="dark" content="删除" placement="top">
                                    <img src="statics/img/mall/del.png" alt="">
                                </el-tooltip>
                            </a>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <div style="text-align: right;margin: 20px 0;">
                <el-pagination @current-change="pagination" background layout="prev, pager, next, jumper"
                               :page-count="pageCount"></el-pagination>
            </div>
        </div>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                searchData: {
                    keyword: '',
                    tag_id: null
                },
                list: [],
                tagList: [],
                pageCount: 0,
                listLoading: false,
                btnLoading: false,

                sort_weitao_id: '',
                sort: ''
            };
        },
        computed: {
            isShow() {
                let isShow = false
                if (this.searchData.keyword != '' || this.searchData.tag_id != null) {
                    isShow = true
                }

                return isShow
            }
        },
        methods: {
            pagination(currentPage) {
                this.page = currentPage;
                this.getList();
            },
            search() {
                this.page = 1;
                this.getList();
            },
            getList() {
                this.listLoading = true;
                request({
                    params: {
                        r: 'mall/mch/weitao',
                        page: this.page,
                        search: JSON.stringify(this.searchData)
                    },
                }).then(e => {
                    if (e.data.code === 0) {
                        this.list = e.data.data.list;
                        this.pageCount = e.data.data.pagination.page_count;
                        this.tagList = e.data.data.tag_list;
                        this.tagList.unshift({
                            label: '全部',
                            value: null
                        })
                    } else {
                        this.$message.error(e.data.msg);
                    }
                    this.listLoading = false;
                }).catch(e => {
                    this.listLoading = false;
                });
            },
            edit(row) {
                navigateTo({
                    r: 'mall/mch/weitao-edit',
                    id: row.id
                });
            },
            changeStatus(row) {
                let self = this;
                self.listLoading = true;
                request({
                    params: {
                        r: 'mall/mch/update-weitao-status'
                    },
                    method: 'post',
                    data: row
                }).then(e => {
                    self.listLoading = true;
                    if (e.data.code === 0) {
                        self.getList();
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    self.$message.error(e.data.msg);
                });
            },
            editSort(row) {
                this.sort_weitao_id = row.id;
                this.sort = row.sort;
            },
            quit() {
                this.sort_weitao_id = null;
            },
            changeSortSubmit(row) {
                let self = this;
                if (!self.sort || self.sort < 0) {
                    self.$message.warning('排序值不能小于0')
                    return;
                }
                row.sort = self.sort;
                request({
                    params: {
                        r: 'mall/mch/update-weitao-sort'
                    },
                    method: 'post',
                    data: row
                }).then(e => {
                    self.btnLoading = false;
                    if (e.data.code === 0) {
                        self.$message.success(e.data.msg);
                        this.sort_weitao_id = null;
                        self.getList();
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    self.$message.error(e.data.msg);
                    self.btnLoading = false;
                });
            },
            deleteWeitao(row) {
                let self = this;
                self.$confirm('删除该内容, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    self.listLoading = true;
                    request({
                        params: {
                            r: 'mall/mch/delete-weitao'
                        },
                        method: 'post',
                        data: {
                            id: row.id
                        }
                    }).then(e => {
                        self.listLoading = true;
                        if (e.data.code === 0) {
                            self.$message.success(e.data.msg);
                            self.getList();
                        } else {
                            self.$message.error(e.data.msg);
                        }
                    }).catch(e => {
                        self.$message.error(e.data.msg);
                    });
                }).catch(() => {
                    self.$message.info('已取消删除')
                });
            },
            clearSearchData() {
                this.searchData = {
                    keyword: '',
                    tag_id: null
                }
                this.search()
            }
        },
        mounted: function () {
            this.getList();
        }
    });
</script>
