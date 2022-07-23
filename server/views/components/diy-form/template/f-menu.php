<?php defined('YII_ENV') or exit('Access Denied');
Yii::$app->loadViewComponent('m-basic', __DIR__ . '/menu');
Yii::$app->loadViewComponent('m-store', __DIR__ . '/menu');
Yii::$app->loadViewComponent('m-date', __DIR__ . '/menu');
Yii::$app->loadViewComponent('m-address', __DIR__ . '/menu');
Yii::$app->loadViewComponent('m-time', __DIR__ . '/menu');
?>
<style>
    .f-menu .f-type {
        font-size: 14px;
        font-weight: 500;
        color: #343434;
        border-radius: 3px;
        line-height: 1;
        padding: 6px 12px;
        margin-top: 3px;
        margin-right: 30px;
        cursor: pointer;
        white-space: nowrap;
    }

    .f-menu .f-type.active {
        background: #409EFF;
        color: #FFFFFF;
    }

    .f-menu .f-type.edit {
        background: #FFFFFF;
        display: inline-block;
        padding: 6px 7px;
        color: #409EFF;
        border: 1px solid #409EFF;
    }


    .f-menu .f-three {
        height: 12px;
        width: 20px;
        border-top: 10px solid #888F9A;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid transparent;
        margin-top: 8px;
    }

    .f-menu .f-type-style {
        padding: 24px 28px;
        background: #fef0f0;
        border-radius: 10px;
        position: relative;
        margin-top: 12px;
        font-size: 14px;
        color: #FA706C;
        width: 370px;
    }

    .f-menu .f-type-style .el-icon-warning-outline {
        font-size: 15px;
        line-height: 1.3;
    }

    .f-menu .f-type-style .f-top {
        width: 19px;
        height: 12px;
        position: absolute;
        right: 35px;
        top: -12px;
    }

    .f-menu .el-form-item--small .m-right .el-form-item__label {
        line-height: inherit !important;
    }
    .f-menu .el-checkbox {
        line-height: 1 !important;
    }
