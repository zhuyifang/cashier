<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */
?>

<style>
    .el-tabs__header {
        padding: 0 20px;
        height: 56px;
        line-height: 56px;
        background-color: #fff;
    }

    .item {
        background-color: #fff;
        width: 33%;
        min-height: 185px;
        margin-bottom: 10px;
        position: relative;
        padding: 20px;
        margin-right: 0.33%
    }

    .item .app-icon {
        display: flex;
        width: 85px;
        justify-content: space-between;
        position: absolute;
        right: 0;
        top: 0;
    }

    .item .app-icon img {
        cursor: pointer;
    }

    .item .name {
        background-color: #F4F4F5;
        color: #909399;
        width: auto;
        display: inline-block;
        padding: 0 10px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        font-size: 12px;
        border-radius: 3px;
        border: 1px solid #E0E0E3;
        margin-bottom: 5px;
    }

    .el-form-item {
        margin-bottom: 0px;
    }

    .showqr .el-dialog__body {
        text-align: center;
        padding-bottom: 10px;
    }

    .el-dialog {
        min-width: 400px;
    }
    .app-page {
        position: fixed;
        z-index: 10;
        background: #f3f3f3;
        padding-top: 20px;
        padding-left: 20px;
    }
</style>

<div id="app" v-cloak>
    <el-card shadow="never" style="border:0" body-style="background-color: #f3f3f3;padding: 0 0;"
             v-loading="cardLoading">
        <el-tabs class="app-page" :style="{'left': headLeft,'top': headTop, 'width': headWidth}" v-model="activeName" @tab-click="handleClick(activeName)">
            <el-tab-pane id="header" v-for="(tab, tabIndex) in tabList" :key="tabIndex" :label="tab.name" :name="tab.value"></el-tab-pane>
        </el-tabs>
        <div ref="header" class="el-tabs__header"></div>
        <div style="display: flex;flex-wrap: wrap">
            <div ref="item" v-for="(item,itemIndex) in list" class="item">
                <div class="name">{{item.name}}</div>
                <el-form @submit.native.prevent label-position="left" label-width="90px">
                    <el-form-item v-if="item.params" v-for="(param, index) in item.params" :key="index" :label="`参数` + (index + 1)">
                        <el-input size="small" v-model="param.value" :placeholder="param.desc"></el-input>
                    </el-form-item>
                    <el-form-item label="小程序路径">
                        <div style="width: 75%;word-break: break-all;display: none;">
                            <span ref="mini">
                                {{item.value}}<template v-if="item.params"
                                                        v-for="(param, index) in item.params">{{index === 0 ? `?` + param.key + `=` + param.value : `&` + param.key + `=` + param.value}}</template>
                            </span>
                        </div>
                        <div class="app-icon">
                            <el-tooltip effect="dark" content="复制链接" placement="top">
                                <img class="copy-btn" src="statics/img/mall/copy.png" alt=""
                                     data-clipboard-action="copy" @click="copyMethod(itemIndex, 0)">
                            </el-tooltip>
                            <el-tooltip effect="dark" content="二维码" placement="top">
                                <img src="statics/img/mall/qr.png" @click="qrcode(item, 'all')" alt="">
                            </el-tooltip>
                        </div>
                    </el-form-item>
                    <el-form-item v-if="wechat" label="公众号路径">
                        <div style="width: 75%;word-break: break-all;display: none;">
                            <span ref="wechat">{{wechat + item.value}}<template v-if="item.params"
                                                        v-for="(param, index) in item.params">{{index === 0 ? `?` + param.key + `=` + param.value : `&` + param.key + `=` + param.value}}</template>
                            </span>
                        </div>
                        <div class="app-icon">
                            <el-tooltip effect="dark" content="复制链接" placement="top">
                                <img class="copy-btn" src="statics/img/mall/copy.png" alt=""
                                     data-clipboard-action="copy" @click="copyMethod(itemIndex, 1)">
                            </el-tooltip>
                            <el-tooltip effect="dark" content="二维码" placement="top">
                                <img src="statics/img/mall/qr.png" @click="qrcode(item,'wechat')" alt="">
                            </el-tooltip>
                        </div>
                    </el-form-item>
                    <el-form-item v-if="mobile" label="H5路径">
                        <div style="width: 75%;word-break: break-all;display: none;">
                            <span ref="mobile">{{mobile + item.value}}<template v-if="item.params"
                                                        v-for="(param, index) in item.params">{{index === 0 ? `?` + param.key + `=` + param.value : `&` + param.key + `=` + param.value}}</template>
                            </span>
                        </div>
                        <div class="app-icon">
                            <el-tooltip effect="dark" content="复制链接" placement="top">
                                <img class="copy-btn" src="statics/img/mall/copy.png" alt=""
                                     data-clipboard-action="copy" @click="copyMethod(itemIndex, 2)">
                            </el-tooltip>
                            <el-tooltip effect="dark" content="二维码" placement="top">
                                <img src="statics/img/mall/qr.png" @click="qrcode(item,'mobile')" alt="">
                            </el-tooltip>
                        </div>
                    </el-form-item>
                    <el-form-item v-if="wechat" label="公众号跳转小程序路径" label-width="180px">
                        <div style="width: 75%;word-break: break-all;display: none;">
                            <span ref="jump">{{item.value}}.html<template v-if="item.params"
                                                        v-for="(param, index) in item.params">{{index === 0 ? `?` + param.key + `=` + param.value : `&` + param.key + `=` + param.value}}</template>
                            </span>
                        </div>
                        <div class="app-icon">
                            <el-tooltip effect="dark" content="复制链接" placement="top">
                                <img class="copy-btn" src="statics/img/mall/copy.png" alt=""
                                     data-clipboard-action="copy" @click="copyMethod(itemIndex, 3)">
                            </el-tooltip>
                        </div>
                    </el-form-item>
                </el-form>
            </div>
        </div>
        <div v-if="loadText" flex="main:center cross:center" style="padding: 20px 0;">{{loadText}}</div>
    </el-card>
    <el-dialog class="showqr" :visible.sync="showqr" width="20%" center>
        <div class="name" style="text-align: center">{{title}}</div>
        <app-image :src="qrimg" style="margin: 20px auto 10px" height='200' width='200'></app-image>
        <span slot="footer" class="dialog-footer">
            <el-button type="primary" style="margin-bottom: 10px;" size="small" @click="down">保存二维码图片</el-button>
        </span>
    </el-dialog>
