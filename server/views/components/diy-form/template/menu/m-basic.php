<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .m-basic .m-right {
        margin: 0 10px;
    }

    .m-basic .m-right .el-scrollbar__wrap {
        overflow-x: hidden;
        padding: 0 15px;
    }

    .m-basic .el-dialog {
        min-width: 854px;
    }

    .m-basic .m-right {
        width: 248px;
        height: 224px;
        border: 1px solid #E5E7EC;
        border-radius: 3px;
    }

    .m-basic .m-right .el-input__inner {
        border-left: none;
        border-top: none;
        border-right: 0;
        padding: 0;
        height: 22px;
        line-height: 22px;
        border-radius: 0;
        border-right: none;
    }


    .m-basic .m-add {
        height: 22px;
        width: 53px;
        margin-left: 19px;
        margin-top: 10px;
        border-color: #409EFF;
        border-width: 1px;
        border-style: solid;
        border-radius: 3px;
        color: #409EFF;
        cursor: pointer;
    }


    .m-basic .m-right .m-box {
        height: 28px;
        margin-top: 8px;
    }

    .m-basic .m-right .m-left {
        height: 100%;
        width: 122px;
        background: #FFFFFF;
        border-radius: 3px;
        padding-left: 6px;
    }

    .m-basic .m-right .m-left.active {
        background: #0ab6fe;
        color: #FFFFFF;
    }
