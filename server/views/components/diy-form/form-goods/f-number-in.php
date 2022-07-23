<?php defined('YII_ENV') or exit('Access Denied');
$re_path = __DIR__ . '/dothing/';
?>
<style>
    .f-number-in {

    }

    .f-number-in .f-type-style {
        padding: 24px 28px;
        background: #fef0f0;
        border-radius: 10px;
        position: relative;
        margin-top: 12px;
        font-size: 14px;
        color: #FA706C;
        width: 370px;
    }

    .f-number-in .f-type-style .f-top {
        width: 19px;
        height: 12px;
        position: absolute;
        right: 35px;
        top: -12px;
    }

    .f-number-in .f-type-style .el-icon-warning-outline {
        font-size: 15px;
        line-height: 1.3;
    }

</style>
<template id="f-number-in">
    <div class="f-number-in">
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
                                     style="padding:0;margin:0;width: 125px;"
                                     :class="{required: data.is_required}"
                                >
                                    {{ data.title.substring(0, 4) }}
                                </div>
                                <div flex="dir:left cross:center" style="margin-left: auto">
                                    <div :style="{color: data.place_color}" style="font-size: 30px;margin-right: 12px">
                                        {{data.number_type === 'int' ? data.number_min : data.number_float_min}} -
                                        {{data.number_type === 'int' ? data.number_max : data.number_float_max}}
                                    </div>
                                    <div :style="{color: data.in_color}" style="font-size:30px">
                                        {{data.unit}}
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div :style="{color: data.place_color}" style="font-size: 30px">
                                {{data.number_type === 'int' ? data.number_min : data.number_float_min}} -
                                {{data.number_type === 'int' ? data.number_max : data.number_float_max}}
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
                    <div>纯数字输入</div>
                </div>
                <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                    <el-form-item label="字段属性">
                        <app-radio v-model="data.is_required" :label="1" turn>必填</app-radio>
                        <app-radio v-model="data.is_required" :label="0" turn>不必填</app-radio>
                    </el-form-item>
                    <?php require __DIR__ . '/../form-goods/dothing/show.php' ?>
                    <el-form-item label="内容标题" required>
                        <el-input v-model="data.title"
                                  size="small"
                                  placeholder="请输入内容标题"
                                  maxlength="21"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="单位" required>
                        <el-input v-model="data.unit"
                                  size="small"
                                  placeholder="请输入单位"
                                  maxlength="6"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="数字类型" required>
                        <app-radio @click="changeNumber" v-model="data.number_type" label="int" turn>整数</app-radio>
                        <app-radio @click="changeNumber" v-model="data.number_type" label="float" turn>小数</app-radio>
                    </el-form-item>
                    <el-form-item label="数字范围" v-if="data.number_type === 'int' " required>
                        <div flex="dir:left cross:center">
                            <el-input v-model="data.number_min"
                                      size="small"
                                      :placeholder="data.number_type === 'int' ? '1' : '0.01'"
                                      type="number"
                                      @input="minNumber"
                                      style="width:110px"
                            ></el-input>
                            <div style="margin:0 5px">至</div>
                            <el-input v-model="data.number_max"
                                      size="small"
                                      placeholder="99999999"
                                      type="number"
                                      @input="maxNumber"
                                      style="width:110px"
                            ></el-input>
                        </div>
                    </el-form-item>
                    <el-form-item label="数字范围" v-if="data.number_type === 'float' " required>
                        <div flex="dir:left cross:center">
                            <el-input v-model="data.number_float_min"
                                      size="small"
                                      :placeholder="data.number_type === 'int' ? '1' : '0.01'"
                                      type="number"
                                      @input="minNumber"
                                      style="width:110px"
                            ></el-input>
                            <div style="margin:0 5px">至</div>
                            <el-input v-model="data.number_float_max"
                                      size="small"
                                      placeholder="99999999"
                                      type="number"
                                      @input="maxNumber"
                                      style="width:110px"
                            ></el-input>
                        </div>
                    </el-form-item>
                    <el-form-item label="默认值" required>
                        <el-input v-model="data.default_var"
                                  size="small"
                                  placeholder="请输入默认值"
                                  type="number"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="样式" style="margin-top: 20px;padding-right: 27px;color:#242424">
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
                                         :style="{color: data.list_style == 1 ? '#409EFF': 'inherit'}">样式一
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
                                         :style="{color: data.list_style == 2 ? '#409EFF': 'inherit'}">样式二
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
                                         :style="{color: data.list_style == 3 ? '#409EFF': 'inherit'}">样式三
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="f-type-style" flex="dir:left cross:top" v-if="data.list_style == 3">
                            <i class="el-icon-warning-outline"></i>
                            <div style="margin-left: 7px;line-height: 1.3">该文本样式所显示字符数量有限，仅显示标题的前4个字符</div>
                            <el-image class="f-top"
                                      src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAGCAYAAAAhS6XkAAAA0ElEQVQoU4WQTW7CQAyFnyfggZmIVZEQW9bcgUvMMbhDzpErcLKKRVfxZEKwq2RBpRbK274ffTbhH1lKFXa7iFIYOWccDpmaRl9V6JlhACGlJTabGt4zmAlmilXu8QWhtr096/0Zm2m22zVUg6y0wsg/mWEw9bexLssO+33/m/IRnGnOZ8ZCIopncc69OsdUNTL3EOnQtiMBNmVpHjmdKhyPoXN5Hal2Mk7+Gy0GC727wznB9ZpxuShZkxifH7Ej8pGZBPJu5uEHBMy/JCoT5TcF5VTX7p2cFgAAAABJRU5ErkJggg=="
                            ></el-image>
                        </div>
                    </el-form-item>
                    <el-form-item label="输入框边距">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.input_padding" style="width: 100%"
                                       size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="输入框圆角" v-if="data.list_style != 1">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.input_radius" style="width: 100%"
                                       size="small"
                                       :max="42"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <div class="app-form-box-label">
                        颜色设置
                    </div>
                    <div flex="dir:left" style="flex-wrap: wrap;width: 555px">
                        <el-form-item label="边框颜色">
                            <color v-model="data.border_color"></color>
                        </el-form-item>
                        <el-form-item label="标题颜色">
                            <color v-model="data.title_color"></color>
                        </el-form-item>
                        <el-form-item label="提示文本">
                            <color v-model="data.place_color"></color>
                        </el-form-item>
                        <el-form-item label="输入文本">
                            <color v-model="data.in_color"></color>
                        </el-form-item>
                        <el-form-item label="背景颜色">
                            <color v-model="data.bg_color"></color>
                        </el-form-item>
                        <el-form-item label="填充颜色" v-if="data.list_style != 1">
                            <color v-model="data.padding_color"></color>
                        </el-form-item>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('f-number-in', {
        template: '#f-number-in',
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
                data: {
                    is_required: 0,
                    has_show: 1,
                    title: '',
                    unit: '',
                    number_type: 'float',
                    number_min: 1,
                    number_max: 99999999,
                    number_float_min: 0.01,
                    number_float_max: 99999999,

                    list_style: 1,
                    input_padding: 24,
                    input_radius: 10,
                    border_color: '#E5E7EC',
                    title_color: '#545b60',
                    place_color: '#BEC3C7',
                    in_color: '#242424',
                    bg_color: '#FFFFFF',
                    padding_color: '#F1F5F7',
                    default_var: '',
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
            changeNumber(){

            },
            minNumber(value) {
                const self = this;
                const {number_type} = self.data;
                self.$nextTick(item => {
                    let number;
                    if (number_type === 'float') {
                        number = value.match(/^\d+(\.)?\d{0,2}/g);
                    } else {
                        number = value.match(/^\d+/g);
                    }
                    self.data.number_min = number[0];
                })
            },
            maxNumber(value) {
                const self = this;
                const {number_type} = self.data;

                self.$nextTick(item => {
                    let number;
                    if (number_type === 'float') {
                        number = value.match(/^\d+(\.)?\d{0,2}/g);
                    } else {
                        number = value.match(/^\d+/g);
                    }
                    self.data.number_max = number[0];
                })
            }
        },
    });
</script>
