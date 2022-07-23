<?php
Yii::$app->loadViewComponent('diy-form/form-goods/app-date-picker');
?>
<style>
    .model-calc .input-item {
        display: inline-block;
        width: 250px;
    }

    .model-calc .el-dialog {
        min-width: 674px;
        min-height: 569px;
    }

    .model-calc .calc-item {
        width: 634px;
        height: 60px;
        color: #606266;
        background: #F5F7FA;
        border-radius: 3px;
        margin-bottom: 10px;
    }

    .model-calc .calc-add {
        cursor: pointer
    }

    .model-calc .calc-add img {
        width: 32px;
        height: 32px;
    }

    .model-calc .calc-add div {
        font-size: 15px;
        color: #409EFF;
        margin-left: 16px;
    }

    .model-calc .calc-edit {
        padding: 0 20px;
    }

    .model-calc .calc-edit img {
        width: 32px;
        height: 32px;
        cursor: pointer;
        margin-left: 10px;
    }

    .model-calc .c-edit-item {
        font-size: 14px;
        color: #606266;
        padding-bottom: 20px;
    }

    .model-calc .c-edit-item img {
        width: 32px;
        height: 32px;
        cursor: pointer;
        margin-left: 10px;
    }

    .model-calc .el-dialog__body {
        min-height: 450px;
    }

    .model-calc .el-range-separator {
        width: 10%;
    }

    .el-cascader-panel {
        max-height: 300px;
        min-height: 40px;
    }

    .el-cascader-panel .el-scrollbar.el-cascader-menu {
        width: 240px;
    }

    .el-cascader-panel .el-cascader-menu__wrap.el-scrollbar__wrap {
        overflow-x: hidden;
    }
