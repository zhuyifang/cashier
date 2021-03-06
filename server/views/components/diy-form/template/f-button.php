<style>
    .f-button .f-c-box {
        margin-top: 12px;
        min-width: 450px;
        padding: 20px 40px 10px 0;
        border-radius: 13px;
        background: #F3F3F3;
    }

    .f-button .f-c-box.left {
        padding-left: 40px;
    }

    .f-button .f-c-box .f-c-box-white {
        background: white;
        margin-top: 12px;
        border: 1px solid #E5E7EC;
        border-radius: 5px;
        padding: 20px 20px 10px 10px;
    }

    .f-button .f-c-box .f-c-box-white .f-label:before {
        font-size: 16px;
        font-weight: bold;
        color: #242424;
    }

    .f-button .f-c-box .f-c-box-white .f-label {
        font-size: 16px;
        font-weight: bold;
        padding-left: 25px;
        color: #242424;
    }
</style>
<?php
defined('YII_ENV') or exit('Access Denied');
Yii::$app->loadViewComponent('app-select-member');
Yii::$app->loadViewComponent('goods/app-select-card');
Yii::$app->loadViewComponent('goods/app-select-coupon');
Yii::$app->loadViewComponent('goods/app-goods-share');
Yii::$app->loadViewComponent('goods/app-attr');


$permission = \Yii::$app->branch->childPermission(\Yii::$app->mall->user->adminInfo);
$is_pond_show = array_search('pond', $permission) !== false;
$is_scratch_show = array_search('scratch', $permission) !== false;
$is_vip_card_show = array_search('vip_card', $permission) !== false;
$is_coupon_show = array_search('coupon', $permission) !== false;
$is_plugin_show = array_search('pond', $permission) !== false || array_search('scratch', $permission) !== false;

?>
<style>

    .f-button .yuan {
        display: flex;
        flex-grow: 0;
        flex-shrink: 0;
        height: 32px;
        width: 32px;
        border-radius: 50%;
        margin-right: 10px;
        border: 1px solid #E5E7EC;
    }

    .f-button .yuan.active {
        border-color: #ff4544;
        background: #ff4544;
        position: relative;
    }

    .f-button .yuan.active:after {
        box-sizing: content-box;
        content: "";
        border: 1px solid white;
        border-left: 0;
        border-top: 0;
        height: 14px;
        left: 10px;
        position: absolute;
        top: 4px;
        transform: rotate(45deg);
        width: 6px;
        transition: transform .15s ease-in .05s;
        transform-origin: center;
    }

    .f-button .btn-much {
        margin-top: 38px;
    }

    .f-button .btn-much:first-child {
        margin-top: 0;
    }


    .f-button .b-box {
        margin-top: 18px;
        margin-bottom: 56px;
    }

    .f-button .b-price {
        font-size: 28px;
        font-weight: bold;
        color: #242424;

    }

    .f-button .b-label {
        margin-right: 10px;
        font-size: 28px;
        color: #242424;
        max-width: 400px;
    }

    .f-button .update-btn {
        height: 40px;
        width: 40px;
        margin-left: auto;
        margin-bottom: 18px;
    }

    .button-r-close {
        background: #99A1AA;
        height: 18px;
        width: 18px;
        line-height: 18px;
        color: #FFFFFF;

        border-radius: 50%;
        text-align: center;
        position: absolute;
        cursor: pointer;
        font-size: 12px;
        right: -6px;
        top: -9px;
        vertical-align: middle;
    }

    .button-r-close:before {
        content: "\e6db";
    }

    .f-button .t-omit-two {
        /*
            ??????????????????????????????
            ??????:???flex????????????????????????????????????
        */
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        white-space: normal !important;
    }


    .f-button .el-form-item__label {
        padding-right: 25px !important;
        width: 130px !important;
    }
    .f-button .el-form-item__content {
        margin-left: 130px !important;
    }

    .button-dialog-model .el-form-item__label {
        padding-right: 5px !important;
        width: 150px !important;
    }

    .button-dialog-model .el-form-item__content {
        margin-left: 150px !important;
    }

    .yuan-input {
        width: 80px;
        height: 48px;
        margin: 0 6px;
        background: #F7F7F7;
        border-right: 8px;
        font-size: 24px;
        color: #242424;
    }

    .yuan-icon {
        background-size: 100% 100%;
        background-repeat: no-repeat;
        width: 48px;
        height: 48px;
        border-radius: 8px;
    }

    .yuan-num {
        font-size: 24px;
    }
