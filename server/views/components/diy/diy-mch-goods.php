<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/5/8
 * Time: 11:02
 */
$baseUrl = \Yii::$app->request->hostInfo . \Yii::$app->request->baseUrl;
Yii::$app->loadViewComponent('diy/diy-bg');
Yii::$app->loadViewComponent('diy/app-g');
Yii::$app->loadViewComponent('diy/color');
?>
<style>

    .diy-mch-goods .del-btn {
        position: absolute;
        right: -8px;
        top: -8px;
        padding: 4px 4px;
    }

    .diy-mch-goods .reset {
        position: absolute;
        top: 8px !important;
        left: 90px;
    }
    .diy-mch-goods .diy-component-edit .goods-list {
        line-height: normal;
        flex-wrap: wrap;
    }

    .diy-mch-goods .diy-component-edit .goods-item,
    .diy-mch-goods .diy-component-edit .goods-add {
        width: 50px;
        height: 50px;
        border: 1px solid #e2e2e2;
        background-position: center;
        background-size: cover;
        margin-right: 15px;
        margin-bottom: 15px;
        position: relative;
    }

    .diy-mch-goods .diy-component-edit .goods-add {
        cursor: pointer;
    }

    .diy-mch-goods .diy-component-edit .goods-delete {
        position: absolute;
        top: -11px;
        right: -11px;
        width: 25px;
        height: 25px;
        line-height: 25px;
        padding: 0 0;
        visibility: hidden;
    }

    .diy-mch-goods .diy-component-edit .goods-item:hover .goods-delete {
        visibility: visible;
    }

    /*-------------------- 预览部分 --------------------*/
    .diy-mch-goods .diy-component-preview .goods-list {
        flex-wrap: wrap;
        padding: 10px;
    }

    .diy-mch-goods .diy-component-preview .goods-item {
        position: relative;
    }
    .diy-mch-goods .diy-component-preview .goods-list--1 .goods-item {
        margin-bottom: 20px;
    }

    .diy-mch-goods .diy-component-preview .goods-list--1 .goods-item:last-child {
        margin-bottom: 0;
    }


