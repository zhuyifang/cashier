(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-registered-setting"],{"0a25":function(e,t,a){"use strict";a.r(t);var r=a("0a6b"),n=a("6531");for(var i in n)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(i);a("eba3");var o,s=a("f0c5"),u=Object(s["a"])(n["default"],r["b"],r["c"],!1,null,"6613079a",null,!1,r["a"],o);t["default"]=u.exports},"0a6b":function(e,t,a){"use strict";var r;a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return i})),a.d(t,"a",(function(){return r}));var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"bd-setting"},[a("v-uni-view",{staticClass:"bd-item dir-left-nowrap main-between cross-center",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.router("/pages/registered/authentication")}}},[a("v-uni-text",[e._v("手机号")]),a("v-uni-view",[a("v-uni-text",[e._v(e._s(e._f("setIphone")(e.userInfo&&e.userInfo.mobile)))]),a("v-uni-image",{staticClass:"bd-arrow",attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),a("v-uni-view",{staticClass:"bd-item dir-left-nowrap main-between cross-center",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.router("/pages/registered/password")}}},[a("v-uni-text",[e._v("登入密码")]),a("v-uni-view",[a("v-uni-text",[e._v("修改")]),a("v-uni-image",{staticClass:"bd-arrow",attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),a("v-uni-view",{staticClass:"bd-item dir-left-nowrap main-between cross-center",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.setAvatar.apply(void 0,arguments)}}},[a("v-uni-text",[e._v("头像")]),a("v-uni-view",{staticClass:"cross-center"},[a("v-uni-image",{staticClass:"bd-avatar",attrs:{src:e.userInfo.avatar}}),a("v-uni-image",{staticClass:"bd-arrow",attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),a("v-uni-view",{staticClass:"bd-item dir-left-nowrap main-between cross-center",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.router("/pages/registered/nickname")}}},[a("v-uni-text",[e._v("昵称")]),a("v-uni-view",[a("v-uni-text",[e._v(e._s(e.userInfo.nickname))]),a("v-uni-image",{staticClass:"bd-arrow",attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),a("v-uni-view",{staticClass:"bd-btn",on:{click:function(t){arguments[0]=t=e.$handleEvent(t),e.logOut.apply(void 0,arguments)}}},[e._v("退出登入")])],1)},i=[]},6531:function(e,t,a){"use strict";a.r(t);var r=a("d3f2"),n=a.n(r);for(var i in r)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return r[e]}))}(i);t["default"]=n.a},b6a4:function(e,t,a){t=e.exports=a("24fb")(!1),t.push([e.i,".bd-setting[data-v-6613079a]{padding:0 %?24?%;background-color:#fff}.bd-item[data-v-6613079a]{height:%?100?%;font-size:%?28?%;color:#353535;border-bottom:%?2?% solid #f4f4f4}.bd-arrow[data-v-6613079a]{width:%?12?%;height:%?22?%;margin-left:%?20?%}.bd-btn[data-v-6613079a]{text-align:center;height:%?100?%;line-height:%?100?%;position:fixed;bottom:%?30?%;width:%?702?%;color:#353535;border-radius:%?16?%;-webkit-box-shadow:0 0 %?8?% rgba(0,0,0,.05);box-shadow:0 0 %?8?% rgba(0,0,0,.05);background-color:#fff}.bd-avatar[data-v-6613079a]{width:%?80?%;height:%?80?%}",""])},d3f2:function(e,t,a){"use strict";var r=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a481");var n=r(a("bd86")),i=a("2f62");r(a("d5ea"));function o(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,r)}return a}function s(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?o(Object(a),!0).forEach((function(t){(0,n.default)(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):o(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}var u={name:"setting",computed:s({},(0,i.mapState)({userInfo:function(e){return e.user.info}})),filters:{setIphone:function(e){return e&&e.replace(/^(\d{3})\d{4}(\d{4})$/,"$1****$2")}},methods:{router:function(e){uni.navigateTo({url:e})},logOut:function(){var e=this;this.$request({url:this.$api.registered.logout}).then((function(t){0===t.code&&(e.$store.dispatch("user/logout"),uni.navigateBack())}))},setAvatar:function(){var e=this;uni.chooseImage({count:1,sizeType:["original","compressed"],sourceType:["album","camera"],success:function(t){uni.uploadFile({url:e.$api.upload.file,filePath:t.tempFilePaths[0],name:"file",success:function(t){e.userInfo.avatar=JSON.parse(t.data).data.url,e.$request({url:e.$api.registered.avatar,method:"post",data:{avatar:JSON.parse(t.data).data.url}})}})}})}}};t.default=u},d5ea:function(e,t,a){"use strict";var r=a("4ea4");Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r(a("f854")),i=(r(a("e143")),function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return new Promise((function(t,a){(0,n.default)(e,"file").then((function(t){e.success({res:"",header:t})}))}))}),o=i;t.default=o},eba3:function(e,t,a){"use strict";var r=a("f827"),n=a.n(r);n.a},f827:function(e,t,a){var r=a("b6a4");"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var n=a("4f06").default;n("d19f672c",r,!0,{sourceMap:!1,shadowMode:!1})},f854:function(e,t,a){"use strict";var r=a("4ea4");Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a481"),a("96cf");var n=r(a("3b8d")),i=a("8de3"),o=r(a("e143")),s=r(a("4360")),u=a("b1c7"),c=r(a("36e8")),d=function(){var e=(0,n.default)(regeneratorRuntime.mark((function e(t,a){var r,n,d;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return r={"X-App-Platform":t.header&&t.header["X-App-Platform"]?t.header["X-App-Platform"]:o.default.prototype.$platform,"X-Form-Id-List":JSON.stringify((0,i.popAll)()),"X-Requested-With":t.header&&t.header["X-Requested-With"]?t.header["X-Requested-With"]:"XMLHttpRequest","X-App-Version":o.default.prototype.$appVersion,"content-type":a?"multipart/form-data":"application/x-www-form-urlencoded"},e.next=3,s.default.dispatch("user/loadAccessTokenFormCache");case 3:return s.default.state.user&&s.default.state.user.accessToken&&(r["X-Access-Token"]=s.default.state.user.accessToken),s.default.state.user&&0!==s.default.state.user.tempParentId&&(r["X-User-Id"]=s.default.state.user.tempParentId+""),n={},t.url.replace(/([^=&]+)=([^&]*)/g,(function(e,t,a){n[decodeURIComponent(t)]=decodeURIComponent(a)})),-1!==(0,u.objectValues)(c.default.mch).indexOf(n.r)&&(d=o.default.prototype.$storage.getStorageSync("MCH2019"),r["Mch-Access-Token"]=d.token),e.abrupt("return",r);case 9:case"end":return e.stop()}}),e)})));return function(t,a){return e.apply(this,arguments)}}(),f=d;t.default=f}}]);