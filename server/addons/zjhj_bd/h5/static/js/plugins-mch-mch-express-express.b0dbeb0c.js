(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-mch-mch-express-express"],{"2d17":function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return n})),a.d(e,"a",(function(){return i}));var o=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("app-layout",[i("v-uni-view",{staticClass:"express"},[i("v-uni-image",{staticClass:"logo",attrs:{src:a("2f48")}}),i("v-uni-view",{staticClass:"company-name"},[t._v(t._s(t.express_company))]),i("v-uni-view",{staticClass:"express-no"},[t._v("运单编号："+t._s(t.express_no)),i("v-uni-image",{attrs:{src:a("8c9d")},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.copy.apply(void 0,arguments)}}})],1)],1),i("v-uni-view",{staticClass:"logistics-box dir-top t-small-color t-medium"},[t.express.list?[i("v-uni-view",{staticClass:"item-box"},t._l(t.express.list,(function(e){return i("v-uni-view",{key:e.id,class:["dir-top-nowrap","item",0==t.index?"sign-text":""]},[0==t.index?i("v-uni-image",{staticClass:"sign-big",attrs:{src:"/static/image/icon/order/point-green.png"}}):i("v-uni-image",{staticClass:"sign",attrs:{src:"/static/image/icon/order/point-gray.png"}}),i("v-uni-view",[t._v(t._s(e.desc))]),i("v-uni-view",[t._v(t._s(e.datetime))])],1)})),1)]:i("v-uni-view",{staticClass:"main-center"},[i("v-uni-view",[t._v("暂无物流信息")])],1)],2)],1)},n=[]},"2f48":function(t,e){t.exports="data:image/png;base64,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"},"341c":function(t,e,a){"use strict";var i=a("e119"),o=a.n(i);o.a},"4bc4":function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o=i(a("bd86")),n=a("2f62");function r(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function s(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?r(Object(a),!0).forEach((function(e){(0,o.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):r(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var c={data:function(){return{express:"",id:"",express_no:"",express_company:""}},computed:s({},(0,n.mapState)({userInfo:function(t){return t.user.info},adminImg:function(t){return t.mallConfig.__wxapp_img.app_admin}})),methods:{copy:function(){this.$utils.uniCopy({data:this.express_no,success:function(){uni.showToast({title:"复制成功"})}})}},onLoad:function(t){this.$commonLoad.onload(t);var e=this;e.$showLoading({type:"global",text:"加载中..."}),e.$request({url:e.$api.app_admin.express_detail,data:{id:t.id,express:t.express,customer_name:t.customer_name,express_no:t.express_no}}).then((function(a){e.$hideLoading(),0==a.code?(e.express=a.data.express,e.id=t.id,e.express_company=t.express,e.express_no=t.express_no):uni.showToast({title:a.msg,icon:"none",duration:1e3})})).catch((function(t){e.$hideLoading(),uni.showToast({title:t,icon:"none",duration:1e3})}))}};e.default=c},"8c9d":function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYAgMAAACdGdVrAAAACVBMVEUAAAD///+qqqrFwkVSAAAAAXRSTlMAQObYZgAAAC1JREFUCNdjYNBaBQRwSjM0NDQKjQLJrIRTS4FimVShslYhUxkMqBTYvhUwCgBFgzu7R5IfHgAAAABJRU5ErkJggg=="},9964:function(t,e,a){"use strict";a.r(e);var i=a("2d17"),o=a("d783");for(var n in o)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(n);a("341c");var r,s=a("f0c5"),c=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"0c36a8b8",null,!1,i["a"],r);e["default"]=c.exports},a8c7:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-0c36a8b8]{text-align:center}.font-weight[data-v-0c36a8b8]{font-weight:700}.page-width[data-v-0c36a8b8]{width:100%}.goods-hover-class[data-v-0c36a8b8]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-0c36a8b8]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-0c36a8b8]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-0c36a8b8]{width:100%}.u-hover-class[data-v-0c36a8b8]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-0c36a8b8]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.logo[data-v-0c36a8b8]{height:%?100?%;width:%?100?%;float:left;margin-right:%?34?%}.express[data-v-0c36a8b8]{margin:%?24?%;display:block;margin-bottom:0;padding:%?32?%;padding-left:%?24?%;position:relative;font-size:%?32?%;background-color:#fff;color:#353535;border-radius:%?16?%;height:%?160?%}.to-more[data-v-0c36a8b8]{height:%?24?%;width:%?12?%;position:absolute;right:%?24?%;top:50%;margin-top:%?-6?%}.express-list[data-v-0c36a8b8]{padding:%?40?% %?32?%;background-color:#fff;color:#25ae5f;font-size:%?32?%;margin:%?24?%;border-radius:%?16?%}.express-box .top-box[data-v-0c36a8b8]{background-color:#fff;padding:%?20?%}.express-box .label[data-v-0c36a8b8]{margin-right:%?10?%}.express-box .goods-pic[data-v-0c36a8b8]{width:%?130?%;height:%?130?%;margin-right:%?20?%}.logistics-box[data-v-0c36a8b8]{padding:%?20?% %?25?%;margin:0 %?24?%;border-radius:%?16?%;background-color:#fff;margin-top:%?25?%}.logistics-box .item-box[data-v-0c36a8b8]{border-left:%?1?% solid #e2e2e2;padding-left:%?45?%;position:relative}.logistics-box .item[data-v-0c36a8b8]{margin-bottom:%?25?%;padding-bottom:%?25?%;border-bottom:%?1?% solid #e2e2e2}.logistics-box .item .sign[data-v-0c36a8b8]{width:%?16?%;height:%?16?%;position:absolute;left:%?-7?%}.logistics-box .item .sign-big[data-v-0c36a8b8]{width:%?32?%;height:%?32?%;position:absolute;left:%?-16?%}.sign-text[data-v-0c36a8b8]{color:#25ae5f}.company-name[data-v-0c36a8b8]{margin-top:%?6?%}.express-no[data-v-0c36a8b8]{color:#666;font-size:%?28?%;margin-top:%?10?%}.express-no uni-image[data-v-0c36a8b8]{height:%?24?%;width:%?24?%;margin-left:%?16?%}body.?%PAGE?%[data-v-0c36a8b8]{background:#f7f7f7}",""])},d783:function(t,e,a){"use strict";a.r(e);var i=a("4bc4"),o=a.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(n);e["default"]=o.a},e119:function(t,e,a){var i=a("a8c7");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("ddb0a828",i,!0,{sourceMap:!1,shadowMode:!1})}}]);