</style>
<template id="f-button">
    <div class="f-button">
        <div class="diy-component-preview">
            <div :style="[boxStyle]">
                <div v-if="data.is_pay == 1" :style="{padding: `0 ${data.box_padding}px`}">
                    <div flex="dir:left cross:center main:between">
                        <div class="_diy-form-label"
                             :style="{color: data.title_color,padding:0}"
                             :class="{required: data.is_required}">
                            {{ data.title }}
                        </div>
                        <div class="update-btn box-grow-0" v-if="data.pay_update == 1 && data.pay_status === 'alone'">
                            <el-image style="height: 40px;width: 40px;display: block"
                                      :src="data.pay_update_icon"></el-image>
                        </div>
                    </div>
                    <div class="b-box">
                        <div v-if="data.pay_status === 'alone'" flex="dir:top">

                            <div flex="dir:left cross:center" style="width: 100%">
                                <div flex style="flex-grow: 1;flex-shrink: 1">
                                    <div v-if="data.pay_status === 'alone'" :style="{color: data.label_color}"
                                         class="b-label t-omit-two">
                                        {{data.pay_title}}
                                    </div>
                                </div>
                                <div class="b-price" :style="{color: data.label_color}">{{ data.pay_price > 0 ? '???' + data.pay_price : '??????' }}</div>
                            </div>
                            <div flex="dir:left cross:center main:justify" style="margin-top: 20px"
                                 v-if="data.has_stock == 1">
                                <div class="yuan-num" :style="{color: data.label_color}">
                                    ??????
                                    <template v-if="data.has_limit_stock_num == 0">
                                        ?????????{{data.stock_num}}{{data.goods_unit}}???
                                    </template>
                                </div>

                                <div flex="dir:left cross:center">
                                    <div :style="{backgroundImage: `url( data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8AQMAAAAAMksxAAAABlBMVEX39/eZmZmXx6vxAAAAFElEQVQoz2MY2aD+//8H+BgjGgAAMQANdT7AwNcAAAAASUVORK5CYII=)`}"
                                         class="yuan-icon"
                                    ></div>
                                    <div class="yuan-input">
                                        <div style="color: #242424;font-size: 24px;height: 100%;width:100%;text-align: center"
                                             flex="main:center cross:center"
                                        >1
                                        </div>
                                    </div>
                                    <div :style="{backgroundImage: `url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8AQMAAAAAMksxAAAABlBMVEX39/eZmZmXx6vxAAAAGklEQVQoz2MYzICf5oz6//8f4GHQ3hmDGQAAjcAOv+IPUVgAAAAASUVORK5CYII=)`}"
                                         class="yuan-icon"
                                    ></div>
                                </div>
                            </div>
                        </div>

                        <div v-if="data.pay_status === 'much'" style="width: 100%">
                            <div v-for="(item,index) in data.pay_price_list" :key="index"
                                 class="btn-much" flex="dir:top">
                                <div flex="dir:left cross:center">
                                    <div class="yuan" :class="{active: selectMultIndex === index}"
                                         @click="selectMultIndex = index"
                                         style="cursor: pointer"
                                         :style="{borderColor: selectMultIndex === index ? data.select_bg: data.noselect_bg,
                                         background: selectMultIndex === index? data.select_bg: 'inherit'}"
                                    ></div>
                                    <div flex style="flex-grow: 1;flex-shrink: 1">
                                        <div class="b-label t-omit-two" :style="{color: data.label_color}">
                                            {{ item.title }}
                                        </div>
                                    </div>
                                    <div class="b-price" :style="{color: data.label_color}">{{ item.pay_price > 0 ? '???' + item.pay_price : '??????' }}
                                    </div>
                                </div>

                                <div flex="dir:left cross:center main:justify"
                                     style="margin-top: 20px"
                                     v-if="selectMultIndex === index && data.has_stock == 1">
                                    <div :style="{color: data.label_color}" class="yuan-num" style="margin-left:52px">
                                        ??????
                                        <template v-if="data.has_limit_stock_num == 0">
                                            ?????????{{item.stock_num}}{{data.goods_unit}}???
                                        </template>
                                    </div>
                                    <div flex="dir:left cross:center">
                                        <div
                                                :style="{backgroundImage: `url( data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8AQMAAAAAMksxAAAABlBMVEX39/eZmZmXx6vxAAAAFElEQVQoz2MY2aD+//8H+BgjGgAAMQANdT7AwNcAAAAASUVORK5CYII=)`}"
                                                class="yuan-icon"></div>
                                        <div class="yuan-input">
                                            <div style="color: #242424;font-size: 24px;height: 100%;width:100%;text-align: center"
                                                 flex="main:center cross:center"
                                            >1</div>
                                        </div>
                                        <div
                                                :style="{backgroundImage: `url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8AQMAAAAAMksxAAAABlBMVEX39/eZmZmXx6vxAAAAGklEQVQoz2MYzICf5oz6//8f4GHQ3hmDGQAAjcAOv+IPUVgAAAAASUVORK5CYII=)`}"
                                                class="yuan-icon"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div flex="main:center cross:center" :style="btnStyle">
                    {{data.btn_title}}
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <div>
                <div class="app-form-title">
                    <div>????????????</div>
                </div>
                <el-form ref="data" :model="data" label-width="120px" size="small" style="padding: 20px 0">
                    <el-form-item label="????????????">
                        <el-input v-model="data.btn_title"
                                  size="small"
                                  placeholder="?????????????????????"
                                  maxlength="10"
                                  show-word-limit
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="??????????????????">
                        <el-switch @change="ldon" v-model="data.is_pay" :active-value="1" :inactive-value="0"></el-switch>
                        <div class="f-c-box" v-if="data.is_pay == 1">
                            <el-form-item label="????????????">
                                <el-input v-model="data.title"
                                          size="small"
                                          placeholder="?????????????????????"
                                          maxlength="10"
                                          show-word-limit
                                ></el-input>
                            </el-form-item>
                            <el-form-item label="??????">
                                <app-radio @change="ldon" v-model="data.pay_status" label="alone" turn>????????????</app-radio>
                                <app-radio @change="ldon" v-model="data.pay_status" label="much" turn>????????????</app-radio>
                            </el-form-item>
                            <template v-if="data.pay_status === 'alone'">
                                <el-form-item label="????????????">
                                    <app-radio v-model="data.has_limit_stock_num" :label="0" turn>????????????</app-radio>
                                    <app-radio v-model="data.has_limit_stock_num" :label="1" turn>????????????</app-radio>
                                </el-form-item>
                                <el-form-item label="????????????">
                                    <el-input v-model="data.pay_title" size="small"
                                              placeholder="?????????????????????"></el-input>
                                    <div flex="dir:left cross:center" style="margin-top: 10px">
                                        <el-input-number v-model="data.pay_price" :precision="2"
                                                         :min="0.01"
                                                         :step="1"
                                                         :max="9999999"
                                        ></el-input-number>
                                        <span style="margin-left: 10px">???</span>
                                    </div>
                                </el-form-item>
                                <el-form-item label="????????????">
                                    <app-radio v-model="data.has_stock" :label="1" turn>??????</app-radio>
                                    <app-radio v-model="data.has_stock" :label="0" turn>??????</app-radio>
                                </el-form-item>
                                <el-form-item label="????????????" v-if="data.has_limit_stock_num == 0">
                                    <el-input-number v-model="data.stock_num"
                                                     :precision="0"
                                                     @change="ldon"
                                                     style="margin-right: 57px"
                                                     :min="0"
                                                     :step="1"
                                                     :max="9999999"
                                    ></el-input-number>
                                </el-form-item>
                                <el-form-item v-if="data.has_stock == 1" label="????????????">
                                    <el-input placeholder="?????????????????????" v-model="data.goods_unit" size="small" maxlength="1"
                                              show-word-limit></el-input>
                                </el-form-item>
                                <el-form-item label="????????????">
                                    <el-checkbox-group v-model="data.discount_type">
                                        <el-checkbox v-if="is_coupon_show" label="coupon">?????????</el-checkbox>
                                        <el-checkbox label="integral">??????</el-checkbox>
                                        <el-checkbox v-if="is_vip_card_show" label="vip-card">???????????????</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <template v-if="data.discount_type.indexOf('integral') !== -1">
                                    <el-form-item label="????????????">
                                        <div flex="dir:left cross:center">
                                            <div style="display:flex;flex-grow:0;flex-shrink:0;padding-right: 10px;color:#545B60">
                                                ????????????
                                            </div>
                                            <div style="width: 100%">
                                                <el-input v-model="data.integral_max"
                                                          size="small"
                                                          style="width: 100%"
                                                          oninput="this.value = this.value.match(/[1-9]\d*|/)"
                                                          placeholder="?????????????????????"
                                                >
                                                    <template slot="append">??????</template>
                                                </el-input>
                                            </div>
                                        </div>
                                    </el-form-item>
                                    <el-form-item label="????????????">
                                        <el-checkbox v-model="data.integral_diejia"
                                                     class="f-label"
                                                     :true-label="1"
                                                     :false-label="0">????????????
                                        </el-checkbox>
                                    </el-form-item>
                                </template>
                                <el-form-item label="?????????">
                                    <el-button size="small" @click="openMember" plain>???????????????</el-button>
                                </el-form-item>
                                <el-form-item label="?????????">
                                    <el-button size="small" @click="openShare" plain>???????????????</el-button>
                                </el-form-item>
                                <el-form-item label="????????????">
                                    <el-checkbox v-model="data.pay_update" :true-label="1" :false-label="0">????????????????????????
                                    </el-checkbox>
                                </el-form-item>
                                <el-form-item v-if="data.pay_update" label="????????????">
                                    <app-image-upload width="80" height="80"
                                                      v-model="data.pay_update_icon"
                                    ></app-image-upload>
                                </el-form-item>
                                <el-form-item label="?????????????????????" v-if="calcCalendar && calcCalendar.length">
                                    <el-switch v-model="data.has_calendar" :active-value="1" :inactive-value="0"></el-switch>
                                </el-form-item>
                                <el-form-item v-if="calcCalendar && calcCalendar.length && data.has_calendar == 1">
                                    <label slot="label">??????????????????
                                        <el-tooltip class="item" effect="dark"
                                                    content="???????????? X ???????????? X ?????? = ????????????"
                                                    placement="top">
                                            <i class="el-icon-info"></i>
                                        </el-tooltip>
                                    </label>

                                    <el-select style="width:100%" v-model="data.calendar_key" size="small" placeholder="?????????">
                                        <el-option
                                                v-for="item in calcCalendar"
                                                :key="item.value"
                                                :label="item.label"
                                                :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </template>

                            <template v-if="data.pay_status === 'much'">
                                <el-form-item label="????????????">
                                    <app-radio v-model="data.has_limit_stock_num" :label="0" turn>????????????</app-radio>
                                    <app-radio v-model="data.has_limit_stock_num" :label="1" turn>????????????</app-radio>
                                </el-form-item>
                            </template>
                            <div v-if="data.pay_status === 'much'" v-for="(i,index) of data.pay_price_list">
                                <el-form-item :label="`??????${index + 1}`">
                                    <el-input v-model="i.title" size="small" placeholder="?????????????????????"></el-input>
                                    <div flex="dir:left cross:center" style="margin-top: 10px">
                                        <el-input-number v-model="i.pay_price" :precision="2"
                                                         :min="0"
                                                         :step="1"
                                                         :max="9999999"
                                        ></el-input-number>
                                        <span style="margin-left: 10px">???</span>
                                    </div>
                                </el-form-item>
                                <el-form-item label="????????????" v-if="data.has_limit_stock_num == 0">
                                    <el-input-number v-model="i.stock_num"
                                                     :precision="0"
                                                     style="margin-right: 57px"
                                                     :min="0"
                                                     :step="1"
                                                     @change="ldon"
                                                     :max="9999999"
                                    ></el-input-number>
                                </el-form-item>
                                <div flex="dir:left cross:center main:right"
                                     style="margin-bottom: 12px;margin-top: -5px;">
                                    <el-image style="display:block;height:30px;width:30px;cursor: pointer"
                                              @click="payPriceAdd"
                                              v-if="index <6 && data.pay_price_list.length == index + 1"
                                              src="statics/img/mall/form/tianjia.png"
                                    ></el-image>
                                    <el-image
                                            style="display:block;height:30px;width:30px;margin-left: 5px;cursor: pointer"
                                            v-if="data.pay_price_list.length > 1"
                                            @click="payPriceDelete(index)"
                                            src="statics/img/mall/form/del.png"
                                    ></el-image>
                                </div>
                            </div>
                            <template v-if="data.pay_status === 'much'">
                                <el-form-item label="????????????">
                                    <app-radio v-model="data.has_stock" :label="1" turn>??????</app-radio>
                                    <app-radio v-model="data.has_stock" :label="0" turn>??????</app-radio>
                                </el-form-item>
                                <el-form-item v-if="data.has_stock == 1" label="????????????">
                                    <el-input placeholder="?????????????????????" v-model="data.goods_unit" size="small" maxlength="1"
                                              show-word-limit></el-input>
                                </el-form-item>
                                <el-form-item label="????????????">
                                    <el-checkbox-group v-model="data.discount_type">
                                        <el-checkbox label="coupon">?????????</el-checkbox>
                                        <el-checkbox label="integral">??????</el-checkbox>
                                        <el-checkbox label="vip-card">???????????????</el-checkbox>
                                    </el-checkbox-group>
                                </el-form-item>
                                <template v-if="data.discount_type.indexOf('integral') !== -1">
                                    <el-form-item label="????????????">
                                        <div flex="dir:left cross:center">
                                            <div style="display:flex;flex-grow:0;flex-shrink:0;padding-right: 10px;color:#545B60">
                                                ????????????
                                            </div>
                                            <div style="width: 100%">
                                                <el-input v-model="data.integral_max"
                                                          size="small"
                                                          style="width: 100%"
                                                          oninput="this.value = this.value.match(/[1-9]\d*|/)"
                                                          placeholder="?????????????????????"
                                                >
                                                    <template slot="append">??????</template>
                                                </el-input>
                                            </div>
                                        </div>
                                    </el-form-item>
                                    <el-form-item label="????????????">
                                        <el-checkbox v-model="data.integral_diejia"
                                                     class="f-label"
                                                     :true-label="1"
                                                     :false-label="0">????????????
                                        </el-checkbox>
                                    </el-form-item>
                                </template>
                                <el-form-item label="?????????">
                                    <el-button size="small" @click="openMember" plain>???????????????</el-button>
                                </el-form-item>
                                <el-form-item label="?????????">
                                    <el-button size="small" @click="openShare" plain>???????????????</el-button>
                                </el-form-item>
                                <el-form-item label="?????????????????????" v-if="calcCalendar && calcCalendar.length">
                                    <el-switch v-model="data.has_calendar" :active-value="1" :inactive-value="0"></el-switch>
                                </el-form-item>
                                <el-form-item v-if="calcCalendar && calcCalendar.length && data.has_calendar == 1">
                                    <label slot="label">??????????????????
                                        <el-tooltip class="item" effect="dark"
                                                    content="???????????? X ???????????? X ?????? = ????????????"
                                                    placement="top">
                                            <i class="el-icon-info"></i>
                                        </el-tooltip>
                                    </label>

                                    <el-select style="width:100%" v-model="data.calendar_key" size="small" placeholder="?????????">
                                        <el-option
                                                v-for="item in calcCalendar"
                                                :key="item.value"
                                                :label="item.label"
                                                :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </template>
                        </div>
                    </el-form-item>
                    <el-form-item label="?????????">
                        <el-switch v-model="data.before_status" :active-value="1" :inactive-value="0"></el-switch>
                        <div v-if="data.before_status == 1"
                             class="f-c-box left"
                             style="padding-bottom: 25px">
                            <div flex="dir:left cross:center">
                                <div style="color: #545B60;font-size: 14px;margin-right: 24px">????????????</div>
                            </div>
                            <el-input v-if="data.before_status == 1" v-model="data.before_text"
                                      size="small"></el-input>
                        </div>
                    </el-form-item>
                    <el-form-item label="?????????">
                        <el-switch v-model="data.after_trigger" active-value="event"
                                   inactive-value="none"></el-switch>
                        <div v-if="data.after_trigger === 'event'" class="f-c-box left">
                            <div flex="dir:left cross:center">
                                <div style="color: #545B60;font-size: 14px;margin-right: 24px">????????????</div>
                            </div>
                            <div v-if="data.after_trigger === 'none'" style="padding-bottom: 15px"></div>
                            <!-- ???????????? -->
                            <div v-if="data.after_trigger === 'event'" class="f-c-box-white">
                                <div flex="dir:left cross:center" style="padding-bottom: 20px">
                                    <el-checkbox v-model="data.after_send_status"
                                                 class="f-label"
                                                 :true-label="1"
                                                 :false-label="0">????????????
                                    </el-checkbox>
                                </div>
                                <template v-if="data.after_send_status == 1">
                                    <el-form-item label="??????">
                                        <el-checkbox-group v-model="data.after_send_type">
                                            <el-checkbox v-for="r of reward"
                                                         :label="r.value">
                                                {{r.label}}
                                            </el-checkbox>
                                        </el-checkbox-group>
                                    </el-form-item>
                                    <el-form-item label="????????????"
                                                  v-if="is_plugin_show && data.after_send_type.indexOf(32) !== -1">
                                        <app-radio v-if="is_pond_show" v-model="data.after_send_plugin"
                                                   label="pond"
                                                   turn>?????????
                                        </app-radio>
                                        <app-radio v-if="is_scratch_show" v-model="data.after_send_plugin"
                                                   label="scratch" turn>?????????
                                        </app-radio>
                                    </el-form-item>
                                    <el-form-item label="????????????"
                                                  v-if="is_plugin_show && data.after_send_type.indexOf(32) !== -1">
                                        <el-input-number v-model="data.after_send_lottery_limit"
                                                         size="small"
                                                         :precision="0"
                                                         :step="1"
                                                         :min="1"
                                                         :max="9999999"
                                                         oninput="this.value = this.value.match(/[1-9]\d*|/)"
                                        ></el-input-number>
                                    </el-form-item>
                                    <el-form-item label="????????????" v-if="data.after_send_type.indexOf(1) !== -1">
                                        <el-input-number v-model="data.after_send_price"
                                                         size="small"
                                                         :precision="2"
                                                         :step="1"
                                                         :min="0.01"
                                                         :max="9999999"
                                                         oninput="this.value = this.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')"
                                        ></el-input-number>
                                    </el-form-item>
                                    <el-form-item label="????????????" v-if="data.after_send_type.indexOf(2) !== -1">
                                        <el-input-number v-model="data.after_send_integral"
                                                         size="small"
                                                         :precision="0"
                                                         :step="1"
                                                         :min="1"
                                                         :max="9999999"
                                                         oninput="this.value = this.value.match(/[1-9]\d*|/)"
                                        ></el-input-number>
                                    </el-form-item>
                                    <el-form-item label="????????????" v-if="data.after_send_type.indexOf(4) !== -1">
                                        <div flex="dir:left cross:center">
                                            <span v-if="data.after_send_member_id"
                                                  style="position: relative;display: inline-block; margin-right: 15px;line-height: 1">
                                                <el-tag :disable-transitions="true"
                                                        style="max-width: 300px;overflow:hidden;text-overflow:ellipsis">
                                                   {{data.after_send_member_name}}
                                                </el-tag>
                                                <div @click="closeMember"
                                                     class="el-icon-r-close button-r-close"></div>
                                            </span>
                                            <div style="display: inline-block;position: relative;">
                                                <app-select-member v-model="data.after_send_member_id"
                                                                   @change="changeSendMemberId">
                                                    <el-button type="small">??????????????????</el-button>
                                                </app-select-member>
                                            </div>
                                        </div>
                                    </el-form-item>

                                    <el-form-item label="???????????????" v-if="data.after_send_type.indexOf(8) !== -1 && is_coupon_show">
                                        <div flex="dir:left cross:center" style="flex-wrap: wrap">
                                            <span v-for="(coupon, index) in data.after_send_coupon" :key="index"
                                                  style="position: relative;margin:2px 15px 2px 0;display: inline-block;line-height: 1">
                                            <el-tag :disable-transitions="true"
                                                    style="max-width: 300px;overflow:hidden;text-overflow:ellipsis">
                                                {{coupon.send_num}}??? | {{coupon.name}}
                                            </el-tag>
                                            <div @click="couponDelete(index)"
                                                 class="el-icon-r-close button-r-close"></div>
                                        </span>
                                            <div style="display: inline-block;position: relative;">
                                                <app-select-coupon v-model="data.after_send_coupon" @select="couponSubmit">
                                                    <el-button style="background-color: white;color:#409EFF"
                                                               type="primary"
                                                               size="mini" plain>??????
                                                    </el-button>
                                                </app-select-coupon>
                                            </div>
                                        </div>
                                    </el-form-item>
                                    <el-form-item label="????????????" v-if="data.after_send_type.indexOf(16) !== -1">
                                        <div flex="dir:left cross:center" style="flex-wrap: wrap">
                                        <span v-for="(card, index) in data.after_send_card" :key="index"
                                              style="position: relative;margin:2px 15px 2px 0;display: inline-block;line-height: 1">
                                            <el-tag :disable-transitions="true"
                                                    style="max-width: 300px;overflow:hidden;text-overflow:ellipsis">
                                                   {{card.num}}??? | {{card.name}}
                                            </el-tag>
                                            <div @click="cardDelete(index)"
                                                 class="el-icon-r-close button-r-close"></div>
                                        </span>
                                            <div style="display: inline-block;position: relative;">
                                                <el-button style="background-color: white;color:#409EFF" type="primary"
                                                           @click="cardDialogVisible = true"
                                                           size="mini" plain>??????
                                                </el-button>
                                            </div>
                                        </div>
                                    </el-form-item>
                                </template>
                            </div>
                            <!-- ???????????? -->
                            <div v-if="data.after_trigger === 'event'" class="f-c-box-white">
                                <div flex="dir:left cross:center" style="padding-bottom: 20px">
                                    <el-checkbox v-model="data.after_jump_status"
                                                 class="f-label"
                                                 :true-label="1"
                                                 :false-label="0">????????????
                                    </el-checkbox>
                                </div>
                                <template v-if="data.after_jump_status == 1">
                                    <el-form-item label="?????????">
                                        <app-pick-link @selected="onSelectLink" :show-customer="false" :link="data.after_jump_link ? (data.after_jump_link.link ? data.after_jump_link.link : {url: data.after_jump_link.name}) : {}">
                                        </app-pick-link>
