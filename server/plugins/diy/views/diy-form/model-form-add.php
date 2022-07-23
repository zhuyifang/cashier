<style>
    .model-form-add .input-item {
        display: inline-block;
        width: 250px;
    }

    .model-form-add .el-dialog {
        min-width: 600px;
    }

    .diy-form-dialog .el-form-item__label {
        padding-bottom: 10px;
        padding-top: 20px;
        line-height: 1;
    }

    .diy-form-dialog .el-dialog__body {
        padding-top: 0;
    }

    .diy-form-dialog .el-radio-button:not(:first-child) {
        margin-left: 24px;
    }

    .diy-form-dialog .el-radio-button .el-radio-button__inner {
        border-left: 1px solid #DCDFE6;
        border-radius: 4px;
    }

    .diy-form-dialog .el-radio-button:not(:first-child).is-active .el-radio-button__inner {
        box-shadow: 1px 0 0 0 #409eff;
    }

    .diy-form-dialog .el-radio-button__orig-radio:checked + .el-radio-button__inner {
        box-shadow: 1px 0 0 0 #409eff;
    }

    .diy-form-dialog .el-form-item {
        margin-bottom: 5px;
    }

    .diy-form-dialog .el-form-item__content {
        margin-left: 0 !important;
    }
</style>
<template id="model-form-add">
    <div class="model-form-add">
        <el-dialog :title="formForm.id?'修改表单': '新建表单'" :visible.sync="value" width="30%" top="10vh" @close="closeModel"
                   class="diy-form-dialog"
                   :close-on-click-modal="false">
            <el-form :model="formForm" :rules="formRules" ref="formForm"
                     label-position="top"
                     @submit.native.prevent>
                <el-form-item label="表单名称" prop="name">
                    <el-input size="small" v-model="formForm.name"
                              placeholder="请输入表单名称，最多输入30个字"
                              auto-complete="off"
                              maxlength="30"
                              show-word-limit
                    ></el-input>
                </el-form-item>
                <el-form-item label="是否开启分销" v-if="showShare" prop="is_share">
                    <el-switch v-model="formForm.is_share" :active-value="1" :inactive-value="0"></el-switch>
                    <span style="color:#ff4544;margin-left: 10px">注：必须在“
                        <el-button type="text" @click="$navigate({r:'mall/share/basic'}, true)">分销中心=>基础设置</el-button>
                                    ”中开启，才能使用
                    </span>
                </el-form-item>
                <el-form-item label="活动定时结束" prop="status">
                    <el-switch v-model="formForm.time_status" :active-value="1" :inactive-value="0"></el-switch>
                    <div>
                        <el-date-picker
                                style="width:100%"
                                v-if="formForm.time_status == 1"
                                format="yyyy-MM-dd HH:mm:ss"
                                value-format="yyyy-MM-dd HH:mm:ss"
                                v-model="formForm.time_at"
                                type="datetime"
                                size="small"
                                :picker-options="pickerOptions"
                                placeholder="请输入活动定时结束"
                                >
                        </el-date-picker>
                    </div>
                </el-form-item>
                <el-form-item label="提交周期" prop="status">
                    <el-radio-group v-model="formForm.status" size="small">
                        <el-radio-button label="0">永久</el-radio-button>
                        <el-radio-button label="1">每天</el-radio-button>
                        <el-radio-button label="2">每周</el-radio-button>
                        <el-radio-button label="3">每月</el-radio-button>
                        <el-radio-button label="4">每年</el-radio-button>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="总共可提交" prop="limit">
                    <el-input-number :step="1" step-strictly v-model="formForm.limit" size="small" :min="1" :max="9999999"></el-input-number>
                </el-form-item>
                <el-form-item label="超出提示" prop="tip">
                    <el-input type="textarea"
                              placeholder="请输入提示，最多输入32个字"
                              v-model="formForm.tip"
                              maxlength="32"
                              show-word-limit
                    ></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <template v-if="formForm.id">
                    <el-button size="small" :loading="btnLoading" @click="closeModel">取消</el-button>
                    <el-button size="small" :loading="btnLoading" @click.native="formSubmit" type="primary">提交
                    </el-button>
                </template>
                <el-button v-else size="small" :loading="btnLoading" @click.native="formSubmit" type="primary">下一步
                </el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    Vue.component('model-form-add', {
        template: '#model-form-add',
        props: {
            showShare: Boolean,
            form: {
                type: Object,
            },
            value: Boolean,
        },
        watch: {
            form: {
                deep: true,
                handler(newData) {
                    if (newData) {
                        Object.assign(this.formForm, newData)
                    }
                },
            }
        },
        data() {
            return {
                pickerOptions: {
                    disabledDate(time) {
                        return time.getTime() < Date.now() - 24 * 60 * 60 * 1000
                    }
                },
                formForm: {
                    id: '',
                    name: '',
                    status: 0,
                    limit: 1,
                    tip: '',
                    is_share: 0,
                    time_status: 0,
                    time_at: null,
                },
                formRules: {},
                btnLoading: false,
                formDialog: false,
            }
        },
        methods: {
            closeModel() {
                this.$emit('input', false)
            },
            formSubmit() {
                this.$refs.formForm.validate((valid) => {
                    if (valid) {
                        this.btnLoading = true;
                        request({
                            params: {
                                r: 'plugin/diy/mall/diy-form/index',
                            },
                            data: Object.assign({}, this.formForm, {
                                data: null,
                            }),
                            method: 'POST',
                        }).then(e => {
                            this.btnLoading = false;
                            if (e.data.code === 0) {
                                this.$message.success(e.data.msg);
                                this.$emit('submit', e.data.data);
                                this.closeModel();
                            } else {
                                this.$message.error(e.data.msg);
                            }
                        });
                    }
                });
            },
        },
    })
</script>