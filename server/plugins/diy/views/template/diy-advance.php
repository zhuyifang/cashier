<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/5/8
 * Time: 11:02
 */
Yii::$app->loadViewComponent('diy/diy-bg');
?>
<style>
    .diy-advance .diy-component-edit .goods-list {
        line-height: normal;display:flex;
        flex-wrap: wrap;
    }

    .diy-advance .diy-component-edit .goods-item,
    .diy-advance .diy-component-edit .goods-add {
        width: 50px;
        height: 50px;
        border: 1px solid #e2e2e2;
        background-position: center;
        background-size: cover;
        margin-right: 15px;
        margin-bottom: 15px;
        position: relative;
    }

    .diy-advance .diy-component-edit .goods-add {
        cursor: pointer;
    }

    .diy-advance .diy-component-edit .goods-delete {
        position: absolute;
        top: -11px;
        right: -11px;
        width: 25px;
        height: 25px;
        line-height: 25px;
        padding: 0 0;
        visibility: hidden;
    }

    .diy-advance .diy-component-edit .goods-item:hover .goods-delete {
        visibility: visible;
    }

    /*-------------------- 预览部分 --------------------*/
    .diy-advance .diy-component-preview .goods-list {
        flex-wrap: wrap;
        padding: 10px;
    }

    .diy-advance .diy-component-preview .goods-item {
        position: relative;
    }

    .diy-advance .diy-component-preview .goods-tag {
        position: absolute;
        top: 0;
        left: 0;
        width: 64px;
        height: 64px;
        background-position: center;
        background-size: cover;
    }

    .diy-advance .diy-component-preview .goods-pic {
        width: 100%;
        height: 706px;
        background-color: #e2e2e2;
        background-position: center;
        background-size: cover;
        position: relative;
        background-repeat: no-repeat;
    }
    
    .diy-advance .diy-component-preview .goods-cover-3-2 .goods-pic {
        height: 470px;
    }

    .diy-advance .diy-component-preview .goods-list-2 .goods-pic {
        height: 343px;
    }

    .diy-advance .diy-component-preview .goods-list--1 .goods-pic {
        width: 200px;
        height: 200px;
        margin-right: 20px;
    }

    .diy-advance .diy-component-preview .goods-list--1 .goods-item {
        margin-bottom: 20px;
    }

    .diy-advance .diy-component-preview .goods-list--1 .goods-item:last-child {
        margin-bottom: 0;
    }

    .diy-advance .diy-component-preview .goods-name-static {
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        word-break: break-all;
        margin-bottom: 12px;
    }

    .diy-advance .diy-component-preview .goods-price {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #ff4544;
    }

    .diy-advance .diy-component-preview .goods-advance-timer {
        position: relative;
        height: 80px;
        line-height: 80px;
        background: #ff4544;
        color: #353535;
        font-size: 28px;
    }

    .diy-advance .plugin-name {
        height: 28px;
        line-height: 28px;
        padding: 0 8px;
        color: #ff4544;
        font-size: 24px;
        background-color: #feeeee;
        border-radius: 14px;
        margin-right: 8px;
    }

    .diy-advance .des-text {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        display: inline-block;
        height: 30px;
        border: 1px solid #ff4544;
        border-radius: 15px;
        font-size: 20px;
        line-height: 26px;
        text-align: center;
        padding: 0 8px;
        color: #ff4544;
        margin-top: 10px;
    }
    .diy-advance .list-time {
        height: 36px;
        line-height: 36px;
        text-align: center;
        width: 38px;
        background: #F3F3F3;
        border-radius: 4px;
        margin: 0 6px;
        font-weight: 500;
    }
    .diy-advance .scroll {
        width: 100%;
        color: #333333;
    }
    .diy-advance .scroll.list-one {
        position: absolute;
        height: 100%;
        width: 340px;
        right: 10px;
    }
    .diy-advance .scroll .list-time {
        font-size: 24px;
        margin: 0 3px;
        background-color: #333333;
        color: #FFFFFF;
    }
