<style>
    .diy-mch-home .mch-home-head {
        width: 100%;
        overflow :hidden;
        position: relative;
    }

    .diy-mch-home .select-input {
        text-align: center;
        width: 98px;
        min-width: 98px;
        height: 70px;
        background: #FFFFFF;
        cursor: pointer;
        border-radius: 3px;
        margin-right: 20px;
        border: 1px solid #DCDFE6;
    }

    .diy-mch-home .select-input span {
        line-height: 1;
        margin-top: 10px;
    }

    .diy-mch-home .select-input.active {
        border-color: #409EFF;
        color: #409eff;
    }

    .diy-mch-home .mch-home-padding {
        padding: 20px;
        min-width: 500px;
        border-radius: 5px;
        border: 1px solid #DCDFE6;
    }


    .diy-mch-home .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }

    .diy-mch-home .reset {
        position: absolute;
        top: 6px !important;
        left: 90px;
    }
</style>
<style>
    .diy-shop-header {
        position: relative;
        z-index: 33;
    }
    .line-padding {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        display: block;
    }

    .line-padding  > div {
        padding-left: 24px;
        white-space: nowrap;
        display: inline-block;
    }

    .line-padding  > div:first-child {
        padding-left: 0;
    }

    .btn-all {
        position: absolute;
        z-index: 4;
    }


    .btn-all .gz-btn-icon {
        height: 30px;
        width: 28px;
    }

    .btn-all .kf-btn-icon {
        height: 30px;
        width: 30px;
    }

    .shop-bg {
        position: relative;
        width: 100%;
        display: block;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 310px;
    }
    .shop-bg .shop-mo {
        height: inherit;
        background-image: linear-gradient(180deg, rgba(255, 255, 255, 0), #ffffff);
    }


    .diy-shop-header .shop-label {
        font-weight: bolder;
    }

    .diy-shop-header .shop-pos-text {
        color: white;
        font-size: 24px;
    }

    .diy-shop-header .box-grow-1 {
        display: flex;
        flex-shrink: 1;
        flex-grow: 1;
    }

    .diy-shop-header .box-grow-0 {
        display: flex;
        flex-shrink: 0;
        flex-grow: 0;
    }

    .diy-shop-header .t-omit {
        display: inline-block;
        white-space: nowrap;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .diy-mch-home .el-form-item .el-form-item .el-form-item__label {
        width: 100px !important;
    }

    .diy-mch-home .el-form-item .el-form-item .el-form-item__content {
        margin-left: 100px !important;
    }
</style>
<template id="diy-mch-home">
    <div class="diy-mch-home">
        <div class="diy-component-preview">
            <div class="mch-home-head diy-shop-header">
                <div class="shop-bg" :style="[endStyle]">
                    <div class="shop-mo"
                          :style="{ backgroundImage: `linear-gradient(180deg, rgba(0, 0, 0, .3), ${data.bg_type === 'gradient' ? 'white' :'rgba(0, 0, 0, .3)' })`}"
                    ></div>
                    <div class="btn-all" flex="dir:left cross:center"
                         :style="{top: `${data.gk_top}px`,left: `${data.gk_left}px`}">
                        <div flex="dir:left cross:center" class="box-grow-0">
                            <image class="box-grow-0 gz-btn-icon" :src="data.nolove_pic"></image>
                            <div class="box-grow-0 shop-pos-text"
                                 :style="{color: data.gk_color,paddingLeft: `${data.gk_cen}px`}">
                                <template>关注</template>
                            </div>
                        </div>
                        <div flex="dir:left cross:center" class="box-grow-0"
                             :style="{marginLeft: `${data.gk_margin}px`}">
                            <image class="box-grow-0 kf-btn-icon" :src="data.tel_pic"></image>
                            <div class="box-grow-0 shop-pos-text"
                                 :style="{color: data.gk_color,paddingLeft: `${data.gk_cen}px`}">客服
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="data.box_access_style === 'around'" :style="[boxStyle]" flex="dir:left cross:center">
                    <image class="box-grow-0" :style="[logoStyle]" :src="mchData.cover_url"></image>
                    <div class="box-grow-1" flex="dir:top main:center"
                         :style="{marginLeft: `${data.basic_center}px`, width: `calc(100% - ${data.logo_size}px - ${data.basic_left * 2}px - ${data.basic_center}px)`}">
                        <div :style="[nameTextStyle,calcWidth]" class="t-omit shop-label" style="margin-bottom: 16px">
                            {{mchData.name}}
                        </div>
                        <div :style="[placeTextStyle]" class=" line-padding" flex="dir:left">
                            <div v-if="data.has_goods_num" class="box-grow-0">商品：{{mchData.goods_count}}</div>
                            <div v-if="data.has_shop_num" class="box-grow-0">已售：{{mchData.order_goods_count}}</div>
                            <div v-if="data.has_assess_num" class="box-grow-0">{{mchData.comment_count}}条评价</div>
                        </div>
                    </div>
                </div>
                <div v-if="data.box_access_style === 'down'" flex="dir:top cross:center" :style="[boxStyle]">
                    <image class="box-grow-0" style="position: absolute;"
                           :style="[logoStyle,{top:data.box_placed_style == 2 ? `calc(-${data.logo_size / 2}px)` : `${data.basic_top}px`}]"
                           :src="mchData.cover_url"></image>
                    <div :style="[nameTextStyle,{paddingTop: data.box_placed_style == 2 ? `calc(${data.logo_size / 2}px)` : `${data.logo_size}px` }, calcWidth]"
                         style="text-align: center"
                         class="t-omit shop-label">
                        {{mchData.name}}
                    </div>
                    <div :style="[placeTextStyle]" class=" line-padding" flex="dir:left">
                        <div v-if="data.has_goods_num" class="box-grow-0">商品：{{mchData.goods_count}}</div>
                        <div v-if="data.has_shop_num" class="box-grow-0">已售：{{mchData.order_goods_count}}</div>
                        <div v-if="data.has_assess_num" class="box-grow-0">{{mchData.comment_count}}条评价</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>店铺信息</div>
            </div>
            <el-form label-width="150px" @submit.native.prevent style="padding: 20px 0">
                <el-form-item label="背景颜色" v-if="data.has_bg == 0">
                    <color v-model="data.bg_color" height></color>
                </el-form-item>
                <el-form-item label="背景图片">
                    <el-switch v-model="data.has_bg" :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item label="上传背景" v-if="data.has_bg == 1">
                    <app-image-upload width="750" height="310" v-model="data.bg_pic"></app-image-upload>
                </el-form-item>
                <el-form-item label="显示形式">
                    <app-radio turn v-model="data.bg_type" label="pure">全显</app-radio>
                    <app-radio turn v-model="data.bg_type" label="gradient">渐隐</app-radio>
                </el-form-item>
                <el-form-item label="店铺名称文案颜色">
                    <color v-model="data.title_color" height></color>
                </el-form-item>
                <el-form-item label="店铺名称字号设置">
                    <div flex="dir:left cross:center">
                        <el-slider :show-tooltip="false" v-model="data.title_size"
                                   style="width: 100%" size="small"
                                   :max="50"
                                   show-input></el-slider>
                        <div style="margin-left: 5px">px</div>
                    </div>
                </el-form-item>
                <el-form-item label="辅助信息文案颜色">
                    <color v-model="data.place_color" height></color>
                </el-form-item>
                <el-form-item label="辅助信息字号设置">
                    <div flex="dir:left cross:center">
                        <el-slider :show-tooltip="false" v-model="data.place_size"
                                   style="width: 100%" size="small"
                                   :max="50"
                                   show-input></el-slider>
                        <div style="margin-left: 5px">px</div>
                    </div>
                </el-form-item>
                <el-form-item label="店铺头像大小">
                    <div flex="dir:left cross:center">
                        <el-slider :show-tooltip="false" v-model="data.logo_size"
                                   style="width: 100%" size="small"
                                   :max="160"
                                   show-input></el-slider>
                        <div style="margin-left: 5px">px</div>
                    </div>
                </el-form-item>
                <el-form-item label="基本信息组合样式">
                    <div flex="dir:left cross:center">
                        <div class="select-input" flex="dir:top main:center cross:center"
                             @click="changeBoxAccessStyle('around')"
                             :class="{active: data.box_access_style === 'around'}">
                            <el-image style="height: 16px;width: 58px" :src="_appImg + 'access-1.png'"></el-image>
                            <span>左右排布</span>
                        </div>
                        <div class="select-input" flex="dir:top main:center cross:center"
                             @click="changeBoxAccessStyle('down')"
                             :class="{active: data.box_access_style === 'down'}">
                            <el-image style="height: 25px;width:38px" :src="_appImg + 'access-2.png'"></el-image>
                            <span>上下排布</span>
                        </div>
                    </div>
                </el-form-item>
                <el-form-item label="基本信息摆放样式">
                    <div flex="dir:left cross:center">
                        <div class="select-input" flex="dir:top main:center cross:center"
                             @click="changePlacedStyle(1)"
                             :class="{active: data.box_placed_style == 1}">
                            <el-image style="height: 28px;width: 58px" :src="_appImg + 'placed-1.png'"></el-image>
                            <span>样式一</span>
                        </div>
                        <div class="select-input" flex="dir:top main:center cross:center"
                             @click="changePlacedStyle(2)"
                             :class="{active: data.box_placed_style == 2}">
                            <el-image style="height: 24px;width: 58px" :src="_appImg + 'placed-2.png'"></el-image>
                            <span>样式二</span>
                        </div>
                        <div class="select-input" flex="dir:top main:center cross:center"
                             @click="changePlacedStyle(3)"
                             :class="{active: data.box_placed_style == 3}">
                            <el-image style="height: 28px;width: 58px" :src="_appImg + 'placed-3.png'"></el-image>
                            <span>样式三</span>
                        </div>
                    </div>
                </el-form-item>
                <el-form-item label="卡片圆角设置" v-if="data.box_placed_style == 1 || data.box_placed_style == 3">
                    <div flex="dir:left cross:center">
                        <el-slider :show-tooltip="false" v-model="data.box_radius"
                                   style="width: 100%" size="small"
                                   show-input></el-slider>
                        <div style="margin-left: 5px">px</div>
                    </div>
                </el-form-item>
                <el-form-item label="基本信息边距">
                    <div class="mch-home-padding">
                        <el-form-item label="上边框">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.basic_top"
                                           style="width: 100%" size="small"
                                           :max="300"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="左边框" v-if="data.box_access_style == 'around'">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.basic_left"
                                           style="width: 100%" size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="信息间间距" v-if="data.box_access_style != 'down' || data.box_placed_style != 2">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.basic_center"
                                           style="width: 100%" size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                    </div>
                </el-form-item>


                <el-form-item label="关注按钮" prop="nolove_pic">
                    <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                    @selected="selectNoLovePic">
                        <el-tooltip effect="dark"
                                    content="建议尺寸:30 * 30"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1"
                                        @selected="selectNoLovePic">
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height='80px'
                                       :src="data.nolove_pic">
                            </app-image>
                        </app-attachment>
                        <el-button v-if="data.nolove_pic" class="del-btn"
                                   size="mini" type="danger" icon="el-icon-close"
                                   circle
                                   @click="removeNoLovePic"
                        ></el-button>
                    </div>
                    <el-button size="mini" @click="resetImg('nolove_pic')" class="reset" type="primary">恢复默认
                    </el-button>
                </el-form-item>
                <el-form-item label="已关注按钮" prop="love_pic">
                    <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                    @selected="selectLovePic">
                        <el-tooltip effect="dark"
                                    content="建议尺寸:30 * 30"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1"
                                        @selected="selectLovePic">
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height='80px'
                                       :src="data.love_pic">
                            </app-image>
                        </app-attachment>
                        <el-button v-if="data.love_pic" class="del-btn"
                                   size="mini" type="danger" icon="el-icon-close"
                                   circle
                                   @click="removeLovePic"
                        ></el-button>
                    </div>
                    <el-button size="mini" @click="resetImg('love_pic')" class="reset" type="primary">恢复默认
                    </el-button>
                </el-form-item>
                <el-form-item label="客服按钮" prop="tel_pic">
                    <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                    @selected="selectTelPic">
                        <el-tooltip effect="dark"
                                    content="建议尺寸:30 * 30"
                                    placement="top">
                            <el-button size="mini">选择图片</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1"
                                        @selected="selectTelPic">
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height='80px'
                                       :src="data.tel_pic">
                            </app-image>
                        </app-attachment>
                        <el-button v-if="data.tel_pic" class="del-btn"
                                   size="mini" type="danger" icon="el-icon-close"
                                   circle
                                   @click="removeTelPic"></el-button>
                    </div>
                    <el-button size="mini" @click="resetImg('tel_pic')" class="reset" type="primary">恢复默认
                    </el-button>
                </el-form-item>
                <el-form-item label="按钮文案颜色">
                    <color v-model="data.gk_color" height></color>
                </el-form-item>
                <el-form-item label="客服按钮跳转选择" prop="service_type">
                    <el-radio v-model="data.service_type" :label="1">客服外链</el-radio>
                    <el-radio v-model="data.service_type" :label="2">拨打电话</el-radio>
                </el-form-item>
                <el-form-item label="按钮边距">
                    <div class="mch-home-padding">
                        <el-form-item label="上边框">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.gk_top"
                                           style="width: 100%" size="small"
                                           :max="300"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="左边距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.gk_left"
                                           style="width: 100%" size="small"
                                           :max="700"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="按钮文案间距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.gk_cen"
                                           style="width: 100%" size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="按钮间间距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.gk_margin"
                                           style="width: 100%" size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                    </div>
                </el-form-item>
                <el-form-item label="商品数量">
                    <el-switch v-model="data.has_goods_num" :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item label="已售数量">
                    <el-switch v-model="data.has_shop_num" :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
                <el-form-item label="评价数量">
                    <el-switch v-model="data.has_assess_num" :active-value="1" :inactive-value="0"></el-switch>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<script>
    Vue.component('diy-mch-home', {
        template: '#diy-mch-home',
        props: {
            value: Object,
            mchData: Object,
        },
        data() {
            return {
                data: {
                    bg_color: '#ffffff',
                    has_bg: 1,
                    bg_type: 'pure',
                    title_color: '#333333',
                    title_size: 40,
                    place_color: '#999999',
                    place_size: 28,
                    logo_size: 128,
                    box_access_style: 'around',
                    box_placed_style: 1,
                    box_radius: 40,
                    basic_top: 24,
                    basic_left: 24,
                    basic_center: 24,
                    service_type: 2,


                    gk_color: '#999999',
                    gk_top: 270,
                    gk_left: 526,
                    gk_cen: 10,
                    gk_margin: 10,
                    nolove_pic: _appImg + 'home-nolove_pic-y.png',
                    love_pic: _appImg + 'home-love_pic-y.png',
                    tel_pic: _appImg + 'home-tel_pic-y.png',
                    has_goods_num: 1,
                    has_shop_num: 1,
                    has_assess_num: 1,
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
        computed: {
            calcWidth() {
                let {
                    box_access_style,
                    basic_left,
                    basic_center,
                    logo_size,
                    box_placed_style,
                    basic_top,
                    gk_top,
                    gk_left,
                    title_size
                } = this.data;
                let w = 24;
                if (box_placed_style == 3)
                    w += 24;

                if (box_access_style === 'around') {
                    w += basic_left + basic_center + logo_size;
                    let t = box_placed_style == 2 ? 0 : 220;
                    let first_top = t + basic_top - 12;
                    let first_bottom = t + basic_top + title_size + 12;
                    if (first_top < gk_top && first_bottom > gk_top) {
                        w += 750 - gk_left
                    }
                    return {maxWidth: `${750 > w ? 750 - w : 0}px`};
                } else {
                    let first_top = 0;
                    let first_bottom = 0;
                    let c_height = 0;
                    if (box_placed_style == 1) {
                        c_height = 310 - 90;
                    }
                    if (box_placed_style == 2) {
                        c_height = 310;
                    }
                    if (box_placed_style == 3) {
                        c_height = 310 - 102;
                    }
                    c_height += logo_size / 2;
                    first_top = c_height + basic_top - 12;
                    first_bottom = c_height + basic_top + title_size + 12;
                    if (first_top < gk_top && first_bottom > gk_top) {
                        w += (750 - gk_left) * 2;
                    }
                    return {maxWidth: `${750 > w ? 750 - w : 0}px`};
                }
            },
            endStyle() {
                let {has_bg, bg_pic, bg_color} = this.data;
                let style = has_bg == 1 ? {backgroundImage: `url(${bg_pic})`} : {backgroundColor: bg_color};
                return style;
            },
            boxStyle() {
                let {box_radius, basic_top, basic_left, logo_size, box_placed_style, box_access_style,basic_center} = this.data;
                let style = {position: 'relative'};
                if (box_placed_style == 1) {
                    Object.assign(style, {
                        background: 'white',
                        padding: `${(box_access_style === 'down' ? basic_center: 0) + basic_top}px ${basic_left}px 24px`,
                        borderRadius: `${box_radius}px ${box_radius}px 0 0`,
                        top: `calc(220px - 310px)`,
                        marginBottom: `calc(220px - 310px)`,
                    })
                } else if (box_placed_style == 2) {
                    if (box_access_style === 'around') {
                        Object.assign(style, {
                            background: 'none',
                            padding: `0 ${basic_left}px`,
                            top: `calc(${basic_top}px - 310px)`,
                            marginBottom: `${-logo_size}px`,
                        })
                    }
                    if (box_access_style === 'down') {
                        Object.assign(style, {
                            top: 0,
                            marginBottom: 0,
                            background: 'white',
                            padding: `${basic_top}px ${basic_left}px 24px`,
                        })
                    }
                } else if (box_placed_style == 3) {
                    Object.assign(style, {
                        background: 'white',
                        padding: `${(box_access_style === 'down' ? basic_center: 0) + basic_top}px ${basic_left}px 24px`,
                        borderRadius: `${box_radius}px`,
                        boxShadow: '0 0 30px 0 rgba(0, 0, 0, 0.1)',
                        top: `calc(208px - 310px)`,
                        margin: `0 24px calc(208px - 310px + 30px)`
                    })
                }
                return style;
            },
            logoStyle() {
                let {logo_size} = this.data;
                return {
                    height: `${logo_size}px`,
                    width: `${logo_size}px`,
                    display: 'block',
                    borderRadius: `20px`,
                }
            },
            nameTextStyle() {
                let {title_color, title_size} = this.data;
                return {color: title_color, fontSize: `${title_size}px`};
            },
            placeTextStyle() {
                let {place_color, place_size} = this.data;
                return {color: place_color, fontSize: `${place_size}px`};
            },
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
            commonC(){
                let {box_placed_style,box_access_style} = this.data;
                let s = {}
                if (box_access_style === 'around') {
                    if (box_placed_style == 1) {
                        s = {
                            basic_top: 24,
                            basic_left: 24,
                            basic_center: 24,
                            gk_top: 270,
                            gk_left: 526,
                            gk_cen: 10,
                            gk_margin: 10,
                        }
                    }
                    if (box_placed_style == 2) {
                        s = {
                            basic_top: 160,
                            basic_left: 24,
                            basic_center: 24,
                            gk_top: 180,
                            gk_left: 526,
                            gk_cen: 10,
                            gk_margin: 10,
                        }
                    }
                    if (box_placed_style == 3) {
                        s = {
                            basic_top: 24,
                            basic_left: 24,
                            basic_center: 24,
                            gk_top: 254,
                            gk_left: 502,
                            gk_cen: 10,
                            gk_margin: 10,
                        }
                    }
                }
                if (box_access_style === 'down') {
                    if (box_placed_style == 1) {
                        s = {
                            basic_top: 24,
                            basic_left: 24,
                            basic_center: 24,
                            gk_top: 258,
                            gk_left: 526,
                            gk_cen: 10,
                            gk_margin: 10,
                        }
                    }
                    if (box_placed_style == 2) {
                        s = {
                            basic_top: 24,
                            basic_left: 24,
                            basic_center: 24,
                            gk_top: 242,
                            gk_left: 526,
                            gk_cen: 10,
                            gk_margin: 10,
                        }
                    }
                    if (box_placed_style == 3) {
                        s = {
                            basic_top: 24,
                            basic_left: 24,
                            basic_center: 24,
                            gk_top: 248,
                            gk_left: 502,
                            gk_cen: 10,
                            gk_margin: 10,
                        }
                    }
                }
                Object.assign(this.data, s);
            },
            changeBoxAccessStyle(value){
                this.data.box_access_style = value;
                this.commonC();
            },
            changePlacedStyle(value) {
                this.data.box_placed_style = value;
                this.commonC();
                this.resetImg('love_pic');
                this.resetImg('nolove_pic');
                this.resetImg('tel_pic')
            },
            removeNoLovePic() {
                this.data.nolove_pic = '';
            },
            removeLovePic() {
                this.data.love_pic = '';
            },
            removeTelPic() {
                this.data.tel_pic = '';
            },
            selectNoLovePic(e) {
                if (e.length) this.data.nolove_pic = e.shift().url;
            },
            selectLovePic(e) {
                if (e.length) this.data.love_pic = e.shift().url;
            },
            selectTelPic(e) {
                if (e.length) this.data.tel_pic = e.shift().url;
            },
            resetImg(type) {
                this.data[type] = _appImg + 'home-' + type + (this.data.box_placed_style === 2 ? '-w' : '-y') + '.png'
            },
        }
    });
</script>
