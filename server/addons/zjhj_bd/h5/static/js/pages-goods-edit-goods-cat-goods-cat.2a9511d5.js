(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-goods-edit-goods-cat-goods-cat"],{"35ea":function(t,i,e){"use strict";var a;e.d(i,"b",(function(){return n})),e.d(i,"c",(function(){return o})),e.d(i,"a",(function(){return a}));var n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("app-layout",[t.list.length>0?e("v-uni-view",{staticClass:"dir-left-wrap cat-list"},t._l(t.list,(function(i,a){return e("v-uni-view",{key:i.value,staticClass:"cross-center dir-left-nowrap cat-item",style:{color:t.color,"background-color":0==t.mch_id?"#ECF0FF":"#FFECEC"}},[e("v-uni-view",[t._v(t._s(i.label))]),e("v-uni-view",{staticClass:"close cross-center main-center",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.delCat(a)}}},[e("v-uni-image",{attrs:{src:0==t.mch_id?"./../image/cat-close.png":"./../image/mch-cat-close.png"}})],1)],1)})),1):t._e(),t.mch_id||0==t.mch_id?e("v-uni-view",{staticClass:"add-cat",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.add.apply(void 0,arguments)}}},[e("v-uni-view",{staticClass:"add-cat-btn main-center",style:{"border-color":t.color,color:t.color}},[e("v-uni-image",{attrs:{src:0==t.mch_id?"./../image/add.png":"./../image/mch-add.png"}}),e("v-uni-view",[t._v("添加分类")])],1)],1):t._e(),e("v-uni-view",{class:["add main-between",t.iphone_x?"iphone_x":""]},["mall"==t.type&&t.mch_id>0?t._e():e("v-uni-view",{staticClass:"add-btn",style:{"border-color":t.color,color:t.color},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.settingCat.apply(void 0,arguments)}}},[t._v("分类管理")]),e("v-uni-view",{staticClass:"save-btn",class:{all:"mall"==t.type&&t.mch_id>0},style:{"background-color":t.color},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.save.apply(void 0,arguments)}}},[t._v("保存")])],1),t.dialog?e("v-uni-view",{staticClass:"dialog"},[e("v-uni-view",{staticClass:"picker-list"},[e("v-uni-view",{staticClass:"main-between picker-header",style:{color:t.color}},[e("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.cancel.apply(void 0,arguments)}}},[t._v("取消")]),e("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.toAdd.apply(void 0,arguments)}}},[t._v("新增")])],1),e("v-uni-picker-view",{attrs:{value:t.catValue,"indicator-style":"height: 34px;"},on:{change:function(i){arguments[0]=i=t.$handleEvent(i),t.bindChange.apply(void 0,arguments)}}},[e("v-uni-picker-view-column",t._l(t.cat,(function(i,a){return e("v-uni-view",{key:i.value,staticClass:"picker-view t-omit",style:{color:t.index_1==a?t.color:t.index_1==a+1||t.index_1==a-1?"#999999":t.index_1==a+2||t.index_1==a-2?"#cdcdcd":""}},[t._v(t._s(i.label))])})),1),e("v-uni-picker-view-column",t._l(t.sec_list,(function(i,a){return e("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.sec_show||0==a,expression:"sec_show || idx == 0"}],key:i.value,staticClass:"picker-view t-omit",style:{color:t.index_2==a?t.color:t.index_2==a+1||t.index_2==a-1?"#999999":t.index_2==a+2||t.index_2==a-2?"#cdcdcd":""}},[t._v(t._s(i.label))])})),1),e("v-uni-picker-view-column",t._l(t.third_list,(function(i,a){return e("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.third_show||0==a,expression:"third_show || idx == 0"}],key:i.value,staticClass:"picker-view t-omit",style:{color:t.index_3==a?t.color:t.index_3==a+1||t.index_3==a-1?"#999999":t.index_3==a+2||t.index_3==a-2?"#cdcdcd":""}},[t._v(t._s(i.label))])})),1)],1)],1)],1):t._e()],1)},o=[]},"45ff":function(t,i,e){i=t.exports=e("24fb")(!1),i.push([t.i,".text-center[data-v-071825b0]{text-align:center}.font-weight[data-v-071825b0]{font-weight:700}.page-width[data-v-071825b0]{width:100%}.goods-hover-class[data-v-071825b0]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-071825b0]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-071825b0]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-071825b0]{width:100%}.u-hover-class[data-v-071825b0]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-071825b0]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.add-cat[data-v-071825b0]{height:%?120?%;background-color:#fff;padding-top:%?24?%}.add-cat .add-cat-btn[data-v-071825b0]{height:%?72?%;width:%?320?%;border-radius:%?36?%;border:%?2?% solid;margin:0 auto;font-size:%?26?%;line-height:%?72?%}.add-cat .add-cat-btn uni-image[data-v-071825b0]{height:%?28?%;width:%?28?%;margin-right:%?12?%;margin-top:%?22?%}.cat-list[data-v-071825b0]{background-color:#fff;padding:%?30?%;padding-left:0;padding-bottom:0}.cat-item[data-v-071825b0]{width:auto;border-radius:%?33?%;padding-left:%?30?%;height:%?66?%;line-height:%?66?%;margin-left:%?30?%;margin-bottom:%?30?%}.cat-item .close[data-v-071825b0]{width:%?60?%;height:%?66?%}.cat-item .close uni-image[data-v-071825b0]{width:%?16?%;height:%?16?%;display:block}.title[data-v-071825b0]{font-size:%?32?%;color:#999;padding-top:%?36?%;background-color:#fff;text-align:center}.add.iphone_x[data-v-071825b0]{height:%?170?%;padding-bottom:%?50?%}.add[data-v-071825b0]{height:%?120?%;padding:0 %?24?%;margin:0 auto;position:fixed;bottom:0;left:0;right:0;border-top:%?2?% solid #e2e2e2;background-color:#fff}.add .add-btn[data-v-071825b0]{background-color:#fff;border:%?2?% solid}.add>uni-view[data-v-071825b0]{height:%?80?%;width:%?300?%;margin-top:%?20?%;border-radius:%?40?%;color:#fff;font-size:%?28?%;text-align:center;line-height:%?80?%}.add>uni-view.all[data-v-071825b0]{width:%?702?%}.dialog[data-v-071825b0]{position:fixed;height:100%;width:100%;bottom:0;left:0;z-index:9999;background-color:rgba(0,0,0,.3)}.dialog.iphone_x .picker-list[data-v-071825b0]{padding-bottom:%?50?%}.picker[data-v-071825b0]{width:100%;height:%?440?%;color:#999}.dialog.iphone_x .picker[data-v-071825b0]{height:%?490?%}.picker-list[data-v-071825b0]{background-color:#fff;padding-top:%?20?%;position:fixed;bottom:0;left:0;width:100%;z-index:9999;height:%?520?%;border-top-left-radius:%?10?%;border-top-right-radius:%?10?%}.picker-header[data-v-071825b0]{padding:0 %?24?%;font-size:%?32?%}.dialog[data-v-071825b0]{position:fixed;height:100%;width:100%;bottom:0;left:0;z-index:9999;background-color:rgba(0,0,0,.3)}.picker-view[data-v-071825b0]{height:34px;line-height:34px;text-align:center;font-size:%?32?%}uni-picker-view[data-v-071825b0]{width:100%;height:%?440?%}body.?%PAGE?%[data-v-071825b0]{background:#f7f7f7}",""])},"6bc8":function(t,i,e){"use strict";var a=e("d2e0"),n=e.n(a);n.a},7954:function(t,i,e){"use strict";e.r(i);var a=e("b10e"),n=e.n(a);for(var o in a)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(o);i["default"]=n.a},b10e:function(t,i,e){"use strict";function a(t,i){var e="undefined"!==typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!e){if(Array.isArray(t)||(e=n(t))||i&&t&&"number"===typeof t.length){e&&(t=e);var a=0,o=function(){};return{s:o,n:function(){return a>=t.length?{done:!0}:{done:!1,value:t[a++]}},e:function(t){throw t},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var d,c=!0,s=!1;return{s:function(){e=e.call(t)},n:function(){var t=e.next();return c=t.done,t},e:function(t){s=!0,d=t},f:function(){try{c||null==e.return||e.return()}finally{if(s)throw d}}}}function n(t,i){if(t){if("string"===typeof t)return o(t,i);var e=Object.prototype.toString.call(t).slice(8,-1);return"Object"===e&&t.constructor&&(e=t.constructor.name),"Map"===e||"Set"===e?Array.from(t):"Arguments"===e||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(e)?o(t,i):void 0}}function o(t,i){(null==i||i>t.length)&&(i=t.length);for(var e=0,a=new Array(i);e<i;e++)a[e]=t[e];return a}e("ac4d"),e("8a81"),e("5df3"),e("1c4c"),e("7f7f"),e("6b54"),e("87b3"),Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var d={data:function(){return{iphone_x:!1,first:!0,third_show:!0,sec_show:!0,cat:[],sec_list:[],third_list:[],list:[],mch_id:null,dialog:!1,index_1:0,index_2:0,index_3:0,type:"",color:""}},computed:{catValue:function(){return[this.index_1,this.index_2,this.index_3]}},methods:{settingCat:function(){uni.navigateTo({url:"/pages/goods-edit/cat-setting/cat-setting?mch_id="+this.mch_id})},cancel:function(){this.dialog=!1,this.sec_list=[],this.third_list=[],this.index_1=0,this.index_2=0,this.index_3=0},toAdd:function(){var t,i=this,e=i.cat[i.index_1],n=i.sec_list[i.index_2],o=i.third_list[i.index_3];if(t="未选择"==n.label?e:"未选择"==o.label?n:o,i.list.length>0){var d,c=a(i.list);try{for(c.s();!(d=c.n()).done;){var s=d.value;if(s.value==t.value)return uni.showToast({title:"请勿重复添加",icon:"none",duration:1e3}),!1}}catch(l){c.e(l)}finally{c.f()}}setTimeout((function(){i.list.push(t),i.dialog=!1,i.index_1=0,i.index_2=0,i.index_3=0}))},getCat:function(){var t=this,i=0==this.mch_id?t.$api.app_admin.cat:"mall"==t.type?t.$api.mch.cat:t.$api.mch.mch_cat;t.$request({url:i,data:{mch_id:t.mch_id}}).then((function(i){if(t.$hideLoading(),uni.hideLoading(),t.first=!1,0==i.code){if(t.cat=i.data.list,t.list.length>0){var e=JSON.parse(JSON.stringify(t.list));t.list=[];var n,o=a(e);try{for(o.s();!(n=o.n()).done;){var d,c=n.value,s=a(t.cat);try{for(s.s();!(d=s.n()).done;){var l=d.value;if(c.value==l.value)t.list.push(c);else if(l.children){var r,h=a(l.children);try{for(h.s();!(r=h.n()).done;){var u=r.value;if(c.value==u.value)t.list.push(c);else if(u.children){var v,f=a(u.children);try{for(f.s();!(v=f.n()).done;){var g=v.value;c.value==g.value&&t.list.push(c)}}catch(_){f.e(_)}finally{f.f()}}}}catch(_){h.e(_)}finally{h.f()}}}}catch(_){s.e(_)}finally{s.f()}}}catch(_){o.e(_)}finally{o.f()}}}else uni.showToast({title:i.msg,icon:"none",duration:1e3})})).catch((function(i){t.$hideLoading(),uni.hideLoading()}))},delCat:function(t){this.list.splice(t,1)},bindChange:function(t){var i=this;(t.detail.value[0]<0||!t.detail.value[0])&&(t.detail.value[0]=0),i.index_1==t.detail.value[0]?i.index_2==t.detail.value[1]?i.index_3=+t.detail.value[2]:(i.index_2=+t.detail.value[1],i.third_list=[{label:"未选择",value:""}],i.sec_list[i.index_2].children&&(i.third_list=i.third_list.concat(i.sec_list[i.index_2].children)),setTimeout((function(){i.third_show=!0,i.index_3=0}))):(i.index_1=+t.detail.value[0],i.sec_list=[{label:"未选择",value:""}],i.third_list=[{label:"未选择",value:""}],i.cat[i.index_1].children&&(i.sec_list=i.sec_list.concat(i.cat[i.index_1].children),i.sec_list[0].children&&(i.third_list=i.third_list.concat(i.sec_list[0].children))),setTimeout((function(){i.sec_show=!0,i.index_2=0,i.third_show=!0,i.index_3=0})))},save:function(){0==this.mch_id?this.$storage.setStorageSync("goods_cat",this.list):"mall"==this.type?this.$storage.setStorageSync("mch_goods_cat",this.list):this.$storage.setStorageSync("mch_goods_mch_cat",this.list),setTimeout((function(){uni.navigateBack()}),500)},add:function(){if(0==this.cat.length)return uni.showToast({title:"暂无分类，请前往分类管理添加",icon:"none",duration:1e3}),!1;this.dialog=!0,this.sec_list=[{label:"未选择",value:""}],this.third_list=[{label:"未选择",value:""}],this.cat[0].children&&(this.sec_list=this.sec_list.concat(this.cat[0].children),this.sec_list[0].children&&(this.third_list=this.third_list.concat(this.sec_list[0].children)))}},onShow:function(){this.first||(uni.showLoading({mask:!0}),this.getCat())},onLoad:function(t){this.$commonLoad.onload(t);var i=this;i.$showLoading({type:"global",text:"加载中..."}),this.type=t.type?t.type:"",this.mch_id=t.mch_id?t.mch_id:0,this.color=t.mch_id?"#ff4544":"#446dfd",0==this.mch_id?this.list=this.$storage.getStorageSync("goods_cat")?this.$storage.getStorageSync("goods_cat"):[]:"mall"==this.type?this.list=this.$storage.getStorageSync("mch_goods_cat")?this.$storage.getStorageSync("mch_goods_cat"):[]:this.list=this.$storage.getStorageSync("mch_goods_mch_cat")?this.$storage.getStorageSync("mch_goods_mch_cat"):[],i.iphone_x=this.$utils.checkIphone(),i.getCat()}};i.default=d},cc98:function(t,i,e){"use strict";e.r(i);var a=e("35ea"),n=e("7954");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(i,t,(function(){return n[t]}))}(o);e("6bc8");var d,c=e("f0c5"),s=Object(c["a"])(n["default"],a["b"],a["c"],!1,null,"071825b0",null,!1,a["a"],d);i["default"]=s.exports},d2e0:function(t,i,e){var a=e("45ff");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=e("4f06").default;n("76c002ce",a,!0,{sourceMap:!1,shadowMode:!1})}}]);