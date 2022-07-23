<?php
Yii::$app->loadViewComponent("model-form-add", __DIR__);
?>
<style type="text/css">
    @import "<?= \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/statics/css/element/table.css' ?>";
</style>
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

</style>
<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <div slot="header">
            <span>自定义表单</span>
            <el-button @click="handleAdd" style="margin: -5px 0;float: right" type="primary"
                       size="small">新建
            </el-button>
        </div>
        <model-form-add v-model="formVisible" :show-share="showShare != -1" :form="formForm"
                        @submit="addJump"></model-form-add>
        <div class="table-body">
            <!--工具条 过滤表单和新增按钮-->
            <el-col :span="24" class="toolbar" style="padding-bottom: 0px">
                <div class="input-item" style="display:inline-block;margin-left: 12px">
                    <el-input @keyup.enter.native="searchList"
                              size="small"
                              placeholder="请输入表单名称或ID搜索"
                              v-model="search.keyword"
                              clearable
                              @clear="searchList">
                        <el-button slot="append" icon="el-icon-search" @click="searchList"></el-button>
                    </el-input>
                </div>
                <el-button style="margin-left: 20px" @click="searchList" type="primary" size="small">查询</el-button>
            </el-col>
            <!-- 列表 -->
            <el-table v-loading="listLoading" :data="list" border>
                <el-table-column prop="id" label="ID"></el-table-column>
                <el-table-column prop="name" label="表单名称"></el-table-column>
                <el-table-column prop="time" label="状态更新时间"></el-table-column>
                <el-table-column label="操作" width="280" fixed="right">
                    <template slot-scope="scope">
                        <el-button size="mini" type="text"
                                   @click="handlerEdit(scope.row)"
                                   circle>
                            <el-tooltip class="item" effect="dark" content="修改" placement="top">
                                <img src="statics/img/mall/list/edit.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button size="mini" type="text"
                                   @click="$navigate({r:'plugin/diy/mall/diy-form/edit',id: scope.row.id})"
                                   circle>
                            <el-tooltip class="item" effect="dark" content="编辑" placement="top">
                                <img src="statics/img/mall/list/edit-one.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button class="set-el-button" size="mini" type="text" circle
                                   @click="destroy(scope.row,scope.$index)">
                            <el-tooltip class="item" effect="dark" content="删除" placement="top">
                                <img src="statics/img/mall/list/del.png" alt="">
                            </el-tooltip>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>

        <!--工具条 批量操作和分页-->
        <el-col :span="24" class="toolbar" style="margin-bottom: 20px">
            <el-pagination
                    v-if="pagination"
                    style="float: right;margin-right: 24px"
                    background
                    :page-size="pagination.pageSize"
                    @current-change="pageChange"
                    layout="total,prev, pager, next, jumper" :current-page="pagination.current_page"
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
                showShare: -1,
                formForm: {
                    id: '',
                    name: '',
                    status: 0,
                    limit: 1,
                    tip: '',
                },
                formVisible: false,
                search: {
                    keyword: '',
                },
                storeList: [],
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
            addJump(data) {
                if (this.model_status === 'add') {
                    this.$navigate({
                        r: 'plugin/diy/mall/diy-form/edit',
                        id: data.id,
                    });
                } else {
                    this.getList();
                }
            },
            handleAdd() {
                this.formForm = {
                    id: '',
                    name: '',
                    status: 0,
                    limit: 1,
                    tip: '',
                };
                this.model_status = 'add';
                this.formVisible = true;
            },
            handlerEdit(e) {
                this.formForm = e;
                this.model_status = 'edit';
                this.formVisible = true;
            },
            getList() {
                this.listLoading = true;
                let params = Object.assign({}, {
                    r: 'plugin/diy/mall/diy-form/index',
                    page: this.page,
                }, this.search);
                request({
                    params,
                }).then(e => {
                    this.listLoading = false;
                    if (e.data.code === 0) {
                        this.showShare = e.data.data.is_share;
                        this.list = e.data.data.list;
                        this.pagination = e.data.data.pagination;
                    }
                });
            },
            sizeChange(size) {

                this.getList();
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
                            r: 'plugin/diy/mall/diy-form/destroy',
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
                            // setTimeout(() => {
                            //     location.reload();
                            // }, 1000);
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
