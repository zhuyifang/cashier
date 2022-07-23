<style>
    .diy-component-edit .diy-text .c-input-big {
        width: 64px;
        margin-right: 25px;
        margin-left: 5px;
    }
    .diy-component-edit .diy-text .label {
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        margin: 55px 35px 40px;
    }
    .diy-component-edit .diy-text .el-textarea .el-textarea__inner{
        resize: none;
    }
    .diy-component-edit .diy-text .el-form-item__label {
        padding-right: 50px;
    }
    .diy-component-edit .diy-text .color-input .el-form-item__label {
        padding-right: 12px;
    }
    .diy-component-edit .diy-text .color-input .el-form-item--small.el-form-item {
        margin-bottom: 0;
    }
    .diy-component-edit .diy-text .mode-choose-small>div {
        width: 98px;
        height: 70px;
        border: 2px solid #E5E7EC;
        border-radius: 3px;
        position: relative;
        margin-left: 28px;
        padding: 0 21px 9px;
        flex-wrap: wrap;
        align-content: center;
        background-color: #fff;
        color: #606266;
    }
    .diy-component-edit .diy-text .mode-choose-small .style1 {
        margin-left: 0;
    }
    .diy-component-edit .diy-text .mode-choose-small .style1>.div {
        width: 57px;
        height: 3px;
        background-color: #D1E8FF;
        margin-top: 5px;
    }
    .diy-component-edit .diy-text .mode-choose-small .style1>.div:first-of-type {
        width: 33px;
        height: 10px;
        margin-top: 20px;
    }
    .diy-component-edit .diy-text .mode-choose-small .style2 .div {
        width: 57px;
        height: 9px;
        background-color: #D1E8FF;
        margin-top: 3px;
    }
    .diy-component-edit .diy-text .mode-choose-small .style2 .div:first-of-type {
        width: 23px;
        margin-top: 18px;
    }
    .diy-component-edit .diy-text .mode-choose-small .style3 .div {
        width: 56px;
        height: 18px;
        background-color: #D1E8FF;
        position: relative;
    }
    .diy-component-edit .diy-text .mode-choose-small .style3>.div>.div {
        width: 16px;
        height: 11px;
        background-color: #FFFFFF;
        position: absolute;
        left: 4px;
        top: 4px;
    }
    .diy-component-edit .diy-text .mode-choose-small>div.active {
        border-color: #409EFF;
        color: #409EFF;
    }
    .diy-component-edit .diy-text .mode-choose-small>div .text {
        position: absolute;
        bottom: 5px;
        height: 14px;
        line-height: 14px;
        left: 0;
        width: 100%;
        text-align: center;
    }
    .diy-component-edit .diy-text .el-form-item--small .el-form-item__content,.diy-component-edit .diy-text .el-form-item--small .el-form-item__label {
        line-height: 32px!important;
    }
    .diy-component-preview.diy-text .input-area .input-label {
        flex-shrink: 0;
        word-break: break-all;
        padding: 0 22px;
        margin-bottom: 20px;
        font-size: 30px;
    }
    .diy-component-preview.diy-text .input-area .input-label div {
        position: relative;
        display: inline-block;
    }
    .diy-component-preview.diy-text .input-area .input-label div span {
        color: #FF4544;
        position: absolute;
        right: -18px;
        top: 0;
    }
    .diy-component-preview.diy-text .input-area .input-item {
        flex-wrap: wrap;
        position: relative;
        font-size: 30px;
    }
    .diy-component-preview.diy-text .input-area .input-item .input {
        border: 0;
        width: 100%;
        font-size: 30px;
        resize: none;
    }
    .diy-component-preview.diy-text .input-area .input-item .input .el-textarea__inner {
        border: 0;
        width: 100%;
        padding: 0;
        font-size: 30px;
        resize: none;
        border-radius: 0;
        height: 100%;
    }
    .diy-component-preview.diy-text .input-area .input-item .input.no-radius {
        border-bottom-left-radius: 0!important;
        border-bottom-right-radius: 0!important;
    }
    .diy-component-preview.diy-text .input-area .input-item .placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        /* white-space: nowrap; */
        overflow: hidden;
        z-index: 10;
        font-size: 30px;
        height: 100%;
    }
    .diy-component-preview.diy-text .input-item .input-label {
        padding-left: 0;
    }
    .diy-component-preview.diy-text .input-item .input-count {
        position: absolute;
        font-size: 24px;
        bottom: 20px;
        right: 20px;
    }
    .diy-component-edit .diy-text .required-icon .el-form-item__label:before {
        content: '*';
        color: #F56C6C;
        margin-right: 4px;
    }
