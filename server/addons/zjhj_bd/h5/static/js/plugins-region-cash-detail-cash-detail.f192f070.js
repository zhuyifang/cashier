(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-region-cash-detail-cash-detail"],{"03fe":function(t,e,a){"use strict";a.r(e);var i=a("131d"),n=a.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(o);e["default"]=n.a},"0851":function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[a("v-uni-view",{class:[t.shadow?"main-between app-nav shadow":"main-between app-nav"],style:[{"line-height":(t.setHeight?t.setHeight:90)+"rpx","font-size":(t.fontSize?t.fontSize:28)+"rpx",height:(t.setHeight?t.setHeight:90)+"rpx",top:t.setTop>0?t.setTop+"rpx":"0",backgroundColor:""+(t.background?t.background:"#fff")}]},t._l(t.tabList,(function(e){return a("v-uni-view",{key:e.id,staticClass:"box-grow-1 nav-item",style:[{borderBottom:(t.border?1:0)+"rpx solid #e2e2e2"}],attrs:{"data-id":e.id},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.handleClick.apply(void 0,arguments)}}},[a("v-uni-text",{class:[e.id==t.activeItem?"active-text":""],style:[{color:""+(e.id==t.activeItem?t.theme.color:"#353535"),"border-color":""+(e.id==t.activeItem?t.theme.color:""),height:(t.setHeight?t.setHeight:90)+"rpx",padding:"0 "+t.padding+"rpx"}]},[t._v(t._s(e.name))])],1)})),1),a("v-uni-view",{style:[{height:(t.placeHeight?t.placeHeight:90)+"rpx"}]})],1)},o=[]},"131d":function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("7f7f");var n=i(a("bd86")),o=i(a("7fd0")),r=a("2f62");function c(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function d(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?c(Object(a),!0).forEach((function(e){(0,n.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):c(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var s={data:function(){return{tabList:[{id:-1,name:"全部"},{id:0,name:"待审核"},{id:1,name:"待打款"},{id:2,name:"已打款"},{id:3,name:"已驳回"}],loading:null,list:[],activeTab:-1,noBorder:!1,id:null,page:2}},components:{"app-tab-nav":o.default},computed:d({},(0,r.mapState)({mall:function(t){return t.mallConfig.mall},custom_setting:function(t){return t.mallConfig.share_setting_custom},share_setting:function(t){return t.mallConfig.share_setting}})),methods:{open:function(t){this.id=t},tabStatus:function(t){uni.showLoading({mask:!0,title:"加载中..."}),this.list=[],this.page=2,this.activeTab=t.currentTarget.dataset.id,this.getList()},getList:function(){var t=this;t.$request({url:t.$api.region.detail,data:{status:t.activeTab}}).then((function(e){t.$hideLoading(),uni.hideLoading(),0==e.code?t.list=e.data.list:uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(e){t.$hideLoading(),uni.hideLoading(),t.$event.on(t.$const.EVENT_USER_LOGIN).then((function(){t.getList()}))}))},getMore:function(){var t=this;uni.showLoading({mask:!0,title:"加载中..."}),t.$request({url:t.$api.region.detail,data:{status:t.activeTab,page:t.page}}).then((function(e){if(uni.hideLoading(),0==e.code){t.loading=null;var a=e.data.list;a.length>0&&(t.list[t.list.length-1].date==a[0].date?(t.list[t.list.length-1].list=t.list[t.list.length-1].list.concat(a[0].list),a.shift(),t.list=t.list.concat(a)):t.list=t.list.concat(a),t.page++)}else uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(t){uni.hideLoading()}))},toGoods:function(t){uni.navigateTo({url:"/pages/goods/goods?id="+t})}},onLoad:function(t){this.$commonLoad.onload(t);var e=this;t.name&&uni.setNavigationBarTitle({title:t.name}),e.$showLoading({type:"global",text:"加载中..."}),e.getList()},onReachBottom:function(){this.getMore()}};e.default=s},"28ff":function(t,e,a){var i=a("aadf");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("306c997a",i,!0,{sourceMap:!1,shadowMode:!1})},3379:function(t,e,a){"use strict";var i=a("7cbc"),n=a.n(i);n.a},"4d1c":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("c5f6");var i={name:"app-tab-nav",props:{background:String,setTop:{type:[Number,String]},padding:{default:45,type:[Number,String]},setHeight:Number,placeHeight:Number,fontSize:Number,theme:{type:Object,default:function(){return{color:"#ff4544"}}},border:{default:!0,type:Boolean},shadow:{default:!0,type:Boolean},activeItem:{type:[Number,String]},tabList:Array},methods:{handleClick:function(t){this.$emit("click",t)}}};e.default=i},"71af":function(t,e,a){"use strict";var i=a("28ff"),n=a.n(i);n.a},7761:function(t,e,a){"use strict";a.r(e);var i=a("a93b"),n=a("03fe");for(var o in n)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(o);a("3379");var r,c=a("f0c5"),d=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"084d83d8",null,!1,i["a"],r);e["default"]=d.exports},"7cbc":function(t,e,a){var i=a("7f9f");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("68d22a61",i,!0,{sourceMap:!1,shadowMode:!1})},"7f9f":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-084d83d8]{text-align:center}.font-weight[data-v-084d83d8]{font-weight:700}.page-width[data-v-084d83d8]{width:100%}.goods-hover-class[data-v-084d83d8]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-084d83d8]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-084d83d8]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-084d83d8]{width:100%}.u-hover-class[data-v-084d83d8]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-084d83d8]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.list[data-v-084d83d8]{background-color:#fff;margin:%?24?% %?24?% %?12?%;border-radius:%?8?%;-webkit-box-shadow:rgba(0,0,0,.1) 0 0 %?20?%;box-shadow:rgba(0,0,0,.1) 0 0 %?20?%}.item-header[data-v-084d83d8]{color:#999;font-size:%?32?%;height:%?96?%;line-height:%?96?%;padding:0 %?32?%}.list .item[data-v-084d83d8]{padding:%?32?%;font-size:%?24?%;color:#999;border-top:1px solid #e2e2e2;position:relative}.type[data-v-084d83d8]{font-size:%?32?%;color:#353535;margin-bottom:%?8?%}.status[data-v-084d83d8]{margin-left:%?20?%;font-size:%?24?%;padding:0 %?10?%;border-radius:%?16?%;border:1px solid #ff4544;color:#ff4544}.cash[data-v-084d83d8]{position:absolute;top:%?50?%;right:%?32?%;text-align:right}.cash-price[data-v-084d83d8]{font-size:%?40?%;color:#353535}.no-list[data-v-084d83d8]{text-align:center;margin-top:%?200?%;font-size:%?24?%;color:#666}.no-list uni-image[data-v-084d83d8]{width:%?240?%;height:%?240?%;margin-bottom:%?20?%}body.?%PAGE?%[data-v-084d83d8]{background:#f7f7f7}",""])},"7fd0":function(t,e,a){"use strict";a.r(e);var i=a("0851"),n=a("86a7");for(var o in n)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(o);a("71af");var r,c=a("f0c5"),d=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"c1c7a34c",null,!1,i["a"],r);e["default"]=d.exports},"86a7":function(t,e,a){"use strict";a.r(e);var i=a("4d1c"),n=a.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(o);e["default"]=n.a},a93b:function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("app-layout",[a("app-tab-nav",{attrs:{tabList:t.tabList,background:"#f7f7f7",padding:"0",shadow:t.noBorder,border:t.noBorder,activeItem:t.activeTab},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.tabStatus.apply(void 0,arguments)}}}),0==t.list.length?a("v-uni-view",{staticClass:"no-list"},[a("v-uni-image",{attrs:{src:"/static/image/order-empty.png"}}),a("v-uni-view",[t._v("暂无任何明细")])],1):t._l(t.list,(function(e){return a("v-uni-view",{key:e.id,staticClass:"list"},[a("v-uni-view",{staticClass:"item-header"},[t._v(t._s(e.date))]),t._l(e.list,(function(e){return a("v-uni-view",{key:e.id,staticClass:"item"},[a("v-uni-view",{staticClass:"type"},["auto"==e.pay_type?a("v-uni-text",[t._v("自动打款")]):t._e(),"balance"==e.pay_type?a("v-uni-text",[t._v("提现至余额")]):t._e(),"wechat"==e.pay_type?a("v-uni-text",[t._v("提现至微信")]):t._e(),"alipay"==e.pay_type?a("v-uni-text",[t._v("提现至支付宝")]):t._e(),"bank"==e.pay_type?a("v-uni-text",[t._v("提现至银行卡")]):t._e(),a("v-uni-text",{staticClass:"status"},[t._v(t._s(e.status_text))])],1),a("v-uni-view",[t._v("提现账户："+t._s(e.extra.mobile?e.extra.mobile:"无"))]),a("v-uni-view",[t._v("提现时间："+t._s(e.time.created_at))]),e.content.reject_content?a("v-uni-view",[t._v("驳回理由："),a("v-uni-text",{staticStyle:{"word-wrap":"break-word"}},[t._v(t._s(e.content.reject_content))])],1):t._e(),a("v-uni-view",{staticClass:"cash"},[a("v-uni-view",{staticClass:"cash-price"},[t._v(t._s(e.cash.price))]),a("v-uni-view",[t._v("手续费"+t._s(e.cash.service_charge))])],1)],1)}))],2)}))],2)},o=[]},aadf:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-c1c7a34c]{text-align:center}.font-weight[data-v-c1c7a34c]{font-weight:700}.page-width[data-v-c1c7a34c]{width:100%}.goods-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-c1c7a34c]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-c1c7a34c]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-c1c7a34c]{width:100%}.u-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-c1c7a34c]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-nav[data-v-c1c7a34c]{color:#353535;width:100%;position:fixed;left:0;background-color:#fff;z-index:11}.app-nav .nav-item[data-v-c1c7a34c]{text-align:center}.app-nav .nav-item uni-text[data-v-c1c7a34c]{display:inline-block}.app-nav .active-text[data-v-c1c7a34c]{color:#ff4544;border-bottom:%?4?% solid #ff4544}.app-nav.shadow[data-v-c1c7a34c]{-webkit-box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06);box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06)}.blue-m-text[data-v-c1c7a34c]{color:#446dfd}body.?%PAGE?%[data-v-c1c7a34c]{background:#f7f7f7}",""])}}]);