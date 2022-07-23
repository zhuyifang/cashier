<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/8
 * Time: 3:09 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
Yii::$app->loadViewComponent('pick-link/app-pick-link-demo');
?>
<template id="app-customer">
    <div style="display: inline-block">
        <app-pick-link-demo title="选择客服" placeholder="根据企业名称或者客服名称搜索"
                            list-url="plugin/customer_service/mall/index/customer"
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
                    <el-table-column label="企业名称" prop="qy_name">
                        <template slot-scope="scope">
                            <div flex="dir:left cross:center">
                                <el-radio :label="scope.$index" v-model="id">
                                    {{scope.row.qy_name}}
                                </el-radio>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column label="客服名称" prop="name"></el-table-column>
                </el-table>
            </template>
        </app-pick-link-demo>
    </div>
</template>
<script>
    Vue.component('app-customer', {
        template: '#app-customer',
        props: {
            value: {
                type: Object|null,
                default: null
            }
        },
        data() {
            return {
                id: -1,
                select: '',
            };
        },
        created() {
            this.select = this.value;
        },
        methods: {
            confirm(select) {
                select.show_name = select.qy_name;
                select.second_name = select.name;
                this.select = select;
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

