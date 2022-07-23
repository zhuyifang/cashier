<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/4/25
 * Time: 9:49
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
$pluginUrl = \app\helpers\PluginHelper::getPluginBaseAssetsUrl();
$mallUrl = Yii::$app->request->hostInfo
    . Yii::$app->request->baseUrl
    . '/statics/img/app';
Yii::$app->loadViewComponent('app-dialog-select')
?>
<style>
    /* ------------------预览------------------- */
    .diy-topic .diy-component-preview {
        width: 100%;
    }

    .diy-topic .diy-component-preview .diy-topic-normal {
        width: 100%;
        padding: 10px;
        background: #fff;
    }

    .diy-topic .diy-component-preview .cat-list {
        width: 100%;
        overflow-x: auto;
        background: #fff;
    }

    .diy-topic .diy-component-preview .cat-list .cat-item {
        height: 80px;
        padding: 0 10px;
        text-align: center;
        max-width: 100%;
        white-space: nowrap;
        margin: 0 20px;
    }

    .diy-topic .diy-component-preview .cat-list .cat-item.active {
        border-bottom: 4px #ff4544 solid;
    }

    .diy-topic .diy-component-preview .topic-list {
    }

    .diy-topic .diy-component-preview .topic-list .topic-item {
        padding: 24px;
        margin-top: 12px;
        background: #fff;
    }

    .diy-topic .diy-component-preview .topic-list .topic-item:first-child {
        margin-top: 0;
    }

    .diy-topic .diy-component-preview .topic-list .topic-item .browse {
        font-size: 24px;
        color: #888;
        margin-top: 12px;
    }

    .diy-topic .diy-component-preview .topic-list .topic-item .topic-pic {
        background: #eee;
    }


    /* ------------------设置------------------- */
    .diy-topic .diy-component-edit .diy-topic-label {
        width: 82px;
    }

    .diy-topic .topic-edit-options {
        position: relative;
        overflow: visible;
        padding: 0 10px;
    }

    .diy-topic .topic-edit-options .delete {
        height: 25px;
        line-height: 25px;
        width: 25px;
        padding: 0;
        text-align: center;
        border: none;
        border-radius: 0;
        position: absolute;
        margin-left: 0;
    }
</style>

