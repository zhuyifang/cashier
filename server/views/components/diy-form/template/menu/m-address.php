<?php defined('YII_ENV') or exit('Access Denied');
?>
<style>
    .m-address .box-grow-1 {
        flex-grow: 1;
        flex-shrink: 1;
    }
    .m-address .m-right .el-scrollbar__wrap {
        overflow-x: hidden;
        padding: 0 20px;

    }
    .m-address .m-right .el-checkbox {
        display: block;
        padding: 6px 29px 6px 7px;
        margin: 12px 0 12px -7px;
        border-radius: 3px;
    }

    .m-address .m-right .m-checkbox.active.el-checkbox {
        background: #409EFF;
    }

    .m-address .m-right .m-checkbox.active .el-checkbox__input + .el-checkbox__label {
        color: #FFFFFF;
    }

    .m-address .m-right .el-checkbox__input.is-checked + .el-checkbox__label {
        color: #606266;
    }


    .m-address .el-checkbox__input.is-indeterminate .el-checkbox__inner::before {
        background-color: #409EFF;
    }

    .m-address .m-right .el-checkbox .el-checkbox__input {
        float: left;
        margin-top: 2px;
    }

    .m-address .el-checkbox .el-checkbox__input .el-checkbox__inner {
        background-color: #FFFFFF;
    }

    .m-address .m-right .el-checkbox .el-checkbox__label {
        white-space: normal;
    }


    .m-address .el-dialog {
        min-width: 623px;
    }

    .m-address .el-checkbox__inner::after {
        border-color: #409EFF;
    }

    .m-address .m-right {
        width: 180px;
        height: 224px;
        border: 1px solid #E5E7EC;
        border-radius: 3px;
        margin: 0 5px;
    }
