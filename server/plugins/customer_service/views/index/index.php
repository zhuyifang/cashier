<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/4
 * Time: 5:27 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
Yii::$app->loadViewComponent('layout/app-contain');
Yii::$app->loadViewComponent('layout/app-search-input');
Yii::$app->loadViewComponent('layout/app-pagination');
?>
<div id="app" v-cloak>
    <app-contain edit-button-name="新增企业" head-name="企业列表" :edit-button="true"
                 @edit-click="editClick">
        <el-card shadow="never">
            <app-search-input placeholder="请输入企业id或者企业名称搜索" @search="searchFunc"></app-search-input>
            <el-table
                    ref="multipleTable"
                    :data="form.list"
                    border
                    style="width: 100%;margin-bottom: 15px"
                    v-loading="listLoading">
                <el-table-column prop="enterprise_id" label="企业id"></el-table-column>
                <el-table-column prop="name" label="企业名称"></el-table-column>
                <el-table-column label="操作" width="200" fixed="right">
                    <template slot-scope="scope">
                        <el-button class="set-el-button" size="mini" type="text" circle @click="editQy(scope.row)">
                            <el-tooltip class="item" effect="dark" content="编辑" placement="top">
                                <img src="statics/img/mall/edit.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button class="set-el-button" size="mini" type="text" circle @click="$navigate({r: 'plugin/customer_service/mall/index/customer', qy_id: scope.row.id})">
                            <el-tooltip class="item" effect="dark" content="客服详情" placement="top">
                                <img src="statics/img/mall/customer.png" alt="">
                            </el-tooltip>
                        </el-button>
                        <el-button class="set-el-button" size="mini" type="text" circle @click="destroy(scope.row)">
                            <el-tooltip class="item" effect="dark" content="删除" placement="top">
                                <img src="statics/img/mall/del.png" alt="">
                            </el-tooltip>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <app-pagination :pagination="pagination" @change="pageChange"></app-pagination>
            <el-dialog :title="edit.title" :visible.sync="edit.dialogVisible" width="30%"
                       :close-on-click-modal="false"
                       :close-on-press-escape="false">
                    <span>
                        <el-form :model="edit.form" size="small" label-width="100px" ref="form" :rules="edit.rules">
                            <el-form-item label="企业id" prop="enterprise_id">
                                <div>
                                    <el-input v-model="edit.form.enterprise_id" placeholder="请输入企业id"></el-input>
                                    <div style="color: #ff4544">注：在小程序中使用，则企业微信跟小程序主体必须一致</div>
                                </div>
                            </el-form-item>
                            <el-form-item label="企业名称" prop="name">
                                <div>
                                    <el-input v-model="edit.form.name" placeholder="请输入企业名称"></el-input>
                                </div>
                            </el-form-item>
                        </el-form>
                    </span>
                <span slot="footer" class="dialog-footer">
                        <el-button @click="edit.dialogVisible = false" size="mini">取 消</el-button>
                        <el-button type="primary" @click="add" size="mini" :loading="edit.editLoading">确 定</el-button>
                    </span>
            </el-dialog>
        </el-card>
    </app-contain>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                listLoading: false,
                form: {
                    list: []
                },
                search: {
                    keyword: '',
                },
                pagination: {},
                edit: {
                    dialogVisible: false,
                    title: '新增企业',
                    editLoading: false,
                    form: {
                        enterprise_id: '',
                        name: '',
                        id: '',
                    },
                    rules: {
                        enterprise_id: [
                            { required: true, message: '请输入企业id', trigger: 'blur' }
                        ],
                        name: [
                            { required: true, message: '请输入企业名称', trigger: 'blur' }
                        ],
                    }
                }
            }
        },
        created() {
            this.listLoading = true;
            this.getList(1);
        },
        methods: {
            editClick() {
                this.edit.form ={
                    enterprise_id: '',
                    name: '',
                    id: '',
                };
                this.edit.title = '新增企业';
                this.edit.dialogVisible = true;
            },
            searchFunc(keyword) {
                this.search.keyword = keyword
                this.getList(1)
            },
            getList(page = 1) {
                this.listLoading = true;
                this.$request({
                    params: {
                        r: 'plugin/customer_service/mall/index/index',
                        page: page,
                        search: this.search,
                    },
                }).then(e => {
                    this.listLoading = false;
                    if (e.data.code === 0) {
                        this.form = e.data.data;
                        this.pagination = e.data.data.pagination;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    this.listLoading = false;
                    console.log(e)
                });
            },
            pageChange(currentPage) {
                this.getList(currentPage);
            },
            add() {
                this.$refs.form.validate(valid => {
                    if (valid) {
                        this.edit.editLoading = true;
                        this.$request({
                            params: {
                                r: 'plugin/customer_service/mall/index/index',
                            },
                            data: this.edit.form,
                            method: 'post'
                        }).then(e => {
                            this.edit.editLoading = false;
                            if (e.data.code === 0) {
                                this.edit.dialogVisible = false;
                                this.$message.success(e.data.msg);
                                this.getList();
                            } else {
                                this.$message.error(e.data.msg);
                            }
                        }).catch(e => {
                            this.edit.editLoading = false;
                            this.edit.dialogVisible = false;
                        });
                    }
                })
            },
            editQy(row) {
                this.edit.form = JSON.parse(JSON.stringify(row));
                this.edit.title = '编辑';
                this.edit.dialogVisible = true;
            },
            destroy(row) {
                let self = this;
                let text = '删除该条数据, 是否继续?';
                self.$confirm(text, '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$request({
                        params: {
                            r: 'plugin/customer_service/mall/index/destroy',
                            id: row.id
                        },
                    }).then(e => {
                        if (e.data.code === 0) {
                            this.getList();
                        } else {
                            this.$message.error(e.data.msg);
                        }
                    }).catch(e => {
                        console.log(e)
                    });
                }).catch(() => {
                    self.$message.info('已取消删除')
                });
            }
        }
    });
</script>