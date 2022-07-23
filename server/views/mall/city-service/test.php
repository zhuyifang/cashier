<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */
?>
<style>
    .set-el-button {
        padding: 0!important;
        border: 0;
        margin: 0 5px;
    }

    .table-body {
        padding: 20px;
        background-color: #fff;
    }

    .table-info .el-button {
        padding: 0 !important;
        border: 0;
        margin: 0 5px;
    }
</style>
<div id="app" v-cloak>
    <el-card class="box-card" shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 10px 0 0;">
        <div slot="header">
            <div>
                <span>联调测试</span>
            </div>
        </div>
        <div class="table-body" v-loading="listLoading">
            <el-tabs v-model="activeName" @tab-click="handleClick">
                <el-tab-pane 
                    v-for="tab in tabs"
                    :key="tab.value"
                    :label="tab.label" 
                    :name="tab.value"
                >
                </el-tab-pane>
            </el-tabs>
            <!-- 顺丰 -->
            <template v-if="activeName == 'SF'">
                
            </template>
            <!-- 美团 -->
            <template v-if="activeName == 'MT'">
                <el-button @click="addOrder">生成订单</el-button>
                <el-table
                    :data="list"
                    style="width: 100%">
                    <el-table-column
                      label="日期"
                      width="180">
                      <template slot-scope="scope">
                        <i class="el-icon-time"></i>
                        <span style="margin-left: 10px">{{ scope.row.date }}</span>
                      </template>
                    </el-table-column>
                    <el-table-column
                      label="姓名"
                      width="180">
                      <template slot-scope="scope">
                        <el-popover trigger="hover" placement="top">
                          <p>姓名: {{ scope.row.name }}</p>
                          <p>住址: {{ scope.row.address }}</p>
                          <div slot="reference" class="name-wrapper">
                            <el-tag size="medium">{{ scope.row.name }}</el-tag>
                          </div>
                        </el-popover>
                      </template>
                    </el-table-column>
                    <el-table-column label="操作">
                      <template slot-scope="scope">
                        <!-- <el-button
                          size="mini"
                          @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button
                          size="mini"
                          type="danger"
                          @click="handleDelete(scope.$index, scope.row)">删除</el-button> -->
                      </template>
                    </el-table-column>
                </el-table>
            </template>
        </div>
    </el-card>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                activeName: 'MT',
                listLoading: false,
                tabs: [],
                list: []
            };
        },
        methods: {
            handleClick(tab, event) {
                console.log(tab, event);
            },
            getSetting() {
                let self = this;
                self.listLoading = true;
                request({
                    params: {
                        r: 'mall/city-service/test',
                    },
                    method: 'get',
                }).then(e => {
                    self.listLoading = false;
                    self.tabs = e.data.data.tabs;
                }).catch(e => {
                    console.log(e);
                });
            },
            addOrder() {
                let self = this;
                self.listLoading = true;
                request({
                    params: {
                        r: 'mall/city-service/add-order',
                    },
                    method: 'post',
                    data: {
                        type: self.activeName,
                    }
                }).then(e => {
                    console.log(e)
                }).catch(e => {
                    console.log(e);
                });
            }
        },
        mounted: function () {
            this.getSetting();
        }
    });
</script>