</style>
<template id="f-text">
    <div>
        <div class="diy-component-preview diy-text">
            <div class="input-area" :style="cRadioStyle" flex="dir:top">
                <div class="input-label" :style="cTitleStyle" v-if="data.style != 3">
                    <div>{{data.title}}
                        <span v-if="data.is_required == 1 && data.title">*</span>
                    </div>
                </div>
                <div class="input-item" :style="itemStyle" flex="cross:center">
                    <div class="input-label" style="font-size: 30px;width: 100%" :style="cTitleStyle" v-if="data.style == 3">
                        <div>{{data.title}}
                            <span v-if="data.is_required == 1 && data.title">*</span>
                        </div>
                    </div>
                    <el-input ref="textarea" class="input" :class="{'no-radius': data.style == 1}" type="textarea" autosize :maxlength="data.max" :value="data.default ? data.default : data.placeholder" :style="inputStyle"></el-input>
                    <span class="input-count" v-if="data.default" :style="{'background-color' : data.style == 1 ? data.bg_color : data.fill_color,'color': data.placeholder_color}">{{data.default.length}}/{{data.max}}</span>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="diy-text">
                <div class="app-form-title">
                    <div>多行文本</div>
                </div>
                <el-form ref="form" :model="form" label-width="140px" size="small" style="padding: 20px 0">
                    <el-form-item label="字段属性">
                        <app-radio turn v-model="data.is_required" :label="1">必填</app-radio>
                        <app-radio turn v-model="data.is_required" :label="0">不必填</app-radio>
                    </el-form-item>
                    <el-form-item v-if="isFormGoods" label="是否显示">
                        <app-radio v-model="data.has_show" :label="1" turn>显示</app-radio>
                        <app-radio v-model="data.has_show" :label="0" turn>隐藏</app-radio>
                    </el-form-item>
                    <el-form-item label="内容标题" class="required-icon">
                        <el-input size="small" placeholder="请输入内容标题" v-model="data.title" :rows="3" type="textarea"></el-input>
                    </el-form-item>
                    <el-form-item label="提示文字">
                        <el-input size="small" placeholder="请输入提示文字" v-model="data.placeholder" maxlength="25"></el-input>
                    </el-form-item>
                    <el-form-item label="预填内容">
                        <el-input size="small" placeholder="请输入预填内容" @input="checkInput" v-model="data.default"></el-input>
                    </el-form-item>
                    <el-form-item label="只读属性" prop="is_disabled">
                        <el-switch v-model="data.is_disabled" :inactive-value="0"
                                   :active-value="1"></el-switch>
                    </el-form-item>
                    <el-form-item label="最少输入">
                        <div flex="dir:left">
                            <el-slider style="width: 50%;margin-right: 20px" input-size="mini"
                                       v-model="data.min"
                                       :max="data.max" :min="1"
                                       :show-tooltip="false"></el-slider>
                            <el-input-number @change="minChange" size="small" v-model="data.min" :min="1" :max="data.max" label="最少输入"></el-input-number>
                        </div>
                    </el-form-item>
                    <el-form-item label="最多输入">
                        <div flex="dir:left">
                            <el-slider style="width: 50%;margin-right: 20px" input-size="mini"
                                       v-model="data.max"
                                       :max="200" :min="data.min"
                                       :show-tooltip="false"></el-slider>
                            <el-input-number size="small" v-model="data.max" :min="data.min" :max="200" label="最多输入"></el-input-number>
                        </div>
                    </el-form-item>
                    <el-form-item label="样式">
                        <div flex="dir:left cross:center" class="mode-choose-small">
                            <div flex="dir:top cross:center" @click="changeStyle(1)" class="style1" :class="{'active' : data.style == 1}">
                                <div class="div"></div>
                                <div class="div"></div>
                                <div class="text">样式1</div>
                            </div>
                            <div flex="dir:top cross:center" @click="changeStyle(2)" class="style2" :class="{'active' : data.style == 2}">
                                <div class="div"></div>
                                <div class="div"></div>
                                <div class="text">样式2</div>
                            </div>
                            <div flex="main:center cross:center" @click="changeStyle(3)" class="style3" :class="{'active' : data.style == 3}">
                                <div class="div">
                                    <div class="div"></div>
                                </div>
                                <div class="text">样式3</div>
                            </div>
                        </div>
                    </el-form-item>
                    <el-form-item label="输入框高度" v-if="data.style != 1">
                        <el-slider :show-tooltip="false" v-model="data.height" style="float: left;width: 95%" :max="400" :min="data.style == 2 ? 44 : 76"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="输入框边距">
                        <el-slider :show-tooltip="false" v-model="data.inputPadding" style="float: left;width: 95%" :max="100"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="输入框圆角" v-if="data.style != 1">
                        <el-slider :show-tooltip="false" v-model="data.radius" style="float: left;width: 95%" :max="42"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>

                    <div class="app-form-box-label">
                        颜色设置
                    </div>

                    <el-form-item label="边框颜色" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <el-color-picker size="small"
                                                 v-model="data.border_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.border_color"></el-input>
                            </div>
                            <el-form-item label="标题颜色">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.title_color = '#545B60' : ''}"
                                                     size="small"
                                                     v-model="data.title_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.title_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="提示文本" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <el-color-picker @change="changePlaceholder"
                                                 size="small"
                                                 v-model="data.placeholder_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.placeholder_color"></el-input>
                            </div>
                            <el-form-item label="输入文本">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="changeText"
                                                     size="small"
                                                     v-model="data.text_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.text_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="背景颜色" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="changeBg"
                                                     size="small"
                                                     v-model="data.bg_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.bg_color"></el-input>
                                </div>
                            </div>
                            <el-form-item  label="填充颜色" v-if="data.style != 1">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="changeFill"
                                                     size="small"
                                                     v-model="data.fill_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.fill_color"></el-input>
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
    Vue.component('f-text', {
        template: '#f-text',
        props: {
            value: Object,
            isFormGoods: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {
                form: {},
                data: Object.assign({
                    is_required: 0,
                    title: '',
                    placeholder: '',
                    default: '',
                    mode: 1,
                    style: 1,
                    is_disabled: 0,
                    min: 0,
                    max: 30,
                    height: 100,
                    inputPadding: 24,
                    radius: 5,
                    title_color: '#545B60',
                    placeholder_color: '#BEC3C7',
                    text_color: '#242424',
                    border_color: '#E5E7EC',
                    fill_color: '#FFFFFF',
                    bg_color: '#FFFFFF',
                    key: new Date().getTime(),
                }, this.isFormGoods ? {has_show: 1} : {}),
            }
        },
        created() {
            if (!this.value) {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
                this.data.is_required = +this.data.is_required;
            }
            setTimeout(()=>{
                this.$refs.textarea.$refs.textarea.style.color = this.data.default ? this.data.text_color : this.data.placeholder_color;
                this.$refs.textarea.$refs.textarea.style.backgroundColor = this.data.fill_color;
            })
        },
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            }
        },
        computed: {
            cRadioStyle() {
                let style = `background-color:${this.data.bg_color ? this.data.bg_color : 'transparent'};width:100%;padding: 20px ${this.data.inputPadding}px;`;
                return style;
            },
            cTitleStyle() {
                let style = `color:${this.data.title_color};`;
                return style;
            },
            inputStyle() {
                let style = `color:${this.data.default ? this.data.text_color : this.data.placeholder_color};`;
                if(this.data.style != 3) {
                    if(this.data.style == 2) {
                        style += `background-color:${this.data.fill_color};border-radius:${this.data.radius}px;`
                        setTimeout(()=>{
                            this.$refs.textarea.$refs.textarea.style.backgroundColor = this.data.fill_color;
                        })
                    }else {
                        setTimeout(()=>{
                            this.$refs.textarea.$refs.textarea.style.backgroundColor = this.data.bg_color ? this.data.bg_color : 'transparent';
                        })
                    }
                    let border = `2px solid ${this.data.border_color ? this.data.border_color : this.data.bg_color }`;
                    if(this.data.style == 1) {
                        style += `border-bottom: ${border};padding: 12px 22px;`
                    }else {
                        style += `border: ${border};padding: 16px 20px;`
                    }
                }else {
                    style += `background-color:${this.data.fill_color};`
                    setTimeout(()=>{
                        this.$refs.textarea.$refs.textarea.style.backgroundColor = this.data.fill_color;
                    })
                }
                if(this.data.style != 1) {
                    style += `min-height:${this.data.style == 2 ? +this.data.height/2 +8 : this.data.height/2}px;`
                }
                return style;
            },
            itemStyle() {
                let style = ``;
                if(this.data.style == 3) {
                    style += `background-color:${this.data.fill_color};border-radius:${this.data.radius}px;padding: 24px 20px;`
                    if(this.data.border_color) {
                        style += `border: 1px solid ${this.data.border_color};`
                    }
                }
                return style;
            }
        },
        methods: {
            changeFill(row) {
                row == null ? this.data.fill_color = '#F1F5F7' : '';
                if(this.data.style != 1) {
                    this.$refs.textarea.$refs.textarea.style.backgroundColor = this.data.fill_color;
                }
            },
            changeBg(row) {
                row == null ? this.data.bg_color = '' : '';
                if(this.data.style == 1) {
                    this.$refs.textarea.$refs.textarea.style.backgroundColor = this.data.bg_color ? this.data.bg_color : 'transparent';
                }
            },
            checkInput(e) {
                this.$refs.textarea.$refs.textarea.style.color = this.data.default ? this.data.text_color : this.data.placeholder_color;
            },
            changeText(row) {
                row == null ? this.data.text_color = '#242424' : ''
                this.$refs.textarea.$refs.textarea.style.color = this.data.default ? this.data.text_color : this.data.placeholder_color;
            },
            changePlaceholder(row) {
                row == null ? this.data.text_color = '#BEC3C7' : ''
                this.$refs.textarea.$refs.textarea.style.color = this.data.default ? this.data.text_color : this.data.placeholder_color;
            },
            changeStyle(e) {
                this.data.style = e;
                if(e != 2 && this.data.min < 38) {
                    this.data.min == 38;
                }
                let text = this.data.default ? this.data.default : '';
                this.data.default =  '.'
                setTimeout(()=>{
                    this.data.default = text;
                })
            },
            minChange(e) {
                if(e > this.data.max) {
                    this.data.max = e;
                }
            }
        },
    });
</script>
