(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-stock-bonus-bonus"],{7752:function(t,e,a){"use strict";var i=a("7ee6"),n=a.n(i);n.a},"7a2e":function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("app-layout",[a("v-uni-view",{staticClass:"header cross-center dir-top-nowrap",style:{"background-image":"url("+t.stock.bonus+")"}},[a("v-uni-view",[t._v(t._s(t.setting.form&&t.setting.form.bonus_title?t.setting.form.bonus_title:"股东分红")+"(元)")]),a("v-uni-view",{staticClass:"detail-price"},[t._v(t._s(t.detail.all_bonus?t.detail.all_bonus:"0.00"))]),a("v-uni-view",{staticClass:"to-cash",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toDetail.apply(void 0,arguments)}}},[a("v-uni-text",[t._v("提现明细")]),a("v-uni-image",{staticClass:"arrow-right",attrs:{src:"/static/image/icon/arrow-right-white.png"}})],1)],1),a("v-uni-view",{staticClass:"cell"},[a("v-uni-view",{staticClass:"main-between cell-item"},[a("v-uni-view",{staticClass:"label"},[t._v(t._s(t.setting.form&&t.setting.form.bonus_total?t.setting.form.bonus_total:"可提现分红"))]),a("v-uni-view",[t._v(t._s(t.detail.total_bonus?t.detail.total_bonus:"0.00")+"元")])],1)],1),a("v-uni-view",{staticClass:"cell"},[a("v-uni-view",{staticClass:"main-between cell-item"},[a("v-uni-view",{staticClass:"label"},[t._v(t._s(t.setting.form&&t.setting.form.bonus_cash?t.setting.form.bonus_cash:"已提现分红"))]),a("v-uni-view",[t._v(t._s(t.detail.cash_bonus?t.detail.cash_bonus:"0.00")+"元")])],1),a("v-uni-view",{staticClass:"main-between cell-item"},[a("v-uni-view",{staticClass:"label"},[t._v(t._s(t.setting.form&&t.setting.form.bonus_loading?t.setting.form.bonus_loading:"待打款分红"))]),a("v-uni-view",[t._v(t._s(t.detail.loading_bonus?t.detail.loading_bonus:"0.00")+"元")])],1)],1),a("v-uni-view",{staticClass:"cell",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.show=!t.show}}},[a("v-uni-view",{staticClass:"main-between cell-item"},[a("v-uni-view",{staticClass:"label"},[t._v("用户须知")]),a("v-uni-view",[a("v-uni-image",{class:["arrow-right",t.show?"show":""],attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),t.show?a("v-uni-view",{staticClass:"content"},[a("v-uni-text",[t._v(t._s(t.detail.user_instructions))])],1):t._e()],1),a("v-uni-view",{staticClass:"cash",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toCash.apply(void 0,arguments)}}},[t._v("我要提现")])],1)},o=[]},"7ee6":function(t,e,a){var i=a("8c7c");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("13ab03e8",i,!0,{sourceMap:!1,shadowMode:!1})},"8c7c":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-92080c64]{text-align:center}.font-weight[data-v-92080c64]{font-weight:700}.page-width[data-v-92080c64]{width:100%}.goods-hover-class[data-v-92080c64]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-92080c64]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-92080c64]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-92080c64]{width:100%}.u-hover-class[data-v-92080c64]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-92080c64]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.arrow-right[data-v-92080c64]{height:%?20?%;width:%?12?%}.arrow-right.show[data-v-92080c64]{-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg)}.header[data-v-92080c64]{height:%?300?%;width:100%;background-size:100% 100%;color:#fff;font-size:%?28?%;padding:%?50?% 0}.header .detail-price[data-v-92080c64]{font-size:%?80?%;font-family:Alibaba;margin:%?10?% 0 %?24?%}.header .to-cash[data-v-92080c64]{font-size:%?26?%}.header .to-cash .arrow-right[data-v-92080c64]{margin-left:%?16?%}.cell[data-v-92080c64]{font-size:%?28?%;color:#666;margin:%?20?% %?24?% 0;width:%?702?%;background-color:#fff;padding:0 %?32?%;border-radius:%?8?%}.cell .cell-item[data-v-92080c64]{border-top:%?2?% solid #e2e2e2;height:%?96?%;line-height:%?96?%}.cell .cell-item .label[data-v-92080c64]{color:#353535}.cell .cell-item[data-v-92080c64]:first-of-type{border-top:0}.cell .content[data-v-92080c64]{font-size:#353535;padding-bottom:%?24?%}.cash[data-v-92080c64]{width:%?702?%;height:%?80?%;line-height:%?80?%;text-align:center;margin:%?40?% auto 0;border-radius:%?40?%;background-color:#ff4544;color:#fff;font-size:%?32?%}body.?%PAGE?%[data-v-92080c64]{background:#f7f7f7}",""])},cbc4:function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("7f7f");var n=i(a("bd86")),o=a("2f62");function s(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function c(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?s(Object(a),!0).forEach((function(e){(0,n.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):s(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var r={data:function(){return{show:!1,cash_detail:"",setting:{},detail:{}}},computed:c({},(0,o.mapState)({stock:function(t){return t.mallConfig.__wxapp_img.stock}})),methods:{toCash:function(){uni.navigateTo({url:"/plugins/stock/cash/cash"})},toDetail:function(){var t=this.cash_detail?this.cash_detail:"";uni.navigateTo({url:"/plugins/stock/cash-detail/cash-detail?name="+t})},getSetting:function(){var t=this;t.$showLoading({type:"global",text:"加载中..."}),t.$request({url:t.$api.stock.setting}).then((function(e){t.getInfo(),0==e.code?t.setting=e.data:uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(e){t.$hideLoading(),uni.hideLoading()}))},getInfo:function(){var t=this;t.$request({url:t.$api.stock.info}).then((function(e){t.$hideLoading(),0==e.code?t.detail=e.data:uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(e){t.$hideLoading()}))}},onLoad:function(t){this.$commonLoad.onload(t),this.getSetting(),t.name&&uni.setNavigationBarTitle({title:t.name}),t.cash_detail&&(this.cash_detail=t.cash_detail)}};e.default=r},e610:function(t,e,a){"use strict";a.r(e);var i=a("cbc4"),n=a.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(o);e["default"]=n.a},e8bb:function(t,e,a){"use strict";a.r(e);var i=a("7a2e"),n=a("e610");for(var o in n)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(o);a("7752");var s,c=a("f0c5"),r=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"92080c64",null,!1,i["a"],s);e["default"]=r.exports}}]);