(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-lottery-prize-prize"],{"0654":function(t,e,o){"use strict";var a;o.d(e,"b",(function(){return n})),o.d(e,"c",(function(){return i})),o.d(e,"a",(function(){return a}));var n=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-uni-view",[o("v-uni-view",{staticClass:"safe-area-inset-bottom"},[o("v-uni-view",{staticClass:"u-bottom-height"})],1),o("v-uni-view",{staticClass:"safe-area-inset-bottom u-bottom-fixed"},[o("v-uni-view",{staticClass:"lottery-bottom dir-left-nowrap cross-center"},[o("v-uni-view",{staticClass:"box-grow-1 dir-left-nowrap main-center cross-center",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.nav("/plugins/lottery/index/index")}}},[o("v-uni-icon",{staticClass:"icon",class:"index"===t.status?"icon-ht":"icon-hf",style:{"background-color":"index"===t.status?t.getTheme.background:""},attrs:{type:!0}}),o("v-uni-view",{style:{color:"index"===t.status?t.getTheme.color:"#999999"}},[t._v("抽奖会场")])],1),o("v-uni-view",{staticClass:"line"}),o("v-uni-view",{staticClass:"box-grow-1 dir-left-nowrap main-center cross-center",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.nav("/plugins/lottery/prize/prize")}}},[o("v-uni-icon",{staticClass:"icon",class:"index"===t.status?"icon-jf":"icon-jt",style:{"background-color":"index"===t.status?"":t.getTheme.background},attrs:{type:!0}}),o("v-uni-view",{style:{color:"index"===t.status?"#999999":t.getTheme.color}},[t._v("抽奖记录")])],1)],1)],1)],1)},i=[]},"1ba5":function(t,e,o){"use strict";var a=o("a3c1"),n=o.n(a);n.a},"33c4":function(t,e,o){"use strict";var a=o("e1e6"),n=o.n(a);n.a},"3a56":function(t,e,o){"use strict";var a=o("4ea4");o("8e6e"),o("ac6a"),o("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n=a(o("bd86")),i=o("2f62");function r(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,a)}return o}function c(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?r(Object(o),!0).forEach((function(e){(0,n.default)(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):r(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}var d={name:"common-buttom",computed:c(c({},(0,i.mapGetters)("mallConfig",{getTheme:"getTheme"})),(0,i.mapState)("gConfig",{iphone:function(t){return t.iphone},iphoneHeight:function(t){return t.iphoneHeight}})),props:{status:{type:String,default:"index"}},methods:{nav:function(t){uni.redirectTo({url:t})}}};e.default=d},"45e5":function(t,e,o){"use strict";var a;o.d(e,"b",(function(){return n})),o.d(e,"c",(function(){return i})),o.d(e,"a",(function(){return a}));var n=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("app-layout",[t.list&&0!=t.list.length?t._e():o("v-uni-view",{staticClass:"no-content"},[t._v("暂无记录")]),o("v-uni-view",{staticClass:"prize-bar dir-left-nowrap"},[o("v-uni-view",{staticClass:"box-grow-1",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.change(1)}}},[o("v-uni-text",{style:{color:1==t.type?t.getTheme.color:"#666666","border-bottom-color":1==t.type?t.getTheme.color:"#ffffff"}},[t._v("进行中")])],1),o("v-uni-view",{staticClass:"box-grow-1",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.change(2)}}},[o("v-uni-text",{style:{color:2==t.type?t.getTheme.color:"#666666","border-bottom-color":2==t.type?t.getTheme.color:"#ffffff"}},[t._v("已中奖")])],1),o("v-uni-view",{staticClass:"box-grow-1",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.change(3)}}},[o("v-uni-text",{style:{color:3==t.type?t.getTheme.color:"#666666","border-bottom-color":3==t.type?t.getTheme.color:"#ffffff"}},[t._v("未中奖")])],1)],1),o("v-uni-view",{staticClass:"prize-list"},[t._l(t.list,(function(e,a){return o("v-uni-view",{key:a,staticClass:"line"},[o("v-uni-view",{staticClass:"dir-left-nowrap goods",on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.lotteryDetail(e.lottery_id)}}},[o("v-uni-image",{staticClass:"box-grow-0",attrs:{src:e.goods.goodsWarehouse.cover_pic}}),o("v-uni-view",{staticClass:"dir-top info"},[o("v-uni-view",{staticClass:"t-omit-three name"},[t._v(t._s(e.goods.goodsWarehouse.name))]),o("v-uni-view",{staticClass:"attr-text dir-left-wrap t-omit"},[t._l(e.attr_list,(function(e,a){return[o("v-uni-text",[t._v(t._s(e.attr_group_name)+"："+t._s(e.attr_name))])]}))],2),o("v-uni-view",{staticClass:"stock"},[t._v("共"+t._s(e.lottery.stock)+"份")])],1)],1),o("v-uni-view",{staticClass:"dir-left-nowrap cross-center end"},[o("v-uni-icon",{staticClass:"box-grow-0 icon-time",attrs:{type:!0}}),o("v-uni-view",{staticClass:"box-grow-1"},[t._v(t._s(e.time))]),o("v-uni-view",{staticClass:"box-grow-0"},[o("v-uni-view",{staticClass:"prize-detail",style:{color:t.getTheme.color,"border-color":t.getTheme.color},on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.lotteryDetail(e.lottery_id)}}},[t._v("查看详情")])],1)],1)],1)})),t.load?o("app-load-text"):t._e()],2),o("common-buttom",{attrs:{status:"prize"}})],1)},i=[]},"5a76":function(t,e,o){"use strict";o.r(e);var a=o("0654"),n=o("7815");for(var i in n)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return n[t]}))}(i);o("1ba5");var r,c=o("f0c5"),d=Object(c["a"])(n["default"],a["b"],a["c"],!1,null,"6f5bb482",null,!1,a["a"],r);e["default"]=d.exports},"71a1":function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAMAAAANmfvwAAAAaVBMVEUAAACZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZlWst2SAAAAInRSTlMAzwylrZPh2bLILOqiYEjRgVnBuYp1bFQ1IRkD8fCZl2YBXbo67QAAAMRJREFUOMvFk9kOgyAQRUVbKoto3ap2v///kTVALEVIX0w8TzBzkpmbQOKiKDS3IokwALlGIOKcgdQegSpkXED7xa7Rel1GKQVxSxnmUvn6XjWlq+TQMHMrcEzNKqcFs8y7w0Mr4m5VigXRmRqBWZ8lUaRVSFw5bK5MxxXKUwasaP1B6Qo9aI9EIyMOKqRwuPTBQVc/TLJbIk5+qcKJXGQ4kcu26/5/3plVaFxpjPKEihncftFUoJFZAJkDo3GnHBFqPrc/k1QcrIrhvGIAAAAASUVORK5CYII="},7815:function(t,e,o){"use strict";o.r(e);var a=o("3a56"),n=o.n(a);for(var i in a)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return a[t]}))}(i);e["default"]=n.a},"811a":function(t,e,o){e=t.exports=o("24fb")(!1);var a=o("b605"),n=a(o("db99")),i=a(o("dd69")),r=a(o("ed7f")),c=a(o("71a1"));e.push([t.i,".text-center[data-v-6f5bb482]{text-align:center}.font-weight[data-v-6f5bb482]{font-weight:700}.page-width[data-v-6f5bb482]{width:100%}.goods-hover-class[data-v-6f5bb482]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-6f5bb482]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-6f5bb482]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-6f5bb482]{width:100%}.u-hover-class[data-v-6f5bb482]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-6f5bb482]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.lottery-bottom[data-v-6f5bb482]{width:100%;height:%?96?%;border-top:%?1?% solid #e2e2e2;color:#999}.lottery-bottom .line[data-v-6f5bb482]{height:%?48?%;width:%?1?%;background:#e2e2e2}.lottery-bottom .icon[data-v-6f5bb482]{width:%?34?%;height:%?33?%;background-repeat:no-repeat;background-size:100% 100%;margin:0 %?16?%}.lottery-bottom .icon.icon-ht[data-v-6f5bb482]{background-image:url("+n+")}.lottery-bottom .icon.icon-hf[data-v-6f5bb482]{background-image:url("+i+")}.lottery-bottom .icon.icon-jt[data-v-6f5bb482]{background-image:url("+r+")}.lottery-bottom .icon.icon-jf[data-v-6f5bb482]{background-image:url("+c+")}.lottery-bottom .gray[data-v-6f5bb482]{color:#999}.navbar+.body[data-v-6f5bb482]{padding-bottom:%?115?%}.navbar+.body .lottery-bottom[data-v-6f5bb482]{bottom:%?115?%}.u-bottom-fixed[data-v-6f5bb482]{position:fixed;bottom:0;left:0;width:100%;z-index:1500;background-color:#fff;-webkit-box-shadow:0 %?-1?% %?20?% %?-15?% #353535;box-shadow:0 %?-1?% %?20?% %?-15?% #353535}.u-bottom-height[data-v-6f5bb482]{height:%?96?%}body.?%PAGE?%[data-v-6f5bb482]{background:#f7f7f7}",""])},a3c1:function(t,e,o){var a=o("811a");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=o("4f06").default;n("30df4925",a,!0,{sourceMap:!1,shadowMode:!1})},a7a9:function(t,e,o){"use strict";var a=o("4ea4");o("8e6e"),o("ac6a"),o("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n=a(o("bd86")),i=o("2f62"),r=a(o("5a76"));function c(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,a)}return o}function d(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?c(Object(o),!0).forEach((function(e){(0,n.default)(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):c(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}var s={name:"prize",components:{commonButtom:r.default},data:function(){return{list:null,page:1,type:1,load:!1,args:!1}},computed:d({},(0,i.mapGetters)("mallConfig",{getTheme:"getTheme"})),onLoad:function(t){this.$commonLoad.onload(t),this.type=t.type?t.type:1,this.getSetting(),this.loadData()},onReachBottom:function(){var t=this;if(!t.args&&!t.load){t.load=!0;var e=t.page+1;t.$request({url:t.$api.lottery.prize,data:{page:e,type:t.type}}).then((function(o){if(0===o.code){var a=[e,0===o.data.list.length,t.list.concat(o.data.list)];t.page=a[0],t.args=a[1],t.list=a[2]}t.load=!1}))}},methods:{getSetting:function(){var t=this;t.$request({url:t.$api.lottery.setting}).then((function(t){0===t.code&&uni.setNavigationBarTitle({title:t.data.setting.title})}))},loadData:function(){var t=this;t.$showLoading({title:"加载中"}),t.$request({url:t.$api.lottery.prize,data:{type:t.type}}).then((function(e){t.$hideLoading(),0===e.code&&(t.list=e.data.list)})).catch((function(e){t.$hideLoading()}))},change:function(t){var e=[t,1,!1];this.type=e[0],this.page=e[1],this.args=e[2],this.loadData()},lotteryDetail:function(t){uni.navigateTo({url:"/plugins/lottery/detail/detail?lottery_id="+t})}}};e.default=s},c632:function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAMAAADXqc3KAAAAUVBMVEUAAACqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqo7vbaqAAAAGnRSTlMAIPjxd6VVBd2t5LkOqm1hJKMbfOzAW03QL4SWDQ4AAAC5SURBVCjPdZJtD4MgDITbysvUOUWd2+7//9ChiDUS7wM09zQh9Eq72LSNSNMaprM44FB3Qp8KUi/sPS+dQPrsv4D6aOMOmFLpALMV2tdvLVX2lcgQL4t6Nyo845kthoxXwIKBDCxdAQUYauFK4PCmBlyCETMJvIIfr4olEMFTQZInH0GDIYPvI8kTY06Pq/RxA1uCgCl9UKUf1JGoklUOsYcMd2PXoMZLUBqtdWu0Lmi0W5stluF2ff4fKw2NcisnCQAAAABJRU5ErkJggg=="},db99:function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAA6RwvCAAACTElEQVRYhe2Yu2tUURDGf9HER5S1EB+wKCkCYqEYsImCEgvBVpAUltYWItosWFgGTKFgmT/AEItALKw0bRSFYGclBlaN4COERHRHJs6B2cO555oNu5tiP7h7LvM483HuPPZepBw1EamIyICI3BaR9f/wWTe/IyIyJCKPyxzKiFwwG38Ni8iHjE/dbGK/K60SmTL9ORFZEpGfInLPZJUCMmp3yGzGjZTKRkw20wqRcdMvRPIJR+a9kyuxg6a7Gfm8deSS2EExTphmOrK4A0wCP4DTTj4CfAXuAg8jn+e2DhdGy5xI3T3fiYR+0nSn3NHXEnazbp+lomBlyaqO1QyZaRdkKqGfMV21JMGl3w5mBZgHVgH/uI4DV4FHduTLwEVgDdgD7Ha2B4BnTvfOfBTXgU/AgrNvmP8Z4FifJhwwCnzJ5Eu7MadENMneADeAowUBd7r7PwW6InlKF6Cn9wCoKBGVVYDvXToNfdTzIR/2dokEIScDkd9dJNLwRHKNrSPoOgFgn/5oHxmw0tU+ctgZfO4ACe1fr/RGq0ZnybUOBM2h1if/6vcp8AR4DWiDGwJOZuq/DGHIXY7stLd8BBaBKnDWyvdWPGtmM3NjM6hm5tjL1OyKk3XZ1m9bPOrQDn4ldCHGihcWVU07+0ojJWxX+SaD5bAd+sgGekRi9IjE6BGJse2J7G9jzEFbmwZqTGTN1voWg4V9dyV0q1GsDfRHRmO23gde2Iabbtf2MqU4b2T8HvoHTHGpyaPgNTKM8VavQftakPJXXfOHGxH5CzA1OovRRSl/AAAAAElFTkSuQmCC"},dd69:function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAMAAAANmfvwAAAAclBMVEUAAACZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZkjQ/XgAAAAJXRSTlMAgyhTwOm5YQZ0gPNKGYvk0U4zHbeocu3bwnhuZ9+SQCWwnA4KhtLBMgAAAPZJREFUOMvtkslywyAQBQdjYlsIbdbm3Vn6/38xSMiqIuUoh1xySB/mMdAHqmbkgerItjKxVeZyki+sAfp9aFwPUMfGhoP7UNjRcYbGuQIdKQ2Vr0fsXWRvuPqmoomUhGyIE1akC+cdKlIcHIdsKYrwVIKT2MmDo2ETMt/Lg/dUe6orZKlOSyh9tJBV2lN68W5YJpWCNzWSJEkINYcnwwqdLLJGMH9EqRHLbbVAZRDNDygR3fRc6pcIGGpdkL+GzSrZSEzOGDfaeZ9aiTFswyyTWdl9p6h/5ffK+bmSzsqZ5PkYNZkEVnBYR0wXkMqEzomxNsT4gU9XuyXnQaHevQAAAABJRU5ErkJggg=="},deb4:function(t,e,o){"use strict";o.r(e);var a=o("45e5"),n=o("e976");for(var i in n)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return n[t]}))}(i);o("33c4");var r,c=o("f0c5"),d=Object(c["a"])(n["default"],a["b"],a["c"],!1,null,"633cbd33",null,!1,a["a"],r);e["default"]=d.exports},e1e6:function(t,e,o){var a=o("ef8c");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=o("4f06").default;n("51e41d8b",a,!0,{sourceMap:!1,shadowMode:!1})},e976:function(t,e,o){"use strict";o.r(e);var a=o("a7a9"),n=o.n(a);for(var i in a)["default"].indexOf(i)<0&&function(t){o.d(e,t,(function(){return a[t]}))}(i);e["default"]=n.a},ed7f:function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAA6RwvCAAABpklEQVRYhe2Yv0vDQBTHv1pRJzcXBYuLIN26OFdwUToILtJFp4Kgk7g4dxac7NTNxdlVV13UxT/AQRFE6VJBQb7y6qucR9LcJTFWyBcepPT9+CS8d7kL6K9TkkWSCLEJki3frCPw0yWAFY2ohkReANjU6w3n7B7Qx8YTeInw7fk1XJO7gpyo7zTJAwd/ga5ozF5cECm6oH1QNPqh7Ahtak1jzVwlks0okJrxWAuGQRP4qhqSC3qzgSDS6fJ7m2THKmj2x5yj9YruB8A39L96EMikjl6YWtojYWNrW1Q/lc36JkjcPoirmll/2JrmD891JYnezFgbJEu9DgrID0Ut8TcAjgC8p1BrCcB6XJAHAM0UIESjSUCW5XWUEkhfDUyP5CC2onpENkJb9uLjoF2vTZEDSAfAlScEdNq8FAWymE/NX+nfTM0ZgJ0E+aXHDtMAEd0mAJl3dcynxtbAgoxnWHusH8hjhiDtMJA6gDsd2d+W1DgHUOrVGeoeaL4kL7hZAE8AKgCm7J12CioAeFYIkdz4TPfKOhzdk1z1OM3FNflScP1dleQnKnZ/WGMsBLAAAAAASUVORK5CYII="},ef8c:function(t,e,o){e=t.exports=o("24fb")(!1);var a=o("b605"),n=a(o("c632"));e.push([t.i,'.text-center[data-v-633cbd33]{text-align:center}.font-weight[data-v-633cbd33]{font-weight:700}.page-width[data-v-633cbd33]{width:100%}.goods-hover-class[data-v-633cbd33]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-633cbd33]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-633cbd33]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-633cbd33]{width:100%}.u-hover-class[data-v-633cbd33]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-633cbd33]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.attr-text[data-v-633cbd33]{color:#999;font-size:%?28?%;margin-top:%?14?%;max-width:%?480?%}.attr-text uni-text[data-v-633cbd33]:after{content:"，"}.attr-text uni-text[data-v-633cbd33]:last-child:after{content:""}.no-content[data-v-633cbd33]{color:#888;padding-top:%?200?%;text-align:center}.prize-bar[data-v-633cbd33]{position:fixed;top:0;left:0;width:100%;background:#fff;border-top:%?1?% solid #e3e3e3;border-bottom:%?1?% solid #e3e3e3;z-index:999}.prize-bar uni-view[data-v-633cbd33]{color:#666;text-align:center}.prize-bar uni-view uni-text[data-v-633cbd33]{height:%?90?%;line-height:%?90?%;border-bottom:%?4?% solid rgba(0,0,0,0);width:auto;display:inline-block}.prize-list[data-v-633cbd33]{padding-top:%?92?%}.prize-list .line[data-v-633cbd33]{margin-top:%?20?%}.prize-list .goods[data-v-633cbd33]{padding:%?24?%;border-bottom:1px solid #e2e2e2;background:#fff}.prize-list .goods uni-image[data-v-633cbd33]{display:block;width:%?160?%;height:%?160?%}.prize-list .goods .info[data-v-633cbd33]{font-size:%?28?%;margin-left:%?24?%;margin-top:%?16?%}.prize-list .goods .info .name[data-v-633cbd33]{color:#353535}.prize-list .goods .info .stock[data-v-633cbd33]{margin-top:%?10?%;color:#999}.prize-detail[data-v-633cbd33]{height:%?46?%;line-height:%?46?%;width:%?148?%;border-radius:%?24?%;border:1px solid;background:#fff;font-size:%?28?%;text-align:center}.end[data-v-633cbd33]{color:#999;font-size:%?28?%;height:%?72?%;background:#fff;padding:0 %?24?%}.end .icon-time[data-v-633cbd33]{background-repeat:no-repeat;background-size:100% 100%;height:%?24?%;width:%?24?%;margin-right:%?12?%;background-image:url('+n+")}body.?%PAGE?%[data-v-633cbd33]{background:#f7f7f7}",""])}}]);