</div>
<script src="<?= Yii::$app->request->baseUrl ?>/statics/js/clipboard.min.js"></script>
<script>


    const app = new Vue({
        el: '#app',
        data() {
            return {
                headLeft: '100%',
                headTop: '100%',
                headWidth: '',
                qrimg: '',
                showqr: false,
                list: [],
                cardLoading: false,
                activeName: 'base',
                mobile: false,
                wechat: false,
                detail: [],
                tabList: [],
                title: '',
                page: 1,
                load: false,
                loadText: '',
            };
        },
        methods: {
            copyMethod(i,type) {
                let list = ['mini', 'wechat', 'mobile', 'jump'];
                // let value = type == 0 ? this.$refs.mini[i].innerText.replace(/\s+/g,"") : type == 1 ? this.$refs.wechat[i].innerText.replace(/\s+/g,"") : type == 2 ? this.$refs.mobile[i].innerText.replace(/\s+/g,"") : '';
                let value = this.$refs[list[type]][i].innerText.replace(/\s+/g,"");
                let clipboard = new Clipboard('.copy-btn', {
                    text: function() {
                        return value;
                    }
                });
                let self = this;
                clipboard.on('success', function (e) {
                    self.$message({
                        message: '复制成功',
                        type: 'success'
                    });
                    e.clearSelection();
                    clipboard.destroy()
                });
                clipboard.on('error', function (e) {
                    self.$message.error('复制失败，请手动复制')
                    clipboard.destroy()
                });
            },
            down() {
                var alink = document.createElement("a");
                alink.href = this.qrimg;
                alink.download = this.title;
                alink.click();
            },

            change(e, row) {
                row.goods_id = e;
            },

            handleClick(e) {
                this.list = [];
                this.page = 1;
                this.load = false;
                setTimeout(()=>{
                    this.list = this.detail[e]
                },0)
            },
            paperScroll() {
                if(this.activeName == 'diy') {
                    let innerHeight = window.innerHeight;
                    let top = this.$refs['item'][this.list.length - 1].getBoundingClientRect().top;
                    let domHeight = this.$refs['item'][this.list.length - 1].getBoundingClientRect().height;
                    if(top + domHeight < innerHeight * 1.8) {
                        this.getMore();
                    }
                }
            },
            getMore() {
                let self = this;
                if(self.load) {
                    return false;
                }
                self.load = true;
                self.page++;
                self.loadText = '加载中...';
                request({
                    params: {
                        r: 'mall/app-page/index',
                        page: self.page
                    },
                    method: 'get',
                }).then(e => {
                    self.load = false;
                    self.loadText = '';
                    if (e.data.code == 0) {
                        if(e.data.data.list.diy) {
                            self.list = self.list.concat(e.data.data.list.diy);
                        }else {
                            self.loadText = '没有更多了';
                            self.load = true;
                            setTimeout(()=>{
                                self.loadText = ''
                            },800)
                        }
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    console.log(e);
                });
            },

            qrcode(row,type) {
                this.cardLoading = true;
                let value = row.value.replace('/', '')
                let para = {
                    r: 'mall/app-page/qrcode',
                    path: value,
                    platform: type
                };
                if (row.params) {
                    para.params = {};
                    row.params.forEach((item) => {
                        para.params[item.key] = item.value;
                    })
                }

                this.title = row.name;
                request({
                    params: para,
                    method: 'get',
                }).then(e => {
                    this.cardLoading = false;
                    if (e.data.code == 0) {
                        if (e.data.data.wechat) {
                            this.qrimg = e.data.data.wechat.file_path
                        } else if (e.data.data.alipay) {
                            this.qrimg = e.data.data.alipay.file_path
                        } else {
                            this.qrimg = e.data.data.file_path
                        }
                        this.showqr = true;
                    } else {
                        this.$message.error(e.data.msg)
                    }
                }).catch(e => {
                    this.cardLoading = false;
                });
            },
            getList() {
                let self = this;
                self.cardLoading = true;
                request({
                    params: {
                        r: 'mall/app-page/index',
                    },
                    method: 'get',
                }).then(e => {
                    self.cardLoading = false;
                    if (e.data.code == 0) {
                        self.detail = e.data.data.list;
                        if (typeof self.detail.plugin != 'undefined') {
                            self.detail.plugin.forEach(function (row) {
                                row.goods_id = ''
                            })
                        }
                        self.list = e.data.data.list.base;
                        self.mobile = e.data.data.webUri.mobile ? e.data.data.webUri.mobile : false;
                        self.wechat = e.data.data.webUri.wechat ? e.data.data.webUri.wechat : false;
                        self.getTabList();
                    } else {
                        self.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    console.log(e);
                });
            },
            getTabList() {
                let self = this;
                let tabList = Object.keys(self.detail);
                let newTabList = [];
                // TODO 已下代码应该写在后端
                tabList.forEach((item) => {
                    if (item === 'base') {
                        newTabList.push({
                            name: '基础页面',
                            value: item
                        })
                    }
                    if (item === 'marketing') {
                        newTabList.push({
                            name: '营销页面',
                            value: item
                        })
                    }
                    if (item === 'order') {
                        newTabList.push({
                            name: '订单页面',
                            value: item
                        })
                    }
                    if (item === 'diy') {
                        newTabList.push({
                            name: 'diy页面',
                            value: item
                        })
                    }
                    if (item === 'plugin') {
                        newTabList.push({
                            name: '插件页面',
                            value: item
                        })
                    }
                })
                this.tabList = newTabList;
                this.$nextTick(()=>{
                    this.headTop = (this.$refs['header'].getBoundingClientRect().top -20 ) + 'px';
                    this.headLeft = (this.$refs['header'].getBoundingClientRect().left - 20) + 'px';
                    this.headWidth = (this.$refs['header'].getBoundingClientRect().width + 20) + 'px';
                })
            },
        },
        mounted: function () {
            this.getList();
            window.addEventListener('scroll',this.paperScroll, true)
        }
    });
</script>
