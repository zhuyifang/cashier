<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .f-calendar {

    }

    .f-calendar .jt-left {
        height: 20px;
        width: 12px;
        border-right: 12px solid #888F9A;
        border-top: 10px solid transparent;
        border-left: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }

    .f-calendar .jt-right {
        height: 20px;
        width: 12px;
        margin-left: 70px;
        border-left: 12px solid #888F9A;
        border-top: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }


    .f-calendar .f-type-style {
        padding: 24px 28px;
        background: #fef0f0;
        border-radius: 10px;
        position: relative;
        margin-top: 12px;
        font-size: 14px;
        color: #FA706C;
        width: 370px;
    }

    .f-calendar .f-type-style .f-top {
        width: 19px;
        height: 12px;
        position: absolute;
        right: 35px;
        top: -12px;
    }

    .f-calendar .f-type-style .el-icon-warning-outline {
        font-size: 15px;
        line-height: 1.3;
    }

    .f-calendar .box-grow-0 {
        flex-shrink: 0;
        flex-grow: 0;
    }

    .f-calendar .box-grow-1 {
        flex-shrink: 1;
        flex-grow: 1;
    }

    .f-calendar .calendar-basic {
        height: 84px;
    }

    .f-calendar .calendar-basic .c-select {
        height: 84px;
    }

    .f-calendar .calendar-basic > div {
        font-size: 30px
    }

    .f-calendar .f-week > div {
        flex-shrink: 1;
        flex-grow: 1;
        display: flex;
        font-size: 30px;
        color: #99A1AA;
        justify-content: center;
    }

    .f-calendar .f-week.f-date {
        margin: 10px 0;
        height: 80px;
    }

    .f-calendar .f-week.f-date > div {
        align-items: center;
        height: 100%;
        color: inherit;
    }
