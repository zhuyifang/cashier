<?php
/**
 * Created by PhpStorm.
 * User: 风哀伤
 * Date: 2019/4/28
 * Time: 17:14
 * @copyright: ©2019 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */
?>
<?php
?>
<style>
    .app-attr .box {
        line-height: 64px;
        border-top: 1px solid #E8EAEE;
        border-left: 1px solid #E8EAEE;
        border-right: 1px solid #E8EAEE;
        padding: 0 16px;
    }

    .app-attr .box .batch {
        margin-left: -10px;
        margin-right: 20px;
    }

    .app-attr .el-select .el-input {
        width: 130px;
    }

    .app-attr .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }

    .app-attr .header-require:before {
        content: '*';
        color: #F56C6C;
        margin-right: 2px;
    }

    .app-attr .header-require.long-header {
        padding-left: 2px;
        overflow: visible;
        line-height: 1;
        white-space: normal;
    }
    ._margin .el-form-item__label {
        width: 106px !important;
    }
    ._margin .el-form-item__content {
        margin-left: 106px !important;
    }
</style>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/unpkg/umy-ui@1.1.6/lib/index.js"></script>
<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/statics/unpkg/umy-ui@1.1.6/lib/theme-chalk/index.css">
<template id="app-attr">
    <div class="app-attr">
        <div v-if="showtype === 'text' && $attrs.goods_type === 'form-goods'" flex="dir:left cross:center"
             style="background: #F9F9F9;border: 1px solid #DCDFE6;border-bottom-width: 0px;height: 44px;padding:0 16px;color:#909399;font-size: 14px;border-radius: 3px 3px 0px 0px;">
            注：该设置为日历中数据默认值
        </div>
        <div class="box">
