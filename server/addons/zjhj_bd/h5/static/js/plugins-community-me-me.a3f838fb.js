(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-community-me-me"],{"0226":function(t,e,a){"use strict";var n;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){return n}));var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("app-layout",[n("app-head",{attrs:{theme:t.getTheme}}),n("v-uni-view",{staticClass:"title dir-left-nowrap cross-center"},[n("v-uni-image",{staticClass:"avatar",attrs:{src:t.middleman.avatar}}),n("v-uni-view",{staticClass:"user-info dir-top-nowrap main-center"},[n("v-uni-view",{staticClass:"user dir-left-nowrap cross-center"},[n("v-uni-view",{staticClass:"nickname"},[t._v(t._s(t.middleman.nickname))]),n("v-uni-view",{staticClass:"middleman"},[n("v-uni-image",{attrs:{src:a("5d63")}}),n("v-uni-text",[t._v(t._s(t.setting.middleman))])],1)],1),n("v-uni-view",{staticClass:"apply"},[t._v("加入时间: "+t._s(t.apply_at))])],1)],1),n("v-uni-view",{staticClass:"money-info"},[n("v-uni-view",{staticClass:"menu",staticStyle:{margin:"0"}},[n("v-uni-view",{staticClass:"menu-item main-between cross-center"},[n("v-uni-view",[t._v("已结算"),n("v-uni-view",{staticClass:"sec-title"},[t._v("已结算金额=已提现金额+可提现金额")])],1),n("v-uni-view",{staticClass:"money"},[t._v(t._s(t.middleman.total_money))])],1),n("v-uni-view",{staticClass:"menu-item main-between cross-center"},[n("v-uni-view",[t._v("可提现")]),n("v-uni-view",{staticClass:"money"},[t._v(t._s(t.middleman.money))])],1)],1),n("v-uni-view",{staticClass:"look-money main-center cross-center",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toProfit.apply(void 0,arguments)}}},[n("v-uni-view",[t._v("查看利润明细")]),n("v-uni-image",{attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),n("v-uni-view",{staticClass:"menu"},[n("v-uni-view",{staticClass:"menu-item main-between cross-center",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toCash.apply(void 0,arguments)}}},[n("v-uni-view",[t._v("利润提现")]),n("v-uni-image",{attrs:{src:"/static/image/icon/arrow-right.png"}})],1),n("v-uni-view",{staticClass:"menu-item main-between cross-center",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toClerk.apply(void 0,arguments)}}},[n("v-uni-view",[t._v("提货核销")]),n("v-uni-image",{attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),n("v-uni-view",{staticClass:"menu"},[n("v-uni-view",{staticClass:"menu-item main-between cross-center",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.toAddress.apply(void 0,arguments)}}},[n("v-uni-view",[t._v("我的地址")]),n("v-uni-image",{attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),n("app-menu",{attrs:{theme:t.getTheme,active:"me"}})],1)},o=[]},"0d1f":function(t,e,a){var n=a("7dc6");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var i=a("4f06").default;i("045c02cb",n,!0,{sourceMap:!1,shadowMode:!1})},"0f1f":function(t,e,a){"use strict";var n=a("efce"),i=a.n(n);i.a},1220:function(t,e,a){"use strict";var n=a("0d1f"),i=a.n(n);i.a},"265c":function(t,e,a){"use strict";var n=a("625e"),i=a.n(n);i.a},"3ff8":function(t,e,a){"use strict";var n;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){return n}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[a("v-uni-view",{staticClass:"safe-area-inset-bottom"},[a("v-uni-view",{staticClass:"u-bottom-height"})],1),a("v-uni-view",{staticClass:"safe-area-inset-bottom u-bottom-fixed"},[a("v-uni-view",{staticClass:"app-menu main-between"},[t._l(t.list,(function(e,n){return[a("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:e.show,expression:"item.show"}],key:n+"_0",staticClass:"menu-btn dir-top-nowrap main-center cross-center",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.toMenu(e)}}},[a("v-uni-image",{style:{"background-color":t.active===e.key?t.theme.background:""},attrs:{src:t.active===e.key?e.active_icon:e.icon},on:{load:function(a){arguments[0]=a=t.$handleEvent(a),t.imgLoading(e)}}}),a("v-uni-view",{style:{color:t.active===e.key?t.theme.color:""}},[t._v(t._s(e.name))])],1)]}))],2)],1)],1)},o=[]},"44b7":function(t,e,a){"use strict";a.r(e);var n=a("dd2a"),i=a.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(o);e["default"]=i.a},4807:function(t,e,a){"use strict";a.r(e);var n=a("79c8"),i=a.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(o);e["default"]=i.a},"5d63":function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAB9VBMVEUAAAD/wAH/wQHhZQD/wQL/wQLiagDhaQDhagDhagDhagDhaQD/vgH/wg/hZwD6sAT/wwLdXALhagDhagD/vwL/wAH/wgLhaQDhaQDhaQD/vwH/2C7+/XTpkBz/rwHofQD/ug3/xAL+/4T/wQL/vgD/wQLhagD++GD+4kX+/nP/wQLgZwD/wQL+2TH/wQL/wQL+/3vhagDhaQD+/3v/wQL/wQH/zgD/xAH/xwH/0wDwkwHxlgH/zAH/yQH1oAHdWgD/0QHzmQHylwHwmAL/uQHukAHeXgH2uwH/2ADtigD//3/ynQP6tgH0mwHVcAHIYAH/3wD3qwD//nfehAL8xgH/2wD+1QD6ugD2rgDgZgDadwL0pgHaiAHPZAH//4r/7kv0qR/+sAXTewT8ygLtjgLefgLVdQL/vQHvuAHsrAH3ogHknwHknQHMbQH/5QDkcQDfYgDdUgD//5T//4T++X3+/W3942bz1GL+9WD/+1z/11z/6Vn/6lTvxU//5kn+1iz/yCvnghn9yhL+ww7/wQn/vAfDWQX4tALiiQLrggLohgHUgAHMcgH5zQDogQDSdQD/////7rr/5qD+72T/71j52VHoxUT+2kHYmzL+0i7SiSXicRr/0xL3xhL5vwLnpALbkQLghALjgQLtoQHmdwH1xwDBTgBiqpGwAAAANXRSTlMA7O358ubIGKKLa2JGPvTr6+jawLGsNDAeExIK8fHw7+3t6tPNvqyrqqOfmo9ycE1KSkQpHp51t80AAAJbSURBVCjPbdLVcuMwGAXgdNumzLjtMjPLimXHbNcOJw01UGZmZuYuM9Nz1lU6mTSTMx5d+PslnQsZElKbX5GZWf641pAyBbc3JKCnIj8FPrlzab4JM8i4V5mEz+9esHxqmW6CZgLqA5kPXiRgzcNrngmPZWn1fetRvzc28KgmfukNaXHMY2lcGPgf6XO0/mjDA9dPK1SmdUkbM41TnzcdMjHI7Ib2emj6pEIB5vLZ18vg28fNqMy7/WqAsmudkW6z7jcxX3n1cjLodO7aqXYvyZFWTRB+O3p0z8Cctjy7etTZGw4HAyRBkN6gm2EoGcJTLpZAXadVVQm/n9BD+jnS5UbABM7FdgO6bluL+H00gUOTg/0dTAKb6+oFx/6BSsfU9TPansy9oYF/Kj5cjUR5XjzLlN3e0e07YfWgHtkRn8Q8YgiS8LlIgrQhihLOVOugRBQmXb6ePn0JyBSyrsE4m75vI1EODHa3Op0DfS4SUVrz9Jp0FXMxAKYtJAt/9pwOkfnl3O/nNdSy+FZKw1zEdQFzgBFCDqrXzjNMKKo1T861zDUVYb7M0fp+k80q8CIligLV/G7c0vhhfeYi5pIdL2c6GdgSZYRk5J4f9UxYRpd2SjDnsA3WNjwAg1beDeH6mzHL+MKXkfuYzxuH2aEwTYAuaIL6B6SvnqmVEdaYZcDJyilU2L9BQq8AIQA0515RRgpzquNvsSo7XWEPbZwZQjNnO1TY9FtVhsQ8K0tnFc3mbbO162h8akhOXlkD2zA0pC/GvGTDFfNKhxVluDQXV0qRrNzs7NzqxD/HaciyNJuwIy4AAAAASUVORK5CYII="},"5eb1":function(t,e,a){"use strict";a.r(e);var n=a("d6bc"),i=a.n(n);for(var o in n)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return n[t]}))}(o);e["default"]=i.a},"625e":function(t,e,a){var n=a("7e54");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var i=a("4f06").default;i("6a35cf13",n,!0,{sourceMap:!1,shadowMode:!1})},"79c8":function(t,e,a){"use strict";var n=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i=n(a("bd86")),o=a("2f62");function r(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function c(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?r(Object(a),!0).forEach((function(e){(0,i.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):r(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var d={name:"app-head",props:{apply:Boolean,height:{type:String,default:function(){return"360rpx"}},theme:Object},data:function(){return{head:""}},computed:c({},(0,o.mapState)({community:function(t){return t.mallConfig.__wxapp_img.community}}))};e.default=d},"7c78":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-1994bf99]{text-align:center}.font-weight[data-v-1994bf99]{font-weight:700}.page-width[data-v-1994bf99]{width:100%}.goods-hover-class[data-v-1994bf99]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-1994bf99]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-1994bf99]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-1994bf99]{width:100%}.u-hover-class[data-v-1994bf99]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-1994bf99]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.title[data-v-1994bf99]{height:%?220?%;margin-top:%?-360?%;width:100%;padding:0 %?45?%;position:relative;z-index:10}.title .avatar[data-v-1994bf99]{width:%?130?%;height:%?130?%;margin-right:%?25?%;display:block;border-radius:50%}.title .user-info[data-v-1994bf99]{color:#fff;height:%?130?%}.title .user-info .user[data-v-1994bf99]{height:%?36?%;line-height:%?36?%}.title .user-info .user .nickname[data-v-1994bf99]{font-size:%?28?%;margin-right:%?20?%}.title .user-info .user .middleman[data-v-1994bf99]{height:%?36?%;background-color:#353535;border-radius:%?18?%;padding:0 %?12?% 0 %?6?%;font-size:%?22?%}.title .user-info .user .middleman uni-image[data-v-1994bf99]{float:left;margin-top:%?2?%;width:%?32?%;height:%?32?%;display:block;margin-right:%?6?%}.title .user-info .apply[data-v-1994bf99]{color:#fff;font-size:%?26?%;margin-top:%?20?%}.money-info[data-v-1994bf99]{width:%?702?%;margin:0 %?24?%;border-radius:%?16?%;background-color:#fff;position:relative;z-index:10}.money-info .menu[data-v-1994bf99]{border-bottom-left-radius:0;border-bottom-right-radius:0}.money-info .menu .menu-item[data-v-1994bf99]{height:%?115?%;font-size:%?26?%}.money-info .menu .menu-item .sec-title[data-v-1994bf99]{font-size:%?20?%;margin-top:%?8?%;color:#999}.money-info .menu .menu-item .money[data-v-1994bf99]{font-family:Alibaba;font-size:%?40?%;color:#f39800}.money-info .look-money[data-v-1994bf99]{height:%?88?%;border-top:%?2?% solid #e2e2e2;font-size:%?26?%;color:#999}.money-info .look-money uni-image[data-v-1994bf99]{width:%?12?%;height:%?22?%;margin-left:%?15?%;display:block}.menu[data-v-1994bf99]{border-radius:%?16?%;background-color:#fff;width:%?702?%;margin:%?15?% %?24?% 0}.menu .menu-item[data-v-1994bf99]{padding:%?32?%;height:%?96?%;border-top:%?2?% solid #e2e2e2;font-size:%?26?%;color:#353535}.menu .menu-item[data-v-1994bf99]:first-of-type{border-top:0}.menu .menu-item uni-image[data-v-1994bf99]{width:%?12?%;height:%?22?%;display:block}body.?%PAGE?%[data-v-1994bf99]{background:#f7f7f7}",""])},"7dc6":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-b6d7abda]{text-align:center}.font-weight[data-v-b6d7abda]{font-weight:700}.page-width[data-v-b6d7abda]{width:100%}.goods-hover-class[data-v-b6d7abda]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-b6d7abda]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-b6d7abda]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-b6d7abda]{width:100%}.u-hover-class[data-v-b6d7abda]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-b6d7abda]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.u-bottom-fixed[data-v-b6d7abda]{position:fixed;bottom:0;left:0;width:100%;z-index:1500;background-color:#fff}.u-bottom-height[data-v-b6d7abda]{height:%?90?%}.app-menu[data-v-b6d7abda]{height:%?90?%;width:100%;background-color:#fff;font-size:%?22?%;border-top:%?2?% solid #e2e2e2}.app-menu .menu-btn[data-v-b6d7abda]{width:%?200?%;color:#666;text-align:center;height:%?90?%}.app-menu .menu-btn uni-image[data-v-b6d7abda]{width:%?40?%;height:%?40?%;margin-bottom:%?3?%}body.?%PAGE?%[data-v-b6d7abda]{background:#f7f7f7}",""])},"7e54":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-f1accd10]{text-align:center}.font-weight[data-v-f1accd10]{font-weight:700}.page-width[data-v-f1accd10]{width:100%}.goods-hover-class[data-v-f1accd10]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-f1accd10]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-f1accd10]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-f1accd10]{width:100%}.u-hover-class[data-v-f1accd10]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-f1accd10]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.head-bg[data-v-f1accd10]{width:%?750?%;height:%?360?%}body.?%PAGE?%[data-v-f1accd10]{background:#f7f7f7}",""])},"93b2":function(t,e,a){"use strict";a.r(e);var n=a("3ff8"),i=a("44b7");for(var o in i)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(o);a("1220");var r,c=a("f0c5"),d=Object(c["a"])(i["default"],n["b"],n["c"],!1,null,"b6d7abda",null,!1,n["a"],r);e["default"]=d.exports},a54e:function(t,e,a){"use strict";a.r(e);var n=a("0226"),i=a("5eb1");for(var o in i)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(o);a("0f1f");var r,c=a("f0c5"),d=Object(c["a"])(i["default"],n["b"],n["c"],!1,null,"1994bf99",null,!1,n["a"],r);e["default"]=d.exports},ac02:function(t,e,a){"use strict";var n;a.d(e,"b",(function(){return i})),a.d(e,"c",(function(){return o})),a.d(e,"a",(function(){return n}));var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-image",{staticClass:"head-bg",style:{height:t.height,"background-color":t.theme.background},attrs:{src:t.apply?t.community.apply:t.community.bg}})},o=[]},d0d3:function(t,e,a){"use strict";a.r(e);var n=a("ac02"),i=a("4807");for(var o in i)["default"].indexOf(o)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(o);a("265c");var r,c=a("f0c5"),d=Object(c["a"])(i["default"],n["b"],n["c"],!1,null,"f1accd10",null,!1,n["a"],r);e["default"]=d.exports},d6bc:function(t,e,a){"use strict";var n=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i=n(a("bd86")),o=a("2f62"),r=n(a("93b2")),c=n(a("d0d3"));function d(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function u(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?d(Object(a),!0).forEach((function(e){(0,i.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):d(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var s={data:function(){return{middleman:{},setting:{},apply_at:""}},components:{"app-menu":r.default,"app-head":c.default},computed:u(u({},(0,o.mapGetters)("mallConfig",{getTheme:"getTheme"})),(0,o.mapState)({stock:function(t){return t.mallConfig.__wxapp_img.stock},bonusImg:function(t){return t.mallConfig.__wxapp_img.bonus},userInfo:function(t){return t.user.info}})),onShow:function(t){this.getStatus()},methods:{toProfit:function(){uni.navigateTo({url:"/plugins/community/profit/profit"})},toCash:function(){uni.navigateTo({url:"/plugins/community/profit-cash/profit-cash"})},toClerk:function(){uni.navigateTo({url:"/plugins/community/clerk/clerk"})},toAddress:function(){uni.navigateTo({url:"/plugins/community/apply/apply?id="+this.middleman.id})},getStatus:function(){var t=this,e=this;e.$request({url:e.$api.community.index}).then((function(e){0==e.code?(t.setting=e.data.setting,e.data.middleman.id>0?(t.middleman=e.data.middleman,t.apply_at=t.middleman.apply_at.substring(0,10)):(uni.showToast({title:"您还不是团长，现在前往申请页面",icon:"none",duration:1e3}),setTimeout((function(){uni.redirectTo({url:"/plugins/community/apply/apply"})}),1e3))):uni.showToast({title:e.msg,icon:"none",duration:1e3})})).catch((function(t){e.$hideLoading()}))}}};e.default=s},dd2a:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"app-index",props:{active:{type:String},theme:Object},data:function(){return{list:[{show:!1,key:"activity",name:"活动",active_icon:"./../image/activity-active.png",icon:"./../image/activity.png",path:"/plugins/community/index/index"},{show:!1,key:"order",name:"订单",active_icon:"./../image/order-active.png",icon:"./../image/order.png",path:"/plugins/community/order/order"},{show:!1,key:"me",name:"我的",active_icon:"./../image/me-active.png",icon:"./../image/me.png",path:"/plugins/community/me/me"}]}},methods:{imgLoading:function(t){t.show=!0},toMenu:function(t){if(this.active===t.key)return!1;uni.redirectTo({url:t.path})}}};e.default=n},efce:function(t,e,a){var n=a("7c78");"string"===typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);var i=a("4f06").default;i("7bc300ea",n,!0,{sourceMap:!1,shadowMode:!1})}}]);