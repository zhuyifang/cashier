<style>
    .diy-component-edit .diy-position .c-input-big {
        width: 64px;
        margin-right: 25px;
        margin-left: 5px;
    }
    .diy-component-edit .diy-position .label {
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        margin: 55px 35px 40px;
    }
    .diy-component-edit .diy-position .f-type-style {
        padding: 24px 28px;
        background: #fef0f0;
        border-radius: 10px;
        position: relative;
        margin-top: 12px;
        font-size: 14px;
        color: #FA706C;
        width: 370px;
    }

    .diy-component-edit .diy-position .f-type-style .el-icon-warning-outline {
        font-size: 30px;
        line-height: 1.3;
    }

    .diy-component-edit .diy-position .f-type-style .f-top {
        width: 19px;
        height: 12px;
        position: absolute;
        right: 35px;
        top: -12px;
    }
    .diy-component-edit .diy-position .el-form-item__label {
        padding-right: 50px;
    }
    .diy-component-edit .diy-position .color-input .el-form-item__label {
        padding-right: 12px;
    }
    .diy-component-edit .diy-position .color-input .el-form-item--small.el-form-item {
        margin-bottom: 0;
    }
    .diy-component-edit .diy-position .mode-choose {
        background-color: #F3F3F3;
        padding: 30px 8px 10px 0;
        border-radius: 13px;
        margin-bottom: 18px;
    }
    .diy-component-edit .diy-position .mode-choose .mode-choose-big {
        width: 81px;
        height: 26px;
        line-height: 26px;
        text-align: center;
        margin-right: 38px;
        color: #242424;
        border-radius: 3px;
        margin-top: 2px;
    }
    .diy-component-edit .diy-position .mode-choose .mode-choose-big.active {
        background-color: #409EFF;
        color: #FFFFFF;
    }
    .diy-component-edit .diy-position .mode-choose-small>div {
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
    .diy-component-edit .diy-position .mode-choose-small .style1 {
        margin-left: 0;
    }
    .diy-component-edit .diy-position .mode-choose-small .style1>.div {
        width: 57px;
        height: 3px;
        background-color: #D1E8FF;
        margin-top: 5px;
    }
    .diy-component-edit .diy-position .mode-choose-small .style1>.div:first-of-type {
        width: 33px;
        height: 10px;
        margin-top: 20px;
    }
    .diy-component-edit .diy-position .mode-choose-small .style2 .div {
        width: 57px;
        height: 9px;
        background-color: #D1E8FF;
        margin-top: 3px;
    }
    .diy-component-edit .diy-position .mode-choose-small .style2 .div:first-of-type {
        width: 23px;
        margin-top: 18px;
    }
    .diy-component-edit .diy-position .mode-choose-small .style3 .div {
        width: 56px;
        height: 18px;
        background-color: #D1E8FF;
        position: relative;
    }
    .diy-component-edit .diy-position .mode-choose-small .style3>.div>.div {
        width: 16px;
        height: 11px;
        background-color: #FFFFFF;
        position: absolute;
        left: 4px;
        top: 4px;
    }
    .diy-component-edit .diy-position .mode-choose-small>div.active {
        border-color: #409EFF;
        color: #409EFF;
    }
    .diy-component-edit .diy-position .mode-choose-small>div .text {
        position: absolute;
        bottom: 5px;
        height: 14px;
        line-height: 14px;
        left: 0;
        width: 100%;
        text-align: center;
    }
    .diy-component-edit .diy-position .el-form-item--small .el-form-item__content,.diy-component-edit .diy-position .el-form-item--small .el-form-item__label {
        line-height: 32px!important;
    }
    .diy-component-preview.diy-position .input-area .input-label {
        flex-shrink: 0;
        word-break: break-all;
        padding-left: 22px;
        font-size: 30px;
        margin-bottom: 10px;
    }
    .diy-component-preview.diy-position .input-area .input-label.inline {
        position: absolute;
        max-width: 160px;
        bottom: 20px;
        left: 0px;
        font-size: 30px;
        white-space: nowrap;
        z-index: 10;
        padding: 0 20px;
        margin-bottom: 0;
    }
    .diy-component-preview.diy-position .input-area .input-label.inline+.input-item .input {
        margin-top: 0;
    }
    .diy-component-preview.diy-position .input-area .input-label.inline+.input-item .palceholder {
        left: 71px;
        width: calc(100% - 71px);
    }
    .diy-component-preview.diy-position .input-area .input-label.inline>div {
        width: 100%;
    }
    .diy-component-preview.diy-position .input-area .input-label.inline div div {
        overflow: hidden;
        width: 100%;
    }
    .diy-component-preview.diy-position .input-area .input-label.inline div span {
        right: -16px;
    }
    .diy-component-preview.diy-position .input-area .input-label>div {
        position: relative;
        display: inline-block;
    }
    .diy-component-preview.diy-position .input-area .input-label div span {
        color: #FF4544;
        position: absolute;
        right: -18px;
        top: 0;
    }
    .diy-component-preview.diy-position .input-area .input-item {
        flex-wrap: wrap;
        position: relative;
    }
    .diy-component-preview.diy-position .input-area .input-item .input {
        border: 0;
        width: 100%;
        font-size: 14px;
        padding: 0 11px;
        height: 84px;
        line-height: 84px;
    }
    .diy-component-preview.diy-position .input-area .input-item .placeholder {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 10;
        white-space: nowrap;
        overflow: hidden;
        z-index: 10;
        height: 84px;
        line-height: 84px;
        font-size: 30px;
    }
    .diy-component-preview.diy-position .input-area .input-item .position-icon {
        position: absolute;
        right: 2px;
        bottom: 2px;
        width: 72px;
        height: 80px;
        padding: 20px 16px;
        z-index: 12;
    }
    .diy-component-preview.diy-position .input-area .input-item .position-icon img {
        width: 40px;
        height: 40px;
        display: block;
    }
</style>
<template id="f-position">
    <div>
        <div class="diy-component-preview diy-position">
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
                    <div :style="{'background-color': data.style == 1 ? data.bg_color : data.fill_color,'border-radius': data.radius + 'px'}" class="position-icon">
                        <img src="statics/img/mall/diy-position.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="diy-position">
                <div class="app-form-title">
                    <div>定位</div>
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
                    <el-form-item label="内容标题" required>
                        <el-input size="small" placeholder="请输入内容标题" v-model="data.title" maxlength="21" show-word-limit></el-input>
                    </el-form-item>
                    <el-form-item label="提示文字">
                        <el-input size="small" placeholder="请输入提示文字" v-model="data.placeholder"></el-input>
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
    Vue.component('f-position', {
        template: '#f-position',
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
                    placeholder: '请选择',
                    title: '',
                    style: 1,
                    height: 84,
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
                let style = `background-color:${this.data.bg_color ? this.data.bg_color : 'transparent'};width:100%;padding: 20px ${this.data.inputPadding}px;`;
                return style;
            },
            cTitleStyle() {
                let style = `color:${this.data.title_color};`;
                if(this.data.style == 3) {
                    style += `height:84px;line-height:84px;left:${+this.data.inputPadding}px;`
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
                    style += `padding-left: 71px;`
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
                    style += `padding: 0 74px 0 162px;text-align: right;`
                }else {
                    style += `padding:0 22px;`
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