<!--            <el-checkbox v-model="attrBatch" @change="selectClick" :disabled="!cData || cData.length == 0"-->
<!--                         style="position:absolute">全选-->
<!--            </el-checkbox>-->
            <el-form-item label="批量设置" class="_margin" style="margin-bottom:0;padding:18px 0">
                <el-input @keyup.enter.native="batchAttr(selectData)"
                          :type="selectData == 'no' ? 'text' : 'number'" v-model="batch">
                    <el-select v-model="selectData" slot="prepend">
                        <el-option
                                v-for="(item, index) in showtype === 'basic' ? {price: '价格',stock: '库存'} : cList"
                                :value="index" :key="item" v-if="index!='pic_url'"
                                :label="item">{{item}}
                        </el-option>
                    </el-select>
                    <template slot="append">
                        <el-button @click="batchAttr(selectData)">
                            确定
                        </el-button>
                    </template>
                </el-input>
            </el-form-item>
        </div>
        <div>
            <u-table ref="multipleTable" border stripe style="width: 100%;"
                     use-virtual
                     show-header-overflow
                     show-body-overflow
                     big-data-checkbox
                     row-key="id"
                     :max-height="700"
            >
                <u-table-column type="selection" width="50"></u-table-column>
                <u-table-column
                        v-for="(item, index) in attrGroups"
                        :key="item.id"
                        :prop="'attr_list['+index+'].attr_name'"
                        :label="item.attr_group_name">
                </u-table-column>

                <u-table-column v-if="cList"
                                v-for="(item, key, index) in cList"
                                :key="item.id"
                                :property="key"
                                :label="item + (append ? '(' + append + ')' : '')">
                    <template slot="header" v-if="requiredArray.indexOf(key) !== -1">
                        <div class="header-require" :class="{'long-header' : item.length > 6}">{{item}}</div>
                    </template>
                    <template slot-scope="scope">
                        <template v-if="!isLevel">
                            <div flex="box:first" v-if="scope.column.property == 'pic_url'" style="padding: 10px;">
                                <div flex="cross:center" style="margin-right: 10px;position: relative;">
                                    <app-attachment :multiple="false" :params="scope.row" :max="1"
                                                    v-model="scope.row[scope.column.property]">
                                        <app-gallery :url="scope.row[scope.column.property]"
                                                     width="50px" height="50px"></app-gallery>
                                    </app-attachment>
                                    <el-button v-if="scope.row[scope.column.property]"
                                               style="position: absolute; right: -8px; top: -8px; padding: 4px 4px;"
                                               size="mini" type="danger" icon="el-icon-close" circle
                                               @click="scope.row[scope.column.property] = ''"></el-button>
                                </div>
                            </div>
                            <template v-if="showtype === 'basic'">
                                <div v-if="scope.column.property == 'pic_url'"></div>
                                <el-input v-else-if="scope.column.property == 'stock'"
                                          oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                          v-model="scope.row[scope.column.property]"></el-input>
                                <div v-else-if="scope.column.property == 'no'">
                                    {{calendarOld(scope.row.attr_list).no}}
                                </div>
                                <div v-else-if="scope.column.property == 'bar_code'">
                                    {{calendarOld(scope.row.attr_list).bar_code}}
                                </div>
                                <div v-else-if="scope.column.property =='cost_price'">
                                    {{calendarOld(scope.row.attr_list).cost_price}}
                                </div>
                                <div v-else-if="scope.column.property =='weight'">
                                    {{calendarOld(scope.row.attr_list).weight}}
                                </div>
                                <el-input
                                        v-else-if="scope.column.property == 'price' || scope.column.property == 'level'"
                                        :style="{'width': price_width}"
                                        type="number" v-model="scope.row[scope.column.property]">
                                    <template v-if="append" slot="append">{{append}}</template>
                                </el-input>
                                <el-input v-else oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                          v-model="scope.row[scope.column.property]">
                                    <template v-if="append" slot="append">{{append}}</template>
                                </el-input>
                            </template>
                            <template v-else-if="showtype === 'before'">
                                <div v-if="scope.column.property == 'pic_url'"></div>
                                <el-input v-else-if="scope.column.property == 'no'"
                                          v-model="scope.row[scope.column.property]"></el-input>
                                <el-input v-else-if="scope.column.property == 'stock'"
                                          oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                          v-model="scope.row[scope.column.property]"></el-input>
                                <el-input v-else-if="scope.column.property == 'bar_code'"
                                          oninput="this.value = this.value.replace(/[^\w_]/g,'');"
                                          v-model="scope.row[scope.column.property]"></el-input>
                                <el-input v-else-if="scope.column.property.indexOf('cost_price')"
                                          type="number" v-model="scope.row[scope.column.property]"></el-input>
                                <el-input v-else-if="scope.column.property.indexOf('price') > -1 || scope.column.property.indexOf('level')"
                                          :style="{'width': price_width}"
                                          type="number" v-model="scope.row[scope.column.property]">
                                    <template v-if="append" slot="append">{{append}}</template>
                                </el-input>
                                <el-input v-else oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                          v-model="scope.row[scope.column.property]">
                                    <template v-if="append" slot="append">{{append}}</template>
                                </el-input>
                            </template>
                            <template v-else>
                                <div v-if="scope.column.property == 'pic_url'"></div>
                                <el-input v-else-if="scope.column.property == 'no'"
                                          v-model="attrInfo(scope.row)[scope.column.property]"></el-input>
                                <el-input v-else-if="scope.column.property == 'stock'"
                                          oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                          v-model="attrInfo(scope.row)[scope.column.property]"></el-input>
                                <el-input v-else-if="scope.column.property == 'bar_code'"
                                          oninput="this.value = this.value.replace(/[^\w_]/g,'');"
                                          v-model="attrInfo(scope.row)[scope.column.property]"></el-input>
                                <el-input v-else-if="scope.column.property.indexOf('cost_price')"
                                          type="number"
                                          v-model="attrInfo(scope.row)[scope.column.property]"></el-input>
                                <el-input
                                        v-else-if="scope.column.property.indexOf('price') > -1 || scope.column.property.indexOf('level')"
                                        :style="{'width': price_width}"
                                        type="number" v-model="attrInfo(scope.row)[scope.column.property]">
                                    <template v-if="append" slot="append">{{append}}</template>
                                </el-input>
                                <el-input v-else oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                          v-model="attrInfo(scope.row)[scope.column.property]">
                                    <template v-if="append" slot="append">{{append}}</template>
                                </el-input>
                            </template>
                        </template>
                        <template v-else>
                            <el-input :data-id="scope.row[scope.column.label]" type="number"
                                      v-model="scope.row[paramKey][scope.column.property]">
                            </el-input>
                        </template>
                    </template>
                </u-table-column>
            </u-table>
        </div>
    </div>
