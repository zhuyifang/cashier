<style>
    .diy-component-edit .diy-select .isFormGoods .el-form-item__label {
        width: 159px!important;
        padding-right: 25px!important;
    }
    .diy-component-edit .diy-select .isFormGoods .el-form-item__content {
        margin-left: 159px!important;
    }
    .diy-component-edit .diy-select .c-input-big {
        width: 66px;
        margin-right: 25px;
        margin-left: 5px;
    }
    .diy-component-edit .diy-select .label {
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        margin: 55px 35px 40px;
    }
    .diy-component-edit .diy-select .el-form-item__label {
        padding-right: 50px;
    }
    .diy-component-edit .diy-select .color-input .el-form-item__label {
        padding-right: 12px;
    }
    .diy-component-edit .diy-select .color-input .el-form-item--small.el-form-item {
        margin-bottom: 0;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-big {
        width: 81px;
        height: 26px;
        line-height: 26px;
        text-align: center;
        margin-right: 38px;
        color: #242424;
        border-radius: 3px;
        margin-top: 2px;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-big.active {
        background-color: #409EFF;
        color: #FFFFFF;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-small>div {
        width: 98px;
        height: 70px;
        border: 2px solid #E5E7EC;
        border-radius: 3px;
        position: relative;
        margin-top: 20px;
        margin-left: 28px;
        padding: 0 12px 9px;
        flex-wrap: wrap;
        align-content: center;
        background-color: #fff;
        color: #606266;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-small>div:first-of-type {
        margin-left: 0;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-small .matrix {
        padding: 0 30px 16px;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-small .img {
        padding: 0 0 16px;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-small>div.active {
        border-color: #409EFF;
        color: #409EFF;
    }
    .diy-component-edit .diy-select .mode-choose .classic .div {
        width: 18px;
        height: 6px;
        background-color: #d1e8ff;
        margin: 1.5px 2px;
    }
    .diy-component-edit .diy-select .mode-choose .mode-choose-small>div .text {
        position: absolute;
        bottom: 5px;
        height: 14px;
        line-height: 14px;
        left: 0;
        width: 100%;
        text-align: center;
    }
    .diy-component-edit .diy-select .mode-choose .matrix .div {
        width: 18px;
        height: 6px;
        background-color: #d1e8ff;
        margin: 2.5px 2px;
    }
    .diy-component-edit .diy-select .mode-choose .tag .div {
        width: 21px;
        height: 7px;
        border: 1px solid #d1e8ff;
        background-color: #d1e8ff;
        margin: 1.5px 2px;
    }
    .diy-component-edit .diy-select .mode-choose .tag .div.placeholder {
        background-color: #fff;
    }
    .diy-component-edit .diy-select .mode-choose .img .div {
        width: 20px;
        height: 20px;
        background-image: url('statics/img/mall/diy-img.png');
        background-size: 100%;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0 2.5px;
        border: 1px solid #4798EB;
    }
    .diy-component-edit .diy-select .mode-choose .img .div:nth-child(2) {
        border-color: #fff;
    }
    .diy-component-edit .diy-select .option-add {
        flex-wrap: wrap;
    }
    .diy-component-edit .diy-select .option-add>div {
        margin-bottom: 10px;
    }
    .diy-component-edit .diy-select .option-add .add {
        width: 59px;
        height: 30px;
        line-height: 28px;
        text-align: center;
        border-radius: 3px;
        border: 1px solid #409EFF;
        background-color: #fff;
        color: #409EFF;
        font-size: 14px;
    }
    .diy-component-edit .diy-select .add-option-img {
        width: 60px;
        height: 30px;
        color: #409EFF;
        line-height: 28px;
        text-align: center;
        border-radius: 3px;
        border: 1px solid #409EFF;
        background-color: #fff;
        font-size: 14px;
        margin-top: 15px;
    }
    .diy-component-edit .diy-select .option-add .el-input {
        width: 80px;
        margin-right: 12px;
    }
    .diy-component-edit .diy-select .option-add .inactive .el-input__inner {
        vertical-align: middle;
        text-align: center;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        line-height: 28px;
    }
    .diy-component-edit .diy-select .option-add .option-delete {
        position: absolute;
        top: -7px;
        right: 3px;
        height: 20px;
        width: 20px;
        z-index: 5;
    }
    .diy-component-edit .diy-select .option-add-img {
        margin-top: -20px;
    }
    .diy-component-edit .diy-select .option-add-img>div {
        margin-top: 20px;
        height: 60px;
    }
    .diy-component-edit .diy-select .option-add-img .option-img {
        width: 60px;
        height: 60px;
        margin-right: 10px;
        background-color: #fff;
        border-radius: 3px;
        border: 1px solid #E5E7EC;
        margin-right: 10px;
    }
    .diy-component-edit .diy-select .option-add-img .option-img .upload {
        width: 30px;
        height: 30px;
        margin: 15px;
    }
    .diy-component-edit .diy-select .option-add-img .option-img .option-delete {
        height: 30px;
        width: 30px;
    }
    .diy-component-edit .diy-select .option-delete {
        cursor: pointer;
    }
    .diy-component-edit .diy-select .option-delete.option-add-icon {
        margin-right: 10px;
    }
    .diy-component-edit .diy-select .form-goods-area {
        background-color: #F3F3F3;
        padding: 26px 20px;
        border-radius: 13px;
        min-width: 400px;
    }
    .diy-component-edit .diy-select .el-form-item--small .el-form-item__content,.diy-component-edit .diy-select .el-form-item--small .el-form-item__label {
        line-height: 32px!important;
    }
    .diy-component-preview.diy-select .radio-area {
        min-height: 80px;
    }
    .diy-component-preview.diy-select .radio-area .radio-label {
        flex-shrink: 0;
        word-break: break-all;
        font-size: 30px;
    }
    .diy-component-preview.diy-select .radio-area .radio-label div {
        position: relative;
        display: inline-block;
    }
    .diy-component-preview.diy-select .radio-area .radio-label div span {
        color: #FF4544;
        position: absolute;
        right: -18px;
        top: 0;
    }
    .diy-component-preview.diy-select .radio-area .radio-option {
        flex-wrap: wrap;
    }
    .diy-component-preview.diy-select .radio-area .radio-option .el-radio__inner {
        vertical-align: middle;
    }
    .diy-component-preview.diy-select .radio-area .radio-option .el-checkbox {
        outline: none;
        font-size: 30px;
    }
    .diy-component-preview.diy-select .radio-area .radio-option .el-checkbox.line {
        height: 84px;
        line-height: 84px;
    }
    .diy-component-preview.diy-select .radio-area .el-checkbox.position {
        position: absolute;
        top: 14px;
        left: 18px;
    }
    .diy-component-preview.diy-select .radio-area .radio-option .el-checkbox .el-checkbox__input {
        line-height: normal;
    }
    .diy-component-preview.diy-select .radio-area .radio-option .el-checkbox:last-of-type {
        margin-right: 0!important;
    }
    .diy-component-preview.diy-select .radio-area .radio-option .el-checkbox__label {
        font-size: 30px;
        vertical-align: middle;
    }
    .diy-component-preview.diy-select .radio-area .radio-option .el-checkbox__label.matrix {
        width: 650px;
        display: inline-block;
        margin-left: 20px;
        height: 84px;
        line-height: 84px;
        padding-left: 20px;
    }
    .diy-component-preview.diy-select .radio-area .checkbox-img {
        width: 20px;
        height: 20px;
    }
    .diy-component-preview.diy-select .radio-area .el-checkbox__inner {
        width: 28px;
        height: 28px;
    }
    .diy-component-preview.diy-select .radio-area .el-checkbox__inner::after {
        display: none;
    }
    .diy-component-preview.diy-select .radio-area .tag-radio-option .tag-item {
        padding: 0 60px;
        height: 84px;
        line-height: 84px;
        font-size: 30px;
    }
    .diy-component-preview.diy-select .radio-area .tag-radio-option .img-item {
        position: relative;
    }
    .diy-component-preview.diy-select .radio-area .tag-radio-option {
        flex-wrap: wrap;
    }
    .diy-component-preview.diy-select .radio-area .tag-radio-option .option-top-img {
        border: 2px solid;
    }
    .diy-component-preview.diy-select .radio-area .tag-radio-option .option-top-img+div {
        text-align: center;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        margin-top: 8px;
    }
    .diy-component-edit .diy-select .required-icon .el-form-item__label:before {
        content: '*';
        color: #F56C6C;
        margin-right: 4px;
    }
    .diy-component-edit .diy-select input::-webkit-outer-spin-button,
    .diy-component-edit .diy-select input::-webkit-inner-spin-button {
      -webkit-appearance: none;
    }
    .diy-component-edit .diy-select input[type="number"]{
      -moz-appearance: textfield;
    }
    .diy-component-edit .diy-select .isFormGoods .input-number-limit .el-input__inner {
        border-right: 0;
    }
    .diy-component-edit .diy-select .isFormGoods .input-number-limit .el-input-group__append {
        background-color: #fff;
    }
    .diy-component-edit .diy-select .isFormGoods .el-input__inner:focus+.el-input-group__append{
        border-color:#409EFF;
    }
    .diy-component-edit .diy-select .isFormGoods .el-input:hover .el-input-group__append{
        border-color:#C0C4CC;
    }
    .diy-component-edit .diy-select .isFormGoods .el-input:hover .el-input__inner:focus+.el-input-group__append{
        border-color:#409EFF;
    }
    .diy-component-edit .diy-select .isFormGoods .el-input {
        height: 32px!important;
    }
    .diy-component-edit .diy-select .isFormGoods .el-input input {
        height: 100%!important;
    }
</style>
<template id="f-select">
    <div>
        <div class="diy-component-preview diy-select">
            <div class="radio-area" :style="cRadioStyle" flex="dir:top">
                <div class="radio-label" :style="cTitleStyle" :flex="data.mode == 2 ? 'cross:center' : ''">
                    <div>{{data.title}}
                        <span v-if="data.is_required == 1 && data.title">*</span>
                    </div>
                </div>
                <!-- 传统和矩阵单选框选项 -->
                <div class="radio-option" v-if="data.mode < 3" flex="dir:left cross:center" :style="{'margin-top': -data.marginBottom + 'px'}">
                    <div v-if="data.list.length > 0" role="checkboxgroup" class="el-checkbox-group">
                        <label @click="toggleChoose(item)" role="checkbox" aria-checked="true" tabindex="0" class="el-checkbox" :class="{'line' : data.mode == 1}" v-for="(item,index) in list" v-if="item.label" :style="{'margin': data.marginBottom + 'px ' + data.inputPadding + 'px' + ' 0 0'}" :class="{'is-checked' : item.is_choose}">
                            <span class="el-checkbox__input" :class="{'is-checked' : item.is_choose}">
                                <span class="el-checkbox__inner" flex="main:center cross:center" :style="{'border-color': item.is_choose ? data.active_color : data.inactive_color,'background-color': item.is_choose ? data.active_color : data.inactive_color}">
                                    <img v-if="item.is_choose" class="checkbox-img" src="statics/img/mall/diy-form-select.png" alt="">
                                </span>
                            </span>
                            <span v-if="data.mode == 1" class="el-checkbox__label" :style="{'color': data.text_color}">{{item.label}}</span>
                            <span v-if="data.mode == 2" class="el-checkbox__label matrix" :style="{'color': data.text_color,'border-radius': data.radius + 'px','background': data.fill_color, 'width': 650 - data.margin + 'px'}">{{item.label}}</span>
                        </label>
                    </div>
                </div>
                <!-- 标签单选框选项 -->
                <div v-else class="tag-radio-option" flex="dir:left" :style="{'margin-top': -data.marginBottom + 16 + 'px','margin-left': -data.inputPadding + 'px'}">
                    <div @click="toggleChoose(item)" v-if="data.mode == 3" :style="{'background': item.is_choose ? data.active_color : data.inactive_color,'color': item.is_choose ? data.active_text_color : data.text_color,'border-radius': data.radius + 'px','margin': data.marginBottom + 'px' + ' 0 0 ' + data.inputPadding + 'px'}" class="tag-item" v-for="(item,index) in list" :key="index">{{item.label}}</div>
                    <div @click="toggleChoose(item)" v-if="data.mode == 4" :style="{'color': data.text_color,'margin': data.marginBottom + 'px' + ' 0 0 ' + data.inputPadding + 'px'}" flex="dir:top main:center" class="img-item" v-for="(item,index) in list" :key="index">
                        <label v-if="item.is_choose" role="checkbox" aria-checked="true" tabindex="0" class="el-checkbox is-checked position">
                            <span class="el-checkbox__input is-checked">
                                <span class="el-checkbox__inner" flex="main:center cross:center" :style="{'border-color': data.active_color,'background': data.active_color}">
                                    <img class="checkbox-img" src="statics/img/mall/diy-form-select.png" alt="">
                                </span>
                            </span>
                        </label>
                        <img class="option-top-img" :style="{'height': data.height + 'px','width': data.height + 'px', 'border-radius': data.radius + 'px','border-color': item.is_choose ? data.active_color : data.inactive_color}" :src="item.img ? item.img : 'statics/img/mall/default_img.png'" alt="">
                        <div :style="{'width': data.height + 'px'}">{{item.label}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="diy-select">
                <div class="app-form-title">
                    <div>复选框</div>
                </div>
                <el-form ref="form" :model="form" :class="isFormGoods ? 'isFormGoods' : ''" label-width="140px" size="small" style="padding: 20px 0">
                    <el-form-item label="字段属性">
                        <app-radio turn v-model="data.is_required" :label="1">必填</app-radio>
                        <app-radio turn v-model="data.is_required" :label="0">不必填</app-radio>
                    </el-form-item>
                    <el-form-item v-if="isFormGoods" label="是否显示">
                        <app-radio v-model="data.has_show" :label="1" turn>显示</app-radio>
                        <app-radio v-model="data.has_show" :label="0" turn>隐藏</app-radio>
                    </el-form-item>
                    <el-form-item label="内容标题" required>
                        <el-input size="small" placeholder="请输入内容标题" v-model="data.title" maxlength="21" show-word-limit></el-input>
                    </el-form-item>
                    <el-form-item label="最少选择" v-if="!isFormGoods">
                        <el-input-number @change="minChange" :step="1" step-strictly size="small" v-model="data.min" :min="1" :max="data.max" label="最少选择"></el-input-number>
                    </el-form-item>
                    <el-form-item label="最多选择" v-if="!isFormGoods">
                        <el-input-number size="small" :step="1" step-strictly v-model="data.max" :min="data.min" :max="data.list ?data.list.length : 1" label="最多选择"></el-input-number>
                    </el-form-item>
                    <div class="mode-choose">
                        <el-form-item label="模式">
                            <div>
                                <app-radio turn v-model="is_img" :label="false" @change="data.mode = data.mode == 4 ? 1 : data.mode">默认模式</app-radio>
                                <app-radio turn v-model="is_img" :label="true" @change="changeMode(4)">图文模式</app-radio>
                            </div>
                            <div flex="dir:left cross:center" class="mode-choose-small">
                                <div v-if="data.mode != 4" flex="main:center cross:center" @click="changeMode(1)" class="classic" :class="{'active' : data.mode == 1}">
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="text">传统</div>
                                </div>
                                <div v-if="data.mode != 4" flex="main:center cross:center" @click="changeMode(2)" class="matrix" :class="{'active' : data.mode == 2}">
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="text">矩阵</div>
                                </div>
                                <div v-if="data.mode != 4" flex="main:center cross:center" @click="changeMode(3)" class="tag" :class="{'active' : data.mode == 3}">
                                    <div class="div"></div>
                                    <div class="div placeholder"></div>
                                    <div class="div placeholder"></div>
                                    <div class="div"></div>
                                    <div class="text">标签</div>
                                </div>
                                <div v-if="data.mode == 4" flex="main:center cross:center" @click="changeMode(4)" class="img" :class="{'active' : data.mode == 4}">
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="div"></div>
                                    <div class="text">图文</div>
                                </div>
                            </div>
                        </el-form-item>
                        <el-form-item v-if="isFormGoods" class="required-icon input-number-limit" label="">
                            <label slot="label">未选中变量值
                                <el-tooltip class="item" effect="dark"
                                            content="用户未选中的状态才会显示该值"
                                            placement="top">
                                    <i class="el-icon-info"></i>
                                </el-tooltip>
                            </label>
                            <el-input @mousewheel.native.prevent type="number" @input="changeValue" :min="0" show-word-limit size="small" placeholder="数字类型，最多两位小数" v-model="data.default_var">
                                <template slot="append">
                                <span class="el-input__suffix">
                                    <span class="el-input__suffix-inner">
                                        <span class="el-input__count">
                                            <span class="el-input__count-inner">
                                            {{data.default_var.length}}/12
                                          </span>
                                      </span>
                                  </span>
                                </span>
                                </template>
                            </el-input>
                        </el-form-item>
                        <el-form-item label="添加选项" v-if="isFormGoods">
                            <div class="form-goods-area">
                                <div v-for="(item,index) in data.list" :key="index" style="position: relative;">
                                    <el-form-item label="默认选中">
                                        <el-switch v-model="item.default" :inactive-value="0"
                                           :active-value="1"></el-switch>
                                    </el-form-item>
                                    <el-form-item class="required-icon" :label="'选项' + (index+1)">
                                        <div flex="dir:left cross:center">
                                            <div v-if="data.mode == 4" style="margin-right: 8px;">
                                                <app-image-upload size="60" width="320" height="320" v-model="item.img"></app-image-upload>
                                            </div>
                                            <el-input :maxlength="data.mode == 2 ? 16 : 7" show-word-limit size="small" placeholder="请输入选项名称" v-model="item.label"></el-input>
                                        </div>
                                    </el-form-item>
                                    <el-form-item class="required-icon input-number-limit" label="变量值">
                                        <el-input @mousewheel.native.prevent type="number" @input="changeArrayValue($event,index)" :min="0" show-word-limit size="small" placeholder="数字类型，最多两位小数" v-model="item.var">
                                            <template slot="append">
                                                <span class="el-input__suffix">
                                                    <span class="el-input__suffix-inner">
                                                        <span class="el-input__count">
                                                            <span class="el-input__count-inner">
                                                            {{item.var.length}}/12
                                                          </span>
                                                      </span>
                                                  </span>
                                                </span>
                                            </template>
                                        </el-input>
                                    </el-form-item>
                                    <div flex="dir:right">
                                        <img v-if="data.list.length > 1" @click="closeOption(index)" class="option-delete" src="statics/img/mall/diy-form-delete.png" alt="">
                                        <img v-if="index == data.list.length - 1" @click="addOption" class="option-delete option-add-icon" src="statics/img/mall/diy-form-add.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </el-form-item>
                        <el-form-item label="添加选项" v-else>
                            <label v-if="data.mode == 4" slot="label">
                                <div style="height: 60px;line-height: 60px;">添加选项:</div>
                            </label>
                            <div v-if="data.mode < 4" flex="dir:left cross:center" class="option-add">
                                <div v-for="(item,index) in data.list" :key="index" style="position: relative;">
                                    <img class="option-delete" src="statics/img/mall/option-close.png" @click="closeOption(index)" v-if="!item.active" alt="">
                                    <div class="el-input el-input--small inactive" v-show="!item.active" @click="toggle(index)"><div class="el-input__inner">{{item.label}}</div></div>
                                    <el-input :maxlength="data.mode == 2 ? 16 : 7" :autofocus="item.active" :ref="'option'+index" v-show="item.active" size="small" @blur="item.active = false" v-model="item.label"></el-input>
                                </div>
                                <div class="add" @click.stop="addOption">添加</div>
                            </div>
                            <div v-if="data.mode == 4 && data.list && data.list.length > 0" flex="dir:top" class="option-add-img">
                                <div v-for="(item,index) in data.list" :key="index" flex="dir:left cross:center">
                                    <app-image-upload size="60" width="320" height="320" v-model="item.img"></app-image-upload>
                                    <el-input size="small" style="width: 60%;margin: 0 10px;" maxlength="7" show-word-limit v-model="item.label"></el-input>
                                    <img @click="closeOption(index)" class="option-delete" src="statics/img/mall/diy-form-delete.png" alt="">
                                </div>
                            </div>
                            <div v-if="data.mode == 4" class="add-option-img" @click.stop="addOption">添加</div>
                        </el-form-item>
                    </div>
                    <el-form-item label="最少选择" v-if="isFormGoods">
                        <el-input-number @change="minChange" :step="1" step-strictly size="small" v-model="data.min" :min="1" :max="data.max" label="最少选择"></el-input-number>
                    </el-form-item>
                    <el-form-item label="最多选择" v-if="isFormGoods">
                        <el-input-number size="small" :step="1" step-strictly v-model="data.max" :min="data.min" :max="data.list ?data.list.length : 1" label="最多选择"></el-input-number>
                    </el-form-item>
                    <el-form-item label="图片高度" v-if="data.mode == 4">
                        <el-slider :show-tooltip="false" v-model="data.height" style="float: left;width: 95%" :max="320" :min="64" show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item :label="data.mode == 4 ? '图片边距' : '选框边距'" v-if="data.mode != 2">
                        <el-slider :show-tooltip="false" v-model="data.inputPadding" style="float: left;width: 95%" :max="100"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="选框间距">
                        <el-slider :show-tooltip="false" v-model="data.marginBottom" style="float: left;width: 95%" :max="100"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item :label="data.mode == 4 ? '图片圆角' : '选框圆角'" v-if="data.mode != 1">
                        <el-slider :show-tooltip="false" v-model="data.radius" style="float: left;width: 95%" :max="data.mode == 4 ? data.height/2 : 42"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="组件边距">
                        <el-slider :show-tooltip="false" v-model="data.margin" style="float: left;width: 95%" :max="100"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>

                    <div class="app-form-box-label">
                        颜色设置
                    </div>
                    <el-form-item label="标题颜色" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <el-color-picker @change="(row) => {row == null ? data.title_color = '#242424' : ''}"
                                                 size="small"
                                                 v-model="data.title_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.title_color"></el-input>
                            </div>
                            <el-form-item :label="data.mode == 4 ? '未选边框' : '未选颜色'">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.inactive_color = '#E5E7EC' : ''}"
                                                     size="small"
                                                     v-model="data.inactive_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.inactive_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item :label="data.mode == 4 ? '已选边框' : '已选颜色'" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <el-color-picker @change="(row) => {row == null ? data.active_color = '#FF4544' : ''}"
                                                 size="small"
                                                 v-model="data.active_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.active_color"></el-input>
                            </div>
                            <el-form-item label="背景颜色">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.bg_color = '' : ''}"
                                                     size="small"
                                                     v-model="data.bg_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.bg_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item :label="data.mode == 3 ? '未选文本' : '文本颜色'" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.text_color = '#242424' : ''}"
                                                     size="small"
                                                     v-model="data.text_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.text_color"></el-input>
                                </div>
                            </div>
                            <el-form-item v-if="data.mode == 2" label="填充颜色">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.fill_color = '#F1F5F7' : ''}"
                                                     size="small"
                                                     v-model="data.fill_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.fill_color"></el-input>
                                </div>
                            </el-form-item>
                            <el-form-item v-if="data.mode == 3" label="已选文本">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.active_text_color = '#FFFFFF' : ''}"
                                                     size="small"
                                                     v-model="data.active_text_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.active_text_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component('f-select', {
        template: '#f-select',
        props: {
            value: Object,
            isFormGoods: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {
                is_img: false,
                form: {},
                data: Object.assign({
                    is_required: 0,
                    title: '',
                    mode: 1,
                    min: 1,
                    max: 1,
                    list: [],
                    height: 84,
                    inputPadding: 24,
                    margin: 24,
                    marginBottom: 0,
                    radius: 10,
                    title_color: '#242424',
                    text_color: '#242424',
                    active_color: '#FF4544',
                    fill_color: '#F1F5F7',
                    inactive_color: '#E5E7EC',
                    active_text_color: '#FFFFFF',
                    bg_color: '#FFFFFF',
                    key: new Date().getTime(),
                }, this.isFormGoods ? {has_show: 1, default_var: ''} : {}),
            }
        },
        computed: {
            list() {
                let list = JSON.parse(JSON.stringify(this.data.list));
                for(let item of list) {
                    item.is_choose = item.is_choose ? item.is_choose : false;
                }
                return list
            },
            cRadioStyle() {
                let style = `background-color:${this.data.bg_color ? this.data.bg_color : 'transparent'};width:100%;`;
                if (this.data.mode === 1) {
                    style += `padding: 20px ${this.data.margin}px;`;
                }else if (this.data.mode === 2) {
                    style += `padding: 20px ${this.data.margin}px 30px;`;
                }else {
                    style += `padding: 24px ${this.data.margin}px 32px;`;
                }
                return style;
            },
            cTitleStyle() {
                let style = `color:${this.data.title_color};`;
                if(this.data.mode < 3) {
                    style += `margin-bottom: 24px;`
                }
                return style;
            },
            activeRadio() {
                return [this.data.list[0].label]
            }
        },
        created() {
            if (!this.value) {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
                this.data.is_required = +this.data.is_required;
                this.is_img = this.data.mode == 4
            }
            if(this.isFormGoods && this.data.list.length == 0) {
                this.addOption();
            }
        },
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            }
        },
        methods: {
            changeValue(e) {
                e = e.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');
                e = e.slice(0,12);
                this.data.default_var = e;
            },
            changeArrayValue(e,index) {
                e = e.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');
                e = e.slice(0,12);
                this.data.list[index].var = e;
            },
            changeMode(e) {
                this.data.mode = e;
                let itemLength = 6;
                if(e == 2) {
                    itemLength = 17;
                }
                if(e == 4) {
                    itemLength = 7;
                }
                for(let item of this.data.list) {
                    item.label = item.label.substring(0,itemLength);
                }
                if(e == 2 || e == 3) {
                    this.data.marginBottom = this.data.marginBottom > 0 ? this.data.marginBottom : 24;
                }
            },
            toggleChoose(item) {
                item.is_choose = !item.is_choose;
                console.log(item.is_choose)
                this.$forceUpdate();
            },
            minChange(e) {
                if(e > this.data.max) {
                    this.data.max = e;
                }
            },
            toggle(index) {
                let ref = 'option' + index;
                this.data.list[index].active = true;
                this.$nextTick(()=>{
                    this.$refs[ref][0].focus();
                })
            },
            closeOption(index) {
                this.data.list.splice(index,1)
            },
            addOption() {
                if(this.isFormGoods) {
                    let text = {label: '',var: '',img: '',value: false, default: false};
                    this.data.list.push(text);
                }else {
                    for(let item of this.data.list) {
                        item.active = false;
                    }
                    let text = {label: '',active: true,img: '',value: false};
                    this.data.list.push(text);
                    let ref = 'option' + (this.data.list.length -1);
                    this.$nextTick(()=>{
                        this.$refs[ref][0].focus();
                    })
                }
            }
        },
    });
</script>
