<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .f-time {
    }

    .f-time .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }

    .f-time .reset {
        position: absolute;
        top: 3px;
        left: 90px;
    }

    .f-time .edit-nav-item {
        line-height: normal;
        padding: 5px;
        margin-bottom: 5px;
    }
</style>
<style>
    .f-time .diy-form-time {
        padding: 20px 24px;

    }

    .f-time .form-end-time {
        color: white;
        font-size: 32px;
        margin-bottom: 20px;
    }

    .f-time .form-end-time .time {
        margin: 0 4px;
        padding: 0 12px;
        height: 42px;
        background: #FFFFFF;
        border-radius: 10px;
    }

    .f-time .form-end-time .end-text {
        margin-left: 4px;
        color: #FFFFFF;
    }


    .f-time .form-card {
        padding: 20px 0;
    }

    .f-time .form-card .time-people {
        line-height: 1;
        font-size: 30px;
        color: #FFFFFF;

    }

    .f-time .form-card .progress-box {
        width: 100%;
        height: 20px;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 20px;
    }

    .f-time .form-card .progress-box .progress-view {
        width: 50%;
        height: 100%;
        border-radius: inherit;
        background-color: #ff9f9f;
    }


    .f-time .form-card .time-man {
        margin-top: 20px;
    }

    .f-time .form-card .time-man .woman-image {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        display: block;
        margin-left: -14px;
        background: #EFEFEF;
        border: 4px solid white;
    }

    .f-time .form-card .time-man .woman-image.end {
        position: absolute;
        background: rgba(0, 0, 0, 0.5);
        right: 0;
        color: white;
    }

    .f-time .form-card .time-man .woman-image.end div {
        height: 100%;
        width: 100%;
    }

    .f-time .form-card .time-man .woman-image.end .dian {
        height: 6px;
        width: 6px;
        background-color: white;
        border-radius: 50%;
        margin: 0 3px
    }

    .f-time .form-card .swiper {
        margin-top: 40px;
        height: 80px;
        width: 478px;
        background: #DC2325;
        border-radius: 40px;
    }

    .f-time .form-card .man-time {
        height: 80px;
        width: 478px;
    }


    .f-time .form-card .man-time span, .f-time .form-card .man-time .span-image{
        width: 64px;
        display: block;
        height: 64px;
        border-radius: 50%;
        background: #EFEFEF;
    }

    .f-time .form-card .man-time div {
        margin-left: 14px;
        font-size: 28px;
    }
