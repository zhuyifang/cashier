(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-registered-nickname"],{5350:function(e,t,n){"use strict";n.r(t);var a=n("9c48"),i=n("9c9b");for(var r in i)["default"].indexOf(r)<0&&function(e){n.d(t,e,(function(){return i[e]}))}(r);n("6516");var c,o=n("f0c5"),s=Object(o["a"])(i["default"],a["b"],a["c"],!1,null,"2b700e28",null,!1,a["a"],c);t["default"]=s.exports},6516:function(e,t,n){"use strict";var a=n("a91d"),i=n.n(a);i.a},"715b":function(e,t,n){t=e.exports=n("24fb")(!1),t.push([e.i,".bd-nickname[data-v-2b700e28]{min-height:100vh}.bd-item[data-v-2b700e28]{height:%?100?%;padding:%?46?% %?42?%;background-color:#fff;position:relative}.bd-input[data-v-2b700e28]{height:%?36?%}.bd-bottom[data-v-2b700e28]{height:%?88?%;line-height:%?88?%;color:#fff;font-size:%?36?%;border-radius:%?44?%;margin-top:%?68?%;text-align:center}.bd-yes-agree[data-v-2b700e28]{background:#ff4544}.bd-no-agree[data-v-2b700e28]{background:rgba(255,69,68,.5)}.bd-comment[data-v-2b700e28]{padding:%?24?%;font-size:%?24?%;color:#999}.bd-clear[data-v-2b700e28]{width:%?25?%;height:%?25?%;position:absolute;right:%?33?%;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}",""])},"9c48":function(e,t,n){"use strict";var a;n.d(t,"b",(function(){return i})),n.d(t,"c",(function(){return r})),n.d(t,"a",(function(){return a}));var i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-uni-view",{staticClass:"bd-nickname"},[n("v-uni-view",{staticClass:"bd-item dir-left-nowrap cross-center"},[n("v-uni-input",{staticClass:"bd-input box-grow-1",attrs:{placeholder:"请输入昵称",type:"text"},model:{value:e.nickname,callback:function(t){e.nickname=t},expression:"nickname"}}),n("v-uni-image",{staticClass:"bd-clear",attrs:{src:"/static/image/icon/delete-yuan.png"},on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.clear.apply(void 0,arguments)}}})],1),n("v-uni-view",{staticClass:"bd-comment"},[e._v("注：最多可设置16个汉字，可设置含有中文、英文、数字、符号组合的昵称，但不建议设置特殊字符。")]),n("v-uni-view",{staticClass:"bd-bottom",class:e.agree?"bd-yes-agree":"bd-no-agree",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.changeName.apply(void 0,arguments)}}},[e._v("确认")])],1)},r=[]},"9c9b":function(e,t,n){"use strict";n.r(t);var a=n("aae0"),i=n.n(a);for(var r in a)["default"].indexOf(r)<0&&function(e){n.d(t,e,(function(){return a[e]}))}(r);t["default"]=i.a},a91d:function(e,t,n){var a=n("715b");"string"===typeof a&&(a=[[e.i,a,""]]),a.locals&&(e.exports=a.locals);var i=n("4f06").default;i("e44040ba",a,!0,{sourceMap:!1,shadowMode:!1})},aae0:function(e,t,n){"use strict";var a=n("4ea4");n("8e6e"),n("ac6a"),n("456d"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var i=a(n("bd86")),r=n("2f62");function c(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?c(Object(n),!0).forEach((function(t){(0,i.default)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var s={name:"nickname",data:function(){return{nickname:""}},methods:{changeName:function(){var e=this;this.agree&&(this.nickname=this.nickname.trim(),this.$request({url:this.$api.registered.nickName,method:"post",data:{nickname:this.nickname}}).then((function(t){0===t.code?(uni.navigateBack(),e.userInfo.nickname=e.nickname):uni.showToast({icon:"none",title:t.msg})})))},clear:function(){this.nickname=""}},computed:o(o({},(0,r.mapState)({userInfo:function(e){return e.user.info}})),{},{agree:function(){return this.nickname?1:0}}),mounted:function(){this.nickname=this.userInfo.nickname}};t.default=s}}]);