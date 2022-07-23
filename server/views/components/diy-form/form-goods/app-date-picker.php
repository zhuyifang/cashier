<template id="app-date-picker">
    <div class="app-date-picker" v-if="$attrs.type === 'yearrange'">
        <el-date-picker
                v-bind="$attrs"
                type="year"
                v-model="queryParams.start_time"
                style="width: 108px"
                :picker-options="pickerStartAuditYear"
        ></el-date-picker>
        {{$attrs['range-separator']}}
        <el-date-picker
                v-bind="$attrs"
                v-model="queryParams.end_time"
                type="year"
                style="width: 108px"
                :picker-options="pickerEndAuditYear"
        ></el-date-picker>
    </div>
    <el-date-picker style="width:240px" v-else v-bind="$attrs" v-on="$listeners"></el-date-picker>
</template>


<script>
    Vue.component('app-date-picker', {
        template: '#app-date-picker',
        props: {},
        created() {
            const value = JSON.parse(JSON.stringify(this.$attrs.value));

            if (value && this.$attrs.type === 'yearrange') {
                this.queryParams = {
                    start_time: value[0],
                    end_time: value[1],
                };
            }
        },
        watch: {
            queryParams: {
                deep: true,
                handler(newVal) {
                    let {start_time, end_time} = this.queryParams;
                    this.$emit('input', [start_time || '', end_time || ''])
                },
            }
        },
        data() {
            return {
                queryParams: {start_time: '', end_time: ''},
                pickerStartAuditYear: {
                    disabledDate: time => {
                        if (this.queryParams.end_time && time.getFullYear() > this.queryParams.end_time) {
                            return true
                        }

                        const {is_now, start_at, end_at} = this.$attrs;
                        let startTime = is_now == 1 ? new Date().getTime() : new Date(start_at.replace(/-/g, "/")).getTime();
                        let endTime = new Date(end_at.replace(/-/g, "/")).getTime()
                        return time.getTime() > endTime || time.getTime() < startTime;
                    }
                },
                pickerEndAuditYear: {
                    disabledDate: time => {
                        if (time.getFullYear() < this.queryParams.start_time) {
                            return true;
                        }
                        const {is_now, start_at, end_at} = this.$attrs;
                        let startTime = is_now == 1 ? new Date().getTime() : new Date(start_at.replace(/-/g, "/")).getTime();
                        let endTime = new Date(end_at.replace(/-/g, "/")).getTime()
                        return time.getTime() > endTime || time.getTime() < startTime;
                    }
                },
            }
        },
    })
</script>