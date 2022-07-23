<?php
$_currentPluginBaseUrl = \app\helpers\PluginHelper::getPluginBaseAssetsUrl(Yii::$app->plugin->currentPlugin->getName());
require \Yii::$app->BasePath . '/views/components/diy-form/template/dothing/plugin.php';


Yii::$app->loadViewComponent("model-form-add", __DIR__);
?>

<script>
    const _currentPluginBaseUrl = '<?=$_currentPluginBaseUrl?>';
    const _appImg = _currentPluginBaseUrl + '/images/form/';
</script>
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
    .del-app-edit .diy-component-edit .el-switch.is-checked .el-switch__core::after{
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
    .app-edit .diy-component-edit .el-color-picker .el-color-picker__icon:before{
        content:"\e790";
    }
    .app-edit .diy-component-edit .el-color-picker .el-color-picker__icon {
        left: 70%;
        font-size: 22px;
        color: #888F9A;
    }
    .app-edit .diy-component-edit .el-color-picker+.el-input .el-input__inner {
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
    .del-app-edit .diy-component-edit .el-checkbox__input.is-checked+.el-checkbox__label {
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

    .el-form-item__label {
        padding-right: 5px !important;
        width: 90px !important;
    }

    .el-form-item__content {
        margin-left: 110px !important;
    }
</style>
<div id="app" v-cloak="">
    <div class="app-edit">
        <el-card shadow="never" style="margin-bottom: 10px">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <span style="color: #409EFF;cursor: pointer"
                          @click="$navigate({r:'plugin/diy/mall/diy-form/index'})">
                        自定义表单
                    </span>
                </el-breadcrumb-item>
                <el-breadcrumb-item v-if="id > 0">编辑</el-breadcrumb-item>
                <el-breadcrumb-item v-else>新增</el-breadcrumb-item>
            </el-breadcrumb>
        </el-card>
        <model-form-add :show-share="showShare != -1" v-model="formVisible" @submit="asSubmit"></model-form-add>

        <div v-loading="loading">
            <div flex="box:first" style="margin-bottom: 10px;min-width: 1280px;height: 725px;">
                <div class="all-components">
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
                                    商城首页
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


                                        <?php foreach ($components as $component) : ?>
                                            <<?= $component ?> v-if="`f-${component.id}` === '<?= $component ?>'"
                                                                   :active="component.active"
                                                                    @ldon="buttonTime"
                                                                   :all-data="components"
                                        :other-info="otherInfo"
                                                                   v-model="component.data"
                                            ></<?= $component ?>>
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
    </div>
    <el-card class="bottom-menu" shadow="never">
        <div>
            <el-button size="small" @click="onSubmit" type="primary" :loading="submitLoading">保存</el-button>
            <el-button size="small" @click="formVisible = true" type="primary" :loading="submitLoading">另存为</el-button>
        </div>
    </el-card>
</div>
</div>
<script>
    let {log, warn, error, table} = console;
    const app = new Vue({
        el: '#app',

        data() {
            return {
                activeId: '',
                formVisible: false,
                formForm: [],


                loading: false,
                allComponents: [],
                components: [],

                id: null,
                maxLimit: 20,
                showShare: -1,
                submitLoading: false,
                overrun: null,
                otherInfo: null,
            };
        },
        created() {
            this.id = getQuery('id');
            this.loadData();
        },
        watch: {
            components: {
                deep: true,
                handler(newVal, oldVal) {
                },
            }
        },
        methods: {
            formatColor(e) {
                if (e === 0) {
                    return '#2FD596';
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
                        r: 'plugin/diy/mall/diy-form/edit',
                        id: this.id,
                    }
                }).then(response => {
                    this.loading = false;
                    if (response.data.code === 0) {
                        let {allComponents, info, is_share, overrun} = response.data.data;
                        this.allComponents = allComponents;
                        this.showShare = is_share;
                        let components = info.data;
                        this.overrun = overrun;

                        this.otherInfo = {
                            time: {
                                update: 0,
                                time_status: info.time_status,
                                time_at: info.time_at
                            }
                        }
                        for (let i in components) {
                            components[i].active = false;
                            components[i].key = randomString();
                        }
                        this.components = components;
                    }
                });
            },
            buttonTime(e){
                this.otherInfo.time.update = this.otherInfo.time.update++;
            },
            asSubmit({id}) {
                this.id = id;
                this.onSubmit();
            },
            onSubmit() {
                const postComponents = [];
                for (let i in this.components) {
                    //需求要加的判断
                    if (this.components[i]['id'] === 'button') {
                        let button = this.components[i]['data'];
                        let {
                            m_send_date,
                            m_sms,
                            m_subscribe,
                            message_status,
                            pay_status,
                            pay_price_list,
                            m_send_type
                        } = button
                        if (m_send_type === 'date' && message_status == 1 && (m_sms || m_subscribe) && !m_send_date) {
                            this.$message({message: '提醒时间不能为空', type: 'warning', center: true});
                            return;
                        }
                        if (pay_status === 'much') {
                            for (let item of pay_price_list) {
                                if (!item.title) {
                                    this.$message({message: '金额列表标题不能为空', type: 'warning', center: true});
                                    return;
                                }
                            }
                        }
                    }
                    if (this.components[i]['id'] === 'phone') {
                        let data = this.components[i]['data'];
                        if (!data.error_limit) {
                            this.$message({message: '手机验证次数不能为空', type: 'warning', center: true});
                            return;
                        }
                    }
                    postComponents.push({
                        id: this.components[i].id,
                        permission_key: this.components[i].permission_key,
                        data: this.components[i].data,
                    });
                }
                this.submitLoading = true;
                this.$request({
                    params: {
                        r: 'plugin/diy/mall/diy-form/edit',
                    },
                    method: 'post',
                    data: {
                        id: this.id,
                        data: JSON.stringify(postComponents),
                    },
                }).then(response => {
                    this.submitLoading = false;
                    if (response.data.code === 0) {
                        this.$message({message: response.data.msg, type: 'success', center: true});
                        //this.id = response.data.data.id;
                    } else {
                        this.$message({message: response.data.msg, type: 'error', center: true});
                    }
                });
            },

            /////////////////////////////////////
            selectComponent(e) {
                if (this.overrun && !this.overrun.is_diy_module_overrun
                    && this.components.length >= this.overrun.diy_module_overrun) {
                    this.$message.error('最多添加' + this.overrun.diy_module_overrun + '个组件');
                    return;
                }
                if (e.single) {
                    for (let i in this.components) {
                        if (this.components[i].id === e.id) {
                            this.$message.error('该组件只允许添加一个。');
                            return;
                        }
                    }
                }
                let currentIndex = this.components.length;
                for (let i in this.components) {
                    if (this.components[i].active) {
                        currentIndex = parseInt(i) + 1;
                        break;
                    }
                }
                const component = {
                    id: e.id,
                    data: null,
                    active: false,
                    key: randomString(),
                    permission_key: e.key ? e.key : ''
                };

                this.components.splice(currentIndex, 0, component);
                this.$nextTick(function () {
                    this.activeId = e.id;
                    let document = this.$el.querySelector('#child').childNodes[currentIndex];
                    this.showComponentEdit(component, currentIndex);
                    this.$el.querySelector('#ggg').scrollTop = document.offsetTop - 200;
                });
            },
            showComponentEdit(component, index) {
                for (let i in this.components) {
                    this.components[i].active = i == index;
                }
                this.activeId = component.id;
            },
            deleteComponent(index) {
                this.components.splice(index, 1);
            },
            copyComponent(index) {
                if (this.overrun && !this.overrun.is_diy_module_overrun
                    && this.components.length >= this.overrun.diy_module_overrun) {
                    this.$message.error('最多添加' + this.overrun.diy_module_overrun + '个组件');
                    return;
                }
                for (let i in this.allComponents) {
                    for (let j in this.allComponents[i].list) {
                        if (this.allComponents[i].list[j].id === this.components[index].id) {
                            if (this.allComponents[i].list[j].single) {
                                this.$message({message: '该组件只允许添加一个。', type: 'error', center: true});
                                return;
                            }
                        }
                    }
                }
                let json = JSON.stringify(this.components[index]);
                console.log(json);
                let copy = JSON.parse(json);
                copy.active = false;
                copy.key = randomString();
                this.components.splice(index + 1, 0, copy);
            },
            moveUpComponent(index) {
                this.swapComponents(index, index - 1);
            },
            moveDownComponent(index) {
                this.swapComponents(index, index + 1);
            },
            swapComponents(index1, index2) {
                this.components[index2] = this.components.splice(index1, 1, this.components[index2])[0];
            },
            ////////////////////////////
        },
    });
</script>