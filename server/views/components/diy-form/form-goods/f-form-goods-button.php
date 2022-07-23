<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .f-form-goods-button {

    }

    .f-form-goods-button .f-type-style {
        padding: 24px 28px;
        background: #fef0f0;
        border-radius: 10px;
        position: relative;
        margin-top: 12px;
        font-size: 14px;
        color: #FA706C;
        width: 370px;
    }

    .f-form-goods-button .f-type-style .f-top {
        width: 19px;
        height: 12px;
        position: absolute;
        right: 35px;
        top: -12px;
    }

    .f-form-goods-button .f-type-style .el-icon-warning-outline {
        font-size: 15px;
        line-height: 1.3;
    }

    .jiantou {
        margin-right: 30px;
        margin-left: 18px;
        margin-top: 4px;
    }

    .jiantou > div {
        height: 21px;
        width: 4px;
        background: #c0c4cc;
    }

    .jiantou > div:first-child {
        transform: rotate(-45deg);
    }

    .jiantou > div:last-child {
        margin-left: 8px;
        transform: rotate(45deg);
    }
</style>
<template id="f-form-goods-button">
    <div class="f-form-goods-button">
        <div class="diy-component-preview">
            <div flex="dir:left cross:center main:justify" :style="[boxStyle]">
                <div flex="dir:left cross:bottom">
                    <div style="font-size: 32px;line-height: 1;margin-bottom: 2px">￥</div>
                    <div style="font-size: 52px;line-height:1">0.00</div>
                </div>
                <div flex="dir:left cross:center">
                    <div style="font-size: 28px;color: #999999">明细</div>
                    <div :style="{transform:  'rotate(180deg)'}"
                         flex="dir:left cross:center main:center"
                         class="jiantou">
                        <div></div>
                        <div></div>
                    </div>
                    <div :style="[btnStyle]" flex="main:center cross:center">{{data.btn_title}}</div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div>
                <div class="app-form-title">
                    <div>提交按钮</div>
                </div>
                <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                    <el-form-item label="按钮文字" required>
                        <el-input v-model="data.btn_title"
                                  size="small"
                                  placeholder="请输入按钮文字"
                                  maxlength="5"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="公式编辑">
                        <calc-common v-model="data.calc" type="form-goods-button" :show.sync="calcShow"
                                     :title="data.btn_title" v-bind="$attrs" @submit="calcSubmit">
                            <el-button type="primary" size="small" plain>公式编辑</el-button>
                        </calc-common>
                    </el-form-item>

                    <el-form-item label="按钮圆角">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.btn_radius" style="width: 100%"
                                       size="small"
                                       :max="34"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="组件边距">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.input_padding" style="width: 100%"
                                       size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <div class="app-form-box-label">
                        颜色设置
                    </div>
                    <div flex="dir:left" style="flex-wrap: wrap;width: 555px">
                        <el-form-item label="按钮文字">
                            <color v-model="data.btn_text_color"></color>
                        </el-form-item>
                        <el-form-item label="按钮填充">
                            <color v-model="data.padding_color"></color>
                        </el-form-item>
                        <el-form-item label="按钮边框">
                            <color v-model="data.border_color"></color>
                        </el-form-item>
                        <el-form-item label="背景颜色">
                            <color v-model="data.bg_color"></color>
                        </el-form-item>
                        <el-form-item label="总计价格">
                            <color v-model="data.total_color"></color>
                        </el-form-item>
                        <el-form-item label="分隔线">
                            <color v-model="data.limit_color"></color>
                        </el-form-item>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('f-form-goods-button', {
        template: '#f-form-goods-button',
        props: {
            value: Object,
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
                calcShow: false,
                data: {
                    btn_title: '立即定制',
                    btn_text_color: '#FFFFFF',
                    padding_color: '#ff4544',
                    border_color: '',
                    btn_radius: 24,
                    bg_color: '#FFFFFF',
                    total_color: '#FF4544',
                    limit_color: '#E5E5E5',
                    input_padding: 34,
                    calc: [],
                    key: new Date().getTime(),
                },
            };
        },
        computed: {
            btnStyle() {
                let {
                    btn_text_color,
                    padding_color,
                    border_color,
                    btn_radius,
                } = this.data;
                return {
                    color: btn_text_color,
                    backgroundColor: padding_color,
                    padding: '0 58px',
                    height: '68px',
                    lineHeight: '1',
                    border: `1px solid ${border_color || padding_color}`,
                    borderRadius: `${btn_radius}px`,
                }
            },
            boxStyle() {
                let {
                    bg_color,
                    input_padding,
                    limit_color,
                    total_color,
                } = this.data;
                return {
                    backgroundColor: bg_color,
                    padding: `20px ${input_padding}px`,
                    height: '112px',
                    marginTop: '22px',
                    color: total_color,
                    borderTop: `1px solid ${limit_color || bg_color}`,
                }
            },
        },
        methods: {
            calcSubmit(data) {
                this.data.calc = data;
            },
        },
    });
</script>
