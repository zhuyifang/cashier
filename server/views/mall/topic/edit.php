<?php

$baseUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl;
$baseUrl = str_replace('http://', 'https://', $baseUrl);

$components = [
    'mch-goods',
    'video',
    'image-text',
    'bg',
    'rubik',
];
Yii::$app->loadViewComponent('diy/diy-mch-goods');
Yii::$app->loadViewComponent('diy/diy-video');
Yii::$app->loadViewComponent('diy/diy-image-text');
Yii::$app->loadViewComponent('diy/diy-bg');
Yii::$app->loadViewComponent('diy/diy-rubik');

Yii::$app->loadViewComponent('app-rich-text');
Yii::$app->loadViewComponent('app-hotspot');
Yii::$app->loadViewComponent('app-rich-text');
Yii::$app->loadViewComponent('app-radio');
Yii::$app->loadViewComponent("diy/app-padding");

?>
<style>
    .app-form-title {
        margin: 0 -20px;
        border-bottom: 1px solid #E5E7EC;
    }

    .app-form-title div {
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
</style>
<style>
    .mch-weitao-body {
        padding: 20px;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .red {
        color: #ff4544;
        margin-left: 20px;
    }

    .form-body {
        padding: 20px;
        background-color: #fff;
        margin-bottom: 20px;
        padding-right: 50%;
        min-width: 1200px;
    }

    .form-button {
        margin: 0!important;
    }

    .form-button .el-form-item__content {
        margin-left: 0!important;
    }

    .button-item {
        padding: 9px 25px;
    }

    .box {
        border: 1px solid #DCDFE6;
        border-radius: 3px;
        margin-bottom: 20px;
    }

    .box .content {
        width: 60%;
        padding: 20px 0;
    }

    .box .title {
        height: 50px;
        line-height: 50px;
        background-color: #F9F9F9;
        padding-left: 10px;
        border-bottom: 1px solid #DCDFE6;
    }

    .layout-box {
        width: 98px;
        height: 70px;
        background: #ffffff;
        border-radius: 3px;
        margin-right: 20px;
        font-size: 14px;
        padding-top: 5px;
        cursor: pointer;
        border: 2px solid #DCDFE6;
    }

    .layout-box-active {
        border: 2px solid #409eff;
    }

    .layout-box .layout-imgage {
        width: 32px;
        height: 30px;
    }

    .goods-list {
        flex-wrap: wrap;
        cursor: move;
    }

    .goods-item {
        /*margin-right: 10px;*/
        position: relative;
    }

    .goods-item,
    .goods-add {
        width: 50px;
        height: 50px;
        border: 1px solid #e2e2e2;
    }

    .goods-add .el-button {
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 0;
        padding: 0;
    }

    .goods-delete {
        position: absolute;
        left: calc(100% - 13px);
        top: -13px;
        width: 25px;
        height: 25px;
        line-height: 25px;
        padding: 0 0;
        visibility: hidden;
        z-index: 1;
    }

    .goods-delete .el-icon-close {
        position: absolute;
        top: 6px;
        left: 6px;
    }

    .goods-item:hover .goods-delete {
        visibility: visible;
    }

    .goods-pic {
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 100%;
        background-color: #f6f6f6;
        background-repeat: no-repeat;
    }

    .input-item {
        display: inline-block;
        width: 250px;
        margin: 0;
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

    .left-box {
        width: 561px;
    }

    .menu-box {
        width: 100%;
        border-bottom: 1px solid #DCDFE6;
        border-right: 1px solid #DCDFE6;
        cursor: pointer;
    }

    .menu-box .menu-item img {
        width: 40px;
        height: 40px;
    }

    .menu-box .menu-item {
        height: 99px;
        border-top: 1px solid #DCDFE6;
        border-left: 1px solid #DCDFE6;
    }

    .mobile-box {
        width: 375px;
        height: 667px;
        border: 1px solid #DCDFE6;
        margin-top: 20px;
    }

    .mch-weitao-body .slider-label {
        width: 80px;
        text-align: right;
        padding-right: 10px;
    }

    .mch-weitao-body .phone-bar {
        width: 100%;
    }



    /*start*/
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
        background: url('statics/img/mall/topic/phone-bar.png') no-repeat;
        background-size: 100% 100%;
    }

    .mobile-framework-header > div {
        margin-left: 13px;
    }

    .mobile-framework-header .search {
        position: relative;
        background: url('statics/img/app/mall/head-nav-bar-ssss.png') no-repeat;
        background-size: 100% 100%;
        width: 150px;
        height: 27px;
        background-repeat: no-repeat;
    }

    .mobile-framework-header .t-omit {
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
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

    .mobile-framework .diy-component-preview .agreement-dialog {
        zoom:  2;
        font-size: 14px;
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
            position: relative;
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
        overflow: auto;
        cursor: default;
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
        position: relative;
    }

    .mobile-framework .active .diy-component-edit {
        display: block;
        del-padding-right: 20%;
        min-width: calc(650px - 20%);
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


    /*start*/
    .all-components {
        max-height: 725px;
    }

    .all-components .component-group {
        border: 1px solid #eeeeee;
        width: 300px;
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
    }

    .all-components .component-list .component-icon {
        width: 40px;
        height: 40px;
        /*border: 1px solid #eee;*/
    }

    .all-components .component-list .component-name {

    }
</style>
<div id="app" v-cloak>
    <el-card v-loading="loading" shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <div slot="header"><span style="color: #C0C4CC;">专题</span> / {{title}}</div>

        <div class="mch-weitao-body">
            <el-form @submit.native.prevent :model="ruleForm" :rules="rules" ref="ruleForm" label-width="150px" size="small">
                <el-tabs v-model="activeName" @tab-click="handleClick">
                    <el-tab-pane label="基础设置" name="first">
                        <div class="box">
                            <div class="title">购买设置</div>
                            <div class="content">
                                <el-form-item label="标题" prop="title">
                                    <el-input v-model="ruleForm.title"></el-input>
                                </el-form-item>
                                <el-form-item label="专题列表布局方式" prop="layout_type">
                                    <div flex="dir:left">
                                        <div
                                                @click="selectType(index)"
                                                flex="dir:top cross:center"
                                                :class="{'layout-box': true, 'layout-box-active': item.is_active}" v-for="(item, index) in typeList"
                                                :key="index">
                                            <img class="layout-imgage" :src="item.image">
                                            <div>{{item.label}}</div>
                                        </div>
                                    </div>
                                    <div @click="example()" style="font-size: 12px;color: #409EFF;cursor: pointer;">查看图例</div>
                                    <div style="color: #C0C4CC;">注：大图模式与宫格模式下最多上传9张图片，列表模式仅可上传1张封面图</div>
                                </el-form-item>
                                <el-form-item label="封面图比例选择" prop="proportion" v-if="ruleForm.layout_type == 1">
                                    <app-radio turn v-model="ruleForm.proportion" :label="1">1:1</app-radio>
                                    <app-radio turn v-model="ruleForm.proportion" :label="2">3:2</app-radio>
                                    <app-radio turn v-model="ruleForm.proportion" :label="3">2:1</app-radio>
                                </el-form-item>
                                <el-form-item label="封面图" prop="pic_url">
                                    <el-button v-if="ruleForm.layout_type == 3 && ruleForm.pic_url.length >= 1" style="margin-bottom: 10px;" size="mini" disabled>选择图片</el-button>
                                    <app-attachment v-else :multiple="true" :max="ruleForm.layout_type == 3 ? 1 : 9" @selected="picUrlSuccess">
                                        <el-tooltip effect="dark" :content="ruleForm.proportion != 3 ?ruleForm.proportion != 2 ?'建议尺寸654*654':'建议尺寸654*436' : '建议尺寸654*327'" placement="top">
                                            <el-button style="margin-bottom: 10px;" size="mini">选择图片</el-button>
                                        </el-tooltip>
                                    </app-attachment>
                                    <div flex="wrap:wrap">
                                        <div v-if="ruleForm.pic_url.length > 0">
                                            <draggable v-model="ruleForm.pic_url" flex="dif:left">
                                                <app-gallery v-for="(picItem, picIndex) in ruleForm.pic_url" :key="picIndex" :url="picItem.pic_url" :show-delete="true" @deleted="deletePicUrl(picIndex)"
                                                             width="80px" height="80px">
                                                </app-gallery>
                                            </draggable>
                                        </div>
                                        <app-gallery v-if="ruleForm.pic_url.length == 0" url="" :show-delete="false"width="80px" height="80px">
                                        </app-gallery>
                                    </div>
                                </el-form-item>
                                <el-form-item label="摘要" prop="abstract">
                                    <template slot="label">
                                        <span>摘要</span>
                                        <el-tooltip effect="dark" content="专题内容的简介，用于列表上显示" placement="top">
                                            <i class="el-icon-info"></i>
                                        </el-tooltip>
                                    </template>
                                    <el-input type="textarea" v-model="ruleForm.abstract"></el-input>
                                </el-form-item>
                                <el-form-item label="自定义分享标题" prop="share_title">
                                    <el-input v-model="ruleForm.share_title"></el-input>
                                </el-form-item>
                                <el-form-item label="自定义分享图片" prop="share_pic_url">
                                    <app-attachment :multiple="false" :max="1" v-model="ruleForm.share_pic_url">
                                        <el-tooltip effect="dark" content="建议尺寸420*336" placement="top">
                                            <el-button style="margin-bottom: 10px;" size="mini">选择图片</el-button>
                                        </el-tooltip>
                                    </app-attachment>
                                    <app-gallery :url="ruleForm.share_pic_url" :show-delete="true" @deleted="ruleForm.share_pic_url = ''"
                                                 width="80px" height="80px">
                                    </app-gallery>
                                </el-form-item>
                                <el-form-item label="标签" prop="tag_id">
                                    <el-radio-group v-model="ruleForm.tag_id">
                                        <el-radio style="height: 32px;line-height: 32px;" v-for="(item, index) in tagList" :key="index" :label="item.value">{{item.label}}</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                                <el-form-item label="是否显示" prop="is_show">
                                    <el-radio-group v-model="ruleForm.is_show">
                                        <el-radio :label="1">是</el-radio>
                                        <el-radio :label="0">否</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                                <el-form-item label="虚拟阅读量" prop="virtual_read_number">
                                    <template slot="label">
                                        <span>虚拟阅读量</span>
                                        <el-tooltip effect="dark" content="手机端显示的阅读量=实际阅读量+虚拟阅读量" placement="top">
                                            <i class="el-icon-info"></i>
                                        </el-tooltip>
                                    </template>
                                    <el-input type="number" v-model="ruleForm.virtual_read_number"></el-input>
                                </el-form-item>
                                <el-form-item label="排序" prop="sort">
                                    <el-input type="number" v-model="ruleForm.sort"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="box">
                            <div class="title">商品设置</div>
                            <div class="content">
                                <el-form-item label="商品添加" prop="add_goods_type">
                                    <el-radio-group v-model="ruleForm.add_goods_type">
                                        <el-radio :label="1">自动添加</el-radio>
                                        <el-radio :label="2">手动添加</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                                <el-form-item v-if="ruleForm.add_goods_type == 1" label="商品数量" prop="add_goods_number">
                                    <el-input type="number" min="0" max="10" v-model="ruleForm.add_goods_number" placeholder="请输入要添加的商品数量"></el-input>
                                    <span style="color: #C0C4CC;">注：每篇专题文章最多添加{{goodsDialog.max}}个内嵌商品</span>
                                </el-form-item>
                                <el-form-item v-else label="商品列表" prop="add_goods_number">
                                    <div flex="warp:warp">
                                        <draggable v-model="ruleForm.add_goods_list" flex class="goods-list">
                                            <div class="goods-item" v-for="(goods,goodsIndex) in ruleForm.add_goods_list">
                                                <el-tooltip effect="dark" content="移除商品" placement="top">
                                                    <el-button @click="deleteGoods(goodsIndex, 'order_pay')" circle
                                                               class="goods-delete" type="danger"
                                                               icon="el-icon-close"></el-button>
                                                </el-tooltip>
                                                <div class="goods-pic"
                                                     :style="'background-image:url('+goods.cover_pic+')'"></div>
                                            </div>
                                        </draggable>
                                        <div v-if="ruleForm.add_goods_list.length < goodsDialog.max" class="goods-add">
                                            <el-tooltip effect="dark" content="添加商品" placement="top">
                                                <el-button @click="showGoodsDialog('order_pay')"
                                                           icon="el-icon-plus"></el-button>
                                            </el-tooltip>
                                        </div>
                                    </div>
                                    <span style="color: #C0C4CC;">注：每篇专题文章最多添加{{goodsDialog.max}}个内嵌商品</span>
                                </el-form-item>
                            </div>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="详情设置" name="second">
                        <div class="detail-box" flex="dir:left">
                            <div class="all-components" flex-box="0">
                                <div class="component-group" v-for="group in allComponents">
                                    <div class="component-group-name">{{group.groupName}}</div>
                                    <div class="component-list" flex="">
                                        <template v-for="item in group.list">
                                            <div class="component-item"
                                                 @click="selectComponent(item)">
                                                <img class="component-icon" :src="item.icon">
                                                <div class="component-name">{{item.name}}</div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div style="padding-left: 2px;position: relative;overflow-y: auto" flex-box="1">
                                <div id="ggg" style="overflow-y: auto;padding: 0 60px;height: 705px;">
                                    <div class="mobile-framework" style="height: 705px;">
                                        <div class="mobile-framework-header"
                                             flex="dir:left"
                                             @click="openPageSetting"
                                             :style="{
                                                backgroundColor: appNavBar.backgroundColor,
                                                color: appNavBar.color,
                                                justifyContent: (appNavBar.position == 'center' && appNavBar.style == 1) ? 'center': 'flex-start'
                                            }">
                                        </div>
                                        <div id="mobile-framework-body" class="mobile-framework-body"
                                             :style="'background-color:'+ bg.backgroundColor+';background-image:url('+bg.backgroundPicUrl+');background-size:'+bg.backgroundWidth+'% '+bg.backgroundHeight+'%;background-repeat:'+repeat+';background-position:'+position">
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
                                                                       icon="el-icon-document-copy"
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
                                                        <?php foreach ($components as $component) : ?>
                                                            <diy-<?= $component ?> v-if="component.id === '<?= $component ?>'"
                                                                                   :active="component.active"
                                                                                   v-model="component.data"
                                                            ></diy-<?= $component ?>>
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
                    </el-tab-pane>
                </el-tabs>
            </el-form>
        </div>

        <el-dialog
                :title="exampleDialog.title"
                :visible.sync="exampleDialog.visible"
                width="30%">
            <div style="text-align: center;">
                <img style="width: 375px;height: 667px;" :src="exampleDialog.example">
            </div>
            <span slot="footer" class="dialog-footer">
            <el-button size="small" type="primary" @click="exampleDialog.visible = false">我知道了</el-button>
          </span>
        </el-dialog>

        <el-dialog @open="getGoods" title="选择商品" :visible.sync="goodsDialog.visible" :close-on-click-modal="false">
            <el-form size="small" :inline="true" :model="goodsDialog.search" @submit.native.prevent>
                <el-form-item>
                    <div class="input-item">
                        <el-input @clear="toSearch" clearable @keyup.enter.native="toSearch" size="small"
                                  placeholder="请输入商品ID/名称搜索"
                                  v-model="goodsDialog.search.keyword">
                            <el-button slot="append" icon="el-icon-search" @click="toSearch"></el-button>
                        </el-input>
                    </div>
                </el-form-item>
            </el-form>
            <el-table :data="goodsDialog.list" v-loading="goodsDialog.loading" @selection-change="goodsSelectionChange">
                <el-table-column label="选择" type="selection"></el-table-column>
                <el-table-column label="ID" prop="id" width="100px"></el-table-column>
                <el-table-column label="名称" prop="name"></el-table-column>
            </el-table>
            <div style="text-align: center; margin-top: 15px;">
                <el-pagination
                        v-if="goodsDialog.pagination"
                        style="display: inline-block"
                        background
                        @current-change="goodsDialogPageChange"
                        layout="prev, pager, next, jumper"
                        :page-size.sync="goodsDialog.pagination.pageSize"
                        :total="goodsDialog.pagination.totalCount">
                </el-pagination>
            </div>
            <div slot="footer">
                <el-button size="small" @click="goodsDialog.visible = false">取 消</el-button>
                <el-button size="small" type="primary" @click="addGoods">确 定</el-button>
            </div>
        </el-dialog>

        <el-button class="button-item" :loading="btnLoading" type="primary" @click="store('ruleForm')" size="small">保存</el-button>
</div>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/unpkg/vuedraggable@2.18.1/dist/vuedraggable.umd.min.js"></script>
<script>
    const app = new Vue({
        el: '#app',
        data() {

            return {
                title: '',
                loading: false,
                btnLoading: false,
                ruleForm: {
                    title: '',
                    proportion: 1,
                    layout_type: 1,
                    pic_url: [],
                    abstract: '',
                    share_title: '',
                    share_pic_url: '',
                    tag_id: null,
                    is_show: 1,
                    virtual_read_number: null,
                    sort: 100,
                    add_goods_type: 1,
                    add_goods_number: 10,
                    add_goods_list: [],
                    component: []
                },
                goodsDialog: {
                    visible: false,
                    page: 1,
                    loading: null,
                    pagination: null,
                    list: null,
                    index: null,
                    selectedList: null,
                    max: 10,//添加商品最大数量
                    search: {
                        keyword: '',
                        status: 1,
                    }
                },
                rules: {
                    title: [
                        { required: true, message: '请输入标题', trigger: 'change' },
                    ],
                    layout_type: [
                        // { required: true, message: '请选择布局类型', trigger: 'change' },
                    ],
                    tag_id: [
                        { required: true, message: '请选择标签', trigger: 'change' },
                    ],
                    sort: [
                        { required: true, message: '请输入排序', trigger: 'change' },
                    ],
                    pic_url: [
                        { required: true, message: '请上传封面图', trigger: 'change' },
                    ],
                },
                activeName: 'first',
                typeList: [
                    {
                        label: '大图模式',
                        value: 1,
                        image: 'statics/img/mall/mch/weitao/big-type.png',
                        example: 'statics/img/mall/topic/1.png',
                        is_active: 1
                    },
                    {
                        label: '宫格模式',
                        value: 2,
                        image: 'statics/img/mall/mch/weitao/grid-type.png',
                        example: 'statics/img/mall/topic/2.png',
                        is_active: 0
                    },
                    {
                        label: '列表模式',
                        value: 3,
                        image: 'statics/img/mall/mch/weitao/list-type.png',
                        example: 'statics/img/mall/topic/3.png',
                        is_active: 0
                    },
                ],
                tagList: [],
                exampleDialog: {
                    visible: false,
                    title: '',
                    image: '',
                    index: 0,
                },

                // 组件相关
                components: [],
                overrun: null,
                appNavBar: {
                    style: '1',
                    leftIcon: "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>" + 'statics/img/app/mall/head-nav-bar-mall.png',
                    link: {},
                    hasMallSetting: 0,
                    color: 'black',
                    backgroundColor: '#FFFFFF',
                    position: 'center',
                    placeholder: '搜索',
                    placeholderColor: '#666666',
                },
                templateName: '',
                bg: {
                    showImg: false,
                    backgroundColor: '#f5f7f9',
                    backgroundPicUrl: '',
                    position: 5,
                    mode: 1,
                    backgroundHeight: 100,
                    backgroundWidth: 100,
                },
                bgSetting: {
                    showImg: false,
                    backgroundColor: '#f5f7f9',
                    backgroundPicUrl: '',
                    position: 5,
                    mode: 1,
                    backgroundHeight: 100,
                    backgroundWidth: 100,
                    positionText: 'center center',
                    repeatText: 'no-repeat',
                },
                position: 'center center',
                repeat: 'no-repeat',
                overrun: null,
                has_home: 0,
                hasNavShow: false,

                allComponents: [
                    {
                        groupName: '基础组件',
                        list: [
                            {
                                icon: 'statics/img/mall/mch/weitao/rubik.png',
                                id: 'rubik',
                                name: '图片广告'
                            },
                            {
                                icon: 'statics/img/mall/mch/weitao/video.png',
                                id: 'video',
                                name: '视频'
                            },
                            {
                                icon: 'statics/img/mall/mch/weitao/image-text.png',
                                id: 'image-text',
                                name: '图文详情'
                            },
                            {
                                icon: 'statics/img/mall/mch/weitao/goods.png',
                                id: 'mch-goods',
                                name: '商品'
                            },
                        ]
                    }
                ],
            };
        },
        created() {
            this.title = getQuery('id') ? '编辑' : '新增'
            this.loadData();
            console.log(this.ruleForm)
        },
        watch: {
            'ruleForm.add_goods_number': {
                handler(newVal, oldVal) {
                    this.ruleForm.add_goods_number = Math.floor(newVal);
                    if (this.ruleForm.add_goods_number > 10) {
                        this.ruleForm.add_goods_number = 10;
                    }
                    if (this.ruleForm.add_goods_number < 0) {
                        this.ruleForm.add_goods_number = 0;
                    }
                },
            },
        },
        methods: {
            store(formName) {
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        this.btnLoading = true;
                        let ruleForm = JSON.parse(JSON.stringify(this.ruleForm));
                        ruleForm.components = this.components;
                        request({
                            params: {
                                r: 'mall/topic/edit',
                            },
                            method: 'post',
                            data: {
                                data: JSON.stringify(ruleForm)
                            }
                        }).then(e => {
                            this.btnLoading = false;
                            if (e.data.code == 0) {
                                this.$message.success(e.data.msg);
                                navigateTo({
                                    r: 'mall/topic/index',
                                });
                            } else {
                                this.$message.error(e.data.msg);
                            }
                        });
                    } else {
                        this.btnLoading = false;
                        console.log('error submit!!');
                        return false;
                    }
                })
            },
            loadData() {
                let self = this;
                this.loading = true;
                request({
                    params: {
                        r: 'mall/topic/edit',
                        id: getQuery('id')
                    },
                    method: 'get'
                }).then(e => {
                    this.loading = false;
                    this.is_show = true;
                    if (e.data.code == 0) {
                        this.tagList = e.data.data.tag_list
                        if (e.data.data.topic) {
                            this.ruleForm = e.data.data.topic
                            this.components = e.data.data.topic.detail

                            this.typeList.forEach(function(item) {
                                item.is_active = 0;
                                if (item.value == self.ruleForm.layout_type) {
                                    item.is_active = 1;
                                }
                            })
                        } else {
                            if (this.tagList.length > 0) {
                                this.ruleForm.tag_id = this.tagList[0].value
                            }
                        }
                    }
                }).catch(e => {
                    this.loading = false;
                });
            },
            handleClick(tab, event) {
                console.log(tab, event);
            },
            selectType(index) {
                let self = this;
                self.typeList.forEach(function(cItem, cInex) {
                    cItem.is_active = 0;
                    if (index == cInex) {
                        cItem.is_active = 1;
                        self.ruleForm.layout_type = cItem.value;
                        self.exampleDialog.index = index;
                    }
                })
            },
            example() {
                let index = this.exampleDialog.index;
                console.log(this.typeList[index])
                this.exampleDialog.example = this.typeList[index].example;
                this.exampleDialog.title = this.typeList[index].value != 1 ? this.typeList[index].value != 2 ? '专题列表列表模式布局图例':  '专题列表宫格模式布局图例' : '专题列表大图模式布局图例';
                this.exampleDialog.visible = true;
            },
            showGoodsDialog(index) {
                this.goodsDialog.visible = true;
                this.goodsDialog.index = index;
            },
            goodsSelectionChange(e) {
                this.goodsDialog.selectedList = e;
            },
            addGoods() {
                this.goodsDialog.visible = false;
                for (let i in this.goodsDialog.selectedList) {
                    console.log(this.goodsDialog.selectedList[i])
                    const item = {
                        id: this.goodsDialog.selectedList[i].id,
                        name: this.goodsDialog.selectedList[i].name,
                        cover_pic: this.goodsDialog.selectedList[i].goodsWarehouse.cover_pic,
                        price: this.goodsDialog.selectedList[i].price,
                    };
                    if (this.ruleForm.add_goods_list.length < this.goodsDialog.max) {
                        this.ruleForm.add_goods_list.push(item);
                    }
                }
            },
            deleteGoods(goodsIndex, index) {
                this.ruleForm.add_goods_list.splice(goodsIndex, 1);
            },
            getGoods() {
                let self = this;
                self.goodsDialog.loading = true;
                request({
                    params: {
                        r: 'mall/goods/index',
                        page: self.goodsDialog.page,
                        search: JSON.stringify(self.goodsDialog.search),
                    },
                    method: 'get',
                }).then(e => {
                    self.goodsDialog.loading = false;
                    self.goodsDialog.list = e.data.data.list;
                    self.goodsDialog.pagination = e.data.data.pagination;
                }).catch(e => {
                    console.log(e);
                });
            },
            goodsDialogPageChange(page) {
                this.goodsDialog.page = page;
                this.getGoods();
            },
            toSearch() {
                this.getGoods();
            },
            selectComponent(e) {
                if (this.overrun && !this.overrun.is_diy_module_overrun
                    && this.components.length - 1 >= this.overrun.diy_module_overrun) {
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
                this.hasNavShow = false;
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
                    let document = this.$el.querySelector('#child').childNodes[currentIndex];
                    this.showComponentEdit(component, currentIndex);
                    this.$el.querySelector('#ggg').scrollTop = document.offsetTop - 200;
                });
                console.log(this.components)
            },
            showComponentEdit(component, index) {
                for (let i in this.components) {
                    if (i == index) {
                        this.components[i].active = true;
                    } else {
                        this.components[i].active = false;
                    }
                }
            },
            deleteComponent(index) {
                this.components.splice(index, 1);
            },
            copyComponent(index) {
                if (this.overrun && !this.overrun.is_diy_module_overrun
                    && this.components.length >= this.overrun.diy_module_overrun) {
                    this.$message({
                        message: '最多添加' + this.overrun.diy_module_overrun + '个组件',
                        type: 'error',
                        center: true
                    });
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
            openPageSetting() {
                if (this.type === 'module') return
                this.hasNavShow = true;
                this.showComponentEdit('', '-1');
            },
            picUrlSuccess(e) {
                let self = this;
                let array = [];
                e.forEach(function(item, index) {
                    if (self.ruleForm.pic_url.length < 9) {
                        self.ruleForm.pic_url.push({
                            pic_url: item.url
                        })
                    }
                })
            },
            deletePicUrl(index) {
                this.ruleForm.pic_url.splice(index, 1)
            }
        }
    });
</script>
