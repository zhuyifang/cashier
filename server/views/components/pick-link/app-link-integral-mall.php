<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/18
 * Time: 9:41 上午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
Yii::$app->loadViewComponent('pick-link/app-pick-link-demo');
?>
<template id="app-link-integral-mall">
    <div style="display: inline-block">
        <app-pick-link-demo title="商品选择" placeholder="根据商品ID、商品名称搜索"
                            list-url="plugin/integral_mall/mall/goods/index" :other="other"
                            :select="select"
                            @confirm="confirm" v-model="isSelect" :id="id">
            <template #table="slotProps">
                <el-table
                    ref="multipleTable"
                    :data="slotProps.table.list"
                    border
                    max-height="400"
                    style="width: 100%;margin-top: 20px"
                    v-loading="slotProps.table.listLoading">
                    <el-table-column label="ID" prop="id">
                        <template slot-scope="scope">
                            <div flex="dir:left cross:center">
                                <el-radio :label="scope.$index" v-model="id">
                                    {{scope.row.id}}
                                </el-radio>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column label="商品名称" prop="name" width="350">
                        <template slot-scope="scope">
                            <div flex="box:first">
                                <div style="padding-right: 10px;">
                                    <app-image mode="aspectFill" :src="scope.row.goodsWarehouse.cover_pic"></app-image>
                                </div>
                                <div flex="cross:top">
                                    <div flex="dir:left" style="overflow:hidden;">
                                        <div style="position: absolute;width: 250px;height: 50px;overflow: hidden" flex="dir:left">
                                            <el-tooltip class="item"
                                                        effect="dark"
                                                        placement="top">
                                                <template slot="content">
                                                    <div style="width: 320px;" flex="cross:center">{{scope.row.goodsWarehouse.name}}</div>
                                                </template>
                                                <div v-line-clamp="2" v-if="scope.row.goodsWarehouse.name.length < 30" flex="cross:center">{{scope.row.goodsWarehouse.name}}</div>
                                                <div v-line-clamp="2" v-else>{{scope.row.goodsWarehouse.name}}</div>
                                            </el-tooltip>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column prop="price" width="105" label="兑换价格">
                        <template slot-scope="scope">
                            <div>{{scope.row.price}}</div>
                        </template>
                    </el-table-column>
                    <el-table-column prop="integral_num" width="105" label="兑换积分">
                        <template slot-scope="scope">
                            <div>{{scope.row.integral_num}}</div>
                        </template>
                    </el-table-column>
                    <el-table-column label="库存" prop="goods_stock">
                        <template slot-scope="scope">
                            <div v-if="scope.row.goods_stock > 0">{{scope.row.goods_stock}}</div>
                            <div v-else style="color: red;">售罄</div>
                        </template>
                    </el-table-column>
                </el-table>
            </template>
        </app-pick-link-demo>
    </div>
</template>
<script>
    Vue.component('app-link-integral-mall', {
        template: '#app-link-integral-mall',
        props: {
            value: {
                type: Object | null,
                default: null
            }
        },
        data() {
            return {
                id: -1,
                select: '',
                other: {
                    search: {
                        status: 1
                    }
                }
            };
        },
        created() {
            this.select = this.value;
        },
        methods: {
            confirm(select) {
                this.select = {
                    show_name: select.name,
                    id: select.id,
                    goods_id: select.id
                };
                this.$emit('confirm', this.select);
            },
        },
        computed: {
            isSelect() {
                return !this.select || this.select.length === 0
            }
        }
    });
</script>
