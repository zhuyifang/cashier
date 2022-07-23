<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .calc-common {

    }

    .calc-common .el-dialog {
        min-width: 760px;
    }

    .calc-common .c-head {
        padding: 0 9px;
        font-size: 14px;
        color: #606266;
        height: 40px;
        background: #f3f3f3;
        border-radius: 3px 3px 0 0;
    }

    .calc-common .c-head img {
        height: 24px;
        width: 24px;
        background-color: #dfdfdf;
        border-radius: 3px;
        margin-right: 10px;
        cursor: pointer;
    }

    .calc-common .c-box {

    }

    .calc-common .c-total {
        height: 26px;
        line-height: 26px;
        color: white;
        padding: 0 16px;
        background: #409EFF;
        border-radius: 3px;
        margin-left: 2px;
        margin-right: 2px;
        margin-bottom: 10px;
    }

    .calc-common .c-box-fh {
        height: 24px;
        width: 24px;
        cursor: text;
        margin: 1px 2px 11px;
    }

    .calc-common .c-box-fh.c-br {
        /*width: 12px;*/
    }

    .calc-common .c-box-fh.c-br.right {
        transform: rotate(180deg);
    }

    .calc-common .c-tree .el-tree-node__content {
        height: 35px;
    }

    .calc-common .c-tree > .el-tree > .el-tree-node > .el-tree-node__content > .el-tree-node__expand-icon {
        background: url(statics/img/mall/form-goods/right.png) center no-repeat;
        background-size: 100% 100%;
        height: 20px;
        width: 20px;
        padding: 0;
        margin: 0 10px;
    }

    .calc-common .c-tree > .el-tree > .el-tree-node > .el-tree-node__content > .el-tree-node__expand-icon:before {
        content: "替";
        font-size: 16px;
        visibility: hidden;
    }

    .calc-common .el-scrollbar__wrap {
        overflow-x: hidden
    }

    .fadenum {
        cursor: text;
        position: relative;
        width: 1px;
        height: 24px;
        margin-left: 2px;

        -webkit-animation: fadenum 1s infinite;
        -moz-animation: fadenum 1s infinite;
        animation: fadenum 1s infinite;
    }

    @-webkit-keyframes fadenum { /*设置内容由显示变为隐藏*/
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
</style>
<template id="calc-common">
    <div class="calc-common">
        <div @click="openModel">
            <slot name="default"></slot>
        </div>
        <el-dialog title="公式编辑" :visible="show" top="10vh" @close="closeModel" class="diy-form-dialog" width="760px"
                   :close-on-click-modal="false">
            <div style="color:#909399;font-size: 14px;margin-bottom: 10px">
                <div>支持使用运算符四则运算、括号，支持使用常量0.01-9999999999</div>
                <div>根据组件的默认变量值通过设定的公式计算出结果显示</div>
            </div>
            <div flex="dir:left main:center" style="height: 397px;">
                <el-scrollbar style="width: 293px;border: 1px solid #DCDFE6;border-radius: 3px;" flex="dir:top">
                    <div class="c-head" flex="cross:center">可用变量</div>
                    <div class="c-tree">
                        <el-tree :data="comTreeData" @node-click="handleNodeClick"></el-tree>
                    </div>
                </el-scrollbar>
                <div style="width: 10px"></div>
                <div style="width: 415px;border: 1px solid #DCDFE6;border-radius: 3px;" flex="dir:top">
                    <div class="c-head" style="height:auto;padding:10px">
                        <div flex="cross:center">
                            <image @click="handleAddFH('add')" src="statics/img/mall/form-goods/add.png"></image>
                            <image @click="handleAddFH('sub')" src="statics/img/mall/form-goods/sub.png"></image>
                            <image @click="handleAddFH('multiply')"
                                   src="statics/img/mall/form-goods/multiply.png"></image>
                            <image @click="handleAddFH('except')" src="statics/img/mall/form-goods/except.png"></image>
                            <image @click="handleAddFH('bracket-left')"
                                   src="statics/img/mall/form-goods/bracket-left.png"></image>
                            <image @click="handleAddFH('bracket-right')" style="transform:rotate(180deg);"
                                   src="statics/img/mall/form-goods/bracket-left.png"></image>
                        </div>
                        <div flex="dir:left cross:center" style="margin:10px 10px 0">
                            <div style="flex-grow: 0;flex-shrink: 0" flex="dir:left cross:center">常量</div>
                            <div style="flex-grow: 1;flex-shrink: 1;margin:0 10px">
                                <el-input v-model="const_temp" size="small"
                                          oninput="this.value = this.value.match(/^\d{0,9}(\.)?\d{0,2}/g)"
                                          placeholder="输入数字0.01-9999999999"></el-input>
                            </div>
                            <div style="flex-grow: 0;flex-shrink: 0">
                                <el-button size="small" type="primary" @click="handleConst">确定</el-button>
                            </div>
                        </div>
                    </div>
                    <el-scrollbar style="height: 100%;position: relative">
                        <div flex="dir:left" style="padding: 20px;flex-wrap:wrap;position:relative;cursor:" ref="test">
                            <div class="c-total">{{$attrs.title}}</div>
                            <image class="c-box-fh" src="statics/img/mall/form-goods/amount.png"></image>
                            <template v-for="(i,index) in formData">
                                <div class="fadenum"
                                     @click="setSelect(index)"
                                     :style="{background: select_index == index && open_select ? '#707070': 'rgba(0,0,0,0)'}"></div>
                                <image v-if="i.ignore === 'add'" class="c-box-fh"
                                       @click="setSelect(index)"
                                       src="statics/img/mall/form-goods/add.png"></image>
                                <image v-else-if="i.ignore === 'sub'" class="c-box-fh"
                                       @click="setSelect(index)"
                                       src="statics/img/mall/form-goods/sub.png"></image>
                                <image v-else-if="i.ignore === 'multiply'" class="c-box-fh"
                                       @click="setSelect(index)"
                                       src="statics/img/mall/form-goods/multiply.png"></image>
                                <image v-else-if="i.ignore === 'except'" class="c-box-fh"
                                       @click="setSelect(index)"
                                       src="statics/img/mall/form-goods/except.png"></image>
                                <image v-else-if="i.ignore === 'bracket-left'" class="c-box-fh c-br"
                                       @click="setSelect(index)"
                                       src="statics/img/mall/form-goods/bracket-left.png"></image>
                                <image v-else-if="i.ignore === 'bracket-right'" class="c-box-fh c-br right"
                                       @click="setSelect(index)"
                                       src="statics/img/mall/form-goods/bracket-left.png"></image>
                                <div v-else-if="i.type === 'const'" class="c-total"
                                     style="cursor:text;background:white;padding:0;color:inherit "
                                     @click="setSelect(index)">
                                    {{i.label}}
                                </div>
                                <div v-else @click="setSelect(index)" class="c-total" style="cursor:text">
                                    {{i.label}}
                                </div>
                                <div class="fadenum"
                                     @click="setSelect(formData.length)"
                                     :style="{background: select_index == formData.length && select_index == index + 1 && open_select ? '#707070': 'rgba(0,0,0,0)'}"></div>
                            </template>
                        </div>
                        <div style="position:absolute;right:10px;bottom: 10px;cursor: pointer" @click="clearData">
                            <img style="display:block" src="statics/img/mall/form/calc-b.png" alt="">
                        </div>
                    </el-scrollbar>
                </div>
            </div>
            <div slot="footer" class="dialog-footer">
                <el-button size="small" @click="closeModel">取消</el-button>
                <el-button size="small" @click="calcSubmit" type="primary">提交</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    Vue.component('calc-common', {
        template: '#calc-common',
        props: {
            allData: {
                type: Array,
                default() {
                    return [];
                }
            },
            show: Boolean,
            value: Array,
            type: String,
        },
        data() {
            return {
                open_select: false,
                select_index: -1,
                const_temp: '',
                formData: this.value,
            };
        },
        computed: {
            comTreeData() {
                let l = [{
                    value: 'radio',
                    label: '单选框',
                }, {
                    value: 'select',
                    label: '复选框',
                }, {
                    value: 'number-in',
                    label: '纯数字输入',
                }, Object.assign(
                    this.type === 'form-goods-button' ?
                        {
                            value: 'calc',
                            label: '公式计算',
                        } : {}
                ), {
                    value: 'form-goods-const',
                    label: '默认变量',
                }];
                let arr = [];
                l.forEach(item => {
                    let children = [];
                    this.allData.forEach(item2 => {
                        if (item2.id == item.value) {
                            children.push({
                                id: item2.id,
                                select: true,
                                key: item2.data.key,
                                label: item2.data.title,
                                value: item2.id,
                            })
                        }
                    })
                    if (item.value === 'form-goods-const') {
                        children = [{
                            id: 'form-goods-const',
                            select: true,
                            key: 'goods-price',
                            label: '商品总计',
                            value: '',
                        }, {
                            id: 'form-goods-const',
                            select: true,
                            key: 'alone-price',
                            label: '商品单价',
                            value: '',
                        }, {
                            id: 'form-goods-const',
                            select: true,
                            key: 'alone-num',
                            label: '商品数量',
                            value: '',
                        }]
                    }
                    children.length == 0 || arr.push(Object.assign(item, {children, select: false}));
                })
                return arr;
            },
            selectId() {
                if (!this.open_select) {
                    this.select_index = this.formData.length;
                }
                return this.select_index;
            }
        },
        created: function () {
            this.keyDown();
        },
        methods: {
            keyDown() {
                const self = this;

                function showChar(event) {
                    if (!self.open_select) {
                        return;
                    }
                    let {keyCode} = event;
                    switch (keyCode) {
                        case 8:
                            if (self.selectId - 1 >= 0) {
                                self.formData.splice(self.selectId - 1, 1);
                                self.select_index--;
                            }
                            break;
                        case 37:
                            self.select_index--;
                            break;
                        case 39:
                            self.select_index++;
                            break;
                        default:
                            break;
                    }
                }

                document.body.addEventListener('keydown', showChar, false);
            },
            calcPrice() {
                const formData = this.formData;
                let str = '';
                for (let i of formData) {
                    let {type, ignore, label, id} = i, value = '';
                    if (type === 'operation') {
                        value = ignore === 'add' ? ' + ' : value;
                        value = ignore === 'sub' ? ' - ' : value;
                        value = ignore === 'multiply' ? ' * ' : value;
                        value = ignore === 'except' ? ' / ' : value;
                        value = ignore === 'bracket-left' ? ' ( ' : value;
                        value = ignore === 'bracket-right' ? ' ) ' : value;
                    }
                    if (type === 'const') {
                        value = label;
                    }
                    if (type === 'variable') {
                        value = Math.floor(Math.random() * 10);
                    }

                    if (value === '') {
                        console.log(i, '参数空');
                    } else {
                        str += value;
                    }

                }
                try {
                    return new Function('return ' + str)();
                } catch (e) {
                    return Infinity
                }
            },

            calcSubmit() {
                if (this.calcPrice() === Infinity) {
                    this.$message.error('格式不合法');
                } else {
                    this.$emit('submit', this.formData);
                    this.closeModel();
                }
            },
            handleNodeClick({select, key, label, id}) {
                if (select) {
                    this.formData.splice(this.selectId, 0, {
                        type: 'variable',
                        ignore: key,
                        label: label,
                        id,
                    })
                    this.select_index++;
                }
            },
            handleConst() {
                if (this.const_temp) {
                    this.formData.splice(this.selectId, 0, {
                        type: 'const',
                        ignore: this.const_temp,
                        label: this.const_temp,
                    })
                    this.select_index++;
                }
            },
            handleAddFH(column) {
                this.formData.splice(this.selectId, 0, {
                    type: 'operation',
                    ignore: column,
                    label: '',
                })
                this.select_index++;
            },
            setSelect(index) {
                this.open_select = true;
                this.select_index = index;
            },
            openModel() {
                this.$emit('update:show', true);
            },
            closeModel() {
                this.$emit('update:show', false);
            },
            clearData() {
                this.formData = [];
                this.open_select = false;
            },
        },
    });
</script>
