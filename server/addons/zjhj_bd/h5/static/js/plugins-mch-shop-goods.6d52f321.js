(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-mch-shop-goods"],{"030e":function(t,e,a){"use strict";var i=a("2130"),n=a.n(i);n.a},1490:function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[t._t("default",[t.navs&&t.navs.length>1?a("v-uni-view",{style:{height:"calc("+t.botNavHei+"rpx + env(safe-area-inset-bottom))",width:"100%"}}):t._e()]),t.navs&&t.navs.length>1?a("v-uni-view",{staticClass:"app-navigation-bar safe-area-inset-bottom",class:{"app-tab-bar-shadow":t.shadow},style:{backgroundColor:t.bottom_background_color}},t._l(t.navs,(function(e,i){return a("v-uni-view",{key:i,staticClass:"navbar-item box-grow-1",style:{height:t.botNavHei+"rpx",backgroundColor:t.bottom_background_color,width:100/t.navs.length+"%"}},[a("app-jump-button",{staticClass:"app-button",attrs:{backgroundColor:t.bottom_background_color,open_type:e.open_type,params:e.params,url:e.url,arrangement:"column",form:!0}},[a("v-uni-image",{staticClass:"app-icon",attrs:{src:t.router===e.url?e.active_icon:e.icon}}),a("v-uni-text",{staticClass:"app-nav-text",style:{color:t.router===e.url?e.active_color:e.color}},[t._v(t._s(e.text))])],1)],1)})),1):t._e()],2)},r=[]},1523:function(t,e,a){"use strict";a.r(e);var i=a("39d9"),n=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=n.a},1639:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={onLoad:function(){console.log("--商品混入--")},computed:{remindParams:function(){return{sell_time:this.sell_time,goods_id:this.goods?this.goods.id:0,template_message_list:this.template_message_list,buy_text:"立即购买"}},rightRemindText:function(){return this.remindParams.sell_time>300?"开售提醒我":this.remindParams.sell_time>0?"即将开售":this.remindParams.buy_text}},methods:{rightTip:function(){this.remindParams.sell_time<300?console.log("小于5分钟不进行开售提醒"):this.$goodsRemind(this.remindParams.template_message_list,this.remindParams.goods_id)}}};e.default=i},"1aa1":function(t,e,a){"use strict";a.r(e);var i=a("7f2c5"),n=a("efb1");for(var r in n)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(r);var o,c=a("f0c5"),s=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"2a7c6aa4",null,!1,i["a"],o);e["default"]=s.exports},"1ddd":function(t,e,a){"use strict";var i=a("35a6"),n=a.n(i);n.a},2130:function(t,e,a){var i=a("6fec");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("149c49d4",i,!0,{sourceMap:!1,shadowMode:!1})},"312d":function(t,e,a){var i=a("db11");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("e46477d4",i,!0,{sourceMap:!1,shadowMode:!1})},"356e":function(t,e,a){var i=a("54e5");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("6956903f",i,!0,{sourceMap:!1,shadowMode:!1})},"35a6":function(t,e,a){var i=a("be3d");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("43807904",i,!0,{sourceMap:!1,shadowMode:!1})},"39d9":function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n=i(a("bd86"));a("c5f6");var r=a("2f62");function o(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function c(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?o(Object(a),!0).forEach((function(e){(0,n.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):o(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var s={name:"mch-navbar",data:function(){return{router:"",navs:[],bottom_background_color:"",shadow:!1}},props:{mchId:[String,Number],pageCount:Number},computed:c({},(0,r.mapGetters)("iPhoneX",{botNavHei:"getNavHei"})),methods:{flashData:function(t){var e=this;if(t){var a=JSON.parse(JSON.stringify(t)),i=a.bottom_background_color,n=a.shadow,r=a.navs;this.bottom_background_color=i,this.shadow=n,this.navs=r.map((function(t){return t.url=t.url+"?mch_id="+e.mchId,t}))}}},created:function(){function t(){e.$request({url:e.$api.mch.diy_nav,data:{mch_id:e.mchId}}).then((function(t){0===t.code&&(e.flashData(t.data.navbar),e.$storage.setStorage({key:"MCH_NARBAR_"+e.mchId,data:t.data.navbar}))}))}this.$request({url:this.$api.index.status,data:{mch_id_list:JSON.stringify([this.mchId])}}).then((function(t){0===t.code||wx.showModal({title:"提示",showCancel:!1,content:t.msg,success:function(t){uni.navigateBack({delta:1})}})}));var e=this;e.$storage.getStorage({key:"MCH_NARBAR_"+e.mchId,success:function(a){e.flashData(a.data),t()},fail:function(e){t()}})},watch:{navs:{handler:function(t){this.$emit("setHeight",this.navs&&this.navs.length>1?"(".concat(this.botNavHei,"rpx + env(safe-area-inset-bottom))"):0)},deep:!0},$route:{handler:function(t){var e=t.query,a=t.meta,i="?";for(var n in e)i+="".concat(n,"=").concat(e[n],"&");var r="/"+a.pagePath+i;r=r.slice(0,r.length-1),this.router=r},deep:!0,immediate:!0}}};e.default=s},"3da2":function(t,e,a){"use strict";a.r(e);var i=a("66c9"),n=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=n.a},"54e5":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-08bdce4c]{text-align:center}.font-weight[data-v-08bdce4c]{font-weight:700}.page-width[data-v-08bdce4c]{width:100%}.goods-hover-class[data-v-08bdce4c]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-08bdce4c]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-08bdce4c]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-08bdce4c]{width:100%}.u-hover-class[data-v-08bdce4c]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-08bdce4c]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-no-goods[data-v-08bdce4c]{width:100%;height:%?400?%}.app-no-goods .icon[data-v-08bdce4c]{width:%?240?%;height:%?240?%}.app-no-goods .text[data-v-08bdce4c]{font-size:%?24?%;line-height:1;margin-top:%?25?%}body.?%PAGE?%[data-v-08bdce4c]{background:#f7f7f7}",""])},"571a":function(t,e,a){"use strict";a.r(e);var i=a("d908"),n=a("9fde");for(var r in n)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(r);a("030e");var o,c=a("f0c5"),s=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"fa28fc68",null,!1,i["a"],o);e["default"]=s.exports},6294:function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"app-no-goods dir-top-nowrap main-center cross-center",style:{backgroundColor:t.background}},[0===t.is_image?a("v-uni-image",{staticClass:"icon",attrs:{src:"/static/image/no-goods.png"}}):1===t.is_image?a("v-uni-image",{staticClass:"icon",attrs:{src:"/static/image/order-empty.png"}}):t._e(),a("v-uni-text",{staticClass:"text",style:{color:t.color}},[t._v(t._s(t.title))])],1)},r=[]},"666e":function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"app-preview-image",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.close.apply(void 0,arguments)}}},[a("v-uni-swiper",{staticClass:"swiper",attrs:{"current-item-id":t.currentIndex},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.changIndex.apply(void 0,arguments)}}},t._l(t.list,(function(e,i){return a("v-uni-swiper-item",{key:i,attrs:{"item-id":i}},[a("v-uni-view",{staticClass:"swiper-item main-center cross-center"},[a("v-uni-image",{directives:[{name:"show",rawName:"v-show",value:e.height,expression:"item.height"}],style:[{height:""+e.height}],attrs:{src:e.pic_url},on:{load:function(e){arguments[0]=e=t.$handleEvent(e),t.imageLoad(i,e)}}})],1)],1)})),1),a("v-uni-view",{staticClass:"attr-name main-center cross-center"},[a("v-uni-view",[t._v(t._s(t.currentName))])],1),a("v-uni-view",{staticClass:"attr-index"},[t._v(t._s(t.currentIndex+1)+"/"+t._s(t.list.length))])],1)},r=[]},"66c9":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("c5f6");var i={name:"app-no-goods",props:{background:{type:String,default:function(){return"#ffffff"}},color:{type:String,default:function(){return"#666666"}},title:{type:String,default:function(){return"没有任何商品哦~"}},is_image:{type:Number,default:function(){return 0}}}};e.default=i},"6cea":function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("55dd");var n=i(a("bd86")),r=a("2f62"),o=i(a("70a5")),c=i(a("8112")),s=i(a("24ba"));function d(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?d(Object(a),!0).forEach((function(e){(0,n.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):d(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var f={name:"goods",computed:u(u({},(0,r.mapState)({userInfo:function(t){return t.user.info}})),(0,r.mapGetters)("mallConfig",{getTheme:"getTheme"})),data:function(){return{onStart:!1,order_preview:this.$api.mch.order_preview,order_submit:this.$api.mch.order_submit,reset:!0,goods_list:[],page_count:1,coupon_id:0,page:1,cat_id:0,sort:1,tabbarbool:!0,sort_type:1,first_req:!0,listStyle:!1,noGoods:!1,loading:!1,sign:"",mch_id:""}},onLoad:function(t){this.$commonLoad.onload(t),this.mch_id=t.mch_id,this.reset=!0,this.getGoods()},onReachBottom:function(){var t=this;if(this.reset=!1,!t.args&&!t.load){t.load=!0;var e=t.page+1;t.$request({url:t.$api.mch.goods,data:{page:e,mch_id:t.mch_id,sort:2,mch_status:2,cat_id:0,sort_type:0}}).then((function(a){if(0===a.code){var i;i=5===t.sort?t.formatList(t.goods_list,a.data.list):t.goods_list.concat(a.data.list);var n=[e,0===a.data.list.length,i];t.page=n[0],t.args=n[1],t.goods_list=n[2]}t.load=!1}))}},methods:{getGoods:function(){var t=this;this.$showLoading({title:"加载中"}),t.$request({url:t.$api.mch.goods,data:{page:1,mch_id:t.mch_id,sort:2,mch_status:2,cat_id:0,sort_type:0}}).then((function(e){t.$hideLoading(),0===e.code&&(t.onStart=!0,t.goods_list=e.data.list)})).catch((function(e){t.$hideLoading()}))}},components:{"app-no-goods":c.default,mchNavbar:o.default,uOrdinaryList:s.default}};e.default=f},"6fec":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-fa28fc68]{text-align:center}.font-weight[data-v-fa28fc68]{font-weight:700}.page-width[data-v-fa28fc68]{width:100%}.goods-hover-class[data-v-fa28fc68]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-fa28fc68]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-fa28fc68]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-fa28fc68]{width:100%}.u-hover-class[data-v-fa28fc68]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-fa28fc68]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.sell-tip[data-v-fa28fc68]{width:100%;height:%?80?%;padding:0 %?32?%;background-color:#f2f2f2;border-radius:%?16?%;font-size:%?24?%}.content[data-v-fa28fc68]{font-weight:700;font-size:%?26?%}.u-time-box[data-v-fa28fc68]{margin-left:%?23?%}.u-symbol[data-v-fa28fc68]{width:%?16?%;height:%?42?%}.u-time[data-v-fa28fc68]{width:%?42?%;height:%?42?%;color:#fff;border-radius:%?8?%;background-color:#353535}body.?%PAGE?%[data-v-fa28fc68]{background:#f7f7f7}",""])},"70a5":function(t,e,a){"use strict";a.r(e);var i=a("1490"),n=a("1523");for(var r in n)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(r);a("1ddd");var o,c=a("f0c5"),s=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"01ed1c14",null,!1,i["a"],o);e["default"]=s.exports},"7f2c5":function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("app-layout",[a("v-uni-view",{staticClass:"shop"},[t.goods_list.length>0&&t.onStart?a("v-uni-view",{staticClass:"product-list"},[a("u-ordinary-list",{attrs:{reset:t.reset,pagination:!0,isShowAttr:!0,previewUrl:t.order_preview,submitUrl:t.order_submit,list:t.goods_list,theme:t.getTheme,"list-style":2}})],1):t._e(),0==t.goods_list.length&&t.onStart?a("v-uni-view",{staticStyle:{"margin-top":"240rpx"}},[a("app-no-goods",{attrs:{background:"#f7f7f7"}})],1):t._e(),t.mch_id?a("mch-navbar",{attrs:{mchId:t.mch_id}}):t._e()],1)],1)},r=[]},8112:function(t,e,a){"use strict";a.r(e);var i=a("6294"),n=a("3da2");for(var r in n)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(r);a("bb3a");var o,c=a("f0c5"),s=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"08bdce4c",null,!1,i["a"],o);e["default"]=s.exports},"8f77":function(t,e,a){"use strict";a.r(e);var i=a("666e"),n=a("ebb8");for(var r in n)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(r);a("b631");var o,c=a("f0c5"),s=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"08768c76",null,!1,i["a"],o);e["default"]=s.exports},"9cab":function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n=i(a("bd86"));a("c5f6");var r=a("2f62");function o(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function c(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?o(Object(a),!0).forEach((function(e){(0,n.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):o(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var s={name:"app-sell-tip",components:{},props:{time:{type:Number,default:function(){return 0}}},data:function(){return{timer:null,timeLog:0}},watch:{time:{handler:function(){var t=this,e=this.time;if(!(e<=0)){var a=parseInt(e/60/60/24),i=parseInt(e/60/60%24),n=parseInt(e/60%60),r=parseInt(e%60);this.timer={day:a,hour:i<10?"0"+i:i,min:n<10?"0"+n:n,sec:r<10?"0"+r:r},setTimeout((function(){e-=1,t.$emit("changeTime",e)}),1e3)}},immediate:!0}},computed:c(c({},(0,r.mapState)({isTip:function(t){return t.mallConfig.mall.setting.is_remind_sell_time}})),{},{content:function(){var t="即将开售";return 1==this.isTip&&(t+="，记得设置提醒"),t}})};e.default=s},"9fde":function(t,e,a){"use strict";a.r(e);var i=a("9cab"),n=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=n.a},b631:function(t,e,a){"use strict";var i=a("312d"),n=a.n(i);n.a},bb3a:function(t,e,a){"use strict";var i=a("356e"),n=a.n(i);n.a},be3d:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-01ed1c14]{text-align:center}.font-weight[data-v-01ed1c14]{font-weight:700}.page-width[data-v-01ed1c14]{width:100%}.goods-hover-class[data-v-01ed1c14]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-01ed1c14]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-01ed1c14]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-01ed1c14]{width:100%}.u-hover-class[data-v-01ed1c14]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-01ed1c14]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-navigation-bar[data-v-01ed1c14]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;width:100%;bottom:0;left:0;background-color:#fff;z-index:1000;position:fixed;-webkit-box-shadow:0 %?2?% 0 0 #e5e5e5;box-shadow:0 %?2?% 0 0 #e5e5e5}.navbar-item[data-v-01ed1c14]{position:relative}.app-icon[data-v-01ed1c14]{width:%?44?%;height:%?44?%;position:absolute;top:0;left:50%;margin-top:%?16?%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.app-nav-text[data-v-01ed1c14]{font-size:%?22?%;line-height:%?22?%;margin-top:%?60?%}.app-tab-bar-shadow[data-v-01ed1c14]{border-top:%?1?% solid #e2e2e2}body.?%PAGE?%[data-v-01ed1c14]{background:#f7f7f7}",""])},d908:function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return t.time>0?a("v-uni-view",{staticClass:"app-sell-tip"},[a("v-uni-view",{staticClass:"dir-left-norwap cross-center sell-tip"},[a("v-uni-view",{staticClass:"content box-grow-1"},[t._v(t._s(t.content))]),a("v-uni-view",{staticClass:"box-grow-0"},[t._v("距开始")]),t.timer?a("v-uni-view",{staticClass:"box-grow-0 dir-left-nowrap u-time-box"},[t.timer.day>0?a("v-uni-view",{staticClass:"main-center cross-center u-time"},[t._v(t._s(t.timer.day))]):t._e(),t.timer.day>0?a("v-uni-view",{staticClass:"main-center cross-center u-symbol"},[t._v(":")]):t._e(),a("v-uni-view",{staticClass:"main-center cross-center u-time"},[t._v(t._s(t.timer.hour))]),a("v-uni-view",{staticClass:"main-center cross-center u-symbol"},[t._v(":")]),a("v-uni-view",{staticClass:"main-center cross-center u-time"},[t._v(t._s(t.timer.min))]),a("v-uni-view",{staticClass:"main-center cross-center u-symbol"},[t._v(":")]),a("v-uni-view",{staticClass:"main-center cross-center u-time"},[t._v(t._s(t.timer.sec))])],1):t._e()],1)],1):t._e()},r=[]},db11:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-08768c76]{text-align:center}.font-weight[data-v-08768c76]{font-weight:700}.page-width[data-v-08768c76]{width:100%}.goods-hover-class[data-v-08768c76]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-08768c76]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-08768c76]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-08768c76]{width:100%}.u-hover-class[data-v-08768c76]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-08768c76]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-preview-image[data-v-08768c76]{position:fixed;top:0;left:0;width:100%;height:100%;background-color:#000;z-index:10000}.app-preview-image .swiper[data-v-08768c76]{width:100%;height:100%}.app-preview-image .swiper .swiper-item[data-v-08768c76]{height:100%}.app-preview-image .swiper .swiper-item uni-image[data-v-08768c76]{display:block;width:100%}.app-preview-image .attr-name[data-v-08768c76]{height:%?76?%;position:fixed;bottom:%?160?%;left:0;width:100%;z-index:10001;color:#fff;font-size:%?32?%}.app-preview-image .attr-name>uni-view[data-v-08768c76]{height:%?76?%;line-height:%?76?%;border-radius:%?38?%;display:inline-block;padding:0 %?40?%;background-color:hsla(0,0%,100%,.25);max-width:80%;white-space:nowrap;overflow:hidden;-o-text-overflow:ellipsis;text-overflow:ellipsis}.app-preview-image .attr-index[data-v-08768c76]{color:#fff;height:%?60?%;line-height:%?60?%;padding:0 %?30?%;display:inline-block;background-color:hsla(0,0%,100%,.25);position:fixed;bottom:%?60?%;right:%?40?%;border-radius:%?30?%;font-size:%?26?%;z-index:10001}body.?%PAGE?%[data-v-08768c76]{background:#f7f7f7}",""])},e6eb:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("7f7f"),a("c5f6");var i={name:"app-preview-image",data:function(){return{currentIndex:0,currentName:"",list:[]}},props:{cover_list:Array,index:{type:Number,default:function(){return 0}}},created:function(){this.list=JSON.parse(JSON.stringify(this.cover_list)),this.currentIndex=this.index,this.currentName=this.list[this.currentIndex].name},methods:{close:function(){this.$emit("change",this.currentIndex)},changIndex:function(t){this.currentIndex=t.detail.current,this.currentName=this.list[t.detail.current].name},imageLoad:function(t,e){var a=e.detail.height,i=e.detail.width,n=a*(750/i);this.list[t].height=n+"rpx",this.$forceUpdate()}}};e.default=i},ebb8:function(t,e,a){"use strict";a.r(e);var i=a("e6eb"),n=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=n.a},efb1:function(t,e,a){"use strict";a.r(e);var i=a("6cea"),n=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=n.a}}]);