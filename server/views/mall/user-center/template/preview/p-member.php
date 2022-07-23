<style>
    .diy-preview.diy-member .classic {
        padding: 20px 40px;
        background-color: #fff;
    }
    .diy-preview.diy-member .classic .classic-area {
        padding: 20px 50px;
        font-size: 30px;
        border-radius: 47px;
    }
    .diy-preview.diy-member .classic .classic-area>div>img {
        margin-left: 10px;
    }
    .diy-preview.diy-member .custom .custom-area {
        position: relative;
        width: 702px;
        height: 144px;
        margin: 0 auto 20px;
    }
    .diy-preview.diy-member .custom .custom-area .default {
        position: absolute;
        left: 40px;
        top: 0;
        height: 144px;
        color: #FFFFFF;
    }
    .diy-preview.diy-member .custom .custom-area .default>div {
        max-width: 320px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: 600;
        font-size: 40px;
    }
</style>
<template id="p-member">
    <div ref="component" class="diy-preview diy-member">
        <div class="classic" v-if="data.style == 1">
            <div class="classic-area" flex="main:justify cross:center" :style="areaStyle">
                <img width="60" height="60" :src="data.icon">
                <div flex="dir:right cross:center">
                    <img width="24" height="30" src="statics/img/app/user-center/arrow.png" alt="">
                    <div :style="{'color': data.text_color,'max-width': '400px'}">{{data.before_text}}</div>
                </div>
            </div>
        </div>
        <div class="custom" v-if="data.style == 2">
            <div class="custom-area" v-if="data.mode == 1">
                <img width="702" height="144" :src="data.bg_pic">
                <div class="default" flex="dir:right cross:center">
                    <img width="44" height="50" src="statics/img/app/user-center/white-arrow.png" alt="">
                    <div>{{data.before_text}}</div>
                </div>
            </div>
            <div class="custom-area" v-if="data.mode == 2">
                <img width="702" height="144" :src="data.before_bg">
            </div>
        </div>
    </div>
</template>
<script>
    Vue.component('p-member', {
        template: '#p-member',
        props: {
            value: Object
        },
        data() {
            return {
                data: {}
            }
        },
        computed: {
            areaStyle() {
                let style = `background-color: ${this.data.card_color};`
                if(this.data.shadow == 1) {
                    style += `box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);`
                }
                return style;
            }
        },
        created() {
            this.data = JSON.parse(JSON.stringify(this.value));
        },
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            }
        },
    });
</script>