<!--                                        <div v-if="data.after_jump_link" flex="dir:left cross:center"-->
<!--                                             style="margin-top: -10px">-->
<!--                                            <div flex="dir:left cross:center"-->
<!--                                                 style="padding:0 20px;margin-right:11px;border: 1px solid #E5E7EC;border-radius: 3px;">-->
<!--                                                <el-image style="height: 22px;width: 22px"-->
<!--                                                          :src="data.after_jump_link.icon"></el-image>-->
<!--                                                <div style="font-size: 14px;color: #242424;margin-left: 4px">-->
<!--                                                    {{data.after_jump_link.name}}-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <app-pick-link @selected="onSelectLink" >-->
<!--                                                <el-image style="height:30px;width:30px;margin-top: 10px;cursor: pointer"-->
<!--                                                          :src="_currentPluginBaseUrl +'/images/form/edit.png'"-->
<!--                                                ></el-image>-->
<!--                                            </app-pick-link>-->
<!--                                        </div>-->
<!--                                        <div v-else>-->
<!--                                            <app-pick-link @selected="onSelectLink">-->
<!--                                                <el-button type="primary" plain>?????????</el-button>-->
<!--                                            </app-pick-link>-->
<!--                                        </div>-->
                                    </el-form-item>
                                </template>
                            </div>
                        </div>
                    </el-form-item>


                    <el-form-item label="????????????" class="mess">
                        <el-switch v-model="data.message_status"
                                   :active-value="1"
                                   :inactive-value="0"
                        ></el-switch>
                        <div v-if="data.message_status == 1" class="f-c-box left">
                            <div style="background: white;padding: 20px;margin:0 -20px">
                                <div style="font-size: 14px;font-weight: bold;color: #242424">????????????
                                </div>
                                <div>
                                    <el-checkbox v-model="data.m_subscribe"
                                                 :true-label="1"
                                                 :false-label="0">
                                        ????????????????????????????????????????????????????????????
                                    </el-checkbox>
                                    <div v-if="data.m_subscribe == 1" style="padding:0 20px">
                                        <el-form-item label="??????" class="mess" style="margin-top: 12px">
                                            <el-input
                                                    :rows="2"
                                                    placeholder="?????????????????????"
                                                    maxlength="20"
                                                    show-word-limit
                                                    v-model="data.m_subscribe_content">
                                            </el-input>
                                        </el-form-item>
                                        <el-form-item label="??????????????????" class="mess">
                                            <app-pick-link @selected="onSubscribe" :show-customer="false" :link="data.m_subscribe_link ? (data.m_subscribe_link.link ? data.m_subscribe_link.link : {url: data.m_subscribe_link.name}) : {}">
                                            </app-pick-link>
