<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .f-calc {

    }

    .f-calc .f-type-style {
        padding: 24px 28px;
        background: #fef0f0;
        border-radius: 10px;
        position: relative;
        margin-top: 12px;
        font-size: 14px;
        color: #FA706C;
        width: 370px;
    }

    .f-calc .f-type-style .f-top {
        width: 19px;
        height: 12px;
        position: absolute;
        right: 35px;
        top: -12px;
    }

    .f-calc .f-type-style .el-icon-warning-outline {
        font-size: 15px;
        line-height: 1.3;
    }

</style>
<template id="f-calc">
    <div class="f-calc">
        <div class="diy-component-preview">
            <div flex="dir:top" :style="[boxStyle]">
                <div :style="{color: data.title_color}"
                     class="_diy-form-label"
                     v-if="data.list_style != 3"
                     :class="{required: data.is_required}"
                >
                    {{data.title}}
                </div>
                <div :style="[inputStyle]" flex="cross:center">
                    <div flex="dir:left cross:center main:justify" style="width: 100%">
                        <template v-if="data.list_style == 3">
                            <div flex="dir:left cross:center" style="width: inherit">
                                <div :style="{color: data.title_color}"
                                     class="_diy-form-label"
                                     style="padding:0;margin:0;width: 125px"
                                     :class="{required: data.is_required}"
                                >
                                    {{ data.title.substring(0, 4) }}
                                </div>
                                <div flex="dir:left cross:center" style="margin-left: auto">
                                    <div :style="{color: data.place_color}" style="font-size: 30px;">

                                    </div>
                                    <div :style="{color: data.in_color}" style="font-size:30px">
                                        {{data.unit}}
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div :style="{color: data.place_color}" style="font-size: 30px">

                            </div>
                            <div :style="{color: data.in_color}" style="font-size:30px">
                                {{data.unit}}
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div>
                <div class="app-form-title">
                    <div>????????????</div>
                </div>
                <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                    <template>
                        <?php require __DIR__ . '/../form-goods/dothing/show.php' ?>
                    </template>
                    <el-form-item label="????????????" required>
                        <el-input v-model="data.title"
                                  size="small"
                                  placeholder="?????????????????????"
                                  maxlength="10"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="??????">
                        <el-input v-model="data.unit"
                                  size="small"
                                  placeholder="???????????????"
                                  maxlength="6"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="????????????" required>
                        <calc-common v-model="data.calc" :show.sync="calcShow" :title="data.title" v-bind="$attrs" @submit="calcSubmit">
                            <el-button type="primary" size="small" plain>????????????</el-button>
                        </calc-common>
                    </el-form-item>
                    <el-form-item label="??????" style="margin-top: 20px;padding-right: 27px;color:#242424">
                        <div flex="dir:left">
                            <div style="cursor:pointer;margin-right:38px;padding: 0 20px;width: 98px;height: 70px;border: 2px solid #E5E7EC;border-radius: 3px;"
                                 :style="{borderColor: data.list_style == 1 ? '#409EFF': '#E5E7EC'}"
                                 @click="data.list_style = 1"
                            >
                                <div style="padding-top: 20px;padding-bottom: 10px">
                                    <div style="width: 33px;height: 10px;background: #D1E8FF;"></div>
                                    <div style="width: 57px;height: 3px;background: #D1E8FF;margin-top: 5px"></div>
                                </div>
                                <div style="width: 100%;text-align: center">
                                    <div style="line-height: 1"
                                         :style="{color: data.list_style == 1 ? '#409EFF': 'inherit'}">?????????
                                    </div>
                                </div>
                            </div>

                            <div style="cursor:pointer;margin-right:38px;padding: 0 20px;width: 98px;height: 70px;border: 2px solid #E5E7EC;border-radius: 3px;"
                                 :style="{borderColor: data.list_style == 2 ? '#409EFF': '#E5E7EC'}"
                                 @click="data.list_style = 2"
                            >
                                <div style="padding-top: 17px;padding-bottom: 7px">
                                    <div style="width: 33px;height: 10px;background: #D1E8FF;"></div>
                                    <div style="width: 57px;height: 9px;background: #D1E8FF;margin-top: 5px"></div>
                                </div>
                                <div style="width: 100%;text-align: center">
                                    <div style="line-height: 1"
                                         :style="{color: data.list_style == 2 ? '#409EFF': 'inherit'}">?????????
                                    </div>
                                </div>
                            </div>
                            <div style="cursor:pointer;padding: 0 20px;width: 98px;height: 70px;border: 2px solid #E5E7EC;border-radius: 3px;"
                                 :style="{borderColor: data.list_style == 3 ? '#409EFF': '#E5E7EC'}"
                                 @click="data.list_style = 3"
                            >
                                <div style="padding-top: 20px;padding-bottom: 10px;">
                                    <div style="width: 56px;height: 18px;background: #D1E8FF;padding: 4px">
                                        <div style="width: 16px;height: 11px;background: #FFFFFF;"></div>
                                    </div>
                                </div>
                                <div style="width: 100%;text-align: center">
                                    <div style="line-height: 1"
                                         :style="{color: data.list_style == 3 ? '#409EFF': 'inherit'}">?????????
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="f-type-style" flex="dir:left cross:top" v-if="data.list_style == 3">
                            <i class="el-icon-warning-outline"></i>
                            <div style="margin-left: 7px;line-height: 1.3">??????????????????????????????????????????????????????????????????4?????????</div>
                            <el-image class="f-top"
                                      src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAGCAYAAAAhS6XkAAAA0ElEQVQoU4WQTW7CQAyFnyfggZmIVZEQW9bcgUvMMbhDzpErcLKKRVfxZEKwq2RBpRbK274ffTbhH1lKFXa7iFIYOWccDpmaRl9V6JlhACGlJTabGt4zmAlmilXu8QWhtr096/0Zm2m22zVUg6y0wsg/mWEw9bexLssO+33/m/IRnGnOZ8ZCIopncc69OsdUNTL3EOnQtiMBNmVpHjmdKhyPoXN5Hal2Mk7+Gy0GC727wznB9ZpxuShZkxifH7Ej8pGZBPJu5uEHBMy/JCoT5TcF5VTX7p2cFgAAAABJRU5ErkJggg=="
                            ></el-image>
                        </div>
                    </el-form-item>
                    <el-form-item label="???????????????">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.input_padding" style="width: 100%"
                                       size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="???????????????" v-if="data.list_style != 1">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.input_radius" style="width: 100%"
                                       size="small"
                                       :max="42"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <div class="app-form-box-label">
                        ????????????
                    </div>
                    <div flex="dir:left" style="flex-wrap: wrap;width: 555px">
                        <el-form-item label="????????????">
                            <color v-model="data.border_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????">
                            <color v-model="data.title_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????">
                            <color v-model="data.in_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????">
                            <color v-model="data.bg_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????" v-if="data.list_style != 1">
                            <color v-model="data.padding_color"></color>
                        </el-form-item>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('f-calc', {
        template: '#f-calc',
        props: {
            value: [Object, Array],
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
                    has_show: 1,
                    title: '',
                    unit: '',

                    list_style: 1,
                    input_padding: 24,
                    input_radius: 10,
                    border_color: '#E5E7EC',
                    title_color: '#545b60',
                    in_color: '#242424',
                    bg_color: '#FFFFFF',
                    padding_color: '#F1F5F7',
                    calc: [],
                    key: new Date().getTime(),
                },
            };
        },
        computed: {
            inputStyle() {
                let {
                    border_color,
                    input_radius,
                    padding_color,
                    bg_color,
                    list_style,
                } = this.data;
                let style = {
                    padding: '0 24px',
                    height: `84px`,
                }
                if (list_style == 1) {
                    Object.assign(style, {
                        borderBottomWidth: '1px',
                        borderBottomStyle: 'solid',
                        borderBottomColor: border_color || bg_color,
                    })
                } else {
                    Object.assign(style, {
                        border: `1px solid ${border_color || bg_color}`,
                        borderRadius: `${input_radius}px`,
                        background: padding_color,
                    })
                }
                return style;
            },

            boxStyle() {
                let {
                    bg_color,
                    input_padding,
                } = this.data;
                return {
                    backgroundColor: bg_color,
                    padding: `20px ${input_padding}px`
                }
            },
        },
        methods: {
            calcSubmit(data){
                this.data.calc = data;
            },
        },
    });
</script>
