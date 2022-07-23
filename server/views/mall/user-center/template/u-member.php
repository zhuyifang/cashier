<style>
    .diy-component-edit .diy-member .c-input-big {
        width: 100%;
        margin-right: 25px;
        margin-left: 5px;
    }
    .diy-component-edit .diy-member .label {
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        margin: 55px 35px 40px;
    }
    .diy-component-edit .diy-member .mode-choose {
    }
    .diy-component-edit .diy-member .mode-choose .classic {
        width: 98px;
        height: 70px;
        border-radius: 3px;
        border: 2px solid #DCDFE6;
        color: #606266;
        font-size: 14px;
        margin-right: 20px;
    }
    .diy-component-edit .diy-member .mode-choose .classic.active {
        color: #409EFF;
        border-color: #409EFF;
    }
    .diy-component-edit .diy-member .mode-choose .classic img {
        margin-bottom: 6px;
        display: block;
    }
    .diy-component-edit .diy-member .mode-choose .classic .text {
        line-height: 1;
    }
</style>
<template id="u-member">
    <div>
        <div ref="component" class="diy-component-preview diy-member">
            <p-member v-model="data"></p-member>
        </div>
        <div class="diy-component-edit">
            <div class="diy-member">
                <div class="app-form-title">
                    <div>会员信息</div>
                </div>
                <el-form ref="data" :model="data" label-width="118px" size="small" style="padding: 20px 0">
                    <el-form-item label="会员信息样式">
                        <app-radio turn v-model="data.style" :label="1">标准样式</app-radio>
                        <app-radio turn v-model="data.style" :label="2">背景图样式</app-radio>
                    </el-form-item>
                    <el-form-item label="图标" prop="icon" v-if="data.style == 1">
                        <div flex style="margin-bottom: 8px;">
                            <app-attachment :multiple="false" :max="1" @selected="iconUrl">
                                <el-tooltip effect="dark"
                                            content="建议尺寸: 60 * 60"
                                            placement="top">
                                    <el-button size="mini">选择图标</el-button>
                                </el-tooltip>
                            </app-attachment>
                            <div style="margin-left: 10px;">
                                <el-button type="primary" size="mini" @click="resetImg('icon')">恢复默认</el-button>
                            </div>
                        </div>
                        <app-gallery :url="data.icon" :show-delete="true" @deleted="data.icon = ''"
                                     width="80px" height="80px">
                        </app-gallery>
                    </el-form-item>
                    <el-form-item label="阴影" v-if="data.style == 1">
                        <el-switch v-model="data.shadow" :active-value="1"
                                           :inactive-value="0"></el-switch>
                    </el-form-item>
                    <el-form-item label="背景选择" v-if="data.style == 2">
                        <app-radio turn v-model="data.mode" :label="1">默认样式</app-radio>
                        <app-radio turn v-model="data.mode" :label="2">自定义上传</app-radio>
                        <app-gallery v-if="data.mode == 1" :url="data.bg_pic"
                                     width="80px" height="80px">
                        </app-gallery>
                    </el-form-item>
                    <el-form-item label="填写前背景选择" prop="before_bg" v-if="data.style == 2 && data.mode == 2">
                        <div flex style="margin-bottom: 8px;">
                            <app-attachment :multiple="false" :max="1" @selected="beforeBgUrl">
                                <el-tooltip effect="dark"
                                            content="建议尺寸: 702 * 144"
                                            placement="top">
                                    <el-button size="mini">选择图标</el-button>
                                </el-tooltip>
                            </app-attachment>
                            <div style="margin-left: 10px;">
                                <el-button type="primary" size="mini" @click="resetImg('before_bg')">恢复默认</el-button>
                            </div>
                        </div>
                        <app-gallery :url="data.before_bg" :show-delete="true" @deleted="data.before_bg = ''"
                                     width="80px" height="80px">
                        </app-gallery>
                    </el-form-item>
                    <el-form-item label="填写后背景选择" prop="after_bg" v-if="data.style == 2 && data.mode == 2">
                        <div flex style="margin-bottom: 8px;">
                            <app-attachment :multiple="false" :max="1" @selected="afterBgUrl">
                                <el-tooltip effect="dark"
                                            content="建议尺寸: 702 * 144"
                                            placement="top">
                                    <el-button size="mini">选择图标</el-button>
                                </el-tooltip>
                            </app-attachment>
                            <div style="margin-left: 10px;">
                                <el-button type="primary" size="mini" @click="resetImg('after_bg')">恢复默认</el-button>
                            </div>
                        </div>
                        <app-gallery :url="data.after_bg" :show-delete="true" @deleted="data.after_bg = ''"
                                     width="80px" height="80px">
                        </app-gallery>
                    </el-form-item>
                    <el-form-item label="填写前标题文案" v-if="!(data.style == 2 && data.mode == 2)">
                        <el-input v-model="data.before_text"></el-input>
                    </el-form-item>
                    <el-form-item label="填写后标题文案" v-if="!(data.style == 2 && data.mode == 2)">
                        <el-input v-model="data.after_text"></el-input>
                    </el-form-item>
                    <el-form-item label="标题文案颜色" v-if="data.style == 1">
                        <div flex="dir:left cross:center">
                            <div flex="dir:left cross:center" style="width: 100%;">
                                <el-color-picker @change="(row) => {row == null ? data.text_color = '#999999' : ''}"
                                                 size="small"
                                                 v-model="data.text_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.text_color"></el-input>
                            </div>
                        </div>
                    </el-form-item>
                    <el-form-item label="卡片背景颜色" v-if="data.style == 1">
                        <div flex="dir:left cross:center">
                            <div flex="dir:left cross:center" style="width: 100%;">
                                <el-color-picker @change="(row) => {row == null ? data.card_color = '#FFFFFF' : ''}"
                                                 size="small"
                                                 v-model="data.card_color"></el-color-picker>
                                <el-input size="small" class="c-input-big"
                                          v-model="data.card_color"></el-input>
                            </div>
                        </div>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component('u-member', {
        template: '#u-member',
        props: {
            value: Object,
            default: Object
        },
        data() {
            return {
                data: {}
            }
        },
        created() {
            this.data = JSON.parse(JSON.stringify(this.default));
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
            checkMode() {
                this.hideMode = false;
                if(this.data.integral == 0 && this.data.balance == 0 && this.data.coupon == 0) {
                    this.data.mode = '1';
                    this.hideMode = true;
                }
            },
            resetImg(obj) {
                this.data[obj] = this.default[obj]
            },
            bgPicUrl(e) {
                if (e.length) {
                    this.data.bg_pic = e[0].url;
                    // this.$refs.data.validateField('member_bg_pic_url');
                }
            },
            beforeBgUrl(e){
                if(e.length){
                    this.data.before_bg = e[0].url;
                }
            },
            afterBgUrl(e){
                if(e.length){
                    this.data.after_bg = e[0].url;
                }
            },
            iconUrl(e){
                if(e.length){
                    this.data.icon = e[0].url;
                }
            },
        },
    });
</script>
