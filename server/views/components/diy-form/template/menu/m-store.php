<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .m-store .m-left {
        font-size: 14px;
        color: #545B60;
        flex-shrink: 0;
        flex-grow: 0;
        margin-top: 19px;
        margin-right: 27px;
    }

    .m-store .m-right {
        width: 378px;
        height: 326px;
        border: 1px solid #E5E7EC;
        border-radius: 10px;
    }

    .m-store .m-right .el-scrollbar__wrap {
        overflow-x: hidden;
        padding: 0 25px;
    }
    .m-store .el-checkbox__input.is-indeterminate .el-checkbox__inner::before {
        background-color: #409EFF;
    }
    .m-store .m-right .el-checkbox {
        display: block;
        margin-top: 12px;
        margin-bottom: 12px;
    }

    .m-store .m-right .el-checkbox .el-checkbox__input {
        float: left;
        margin-top: 2px;

    }

    .m-store .el-checkbox .el-checkbox__input .el-checkbox__inner {
        background-color: #FFFFFF;
    }

    .m-store .m-right .el-checkbox .el-checkbox__label {
        white-space: normal;
    }

    .m-store .el-dialog {
        min-width: 481px;
    }

    .m-store .el-checkbox__inner::after {
        border-color: #409EFF;
    }

</style>
<template id="m-store">
    <div class="m-store">
        <el-dialog title="门店选择" :visible.sync="storeVisible" top="5vh" width="481px" @close="onClose">
            <div flex="dir:left main:center">
                <div class="m-left">门店</div>
                <div>
                    <el-scrollbar class="m-right" v-loading="listLoading">
                        <el-checkbox-group v-model="checkedList" @change="handleChange">
                            <el-checkbox v-for="(item,index) of storeList" :label="item.id" :key="index">
                                {{item.name}}
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-scrollbar>
                    <div style="padding: 5px 29px">
                        <el-checkbox :indeterminate="isIndeterminate" v-model="checkAll" @change="handleAllChange">
                            全选
                        </el-checkbox>
                    </div>
                </div>
            </div>
            <div style="margin-top: 24px;text-align: center">
                <el-button @click="onSubmit" size="small" type="primary">确定</el-button>
                <el-button @click="onClose" size="small">取消</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    Vue.component('m-store', {
        template: '#m-store',
        props: {
            value: Boolean,
            typeData: {
                type: Array,
                default() {
                    return []
                }
            }
        },
        data() {
            return {
                storeVisible: false,
                listLoading: false,
                isIndeterminate: false,
                checkAll: false,
                checkedList: this.typeData,
                storeList: [],
                search: {},
                pagination: null,
            };
        },
        created() {
            this.getList();
        },
        watch: {
            value: {
                deep: true,
                handler(newVal) {
                    this.storeVisible = newVal;
                },
            },
        },
        methods: {
            handleChange(value) {
                let checkedCount = value.length;
                this.checkAll = checkedCount === this.storeList.length;
                this.isIndeterminate = checkedCount > 0 && checkedCount < this.storeList.length;
            },
            handleAllChange(val) {
                let all = [];
                val && this.storeList.forEach(item => all.push(item.id));
                this.checkedList = all;
                this.isIndeterminate = false;
            },
            onSubmit() {
                const active = this.storeList.filter(item => this.checkedList.indexOf(item.id) !== -1)
                this.$emit('change', active);
                this.onClose();
            },
            onClose() {
                this.$emit('input', false)
            },
            getList() {
                this.listLoading = true;
                request({
                    params: Object.assign({}, {
                        r: 'mall/store/index',
                        page_size: 999,
                        status: 1,
                    }, this.search),
                }).then(e => {
                    this.listLoading = false;
                    if (e.data.code === 0) {
                        this.storeList = e.data.data.list;
                        let checkedCount = this.checkedList.length;
                        this.checkAll = checkedCount === this.storeList.length;
                        this.isIndeterminate = checkedCount > 0 && checkedCount < this.storeList.length;
                        this.pagination = e.data.data.pagination;
                    } else {
                        this.$message.error(e.data.msg);
                    }
                });
            },
        },
    });
</script>
