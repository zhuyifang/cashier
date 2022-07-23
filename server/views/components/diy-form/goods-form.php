<style>
    .table-body {
        padding: 20px;
        background-color: #fff;
    }

    .diy-info-style {
        min-height: 40px;
        background: #ffffff;
        border-radius: 3px;
    }

    .diy-info-style:nth-child(2n+1) {
        background: #F1F5F7;
    }

    .input-item {
        display: inline-block;
        width: 290px;
        margin: -2px 70px 18px 0;
    }

    .show-send {
        width: 90px;
        height: 25px;
        border: 1px solid #409EFF;
        border-radius: 3px;
        color: #409EFF;
        font-size: 14px;
        cursor: pointer;
    }

    .show-send + div > div {
        margin-top: 10px;
    }

    .send-label {
        width: 100px;
        flex-shrink: 0;
        vertical-align: top;
    }

    .reply-content {
        width: 100%;
        padding: 20px 43px;
        background-color: #F1F5F7;
        color: #545B60;
        font-size: 14px;
        position: relative;
    }

    .reply-content::before {
        content: '' !important;
        position: absolute;
        top: -10px;
        left: 40px;
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-bottom: 10px solid #F1F5F7;
    }

    .edit-btn {
        width: 70px;
        height: 25px;
        border-radius: 3px;
        color: #FFFFFF;
        background-color: #409EFF;
        font-size: 14px;
        cursor: pointer;
    }

    .edit-btn img {
        width: 20px;
        height: 20px;
    }

    .diy-info-style .el-icon-circle-close {
        color: #fff;
    }

    .send-data > div {
        margin: 5px 0;
    }

    .__goods-form > img {
        height: 14px;
        width: 14px;
        margin: 0 1px;
    }

    .__goods-form .leftimg {
        height: 18px;
        width: 8px;
    }
