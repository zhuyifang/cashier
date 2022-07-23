<?php
defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .diy-component-preview .idcard-photo {
        height: 60px;
        width: 60px;
        display: block;
    }

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

    .diy-component-preview .f-idcard {
        height: 200px;
    }


    .diy-component-preview .f-idcard .idcard-position {
        position: relative;
        height: 134px;
        width: 214px;
        display: block;
    }

    .diy-component-preview .f-idcard .idcard-position .p-image {
        height: 100%;
        width: 100%;
        display: block;
    }

    .diy-component-preview .f-idcard .idcard-alone {
        opacity: 0.5;
        position: absolute;
        top: 17px;
        left: 56px;
        border-radius: 50%;
        height: 100px;
        width: 100px;
    }


    .diy-component-preview .f-idcard:first-child {
        margin-right: 22px;
    }

    .diy-component-preview .f-idcard.f-license {
        width: 340px;
    }

    .diy-component-preview .f-idcard.f-license .idcard-position {
        height: 174px;
        width: 214px;
    }

    .diy-component-preview .f-idcard.f-license .idcard-alone {
        top: 36px;
    }

</style>

<template id="f-uimage">
    <div class="f-uimage">
        <div class="diy-component-preview">
            <div flex="dir:top" :style="[boxStyle]">
                <div class="_diy-form-label" :class="{required: data.is_required}" :style="{ color: data.title_color}">
                    {{data.title}}
                </div>
                <div v-if="data.type === 'ordinary'"
                     flex="dir:left cross:center"
                     :style="[uploadStyle]">
                    <div
                            flex="dir:left cross:center main:center"
                            class="ordinary-pic"
                            :style="{backgroundColor: data.ordinary_bg_color}">
                        <el-image
                                style="height: 60px;width: 60px;display: block"
                                :src="_appImg+ 'uimage-photo.png'"></el-image>
                    </div>
                    <div class="ordinary-text"
                         :style="{color: data.place_color}">
                        最多上传{{ data.max_num }}张
                    </div>
                </div>
                <div v-if="data.type === 'idcard'" flex="dir:left cross:center main:justify">
                    <div class="f-idcard"
                         style="flex-grow: 1;flex-shrink: 1"
                         flex="cross:center main:center"
                         :style="[uploadStyle]">
                        <div class="idcard-position">
                            <el-image class="p-image" :src="_appImg + 'uimage-idcard-l.png'"></el-image>
                            <div class="idcard-alone"
                                 flex="cross:center main:center"
                                 :style="{background: data.icon_bg_color}"
                            >
                                <el-image class="idcard-photo" :src="_appImg+ 'uimage-photo-white.png'"></el-image>
                            </div>
                        </div>
                    </div>
                    <div class="f-idcard"
                         style="flex-grow: 1;flex-shrink: 1"
                         flex="cross:center main:center"
                         :style="[uploadStyle]">
                        <div class="idcard-position">
                            <el-image class="p-image" :src="_appImg + 'uimage-idcard-r.png'"></el-image>
                            <div class="idcard-alone"
                                 flex="main:center cross:center"
                                 :style="{background: data.icon_bg_color}"
                            >
                                <el-image class="idcard-photo" :src="_appImg + 'uimage-photo-white.png'"></el-image>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="data.type === 'license'" flex="dir:left cross:center">
                    <div class="f-idcard f-license "
                         flex="cross:center main:center"
                         :style="[uploadStyle]">
                        <div class="idcard-position" @click="chooseImage(0)">
                            <el-image class="p-image" :src="_appImg + 'uimage-license.png'"></el-image>
                            <div class="idcard-alone"
                                 flex="cross:center main:center"
                                 :style="{background: data.icon_bg_color}"
                            >
                                <el-image class="idcard-photo" :src="_appImg + 'uimage-photo-white.png'"></el-image>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div>
                <div class="app-form-title">
                    <div>上传图片</div>
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
                            注：上传图片格式必须为png、jpg、jpeg
                        </div>
                    </el-form-item>
                    <el-form-item label="图片类型">
                        <app-radio v-model="data.type" label="ordinary" turn>普通</app-radio>
                        <app-radio v-model="data.type" label="idcard" turn>身份证</app-radio>
                        <app-radio v-model="data.type" label="license" turn>营业执照</app-radio>
                    </el-form-item>
                    <el-form-item label="最少上传" v-if="data.type === 'ordinary'">
                        <el-input-number v-model="data.min_num"
                                         :min="1"
                                         :precision="0"
                                         :step="1"
                                         :max="99999"
                        ></el-input-number>

                    </el-form-item>
                    <el-form-item label="最多上传" v-if="data.type === 'ordinary'">
                        <el-input-number v-model="data.max_num"
                                         :min="data.min_num > 1 ? data.min_num : 1"
                                         :precision="0"
                                         :step="1"
                                         :max="99999"
                        ></el-input-number>
                    </el-form-item>
                    <el-form-item label="图片边距">
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
                        <el-form-item label="图标背景" v-if="data.type === 'ordinary'">
                            <color v-model="data.ordinary_bg_color"></color>
                        </el-form-item>
                        <el-form-item label="图标背景" v-else>
                            <color v-model="data.icon_bg_color"></color>
                        </el-form-item>
                        <el-form-item label="背景颜色">
                            <color v-model="data.bg_color"></color>
                        </el-form-item>
                        <el-form-item label="提示文本" v-if="data.type === 'ordinary'">
                            <color v-model="data.place_color"></color>
                        </el-form-item>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('f-uimage', {
        template: '#f-uimage',
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
                    type: 'ordinary',//ordinary idcard license
                    box_padding: 24,
                    pd_color: '#F1F5F8',
                    border_color: '#F1F5F8',
                    title_color: '#545B60',
                    place_color: '#545B60',
                    icon_bg_color: '#99A1AA',
                    ordinary_bg_color: '#FFFFFF',
                    bg_color: '#FFFFFF',
                    key: new Date().getTime(),
                }, this.isFormGoods ? {has_show: 1} : {}),
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
                    type,
                } = this.data;
                let style = {
                    borderWidth: '1px',
                    borderStyle: 'solid',
                    borderColor: border_color ? border_color : pd_color,
                    backgroundColor: pd_color,
                    borderRadius: '12px',
                }
                if (type === 'ordinary') {
                    Object.assign(style, {
                        padding: '16px 44px 0 3px',
                    })
                }
                return style;
            },
        },
    });
</script>
