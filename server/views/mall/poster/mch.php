<?php defined('YII_ENV') or exit('Access Denied');
Yii::$app->loadViewComponent('poster/app-poster-new');
Yii::$app->loadViewComponent('app-radio');
?>
<style>
    .form-body {
        background-color: white;
        margin-bottom: 20px;
        width: 100%;
    }

    .reset {
        position: absolute;
        top: 7px;
        left: 90px;
    }

    .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }

    .c-input {
        width: 70%
    }

    .mch__head {
        margin-top: 20px;
    }

    .mch__head > .el-card__header {
        border-top: 1px solid #EBEEF5;
        border-bottom: 1px solid #EBEEF5;
        background: #F9F9F9;
        font-weight: bold;
        border-radius: 6px 6px 0 0;
    }

    .mch-card {
        border-radius: 0 0 6px 6px;
        padding: 20px;
    }
</style>
<style>
    .mobile-box {
        background-image: url('statics/img/mall/mch/poster/phone.png');
        margin-right: 20px;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        height: 825px;
        display: flex;
        flex-grow: 0;
        flex-shrink: 0;
        width: 419px;
    }

    .mobile-box .select-box {
        position: relative;
        height: 1334px;
        width: 750px;
        top: 132px;
        left: 42px;
        overflow-x: auto;
        text-align: center;
        zoom: 0.5;
    }
