<?php defined('YII_ENV') or exit('Access Denied'); ?>
<style>
    .m-date .m-label {
        font-size: 16px;
        color: #242424;
        padding: 0 5px 4px;
        cursor: pointer;
        border-bottom-width: 4px;
        border-bottom-style: solid;
        border-bottom-color: white;
    }

    .m-date .m-label.active {
        border-bottom-color: #409EFF;
    }

    .m-date .el-dialog {
        min-width: 459px;
    }
</style>
<template id="m-date">
    <div class="m-date">
        <el-dialog title="日期选择" :visible.sync="dateVisible" top="5vh" width="459px" @close="onClose">
            <div flex="dir:top cross:center">
                <el-form ref="editForm" label-width="100px" :rules="editFormRules" style="width: 100%"
                         :model="editForm">
                    <div style="padding: 0 29px;margin-bottom: 20px" flex="dir:left cross:center main:justify">
                        <div class="m-label" @click="changeType('year')"
                             :class="{'active' : editForm.type === 'year'}">年
                        </div>
                        <div class="m-label" @click="changeType('month')"
                             :class="{'active' : editForm.type === 'month'}">年-月
                        </div>
                        <div class="m-label" @click="changeType('date')"
                             :class="{'active' : editForm.type === 'date'}">年-月-日
                        </div>
                    </div>
                    <el-form-item style="margin-bottom: 22px" label="开始日期">
                        <app-radio v-model="editForm.is_now" :label="1" turn>
                            <template v-if="editForm.type === 'year'">今年</template>
                            <template v-if="editForm.type === 'month'">本月</template>
                            <template v-if="editForm.type === 'date'">当天</template>
                        </app-radio>
                        <app-radio v-model="editForm.is_now" :label="0" turn>自定义</app-radio>
                        <div v-if="editForm.is_now == 0">
                            <el-date-picker
                                    v-model="editForm.start_at"
                                    :format="formatV.format"
                                    :value-format="formatV.valueFormat"
                                    :type="formatV.type"
                                    placeholder="开始日期"
                                    size="small">
                            </el-date-picker>
                        </div>
                    </el-form-item>
                    <el-form-item style="margin-bottom: 22px" label="结束日期">
                        <el-date-picker
                                v-model="editForm.end_at"
                                :format="formatV.format"
                                :value-format="formatV.valueFormat"
                                :type="formatV.type"
                                :picker-options="pickerOptions"
                                placeholder="结束日期"
                                size="small">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item style="margin-bottom: 22px" label="日期选项">
                        <app-radio v-model="editForm.is_alone" :label="1" turn>单日期</app-radio>
                        <app-radio v-model="editForm.is_alone" :label="0" turn>时间段</app-radio>
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
    Vue.component('m-date', {
        template: '#m-date',
        props: {
            value: Boolean,
            typeData: Object
        },
        data() {
            return {
                dateVisible: false,
                editFormRules: {},
                editForm: {
                    is_now: 1,
                    start_at: '',
                    end_at: '',
                    is_alone: 1,
                    type: 'date',
                },
                pickerOptions: this.pickerOptionsDate(),
            };
        },
        watch: {
            value: {
                deep: true,
                handler(newVal) {
                    this.dateVisible = newVal;
                },
            },
        },
        created() {
            Object.assign(this.editForm, {
                is_now: 1,
                start_at: '',
                end_at: '',
                is_alone: 1,
                type: 'date',
            }, this.typeData)
        },
        computed: {
            formatV() {
                let {type} = this.editForm;
                let style = {type};
                if (type === 'year') {
                    Object.assign(style, {
                        format: 'yyyy',
                        valueFormat: 'yyyy',
                    })
                }
                if (type === 'month') {
                    Object.assign(style, {
                        format: 'yyyy-MM',
                        valueFormat: 'yyyy-MM',
                    })
                }
                if (type === 'date') {
                    Object.assign(style, {
                        format: 'yyyy-MM-dd',
                        valueFormat: 'yyyy-MM-dd',
                    })
                }
                return style;
            },
        },
        methods: {
            pickerOptionsDate() {
                let self = this;
                return {
                    disabledDate(time) {
                        if (self.editForm.is_now == 1) {
                            return time.getTime() < Date.now() - 24 * 60 * 60 * 1000
                        }
                    }
                }
            },
            changeType(type) {
                let start_at, end_at
                Object.assign(this.editForm, {type, start_at, end_at});
            },
            onSubmit() {
                this.$refs.editForm.validate((valid) => {
                    if (valid) {
                        if (this.editForm.end_at) {
                            let time = null
                            if (this.editForm.type === 'year') {
                                time = "<?= (new DateTime())->format('Y') ?>";
                            } else if (this.editForm.type === 'month') {
                                time = "<?= (new DateTime())->format('Y-m') ?>";
                            } else if (this.editForm.type === 'date') {
                                time = "<?= (new DateTime())->format('Y-m-d') ?>";
                            }
                            if (this.editForm.is_now == 1) {
                                if (time > this.editForm.end_at) {
                                    this.$message.error('时间不合规范');
                                    return;
                                }
                            } else if (this.editForm.start_at && this.editForm.start_at > this.editForm.end_at) {
                                this.$message.error('时间不合规范');
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