</style>
<template id="diy-mch-goods">
    <div class="diy-mch-goods">
        <div class="diy-component-preview" :style="cListStyle">
            <app-g :data="data" :list="cList" sign="mch"></app-g>
        </div>
        <div class="diy-component-edit">
            <el-form label-width="150px" @submit.native.prevent style="padding: 20px 0">
                <el-form-item label="商品列表">
                    <draggable class="goods-list" flex v-model="data.list" ref="parentNode">
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
                <el-form-item label="列表样式">
                    <app-radio turn v-model="data.listStyle" :label="-1" @change="listStyleChange">列表模式</app-radio>
                     <app-radio turn v-model="data.listStyle" :label="0" @change="listStyleChange">左右滑动</app-radio>
                    <app-radio turn v-model="data.listStyle" :label="1" @change="listStyleChange">一行一个</app-radio>
                    <app-radio turn v-model="data.listStyle" :label="2" @change="listStyleChange">一行两个</app-radio>
                    <app-radio turn v-model="data.listStyle" :label="3" @change="listStyleChange">一行三个</app-radio>
                </el-form-item>
                <el-form-item label="商品封面图填充">
                    <app-radio turn v-model="data.fill" :label="1">填充</app-radio>
                    <app-radio turn v-model="data.fill" :label="0">留白</app-radio>
                </el-form-item>
                <el-form-item label="商品条底色">
                    <color v-model="data.goodsEndColor" height></color>
                </el-form-item>
                <el-form-item label="商品条边框">
                    <color v-model="data.goodsBorderColor" height></color>
                </el-form-item>

                <el-form-item label="显示跳转按钮">
                    <el-switch v-model="data.showBuyBtn"></el-switch>
                </el-form-item>

                <el-form-item v-if="(data.listStyle === 3 || data.listStyle === 0) && data.showBuyBtn" label="按钮样式">
                    <app-attachment style="margin-bottom:10px" :multiple="false" :max="1"
                                    @selected="buyBtnPic">
                        <el-tooltip effect="dark"
                                    content="建议尺寸:30 * 30"
                                    placement="top">
                            <el-button size="mini">选择图标</el-button>
                        </el-tooltip>
                    </app-attachment>
                    <div style="margin-right: 20px;display:inline-block;position: relative;cursor: move;">
                        <app-attachment :multiple="false" :max="1"
                                        @selected="buyBtnPic">
                            <app-image mode="aspectFill"
                                       width="80px"
                                       height='80px'
                                       :src="data.buyBtnPic">
                            </app-image>
                        </app-attachment>
                        <el-button v-if="data.buyBtnPic" class="del-btn"
                                   size="mini" type="danger" icon="el-icon-close"
                                   circle
                                   @click="removeBuyBtnPic"></el-button>
                    </div>
                    <el-button size="mini" @click="resetImg" class="reset" type="primary">恢复默认</el-button>
                </el-form-item>

                <template v-else-if="data.showBuyBtn">
                    <el-form-item label="按钮颜色">
                        <color v-model="data.buttonColor" height></color>
                    </el-form-item>
                    <el-form-item label="按钮样式">
                        <app-radio turn v-model="data.buyBtnStyle" :label="1">填充</app-radio>
                        <app-radio turn v-model="data.buyBtnStyle" :label="2">线条</app-radio>
                        <app-radio turn v-model="data.buyBtnStyle" :label="3">圆角填充</app-radio>
                        <app-radio turn v-model="data.buyBtnStyle" :label="4">圆角线条</app-radio>
                    </el-form-item>
                    <el-form-item label="按钮文案颜色">
                        <color v-model="data.buyBtnTextColor" height></color>
                    </el-form-item>
                    <el-form-item  label="按钮文案">
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
                        <div></div>
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
    Vue.component('diy-mch-goods', {
        template: '#diy-mch-goods',
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
                    pagination: null,
                    selected: null,
                },
                goodsTags: [
                    {
                        name: '热销',
                        picUrl: "<?= $baseUrl ?>" + '/statics/img/mall/mch/weitao/goods-tag-rx.png',
                    },
                    {
                        name: '新品',
                        picUrl: "<?= $baseUrl ?>" + '/statics/img/mall/mch/weitao/goods-tag-xp.png',
                    },
                    {
                        name: '折扣',
                        picUrl: "<?= $baseUrl ?>" + '/statics/img/mall/mch/weitao/goods-tag-zk.png',
                    },
                    {
                        name: '推荐',
                        picUrl: "<?= $baseUrl ?>" + '/statics/img/mall/mch/weitao/goods-tag-tj.png',
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
                    buyBtnText: '去看看',
                    showGoodsTag: false,
                    customizeGoodsTag: false,
                    goodsTagPicUrl: "<?= $baseUrl ?>" + '/statics/img/mall/mch/weitao/goods-tag-rx.png',
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

                    buyBtnTextColor: '#FFFFFF',
                    buyBtnPic: "<?= $baseUrl ?>" + '/statics/img/mall/mch/weitao/jump-button.png',
                    goodsEndColor: '#F6F6F6',
                    goodsBorderColor: '',
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
            cList() {
                if (!this.data.list || !this.data.list.length) {
                    const item = {
                        id: 0,
                        name: '演示商品名称',
                        picUrl: '',
                        price: '300.00',
                        original_price: '200.00',
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
                let style = '';
                if (this.data.listStyle !== -1) {
                    style += 'padding:20px;';
                }
                if (this.data.textStyle === 2) {
                    style += 'text-align: center;';
                }
                return style;
            },
            cPriceStyle() {
                let style = '';
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
            cShowBuyBtn() {
                return this.data.textStyle !== 2
                    && this.data.showBuyBtn;
            },
            cShowEditBuyBtn() {
                return this.data.textStyle !== 2 && this.data.listStyle !== 0 && this.data.listStyle !== 3
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
            buyBtnPic(e) {
                if (e.length) {
                    this.data.buyBtnPic = e[0].url;
                }
            },
            removeBuyBtnPic() {
                this.data.buyBtnPic = "";
            },
            resetImg() {
                this.data.buyBtnPic = "<?= $baseUrl ?>" + '/statics/img/mall/mch/weitao/jump-button.png';
            },
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
                        r: 'mall/goods/index',
                        page: this.goodsDialog.page,
                        search: JSON.stringify({
                            keyword: this.goodsDialog.keyword
                        }),
                        sign: 'mch',
                    }
                }).then(response => {
                    this.goodsDialog.loading = false;
                    if (response.data.code === 0) {
                        let list = response.data.data.list;
                        list = list.map(item => {
                            item = Object.assign({}, item.goodsWarehouse, item, {picUrl: item.goodsWarehouse.cover_pic});
                            return item;
                        })
                        this.goodsDialog.list = list;
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
                        original_price: this.goodsDialog.selected[i].original_price,
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
