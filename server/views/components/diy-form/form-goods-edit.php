<?php
require \Yii::$app->BasePath . '/views/components/diy-form/form-goods/dothing/plugin.php';
Yii::$app->loadViewComponent('diy-form/form-goods/model-calc');

$_currentPluginBaseUrl = Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/statics/img/mall/form/';
?>

<script>
    const _currentPluginBaseUrl = '<?=$_currentPluginBaseUrl?>';
    const _appImg = _currentPluginBaseUrl;

</script>
<script src="<?= Yii::$app->request->baseUrl ?>/../views/components/diy-form/diy-edit.js"></script>
<style>
    body {
        --form-edit: inherit
    }

    .all-components {
        background: #fff;
        padding: 20px;
    }

    .all-components .component-group {
        border: 1px solid #eeeeee;
        width: 300px;
        color: #303133;
        margin-bottom: 20px;
    }

    .all-components .component-group:last-child {
        margin-bottom: 0;
    }

    .all-components .component-group-name {
        height: 35px;
        line-height: 35px;
        background: #f7f7f7;
        padding: 0 20px;
        border-bottom: 1px solid #eeeeee;
    }

    .all-components .component-list {
        margin-right: -2px;
        margin-top: -2px;
        flex-wrap: wrap;
    }

    .all-components .component-list .component-item {
        width: 100px;
        height: 100px;
        border: 0 solid #eeeeee;
        border-width: 0 1px 1px 0;
        text-align: center;
        padding: 15px 0 0;
        cursor: pointer;
        position: relative;
    }

    .all-components .component-list .component-item.active:before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        width: 98px;
        height: 98px;
        border: 1px solid var(--form-edit);
        left: 0;
    }

    .all-components .component-list .component-icon {
        width: 40px;
        height: 40px;
        /*border: 1px solid #eee;*/
    }

    .all-components .component-list .component-name {

    }

    .mobile-framework {
        width: 375px;
        height: 100%;
    }

    .mobile-framework-header {
        position: relative;
        height: 60px;
        /*line-height: 60px;*/
        background: #333;
        color: #fff;
        text-align: center;
        font-size: 15px;
        padding-top: 20px;
        cursor: pointer;
        background: url('statics/img/mall/head-diy.png') no-repeat;
    }

    .mobile-framework-header .search div {
        position: absolute;
        top: 7px;
        line-height: 1;
        left: 12px;
        font-size: 11px;
        max-width: 110px;
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
    }

    .mobile-framework-body {
        min-height: 645px;
        border: 1px solid #e2e2e2;
        /* background: #f5f7f9; */
    }

    .mobile-framework .diy-component-preview {
        del-cursor: pointer;
        position: relative;
        zoom: 0.5;
        -moz-transform: scale(0.5);
        -moz-transform-origin: top left;
        font-size: 28px;
    }

    @-moz-document url-prefix() {
        .mobile-framework .diy-component-preview {
            cursor: pointer;
            position: relative;
            -moz-transform: scale(0.5);
            -moz-transform-origin: top left;
            font-size: 28px;
            width: 200% !important;
            height: 100%;
            margin-bottom: auto;
        }
        .mobile-framework .active .diy-component-preview {
            border: 2px dashed #409EFF;
            left: -2px;
            right: -2px;
            width: calc(200% + 4px) !important;
        }
    }

    .mobile-framework .diy-component-preview:hover {
        box-shadow: inset 0 0 10000px rgba(0, 0, 0, .03);
    }

    .mobile-framework .diy-component-edit {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 500px;
        right: 0;
        background: #fff;
        padding: 20px;
        display: none;
        cursor: default;
        overflow: auto;
    }

    .diy-component-options {
        position: relative;
    }

    .diy-component-options .el-button {
        height: 25px;
        line-height: 25px;
        width: 25px;
        padding: 0;
        text-align: center;
        border: none;
        border-radius: 0;
        position: absolute;
        margin-left: 0;
    }

    .mobile-framework .active .diy-component-preview {
        border: 2px dashed #409EFF;
        left: -2px;
        right: -2px;
        width: calc(100% + 4px);
    }

    .mobile-framework .active .diy-component-edit {
        display: block;
        del-padding-right: 20%;
        min-width: calc(650px - 20%);
    }

    .all-components {
        max-height: 725px;
        overflow-y: auto;
    }

    .bottom-menu {
        text-align: center;
        height: 54px;
        width: 100%;
    }

    .bottom-menu .el-card__body {
        padding-top: 10px;
    }

    .el-dialog {
        min-width: 800px;
    }

    #ggg div, span {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Chrome/Safari/Opera */
        -khtml-user-select: none; /* Konqueror */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently */
    }
