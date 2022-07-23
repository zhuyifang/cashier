<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */
Yii::$app->loadViewComponent('app-poster');
Yii::$app->loadViewComponent('app-setting');
Yii::$app->loadViewComponent('app-rich-text');
?>
<style>
    .el-tabs__header {
        padding: 0 20px;
        height: 56px;
        line-height: 56px;
        background-color: #fff;
        margin-bottom: 10px;
    }

    .form-body {
        padding: 20px;
        background-color: #fff;
        margin-bottom: 20px;
        padding-right: 50%;
        min-width: 1000px;
    }

    .button-item {
        margin-top: 12px;
        padding: 9px 25px;
    }

    .bg .left {
        width: 419px;
        height: 825px;
        margin-right: 10px;
        position: relative;
    }

    .bg .left .mobile-bg {
        width: 419px;
        height: 825px;
    }

    .bg .left .content {
        position: absolute;
        width: 375px;
        left: 21px;
        top: 66px;
    }

    .bg .left .content .activity-bg {
        position: absolute;
        top: 74.5px;
        left: 7.5px;
        height: 112px;
        width: 360px;
        border-radius: 8px;
    }

    .bg .left .content .rules {
        position: absolute;
        top: 64px;
        right: 0;
        width: 66px;
        height: 22px;
        text-align: center;
        line-height: 22px;
        border-radius: 11px 0 0 11px;
        background-color: rgba(0,0,0,.7);
        color: #fff;
        font-size: 12px;
        z-index: 10;
    }

    .bg .right {
        height: 100%;
        position: relative;
    }

    .red {
        color: #ff4544;
        margin-left: 10px;
    }
    .doit {
        position: absolute;
        right: 10px;
        top: 10px;
    }

    .el-dialog {
        min-width: 800px;
    }

    .title {
        padding: 18px 20px;
        border-top: 1px solid #F3F3F3;
        border-bottom: 1px solid #F3F3F3;
        background-color: #fff;
    }

    .right-button {
        position: absolute;
        top: 100%;
        left: 0;
    }
    .required-icon .el-form-item__label:before {
        content: '*';
        color: #F56C6C;
        margin-right: 4px;
    }
</style>

<div id="app" v-cloak>
    <el-card v-loading="loading" style="border:0" shadow="never" body-style="background-color: #f3f3f3;padding: 0 0;">
        <el-form :model="form" label-width="180px" ref="form">
            <el-tabs v-model="activeName">
                <el-tab-pane label="基本设置" name="first">
                    <app-setting v-model="form" :is_payment="false" :is_send_type="false" :is_full_reduce="true"></app-setting>
                    <el-card style="margin-bottom: 10px">
                        <div slot="header">活动规则设置</div>
                        <el-form-item label="活动规则" prop="detail">
                            <div style="width: 458px; min-height: 458px;">
                                <app-rich-text v-model="form.detail"></app-rich-text>
                            </div>
                        </el-form-item>
                    </el-card>
                </el-tab-pane>
                <el-tab-pane label="自定义背景图" name="second">
                    <div class="bg" flex="dir:left box:first">
                        <div class="left">
                            <img class="mobile-bg" src="statics/img/plugins/mobile.png" alt="">
                            <div class="content">
                                <div class="rules">活动规则</div>
                                <img class="screen-bg" src="statics/img/plugins/weekly.png" alt="">
                                <img class="activity-bg" :src="form.banner" alt="">
                            </div>
                        </div>
                        <div class="right">
                            <el-card shadow="never">
                                <div slot="header">背景图设置</div>
                                <div class="form-body">
                                    <el-form :model="form" label-width="120px" ref="form">
                                        <el-form-item label="头部banner图" prop="banner" class="required-icon">
                                            <div flex style="margin-bottom: 8px;">
                                                <app-attachment :multiple="false" :max="1" @selected="topPicUrl">
                                                    <el-tooltip effect="dark"
                                                                content="建议尺寸:750 * 280"
                                                                placement="top">
                                                        <el-button size="mini">选择图标</el-button>
                                                    </el-tooltip>
                                                </app-attachment>
                                                <div style="margin-left: 10px;">
                                                    <el-button type="primary" size="mini" @click="resetImg">恢复默认</el-button>
                                                </div>
                                            </div>
                                            <app-gallery :url="form.banner" :show-delete="true" @deleted="delPic"></app-gallery>
                                        </el-form-item>
                                    </el-form>
                                    <div class="right-button" v-if="activeName == 'second'">
                                        <el-button class="button-item" :loading="btnLoading" type="primary" @click="submit('form')" size="small">保存</el-button>
                                    </div>
                                </div>
                            </el-card>
                        </div>
                    </div>
                </el-tab-pane>
            </el-tabs>
            <el-button v-if="activeName == 'first'" style="margin-bottom: 150px;" :loading="btnLoading" class="button-item" type="primary" @click="submit('form')" size="small">保存</el-button>
            </el-tabs>
        </el-form>
    </el-card>
</div>

<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                loading: false,
                btnLoading: false,
                form: {
                    is_coupon: 1,
                    is_integral: 1,
                    is_member_price: 1,
                    is_share: 0,
                    is_territorial_limitation: 0,
                    banner: ''
                },
                activeName: 'first',
            };
        },
        created() {
            this.loadSetting();
        },
        methods: {
            topPicUrl(e) {
                this.form.banner = e[0].url;
            },
            resetImg() {
                this.form.banner = this.form.default_banner;
            },
            delPic() {
                this.form.banner = '';
            },
            async submit(formName) {
                if(!this.form.banner) {
                    this.$message.error('请选择头部banner图');
                    return false;
                }
                this.$refs[formName].validate(valid => {
                    if (valid) {
                        this.btnLoading = true;
                        let vip_show_limit = [];
                        let para = JSON.parse(JSON.stringify(this.form));
                        for(item of this.form.vip_show_limit) {
                            vip_show_limit.push(item.level);
                        }
                        para.vip_show_limit = JSON.stringify(vip_show_limit);
                        request({
                            params: {
                                r: 'plugin/weekly_buy/mall/index/index'
                            },
                            method: 'post',
                            data: para
                        }).then(e => {
                            this.btnLoading = false;
                            if (e.data.code === 0) {
                                this.$message.success('保存成功');
                            } else {
                                this.$message.error(e.data.msg);
                            }
                        });
                    } else {
                        this.btnLoading = false;
                        console.log('error submit!!');
                        return false;
                    }
                })
            },
            async loadSetting() {
               try {
                   this.loading = true;
                   const e = await request({
                       params: {
                           r: 'plugin/weekly_buy/mall/index/index'
                       },
                       method: 'get'
                   });
                   this.loading = false;
                   if (e.data.code === 0) {
                       this.form = e.data.data;
                       this.form.banner = this.form.banner ? this.form.banner : this.form.default_banner;
                   }
               } catch (e) {
                   this.loading = false;
                   throw new Error(e);
               }
            },
        },
    });
</script>
