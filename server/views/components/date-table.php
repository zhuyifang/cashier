<style>
    .date-table th {
        border-top: 1px solid #DCDFE6;
        border-right: 1px solid #DCDFE6;
        height: 87px;
        font-size: 18px;
        color: #303133;
    }

    .date-table th:last-child {
        border-right-width: 0px;
    }

    .date-table .el-calendar-day {
        font-size: 18px;
        color: #606266;
    }

    .date-table .calendar-day-model {
        height: 85px;
        width: 100%;
        top: 0;
        position: absolute;
        z-index: 2;
        background: rgba(0, 0, 0, 0.45);
    }

    .date-table .__calendar-set {
        height: 23px;
        width: 40%;
        background: #FFFFFF;
        border-radius: 3px;
        cursor: pointer;
        font-size: 12px;
        color: #606266;
        margin-right: 7%;
    }

    .date-table .__calendar-set:last-child {
        margin-right: 0;
    }

    .date-table .__calen-active {
        border: 10px solid rgba(0, 0, 0, 0);
        transform: rotate(270deg);
        border-left-color: #409EFF;
        border-bottom-color: #409EFF;
        position: absolute;
        z-index: 1;
        bottom: 0;
        right: 0;
    }
</style>
<template id="date-table">
    <div class="date-table">
        <table class="el-calendar-table" cellspacing="0" cellpadding="0">
            <thead>
            <th>周日</th>
            <th>周一</th>
            <th>周二</th>
            <th>周三</th>
            <th>周四</th>
            <th>周五</th>
            <th>周六</th>
            </thead>
            <tbody>
            <tr v-for="(row,index) in rows" class="el-calendar-table__row">
                <td v-for="(cell,key) in row" :key="key" @mouseenter="mouseenter(cell)" @mouseleave="mouseId = -1"
                    style="position:relative;cursor:pointer">
                    <div class="el-calendar-day" style="padding: 0" flex="main:center cross:center">
                        <span :style="{color: !cell.disable ? '#606266' : '#DCDFE6'}">{{ cell.day }}</span>
                    </div>
                    <div v-show="mouseId == cell.value && !cell.disable && cell.type === 'current'"
                         class="calendar-day-model"
                         flex="dir:left main:center cross:center">

                        <template v-if="isSelect(cell)">
                            <div flex="main:center cross:center" @click="handleEdit(cell)" class="__calendar-set">
                                修改
                            </div>
                            <div flex="main:center cross:center" @click="handleClear(cell)"
                                 class="__calendar-set">清空
                            </div>
                        </template>
                        <div v-else flex="main:center cross:center" class="__calendar-set" @click="handleAdd(cell)">
                            设置
                        </div>
                    </div>
                    <div v-if="isSelect(cell)" class="__calen-active"></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    const getFirstDayOfMonth = function (date) {
        const temp = new Date(date.getTime());
        temp.setDate(1);
        return temp.getDay();
    };
    const range = function (n) {
        // see https://stackoverflow.com/questions/3746725/create-a-javascript-array-containing-1-n
        return Array.apply(null, {length: n}).map((_, n) => n);
    };
    const getPrevMonthLastDays = (date, amount) => {
        if (amount <= 0) return [];
        const temp = new Date(date.getTime());
        temp.setDate(0);
        const lastDay = temp.getDate();
        return range(amount).map((_, index) => lastDay - (amount - index - 1));
    };
    const rangeArr = range;
    const getMonthDays = (date) => {
        const temp = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        const days = temp.getDate();
        return range(days).map((_, index) => index + 1);
    };
    const getTimeMonthDays = (date) => {
        const temp = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        const days = temp.getDate();
        return range(days).map((_, index) => index + 1);
    };


    Vue.component('date-table', {
        template: '#date-table',
        inject: ['calendar', 'appGoods'],
        data() {
            return {
                mouseId: '',
            }
        },
        created(){
            this.calendar.fluashActiveIds();
        },
        methods: {
            handleClear({value}) {
                const self = this;
                this.appGoods.map.forEach(function (_, key) {
                    if (key.value === value) Object.assign(_.has_type, {[self.calendar.$attrs.showtype]: false});
                });
                this.calendar.fluashActiveIds();
            },
            mouseenter({value}) {
                this.mouseId = value;
            },
            toNestedArr(days) {
                return rangeArr(Math.ceil(days.length / 7)).map((_, index) => {
                    const start = index * 7;
                    return days.slice(start, start + 7);
                });
            },

            handleAdd(params) {
                if (this.calendar.$attrs.showtype !== 'basic') {
                    this.handleEdit(params, 'add');
                    return;
                }
                let {year, month, value, day} = params;

                const goodsPrice = JSON.parse(JSON.stringify(this.appGoods.ruleForm))
                if (!goodsPrice.use_attr) {
                    const {goods_num, price} = goodsPrice;
                    this.calendar.calendarForm.calcAlone[0].price = price;
                    this.calendar.calendarForm.calcAlone[0].stock = goods_num;
                }
                Object.assign(this.calendar.calendarForm, JSON.parse(JSON.stringify({
                    type: 'add',
                    goods: {
                        attr: goodsPrice.attr,
                        shareLevel: goodsPrice.shareLevelList,
                        member_price: goodsPrice.member_price,
                    },
                    calc: {year, month, value, day},
                    has_type: {
                        basic: false,
                        memberPrice: false,
                        sharePrice: false,
                    },
                    visible: true,
                })));
            },
            handleAttrSort(goods) {
                const res = this.appGoods.ruleForm.attr;

                let s = {};
                for (let _ of goods.attr) {
                    let a = JSON.stringify(_.attr_list);
                    Object.assign(s, {[a]: _});
                }
                let attrData = s;


                goods.attr = this.calendar.makeAttrGroup(res)
                for (let _ in goods.attr) {
                    let a = JSON.stringify(goods.attr[_].attr_list);
                    goods.attr[_] = Object.assign({}, {
                        attr_list: JSON.parse(a),
                        bar_code: '',
                        cost_price: '0',
                        member_price: {},
                        no: '',
                        pic_url: '',
                        price: '0',
                        shareLevelList: [],
                        stock: '0',
                        weight: '',
                    }, attrData[a])
                }
                return goods;
            },
            handleEdit({year, month, value, day}, type = 'edit') {
                for (let key of this.appGoods.map.keys()) {
                    if (key.value === value) {
                        var {goods, calcAlone, has_type, calc} = this.appGoods.map.get(key);
                        break;
                    }
                }

                Object.assign(this.calendar.calendarForm, {
                    type,
                    visible: true,
                    goods: this.handleAttrSort(JSON.parse(JSON.stringify(goods))),
                    has_type,
                    calcAlone,
                    calc
                })
            },
        },
        computed: {
            isSelect() {
                return ({value, disable}) => {
                    if (disable) return false;
                    const s = {
                        basic: 'attr_ids',
                        memberPrice: 'member_ids',
                        sharePrice: 'sharelist_ids'
                    };
                    return this.calendar.calendar_ids[s[this.calendar.$attrs.showtype]].indexOf(value) !== -1;
                }
            },
            rows() {
                let {calendar_start, calendar_end} = this.appGoods.ruleForm, {currentDate} = this.calendar, days = [];

                function getTime(date) {
                    return date && new Date(Date.parse(date.replace(/-/g, "/"))).getTime();
                }

                const start_time = getTime(calendar_start),
                    end_time = getTime(calendar_end), [year, month] = [currentDate.getFullYear(), currentDate.getMonth() + 1]

                let firstDay = getFirstDayOfMonth(currentDate);
                firstDay = firstDay === 0 ? 7 : firstDay;
                const offset = firstDay % 7;
                const prevMonthDays = getPrevMonthLastDays(currentDate, offset).map(day => ({
                    type: 'prev',
                    disable: true,
                }));


                const currentMonthDays = getMonthDays(currentDate).map(day => {
                    let disable = true;
                    let value = year + '-' + (month >= 10 ? month : '0' + month) + '-' + (day >= 10 ? day : '0' + day);

                    if (this.calendar.$attrs.showtype === 'basic') {
                        disable = start_time > getTime(`${year}/${month}/${day}`) || getTime(`${year}/${month}/${day}`) > end_time;
                    } else {
                        for (let _ of this.appGoods.map.entries()) {
                            if (_[0].value === value && _[1].has_type.basic) disable = false;
                        }
                    }
                    return {
                        year,
                        month,
                        day,
                        value,
                        type: 'current',
                        disable,
                    }
                });
                days = this.toNestedArr([...prevMonthDays, ...currentMonthDays]);
                this.$emit('flushrows', days);
                return days;
            },
        },
    });
</script>