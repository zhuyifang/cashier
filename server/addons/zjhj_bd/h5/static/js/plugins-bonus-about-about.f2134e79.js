(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-bonus-about-about"],{"186e":function(t,e,n){"use strict";var a=n("4ea4");n("8e6e"),n("ac6a"),n("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,n("7f7f");var o=a(n("bd86")),i=n("2f62");function r(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function c(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?r(Object(n),!0).forEach((function(e){(0,o.default)(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var u={data:function(){return{become_name:"下线分销商",rate_name:"提成比例",loadingOver:!1,list:[]}},computed:c({},(0,i.mapState)({userInfo:function(t){return t.user.info},bonusImg:function(t){return t.mallConfig.__wxapp_img.bonus}})),methods:{getList:function(){var t=this;this.$request({url:this.$api.bonus.member}).then((function(e){t.$hideLoading(),0===e.code?(t.list=e.data.list,t.loadingOver=!0):uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(){t.$hideLoading()}))}},onLoad:function(t){this.$commonLoad.onload();var e=this;this.become_name=t.name?t.name:"下线分销商",this.rate_name=t.rate?t.rate:"提成比例",e.$showLoading({type:"global",text:"加载中..."}),e.getList()}};e.default=u},"23fb":function(t,e,n){"use strict";n.r(e);var a=n("ef7a"),o=n("3425");for(var i in o)["default"].indexOf(i)<0&&function(t){n.d(e,t,(function(){return o[t]}))}(i);n("5ff0");var r,c=n("f0c5"),u=Object(c["a"])(o["default"],a["b"],a["c"],!1,null,"37becd8c",null,!1,a["a"],r);e["default"]=u.exports},3425:function(t,e,n){"use strict";n.r(e);var a=n("186e"),o=n.n(a);for(var i in a)["default"].indexOf(i)<0&&function(t){n.d(e,t,(function(){return a[t]}))}(i);e["default"]=o.a},"5ff0":function(t,e,n){"use strict";var a=n("8b85"),o=n.n(a);o.a},"8b85":function(t,e,n){var a=n("d2c1f");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=n("4f06").default;o("4a190a00",a,!0,{sourceMap:!1,shadowMode:!1})},d2c1f:function(t,e,n){e=t.exports=n("24fb")(!1),e.push([t.i,".text-center[data-v-37becd8c]{text-align:center}.font-weight[data-v-37becd8c]{font-weight:700}.page-width[data-v-37becd8c]{width:100%}.goods-hover-class[data-v-37becd8c]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-37becd8c]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-37becd8c]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-37becd8c]{width:100%}.u-hover-class[data-v-37becd8c]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-37becd8c]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.page[data-v-37becd8c]{font-size:%?28?%;color:#353535;position:absolute;width:100%;height:100%;background-color:#fff;padding:%?28?% 0}.list[data-v-37becd8c]{background-color:#fff;padding:0 %?28?%}body.?%PAGE?%[data-v-37becd8c]{background:#f7f7f7}",""])},ef7a:function(t,e,n){"use strict";var a;n.d(e,"b",(function(){return o})),n.d(e,"c",(function(){return i})),n.d(e,"a",(function(){return a}));var o=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("app-layout",[t.loadingOver?n("v-uni-view",{staticClass:"page"},[n("v-uni-view",{staticClass:"list"},[t._v(t._s(t.rate_name)+"分"+t._s(t.list.length)+"个等级")]),t._l(t.list,(function(e){return n("v-uni-view",{key:e.id,staticClass:"list"},[0==e.update_type?n("v-uni-text",[t._v("分销佣金")]):t._e(),1==e.update_type?n("v-uni-text",[t._v("已提现佣金")]):t._e(),2==e.update_type?n("v-uni-text",[t._v("下线人数")]):t._e(),3==e.update_type?n("v-uni-text",[t._v(t._s(t.become_name)+"数")]):t._e(),4==e.update_type?n("v-uni-text",[t._v("下级队长数")]):t._e(),n("v-uni-text",[t._v("达到"+t._s(e.update_condition))]),e.update_type>1?n("v-uni-text",[t._v("人,")]):t._e(),e.update_type<2?n("v-uni-text",[t._v("元,")]):t._e(),n("v-uni-text",[t._v("提成等级比例为"+t._s(e.rate)+"%")])],1)}))],2):t._e()],1)},i=[]}}]);