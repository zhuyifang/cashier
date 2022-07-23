<?php
defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .diy-component-preview .ordinary-pic {
        height: 100px;
        width: 100px;
        border-radius: 10px;
        margin: 10px 17px 28px;
    }

    .diy-component-preview .ordinary-text {
        margin-left: auto;
        color: #545B60;
        margin-bottom: 16px;
        font-size: 24px;
    }
</style>

<template id="f-uvideo">
    <div class="f-uvideo">
        <div class="diy-component-preview">
            <div flex="dir:top" :style="[boxStyle]">
                <div class="_diy-form-label" :class="{required: data.is_required}" :style="{ color: data.title_color}">
                    {{data.title}}
                </div>
                <div flex="dir:left cross:center"
                     :style="[uploadStyle]">
                    <div
                            flex="dir:left cross:center main:center"
                            class="ordinary-pic"
                            :style="{backgroundColor: data.icon_bg_color}">
                        <el-image
                                style="height: 60px;width: 60px;display: block"
                                :src="_appImg+ 'uvideo-photo.png'"></el-image>
                    </div>
                    <div class="ordinary-text"
                         :style="{color: data.place_color}">
                        最多上传{{ data.max_num }}个
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div>
                <div class="app-form-title">
                    <div>上传视频</div>
                </div>
                <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                    <el-form-item label="字段属性">
                        <app-radio v-model="data.is_required" :label="1" turn>必填</app-radio>
                        <app-radio v-model="data.is_required" :label="0" turn>不必填</app-radio>
                    </el-form-item>
                    <template v-if="this.isFormGoods">
                        <?php require __DIR__ . '/../form-goods/dothing/show.php' ?>
                    </template>
                    <el-form-item label="内容标题" required>
                        <el-input v-model="data.title"
                                  size="small"
                                  placeholder="请输入内容标题"
                                  maxlength="21"
                                  show-word-limit
                        ></el-input>
                        <div style="font-size: 12px;color:  #FA706C">
                            注：上传视频格式必须为mp4
                        </div>
                    </el-form-item>
                    <el-form-item label="最少上传">
                        <el-input-number v-model="data.min_num"
                                         :min="1"
                                         :step="1"
                                         :precision="0"
                                         :max="99999"
                        ></el-input-number>

                    </el-form-item>
                    <el-form-item label="最多上传">
                        <el-input-number v-model="data.max_num"
                                         :min="data.min_num > 1 ? data.min_num : 1"
                                         :step="1"
                                         :precision="0"
                                         :max="99999"
                        ></el-input-number>
                    </el-form-item>
                    <el-form-item label="视频边距">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.box_padding" style="width: 100%" size="small"
                                       show-input
                            ></el-slider>
                            <div style="margin-left: 10px">px</div>
                        </div>
                    </el-form-item>
                    <div class="app-form-box-label">颜色设置</div>
                    <div flex="dir:left" style="flex-wrap: wrap;width: 555px">
                        <el-form-item label="填充颜色">
                            <color v-model="data.pd_color"></color>
                        </el-form-item>
                        <el-form-item label="边框颜色">
                            <color v-model="data.border_color"></color>
                        </el-form-item>
                        <el-form-item label="标题颜色">
                            <color v-model="data.title_color"></color>
                        </el-form-item>
                        <el-form-item label="图标背景">
                            <color v-model="data.icon_bg_color"></color>
                        </el-form-item>
                        <el-form-item label="背景颜色">
                            <color v-model="data.bg_color"></color>
                        </el-form-item>
                        <el-form-item label="提示文本">
                            <color v-model="data.place_color"></color>
                        </el-form-item>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('f-uvideo', {
        template: '#f-uvideo',
        props: {
            value: Object,
            isFormGoods: {
                type: Boolean,
                default: false,
            },
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
        data() {
            return {
                data: Object.assign({
                    is_required: 0,
                    title: '',
                    min_num: 1,
                    max_num: 1,
                    box_padding: 24,
                    pd_color: '#F1F5F8',
                    border_color: '#F1F5F8',
                    title_color: '#545B60',
                    place_color: '#545B60',
                    icon_bg_color: '#FFFFFF',
                    bg_color: '#FFFFFF',
                    key: new Date().getTime(),
                }, this.isFormGoods ? {has_show: 1,} : {}),
            };
        },
        computed: {
            boxStyle() {
                let {
                    bg_color,
                    box_padding,
                } = this.data;
                return {
                    backgroundColor: bg_color,
                    padding: `20px ${box_padding}px`,
                }
            },
            uploadStyle() {
                let {
                    border_color,
                    pd_color,
                } = this.data;
                let style = {
                    borderWidth: '1px',
                    borderStyle: 'solid',
                    borderColor: border_color ? border_color : pd_color,
                    backgroundColor: pd_color,
                    borderRadius: '12px',
                    padding: '16px 44px 0 3px',
                }
                return style;
            },
        },
    });
</script>
