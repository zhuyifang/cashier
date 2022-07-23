<style>
    .diy-component-edit .diy-switch .c-input-big {
        width: 64px;
        margin-right: 25px;
        margin-left: 5px;
    }
    .diy-component-edit .diy-switch .label {
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        margin: 55px 35px 40px;
    }
    .diy-component-edit .diy-switch .el-form-item__label {
        padding-right: 50px;
    }
    .diy-component-edit .diy-switch .color-input .el-form-item__label {
        padding-right: 12px;
    }
    .diy-component-edit .diy-switch .color-input .el-form-item--small.el-form-item {
        margin-bottom: 0;
    }
    .diy-component-edit .diy-switch .el-form-item--small .el-form-item__content,.diy-component-edit .diy-switch .el-form-item--small .el-form-item__label {
        line-height: 32px!important;
    }
    .diy-component-preview.diy-switch .switch-area {
        height: 82px;
    }
    .diy-component-preview.diy-switch .switch-area .input-label {
        flex-shrink: 0;
        word-break: break-all;
        font-size: 30px;
    }
    .diy-component-preview.diy-switch .switch-area .input-label>div {
        position: relative;
        display: inline-block;
    }
    .diy-component-preview.diy-switch .switch-area .input-label>div span {
        color: #FF4544;
        position: absolute;
        right: -18px;
        top: 0;
    }
    .diy-component-preview.diy-switch .switch-area .el-switch {
        zoom:  2;
    }
    .diy-component-preview.diy-switch .switch-area .el-switch .el-switch__core {
        height: 20px;
    }
    .diy-component-preview.diy-switch .switch-area .el-switch .el-switch__core:after {
        width: 13px;
        height: 13px;
        top: 2px;
        left: 2px;
    }
    .diy-component-preview.diy-switch .switch-area .el-switch.is-checked .el-switch__core::after {
        left: 100%;
    }
    .switch-dialog {
        width: 100%;
        text-align: center;
        font-size: 30px;
    }
    .switch-dialog>div {
        padding: 2% 10%;
        overflow: hidden;
    }
</style>
<template id="f-switch">
    <div>
        <div class="diy-component-preview diy-switch">
            <div class="switch-area" :style="cRadioStyle" flex="main:justify cross:center">
                <div class="input-label" flex="cross:center" :style="cTitleStyle">
                    <div>
                        <div>{{data.title}}</div>
                        <span v-if="data.is_required == 1 && data.title">*</span>
                    </div>
                </div>
                <el-switch v-model="is_open" :active-color="data.open_color" :inactive-color="data.close_color"></el-switch>
            </div>
            <div class="switch-dialog" :style="{'padding': '18px '+ data.inputPadding +'px'}">
                <div :style="cDialogStyle" flex="main:center cross:center">{{is_open ? data.open_text : data.close_text}}</div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="diy-switch">
                <div class="app-form-title">
                    <div>开关</div>
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
                        <el-input size="small" v-model="data.title" maxlength="15" placeholder="请输入内容标题" show-word-limit></el-input>
                    </el-form-item>
                    <el-form-item label="初始状态" prop="default">
                        <el-switch v-model="data.default" @change="changeValue" :inactive-value="0"
                                   :active-value="1"></el-switch>
                    </el-form-item>
                    <el-form-item label="开启提示">
                        <el-input size="small" maxlength="130"
                                  show-word-limit v-model="data.open_text" placeholder="请输入开启提示"></el-input>
                    </el-form-item>
                    <el-form-item label="关闭提示" >
                        <el-input size="small" maxlength="130"
                                  show-word-limit v-model="data.close_text" placeholder="请输入关闭提示"></el-input>
                    </el-form-item>
                    <el-form-item label="弹窗高度">
                        <el-slider :show-tooltip="false" v-model="data.height" style="float: left;width: 95%" :max="380" :min="32"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="弹窗边距">
                        <el-slider :show-tooltip="false" v-model="data.inputPadding" style="float: left;width: 95%" :max="375"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="弹窗圆角">
                        <el-slider :show-tooltip="false" v-model="data.radius" style="float: left;width: 95%" :max="42"
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

                    <el-form-item label="开启按钮" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <el-color-picker @change="(row) => {row == null ? data.open_color = '#4798EB' : ''}"
                                                 size="small"
                                                 v-model="data.open_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.open_color"></el-input>
                            </div>
                            <el-form-item label="关闭按钮">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.close_color = '#C8C8C8' : ''}"
                                                     size="small"
                                                     v-model="data.close_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.close_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="标题文字" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <el-color-picker @change="(row) => {row == null ? data.title_color = '#545B60' : ''}"
                                                 size="small"
                                                 v-model="data.title_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.title_color"></el-input>
                            </div>
                            <el-form-item label="提示文字">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.tips_color = '#FFFFFF' : ''}"
                                                     size="small"
                                                     v-model="data.tips_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.tips_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="提示背景" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.fill_color = '#99A1AA' : ''}"
                                                     size="small"
                                                     v-model="data.fill_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.fill_color"></el-input>
                                </div>
                            </div>
                            <el-form-item  label="背景颜色" v-if="data.style != 1">
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
                </el-form>
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component('f-switch', {
        template: '#f-switch',
        props: {
            value: Object,
            isFormGoods: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {
                is_open: false,
                form: {},
                data: Object.assign({
                    is_required: 0,
                    title: '',
                    open_text: '',
                    close_text: '',
                    default: 0,
                    margin: 24,
                    height: 80,
                    inputPadding: 12,
                    radius: 5,
                    open_color: '#4798EB',
                    close_color: '#C8C8C8',
                    title_color: '#545B60',
                    tips_color: '#FFFFFF',
                    fill_color: '#99A1AA',
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
            cDialogStyle() {
                let style = `background-color:${this.data.fill_color};color:${this.data.tips_color};border-radius:${this.data.radius}px;height:${this.data.height}px;`;
                return style;
            },
            cRadioStyle() {
                let style = `background-color:${this.data.bg_color ? this.data.bg_color : 'transparent'};width:100%;padding: 0 ${this.data.margin}px;`;
                return style;
            },
            cTitleStyle() {
                let style = `color:${this.data.title_color};`;
                return style;
            },
        },
        methods: {
            changeValue(item) {
                this.is_open = item == 1 ? true : false
            },
        },
    });
</script>
