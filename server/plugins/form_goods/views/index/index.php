<?php
Yii::$app->loadViewComponent('diy-form/form-goods/model-calc');
Yii::$app->loadViewComponent("app-market", __DIR__);
?>
<style>
    .input-item {
        width: 250px;
        margin: 0 0 20px;
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
        padding: 0;
    }

    .input-item .el-input-group__append .el-button {
        margin: 0;
    }

    .table-body {
        padding: 20px;
        background-color: #fff;
    }

    .col-li {
        display: inline-block;
        margin-right: 8px;
        margin-bottom: 12px;
    }

    .y-left-input .el-select .el-input {
        width: 130px;
    }

    .y-left-input .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }
</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <div slot="header">
            <span>定制模板</span>
            <app-market list-url="plugin/form_goods/mall/index/default-template"
                        edit-url="plugin/form_goods/mall/index/edit" type="page">
                <el-button style="margin: -5px 0;float: right;margin-top: -24px;" type="primary" size="small">新建
                </el-button>
            </app-market>
        </div>
        <div class="table-body">
            <!--工具条 过滤表单和新增按钮-->
            <el-col :span="24" class="toolbar" style="padding-bottom: 0px">
                <div class="input-item" style="display:inline-block">
                    <el-input @keyup.enter.native="searchList"
                              size="small"
                              placeholder="输入模板名称或ID搜索"
                              v-model="search.keyword"
                              clearable
                              @clear="searchList">
                        <el-button slot="append" icon="el-icon-search" @click="searchList"></el-button>
                    </el-input>
                </div>
                <el-button style="margin-left: 40px" type="primary" size="small" @click="searchList">查询</el-button>
            </el-col>
            <!-- 列表 -->
            <el-table v-loading="listLoading" :data="list" border>
                <el-table-column prop="id" label="ID"></el-table-column>
                <el-table-column prop="name" label="模板名称"></el-table-column>
                <el-table-column prop="updated_at" label="状态更新时间"></el-table-column>
                <el-table-column label="操作" fixed="right">
                    <template slot-scope="scope">
                        <el-button size="mini" type="text"
                                   @click="openIfModel(scope.row)"
                                   circle>
                            <el-tooltip class="item" effect="dark" content="逻辑设置" placement="top">
                                <img src="statics/img/mall/list/icon-b.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button size="mini" type="text"
                                   @click="$navigate({r:'plugin/form_goods/mall/index/edit',id: scope.row.id})"
                                   circle>
                            <el-tooltip class="item" effect="dark" content="编辑" placement="top">
                                <img src="statics/img/mall/list/icon-d.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button class="set-el-button" size="mini" type="text" circle
                                   @click="destroy(scope.row,scope.$index)">
                            <el-tooltip class="item" effect="dark" content="删除" placement="top">
                                <img src="statics/img/mall/list/icon-c.png" alt="">
                            </el-tooltip>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <model-calc :show.sync="logicDataShow" :edit-id="logicDataForm.id"
                        :form-data="logicDataForm.form_data"
                        :logic-data="logicDataForm.logic_data"></model-calc>
        </div>

        <!--工具条 批量操作和分页-->
        <el-col :span="24" class="toolbar">
            <el-pagination
                    v-if="pagination"
                    style="float: right;margin-right: 24px;margin-bottom:20px"
                    background
                    :page-size="pagination.pageSize"
                    @current-change="pageChange"
                    layout="total,prev, pager, next, jumper"
                    :current-page="pagination.current_page"
                    :total="pagination.totalCount">
            </el-pagination>
        </el-col>
    </el-card>
</div>

<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                logicDataForm: {
                    id: '',
                    form_data: [],
                    logic_data: [],
                },
                logicDataShow: false,
                search: {
                    keyword: '',
                },
                btnLoading: false,
                listLoading: false,
                list: [],
                pagination: null,
                page: 1,
            };
        },
        mounted() {
            this.getList();
        },
        methods: {
            openIfModel({id}) {
                this.$request({
                    params: {
                        id: id,
                        r: 'plugin/form_goods/mall/index/template-detail',
                    },
                    method: 'get',
                }).then(e => {
                    if (e.data.code === 0) {
                        const {form_data, logic_data, name} = e.data.data.template;
                        this.logicDataForm = {id, logic_data, form_data}
                        this.logicDataShow = true;
                    }
                });
            },
            ////////////////////////////////////////////////////////////
            getList() {
                this.listLoading = true;
                let params = Object.assign({}, {
                    r: 'plugin/form_goods/mall/index/index',
                    page: this.page,
                }, this.search);
                request({
                    params,
                }).then(e => {
                    this.listLoading = false;
                    if (e.data.code === 0) {
                        this.list = e.data.data.list;
                        this.pagination = e.data.data.pagination;
                    }
                });
            },
            pageChange(page) {
                this.page = page;
                this.getList()
            },
            searchList() {
                this.page = 1;
                this.getList();
            },
            destroy(params, index) {
                this.$confirm('是否删除该记录', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.listLoading = true;
                    request({
                        params: {
                            r: 'plugin/form_goods/mall/index/destroy',
                        },
                        data: {
                            id: params.id,
                        },
                        method: 'POST',
                    }).then(e => {
                        this.listLoading = false;
                        if (e.data.code === 0) {
                            this.$message.success(e.data.msg);
                            this.list.splice(index, 1);
                        } else {
                            this.$message.error(e.data.msg);
                        }
                    }).catch(e => {
                        this.listLoading = false;
                    });
                }).catch(() => {
                    this.$message({type: 'info', message: '已取消删除'});
                });
            },
        }
    });
</script>
