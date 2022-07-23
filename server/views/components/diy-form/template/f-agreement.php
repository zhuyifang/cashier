<style>
    .diy-component-edit .diy-agreement .c-input-big {
        width: 64px;
        margin-right: 25px;
        margin-left: 5px;
    }
    .diy-component-edit .diy-agreement .label {
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        margin: 55px 35px 40px;
    }
    .diy-component-edit .diy-agreement .el-form-item__label {
        padding-right: 50px;
    }
    .diy-component-edit .diy-agreement .color-input .el-form-item__label {
        padding-right: 12px;
    }
    .diy-component-edit .diy-agreement .color-input .el-form-item--small.el-form-item {
        margin-bottom: 0;
    }
    .diy-component-edit .diy-agreement .el-textarea .el-textarea__inner{
        resize: none;
    }
    .diy-component-edit .diy-agreement .el-form-item--small .el-form-item__content,.diy-component-edit .diy-agreement .el-form-item--small .el-form-item__label {
        line-height: 32px!important;
    }
    .diy-component-preview.diy-agreement .agreement-area {
        height: 62px;
        line-height: 62px;
        font-size: 24px;
    }
    .diy-component-preview.diy-agreement .agreement-area .checked {
        width: 46px;
        height: 62px;
        padding: 18px 10px;
    }
    .diy-component-preview.diy-agreement .agreement-area .checked img {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: block;
    }
    .diy-component-preview.diy-agreement .agreement-area .arrow {
        font-size: 28px;
        font-weight: bold;
        margin-left: -5px;
    }
    .agreement-dialog {
        position: absolute;
        top: 0;
        width: 375px;
        height: 100%;
        text-align: center;
        z-index: 1000;
        background-color: rgba(36, 36, 36, .35);
    }
    .agreement-dialog .agreement-dialog-item {
        padding: 25px;
        padding-bottom: 23px;
    }
    .agreement-dialog .agreement-dialog-item .agreement-dialog-title {
        font-size: 20px;
        font-weight: bold;
        padding-bottom: 28px;
    }
    .agreement-dialog .agreement-dialog-item .agreement-dialog-title .rhombus{
        width: 4px;
        height: 4px;
        transform: rotateZ(45deg)skew(0,0);
        margin: 0 6px;
    }
    .agreement-dialog .agreement-dialog-item .agreement-dialog-content {
        overflow: auto;
        word-break: break-all;
        text-align: left;
    }
    .agreement-dialog .agreement-dialog-item .agreement-dialog-content pre {
        white-space: pre-wrap;       /* css-3 */
        white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
        white-space: -pre-wrap;      /* Opera 4-6 */
        white-space: -o-pre-wrap;    /* Opera 7 */
        word-wrap: break-word;       /* Internet Explorer 5.5+ */
    }
    .agreement-dialog .agreement-dialog-item .agreement-dialog-content::-webkit-scrollbar {
        display:none;
    }
    .agreement-dialog .agreement-dialog-item .agreement-dialog-button {
        height: 40px;
        margin-top: 35px;
    }
    .agreement-dialog .agreement-dialog-item .agreement-dialog-button div {
        margin: 0 15px;
        height: 40px;
        line-height: 40px;
        width: 110px;
        border-radius: 20px;
        color: #fff;
        font-size: 16px;
        text-align: center;
    }