</style>
<template id="m-address">
    <div class="m-address">
        <el-dialog title="选择地区" :visible.sync="addressVisible" top="5vh" width="854px" @close="onClose">
            <div style="font-size: 16px;padding-left: 128px;padding-bottom: 10px">
                <el-checkbox v-model="all_check_all"
                             @change="allChange">
                    全选
                </el-checkbox>
            </div>
            <div flex="dir:top cross:center">
                <div flex="dir:left" v-loading="listLoading">
                    <!-- 省 -->
                    <div class="box-grow-1" flex="dir:top">
                        <div style="margin-left: 26px;margin-bottom:8px">
                            <el-checkbox :indeterminate="province_indeterminate"
                                         v-model="province_check_all"
                                         @change="provinceAllChange">
                                省
                            </el-checkbox>
                        </div>
                        <el-scrollbar class="m-right">
                            <el-checkbox v-for="(item,index) of districtList"
                                         class="m-checkbox"
                                         :class="{'active': index === province_active_index}"
                                         :key="index"
                                         v-model="item.active"
                                         @change="provinceChange(index,item.active)"
                            >
                                {{item.name}}
                            </el-checkbox>
                        </el-scrollbar>
                    </div>
                    <!-- 市 -->
                    <div class="box-grow-1" flex="dir:top">
                        <div style="margin-left: 26px;margin-bottom:8px">
                            <el-checkbox :indeterminate="city_indeterminate"
                                         v-model="city_check_all"
                                         @change="cityAllChange">
                                市
                            </el-checkbox>
                        </div>
                        <el-scrollbar class="m-right">
                            <el-checkbox v-for="(item,index) of cityList"
                                         class="m-checkbox"
                                         :class="{'active': index === city_active_index}"
                                         :key="index"
                                         v-model="item.active"
                                         @change="cityChange(index,item.active)"
                            >
                                {{item.name}}
                            </el-checkbox>
                        </el-scrollbar>
                    </div>
                    <!-- 区 -->
                    <div class="box-grow-1" flex="dir:top">
                        <div style="margin-left: 26px;margin-bottom:8px">
                            <el-checkbox :indeterminate="area_indeterminate"
                                         v-model="area_check_all"
                                         @change="areaAllChange">
                                区
                            </el-checkbox>
                        </div>
                        <el-scrollbar class="m-right">
                            <el-checkbox v-for="(item,index) of areaList"
                                         class="m-checkbox"
                                         :class="{'active': index === area_active_index}"
                                         :key="index"
                                         v-model="item.active"
                                         @change="areaChange(index,item.active)"
                            >
                                {{item.name}}
                            </el-checkbox>
                        </el-scrollbar>
                    </div>
                </div>


                <div style="margin-top: 24px;text-align: center">
                    <el-button @click="onSubmit" size="small" type="primary">确定</el-button>
                    <el-button @click="onClose" size="small">取消</el-button>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    Vue.component('m-address', {
        template: '#m-address',
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
                addressVisible: false,
                districtList: [],
                all_check_all: false,
                //////
                province_active_index: -1,
                province_indeterminate: false,
                province_check_all: false,


                city_active_index: -1,
                city_indeterminate: false,
                city_check_all: false,

                area_active_index: -1,
                area_indeterminate: false,
                area_check_all: false,
                ///
                isIndeterminate: true,
                province_active: 0,
                city_active: 0,
                checkAll: true,
            };
        },
        created() {
            if (this.districtList && this.districtList.length) {

            } else {
                let activeIds = [];
                this.xunhuan(this.typeData, item => activeIds.push(item.id) && false)
                this.getDistrict(activeIds);
            }
        },
        watch: {
            value: {
                deep: true,
                handler(newVal) {
                    this.addressVisible = newVal;
                },
            },
        },

        computed: {
            cityList() {
                if (this.province_active_index === -1) {
                    return [];
                }
                return this.districtList[this.province_active_index].list
            },
            areaList() {
                if (this.province_active_index === -1 || this.city_active_index === -1) {
                    return [];
                }
                return this.districtList[this.province_active_index].list[this.city_active_index].list;
            }
        },
        methods: {
            allChange() {
                this.districtList = this.xunhuan(this.districtList, ((item, all_check_all) => {
                    item.active = all_check_all;
                }), this.all_check_all);
                this.calcProAll();
                this.calcAreaAll();
                this.calcCityAll();
            },
            onSubmit() {
                let sentinel = 1;
                let select = this.xunhuan([].concat(this.districtList).filter(item => item['active']), item => {
                    sentinel++;
                    item = Object.assign({key: new Date().getTime() + sentinel}, item);
                    if (item.active !== undefined) {
                        if (item.list && item.list.length) {
                            item.list = item.list.filter(item1 => item1['active']);
                        }
                    }
                    delete item['active'];
                    return item;
                });
                this.$emit('change', select);
                this.onClose();
            },

            provinceAllChange(value) {
                //省 全
                this.districtList.forEach(item1 => {
                    item1.active = value;
                    if (!value) {
                        item1.list.forEach(item2 => {
                            item2.active = value;
                            item2.list.forEach(item3 => item3.active = value)
                        })
                    }
                })
                this.province_indeterminate = false;
                this.province_check_all = value;
                //市
                this.calcCityAll();
                //区
                this.calcAreaAll();
            },
            provinceChange(index, active) {
                if (this.province_active_index !== index) {
                    this.city_active_index = 0;
                    this.area_active_index = 0;
                }
                //省 全
                this.province_active_index = index;
                this.calcProAll();
                //市 + 区
                if (!active) {
                    this.cityAllChange(active);
                }
            },
            cityAllChange(value) {
                let {province_active_index} = this;
                if (province_active_index === -1)
                    return false;
                //市 全
                this.cityList.forEach(item1 => {
                    item1.active = value;
                    if (!value) {
                        item1.list.forEach(item2 => item2.active = value)
                    }
                })
                this.city_indeterminate = false;
                this.city_check_all = value;
                //区 全+个
                this.calcAreaAll();
                //省
                if (value) {
                    this.districtList[this.province_active_index].active = this.city_indeterminate || this.city_check_all;
                }
                this.calcProAll();
            },
            cityChange(index, active) {
                if (this.city_active_index !== index) {
                    this.area_active_index = 0;
                }
                //市 全
                this.city_active_index = index;
                this.calcCityAll();
                if (active) {
                    //省
                    this.districtList[this.province_active_index].active = this.city_indeterminate || this.city_check_all;
                    this.calcProAll();
                } else {
                    //区
                    this.areaAllChange(active);
                }
            },
            areaAllChange(value) {
                let {province_active_index, city_active_index} = this;
                if (province_active_index === -1 || city_active_index === -1)
                    return false;
                //区 全
                this.areaList.forEach(item1 => item1.active = value)
                this.area_indeterminate = false;
                this.area_check_all = value;
                if (!value) return;
                //市 个+全
                this.districtList[this.province_active_index]['list'][this.city_active_index].active = value;
                this.calcCityAll();
                //省 个+全
                this.districtList[this.province_active_index].active = this.city_indeterminate || this.city_check_all;
                this.calcProAll();
            },
            areaChange(index, active) {
                this.area_active_index = index;
                //区 全
                this.calcAreaAll();
                if (!active) return;
                //市 个+全
                this.districtList[this.province_active_index]['list'][this.city_active_index].active = this.area_indeterminate || this.area_check_all;
                this.calcCityAll();
                //省 个+全
                this.districtList[this.province_active_index].active = this.city_indeterminate || this.city_check_all;
                this.calcProAll();
            },
            //end
            calcActiveNum(array) {
                let num = 0;
                array.forEach(item => num += item.active ? 1 : 0)
                return num;
            },
            calcAreaAll() {
                let num = this.calcActiveNum(this.areaList);
                this.area_indeterminate = num > 0 && num < this.areaList.length;
                this.area_check_all = num > 0 && num === this.areaList.length;
            },
            calcCityAll() {
                let num = this.calcActiveNum(this.cityList);
                this.city_indeterminate = num > 0 && num < this.cityList.length;
                this.city_check_all = num > 0 && num === this.cityList.length;
            },
            calcProAll() {
                let num = this.calcActiveNum(this.districtList);
                this.province_indeterminate = num > 0 && num < this.districtList.length;
                this.province_check_all = num > 0 && num === this.districtList.length;
            },
            getDistrict(activeIds = []) {
                this.listLoading = true;
                request({
                    params: {
                        r: 'district/index',
                        level: 3,
                    },
                }).then(e => {
                    this.listLoading = false;
                    if (e.data.code === 0) {
                        let {district} = e.data.data;
                        this.districtList = this.xunhuan(district, function (item, activeIds) {
                            item['active'] = activeIds.indexOf(item.id) !== -1;
                            return item;
                        }, activeIds);
                        this.calcProAll();
                    } else {
                        this.$message.error(e.data.msg);
                    }
                });
            },
            xunhuan(a, callback, ...params) {
                let arr = [].concat(a);
                return arr.map(item1 => {
                    item1 = callback(item1, ...params) || item1;
                    if (!item1.list || !item1.list.length) {
                        return item1;
                    }
                    item1.list = item1.list.map(item2 => {
                        item2 = callback(item2, ...params) || item2;
                        if (!item2.list || !item2.list.length) {
                            return item2;
                        }
                        item2.list = item2.list.map(item3 => {
                            item3 = callback(item3, ...params) || item3;
                            return item3;
                        })
                        return item2;
                    })
                    return item1;
                })
            },
            onClose() {
                this.$emit('input', false);
            },
        },
    });
</script>