<!--                                            <div v-if="data.m_subscribe_link" flex="dir:left cross:center"-->
<!--                                                 style="margin-top: -10px">-->
<!--                                                <div flex="dir:left cross:center"-->
<!--                                                     style="padding:0 20px;margin-right:11px;border: 1px solid #E5E7EC;border-radius: 3px;">-->
<!--                                                    <el-image style="height: 22px;width: 22px"-->
<!--                                                              :src="data.m_subscribe_link.icon"></el-image>-->
<!--                                                    <div style="font-size: 14px;color: #242424;margin-left: 4px">-->
<!--                                                        {{data.m_subscribe_link.name}}-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!---->
<!--                                                <app-pick-link @selected="onSubscribe">-->
<!--                                                    <el-image-->
<!--                                                            style="height:30px;width:30px;margin-top: 10px;cursor:pointer;"-->
<!--                                                            :src="_currentPluginBaseUrl +'/images/form/edit.png'"-->
<!--                                                    ></el-image>-->
<!--                                                </app-pick-link>-->
<!--                                            </div>-->
<!--                                            <div v-else>-->
<!--                                                <app-pick-link @selected="onSubscribe">-->
<!--                                                    <el-button type="primary" plain>?????????</el-button>-->
<!--                                                </app-pick-link>-->
<!--                                            </div>-->
                                        </el-form-item>
                                    </div>
                                </div>
                                <el-checkbox v-model="data.m_sms"
                                             :true-label="1"
                                             :false-label="0">
                                    ????????????????????????????????????????????????????????????????????????
                                </el-checkbox>
                                <div style="padding:0 20px" v-if="data.m_sms==1">
                                    <el-form-item label="??????ID" class="mess" style="margin-top: 12px;margin-bottom: 0">
                                        <el-input type="input" placeholder="???????????????ID"
                                                  v-model="data.m_sms_tempid"></el-input>
                                        <span style="color:#ff4544;font-size: 10px">??????????????????"
                                            <el-button type="text" @click="$navigate({r:'mall/sms/setting'}, true)">????????????-????????????</el-button>
                                                    ",????????????
                                        </span>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="f-c-box" style="padding:0 0 10px 0"
                                 v-if="data.m_sms == 1 || data.m_subscribe == 1">
                                <div style="background: white;padding: 20px;margin:0 -20px">
                                    <div style="font-size: 14px;font-weight: bold;color: #242424;">
                                        ????????????
                                    </div>
                                    <app-radio v-model="data.m_send_type" label="submit" turn>?????????????????????</app-radio>
                                    <app-radio v-model="data.m_send_type" label="date" turn>????????????</app-radio>
                                    <div v-if="data.m_send_type === 'date'">
                                        <el-date-picker
                                                style="width: 100%;margin-top: 5px"
                                                v-model="data.m_send_date"
                                                format="yyyy-MM-dd HH:mm"
                                                value-format="yyyy-MM-dd HH:mm"
                                                type="datetime"
                                                :picker-options="pickerOptions"
                                                placeholder="??????????????????">
                                        </el-date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </el-form-item>

                    <el-form-item label="??????????????????">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.btn_height" style="width: 100%" size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="??????????????????">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.btn_padding" style="width: 100%" size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="??????????????????">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.btn_radius" style="width: 100%" size="small" :max="50"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <el-form-item label="??????????????????" v-if="data.is_pay == 1">
                        <div flex="dir:left cross:center">
                            <el-slider :show-tooltip="false" v-model="data.box_padding" style="width: 100%" size="small"
                                       show-input></el-slider>
                            <div style="margin-left: 5px">px</div>
                        </div>
                    </el-form-item>
                    <div class="app-form-box-label">
                        ????????????
                    </div>
                    <div flex="dir:left" style="flex-wrap: wrap;width: 555px">
                        <el-form-item label="??????????????????">
                            <color v-model="data.btn_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????">
                            <color v-model="data.btn_bg"></color>
                        </el-form-item>
                        <el-form-item label="??????????????????">
                            <color v-model="data.btn_border_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????">
                            <color v-model="data.bg_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????" v-if="data.is_pay == 1">
                            <color v-model="data.title_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????" v-if="data.is_pay == 1">
                            <color v-model="data.label_color"></color>
                        </el-form-item>
                        <el-form-item label="????????????" v-if="data.is_pay == 1 && data.pay_status === 'much'">
                            <color v-model="data.select_bg"></color>
                        </el-form-item>
                        <el-form-item label="????????????" v-if="data.is_pay == 1 && data.pay_status === 'much'">
                            <color v-model="data.noselect_bg"></color>
                        </el-form-item>
                    </div>
            </div>
        </div>

        <el-dialog title="???????????????" :visible.sync="memberVisible" width="30%">
            <el-form class="button-dialog-model" label-width="200px" size="small" :model="memberForm"
                     :rules="memberRules" v-if="memberForm">
                <el-form-item label="????????????????????????" prop="is_level">
                    <el-switch :active-value="1" :inactive-value="0" v-model="memberForm.is_level">
                    </el-switch>
                </el-form-item>
                <template v-if="memberForm.is_level == 1">
                    <el-form-item label="???????????????????????????" prop="is_level_alone">
                        <el-switch :active-value="1" :inactive-value="0" v-model="memberForm.is_level_alone">
                        </el-switch>
                    </el-form-item>
                    <template v-if="memberForm.is_level_alone == 1">
                        <!-- ???????????????????????? -->
                        <template v-if="data.pay_status == 'much' && memberLevel.length > 0">
                            <el-form-item label="???????????????">
                                <app-attr v-model="memberForm.attr" :attr-groups="attrGroups"
                                          :members="memberLevel" :is-level="true"></app-attr>
                            </el-form-item>
                        </template>
                        <!-- ???????????????????????? -->
                        <template v-if="data.pay_status == 'alone' && memberLevel.length > 0">
                            <el-form-item label="???????????????????????????">
                                <el-col :xl="12" :lg="16">
                                    <el-input v-for="item in defaultMemberPrice" :key="item.id" type="number"
                                              style="margin-bottom: 18px"
                                              oninput="this.value = this.value.match(/^\d+(\.)?\d{0,2}/g)"
                                              v-model="memberForm.member_price[item.level]">
                                        <span slot="prepend">{{item.name}}</span>
                                        <span slot="append">???</span>
                                    </el-input>
                                </el-col>
                            </el-form-item>
                        </template>
                        <el-form-item v-if="memberLevel.length == 0" label="???????????????">
                            <el-button type="danger" @click="$navigate({r: 'mall/mall-member/edit'},true)">
                                ????????????,??????????????????
                            </el-button>
                        </el-form-item>
                    </template>
                </template>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="memberVisible = false" size="small">??????</el-button>
                <el-button @click="saveMember" type="primary" size="small">??????</el-button>
            </div>
        </el-dialog>
        <el-dialog title="???????????????" :visible.sync="shareVisible" width="30%">
            <el-form class="button-dialog-model" size="small" :model="shareForm" :rules="shareRules">
                <el-form-item label="????????????????????????" prop="individual_share">
                    <el-switch :active-value="1" :inactive-value="0" v-model="shareForm.individual_share">
                    </el-switch>
                </el-form-item>
                <template v-if="shareForm.individual_share == 1">
                    <el-form-item label="????????????" prop="attr_setting_type"
                                  v-if="data.pay_status == 'much'">
                        <el-radio v-model="shareForm.attr_setting_type" :label="0">????????????</el-radio>
                        <el-radio v-model="shareForm.attr_setting_type" :label="1">????????????</el-radio>
                    </el-form-item>
                    <el-form-item label="??????????????????" prop="share_type">
                        <el-radio v-model="shareForm.share_type" :label="0">????????????</el-radio>
                        <el-radio v-model="shareForm.share_type" :label="1">?????????</el-radio>
                    </el-form-item>
                    <app-goods-share v-model="shareForm" :is_mch="0" :attr-groups="attrGroups"
                                     :attr_setting_type="shareForm.attr_setting_type"
                                     :share_type="shareForm.share_type"
                                     :use_attr="data.pay_status == 'much' ? 1 : 0"
                    ></app-goods-share>
                </template>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="shareVisible = false" size="small">??????</el-button>
                <el-button size="small" type="primary" @click="saveShare">??????</el-button>
            </div>
        </el-dialog>
        <app-select-card :is-show="cardDialogVisible" :rule-form="ruleForm" @select="cardSubmit"></app-select-card>
    </div>
