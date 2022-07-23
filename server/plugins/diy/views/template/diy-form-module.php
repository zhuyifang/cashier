<?php
require \Yii::$app->BasePath . '/views/components/diy-form/template/dothing/plugin.php';
?>
<style>
    .box {
        width: 320px;
        height: 64px;
        background: rgba(255, 255, 255, 1);
        border: 1px dashed rgba(221, 221, 221, 1);
        border-radius: 4px;
        line-height: 64px;
        padding: 0 20px;
        color: #000000;
        margin-right: 20px;
    }
    .diy-form-module .el-form-item--small .el-form-item__content {
        width: 100%;
    }
    .diy-form-module .el-radio__label {
        /*display: none;*/
    }
    .diy-form-module .pane-second .diy-component-edit {
        display: none !important;
    }

    .diy-form-module .pane-second .diy-component-preview {
        cursor: pointer;
        position: relative;
        zoom: 1;
        -moz-transform: scale(1);
        border-width: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
    }

    .diy-form-module .el-table__header-wrapper .has-gutter tr th:first-of-type .cell {
        display: none !important;
    }
    .diy-form-module .el-table .cell, .el-table th div {
        text-overflow: clip !important;
    }
</style>
<style>
    .app-edit .app-form-title {
        margin: 0 -20px;
        border-bottom: 1px solid #E5E7EC;
    }

    .app-edit .app-form-title div {
        font-size: 22px;
        font-weight: 600;
        color: #242424;
        padding: 0 10px;
        height: 24px;
        margin-left: 20px;
        line-height: 1;
        margin-top: 10px;
        margin-bottom: 30px;
        border-left: 7px solid #409eff;
    }
    .app-edit .app-form-box-label {
        font-size: 18px;
        color: #242424;
        margin-left: 25px;
        font-weight: 600;
        margin-bottom: 20px
    }

    .app-edit .f-c-box {
        padding: 30px 40px 10px 0;
        border-radius: 13px;
        background: #F3F3F3;
    }

    .app-edit ._diy-form-label {
        padding-left: 20px;
        font-size: 30px;
        white-space: nowrap;
        margin-bottom: 18px;
    }

    .app-edit ._diy-form-label.required:after {
        content: '*';
        color: #FF4544;
        margin-left: -6px;
    }

</style>
<template id="diy-form-module">
    <div class="diy-form-module">
        <div class="diy-component-preview">
            <div class="pane-second" v-if="data.form_id">
                <div v-for="(component, index) in data.list" :key="index">
                    <?php foreach ($other as $component) : ?>
                        <diy-<?= $component ?> v-if="component.id === '<?= $component ?>'"
                                               :active="component.active"
                                               v-model="component.data"
                        ></diy-<?= $component ?>>
                    <?php endforeach; ?>

                    <?php foreach ($components as $component) : ?>
                        <<?= $component ?> v-if="`f-${component.id}` === '<?= $component ?>'"
                        :active="component.active"
                        v-model="component.data"
                    :all-data="data.list"
                        ></<?= $component ?>>
                    <?php endforeach; ?>
                </div>
            </div>
            <div v-else>
                <div style="padding: 50px 0;text-align: center;background: #fff;">请选择自定义表单</div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>自定义表单</div>
            </div>
            <el-form label-width="120px" @submit.native.prevent style="padding: 20px 0">
                <el-form-item label="自定义表单">
                    <div v-if="data.form_id" flex="dir:left" style="margin-bottom: 12px">
                        <div class="box">
                            表单： {{data.name}}
                        </div>
                        <el-button type="text" @click="openModel">修改</el-button>
                    </div>
                    <el-button v-else class="add-btn" type="primary" @click="openModel" size="small" plain>+添加一个表单
                    </el-button>
                </el-form-item>
            </el-form>
            <el-dialog title="自定义表单" :visible.sync="dialogVisible">
                <!--工具条 表单搜索-->
                <el-form size="small" :inline="true" :model="search" @submit.native.prevent>
                    <el-form-item style="margin-bottom: 20px;width: 100%">
                        <el-input @keyup.enter.native="searchModule" placeholder="根据名称搜索" style="width: 100%"
                                  v-model="search.keyword">
                            <template slot="append">
                                <el-button @click="searchModule" :loading="listLoading">搜索</el-button>
                            </template>
                        </el-input>
                    </el-form-item>
                </el-form>

                <!--列表-->
                <el-table :data="formList" style="width: 100%" v-loading="listLoading">
                    <el-table-column type="index" :index="0" width="50">
                        <template slot-scope="scope">
                            <app-radio turn v-model="editForm.selectIndex" :label="scope.row.id"></app-radio>
                        </template>
                    </el-table-column>
                    <el-table-column prop="name" label="标题"></el-table-column>
                    <el-table-column prop="time" label="创建时间" width="250"></el-table-column>
                </el-table>

                <!--工具条 批量操作和分页-->
                <el-col :span="24" class="toolbar">
                    <el-pagination
                            background
                            layout="prev, pager, next, jumper"
                            @current-change="pageChange"
                            :page-size="pagination.pageSize"
                            :total="pagination.total_count"
                            style="text-align: center;margin:15px 0"
                            v-if="pagination">
                    </el-pagination>
                </el-col>
                <div slot="footer">
                    <el-button size="small" @click="submit" type="primary">确定</el-button>
                </div>
            </el-dialog>
        </div>
    </div>
</template>
<script>
    Vue.component('diy-form-module', {
        template: '#diy-form-module',
        props: {
            value: Object,
        },
        data() {
            return {
                data: {
                    form_id: '',
                    name: '',
                    list: null,
                },

                search: {keyword: ''},
                dialogVisible: false,
                formList: [],
                pagination: null,
                listLoading: false,
                editForm: {
                    editIndex: -1,
                    selectIndex: 0,
                },
            };
        },
        created() {
            if (this.value) {
                this.data = JSON.parse(JSON.stringify(this.value));
            } else {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            }
        },
        computed: {},
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            }
        },
        methods: {
            openModel() {
                this.editForm.editIndex = -1;
                if (!this.formList || this.formList.length === 0) {
                    this.getList();
                }
                this.dialogVisible = true;
            },
            submit() {
                const list = this.formList;
                const index = this.editForm.selectIndex;
                let sentinel;
                list.forEach(module => {
                    if (module.id === index)
                        sentinel = module;
                });
                if (!sentinel) {
                    this.$message.error('请选择表单');
                    return;
                }
                Object.assign(this.data, {
                    form_id: sentinel.id,
                    name: sentinel.name,
                    list:  sentinel.data,
                })
                this.dialogVisible = false;
            },
            searchModule() {
                this.page = 1;
                this.getList();
            },
            pageChange(page) {
                this.page = page;
                this.getList();
            },
            getList() {
                let params = Object.assign({
                    r: 'plugin/diy/mall/diy-form/index',
                    page: this.page
                }, this.search);
                this.listLoading = true;
                this.$request({
                    params,
                }).then(info => {
                    this.listLoading = false;
                    if (info.data.code === 0) {
                        this.formList = info.data.data.list;
                        this.pagination = info.data.data.pagination;
                    }
                }).catch(e => {
                    this.listLoading = false;
                });
            },
        }
    });
</script>
