<?php

$mchPathUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/statics/img/mall/mch/';
Yii::$app->loadViewComponent('app-radio');
Yii::$app->loadViewComponent('app-rich-text');
Yii::$app->loadViewComponent('app-hotspot');
Yii::$app->loadViewComponent('diy/color');
$components = ['mch-home', 'search', 'nav', 'banner', 'notice', 'image-text', 'link', 'rubik', 'video', 'goods', 'empty', 'customer'];
$components = array_merge($components, ['mch-share']);
foreach ($components as $component) {
    Yii::$app->loadViewComponent(sprintf('diy/diy-%s', $component));
}
?>
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
        cursor: default;
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

    /**********************************************************/
    .head-tabs {
        margin-bottom: 10px;
    }

    .head-tabs .el-card__body {
        padding: 0 30px;
    }

    .head-tabs .el-tabs__header {
        margin-bottom: 0;
    }

    .head-tabs .el-tabs__item {
        padding: 0 27px;
    }

    .head-tabs .el-tabs__nav {
        padding: 10px 0;
    }
</style>
<style>

    .app-edit .__mch-home-padding {
        padding: 20px;
        border-radius: 5px;
        border: 1px solid #DCDFE6;
    }

    .mch-home-detail .mobile {
        width: 404px;
        height: 736px;
        border-radius: 30px;
        background-color: #fff;
        padding: 33px 12px;
        margin-right: 10px;
    }

    .mch-home-detail .screen {
        border: 2px solid #F3F5F6;
        height: 670px;
        width: 379px;
        margin: 0 auto;
        position: relative;
        background-color: #F7F7F7;
    }

    .mch-home-detail .top-bar {
        width: 375px;
        height: 64px;
        position: relative;
        background: url('statics/img/mall/head-diy.png') center no-repeat;
    }

    .mch-home-detail .form-body {
        padding: 20px 0;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .mobile.new-mobile {
        border-radius: 0;
        background-size: 100% 100%;
        background-color: #f7f7f7;
        width: 419px;
        padding-top: 66px;
        height: 825px;
        background-image: url('statics/img/mall/mch/iphone.png');
        background-repeat: no-repeat;
    }

    .new-screen {
        height: 667px;
        width: 375px;
    }

    .new-top-bar {
        position: absolute !important;
        z-index: 333;
    }

    /*///////////////////////////////*/
    .summary {
        position: relative;
        height: 100%;
        zoom: 0.5;
    }

    .summary .shop-pos {
        position: relative;
        z-index: 2;
    }

    .summary .shop-pos .center > div {
        margin-bottom: 40px;
    }

    .summary .shop-pos .summary-name {
        font-weight: bold;
        font-size: 40px;
        margin-bottom: 10px;
    }



    .summary .shop-pos .summary-tag {
        font-size: 24px;
        color: #FF4544;
        padding: 4px 14px;
        border-radius: 4px;
        border: 1px solid #FF4544;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .summary .shop-pos .center {
        margin-top: 30px;
    }

    .summary .shop-style2 {
        padding: 24px;
        background: #FFFFFF;
        border-radius: 8px;
    }

    .summary .map {
        width: 100%;
        height: 320px;
    }

    .summary .box-grow-1 {
        display: flex;
        flex-shrink: 1;
        flex-grow: 1;
    }

    .summary .box-grow-0 {
        display: flex;
        flex-shrink: 0;
        flex-grow: 0;
    }

    .app-edit .image-close {
        background-image: url("data:image/png;base64,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");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 32px;
        width: 32px;
        position: absolute;
        top: 0;
        right: 0;
    }

    .app-edit .shop-phone {
        margin-left: auto;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        height: 48px;
        width: 48px;
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAclBMVEUAAACkpKSZmZmampqVlZWZmZmampqZmZmZmZmZmZmbm5udnZ2ampqampqZmZmYmJiZmZmZmZmZmZmTk5OZmZmampqZmZmZmZmZmZmYmJiZmZmZmZmbm5uampqYmJiZmZmZmZmZmZmZmZmampqYmJiZmZmZotNBAAAAJXRSTlMADcRlCvPjHvc+WRe1lX3s+75GBOV0VdXSv6MoJWtdijkrz6ukD4vHCAAAAdZJREFUSMelltmSgjAQRZtAwr4jKoo6y/3/XxwNM2nIBC3K84BVmJt0d3qB3idN8lpFQKTqPEnpBZ4voKkqaITvPVtelIDMdk0YEAVhs8skUBarkr4DxCWgGcFFAF3v3n4AREz/iAUwOA4J95A+OfEl9iFZnBQOJ1rhdICy/gwVjt6TaByhwsWLPY4BPSE4Yj/fcMDBe3FBBwyzeEKe6QVnid6oO5j4pGM+tu5YofuzooD4eztGAHJyIlD8HlAiNrs8iNwpF6P0plXmgLaDZlw7wv/9TcweE7VbcJl2TiEDtkhTee7LkHgYmyAjS4CenGTalhw7skyKYrdgpwNYozEXEk3rG3LTaO8UOK2+tCChFUKo+zMCp91NC4rVFER0f6JauHVHhmuKCq0lOGsvRLsuMCaZQDzIn5nETrNRuE5hDl1O67Ay3qdWZCnRFSiz4maFlS+Oy/uBvF4x8ZnOLo5Tg/kosaRYpAYnHysUFuSL5OP0ZlKBOSOntykgi7aoYCg9LiAuUZuPGgCnIpcoNwGb2yBxR8V2E+A2Y9PeLn7cztvMlkZ2kui3tso3mvG2ds8DZdWPMw+U7SOL8b63DEUeu8ly7CY8djcM9jc+Hd7+OGHatU7zA+eJPBsdy0rTAAAAAElFTkSuQmCC");
    }

    .app-edit .map {
        width: 100%;
        height: 320px;
    }
    .app-edit .mch-home_arrow {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAWCAMAAADD5o0oAAAARVBMVEUAAACZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZkBVNYgAAAAFnRSTlMAgtiokR0V5s+9dmdhUklA8LW0nZx9Nlin2AAAAE9JREFUGNNlz0cOwDAIRFHXOInTy9z/qF7yJVjxJARMuGKwyqKKChT1Qasy1PVAmxZo1zyZDiXoVKqmquaAMS7gan+06+ajiPC6cC52+60f0acDStr+zywAAAAASUVORK5CYII=");
        background-size: 100% 100%;
        height:28px;
        width:18px;
        background-repeat: no-repeat;
    }
</style>
<div id="app" v-cloak="">
    <div class="app-edit">
        <el-card shadow="never" class="head-tabs">
            <el-tabs v-model="tabsActive">
                <el-tab-pane label="首页装修" name="home"></el-tab-pane>
                <el-tab-pane label="店铺印象" name="detail"></el-tab-pane>
            </el-tabs>
        </el-card>
        <div v-loading="loading">
            <div v-if="tabsActive === 'home'" flex="box:first"
                 style="margin-bottom: 10px;min-width: 1280px;height: 725px;">
                <div class="all-components">
                    <el-form label-width="95px">
                        <el-form-item label="设置背景">
                            <el-button size="small" @click="openBgSetting">设置</el-button>
                        </el-form-item>
                    </el-form>
                    <div class="component-group" v-for="(group,indexcolor) in allComponents">
                        <div class="component-group-name">{{group.groupName}}</div>
                        <div class="component-list" flex>
                            <div v-for="item in group.list"
                                v-show="item.id != 'mch-home'"
                                class="component-item"
                                :class="{'active': activeId === item.id}"
                                :style="{'--form-edit': formatColor(indexcolor)}"
                                @click="selectComponent(item)">
                                <img class="component-icon" :src="item.icon">
                                <div class="component-name">{{item.name}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="padding-left: 2px;position: relative;overflow-y: auto">
                    <div id="ggg" style="overflow-y: auto;padding: 0 60px;height: 705px;">
                        <div class="mobile-framework" style="height: 705px;">
                            <div class="mobile-framework-header"
                                 flex="dir:left main:center"
                                 style="position:absolute;width:inherit;z-index: 999">
                            </div>
                            <div style="height: 60px;width: 375px;"></div>
                            <div id="mobile-framework-body" class="mobile-framework-body"
                                 :style="'background-color:'+ bg.backgroundColor+';background-image:url('+bg.backgroundPicUrl+');background-size:'+bg.backgroundWidth+'% '+bg.backgroundHeight+'%;background-repeat:'+repeat+';background-position:'+position">
                                <draggable v-model="components" :options="{filter:'.active',preventOnFilter:false}"
                                           v-if="components && components.length" id="child">
                                    <div v-for="(component, index) in components" :key="component.key"
                                         :style="{cursor: component.active ? 'pointer': 'move'}">
                                        <div @click="showComponentEdit(component,index)"
                                             :class="(component.active?'active':'')">
                                            <div class="diy-component-options" v-if="component.active && component.id !== 'mch-share'"
                                                 :style="[optionStyle(component)]">
                                                <template v-if="component.id != 'mch-home'">
                                                    <el-button type="primary"
                                                           icon="el-icon-delete"
                                                           @click.stop="deleteComponent(index)"
                                                           style="left: -25px;top:0;"></el-button>
                                                    <el-button type="primary"
                                                               icon="el-icon-plus"
                                                               @click.stop="copyComponent(index)"
                                                               style="left: -25px;top:30px;"></el-button>
                                                    <el-button
                                                            v-if="index > 1 && components.length > 1 && component.id !== 'mch-share'"
                                                            type="primary"
                                                            icon="el-icon-arrow-up"
                                                            @click.stop="moveUpComponent(index)"
                                                            style="right: -25px;top:0;"></el-button>
                                                    <el-button
                                                            v-if="components.length > 1 && index < components.length-1 && component.id !== 'mch-share'"
                                                            type="primary"
                                                            icon="el-icon-arrow-down"
                                                            @click.stop="moveDownComponent(index)"
                                                            style="right: -25px;top:30px;"></el-button>
                                                </template>
                                            </div>
                                            <?php foreach ($components as $component) : ?>
                                                <diy-<?= $component ?> v-if="component.id === '<?= $component ?>'"
                                                                       :active="component.active"
                                                                       :mch-data="mch_default_data"
                                                                       v-model="component.data"
                                                ></diy-<?= $component ?>>


                                                <div v-if="component.id === 'mch-share' && component.id === '<?= $component ?>' && component.data" class="mch-home-head diy-component-preview mch-home-head"
                                                     style="position:absolute;z-index: 1;cursor: pointer;width:140px;border-width:2px;z-index: 20;"
                                                     :style="{top: `${1140 - component.data.share_bottom}px`, left: `${731 - component.data.share_right}px`}">
                                                    <el-image style="height: 140px;width:140px" :src="component.data.share_btn_pic"></el-image>
                                                    <div v-if="component.data.is_open == 1" class="image-close"></div>
                                                </div>

                                                <div v-if="component.id === 'mch-share'
                                                     && component.id === '<?= $component ?>'
                                                     && component.data
                                                     && component.active" class="diy-component-preview diy-component-options"
                                                     style="position:absolute;z-index: 1;cursor: pointer;width:56px;border-width:0px;zoom: 1"
                                                     :style="{top: `${570  - component.data.share_bottom / 2}px`, left: `${436 - component.data.share_right / 2 - 70}px`}">

                                                    <el-button type="primary"
                                                               icon="el-icon-delete"
                                                               @click.stop="deleteComponent(index)"
                                                               style="left: -25px;top:0;"
                                                    ></el-button>
                                                </div>
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
            <div v-if="tabsActive === 'detail'" class="mch-home-detail">
                <div style="display: flex;">
                    <div class="mobile new-mobile">
                        <div class="screen new-screen">
                            <div class="top-bar new-top-bar"></div>
                            <div class="content" style="height:667px;overflow-y:scroll;" flex-box="0">
                                <div class="summary">
                                    <div :style="[bgStyle]"></div>
                                    <template v-if="detailForm.basic_style == 1">
                                        <div :style="[logoStyle]" style="position: absolute"></div>
                                        <div :style="{paddingTop: `calc(${detailForm.card_top}px  + 3px + ${detailForm.shop_logo_size / 2}px)`}"
                                             class="shop-pos">
                                            <div :style="[boxStyle]" flex="dir:top">
                                                <div flex="dir:top cross:center">
                                                    <div class="summary-name"
                                                         :style="{color: detailForm.shop_title_color,fontSize: `${detailForm.shop_logo_font}px`}">
                                                        {{ mch_default_data.name }}
                                                    </div>
                                                </div>
                                                <div class="center" flex="dir:top">
                                                    <div :style="{marginBottom: `${detailForm.card_padding}px`}"
                                                         flex="dir:left cross:center">
                                                        <div class="box-grow-0" :style="[sLabelStyle]">主营内容</div>
                                                        <div :style="[sValueStyle]">
                                                            {{ mch_default_data.scope }}
                                                        </div>
                                                    </div>
                                                    <div :style="{marginBottom: `${detailForm.card_padding}px`}"
                                                         flex="dir:left cross:center">
                                                        <div class="box-grow-0" :style="[sLabelStyle]">店铺简介</div>
                                                        <div :style="[sValueStyle]">
                                                            {{ mch_default_data.description }}
                                                        </div>
                                                    </div>
                                                    <div :style="{marginBottom: `${detailForm.card_padding}px`}"
                                                         flex="dir:left cross:center">
                                                        <div class="box-grow-0" :style="[sLabelStyle]">营业时间</div>
                                                        <div :style="[sValueStyle]">{{ mch_default_data.business_hours }}</div>
                                                    </div>
                                                    <div :style="{marginBottom: `${detailForm.card_padding}px`}"
                                                         v-if="detailForm.has_shop_phone == 1"
                                                         flex="dir:left cross:center">
                                                        <div class="box-grow-0" style="padding-top: 8px"
                                                             :style="[sLabelStyle]">联系电话
                                                        </div>
                                                        <div :style="[sValueStyle]">{{mch_default_data.mobile}}</div>
                                                        <div class="shop-phone"></div>
                                                    </div>
                                                    <div flex="dir:left cross:center">
                                                        <div class="box-grow-0" :style="[sLabelStyle]">店铺地址</div>
                                                        <div class="box-grow-1" :style="[sValueStyle]">{{mch_default_data.address}}</div>
                                                        <div class="box-grow-0">
                                                            <div class="mch-home_arrow"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-grow-0">
                                                        <image class="map"
                                                               src="statics/img/mall/mch/shop-map-icon.png"
                                                        ></image>
                                                    </div>
                                                </div>
                                            </div>
                                            <div :style="[btnStyle]" flex="main:center cross:center"
                                                 v-if="detailForm.has_contact_customer == 1">
                                                联系客服
                                            </div>
                                        </div>
                                    </template>
                                    <template v-if="detailForm.basic_style == 2">
                                        <div :style="{paddingTop: `${detailForm.card_top}px`}" class="shop-pos">
                                            <div :style="{margin: `0 ${detailForm.card_left_right}px`}">
                                                <div class="shop-style2" flex="dir:left cross:center"
                                                     :style="{borderRadius: `${detailForm.card_radius}px`}">
                                                    <div :style="[logoStyle,{position: 'static'}]" class="box-grow-0"></div>
                                                    <div style="margin-left:20px" flex="dir:top">
                                                        <div class="summary-name"
                                                             :style="{color: detailForm.shop_title_color,fontSize: `${detailForm.shop_logo_font}px`}">
                                                            {{ mch_default_data.name }}
                                                        </div>
                                                        <div :style="[sValueStyle]">{{ mch_default_data.description }}</div>
                                                    </div>
                                                </div>
                                                <div class="shop-style2"
                                                     :style="{marginTop: `${detailForm.card_padding}px`, borderRadius: `${detailForm.card_radius}px`}">
                                                    <div flex="dir:left cross:center"
                                                         style="margin-bottom: 30px">
                                                        <div class="box-grow-0" :style="[sLabelStyle]">主营内容</div>
                                                        <div :style="[sValueStyle]">{{mch_default_data.scope}}</div>
                                                    </div>
                                                    <div flex="dir:left cross:center">
                                                        <div class="box-grow-0" :style="[sLabelStyle]">营业时间</div>
                                                        <div :style="[sValueStyle]">{{mch_default_data.business_hours}}</div>
                                                    </div>
                                                </div>
                                                <div class="shop-style2"
                                                     v-if="detailForm.has_shop_phone == 1"
                                                     :style="{marginTop: `${detailForm.card_padding}px`, borderRadius: `${detailForm.card_radius}px`}">
                                                    <div flex="dir:left cross:center">
                                                        <div class="box-grow-0" style="padding-top: 8px"
                                                             :style="[sLabelStyle]">联系电话
                                                        </div>
                                                        <div :style="[sValueStyle]">{{mch_default_data.mobile}}</div>
                                                        <div class="shop-phone"></div>
                                                    </div>
                                                </div>
                                                <div class="shop-style2"
                                                     :style="{marginTop: `${detailForm.card_padding}px`, borderRadius: `${detailForm.card_radius}px`}">
                                                    <div flex="dir:left cross:center">
                                                        <div class="box-grow-0" :style="[sLabelStyle]">店铺地址</div>
                                                        <div class="box-grow-1" :style="[sValueStyle]">{{mch_default_data.address}}</div>
                                                        <div class="box-grow-0">
                                                            <div class="mch-home_arrow"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-grow-0" style="margin-top:12px">
                                                        <image class="map"
                                                               src="statics/img/mall/mch/shop-map-icon.png"
                                                        ></image>
                                                    </div>
                                                </div>
                                            </div>


                                            <div :style="[btnStyle]" flex="main:center cross:center"
                                                 v-if="detailForm.has_contact_customer == 1">
                                                联系客服
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%;margin-bottom: 20px">
                        <el-card class="box-card" shadow="never">
                            <div slot="header">
                                <span>店铺印象设置</span>
                            </div>
                            <el-form style="height: 728px; overflow-y: scroll;" :model="detailForm" label-width="150px">
                                <el-form-item label="基础样式选取">
                                    <app-radio turn v-model="detailForm.basic_style" :label="1">样式一</app-radio>
                                    <app-radio turn v-model="detailForm.basic_style" :label="2">样式二</app-radio>
                                </el-form-item>
                                <el-form-item label="背景颜色">
                                    <color v-model="detailForm.bg_color" height></color>
                                </el-form-item>
                                <el-form-item label="背景图片">
                                    <el-switch v-model="detailForm.has_bg" :active-value="1"
                                               :inactive-value="0"></el-switch>
                                </el-form-item>
                                <el-form-item label="上传背景" v-if="detailForm.has_bg == 1">
                                    <div flex="dir:left cross:center">
                                        <app-image-upload width="750" :height="detailForm.bg_style == 'top' ? 360 : 1624"
                                                          v-model="detailForm.bg_pic"></app-image-upload>
                                        <div style="margin-left:10px;color: #C0C4CC;">注：建议尽量选取较高清的图片，此外卡片将会遮盖部分区域哦</div>
                                    </div>
                                </el-form-item>
                                <el-form-item label="背景图片展示形式" v-if="detailForm.basic_style == 1 && detailForm.has_bg == 1">
                                    <app-radio turn v-model="detailForm.bg_style" label="top">顶部展示</app-radio>
                                    <app-radio turn v-model="detailForm.bg_style" label="all">全屏展示</app-radio>
                                </el-form-item>
                                <el-form-item label="信息卡片边距" v-if="detailForm.basic_style == 1">
                                    <div class="__mch-home-padding">
                                        <el-form-item label="上边框">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false" v-model="detailForm.card_top"
                                                           style="width: 100%" size="small"
                                                           :max="300"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                        <el-form-item label="左右边距">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false" v-model="detailForm.card_left_right"
                                                           style="width: 100%" size="small"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                        <el-form-item label="信息条间间距">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false" v-model="detailForm.card_padding"
                                                           style="width: 100%" size="small"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                    </div>
                                </el-form-item>
                                <el-form-item label="卡片边距" v-if="detailForm.basic_style == 2">
                                    <div class="__mch-home-padding">
                                        <el-form-item label="上边框">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false" v-model="detailForm.card_top"
                                                           style="width: 100%" size="small"
                                                           :max="300"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                        <el-form-item label="左右边距">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false" v-model="detailForm.card_left_right"
                                                           style="width: 100%" size="small"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                        <el-form-item label="卡片间距">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false" v-model="detailForm.card_padding"
                                                           style="width: 100%" size="small"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                    </div>
                                </el-form-item>
                                <el-form-item label="卡片圆角设置">
                                    <div flex="dir:left cross:center">
                                        <el-slider :show-tooltip="false" v-model="detailForm.card_radius"
                                                   style="width: 100%" size="small"
                                                   show-input></el-slider>
                                        <div style="margin-left: 5px">px</div>
                                    </div>
                                </el-form-item>
                                <el-form-item label="店铺名称文案颜色">
                                    <color v-model="detailForm.shop_title_color" height></color>
                                </el-form-item>
                                <el-form-item label="店铺名称字号设置">
                                    <div flex="dir:left cross:center">
                                        <el-slider :show-tooltip="false" v-model="detailForm.shop_logo_font"
                                                   style="width: 100%" size="small"
                                                   :max="50"
                                                   show-input></el-slider>
                                        <div style="margin-left: 5px">px</div>
                                    </div>
                                </el-form-item>
                                <el-form-item label="店铺logo大小">
                                    <div flex="dir:left cross:center">
                                        <el-slider :show-tooltip="false" v-model="detailForm.shop_logo_size"
                                                   style="width: 100%" size="small"
                                                   :max="200"
                                                   show-input></el-slider>
                                        <div style="margin-left: 5px">px</div>
                                    </div>
                                </el-form-item>
                                <el-form-item label="店铺logo圆角">
                                    <div flex="dir:left cross:center">
                                        <el-slider :show-tooltip="false" v-model="detailForm.shop_logo_radius"
                                                   style="width: 100%" size="small"
                                                   show-input></el-slider>
                                        <div style="margin-left: 5px">px</div>
                                    </div>
                                </el-form-item>
                                <el-form-item label="信息标题颜色">
                                    <color v-model="detailForm.info_title_color" height></color>
                                </el-form-item>
                                <el-form-item label="信息标题字号设置">
                                    <div flex="dir:left cross:center">
                                        <el-slider :show-tooltip="false" v-model="detailForm.info_title_font"
                                                   style="width: 100%" size="small"
                                                   :max="50"
                                                   show-input></el-slider>
                                        <div style="margin-left: 5px">px</div>
                                    </div>
                                </el-form-item>
                                <el-form-item label="信息内容颜色">
                                    <color v-model="detailForm.info_content_color" height></color>
                                </el-form-item>
                                <el-form-item label="信息内容字号设置">
                                    <div flex="dir:left cross:center">
                                        <el-slider :show-tooltip="false" v-model="detailForm.info_content_font"
                                                   style="width: 100%" size="small"
                                                   :max="50"
                                                   show-input></el-slider>
                                        <div style="margin-left: 5px">px</div>
                                    </div>
                                </el-form-item>
                                <el-form-item label="店铺联系电话">
                                    <el-switch v-model="detailForm.has_shop_phone" :active-value="1"
                                               :inactive-value="0"></el-switch>
                                </el-form-item>
                                <el-form-item label="联系客服">
                                    <el-switch v-model="detailForm.has_contact_customer" :active-value="1"
                                               :inactive-value="0"></el-switch>
                                </el-form-item>
                                <template v-if="detailForm.has_contact_customer == 1">
                                    <el-form-item label="客服按钮边距">
                                        <div class="__mch-home-padding">
                                            <el-form-item label="上边距">
                                                <div flex="dir:left cross:center">
                                                    <el-slider :show-tooltip="false" v-model="detailForm.customer_top"
                                                               style="width: 100%" size="small"
                                                               show-input></el-slider>
                                                    <div style="margin-left: 5px">px</div>
                                                </div>
                                            </el-form-item>
                                            <el-form-item label="左右边距">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false"
                                                           v-model="detailForm.customer_left_right"
                                                           style="width: 100%" size="small"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                        <el-form-item label="按钮高度">
                                            <div flex="dir:left cross:center">
                                                <el-slider :show-tooltip="false" v-model="detailForm.customer_height"
                                                           style="width: 100%" size="small"
                                                           show-input></el-slider>
                                                <div style="margin-left: 5px">px</div>
                                            </div>
                                        </el-form-item>
                                    </div>
                                </el-form-item>
                                    <el-form-item label="客服微信号">
                                        <el-switch v-model="detailForm.is_customer_wechat" :active-value="1"
                                                   :inactive-value="0"></el-switch>
                                    </el-form-item>
                                    <el-form-item label="提示语" v-if="detailForm.is_customer_wechat == 1">
                                        <el-input size="small" placeholder="例：复制微信号"
                                                  v-model="detailForm.customer_wechat_place"></el-input>
                                    </el-form-item>
                                    <el-form-item label="客服电话">
                                        <el-switch v-model="detailForm.is_customer_phone" :active-value="1"
                                                   :inactive-value="0"></el-switch>
                                    </el-form-item>
                                    <el-form-item label="提示语" v-if="detailForm.is_customer_phone == 1">
                                        <el-input size="small" placeholder="例：拨打电话"
                                                  v-model="detailForm.customer_phone_place"></el-input>
                                    </el-form-item>
                                    <el-form-item label="客服外链">
                                        <el-switch v-model="detailForm.is_web_service" :active-value="1"
                                                   :inactive-value="0"></el-switch>
                                    </el-form-item>
                                    <el-form-item label="提示语" v-if="detailForm.is_web_service == 1">
                                        <el-input size="small" placeholder="例：在线客服"
                                                  v-model="detailForm.web_server_place"></el-input>
                                    </el-form-item>
                                </template>
                            </el-form>
                        </el-card>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------>
        <el-dialog title="背景设置" :visible.sync="bgVisible">
            <el-form @submit.native.prevent label-width="100px">
                <diy-bg v-if="bgVisible" :data="bgSetting" :background="bgVisible" :hr="!bgVisible" @update="updateData"
                        @toggle="toggleData" @change="changeData"
                ></diy-bg>
            </el-form>
            <div slot="footer">
                <el-button size="small" @click="bgVisible = false">取消</el-button>
                <el-button size="small" @click="beSettingBg" type="primary">确定</el-button>
            </div>
        </el-dialog>
        <el-card class="bottom-menu" shadow="never">
            <div>
                <el-button size="small" @click="onSubmit" type="primary" :loading="submitLoading">保存</el-button>
            </div>
        </el-card>
    </div>
</div>
<script>
    const _appImg = "<?= $mchPathUrl ?>";
    let {log, warn, error, table} = console;
    const app = new Vue({
        el: '#app',

        data() {
            return {
                mch_default_data: {},
                detailForm: {
                    basic_style: 2,
                    bg_color: '#ff4544',
                    has_bg: 1,
                    bg_pic: 'http://dwz.date/eWrf',
                    card_top: 92,
                    card_left_right: 24,
                    card_padding: 24,
                    card_radius: 20,
                    bg_style: 'top',
                    shop_title_color: '#333333',
                    shop_logo_font: 40,
                    shop_logo_size: 108,
                    shop_logo_radius: 54,
                    info_title_color: '#333333',
                    info_title_font: 28,
                    info_content_color: '#999999',
                    info_content_font: 28,
                    has_shop_phone: 1,
                    has_contact_customer: 0,
                    customer_top: 20,
                    customer_left_right: 24,
                    customer_height: 80,
                    /////
                    is_customer_wechat: 0,
                    customer_wechat_place: '',
                    is_customer_phone: 0,
                    customer_phone_place: '',
                    is_web_service: 0,
                    web_server_place: '',
                },
                //////
                tabsActive: 'home',
                bgVisible: false,
                bg: {
                    showImg: false,
                    backgroundColor: '#ffffff',
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
                ///////////////////////////////////////////
                loading: false,
                allComponents: [],
                components: [],
                activeId: '',


                formVisible: false,
                formForm: [],
                id: null,
                maxLimit: 20,
                showShare: -1,
                submitLoading: false,
            };
        },
        computed: {
            floatStyle(){
                return {
                    share_bottom: 50,
                    share_right: 0,
                    is_open: 1,
                }
            },
            optionStyle() {
                return component => {
                    if (component.id === 'mch1-share') {
                        return {
                            width: '70px',
                            height: '70px',
                            float: 'right',
                            marginTop: '563px',
                            bottom: `${component.data ? component.data.share_bottom / 2 : 0}px`,
                            right: `${component.data ? component.data.share_right / 2 : 0}px`
                        }
                    }
                    return {}
                }
            },
            bgStyle() {
                let {
                    bg_color,
                    has_bg,
                    bg_pic,
                    bg_style,
                    basic_style,
                } = this.detailForm;
                let style = {
                    position: 'absolute',
                    top: 0,
                    width: '100%',
                    backgroundColor: bg_color,
                };
                if (has_bg == 1) {
                    Object.assign(style, {
                        backgroundImage: `url(${bg_pic})`,
                        backgroundRepeat: 'no-repeat',
                        backgroundSize: '100% 100%',
                    })
                }
                if (bg_style === 'top' || basic_style == 2 || has_bg == 0) {
                    Object.assign(style, {
                        height: '360px',
                        borderBottomRightRadius: '200rem 100px',
                        borderBottomLeftRadius: '200rem 100px',
                    })
                } else {
                    Object.assign(style, {minHeight: '1334px', height: 'inherit'})
                }
                return style;
            },

            logoStyle() {
                let {
                    shop_logo_size, shop_logo_radius, card_top
                } = this.detailForm;
                return {
                    height: `calc(${shop_logo_size}px + 6px)`,
                    width: `calc(${shop_logo_size}px + 6px)`,
                    borderRadius: `${shop_logo_radius}px`,
                    backgroundImage: `url(${this.mch_default_data.cover_url})`,
                    backgroundRepeat: 'no-repeat',
                    backgroundSize: '100% 100%',
                    border: '6px solid white',
                    zIndex: 3,
                    top: `${card_top}px`,
                    left: `calc(50% - ${shop_logo_size / 2}px - 3px)`
                }
            },
            boxStyle() {
                let {
                    card_left_right,
                    card_radius,
                    shop_logo_size,
                } = this.detailForm;
                return {
                    margin: `0 ${card_left_right}px`,
                    padding: `${shop_logo_size / 2 + 3}px 24px 0`,
                    background: 'white',
                    borderRadius: `${card_radius}px`,
                }
            },
            sLabelStyle() {
                return {
                    color: this.detailForm.info_title_color,
                    fontSize: `${this.detailForm.info_title_font}px`,
                    marginRight: '30px',
                    alignSelf: 'flex-start',
                    fontWeight: 'bold',
                }
            },
            sValueStyle() {
                return {
                    color: this.detailForm.info_content_color,
                    fontSize: `${this.detailForm.info_content_font}px`,
                }
            },
            btnStyle() {
                let {
                    customer_top,
                    customer_left_right,
                    customer_height,
                } = this.detailForm;
                return {
                    height: `${customer_height}px`,
                    margin: `${customer_top}px ${customer_left_right}px 0`,
                    background: 'linear-gradient(106deg, #FF7473 0%, #FF4544 100%)',
                    borderRadius: '40px',
                    color: 'white',
                    fontSize: '32px',
                }
            },
            /////////////////////////////////
        },
        created() {
            this.id = getQuery('id');
            this.loadData();
        },
        methods: {
            loadData() {
                this.loading = true;
                this.$request({
                    params: {
                        r: 'mall/mch/home',
                        id: this.id,
                    }
                }).then(response => {
                    this.loading = false;
                    if (response.data.code === 0) {
                        let {allComponents, data, is_share,default_data} = response.data.data;
                        this.mch_default_data = default_data.mch;
                        this.allComponents = allComponents;
                        this.showShare = is_share;
                        let components = data.home ? data.home : [];
                        this.detailForm = data.remake;
                        for (let i in components) {
                            components[i].active = false;
                            components[i].key = randomString();
                            if (components[i].id == 'background') {
                                this.bg = components[i].data;
                                this.bgSetting = this.bg;
                                this.position = this.bg.positionText;
                                this.repeat = this.bg.repeatText;
                            }
                        }

                        this.components = components;
                    }
                });
            },
            onSubmit() {
                let hasBackGround = false;
                let hasAppNavBar = false;

                for (let i in this.components) {
                    if (this.components[i].id === 'background') {
                        hasBackGround = true;
                        this.components[i].data = this.bg;
                    }
                }
                if (!hasBackGround) this.components.push({
                    id: 'background',
                    permission_key: '',
                    data: this.bg
                })
                const postComponents = [];
                for (let i in this.components) {
                    //需求要加的判断
                    postComponents.push({
                        id: this.components[i].id,
                        permission_key: this.components[i].permission_key,
                        data: this.components[i].data,
                    });
                }
                this.submitLoading = true;
                this.$request({
                    params: {
                        r: 'mall/mch/home',
                    },
                    method: 'post',
                    data: {
                        id: this.id,
                        data: JSON.stringify({home:postComponents,remake: this.detailForm}),
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

            formatColor(e) {
                if (e === 0) {
                    return '#078cff';
                } else if (e === 1) {
                    return '#2FD596';
                }
            },
            /////////////////////////////////////
            updateData(e) {
                this.bgSetting = e;
            },
            toggleData(e) {
                this.bgSetting.positionText = e;
            },
            changeData(e) {
                this.bgSetting.repeatText = e;
            },
            beSettingBg() {
                this.bg = JSON.parse(JSON.stringify(this.bgSetting));
                this.position = this.bgSetting.positionText;
                this.repeat = this.bgSetting.repeatText;
                this.bgVisible = false;
            },
            openBgSetting() {
                this.bgSetting = JSON.parse(JSON.stringify(this.bg));
                this.bgSetting.positionText = this.position;
                this.bgSetting.repeatText = this.repeat;
                this.bgVisible = true;
            },
            /////////////////////////////////////
            selectComponent(e) {
                if (this.components.length >= this.maxLimit) {
                    this.$message.error('最多添加' + this.maxLimit + '个组件');
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
                console.log(1111);
                this.components.splice(index, 1);
            },
            copyComponent(index) {
                if (this.components.length >= this.maxLimit) {
                    this.$message.error('最多添加' + this.maxLimit + '个组件');
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
            ////////////////////////////
        },
    });
</script>