</style>
<template id="f-calendar">
    <div class="f-calendar">
        <div class="diy-component-preview">
            <div flex="dir:top" :style="{backgroundColor: data.bg_color}">
                <div :style="{padding: `20px ${data.input_padding}px`,border: `1px solid ${data.input_radius}`}">
                    <div :style="{color: data.title_color}"
                         class="_diy-form-label"
                         v-if="data.list_style != 3"
                         :class="{required: data.is_required}"
                    >
                        {{data.title}}
                    </div>
                    <div :style="[inputStyle]" class="calendar-basic" flex="dir:left cross:center">
                        <div class="_diy-form-label box-grow-0"
                             :style="{ color: data.title_color}"
                             v-if="data.list_style == 3"
                             :class="{required: data.is_required}"
                             style="margin: 0;padding: 0;margin-right: 16px;"
                        >
                            {{ data.title.substring(0, 4) }}
                        </div>
                        <div v-if="data.is_alone == 1" flex="dir:left cross:center"
                             :style="{marginLeft: data.list_style == 3 ? 'auto': '0'}">
                            <div class="c-select" :style="{color: date.fulldate ? data.in_color: data.place_color}"
                                 flex="cross:center">
                                {{date.fulldate || data.place_text}}
                            </div>
                        </div>
                        <template v-else>
                            <div class="box-grow-1" style="width: 50%" flex="dir:left cross-center">
                                <div class="c-select" :style="{color: date.before ? data.in_color: data.place_color}"
                                     flex="cross:center">
                                    {{date.before || data.place_text}}
                                </div>
                            </div>
                            <div class="box-grow-0" style="color:#343434;padding: 0 20px">至</div>
                            <div class="box-grow-1" style="width: 50%" flex="dir:left cross:center">
                                <div class="c-select" :style="{color: date.after ? data.in_color: data.place_color}"
                                     flex="cross:center">
                                    {{date.after || data.place_text}}
                                </div>
                            </div>
                            <div v-if="date.data.length" class="box-grow-0" style="color: #242424">
                                共{{ date.data.length }}天
                            </div>
                        </template>
                    </div>
                </div>
                <div :style="{padding: `0 ${data.box_padding}px`}" style="margin-bottom: 20px">
                    <div flex="dir:top main:center" style="padding: 0 12px"
                         :style="{background: data.padding_color,border: `1px solid ${data.border_color || data.padding_color}`,borderRadius: `${data.box_radius}px`}">
                        <div flex="dir:left cross:center main:justify"
                             style="padding: 44px 26px 48px 20px">
                            <div style=" color: #242424;font-size: 32px">2021年1月</div>
                            <div flex="dir:left cross:center">
                                <div class="jt-left"></div>
                                <div class="jt-right"></div>
                            </div>
                        </div>
                        <div class="f-week" flex="dir:left cross:center main:justify">
                            <div>日</div>
                            <div>一</div>
                            <div>二</div>
                            <div>三</div>
                            <div>四</div>
                            <div>五</div>
                            <div>六</div>
                        </div>
                        <span :style="{color: data.active_color}">
                            <div class="f-week f-date" flex="dir:left cross:center main:justify">
                                <div v-for="(item,index) in ['29','30','31','1','2','3','4']" :style="[dayStyle(item)]">
                                    {{item.length == 1 ? '0' + item : item}}
                                </div>
                            </div>
                            <div class="f-week f-date" flex="dir:left cross:center main:justify">
                                <div v-for="(item,index) in ['4','5','6','7','8','9','10']">
                                    {{item.length == 1 ? '0' + item : item}}
                                </div>
                            </div>
                            <div class="f-week f-date" flex="dir:left cross:center main:justify">
                                <div v-if="data.is_alone == 1" :style="{background: data.select_color}"
                                     style="border-radius: 16px;color: white">11</div>
                                <div v-else :style="{background: data.select_color}"
                                     flex="dir:top"
                                     style="border-radius: 16px 0 0 16px;color: white;">
                                    <div>11</div>
                                    <div style="font-size: 20px">开始</div>
                                </div>
                                <div v-for="(item,index) in ['12','13','14','15','16']"
                                     :style="{background: data.is_alone == 1 ? `inherit` : colorRgba(data.select_color,0.15)}"
                                >
                                    {{item.length == 1 ? '0' + item : item}}
                                </div>

                                <div v-if="data.is_alone == 1">17</div>
                                <div v-else :style="{background: data.select_color}"
                                     flex="dir:top"
                                     style="border-radius:  0 16px 16px  0 ;color: white;">
                                    <div>17</div>
                                    <div style="font-size: 20px">结束</div>
                                </div>
                            </div>
                            <div class="f-week f-date" flex="dir:left cross:center main:justify">
                                <div v-for="(item,index) in ['18','19','20','21','22','23','24']">
                                    {{item.length == 1 ? '0' + item : item}}
                                </div>
                            </div>
                            <div class="f-week f-date" flex="dir:left cross:center main:justify">
                                <div v-for="(item,index) in ['25','26','27','28','29','30','31']">
                                    {{item.length == 1 ? '0' + item : item}}
                                </div>
                            </div>
                        </span>

                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div>
                <div class="app-form-title">
                    <div>日历</div>
                </div>
                <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                    <el-form-item label="字段属性">
                        <app-radio v-model="data.is_required" :label="1" trun>必填</app-radio>
                        <app-radio v-model="data.is_required" :label="0" trun>不必填</app-radio>
                    </el-form-item>
                    <template v-if="this.isFormGoods">
                        <?php require __DIR__ . '/../form-goods/dothing/show.php' ?>
                    </template>
                    <el-form-item label="内容标题" required>
                        <el-input v-model="data.title" size="small" placeholder="请输入内容标题"
                                  maxlength="21"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item hidden label="提示文字">
                        <el-input v-model="data.place_text" size="small" placeholder="请输入提示文字" maxlength="13"
                                  show-word-limit></el-input>
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
                            <div style="cursor:pointer;margin-right:38px;padding: 0 20px;width: 98px;height: 70px;border: 2px solid #E5E7EC;border-radius: 3px;"
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
                    <el-form-item label="开始日期">
                        <app-radio v-model="data.is_now" :label="1" turn>当天</app-radio>
                        <app-radio v-model="data.is_now" :label="0" turn>自定义</app-radio>
                        <div>
                            <el-date-picker
                                    v-if="data.is_now == 0"
                                    format="yyyy-MM-dd"
                                    value-format="yyyy-MM-dd"
                                    v-model="data.start_at"
                                    type="date"
                                    :picker-options="pickerOptions"
                                    placeholder="开始日期"
                                    align="right">
                            </el-date-picker>
                        </div>
                        <div v-if="data.is_now == 1" flex="dir:Left cross:center" style="margin-top: 12px">
                            <app-radio v-model="data.is_today" label="today" turn>当天</app-radio>
                            <div flex="dir:left cross:center">
                                <app-radio v-model="data.is_today" label="after" turn></app-radio>
                                <div style="margin-left: -30px">
                                    <el-input size="small"  oninput="this.value = this.value.match(/[1-9]\d*|/)" v-model="data.after_day" style="width: 284px">
                                        <template slot="prepend">比当天日期推迟</template>
                                        <template slot="append">天预定</template>
                                    </el-input>
                                </div>
                            </div>

                        </div>
                    </el-form-item>
                    <el-form-item label="结束日期">
                        <el-date-picker
                                format="yyyy-MM-dd"
                                value-format="yyyy-MM-dd"
                                v-model="data.end_at"
                                type="date"
                                :picker-options="pickerOptions"
                                placeholder="结束日期"
                                align="right">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="日期选项">
                        <app-radio v-model="data.is_alone" :label="1" turn>单日期</app-radio>
                        <app-radio v-model="data.is_alone" :label="0" turn>时间段</app-radio>
                    </el-form-item>
                    <el-form-item label="天数计算" v-if="data.is_alone == 0">
                        <span @click="changeMin">
                             <app-radio v-model="data.has_kuatian" :label="0" turn>当天</app-radio>
                        </span>
                        <el-tooltip style="position: relative;left: -25px;top:1px;cursor: pointer;color:#606266"
                                    effect="dark" content="示例：如用户选择1号至7号  当天计算为7晚/天"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                        <span @click="changeMax">
                        <app-radio v-model="data.has_kuatian" :label="1" turn>跨天</app-radio>
                        </span>
                        <el-tooltip style="position: relative;left: -25px;top:1px;cursor: pointer;color:#606266"
                                    effect="dark" content="示例：如用户选择1号至7号  跨天计算为6晚/天"
                                    placement="top">
                            <i class="el-icon-info"></i>
                        </el-tooltip>
                    </el-form-item>
                    <el-form-item label="限定天数" v-if="data.is_alone == 0">
                        <el-switch v-model="data.is_day" :active-value="1" :inactive-value="0"></el-switch>
                        <div v-if="data.is_day == 1">
                            <el-input-number v-model="data.day_max"
                                             size="small"
                                             :precision="0"
                                             :step="1"
                                             :min="data.has_kuatian == 1 ? 1 : 2"
                                             :max="day_max_max"
                            ></el-input-number>
                            <span style="margin-left: 10px">{{data.place_unit}}</span>
                        </div>
                    </el-form-item>
                    <el-form-item label="结束提示" v-if="data.is_alone == 0">
                        <el-input v-model="data.end_title"
                                  size="small"
                                  placeholder="请输入结束提示"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="提示单位" v-if="data.is_alone == 0">
                        <el-input v-model="data.place_unit"
                                  size="small"
                                  maxlength="1"
                                  show-word-limit
                                  placeholder="请输入提示单位"
                        ></el-input>
                    </el-form-item>

                    <el-form-item label="输入框边距">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.input_padding" style="width: 100%"
                                       size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 20px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="输入框圆角" v-if="data.list_style != 1">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.input_radius" style="width: 100%"
                                       size="small"
                                       :max="42"
                                       show-input></el-slider>
                            <div style="margin-left: 20px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="日历边距">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.box_padding" style="width: 100%" size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 20px">px</div>
                        </div>
                    </el-form-item>

                    <el-form-item label="日历圆角">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.box_radius" style="width: 100%" size="small"
                                       :max="42"
                                       show-input></el-slider>
                            <div style="margin-left: 20px">px</div>
                        </div>
                    </el-form-item>
                    <div class="app-form-box-label">
                        颜色设置
                    </div>
                    <div flex="dir:left" style="flex-wrap: wrap;width: 555px">
                        <el-form-item label="填充颜色">
                            <color v-model="data.padding_color"></color>
                        </el-form-item>
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
                        <el-form-item label="可选颜色">
                            <color v-model="data.active_color"></color>
                        </el-form-item>
                        <el-form-item label="不可选颜色">
                            <color v-model="data.noactive_color"></color>
                        </el-form-item>
                        <el-form-item label="选中颜色">
                            <color v-model="data.select_color"></color>
                        </el-form-item>
                        <el-form-item label="背景颜色">
                            <color v-model="data.bg_color"></color>
                        </el-form-item>
                    </div>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('f-calendar', {
        template: '#f-calendar',
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
            'data.is_now'() {
                this.upateMax();
            },
            'data.start_at'() {
                this.upateMax();
            },
            'data.end_at'() {
                this.upateMax();
            },
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            }
        },
        data() {
            return {
                pickerOptions: {
                    disabledDate(time) {
                        return time.getTime() < Date.now() - 24 * 60 * 60 * 1000
                    }
                },
                day_max_max: 99999999,
                date: {
                    before: '',
                    after: '',
                    data: [],
                    fulldate: '',
                },

                ddd: new Date(),
                data: Object.assign({
                    is_required: 0,
                    title: '日历',
                    place_text: '请选择',
                    list_style: 1,
                    is_now: 1,
                    start_at: null,
                    end_at: null,
                    is_alone: 1,
                    is_day: 0,
                    is_today: 'today',
                    after_day: 0,
                    day_max: 5,
                    place_unit: '天',
                    end_title: '请选择结束时间',

                    input_padding: 24,
                    input_radius: 24,
                    box_padding: 24,
                    box_radius: 24,
                    has_kuatian: 0,

                    title_color: '#545B60',
                    place_color: '#BEC3C7',
                    in_color: '#242424',

                    border_color: '#E5E7EC',
                    padding_color: '#F1F5F7',
                    active_color: '#242424',
                    noactive_color: '#C2C7CA',
                    select_color: '#FF4544',
                    bg_color: '#FFFFFF',
                    key: new Date().getTime(),
                }, this.isFormGoods ? {has_show: 1} : {}),
            };
        },
        methods: {
            upateMax() {
                let {is_now, start_at, end_at, has_kuatian} = this.data;
                if (is_now == 1) {
                    start_at = "<?= (new DateTime())->format('Y-m-d') ?>"
                }
                if(!end_at){
                    this.day_max_max = 99999999;
                    return;
                }
                if (!start_at) {
                    this.day_max_max = 0;
                    return;
                }

                var startTime = new Date(Date.parse(start_at.replace(/-/g, "/"))).getTime();
                var endTime = new Date(Date.parse(end_at.replace(/-/g, "/"))).getTime();
                var dates = Math.abs((startTime - endTime)) / (1000 * 60 * 60 * 24);
                if (has_kuatian == 1) {
                    this.day_max_max = dates;
                } else {
                    this.day_max_max = dates + 1;
                }
            },
            changeMin() {
                if (this.data.day_max < 2) {
                    this.data.day_max = 2;
                }
                this.upateMax();
            },
            changeMax(){
                this.upateMax();

                if (this.data.day_max > this.day_max_max) {
                    this.data.day_max = this.day_max_max;
                }
            },
            colorRgba: function (sHex, alpha = 1) {
                // 十六进制颜色值的正则表达式
                let reg = /^#([0-9a-fA-f]{3}|[0-9a-fA-f]{6})$/;
                /* 16进制颜色转为RGB格式 */
                let sColor = sHex.toLowerCase()
                if (sColor && reg.test(sColor)) {
                    if (sColor.length === 4) {
                        let sColorNew = '#'
                        for (let i = 1; i < 4; i += 1) {
                            sColorNew += sColor.slice(i, i + 1).concat(sColor.slice(i, i + 1))
                        }
                        sColor = sColorNew
                    }
                    //  处理六位的颜色值
                    let sColorChange = []
                    for (let i = 1; i < 7; i += 2) {
                        sColorChange.push(parseInt('0x' + sColor.slice(i, i + 2)))
                    }
                    // 或
                    return 'rgba(' + sColorChange.join(',') + ',' + alpha + ')'
                } else {
                    return sColor
                }
            },
        },
        computed: {
            dayStyle() {
                return (item) => {
                    let {noactive_color} = this.data;
                    if (['29', '30', '31'].indexOf(item) !== -1) {
                        return {
                            color: noactive_color,
                        }
                    }
                }
            },
            calcTime() {
                let date = new Date();
            },
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
                    box_padding,
                } = this.data;
                return {
                    backgroundColor: bg_color,
                    padding: `20px ${box_padding}px`
                }
            },
        },
    });
</script>
