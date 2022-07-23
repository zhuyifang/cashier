<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/5/5
 * Time: 17:48
 */
?>
<style>
    .chooseLink .el-input-group__append {
        background-color: #fff;
    }

    .diy-component-preview .bg {
        height: 140px;
        color: #fff;
        background-color: white;
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    .diy-component-edit .del-btn {
        position: absolute;
        top: -8px;
        width: 25px;
        height: 25px;
        padding: 0 !important;
        border-width: 0px;
        z-index: 1;
        background: #ff4544 !important;
        color: white !important;
    }

    .diy-component-edit .reset {
        position: absolute;
        top: 3px;
        left: 90px;
    }

    .diy-timer .el-form-item__label {
        width: 150px !important;
    }

    .diy-timer .el-form-item__content {
        margin-left: 150px !important;
    }

    .diy-timer ._t .el-form-item__label {
        width: 100px !important;
    }

    .diy-timer ._t .el-form-item__content {
        margin-left: 100px !important;
    }

    .diy-timer-type2 .time-label {
        font-size: 28px;
        color: #FFFFFF;
        line-height: 40px;
        margin-bottom: 6px;
    }

    .diy-timer-type2 .time-box {
        width: 42px;
        line-height: 40px;
        font-size: 28px;
        border-radius: 4px;
    }

    .diy-timer-type2 .time-text {
        margin: 0 4px;
    }

    .diy-timer-type3 .time-label {
        font-size: 30px;
        width: 100%;
        margin-bottom: 10px;
    }

    .diy-timer-type3 .time-box {
        width: 68px;
        line-height: 64px;
        font-size: 45px;
        border-radius: 6px;
    }

    .diy-timer-type3 .time-text {
        margin: 0 18px;
    }

    .diy-timer-type3 .line {
        height: 1px;
        width: 60px;
        border-top-style: dashed;
        border-top-width: 2px;
    }

    .diy-timer-type4 .time-label {
        text-align: center;
        font-weight: 800;
        width: 100%;
        margin-bottom: 20px;
    }

    .diy-timer-type4 .time-box {
        width: 42px;
        line-height: 40px;
        font-size: 28px;
        border-radius: 4px;
    }


    .diy-timer-type4 .time-text {
        margin: 0 8px;
    }

    .t-omit {
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
        white-space: nowrap;
    }
</style>
<template id="diy-timer">
    <div class="diy-timer">
        <div class="diy-component-preview">
            <div style="font-size: 0;">
                <img v-if="data.picUrl" :src="data.picUrl" style="width: 100%;height: auto;">
            </div>
            <div class="bg" :style="'background-image: url('+data.bgPicUrl+');padding-top:' + data.c_padding_top +'px'">
                <div v-if="data.type == 1" :style="{paddingLeft: `${data.c_padding_left}px`}">
                    <div :style="{color: data.title_color}" class="time-label">{{data.title_before}}</div>
                    <div :style="{color: data.text_color}">xx天xx小时xx分xx秒</div>
                </div>
                <div v-if="data.type == 2" class="diy-timer-type2" :style="{paddingLeft: `${data.c_padding_left}px`}">
                    <div :style="{color: data.title_color}" class="time-label">{{data.title_before}}</div>
                    <div :style="{color: data.place_text_color}" flex="dir:left cross:center">
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">0</div>
                        <div class="time-text">天</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">30</div>
                        <div class="time-text">时</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">30</div>
                        <div class="time-text">分</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">30</div>
                        <div class="time-text">秒</div>
                    </div>
                </div>
                <div v-if="data.type == 3" class="diy-timer-type3">
                    <div :style="{color: data.title_color}" flex="dir:left cross:center main:center" class="time-label">
                        <div class="line" :style="{borderColor: data.title_color}"></div>
                        <div style="margin: 0 18px;line-height: 1">{{data.title_before}}</div>
                        <div class="line" :style="{borderColor: data.title_color}"></div>
                    </div>
                    <div :style="{color: data.place_text_color}" flex="dir:left cross:center main:center">
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">0</div>
                        <div class="time-text">天</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">30</div>
                        <div class="time-text">时</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">30</div>
                        <div class="time-text">分</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">30</div>
                        <div class="time-text">秒</div>
                    </div>
                </div>
                <div v-if="data.type == 4" class="diy-timer-type4">
                    <div :style="{color: data.place_text_color}" flex="dir:left cross:center main:center">
                        <div :style="{color: data.title_color}" class=" t-omit"  style="margin-right: 18px">{{data.title_before}}</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">0</div>
                        <div class="time-text">天</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">33</div>
                        <div class="time-text">:</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">33</div>
                        <div class="time-text">:</div>
                        <div flex="main:center cross:center" class="time-box" :style="[typeFour]">33</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>倒计时</div>
            </div>
            <el-form label-width="100px" @submit.native.prevent style="padding: 20px 0" size="small">
                <el-form-item label="图片">
                    <app-image-upload v-model="data.picUrl"></app-image-upload>
                </el-form-item>
                <el-form-item prop="type" label="倒计时样式">
                    <app-radio @click.native="changeType(1)" v-model="data.type" :label="1" turn>样式一</app-radio>
                    <app-radio @click.native="changeType(2)" v-model="data.type" :label="2" turn>样式二</app-radio>
                    <app-radio @click.native="changeType(3)" v-model="data.type" :label="3" turn>样式三</app-radio>
                    <app-radio @click.native="changeType(4)" v-model="data.type" :label="4" turn>样式四</app-radio>
                </el-form-item>
                <el-form-item label="背景图片" prop="bgPicUrl">
                    <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                    @selected="mallLogoPic">
                        <el-tooltip effect="dark"
                                    content="建议尺寸:750 * 140"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1"
                                        @selected="mallLogoPic">
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height='80px'
                                       :src="data.bgPicUrl">
                            </app-image>
                        </app-attachment>
                        <el-button v-if="data.bgPicUrl" class="del-btn"
                                   size="mini" type="delete" icon="el-icon-close"
                                   circle
                                   @click="removeMallLoGoPic"></el-button>
                    </div>
                    <el-button size="mini" @click="resetImg(data.type)" class="reset" type="primary">恢复默认</el-button>
                </el-form-item>
                <el-form-item prop="title" label="活动前标题自定义">
                    <el-input v-model="data.title_before" size="small" :maxlength="14" show-word-limit></el-input>
                </el-form-item>
                <el-form-item prop="title" label="活动中标题自定义">
                    <el-input v-model="data.title_progress" size="small" :maxlength="14" show-word-limit></el-input>
                </el-form-item>
                <el-form-item prop="title" label="活动后标题自定义">
                    <el-input v-model="data.title_after" size="small" :maxlength="14" show-word-limit></el-input>
                </el-form-item>
                <el-form-item label="倒计时位置">
                    <div class="_t"
                         style="border: 1px solid #e2e2e2;border-radius:6px;padding-top: 15px;min-width:500px">
                        <el-form-item label="上边距">
                            <div flex="dir:left">
                                <el-slider style="width: 50%;margin-right: 20px" input-size="mini"
                                           v-model="data.c_padding_top"
                                           :min="0"
                                           :show-tooltip="false"></el-slider>
                                <el-input-number size="small" v-model="data.c_padding_top" :min="0"
                                                 label="上边距"></el-input-number>
                                <div style="margin-left: 10px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="左边距" v-if="data.type == 1 || data.type == 2">
                            <div flex="dir:left">
                                <el-slider style="width: 50%;margin-right: 20px" input-size="mini"
                                           v-model="data.c_padding_left"
                                           :min="0"
                                           :show-tooltip="false"></el-slider>
                                <el-input-number size="small" v-model="data.c_padding_left" :min="0"
                                                  label="左边距"></el-input-number>
                                <div style="margin-left: 10px">px</div>
                            </div>
                        </el-form-item>
                    </div>
                </el-form-item>

                <el-form-item class="chooseLink" label="链接">
<!--                    <el-input v-model="data.link.url" placeholder="点击选择链接" :disabled="true"-->
<!--                              size="small">-->
                        <app-pick-link @selected="linkSelected" :show-customer="false" :link="data.link.data ? data.link.data : {url: data.link.url}">
<!--                            <el-button size="small">选择链接</el-button>-->
                        </app-pick-link>
<!--                    </el-input>-->
                </el-form-item>
                <el-form-item label="开始时间" required>
                    <el-date-picker v-model="data.startDateTime"
                                    size="small"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    type="datetime"
                                    placeholder="选择日期时间">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="结束时间" required>
                    <el-date-picker v-model="data.endDateTime"
                                    size="small"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    type="datetime"
                                    placeholder="选择日期时间">
                    </el-date-picker>
                </el-form-item>

                <div class="app-form-box-label">
                    颜色设置
                </div>
                <div flex="dir:top" style="flex-wrap: wrap;">
                    <el-form-item label="标题文案颜色">
                        <color v-model="data.title_color"></color>
                    </el-form-item>
                    <el-form-item label="倒计时文字颜色">
                        <color v-model="data.text_color"></color>
                    </el-form-item>
                    <el-form-item label="倒计时辅助文字颜色" v-if="data.type != 1">
                        <color v-model="data.place_text_color"></color>
                    </el-form-item>
                    <el-form-item label="倒计时背景颜色" v-if="data.type != 1">
                        <color v-model="data.bg_color"></color>
                    </el-form-item>
                </div>
            </el-form>
        </div>
    </div>
</template>
<script>
    Vue.component('diy-timer', {
        template: '#diy-timer',
        props: {
            value: Object,
        },
        data() {
            const host = "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>";
            return {
                open: false,
                bottomBg: _currentPluginBaseUrl + '/images/timer-bottom-bg.png',
                data: {
                    picUrl: '',
                    link: {
                        url: '',
                        openType: '',
                        bgPicUrl: _currentPluginBaseUrl + '/images/timer-bottom-bg.png',
                    },
                    startDateTime: '',
                    endDateTime: '',
                    type: 1,
                    title_before: '距离活动开始还有',
                    title_progress: '距离活动结束还有',
                    title_after: '活动已结束',
                    c_padding_top: 30,
                    c_padding_left: 24,
                    title_color: '#FFFFFF',
                    text_color: '#FF4544',
                    place_text_color: '#FFFFFF',
                    bg_color: '#FFFFFF',
                    bgPicUrl: host + 'statics/img/mall/diy/timer-bottom-bg.png'
                }
            };
        },
        created() {
            if (!this.value) {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
            }
            this.open = true;
        },
        computed: {
            typeFour() {
                let {bg_color, text_color} = this.data;
                return {
                    background: bg_color,
                    color: text_color,
                }
            }
        },
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            },
        },
        methods: {
            changeType(type) {
                if (type == 4) {
                    const host = "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>";
                    Object.assign(this.data, {
                        bgPicUrl: host + 'statics/img/mall/diy/timer-bottom-bg-2.png',
                        c_padding_top: 86,
                        title_color: '#FFFFFF',
                        text_color: '#FF4544',
                        place_text_color: '#ffffff',
                        bg_color: '#FFFFFF',
                    })
                }
                if (type == 3) {
                    Object.assign(this.data, {
                        bgPicUrl: '',
                        c_padding_top: 12,
                        title_color: '#999999',
                        text_color: '#FF4544',
                        place_text_color: '#999999',
                        bg_color: '#FFF4F4',
                    })
                }
                if (type == 2) {
                    const host = "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>";
                    Object.assign(this.data, {
                        bgPicUrl: host + 'statics/img/mall/diy/timer-bottom-bg.png',
                        c_padding_top: 24,
                        c_padding_left: 24,
                        title_color: '#FFFFFF',
                        text_color: '#FF4544',
                        place_text_color: '#FFFFFF',
                        bg_color: '#FFFFFF',
                    })
                }
                if (type == 1) {
                    const host = "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>";
                    Object.assign(this.data, {
                        bgPicUrl: host + 'statics/img/mall/diy/timer-bottom-bg.png',
                        c_padding_top: 30,
                        c_padding_left: 24,
                        title_color: '#FFFFFF',
                        text_color: '#FFFFFF',
                    })
                }
            },
            resetImg(type) {
                const host = "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>";
                if(type == 1){
                    this.data.bgPicUrl = host + 'statics/img/mall/diy/timer-bottom-bg.png';
                }
                if(type == 2){
                    this.data.bgPicUrl = host + 'statics/img/mall/diy/timer-bottom-bg.png';
                }
                if(type == 3){
                    this.data.bgPicUrl = '';
                }
                if(type == 4){
                    this.data.bgPicUrl = host + 'statics/img/mall/diy/timer-bottom-bg-2.png';
                }

            },
            removeMallLoGoPic() {
                this.data.bgPicUrl = '';
            },
            mallLogoPic(e) {
                if (e.length) {
                    this.data.bgPicUrl = e[0].url;
                }
            },
            linkSelected(list) {
                if (!list || !list.length) {
                    return;
                }
                this.data.link.url = list[0].new_link_url;
                this.data.link.openType = list[0].open_type;
                this.data.link.data = list[0];
            },
        }
    });
</script>
