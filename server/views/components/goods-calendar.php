<?php
Yii::$app->loadViewComponent('date-table');
?>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/js/fecha.min.js"></script>
<style>
    .picker-popper-class {
        left: 533px !important;
    }

    .goods-calendar {
        border: 1px solid #DCDFE6;
        margin-top: 15px;
        border-radius: 3px;
        padding-top: 20px;
        background: #FFFFFF;
        width: 1251px
    }

    .goods-calendar.c-all {
        border: 1px solid #DCDFE6;
        border-radius: 3px;
        width: 1250px;
    }

    .goods-calendar.c-all .c-head {
        height: 67px;
        padding: 0 41px 0 34px;
    }

    .goods-calendar .c-bottom-icon {
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAyElEQVQ4T+2TQQvCMAyFk/1RaRtBvDvBg24HEefZg9Km+EcXKSi4ua2d7qa9FEry9fW9FGHihRPz4A/83tGGh8xMAHAFSPZWRGRujHFPKQ2gtXaZZdl5jM66rhdEdOkEhkNmPgJAngittNbr19rOsXHO7RFxMwQVkdIYU7RreufQe78TkbeGAEDEQilVdl04ONjMvAWAduNGa33oUx/9Kd77lYhUD2W5Uuo0ZEUUGJqttbOwE9EtFlYSMAaJpjwGkJzyp9AffPIdKq83FUo8VQ8AAAAASUVORK5CYII=);
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 20px;
        width: 20px;
        margin-left: 5px
    }

    .close {
        position: absolute;
        top: -4px;
        right: -4px;
        font-size: 16px;
        cursor: pointer;
    }

    .attr-list {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
        position: relative;
        cursor: move;
    }

    .week-item {
        width: 54px;
        height: 28px;
        border: 1px solid #DCDFE6;
        border-radius: 3px;
        margin-right: 20px;
        position: relative;
        color: #606266;
        text-align: center;
        line-height: 26px;
        font-size: 12px;
        cursor: pointer;
    }

    .week-item.active {
        border-color: transparent;
        color: #409EFF;
    }

    .week-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .goods-calendar-table-model {
        width: 100%;
    }

    .goods-calendar-table-model tr > th.is-leaf:before {
        content: '*';
        color: #F56C6C;
        margin-right: 4px;
        padding-left: 10px;
    }

    .goods-calendar-table-model.el-table th > .cell {
        width: auto;
        padding-left: 0;
    }

    .choose-day-list {
        width: 625px;
        border: 1px solid #DCDFE6;
        border-radius: 3px;
        padding: 5px 16px 0;
        font-size: 12px;
        cursor: pointer;
    }

    .choose-day-list .choose-day {
        height: 22px;
        line-height: 22px;
        margin-bottom: 5px;
        width: 47px;
        text-align: center;
        margin-left: 8px;
        background-color: #F5F7FA;
        color: #606266;
    }
</style>

