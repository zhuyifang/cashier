(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-order-submit-gift~pages-order-submit-order-submit"],{4626:function(t,e,i){"use strict";i.r(e);var o=i("94ba"),a=i.n(o);for(var s in o)["default"].indexOf(s)<0&&function(t){i.d(e,t,(function(){return o[t]}))}(s);e["default"]=a.a},"4a88":function(t,e,i){"use strict";var o;i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){return o}));var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"app-address-bar"},[t.allZiti?i("v-uni-view",{staticClass:"group"},[i("v-uni-view",{staticClass:"dir-left-nowrap"},[i("v-uni-view",{staticClass:"box-grow-1"},[i("app-input",{attrs:{placeholder:"请填写联系人",height:"100","padding-left":"36"},on:{input:function(e){arguments[0]=e=t.$handleEvent(e),t.handleAddressInput.apply(void 0,arguments)}},model:{value:t.address.name,callback:function(e){t.$set(t.address,"name",e)},expression:"address.name"}})],1),i("v-uni-view",{staticClass:"box-grow-1",staticStyle:{"padding-right":"36rpx"}},[i("app-input",{attrs:{placeholder:"请填写手机号",height:"100"},on:{input:function(e){arguments[0]=e=t.$handleEvent(e),t.handleAddressInput.apply(void 0,arguments)}},model:{value:t.address.mobile,callback:function(e){t.$set(t.address,"mobile",e)},expression:"address.mobile"}})],1)],1)],1):i("v-uni-view",{staticClass:"group dir-left-nowrap cross-center",staticStyle:{padding:"25rpx 32rpx"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.navigateAddress.apply(void 0,arguments)}}},[i("v-uni-view",{staticClass:"box-grow-1"},[t.address?[i("v-uni-view",{staticClass:"dir-left-nowrap cross-center",staticStyle:{padding:"11rpx 0"}},[i("v-uni-view",{staticClass:"box-grow-1 t-omit",staticStyle:{"word-break":"break-all","line-height":"36rpx",height:"36rpx"}},[t._v("收货人："+t._s(t.address.name))]),i("v-uni-view",{staticClass:"box-grow-0 t-omit",staticStyle:{"max-width":"35%"}},[t._v(t._s(t.address.mobile))])],1),i("v-uni-view",{staticStyle:{padding:"9rpx 0","line-height":"1.25","text-align":"justify"}},[t._v("收货地址："),t.hasCity?[t._v(t._s(t.address.location))]:[t._v(t._s(t.address.province)+"\n                        "+t._s(t.address.city)+"\n                        "+t._s(t.address.district))],t._v(t._s(t.address.detail))],2)]:i("v-uni-view",{staticStyle:{padding:"11rpx 0"}},[(t.hasCity,[t._v("请选择收货地址")])],2),t.hasZiti?i("v-uni-view",{style:{color:t.getTheme.color,padding:"11rpx 0"}},[t._v("(收货地址中的手机号码将用于自提信息)")]):t._e(),t.address&&t.hasCity?i("v-uni-view",{staticStyle:{padding:"11rpx 0"}},[t._v("该地址在配送范围内")]):t._e()],2),i("v-uni-view",{staticClass:"box-grow-0",staticStyle:{"padding-left":"24rpx"}},[i("v-uni-image",{staticStyle:{width:"12rpx",height:"22rpx"},attrs:{src:"/static/image/icon/right.png"}})],1)],1)],1)},s=[]},"80ef":function(t,e,i){var o=i("ae25");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var a=i("4f06").default;a("2d3bffef",o,!0,{sourceMap:!1,shadowMode:!1})},"88e8":function(t,e,i){"use strict";i.r(e);var o=i("8e49"),a=i("4626");for(var s in a)["default"].indexOf(s)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(s);var n,r=i("f0c5"),c=Object(r["a"])(a["default"],o["b"],o["c"],!1,null,"ef56db5e",null,!1,o["a"],n);e["default"]=c.exports},"895e":function(t,e,i){"use strict";var o=i("80ef"),a=i.n(o);a.a},"8e49":function(t,e,i){"use strict";var o;i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){return o}));var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"form-goods-time"},[t.value&&t.value.day?i("v-uni-view",{staticClass:"dir-left-nowrap cross-center",staticStyle:{"padding-bottom":"16rpx","font-size":"24rpx"}},[i("v-uni-view",[t._v("预约时间：")]),1==t.value.is_alone?i("v-uni-view",[t._v(t._s(t.value.new_before))]):t._e(),0==t.value.is_alone?i("v-uni-view",[t._v(t._s(t.value.new_before)+"-"+t._s(t.value.new_after)+"   共"+t._s(t.value.day)+t._s(t.value.place_unit))]):t._e()],1):t._e()],1)},s=[]},"92a5":function(t,e,i){"use strict";i.r(e);var o=i("9c34"),a=i("bf44");for(var s in a)["default"].indexOf(s)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(s);i("895e");var n,r=i("f0c5"),c=Object(r["a"])(a["default"],o["b"],o["c"],!1,null,"6a1b18bb",null,!1,o["a"],n);e["default"]=c.exports},"94ba":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o={name:"form-goods-time",props:{value:Object},data:function(){return{}},methods:{}};e.default=o},"9c34":function(t,e,i){"use strict";var o;i.d(e,"b",(function(){return a})),i.d(e,"c",(function(){return s})),i.d(e,"a",(function(){return o}));var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"app-submit-goods"},["composition"!==t.plugin?i("v-uni-view",{staticClass:"app-submit-goods-item"},t._l(t.newList.goods_list,(function(e,o){return i("v-uni-view",{key:o,staticClass:"goods-item"},[i("form-goods-time",{attrs:{value:e.goods_attr.select_date}}),i("v-uni-view",{staticClass:"dir-left-nowrap"},[i("v-uni-view",{staticClass:"box-grow-0",staticStyle:{position:"relative"}},[e.address_disabled?i("v-uni-view",{staticClass:"address-disabled"},[t._v("不在配送范围内")]):t._e(),i("v-uni-image",{staticClass:"goods-image",attrs:{src:e.goods_attr.pic_url?e.goods_attr.pic_url:e.cover_pic}})],1),i("v-uni-view",{staticClass:"box-grow-1 dir-top-nowrap"},[i("v-uni-view",{staticClass:"goods-name box-grow-1"},[t._v(t._s(e.name))]),i("v-uni-view",{staticClass:"box-grow-0"},[i("v-uni-view",{staticClass:"dir-left-wrap attr-list"},t._l(e.attr_list,(function(e,o){return i("v-uni-view",{key:o,staticClass:"attr-item"},[t._v(t._s(e.attr_group_name)+"："+t._s(e.attr_name))])})),1),i("v-uni-view",{staticClass:"dir-left-nowrap"},[i("v-uni-view",{staticClass:"box-grow-1 goods-num"},[t._v("×"+t._s(e.num))]),i("v-uni-view",{staticClass:"box-grow-0 goods-price-info"},[t.hiddenPrice?t._e():i("v-uni-view",[t._l(e.custom_currency,(function(e,o){return i("v-uni-text",{key:o},[t._v(t._s(e)+"+")])})),i("v-uni-text",{staticClass:"goods-price-unit"},[t._v("￥")]),"weekly_buy"==t.plugin&&e.plugin&&e.plugin.week_number?i("v-uni-text",{staticClass:"goods-total-price"},[t._v(t._s(e.weekly_price)),i("v-uni-text",[t._v("x")]),i("v-uni-text",{staticClass:"weekly-info"},[t._v(t._s(e.plugin.week_number)+"期")])],1):i("v-uni-text",{staticClass:"goods-total-price"},[t._v(t._s(e.total_original_price))])],2)],1)],1)],1)],1)],1),t.hiddenPrice?t._e():t._l(e.discounts,(function(e,o){return i("v-uni-view",{key:o,class:[t.themeTextClass],style:{"text-align":"right","padding-top":"12rpx","font-size":"24rpx",color:t.is_gift?"":t.theme.color}},[i("v-uni-view",{staticStyle:{display:"inline-block","margin-right":"6rpx"}},[t._v(t._s(e.name))]),e.value<0?[t._v("-¥"+t._s(t.priceFormat(0-e.value)))]:e.value>0?[t._v("+¥"+t._s(t.priceFormat(e.value)))]:[t._v("¥0.00")]],2)}))],2)})),1):i("v-uni-view",{staticClass:"composition"},t._l(t.newList.composition_list,(function(e,o){return i("v-uni-view",{key:o,staticClass:"composition-item"},[t._l(e.goods_list,(function(o,a){return i("v-uni-view",{key:a,staticClass:"goods-item"},[i("v-uni-view",{staticClass:"dir-left-nowrap"},[i("v-uni-view",{staticClass:"box-grow-0",staticStyle:{position:"relative"}},[o.address_disabled?i("v-uni-view",{staticClass:"address-disabled"},[t._v("不在配送范围内")]):t._e(),i("v-uni-image",{staticClass:"goods-image",attrs:{src:o.goods_attr.pic_url?o.goods_attr.pic_url:o.cover_pic}})],1),i("v-uni-view",{staticClass:"box-grow-1 dir-top-nowrap"},[i("v-uni-view",{staticClass:"goods-name box-grow-1"},[t._v(t._s(o.name))]),i("v-uni-view",{staticClass:"box-grow-0"},[i("v-uni-view",{staticClass:"dir-left-wrap attr-list"},t._l(o.attr_list,(function(e,o){return i("v-uni-view",{key:o,staticClass:"attr-item"},[t._v(t._s(e.attr_group_name)+"："+t._s(e.attr_name))])})),1),i("v-uni-view",{staticClass:"dir-left-nowrap goods-other"},[i("v-uni-view",{staticClass:"box-grow-1 goods-num"},[t._v("×"+t._s(o.num))]),2==e.type?i("v-uni-view",{staticClass:"box-grow-0 goods-price-info"},[i("v-uni-view",[t._l(o.custom_currency,(function(e,o){return i("v-uni-text",{key:o},[t._v(t._s(e)+"+")])})),i("v-uni-text",{staticClass:"goods-price-unit"},[t._v("￥")]),i("v-uni-text",{staticClass:"goods-total-price"},[t._v(t._s(o.total_price))])],2)],1):t._e()],1)],1)],1)],1),t._l(o.discounts,(function(e,o){return i("v-uni-view",{key:o,class:[t.themeTextClass],style:{"text-align":"right","padding-top":"12rpx","font-size":"24rpx",color:t.is_gift?"":t.theme.color}},[i("v-uni-view",{staticStyle:{display:"inline-block","margin-right":"6rpx"}},[t._v(t._s(e.name))]),e.value<0?[t._v("-¥"+t._s(t.priceFormat(0-e.value)))]:e.value>0?[t._v("+¥"+t._s(t.priceFormat(e.value)))]:[t._v("¥0.00")]],2)}))],2)})),i("v-uni-view",{staticClass:"composition-info",class:[t.themeTextClass],style:{color:t.is_gift?"":t.theme.color}},[i("v-uni-view",{staticStyle:{"margin-bottom":"8rpx"}},[t._v(t._s(1==e.type?"固定套餐":"搭配套餐")+"\n                    ￥"+t._s(e.total_price))]),i("v-uni-view",{staticClass:"composition-discount"},[t._v("已省 ￥"+t._s(e.composition_price))])],1)],2)})),1)],1)},s=[]},a060:function(t,e,i){"use strict";i.r(e);var o=i("bc45"),a=i.n(o);for(var s in o)["default"].indexOf(s)<0&&function(t){i.d(e,t,(function(){return o[t]}))}(s);e["default"]=a.a},aa49:function(t,e,i){"use strict";var o=i("4ea4");i("ac4d"),i("8a81"),i("5df3"),i("1c4c"),i("7f7f"),i("6b54"),i("87b3"),i("8e6e"),i("ac6a"),i("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=o(i("bd86"));i("c5f6");var s=o(i("88e8")),n=i("2f62");function r(t,e){var i="undefined"!==typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!i){if(Array.isArray(t)||(i=c(t))||e&&t&&"number"===typeof t.length){i&&(t=i);var o=0,a=function(){};return{s:a,n:function(){return o>=t.length?{done:!0}:{done:!1,value:t[o++]}},e:function(t){throw t},f:a}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var s,n=!0,r=!1;return{s:function(){i=i.call(t)},n:function(){var t=i.next();return n=t.done,t},e:function(t){r=!0,s=t},f:function(){try{n||null==i.return||i.return()}finally{if(r)throw s}}}}function c(t,e){if(t){if("string"===typeof t)return d(t,e);var i=Object.prototype.toString.call(t).slice(8,-1);return"Object"===i&&t.constructor&&(i=t.constructor.name),"Map"===i||"Set"===i?Array.from(t):"Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i)?d(t,e):void 0}}function d(t,e){(null==e||e>t.length)&&(e=t.length);for(var i=0,o=new Array(e);i<e;i++)o[i]=t[i];return o}function u(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,o)}return i}function l(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?u(Object(i),!0).forEach((function(e){(0,a.default)(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):u(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}var p={name:"app-submit-goods",components:{formGoodsTime:s.default},props:{list:{type:Object},plugin:{type:String},index:{type:Number},hiddenPrice:Boolean,theme:[String,Object]},computed:l(l({},(0,n.mapState)({appImg:function(t){return t.mallConfig.__wxapp_img}})),{},{themeTextClass:function(){if("string"==typeof this.theme&&this.theme.indexOf("gift")>0)return"".concat(this.theme," ").concat(this.theme,"-color")},is_gift:function(){return!!("string"==typeof this.theme&&this.theme&&this.theme.indexOf("gift")>0)},newList:function(){if("weekly_buy"==this.plugin){var t,e=r(this.list.goods_list);try{for(e.s();!(t=e.n()).done;){var i=t.value;console.log(i),console.log(i.total_original_price,i.plugin.week_number),i.weekly_price=(i.total_original_price/i.plugin.week_number).toFixed(2),console.log(i.weekly_price)}}catch(o){e.e(o)}finally{e.f()}}return this.list}}),methods:{priceFormat:function(t){return isNaN(t)?t:parseFloat(t).toFixed(2)}},mounted:function(){console.log(this.list.goods_list)}};e.default=p},ae25:function(t,e,i){e=t.exports=i("24fb")(!1),e.push([t.i,".text-center[data-v-6a1b18bb]{text-align:center}.font-weight[data-v-6a1b18bb]{font-weight:700}.page-width[data-v-6a1b18bb]{width:100%}.goods-hover-class[data-v-6a1b18bb]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-6a1b18bb]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-6a1b18bb]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-6a1b18bb]{width:100%}.u-hover-class[data-v-6a1b18bb]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-6a1b18bb]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-submit-goods .composition .composition-item[data-v-6a1b18bb]{margin-top:%?24?%}.app-submit-goods .composition .composition-item .composition-open[data-v-6a1b18bb]{text-align:center;background-color:#fff;height:%?84?%}.app-submit-goods .composition .composition-item .composition-open .composition-btn[data-v-6a1b18bb]{display:inline-block;border:%?2?% solid #bbb;font-size:%?24?%;color:#999;padding:0 %?24?%;margin:%?12?% 0 %?16?%;height:%?56?%;line-height:%?54?%;border-radius:%?28?%}.app-submit-goods .composition .composition-item .composition-open .composition-btn uni-image[data-v-6a1b18bb]{width:%?22?%;height:%?12?%;margin-left:%?16?%}.app-submit-goods .composition .composition-item .composition-info[data-v-6a1b18bb]{background-color:#fff;font-size:%?28?%;text-align:right;padding:%?24?%}.app-submit-goods .composition .composition-item .composition-info .composition-discount[data-v-6a1b18bb]{font-size:%?24?%}.app-submit-goods .goods-item[data-v-6a1b18bb]{background:#fff;padding:%?28?% %?32?%;border-bottom:%?1?% solid #e2e2e2;font-size:%?28?%}.app-submit-goods .goods-item .address-disabled[data-v-6a1b18bb]{background:#ffecec;color:#ff4544;position:absolute;bottom:0;left:0;right:%?22?%;padding:%?12?% 0;text-align:center;font-size:%?20?%;z-index:100}.app-submit-goods .goods-item .goods-image[data-v-6a1b18bb]{width:%?156?%;height:%?156?%;display:block;margin-right:%?24?%;font-size:%?24?%}.app-submit-goods .goods-item .goods-name[data-v-6a1b18bb]{white-space:nowrap;overflow:hidden;-o-text-overflow:ellipsis;text-overflow:ellipsis;line-height:1.25}.app-submit-goods .goods-item .attr-list[data-v-6a1b18bb]{margin-bottom:%?12?%}.app-submit-goods .goods-item .attr-list[data-v-6a1b18bb],.app-submit-goods .goods-item .goods-num[data-v-6a1b18bb]{font-size:%?24?%;color:#999}.app-submit-goods .goods-item .goods-other[data-v-6a1b18bb]{margin-top:%?16?%}.app-submit-goods .goods-item .attr-item[data-v-6a1b18bb]{margin-right:%?24?%}.app-submit-goods .goods-item .attr-item[data-v-6a1b18bb]:last-child{margin-right:0}.app-submit-goods .goods-item .goods-price-info[data-v-6a1b18bb]{text-align:right}.app-submit-goods .goods-item .goods-price-unit[data-v-6a1b18bb]{font-size:%?24?%}.app-submit-goods .goods-item .goods-total-price[data-v-6a1b18bb]{font-size:%?32?%}.app-submit-goods .goods-item .goods-total-price uni-text[data-v-6a1b18bb]{font-size:%?20?%;margin:0 %?5?%}.app-submit-goods .goods-item .goods-total-price .weekly-info[data-v-6a1b18bb]{font-size:%?28?%}.app-submit-goods .goods-item[data-v-6a1b18bb]:last-child{border-bottom:none}body.?%PAGE?%[data-v-6a1b18bb]{background:#f7f7f7}",""])},bc45:function(t,e,i){"use strict";var o=i("4ea4");i("8e6e"),i("ac6a"),i("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=o(i("bd86")),s=i("2f62");function n(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,o)}return i}function r(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?n(Object(i),!0).forEach((function(e){(0,a.default)(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):n(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}var c={name:"app-address-bar",props:{address:{default:null},allZiti:{default:!1},hasZiti:{default:!1},hasCity:{default:!1},city:{default:null},sign:String},computed:r({},(0,s.mapGetters)("mallConfig",{theme:"getTheme"})),methods:{navigateAddress:function(){if(this.city&&1===this.city.errorCode)uni.showModal({content:this.city.error,showCancel:!1});else{var t="/pages/order-submit/address-pick?hasCity="+this.hasCity;this.sign&&(t+="&sign="+this.sign),uni.navigateTo({url:t})}},handleAddressInput:function(){this.$emit("addressInput",this.address)}}};e.default=c},bf44:function(t,e,i){"use strict";i.r(e);var o=i("aa49"),a=i.n(o);for(var s in o)["default"].indexOf(s)<0&&function(t){i.d(e,t,(function(){return o[t]}))}(s);e["default"]=a.a},e047:function(t,e,i){"use strict";i.r(e);var o=i("4a88"),a=i("a060");for(var s in a)["default"].indexOf(s)<0&&function(t){i.d(e,t,(function(){return a[t]}))}(s);var n,r=i("f0c5"),c=Object(r["a"])(a["default"],o["b"],o["c"],!1,null,null,null,!1,o["a"],n);e["default"]=c.exports}}]);