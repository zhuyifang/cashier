(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-coupon-give-give"],{"320f":function(t,e,o){"use strict";o.r(e);var n=o("95c8"),a=o("3f40");for(var i in a)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return a[t]}))}(i);o("748b");var c,r=o("f0c5"),s=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"783c303d",null,!1,n["a"],c);e["default"]=s.exports},"3f40":function(t,e,o){"use strict";o.r(e);var n=o("abe8"),a=o.n(n);for(var i in n)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return n[t]}))}(i);e["default"]=a.a},"59b7":function(t,e,o){"use strict";var n=o("4ea4");o("8e6e"),o("ac6a"),o("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=n(o("bd86")),i=n(o("ad05")),c=o("2f62");function r(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,n)}return o}function s(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?r(Object(o),!0).forEach((function(e){(0,a.default)(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):r(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}var d={name:"app-goods-recommend",components:{appGoods:i.default},props:{commentStyle:{type:Object,default:function(){return{pic_url:"../../../static/image/icon/icon-favorite.png",text_color:"#999",text:"您或许喜欢",list_style:2}}},goodsList:{type:Array,default:function(){return[]}},theme:Object,sureCart:Boolean,showSales:Boolean,showBuyBtn:{type:Boolean,default:function(){return!0}},showUnderlinePrice:{type:Boolean,default:function(){return!0}},newList:Boolean,activity:Object,onlyShowTitle:Boolean,is_show_member:{type:Boolean,default:function(){return!0}},sign:String,detail:Object},methods:{cartResult:function(){this.$emit("cart",!0)},cartShow:function(t){this.$emit("show",t)}},computed:s({},(0,c.mapState)({isListUnderlinePrice:function(t){return t.mallConfig.mall.setting.is_list_underline_price},goodsImg:function(t){return t.mallConfig.__wxapp_img.goods}}))};e.default=d},"748b":function(t,e,o){"use strict";var n=o("f1eb"),a=o.n(n);a.a},"80e1":function(t,e,o){"use strict";o.r(e);var n=o("59b7"),a=o.n(n);for(var i in n)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return n[t]}))}(i);e["default"]=a.a},8228:function(t,e,o){e=t.exports=o("24fb")(!1),e.push([t.i,".text-center[data-v-00e5f8d0]{text-align:center}.font-weight[data-v-00e5f8d0]{font-weight:700}.page-width[data-v-00e5f8d0]{width:100%}.goods-hover-class[data-v-00e5f8d0]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-00e5f8d0]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-00e5f8d0]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-00e5f8d0]{width:100%}.u-hover-class[data-v-00e5f8d0]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-00e5f8d0]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-goods-recommend .recommend-title[data-v-00e5f8d0]{margin:%?40?% 0 %?32?% 0;font-size:%?24?%;color:#999}.app-goods-recommend .recommend-title .text[data-v-00e5f8d0]{color:#999}.app-goods-recommend .recommend-title .border[data-v-00e5f8d0]{height:%?2?%;background-color:#bbb;width:%?40?%;margin:0 %?24?%}.app-goods-recommend .recommend-title .app-icon-love[data-v-00e5f8d0]{width:%?24?%;height:%?24?%;margin-right:%?12?%}.app-goods-recommend .product-list[data-v-00e5f8d0]{padding:0 %?24?%;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap}body.?%PAGE?%[data-v-00e5f8d0]{background:#f7f7f7}",""])},8902:function(t,e,o){var n=o("8228");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=o("4f06").default;a("fd2a74e2",n,!0,{sourceMap:!1,shadowMode:!1})},"8e97":function(t,e,o){"use strict";o.r(e);var n=o("98d1"),a=o("80e1");for(var i in a)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return a[t]}))}(i);o("d9b4");var c,r=o("f0c5"),s=Object(r["a"])(a["default"],n["b"],n["c"],!1,null,"00e5f8d0",null,!1,n["a"],c);e["default"]=s.exports},"95c8":function(t,e,o){"use strict";var n;o.d(e,"b",(function(){return a})),o.d(e,"c",(function(){return i})),o.d(e,"a",(function(){return n}));var a=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("app-layout",[t.coupon?o("v-uni-view",{staticClass:"give"},[o("v-uni-view",{staticClass:"content",style:t.contentStyle},[o("v-uni-view",{staticClass:"avatar dir-left-nowrap main-center cross-center"},[o("v-uni-image",{attrs:{src:t.coupon.avatar}})],1),o("v-uni-view",{staticClass:"nickname"},[t._v(t._s(t.coupon.nickname))]),o("v-uni-view",{staticClass:"title"},[t._v("送你一张优惠券")]),1==t.coupon.status?[o("v-uni-view",{staticClass:"pic dir-left-nowrap cross-between main-center"},[o("v-uni-view",{staticClass:"box-grow-0 coupon-left main-center cross-center"},[1==t.coupon.type?o("v-uni-view",{staticClass:"discount"},[t._v(t._s(t.coupon.discount))]):o("v-uni-view",{staticClass:"sub t-omit"},[t._v(t._s(t.coupon.sub_price))])],1),o("v-uni-view",{staticClass:"box-grow-0 coupon-right dir-top-nowrap main-center cross-center"},[t.coupon.min_price>0?o("v-uni-view",[t._v("满￥"+t._s(t.coupon.min_price)+"可用")]):o("v-uni-view",[t._v("无门槛使用")]),o("v-uni-view",{staticClass:"margin-top"},[t._v(t._s(t.coupon.appoint_type_text))])],1),o("v-uni-view",{staticClass:"box-grow-1"})],1),1==t.coupon.expire_type?[o("v-uni-view",{staticClass:"time"},[t._v("有效期：领取后"+t._s(t.coupon.expire_day)+"天有效")])]:[o("v-uni-view",{staticClass:"time"},[t._v("有效期："+t._s(t.coupon.begin_time)+" - "+t._s(t.coupon.end_time))])],o("v-uni-view",{staticClass:"card-btn-group dir-left-nowrap main-center"},[o("v-uni-view",{staticClass:"card-btn btn-0 box-grow-0",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.shareShow=!0}}},[o("app-image",{attrs:{"img-src":t.coupon.img_share,width:"100%",height:"100%"}})],1),o("v-uni-view",{staticClass:"card-btn btn-0 box-grow-0",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toGoods.apply(void 0,arguments)}}},[o("app-image",{attrs:{"img-src":t.coupon.img_use,width:"100%",height:"100%"}})],1)],1),o("v-uni-view",[o("app-share-qr-code",{attrs:{title:"生成优惠券海报","poster-url":"/pages/poster/poster?coupon_id="+t.coupon.id,"has-poster-nav":!0},model:{value:t.shareShow,callback:function(e){t.shareShow=e},expression:"shareShow"}})],1)]:o("v-uni-view",{staticClass:"card-btn btn-1",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.receive.apply(void 0,arguments)}}},[o("app-image",{attrs:{"img-src":t.coupon.img_receive,width:"100%",height:"100%"}})],1)],2),o("v-uni-view",[o("app-goods-recommend",{attrs:{sureCart:!0,"comment-style":t.comment_style,theme:t.getTheme,"goods-list":t.recommendGoodsList}})],1)],1):t._e(),t.modal.show?o("v-uni-view",{staticClass:"card-modal dir-top-nowrap cross-center main-center"},[o("v-uni-view",{staticClass:"modal-content",style:{backgroundImage:"url("+t.img_finish_receiving+")"}},[o("v-uni-view",{staticClass:"error"},[t._v(t._s(t.modal.msg))]),o("v-uni-view",{staticClass:"modal-btn",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.btnClick.apply(void 0,arguments)}}})],1)],1):t._e()],1)},i=[]},"98d1":function(t,e,o){"use strict";var n;o.d(e,"b",(function(){return a})),o.d(e,"c",(function(){return i})),o.d(e,"a",(function(){return n}));var a=function(){var t=this,e=t.$createElement,o=t._self._c||e;return t.goodsList&&t.goodsList.length>0||t.onlyShowTitle?o("v-uni-view",{staticClass:"app-goods-recommend"},[o("v-uni-view",{staticClass:"recommend-title dir-left-nowrap main-center"},[o("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},[o("v-uni-view",{staticClass:"border"}),o("v-uni-image",{staticClass:"app-icon-love",attrs:{src:t.commentStyle?t.commentStyle.pic_url:"../../../static/image/icon/icon-favorite.png"}}),o("v-uni-view",{staticClass:"text",style:{color:t.commentStyle?t.commentStyle.text_color:"#999"}},[t._v(t._s(t.commentStyle?t.commentStyle.text:"您或许喜欢"))]),o("v-uni-view",{staticClass:"border"})],1)],1),!t.onlyShowTitle&&t.commentStyle?o("v-uni-view",{staticClass:"recommend-list"},[o("v-uni-view",{staticClass:"product-list main-between"},t._l(t.goodsList,(function(e,n){return o("app-goods",{key:e.id,attrs:{no_extra:!0,listStyle:parseInt(t.commentStyle?t.commentStyle.list_style:2),index:n,theme:t.theme,goods:e,show_time:!1,c_border_top:16,showBuyBtn:t.showBuyBtn,extra:t.showSales?e.sales:"",c_border_bottom:16,padding:24,buy:t.sureCart&&3!=t.commentStyle.list_style,btnSize:60,buyBtnImage:t.sureCart&&3!=t.commentStyle.list_style?t.goodsImg.cart:"",isUnderLinePrice:!(!t.showUnderlinePrice||1!=t.isListUnderlinePrice||3==t.commentStyle.list_style)},on:{cart:function(e){arguments[0]=e=t.$handleEvent(e),t.cartResult.apply(void 0,arguments)},show:function(e){arguments[0]=e=t.$handleEvent(e),t.cartShow.apply(void 0,arguments)}}})})),1)],1):t._e()],1):t._e()},i=[]},aa9f:function(t,e,o){e=t.exports=o("24fb")(!1),e.push([t.i,'.text-center[data-v-783c303d]{text-align:center}.font-weight[data-v-783c303d]{font-weight:700}.page-width[data-v-783c303d]{width:100%}.goods-hover-class[data-v-783c303d]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-783c303d]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-783c303d]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-783c303d]{width:100%}.u-hover-class[data-v-783c303d]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-783c303d]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.give[data-v-783c303d]{background-color:#fff}.content[data-v-783c303d]{width:%?750?%;height:%?880?%;background-size:100% 100%;background-repeat:no-repeat;background-position:50%;padding-top:%?46?%;text-align:center}.content .avatar[data-v-783c303d]{width:%?130?%;height:%?130?%;margin:0 auto %?30?% auto;border-radius:%?130?%;overflow:hidden}.content .avatar uni-image[data-v-783c303d]{width:100%;height:100%;display:block}.content .nickname[data-v-783c303d]{font-size:%?28?%;line-height:1}.content .title[data-v-783c303d]{margin-top:%?40?%;font-size:%?32?%;line-height:1}.content .pic[data-v-783c303d]{margin:%?90?% auto 0 auto;width:%?636?%;height:%?200?%;padding:0 %?16?% 0 %?24?%}.content .pic .coupon-left[data-v-783c303d]{width:%?174?%;height:100%;color:#fff;font-size:%?56?%}.content .pic .coupon-left .discount[data-v-783c303d]:after{content:"折";font-size:%?32?%}.content .pic .coupon-left .sub[data-v-783c303d]:before{content:"￥";font-size:%?32?%}.content .pic .coupon-right[data-v-783c303d]{width:%?300?%;height:100%;font-size:%?32?%}.content .pic .coupon-right .margin-top[data-v-783c303d]{margin-top:%?16?%;font-size:%?28?%}.content .time[data-v-783c303d]{margin:%?45?% 0;font-size:%?24?%}.content .card-btn[data-v-783c303d]{width:%?284?%;height:%?76?%}.content .card-btn.btn-1[data-v-783c303d]{margin:%?410?% auto 0 auto}.content .card-btn.btn-0[data-v-783c303d]:first-child{margin-right:%?38?%}.card-modal[data-v-783c303d]{background-color:rgba(0,0,0,.5);width:100%;height:100%;position:fixed;top:0;left:0;z-index:1000}.card-modal .modal-content[data-v-783c303d]{width:%?600?%;height:%?528?%;background-size:contain;background-repeat:no-repeat;background-position:50%}.card-modal .modal-content .error[data-v-783c303d]{margin:%?290?% auto 0 auto;text-align:center;font-size:%?36?%}.card-modal .modal-content .modal-btn[data-v-783c303d]{margin:%?62?% auto 0 auto;width:%?520?%;height:%?90?%;border-radius:%?90?%}body.?%PAGE?%[data-v-783c303d]{background:#f7f7f7}',""])},abe8:function(t,e,o){"use strict";var n=o("4ea4");o("8e6e"),o("ac6a"),o("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=n(o("bd86")),i=o("2f62"),c=n(o("409e")),r=n(o("8e97")),s=n(o("972f"));function d(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,n)}return o}function u(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?d(Object(o),!0).forEach((function(e){(0,a.default)(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):d(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}var l={name:"give",components:{appGoodsRecommend:r.default,appShareQrCode:c.default},data:function(){return{comment_style:null,recommendGoodsList:null,shareShow:!1,modal:{show:!1,msg:"",is_show_back:!1},coupon:null,user_id:0,img_finish_receiving:null}},computed:u(u(u({},(0,i.mapState)({couponImg:function(t){return t.mallConfig.__wxapp_img.coupon}})),(0,i.mapGetters)("mallConfig",{getTheme:"getTheme"})),{},{contentStyle:function(){var t="";return this.coupon?(t=1===this.coupon.status?"background-image: url("+this.coupon.receive_coupon_bg+")":"background-image: url("+this.coupon.coupon_bg+")",t):""}}),onLoad:function(t){this.$commonLoad.onload(t),"undefined"!==typeof t.user_id&&(this.user_id=t.user_id),this.getList(t.coupon_id),this.loadRecommendGoodsList()},methods:{getList:function(t){var e=this;this.$showLoading(),this.$request({url:this.$api.coupon.give,data:{coupon_id:t,user_id:this.user_id}}).then((function(t){e.$hideLoading(),e.img_finish_receiving=t.data.img_finish_receiving,0==t.code?e.coupon=t.data:e.modal={show:!0,msg:t.msg,is_show_back:!0}})).catch((function(t){e.$hideLoading()}))},loadRecommendGoodsList:function(){var t=this;this.$request({url:this.$api.goods.new_recommend,method:"get",data:{type:"order_pay"}}).then((function(e){0===e.code&&(t.comment_style=e.data.comment_style,t.recommendGoodsList=e.data.list)})).catch((function(t){}))},btnClick:function(){this.modal.is_show_back?(0,s.default)({open_type:"redirect",url:"/pages/index/index"}):this.modal.show=!1},receive:function(){var t=this;this.$showLoading(),this.$request({url:this.$api.coupon.receive,method:"get",data:{coupon_id:this.coupon.id}}).then((function(e){t.$hideLoading(),0===e.code?t.getList(t.coupon.id):t.modal={show:!0,msg:e.msg,is_show_back:!1}}))},toGoods:function(){uni.redirectTo({url:this.coupon.page_url})}}};e.default=l},d9b4:function(t,e,o){"use strict";var n=o("8902"),a=o.n(n);a.a},f1eb:function(t,e,o){var n=o("aa9f");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var a=o("4f06").default;a("dc49019e",n,!0,{sourceMap:!1,shadowMode:!1})}}]);