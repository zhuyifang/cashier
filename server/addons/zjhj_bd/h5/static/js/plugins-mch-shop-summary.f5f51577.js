(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-mch-shop-summary"],{"041fc":function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return i}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return t.showModel?e("v-uni-view",{staticClass:"kf-fixed"},[e("v-uni-view",{staticClass:"kf-model"},[e("v-uni-view",{staticClass:"kf-pic dir-top-nowrap"},[e("v-uni-view",{staticClass:"box-grow-0",staticStyle:{height:"58rpx"}}),e("v-uni-view",{staticClass:"box-grow-1",staticStyle:{"border-radius":"16rpx 16rpx 0 0"},style:[t.themeStyle]}),e("v-uni-image",{staticClass:"kf-pic dir-top-nowrap",staticStyle:{position:"absolute"},attrs:{src:t.appImg.summary_kf_head}})],1),e("v-uni-view",{staticStyle:{"background-color":"white","border-radius":"0 0 16rpx 16rpx","padding-bottom":"20rpx"}},[e("v-uni-view",{staticClass:"kf-remake"},[t._v("我们将会全心全意为您提供满意周到的咨询服务，感谢您的支持！")]),1==t.infoData.is_customer_wechat?e("v-uni-view",{staticClass:"kf-btn main-center cross-center",style:[t.themeStyle],on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.copyWechat.apply(void 0,arguments)}}},[t._v(t._s(t.infoData.customer_wechat_place))]):t._e(),1==t.infoData.is_customer_phone?e("v-uni-view",{staticClass:"kf-btn kf-btn-b main-center cross-center",style:{borderColor:t.getTheme.color,color:t.getTheme.color},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.callPhone.apply(void 0,arguments)}}},[t._v(t._s(t.infoData.customer_phone_place))]):t._e(),1==t.infoData.is_web_service&&t.mchData.is_web_service?e("v-uni-view",{staticClass:"kf-btn end main-center cross-center",style:{color:t.getTheme.color},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.jumpKf.apply(void 0,arguments)}}},[t._v(t._s(t.infoData.web_server_place))]):t._e()],1)],1),e("v-uni-view",{staticClass:"kf-close",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.close.apply(void 0,arguments)}}},[e("v-uni-image",{attrs:{src:t.appImg.summary_kf_close}})],1)],1):t._e()},o=[]},"05da":function(t,a,e){"use strict";e.r(a);var i=e("98db"),n=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(o);a["default"]=n.a},"136c":function(t,a,e){"use strict";var i=e("a08c"),n=e.n(i);n.a},1490:function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return i}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("v-uni-view",[t._t("default",[t.navs&&t.navs.length>1?e("v-uni-view",{style:{height:"calc("+t.botNavHei+"rpx + env(safe-area-inset-bottom))",width:"100%"}}):t._e()]),t.navs&&t.navs.length>1?e("v-uni-view",{staticClass:"app-navigation-bar safe-area-inset-bottom",class:{"app-tab-bar-shadow":t.shadow},style:{backgroundColor:t.bottom_background_color}},t._l(t.navs,(function(a,i){return e("v-uni-view",{key:i,staticClass:"navbar-item box-grow-1",style:{height:t.botNavHei+"rpx",backgroundColor:t.bottom_background_color,width:100/t.navs.length+"%"}},[e("app-jump-button",{staticClass:"app-button",attrs:{backgroundColor:t.bottom_background_color,open_type:a.open_type,params:a.params,url:a.url,arrangement:"column",form:!0}},[e("v-uni-image",{staticClass:"app-icon",attrs:{src:t.router===a.url?a.active_icon:a.icon}}),e("v-uni-text",{staticClass:"app-nav-text",style:{color:t.router===a.url?a.active_color:a.color}},[t._v(t._s(a.text))])],1)],1)})),1):t._e()],2)},o=[]},1523:function(t,a,e){"use strict";e.r(a);var i=e("39d9"),n=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(o);a["default"]=n.a},"1ddd":function(t,a,e){"use strict";var i=e("35a6"),n=e.n(i);n.a},2917:function(t,a){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAwCAMAAAA8VkqRAAAANlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC3dmhyAAAAEnRSTlMA5gpatK2le2Wel5GDcsZsRB0ZwS/QAAAAZElEQVQ4y9XTOw6AMAwDUEz5/7n/ZcnmJcFCYWnGZ6mtWrepfbYSOOAmI4D1oy+O7y8+O34GPpkPP3gx79u8X+YdnXMEftNFoJbi5uK4qYSXmEr007IMqj66cKyoSvQ34MepcB4kcAKd2LF1lgAAAABJRU5ErkJggg=="},"2aee":function(t,a,e){"use strict";var i=e("4ea4");e("8e6e"),e("ac6a"),e("456d"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0,e("b54a");var n=i(e("bd86"));e("c5f6");var o=e("2f62");function r(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);a&&(i=i.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,i)}return e}function s(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?r(Object(e),!0).forEach((function(a){(0,n.default)(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):r(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}var c={name:"app-nav-bar",data:function(){return{hw_style:{}}},watch:{leftIcon:function(t,a){console.log("lefticon 监听测试"),this.doSomething()}},props:{fixed:{type:[Boolean,String],default:!0},shadow:{type:[String,Boolean],default:!1},hasHeight:{type:Boolean,default:!0},border:{type:[String,Boolean],default:!1},backgroundColor:{type:String,default:"#FFFFFF"},leftIcon:{type:String,default:""},link:{type:[Object,Array]},title:{type:String,default:""},xStyle:{type:[Number,String],default:1},hasMallSetting:{type:[Number,String],default:1},color:{type:String,default:"#000000"},position:{type:String,default:"center"},placeholder:{type:String,default:"搜索"},placeholderColor:{type:String,default:"#666666"},backColor:{type:String,default:"black"}},computed:s(s({},(0,o.mapState)({statusBarHeight:function(t){return t.gConfig.systemInfo.statusBarHeight},mBarHeight:function(t){return t.gConfig.mBarHeight},appImg:function(t){return t.mallConfig.__wxapp_img.mall},mallNavbar:function(t){return t.mallConfig.navbar}})),{},{maxWidth:function(){var t=this;return function(){var a=parseInt(t.xStyle),e=0;switch(a){case 1:e="center"===t.position?uni.upx2px(360):uni.upx2px(500);break;case 2:e=uni.upx2px(400);break;case 4:e=uni.upx2px(200);break;default:break}return e&&t.pagesLength>1&&(e-=uni.upx2px(42)),Object.assign({},{"max-width":e+"px"})}},hiddenHeight:function(){var t=this;return function(){var a;a=a||0;var e=a+t.mBarHeight;return t.$emit("headHeight",e),{height:e+"px"}}},ordinaryStyle:function(){var t=this;return function(){var a,e="",i="";1==t.hasMallSetting?(e=t.mallNavbar.top_text_color,i=t.mallNavbar.top_background_color):(e=t.color,i=t.backgroundColor),a=a||0;var n=a+t.mBarHeight;return t.$emit("headHeight",n),e=e||"#000000",i=i||"#FFFFFF",Object.assign({},{color:e,backgroundColor:i,height:n+"px",paddingTop:a+"px"})}},hasJump:function(){return-1!==[2,4].indexOf(parseInt(this.xStyle))},showLeftIcon:function(){return-1!==[2,3].indexOf(parseInt(this.xStyle))&&this.leftIcon},showTitle:function(){return-1!==[1,2,4].indexOf(parseInt(this.xStyle))&&this.title},showLink:function(){return-1!==[3,4].indexOf(parseInt(this.xStyle))&&this.link},pagesLength:function(){return getCurrentPages().length}}),mounted:function(){this.doSomething()},methods:{doSomething:function(){var t=54,a=100,e=this;uni.getImageInfo({src:e.leftIcon,success:function(i){var n=i.height,o=i.width;n<=t&&o>=a&&(n/=o/a,o=a),n>=t&&o<=a&&(n=t,o/=n/t),n>t&&o>=a&&(a/t>o/n?(o/=n/t,n=t):(n/=o/a,o=a)),e.hw_style={height:uni.upx2px(n)+"px",width:uni.upx2px(o)+"px"}}})},navGoodsSearch:function(){uni.navigateTo({url:"/pages/search/search"})},onClickBack:function(){uni.navigateBack({delta:1})}}};a.default=c},"35a6":function(t,a,e){var i=e("be3d");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=e("4f06").default;n("43807904",i,!0,{sourceMap:!1,shadowMode:!1})},"39d9":function(t,a,e){"use strict";var i=e("4ea4");e("8e6e"),e("ac6a"),e("456d"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var n=i(e("bd86"));e("c5f6");var o=e("2f62");function r(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);a&&(i=i.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,i)}return e}function s(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?r(Object(e),!0).forEach((function(a){(0,n.default)(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):r(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}var c={name:"mch-navbar",data:function(){return{router:"",navs:[],bottom_background_color:"",shadow:!1}},props:{mchId:[String,Number],pageCount:Number},computed:s({},(0,o.mapGetters)("iPhoneX",{botNavHei:"getNavHei"})),methods:{flashData:function(t){var a=this;if(t){var e=JSON.parse(JSON.stringify(t)),i=e.bottom_background_color,n=e.shadow,o=e.navs;this.bottom_background_color=i,this.shadow=n,this.navs=o.map((function(t){return t.url=t.url+"?mch_id="+a.mchId,t}))}}},created:function(){function t(){a.$request({url:a.$api.mch.diy_nav,data:{mch_id:a.mchId}}).then((function(t){0===t.code&&(a.flashData(t.data.navbar),a.$storage.setStorage({key:"MCH_NARBAR_"+a.mchId,data:t.data.navbar}))}))}this.$request({url:this.$api.index.status,data:{mch_id_list:JSON.stringify([this.mchId])}}).then((function(t){0===t.code||wx.showModal({title:"提示",showCancel:!1,content:t.msg,success:function(t){uni.navigateBack({delta:1})}})}));var a=this;a.$storage.getStorage({key:"MCH_NARBAR_"+a.mchId,success:function(e){a.flashData(e.data),t()},fail:function(a){t()}})},watch:{navs:{handler:function(t){this.$emit("setHeight",this.navs&&this.navs.length>1?"(".concat(this.botNavHei,"rpx + env(safe-area-inset-bottom))"):0)},deep:!0},$route:{handler:function(t){var a=t.query,e=t.meta,i="?";for(var n in a)i+="".concat(n,"=").concat(a[n],"&");var o="/"+e.pagePath+i;o=o.slice(0,o.length-1),this.router=o},deep:!0,immediate:!0}}};a.default=c},4230:function(t,a){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAMAAADXqc3KAAAAOVBMVEUAAACysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK1NixPAAAAEnRSTlMA2AkUxh6TNOtMu2AoPbGlhXKgxJEIAAAAp0lEQVQoz6WRSxIDIQhEQfE/zqfvf9jUWBJ0kVXeRqAbLZAG4RYAHBNtuAjlDGR4Bq7iyPUI5GR+BmsWBPnbE8HeXBWiJiCR4TMKDW5ctPKg0kDUYTe4EczTYBxToB1B+tkxz76vQZ0RcROaDpKAsDYw2gxPiDMhgjULGdXbnpexUkZ+wltuDKybC+OXZFQLrwqVihdpjvyukDvSMV5VZecfRUjZFekfOzkHxFqYlkYAAAAASUVORK5CYII="},"4c57":function(t,a,e){"use strict";var i=e("e516"),n=e.n(i);n.a},"568c":function(t,a,e){var i=e("ef0e");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=e("4f06").default;n("56ecf22a",i,!0,{sourceMap:!1,shadowMode:!1})},"59f3":function(t,a,e){"use strict";e.r(a);var i=e("d2cc"),n=e("b7ce");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(o);e("4c57");var r,s=e("f0c5"),c=Object(s["a"])(n["default"],i["b"],i["c"],!1,null,"488d01fb",null,!1,i["a"],r);a["default"]=c.exports},"60d7":function(t,a,e){"use strict";e.r(a);var i=e("c87b"),n=e("c558");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(o);e("7a17");var r,s=e("f0c5"),c=Object(s["a"])(n["default"],i["b"],i["c"],!1,null,"272cac98",null,!1,i["a"],r);a["default"]=c.exports},6747:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-ab6c8d98]{text-align:center}.font-weight[data-v-ab6c8d98]{font-weight:700}.page-width[data-v-ab6c8d98]{width:100%}.goods-hover-class[data-v-ab6c8d98]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-ab6c8d98]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-ab6c8d98]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-ab6c8d98]{width:100%}.u-hover-class[data-v-ab6c8d98]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-ab6c8d98]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.kf-fixed[data-v-ab6c8d98]{position:fixed;height:100vh;width:100vw;top:0;z-index:100;background:rgba(0,0,0,.5)}.kf-fixed .kf-model[data-v-ab6c8d98]{margin:%?264?% auto 0;width:%?560?%}.kf-fixed .kf-model .kf-pic[data-v-ab6c8d98]{position:relative;top:0;height:%?265?%;width:100%}.kf-fixed .kf-model .kf-remake[data-v-ab6c8d98]{font-size:%?28?%;color:#999;overflow:hidden;padding:%?40?% %?40?% %?20?%}.kf-fixed .kf-model .kf-btn[data-v-ab6c8d98]{width:%?480?%;height:%?64?%;font-size:%?28?%;border-radius:%?32?%;margin:%?20?% auto 0;color:#fff}.kf-fixed .kf-model .kf-btn.kf-btn-b[data-v-ab6c8d98]{border-width:1px;border-style:solid}.kf-fixed .kf-model .kf-btn.end[data-v-ab6c8d98]{background-color:#fff;width:auto;height:auto;margin-bottom:0}.kf-fixed .kf-close[data-v-ab6c8d98]{height:%?64?%;width:%?64?%;margin:%?60?% auto 0}.kf-fixed .kf-close uni-image[data-v-ab6c8d98]{height:100%;width:100%;display:block}body.?%PAGE?%[data-v-ab6c8d98]{background:#f7f7f7}",""])},"6f54":function(t,a,e){"use strict";e.r(a);var i=e("041fc"),n=e("05da");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(o);e("136c");var r,s=e("f0c5"),c=Object(s["a"])(n["default"],i["b"],i["c"],!1,null,"ab6c8d98",null,!1,i["a"],r);a["default"]=c.exports},"70a5":function(t,a,e){"use strict";e.r(a);var i=e("1490"),n=e("1523");for(var o in n)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return n[t]}))}(o);e("1ddd");var r,s=e("f0c5"),c=Object(s["a"])(n["default"],i["b"],i["c"],!1,null,"01ed1c14",null,!1,i["a"],r);a["default"]=c.exports},"7a17":function(t,a,e){"use strict";var i=e("568c"),n=e.n(i);n.a},"8d6fa":function(t,a,e){"use strict";var i=e("4ea4");e("8e6e"),e("ac6a"),e("456d"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0,e("7f7f");var n=i(e("bd86")),o=i(e("70a5")),r=i(e("6f54")),s=e("2f62"),c=i(e("59f3"));function d(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);a&&(i=i.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,i)}return e}function l(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?d(Object(e),!0).forEach((function(a){(0,n.default)(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):d(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}var p={name:"summary",components:{mchNavbar:o.default,mchCustomer:r.default,appNavBar:c.default},computed:l(l({},(0,s.mapState)({systemInfo:function(t){return t.gConfig.systemInfo}})),{},{navbarStatus:function(){return!this.$jwx.isWechat()},bgStyle:function(){var t=this.data,a=t.bg_color,e=t.has_bg,i=t.bg_pic,n=t.bg_style,o=t.basic_style,r={position:"absolute",top:0,width:"100%",backgroundColor:a};return 1==e&&Object.assign(r,{backgroundImage:"url('".concat(i,"')"),backgroundRepeat:"no-repeat",backgroundSize:"100% 100%"}),"top"===n||2==o||0==e?Object.assign(r,{height:"360rpx",borderBottomRightRadius:"200rem 100px",borderBottomLeftRadius:"200rem 100px"}):Object.assign(r,{minHeight:"calc(100vh - (55px + env(safe-area-inset-bottom)))",height:"inherit"}),r},logoStyle:function(){var t=this.data,a=t.shop_logo_size,e=t.shop_logo_radius,i=t.card_top;return{position:"absolute",height:"calc(".concat(a,"rpx + 6rpx)"),width:"calc(".concat(a,"rpx + 6rpx)"),borderRadius:"".concat(e,"rpx"),backgroundImage:"url('".concat(this.mchData.cover_url,"')"),backgroundRepeat:"no-repeat",backgroundSize:"100% 100%",border:"6rpx solid white",zIndex:3,top:"".concat(i,"rpx"),left:"calc(50vw - ".concat(a/2,"rpx - 3rpx)")}},boxStyle:function(){var t=this.data,a=t.card_left_right,e=t.card_radius,i=t.shop_logo_size;return{margin:"0 ".concat(a,"rpx"),padding:"".concat(i/2+3,"rpx 24rpx 0"),background:"white",borderRadius:"".concat(e,"rpx")}},sLabelStyle:function(){return{color:this.data.info_title_color,fontSize:"".concat(this.data.info_title_font,"rpx"),marginRight:"30rpx",alignSelf:"flex-start",fontWeight:"500"}},sValueStyle:function(){return{color:this.data.info_content_color,fontSize:"".concat(this.data.info_content_font,"rpx")}},btnStyle:function(){var t=this.data,a=t.customer_top,e=t.customer_left_right,i=t.customer_height;return{height:"".concat(i,"rpx"),margin:"".concat(a,"rpx ").concat(e,"rpx 0"),background:"linear-gradient(106deg, #FF7473 0%, #FF4544 100%)",borderRadius:"40rpx",color:"white",fontSize:"32rpx"}}}),data:function(){return{navHeight:0,markers:[],data:{},mch_id:"",mchData:{},isKfShow:!1,scrollTop:0}},onLoad:function(t){this.$commonLoad.onload(t),this.mch_id=t.mch_id,this.loadData()},onPageScroll:function(t){(t.scrollTop>10&&this.scrollTop<=10||t.scrollTop<10&&this.scrollTop>10)&&(this.scrollTop=t.scrollTop)},methods:{setHeight:function(t){this.navHeight=t},callPhone:function(){uni.makePhoneCall({phoneNumber:this.mchData.mobile})},mapPower:function(){var t=this.mchData,a=t.latitude,e=t.longitude,i=t.name,n=t.address;uni.openLocation({latitude:parseFloat(a),longitude:parseFloat(e),name:i,address:n})},loadData:function(){var t=this;this.$showLoading({title:"加载中"}),this.$request({url:this.$api.mch.store_reflection,data:{mch_id:this.mch_id}}).then((function(a){t.$hideLoading(),0===a.code&&(t.data=a.data,t.mchData=a.data.mch,t.markers=[{id:0,width:76,height:54,longitude:t.mchData.longitude,latitude:t.mchData.latitude,iconPath:"./../image/summary-map.png"}])})).catch((function(a){t.$hideLoading()}))}}};a.default=p},"98db":function(t,a,e){"use strict";var i=e("4ea4");e("8e6e"),e("ac6a"),e("456d"),Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var n=i(e("bd86")),o=e("2f62");function r(t,a){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);a&&(i=i.filter((function(a){return Object.getOwnPropertyDescriptor(t,a).enumerable}))),e.push.apply(e,i)}return e}function s(t){for(var a=1;a<arguments.length;a++){var e=null!=arguments[a]?arguments[a]:{};a%2?r(Object(e),!0).forEach((function(a){(0,n.default)(t,a,e[a])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):r(Object(e)).forEach((function(a){Object.defineProperty(t,a,Object.getOwnPropertyDescriptor(e,a))}))}return t}var c={name:"mch-customer",props:{value:Boolean,mchData:Object,infoData:Object},data:function(){return{showModel:this.value}},watch:{value:function(t){this.showModel=t}},computed:s(s(s({},(0,o.mapGetters)("mallConfig",{getTheme:"getTheme"})),(0,o.mapState)({appImg:function(t){return t.mallConfig.plugin.mch.app_image}})),{},{themeStyle:function(){var t=this.getTheme.color;if(t)return{backgroundImage:"linear-gradient(to right,".concat(t,", ").concat(this.$utils.colorRgba(t,.7),")")}}}),methods:{close:function(){this.$emit("input",!1)},copyWechat:function(){this.$utils.uniCopy({data:this.mchData.wechat,success:function(){uni.showToast({title:"复制成功",icon:"none"})}})},callPhone:function(){uni.makePhoneCall({phoneNumber:this.mchData.service_mobile})},jumpKf:function(){uni.navigateTo({url:"/pages/web/web?url="+encodeURIComponent(this.mchData.web_service_url)})}}};a.default=c},a08c:function(t,a,e){var i=e("6747");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=e("4f06").default;n("c2639ed4",i,!0,{sourceMap:!1,shadowMode:!1})},b7ce:function(t,a,e){"use strict";e.r(a);var i=e("2aee"),n=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(o);a["default"]=n.a},be3d:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,".text-center[data-v-01ed1c14]{text-align:center}.font-weight[data-v-01ed1c14]{font-weight:700}.page-width[data-v-01ed1c14]{width:100%}.goods-hover-class[data-v-01ed1c14]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-01ed1c14]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-01ed1c14]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-01ed1c14]{width:100%}.u-hover-class[data-v-01ed1c14]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-01ed1c14]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-navigation-bar[data-v-01ed1c14]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;width:100%;bottom:0;left:0;background-color:#fff;z-index:1000;position:fixed;-webkit-box-shadow:0 %?2?% 0 0 #e5e5e5;box-shadow:0 %?2?% 0 0 #e5e5e5}.navbar-item[data-v-01ed1c14]{position:relative}.app-icon[data-v-01ed1c14]{width:%?44?%;height:%?44?%;position:absolute;top:0;left:50%;margin-top:%?16?%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.app-nav-text[data-v-01ed1c14]{font-size:%?22?%;line-height:%?22?%;margin-top:%?60?%}.app-tab-bar-shadow[data-v-01ed1c14]{border-top:%?1?% solid #e2e2e2}body.?%PAGE?%[data-v-01ed1c14]{background:#f7f7f7}",""])},c558:function(t,a,e){"use strict";e.r(a);var i=e("8d6fa"),n=e.n(i);for(var o in i)["default"].indexOf(o)<0&&function(t){e.d(a,t,(function(){return i[t]}))}(o);a["default"]=n.a},c87b:function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return i}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("app-layout",[e("v-uni-view",{staticClass:"summary",style:{minHeight:"calc(100vh - "+(t.navHeight||"0px")+")"}},[t.navbarStatus?e("app-nav-bar",{attrs:{title:"店铺印象",fixed:!0,"has-height":!1,"has-mall-setting":"0","back-color":t.scrollTop>10?"black":"white",color:t.scrollTop>10?"#353535":"white","background-color":t.scrollTop>10?"white":"rgba(0,0,0,0)"}}):t._e(),e("v-uni-view",{style:[t.bgStyle]}),1==t.data.basic_style?[e("v-uni-view",{style:[t.logoStyle]}),e("v-uni-view",{staticClass:"shop-pos",style:{paddingTop:"calc("+t.data.card_top+"rpx  + 3rpx + "+t.data.shop_logo_size/2+"rpx)"}},[e("v-uni-view",{staticClass:"dir-top-nowrap",style:[t.boxStyle]},[e("v-uni-view",{staticClass:"dir-top-nowrap cross-center"},[e("v-uni-view",{staticClass:"summary-name",style:{color:t.data.shop_title_color,fontSize:t.data.shop_logo_font+"rpx"}},[t._v(t._s(t.mchData.name))])],1),e("v-uni-view",{staticClass:"dir-top-nowrap center"},[e("v-uni-view",{staticClass:"dir-left-nowrap cross-center",style:{marginBottom:t.data.card_padding+"rpx"}},[e("v-uni-view",{staticClass:"box-grow-0",style:[t.sLabelStyle]},[t._v("主营内容")]),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.scope))])],1),e("v-uni-view",{staticClass:"dir-left-nowrap cross-center",style:{marginBottom:t.data.card_padding+"rpx"}},[e("v-uni-view",{staticClass:"box-grow-0",style:[t.sLabelStyle]},[t._v("店铺简介")]),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.description))])],1),e("v-uni-view",{staticClass:"dir-left-nowrap cross-center",style:{marginBottom:t.data.card_padding+"rpx"}},[e("v-uni-view",{staticClass:"box-grow-0",style:[t.sLabelStyle]},[t._v("营业时间")]),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.business_hours))])],1),1==t.data.has_shop_phone?e("v-uni-view",{staticClass:"dir-left-nowrap cross-center",style:{marginBottom:t.data.card_padding+"rpx"}},[e("v-uni-view",{staticClass:"box-grow-0 cross-center",staticStyle:{"min-height":"48rpx","align-self":"flex-start"}},[e("v-uni-view",{style:[t.sLabelStyle,{alignSelf:"auto !important"}]},[t._v("联系电话")])],1),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.mobile))]),e("v-uni-view",{staticClass:"shop-phone",staticStyle:{"line-height":"1"},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.callPhone.apply(void 0,arguments)}}})],1):t._e(),e("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},[e("v-uni-view",{staticClass:"box-grow-0 cross-center",staticStyle:{"min-height":"28rpx","align-self":"flex-start"}},[e("v-uni-view",{style:[t.sLabelStyle,{alignSelf:"auto !important"}]},[t._v("店铺地址")])],1),e("v-uni-view",{staticClass:"box-grow-1",style:[t.sValueStyle],on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.mapPower.apply(void 0,arguments)}}},[t._v(t._s(t.mchData.address))]),e("v-uni-view",{staticClass:"box-grow-0",staticStyle:{"line-height":"1"},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.mapPower.apply(void 0,arguments)}}},[e("v-uni-image",{staticClass:"arrow",staticStyle:{height:"28rpx",width:"18rpx"},attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),e("v-uni-view",{staticClass:"map"},[e("v-uni-map",{staticClass:"map",attrs:{markers:t.markers,latitude:t.mchData.latitude,longitude:t.mchData.longitude}})],1)],1)],1),1==t.data.has_contact_customer?e("v-uni-view",{staticClass:"main-center cross-center",style:[t.btnStyle],on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.isKfShow=!0}}},[t._v("联系客服")]):t._e()],1)]:t._e(),2==t.data.basic_style?[e("v-uni-view",{staticClass:"shop-pos",style:{paddingTop:t.data.card_top+"rpx"}},[e("v-uni-view",{style:{margin:"0 "+t.data.card_left_right+"rpx"}},[e("v-uni-view",{staticClass:"shop-style2 dir-left-nowrap cross-center",style:{borderRadius:t.data.card_radius+"rpx"}},[e("v-uni-image",{staticClass:"box-grow-0",style:{borderRadius:t.data.shop_logo_radius+"rpx",height:"calc("+t.data.shop_logo_size+"rpx + 6rpx)",width:"calc("+t.data.shop_logo_size+"rpx + 6rpx)"},attrs:{src:t.mchData.cover_url}}),e("v-uni-view",{staticClass:"dir-top-nowrap",staticStyle:{"margin-left":"20rpx"}},[e("v-uni-view",{staticClass:"summary-name",style:{color:t.data.shop_title_color,fontSize:t.data.shop_logo_font+"rpx"}},[t._v(t._s(t.mchData.name))]),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.description))])],1)],1),e("v-uni-view",{staticClass:"shop-style2",style:{marginTop:t.data.card_padding+"rpx",borderRadius:t.data.card_radius+"rpx"}},[e("v-uni-view",{staticClass:"dir-left-nowrap cross-center",staticStyle:{"margin-bottom":"30rpx"}},[e("v-uni-view",{staticClass:"box-grow-0",style:[t.sLabelStyle]},[t._v("主营内容")]),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.scope))])],1),e("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},[e("v-uni-view",{staticClass:"box-grow-0",style:[t.sLabelStyle]},[t._v("营业时间")]),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.business_hours))])],1)],1),1==t.data.has_shop_phone?e("v-uni-view",{staticClass:"shop-style2",style:{marginTop:t.data.card_padding+"rpx",borderRadius:t.data.card_radius+"rpx"}},[e("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},[e("v-uni-view",{staticClass:"box-grow-0 cross-center",staticStyle:{"min-height":"48rpx","align-self":"flex-start"}},[e("v-uni-view",{style:[t.sLabelStyle,{alignSelf:"auto !important"}]},[t._v("联系电话")])],1),e("v-uni-view",{style:[t.sValueStyle]},[t._v(t._s(t.mchData.mobile))]),e("v-uni-view",{staticClass:"shop-phone",staticStyle:{"line-height":"1"},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.callPhone.apply(void 0,arguments)}}})],1)],1):t._e(),e("v-uni-view",{staticClass:"shop-style2",style:{marginTop:t.data.card_padding+"rpx",borderRadius:t.data.card_radius+"rpx"}},[e("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},[e("v-uni-view",{staticClass:"box-grow-0 cross-center",staticStyle:{"min-height":"28rpx","align-self":"flex-start"}},[e("v-uni-view",{style:[t.sLabelStyle,{alignSelf:"auto !important"}]},[t._v("店铺地址")])],1),e("v-uni-view",{staticClass:"box-grow-1",style:[t.sValueStyle],on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.mapPower.apply(void 0,arguments)}}},[t._v(t._s(t.mchData.address))]),e("v-uni-view",{staticClass:"box-grow-0",staticStyle:{"line-height":"1"},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.mapPower.apply(void 0,arguments)}}},[e("v-uni-image",{staticClass:"arrow",staticStyle:{height:"28rpx",width:"18rpx"},attrs:{src:"/static/image/icon/arrow-right.png"}})],1)],1),e("v-uni-view",{staticStyle:{"margin-top":"24rpx"}},[e("v-uni-map",{staticClass:"map",attrs:{markers:t.markers,latitude:t.mchData.latitude,longitude:t.mchData.longitude}})],1)],1)],1),1==t.data.has_contact_customer?e("v-uni-view",{staticClass:"main-center cross-center",style:[t.btnStyle],on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.isKfShow=!0}}},[t._v("联系客服")]):t._e()],1)]:t._e(),e("mch-customer",{attrs:{"mch-data":t.mchData,"info-data":t.data},model:{value:t.isKfShow,callback:function(a){t.isKfShow=a},expression:"isKfShow"}}),t.mch_id?e("mch-navbar",{attrs:{mchId:t.mch_id},on:{setHeight:function(a){arguments[0]=a=t.$handleEvent(a),t.setHeight.apply(void 0,arguments)}}}):t._e()],2)],1)},o=[]},d2cc:function(t,a,e){"use strict";var i;e.d(a,"b",(function(){return n})),e.d(a,"c",(function(){return o})),e.d(a,"a",(function(){return i}));var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("v-uni-view",{staticClass:"app-nav-bar"},[t.hasHeight?e("v-uni-view",{staticClass:"hidden-height",style:[t.hiddenHeight()]}):t._e(),e("v-uni-view",{class:{"app-navbar--fixed":t.fixed,"app-navbar--shadow":t.shadow,"app-navbar--border":t.border,"app-navbar--content":!0}},[e("v-uni-view",{staticClass:"app-navbar__bar cross-center",style:[t.ordinaryStyle()]},[e("v-uni-view",{staticClass:"dir-left-nowrap app-navbar__box"},[t.pagesLength>1?e("v-uni-view",{staticClass:"app-navbar__back cross-center box-grow-0",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.onClickBack.apply(void 0,arguments)}}},[e("v-uni-view",{staticClass:"icon-back",class:t.backColor})],1):t._e(),e("v-uni-view",{staticClass:"box-grow-1 dir-left-nowrap app-navbar__right",class:{"main-center app-navbar__right-center":"center"===t.position&&1==t.xStyle,right__back:t.pagesLength>1}},[t.showLeftIcon?e("v-uni-view",[e("app-jump-button",{attrs:{form:!0,open_type:t.link.openType,url:t.link.url,params:t.link.params}},[e("v-uni-view",{staticClass:"cross-center box-grow-0 left-icon"},[e("v-uni-image",{style:[t.hw_style],attrs:{src:t.leftIcon}})],1)],1)],1):t._e(),t.showTitle?e("v-uni-view",{staticClass:"cross-center box-grow-0 title"},[t.hasJump?e("app-jump-button",{attrs:{form:!0,open_type:t.link.openType,url:t.link.url,params:t.link.params}},[e("v-uni-view",{staticClass:"t-omit",style:[t.maxWidth()]},[t._v(t._s(t.title))])],1):e("v-uni-view",{staticClass:"t-omit",style:[t.maxWidth()]},[t._v(t._s(t.title))])],1):t._e(),t.showLink?e("v-uni-view",{staticClass:"cross-center box-grow-0 link"},[e("v-uni-view",{staticClass:"link-search",style:{color:t.placeholderColor},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.navGoodsSearch.apply(void 0,arguments)}}},[e("v-uni-view",{staticClass:"link-box cross-center main-between"},[e("v-uni-view",{staticClass:"search-placeholder t-omit"},[t._v(t._s(t.placeholder))]),e("v-uni-view",{staticClass:"search-icon"})],1)],1)],1):t._e()],1)],1)],1)],1)],1)},o=[]},d6d3:function(t,a,e){a=t.exports=e("24fb")(!1);var i=e("b605"),n=i(e("2917")),o=i(e("e422")),r=i(e("4230"));a.push([t.i,".text-center[data-v-488d01fb]{text-align:center}.font-weight[data-v-488d01fb]{font-weight:700}.page-width[data-v-488d01fb]{width:100%}.goods-hover-class[data-v-488d01fb]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-488d01fb]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-488d01fb]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-488d01fb]{width:100%}.u-hover-class[data-v-488d01fb]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-488d01fb]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-nav-bar .hidden-height[data-v-488d01fb]{height:44px}.app-nav-bar .app-navbar--fixed[data-v-488d01fb]{position:fixed;z-index:9998;top:0}.app-nav-bar .app-navbar--shadow[data-v-488d01fb]{-webkit-box-shadow:0 1px 6px #ccc;box-shadow:0 1px 6px #ccc}.app-nav-bar .app-navbar--border[data-v-488d01fb]{border-bottom-width:%?1?%;border-bottom-style:solid;border-bottom-color:#fff}.app-nav-bar .app-navbar--content[data-v-488d01fb]{width:100vw;overflow:hidden}.app-navbar__bar[data-v-488d01fb]{height:44px;padding-top:0}.app-navbar__bar .app-navbar__box[data-v-488d01fb]{position:relative;width:100%;height:100%}.app-navbar__bar .app-navbar__box .app-navbar__back[data-v-488d01fb]{padding:0 %?52?% 0 %?26?%;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0}.app-navbar__bar .app-navbar__box .app-navbar__back .icon-back[data-v-488d01fb]{background-repeat:no-repeat;background-size:100% 100%;height:%?48?%;width:%?24?%;display:block}.app-navbar__bar .app-navbar__box .app-navbar__back .icon-back.black[data-v-488d01fb]{background-image:url("+n+")}.app-navbar__bar .app-navbar__box .app-navbar__back .icon-back.white[data-v-488d01fb]{background-image:url("+o+")}.app-navbar__bar .app-navbar__box .app-navbar__right>uni-view[data-v-488d01fb]{padding-left:%?26?%}.app-navbar__bar .app-navbar__box .app-navbar__right .left-icon uni-image[data-v-488d01fb]{max-height:%?54?%;max-width:%?100?%;height:0;width:0;display:block}.app-navbar__bar .app-navbar__box .app-navbar__right .title[data-v-488d01fb]{font-size:%?32?%;font-weight:700}.app-navbar__bar .app-navbar__box .app-navbar__right .title>uni-view[data-v-488d01fb]{max-width:50vw}.app-navbar__bar .app-navbar__box .app-navbar__right .link-search[data-v-488d01fb]{width:%?298?%;height:%?55?%;background-color:#fff;border-radius:%?40?%;position:relative}.app-navbar__bar .app-navbar__box .app-navbar__right .link-search .link-box[data-v-488d01fb]{position:absolute;top:0;left:0;font-size:%?22?%;height:%?55?%;padding:0 %?24?%;width:100%;border:%?1?% solid #e2e2e2;border-radius:%?40?%}.app-navbar__bar .app-navbar__box .app-navbar__right .link-search .link-box .search-placeholder[data-v-488d01fb]{max-width:%?218?%}.app-navbar__bar .app-navbar__box .app-navbar__right .link-search .link-box .search-icon[data-v-488d01fb]{background-image:url("+r+");background-repeat:no-repeat;background-size:100% 100%;height:%?26?%;width:%?26?%}.app-navbar__bar .app-navbar__box .app-navbar__right-center[data-v-488d01fb]{margin-right:0}.app-navbar__bar .app-navbar__box .app-navbar__right-center .title[data-v-488d01fb]{padding-left:0}.app-navbar__bar .app-navbar__box .app-navbar__right-center.right__back[data-v-488d01fb]{margin-right:calc(%?26?% + %?16?% + %?56?%)}body.?%PAGE?%[data-v-488d01fb]{background:#f7f7f7}",""])},e422:function(t,a){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAxCAMAAAAYyPIKAAAANlBMVEUAAAD////////////////////////////////////////////////////////////////////xY8b8AAAAEnRSTlMA5p6UhYxtr356dQndVKZkXT5+K1ymAAAAbElEQVQ4y93RMRKAIAxE0USCAoLK/S9rOgs3mcGx0d++amfp/03NAuZmAc9DEBSKBdmChCB6IAjEg4ggWZAVwhAUC2aFiVD1grssK5TGJh2PaFfayCNz1JtUfAqYMiL/Wk18EkyRayecdPpuJ52FAmrMPocjAAAAAElFTkSuQmCC"},e516:function(t,a,e){var i=e("d6d3");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=e("4f06").default;n("35e90ae7",i,!0,{sourceMap:!1,shadowMode:!1})},ef0e:function(t,a,e){a=t.exports=e("24fb")(!1),a.push([t.i,'.text-center[data-v-272cac98]{text-align:center}.font-weight[data-v-272cac98]{font-weight:700}.page-width[data-v-272cac98]{width:100%}.goods-hover-class[data-v-272cac98]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-272cac98]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-272cac98]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-272cac98]{width:100%}.u-hover-class[data-v-272cac98]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-272cac98]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.summary[data-v-272cac98]{position:relative;height:100%}.summary .shop-pos[data-v-272cac98]{position:relative;z-index:2;margin-bottom:%?24?%}.summary .shop-pos .center>uni-view[data-v-272cac98]{margin-bottom:%?40?%}.summary .shop-pos .summary-name[data-v-272cac98]{font-weight:500;font-size:%?40?%;margin-bottom:%?10?%}.summary .shop-pos .summary-tag[data-v-272cac98]{font-size:%?24?%;color:#ff4544;padding:%?4?% %?14?%;border-radius:%?4?%;border:1px solid #ff4544;margin-right:%?10?%;margin-bottom:%?10?%}.summary .shop-pos .center[data-v-272cac98]{margin-top:%?30?%}.summary .shop-style2[data-v-272cac98]{padding:%?24?%;background:#fff;border-radius:%?8?%}.summary .shop-phone[data-v-272cac98]{margin-left:auto;background-size:100% 100%;background-repeat:no-repeat;height:%?48?%;width:%?48?%;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAclBMVEUAAACkpKSZmZmampqVlZWZmZmampqZmZmZmZmZmZmbm5udnZ2ampqampqZmZmYmJiZmZmZmZmZmZmTk5OZmZmampqZmZmZmZmZmZmYmJiZmZmZmZmbm5uampqYmJiZmZmZmZmZmZmZmZmampqYmJiZmZmZotNBAAAAJXRSTlMADcRlCvPjHvc+WRe1lX3s+75GBOV0VdXSv6MoJWtdijkrz6ukD4vHCAAAAdZJREFUSMelltmSgjAQRZtAwr4jKoo6y/3/XxwNM2nIBC3K84BVmJt0d3qB3idN8lpFQKTqPEnpBZ4voKkqaITvPVtelIDMdk0YEAVhs8skUBarkr4DxCWgGcFFAF3v3n4AREz/iAUwOA4J95A+OfEl9iFZnBQOJ1rhdICy/gwVjt6TaByhwsWLPY4BPSE4Yj/fcMDBe3FBBwyzeEKe6QVnid6oO5j4pGM+tu5YofuzooD4eztGAHJyIlD8HlAiNrs8iNwpF6P0plXmgLaDZlw7wv/9TcweE7VbcJl2TiEDtkhTee7LkHgYmyAjS4CenGTalhw7skyKYrdgpwNYozEXEk3rG3LTaO8UOK2+tCChFUKo+zMCp91NC4rVFER0f6JauHVHhmuKCq0lOGsvRLsuMCaZQDzIn5nETrNRuE5hDl1O67Ay3qdWZCnRFSiz4maFlS+Oy/uBvF4x8ZnOLo5Tg/kosaRYpAYnHysUFuSL5OP0ZlKBOSOntykgi7aoYCg9LiAuUZuPGgCnIpcoNwGb2yBxR8V2E+A2Y9PeLn7cztvMlkZ2kui3tso3mvG2ds8DZdWPMw+U7SOL8b63DEUeu8ly7CY8djcM9jc+Hd7+OGHatU7zA+eJPBsdy0rTAAAAAElFTkSuQmCC")}.summary .map[data-v-272cac98]{width:100%;min-width:0;min-height:0;height:%?320?%}body.?%PAGE?%[data-v-272cac98]{background:#f7f7f7}',""])}}]);