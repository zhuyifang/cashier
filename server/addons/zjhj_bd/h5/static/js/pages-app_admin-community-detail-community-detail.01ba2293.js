(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-app_admin-community-detail-community-detail"],{"6c37":function(t,i,e){i=t.exports=e("24fb")(!1),i.push([t.i,".text-center[data-v-871cd8b8]{text-align:center}.font-weight[data-v-871cd8b8]{font-weight:700}.page-width[data-v-871cd8b8]{width:100%}.goods-hover-class[data-v-871cd8b8]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-871cd8b8]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-871cd8b8]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-871cd8b8]{width:100%}.u-hover-class[data-v-871cd8b8]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-871cd8b8]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.info[data-v-871cd8b8]{position:relative;z-index:10;width:%?702?%;margin:%?94?% auto 0;border-radius:%?16?%;background-color:#fff;font-size:%?32?%;color:#353535;padding:%?98?% %?40?% %?15?%}.info .avatar[data-v-871cd8b8]{width:%?140?%;height:%?140?%;border-radius:%?70?%;border:%?4?% solid #fff;position:absolute;top:%?-70?%;left:50%;margin-left:%?-70?%}.info .form-item[data-v-871cd8b8]{margin-bottom:%?26?%}.info .form-item .label[data-v-871cd8b8]{color:#999;width:%?170?%;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0}.info .form-item .item-content[data-v-871cd8b8]{width:%?450?%}.info .form-item .item-content .placeholder[data-v-871cd8b8]{margin:0 %?10?%}.button[data-v-871cd8b8]{width:%?702?%;height:%?80?%;margin:%?80?% %?12?%}.button>uni-view[data-v-871cd8b8]{width:%?346?%;height:%?80?%;line-height:%?80?%;text-align:center;border-radius:%?40?%;font-size:%?28?%}.button .fail[data-v-871cd8b8]{background-color:#e2e2e2;color:#353535}.button .by[data-v-871cd8b8]{background-color:#446dfd;color:#fff}.model[data-v-871cd8b8]{position:fixed;z-index:1600;width:100%;height:100%;top:0;left:0;background-color:rgba(0,0,0,.3)}.model .dialog-list[data-v-871cd8b8]{padding:%?46?% %?30?%}.model .dialog-list .dialog-item[data-v-871cd8b8]{margin:%?10?%;height:%?62?%;line-height:%?60?%;display:inline-block;padding:0 %?32?%;font-size:%?32?%;color:#353535;border-radius:%?32?%;border:%?2?% solid #bbb}.model .dialog-list .dialog-item.active[data-v-871cd8b8]{color:#446dfd;border:%?2?% solid #446dfd}.model .top[data-v-871cd8b8]{margin-top:%?40?%;margin-bottom:%?32?%;color:#353535;font-size:%?32?%;text-align:center}.model .content[data-v-871cd8b8]{width:calc(100% - %?64?%);margin:0 %?32?%}.model .buttons[data-v-871cd8b8]{width:100%;border-top:%?1?% solid #e2e2e2;margin-top:%?32?%}.model .buttons .but[data-v-871cd8b8]{width:calc(50% - %?1?%);height:%?88?%;line-height:%?88?%;font-size:%?32?%;text-align:center}.model .buttons .line[data-v-871cd8b8]{width:%?2?%;height:%?32?%;background-color:#e2e2e2}.model .buttons .cancel[data-v-871cd8b8]{color:#666}.model .buttons .confirm[data-v-871cd8b8]{color:#446dfd}.model .refuse[data-v-871cd8b8]{width:%?620?%;position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);border-radius:%?16?%;background-color:#fff}.model .refuse .content[data-v-871cd8b8]{border-radius:%?16?%;border:%?1?% solid #e2e2e2;height:%?300?%;-webkit-box-sizing:border-box;box-sizing:border-box;padding:%?24?% %?32?%}.model .refuse .textarea[data-v-871cd8b8]{width:%?492?%;height:%?252?%;font-size:%?28?%;color:#80848f}.model .by[data-v-871cd8b8]{width:%?620?%;position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);border-radius:%?16?%;background-color:#fff}.model .by .content[data-v-871cd8b8]{font-size:%?32?%;color:#353535;text-align:center}body.?%PAGE?%[data-v-871cd8b8]{background:#f7f7f7}",""])},"6d8a":function(t,i,e){"use strict";e.r(i);var a=e("8893"),o=e.n(a);for(var n in a)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(n);i["default"]=o.a},8893:function(t,i,e){"use strict";Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var a={data:function(){return{id:0,detail:{},modelType:1,reasonRefusal:"",model:!1,iphone_x:!1}},onLoad:function(t){this.$commonLoad.onload(t);var i=this;i.iphone_x=this.$utils.checkIphone(),i.$showLoading({type:"global",text:"加载中..."}),i.id=t.id,i.getDetail()},methods:{getDetail:function(){var t=this;this.$request({url:this.$api.app_admin.review_detail_v2,data:{key:"community",user_id:this.id}}).then((function(i){t.$hideLoading(),uni.hideLoading(),0===i.code&&(t.detail=i.data)})).catch((function(){t.$hideLoading(),uni.hideLoading()}))},refuse:function(){this.modelType=1,this.model=!0},by:function(){this.modelType=2,this.model=!0},confirm:function(){var t=this;2===this.modelType?this.$request({url:this.$api.app_admin.review_switch_v2,method:"post",data:{key:"community",status:1,user_id:this.detail.user_id}}).then((function(i){0===i.code&&(uni.showToast({title:"通过申请",duration:1e3}),t.model=!1,setTimeout((function(){uni.navigateBack()})))})):1===this.modelType&&this.$request({url:this.$api.app_admin.review_switch_v2,method:"post",data:{key:"community",status:2,reason:this.reasonRefusal,user_id:this.detail.user_id}}).then((function(i){0===i.code?(t.reasonRefusal="",t.model=!1,uni.showToast({title:"拒绝申请",icon:"none",duration:1e3}),setTimeout((function(){uni.navigateBack()}))):uni.showToast({title:i.msg,icon:"none",duration:1e3})}))},cancel:function(){this.model=!1}}};i.default=a},bb89:function(t,i,e){"use strict";var a=e("c1f1"),o=e.n(a);o.a},c1f1:function(t,i,e){var a=e("6c37");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=e("4f06").default;o("0fc9222e",a,!0,{sourceMap:!1,shadowMode:!1})},c4c4:function(t,i,e){"use strict";e.r(i);var a=e("d000"),o=e("6d8a");for(var n in o)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return o[t]}))}(n);e("bb89");var d,s=e("f0c5"),c=Object(s["a"])(o["default"],a["b"],a["c"],!1,null,"871cd8b8",null,!1,a["a"],d);i["default"]=c.exports},d000:function(t,i,e){"use strict";var a;e.d(i,"b",(function(){return o})),e.d(i,"c",(function(){return n})),e.d(i,"a",(function(){return a}));var o=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("app-layout",[e("v-uni-view",{staticClass:"info"},[e("v-uni-image",{staticClass:"avatar",attrs:{src:t.detail.avatar}}),e("v-uni-view",{staticClass:"dir-left-nowrap form-item"},[e("v-uni-view",{staticClass:"label"},[t._v("姓名")]),e("v-uni-view",{staticClass:"item-content"},[t._v(t._s(t.detail.nickname))])],1),e("v-uni-view",{staticClass:"dir-left-nowrap form-item"},[e("v-uni-view",{staticClass:"label"},[t._v("手机号")]),e("v-uni-view",{staticClass:"item-content t-omit"},[t._v(t._s(t.detail.mobile))])],1),e("v-uni-view",{staticClass:"dir-left-nowrap form-item"},[e("v-uni-view",{staticClass:"label"},[t._v("所在地区")]),t.detail.user_id>0?e("v-uni-view",{staticClass:"item-content"},[t._v(t._s(t.detail.province)+t._s(t.detail.city)+t._s(t.detail.district)+t._s(t.detail.location))]):t._e()],1),e("v-uni-view",{staticClass:"dir-left-nowrap form-item"},[e("v-uni-view",{staticClass:"label"},[t._v("提货地址")]),e("v-uni-view",{staticClass:"item-content"},[t._v(t._s(t.detail.detail))])],1)],1),e("v-uni-view",{staticClass:"button dir-left-nowrap main-between"},[e("v-uni-view",{staticClass:"fail",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.refuse.apply(void 0,arguments)}}},[t._v("拒绝")]),e("v-uni-view",{staticClass:"by",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.by.apply(void 0,arguments)}}},[t._v("通过")])],1),t.model?e("v-uni-view",{staticClass:"model",on:{touchmove:function(i){i.stopPropagation(),i.preventDefault(),arguments[0]=i=t.$handleEvent(i)}}},[1===t.modelType?[e("v-uni-view",{staticClass:"refuse"},[e("v-uni-view",{staticClass:"top"},[t._v(t._s(t.type>2?"拒绝申请":"不通过申请"))]),e("v-uni-view",{staticClass:"content"},[e("v-uni-textarea",{staticClass:"textarea",attrs:{placeholder:"请填写拒绝理由"},model:{value:t.reasonRefusal,callback:function(i){t.reasonRefusal=i},expression:"reasonRefusal"}})],1),e("v-uni-view",{staticClass:"buttons dir-left-nowrap cross-center"},[e("v-uni-view",{staticClass:"but cancel",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.cancel.apply(void 0,arguments)}}},[e("app-form-id",[t._v("取消")])],1),e("v-uni-view",{staticClass:"line"}),e("v-uni-view",{staticClass:"but confirm",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.confirm.apply(void 0,arguments)}}},[e("app-form-id",[t._v("确认")])],1)],1)],1)]:t._e(),2===t.modelType?[e("v-uni-view",{staticClass:"by"},[e("v-uni-view",{staticClass:"top"},[t._v("通过申请")]),e("v-uni-view",{staticClass:"content"},[t._v("是否确认通过申请")]),e("v-uni-view",{staticClass:"buttons dir-left-nowrap cross-center"},[e("v-uni-view",{staticClass:"but cancel",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.cancel.apply(void 0,arguments)}}},[e("app-form-id",[t._v("取消")])],1),e("v-uni-view",{staticClass:"line"}),e("v-uni-view",{staticClass:"but confirm",on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.confirm.apply(void 0,arguments)}}},[e("app-form-id",[t._v("确认")])],1)],1)],1)]:t._e()],2):t._e()],1)},n=[]}}]);