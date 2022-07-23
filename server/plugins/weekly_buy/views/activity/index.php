<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: fjt
 */
Yii::$app->loadViewComponent('app-activity-list');
?>

<div id="app" v-cloak>
    <app-activity-list
        activity_name="周期购"
        :tabs="tabs"
        :id_sort="!hidden_stock"
        search_placeholder="请输入商品ID或名称搜索"
        sign="weekly_buy"
        :name_width="585"
        time_width="240"
        :right_width="250"
        :show_stock="hidden_stock"
        activity_url="plugin/weekly_buy/mall/activity/index"
        activity_detail_url="plugin/weekly_buy/mall/activity/detail"
        edit_activity_status_url="plugin/weekly_buy/mall/activity/operate"
        edit_activity_destroy_url="plugin/weekly_buy/mall/activity/operate"
        edit_activity_url="plugin/weekly_buy/mall/activity/edit"
    >
        <el-table-column
             slot="before_status"
             prop="weekly"
             label="配送周期"
             width="130">
            <template slot-scope="scope">
                <span v-if="scope.row.week_type == 1">1日/期</span>
                <span v-if="scope.row.week_type == 2">1周/期</span>
                <span v-if="scope.row.week_type == 3">1月/期</span>
                <span v-if="scope.row.week_type == 4">{{scope.row.week_status_customize_day}}日/期</span>
                <span v-if="scope.row.week_type == 5">按周循环</span>
                <span v-if="scope.row.week_type == 6">按月循环</span>
            </template>
        </el-table-column>
        <el-table-column
             slot="after_status"
             prop="weekly"
             label="活动状态">
            <template slot-scope="scope">
                <el-tag v-for="item in tabs" v-if="item.value == scope.row.status" size="small" :type="item.type">{{item.name}}</el-tag>
            </template>
        </el-table-column>
    </app-activity-list>
</div>

<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                hidden_stock: false,
                tabs: [
                    {
                        name: '全部',
                        value: '1'
                    },
                    {
                        name: '未开始',
                        type: 'success',
                        value: '2'
                    },
                    {
                        name: '进行中',
                        type: '',
                        value: '3'
                    },
                    {
                        name: '已结束',
                        type: 'info',
                        value: '4'
                    },
                    {
                        name: '下架中',
                        type: 'warning',
                        value: '5'
                    }
                ]
            };
        },
        created() {
        },
        methods: {
        }
    });
</script>
