(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-clerk-statics-statics"],{"0851":function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return o})),e.d(a,"c",(function(){return n})),e.d(a,"a",(function(){return i}));var o=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("v-uni-view",[e("v-uni-view",{class:[t.shadow?"main-between app-nav shadow":"main-between app-nav"],style:[{"line-height":(t.setHeight?t.setHeight:90)+"rpx","font-size":(t.fontSize?t.fontSize:28)+"rpx",height:(t.setHeight?t.setHeight:90)+"rpx",top:t.setTop>0?t.setTop+"rpx":"0",backgroundColor:""+(t.background?t.background:"#fff")}]},t._l(t.tabList,(function(a){return e("v-uni-view",{key:a.id,staticClass:"box-grow-1 nav-item",style:[{borderBottom:(t.border?1:0)+"rpx solid #e2e2e2"}],attrs:{"data-id":a.id},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.handleClick.apply(void 0,arguments)}}},[e("v-uni-text",{class:[a.id==t.activeItem?"active-text":""],style:[{color:""+(a.id==t.activeItem?t.theme.color:"#353535"),"border-color":""+(a.id==t.activeItem?t.theme.color:""),height:(t.setHeight?t.setHeight:90)+"rpx",padding:"0 "+t.padding+"rpx"}]},[t._v(t._s(a.name))])],1)})),1),e("v-uni-view",{style:[{height:(t.placeHeight?t.placeHeight:90)+"rpx"}]})],1)},n=[]},"20f5":function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return o})),e.d(a,"c",(function(){return n})),e.d(a,"a",(function(){return i}));var o=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("app-layout",[e("app-tab-nav",{attrs:{shadow:t.noBorder,tabList:t.tabList,background:"#f7f7f7",padding:"0",border:t.noBorder,activeItem:t.activeTab},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.tabStatus.apply(void 0,arguments)}}}),e("v-uni-view",{staticClass:"total-item"},[e("v-uni-view",{staticClass:"total-num",staticStyle:{color:"#417afd"}},[t._v(t._s(t.total_order_num))]),e("v-uni-view",{staticClass:"total-title"},[t._v("核销订单数")]),e("v-uni-canvas",{staticClass:"charts",attrs:{"canvas-id":"canvasFirst",id:"canvasFirst"},on:{touchstart:function(a){arguments[0]=a=t.$handleEvent(a),t.touchIt(a,"canvasFirst")}}})],1),e("v-uni-view",{staticClass:"total-item"},[e("v-uni-view",{staticClass:"total-num",staticStyle:{color:"#ff9000"}},[t._v(t._s(t.total_order_price))]),e("v-uni-view",{staticClass:"total-title"},[t._v("核销订单金额")]),e("v-uni-canvas",{staticClass:"charts",attrs:{"canvas-id":"canvasSec",id:"canvasSec"},on:{touchstart:function(a){arguments[0]=a=t.$handleEvent(a),t.touchIt(a,"canvasSec")}}})],1),e("v-uni-view",{staticClass:"total-item"},[e("v-uni-view",{staticClass:"total-num",staticStyle:{color:"#41c6fe"}},[t._v(t._s(t.total_card))]),e("v-uni-view",{staticClass:"total-title"},[t._v("核销卡券次数")]),e("v-uni-canvas",{staticClass:"charts",attrs:{"canvas-id":"canvasThird",id:"canvasThird"},on:{touchstart:function(a){arguments[0]=a=t.$handleEvent(a),t.touchIt(a,"canvasThird")}}})],1)],1)},n=[]},"28ff":function(t,a,e){var i=e("aadf");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=e("4f06").default;o("306c997a",i,!0,{sourceMap:!1,shadowMode:!1})},"4d1c":function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0,e("c5f6");var i={name:"app-tab-nav",props:{background:String,setTop:{type:[Number,String]},padding:{default:45,type:[Number,String]},setHeight:Number,placeHeight:Number,fontSize:Number,theme:{type:Object,default:function(){return{color:"#ff4544"}}},border:{default:!0,type:Boolean},shadow:{default:!0,type:Boolean},activeItem:{type:[Number,String]},tabList:Array},methods:{handleClick:function(t){this.$emit("click",t)}}};a.default=i},"64ef":function(t,a,e){"use strict";e.r(a);var i=e("20f5"),o=e("e25f");for(var n in o)["default"].indexOf(n)<0&&function(t){e.d(a,t,(function(){return o[t]}))}(n);e("ba29");var r,c=e("f0c5"),s=Object(c["a"])(o["default"],i["b"],i["c"],!1,null,"d7e173f4",null,!1,i["a"],r);a["default"]=s.exports},"6d92":function(t,a,e){var i=e("750f");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=e("4f06").default;o("e5c6b138",i,!0,{sourceMap:!1,shadowMode:!1})},"71af":function(t,a,e){"use strict";var i=e("28ff"),o=e.n(i);o.a},"750f":function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-d7e173f4]{text-align:center}.font-weight[data-v-d7e173f4]{font-weight:700}.page-width[data-v-d7e173f4]{width:100%}.goods-hover-class[data-v-d7e173f4]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-d7e173f4]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-d7e173f4]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-d7e173f4]{width:100%}.u-hover-class[data-v-d7e173f4]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-d7e173f4]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.total-item[data-v-d7e173f4]{width:%?702?%;margin:%?24?% %?24?% 0;border-radius:%?16?%;background-color:#fff;padding-top:%?54?%;text-align:center}.total-title[data-v-d7e173f4]{color:#999;font-size:%?24?%}.total-num[data-v-d7e173f4]{font-size:%?46?%}.charts[data-v-d7e173f4]{width:100%;height:%?340?%;margin:%?85?% auto 0}body.?%PAGE?%[data-v-d7e173f4]{background:#f7f7f7}",""])},"7fd0":function(t,a,e){"use strict";e.r(a);var i=e("0851"),o=e("86a7");for(var n in o)["default"].indexOf(n)<0&&function(t){e.d(a,t,(function(){return o[t]}))}(n);e("71af");var r,c=e("f0c5"),s=Object(c["a"])(o["default"],i["b"],i["c"],!1,null,"c1c7a34c",null,!1,i["a"],r);a["default"]=s.exports},"84f9":function(t,a,e){"use strict";var i=e("4ea4");e("8e6e"),e("456d"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0,e("ac6a"),e("7f7f");var o,n=i(e("7618")),r=i(e("bd86")),c=i(e("7fd0")),s=i(e("a9cc")),d=e("2f62");function u(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);a&&(i=i.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,i)}return e}function f(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?u(Object(e),!0).forEach((function(a){(0,r.default)(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):u(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}var l={},v={name:"about",components:{"app-tab-nav":c.default},data:function(){return{noBorder:!1,tabList:[{id:0,name:"累计"},{id:1,name:"今日"},{id:-1,name:"昨日"},{id:7,name:"7日"},{id:30,name:"30日"}],cWidth:"",cHeight:"",pixelRatio:1,card_list:[],order_num_list:[],order_price_list:[],activeTab:0,total_card:0,total_order_num:0,total_order_price:0}},computed:f({},(0,d.mapState)({mall:function(t){return t.mallConfig.mall}})),onLoad:function(){this.$commonLoad.onload(),o=this,this.cWidth=uni.upx2px(702),this.cHeight=uni.upx2px(340),this.activeTab=0,this.getList()},methods:{showColumn:function(t,a,e,i){l[t]=new s.default({$this:o,canvasId:t,type:"area",legend:{show:!1},fontSize:9,background:"#FFFFFF",colors:e,padding:i||[15,15,4,0],pixelRatio:o.pixelRatio,animation:!1,categories:a.categories,series:a.series,xAxis:{disableGrid:!0},yAxis:{gridType:"dash",data:{disabled:!0}},dataLabel:!1,dataPointShape:!1,width:o.cWidth*o.pixelRatio,height:o.cHeight*o.pixelRatio,extra:{area:{type:"curve",addLine:!0},tooltip:{bgColor:"#000000",bgOpacity:.7}}})},tabStatus:function(t){this.activeTab=t.currentTarget.dataset.id,this.getList()},touchIt:function(t,a){var e=l[a].getCurrentDataIndex(t),i="canvasFirst"==a?this.order_num_list:"canvasSec"==a?this.order_price_list:this.card_list;l[a].showToolTip(t,{format:function(t,a){return t.color="rgba(0,0,0,0)","object"===(0,n.default)(t.data)?i[e].time+" "+t.name+":"+t.data.value:i[e].time+" "+t.name+":"+t.data}})},getList:function(){var t=this;t.$request({url:t.$api.clerk.statistics,data:{key:t.activeTab}}).then((function(a){if(t.$hideLoading(),0==a.code){t.card_list=a.data.card_list,t.order_num_list=a.data.order_num_list,t.order_price_list=a.data.order_price_list,t.total_card=0,t.total_order_num=0,t.total_order_price=0,t.card_list.forEach((function(a){t.total_card=(+t.total_card+ +a.num).toFixed(2)})),t.order_num_list.forEach((function(a){t.total_order_num=(+t.total_order_num+ +a.num).toFixed(2)})),t.order_price_list.forEach((function(a){t.total_order_price=(+t.total_order_price+ +a.num).toFixed(2)}));var e={categories:[],series:[{name:"核销订单数",data:[]}]},i={categories:[],series:[{name:"核销订单金额",data:[]}]},n={categories:[],series:[{name:"核销卡券次数",data:[]}]},r=[15,15,4,-10];1!=t.activeTab&&-1!=t.activeTab&&7!=t.activeTab||(r=[15,15,4,0]),e=t.create(t.order_num_list,e),o.showColumn("canvasFirst",e,["#417afd"],r),i=t.create(a.data.order_price_list,i),o.showColumn("canvasSec",i,["#ff9000"]),n=t.create(a.data.card_list,n),o.showColumn("canvasThird",n,["#41c6fe"])}else uni.showToast({title:a.msg,icon:"none",duration:1e3})})).catch((function(a){t.$hideLoading()}))},create:function(t,a){var e,i=this;return t.forEach((function(o,n){if(e=t[n].time,1==i.activeTab||-1==i.activeTab)n%6==0?(e<10?e="0"+e+":00":e+=":00",a.categories.push(e)):a.categories.push("");else if(30==i.activeTab)n%5==0||n==t.length-1?a.categories.push(e):a.categories.push("");else if(0==i.activeTab&&t.length>7){var r=Math.ceil((t.length+1)/5);0==n||n==t.length-1||n%r==0&&n>r-1&&n<t.length-r+1?a.categories.push(e):a.categories.push("")}else a.categories.push(e);a.series[0].data.push(o.num)})),1!=i.activeTab&&-1!=i.activeTab||a.categories.push("24:00"),a}}};a.default=v},"86a7":function(t,a,e){"use strict";e.r(a);var i=e("4d1c"),o=e.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(n);a["default"]=o.a},aadf:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-c1c7a34c]{text-align:center}.font-weight[data-v-c1c7a34c]{font-weight:700}.page-width[data-v-c1c7a34c]{width:100%}.goods-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-c1c7a34c]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-c1c7a34c]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-c1c7a34c]{width:100%}.u-hover-class[data-v-c1c7a34c]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-c1c7a34c]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-nav[data-v-c1c7a34c]{color:#353535;width:100%;position:fixed;left:0;background-color:#fff;z-index:11}.app-nav .nav-item[data-v-c1c7a34c]{text-align:center}.app-nav .nav-item uni-text[data-v-c1c7a34c]{display:inline-block}.app-nav .active-text[data-v-c1c7a34c]{color:#ff4544;border-bottom:%?4?% solid #ff4544}.app-nav.shadow[data-v-c1c7a34c]{-webkit-box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06);box-shadow:0 %?2?% %?10?% rgba(0,0,0,.06)}.blue-m-text[data-v-c1c7a34c]{color:#446dfd}body.?%PAGE?%[data-v-c1c7a34c]{background:#f7f7f7}",""])},ba29:function(t,a,e){"use strict";var i=e("6d92"),o=e.n(i);o.a},e25f:function(t,a,e){"use strict";e.r(a);var i=e("84f9"),o=e.n(i);for(var n in i)["default"].indexOf(n)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(n);a["default"]=o.a}}]);