</style>
<template id="diy-advance">
    <div class="diy-advance">
        <div class="diy-component-preview" :style="cListStyle">
            <app-g :data="data" :extra="true" :list="cList" sign="advance">
                <template slot="picEnd">
                    <div :style="cTimerStyle" :flex="cTimerFlex" class="goods-advance-timer"
                         v-if="data.listStyle!= -1">
                        <div v-if="data.listStyle===1">
                            <img src="statics/img/app/diy/advance.png" style="width: 100%;height: 100%;" alt="">
                        </div>
                        <div flex="main:justify cross:center" class="scroll" :class="data.listStyle===1 ? 'list-one' :''">
                            <div style="flex-shrink: 0;white-space: nowrap;">距结束</div>
                            <div flex="dir:left cross:center">
                                <div flex="main:center cross:center" :style="timeStyle" class="list-time">30</div>
                                <div>:</div>
                                <div flex="main:center cross:center" :style="timeStyle" class="list-time">29</div>
                                <div>:</div>
                                <div flex="main:center cross:center" :style="timeStyle" class="list-time">58</div>
                            </div>
                        </div>
                    </div>
                </template>
                <template slot="nameSupply" slot-scope="scope">
                    <div v-if="data.listStyle===-1" flex="dir:left cross:center" style="color: #999999;height: 36px;font-size: 24px;margin-top: 10px;">
                        <div>距结束</div>
                        <div class="list-time">30</div>
                        <div>:</div>
                        <div class="list-time">29</div>
                        <div>:</div>
                        <div class="list-time">58</div>
                    </div>
                    <div class="des-text">
                        定金{{Number(scope.goods.deposit)}}抵{{Number(scope.goods.swell_deposit)}}
                    </div>
                </template>
            </app-g>
        </div>
        <div class="diy-component-edit">
            <div class="app-form-title">
                <div>预售</div>
            </div>
            <el-form label-width="150px" @submit.native.prevent style="padding: 20px 0">
                <el-form-item label="商品列表">
                    <draggable class="goods-list" flex
                               v-model="data.list"
                               ref="parentNode">
                        <div class="goods-item drag-drop" v-for="(goods,goodsIndex) in data.list"

                             :style="'background-image: url('+goods.picUrl+');'">
                            <el-button @click="deleteGoods(goodsIndex)" class="goods-delete"
                                       size="small" circle type="danger"
                                       icon="el-icon-close"></el-button>
                        </div>
                        <div class="goods-add" flex="main:center cross:center"
                             @click="goodsDialog.visible=true">
                            <i class="el-icon-plus"></i>
                        </div>
                    </draggable>
                </el-form-item>
                <el-form-item label="购买按钮颜色">
                    <el-color-picker v-model="data.buttonColor"></el-color-picker>
                </el-form-item>
                <el-form-item label="列表样式">
                    <app-radio turn v-model="data.listStyle" :label="-1" @change="listStyleChange">列表模式</app-radio>
                    <app-radio turn v-model="data.listStyle" :label="0" @change="listStyleChange">左右滑动</app-radio>
                    <app-radio turn v-model="data.listStyle" :label="1" @change="listStyleChange">一行一个</app-radio>
                    <app-radio turn v-model="data.listStyle" :label="2" @change="listStyleChange">一行两个</app-radio>
                    <app-radio turn v-model="data.listStyle" :label="3" @change="listStyleChange">一行三个</app-radio>
                </el-form-item>
                <el-form-item label="商品封面图宽高比例" v-if="data.listStyle==1">
                    <app-radio turn v-model="data.goodsCoverProportion" label="1-1">1:1</app-radio>
                    <app-radio turn v-model="data.goodsCoverProportion" label="3-2">3:2</app-radio>
                </el-form-item>
                <el-form-item label="商品封面图填充">
                    <app-radio turn v-model="data.fill" :label="1">填充</app-radio>
                    <app-radio turn v-model="data.fill" :label="0">留白</app-radio>
                </el-form-item>
                <el-form-item label="商品样式">
                    <app-radio turn v-model="data.goodsStyle" :label="1">白底无边框</app-radio>
                    <app-radio turn v-model="data.goodsStyle" :label="2">白底有边框</app-radio>
                    <app-radio turn v-model="data.goodsStyle" :label="3" v-if="false" >无底无边框</app-radio>
                </el-form-item>
                <el-form-item label="显示商品名称">
                    <el-switch v-model="data.showGoodsName"></el-switch>
                </el-form-item>
                <el-form-item v-if="data.listStyle!==-1" label="文本样式">
                    <app-radio turn v-model="data.textStyle" :label="1">左对齐</app-radio>
                    <app-radio turn v-model="data.textStyle" :label="2">居中</app-radio>
                </el-form-item>
                <template v-if="cShowEditBuyBtn">
                    <el-form-item label="显示购买按钮">
                        <el-switch v-model="data.showBuyBtn"></el-switch>
                    </el-form-item>
                    <el-form-item v-if="data.showBuyBtn" label="购买按钮样式">
                        <app-radio turn v-model="data.buyBtnStyle" :label="1">填充</app-radio>
                        <app-radio turn v-model="data.buyBtnStyle" :label="2">线条</app-radio>
                        <app-radio turn v-model="data.buyBtnStyle" :label="3">圆角填充</app-radio>
                        <app-radio turn v-model="data.buyBtnStyle" :label="4">圆角线条</app-radio>
                    </el-form-item>
                    <el-form-item v-if="data.showBuyBtn" label="购买按钮文字">
                        <el-input maxlength="4" size="small" v-model="data.buyBtnText"></el-input>
                    </el-form-item>
                </template>
                <el-form-item label="显示商品角标">
                    <el-switch v-model="data.showGoodsTag"></el-switch>
                </el-form-item>
                <el-form-item label="商品角标样式" v-if="data.showGoodsTag">
                    <app-radio turn v-model="data.goodsTagPicUrl" v-for="tag in goodsTags" :label="tag.picUrl"
                               :key="tag.name"
                               @change="goodsTagChange">
                        {{tag.name}}
                    </app-radio>
                    <app-radio turn v-model="data.customizeGoodsTag" :label="true" @change="customizeGoodsTagChange">自定义
                    </app-radio>
                </el-form-item>
                <el-form-item label="自定义商品角标" v-if="data.showGoodsTag&&data.customizeGoodsTag">
                    <app-image-upload width="64" height="64" v-model="data.goodsTagPicUrl"></app-image-upload>
                </el-form-item>
                <el-form-item label="显示划线价" v-if="[-1,0,1,2,3].indexOf(data.listStyle) != -1">
                    <el-switch v-model="data.isUnderLinePrice"></el-switch>
                </el-form-item>
                <app-padding v-model="data">
                    <template slot="bg">
                        <el-form-item label="底部背景颜色">
                            <el-color-picker
                                    @change="(row) => {row == null ? data.backgroundColor = '#ffffff' : ''}"
                                    size="small"
                                    v-model="data.backgroundColor"></el-color-picker>
                            <el-input size="small" class="c-input-big"
                                      v-model="data.backgroundColor"></el-input>
                        </el-form-item>
                    </template>
                </app-padding>
            </el-form>
        </div>
        <el-dialog title="选择商品" :visible.sync="goodsDialog.visible" @open="goodsDialogOpened">
            <el-input size="mini" v-model="goodsDialog.keyword" placeholder="根据名称搜索" :clearable="true"
                      @clear="goodsDialogPageChange(1)" @keyup.enter.native="goodsDialogPageChange(1)">
                <el-button slot="append" @click="goodsDialogPageChange(1)">搜索</el-button>
            </el-input>
            <el-table :data="goodsDialog.list" v-loading="goodsDialog.loading" @selection-change="goodsSelectionChange">
                <el-table-column type="selection" width="50px"></el-table-column>
                <el-table-column label="ID" prop="id" width="100px"></el-table-column>
                <el-table-column label="名称" prop="name"></el-table-column>
                <el-table-column label="时间" prop="open_date"></el-table-column>
                <el-table-column label="场次" prop="open_time"></el-table-column>
            </el-table>
            <div style="text-align: center">
                <el-pagination
                        hide-on-single-page
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
    Vue.component('diy-advance', {
        template: '#diy-advance',
        props: {
            value: Object,
        },
        data() {
            return {
                goodsDialog: {
                    visible: false,
                    page: 1,
                    keyword: '',
                    loading: false,
                    list: [],
                    pagination: {
                        pageSize: 1
                    },
                    selected: null,
                },
                goodsTags: [
                    {
                        name: '热销',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-rx.png',
                    },
                    {
                        name: '新品',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-xp.png',
                    },
                    {
                        name: '折扣',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-zk.png',
                    },
                    {
                        name: '推荐',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-tj.png',
                    },
                ],
                data: {
                    buttonColor: '#ff4544',
                    list: [],
                    listStyle: 1,
                    fill: 1,
                    goodsCoverProportion: '1-1',
                    goodsStyle: 1,
                    textStyle: 1,
                    showGoodsName: true,
                    showBuyBtn: true,
                    buyBtnStyle: 1,
                    buyBtnText: '抢购',
                    showGoodsTag: false,
                    showGoodsPrice: true,
                    customizeGoodsTag: false,
                    goodsTagPicUrl: _currentPluginBaseUrl + '/images/goods-tag-rx.png',
                    goodsIndex: 0,
                    start_x: 0,
                    showImg: false,
                    backgroundColor: '#fff',
                    backgroundPicUrl: '',
                    position: 5,
                    mode: 1,
                    backgroundHeight: 100,
                    backgroundWidth: 100,
                    isUnderLinePrice: true,
                    c_padding_top: 0,
                    c_padding_lr: 24,
                    c_padding_bottom: 24,
                    c_border_top: 16,
                    c_border_bottom: 16,
                    bg: '#FFFFFF',
                },
                position: 'center center',
                repeat: 'no-repeat',
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
            cListStyle() {
                if (this.data.backgroundColor) {
                    return `background-color:${this.data.backgroundColor};background-image:url(${this.data.backgroundPicUrl});background-size:${this.data.backgroundWidth}% ${this.data.backgroundHeight}%;background-repeat:${this.repeat};background-position:${this.position}`
                } else {
                    return `background-image:url(${this.data.backgroundPicUrl});background-size:${this.data.backgroundWidth}% ${this.data.backgroundHeight}%;background-repeat:${this.repeat};background-position:${this.position}`
                }
            },
            cList() {
                if (!this.data.list || !this.data.list.length) {
                    const item = {
                        id: 0,
                        name: '演示商品名称',
                        picUrl: '',
                        price: '100.00',
                        originalPrice: '300.00',
                        deposit: '10',
                        swell_deposit: '20',
                    };
                    return [item, item,];
                } else {
                    return this.data.list;
                }
            },
            cListFlex() {
                if (this.data.listStyle === -1) {
                    return 'dir:top';
                } else {
                    return 'dir:left';
                }
            },
            cItemStyle() {
                if (this.data.listStyle === 2) {
                    return 'width: 50%;';
                } else {
                    return 'width: 100%;';
                }
            },
            cGoodsStyle() {
                let style = 'border-radius:5px;';
                if (this.data.goodsStyle === 2) {
                    style += 'border: 1px solid #e2e2e2;';
                }
                if (this.data.goodsStyle != 3) {
                    style += 'background-color:#ffffff';
                }
                return style;
            },
            cGoodsInfoStyle() {
                let style = 'position:relative;';
                if (this.data.listStyle !== -1) {
                    style += 'padding:20px;';
                } else {
                    style += 'padding: 15px 20px 0 0;';
                }
                if (this.data.textStyle === 2) {
                    style += 'text-align: center;';
                }
                return style;
            },
            cPriceStyle() {
                let style = 'margin-top: 10px;';
                if (this.data.textStyle === 2) {
                    style += 'text-align: center;width: 100%;';
                }
                return style;
            },
            cGoodsFlex() {
                if (this.data.listStyle === -1) {
                    return 'dir:left box:first';
                } else {
                    return 'dir:top';
                }
            },
            cButtonStyle() {
                let style = `background: ${this.data.buttonColor};border-color: ${this.data.buttonColor};height:48px;line-height:50px;padding: 0 20px;`;
                if (this.data.buyBtnStyle === 3 || this.data.buyBtnStyle === 4) {
                    style += `border-radius:24px;`;
                }
                if (this.data.buyBtnStyle === 2 || this.data.buyBtnStyle === 4) {
                    style += `background:#fff;color:${this.data.buttonColor}`;
                }
                return style;
            },
            timeStyle() {
                let height;
                let width;
                if (this.data.listStyle === 1) {
                    height = 52;
                    width = 56;
                } else if (this.data.listStyle === 2) {
                    height = 40;
                    width = 42;
                } else {
                    height = 32;
                    width = 34;
                }
                let style = `height: ${height}px;width: ${width}px;`
                if(this.data.listStyle === 1) {
                    style += `font-size:32px;margin: 0 10px;`
                }
                return style
            },
            cTimerStyle() {
                if (this.data.listStyle === 2) {
                    return 'height:56px;line-height:54px;font-size:28px;padding: 0 20px;background: linear-gradient(135deg, #FFE3D6 0%, #FFEADA 43%, #FFF0E8 61%, #FFD0B7 100%);';
                } else if(this.data.listStyle === 0 || this.data.listStyle == 3) {
                    return 'height:52px;line-height:50px;font-size:20px;padding: 0 10px;background: linear-gradient(135deg, #FFE3D6 0%, #FFEADA 43%, #FFF0E8 61%, #FFD0B7 100%);';
                } else {
                    return '';
                }
            },
            cTimerFlex() {
                if (this.data.listStyle === 2) {
                    return 'main:center';
                } else {
                    return 'box:last';
                }
            },
            cShowBuyBtn() {
                return this.data.textStyle !== 2
                    && this.data.showBuyBtn;
            },
            cShowEditBuyBtn() {
                return this.data.textStyle !== 2 && this.data.listStyle !== 0  && this.data.listStyle !== 3
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
            cGoodsPicStyle(picUrl) {
                let style = `background-image: url(${picUrl});`
                    + `background-size: ${(this.data.fill === 1 ? 'cover' : 'contain')};`;
                return style;
            },
            listStyleChange(listStyle) {
                if (listStyle === -1 && this.data.textStyle === 2) {
                    this.data.textStyle = 1;
                }
            },
            goodsDialogOpened() {
                this.loadGoodsList();
            },
            loadGoodsList() {
                this.goodsDialog.loading = true;
                this.$request({
                    params: {
                        r: 'plugin/diy/mall/template/get-goods',
                        page: this.goodsDialog.page,
                        keyword: this.goodsDialog.keyword,
                        sign: 'advance',
                    }
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
                if (!this.goodsDialog.selected || !this.goodsDialog.selected.length) {
                    this.goodsDialog.visible = false;
                    return;
                }
                // const total = this.data.list.length + this.goodsDialog.selected.length;
                // if (total > 10) {
                //     this.goodsDialog.visible = false;
                //     this.$message.error('商品数量不能大于10个。');
                //     return;
                // }
                for (let i in this.goodsDialog.selected) {
                    const item = {
                        id: this.goodsDialog.selected[i].id,
                        name: this.goodsDialog.selected[i].name,
                        picUrl: this.goodsDialog.selected[i].cover_pic,
                        price: this.goodsDialog.selected[i].price,
                        originalPrice: this.goodsDialog.selected[i].original_price,
                        deposit: this.goodsDialog.selected[i].advanceGoods.deposit,
                        swell_deposit: this.goodsDialog.selected[i].advanceGoods.swell_deposit,
                    };
                    this.data.list.push(item);
                }
                this.goodsDialog.selected = null;
                this.goodsDialog.visible = false;
            },
            deleteGoods(index) {
                this.data.list.splice(index, 1);
            },
            goodsTagChange(e) {
                this.data.goodsTagPicUrl = e;
                this.data.customizeGoodsTag = false;
            },
            customizeGoodsTagChange(e) {
                this.data.goodsTagPicUrl = '';
                this.data.customizeGoodsTag = true;
            },
        }
    });
</script>
