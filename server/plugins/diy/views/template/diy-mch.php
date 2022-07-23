<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/5/7
 * Time: 12:02
 */
Yii::$app->loadViewComponent('diy/diy-bg');
?>
<style>
    .diy-mch .diy-component-preview .mch-list {
        /*padding: 9px;*/
    }

    .diy-mch .diy-component-preview .mch-item {
        padding-bottom: 16px;
        /*margin-bottom: 12px;*/
        border-radius: 8px;
    }

    .diy-mch .diy-component-preview .mch-pic,
    .diy-mch .diy-component-preview .goods-pic {
        display: inline-block;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% 100%;
        /*background-color: #d6d6d6;*/
    }

    .diy-mch .diy-component-preview .mch-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .diy-mch .diy-component-preview .mch-info {
        color: #B8B8B8;
        font-size: 24px;
    }

    .diy-mch .diy-component-preview .goods-list {
        padding-top: 16px;
        /*margin: 0 -10px;*/
        overflow-x: auto;
    }

    .diy-mch .diy-component-preview .goods-item {
        /*background: #fff;*/
        /*margin: 0 10px;*/
        position: relative;
        /*height: 210px;*/
    }

    .diy-mch .diy-component-preview .goods-price {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: white;
        text-align: center;
        position: absolute;
        bottom: 0;
        left: 0;

        display:block;
        padding:2px 10px;
        border-radius: 0 16px 0 16px;
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .diy-mch .diy-component-preview .mch-item .to-look {
        height: 60px;
        width: 150px;
        border: 1px solid #E7E7E7;
        border-radius: 30px;
        text-align: center;
        line-height: 58px;
        color: #353535;
        font-size: 24px;
    }

    /*-------------- 编辑部份 --------------*/
    .diy-mch .diy-component-edit .edit-item {
        border: 1px solid #e2e2e2;
        padding: 15px;
        min-width:500px;
        width: 90%;
        margin-bottom: 5px;
    }

    .diy-mch .diy-component-edit .edit-options {
        position: relative;
    }

    .diy-mch .diy-component-edit .edit-options .el-button {
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

    .diy-mch .diy-component-edit .goods-list {
        line-height: normal;display:flex;
        flex-wrap: wrap;
    }

    .diy-mch .diy-component-edit .goods-item,
    .diy-mch .diy-component-edit .goods-add {
        width: 50px;
        height: 50px;
        border: 1px solid #e2e2e2;
        background-position: center;
        background-size: cover;
        margin-right: 15px;
        margin-bottom: 15px;
        position: relative;
    }

    .diy-mch .diy-component-edit .goods-add {
        cursor: pointer;
    }

    .diy-mch .diy-component-edit .goods-delete {
        position: absolute;
        top: -11px;
        right: -11px;
        width: 25px;
        height: 25px;
        line-height: 25px;
        padding: 0 0;
        visibility: hidden;
    }

    .diy-mch .diy-component-edit .goods-item:hover .goods-delete {
        visibility: visible;
    }

    .diy-mch .el-form-item .el-form-item {
        margin-bottom: 11px
    }

    .diy-mch .s-n-num {
        padding-top: 20px;
    }

    .diy-mch .s-line {
        width: 2px;
        height: 56px;
        background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0));
    }

    .diy-mch .s-label {
        font-size: 28px;
        font-weight: bold;
        color: #333333;
    }

    .diy-mch .s-value {
        font-size: 20px;
        color: #999999;
    }

    .diy-mch .box-grow-1 {
        display: flex;
        flex-shrink: 1;
        flex-grow: 1;
    }

    .diy-mch .box-grow-0 {
        display: flex;
        flex-shrink: 0;
        flex-grow: 0;
    }

    .diy-mch .app-image {
        width: 70px;
        height: 70px;
        border-radius: 16px;
    }

    .diy-mch .app-button {
        padding: 8px 20px;
        border: 1px solid #cccccc;
        font-size: 24px;
        color: #666666;
        border-radius: 25px;
    }
    .diy-mch .t-omit {
        display: inline-block;
        white-space: nowrap;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<template id="diy-mch">
    <div class="diy-mch">
        <div class="diy-component-preview" :style="cListStyle">
            <div class="mch-list" v-if="!data.showGoods" flex="dir:left" :style="cItemStyle(0,'right')" style="overflow-x: auto;border-radius: 16px;padding:16px 0 8px 16px;">
                <div class="mch-item" :style="{marginRight: `${data.c_padding_cen}px`}"
                     v-for="(mch,mchIndex) in cMchList">
                    <div class="mch-pic" :style="mch.picUrl?('background-image:url('+mch.picUrl+');'):''"
                         style="width: 224px;height: 224px;border-radius:8px 8px 0 0"></div>
                    <div class="mch-name" style="width: 224px;text-align: center;">{{mch.name}}</div>
                </div>
            </div>
            <div class="mch-list" v-else>
                <div class="mch-item" :style="cItemStyle(mchIndex,'bottom')" v-for="(mch,mchIndex) in cMchList">
                    <div class="app-top" flex="dir:top">
                        <div flex="dir:left cross:center">
                            <div class="app-image box-grow-0"
                                 style="margin-right: 24px">
                                <app-image height="70" width="70" :src="mch.picUrl"></app-image>
                            </div>
                            <div class="app-name t-omit box-grow-1">{{mch.name}}</div>
                            <div class="app-button box-grow-0"
                                 flex="main:center cross:center">
                                进店逛逛
                            </div>
                        </div>
                        <div class="s-n-num" flex="dir:left cross:center main:between">
                            <div class="box-grow-1" flex="dir:top cross:center">
                                <div class="s-label">{{mch.favorite_num}}</div>
                                <div class="s-value">关注人数</div>
                            </div>
                            <div class="box-grow-0 s-line"></div>
                            <div class="box-grow-1" flex="dir:top cross:center">
                                <div class="s-label">{{mch.goodsNum}}</div>
                                <div class="s-value">全部商品</div>
                            </div>
                            <div class="box-grow-0 s-line"></div>
                            <div class="box-grow-1" flex="dir:top cross:center">
                                <div class="s-label">{{mch.orderNum}}</div>
                                <div class="s-value"> 已售出</div>
                            </div>
                        </div>
                    </div>
                    <div v-if="fGoodsList(mch) && fGoodsList(mch).length" class="goods-list" flex>
                        <div v-for="(goods,goodsIndex) in fGoodsList(mch)" class="goods-item"
                             :style="picStyle(goods,fGoodsList(mch).length,goodsIndex)">
                            <div style="width: 100%;height:0;position: relative;padding-bottom: 100%">
                                <div class="goods-pic"
                                     style="width:100%;height:100%;position: absolute;border-radius:16px"
                                     :style="goods.picUrl?('background-image:url('+goods .picUrl+');'):''"></div>
                                <span class="goods-price">￥{{goods.price}}</span>
                            </div>
                        </div>
                        <!--囧可-->
                        <div v-if="3 >= fGoodsList(mch).length"
                             v-for="(goods,goodsIndex) in new Array(3 - fGoodsList(mch).length)" class="goods-item"
                             :style="picStyle(goods,fGoodsList(mch).length,goodsIndex)">
                            <div style="width: 100%;height:0;position: relative;padding-bottom: 100%">
                                <div class="goods-pic"
                                     style="width:100%;height:100%;position: absolute;border-radius:16px"></div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="goods-list" flex="main:center cross:center"
                         style="height: 100px;color: #909399;">暂无商品
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>好店推荐</div>
            </div>
            <el-form label-width="100px" @submit.native.prevent style="padding: 20px 0">
                <el-form-item label="显示商品">
                    <el-switch v-model="data.showGoods"></el-switch>
                </el-form-item>
                <el-form-item label="商户列表">
                    <div class="edit-item" v-for="(mch,mchIndex) in data.list" style="min-width: 520px">
                        <div class="edit-options">
                            <el-button @click="deleteMch(mchIndex)"
                                       type="primary"
                                       icon="el-icon-delete"
                                       style="top: -16px;right: -41px;"></el-button>
                        </div>

                        <el-form-item label="商户名称">
                            <el-input size="small" v-model="mch.name" disabled></el-input>
                        </el-form-item>
                        <template v-if="data.showGoods">
                            <el-form-item label="商品显示数量" v-if="!mch.staticGoods">
                                <el-input size="small" v-model.number="mch.showGoodsNum" type="number"
                                          min="0" :max="maxGoodsLength"
                                          :placeholder="`最多${maxGoodsLength}个`" @change="goodsNumChange(mchIndex)"></el-input>
                            </el-form-item>
                            <el-form-item label="自定义商品">
                                <el-switch v-model="mch.staticGoods"></el-switch>
                            </el-form-item>
                            <el-form-item label="商品列表" v-if="mch.staticGoods">
                                <div class="goods-list" flex>
                                    <div class="goods-item" v-for="(goods,goodsIndex) in fGoodsList(mch)"
                                         :style="'background-image: url('+goods.picUrl+');'">
                                        <el-button @click="deleteGoods(mchIndex,goodsIndex)" class="goods-delete"
                                                   size="small" circle type="danger"
                                                   icon="el-icon-close"></el-button>
                                    </div>
                                    <div class="goods-add" flex="main:center cross:center"
                                         v-if="fGoodsList(mch).length < maxGoodsLength"
                                         @click="showGoodsDialog(mchIndex)">
                                        <i class="el-icon-plus"></i>
                                    </div>
                                    <div style="font-size: 14px;color: #C0C4CC;margin-bottom:15px" flex="cross:center">
                                        注：最多显示{{maxGoodsLength}}个商品
                                    </div>
                                </div>
                            </el-form-item>
                        </template>
                    </div>
                    <el-button size="small" @click="showMchDialog">添加商户</el-button>
                </el-form-item>
                <el-form-item label="卡片样式">
                    <el-radio v-model="data.cardStyle" :label="1">白底无边框</el-radio>
                    <el-radio v-model="data.cardStyle" :label="2">白底有边框</el-radio>
                    <el-radio v-model="data.cardStyle" :label="3" v-if="false" >无底无边框</el-radio>
                </el-form-item>
                <el-form-item label="边框颜色" v-if="data.cardStyle == 2">
                    <color v-model="data.borderColor" height></color>
                </el-form-item>
                <el-form-item label="卡片边距">
                    <div class="edit-item">
                        <el-form-item label="上下边距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.c_padding_tb" style="width: 100%"
                                           size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="左右边距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.c_padding_lf" style="width: 100%"
                                           size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                        <el-form-item label="卡片间间距">
                            <div flex="dir:left cross:center">
                                <el-slider :show-tooltip="false" v-model="data.c_padding_cen" style="width: 100%"
                                           size="small"
                                           show-input></el-slider>
                                <div style="margin-left: 5px">px</div>
                            </div>
                        </el-form-item>
                    </div>
                </el-form-item>
                <el-form-item label="背景颜色">
                    <color v-model="data.backgroundColor" height></color>
                </el-form-item>
            </el-form>
        </div>
        <el-dialog title="选择商户" :visible.sync="mchDialog.visible" @open="mchDialogOpened">
            <el-input size="mini" v-model="mchDialog.keyword" placeholder="根据名称搜索" :clearable="true"
                      @clear="loadMchList" @keyup.enter.native="loadMchList">
                <el-button slot="append" @click="loadMchList">搜索</el-button>
            </el-input>
            <el-table :data="mchDialog.list" v-loading="mchDialog.loading" @selection-change="mchSelectionChange">
                <el-table-column type="selection" width="50px"></el-table-column>
                <el-table-column label="ID" prop="id" width="100px"></el-table-column>
                <el-table-column label="名称" prop="store.name"></el-table-column>
            </el-table>
            <div style="text-align: center">
                <el-pagination
                        v-if="mchDialog.pagination"
                        style="display: inline-block"
                        background
                        @current-change="mchDialogPageChange"
                        layout="prev, pager, next, jumper"
                        :page-size.sync="mchDialog.pagination.pageSize"
                        :total="mchDialog.pagination.totalCount">
                </el-pagination>
            </div>
            <div slot="footer">
                <el-button type="primary" @click="addMch">确定</el-button>
            </div>
        </el-dialog>
        <el-dialog title="选择商品" :visible.sync="goodsDialog.visible" @open="goodsDialogOpened">
            <el-input size="mini" v-model="goodsDialog.keyword" placeholder="根据名称搜索" :clearable="true"
                      @clear="loadGoodsList" @keyup.enter.native="loadGoodsList">
                <el-button slot="append" @click="loadGoodsList">搜索</el-button>
            </el-input>
            <el-table :data="goodsDialog.list" v-loading="goodsDialog.loading" @selection-change="goodsSelectionChange">
                <el-table-column type="selection" width="50px"></el-table-column>
                <el-table-column label="ID" prop="id" width="100px"></el-table-column>
                <el-table-column label="名称" prop="name"></el-table-column>
            </el-table>
            <div style="text-align: center">
                <el-pagination
                        v-if="goodsDialog.pagination"
                        style="display: inline-block"
                        background
                        @current-change="goodsDialogPageChange"
                        layout="prev, pager, next, jumper"
                        :page-size.sync="goodsDialog.pagination.pageSize"
                        :total="goodsDialog.pagination.totalCount">
                </el-pagination>
            </div>
            <div slot="footer">
                <el-button type="primary" @click="addGoods">确定</el-button>
            </div>
        </el-dialog>
    </div>
</template>
<script>
    Vue.component('diy-mch', {
        template: '#diy-mch',
        props: {
            value: Object,
        },
        data() {
            return {
                mchDialog: {
                    visible: false,
                    page: 1,
                    keyword: '',
                    loading: false,
                    list: [],
                    pagination: null,
                    selected: null,
                },
                goodsDialog: {
                    visible: false,
                    mchIndex: null,
                    page: 1,
                    keyword: '',
                    loading: false,
                    list: [],
                    pagination: null,
                    selected: null,
                },
                data: {
                    showGoods: false,
                    showGoodsPrice: true,
                    list: [],
                    cardStyle: 1,
                    showImg: false,
                    backgroundColor: '#f6f6f6',
                    backgroundPicUrl: '',
                    position: 5,
                    mode: 1,
                    backgroundHeight: 100,
                    backgroundWidth: 100,
                    borderColor: '#cccccc',
                    c_padding_tb: 20,
                    c_padding_lf: 24,
                    c_padding_cen: 24,
                },
                hr: false,
                position: 'center center',
                repeat: 'no-repeat',
                maxGoodsLength: 3,
            };
        },
        created() {
            if (!this.value) {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
                Vue.set(this.data, 'showGoodsPrice', true);
            }
        },
        computed: {
            fGoodsList() {
                return (mch) => {
                    if (!mch.staticGoods) {
                        const goods = {
                            id: 0,
                            picUrl: _currentPluginBaseUrl + '/images/mch-default-logo.png',
                            price: '999.00',
                        }
                        return new Array(mch.showGoodsNum > 3 ? 3 : mch.showGoodsNum).fill(goods);
                    }
                    return mch.goodsList;
                }
            },
            picStyle() {
                return (goods, length, index) => {
                    let style;
                    if (length < 3 && 0) {
                        style = {width: '210px', marginRight: '22px'};
                    } else {
                        style = {
                            display: 'flex',
                            flexShrink: 1,
                            flexGrow: 1,
                        };
                        if (index < 2) {
                            Object.assign(style, {marginRight: '22px'});
                        }
                    }
                    return style;
                }
            },
            cListStyle() {
                if (this.data.backgroundColor) {
                    return `padding:${this.data.c_padding_tb}px ${this.data.c_padding_lf}px;background-color:${this.data.backgroundColor};background-image:url(${this.data.backgroundPicUrl});background-size:${this.data.backgroundWidth}% ${this.data.backgroundHeight}%;background-repeat:${this.repeat};background-position:${this.position}`
                } else {
                    return `padding:${this.data.c_padding_tb}px ${this.data.c_padding_lf}px;background-image:url(${this.data.backgroundPicUrl});background-size:${this.data.backgroundWidth}% ${this.data.backgroundHeight}%;background-repeat:${this.repeat};background-position:${this.position}`
                }
            },
            cItemStyle() {
                return (index, pos) => {
                    let style;
                    if (this.data.cardStyle == 1) {
                        style = `background-color:#ffffff;`
                    } else if (this.data.cardStyle == 2) {
                        style = `background-color:#ffffff;border: 1px solid ${this.data.borderColor};`
                    } else {
                        style = ''
                    }
                    if (index + 1 < this.cMchList.length) {
                        style += 'margin-' + pos + ': ' + this.data.c_padding_cen + 'px;';
                    }
                    if (this.data.showGoods) {
                        style += `padding: 20px;`
                    }
                    return style
                }
            },
            cMchList() {
                if (this.data.list && this.data.list.length) {
                    return this.data.list;
                }
                const goods = {
                    id: 0,
                    picUrl: '',
                    price: '999.00',
                };
                const item = {
                    id: 0,
                    name: '商户名称',
                    picUrl: '',
                    goodsList: [goods, goods, goods,],
                    favorite_num:  'xxx',
                    goodsNum: 'xxx',
                    orderNum: 'xxx',
                    showGoodsNum: 3,
                    staticGoods: false,
                };
                return [item, item, item,];
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
            updateData(e) {
                this.data = e;
            },
            toggleData(e) {
                this.position = e;
            },
            changeData(e) {
                this.repeat = e;
            },
            mchDialogOpened() {
                if (!this.mchDialog.list || !this.mchDialog.list.length) {
                    this.loadMchList();
                }
            },
            loadMchList() {
                this.mchDialog.loading = true;
                this.$request({
                    params: {
                        r: 'plugin/mch/mall/mch/index',
                        page: this.mchDialog.page,
                        keyword: this.mchDialog.keyword,
                        status: 1
                    }
                }).then(response => {
                    this.mchDialog.loading = false;
                    if (response.data.code === 0) {
                        this.mchDialog.list = response.data.data.list;
                        this.mchDialog.pagination = response.data.data.pagination;
                    }
                }).catch(e => {
                });
            },
            mchDialogPageChange(page) {
                this.mchDialog.page = page;
                this.loadMchList();
            },
            mchSelectionChange(e) {
                if (e && e.length) {
                    this.mchDialog.selected = e;
                } else {
                    this.mchDialog.selected = null;
                }
            },
            addMch() {
                if (!this.mchDialog.selected || !this.mchDialog.selected.length) {
                    this.mchDialog.visible = false;
                    return;
                }
                for (let i in this.mchDialog.selected) {
                    const item = {
                        id: this.mchDialog.selected[i].id,
                        name: this.mchDialog.selected[i].store.name,
                        picUrl: this.mchDialog.selected[i].store.cover_url,
                        goodsNum: this.mchDialog.selected[i].goods_count,
                        orderNum:  this.mchDialog.selected[i].order_goods_count,
                        favorite_num:  this.mchDialog.selected[i].favorite_num,
                        goodsList: [],
                        showGoodsNum: this.maxGoodsLength,
                        staticGoods: false,
                    };
                    this.data.list.push(item);
                }
                this.mchDialog.selected = null;
                this.mchDialog.visible = false;
            },
            deleteMch(mchIndex) {
                this.data.list.splice(mchIndex, 1);
            },
            goodsNumChange(mchIndex) {
                if (this.data.list[mchIndex].showGoodsNum > this.maxGoodsLength) {
                    this.data.list[mchIndex].showGoodsNum = this.maxGoodsLength;
                }
                if (this.data.list[mchIndex].showGoodsNum < 0) {
                    this.data.list[mchIndex].showGoodsNum = 0;
                }
            },
            showGoodsDialog(mchIndex) {
                this.goodsDialog.mchIndex = mchIndex;
                this.goodsDialog.visible = true;
                this.goodsDialog.list = null;
            },
            goodsDialogOpened() {
                if (!this.goodsDialog.list || !this.goodsDialog.list.length) {
                    this.loadGoodsList();
                }
            },
            loadGoodsList() {
                this.goodsDialog.loading = true;
                this.$request({
                    params: {
                        r: 'plugin/diy/mall/template/get-goods',
                        page: this.goodsDialog.page,
                        mch_id: this.data.list[this.goodsDialog.mchIndex].id,
                        cat_id: this.goodsDialog.catId,
                        sign: 'mch',
                        keyword: this.goodsDialog.keyword
                    },
                }).then(response => {
                    this.goodsDialog.loading = false;
                    if (response.data.code === 0) {
                        this.goodsDialog.list = response.data.data.list;
                        this.goodsDialog.pagination = response.data.data.pagination;
                    }
                }).catch(e => {
                });
            },
            goodsDialogPageChange(page) {
                this.goodsDialog.page = page;
                this.loadGoodsList();
            },
            goodsSelectionChange(e) {
                if (e && e.length) {
                    this.goodsDialog.selected = e;
                } else {
                    this.goodsDialog.selected = null;
                }
            },
            addGoods() {
                if (!this.goodsDialog.selected
                    || !this.goodsDialog.selected.length
                    || this.goodsDialog.mchIndex === null) {
                    this.goodsDialog.visible = false;
                    return;
                }
                const total = this.data.list[this.goodsDialog.mchIndex].goodsList.length
                    + this.goodsDialog.selected.length;

                if (total > this.maxGoodsLength) {
                    this.$message.error('商品数量不能大于' + this.maxGoodsLength + '个。');
                    return;
                }
                for (let i in this.goodsDialog.selected) {
                    const item = {
                        id: this.goodsDialog.selected[i].id,
                        name: this.goodsDialog.selected[i].name,
                        picUrl: this.goodsDialog.selected[i].cover_pic,
                        price: this.goodsDialog.selected[i].price,
                    };
                    this.data.list[this.goodsDialog.mchIndex].goodsList.push(item);
                }
                this.goodsDialog.mchIndex = null;
                this.goodsDialog.selected = null;
                this.goodsDialog.visible = false;
            },
            deleteGoods(mchIndex, goodsIndex) {
                this.data.list[mchIndex].goodsList.splice(goodsIndex, 1);
            },
            showMchDialog() {
                this.mchDialog.list = null;
                this.mchDialog.selected = null;
                this.mchDialog.visible = true;
            }
        }
    });
</script>