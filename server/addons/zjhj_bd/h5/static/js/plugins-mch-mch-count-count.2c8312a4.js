(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-mch-mch-count-count"],{"2a84":function(t,a,e){"use strict";e.r(a);var i=e("7402"),n=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(o);a["default"]=n.a},"3a68":function(t,a,e){"use strict";var i=e("8dc9"),n=e.n(i);n.a},5381:function(t,a,e){"use strict";e.r(a);var i=e("e61a"),n=e("2a84");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(o);e("3a68");var r,s=e("f0c5"),c=Object(s["a"])(n["default"],i["b"],i["c"],!1,null,"4bea5b60",null,!1,i["a"],r);a["default"]=c.exports},7402:function(t,a,e){"use strict";var i=e("4ea4");Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0,e("ac6a"),e("6b54"),e("87b3");var n,o=i(e("a9cc")),r=null,s={name:"count",components:{},data:function(){return{contrast_prev_monthly:"",monthly_order_pay_price_average:"",monthly_order_pay_price_count:"",mch_id:0,options:[],year_str:"",month_str:"",year_list:null,scrollId:null,year_index:0,index:0,cWidth:"",cHeight:"",pixelRatio:1,serverData:""}},onLoad:function(t){this.$commonLoad.onload(t),this.mch_id=t.mch_id,this.getYear(),n=this,this.cWidth=uni.upx2px(750),this.cHeight=uni.upx2px(500)},methods:{showColumn:function(t,a){r=new o.default({$this:n,canvasId:t,type:"line",background:"#FFFFFF",animation:!0,dataPointShape:!1,pixelRatio:n.pixelRatio,categories:a.categories,series:a.series,width:n.cWidth*n.pixelRatio,height:n.cHeight*n.pixelRatio,legend:!0,xAxis:{disabled:!0,axisLine:!1,disableGrid:!0},yAxis:{format:function(t){return t}},dataLabel:!1,extra:{line:{type:"curve",width:"4rpx"}}})},changeData:function(){r.updateData({series:n.serverData.ColumnB.series,categories:n.serverData.ColumnB.categories})},getYear:function(){var t=this,a=this;a.$showLoading(),a.$request({url:a.$api.mch.year_list}).then((function(e){if(a.$hideLoading(),0===e.code){var i,n,o,r=e.data.year_list;r.map((function(t,a){t.month_list.map((function(t,e){t.active&&(i=a.toString()+e.toString(),n=r[a].year,o=r[a].month_list[e].month)}))}));var s=[r,i,n,o];a.year_list=s[0],a.scrollId=s[1],a.year_str=s[2],a.month_str=s[3],t.loadData()}}))},loadData:function(){var t=this;t.$request({url:t.$api.mch.statistic,data:{mch_id:t.mch_id,monthly:t.month_str,year:t.year_str}}).then((function(a){if(0===a.code){var e={categories:a.data.trend_arr,series:[{name:"日成交额",data:a.data.trend_arr,color:"#fa6855"}]};t.showColumn("canvasColumn",e);var i=[a.data.contrast_prev_monthly,a.data.monthly_order_pay_price_average,a.data.monthly_order_pay_price_count];t.contrast_prev_monthly=i[0],t.monthly_order_pay_price_average=i[1],t.monthly_order_pay_price_count=i[2]}}))},switchTaps:function(t,a){var e=this,i=e.year_list;i.forEach((function(e,i){e.active=i==t,e.month_list.forEach((function(e,n){e.active=i==t&&n==a}))}));var n=e.scrollId;n=a>=2||0==t?t.toString()+(a-2).toString():(t-1).toString()+(a+10).toString();var o=[t,i,a,n,i[t].year,i[t].month_list[a].month];e.index=o[0],e.year_list=o[1],e.year_index=o[2],e.scrollId=o[3],e.year_str=o[4],e.month_str=o[5],e.loadData()}}};a.default=s},"8dc9":function(t,a,e){var i=e("aa97");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=e("4f06").default;n("f159bcce",i,!0,{sourceMap:!1,shadowMode:!1})},aa97:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-4bea5b60]{text-align:center}.font-weight[data-v-4bea5b60]{font-weight:700}.page-width[data-v-4bea5b60]{width:100%}.goods-hover-class[data-v-4bea5b60]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-4bea5b60]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-4bea5b60]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-4bea5b60]{width:100%}.u-hover-class[data-v-4bea5b60]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-4bea5b60]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.charts[data-v-4bea5b60]{width:%?750?%;height:%?500?%;background-color:#fff}[data-v-4bea5b60]::-webkit-scrollbar{width:0;height:0;color:rgba(0,0,0,0)}.month-list .month-item[data-v-4bea5b60]{color:#bbb;width:%?150?%;text-align:center;height:%?120?%}.month-list .month-item .en[data-v-4bea5b60]{font-size:%?24?%}.month-list .month-item .cn[data-v-4bea5b60]{font-size:%?28?%}.month-list .month-item.active[data-v-4bea5b60]{color:#e9ad33}.year-label[data-v-4bea5b60]{font-size:%?20?%;color:#999;padding:%?24?% %?40?%}.year-line[data-v-4bea5b60]{height:1px;width:100%;background:#e2e2e2}.count-num[data-v-4bea5b60]{font-size:%?24?%;margin:0 %?24?%}.count-num .name[data-v-4bea5b60]{color:#999;margin-bottom:%?16?%}.count-num .num[data-v-4bea5b60]{color:#353535}.canvas-box[data-v-4bea5b60]{margin-top:%?48?%;width:100%}body.?%PAGE?%[data-v-4bea5b60]{background:#f7f7f7}",""])},e61a:function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return i}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("app-layout",[t.year_list?e("v-uni-view",{staticStyle:{background:"#FFFFFF"}},[e("v-uni-scroll-view",{attrs:{"scroll-x":!0,"scroll-into-view":"mch_"+t.scrollId,"scroll-with-animation":!0}},[e("v-uni-view",{staticClass:"dir-left-nowrap month-list"},[e("v-uni-view",{staticClass:"box-grow-0 month-item",attrs:{id:"mch_0-2"}}),e("v-uni-view",{staticClass:"box-grow-0 month-item",attrs:{id:"mch_0-1"}}),t._l(t.year_list,(function(a,i){return t._l(a.month_list,(function(a,n){return e("app-form-id",{key:n+"_"+i+"_0",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.switchTaps(i,n)}}},[e("v-uni-view",{staticClass:"box-grow-0 dir-top-nowrap main-center month-item",class:a.active?"active":"",attrs:{id:"mch_"+i+n}},[e("v-uni-view",{staticClass:"en"},[t._v(t._s(a.name_en))]),e("v-uni-view",{staticClass:"cn"},[t._v(t._s(a.name_cn))])],1)],1)}))})),e("v-uni-view",{staticClass:"box-grow-0 month-item"}),e("v-uni-view",{staticClass:"box-grow-0 month-item"})],2)],1),e("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},[e("v-uni-view",{staticClass:"year-line"}),e("v-uni-view",{staticClass:"year-label"},[t._v(t._s(t.year_str))]),e("v-uni-view",{staticClass:"year-line"})],1),e("v-uni-view",{staticClass:"main-between count-num"},[e("v-uni-view",{staticClass:"cross-center dir-top-nowrap"},[e("v-uni-view",{staticClass:"name"},[t._v("日均成交额")]),e("v-uni-view",{staticClass:"num"},[t._v(t._s(t.monthly_order_pay_price_average))])],1),e("v-uni-view",{staticClass:"cross-center dir-top-nowrap"},[e("v-uni-view",{staticClass:"name"},[t._v("当月成交额")]),e("v-uni-view",{staticClass:"num"},[t._v(t._s(t.monthly_order_pay_price_count))])],1),e("v-uni-view",{staticClass:"cross-center dir-top-nowrap"},[e("v-uni-view",{staticClass:"name"},[t._v("对比上月")]),e("v-uni-view",{staticClass:"num"},[t._v(t._s(t.contrast_prev_monthly))])],1)],1),e("v-uni-view",{staticClass:"main-center cross-center canvas-box"},[e("v-uni-canvas",{staticClass:"charts",attrs:{"canvas-id":"canvasColumn",id:"canvasColumn"}})],1)],1):t._e()],1)},o=[]}}]);