</style>
<template id="f-menu">
    <div class="f-menu">
        <div class="diy-component-preview">
            <div flex="dir:top" :style="[boxStyle]">
                <div :style="{color: data.title_color}"
                     class="_diy-form-label"
                     v-if="data.list_style != 3"
                     :class="{required: data.is_required}"
                >
                    {{data.title}}
                </div>
                <div :style="[inputStyle]" flex="cross:center" style="height: 84px">
                    <div flex="dir:left cross:center main:justify" style="width: 100%">
                        <template v-if="data.list_style == 3 && data.type === 'date'">
                            <div :style="{color: data.title_color}"
                                 class="_diy-form-label"
                                 style="padding:0;margin-bottom: 0;margin-right: 16px"
                                 :class="{required: data.is_required}"
                            >
                                {{ data.title.substring(0, 4) }}
                            </div>
                            <div v-if="data.type_data.date.is_alone == 1" flex="dir:left cross:center">
                                <div :style="{color: data.place_color}" style="font-size: 30px;margin-right: 12px">
                                    {{data.place_text}}
                                </div>
                                <div>
                                    <app-image src="statics/img/mall/form/menu-date.png"
                                               style="height: 30px;width: 30px"></app-image>
                                </div>
                            </div>
                            <template v-if="data.type_data.date.is_alone == 0">
                                <div :style="{color: data.place_color}" style="width: 50%">
                                    {{data.place_text}}
                                </div>
                                <div>
                                    <app-image src="statics/img/mall/form/menu-date.png"
                                               style="height: 30px;width: 30px"></app-image>
                                </div>
                                <div style="font-size: 28px;color: #343434;margin: 0 24px">至</div>
                                <div :style="{color: data.place_color}" style="width: 50%">
                                    {{data.place_text}}
                                </div>
                                <div>
                                    <app-image src="statics/img/mall/form/menu-date.png"
                                               style="height: 30px;width: 30px"></app-image>
                                </div>
                            </template>
                        </template>
                        <template v-else-if="data.type === 'date'">
                            <div v-if="data.type_data.date.is_alone == 1">
                                <div :style="{color: data.place_color}">
                                    {{data.place_text}}
                                </div>
                            </div>
                            <div v-else flex="dir:left cross-center" style="font-size: 30px;width: 100%">
                                <div :style="{color: data.place_color}" style="width: 50%">
                                    {{data.place_text}}
                                </div>
                                <div flex="cross:center">
                                    <app-image src="statics/img/mall/form/menu-date.png"
                                               style="height: 30px;width: 30px"></app-image>
                                </div>
                                <div style="color: #343434;margin: 0 24px">至</div>
                                <div :style="{color: data.place_color}" style="width: 50%">
                                    {{data.place_text}}
                                </div>
                            </div>
                            <div>
                                <app-image src="statics/img/mall/form/menu-date.png"
                                           style="height: 30px;width: 30px"></app-image>
                            </div>
                        </template>
                        <template v-else-if="data.list_style == 3">
                            <div :style="{color: data.title_color}"
                                 class="_diy-form-label"
                                 style="padding:0;margin:0"
                                 :class="{required: data.is_required}"
                            >
                                {{ data.title.substring(0, 4) }}
                            </div>
                            <div flex="dir:left cross:center">
                                <div :style="{color: data.place_color}" style="font-size: 30px;margin-right: 20px">
                                    {{data.place_text}}
                                </div>
                                <div class="f-three"></div>
                            </div>
                        </template>
                        <template v-else>
                            <div :style="{color: data.place_color}" style="font-size: 30px">
                                {{data.place_text}}
                            </div>
                            <div class="f-three"></div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div>
                <div class="app-form-title">
                    <div>下拉菜单</div>
                </div>
                <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                    <el-form-item label="字段属性:">
                        <app-radio v-model="data.is_required" :label="1" trun>必填</app-radio>
                        <app-radio v-model="data.is_required" :label="0" trun>不必填</app-radio>
                    </el-form-item>
                    <template v-if="this.isFormGoods">
                        <?php require __DIR__ . '/../form-goods/dothing/show.php' ?>
                    </template>
                    <el-form-item label="内容标题:" required>
                        <el-input v-model="data.title" size="small" placeholder="请输入内容标题"
                                  maxlength="21"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item hidden label="提示文字">
                        <el-input v-model="data.place_text" size="small" placeholder="请输入提示文字" maxlength="13"
                                  show-word-limit></el-input>
                    </el-form-item>
                    <el-form-item label="预设类型">
                        <app-radio v-model="data.type" label="basic" trun>普通</app-radio>
                        <app-radio v-model="data.type" label="address" trun>省市区</app-radio>
                        <app-radio v-model="data.type" label="date" trun>日期选择</app-radio>
                        <app-radio v-model="data.type" label="time" trun>时间选择</app-radio>
                        <app-radio v-model="data.type" label="store" trun>门店</app-radio>
                    </el-form-item>
                    <el-form-item label="编辑选项">
                        <m-basic v-model="basicVisible" @change="basicChange"
                                 :type-data="data.type_data.basic"></m-basic>
                        <m-address v-model="addressVisible" @change="addressChange"
                                   :type-data="data.type_data.address"></m-address>
                        <m-store v-model="storeVisible" @change="storeChange"
                                 :type-data="formGoodsStore()"></m-store>
                        <m-date v-model="dateVisible" @change="dateChange"
                                :type-data="data.type_data.date"></m-date>
                        <m-time v-model="timeVisible" @change="timeChange"
                                :type-data="data.type_data.time"></m-time>

                        <el-button type="primary" size="small" @click="openTypeModel" plain>预设编辑</el-button>
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
    Vue.component('f-menu', {
        template: '#f-menu',
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
                storeVisible: false,
                dateVisible: false,
                basicVisible: false,
                addressVisible: false,
                timeVisible: false,
                data: Object.assign({
                    is_required: 1,
                    title: '',
                    place_text: '请选择',
                    type: 'basic',
                    type_data: {
                        basic: [],
                        date: {
                            is_now: 0,
                            start_at: '',
                            end_at: '',
                            is_alone: 1,
                            type: 'date',
                        },
                        store: [],
                        address: [],
                        time: {
                            start_list: [{time: ['', '']}],
                            limit_time: 5,
                            show_type: 'alone',
                        },
                    },
                    input_padding: 24,
                    input_radius: 24,
                    list_style: 1,
                    border_color: '#F1F5F7',
                    title_color: '#545B60',
                    place_color: '#BEC3C7',
                    in_color: '#242424',
                    bg_color: '#FFFFFF',
                    padding_color: '#F1F5F7',
                    key: new Date().getTime(),
                }, this.isFormGoods ? {has_show: 1,} : {}),
            };
        },
        methods: {
            formGoodsStore() {
                if (this.isFormGoods) {
                    return this.data.type_data.store.map(item => {
                        return item.id;
                    })
                } else {
                    return this.data.type_data.store
                }
            },
            basicChange(e) {
                this.data.type_data.basic = e;
            },
            addressChange(e) {
                this.data.type_data.address = e;
            },
            storeChange(e) {
                this.data.type_data.store = e.map(item => this.isFormGoods ? {
                    id: item.id,
                    key: 'menu-store' + item.id
                } : item.id);
            },
            dateChange(e) {
                this.data.type_data.date = e;
            },
            timeChange(e) {
                this.data.type_data.time = e;
            },
            openTypeModel() {
                this[this.data.type + 'Visible'] = true;
            },
        },
        computed: {
            inputStyle() {
                let {
                    border_color,
                    input_radius,
                    padding_color,
                    list_style,
                } = this.data;
                let style = {
                    padding: '0 24px',
                }
                if (list_style == 1) {
                    Object.assign(style, {
                        borderBottomWidth: '1px',
                        borderBottomStyle: 'solid',
                        borderBottomColor: border_color || padding_color,
                    })
                } else {
                    Object.assign(style, {
                        border: `1px solid ${border_color || padding_color}`,
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
    });
</script>