</template>
<script>
    Vue.component('app-attr', {
        template: '#app-attr',
        props: {
            showtype: {
                type: String,
                default: 'before'
            },
            value: Array, // 商品规格信息
            attrGroups: Array, // 商品规格组
            extra: Object, // 额外的数据信息
            list: Object | Array, // 从排列数据信息
            isLevel: Boolean, // 是否是会员
            members: Array, // 会员等级列表
            share: Array, // 分销等级列表
            append: String, // 输入框后缀
            price_append: String, // 输入框后缀
            requiredExtra: {
                type: Array,
                default() {
                    return []
                }
            },
            price_width: {
                type: String,
                default() {
                    return '100%'
                }
            },
            // list的默认值
            default_param: String,
            paramKey: {
                type: String,
                default() {
                    return 'member_price';
                }
            },
        },
        data() {
            return {
                requiredArray: [`price`, `stock`].concat(this.requiredExtra),
                attrBatch: false,
                data: {
                    price: '价格',
                    stock: '库存',
                    cost_price: '成本',
                    weight: '重量(克)',
                    no: '货号',
                    bar_code: '条形码',
                },
                selectData: '',
                batch: 0,
                selectList: [],
                attrData: {},
                allSelect: false,
            };
        },
        created() {
            if (this.isLevel) {
                for (let i in this.value) {
                    if (this.value[i][this.paramKey]) {
                        continue;
                    }
                    let members = JSON.parse(JSON.stringify(this.members));
                    let obj = {};
                    members.forEach(function (memberLevelItem, memberLevelIndex) {
                        let key = 'level' + memberLevelItem.level;
                        obj[key] = '';
                    });
                    this.value[i][this.paramKey] = obj;
                }
            }
            if (this.extra && this.extra.supply_price == '团长供货价(元)') {
                this.data.price = '买家购买价(元)'
            }
        },
        watch: {
            'attrData': function (newData) {
                this.$emit('upattr', newData)
            },
            'value': {
                handler(newData) {
                    let self = this;
                    this.$nextTick(_ => {
                        self.attrConcat(newData);
                    })
                },
                immediate: true,
            },
            'selectList': function () {
                return;
                const self = this;
                let sign = 0;
                this.value.forEach(function (item, index) {
                    self.selectList.map((item1) => {
                        if (JSON.stringify(item1.attr_list) === JSON.stringify(item.attr_list)) {
                            sign++;
                        }
                    });
                });
                self.attrBatch = self.value.length === sign;
            }
        },
        computed: {
            cList() {
                // TODO 分销数据暂时
                if (this.share) {
                    let share = JSON.parse(JSON.stringify(this.share));
                    let obj = {};
                    for (let i = 0; i < share.length; i++) {
                        obj[share[i].value] = share[i].label;
                    }
                    return obj;
                }
                // TODO 会员数据暂时
                if (this.isLevel) {
                    let members = JSON.parse(JSON.stringify(this.members));
                    let obj = {};
                    for (let i = 0; i < members.length; i++) {
                        obj['level' + members[i].level] = members[i].name
                    }
                    return obj;
                } else {
                    if (this.extra) {
                        return Object.assign(this.data, JSON.parse(JSON.stringify(this.extra)));
                    } else if (this.list) {
                        if (this.default_param) {
                            this.batch = this.default_param;
                            this.selectData = this.default_param;
                        }
                        return JSON.parse(JSON.stringify(this.list))
                    } else {
                        return this.data;
                    }
                }
            },
            cData() {
                if (this.attrGroups && this.attrGroups.length > 0 && this.attrGroups[0].attr_list.length === 0) {
                    return [];
                } else {
                    return this.value;
                }
            },
            attrInfo() {
                return row => {
                    row = this.attrData[JSON.stringify(row.attr_list)];
                    return row;
                }
            },
            calendarOld() {
                return attr_list => {
                    if (this.appGoods.ruleForm.use_attr) {
                        return this.appGoods.attrData[JSON.stringify(attr_list)] || {}
                    } else {
                        return {
                            bar_code: this.appGoods.ruleForm.bar_code,
                            weight: this.appGoods.ruleForm.goods_weight,
                            no: this.appGoods.ruleForm.goods_no,
                            cost_price: this.appGoods.ruleForm.cost_price,
                        }
                    }
                }
            }
        },
        methods: {
            attrConcat(newData) {
                if (!newData || Array.from(newData).length == 0) {
                    return
                }
                for (let _ of newData) {
                    let a = JSON.stringify(_.attr_list);
                    this.attrData[a] = Object.assign({}, {
                        extra: '',
                        bar_code: '',
                        cost_price: '0',
                        member_price: {},
                        no: '',
                        pic_url: '',
                        price: '0',
                        shareLevelList: [],
                        stock: '0',
                        weight: '',
                    }, _, this.attrData[a] || {})
                }
                this.attrData = JSON.parse(JSON.stringify(this.attrData));
                this.$refs.multipleTable.reloadData(newData)
            },
            selectable(row, index) {
                if (index === 1) {
                    return false
                } else {
                    return true
                }
            },
            specCartesian(arr1, arr2) {
                // 去除第一个元素
                var result = [];
                var temp_arr = arr1;
                var first = temp_arr.splice(0, 1);

                if ((arr2 || null) == null) {
                    arr2 = [];
                }

                // 判断是否是第一次进行拼接
                if (arr2.length > 0) {
                    for (var i in arr2) {
                        for (var k in first[0].value) {
                            result.push(arr2[i] + ',' + first[0].value[k]);
                        }
                    }
                } else {
                    for (var i in first[0].value) {
                        result.push(first[0].value[i]);
                    }
                }

                // 递归进行拼接
                if (arr1.length > 0) {
                    result = SpecCartesian(arr1, result);
                }
                return result;
            },
            selectClick() {
                if (this.attrBatch) {
                    this.$refs.multipleTable.partRowSelections(this.value, this.attrBatch)
                } else {
                    this.$refs.multipleTable.clearSelection()
                }
            },
            handleSelectionChange(data) {
                this.selectList = data;
            },
            batchAttr(param) {
                if (!param) {
                    this.$message.warning('请选择批量设置');
                    return;
                }
                this.selectList = this.$refs.multipleTable.getCheckboxRecords();
                if (!this.selectList || this.selectList.length === 0) {
                    this.$message.warning('请勾选商品规格');
                    return;
                }
                if (this.showtype === 'text' || this.showtype === 'after') {
                    let self = this;
                    let attrData = JSON.parse(JSON.stringify(this.attrData));
                    for (let item1 of this.selectList) {
                        let attr_list = JSON.stringify(item1.attr_list);
                        if (this.attrData[attr_list]) {
                            attrData[attr_list][param] = self.batch;
                        }
                    }
                    this.attrData = attrData;
                } else {
                    let self = this;
                    let batch = self.batch;
                    this.value.forEach((item, index) => {
                        let sign = false;
                        self.selectList.map((item1) => {
                            if (JSON.stringify(item1.attr_list) === JSON.stringify(item.attr_list)) {
                                sign = true;
                            }
                        });
                        if (sign) {
                            // 批量设置会员价
                            // 判断字符串是否出现过，并返回位置
                            if (param.indexOf('level') !== -1) {
                                //item[this.paramKey][param] = batch;
                                Vue.set(item[this.paramKey], param, batch)
                            } else {
                                item[param] = batch;
                            }
                        }
                    });
                }
            }
        },
        inject: ['appGoods'],
    });
</script>