</style>
<template id="goods-form">
    <div class="goods-form">
        <div @click="getData">
            <slot></slot>
        </div>

        <el-dialog title="定制详情" :visible.sync="dialogTableVisible">
            <el-dialog width="50%" :visible.sync="videoForm.status" append-to-body>
                <div style="text-align: center">
                    <video autoplay
                           controls
                           width="700"
                           :src="videoForm.src"
                    ></video>
                </div>
            </el-dialog>
            <el-dialog width="50%" :visible.sync="agreementForm.status" title="协议内容" append-to-body>
                <div v-html="agreementForm.html.replace(/\n/g,'<br>')"></div>
            </el-dialog>
            <div v-if="formData">
                <div style="font-size:16px;color:#303133" flex="dir:left cross:center"
                     v-if="formData.eval_calc_list && formData.eval_calc_list.length">
                    <div style="margin-right: 1px">总计</div>
                    <img style="height: 14px;width: 14px;margin:0 1px" src="statics/img/mall/form-goods/icon/1089.png" alt="">
                    <div v-for="i of formData.eval_calc_list" class="__goods-form" flex="dir:left cross:center">
                        <template v-if="i.type === 'operation'">
                            <img v-if="i.value === '//'" src="statics/img/mall/form-goods/icon/1084.png" alt="">
                            <img v-else-if="i.value === '*'" src="statics/img/mall/form-goods/icon/1085.png" alt="">
                            <img v-else-if="i.value === '-'" src="statics/img/mall/form-goods/icon/1086.png" alt="">
                            <img v-else-if="i.value === '+'" src="statics/img/mall/form-goods/icon/1096.png" alt="">
                            <img class="leftimg" v-else-if="i.value === '('"
                                 src="statics/img/mall/form-goods/icon/1092.png" alt="">
                            <img class="leftimg" v-else-if="i.value === ')'"
                                 src="statics/img/mall/form-goods/icon/1095.png" alt="">
                        </template>
                        <div v-else>{{i.label}}</div>
                    </div>
                </div>
                <div style="font-size: 18px;color:#ff4544;margin-top: 20px" flex="dir:left cross:center">
                    <div>总计</div>
                    <div style="margin-left: 10px;font-weight: bold">￥{{formData.total_price}}</div>
                    <el-button size="mini" type="primary" style="padding:3px 16px;margin-left: 10px" @click="showForm">
                        <div flex="dir:left cross:center">
                            <div style="margin-right: 2px">详情</div>
                            <div :style="{transform: form_show ?'rotate(0deg)': 'rotate(180deg)' }"
                                 style="height: 20px;width:20px;background-repeat: no-repeat;background-size:100% 100%;background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAAXNSR0IArs4c6QAAAH1JREFUOE+t0r0JgDAAhNE7sLSwcDkHcR5LS1dyAAsHEE4iScifiCHpH98lhKg8rHRoDyV1Zg3Jq7SqWLRotWAq4QwmyMUyHMG0ZFWx7KGkHsAG4ATgC2+zQ7gAMDibFeCd5Pw8mruEpNHU3l7R4oHkEcG/H6H9B/haUF28AQfCMg8z4EmYAAAAAElFTkSuQmCC')"
                            ></div>
                        </div>
                    </el-button>
                </div>
                <div v-if="form_show" flex="dir:top"
                     style="width: 100%;font-size: 14px;margin-top: 10px;background: #F5F7FA;color: #303133; border-radius: 3px;">
                    <div style="padding: 20px 61px;font-size:14px;">
                        <div flex="dir:left cross:center">
                            <div style="width: calc(1045px - 928px)">商品价格</div>
                            <div style="color:#ff4544;margin-left: 30px">￥{{calcPrice(formData.goods_price,formData.number)}}</div>
                        </div>
                        <div flex="dir:left cross:center" style="padding-top:10px" v-for="attr in formData.attr_list">
                            <div style="width: calc(1045px - 928px)">{{attr.attr_group_name}}</div>
                            <div style="margin-left: 30px">{{attr.attr_name}}</div>
                        </div>
                        <div flex="dir:left cross:top" style="padding-top:10px"
                             v-if="formData.select_date && formData.select_date.length">
                            <div style="width: calc(1045px - 928px)">预约时间</div>
                            <div flex="dir:top">
                                <div flex="dir:left cross:center"
                                     style="font-size:14px;margin-left: 30px;padding-bottom: 10px"
                                     v-for="date in formData.select_date">
                                    <div style="font-size:14px;">{{Object.keys(date)[0]}}</div>
                                    <div style="margin-left: 30px">￥{{Object.values(date)[0]}}</div>
                                </div>
                            </div>
                        </div>
                        <div flex="dir:left cross:center" style="padding-top:10px">
                            <div style="width: calc(1045px - 928px)">数量</div>
                            <div style="margin-left: 30px">{{formData.number}}个</div>
                        </div>
                    </div>
                    <div v-if="formData.eval_calc_list && formData.eval_calc_list.length && item.type !== 'operation'"
                         style="padding: 20px 61px;font-size:14px;border-top: 1px solid #C0C4CC;"
                         flex="dir:left cross:center" v-for="item in formData.eval_calc_list">
                        <div style="width: calc(1045px - 928px)">{{item.label}}</div>
                        <div style="color:#ff4544;margin-left: 30px">{{item.value}}</div>
                    </div>
                </div>
            </div>

            <div style="width: 100%;padding: 0 10px 28px;margin-top: 30px">
                <el-row :gutter="20" class="diy-info-style" style="font-weight: bold" flex="dir:left cross:center">
                    <el-col :span="10" style="padding: 15px 0 15px 20px">表单名称</el-col>
                    <el-col :span="10" style="padding: 15px 0 15px 20px">填写内容</el-col>
                </el-row>
                <el-row v-for="(info,i) of formData.customization" :key="i" :gutter="20"
                        class="diy-info-style"
                        flex="dir:left cross:center"
                        v-if="!(info.key === 'button' && info.value.is_pay == 0) && info.key !== 'form-button'">
                    <el-col :span="10" style="padding: 15px 0 15px 20px">{{info.key === 'button' ? '支付信息' :
                        info.label}}
                    </el-col>
                    <el-col :span="10" style="padding: 15px 0 15px 20px">
                        <div v-if="info.value && [`,`,``].indexOf(info.value.toString()) === -1">
                            <template v-if="info.key=== 'uvideo'">
                                <div v-for="(item,index) in info.value" :key="index"
                                     style="position: relative;display: inline-block">
                                    <video :src="item"
                                           style="height: 50px;width: 50px;border-radius: 5px;margin-right: 5px"
                                    ></video>
                                    <el-image
                                            style="position:absolute;height: 30px;width: 30px;
                                        border-radius: 5px;margin-right: 5px;left: 10px;top: 10px;cursor:pointer"
                                            src="statics/img/mall/diy/play.png"
                                            @click="playVideo(item)"
                                    ></el-image>
                                </div>
                            </template>
                            <template v-else-if="info.key === 'img_upload' || info.key === 'uimage'">
                                <el-image v-for="img in info.value"
                                          :preview-src-list="[img]"
                                          :src="img"
                                          style="height: 50px;width: 50px;border-radius: 5px;margin-right: 5px"
                                ></el-image>
                            </template>
                            <template v-else-if="info.key === 'calendar'">
                                <div v-if="info.value.before && info.value.after">
                                    {{info.value.before}}~{{info.value.after}}
                                </div>
                                <div v-else-if="info.value.fulldate">{{info.value.fulldate}}</div>
                                <div v-else>{{info.value ? info.value : '未填写'}}</div>
                            </template>
                            <template v-else-if="info.key === 'calendar'">
                                <div v-if="info.value.before && info.value.after">
                                    {{info.value.before}}~{{info.value.after}}
                                </div>
                                <div v-else-if="info.value.fulldate">{{info.value.fulldate}}</div>
                                <div v-else>{{info.value ? info.value : '未填写'}}</div>
                            </template>
                            <template v-else-if="info.key === 'menu'">

                                <div v-if="info.value.type == 'date' && info.value.begin_at && info.value.end_at">
                                    {{info.value.begin_at}}~{{info.value.end_at}}
                                </div>
                                <div v-else-if="info.value.type == 'date' && info.value.alone_at">
                                    {{info.value.alone_at}}
                                </div>
                                <div v-else>{{info.value.text ? info.value.text : '未填写'}}</div>
                            </template>
                            <template v-else-if="info.key === 'agreement'">
                                {{info.value.is_check ? '已同意' : '未同意'}}
                                <el-button size="mini" style="padding:3px 16px;margin-left: 10px" type="primary"
                                           @click="openAgreement(info.value.content)">查看
                                </el-button>
                            </template>
                            <template v-else-if="info.key === 'phone'">
                                {{info.value ? info.value.mobile : '未验证'}}
                            </template>
                            <template v-else-if="info.key === 'switch'">
                                {{info.value ? '开启' : '关闭'}}
                            </template>
                            <template v-else-if="info.key === 'input'">
                                {{info.value.text ? info.value.text : '未填写'}}
                            </template>
                            <template v-else-if="info.key === 'number-in'">
                                {{info.value ? info.value : '未填写'}}
                            </template>
                            <template v-else-if="info.key === 'select'">
                                {{info.value.length ? info.value.join(';') : '未填写'}}
                            </template>
                            <div v-else>{{info.value ? info.value : '未填写'}}</div>
                        </div>
                        <div v-else-if="info.key === 'form-button'"></div>
                        <div v-else>{{info.value ? info.value : '未填写'}}</div>
                    </el-col>
                </el-row>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    Vue.component('goods-form', {
        template: '#goods-form',
        props: {
            detailId: [Number, String],
        },
        data() {
            return {
                formData: {},
                dialogTableVisible: false,
                videoForm: {
                    status: false,
                    src: '',
                },
                agreementForm: {
                    status: false,
                    html: '',
                },
                form_show: true,
            }
        },
        methods: {
            calcPrice(price, num){
                price = price * num;
                price = price.toFixed(3).toLocaleString();
                price = price.substr(0, price.length - 1);
                return price;
            },
            playVideo(e) {
                this.videoForm = {status: true, src: e};
            },
            openAgreement(data) {
                this.agreementForm = {status: true, html: data}
            },
            showForm() {
                this.form_show = !this.form_show;
            },
            getData() {
                request({
                    params: {
                        r: 'mall/order/customization',
                        order_detail_id: this.detailId,
                    },
                }).then(e => {
                    if (e.data.code === 0) {
                        this.formData = e.data.data;
                        this.dialogTableVisible = true;
                    } else {
                        this.$message({
                            message: e.data.msg,
                            type: 'warning'
                        });
                    }
                });
            },
        },
    });
</script>