</template>

<script>
    Vue.component('f-button', {
        template: '#f-button',
        props: {
            value: [Object, null],
            allData: [Array, null],
        },
        created() {
            if (!this.value) {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
            }
        },
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            },
            allData: {
                deep: true,
                handler(newVal) {
                    if (newVal instanceof Array) {
                        let options = [];
                        newVal.forEach((item, index) => {
                            if (item['id'] === 'calendar') {
                                options.push({
                                    label: item.data.title,
                                    value: item.data.key,
                                })
                            }
                        })
                        this.$nextTick(() => {
                            if(!options.some(item => item.value === this.data.calendar_key)){
                                this.data.calendar_key = ''
                            }
                        })
                        this.calcCalendar = options;
                    } else {
                        return [];
                    }
                },
            },
        },
        data() {
            const reward = [{
                label: '??????',
                value: 1
            }, {
                label: '??????',
                value: 2,
            }, {
                label: '??????',
                value: 4,
            }].concat("<?= $is_coupon_show ?>" ? [
                {label: '?????????', value: 8}
            ] : []).concat([{label: '??????', value: 16}]).concat("<?= $is_pond_show || $is_scratch_show ?>" ? [
                {label: '??????', value: 32}
            ] : []);
            return {
                selectMultIndex: 0,
                calcCalendar: null,
                /////??????
                is_svip: true,//????????????????????????
                memberLevel: [],

                defaultMemberPrice: [],

                memberVisible: false,
                memberForm: {
                    is_level: 0,
                    member_price: {},
                    is_level_alone: 0,
                    attr: [],
                },


                memberRules: {},
                shareVisible: false,
                shareForm: {
                    shareLevelList: [],
                    individual_share: 0,
                    attr_setting_type: 0,
                    share_type: 0,
                    attr: [],
                },
                shareRules: {},
                /////??????
                pickerOptions: {
                    disabledDate(time) {
                        return time.getTime() < Date.now() - 24 * 60 * 60 * 1000
                    }
                },
                ruleForm: {
                    cards: [],
                },
                cardDialogVisible: false,

                is_coupon_show: "<?= $is_coupon_show ?>",
                is_pond_show: "<?= $is_pond_show?>",
                is_plugin_show: "<?= $is_plugin_show?>",
                is_scratch_show: "<?= $is_scratch_show?>",
                is_vip_card_show: "<?= $is_vip_card_show?>",

                reward,

                submitStatus: 'before',
                data: {
                    has_calendar: 0,
                    calendar_key: '',

                    title: '????????????',
                    is_pay: 0,
                    pay_status: 'alone',//much
                    pay_update: 0,
                    pay_update_icon: _appImg + 'button-update.png',
                    pay_title: '????????????',
                    btn_title: '??????',
                    pay_price: 0.01,
                    stock_num: 200,
                    has_limit_stock_num: 0,
                    has_stock: 1,
                    goods_unit: '???',
                    discount_type: ['coupon', 'integral', 'vip-card'],
                    integral_max: '',
                    integral_diejia: 0,

                    //?????????
                    is_level: 0,
                    member_price: {},
                    is_level_alone: 0,
                    //?????????
                    shareLevelList: [],
                    individual_share: 0,
                    attr_setting_type: 0,
                    share_type: 0,
                    //
                    calendar_key: '',

                    pay_price_list: [{
                        title: '?????????',
                        pay_price: 0,
                        stock_num: 200,

                        member_price: {},
                        shareLevelList: [],
                        key: new Date().getTime(),
                    }],
                    before_status: 1,
                    before_text: '??????????????????',

                    after_trigger: 'none',//event
                    after_send_status: 0,
                    after_send_type: [1, 2, 4, 8, 16, 32],
                    after_send_plugin: "<?= !$is_pond_show ? !$is_scratch_show ? '' : 'scratch' : 'pond'?>",
                    after_send_lottery_limit: 1,
                    after_send_price: 0.01,
                    after_send_integral: 1,
                    after_send_member_id: '',
                    after_send_member_name: '',
                    after_send_coupon: [],
                    after_send_card: [],
                    after_jump_status: 0,
                    after_jump_link: null,

                    message_status: 0,
                    m_subscribe: 1,
                    m_subscribe_content: '',
                    m_subscribe_link: null,
                    m_sms: 1,
                    m_sms_tempid: '',
                    m_send_type: 'submit',//date
                    m_send_date: '',

                    btn_height: 84,
                    btn_padding: 24,
                    box_padding: 24,
                    btn_radius: 24,

                    btn_color: '#FFFFFF',
                    btn_bg: '#FF4544',
                    btn_border_color: '#FF4544',
                    bg_color: "#FFFFFF",
                    title_color: '#545B60',
                    select_bg: '#FF4544',
                    noselect_bg: '#E5E7EC',
                    label_color: '#242424'
                },
            };
        },
        computed: {
            boxStyle() {
                let {
                    bg_color,
                } = this.data;
                return {
                    backgroundColor: bg_color,
                    padding: `20px 0`,
                }
            },

            btnStyle() {
                let {
                    btn_height,
                    btn_radius,
                    btn_color,
                    btn_bg,
                    btn_padding,
                    btn_border_color,
                } = this.data;
                return {
                    height: `${btn_height}px`,
                    background: btn_bg,
                    color: btn_color,
                    borderWidth: '1px',
                    borderStyle: 'solid',
                    borderColor: btn_border_color,
                    borderRadius: `${btn_radius}px`,
                    marginLeft: `${btn_padding}px`,
                    fontSize: '32px',
                    marginRight: `${btn_padding}px`,
                }
            },

            attrGroups() {
                let attr_list = [];
                let {pay_status, title, pay_price_list} = this.data;
                if (pay_status === 'alone') {
                    attr_list = [{
                        attr_id: 1,
                        attr_name: title
                    }]
                } else {
                    for (let i = 0; i < pay_price_list.length; i++) {
                        attr_list.push({
                            attr_id: i + 1,
                            attr_name: pay_price_list[i].title
                        })
                    }
                }
                let attr_group_name = '??????';
                return [{
                    attr_group_id: 1,
                    attr_group_name,
                    attr_list
                }];
            },
            addAttr() {
                let {pay_status, title, pay_price_list} = this.data;
                let attr = [];
                let attr_group_name = '??????';
                if (pay_status === 'alone') {
                    attr = [{
                        attr_list: [{
                            attr_group_name,
                            attr_group_id: 1,
                            attr_id: 1,
                            attr_name: title,
                        }],
                        member_price: {},
                        shareLevelList: [],
                    }]
                } else {
                    for (let i = 0; i < pay_price_list.length; i++) {
                        let {member_price, shareLevelList} = pay_price_list[i];
                        if (member_price instanceof Array) member_price = {};
                        attr.push({
                            attr_list: [{
                                attr_group_name,
                                attr_group_id: 1,
                                attr_id: i + 1,
                                attr_name: pay_price_list[i].title
                            }],
                            member_price,
                            shareLevelList,
                        })
                    }
                }
                return {attr}
            },
        },
        methods: {
            ldon(){
              this.$emit('ldon');
            },
            saveMember() {
                let {is_level, member_price, is_level_alone, attr} = this.memberForm;
                let {data} = this;
                for (let i = 0; i < data.pay_price_list.length; i++) {
                    for (let j = 0; j < attr.length; j++) {
                        let attr_id = attr[j].attr_list[0]['attr_id'];
                        if (attr_id === i + 1) {
                            data.pay_price_list[i].member_price = attr[j].member_price;
                            break;
                        }
                    }
                }
                Object.assign(this.data, {
                    is_level,
                    member_price,
                    is_level_alone,
                })
                this.memberVisible = false;
            },
            saveShare() {
                let {shareLevelList, individual_share, attr_setting_type, share_type,attr} = this.shareForm;
                let {data} = this;
                for (let i = 0; i < data.pay_price_list.length; i++) {
                    for (let j = 0; j < attr.length; j++) {
                        let attr_id = attr[j].attr_list[0]['attr_id'];
                        if (attr_id === i + 1) {
                            data.pay_price_list[i].shareLevelList = attr[j].shareLevelList;
                            break;
                        }
                    }
                }
                Object.assign(this.data, {
                    shareLevelList,
                    individual_share,
                    attr_setting_type,
                    share_type,
                })
                this.shareVisible = false;
            },
            /////////
            openMember() {
                this.getMembers();
                let {is_level, member_price, is_level_alone} = this.data;
                if (member_price instanceof Array) member_price = {};
                let memberForm = Object.assign({}, {
                    is_level,
                    is_level_alone,
                    member_price,
                    attr: [],
                }, this.addAttr);
                this.memberForm = JSON.parse(JSON.stringify(memberForm));
                this.memberVisible = true;
            },
            openShare() {
                let {shareLevelList, individual_share, attr_setting_type, share_type} = this.data;
                let shareForm = Object.assign({}, {
                    individual_share,
                    attr_setting_type,
                    share_type,
                    shareLevelList,
                    attr: [],
                }, this.addAttr);
                this.shareForm = JSON.parse(JSON.stringify(shareForm));
                this.shareVisible = true;
            },
            // ??????????????????
            async getMembers() {
                let self = this;
                await request({
                    params: {
                        r: 'mall/mall-member/all-member'
                    },
                    method: 'get',
                    data: {}
                }).then(e => {
                    if (e.data.code == 0) {
                        self.memberLevel = e.data.data.list;
                        let defaultMemberPrice = [];
                        // ?????????????????????????????????????????? ???????????????
                        self.memberLevel.forEach(function (item, index) {
                            let obj = {};
                            obj['id'] = index;
                            obj['name'] = item.name;
                            obj['level'] = 'level' + parseInt(item.level);
                            defaultMemberPrice.push(obj);
                        });
                        self.defaultMemberPrice = defaultMemberPrice;
                    } else {
                        self.$message.error(e.data.msg);
                    }
                })
            },
            //?????????????????????????????????????????????????????
            onSubscribe(e) {
                e.map((item, index) => {
                    this.data.m_subscribe_link = {
                        icon: item.icon,
                        url: item.new_link_url,
                        openType: item.open_type,
                        params: item.params,
                        name: item.name,
                        link: item,
                    }
                });
            },
            onSelectLink(e) {
                e.map((item, index) => {
                    this.data.after_jump_link = {
                        icon: item.icon,
                        url: item.new_link_url,
                        openType: item.open_type,
                        params: item.params,
                        name: item.name,
                        link: item,
                    }
                });
            },
            couponDelete(index) {
                this.data.after_send_coupon.splice(index, 1);
            },
            cardDelete(index) {
                this.data.after_send_card.splice(index, 1);
            },
            couponSubmit(e) {
                this.data.after_send_coupon = e;
            },
            cardSubmit(e) {
                this.data.after_send_card = e;
            },
            closeMember() {
                this.data.after_send_member_id = 0;
                this.data.after_send_member_name = '';
            },
            changeSendMemberId(e) {
                if (e) {
                    this.data.after_send_member_id = e.id;
                    this.data.after_send_member_name = e.name;
                }
            },
            //?????????????????????????????????????????????????????
            payPriceAdd() {
                this.data.pay_price_list.push({
                    title: '',
                    pay_price: 0,
                    stock_num: 200,
                    member_price: {},
                    shareLevelList: [],
                    key: new Date().getTime(),
                })
            },
            payPriceDelete(index) {
                this.data.pay_price_list.splice(index, 1);
            },
        },
    });
</script>