</style>
<div id="app" v-cloak>
    <el-card style="border:0" shadow="never" body-style="background-color: #f3f3f3;padding: 0 0;"
             v-loading="cardLoading">
        <div slot="header"><span>自定义海报</span></div>
        <div style="padding-top: 20px" :model="ruleForm" :rules="rules" size="small"
        >
            <div style="display: flex;">
                <div class="mobile-box" flex="dir:top">
                    <div class="select-box" ref="box">
                        <div style="height: 100%;width: 100%;position:absolute;background-size: 100% 100%;background-repeat: no-repeat"
                             :style="editForm.bg_default === 'image' ? 'filter: blur(10px);background-image: url( ' + editForm.card_pic[0] + ')'
                             : 'background-color: ' + editForm.bg_color"></div>
                        <div flex="dir:top cross:center" style="position:relative;">
                            <div style="height: 652px;width: 652px;border-radius: 32px 32px 0 0;margin-top: 104px;overflow:hidden">
                                <image v-if="editForm.is_card == 1" style="height: 100%;width: 100%"
                                       :src="editForm.card_pic[0]"></image>
                            </div>
                            <div :style="{top: `${editForm.shop_info_top + 104}px`}"
                                 v-if="editForm.is_shop == 1"
                                 style="position: absolute;z-index:3;" flex="dir:top main:center cross:center">
                                <!-- 头像 -->
                                <div v-if="editForm.logo_show == 1"
                                     style="height: 140px;width:140px;background: #D8D8D8;border-radius: 50%;border: 6px solid white">
                                </div>
                                <!-- 店铺名称 -->
                                <div v-if="editForm.shop_name_show == 1"
                                     style="margin-top:20px;color:#333333;font-size: 36px">
                                    店铺名称
                                </div>
                                <image style="height: 48px;width: 594px;margin: 0 auto"
                                       ref="calcImage"
                                       src="statics/img/mall/mch/poster/44.png"></image>
                            </div>
                            <!-- 店铺背景 -->
                            <template v-if="editForm.code_pos === 'left'">
                                <div style="width: 652px; background: #FFFFFF;border-radius: 32px;position: relative;margin-top: -40px"
                                     flex="dir:top"
                                >
                                    <!-- 店铺背景 -->
                                    <div flex="dir:left main:justify cross:center"
                                         :style="{marginTop: `${calcHeight}px`}"
                                         style="width: 100%;padding: 20px 30px">
                                        <div flex="dir:top" style="text-align: left">
                                            <div style="font-size: 32px;color:#000000;">{{editForm.code_title}}
                                            </div>
                                            <div style="font-size: 24px;color: #999999"
                                                 :style="{paddingTop: `${editForm.code_title_padding}px`}">
                                                {{editForm.code_sub_title}}
                                            </div>
                                        </div>
                                        <image :style="{height: `${editForm.code_size}px`,width:`${editForm.code_size}px` }"
                                               src="statics/img/mall/poster/default_mobile_qr_code.png"></image>
                                    </div>
                                </div>
                            </template>
                            <template v-if="editForm.code_pos === 'center'">
                                <div style="width: 652px; background: #FFFFFF;border-radius: 32px;position: relative;margin-top: -40px"
                                     flex="dir:top"
                                >
                                    <!-- 店铺背景 -->
                                    <div flex="dir:top main:center cross:center"
                                         :style="{marginTop: `${calcHeight}px`}"
                                         style="width: 100%;padding: 20px 0;text-align: center">
                                        <image :style="{height: `${editForm.code_size}px`,width:`${editForm.code_size}px` }"
                                               src="statics/img/mall/poster/default_mobile_qr_code.png"></image>
                                        <div style="font-size: 32px;color:#000000;">
                                            {{editForm.code_title}}
                                        </div>
                                        <div style="font-size: 24px;color: #999999;padding-top: 12px">
                                            {{editForm.code_sub_title}}
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-if="editForm.code_pos === 'right'">
                                <div style="width: 652px; background: #FFFFFF;border-radius: 32px;position: relative;margin-top: -40px"
                                     flex="dir:top"
                                >
                                    <!-- 店铺背景 -->
                                    <div flex="dir:left cross:center"
                                         :style="{marginTop: `${calcHeight}px`}"
                                         style="width: 100%;padding: 20px 30px">
                                        <image :style="{height: `${editForm.code_size}px`,width:`${editForm.code_size}px` }"
                                               src="statics/img/mall/poster/default_mobile_qr_code.png"></image>
                                        <div flex="dir:top" style="text-align: left;margin-left: 20px">
                                            <div style="font-size: 32px;color:#000000;">{{editForm.code_title}}
                                            </div>
                                            <div style="font-size: 24px;color: #999999"
                                                 :style="{paddingTop: `${editForm.code_title_padding}px`}">
                                                {{editForm.code_sub_title}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div flex="main:center cross:center"
                             style="width: 652px;height: 100px;font-size:32px;position: relative; margin:0 auto;border-radius: 50px;color:white;margin-top: 40px"
                             :style="{background: editForm.btn_theme == 1 ? themeColor : editForm.btn_bg}">
                            {{editForm.btn_title}}
                        </div>
                    </div>
                </div>
                <el-form style="width: 100%;" label-width="120px">
                    <el-card class="form-body" shadow="never" body-style="padding: 0 0;">
                        <div slot="header"><span>背景设置</span></div>
                        <div>
                            <el-form-item label="背景设置">
                                <div flex="dir:top">
                                    <div>
                                        <app-radio turn v-model="editForm.bg_default" label="image">
                                            使用默认背景，即海报背景为用户发布的名片图高斯模糊效果
                                        </app-radio>
                                    </div>
                                    <div @click="mchPosterDialog = true"
                                         style="margin-left: 27px;margin-bottom: 5px;line-height:1;cursor:pointer;font-size: 14px;color:  #409EFF">
                                        查看图例
                                    </div>
                                    <div flex="dir:left cross:center">
                                        <app-radio turn v-model="editForm.bg_default" label="color">背景颜色
                                        </app-radio>
                                        <div flex="dir:left cross:center" style="flex-grow: 1;flex-shrink: 1">
                                            <el-color-picker v-model="editForm.bg_color"
                                                             size="small"></el-color-picker>
                                            <el-input size="small" v-model="editForm.bg_color"
                                                      style="width: 65%;margin-left: 20px"
                                            ></el-input>
                                        </div>
                                    </div>
                                </div>
                            </el-form-item>
                        </div>
                    </el-card>
                    <el-card class="form-body" shadow="never" body-style="padding: 0 0;">
                        <div slot="header"><span style="font-weight: bold;">内容管理</span></div>
                        <div class="mch-card">
                            <div flex="dir:left cross:center">
                                <div flex="dir:top cross:center main:center"
                                     style="margin-right:20px;height:80px;position:relative;width:80px;cursor:pointer;border-radius: 3px;border: 1px solid #DCDFE6;"
                                     @mouseleave="focusIndex = -1"
                                     @mouseover="focusIndex = index"
                                     v-for="(i,index) of config">
                                    <image style="height: 38px;width:38px" :src="i.pic_url"></image>
                                    <div style="font-size: 14px;color: #909399;margin-top: 3px">
                                        {{i.name}}
                                    </div>
                                    <div style="position: absolute;bottom: 0;height: 30px;width: 100%; color: #FFFFFF; font-size: 13px"
                                         v-if="focusIndex == index && (i.value === 'shop' || i.value === 'card')"
                                         @click="editForm[`is_${i.value}`] = +(editForm[`is_${i.value}`] == 0)"
                                         :style="{background: editForm[`is_${i.value}`] == 0 ?  '#409EFF' : '#FF4544'}"
                                         flex="cross:center main:center"
                                    >
                                        {{editForm[`is_${i.value}`] == 0 ? '显示' : '隐藏'}}
                                    </div>
                                    <image style="height: 31px;position:absolute;width: 31px;top: 0;right: 0"
                                           v-if="editForm[`is_${i.value}`] == 0"
                                           src="./statics/img/mall/mch/poster/19.png"></image>
                                </div>
                            </div>
                            <el-card v-if="editForm.is_shop == 1" class="mch__head" shadow="never"
                                     body-style="padding: 0 0;">
                                <div slot="header"><span>店铺信息设置</span></div>
                                <div class="mch-card">
                                    <el-form-item label="logo显示" prop="logo_show">
                                        <el-switch v-model="editForm.logo_show" :active-value="1"
                                                   :inactive-value="0"></el-switch>
                                    </el-form-item>
                                    <el-form-item label="店铺名称显示" prop="shop_name_show">
                                        <el-switch v-model="editForm.shop_name_show" :active-value="1"
                                                   :inactive-value="0"></el-switch>
                                    </el-form-item>
                                    <el-form-item label="店铺信息上间距" prop="shop_info_top"
                                                  v-if="editForm.shop_name_show == 1">
                                        <div flex="dir:left cross:center">
                                            <el-slider :show-tooltip="false" v-model="editForm.shop_info_top"
                                                       class="c-input"
                                                       size="small"
                                                       :max="628"
                                                       show-input></el-slider>
                                            <div style="margin-left: 5px">px</div>
                                        </div>
                                    </el-form-item>
                                </div>
                            </el-card>
                            <el-card class="mch__head" shadow="never"
                                     body-style="padding: 0 0;">
                                <div slot="header"><span>二维码设置</span></div>
                                <div class="mch-card">
                                    <el-form-item label="二维码排列方式" prop="code_pos">
                                        <app-radio turn v-model="editForm.code_pos" label="left">左对齐
                                        </app-radio>
                                        <app-radio turn v-model="editForm.code_pos" label="right">右对齐
                                        </app-radio>
                                        <app-radio turn v-model="editForm.code_pos" label="center">居中对齐
                                        </app-radio>
                                    </el-form-item>

                                    <el-form-item label="二维码大小" prop="code_size">
                                        <div flex="dir:left cross:center">
                                            <el-slider :show-tooltip="false" v-model="editForm.code_size"
                                                       class="c-input"
                                                       size="small"
                                                       :min="90"
                                                       :max="240"
                                                       show-input></el-slider>
                                            <div style="margin-left: 5px">px</div>
                                        </div>
                                    </el-form-item>
                                    <el-form-item label="引导扫码主文案" prop="code_title">
                                        <el-input size="small" maxlength="10" v-model="editForm.code_title"
                                                  class="c-input"
                                                  show-word-limit></el-input>
                                    </el-form-item>
                                    <el-form-item label="引导扫码副文案" prop="code_sub_title">
                                        <el-input size="small" maxlength="16" v-model="editForm.code_sub_title"
                                                  class="c-input"
                                                  show-word-limit></el-input>
                                    </el-form-item>
                                    <el-form-item label="引导文案间间距" prop="code_title_padding"
                                                  v-if="editForm.code_pos !== 'center'">
                                        <div flex="dir:left cross:center">
                                            <el-slider :show-tooltip="false" v-model="editForm.code_title_padding"
                                                       class="c-input"
                                                       size="small"
                                                       :max="160"
                                                       show-input></el-slider>
                                            <div style="margin-left: 5px">px</div>
                                        </div>
                                    </el-form-item>
                                </div>
                            </el-card>
                            <el-card v-if="editForm.is_card == 1" class="mch__head" shadow="never"
                                     body-style="padding: 0 0;">
                                <div slot="header"><span>名片图设置</span></div>
                                <div class="mch-card">
                                    <el-form-item label="图片设置" prop="card_pic">
                                        <app-attachment style="margin-bottom:10px" multiple
                                                        @selected="cardPic">
                                            <el-tooltip effect="dark"
                                                        content="建议尺寸:654 * 654"
                                                        placement="top">
                                                <el-button size="mini">选择图片</el-button>
                                            </el-tooltip>
                                        </app-attachment>

                                        <el-button size="mini" @click="resetImg" class="reset" type="primary">恢复默认
                                        </el-button>
                                        <div flex="dir:left cross:center">
                                            <div v-for="(pic,index) in editForm.card_pic"
                                                 style="margin-right: 20px;display:inline-block;position: relative;cursor: pointer;">
                                                <app-attachment :multiple="false" :max="1"
                                                                @selected="cardPic">
                                                    <app-image mode="aspectFill"
                                                               width="80px"
                                                               height='80px'
                                                               :src="pic">
                                                    </app-image>
                                                </app-attachment>
                                                <el-button v-if="editForm.card_pic.length > 1" class="del-btn"
                                                           size="mini" type="danger" icon="el-icon-close"
                                                           circle
                                                           @click="removeMallLoGoPic(index)"
                                                ></el-button>
                                            </div>
                                        </div>
                                        <div style="font-size: 12px; color: #C0C4CC;line-height: 1">
                                            注：若上传多张图保存名片时名片图将随机设置
                                        </div>
                                    </el-form-item>
                                </div>
                            </el-card>
                            <el-card class="mch__head" shadow="never"
                                     body-style="padding: 0 0;">
                                <div slot="header"><span>按钮设置</span></div>
                                <div class="mch-card">
                                    <el-form-item label="背景设置" prop="btn_theme">
                                        <div flex="dir:top">
                                            <div>
                                                <app-radio turn v-model="editForm.btn_theme" :label="1">使用主题色
                                                </app-radio>
                                            </div>
                                            <div flex="dir:left cross:center">
                                                <app-radio turn v-model="editForm.btn_theme" :label="0">自定义颜色
                                                </app-radio>
                                                <div flex="dir:left cross:center" style="flex-grow: 1;flex-shrink: 1">
                                                    <el-color-picker v-model="editForm.btn_bg"
                                                                     size="small"></el-color-picker>
                                                    <el-input size="small" v-model="editForm.btn_bg"
                                                              style="width: 65%;margin-left: 20px"
                                                    ></el-input>
                                                </div>
                                            </div>
                                        </div>
                                    </el-form-item>
                                    <el-form-item label="按钮文案" prop="btn_title">
                                        <el-input size="small" maxlength="10" v-model="editForm.btn_title"
                                                  class="c-input"
                                                  show-word-limit></el-input>
                                    </el-form-item>
                                </div>
                            </el-card>
                        </div>
                    </el-card>
                    <el-button class="button-item" :loading="btnLoading" type="primary"
                               @click="store('ruleForm')" size="small">保存
                    </el-button>
                </el-form>
                <el-dialog title="自定义海报默认背景图例" :visible.sync="mchPosterDialog" width="40%">
                    <div flex="dir:left main:center" class="app-mch-poster">
                        <div :style="{backgroundImage: 'url(statics/img/mall/mch/poster/22.png)'}"></div>
                    </div>
                    <span slot="footer" class="dialog-footer">
                        <el-button size="small" type="primary" @click="mchPosterDialog = false">我知道了</el-button>
                    </span>
                </el-dialog>
            </div>
        </div>
    </el-card>
</div>
<style>
    .app-mch-poster {
        height: 667px;
        width: 375px;
        margin: 0 auto;
    }

    .app-mch-poster > div {
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 100%;
        width: 100%;
    }
</style>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            const host = "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>";
            return {
                mchPosterDialog: false,
                themeColor: '',
                config: [
                    {
                        name: '店铺信息',
                        pic_url: './statics/img/mall/mch/poster/23.png',
                        value: 'shop',
                    },
                    {
                        name: '二维码',
                        pic_url: './statics/img/mall/mch/poster/29.png',
                        value: 'code'
                    },
                    {
                        name: '名片图',
                        pic_url: './statics/img/mall/mch/poster/40.png',
                        value: 'card'
                    },
                    {
                        name: '按钮设置',
                        pic_url: './statics/img/mall/mch/poster/41.png',
                        value: 'btn',
                    }
                ],
                editForm: {
                    bg_default: 'image',
                    btn_title: '保存店铺名片',
                    btn_theme: 1,
                    bg_color: '#FFFFFF',
                    btn_bg: '#FF4544',
                    card_pic: [host + 'statics/img/mall/mch/poster/welcome.png'],
                    code_size: 40,
                    code_title: '扫一扫，查看店铺',
                    code_sub_title: '和我一起查看店铺优质商品吧！',
                    logo_show: 1,
                    code_pos: 'left',
                    code_title_padding: 12,
                    shop_name_show: 1,
                    shop_info_top: 722,
                    is_shop: 1,
                    is_card: 1,
                },
                focusIndex: -1,


                ruleForm: null,
                rules: {},

                btnLoading: false,
                cardLoading: false,
                calcHeight: 0,
            };
        },
        watch: {
            'editForm.logo_show': 'calcWidth',
            'editForm.is_shop': 'calcWidth',
            'editForm.shop_name_show': 'calcWidth',
            'editForm.shop_info_top': 'calcWidth',
        },
        methods: {
            calcWidth() {
                const self = this;
                this.$nextTick(_ => {
                    try {
                        let dom = self.$refs.calcImage.getBoundingClientRect();
                        let box = self.$refs.box.getBoundingClientRect();
                        let h = dom.top - box.top;
                        self.calcHeight = this.editForm.shop_name_show == 1 ? h > 683 ? h - 683 : 0 : 0;
                    } catch (err) {
                        self.calcHeight = 0;
                        console.log(self.calcHeight);
                    }
                })
            },
            cardPic(e) {
                this.editForm.card_pic = this.editForm.card_pic.concat(e.map(_ => _.url));
            },
            resetImg() {
                const host = "<?php echo \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl . "/" ?>";
                this.editForm.card_pic = [host + 'statics/img/mall/mch/poster/welcome.png'];
            },
            removeMallLoGoPic(index) {
                this.editForm.card_pic.splice(index, 1);
            },


            store() {
                const self = this;
                self.btnLoading = true;
                request({
                    params: {
                        r: 'mall/poster/mch',
                    },
                    method: 'post',
                    data: {
                        form: JSON.stringify(self.editForm),
                    }
                }).then(e => {
                    self.btnLoading = false;
                    if (e.data.code === 0) {
                        self.$message.success(e.data.msg);
                    } else {
                        self.$message.error(e.data.msg);
                    }
                });
            },


            submit() {
                const self = this;
                self.btnLoading = true;
                request({
                    params: {
                        r: 'mall/poster/mch',
                    },
                    method: 'post',
                    data: {
                        form: JSON.stringify(self.editForm),
                    }
                }).then(e => {
                    self.btnLoading = false;
                    if (e.data.code === 0) {
                        self.$message.success(e.data.msg);
                    } else {
                        self.$message.error(e.data.msg);
                    }
                });
            },
            getPoster() {
                let self = this;
                self.cardLoading = true;
                request({
                    params: {
                        r: 'mall/poster/mch',
                    },
                }).then(e => {
                    self.cardLoading = false;
                    if (e.data.code === 0) {
                        this.editForm = e.data.data.config;
                        this.themeColor = e.data.data.themeColor;
                    } else {
                        self.$message.error(e.data.msg);
                    }
                });
            },
        },
        mounted: function () {
            this.getPoster();
        }
    });
</script>
