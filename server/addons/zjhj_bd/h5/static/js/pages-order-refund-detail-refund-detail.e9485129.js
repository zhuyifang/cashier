(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-order-refund-detail-refund-detail"],{"255e":function(e,t,a){"use strict";a.r(t);var i=a("729f"),n=a.n(i);for(var s in i)["default"].indexOf(s)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(s);t["default"]=n.a},4021:function(e,t,a){"use strict";var i;a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return s})),a.d(t,"a",(function(){return i}));var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"app-scan main-center cross-center",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.scanCode.apply(void 0,arguments)}}},[a("v-uni-image",{attrs:{src:"/static/image/icon/scan.png"}})],1)},s=[]},"4f38":function(e,t,a){"use strict";a.r(t);var i=a("4021"),n=a("ee9a");for(var s in n)["default"].indexOf(s)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(s);a("e231");var r,o=a("f0c5"),d=Object(o["a"])(n["default"],i["b"],i["c"],!1,null,"0cd98e59",null,!1,i["a"],r);t["default"]=d.exports},"729f":function(e,t,a){"use strict";var i=a("4ea4");Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("7f7f"),a("96cf");var n=i(a("3b8d")),s=i(a("1d88")),r=i(a("4e01")),o=i(a("33297")),d=(i(a("ee50")),i(a("4f38"))),c={components:{"app-order-banner":s.default,"app-order-goods-info":r.default,"app-order-express":o.default,appScan:d.default},data:function(){return{id:null,refundDetail:{},expressList:[],expressIndex:0,express:"",express_no:"",customer_name:"",index:0,is_show:!1,value:[0]}},methods:{getNumber:function(e){this.express_no=e},getRefundDetail:function(){var e=this;e.$showLoading(),e.$request({url:e.$api.order.refund_detail,data:{id:e.id}}).then((function(t){e.$hideLoading(),e.is_show=!0,0===t.code&&(e.refundDetail=t.data.detail,e.expressList=t.data.express_list)})).catch((function(){e.$hideLoading()}))},formSubmit:function(){var e=(0,n.default)(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(t=this,this.express){e.next=4;break}return uni.showToast({title:"请选择快递公司",icon:"none"}),e.abrupt("return");case 4:if(this.express_no){e.next=7;break}return uni.showToast({title:"请填写快递单号",icon:"none"}),e.abrupt("return");case 7:this.$subscribe(this.refundDetail.template_message_list).then((function(e){t.submitAction()})).catch((function(e){t.submitAction()}));case 8:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),submitAction:function(){var e=this;try{this.$showLoading({title:"提交中"}),this.$request({url:this.$api.order.refund_send,method:"post",data:{id:this.id,express:this.express,customer_name:this.customer_name,express_no:this.express_no}}).then((function(t){e.$hideLoading(),0===t.code?e.getRefundDetail():uni.showModal({title:"",content:t.msg,showCancel:!1})}))}catch(t){this.$hideLoading()}},copyText:function(){var e="".concat(this.refundDetail.refund_name," ").concat(this.refundDetail.refund_mobile," ").concat(this.refundDetail.refund_address);this.$utils.uniCopy({data:e,success:function(){uni.showToast({title:"复制成功",duration:1e3})}})},cancel:function(){var e=this;uni.showModal({title:"提示",content:"是否撤销申请？",success:function(t){t.confirm&&(uni.showLoading({title:"撤销中"}),e.$request({url:e.$api.order.cancel_refund,data:{refund_id:e.refundDetail.id},method:"post"}).then((function(e){uni.hideLoading();e.code,e.data;var t=e.msg;uni.showModal({title:"",content:t,showCancel:!1,success:function(){var e=getCurrentPages();uni.navigateBack({delta:e.length>3?3:1})}})})))}})},expressListChange:function(e){this.expressIndex=e.target.value,this.express=this.expressList[this.expressIndex].name},previewImage:function(e){var t=this.refundDetail.pic_list;uni.previewImage({current:t[e],urls:t})}},onLoad:function(e){this.$commonLoad.onload(e),this.id=e.id,this.getRefundDetail()}};t.default=c},"73d2":function(e,t,a){"use strict";a.r(t);var i=a("8b58"),n=a("255e");for(var s in n)["default"].indexOf(s)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(s);a("7c42");var r,o=a("f0c5"),d=Object(o["a"])(n["default"],i["b"],i["c"],!1,null,"5c943539",null,!1,i["a"],r);t["default"]=d.exports},7932:function(e,t,a){t=e.exports=a("24fb")(!1),t.push([e.i,".text-center[data-v-5c943539]{text-align:center}.font-weight[data-v-5c943539]{font-weight:700}.page-width[data-v-5c943539]{width:100%}.goods-hover-class[data-v-5c943539]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-5c943539]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-5c943539]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-5c943539]{width:100%}.u-hover-class[data-v-5c943539]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-5c943539]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.refund-detail-box[data-v-5c943539]{position:absolute;width:100%;height:100%;font-size:%?28?%}.refund-detail-box .form-box .platform[data-v-5c943539]{background:#fff;border-bottom:%?1?% solid #e2e2e2;padding:%?20?% %?20?%;margin-top:%?20?%}.refund-detail-box .form-box .select-box[data-v-5c943539]{text-align:right;width:100%}.refund-detail-box .form-box .select-box .select-label[data-v-5c943539]{font-size:%?31?%;color:#999}.refund-detail-box .form-box .select-box .select-label-active[data-v-5c943539]{color:#353535}.refund-detail-box .form-box .select-box .arrow-right[data-v-5c943539]{width:%?12?%;height:%?22?%;margin-left:%?16?%}.refund-detail-box .btn-box[data-v-5c943539]{position:fixed;bottom:0;width:100%;background:#f7f7f7;padding:%?20?%}.refund-detail-box .btn-box .btn[data-v-5c943539]{border-radius:%?40?%;height:%?80?%;width:100%;background-color:#ff4544;padding:%?24?% 0;color:#fff;font-size:%?32?%}.express-box[data-v-5c943539]{background:#fff;padding:%?32?% %?24?%;margin-top:%?20?%}.express-label[data-v-5c943539]{margin-bottom:%?10?%;color:#999;font-size:%?28?%}.goods-box[data-v-5c943539]{background:#fff;padding:%?32?% %?24?%}.preferential-box[data-v-5c943539]{background:#fff;padding:%?32?% %?24?%;margin-top:%?20?%}.preferential-box .picture[data-v-5c943539]{width:%?160?%;height:%?160?%;margin-right:%?14?%;margin-bottom:%?14?%}.preferential-box .item[data-v-5c943539]{margin:%?12?% %?15?% %?12?% 0;-webkit-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start}.preferential-box .image-label[data-v-5c943539]{margin:%?12?% 0 %?24?%}.preferential-box .common-text[data-v-5c943539]{word-break:break-all}.preferential-box .label[data-v-5c943539]{margin-right:%?15?%}.preferential-box .merchant-remark[data-v-5c943539]{color:#ff4544}.refund-address-box[data-v-5c943539]{background-color:#fff;padding:%?32?% %?24?%;margin-top:%?20?%;font-size:%?28?%}.refund-address-box .express[data-v-5c943539]{margin:%?15?% 0 %?5?%}.refund-address-box .remark[data-v-5c943539]{margin-top:%?10?%;padding-top:%?5?%;border-top:%?1?% solid #e2e2e2}.refund-express-box[data-v-5c943539]{background-color:#fff;padding:0 %?24?%;margin-top:%?20?%}.refund-express-box>uni-view[data-v-5c943539]{height:%?88?%}.refund-express-box .label[data-v-5c943539]{margin-right:%?25?%}.refund-express-box .express_no[data-v-5c943539]{border-top:%?1?% solid #e2e2e2}.refund-express-box .right-icon[data-v-5c943539]{width:%?12?%;height:%?22?%;margin-right:%?25?%}.refund-price[data-v-5c943539]{color:#ff4544}.detail-btn[data-v-5c943539]{border:1px solid #bbb;border-radius:%?30?%;padding:%?10?% %?30?%;margin-left:%?15?%}.dialog[data-v-5c943539]{position:fixed;height:100%;width:100%;bottom:%?96?%;left:0;z-index:10;background-color:rgba(0,0,0,.3)}.picker-list[data-v-5c943539]{background-color:#fff;padding-top:%?20?%;position:fixed;bottom:0;left:0;width:100%}.picker-header[data-v-5c943539]{padding:0 %?24?%;color:#446dfd;font-size:%?32?%}.get[data-v-5c943539]{width:%?160?%;height:%?48?%;line-height:%?48?%;text-align:center;border:%?1?% solid #446dfd;border-radius:%?24?%;position:absolute;top:%?20?%;right:%?24?%;display:block;color:#446dfd}.pick[data-v-5c943539]{width:100%;height:%?440?%}.pick-view[data-v-5c943539]{line-height:%?72?%;text-align:center;color:#446dfd;font-size:%?32?%}.t-extra-small-color[data-v-5c943539]{font-size:%?24?%;color:#999}.scan-btn[data-v-5c943539]{height:%?96?%;width:%?49?%}body.?%PAGE?%[data-v-5c943539]{background:#f7f7f7}",""])},"7c42":function(e,t,a){"use strict";var i=a("8686"),n=a.n(i);n.a},8686:function(e,t,a){var i=a("7932");"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("da934e2c",i,!0,{sourceMap:!1,shadowMode:!1})},"8b58":function(e,t,a){"use strict";var i;a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return s})),a.d(t,"a",(function(){return i}));var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("app-layout",[e.is_show?a("v-uni-view",{staticClass:"refund-detail-box"},[a("app-order-banner",{attrs:{refund:e.refundDetail.status_text,title:e.refundDetail.status_text,hint:e.refundDetail.hint_text}}),1==e.refundDetail.is_confirm&&2==e.refundDetail.type?a("v-uni-view",{staticClass:"express-box"},[a("v-uni-view",{staticClass:"express-label t-medium"},[e._v("换货物流")]),e.refundDetail.merchant_express&&e.refundDetail.merchant_express_no?[a("app-order-express",{attrs:{pageUrl:"/pages/order/express-detail/express-detail?id="+e.refundDetail.order_id+"&express="+e.refundDetail.merchant_express+"&express_no="+e.refundDetail.merchant_express_no+"&cover_pic="+e.refundDetail.detail[0].goods_info.pic_url+"&customer_name="+e.refundDetail.customer_name,express:e.refundDetail.merchant_express,express_no:e.refundDetail.merchant_express_no}})]:[1==e.refundDetail.send_type?a("v-uni-view",[e._v("物流信息:到店自提")]):2==e.refundDetail.send_type?a("v-uni-view",[e._v("物流信息:同城配送")]):a("v-uni-view",[e._v("物流信息: 其它方式("+e._s(e.refundDetail.merchant_express_content)+")")])]],2):e._e(),1!=e.refundDetail.send_type&&2!=e.refundDetail.send_type&&1==e.refundDetail.is_send&&3!=e.refundDetail.type?a("v-uni-view",{staticClass:"express-box"},[a("v-uni-view",{staticClass:"express-label"},[e._v("退货物流")]),a("app-order-express",{attrs:{pageUrl:"/pages/order/express-detail/express-detail?id="+e.refundDetail.order_id+"&express="+e.refundDetail.express+"&express_no="+e.refundDetail.express_no+"&cover_pic="+e.refundDetail.goods_info.pic_url+"&customer_name="+e.refundDetail.customer_name,express:e.refundDetail.express,express_no:e.refundDetail.express_no}})],1):e._e(),2==e.refundDetail.status&&0==e.refundDetail.is_send?a("v-uni-view",{staticClass:"refund-address-box dif-top"},[a("v-uni-view",{staticClass:"t-extra-small-color"},[e._v("收件人信息")]),a("v-uni-view",{staticClass:"dir-left-nowrap"},[a("v-uni-view",{staticClass:"box-grow-1 dir-top-nowrap"},[a("v-uni-view",{staticClass:"dir-left-nowrap express"},[a("v-uni-view",{staticClass:"box-grow-1"},[e._v(e._s(e.refundDetail.refund_name))]),a("v-uni-view",{staticClass:"box-grow-0"},[e._v(e._s(e.refundDetail.refund_mobile))])],1),a("v-uni-view",[e._v(e._s(e.refundDetail.refund_address))])],1),a("v-uni-view",{staticClass:"box-grow-0 cross-center"},[a("v-uni-view",{staticClass:"box-grow-0 detail-btn",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.copyText.apply(void 0,arguments)}}},[e._v("复制")])],1)],1),e.refundDetail&&e.refundDetail.refund_remark?a("v-uni-view",{staticClass:"t-extra-small-color t-small remark"},[e._v(e._s(e.refundDetail.refund_remark))]):e._e()],1):e._e(),a("v-uni-form",{staticClass:"form-box"},[2==e.refundDetail.status&&0==e.refundDetail.is_send?a("v-uni-view",{staticClass:"dir-top-nowrap refund-express-box"},[a("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},[a("v-uni-view",{staticClass:"label box-grow-0 cross-center"},[e._v("快递公司:")]),a("v-uni-view",{staticClass:"select-box"},[a("v-uni-picker",{attrs:{value:e.expressIndex,"range-key":"name",range:e.expressList},on:{change:function(t){arguments[0]=t=e.$handleEvent(t),e.expressListChange.apply(void 0,arguments)}}},[a("v-uni-view",[a("span",{staticClass:"select-label",class:{"select-label-active":e.express}},[e._v(e._s(e.express?e.expressList[e.expressIndex].name:"请选择"))]),a("v-uni-image",{staticClass:"arrow-right",attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1)],1)],1),a("v-uni-view",{staticClass:"dir-left-nowrap cross-center express_no"},[a("v-uni-view",{staticClass:"label box-grow-0 cross-center"},[e._v("快递单号:")]),a("v-uni-input",{staticClass:"box-grow-1",attrs:{"placeholder-style":"color:#999999;font-size:31rpx",placeholder:"请填写快递单号"},model:{value:e.express_no,callback:function(t){e.express_no=t},expression:"express_no"}}),a("app-scan",{staticClass:"box-grow-0 scan-btn",on:{get:function(t){arguments[0]=t=e.$handleEvent(t),e.getNumber.apply(void 0,arguments)}}})],1)],1):e._e(),a("v-uni-view",{staticClass:"platform"},[e._v(e._s(e.refundDetail.platform))]),a("v-uni-view",{staticClass:"goods-box"},[a("app-jump-button",{attrs:{url:e.refundDetail.goods_info.page_url}},[a("app-order-goods-info",{staticStyle:{width:"100%"},attrs:{"is-last-one":!1,goods:e.refundDetail.goods_info}})],1)],1),a("v-uni-view",{staticClass:"preferential-box dir-top-nowrap"},[a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label box-grow-0"},[e._v("售后类型:")]),a("v-uni-view",{staticClass:"t-small-color box-grow-1"},[e._v(e._s(e.refundDetail.refund_type_text))])],1),e.refundDetail.refund_data.goods_status?a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label box-grow-0"},[e._v("货物状态:")]),a("v-uni-view",{staticClass:"t-small-color box-grow-1"},[e._v(e._s(e.refundDetail.refund_data.goods_status))])],1):e._e(),e.refundDetail.refund_data.cause?a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label box-grow-0"},[e._v(e._s(2==e.refundDetail.type?"换货原因":"退款原因")+":")]),a("v-uni-view",{staticClass:"t-small-color box-grow-1 common-text"},[e._v(e._s(e.refundDetail.refund_data.cause))])],1):e._e(),1==e.refundDetail.type||3==e.refundDetail.type?[a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label"},[e._v("申请退款:")]),a("v-uni-view",{staticClass:"refund-price"},[e._v("￥"+e._s(e.refundDetail.refund_price))])],1),1==e.refundDetail.is_refund?a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label"},[e._v("实际退款:")]),a("v-uni-view",{staticClass:"refund-price"},[e._v("￥"+e._s(e.refundDetail.reality_refund_price))])],1):e._e()]:e._e(),a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label box-grow-0"},[e._v("备注信息:")]),a("v-uni-view",{staticClass:"t-small-color box-grow-1 common-text"},[e._v(e._s(e.refundDetail.remark))])],1),e.refundDetail.mobile?a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label box-grow-0"},[e._v("联系方式:")]),a("v-uni-view",{staticClass:"t-small-color box-grow-1 common-text"},[e._v(e._s(e.refundDetail.mobile))])],1):e._e(),e.refundDetail.merchant_remark?a("v-uni-view",{staticClass:"dir-left-nowrap item cross-center"},[a("v-uni-view",{staticClass:"label"},[e._v("商家留言:")]),a("v-uni-view",{staticClass:"merchant-remark common-text"},[e._v(e._s(e.refundDetail.merchant_remark))])],1):e._e(),e.refundDetail.pic_list.length>0?a("v-uni-view",{staticClass:"dir-top-nowrap"},[a("v-uni-view",{staticClass:"image-label"},[e._v("图片凭证:")]),a("v-uni-view",{staticClass:"flex-wrap"},e._l(e.refundDetail.pic_list,(function(t,i){return a("v-uni-image",{key:i,staticClass:"picture",attrs:{mode:"aspectFill",src:t},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.previewImage(i)}}})})),1)],1):e._e()],2),1==e.refundDetail.status||2==e.refundDetail.status&&0==e.refundDetail.is_send?[a("v-uni-view",{staticStyle:{height:"120rpx",width:"100%"}}),a("v-uni-view",{staticClass:"main-center btn-box"},[2==e.refundDetail.status&&0==e.refundDetail.is_send?a("v-uni-view",{staticClass:"btn main-center cross-center",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.formSubmit.apply(void 0,arguments)}}},[e._v("确认发货")]):e._e(),1==e.refundDetail.status?a("v-uni-view",{staticClass:"btn main-center cross-center",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.cancel.apply(void 0,arguments)}}},[e._v("撤销申请")]):e._e()],1)]:e._e()],2)],1):e._e()],1)},s=[]},"8c2e":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a481"),a("28a5");var i={name:"app-scan",props:{},methods:{scanCode:function(){var e=this;uni.scanCode({success:function(t){console.log(t),t.result&&e.$emit("get",t.result)},fail:function(t){t.result&&e.$emit("get",t.result)}}),e.$jwx.isWechat()&&e.$jwx.scanQRCode({success:function(t){if(t.resultStr){if(t.resultStr.indexOf(",")>0){var a=t.resultStr.split(",")[1];a=a.replace(/[^a-z\d]/gi,""),e.$emit("get",a)}}else t.result&&e.$emit("get",t.result)}})}}};t.default=i},b310:function(e,t,a){t=e.exports=a("24fb")(!1),t.push([e.i,".text-center[data-v-0cd98e59]{text-align:center}.font-weight[data-v-0cd98e59]{font-weight:700}.page-width[data-v-0cd98e59]{width:100%}.goods-hover-class[data-v-0cd98e59]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-0cd98e59]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-0cd98e59]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-0cd98e59]{width:100%}.u-hover-class[data-v-0cd98e59]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-0cd98e59]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-scan[data-v-0cd98e59]{height:100%;width:%?49?%}.app-scan uni-image[data-v-0cd98e59]{width:%?29?%;height:%?29?%}body.?%PAGE?%[data-v-0cd98e59]{background:#f7f7f7}",""])},bb24:function(e,t,a){var i=a("b310");"string"===typeof i&&(i=[[e.i,i,""]]),i.locals&&(e.exports=i.locals);var n=a("4f06").default;n("41203ce3",i,!0,{sourceMap:!1,shadowMode:!1})},e231:function(e,t,a){"use strict";var i=a("bb24"),n=a.n(i);n.a},ee50:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var i={copyText:function(e){this.$utils.uniCopy({data:e,success:function(){uni.hideLoading(),uni.showToast({title:"复制成功",icon:"none"})}})}};t.default=i},ee9a:function(e,t,a){"use strict";a.r(t);var i=a("8c2e"),n=a.n(i);for(var s in i)["default"].indexOf(s)<0&&function(e){a.d(t,e,(function(){return i[e]}))}(s);t["default"]=n.a}}]);