</style>
<template id="f-time">
    <div class="f-time">
        <div class="diy-component-preview">
            <div class="diy-form-time" :style="[bgStyle]" >
                <div v-if="data.has_countdown == 1 && otherInfo.time.time_status == 1"
                     :style="{paddingLeft: data.has_card ==1 && data.c_position === 'center' ? '20px': '0px'}"
                     :flex="`${data.c_position === 'center' ? 'dir:left main:center': 'dir:left'}`"
                     class="form-end-time">
                    <div :style="[timeStyle]" class="time" flex="main:center cross:center">{{date.H}}</div>
                    <div :style="{color: data.c_bg_color}">:</div>
                    <div :style="[timeStyle]" class="time" flex="main:center cross:center">{{date.i}}</div>
                    <div :style="{color: data.c_bg_color}">:</div>
                    <div :style="[timeStyle]" class="time" flex="main:center cross:center">{{date.s}}</div>
                    <div :style="{color: data.c_bg_color}" class="end-text">后结束</div>
                </div>
                <div :style="[cardStyle]" class="form-card" flex="dir:top">
                    <div class="time-people" :style="{color: data.text_color}">已有{{realNumData.user_count}}人{{ data.text
                        }}
                    </div>
                    <div v-if="is_show_progress_bar && data.has_progress_bar == 1" class="progress-box"
                         :style="{background: `${data.progress_bar_end_color}`}">
                        <div class="progress-view"
                             :style="{width:`${realNumData.progress_item  / realNumData.progress_count * 100}%`,background: `${data.progress_bar_color}`}"></div>
                    </div>
                    <div class="time-man" flex="dir:top cross:center">
                        <div style="position: relative" flex="dir:left cross:center">
                            <template v-for="(item,index) of realNumData.user_list">
                                <image class="woman-image" v-if="item.icon" :src="item.icon"></image>
                                <div class="woman-image" v-else></div>
                                <div class="woman-image end" v-if="index == 7">
                                    <div flex="dir:left cross:center main:center">
                                        <div class="dian"></div>
                                        <div class="dian"></div>
                                        <div class="dian"></div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="swiper" :style="[scrollStyle]"
                             v-if="realNumData.buy_list && realNumData.buy_list.length">
                            <el-carousel height="80px" direction="vertical" indicator-position="none" autoplay loop>
                                <el-carousel-item v-for="(item,index) in realNumData.buy_list" :key="index"
                                                  class="man-time"
                                                  flex="dir:left main:center cross:center">
                                    <image v-if="item.user_icon" height="64" width="64" class="span-image"
                                           :src="item.user_icon"></image>
                                    <span v-else></span>
                                    <div>{{ item.user_text }}</div>
                                </el-carousel-item>
                            </el-carousel>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>实时动态</div>
            </div>
            <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                <template v-if="otherInfo.time.time_status == 1">
                    <el-form-item label="倒计时">
                        <el-switch v-model="data.has_countdown" :active-value="1"
                                   :inactive-value="0"></el-switch>
                    </el-form-item>
                    <template v-if="data.has_countdown == 1">
                        <el-form-item label="倒计时位置">
                            <app-radio v-model="data.c_position" label="left" turn>左对齐</app-radio>
                            <app-radio v-model="data.c_position" label="center" turn>居中对齐</app-radio>
                        </el-form-item>
                        <el-form-item label="倒计时底色">
                            <color v-model="data.c_bg_color"></color>
                        </el-form-item>
                        <el-form-item label="倒计时数字">
                            <color v-model="data.c_text_color"></color>
                        </el-form-item>
                    </template>
                </template>
                <template v-if="is_show_progress_bar">
                    <el-form-item label="进度条开关">
                        <el-switch v-model="data.has_progress_bar" :active-value="1"
                                   :inactive-value="0"></el-switch>
                    </el-form-item>
                    <template v-if="data.has_progress_bar == 1">
                        <el-form-item label="进度条颜色">
                            <color v-model="data.progress_bar_color"></color>
                        </el-form-item>
                        <el-form-item label="进度条底色">
                            <color v-model="data.progress_bar_end_color"></color>
                        </el-form-item>
                    </template>
                </template>
                <el-form-item label="文本内容">
                    <el-input v-model="data.text"
                              size="small"
                              placeholder="请输入文本内容"
                              maxlength="6"
                              show-word-limit
                    ></el-input>
                </el-form-item>
                <el-form-item label="文本颜色">
                    <color v-model="data.text_color"></color>
                </el-form-item>
                <el-form-item label="虚拟用户参与">
                    <el-switch v-model="data.has_virtual" :active-value="1"
                               :inactive-value="0"></el-switch>
                </el-form-item>
                <template v-if="data.has_virtual == 1">
                    <el-form-item label="虚拟报名数">
                        <el-input v-model="data.virtual_num"
                                  size="small"
                                  oninput="this.value = this.value.match(/[1-9]\d*|/)"
                                  placeholder="请输入人数"
                        >
                            <template slot="append">
                                人
                            </template>
                        </el-input>
                    </el-form-item>

                    <el-form-item label="虚拟用户头像">
                        <div class="goods-list" style="padding-right: 25px;" flex="dir:top">
                            <div v-for="(item,index) in data.virtual_list" class="edit-nav-item drag-drop">
                                <div flex="dir:left box:first cross:center">
                                    <div style="flex-grow: 0">
                                        <app-image-upload style="margin-right: 11px;" v-model="item.icon"
                                                          width="100"
                                                          height="100"
                                        ></app-image-upload>
                                    </div>
                                    <div style="flex-grow: 1;max-width: 100%">
                                        <el-date-picker
                                                style="width: 100%;margin-top: 5px"
                                                v-model="item.time"
                                                format="yyyy-MM-dd HH:mm"
                                                :picker-options="beginOptions"
                                                value-format="yyyy-MM-dd HH:mm"
                                                type="datetime"
                                                placeholder="选择时间">
                                        </el-date-picker>
                                    </div>
                                    <div style="flex-grow:0">
                                        <el-image
                                                v-if="data.virtual_list.length > 1"
                                                style="display:block;height:30px;width:30px;margin-left: 10px;margin-top:5px;cursor: pointer"
                                                @click="virtualUser(index)"
                                                src="statics/img/mall/form/del.png"
                                        ></el-image>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--工具条 批量操作和分页-->
                        <el-button size="small" type="primary"
                                   v-if="data.virtual_list.length < 7"
                                   @click="addItem" plain>
                            添加
                        </el-button>
                    </el-form-item>

                </template>
                <el-form-item label="滚动条文字">
                    <color v-model="data.scroll_bar_text"></color>
                </el-form-item>
                <el-form-item label="滚动条底色">
                    <color v-model="data.scroll_bar_bg_color"></color>
                </el-form-item>
                <el-form-item label="卡片开关">
                    <el-switch v-model="data.has_card" :active-value="1"
                               @change="changeCard"
                               :inactive-value="0"></el-switch>
                </el-form-item>
                <template v-if="data.has_card == 1">
                    <el-form-item label="卡片填充">
                        <color v-model="data.card_padding_color"></color>
                    </el-form-item>
                    <el-form-item label="卡片边框">
                        <color v-model="data.card_border_color"></color>
                    </el-form-item>
                    <el-form-item label="卡片圆角">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.card_radius" style="width: 100%"
                                       size="small"
                                       :max="42"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                </template>
                <el-form-item label="组件边距">
                    <div flex="dir:left cross:center">
                        <el-slider :show-tooltip="false" v-model="data.lr_padding" style="width: 100%" size="small"
                                   show-input></el-slider>
                        <div style="margin-left: 5px">px</div>
                    </div>
                </el-form-item>
                <el-form-item label="背景设置">
                    <app-radio v-model="data.has_bg" :label="1" turn>上传背景图</app-radio>
                    <app-radio v-model="data.has_bg" :label="0" turn>设置背景颜色</app-radio>
                </el-form-item>
                <el-form-item v-if="data.has_bg == 1" label="上传背景图">
                    <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                    @selected="selectBgUrl">
                        <el-tooltip effect="dark"
                                    :content="bgContent"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1"
                                        @selected="selectBgUrl">
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height='80px'
                                       :src="data.bg_url">
                            </app-image>
                        </app-attachment>
                        <el-button v-if="data.bg_url" class="del-btn"
                                   size="mini" type="danger" icon="el-icon-close"
                                   circle
                                   @click="removeBgUrl"></el-button>
                    </div>
                    <el-button size="mini" @click="resetImg('bg_url')" class="reset" type="primary">恢复默认</el-button>
                </el-form-item>
                <el-form-item v-else label="背景颜色">
                    <color v-model="data.bg_color"></color>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>
    Vue.component('f-time', {
        template: '#f-time',
        props: {
            value: Object,
            allData: [Array, null],
            otherInfo: {
                type: [Object, null],
                default: function () {
                    return {
                        time: {
                            time_status: 1,
                            time_at: '',
                        }
                    }
                }
            },
        },
        created() {
            if (!this.value) {
                this.realData();
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
                this.realVirtual = this.data.has_virtual == 1 ? this.data.virtual_num : 0
            }
            this.timing();
        },

        data() {
            return {
                realVirtual: 0,
                beginOptions: {
                    disabledDate(time) {
                        return time.getTime() > new Date().getTime()
                    }
                },
                pickerOptions: {
                    disabledDate(time) {
                        return time.getTime() < Date.now() - 24 * 60 * 60 * 1000
                    }
                },
                // index
                is_show_progress_bar: false,
                date: {
                    H: '00',
                    i: '00',
                    s: '00',
                },
                formLoading: false,
                data: {
                    has_countdown: 1,
                    c_position: 'center',
                    c_bg_color: '#ffffff',
                    c_text_color: '#f95047',
                    text: '参与活动',
                    text_color: '#242424',
                    has_virtual: 1,
                    virtual_num: '',
                    virtual_list: [
                        {
                            icon: '',
                            time: '',
                        }, {
                            icon: '',
                            time: '',
                        }, {
                            icon: '',
                            time: '',
                        }, {
                            icon: '',
                            time: '',
                        }, {
                            icon: '',
                            time: '',
                        }, {
                            icon: '',
                            time: '',
                        }, {
                            icon: '',
                            time: '',
                        }],
                    scroll_bar_text: '#ffffff',
                    scroll_bar_bg_color: '#cdcdcd',
                    has_card: 1,
                    card_padding_color: '#ffffff',
                    card_border_color: '#ffffff',
                    card_radius: 10,
                    has_bg: 1,
                    bg_color: '#ff3d3a',
                    bg_url: "<?= Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/statics/img/mall/form/time-bg.png' ?>",
                    lr_padding: 24,
                    has_progress_bar: 1,
                    progress_bar_color: '#fa4a3f',
                    progress_bar_end_color: '#ffebea',
                },
                buttonForm: {},
                realNumData: {
                    progress_item: 0,
                    progress_count: 0,
                    user_count: '  ',
                    user_list: [],
                    buy_list: [],
                },
                isUpdate: 0,
            };
        },
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal);
                },
            },
            'data.virtual_num'() {
                this.realData();
            },
            'data.has_virtual'() {
                this.realData();
            },
            'data.virtual_list' : {
                deep: true,
                handler(newVal) {
                    this.realData();
                }
            },
            otherInfo: {
                deep: true,
                handler(newVal) {
                    let {update} = this.otherInfo.time;
                    this.isUpdate = update;
                    if (this.isUpdate > 0) {
                        this.realData();
                        this.isUpdate = 0;
                    }
                }
            },
            allData: {
                deep: true,
                handler(newVal) {
                    if (newVal instanceof Array) {
                        let is_show_progress_bar = false;
                        let is_pay_show = false;

                        this.buttonForm = [];
                        for (let i = 0; i < newVal.length; i++) {
                            if (newVal[i]['id'] === 'button') {
                                this.buttonForm = newVal[i].data;
                                let {has_limit_stock_num, is_pay} = newVal[i].data;
                                is_pay_show = is_pay == 1;
                                is_show_progress_bar = has_limit_stock_num == 0;
                                break;
                            }
                        }

                        this.is_show_progress_bar = is_show_progress_bar && is_pay_show;
                    } else {
                        return [];
                    }
                },
            },
        },
        computed: {
            realPeople() {
                let {has_virtual, user_count, virtual_num} = this.data;
                user_count = user_count || 0
                return user_count + (has_virtual == 1 ? virtual_num : 0) - this.realVirtual;
            },
            bgContent() {
                let w = 322;
                let {has_countdown, has_progress_bar} = this.data;
                if (this.otherInfo.time.time_status == 1 && has_countdown == 1)
                    w += 384 - 322
                if (this.is_show_progress_bar && has_progress_bar == 1)
                    w += 362 - 322
                return `建议尺寸:750 * ${w}`;
            },
            timeStyle() {
                let {c_bg_color, c_text_color} = this.data;
                return {
                    background: c_bg_color,
                    color: c_text_color,
                }
            },
            scrollStyle() {
                let {scroll_bar_bg_color, scroll_bar_text} = this.data;
                return {
                    background: scroll_bar_bg_color,
                    color: scroll_bar_text
                }
            },
            bgStyle() {
                let {bg_color, bg_url, has_bg, lr_padding} = this.data;
                if (has_bg == 1) {
                    return {
                        backgroundImage: `url(${bg_url})`,
                        backgroundRepeat: 'no-repeat',
                        backgroundSize: '100% 100%',
                        paddingLeft: `${lr_padding}px`,
                        paddingRight: `${lr_padding}px`,
                    }
                }
                if (has_bg == 0) {
                    return {
                        paddingLeft: `${lr_padding}px`,
                        paddingRight: `${lr_padding}px`,
                        backgroundColor: bg_color,
                    }
                }
            },
            cardStyle() {
                let {card_border_color, card_padding_color, card_radius, has_card} = this.data;
                if (has_card == 1) {
                    return {
                        paddingLeft: `20px`,
                        paddingRight: `20px`,
                        borderRadius: `${card_radius}px`,
                        backgroundColor: card_padding_color,
                        borderStyle: 'solid',
                        borderWidth: '1px',
                        borderColor: card_border_color || card_padding_color,
                    }
                }
            },
        },
        methods: {
            realData() {
                this.$nextTick(() => {
                    this.formLoading = true;
                    this.$request({
                        params: {
                            r: 'plugin/diy/mall/diy-form/time-data',
                        },
                        data: {
                            time: JSON.stringify(this.data),
                            button: JSON.stringify(this.buttonForm),
                            form_id: getQuery('id') || 0
                        },
                        method: 'POST',
                    }).then(response => {
                        this.formLoading = false;
                        if (response.data.code === 0) {
                            this.realNumData = response.data.data.data;
                        }
                    });
                })
            },
            calcTime() {
                let {time_at, time_status} = this.otherInfo.time;
                if (time_status != 1 || time_at === '') {
                    return false;
                }
                let date = time_at;
                let time = new Date(date).getTime() - new Date().getTime();
                if (time < 0) {
                    return true
                }
                let hou = parseInt(time / 1000 / 60 / 60);
                let min = parseInt((time / 1000 / 60) % 60);
                let sec = parseInt((time / 1000) % 60);
                Object.assign(this.date, {
                    H: hou < 10 ? "0" + hou : hou,
                    i: min < 10 ? "0" + min : min,
                    s: sec < 10 ? "0" + sec : sec,
                })
                return hou <= 0 && min <= 0 && sec <= 0
            },
            async timing() {
                function timeout(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                }

                if (this.calcTime()) return;
                for (let i = 1; i--; i >= 0) {
                    i = 1;
                    await timeout(1000);
                    if (this.calcTime()) break;
                }
            },
            addItem() {
                this.data.virtual_list.push({
                    icon: '',
                    time: '',
                })
                this.data.user_list = this.data.virtual_list;
                    this.data.buy_list = this.data.virtual_list;
            },
            virtualUser(index) {
                this.data.virtual_list.splice(index, 1);
                this.data.user_list = this.data.virtual_list;
                this.data.buy_list = this.data.virtual_list;
            },
            selectBgUrl(e) {
                if (e.length) {
                    this.data.bg_url = e[0].url;
                }
            },
            removeBgUrl() {
                this.data.bg_url = '';
            },
            resetImg() {
                this.data.bg_url = "<?= Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . '/statics/img/mall/form/time-bg.png' ?>";
            },
            changeCard() {
                let ob = {};
                let {has_card} = this.data;
                if (has_card == 1) {
                    ob = {
                        progress_bar_color: '#fa4a3f',
                        progress_bar_end_color: '#ffebea',
                        lr_padding: 24,
                    }
                } else {
                    ob = {
                        progress_bar_color: '#fbc509',
                        progress_bar_end_color: '#DCDFE6',
                        lr_padding: 44,
                    }
                }
                Object.assign(this.data, ob);
            },
        },
    });
</script>