</style>
<template id="model-calc">
    <div class="model-calc">
        <el-dialog :title="pageData.title" :visible="show" width="30%" top="10vh" @close="closeModel"
                   class="diy-form-dialog"
                   :close-on-click-modal="false">
            <template v-if="show_status === 'list'">
                <template v-if="tempLoginData && tempLoginData.length">
                    <div style="font-size: 14px;color: #606266;margin-bottom: 20px">共{{tempLoginData.length}}条逻辑</div>
                    <div v-for="(item,index) of tempLoginData" class="calc-item calc-edit"
                         flex="dir:left cross:center main:justify">
                        <div>逻辑{{toChinesNum(index + 1)}}</div>
                        <div flex="dir:left cross:center">
                            <image src="statics/img/mall/form/calc-a.png" @click="editLoginData(index,item)"></image>
                            <image src="statics/img/mall/form/calc-b.png"
                                   @click="tempLoginData.splice(index,1)"
                            ></image>
                        </div>
                    </div>
                </template>
                <div class="calc-item" flex="cross:center main:center">
                    <div class="calc-add" @click="addLoginData" flex="dir:left cross:center main:center">
                        <image src="statics/img/mall/form/calc-c.png"></image>
                        <div>新增逻辑</div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div style="font-size: 15px;color: #303133;margin-bottom: 20px">符合以下全部条件时，显示设置生效</div>
                <div class="calc-item" style="height:auto;margin-bottom: 50px">
                    <div style="height: 70px;" flex="dir:left cross:center">
                        <div style="width: 240px;margin-left:44px">组件标题名称</div>
                        <div style="width: 240px;margin-left: 48px">选项内容</div>
                        <image @click="addLoginDataRuleBegin" style="margin-left: 10px;cursor:pointer"
                               src="statics/img/mall/form/calc-c.png"></image>
                    </div>
                    <div :key="index" v-for="(item,index) of rule_begin" flex="dir:left cross:center"
                         class="c-edit-item">
                        <div style="width: 44px;padding-left:20px">在</div>
                        <div>
                            <el-select size="small" @change="item.v = []" v-model="item.k" placeholder="请选择"
                                       style="width: 240px">
                                <el-option
                                        v-for="(item2,index2) in beginData"
                                        :key="item2.key"
                                        :label="item2.label"
                                        :value="item2.key"
                                ></el-option>
                            </el-select>
                        </div>
                        <div style="width: 48px;text-align:center">选中</div>
                        <div>
                            <template v-if="timeDateIf(item) === 'time_alone' || timeDateIf(item) === 'time_no_alone'">
                                <el-select v-model="item.v" placeholder="请选择" size="small" style="width: 240px">
                                    <el-option
                                            size="small"
                                            v-for="item in selectBefore(item.k).children"
                                            :key="item.label"
                                            :label="item.label"
                                            :value="item.label">
                                    </el-option>
                                </el-select>
                            </template>
                            <app-date-picker
                                    v-else-if="timeDateIf(item) === 'date'"
                                    style="width: 240px"
                                    v-bind="formatV(item)"
                                    size="small"
                                    v-model="(item.v instanceof Array) && formatV(item).type === 'date' ? item.v = '' && item.v : item.v"
                                    range-separator="至"
                                    start-placeholder="开始日期"
                                    end-placeholder="结束日期">
                            </app-date-picker>
                            <el-cascader
                                    v-else
                                    placeholder="请选择"
                                    size="small"
                                    v-model="item.v"
                                    style="width: 240px;max-height: 300px"
                                    :options="selectBefore(item.k).children"
                                    :props="{ expandTrigger: 'hover',value: 'key' }"
                            ></el-cascader>
                        </div>
                        <image @click="rule_begin.splice(index,1)" src="statics/img/mall/form/calc-b.png"></image>
                    </div>
                </div>

                <div style="font-size: 15px;color: #303133;margin-bottom: 20px">显示设置</div>
                <div class="calc-item" style="height:auto;margin-bottom: 50px">
                    <div style="height: 70px;" flex="dir:left cross:center">
                        <div style="width: 240px;margin-left:44px">组件标题名称</div>
                        <div style="width: 240px;margin-left: 48px">选项内容</div>
                        <image @click="addLoginDataRuleAfter" style="margin-left: 10px;cursor:pointer"
                               src="statics/img/mall/form/calc-c.png"></image>
                    </div>
                    <div v-for="(item,index) in rule_after" flex="dir:left cross:center" class="c-edit-item">
                        <div style="width: 44px;padding-left:20px">在</div>
                        <div>
                            <el-select @change="item.v = ''" size="small" v-model="item.k" placeholder="请选择"
                                       style="width: 240px">
                                <el-option
                                        v-for="(item2,index2) in afterData"
                                        :key="item2.key"
                                        :label="item2.label"
                                        :value="item2.key"
                                ></el-option>
                            </el-select>
                        </div>
                        <div style="width: 48px;text-align:center">变为</div>
                        <div>
                            <el-select size="small" v-model="item.v" placeholder="请选择" style="width: 240px">
                                <el-option
                                        v-for="(item2, index2) in afterValueArr(item.k)"
                                        :key="index2.key"
                                        :label="item2.label"
                                        :value="item2.key"
                                ></el-option>
                            </el-select>
                        </div>
                        <image @click="rule_after.splice(index,1)" src="statics/img/mall/form/calc-b.png"></image>
                    </div>
                </div>
            </template>
            <div slot="footer" class="dialog-footer">
                <el-button size="small" :loading="btnLoading" @click="closeModel">取消</el-button>
                <el-button size="small" :loading="btnLoading" @click.native="formSubmit" type="primary">提交
                </el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    function uptime(list, time_data = null) {
        let s = new Set(), limit = list.limit_time;

        function all_time(item_time) {
            let start_1 = Number(item_time[0].split(':')[0]);
            let start_2 = Number(item_time[0].split(':')[1]);

            let end_1 = Number(item_time[1].split(':')[0]);
            let end_2 = Number(item_time[1].split(':')[1]);
            do {
                if (start_2 >= 60) {
                    start_2 -= 60;
                    start_1++;
                }
                let hour = start_1 < 10 ? '0' + start_1 : start_1,
                    min = start_2 < 10 ? '0' + start_2 : start_2;
                if (end_2 >= start_2 || end_1 > start_1) {
                    s.add(hour + ':' + min);
                }
                start_2 += limit;
            } while (end_2 >= start_2 || end_1 > start_1)

            let hour = end_1 < 10 ? '0' + end_1 : end_1,
                min = end_2 < 10 ? '0' + end_2 : end_2
            s.add(hour + ':' + min);
        }

        if (time_data === null) {
            list.start_list.forEach(_ => {
                all_time(_.time)
            });
        } else {
            all_time(time_data)
        }

        let time = Array.from(s);
        time.sort((a, b) => {
            let a_1 = Number(a.split(':')[0]);
            let a_2 = Number(a.split(':')[1]);

            let b_1 = Number(b.split(':')[0]);
            let b_2 = Number(b.split(':')[1]);
            if (a_1 === b_1) {
                return b_2 < a_2 ? 1 : -1;
            } else {
                return b_1 < a_1 ? 1 : -1
            }
        })
        time = time.map(_ => {
            return {label: _};
        });
        return time;
    }

    Vue.component('model-calc', {
        template: '#model-calc',
        props: {
            show: Boolean,
            editId: [Number, String],
            logicData: Array,
            formData: Array,
            type: String,
        },
        computed: {
            pageData() {
                if (this.show_status === 'list') {
                    return {
                        title: '逻辑设置'
                    }
                }
                if (this.show_status === 'edit') {
                    return {
                        title: '修改'
                    }
                }
                if (this.show_status === 'add') {
                    return {
                        title: '新增'
                    }
                }
            },

            /////////////////////
            beginData() {
                let formData = JSON.parse(JSON.stringify(this.formData.filter(item => ['radio', 'select', 'menu'].indexOf(item.id) !== -1)));

                return formData.map(item => {
                    let {key, list, title, type} = item.data;
                    let f = {key, label: title || '< 名称未填写 >', type: item.id};
                    Object.assign(f, {children_type: type});
                    if (item.id === 'menu') {
                        let {type, type_data, ignore} = item.data;
                        let data = type_data[type];


                        if (type === 'basic') {
                            function xh(data) {
                                return data.map(item2 => {
                                    let children = undefined;
                                    if (item2.child && item2.child.length) {
                                        children = xh(item2.child);
                                    }
                                    return Object.assign({
                                            key: item2.label,
                                            label: item2.label,
                                        },
                                        children ? {children} : {}
                                    )
                                })
                            }

                            Object.assign(f, {children: xh(data)})
                        } else if (type === 'address') {
                            function xh(data) {
                                return data.map(item2 => {
                                    let children = undefined;
                                    if (item2.list && item2.list.length) {
                                        children = xh(item2.list);
                                    }
                                    return Object.assign({
                                            key: item2.name,
                                            label: item2.name,
                                        },
                                        children ? {children} : {}
                                    )
                                })
                            }

                            Object.assign(f, {children: xh(data)})
                        } else if (type === 'date') {
                            Object.assign(f, {list: item})
                        } else if (type === 'time') {
                            let all = [];
                            const type_data = item.data.type_data.time;
                            if (type_data.show_type === 'alone') {
                                all = uptime(type_data);
                                Object.assign(f, {children_type: 'time_alone'});
                            } else {
                                Object.assign(f, {children_type: 'time_no_alone'});

                                for (let i of type_data.start_list) {
                                    let arr = uptime(type_data, i.time);
                                    while (arr.length > 1) {
                                        let i = arr.shift();
                                        all.push({label: i.label + ' - ' + arr[0].label})
                                    }
                                }


                                // type_data.start_list.forEach(item => {
                                //     let a = uptime(type_data, item.time);
                                //     let arr = [];
                                //     for (let index = 1; index < a.length; index++) {
                                //         if (index + 1 === a.length) {
                                //             continue;
                                //         }
                                //         arr.push({label: a[index].label, child: a.slice(index + 1)})
                                //     }
                                //     all = all.concat(arr);
                                // });
                            }

                            Object.assign(f, {list: item, children: all})
                        } else if (type === 'store') {
                            let children = [];
                            for (let i = 0; i < this.storeData.length; i++) {
                                for (let j = 0; j < data.length; j++) {
                                    if (data[j].id == this.storeData[i].id) {
                                        children.push({
                                            key: this.storeData[i].id,
                                            label: this.storeData[i].name,
                                        })
                                    }
                                }
                            }
                            Object.assign(f, {children})
                        }
                    } else {
                        Object.assign(f, {
                            children: list.map(item2 => {
                                let {key, label} = item2;
                                return {key: label, label}
                            }),
                        })
                    }
                    return f;
                });
            },
            afterData() {
                let formData = JSON.parse(JSON.stringify(this.formData.filter(item => ['form-goods-button', 'rubik', 'link', 'empty', 'app-rich-text', 'image-text'].indexOf(item.id) === -1)));
                formData = formData.map(item => {
                    let {list, title, key} = item.data;
                    let children = [
                        {
                            key: -2,
                            label: '隐藏'
                        },
                        {
                            key: -1,
                            label: '显示',
                        }
                    ]
                    if (['radio', 'select'].indexOf(item.id) !== -1 && 0) {
                        children = children.concat(list.map(item2 => {
                            let {key, label} = item2;
                            return {key: label, label}
                        }));
                    }
                    return Object.assign({label: title || '< 名称未填写 >', type: item.id, key}, {children})
                });
                return formData;
            },
            afterValueArr() {
                return (key) => {
                    for (let even of this.afterData) {
                        if (even.key === key) {
                            return even.children;
                        }
                    }
                    return [];
                }
            },
            timeEnd() {
                return ({k, v}) => {
                    let arr = [];
                    this.selectBefore(k).children.forEach(item => {
                        if (v && v[0] && item.label == v[0]) {
                            arr = item.child;
                        }
                    })
                    return arr;
                }
            },
            selectBefore() {
                return (key) => {
                    for (let even of this.beginData) {
                        if (even.key === key) {
                            return {
                                children: even.children || '',
                                date: even.list ? even.list.data.type_data.date : {},
                            }
                        }
                    }
                    return {
                        children: [],
                        date: {},
                    }
                }
            },
        },

        data() {
            return {
                storeData: [],
                rule_begin: [],
                rule_after: [],
                btnLoading: false,
                show_status: 'list',
                tempLoginData: this.logicData,
            }
        },
        watch: {
            logicData: {
                handler(newVal) {
                    this.tempLoginData = newVal;
                },
                deep: true,
            }
        },
        methods: {
            timeDateIf(column) {
                let {k} = column;
                let e = null
                for (let even of this.beginData) {
                    if (even.key === k) {
                        e = even.children_type;
                    }
                }
                return e || '';
            },
            saveForm() {
                this.btnLoading = true;
                request({
                    params: {
                        r: 'plugin/form_goods/mall/index/update-logic',
                    },
                    data: {
                        id: this.editId,
                        logic_data: JSON.stringify(this.tempLoginData),
                    },
                    method: 'post',
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
            },


            formatV({k}) {
                let {date} = this.selectBefore(k), {is_alone, type, is_now, start_at, end_at} = date;
                let style = {
                    start_at,
                    end_at,
                    is_now,
                    'picker-options': {
                        disabledDate(time) {
                            let startTime = is_now == 1 ? new Date().getTime() : new Date(start_at.replace(/-/g, "/")).getTime();
                            let endTime = new Date(end_at.replace(/-/g, "/")).getTime()
                            return time.getTime() > endTime || time.getTime() + 86400000 < startTime;
                        },
                    },
                    type,
                };
                if (type === 'year') {
                    Object.assign(style, {
                        format: 'yyyy',
                        'value-format': 'yyyy',
                    })
                }
                if (type === 'month') {
                    Object.assign(style, {
                        format: 'yyyy-MM',
                        'value-format': 'yyyy-MM',
                    })
                }
                if (type === 'date') {
                    Object.assign(style, {
                        format: 'yyyy-MM-dd',
                        'value-format': 'yyyy-MM-dd',
                    })
                }
                return style;
            },
            closeModel() {
                if (this.show_status === 'list') {
                    this.$emit('update:show', false);
                } else {
                    this.show_status = 'list';
                }
            },
            ////////////////////////////////////
            formSubmit() {
                function isEmpty(arr) {
                    return arr.length == 0 || arr.some(_ => _.k === '' || _.v === '')
                }

                if (this.show_status === 'list') {
                    if (this.type === 'goods') {
                        this.$emit('submit', this.tempLoginData);
                    } else {
                        this.saveForm();
                    }
                    this.closeModel();
                }
                if (this.show_status === 'edit') {
                    if (isEmpty(this.rule_after) || isEmpty(this.rule_begin)) {
                        this.$message.error('配置不能为空');
                        return;
                    }
                    this.tempLoginData.splice(this.editIndex, 1, {
                        rule_begin: this.rule_begin,
                        rule_after: this.rule_after,
                    });
                    this.closeModel();
                }
                if (this.show_status === 'add') {
                    if (isEmpty(this.rule_after) || isEmpty(this.rule_begin)) {
                        this.$message.error('配置不能为空');
                        return;
                    }
                    console.log(this.tempLoginData);
                    this.tempLoginData.push({
                        rule_begin: this.rule_begin,
                        rule_after: this.rule_after,
                    });
                    this.closeModel();
                }
            },
            addLoginDataRuleAfter() {
                this.rule_after.push({k: '', v: ''})
            },
            addLoginDataRuleBegin() {
                this.rule_begin.push({k: '', v: ''})
            },
            addLoginData() {
                this.rule_begin = [];
                this.rule_after = [];
                this.show_status = 'add';
            },
            editLoginData(index, {rule_begin, rule_after}) {
                this.editIndex = index;
                this.rule_begin = JSON.parse(JSON.stringify(rule_begin));
                this.rule_after = JSON.parse(JSON.stringify(rule_after));
                this.show_status = 'edit';
            },
            ///////////////////////////
            toChinesNum(num) {
                let changeNum = ['零', '一', '二', '三', '四', '五', '六', '七', '八', '九'];
                let unit = ["", "十", "百", "千", "万"];
                num = parseInt(num);
                let getWan = (temp) => {
                    let strArr = temp.toString().split("").reverse();
                    let newNum = "";
                    for (var i = 0; i < strArr.length; i++) {
                        newNum = (i == 0 && strArr[i] == 0 ? "" : (i > 0 && strArr[i] == 0 && strArr[i - 1] == 0 ? "" : changeNum[strArr[i]] + (strArr[i] == 0 ? unit[0] : unit[i]))) + newNum;
                    }
                    if (newNum.length > 1 && newNum[0] == '一') {
                        newNum = newNum.slice(1);
                    }
                    return newNum;
                }
                let overWan = Math.floor(num / 10000);
                let noWan = num % 10000;
                if (noWan.toString().length < 4) {
                    noWan = "0" + noWan
                }
                return overWan ? getWan(overWan) + "万" + getWan(noWan) : getWan(num);
            },
        },
        created() {
            request({
                params: Object.assign({}, {
                    r: 'mall/store/index',
                    page_size: 999,
                    status: 1,
                }),
            }).then(info => {
                this.storeData = info.data.data.list;
            })
        },
    })
</script>