<style>
    .diy-topic .w-tag-all {
        padding-left: 24px;
        margin: 0 0 8px 0;
    }

    .tag-text {
        font-size: 32px;
        color: #333333;
    }

    .diy-topic .tag-text > div {
        padding-right: 50px;
        height: 78px;
        border-bottom-width: 4px;
        border-bottom-style: solid;
    }

    .diy-topic .tag-text > div:last-child {
        margin-right: 0;
    }

    .diy-topic .w-goods-all {
        padding: 0 24px 12px;

    }

    .diy-topic .w-goods-box {
        padding: 22px 0 25px;
        background: white;
        margin-top: 12px;
        margin-bottom: 20px;
        border-radius: 16px;
    }

    .diy-topic .w-goods-title {
        font-size: 32px;
        color: #333333;
        padding: 0 24px;
        font-weight: bolder;
        margin-bottom: 10px;
    }

    .diy-topic .w-goods-remake {
        font-size: 28px;
        padding: 10px 24px;
        color: #333333;
    }

    .diy-topic .show-remake-platform {
        font-size: 24px;
        color: white;
        padding: 3px 16px 5px;
        margin-right: 16px;
        border-radius: 6px;
    }

    .diy-topic .show-remake:before {
        content: attr(data-remake-title);
        font-size: 24px;
        color: white;
        padding: 3px 16px;
        margin-right: 16px;
        background: var(--remake-color);
        border-radius: 6px;
    }

    .diy-topic .w-big-pic {
        height: 654px;
    }

    .diy-topic .w-big-pic > img {
        height: 100%;
        width: 100%;
    }

    .diy-topic .w-pic {
        margin: 10px 13px 10px;
        flex-wrap: wrap;
    }

    .diy-topic .w-pic > img {
        margin: 10.5px;
        height: 204px;
        width: 203px;
        border-radius: 16px;
        display: block
    }

    .diy-topic .w-pic-four > img {
        height: 316px;
        width: 316px;
    }

    .diy-topic .w-right-goods {
        margin: 12px 24px;
        height: 90px;
    }

    .diy-topic .w-m-s {
        width: 296px;
        background: #F6F6F6;
        border-radius: 8px;
        margin-right: 18px;
    }

    .diy-topic .m-pic {
        height: 86px;
        width: 86px;
        display: block;
        border-radius: 8px 0 0 8px;
    }

    .diy-topic .m-text {
        padding: 0 18px;
    }

    .diy-topic .m-text-name {
        font-size: 24px;
        color: #333333;
    }

    .diy-topic .m-d {
        font-size: 22px;
        color: #999999;
        text-decoration: line-through;
        padding-left: 10px;
    }

    .diy-topic .w-m-1 {
        width: 100%;
    }

    .diy-topic .w-m-2 {
        width: 394px;
    }

    .diy-topic .w-m-3 {
        width: 296px;
    }

    .diy-topic .w-read {
        padding: 10px 24px 0;
        font-size: 24px;
        color: #999999;
    }

    .diy-topic .w-empty {
        margin-top: 166px;
    }

    .diy-topic .w-empty > img {
        height: 240px;
        width: 240px;
        display: block;
    }

    .diy-topic .w-empty > div {
        padding-top: 27px;
        font-size: 24px;
        color: #999999;
    }

    .diy-topic .t-omit {
        /*
            单行文本显示、超出省略
            注意:在flex部分布局下使用可能会冲突
        */
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
    }

    .diy-topic .el-carousel__container .el-carousel__indicators, .el-carousel__indicators--horizontal {
        display: block !important;
    }

    .diy-topic .el-carousel__container .el-carousel__indicators, .el-carousel__indicators--horizontal button {
        height: 12px !important;
        width: 12px !important;
        border-radius: 50% !important;
    }
    .diy-topic .el-carousel__container .el-carousel__indicators, .el-carousel__indicators--horizontal .is-active button{
        background-color: #ff4544 !important;
        color:  #ff4544 !important;
    }
    .diy-topic .box-grow-0 {
        display: flex;
        flex-shrink: 0;
        flex-grow: 0;
    }
    .diy-topic .box-grow-1 {
        display: flex;
        flex-shrink: 1;
        flex-grow: 1;
    }
    .diy-topic .t-omit-two {
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        white-space: normal !important;
    }
    .diy-topic .t-omit-three {
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    .diy-topic .l-right {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAAJ1BMVEUAAAAzMzMtLS0zMzM0NDQyMjIyMjIyMjIzMzMsLCwyMjIzMzM1NTW9kjBxAAAADXRSTlMA/gXrslwuetYLUSMYvo7bOgAAADNJREFUKM9jIBswbUATUDFDFxBOQNPiOJiVaAhPQBUoFEXlswsGDD4FM9AUMPAsYCAfAACGrw0nd2uk1AAAAABJRU5ErkJggg==");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 31px;
        width: 31px;
        margin-top: 10px;
    }

</style>
<template id="diy-topic">
    <div class="diy-topic">
        <div class="diy-component-preview">
            <div class="diy-topic-normal" flex="dir:left cross:center" v-if="data.style == 'normal'">
                <template v-if="data.count==1">
                    <app-image :src="data.logo_1" mode="scaleToFill"
                               width="104px" height="32px" style="margin-right: 20px;"></app-image>
                </template>
                <template v-else>
                    <app-image :src="data.logo_2" mode="scaleToFill"
                               width="104px" height="50px" style="margin-right: 20px;"></app-image>
                </template>
                <div :style="cStyle">
                    <div flex="dir:left cross:center" v-for="topic in cTopic">
                        <app-image :src="data.icon" mode="scaleToFill"
                                   width="54px" height="28px" style="margin-right: 10px;"></app-image>
                        <div>{{topic.title}}</div>
                    </div>
                </div>
            </div>
            <div class="diy-topic-list" v-if="data.style == 'list'">
                <div class="list">
                    <template v-if="data.cat_show">
                        <div class="cat-list" flex="dir:left" :style="{backgroundColor:data.catBgColor}">
                            <div class="cat-item" flex="main:center cross:center" v-for="(cat, index) in cList"
                                 :class="index == cat_index ? 'active' : ''" @click="selectCat(index)"
                                 :style="{borderBottomColor: index == cat_index ? data.tagColor: 'transparent',
                        color: index == cat_index ? data.catSelectedColor: data.catUnselectedColor}"
                            >
                                <div>{{cat.name}}</div>
                            </div>
                        </div>
                    </template>
                    <div class="w-goods-all" flex="dir:top">
                        <div v-for="(item,index) in cTopic" :key="index" class="w-goods-box">
                            <div :flex="item.layout == 3 ? 'dir:left': 'dir:top'">
                                <div flex="dir:top" class="box-grow-1">
                                    <div class="w-goods-title" flex="dir:left cross:top">
                                        <div class="t-omit-two box-grow-1">{{ item.title }}</div>
                                        <div class="l-right box-grow-0" v-if="item.layout == 2"></div>
                                    </div>
                                    <div class="w-goods-remake" :class="item.layout != 3 ? ' t-omit-three': ' t-omit-two'" style="line-height: 1.6">
                                        <div class="show-remake-platform"
                                             v-if="item.tag"
                                             style="display:inline-block"
                                             :style="{'background': `linear-gradient(to right,${item.tag.extra_attributes.color},${colorRgba(item.tag.extra_attributes.color)})`}"
                                        >{{ item.tag.name }}
                                        </div>
                                        {{ item.abstract }}
                                    </div>
                               </div>
                            <div>
                            <template v-if="item.layout == 1">
                                <el-carousel :height="item.proportion != 1 ? item.proportion != 2 ?  '327px' : '436px': '654px'" arrow="always"
                                             :style="{height: item.proportion != 1 ? item.proportion != 2 ?  '327px' : '436px': '654px'}"
                                             style="width:auto;height: 654px;margin:10px 24px;">
                                    <el-carousel-item v-for="(pic,index1) in item.pic_list" :key="index1"
                                                      :style="{height: item.proportion != 1 ? item.proportion != 2 ?  '327px' : '436px': '654px'}"
                                                      class="w-big-pic">
                                        <image :src="pic.pic_url"></image>
                                    </el-carousel-item>
                                </el-carousel>
                            </template>
                            <template v-if="item.layout == 2">
                                <div :class="{'w-pic-four' :item.pic_list.length === 4}" class="w-pic" flex="dir:left">
                                    <image v-for="(pic,index1) in item.pic_list"
                                           :key="index1"
                                           :src="pic.pic_url"
                                    ></image>
                                </div>
                            </template>
                            <template v-if="item.layout == 3">
                                <image v-if="item.pic_list"
                                       style="margin-left: 26px;margin-right:24px;height: 160px;width:160px;background: #D8D8D8;border-radius: 16px"
                                       :src="item.pic_list[0].pic_url"
                                ></image>
                            </template>
                            </div>
                        </div>
                            <div class="w-right-goods" v-if="item.goods_list && item.goods_list.length">
                                <el-scrollbar>
                                    <div flex="dir:left cross:center">
                                        <div v-for="(goods,index2) in item.goods_list" :key="index2"
                                             :class="[`w-m-${item.goods_list.length}`]"
                                             class="box-grow-0 w-m-s"
                                             style="flex-shrink: 0;flex-grow: 0"
                                             flex="dir:left">
                                            <image class="box-grow-0 m-pic" :src="goods.cover_pic"></image>
                                            <div class="m-text" flex="dir:top main:center">
                                                <div class="m-text-name t-omit" :style="{maxWidth: item.goods_list.length != 1 ? item.goods_list.length != 2 ? '174px': '270px' : '540px'}">{{ goods.name }}</div>
                                                <div class="t-omit" flex="dir:left" :style="{maxWidth: item.goods_list.length != 1 ? item.goods_list.length != 2 ? '174px': '270px' : '540px'}">
                                                    <div style="display:inline-block;font-size:24px;font-weight: bold;color:#ff4544"
                                                    >￥
                                                    </div>
                                                    <div style="display:inline-block;font-size:28px;font-weight: bold;color: #ff4544"
                                                    >{{ goods.price }}
                                                    </div>
                                                    <div style="display:inline-block;" class="m-d">￥{{ goods.original_price }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </el-scrollbar>
                            </div>
                            <div class="w-read">{{ item.read_number }} 阅读</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>专题</div>
            </div>
            <el-form label-width="100px" @submit.native.prevent style="padding: 20px 0">
                <el-form-item label="专题样式">
                    <app-radio turn v-model="data.style" label="normal">简易模式</app-radio>
                    <app-radio turn v-model="data.style" label="list">列表模式</app-radio>
                </el-form-item>
                <template v-if="data.style == 'normal'">
                    <el-form-item label="显示行数">
                        <el-select size="small" v-model="data.count">
                            <el-option :value="1"></el-option>
                            <el-option :value="2"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="logo(1行)">
                        <app-attachment title="选择图片" :multiple="false" :max="1" type="image"
                                        v-model="data.logo_1">
                            <el-tooltip class="item" effect="dark"
                                        content="建议尺寸104*32"
                                        placement="top">
                                <el-button size="mini">选择图片</el-button>
                            </el-tooltip>
                        </app-attachment>
                        <app-gallery v-if="data.logo_1 && data.logo_1.length" :url="data.logo_1" :show-delete="true"
                                     @deleted="deletePic('logo_1')"></app-gallery>
                        <app-image v-else style="border-radius: 5px"></app-image>
                    </el-form-item>
                    <el-form-item label="logo(2行)">
                        <app-attachment title="选择图片" :multiple="false" :max="1" type="image"
                                        v-model="data.logo_2">
                            <el-tooltip class="item" effect="dark"
                                        content="建议尺寸104*50"
                                        placement="top">
                                <el-button size="mini">选择图片</el-button>
                            </el-tooltip>
                        </app-attachment>
                        <app-gallery v-if="data.logo_2 && data.logo_2.length" :url="data.logo_2" :show-delete="true"
                                     @deleted="deletePic('logo_2')"></app-gallery>
                        <app-image v-else style="border-radius: 5px"></app-image>
                    </el-form-item>
                    <el-form-item label="专题标签">
                        <app-attachment title="选择图片" :multiple="false" :max="1" type="image"
                                        v-model="data.icon">
                            <el-tooltip class="item" effect="dark"
                                        content="建议尺寸54*28"
                                        placement="top">
                                <el-button size="mini">选择图片</el-button>
                            </el-tooltip>
                        </app-attachment>
                        <app-gallery :url="data.icon" :show-delete="true"
                                     @deleted="deletePic('icon')"></app-gallery>
                    </el-form-item>
                </template>
                <template v-else>
                    <el-form-item label="是否显示标签">
                        <el-switch v-model="data.cat_show"></el-switch>
                    </el-form-item>
                    <el-form-item label="标签列表" v-if="data.cat_show">
                        <el-card shadow="never" class="topic-edit-options" style="margin-bottom: 10px"
                                 v-for="(cat, catIndex) in data.list"
                                 :key="catIndex">
                            <div @click="selectCat(catIndex)">
                                <div flex="box:first">
                                    <div class="diy-topic-label">专题标签</div>
                                    <div>{{cat.cat_name}}</div>
                                </div>
                                <div flex="box:first">
                                    <div class="diy-topic-label">菜单名称</div>
                                    <div>
                                        <el-input v-model="cat.name" size="small"></el-input>
                                    </div>
                                </div>
                                <div flex="box:first">
                                    <div class="diy-topic-label">自定义专题</div>
                                    <div>
                                        <el-switch v-model="cat.custom"></el-switch>
                                    </div>
                                </div>
                                <div flex="box:first" v-if="!cat.custom">
                                    <div class="diy-topic-label">专题数量</div>
                                    <div>
                                        <el-input v-model="cat.number" size="small"></el-input>
                                    </div>
                                </div>
                                <div flex="box:first" v-else>
                                    <div class="diy-topic-label">专题列表</div>
                                    <div>
                                        <app-dialog-select url="mall/topic/index" :multiple="true"
                                                           @selected="selectTopic" :extra-search="{tag_id: cat.cat_id}"
                                                           title="选择专题" list-key="title">
                                            <el-button size="mini">添加专题</el-button>
                                        </app-dialog-select>
                                        <app-gallery :list.sync="cat.children" url-key="cover_pic" :show-delete="true"
                                                     cursor="move"
                                                     @deleted="deleteTopic" width="100px" height="100px"></app-gallery>
                                    </div>
                                </div>
                            </div>
                            <el-button class="delete" @click="topicCatDelete(catIndex)" type="primary"
                                       icon="el-icon-delete"
                                       style="top: 0;right: -26px;"></el-button>
                        </el-card>
                        <app-dialog-select url="mall/topic-type/index" :multiple="true" @selected="selectCatList"
                                           title="选择标签">
                            <el-button size="mini">添加标签</el-button>
                        </app-dialog-select>
                    </el-form-item>
                    <el-form-item label="专题列表" v-else>
                        <app-dialog-select url="mall/topic/index" :multiple="true" @selected="selectTopic"
                                           title="选择专题" list-key="title">
                            <el-button size="mini">添加专题</el-button>
                        </app-dialog-select>
                        <app-gallery v-if="data.topic_list && data.topic_list.length" :list.sync="data.topic_list"
                                     style="width: 100%"
                                     url-key="cover_pic" :show-delete="true"
                                     cursor="move"
                                     @deleted="deleteTopic" width="100px" height="100px"
                        ></app-gallery>
                        <app-image v-else style="border-radius: 5px"></app-image>
                    </el-form-item>
                </template>
                <div class="app-form-box-label" v-if="data.cat_show == 1">
                    颜色设置
                </div>
                <div flex="dir:left" style="flex-wrap: wrap;width: 600px" v-if="data.cat_show == 1">
                    <el-form-item label="标签选中色">
                        <color v-model="data.catSelectedColor"></color>
                    </el-form-item>
                    <el-form-item label="标签未选中色" style="margin-left:50px">
                        <color v-model="data.catUnselectedColor"></color>
                    </el-form-item>
                    <el-form-item label="标签背景色">
                        <color v-model="data.catBgColor"></color>
                    </el-form-item>
                </div>
            </el-form>
        </div>
    </div>
</template>
<script>
    let _mallUrl = '<?= $mallUrl ?>';

    const colorRgba = function (sHex, alpha = 1) {
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
            // return sColorChange.join(',')
            // 或
            return 'rgba(' + sColorChange.join(',') + ',' + alpha + ')'
        } else {
            return sColor
        }
    };

    Vue.component('diy-topic', {
        template: '#diy-topic',
        props: {
            value: Object
        },
        data() {
            return {
                list: [],
                search: {
                    keyword: '',
                    tag_id: '',
                },

                data: {
                    style: 'normal',
                    count: 1,
                    logo_1: _mallUrl + '/topic/icon-topic-1.png',
                    logo_2: _mallUrl + '/topic/icon-topic-2.png',
                    icon: _mallUrl + '/topic/icon-topic-r.png',
                    list: [],
                    cat_show: false,
                    topic_list: [],
                    tagColor: '#ff4544',
                    catSelectedColor: '#353535',
                    catUnselectedColor: '#353535',
                    catBgColor: '#FFFFFF',
                },
                defaultData: {},
                cat_index: 0,
                topicShow: false,
                catShow: false,
            }
        },
        created() {
            let data = JSON.parse(JSON.stringify(this.data));
            this.defaultData = data;
            if (!this.value) {
                this.$emit('input', data)
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
            },
        },
        computed: {
            cList() {
                if (this.data.list && this.data.list.length > 0 && this.data.cat_show) {
                    return this.data.list;
                } else {
                    let catList = {
                        cat_id: 0,
                        cat_name: '标签名称',
                        name: '标签名称',
                        children: [],
                        custom: 0,
                        number: 0
                    };
                    return [catList, catList]
                }
            },
            cTopic() {
                if (this.data.list && this.data.list.length > 0
                    && this.data.list[this.cat_index].children && this.data.list[this.cat_index].children.length > 0
                    && this.data.cat_show) {
                    return this.data.list[this.cat_index].children;
                } else if (this.data.topic_list && this.data.topic_list.length > 0 && !this.data.cat_show) {
                    return this.data.topic_list;
                } else {
                    let topic = {
                        title: '这是一条专题示例',
                        cover_pic: '',
                        read_count: '999',
                        layout: 3,
                        id: 0,
                        goods_list: new Array(4).fill({
                            name: '商品名称',
                            price: '100',
                            original_price: '100',
                            cover_pic: _currentPluginBaseUrl + '/images/diy-top-default-a.png'
                        }),
                        tag: {
                            extra_attributes: {
                                color: '#Ff4544',
                            },
                            name: '标签',
                        },
                        abstract: '简介简介简介简介',
                        pic_list: [
                            {
                                pic_url: _currentPluginBaseUrl + '/images/diy-top-default.png'
                            }, {
                                pic_url: _currentPluginBaseUrl + '/images/diy-top-default.png'
                            }, {
                                pic_url: _currentPluginBaseUrl + '/images/diy-top-default.png'
                            }
                        ],
                        read_number: 999,
                    };
                    let topic_1 = JSON.parse(JSON.stringify(topic));
                    topic_1.layout = 2;
                    return [topic, topic_1];
                }
            },
            cStyle() {
                if (this.data.style === 'normal') {
                    if (this.data.count === 1) {
                        return 'height: 32px;overflow-y: hidden;line-height: 32px'
                    }
                }
            },
        },
        methods: {
            searchTab(index) {
                this.cat_index = index
            },
            colorRgba(color, alpha = 0.75) {
                return colorRgba(color, alpha)
            },
            topicCatDelete(index) {
                this.data.list.splice(index, 1);
            },

            deletePic(param) {
                this.data[param] = this.defaultData[param];
            },
            deleteTopic(item, index) {
                if (this.data.cat_show) {
                    this.data.list[this.cat_index].children.splice(index, 1)
                } else {
                    this.data.topic_list.splice(index, 1)
                }
            },
            selectCat(index) {
                this.cat_index = index
                this.catShow = false;
            },
            selectTopic(list) {
                let topic_list = [];
                for (let i in list) {
                    topic_list.push({
                        title: list[i].title,
                        cover_pic: list[i].pic_url,
                        read_count: list[i].read_count,
                        layout: list[i].layout,
                        id: list[i].id,
                        goods_list: list[i].goods_list,
                        tag: list[i].tag,
                        abstract: list[i].abstract,
                        pic_list: list[i].pic_list,
                        read_number: list[i].read_number,
                        proportion: list[i].proportion
                    });
                }
                topic_list = JSON.parse(JSON.stringify(topic_list));
                this.data.topic_list = this.data.topic_list.concat(topic_list);
                if (this.data.list && this.data.list.length > 0) {
                    this.data.list[this.cat_index].children = this.data.list[this.cat_index].children.concat(topic_list);
                }
                this.topicShow = false;
            },
            selectCatList(list) {
                for (let i in list) {
                    this.data.list.push({
                        cat_id: list[i].id,
                        cat_name: list[i].name,
                        name: list[i].name,
                        children: [],
                        custom: 0,
                        number: 30
                    });
                }
            }
        }
    });
</script>