</style>
<style>
    .app-nav-bar {
        cursor: pointer;
    }

    .app-nav-bar .nav-input {
        width: 400px;
    }

    .app-nav-bar .reset {
        position: absolute;
        top: 7px;
        left: 90px;
    }

    .del-app-edit .diy-component-edit .el-switch .el-switch__core {
        background-color: #9BA1A9;
        border-color: #9BA1A9;
    }

    .del-app-edit .diy-component-edit .el-switch.is-checked .el-switch__core {
        border-color: #205E9E;
        background-color: #205E9E;
    }

    .del-app-edit .diy-component-edit .el-switch .el-switch__core {
        height: 13px;
        width: 37px;
    }

    .del-app-edit .diy-component-edit .el-switch .el-switch__core:after {
        top: -3.5px;
        left: -1px;
        width: 19px;
        height: 19px;
        background-color: #E5E7EC;
    }

    .del-app-edit .diy-component-edit .el-switch.is-checked .el-switch__core::after {
        left: 100%;
    }

    .del-app-edit .diy-component-edit .el-switch.is-checked .el-switch__core::after {
        background-color: #409EFF;
    }

    .app-edit .diy-component-edit .el-slider__button {
        background-color: #409EFF;
    }

    .app-edit .diy-component-edit .el-color-picker {
        height: 30px;
    }

    .app-edit .diy-component-edit .el-color-picker .el-color-picker__trigger {
        width: 55px;
        height: 30px;
        border-radius: 3px;
        border: 1px solid #E5E7EC;
        padding: 6px 7px 5px;
    }

    .app-edit .diy-component-edit .el-color-picker .el-color-picker__color {
        width: 17px;
        height: 17px;
        border: 1px solid #E5E7EC;
        border-radius: 3px;
    }

    .app-edit .diy-component-edit .el-color-picker .el-color-picker__color .el-color-picker__color-inner {
        border-radius: 3px;
    }

    .app-edit .diy-component-edit .el-color-picker .el-color-picker__icon:before {
        content: "\e790";
    }

    .app-edit .diy-component-edit .el-color-picker .el-color-picker__icon {
        left: 70%;
        font-size: 22px;
        color: #888F9A;
    }

    .app-edit .diy-component-edit .el-color-picker + .el-input .el-input__inner {
        padding: 0 5px 0 7px;
        height: 30px;
        line-height: 30px;
        font-size: 12px;
    }

    .del-app-edit .diy-component-edit .el-checkbox__input.is-checked .el-checkbox__inner {
        background-color: #FFF;
    }

    .del-app-edit .diy-component-edit .el-checkbox__input.is-checked .el-checkbox__inner::after {
        border-color: #409EFF;
    }

    .del-app-edit .diy-component-edit .el-checkbox__input.is-checked + .el-checkbox__label {
        color: #606266;
    }

    .app-edit .diy-component-edit .el-color-picker--small .el-color-picker__empty.el-icon-close:before {
        color: #ff4544;
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
        padding: 20px 40px 10px 0;
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

    ._form-end .el-form-item__label {
        padding-right: 5px !important;
        width: 90px !important;
    }

    ._form-end .el-form-item__content {
        margin-left: 110px !important;
    }
</style>
<style>
    .all-components .input-item {
        width: auto;
        margin: 0;
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

    .newclass .el-form-item__content {
        width: 100%;
        margin-left: 0 !important;
    }

    .newclass .el-table__header-wrapper .el-table_1_column_1 .cell {
        display: none;
    }
    .newclass .app-radio > span:last-child {
        display: none !important;
    }
    .form-mmm > div{
        min-width: 616px !important;
    }

</style>
<?php
$mchId = Yii::$app->user->identity->mch_id;
?>
<template id="form-goods-edit">
    <div class="app-edit _form-end">
        <slot name="head">
            <el-card shadow="never" style="margin-bottom: 10px">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>
                        <span style="color: #409EFF;cursor: pointer"
                              @click="$navigate({r:'plugin/form_goods/mall/index/index'})">
                            定制模板
                        </span>
                    </el-breadcrumb-item>
                    <el-breadcrumb-item v-if="id > 0">编辑</el-breadcrumb-item>
                    <el-breadcrumb-item v-else>新增</el-breadcrumb-item>
                </el-breadcrumb>
            </el-card>
        </slot>

        <el-dialog title="选择定制模板" :visible.sync="dialogVisible" class="newclass">
            <!--工具条 表单搜索-->
            <el-form size="small" :inline="true" :model="search" @submit.native.prevent>
                <el-form-item style="margin-bottom: 20px;width: 100%">
                    <el-input @keyup.enter.native="searchModule" placeholder="根据名称/ID搜索" style="width: 100%"
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
                        <app-radio turn v-model="formSelectId" :label="scope.row.id"></app-radio>
                    </template>
                </el-table-column>
                <el-table-column prop="id" label="ID" width="80"></el-table-column>
                <el-table-column prop="name" label="标题"></el-table-column>
                <el-table-column prop="created_at" label="创建时间" width="250"></el-table-column>
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
                <el-button size="small" :loading="modelLoading" @click="submit" type="primary">确定</el-button>
            </div>
        </el-dialog>

        <div v-loading="loading">
            <div flex="box:first" style="margin-bottom: 10px;min-width: 1280px;height: 725px;">
                <div class="all-components">
                    <el-form @submit.native.prevent label-width="95px" ref="templateName">
                        <el-form-item :rules="[{ required: true, validator: validate, trigger: 'change'}]"
                                      label="模板名称"
                                      prop="templateName">
                            <el-input style="width: 190px" size="small" placeholder="请输入名称" show-word-limit
                                      v-model="templateName" maxlength="15"></el-input>
                        </el-form-item>
                        <slot name="goods">
                            <el-form-item label="选择模板">
                                <el-button size="small" @click="openModel">选择</el-button>
                            </el-form-item>
                            <el-form-item label="逻辑设置">
                                <model-calc :show.sync="logicDataShow" :edit-id="logicDataForm.id"
                                            :form-data="components"
                                            @submit="formSubmit"
                                            type="goods"
                                            :logic-data="logicData"
                                ></model-calc>
                                <el-button size="small" @click="openIfModel">设置</el-button>
                            </el-form-item>
                            <el-form-item label="定制文字">
                                <el-input style="width: 190px" size="small" placeholder="请输入名称" show-word-limit
                                          v-model="tempBtnName" maxlength="5"></el-input>
                                <div>
                                    <el-link type="primary" :underline="false" @click="formModel = true">查看图例</el-link>
                                </div>
                            </el-form-item>
                        </slot>
                    </el-form>
                    <div class="component-group" v-for="(group,indexcolor) in allComponents">
                        <div class="component-group-name">{{group.groupName}}</div>
                        <div class="component-list" flex="">
                            <template v-for="item in group.list">
                                <div class="component-item"
                                     :class="{'active': activeId === item.id}"
                                     :style="{'--form-edit': formatColor(indexcolor)}"
                                     @click="selectComponent(item)">
                                    <img class="component-icon" :src="item.icon">
                                    <div class="component-name">{{item.name}}</div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div style="padding-left: 2px;position: relative;overflow-y: auto">
                    <div id="ggg" style="overflow-y: auto;padding: 0 60px;height: 705px;">
                        <div class="mobile-framework" style="height: 705px;">
                            <div class="mobile-framework-header"
                                 flex="dir:left main:center"
                                 style="color: #242424;background-color: #FFFFFF">
                                <div flex="cross:center">
                                    <div style="font-size: 15px;font-weight: bold">
                                        {{templateName}}
                                    </div>
                                </div>
                            </div>
                            <div id="mobile-framework-body" class="mobile-framework-body">
                                <draggable v-model="components" :options="{filter:'.active',preventOnFilter:false}"
                                           v-if="components && components.length" id="child">
                                    <div v-for="(component, index) in components" :key="component.key"
                                         :style="{cursor: component.active ? 'pointer': 'move'}">
                                        <div @click="showComponentEdit(component,index)"
                                             :class="(component.active?'active':'')">
                                            <div class="diy-component-options" v-if="component.active">
                                                <el-button type="primary"
                                                           icon="el-icon-delete"
                                                           @click.stop="deleteComponent(index)"
                                                           style="left: -25px;top:0;"></el-button>
                                                <el-button type="primary"
                                                           icon="el-icon-plus"
                                                           @click.stop="copyComponent(index)"
                                                           style="left: -25px;top:30px;"></el-button>
                                                <el-button v-if="index > 0 && components.length > 1"
                                                           type="primary"
                                                           icon="el-icon-arrow-up"
                                                           @click.stop="moveUpComponent(index)"
                                                           style="right: -25px;top:0;"></el-button>
                                                <el-button v-if="components.length > 1 && index < components.length-1"
                                                           type="primary"
                                                           icon="el-icon-arrow-down"
                                                           @click.stop="moveDownComponent(index)"
                                                           style="right: -25px;top:30px;"></el-button>
                                            </div>
                                            <?php foreach ($other as $component) : ?>
                                                <diy-<?= $component ?> v-if="component.id === '<?= $component ?>'"
                                                                       :active="component.active"
                                                                       v-model="component.data"
                                                ></diy-<?= $component ?>>
                                            <?php endforeach; ?>



                                            <?php foreach ($components

                                            as $component) : ?>
                                            <<?= $component ?> v-if="`f-${component.id}` === '<?= $component ?>'"
                                            :active="component.active"
                                            :is-form-goods="true"
                                            :all-data="components"

                                            v-model="component.data"
                                            >
                                        </<?= $component ?>>
                                        <?php endforeach; ?>
                                    </div>
                            </div>
                            </draggable>
                            <div v-else flex="main:center cross:center"
                                 style="height: 200px;color: #adb1b8;text-align: center;">
                                <div>
                                    <i class="el-icon-folder-opened"
                                       style="font-size: 32px;margin-bottom: 10px"></i>
                                    <div>空空如也</div>
                                    <div>请从左侧组件库添加组件</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 自定义 -->
        <el-dialog title="定制文字图例"
                   :visible.sync="formModel" width="30%" class="form-mmm">
            <div flex="dir:left main:center" class="app-share" style="padding-top: 40px">
                <div class="app-share-bg"
                     style="height: 316px;width:576px"
                     :style="{'background-image': 'url(statics/img/mall/form-goods/2553.png)'}"></div>
            </div>
            <div slot="footer" class="dialog-footer">
                <el-button @click="formModel = false" type="primary">我知道了</el-button>
            </div>
        </el-dialog>
    </div>
    <slot name="end">
        <el-card class="bottom-menu" shadow="never">
            <div>
                <el-button size="small" @click="onSubmit" type="primary" :loading="submitLoading">保存</el-button>
                <el-button size="small" @click="formVisible = true" type="primary" :loading="submitLoading">另存为
                </el-button>
            </div>
        </el-card>
    </slot>
</template>
<script>
    Vue.component('form-goods-edit', {
        template: '#form-goods-edit',
        data() {
            return {
                formModel: false,
                mch_id: "<?= $mchId ?>",
                formList: [],
                dialogVisible: false,
                formSelectId: '',
                page: 1,
                pagination: null,
                listLoading: false,
                search: {keyword: ''},
                ////////////

                logicDataShow: false,
                logicDataForm: {
                    id: '',
                    form_data: [],
                    logic_data: [],
                },
                logicData: [],

                /////////
                formVisible: false,
                formForm: [],
                tempBtnName: '定制详情',
                templateName: '',
                validate: (rule, value, callback) => {
                    if (this.templateName) {
                        callback();
                    } else {
                        callback(new Error('模板名称不能为空'))
                    }
                },
                id: null,
                maxLimit: 20,
                showShare: -1,
                submitLoading: false,

                modelLoading: false,
            }
        },
        props: {
            value: {
                type: [Object, Array],
                default() {
                    return null;
                    return {
                        name: '',
                        form_data: '',
                        logic_data: {
                            rule_begin: [],
                            rule_after: [],
                        }
                    }
                }
            }
        },

        created() {
            this.id = getQuery('id');
            this.loadData();
        },
        mixins: [diyEdit],
        watch: {
            components: {
                deep: true,
                handler(newVal, oldVal) {
                },
            }
        },
        methods: {
            updateValue() {
                return {
                    name: this.templateName,
                    btn_name: this.tempBtnName,
                    form_data: this.components,
                    logic_data: this.logicData,
                }
            },
            formSubmit(e) {
                this.logicData = e;
            },
            openModel() {
                if (!this.formList || this.formList.length === 0) {
                    this.getList();
                }
                this.dialogVisible = true;
            },
            submit() {
                const list = this.formList;

                let sentinel;
                list.forEach(module => {
                    if (module.id === this.formSelectId)
                        sentinel = module;
                });
                if (!sentinel) {
                    this.$message.error('请选择表单');
                    return;
                }
                this.modelLoading = true;
                this.$request({
                    params: {
                        id: sentinel.id,
                        r: 'plugin/form_goods/mall/index/template-detail',
                    },
                    method: 'get',
                }).then(e => {
                    if (e.data.code === 0) {
                        const {form_data, logic_data, name,btn_name} = e.data.data.template;

                        this.templateName = name || '';
                        let components = form_data || [];
                        for (let i in components) {
                            components[i].active = false;
                            components[i].key = randomString();
                        }
                        this.components = components;
                        this.logicData = logic_data;
                        Object.assign(this.logicDataForm, {
                            form_data,
                            logic_data,
                        })
                        this.dialogVisible = false;
                        this.modelLoading = false;
                    }
                });
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
                    r: 'plugin/form_goods/mall/index/index',
                    page: this.page,
                    is_show_default: 1
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


            openIfModel({id, logic_data, form_data}) {
                //    this.logicDataForm = {id, logic_data, form_data}
                this.logicDataShow = true;
            },
            formatColor(e) {
                if (e === 0) {
                    return '#2FD596'
                } else if (e === 1) {
                    return '#fa706c';
                } else if (e === 2) {
                    return '#078cff';
                }
            },
            loadData() {
                this.loading = true;
                this.$request({
                    params: {
                        r: 'plugin/form_goods/mall/index/edit',
                        id: this.$attrs.pos === 'plugin' ? getQuery('id') : 0,
                        goods_id: this.$attrs.pos === 'plugin' ? 0 : getQuery('id'),
                    }
                }).then(response => {
                    this.loading = false;
                    if (response.data.code === 0) {
                        let {allComponents, info, is_share, overrun} = response.data.data;
                        this.allComponents = allComponents;
                        this.showShare = is_share;

                        if (this.value && Object.values(this.value).length) {
                            let {name, form_data, logic_data} = this.value;
                            Object.assign(info, {
                                form_data,
                                name,
                            })
                            this.logicData = logic_data || [];
                        } else {
                            this.logicData = info.logic_data || [];
                        }

                        let components = info.form_data || [];
                        this.templateName = info.name || '';
                        this.tempBtnName = info.btn_name || '定制详情';
                        this.overrun = overrun;

                        for (let i in components) {
                            components[i].active = false;
                            components[i].key = randomString();
                        }
                        this.components = components;
                    }
                });
            },
            asSubmit({id}) {
                this.id = id;
                this.onSubmit();
            },
            onSubmit() {
                const postComponents = [];
                for (let i in this.components) {
                    postComponents.push({
                        id: this.components[i].id,
                        permission_key: this.components[i].permission_key,
                        data: this.components[i].data,
                    });
                }
                this.submitLoading = true;
                this.$request({
                    params: {
                        r: 'plugin/form_goods/mall/index/edit',
                    },
                    method: 'post',
                    data: {
                        id: this.id,
                        name: this.templateName,
                        data: JSON.stringify(postComponents),
                    },
                }).then(response => {
                    this.submitLoading = false;
                    if (response.data.code === 0) {
                        this.$message({message: response.data.msg, type: 'success', center: true});
                    } else {
                        this.$message({message: response.data.msg, type: 'error', center: true});
                    }
                });
            },
        },
    });
</script>