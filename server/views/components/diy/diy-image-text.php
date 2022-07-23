<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

?>

<style>
    .diy-image-text {
        width: 100%;
        width: auto;
        padding: 0 20px;
        height: 500px;
        overflow: hidden;
        overflow-y: auto;
    }
    .diy-image-text img {
        max-height: 100%;
        max-width: 100%;
    }
    .diy-image-text strong {
        display: block;
    }
</style>

<template id="diy-image-text">
    <div>
        <div class="diy-component-preview">
            <div class="diy-image-text" :style="{background: data.bg || 'inherit'}">
                <div v-if="data.content" style="background:white" v-html="data.content"></div>
                <div v-else flex="main:center" style="line-height: 500px;color: rgb(173, 177, 184);">图文详情</div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>图文详情</div>
            </div>
            <div style="padding: 20px 0"></div>
            <app-rich-text style="width: 455px" v-model="data.content"></app-rich-text>
            <div flex="dir:left cross:center" style="margin-top: 12px">
                <div style="margin-right: 12px">背景</div>
                <div flex="dir:left cross:center">
                    <el-color-picker v-model="data.bg" size="small"></el-color-picker>
                    <el-input size="small" class="color-input" v-model="data.bg"></el-input>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('diy-image-text', {
        template: '#diy-image-text',
        props: {
            value: Object,
        },
        data() {
            return {
                data: {
                    content: '',
                    bg: '#FFFFFF',
                },
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
    });
</script>