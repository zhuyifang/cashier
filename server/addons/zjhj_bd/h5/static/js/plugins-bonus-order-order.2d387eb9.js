(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-bonus-order-order"],{"0851":function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return i}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("v-uni-view",[e("v-uni-view",{class:[t.shadow?"main-between app-nav shadow":"main-between app-nav"],style:[{"line-height":(t.setHeight?t.setHeight:90)+"rpx","font-size":(t.fontSize?t.fontSize:28)+"rpx",height:(t.setHeight?t.setHeight:90)+"rpx",top:t.setTop>0?t.setTop+"rpx":"0",backgroundColor:""+(t.background?t.background:"#fff")}]},t._l(t.tabList,(function(a){return e("v-uni-view",{key:a.id,staticClass:"box-grow-1 nav-item",style:[{borderBottom:(t.border?1:0)+"rpx solid #e2e2e2"}],attrs:{"data-id":a.id},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.handleClick.apply(void 0,arguments)}}},[e("v-uni-text",{class:[a.id==t.activeItem?"active-text":""],style:[{color:""+(a.id==t.activeItem?t.theme.color:"#353535"),"border-color":""+(a.id==t.activeItem?t.theme.color:""),height:(t.setHeight?t.setHeight:90)+"rpx",padding:"0 "+t.padding+"rpx"}]},[t._v(t._s(a.name))])],1)})),1),e("v-uni-view",{style:[{height:(t.placeHeight?t.placeHeight:90)+"rpx"}]})],1)},o=[]},"1f34":function(t,a,e){var i=e("bc72d");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=e("4f06").default;n("528e4af9",i,!0,{sourceMap:!1,shadowMode:!1})},"28ff":function(t,a,e){var i=e("aadf");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=e("4f06").default;n("306c997a",i,!0,{sourceMap:!1,shadowMode:!1})},"4d1c":function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0,e("c5f6");var i={name:"app-tab-nav",props:{background:String,setTop:{type:[Number,String]},padding:{default:45,type:[Number,String]},setHeight:Number,placeHeight:Number,fontSize:Number,theme:{type:Object,default:function(){return{color:"#ff4544"}}},border:{default:!0,type:Boolean},shadow:{default:!0,type:Boolean},activeItem:{type:[Number,String]},tabList:Array},methods:{handleClick:function(t){this.$emit("click",t)}}};a.default=i},"5b23":function(t,a,e){"use strict";var i=e("1f34"),n=e.n(i);n.a},"71af":function(t,a,e){"use strict";var i=e("28ff"),n=e.n(i);n.a},"7fd0":function(t,a,e){"use strict";e.r(a);var i=e("0851"),n=e("86a7");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(o);e("71af");var r,c=e("f0c5"),s=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"c1c7a34c",null,!1,i["a"],r);a["default"]=s.exports},"86a7":function(t,a,e){"use strict";e.r(a);var i=e("4d1c"),n=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(o);a["default"]=n.a},"9f34":function(t,a,e){"use strict";var i=e("4ea4");e("8e6e"),e("ac6a"),e("456d"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var n=i(e("bd86")),o=i(e("7fd0")),r=e("2f62");function c(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);a&&(i=i.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,i)}return e}function s(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?c(Object(e),!0).forEach((function(a){(0,n.default)(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):c(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}var d={data:function(){return{theme:{color:"#ff4544"},tabList:[{id:1,name:"未完成"},{id:2,name:"已完成"}],loading:null,list:[],activeTab:1,page:2,keyword:"",toSearch:!1,haveKeyword:!1}},components:{"app-tab-nav":o.default},computed:s({},(0,r.mapState)({mall:function(t){return t.mallConfig.mall}})),methods:{open:function(t){this.id=t},goSearch:function(){uni.showLoading({mask:!0,title:"加载中..."}),this.getList()},tabStatus:function(t){uni.showLoading({mask:!0,title:"加载中..."}),this.list=[],this.page=2,this.activeTab=t.currentTarget.dataset.id,this.getList()},getSetting:function(){var t=this;t.$request({url:t.$api.bonus.setting}).then((function(a){0==a.code?(t.setting=a.data.list,t.setting.form&&t.setting.form.orders?uni.setNavigationBarTitle({title:t.setting.form.orders}):uni.setNavigationBarTitle({title:"分红订单"})):uni.showToast({title:a.msg,icon:"none",duration:1e3})})).catch((function(a){t.$event.on(t.$const.EVENT_USER_LOGIN).then((function(){t.getSetting()}))}))},getList:function(){var t=this;t.$request({url:t.$api.bonus.order,data:{status:t.activeTab,keyword:t.keyword}}).then((function(a){t.$hideLoading(),uni.hideLoading(),0==a.code?t.list=a.data.list:uni.showToast({title:a.msg,icon:"none",duration:1e3})})).catch((function(a){t.$hideLoading(),uni.hideLoading(),t.$event.on(t.$const.EVENT_USER_LOGIN).then((function(){t.getList()}))}))},getMore:function(){var t=this;uni.showLoading({mask:!0,title:"加载中..."}),t.$request({url:t.$api.bonus.order,data:{status:t.activeTab,keyword:t.keyword,page:t.page}}).then((function(a){uni.hideLoading(),0==a.code?a.data.list.length>0&&(t.loading=null,t.list=t.list.concat(a.data.list),t.page++):uni.showToast({title:a.msg,icon:"none",duration:1e3})})).catch((function(t){uni.hideLoading()}))},cancelSeacrch:function(){this.keyword="",this.toSearch=!this.toSearch,this.getList(),this.$hideLoading()}},onLoad:function(t){this.$commonLoad.onload(t);var a=this;t.nickname&&(a.keyword=t.nickname,a.haveKeyword=!0,a.toSearch=!0),a.$showLoading({text:"加载中..."}),a.getSetting(),a.getList()},onReachBottom:function(){this.getMore()}};a.default=d},a02c:function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return i}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("app-layout",[e("v-uni-view",{staticClass:"search"},[t.toSearch?e("v-uni-view",{staticClass:"dir-left-norwap cross-center search-area"},[e("v-uni-view",{staticClass:"search-input"},[e("v-uni-image",{attrs:{src:"/static/image/icon/icon-search.png"}}),e("v-uni-input",{attrs:{focus:!t.haveKeyword,"confirm-type":"search","placeholder-style":"color:#999999;font-size:13px;",placeholder:"请输入订单号或昵称搜索"},on:{confirm:function(a){arguments[0]=a=t.$handleEvent(a),t.getList.apply(void 0,arguments)}},model:{value:t.keyword,callback:function(a){t.keyword=a},expression:"keyword"}})],1),e("v-uni-view",{staticClass:"cancel",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.cancelSeacrch.apply(void 0,arguments)}}},[t._v("取消")])],1):e("v-uni-view",{staticClass:"main-center search-content cross-center",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.toSearch=!t.toSearch}}},[e("v-uni-image",{attrs:{src:"/static/image/icon/icon-search.png"}}),e("v-uni-text",[t._v("搜索")])],1)],1),e("app-tab-nav",{attrs:{setTop:"88",tabList:t.tabList,activeItem:t.activeTab,padding:"0",theme:t.theme},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.tabStatus.apply(void 0,arguments)}}}),e("v-uni-view",{staticClass:"placeholder"}),t.list&&t.list.length>0?e("v-uni-view",{staticClass:"list"},t._l(t.list,(function(a){return e("v-uni-view",{key:a.id,staticClass:"order-item"},[e("v-uni-view",{staticClass:"order-no"},[t._v("订单号 "+t._s(a.order_no))]),e("v-uni-view",{staticClass:"main-between cross-center"},[e("v-uni-view",{staticClass:"goods-item dir-left-nowrap"},[e("v-uni-image",{staticClass:"goods-img",attrs:{src:a.avatar}}),e("v-uni-view",{staticClass:"t-omit order-nickname"},[t._v(t._s(a.nickname))])],1),e("v-uni-view",{staticClass:"bonus-info"},[e("v-uni-view",{staticClass:"goods-price"},[t._v("商品金额"),e("v-uni-text",[t._v("￥"+t._s(a.total_pay_price))])],1),e("v-uni-view",{staticClass:"bonus-price"},[t._v(t._s(t.setting.form.price_text?t.setting.form.price_text:"分红金额")),e("v-uni-text",[t._v("￥"+t._s(a.bonus_price))])],1)],1)],1)],1)})),1):t._e(),t.list&&0==t.list.length?e("v-uni-view",{staticClass:"no-tip"},[e("v-uni-image",{attrs:{src:"/static/image/order-empty.png"}}),e("span",[t._v("暂无"+t._s(1==t.activeTab?"未完成":2==t.activeTab?"已完成":"")+"订单")])],1):t._e()],1)},o=[]},aadf:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-c1c7a34c]{text-align:center}.font-weight[data-v-c1c7a34c]{font-weight:700}.page-width[data-v-c1c7a34c]{width:100%}.goods-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-c1c7a34c]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-c1c7a34c]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-c1c7a34c]{width:100%}.u-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-c1c7a34c]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-nav[data-v-c1c7a34c]{color:#353535;width:100%;position:fixed;left:0;background-color:#fff;z-index:11}.app-nav .nav-item[data-v-c1c7a34c]{text-align:center}.app-nav .nav-item uni-text[data-v-c1c7a34c]{display:inline-block}.app-nav .active-text[data-v-c1c7a34c]{color:#ff4544;border-bottom:%?4?% solid #ff4544}.app-nav.shadow[data-v-c1c7a34c]{-webkit-box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06);box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06)}.blue-m-text[data-v-c1c7a34c]{color:#446dfd}body.?%PAGE?%[data-v-c1c7a34c]{background:#f7f7f7}",""])},bc72d:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-516aa5f6]{text-align:center}.font-weight[data-v-516aa5f6]{font-weight:700}.page-width[data-v-516aa5f6]{width:100%}.goods-hover-class[data-v-516aa5f6]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-516aa5f6]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-516aa5f6]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-516aa5f6]{width:100%}.u-hover-class[data-v-516aa5f6]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-516aa5f6]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.no-tip[data-v-516aa5f6]{position:fixed;top:%?400?%;left:0;right:0;margin:0 auto;color:#666;font-size:%?24?%;width:%?240?%;text-align:center}.no-tip uni-image[data-v-516aa5f6]{height:%?240?%;width:%?240?%;margin-bottom:%?20?%}.search[data-v-516aa5f6]{height:%?88?%;padding:%?16?% %?26?%;background-color:#efeff4;position:fixed;top:0;left:0;right:0;z-index:10}.search uni-input[data-v-516aa5f6]{padding:0 %?30?%}.search-content[data-v-516aa5f6]{background-color:#fff;height:%?56?%;border-radius:%?28?%}.search-content uni-image[data-v-516aa5f6]{height:%?24?%;width:%?24?%}.search-content uni-text[data-v-516aa5f6]{color:#b2b2b2;font-size:%?24?%;margin:0 %?5?%}.search-area[data-v-516aa5f6]{height:%?56?%}.placeholder[data-v-516aa5f6]{height:%?88?%}.order-item[data-v-516aa5f6]{margin:%?16?% %?24?% 0;border-radius:%?16?%;background-color:#fff;padding:%?28?% %?24?%;font-size:%?28?%;color:#353535}.order-no[data-v-516aa5f6]{margin-bottom:%?28?%}.order-nickname[data-v-516aa5f6]{width:%?240?%}.goods-item[data-v-516aa5f6]{height:%?80?%;line-height:%?80?%;width:%?330?%}.goods-img[data-v-516aa5f6]{height:%?80?%;width:%?80?%;border-radius:%?10?%;margin-right:%?24?%}.bonus-info[data-v-516aa5f6]{font-size:%?24?%;color:#999}.search-input[data-v-516aa5f6]{height:%?56?%;position:relative;width:%?620?%}.search-input uni-image[data-v-516aa5f6]{height:%?22?%;width:%?22?%;position:absolute;top:%?17?%;left:%?28?%;z-index:10}.search-input uni-input[data-v-516aa5f6]{padding-left:%?66?%;background-color:#fff;border-radius:%?32?%;height:%?56?%;font-size:%?26?%;color:#353535}.cancel[data-v-516aa5f6]{margin-left:%?16?%;font-size:%?28?%;color:#00c203}.goods-price[data-v-516aa5f6]{margin-bottom:%?4?%}.goods-price uni-text[data-v-516aa5f6]{font-size:%?24?%;color:#353535}.bonus-price uni-text[data-v-516aa5f6]{font-size:%?28?%;color:#ff4544}body.?%PAGE?%[data-v-516aa5f6]{background:#f7f7f7}",""])},dd2b:function(t,a,e){"use strict";e.r(a);var i=e("9f34"),n=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(o);a["default"]=n.a},f100:function(t,a,e){"use strict";e.r(a);var i=e("a02c"),n=e("dd2b");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(o);e("5b23");var r,c=e("f0c5"),s=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"516aa5f6",null,!1,i["a"],r);a["default"]=s.exports}}]);