</style>
<template id="m-basic">
    <div class="m-basic">
        <el-dialog title="编辑" :visible.sync="basicVisible" top="5vh" width="854px" @close="onClose">
            <div flex="dir:left cross:center main:center">
                <div flex="dir:top">
                    <div flex="dir:top">
                        <div style="margin-left: 26px;margin-bottom:8px">
                            一级
                        </div>
                        <el-scrollbar class="m-right" flex="dir:top">
                            <div flex="dir:left cross:center" class="m-box" v-for="(basic,index) in basicList">
                                <div class="box-grow-0 m-left"
                                     :class="{active: first_active_index === index && edit_status !== basic.ignore}"
                                     flex="cross:center"
                                     @click="handleActivity(index, 'first_active_index')">
                                    <el-input v-if="edit_status === basic.ignore" class="m-input" size="small"
                                              @keyup.enter.native="edit_status = false"
                                              :autofocus="edit_status === basic.ignore"
                                              focus="edit_status === basic.ignore"
                                              maxlength="10"
                                              v-model="basic.label"></el-input>
                                    <div v-else style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                        {{basic.label}}
                                    </div>
                                </div>

                                <div class="box-grow-0" flex="dir:left cross:center" style="margin-left: auto">
                                    <el-button v-if="edit_status === basic.ignore" size="mini" type="primary"
                                               @click="validateHide(basic.label)"
                                    >确定
                                    </el-button>
                                    <template v-else>
                                        <div style="height: 18px;width: 18px;cursor: pointer;margin-right: 7px"
                                             @click="edit_status = basic.ignore">
                                            <app-image height="100%" width="100%"
                                                       src="statics/img/mall/form/menu-basic-edit.png"
                                            ></app-image>
                                        </div>
                                        <div style="height: 18px;width: 18px;cursor: pointer;margin-left: 7px"
                                             @click="handlerDel(index,'first')">
                                            <app-image height="100%" width="100%"
                                                       src="statics/img/mall/form/menu-basic-del.png"
                                            ></app-image>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </el-scrollbar>
                    </div>
                    <div flex="dir:left cross:center main:center" class="m-add" @click="handlerAdd('first')">
                        + 添加
                    </div>
                </div>
                <div flex="dir:top" v-if="first_active_index !== -1">
                    <div flex="dir:top">
                        <div style="margin-left: 26px;margin-bottom:8px">
                            二级
                        </div>
                        <el-scrollbar class="m-right" flex="dir:top">
                            <div flex="dir:left cross:center" class="m-box" v-for="(basic,index) in secondList">
                                <div class="box-grow-0 m-left"
                                     :class="{active: second_active_index === index && edit_status !== basic.ignore}"
                                     flex="cross:center"
                                     @click="handleActivity(index, 'second_active_index')">
                                    <el-input v-if="edit_status === basic.ignore" class="m-input" size="small"
                                              @keyup.enter.native="edit_status = false"
                                              :autofocus="edit_status === basic.ignore"
                                              maxlength="10"
                                              v-model="basic.label"></el-input>
                                    <div v-else style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                        {{basic.label}}
                                    </div>
                                </div>

                                <div class="box-grow-0" flex="dir:left cross:center" style="margin-left: auto">
                                    <el-button v-if="edit_status === basic.ignore" size="mini" type="primary"
                                               @click="validateHide(basic.label)"
                                    >确定
                                    </el-button>
                                    <template v-else>
                                        <div style="height: 18px;width: 18px;cursor: pointer;margin-right: 7px"
                                             @click="edit_status = basic.ignore">
                                            <app-image height="100%" width="100%"
                                                       src="statics/img/mall/form/menu-basic-edit.png"
                                            ></app-image>
                                        </div>
                                        <div style="height: 18px;width: 18px;cursor: pointer;margin-left: 7px"
                                             @click="handlerDel(index,'second')">
                                            <app-image height="100%" width="100%"
                                                       src="statics/img/mall/form/menu-basic-del.png"
                                            ></app-image>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </el-scrollbar>
                    </div>
                    <div flex="dir:left cross:center main:center" class="m-add" @click="handlerAdd('second')">
                        + 添加
                    </div>
                </div>
                <div flex="dir:top" v-if="second_active_index !== -1">
                    <div flex="dir:top">
                        <div style="margin-left: 26px;margin-bottom:8px">
                            三级
                        </div>
                        <el-scrollbar class="m-right" flex="dir:top">
                            <div flex="dir:left cross:center" class="m-box" v-for="(basic,index) in threeList">
                                <div class="box-grow-0 m-left"
                                     :class="{active: three_active_index === index && edit_status !== basic.ignore}"
                                     flex="cross:center"
                                     @click="handleActivity(index, 'three_active_index')">
                                    <el-input v-if="edit_status === basic.ignore" class="m-input" size="small"
                                              @keyup.enter.native="edit_status = false"
                                              :autofocus="edit_status === basic.ignore"
                                              maxlength="10"
                                              v-model="basic.label"></el-input>
                                    <div v-else style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                        {{basic.label}}
                                    </div>
                                </div>

                                <div class="box-grow-0" flex="dir:left cross:center" style="margin-left: auto">
                                    <el-button v-if="edit_status === basic.ignore" size="mini" type="primary"
                                               @click="validateHide(basic.label)"
                                    >确定
                                    </el-button>
                                    <template v-else>
                                        <div style="height: 18px;width: 18px;cursor: pointer;margin-right: 7px"
                                             @click="edit_status = basic.ignore">
                                            <app-image height="100%" width="100%"
                                                       src="statics/img/mall/form/menu-basic-edit.png"
                                            ></app-image>
                                        </div>
                                        <div style="height: 18px;width: 18px;cursor: pointer;margin-left: 7px"
                                             @click="handlerDel(index,'three')">
                                            <app-image height="100%" width="100%"
                                                       src="statics/img/mall/form/menu-basic-del.png"
                                            ></app-image>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </el-scrollbar>
                    </div>
                    <div flex="dir:left cross:center main:center" class="m-add" @click="handlerAdd('three')">
                        + 添加
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
    Vue.component('m-basic', {
        template: '#m-basic',
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
                basicVisible: false,
                edit_status: null,
                basicList: [{
                    label: '',
                    child: [],
                    ignore: Symbol()
                }],
                first_active_index: -1,
                second_active_index: -1,
                three_active_index: -1,
            };
        },

        created() {
            this.flushBasicList();
        },
        watch: {
            typeData: {
                deep: true,
                handler(newVal) {
                    //this.flushBasicList();
                }
            },
            value: {
                deep: true,
                handler(newVal) {
                    this.basicVisible = newVal;
                },
            },
        },

        computed: {
            secondList() {
                if (this.first_active_index === -1) {
                    return [];
                }
                return this.basicList[this.first_active_index].child;
            },
            threeList() {
                if (this.second_active_index === -1) {
                    return [];
                }
                return this.basicList[this.first_active_index].child[this.second_active_index].child;
            }
        },
        methods: {
            validateHide(content) {
                if (content) {
                    this.edit_status = false;
                    return;
                }
                this.$message.error('内容不能为空');
            },
            flushBasicList() {
                this.first_active_index = -1;
                this.second_active_index = -1;
                this.second_active_index = -1;
                this.basicList = -1;
                this.basicList = [];
                let basicList = [].concat(this.typeData);
                if (basicList && basicList) {
                    this.basicList = basicList.map(item1 => {
                        Object.assign(item1, {ignore: Symbol()});
                        if (!item1.child || !item1.child.length) {
                            return item1;
                        }
                        item1.child = item1.child.map(item2 => {
                            Object.assign(item2, {ignore: Symbol()});
                            if (!item2.child || !item2.child.length) {
                                return item2;
                            }

                            item2.child = item2.child.map(item3 => {
                                Object.assign(item3, {ignore: Symbol()});
                                return item3;
                            })
                            return item2;
                        })
                        return item1;
                    });
                }
            },
            onSubmit() {
                try {
                    let sentinel = 1;
                    let value = this.basicList.map(item => {
                        if (!item.label) throw new Error('请输入一级选项内容')
                        sentinel++;
                        item.key = new Date().getTime() + sentinel;
                        if (!item.child || !item.child.length) {
                            return item;
                        }
                        item.child = item.child.map(item1 => {
                            if (!item1.label) throw new Error('请输入二级选项内容')
                            sentinel++;
                            item1.key = new Date().getTime() + sentinel;
                            if (!item1.child || !item1.child.length) {
                                return item1;
                            }
                            item1.child = item1.child.map(item2 => {
                                if (!item2.label) throw new Error('请输入三级选项内容')
                                sentinel++;
                                item2.key = new Date().getTime() + sentinel;
                                return item2;
                            })
                            return item1;
                        })
                        return item;
                    })
                    this.$emit('change', value);
                    this.onClose();
                } catch (error) {
                    this.$message.error(error.message);
                }
            },

            handleActivity(index, type) {
                if (this[type] !== index) {
                    if (type === 'first_active_index') {
                        this.second_active_index = -1;
                        this.three_active_index = -1;
                    } else if (type === 'second_active_index') {
                        this.three_active_index = -1;
                    }
                    this[type] = index;
                }
            },
            handlerDel(index, type) {
                if (type === 'first') {
                    if (this.first_active_index === index) {
                        this.three_active_index = -1;
                        this.second_active_index = -1;
                        this.first_active_index = -1;
                    } else if (this.first_active_index > index) {
                        this.first_active_index = this.first_active_index - 1;
                    }
                    this.basicList.splice(index, 1);

                } else if (type === 'second') {
                    if (this.second_active_index === index) {
                        this.three_active_index = -1;
                        this.second_active_index = -1;
                    } else if (this.second_active_index > index) {
                        this.second_active_index = this.second_active_index - 1;
                    }
                    this.secondList.splice(index, 1);

                } else if (type === 'three') {
                    if (this.three_active_index === index) {
                        this.three_active_index = -1;
                    } else if (this.three_active_index > index) {
                        this.three_active_index = this.three_active_index - 1;
                    }
                    this.threeList.splice(index, 1);

                }
            },
            handlerAdd(type) {
                let value = {
                    label: '',
                    child: [],
                    ignore: Symbol(),
                }
                if (type === 'first') {
                    for (let i = 0; i < this.basicList.length; i++) {
                        if (!this.basicList[i].label) {
                            this.$message.error('内容不能为空');
                            return;
                        }
                    }
                    this.basicList.push(value);
                } else if (type === 'second') {
                    for (let i = 0; i < this.basicList[this.first_active_index].child.length; i++) {
                        if (!this.basicList[this.first_active_index].child[i].label) {
                            this.$message.error('内容不能为空');
                            return;
                        }
                    }
                    this.basicList[this.first_active_index].child.push(value);
                } else if (type === 'three') {
                    for (let i = 0; i < this.basicList[this.first_active_index].child[this.second_active_index].child.length; i++) {
                        if (!this.basicList[this.first_active_index].child[this.second_active_index].child[i].label) {
                            this.$message.error('内容不能为空');
                            return;
                        }
                    }
                    this.basicList[this.first_active_index].child[this.second_active_index].child.push(value);
                }
                this.edit_status = value.ignore;
            },
            onClose() {
                this.$emit('input', false);
            },
        },
    });
</script>