</style>
<template id="f-agreement">
    <div>
        <div v-if="is_show" class="agreement-dialog" :style="{'padding': 355 - data.height/4 +'px '+ data.inputPadding / 2 +'px'}">
            <div class="agreement-dialog-item" :style="cDialogStyle">
                <div class="agreement-dialog-title" :style="{'color':data.title_color}" flex="main:center cross:center">
                    <div class="rhombus" :style="{'background-color':data.title_color}"></div>
                    <div>{{data.title}}</div>
                    <div class="rhombus" :style="{'background-color':data.title_color}"></div>
                </div>
                <div @scroll="showScroll" ref="content" class="agreement-dialog-content" :style="{'color': data.content_color, 'height': (data.height/2) - 186 + 'px'}"><pre>{{data.content}}</pre></div>
                <div class="agreement-dialog-button" flex="main:center cross:center">
                    <div @click="is_show = false;" :style="{'background-color': is_over ? data.over_color : data.open_color}">不同意</div>
                    <div @click="is_show = false;" :style="{'background-color': is_over ? data.over_color : data.open_color}">同意</div>
                </div>
            </div>
        </div>
        <div ref="component" class="diy-component-preview diy-agreement">
            <div class="agreement-area" :style="cRadioStyle" flex="main:center cross:center">
                <div @click="is_check = !is_check" class="checked">
                    <img :style="{'background-color': is_check ? data.active_color : data.inactive_color}" src="statics/img/mall/icon-checkbox-checked.png" alt="">
                </div>
                <div class="agreement-title" :style="{'color': data.text_color}">{{is_check ? '勾选即表示您已阅读并同意' : '请完整阅读'}}<span @click="showAgreement">《{{data.title}}》</span></div>
                <i :style="{'color': data.text_color}" class="el-icon-arrow-right arrow"></i>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="diy-agreement">
                <div class="app-form-title">
                    <div>协议</div>
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
                    <el-form-item label="逻辑">
                        <div>
                            <app-radio turn v-model="data.is_read" label="1">必须完整查看协议内容才能勾选</app-radio>
                        </div>
                        <div>
                            <app-radio turn v-model="data.is_read" label="0">弹出协议即可勾选</app-radio>
                        </div>
                    </el-form-item>
                    <el-form-item label="协议内容">
                        <el-input size="small" placeholder="请输入协议内容" v-model="data.content" :rows="12" type="textarea"></el-input>
                    </el-form-item>
                    <el-form-item label="弹窗高度">
                        <el-slider :show-tooltip="false" v-model="data.height" style="float: left;width: 95%" :max="1000" :min="460"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="弹窗边距">
                        <el-slider :show-tooltip="false" v-model="data.inputPadding" style="float: left;width: 95%" :max="100"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>
                    <el-form-item label="弹窗圆角">
                        <el-slider :show-tooltip="false" v-model="data.radius" style="float: left;width: 95%" :max="data.height/8"
                                   show-input></el-slider>
                        <div style="float: right">px</div>
                    </el-form-item>

                    <div class="app-form-box-label">
                        颜色设置
                    </div>

                    <el-form-item label="标题文字" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <el-color-picker @change="(row) => {row == null ? data.title_color = '#FF4544' : ''}"
                                                 size="small"
                                                 v-model="data.title_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.title_color"></el-input>
                            </div>
                            <el-form-item label="协议内容">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.content_color = '#545B60' : ''}"
                                                     size="small"
                                                     v-model="data.content_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.content_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="勾选按钮" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.active_color = '#FF4544' : ''}"
                                                     size="small"
                                                     v-model="data.active_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.active_color"></el-input>
                                </div>
                            </div>
                            <el-form-item  label="未勾选按钮">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.inactive_color = '#BEC3C7' : ''}"
                                                     size="small"
                                                     v-model="data.inactive_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.inactive_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="勾选文字" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.text_color = '#545B60' : ''}"
                                                     size="small"
                                                     v-model="data.text_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.text_color"></el-input>
                                </div>
                            </div>
                            <el-form-item  label="已查看按钮">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.over_color = '#FF4544' : ''}"
                                                     size="small"
                                                     v-model="data.over_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.over_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="未查看按钮" label-width="100px" class="color-input">
                        <div flex="dir:left main:between">
                            <div flex="dir:left cross:center">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.open_color = '#BEC3C7' : ''}"
                                                     size="small"
                                                     v-model="data.open_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.open_color"></el-input>
                                </div>
                            </div>
                            <el-form-item  label="弹窗背景">
                                <div flex="dir:left cross:center">
                                    <el-color-picker @change="(row) => {row == null ? data.fill_color = '#FFFFFF' : ''}"
                                                     size="small"
                                                     v-model="data.fill_color"></el-color-picker>
                                    <el-input size="small" class="c-input-big"
                                              v-model="data.fill_color"></el-input>
                                </div>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item label="背景颜色" label-width="100px" class="color-input">
                        <div flex="dir:left cross:center">
                            <div flex="dir:left cross:center">
                                <el-color-picker @change="(row) => {row == null ? data.bg_color = '' : ''}"
                                                 size="small"
                                                 v-model="data.bg_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.bg_color"></el-input>
                            </div>
                        </div>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component('f-agreement', {
        template: '#f-agreement',
        props: {
            value: Object,
            isFormGoods: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {
                is_check: false,
                is_show: false,
                is_over: false,
                scrollHeight: 238,
                form: {},
                data: Object.assign({
                    is_required: 0,
                    is_read: '1',
                    title: '服务协议',
                    content: '',
                    height: 848,
                    inputPadding: 24,
                    radius: 5,
                    title_color: '#FF4544',
                    content_color: '#545B60',
                    text_color: '#545B60',
                    active_color: '#FF4544',
                    inactive_color: '#BEC3C7',
                    over_color: '#FF4544',
                    open_color: '#BEC3C7',
                    fill_color: '#FFFFFF',
                    bg_color: '#FFFFFF',
                    key: new Date().getTime(),
                }, this.isFormGoods ? {has_show: 1} : {}),
            }
        },
        computed: {
            cDialogStyle() {
                let style = `background-color:${this.data.fill_color};color:${this.data.content_color};border-radius:${this.data.radius}px;height:${this.data.height/2}px;`;
                return style;
            },
            cRadioStyle() {
                let style = `background-color:${this.data.bg_color ? this.data.bg_color : 'transparent'};width:100%;padding: 0 24px;`;
                return style;
            },
            cTitleStyle() {
                let style = `color:${this.data.title_color};`;
                return style;
            },
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
            showAgreement() {
                this.is_show = !this.is_show;
                this.is_over = this.data.is_read == '1' ? false : true;
                this.$nextTick(()=>{
                    this.scrollHeight = this.$refs.content.scrollHeight - (this.data.height/2 - 186);
                    if(this.scrollHeight == 0) {
                        this.is_over = true;
                    }
                })
            },
            showScroll(e) {
                if(e.target.scrollTop == this.scrollHeight) {
                    this.is_over = true;
                }
            },
        },
    });
</script>
