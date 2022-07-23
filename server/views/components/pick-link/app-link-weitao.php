<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2021/9/27
 * Time: 2:31 下午
 * @copyright: ©2021 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
Yii::$app->loadViewComponent('pick-link/app-pick-link-demo');
?>
<template id="app-link-weitao">
    <div style="display: inline-block">
        <app-pick-link-demo title="店铺微淘" placeholder="根据ID、标签搜索"
                            list-url="mall/mch/weitao" :other="other"
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
                    <el-table-column label="ID" prop="id" width="160">
                        <template slot-scope="scope">
                            <div flex="dir:left cross:center">
                                <el-radio :label="scope.$index" v-model="id">
                                    {{scope.row.id}}
                                </el-radio>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column label="标签" prop="tag_name"></el-table-column>
                    <el-table-column label="微淘内容" width="400px">
                        <template slot-scope="scope">
                            <div flex="dir:left">
                                <img :src="scope.row.pic_url" style="width: 50px;height: 50px;margin-right: 10px;">
                                <div flex="dir:top">
                                    <app-ellipsis :line="1">{{scope.row.title}}</app-ellipsis>
                                    <span>{{scope.row.created_at}}</span>
                                </div>
                            </div>
                        </template>
                    </el-table-column>
                </el-table>
            </template>
        </app-pick-link-demo>
    </div>
</template>
<script>
    Vue.component('app-link-weitao', {
        template: '#app-link-weitao',
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
                    type: 'link'
                }
            };
        },
        created() {
            this.select = this.value;
        },
        methods: {
            confirm(select) {
                this.select = {
                    show_name: select.title,
                    id: select.id,
                    mch_id: select.mch_id
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