<template id="goods-calendar">
    <div class="el-calendar goods-calendar c-all">
        <div class="c-head" flex="dir:left cross:center main:justify">
            <div flex="dir:left cross:center" @click="openDaySelect">
                <div style="font-size: 18px;color: #303133;">
                    {{ showMonthData }}
                </div>
                <div class="c-bottom-icon"></div>
                <el-date-picker
                        ref="datePicker"
                        style="height: 0;width:0;overflow:hidden"
                        v-model="currentDate"
                        @change="handlePicker"
                        popper-class="picker-popper-class"
                        type="month"
                ></el-date-picker>
            </div>
            <div>
                <template v-if="$attrs.showtype === 'basic'">
                    <el-button size="mini" @click="dateInit">数据初始化</el-button>
                    <el-tooltip class="item" effect="dark" content="数据初始化为默认值"
                                placement="top">
                        <i style="color: #606266;margin-right:40px" class="el-icon-info"></i>
                    </el-tooltip>
                </template>
                <el-button size="mini" style="font-size: 14px;color: #606266;cursor: pointer" @click="openBatch">批量设置
                </el-button>
            </div>

        </div>
        <div class="el-calendar__body1" v-loading="dateLoading">
            <date-table @flushrows="flushrows"></date-table>
        </div>

        <el-dialog title="设置" :visible.sync="calendarForm.visible">
            <template slot="title">
                <div v-if="calendarForm.type === 'batch'" style="font-size: 18px; color: #303133;">批量设置</div>
                <div v-if="calendarForm.type === 'edit'" style="font-size: 18px; color: #303133;"
                     flex="dir:left cross:center">
                    <div>修改</div>
                    <div style="margin-left: 20px;color:#909399;font-size: 14px">{{showDayData(calendarForm.calc)}}
                    </div>
                </div>
                <div v-if="calendarForm.type === 'add'" style="font-size: 18px; color: #303133;"
                     flex="dir:left cross:center">
                    <div>设置</div>
                    <div style="margin-left: 20px;color:#909399;font-size: 14px">{{showDayData(calendarForm.calc)}}
                    </div>
                </div>
            </template>

            <el-dialog
                    title="选择日期"
                    :visible.sync="dayVisible"
                    width="997px"
                    append-to-body>
                <el-checkbox-group v-model="dayModel.choose_day" @change="handleCheckeddayChange">
                    <el-checkbox class="day-item" style="margin-bottom: 20px" v-for="item in selectDay" :label="item"
                                 :key="item">{{item}}号
                    </el-checkbox>
                </el-checkbox-group>
                <div style="margin-top: 20px;" flex="cross:center main:justify">
                    <el-checkbox :indeterminate="day_indeterminate" v-model="day_checkAll"
                                 @change="handleCheckAllChange">全选
                    </el-checkbox>
                    <div>
                        <el-button size="small" @click="dayVisible = false">取消</el-button>
                        <el-button size="small" type="primary" @click="submitChooseDay">保存</el-button>
                    </div>
                </div>
            </el-dialog>

            <el-form :model="calendarForm" ref="calendarForm" label-width="100px" size="small">
                <template v-if="calendarForm.type === 'batch'">
                    <el-form-item label="日期设置">
                        <el-radio v-model="calendarForm.dateSet" label="day">按天设置</el-radio>
                        <el-radio v-model="calendarForm.dateSet" label="week">按周设置</el-radio>
                    </el-form-item>
                    <el-form-item label="选择日期">
                        <div v-if="calendarForm.dateSet === 'week'" flex="dir:left cross:center">
                            <div @click="item.is_choose = !item.is_choose"
                                 v-for="(item,index) in calendarForm.week_list"
                                 :key="index"

                                 class="week-item" :class="{'active': item.is_choose}">
                                <img v-if="item.is_choose" src="statics/img/mall/select.png" alt="">
                                <div>{{item.name}}</div>
                            </div>
                        </div>
                        <div v-if="calendarForm.dateSet === 'day'">
                            <div @click="openDayModel" style="width:100%" class="choose-day-list"
                                 v-if="calendarForm.choose_day.length > 0" flex="dir:left cross:top">
                                <div flex="dir:left cross:center" style="flex-wrap: wrap;">
                                    <div class="choose-day" v-for="item in calendarForm.choose_day" :key="item">
                                        {{item}}号
                                    </div>
                                </div>
                            </div>
                            <el-button size="small" v-else @click="openDayModel">选择日期</el-button>
                        </div>
                    </el-form-item>
                </template>
            </el-form>

            <template v-if="$attrs.showtype === 'basic'">
                <app-attr
                        v-if="appGoods.ruleForm.use_attr"
                        showtype="basic"
                        v-model="calendarForm.goods.attr"
                        :attr-groups="appGoods.attrGroups"
                ></app-attr>
                <app-attr
                        v-else
                        showtype="basic"
                        v-model="calendarForm.calcAlone"
                        :attr-groups="AloneAttrGroup"
                ></app-attr>
            </template>
            <app-goods-share
                    v-if="$attrs.showtype === 'sharePrice' && calendarForm.visible"
                    v-model="calendarForm.goods"
                    sign="goods"
                    :is_mch="appGoods.is_mch"
                    :attr-groups="appGoods.attrGroups"
                    :attr_setting_type="appGoods.cForm.attr_setting_type"
                    :share_type="appGoods.ruleForm.share_type"
                    :use_attr="appGoods.ruleForm.use_attr"
                    pintuan_sign="XX"
            ></app-goods-share>
            <template v-if="$attrs.showtype === 'memberPrice'">
                <!--多规格会员价设置-->
                <template v-if="appGoods.ruleForm.use_attr == 1 && appGoods.memberLevel.length > 0">
                    <app-attr v-model="calendarForm.goods.attr" :attr-groups="appGoods.attrGroups"
                              :members="appGoods.memberLevel" :is-level="true"></app-attr>
                </template>
                <!-- 无规格默认会员价 -->
                <div v-if="appGoods.ruleForm.use_attr == 0 && appGoods.memberLevel.length > 0"
                     style="padding-left:25px">
                    <el-input v-for="item in appGoods.defaultMemberPrice" :key="item.id" type="number"
                              style="margin-bottom: 12px"
                              oninput="this.value = this.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')"
                              v-model="calendarForm.goods.member_price[item.level]">
                        >
                        <span slot="prepend">{{item.name}}</span>
                        <span slot="append">元</span>
                    </el-input>
                </div>
            </template>

            <span slot="footer" class="dialog-footer">
                <el-button @click="closeModel">取 消</el-button>
                <el-button type="primary" @click="calendarFormSubmit">确 定</el-button>
              </span>
        </el-dialog>
    </div>
