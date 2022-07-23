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
        width: 200px;
        margin: 0 0 20px 0;
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
                <div flex="cross:center" flex-box="1">标签管理</div>
                <div flex-box="0">
                    <el-button size="small" type="primary" @click="tagEdit({})">新增</el-button>
                </div>
            </div>
        </div>
        <div class="table-body">
            <div class="input-item">
                <el-input @keyup.enter.native="search" size="small" placeholder="请输入名称搜索" v-model="searchData.keyword" clearable @clear="search">
                    <el-button slot="append" icon="el-icon-search" @click="search"></el-button>
                </el-input>
            </div>
            <el-table :data="list" border style="width: 100%">
                <el-table-column prop="sort" label="排序" width="150">
                    <template slot-scope="scope">
                        <div v-if="sort_tag_id != scope.row.id" flex="dir:left cross:center">
                            <span>{{scope.row.sort}}</span>
                            <el-button class="edit-sort" type="text" @click="editSort(scope.row)">
                                <img src="statics/img/mall/order/edit.png" alt="">
                            </el-button>
                        </div>
                        <div style="display: flex;align-items: center" v-else>
                            <el-input style="min-width: 70px" type="number" size="mini" class="change"
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
                <el-table-column prop="name" label="标签名"></el-table-column>
                <el-table-column prop="name" label="颜色" width="300">
                    <template slot-scope="scope">
                        <div flex="dir:left">
                            <el-color-picker @change="changeColor(scope.row)" size="small" v-model="scope.row.extra_attributes.color"></el-color-picker>
                            <el-input @keyup.enter.native="changeColor(scope.row)" size="small" style="margin-left: 10px;" v-model="scope.row.extra_attributes.color" autocomplete="off">
                            </el-input>
                        </div>
                    </template>
                </el-table-column>
                <el-table-column prop="name" label="是否显示" width="180">
                    <template slot-scope="scope">
                        <el-switch
                            @change="changeStatus(scope.row)"
                            :active-value="1" 
                            :inactive-value="0"
                            v-model="scope.row.status">
                        </el-switch>
                    </template>
                </el-table-column>
                <el-table-column width="220" label="操作">
                    <template slot-scope="scope">
                        <el-button class="set-el-button" type="text" size="mini" circle @click="tagEdit(scope.row)">
                            <el-tooltip class="item" effect="dark" content="编辑" placement="top">
                                <img src="statics/img/mall/edit.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button size="mini" type="text" circle>
                            <a @click="deleteTag(scope.row)">
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

    <el-dialog :title="tagDialog.title" :visible.sync="tagDialog.visible">
        <el-form 
            :model="tagDialog.form" 
            :rules="tagDialog.rules"
            ref="tagDialogForm" 
            label-width="165px" 
            size="small"
            @submit.native.prevent
        >
            <el-form-item label="标签名" prop="name">
                <el-input v-model="tagDialog.form.name" autocomplete="off" maxlength="5" show-word-limit></el-input>
            </el-form-item>
            <el-form-item label="是否显示" prop="status">
                <el-switch v-model="tagDialog.form.status" :active-value="1" :inactive-value="0"></el-switch>
            </el-form-item>
            <el-form-item label="排序" prop="sort">
                <el-input type="number" v-model="tagDialog.form.sort" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="标签基础色" prop="extra_attributes.color">
                <div flex="dir:left">
                    <el-color-picker v-model="tagDialog.form.extra_attributes.color"></el-color-picker>
                    <el-input style="margin-left: 10px;" v-model="tagDialog.form.extra_attributes.color" autocomplete="off"></el-input>
                </div>
            </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
            <el-button size="small" @click="tagDialog.visible = false">取 消</el-button>
            <el-button size="small" :loading="tagDialog.btnLoading" type="primary" @click="dialogSubmit('tagDialogForm')">提 交
            </el-button>
        </div>
    </el-dialog>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                searchData: {
                    keyword: '',
                },
                list: [],
                pageCount: 0,
                listLoading: false,
                tagDialog: {
                    visible: false,
                    title: '',
                    btnLoading: false,
                    rules: {
                        name: [
                            {required: true, message: '请填写标签名', trigger: 'change'},
                        ],
                        status: [
                            {required: true, message: '请添加状态', trigger: 'change'},
                        ],
                        sort: [
                            {required: true, message: '请填写排序', trigger: 'change'},
                        ],
                        'extra_attributes.color': [
                            {required: true, message: '请选择标签基础色', trigger: 'change'},
                        ],
                    },
                    form: {
                        id: null,
                        name: '',
                        status: 1,
                        sort: 100,
                        extra_attributes: {
                            color: '#FF4544'
                        }
                    }
                },

                sort_tag_id: '',
                sort: ''
            };
        },
        methods: {
            tagEdit(row) {
                if (row.id) {
                    this.tagDialog.title = '编辑标签'
                    let newRow = JSON.parse(JSON.stringify(row));
                    this.tagDialog.form = newRow
                }else {
                    this.tagDialog.title = '新增标签'
                    this.resetForm()
                }
                this.tagDialog.visible = true;
            },
            resetForm() {
                this.tagDialog.form = {
                    id: null,
                    name: '',
                    status: 1,
                    sort: 100,
                    extra_attributes: {
                        color: '#FF4544'
                    }
                }
            },
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
                        r: 'mall/mch/tag',
                        page: this.page,
                        search: JSON.stringify(this.searchData),
                    },
                }).then(e => {
                    this.listLoading = false;
                    if (e.data.code === 0) {
                        this.list = e.data.data.list;
                        this.pageCount = e.data.data.pagination.page_count;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    this.listLoading = false;
                });
            },
            dialogSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    let self = this;
                    if (valid) {
                        self.tagDialog.btnLoading = true;
                        request({
                            params: {
                                r: 'mall/mch/tag'
                            },
                            method: 'post',
                            data: self.tagDialog.form
                        }).then(e => {
                            self.tagDialog.btnLoading = false;
                            if (e.data.code == 0) {
                                self.$message.success(e.data.msg);
                                self.tagDialog.visible = false;
                                self.getList();
                            } else {
                                self.$message.error(e.data.msg);
                            }
                        }).catch(e => {
                            self.$message.error(e.data.msg);
                            self.tagDialog.btnLoading = false;
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            editSort(row) {
                this.sort_tag_id = row.id;
                this.sort = row.sort;
            },
            quit() {
                this.sort_tag_id = null;
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
                        r: 'mall/mch/tag'
                    },
                    method: 'post',
                    data: row
                }).then(e => {
                    self.btnLoading = false;
                    if (e.data.code === 0) {
                        self.$message.success(e.data.msg);
                        this.sort_tag_id = null;
                        self.getList();
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    self.listLoading = false;
                    self.$message.error(e.data.msg);
                    self.btnLoading = false;
                });
            },
            changeStatus(row) {
                let self = this;
                self.listLoading = true;
                request({
                    params: {
                        r: 'mall/mch/tag'
                    },
                    method: 'post',
                    data: row
                }).then(e => {
                    self.listLoading = false;
                    if (e.data.code === 0) {
                        self.getList();
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    self.listLoading = false;
                    self.$message.error(e.data.msg);
                });
            },
            deleteTag(row) {
                let self = this;
                self.$confirm('删除该标签, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    self.listLoading = true;
                    request({
                        params: {
                            r: 'mall/mch/delete-tag'
                        },
                        method: 'post',
                        data: {
                            id: row.id
                        }
                    }).then(e => {
                        self.listLoading = false;
                        if (e.data.code === 0) {
                            self.$message.success(e.data.msg);
                            self.search();
                        } else {
                            self.$message.error(e.data.msg);
                        }
                    }).catch(e => {
                        self.listLoading = false;
                        self.$message.error(e.data.msg);
                    });
                }).catch(() => {
                    self.$message.info('已取消删除')
                });
            },
            changeColor(row) {
                let self = this;
                self.listLoading = true;
                request({
                    params: {
                        r: 'mall/mch/tag'
                    },
                    method: 'post',
                    data: row
                }).then(e => {
                    self.listLoading = false;
                    if (e.data.code === 0) {
                        self.getList();
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    self.listLoading = false;
                    self.$message.error(e.data.msg);
                });
            }
        },
        mounted: function () {
            this.getList();
        }
    });
</script>
