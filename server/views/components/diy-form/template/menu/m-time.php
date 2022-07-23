<?php defined('YII_ENV') or exit('Access Denied'); ?>
<style>
    .m-time .m-label {
        font-size: 16px;
        color: #242424;
        padding: 0 5px 4px;
        cursor: pointer;
        border-bottom-width: 4px;
        border-bottom-style: solid;
        border-bottom-color: white;
    }

    .m-time .m-label.active {
        border-bottom-color: #409EFF;
    }

    .m-time .el-dialog {
        min-width: 459px;
    }

    .m-time .el-date-editor .el-range-separator {
        width: 10%;
    }
</style>
<template id="m-time">
    <div class="m-time">
        <el-dialog title="时间选择" :visible.sync="timeVisible" top="5vh" width="459px" @close="onClose">
            <div flex="dir:top cross:center">
                <el-form ref="editForm" label-width="80px" :rules="editFormRules" style="width: 100%"
                         size="small" :model="editForm">
                    <el-form-item :label="`起始时间${index + 1}`" v-for="(item,index) in editForm.start_list">
                        <div flex="dir:left cross:center">
                            <el-time-picker
                                    style="width: 280px"
                                    size="small"
                                    is-range
                                    value-format="HH:mm"
                                    format="HH:mm"
                                    v-model="item.time"
                                    range-separator="至"
                                    start-placeholder="开始时间"
                                    end-placeholder="结束时间"
                                    placeholder="选择时间范围">
                            </el-time-picker>
                            <app-image height="20px" width="20px"
                                       v-if="index > 0"
                                       style="cursor:pointer;margin-left: 10px"
                                       @click.native="editForm.start_list.splice(index,1)"
                                       src="statics/img/mall/form/menu-basic-del.png"
                            ></app-image>
                        </div>
                    </el-form-item>
                    <el-button type="primary" style="margin-left: 18px;margin-bottom: 25px" size="mini"
                               @click="editForm.start_list.push({time: ['','']})" plain>+ 添加
                    </el-button>
                    <el-form-item label="间隔时间">
                        <el-select style="width:100%" v-model="editForm.limit_time" size="small" placeholder="请选择">
                            <el-option
                                    v-for="item in timeOption"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="显示方式">
                        <app-radio v-model="editForm.show_type" label="alone" turn>单日期
                            <el-tooltip class="item" effect="dark" content="示例：14:00" placement="top">
                                <i style="color:#606266" class="el-icon-info"></i>
                            </el-tooltip>
                        </app-radio>
                        <app-radio v-model="editForm.show_type" label="between" turn>时间段
                            <el-tooltip class="item" effect="dark" content="示例：14:00 -14:05" placement="top">
                                <i style="color:#606266" class="el-icon-info"></i>
                            </el-tooltip>
                        </app-radio>
                    </el-form-item>
                </el-form>
                <div style="text-align: center">
                    <el-button @click="onSubmit" size="small" type="primary">确定</el-button>
                    <el-button @click="onClose" size="small">取消</el-button>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    Vue.component('m-time', {
        template: '#m-time',
        props: {
            value: Boolean,
            typeData: Object
        },
        data() {
            return {
                timeOption: [{
                    label: '5分钟',
                    value: 5
                }, {
                    label: '10分钟',
                    value: 10
                }, {
                    label: '15分钟',
                    value: 15
                }, {
                    label: '30分钟',
                    value: 30
                }, {
                    label: '60分钟',
                    value: 60
                }, {
                    label: '90分钟',
                    value: 90
                }, {
                    label: '120分钟',
                    value: 120
                }],
                timeVisible: false,
                editFormRules: {},
                editForm: {
                    start_list: [{time: ['', '']}],
                    limit_time: 5,
                    show_type: 'alone',
                },
            };
        },
        watch: {
            value: {
                deep: true,
                handler(newVal) {
                    this.timeVisible = newVal;
                },
            },
        },
        created() {
            Object.assign(this.editForm, this.typeData)
        },
        methods: {
            onSubmit() {
                this.$refs.editForm.validate((valid) => {
                    if (valid) {
                        let all = this.editForm.start_list.sort(function (a, b) {
                            return a.time[0] > b.time[0] ? 1 : -1;
                        });
                        for (let i = 1; i < all.length; i++) {
                            if (all[i].time[0] < all[i - 1].time[1]) {
                                this.$message.error('时间重叠');
                                return;
                            }
                        }
                        this.$emit('change', this.editForm);
                        this.onClose();
                    }
                });
            },
            onClose() {
                this.$emit('input', false);
            },
        },
    });
</script>
