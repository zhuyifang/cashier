(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-integral_mall-exchange-exchange"],{"02b0":function(t,e,a){"use strict";a.r(e);var o=a("6db9"),i=a("4bf9");for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);a("4b6e");var r,c=a("f0c5"),d=Object(c["a"])(i["default"],o["b"],o["c"],!1,null,"5e6a1339",null,!1,o["a"],r);e["default"]=d.exports},"0851":function(t,e,a){"use strict";var o;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return o}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[a("v-uni-view",{class:[t.shadow?"main-between app-nav shadow":"main-between app-nav"],style:[{"line-height":(t.setHeight?t.setHeight:90)+"rpx","font-size":(t.fontSize?t.fontSize:28)+"rpx",height:(t.setHeight?t.setHeight:90)+"rpx",top:t.setTop>0?t.setTop+"rpx":"0",backgroundColor:""+(t.background?t.background:"#fff")}]},t._l(t.tabList,(function(e){return a("v-uni-view",{key:e.id,staticClass:"box-grow-1 nav-item",style:[{borderBottom:(t.border?1:0)+"rpx solid #e2e2e2"}],attrs:{"data-id":e.id},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.handleClick.apply(void 0,arguments)}}},[a("v-uni-text",{class:[e.id==t.activeItem?"active-text":""],style:[{color:""+(e.id==t.activeItem?t.theme.color:"#353535"),"border-color":""+(e.id==t.activeItem?t.theme.color:""),height:(t.setHeight?t.setHeight:90)+"rpx",padding:"0 "+t.padding+"rpx"}]},[t._v(t._s(e.name))])],1)})),1),a("v-uni-view",{style:[{height:(t.placeHeight?t.placeHeight:90)+"rpx"}]})],1)},n=[]},"28ff":function(t,e,a){var o=a("aadf");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var i=a("4f06").default;i("306c997a",o,!0,{sourceMap:!1,shadowMode:!1})},"3a91":function(t,e,a){var o=a("eb6e");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var i=a("4f06").default;i("646ca0fa",o,!0,{sourceMap:!1,shadowMode:!1})},"4b6e":function(t,e,a){"use strict";var o=a("3a91"),i=a.n(o);i.a},"4bf9":function(t,e,a){"use strict";a.r(e);var o=a("89fb"),i=a.n(o);for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);e["default"]=i.a},"4d1c":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("c5f6");var o={name:"app-tab-nav",props:{background:String,setTop:{type:[Number,String]},padding:{default:45,type:[Number,String]},setHeight:Number,placeHeight:Number,fontSize:Number,theme:{type:Object,default:function(){return{color:"#ff4544"}}},border:{default:!0,type:Boolean},shadow:{default:!0,type:Boolean},activeItem:{type:[Number,String]},tabList:Array},methods:{handleClick:function(t){this.$emit("click",t)}}};e.default=o},"6db9":function(t,e,a){"use strict";var o;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return o}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("app-layout",[a("app-tab-nav",{attrs:{tabList:t.tabList,activeItem:t.activeTab,theme:t.getTheme},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.tabStatus.apply(void 0,arguments)}}}),t._l(t.list,(function(e){return 1==t.activeTab?a("v-uni-view",{key:e.id,staticClass:"coupon"},[2==e.integralCoupon.coupon.type?a("v-uni-view",{staticClass:"coupon-name"},[t._v(t._s(e.integralCoupon.coupon.sub_price)+"元优惠券 满"+t._s(e.integralCoupon.coupon.min_price)+"元可用")]):a("v-uni-view",{staticClass:"coupon-name"},[t._v(t._s(e.integralCoupon.coupon.discount)+"折优惠券 满"+t._s(e.integralCoupon.coupon.min_price)+"元可用")]),a("v-uni-view",{staticClass:"coupon-price",style:{color:t.getTheme.color}},[t._v(t._s(e.integralCoupon.integral_num)+"积分"),e.integralCoupon.price>0?a("v-uni-text",[t._v("+"+t._s(e.integralCoupon.price)+"元")]):t._e()],1),a("v-uni-view",{staticClass:"card-list",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toList.apply(void 0,arguments)}}},[a("v-uni-button",{staticClass:"to-card",style:{color:t.getTheme.color}},[t._v("去卡券包查看")])],1)],1):t._e()})),t._l(t.list,(function(e){return 2==t.activeTab?a("v-uni-view",{key:e.id,staticClass:"goods"},[a("v-uni-image",{staticClass:"goods-img",attrs:{mode:"aspectFill",src:e.detail[0].goods_info.goods_attr.pic_url?e.detail[0].goods_info.goods_attr.pic_url:e.detail[0].goods.goodsWarehouse.cover_pic}}),a("v-uni-view",{staticClass:"goods-info"},[a("v-uni-view",{staticClass:"coupon-name t-omit-two"},[t._v(t._s(e.detail[0].goods_info.name))]),a("v-uni-view",{staticClass:"coupon-price",style:{color:t.getTheme.color}},[t._v(t._s(e.detail[0].goods_info.goods_attr.extra.integral_num)+"积分+"+t._s(e.detail[0].goods_info.goods_attr.price)+"元")])],1),a("v-uni-view",{staticClass:"order-detail",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.toOrder(e.id)}}},[a("v-uni-button",{staticClass:"to-card",style:{color:t.getTheme.color}},[t._v("订单详情")])],1)],1):t._e()}))],2)},n=[]},"71af":function(t,e,a){"use strict";var o=a("28ff"),i=a.n(o);i.a},"7fd0":function(t,e,a){"use strict";a.r(e);var o=a("0851"),i=a("86a7");for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);a("71af");var r,c=a("f0c5"),d=Object(c["a"])(i["default"],o["b"],o["c"],!1,null,"c1c7a34c",null,!1,o["a"],r);e["default"]=d.exports},"86a7":function(t,e,a){"use strict";a.r(e);var o=a("4d1c"),i=a.n(o);for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);e["default"]=i.a},"89fb":function(t,e,a){"use strict";var o=a("4ea4");a("8e6e"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("ac6a");var i=o(a("bd86")),n=o(a("7fd0")),r=a("2f62");function c(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,o)}return a}function d(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?c(Object(a),!0).forEach((function(e){(0,i.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):c(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var s={name:"about",components:{"app-tab-nav":n.default},data:function(){return{list:[],tabList:[{id:1,name:"优惠券"},{id:2,name:"商品"}],page:2,activeTab:1}},computed:d(d({},(0,r.mapState)({mall:function(t){return t.mallConfig.mall}})),(0,r.mapGetters)("mallConfig",{getTheme:"getTheme"})),onLoad:function(){this.$commonLoad.onload(),this.$showLoading({type:"global",text:"加载中..."}),this.getList()},methods:{tabStatus:function(t){this.list=[],this.page=2,this.activeTab=+t.currentTarget.dataset.id,uni.showLoading({mask:!0,title:"加载中..."}),this.getList()},toOrder:function(t){uni.navigateTo({url:"/pages/order/order-detail/order-detail?id="+t})},toList:function(){uni.navigateTo({url:"/pages/coupon/index/index"})},getList:function(){var t=this,e=t.$api.integral_mall.coupon_order;2==t.activeTab&&(e=t.$api.integral_mall.order),t.$request({url:e}).then((function(e){t.$hideLoading(),uni.hideLoading(),0==e.code?t.list=e.data.list:uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(e){t.$hideLoading(),uni.hideLoading()}))}},onReachBottom:function(){var t=this,e=t.$api.integral_mall.coupon_order;2==t.activeTab&&(e=t.$api.integral_mall.order),t.$request({url:e,data:{page:t.page}}).then((function(e){if(t.$hideLoading(),0==e.code){var a=!1;t.list.forEach((function(t,o){if(t.id==e.data.list[0].id)return a=!0,!1})),a||(t.list=t.list.concat(e.data.list)),page++}else uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(e){t.$hideLoading()}))}};e.default=s},aadf:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-c1c7a34c]{text-align:center}.font-weight[data-v-c1c7a34c]{font-weight:700}.page-width[data-v-c1c7a34c]{width:100%}.goods-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-c1c7a34c]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-c1c7a34c]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-c1c7a34c]{width:100%}.u-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-c1c7a34c]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-nav[data-v-c1c7a34c]{color:#353535;width:100%;position:fixed;left:0;background-color:#fff;z-index:11}.app-nav .nav-item[data-v-c1c7a34c]{text-align:center}.app-nav .nav-item uni-text[data-v-c1c7a34c]{display:inline-block}.app-nav .active-text[data-v-c1c7a34c]{color:#ff4544;border-bottom:%?4?% solid #ff4544}.app-nav.shadow[data-v-c1c7a34c]{-webkit-box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06);box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06)}.blue-m-text[data-v-c1c7a34c]{color:#446dfd}body.?%PAGE?%[data-v-c1c7a34c]{background:#f7f7f7}",""])},eb6e:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-5e6a1339]{text-align:center}.font-weight[data-v-5e6a1339]{font-weight:700}.page-width[data-v-5e6a1339]{width:100%}.goods-hover-class[data-v-5e6a1339]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-5e6a1339]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-5e6a1339]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-5e6a1339]{width:100%}.u-hover-class[data-v-5e6a1339]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-5e6a1339]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.coupon[data-v-5e6a1339]{height:%?156?%;border-bottom:%?1?% solid #e2e2e2;position:relative;padding:%?30?% %?24?% 0;font-size:15px;background-color:#fff}.coupon-name[data-v-5e6a1339]{color:#353535}.coupon-price[data-v-5e6a1339]{margin-top:%?12?%}.to-card[data-v-5e6a1339]{height:%?56?%;line-height:%?56?%;padding:0 %?16?%;background-color:#fff;border-radius:%?28?%;border:%?1?% solid;font-size:%?28?%;width:auto}.to-card[data-v-5e6a1339]::after{border:0}.goods[data-v-5e6a1339]{height:%?200?%;border-bottom:%?1?% solid #e2e2e2;position:relative;padding:%?32?% %?24?%;font-size:15px;background-color:#fff}.goods-img[data-v-5e6a1339]{height:%?136?%;width:%?180?%;float:left;margin-right:%?16?%}.goods-info[data-v-5e6a1339]{width:72%}.order-detail[data-v-5e6a1339]{position:absolute;top:%?72?%;right:%?24?%}.card-list[data-v-5e6a1339]{position:absolute;top:%?50?%;right:%?24?%}body.?%PAGE?%[data-v-5e6a1339]{background:#f7f7f7}",""])}}]);