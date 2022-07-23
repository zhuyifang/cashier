<?php
/**
 * @copyright ©2018 Lu Wei
 * @author Lu Wei
 * @link http://www.luweiss.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/14 13:49
 */
?>
<style>
    .app-image {
        position: relative;
    }

    .app-image:hover .hover {
        visibility: visible;
    }

    .app-image .hover {
        visibility: hidden;
    }

    .app-image .hover-text {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 34px;
        text-align: center;
        height: 18px;
        line-height: 18px;
        margin-left: -17px;
        margin-top: -9px;
        font-size: 12px;
        color: #fff;
        border-radius: 3px;
        background: rgba(36, 36, 36, 0.5);
        cursor: pointer;
    }

    .app-image .image-delete {
        position: absolute;
        top: -10px;
        right: -10px;
        padding: 5px;
        visibility: hidden;
        z-index: 1;
    }
</style>
<template id="app-image">
    <div class="app-image" :style="src ? style : defaultStyle">
        <template v-if="src">
            <el-button @click.stop="imageDelete" class="hover image-delete" v-if="showDelete"
                       icon="el-icon-close" size="mini" circle type="danger"></el-button>
        </template>
        <template v-else>
            <div class="hover hover-text" v-if="showTips">上传</div>
        </template>
    </div>
</template>
<script>
    Vue.component('app-image', {
        template: '#app-image',
        props: {
            src: String,
            mode: String,
            width: String,
            height: String,
            radius: String,
            showTips: {
                type: Boolean,
                default: false,
            },
            showDelete: {
                type: Boolean,
                default: false,
            }
        },
        data() {
            return {};
        },
        created() {
        },
        computed: {
            style() {
                let width = '50px';
                let height = '50px';
                let radius = '0%';
                let bgSize = 'cover';
                let bgPosition = 'center';
                switch (this.mode) {
                    case 'scaleToFill':
                        bgSize = '100% 100%';
                        break;
                    default:
                        bgSize = 'cover';
                        break;
                }
                if (this.width) {
                    width = this.width + (isNaN(this.width) ? '' : 'px');
                }

                if (this.height) {
                    height = this.height + (isNaN(this.height) ? '' : 'px');
                }
                if (this.radius) {
                    radius = this.radius + (isNaN(this.radius) ? '' : '%');
                }

                return `background-image:url(${this.src ? this.src : 'statics/img/mall/default_img_new.png'});`
                    + `background-size:${bgSize};`
                    + `background-position:${bgPosition};`
                    + `width:${width};`
                    + `height:${height};`
                    + `border-radius: ${radius};`;
            },
            defaultStyle() {
                let width = '80px';
                let height = '80px';
                if (this.width) {
                    width = this.width + (isNaN(this.width) ? '' : 'px');
                }

                if (this.height) {
                    height = this.height + (isNaN(this.height) ? '' : 'px');
                }
                return `background-image:url('statics/img/mall/default_img_new.png');`
                    + `background-size:calc(${width} * 37 / 80) calc(${height} * 37 / 80);`
                    + `background-position:center;`
                    + `background-repeat:no-repeat;`
                    + `width:${width};`
                    + `height:${height};`
                    + `border:1px #E5E7EC solid;`;
            }
        },
        methods: {
            imageDelete() {
                this.$emit('image-delete')
            },
        },
    });
</script>
