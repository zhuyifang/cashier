<style>
    .diy-component-edit .diy-input .c-input-big {
        width: 64px;
        margin-right: 25px;
        margin-left: 5px;
    }
    .diy-component-edit .diy-input .label {
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        margin: 55px 35px 40px;
    }

    .diy-component-edit .diy-input .f-type-style {
        padding: 24px 28px;
        background: #fef0f0;
        border-radius: 10px;
        position: relative;
        margin-top: 12px;
        font-size: 14px;
        color: #FA706C;
        width: 370px;
    }

    .diy-component-edit .diy-input .f-type-style .el-icon-warning-outline {
        font-size: 30px;
        line-height: 1.3;
    }

    .diy-component-edit .diy-input .f-type-style .f-top {
        width: 19px;
        height: 12px;
        position: absolute;
        right: 35px;
        top: -12px;
    }
    .diy-component-edit .diy-input .el-form-item__label {
        padding-right: 50px;
    }
    .diy-component-edit .diy-input .color-input .el-form-item__label {
        padding-right: 12px;
    }
    .diy-component-edit .diy-input .color-input .el-form-item--small.el-form-item {
        margin-bottom: 0;
    }
    .diy-component-edit .diy-input .mode-choose {
        background-color: #F3F3F3;
        padding: 30px 8px 10px 0;
        border-radius: 13px;
        margin-bottom: 18px;
    }
    .diy-component-edit .diy-input .mode-choose .mode-choose-big {
        width: 81px;
        height: 26px;
        line-height: 26px;
        text-align: center;
        margin-right: 38px;
        color: #242424;
        border-radius: 3px;
        margin-top: 2px;
    }
    .diy-component-edit .diy-input .mode-choose .mode-choose-big.active {
        color: #FFFFFF;
    }
    .diy-component-edit .diy-input .mode-choose-small>div {
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
    .diy-component-edit .diy-input .mode-choose-small .style1 {
        margin-left: 0;
    }
    .diy-component-edit .diy-input .mode-choose-small .style1>.div {
        width: 57px;
        height: 3px;
        background-color: #D1E8FF;
        margin-top: 5px;
    }
    .diy-component-edit .diy-input .mode-choose-small .style1>.div:first-of-type {
        width: 33px;
        height: 10px;
        margin-top: 20px;
    }
    .diy-component-edit .diy-input .mode-choose-small .style2 .div {
        width: 57px;
        height: 9px;
        background-color: #D1E8FF;
        margin-top: 3px;
    }
    .diy-component-edit .diy-input .mode-choose-small .style2 .div:first-of-type {
        width: 23px;
        margin-top: 18px;
    }
    .diy-component-edit .diy-input .mode-choose-small .style3 .div {
        width: 56px;
        height: 18px;
        background-color: #D1E8FF;
        position: relative;
    }
    .diy-component-edit .diy-input .mode-choose-small .style3>.div>.div {
        width: 16px;
        height: 11px;
        background-color: #FFFFFF;
        position: absolute;
        left: 4px;
        top: 4px;
    }
    .diy-component-edit .diy-input .mode-choose-small>div.active {
        border-color: #409EFF;
        color: #409EFF;
    }
    .diy-component-edit .diy-input .mode-choose-small>div .text {
        position: absolute;
        bottom: 5px;
        height: 14px;
        line-height: 14px;
        left: 0;
        width: 100%;
        text-align: center;
    }
    .diy-component-edit .diy-input .el-form-item--small .el-form-item__content,.diy-component-edit .diy-input .el-form-item--small .el-form-item__label {
        line-height: 32px!important;
    }
    .diy-component-preview.diy-input .input-area .input-label {
        flex-shrink: 0;
        word-break: break-all;
        padding: 0 22px;
        font-size: 30px;
        margin-bottom: 20px;
    }
    .diy-component-preview.diy-input .input-area .input-label.inline {
        position: absolute;
        max-width: 160px;
        bottom: 20px;
        white-space: nowrap;
        z-index: 10;
        padding: 0 20px;
        font-size: 30px;
        margin-bottom: 0;
        height: 84px;
        line-height: 84px;
    }
    .diy-component-preview.diy-input .input-area .input-label.inline+.input-item .input {
        margin-top: 0;
    }
    .diy-component-preview.diy-input .input-area .input-label.inline+.input-item .palceholder {
        left: 162px;
        width: calc(100% - 162px);
    }
    .diy-component-preview.diy-input .input-area .input-label.inline>div {
        width: 100%;
    }
    .diy-component-preview.diy-input .input-area .input-label.inline div div {
        overflow: hidden;
        width: 100%;
    }
    .diy-component-preview.diy-input .input-area .input-label.inline div span {
        right: -16px;
    }
    .diy-component-preview.diy-input .input-area .input-label>div {
        position: relative;
        display: inline-block;
    }
    .diy-component-preview.diy-input .input-area .input-label div span {
        color: #FF4544;
        position: absolute;
        right: -18px;
        top: 0;
    }
    .diy-component-preview.diy-input .input-area .input-item {
        flex-wrap: wrap;
        position: relative;
    }
    .diy-component-preview.diy-input .input-area .input-item .input {
        border: 0;
        width: 100%;
        font-size: 30px;
        padding: 0 22px;
        height: 84px;
        line-height: 80px;
    }
    .diy-component-preview.diy-input .input-area .input-item .placeholder {
        position: absolute;
        bottom: 0px;
        left: 0;
        width: 100%;
        overflow: hidden;
        z-index: 10;
        font-size: 30px;
        height: 84px;
        line-height: 84px;
        padding:0 22px;
    }
    .diy-component-edit .diy-input .required-icon .el-form-item__label:before {
        content: '*';
        color: #F56C6C;
        margin-right: 4px;
    }
</style>
<template id="f-input">
    <div>
        <div class="diy-component-preview diy-input">
            <div class="input-area" :style="cRadioStyle" flex="dir:top">
                <div class="input-label" :class="{'inline' : data.style == 3}" :style="cTitleStyle" >
                    <div>
                        <div>{{data.title}}</div>
                        <span v-if="data.is_required == 1 && data.title">*</span>
                    </div>
                </div>
                <div class="input-item" :style="itemStyle" flex="cross:center">
                    <div class="placeholder" :style="placeholderStyle" v-if="data.placeholder && !data.default">{{data.placeholder}}</div>
                    <input class="input" :value="data.default"  type="text" :style="inputStyle" readonly="readonly">
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="diy-input">
                <div class="app-form-title">
                    <div>单行文本</div>
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
                        <el-input size="small" placeholder="请输入内容标题" v-model="data.title" maxlength="21" show-word-limit></el-input>
                    </el-form-item>
                    <el-form-item label="提示文字">
                        <el-input size="small" placeholder="请输入提示文字" v-model="data.placeholder"></el-input>
                    </el-form-item>
                    <el-form-item label="预填内容">
                        <el-input size="small" placeholder="请输入预填内容" v-model="data.default"></el-input>
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
                    <el-form-item label="预设类型">
                        <app-radio turn v-model="data.mode" :label="1">普通</app-radio>
                        <app-radio turn v-model="data.mode" :label="2">手机号码</app-radio>
                        <app-radio turn v-model="data.mode" :label="3">邮箱</app-radio>
                        <app-radio turn v-model="data.mode" :label="4">身份证</app-radio>
                    </el-form-item>
                    <el-form-item v-if="data.mode == 1" label="允许输入">
                        <el-checkbox-group v-model="data.allow" :min="1">
                            <el-checkbox label="1">中文</el-checkbox>
                            <el-checkbox label="2">英文</el-checkbox>
                            <el-checkbox label="3">数字</el-checkbox>
                            <el-checkbox label="4">符号</el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>
                    <el-form-item label="样式">
                        <div flex="dir:left cross:center" class="mode-choose-small">
                            <div flex="dir:top cross:center" @click="data.style = 1" class="style1" :class="{'active' : data.style == 1}">
                                <div class="div"></div>
                                <div class="div"></div>
                                <div class="text">样式1</div>
                            </div>
                            <div flex="dir:top cross:center" @click="data.style = 2" class="style2" :class="{'active' : data.style == 2}">
                                <div class="div"></div>
                                <div class="div"></div>
                                <div class="text">样式2</div>
                            </div>
                            <div flex="main:center cross:center" @click="data.style = 3" class="style3" :class="{'active' : data.style == 3}">
                                <div class="div">
                                    <div class="div"></div>
                                </div>
                                <div class="text">样式3</div>
                            </div>
                        </div>
                        <div class="f-type-style" flex="dir:left cross:top" v-if="data.style == 3">
                            <i class="el-icon-warning-outline"></i>
                            <div style="margin-left: 7px;line-height: 1.3">该文本样式所显示字符数量有限，仅显示标题的前4个字符</div>
                            <el-image class="f-top"
                                       src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAGCAYAAAAhS6XkAAAA0ElEQVQoU4WQTW7CQAyFnyfggZmIVZEQW9bcgUvMMbhDzpErcLKKRVfxZEKwq2RBpRbK274ffTbhH1lKFXa7iFIYOWccDpmaRl9V6JlhACGlJTabGt4zmAlmilXu8QWhtr096/0Zm2m22zVUg6y0wsg/mWEw9bexLssO+33/m/IRnGnOZ8ZCIopncc69OsdUNTL3EOnQtiMBNmVpHjmdKhyPoXN5Hal2Mk7+Gy0GC727wznB9ZpxuShZkxifH7Ej8pGZBPJu5uEHBMy/JCoT5TcF5VTX7p2cFgAAAABJRU5ErkJggg=="
                            ></el-image>
                        </div>
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
                                <el-color-picker @change="(row) => {row == null ? data.placeholder_color = '#BEC3C7' : ''}"
                                                 size="small"
                                                 v-model="data.placeholder_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.placeholder_color"></el-input>
                            </div>
                            <el-form-item label="输入文本">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.text_color = '#242424' : ''}"
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
                                    <el-color-picker @change="(row) => {row == null ? data.bg_color = '' : ''}"
                                                     size="small"
                                                     v-model="data.bg_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.bg_color"></el-input>
                                </div>
                            </div>
                            <el-form-item  label="填充颜色" v-if="data.style != 1">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.fill_color = '#F1F5F7' : ''}"
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
    Vue.component('f-input', {
        template: '#f-input',
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
                    allow: ['1','2','3','4'],
                    mode: 1,
                    style: 1,
                    is_disabled: 0,
                    min: 0,
                    max: 30,
                    height: 80,
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
        computed: {
            cRadioStyle() {
                let style = `background-color:${this.data.bg_color ? this.data.bg_color : 'transparent'};width:100%;padding: ${this.data.style == 3 ? '20px' : '16px'} ${this.data.inputPadding}px 20px;`;
                return style;
            },
            cTitleStyle() {
                let style = `color:${this.data.title_color};`;
                if(this.data.style == 3) {
                    style += `left:${+this.data.inputPadding}px;`
                }
                return style;
            },
            inputStyle() {
                let style = `color:${this.data.text_color};`;
                if(this.data.style != 1) {
                    style += `background-color:${this.data.fill_color};border-radius:${this.data.radius}px;`
                }else {
                    style += `background-color:${this.data.bg_color ? this.data.bg_color : 'transparent'};`
                }
                if(this.data.style == 3) {
                    style += `padding-left: 162px;text-align:right;`
                }
                if(this.data.style == 1) {
                    style += `border-bottom: 2px solid ${this.data.border_color ? this.data.border_color : this.data.bg_color};`
                }else {
                    style += `border: 2px solid ${this.data.border_color ? this.data.border_color : this.data.bg_color};`
                }
                return style;
            },
            placeholderStyle() {
                let style = `color:${this.data.placeholder_color};`;
                if(this.data.style == 3) {
                    style += `padding-left: 162px;text-align: right;`
                }
                return style;
            },
            itemStyle() {
                let style = ``;
                if(this.data.style == 3) {
                    style += `height:84px;`
                }
                return style;
            }
        },
        created() {
            if (!this.value) {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
                this.data.is_required = +this.data.is_required;
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
            minChange(e) {
                if(e > this.data.max) {
                    this.data.max = e;
                }
            }
        },
    });
</script>