</template>
<script>
    Vue.component('goods-calendar', {
        template: '#goods-calendar',
        name: 'ElCalendar',
        data() {
            return {
                calendarForm: {
                    goods: {
                        member_price: {},
                        attr: [],
                    },
                    calcAlone: [{
                        "attr_list": [{
                            "attr_group_id": 1,
                            "attr_group_name": "规格",
                            "attr_id": 1,
                            "attr_name": "默认"
                        }],
                        "stock": 0,
                        "price": 0,
                        "cost_price": 0,
                        "no": "",
                        "weight": 0,
                        "bar_code": "",
                        "pic_url": "",
                        "shareLevelList": [],
                        "member_price": {}
                    }],

                    type: 'batch',//alone batch
                    dateSet: 'day',
                    choose_day: [],
                    week_list: [{
                        name: '周一',
                        is_choose: false,
                        value: 'Monday',
                    }, {
                        name: '周二',
                        is_choose: false,
                        value: 'Tuesday',
                    }, {
                        name: '周三',
                        is_choose: false,
                        value: 'Wednesday',
                    }, {
                        name: '周四',
                        is_choose: false,
                        value: 'Thursday',
                    }, {
                        name: '周五',
                        is_choose: false,
                        value: 'Friday',
                    }, {
                        name: '周六',
                        is_choose: false,
                        value: 'Saturday',
                    }, {
                        name: '周日',
                        is_choose: false,
                        value: 'Sunday',
                    }],
                    calc: {year: '', month: '', value: '', day: ''},
                    visible: false,
                    has_type: {
                        basic: false,
                        memberPrice: false,
                        sharePrice: false,
                    }
                },

                calendar_ids: {
                    attr_ids: [],
                    member_ids: [],
                    sharelist_ids: [],
                },
                activeIds: [],
                currentDate: new Date(),
                map: new Map(),
                AloneAttrGroup: [{
                    "attr_group_id": 1,
                    "attr_group_name": '默认',
                    "attr_list": [{
                        "attr_id": 1,
                        "attr_name": "规格",
                        "pic_url": "",
                    }]
                }],
                currentMonth: [],
//////
                dayVisible: false,
                dayModel: {
                    choose_day: [],
                },
                day_checkAll: false,
                day_indeterminate: false,
                dateLoading: false,
            };
        },
        created() {
            if (this.$attrs.showtype === 'basic') {
                if (this.appGoods.ruleForm.calendar_start) {
                    this.currentDate = new Date(Date.parse(this.appGoods.ruleForm.calendar_start.replace(/-/g, "/")) || '');
                } else {
                    this.currentDate = new Date();
                }
                this.handleStart();
            }
        },
        watch: {
            'appGoods.ruleForm.use_attr': 'upAttr'
        },
        methods: {
            // 规格组合
            makeAttrGroup(newData) {
                const res = JSON.parse(JSON.stringify(newData));
                // 3.组合结果赋值
                for (let i in res) {
                    let options = Array.isArray(res[i]) ? res[i] : [res[i]];
                    options = options[0].attr_list
                    const row = {
                        attr_list: options,
                        bar_code: '0',
                        cost_price: '0',
                        member_price: {},
                        no: '0',
                        pic_url: '0',
                        price: '0',
                        shareLevelList: [],
                        stock: '0',
                        weight: '0',
                    };
                    res[i] = row;
                }
                return res;
                v.goods.attr = res;
            },


            dateInit() {
                if (!this.appGoods.ruleForm.use_attr) {
                    const {goods_num, price} = this.appGoods.ruleForm;
                    this.calendarForm.calcAlone[0].price = price;
                    this.calendarForm.calcAlone[0].stock = goods_num;
                }
                Object.assign(this.calendarForm, {
                    type: '',
                    visible: false,
                    goods: JSON.parse(JSON.stringify(this.appGoods.ruleForm)),
                });
                const attrData = this.appGoods.attrData;
                if (this.appGoods.ruleForm.use_attr == 1) {
                    this.calendarForm.goods.attr = this.calendarForm.goods.attr.map(_ => {
                        let __ = attrData[JSON.stringify(_.attr_list)];
                        return Object.assign(_, __, {attr_list: _.attr_list})
                    })
                }
                let {calendar_start, calendar_end} = this.appGoods.ruleForm;
                let startTime = new Date(calendar_start.replace(/-/g, '/'));
                let endTime = new Date(calendar_end.replace(/-/g, '/'));

                let year = startTime.getFullYear();
                let month = startTime.getMonth();
                let day = startTime.getDate();
                let map = new Map();
                while (endTime.getFullYear() >= year) {
                    let maxMonth = endTime.getFullYear() === year ? endTime.getMonth() + 1 : 12;
                    for (let selectMonth = year === startTime.getFullYear() ? month + 1 : 1; selectMonth <= maxMonth; selectMonth++) {

                        let date = new Date(year + '/' + selectMonth + '/1');
                        date.setMonth(date.getMonth() + 1);
                        date.setDate(0);
                        let maxDay = endTime.getFullYear() === year && endTime.getMonth() + 1 === selectMonth ? endTime.getDate() : date.getDate();
                        for (let selectDay = year === startTime.getFullYear() && selectMonth === startTime.getMonth() + 1 ? day : 1; selectDay <= maxDay; selectDay++) {
                            let y = year, m = selectMonth, d = selectDay;
                            let calc = {
                                year: y,
                                month: m,
                                day: d,
                                value: y + '-' + (m >= 10 ? m : '0' + m) + '-' + (d >= 10 ? d : '0' + d),
                            }
                            this.calendarForm.has_type = {
                                basic: true,
                                memberPrice: false,
                                sharePrice: false,
                            };
                            this.calendarForm.calc = calc;
                            map.set(calc, Object.assign({calc}, JSON.parse(JSON.stringify(this.calendarForm))));
                        }
                    }
                    year++;
                }
                this.appGoods.map = map;
                this.fluashActiveIds();
            },
            upAttr(newVal) {
                // this.appGoods.map.clear();
                // this.attrAddDate();
                // this.fluashActiveIds();
            },
            handleStart() {
                if (!getQuery('id')) {
                    return;
                }
                let map = new Map();
                if (this.appGoods.ruleForm.use_attr == 1) {
                    this.appGoods.ruleForm.attr[0].date.forEach(date => {
                        let goods = JSON.parse(JSON.stringify(this.appGoods.ruleForm));
                        goods.attr.forEach(_ => {
                            _.date.forEach(__ => {
                                if (__.date.value === date.date.value) {
                                    Object.assign(_, __.value);
                                }
                            })
                        })

                        let shareLevelList, member_price;
                        if (this.appGoods.ruleForm.attr_setting_type == 0) {
                            for (let _ of this.appGoods.ruleForm.date) {
                                if (_.date.value === date.date.value) {
                                    date.value.has_type.sharePrice = _.value.has_type.sharePrice;
                                    shareLevelList = _.value.shareLevelList;
                                    // member_price = _.value.member_price;
                                    break;
                                }
                            }
                        }
                        let value = {
                            calc: date.date,
                            has_type: date.value.has_type,
                            goods: {
                                attr: goods.attr,
                                shareLevelList: shareLevelList || goods.shareLevelList,
                                member_price: member_price || goods.member_price,
                            }
                        }
                        map.set(date.date, Object.assign({}, this.calendarForm, value));
                    })
                } else {
                    if (this.appGoods.ruleForm.date && this.appGoods.ruleForm.date.length) {
                        this.appGoods.ruleForm.date.forEach(item => {
                            let {date, value} = item
                            let goods = JSON.parse(JSON.stringify(this.appGoods.ruleForm));
                            goods.member_price = value.member_price;
                            goods.has_member = value.has_member;
                            goods.shareLevelList = value.shareLevelList;
                            goods.goods_num = value.stock;
                            goods.price = value.price;

                            let params = Object.assign({calc: date}, {goods: goods}, value);
                            let calcAlone = JSON.parse(JSON.stringify(this.calendarForm.calcAlone));
                            calcAlone[0].price = params.price;
                            calcAlone[0].stock = params.stock;
                            Object.assign(params, {calcAlone: calcAlone});
                            map.set(date, Object.assign({}, this.calendarForm, params));
                        })
                    }
                    console.log(map);
                }

                this.appGoods.map = map;
                this.fluashActiveIds();
            },
            mapSet([k, v]) {
                let s = null;
                for (let key of this.appGoods.map.keys()) {
                    if (key.year == k.year && key.month == k.month && key.day == k.day) {
                        s = this.appGoods.map.get(key);
                        this.appGoods.map.delete(key);
                    }
                }
                if (s) {
                    v.has_type = s.has_type;
                    if (this.$attrs.showtype === 'basic') {
                        v.goods.attr = v.goods.attr.map(__ => {
                            s.goods.attr.forEach(_ => {
                                if (JSON.stringify(__.attr_list) == JSON.stringify(_.attr_list)) {
                                    __.member_price = _.member_price
                                    __.shareLevelList = _.shareLevelList;
                                    v.goods.shareLevelList = s.goods.shareLevelList;
                                    v.goods.member_price = s.goods.member_price;
                                }
                            })
                            return __;
                        })
                    }
                    if (this.$attrs.showtype === 'sharePrice') {
                        v.goods.attr = v.goods.attr.map(__ => {
                            s.goods.attr.forEach(_ => {
                                if (JSON.stringify(__.attr_list) == JSON.stringify(_.attr_list)) {
                                    __.member_price = _.member_price
                                    __.price = _.price;
                                    __.stock = _.stock;
                                    v.goods.price = s.goods.price;
                                    v.goods.goods_num = s.goods.goods_num;
                                    v.goods.member_price = s.goods.member_price;
                                }
                            })
                            return __;
                        })
                        v.calcAlone = s.calcAlone;
                    }
                    if (this.$attrs.showtype === 'memberPrice') {
                        v.goods.attr = v.goods.attr.map(__ => {
                            s.goods.attr.forEach(_ => {
                                if (JSON.stringify(__.attr_list) == JSON.stringify(_.attr_list)) {
                                    __.shareLevelList = _.shareLevelList;
                                    __.price = _.price;
                                    __.stock = _.stock;
                                    v.goods.shareLevelList = s.goods.shareLevelList;
                                    v.goods.price = s.goods.price;
                                    v.goods.goods_num = s.goods.goods_num;
                                }
                            })
                            return __;
                        })
                        v.calcAlone = s.calcAlone;
                    }
                }
                console.log(v.goods.attr,123123);
                v.has_type[this.$attrs.showtype] = true;
                v.calc = k;
                v.has_type.basic = true;
                this.appGoods.map.set(k, JSON.parse(JSON.stringify(v)));
            },
            attrAddDate() {
                let ruleForm = this.appGoods.ruleForm;
                ruleForm.attr.forEach(attr => {
                    attr.date = [];
                    for (let _ of this.appGoods.map.values()) {
                        for (let __ of _.goods.attr) {
                            if (JSON.stringify(attr.attr_list) === JSON.stringify(__.attr_list)) {
                                let {price, stock, member_price, shareLevelList} = __, has_type = _.has_type
                                if(has_type.basic === false){
                                    continue;
                                }
                                attr.date.push({
                                    date: _.calc,
                                    value: {price, stock, member_price, shareLevelList, has_type},
                                })
                            }
                        }
                    }
                })
                ruleForm.date = [];
                for (let _ of this.appGoods.map.values()) {
                    if (_.calcAlone && _.calcAlone[0]) {
                        let {price, stock} = _.calcAlone[0], has_type = _.has_type, {
                            member_price,
                            shareLevelList
                        } = _.goods
                        if(has_type.basic === false){
                            continue;
                        }
                        ruleForm.date.push({
                            date: _.calc,
                            value: {price, stock, member_price, shareLevelList, has_type},
                        })
                    }
                }
            },
            calendarFormSubmit() {
                let {type, dateSet, choose_day, calc, week_list} = JSON.parse(JSON.stringify(this.calendarForm));
                if (type === 'batch') {
                    if (dateSet === 'day') {
                        if (!choose_day || !choose_day.length) {
                            this.$message.error('请选择日期');
                            return
                        }
                        choose_day.forEach(day => {
                            calc = {
                                year: calc.year,
                                month: calc.month,
                                day: day,
                                value: calc.year + '-' + (calc.month >= 10 ? calc.month : '0' + calc.month) + '-' + (day >= 10 ? day : '0' + day),
                            }
                            this.mapSet([calc, this.calendarForm]);
                        })
                    } else {
                        week_list = week_list.filter(_ => _.is_choose).map(_ => _.value);
                        if (!week_list || !week_list.length) {
                            this.$message.error('请选择日期');
                            return
                        }
                        this.currentMonth.forEach(_ => {
                            _.forEach(day => {
                                if (day.type === 'current'
                                    && day.disable == false
                                    && week_list.indexOf(fecha.format(new Date(Date.parse(day.value.replace(/-/g, "/"))), 'dddd')) !== -1
                                ) {
                                    calc = {
                                        year: day.year,
                                        month: day.month,
                                        day: day.day,
                                        value: day.year + '-' + (day.month >= 10 ? day.month : '0' + day.month) + '-' + (day.day >= 10 ? day.day : '0' + day.day),
                                    }
                                    this.mapSet([calc, this.calendarForm]);
                                }
                            })
                        });
                    }
                } else {
                    this.mapSet([calc, this.calendarForm]);
                }
                this.fluashActiveIds();
                this.closeModel();
            },
            ///////////////////////////////////////////////////////////////////////////
            openBatch() {
                this.calendarForm = JSON.parse(JSON.stringify(this.calendarForm));
                if (!this.appGoods.ruleForm.use_attr) {
                    let {goods_num, price} = this.appGoods.ruleForm;
                    this.calendarForm.calcAlone[0].price = price;
                    this.calendarForm.calcAlone[0].stock = goods_num;
                }
                Object.assign(this.calendarForm, {
                    type: 'batch',
                    visible: true,
                    goods: JSON.parse(JSON.stringify(this.appGoods.ruleForm)),
                    choose_day: [],
                    calc: {
                        year: fecha.format(this.currentDate, 'YYYY'),
                        value: '',
                        month: fecha.format(this.currentDate, 'M'),
                    }
                })
            },
            //////////
            handleCheckAllChange(val) {
                this.dayModel.choose_day = val ? this.selectDay : [];
                this.day_indeterminate = false;
            },
            handleCheckeddayChange(value) {
                let checkedCount = value.length;
                this.day_checkAll = checkedCount === this.selectDay.length;
                this.day_indeterminate = checkedCount > 0 && checkedCount < this.selectDay.length;
            },
            submitChooseDay() {
                this.calendarForm = Object.assign({}, this.calendarForm, this.dayModel);
                this.dayVisible = false;
            },
            openDayModel() {
                Object.assign(this.dayModel, {choose_day: this.calendarForm.choose_day});
                this.handleCheckeddayChange(this.calendarForm.choose_day)
                this.dayVisible = true;
            },
            //////////
            closeModel() {
                Object.assign(this.calendarForm, {visible: false})
            },
            fluashActiveIds() {
                let calendar_ids = {
                    attr_ids: [],
                    member_ids: [],
                    sharelist_ids: [],
                }

                for (let _ of this.appGoods.map.values()) {
                    let {basic, memberPrice, sharePrice} = _.has_type;
                    basic && calendar_ids.attr_ids.push(_.calc.value)
                    memberPrice && calendar_ids.member_ids.push(_.calc.value)
                    sharePrice && calendar_ids.sharelist_ids.push(_.calc.value)
                }
                this.calendar_ids = calendar_ids;
            },
            flushrows(rows) {
                this.currentMonth = rows;
                this.$emit('flushrows', rows);
            },
            openDaySelect() {
                this.$refs.datePicker.pickerVisible = true;
            },
            handlePicker(e) {
                const date = new Date(e),
                    year = date.getFullYear(),
                    month = date.getMonth() + 1;
                let d = year + '-' + month
                return;
                this.getAttrDate({goods_id: getQuery('id'), date: d})
            },
            getAttrDate({goods_id, date}) {
                this.dateLoading = true;
                request({
                    params: {
                        r: 'mall/goods/attr-date',
                        goods_id,
                        date
                    },
                    method: 'get',
                }).then(e => {
                    this.dateLoading = false;
                    if (e.data.code === 0) {
                        const attr = e.data.data.attrs;
                        Object.assign(this.appGoods.ruleForm, {attr})
                        this.appGoods.makeAttrGroup();
                    } else {
                        self.$message.error(e.data.msg);
                    }
                })
            },
            showDayData({value}) {
                return fecha.format(new Date(Date.parse(value.replace(/-/g, "/"))), 'M月D号');
            },
        },
        computed: {
            selectDay() {
                let days = [];
                this.currentMonth.forEach(week => {
                    week.forEach(day => {
                        if (day.type === 'current' && !day.disable) {
                            days.push(day.day);
                        }
                    })
                })
                return days;
            },
            showMonthData() {
                return fecha.format(this.currentDate, 'YYYY年MM月');
            },
        },
        provide() {
            return {calendar: this}
        },
        inject: ['appGoods'],
    });
</script>
