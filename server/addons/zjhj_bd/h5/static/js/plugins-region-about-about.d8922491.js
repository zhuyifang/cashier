(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-region-about-about"],{"71e5":function(t,a,e){"use strict";e.r(a);var o=e("ed5f"),n=e("f50e");for(var i in n)["default"].indexOf(i)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(i);e("e73d");var d,u=e("f0c5"),r=Object(u["a"])(n["default"],o["b"],o["c"],!1,null,"26e63bb2",null,!1,o["a"],d);a["default"]=r.exports},"7ce6":function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var o={data:function(){return{about:""}},methods:{getList:function(){var t=this;t.$showLoading({type:"global",text:"加载中..."}),t.$request({url:t.$api.region.setting}).then((function(a){t.$hideLoading(),0==a.code?t.about=a.data.level_up_content:(t.$hideLoading(),uni.showToast({title:a.msg,icon:"none",duration:1e3}))})).catch((function(a){t.$hideLoading()}))}},onLoad:function(t){this.$commonLoad.onload(t),this.getList()}};a.default=o},b0ea:function(t,a,e){var o=e("dcf9");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var n=e("4f06").default;n("1a09305a",o,!0,{sourceMap:!1,shadowMode:!1})},dcf9:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-26e63bb2]{text-align:center}.font-weight[data-v-26e63bb2]{font-weight:700}.page-width[data-v-26e63bb2]{width:100%}.goods-hover-class[data-v-26e63bb2]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-26e63bb2]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-26e63bb2]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-26e63bb2]{width:100%}.u-hover-class[data-v-26e63bb2]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-26e63bb2]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.about[data-v-26e63bb2]{position:absolute;top:0;left:0;background-color:#fff;width:100%;height:100%;z-index:2}.about uni-view[data-v-26e63bb2]{background-color:#fff;padding:%?28?% %?24?%}body.?%PAGE?%[data-v-26e63bb2]{background:#f7f7f7}",""])},e73d:function(t,a,e){"use strict";var o=e("b0ea"),n=e.n(o);n.a},ed5f:function(t,a,e){"use strict";var o;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return i})),e.d(a,"a",(function(){return o}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("app-layout",[e("v-uni-view",{staticClass:"about"},[e("v-uni-view",[e("v-uni-text",{attrs:{space:"nbsp"}},[t._v(t._s(t.about))])],1)],1)],1)},i=[]},f50e:function(t,a,e){"use strict";e.r(a);var o=e("7ce6"),n=e.n(o);for(var i in o)["default"].indexOf(i)<0&&function(t){e.d(a,t,(function(){return o[t]}))}(i);a["default"]=n.a}}]);