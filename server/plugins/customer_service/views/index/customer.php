<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/7
 * Time: 2:52 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
Yii::$app->loadViewComponent('layout/app-contain');
Yii::$app->loadViewComponent('layout/app-search-input');
Yii::$app->loadViewComponent('layout/app-pagination');
?>
<div id="app" v-cloak>
    <app-contain edit-button-name="新增客服" head-name="客服列表" :edit-button="true"
                 @edit-click="editClick" :parent-name="qy_detail.parentName"
                 parent-url="plugin/customer_service/mall/index/index">
        <el-card shadow="never">
            <app-search-input :placeholder="`请输入` + (qy_id ? '' : '企业名称或者') + `客服名称搜索`" @search="searchFunc"></app-search-input>
            <div flex="dir:left cross:center" style="margin-bottom: 20px" v-if="qy_id">
                <el-button class="set-el-button" size="mini" type="text" circle>
                    <img src="statics/img/mall/id.png" alt="">
                </el-button>
                <div style="margin-right: 120px">企业id：{{qy_detail.enterprise_id}}</div>
                <el-button class="set-el-button" size="mini" type="text" circle>
                    <img src="statics/img/mall/qy.png" alt="">
                </el-button>
                <div>企业名称：{{qy_detail.name}}</div>
            </div>
            <el-table
                ref="multipleTable"
                :data="form.list"
                border
                style="width: 100%;margin-bottom: 15px"
                v-loading="listLoading">
                <el-table-column prop="qy_name" label="企业名称" width="200" v-if="!qy_id"></el-table-column>
                <el-table-column prop="name" label="客服名称"></el-table-column>
                <el-table-column prop="url" label="客服链接"></el-table-column>
                <el-table-column label="操作" width="200" fixed="right">
                    <template slot-scope="scope">
                        <el-button class="set-el-button" size="mini" type="text" circle @click="editQy(scope.row)">
                            <el-tooltip class="item" effect="dark" content="编辑" placement="top">
                                <img src="statics/img/mall/edit.png" alt="">
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
                            <el-form-item label="所属企业" prop="name" v-if="!qy_id">
                                <div>
                                    <el-select v-model="edit.form.qy_id" placeholder="请选择" style="width: 100%">
                                        <el-option
                                                v-for="item in edit.qy_list"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item.id">
                                        </el-option>
                                    </el-select>
                                </div>
                            </el-form-item>
                            <el-form-item label="客服名称" prop="name">
                                <div>
                                    <el-input v-model="edit.form.name" placeholder="请输入客服名称"></el-input>
                                </div>
                            </el-form-item>
                            <el-form-item label="客服链接" prop="url">
                                <div>
                                    <el-input v-model="edit.form.url" placeholder="请输入客服链接"></el-input>
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
                    title: '新增客服',
                    editLoading: false,
                    qy_list: [],
                    form: {
                        qy_id: '',
                        url: '',
                        name: '',
                        id: '',
                    },
                    rules: {
                        url: [
                            { required: true, message: '请输入客服链接', trigger: 'blur' }
                        ],
                        name: [
                            { required: true, message: '请输入企业名称', trigger: 'blur' }
                        ],
                        qy_id: [
                            { required: true, message: '请选择所属企业', trigger: 'blur' }
                        ],
                    }
                },
                qy_id: '',
                qy_detail: {
                    enterprise_id: '',
                    name: '',
                    parentName: '',
                },
            }
        },
        created() {
            this.listLoading = true;
            if (getQuery('qy_id')) {
                this.qy_id = getQuery('qy_id');
                this.qy_detail.parentName = '企业列表';
                this.getQyDetail(1);
            } else {
                this.getQy();
            }
            this.getList(1);
        },
        methods: {
            editClick() {
                this.edit.form = {
                    qy_id: this.qy_id,
                    url: '',
                    name: '',
                    id: '',
                }
                this.edit.title = '新增客服';
                this.edit.dialogVisible = true
            },
            searchFunc(keyword) {
                this.search.keyword = keyword
                this.getList(1)
            },
            getQy() {
                this.$request({
                    params: {
                        r: 'plugin/customer_service/mall/index/index',
                        is_all: 1
                    },
                }).then(e => {
                    if (e.data.code === 0) {
                        this.edit.qy_list = e.data.data.list;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    console.log(e)
                });
            },
            getList(page = 1) {
                this.listLoading = true;
                this.$request({
                    params: {
                        r: 'plugin/customer_service/mall/index/customer',
                        page: page,
                        search: this.search,
                        qy_id: this.qy_id,
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
                                r: 'plugin/customer_service/mall/index/customer',
                            },
                            data: this.edit.form,
                            method: 'post'
                        }).then(e => {
                            this.edit.editLoading = false;
                            if (e.data.code === 0) {
                                this.edit.dialogVisible = false;
                                this.$message.success(e.data.msg);
                                this.getList(1);
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
                this.edit.title = '编辑'
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
                            r: 'plugin/customer_service/mall/index/customer-destroy',
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
            },
            getQyDetail() {
                this.$request({
                    params: {
                        r: 'plugin/customer_service/mall/index/detail',
                        qy_id: this.qy_id,
                    },
                }).then(e => {
                    if (e.data.code === 0) {
                        this.qy_detail = e.data.data;
                        this.qy_detail.parentName = '企业列表';
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    console.log(e)
                });
            }
        }
    });
</script>
