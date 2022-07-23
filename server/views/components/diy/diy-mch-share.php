<style>
    .diy-mch-share .mch-home-head {
        width: 140px !important;
        height: 140px !important;
        /*float: right !important;*/
        /*left: auto !important;*/
        margin-top: 1134px;
        /*margin-right: -137px;*/
    }

    .diy-mch-share .mch-home-padding {
        padding: 20px;
        min-width: 500px;
        border-radius: 5px;
        border: 1px solid #DCDFE6;
    }

    .diy-mch-share .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }

    .diy-mch-share .reset {
        position: absolute;
        top: 6px !important;
        left: 90px;
    }

    .diy-mch-share .image-close {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABJ0lEQVQ4T62TIUjFUBSGv6fFIojRYDL4wLKmIFOwiGkrgmVpaeHFjQUZwzC2pmFpaUWwbEksgg5B24qgwWR4UQSLRZEDuzLmE9R52v3v/T/Of+69A77WArAODIH5ZvsJuAOugHHbMmgtpoFdQAemJoBFegcq4AR4E0EBxDwClr8xduV74EggCrAHbP7QrI5dAMcCkMz7qu2yLNfCMLyt6/qlDdQ0bTYIghXDMK4bXeIcCEByb6nDcRwPbdvWTNM8rarqWXRd1+eKotjJsqz2PE+GqepcAEHTxafq+/6S67qrlmWdiZjn+XaSJDdRFD10Yo4FcAjMdPM7jrMYx/GG6J7nXaZp+jhhRq//AugdofcQe1+jzKbXQxJA76esIH/+TO0r/tV3/gCpSYcRDlYacgAAAABJRU5ErkJggg==");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 32px;
        width: 32px;
        position: absolute;
        top: 0;
        right: 0;
    }
    .mch-home-detail .el-form-item .el-form-item .el-form-item__label {
        width: 100px !important;
    }

    .mch-home-detail .el-form-item .el-form-item .el-form-item__content {
        margin-left: 100px !important;
    }
</style>
<template id="diy-mch-share">
    <div class="diy-mch-share">
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>分享浮窗</div>
            </div>
            <el-form label-width="150px" @submit.native.prevent style="padding: 20px 0">
                <el-form-item label="关闭按钮">
                    <el-switch v-model="data.is_open" :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item label="分享按钮">
                    <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                    @selected="selectShareBtnPic">
                        <el-tooltip effect="dark"
                                    content="建议尺寸:70 * 70"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1"
                                        @selected="selectShareBtnPic">
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height='80px'
                                       :src="data.share_btn_pic">
                            </app-image>
                        </app-attachment>
                        <el-button v-if="data.share_btn_pic" class="del-btn"
                                   size="mini" type="danger" icon="el-icon-close"
                                   circle
                                   @click="removeShareBtnPic"></el-button>
                    </div>
                    <el-button size="mini" @click="resetImg('share_btn_pic')" class="reset" type="primary">恢复默认
                    </el-button>
                </el-form-item>
                <el-form-item label="浮动拖动">
                    <el-switch v-model="data.is_float" :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item label="分享按钮边距">
                    <div class="mch-home-padding">
                        <el-form-item label="下边距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.share_bottom"
                                           style="width: 100%" size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="右边距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.share_right"
                                           style="width: 100%" size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                    </div>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<script>
    Vue.component('diy-mch-share', {
        template: '#diy-mch-share',
        props: {
            value: Object
        },
        data() {
            return {
                data: {
                    is_open: 1,
                    share_btn_pic: _appImg + 'share_btn_pic-1.png',
                    share_bottom: 70,
                    share_right: 0,
                    is_float: 0,
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
        methods: {
            selectShareBtnPic(e) {
                if (e.length) this.data.share_btn_pic = e.shift().url;
            },
            removeShareBtnPic() {
                this.data.share_btn_pic = '';
            },
            resetImg(type) {
                this.data[type] = _appImg + type + '-1.png';
            },
        }
    });
</script>
