(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["plugins-mch-shop-weitao"],{"077e":function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAMAAADW3miqAAAAclBMVEUAAACZmZmZmZmampqbm5udnZ2ZmZmZmZmZmZmZmZmZmZmZmZmZmZmXl5eWlpaenp6ZmZmampqZmZmZmZmZmZmZmZmZmZmSkpKampqZmZmZmZmampqZmZmZmZmYmJiZmZmZmZmYmJibm5uYmJiZmZmZmZmrmR+0AAAAJXRSTlMA9fk1QwyQ39HLw6trGwcE6Cnw69aznA+VvqN3USQggntjXFw+kDlT3AAAAUlJREFUOMuFktmygjAQBUmQVVD2TUC92v//i5eKCiJJ0U+Tqk5OMhNroX5UQS5lEjb9ydKTdpKZzI01iuMqRXpB4AEgLhsnDoDcfaoY51AJoKzXjp2AuDpfmxoJxbg6J4Fi2O7zv7Y5AbTO5gYFlMvShUI5a8YcovntEjFYGg6QfS7fwdXScoTbu8+S3NFLg8R7VQ9wLQMl2Kqo4GmS7vBqfIA8maQUOlXkU66JM4SqkASWkQx/XxJvKcEcd4JWFSE4JsmGShUNHExS9Jler2w9IaSv3AwRG9P85ac0eqld/koskLbO+QNvHsYFklgTJqBfDbsYN06y/h51AfnhJ0vw05vRB47D1zEtAGJlOSUgy3t6nnpiRyGAe1xbE1GGIhMovN46b6365jHjR9PbN5bCvnSh74dVpGaxWGYWy963wLV2rSZU4fv8A25vIsd9vz+eAAAAAElFTkSuQmCC"},1490:function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",[t._t("default",[t.navs&&t.navs.length>1?a("v-uni-view",{style:{height:"calc("+t.botNavHei+"rpx + env(safe-area-inset-bottom))",width:"100%"}}):t._e()]),t.navs&&t.navs.length>1?a("v-uni-view",{staticClass:"app-navigation-bar safe-area-inset-bottom",class:{"app-tab-bar-shadow":t.shadow},style:{backgroundColor:t.bottom_background_color}},t._l(t.navs,(function(e,i){return a("v-uni-view",{key:i,staticClass:"navbar-item box-grow-1",style:{height:t.botNavHei+"rpx",backgroundColor:t.bottom_background_color,width:100/t.navs.length+"%"}},[a("app-jump-button",{staticClass:"app-button",attrs:{backgroundColor:t.bottom_background_color,open_type:e.open_type,params:e.params,url:e.url,arrangement:"column",form:!0}},[a("v-uni-image",{staticClass:"app-icon",attrs:{src:t.router===e.url?e.active_icon:e.icon}}),a("v-uni-text",{staticClass:"app-nav-text",style:{color:t.router===e.url?e.active_color:e.color}},[t._v(t._s(e.text))])],1)],1)})),1):t._e()],2)},r=[]},1523:function(t,e,a){"use strict";a.r(e);var i=a("39d9"),o=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=o.a},"1abe":function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var o=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("app-layout",[i("v-uni-view",{staticClass:"weitao"},[t.navbarStatus?i("app-nav-bar",{attrs:{fixed:!0,"has-height":!0,title:"店铺微淘",color:"block","background-color":"white"},on:{headHeight:function(e){arguments[0]=e=t.$handleEvent(e),t.headHeight.apply(void 0,arguments)}}}):t._e(),i("v-uni-view",{staticClass:"w-fixed",style:{top:t.startHeight+"px"}},[i("v-uni-view",{staticClass:"w-search dir-left-nowrap cross-center"},[i("v-uni-view",{staticClass:"box-grow-1 w-input"},[i("v-uni-input",{staticClass:"box-grow-1",staticStyle:{height:"100%","font-size":"24rpx"},attrs:{"confirm-type":"搜索",type:"text",placeholder:"请输入关键词搜索","placeholder-style":"font-size:24rpx;color:#999999"},on:{confirm:function(e){arguments[0]=e=t.$handleEvent(e),t.loadData.apply(void 0,arguments)},input:function(e){arguments[0]=e=t.$handleEvent(e),t.searchKeyword.apply(void 0,arguments)}},model:{value:t.search.keyword,callback:function(e){t.$set(t.search,"keyword",e)},expression:"search.keyword"}})],1),i("v-uni-view",{staticClass:"search-icon main-center cross-center box-grow-0",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.loadData.apply(void 0,arguments)}}},[i("v-uni-image",{attrs:{src:a("077e")}})],1)],1),t.tags&&t.tags.length?i("v-uni-view",{staticClass:"w-tag-all"},[i("v-uni-scroll-view",{attrs:{"scroll-left":t.scrollLeft,"scroll-x":!0,"scroll-with-animation":!0}},[i("v-uni-view",{staticClass:"dir-left-nowrap tag-text"},t._l(t.tags,(function(e,a){return i("v-uni-view",{key:a,staticClass:"box-grow-0 cross-center",style:{color:t.search.tag_id===e.id?t.getTheme.color:"inherit"},attrs:{id:"tag_id_"+e.id},on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.searchTab(e)}}},[t._v(t._s(e.name))])})),1)],1)],1):t._e()],1),i("v-uni-view",{staticClass:"w-goods-all dir-top-nowrap"},[t.tags&&t.tags.length?i("v-uni-view",{staticStyle:{height:"174rpx"}}):i("v-uni-view",{staticStyle:{height:"98rpx"}}),t._l(t.list,(function(e,a){return i("v-uni-view",{key:a,staticClass:"w-goods-box",on:{click:function(a){arguments[0]=a=t.$handleEvent(a),t.jumpDetail(e)}}},[i("v-uni-view",{class:{"dir-left-nowrap":3==e.layout_type}},[i("v-uni-view",{staticClass:"box-grow-1"},[i("v-uni-view",{staticClass:"w-goods-title dir-left-nowrap cross-top"},[i("v-uni-view",{staticClass:"t-omit-two box-grow-1"},[t._v(t._s(e.title))]),2==e.layout_type?i("v-uni-view",{staticClass:"l-right box-grow-0"}):t._e()],1),i("v-uni-view",{staticClass:"w-goods-remake show-remake-----bad-platform",class:3!=e.layout_type?" t-omit-three":" t-omit-two",style:{"--remake-color":"linear-gradient(to right,"+e.tag.extra_attributes.color+", "+t.colorRgba(e.tag.extra_attributes.color)+")"},attrs:{"data-remake-title":e.tag.name}},[i("v-uni-view",{staticClass:"show-remake-platform",staticStyle:{display:"inline-block"},style:{background:"linear-gradient(to right,"+e.tag.extra_attributes.color+", "+t.colorRgba(e.tag.extra_attributes.color)+")"}},[t._v(t._s(e.tag.name))]),t._v(t._s(e.abstract))],1)],1),i("v-uni-view",[1==e.layout_type?[i("v-uni-swiper",{staticStyle:{width:"auto",margin:"10rpx 24rpx"},style:{height:1!=e.proportion?2!=e.proportion?"327rpx":"436rpx":"654rpx"},attrs:{circular:!0,"indicator-active-color":"#ff4544","indicator-color":"#FFFFFF","indicator-dots":e.pic_url&&e.pic_url.length>1}},t._l(e.pic_url,(function(a,o){return i("v-uni-swiper-item",{key:o,staticClass:"w-big-pic"},[i("v-uni-image",{attrs:{src:a.pic_url},on:{click:function(a){a.stopPropagation(),arguments[0]=a=t.$handleEvent(a),t.jumpDetail(e)}}})],1)})),1)]:t._e(),2==e.layout_type?[i("v-uni-view",{staticClass:"w-pic dir-left-wrap",class:{"w-pic-four":4===e.pic_url.length}},t._l(e.pic_url,(function(a,o){return i("v-uni-image",{key:o,attrs:{src:a.pic_url},on:{click:function(a){a.stopPropagation(),arguments[0]=a=t.$handleEvent(a),t.openPre(e,o)}}})})),1)]:t._e(),3==e.layout_type?[e.pic_url?i("v-uni-image",{staticClass:"box-grow-0",staticStyle:{"margin-left":"26rpx","margin-right":"24rpx",height:"160rpx",width:"160rpx","border-radius":"16rpx"},attrs:{src:e.pic_url[0].pic_url},on:{click:function(a){a.stopPropagation(),arguments[0]=a=t.$handleEvent(a),t.jumpDetail(e)}}}):t._e()]:t._e()],2)],1),e.goods_list&&e.goods_list.length?i("v-uni-view",{staticClass:"w-right-goods"},[i("v-uni-scroll-view",{attrs:{"scroll-x":!0}},[i("v-uni-view",{staticClass:"dir-left-nowrap cross-center"},t._l(e.goods_list,(function(a,o){return i("v-uni-view",{key:o,staticClass:"box-grow-0 dir-left-nowrap w-m-s",class:["w-m-"+e.goods_list.length],on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.jumpGoods(a)}}},[i("v-uni-image",{staticClass:"box-grow-0 m-pic",attrs:{src:a.cover_pic}}),i("v-uni-view",{staticClass:"dir-top-nowrap main-center m-text"},[i("v-uni-view",[i("v-uni-view",{staticClass:"m-text-name t-omit",staticStyle:{display:"block"},style:{maxWidth:1!=e.goods_list.length?2!=e.goods_list.length?"174rpx":"270rpx":"540rpx"}},[t._v(t._s(a.name))])],1),i("v-uni-view",{staticClass:"dir-left-nowrap t-omit",style:{maxWidth:1!=e.goods_list.length?2!=e.goods_list.length?"174rpx":"270rpx":"540rpx"}},[i("v-uni-text",{staticStyle:{"font-size":"24rpx","font-weight":"bold"},style:{color:t.getTheme.color}},[t._v("￥")]),i("v-uni-text",{staticStyle:{"font-size":"28rpx","font-weight":"bold"},style:{color:t.getTheme.color}},[t._v(t._s(a.price))]),i("v-uni-text",{staticClass:"m-d"},[t._v("￥"+t._s(a.original_price))])],1)],1)],1)})),1)],1)],1):t._e(),i("v-uni-view",{staticClass:"w-read"},[t._v(t._s(e.read_number)+" 阅读")])],1)})),t.list&&t.list.length?t._e():i("v-uni-view",{staticClass:"dir-top-nowrap cross-center w-empty"},[i("v-uni-image",{attrs:{src:a("8979")}}),i("v-uni-view",[t._v("这里暂时还没有内容哦～")])],1)],2)],1),t.mch_id?i("mch-navbar",{attrs:{mchId:t.mch_id}}):t._e(),i("pre-topic",{attrs:{previewItem:t.previewItem,swiperCurrent:t.swiperCurrent,previewStatus:t.previewStatus},on:{"update:previewStatus":function(e){arguments[0]=e=t.$handleEvent(e),t.previewStatus=e},"update:preview-status":function(e){arguments[0]=e=t.$handleEvent(e),t.previewStatus=e}}})],1)},r=[]},"1ddd":function(t,e,a){"use strict";var i=a("35a6"),o=a.n(i);o.a},"35a6":function(t,e,a){var i=a("be3d");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("43807904",i,!0,{sourceMap:!1,shadowMode:!1})},3724:function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return o})),a.d(e,"c",(function(){return r})),a.d(e,"a",(function(){return i}));var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"pre-topic"},[t.previewStatus?a("v-uni-view",{staticClass:"pri",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closePri.apply(void 0,arguments)}}},[a("v-uni-view",{staticStyle:{"margin-top":"20vh",height:"750rpx",position:"relative"},on:{"!click":function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.sStop.apply(void 0,arguments)}}},[a("v-uni-swiper",{staticStyle:{height:"750rpx"},attrs:{current:t.selectCurrent,"next-active-color":"white"},on:{change:function(e){arguments[0]=e=t.$handleEvent(e),t.swiperChange.apply(void 0,arguments)},touchend:function(e){arguments[0]=e=t.$handleEvent(e),t.touchend(null)},transition:function(e){arguments[0]=e=t.$handleEvent(e),t.swiperTransition.apply(void 0,arguments)}}},t._l(t.previewItem.pic_url,(function(t,e){return a("v-uni-swiper-item",{key:e},[a("v-uni-image",{staticStyle:{height:"100%",width:"100%"},attrs:{src:t.pic_url}})],1)})),1),a("v-uni-view",{staticClass:"main-center cross-center indicator u-border-box"},[t.previewItem.pic_url?a("v-uni-view",{staticClass:"dir-left-nowrap"},t._l(t.previewItem.pic_url,(function(e,i){return a("v-uni-view",{key:i,staticClass:"circle",style:{backgroundColor:t.selectCurrent===i?"white":"rgba(255,255,255,.4)"}})})),1):t._e()],1),t.previewItem&&t.selectCurrent===t.previewItem.pic_url.length-1?a("v-uni-view",{staticClass:"dir-left-nowrap info cross-center"},[a("v-uni-view",{staticClass:"dir-top-nowrap",staticStyle:{"margin-left":"auto"}},t._l(["查","看","详","情"],(function(e){return a("v-uni-view",{key:e},[t._v(t._s(e))])})),1),a("v-uni-view",{staticClass:"arrow-right",style:{transform:t.isJump?"rotate(90deg)":"rotate(-90deg)"}})],1):t._e()],1),a("v-uni-view",{staticClass:"pri-btn dir-left-nowrap cross-center main-center",on:{click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.touchend.apply(void 0,arguments)}}},[a("v-uni-view",{staticClass:"box-grow-0",staticStyle:{"line-height":"1"}},[t._v("查看全文")]),a("v-uni-view",{staticClass:"pri-icon box-grow-0"})],1)],1):t._e()],1)},r=[]},"39d9":function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o=i(a("bd86"));a("c5f6");var r=a("2f62");function n(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function s(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?n(Object(a),!0).forEach((function(e){(0,o.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):n(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var c={name:"mch-navbar",data:function(){return{router:"",navs:[],bottom_background_color:"",shadow:!1}},props:{mchId:[String,Number],pageCount:Number},computed:s({},(0,r.mapGetters)("iPhoneX",{botNavHei:"getNavHei"})),methods:{flashData:function(t){var e=this;if(t){var a=JSON.parse(JSON.stringify(t)),i=a.bottom_background_color,o=a.shadow,r=a.navs;this.bottom_background_color=i,this.shadow=o,this.navs=r.map((function(t){return t.url=t.url+"?mch_id="+e.mchId,t}))}}},created:function(){function t(){e.$request({url:e.$api.mch.diy_nav,data:{mch_id:e.mchId}}).then((function(t){0===t.code&&(e.flashData(t.data.navbar),e.$storage.setStorage({key:"MCH_NARBAR_"+e.mchId,data:t.data.navbar}))}))}this.$request({url:this.$api.index.status,data:{mch_id_list:JSON.stringify([this.mchId])}}).then((function(t){0===t.code||wx.showModal({title:"提示",showCancel:!1,content:t.msg,success:function(t){uni.navigateBack({delta:1})}})}));var e=this;e.$storage.getStorage({key:"MCH_NARBAR_"+e.mchId,success:function(a){e.flashData(a.data),t()},fail:function(e){t()}})},watch:{navs:{handler:function(t){this.$emit("setHeight",this.navs&&this.navs.length>1?"(".concat(this.botNavHei,"rpx + env(safe-area-inset-bottom))"):0)},deep:!0},$route:{handler:function(t){var e=t.query,a=t.meta,i="?";for(var o in e)i+="".concat(o,"=").concat(e[o],"&");var r="/"+a.pagePath+i;r=r.slice(0,r.length-1),this.router=r},deep:!0,immediate:!0}}};e.default=c},"485e":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("c5f6");var i={props:{previewStatus:Boolean,swiperCurrent:Number,previewItem:Object},data:function(){return{dx:0,selectCurrent:0,isJump:!1,previewIndex:0}},watch:{swiperCurrent:function(t){this.selectCurrent=t}},methods:{sStop:function(){},closePri:function(){this.$emit("update:previewStatus",!1),this.$emit("update:previewItem",null)},touchend:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;(t||this.isJump)&&(this.jumpDetail(this.previewItem),this.closePri())},jumpDetail:function(t){var e=t.id;uni.navigateTo({url:"/pages/topic/topic?id=".concat(e)})},swiperChange:function(t){var e=t.detail,a=this;a.selectCurrent=e.current},swiperTransition:function(t){var e=t.detail;this.isJump=e.dx>this.dx&&this.dx>50&&this.selectCurrent===this.previewItem.pic_url.length-1,this.dx=e.dx}}};e.default=i},"49df":function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,'.text-center[data-v-76942a3e]{text-align:center}.font-weight[data-v-76942a3e]{font-weight:700}.page-width[data-v-76942a3e]{width:100%}.goods-hover-class[data-v-76942a3e]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-76942a3e]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-76942a3e]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-76942a3e]{width:100%}.u-hover-class[data-v-76942a3e]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-76942a3e]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.weitao .l-right[data-v-76942a3e]{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAAJ1BMVEUAAAAzMzMtLS0zMzM0NDQyMjIyMjIyMjIzMzMsLCwyMjIzMzM1NTW9kjBxAAAADXRSTlMA/gXrslwuetYLUSMYvo7bOgAAADNJREFUKM9jIBswbUATUDFDFxBOQNPiOJiVaAhPQBUoFEXlswsGDD4FM9AUMPAsYCAfAACGrw0nd2uk1AAAAABJRU5ErkJggg==");background-repeat:no-repeat;background-size:100% 100%;height:%?31?%;width:%?31?%;margin-top:%?5?%}.weitao[data-v-76942a3e] ::-webkit-scrollbar{display:none;width:0!important;height:0!important;-webkit-appearance:none;background:rgba(0,0,0,0)}.weitao .l-right[data-v-76942a3e]{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAAJ1BMVEUAAAAzMzMtLS0zMzM0NDQyMjIyMjIyMjIzMzMsLCwyMjIzMzM1NTW9kjBxAAAADXRSTlMA/gXrslwuetYLUSMYvo7bOgAAADNJREFUKM9jIBswbUATUDFDFxBOQNPiOJiVaAhPQBUoFEXlswsGDD4FM9AUMPAsYCAfAACGrw0nd2uk1AAAAABJRU5ErkJggg==");background-repeat:no-repeat;background-size:100% 100%;height:%?31?%;width:%?31?%}.weitao .pri[data-v-76942a3e]{position:fixed;height:100vh;width:100vw;background:#000;z-index:33333;color:red;top:0;text-align:center}.weitao .pri .pri-icon[data-v-76942a3e]{margin-left:%?8?%;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAAKlBMVEUAAAD///////////////////////////////////////////////////+Gu8ovAAAADnRSTlMA/gXrXC6yetYLq1EjGAqR8lgAAAA0SURBVCjPYyAbMB1AE9AyRRNQEw5A05I4mJVoCE9AFSgUQeWzCzoMPgUz0BQw8G5gIB8AAOpEDUxLXkGwAAAAAElFTkSuQmCC");background-size:100% 100%;height:%?31?%;width:%?31?%}.weitao .pri .info[data-v-76942a3e]{height:100%;color:#fff;position:absolute;top:0;right:0;z-index:-1}.weitao .pri .info .arrow-right[data-v-76942a3e]{margin-left:%?10?%;margin-right:%?24?%;width:0;height:0;-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg);border-width:0 %?12?% %?20?%;border-style:solid;border-color:rgba(0,0,0,0) rgba(0,0,0,0) #fff}.weitao .pri .pri-btn[data-v-76942a3e]{color:#fff;font-size:%?32?%;width:%?300?%;height:%?100?%;background:hsla(0,0%,100%,.16);border-radius:%?50?%;margin:%?80?% auto 0}.weitao .w-fixed[data-v-76942a3e]{position:fixed;top:0;width:100%;background:#f6f6f6;z-index:1}.weitao .w-search[data-v-76942a3e]{height:%?110?%;padding-left:%?24?%}.weitao .w-search .w-input[data-v-76942a3e]{height:%?62?%;background:#fff;border-radius:%?35?%;padding:0 %?32?%}.weitao .w-search .search-icon>uni-image[data-v-76942a3e]{height:%?36?%;width:%?36?%;display:block;margin:0 %?24?%}.weitao .w-tag-all[data-v-76942a3e]{margin:0 0 %?24?% %?24?%}.weitao .w-tag-all .tag-text[data-v-76942a3e]{font-size:%?24?%;color:#333}.weitao .w-tag-all .tag-text>uni-view[data-v-76942a3e]{margin-right:%?24?%;border-radius:%?8?%;padding:0 %?24?%;height:%?50?%;background:#fff}.weitao .w-tag-all .tag-text>uni-view[data-v-76942a3e]:last-child{margin-right:0}.weitao .w-goods-all[data-v-76942a3e]{padding:0 %?24?% %?12?%}.weitao .w-goods-all .w-goods-box[data-v-76942a3e]{padding:%?22?% 0 %?25?%;background:#fff;margin-top:%?12?%;margin-bottom:%?20?%;border-radius:%?16?%}.weitao .w-goods-all .w-goods-box .w-goods-title[data-v-76942a3e]{font-size:%?32?%;color:#333;padding:0 %?24?%;font-weight:bolder;margin-bottom:%?10?%}.weitao .w-goods-all .w-goods-box .w-goods-remake[data-v-76942a3e]{font-size:%?28?%;margin:%?10?% %?24?%;color:#333}.weitao .w-goods-all .w-goods-box .show-remake-platform[data-v-76942a3e]{font-size:%?24?%;color:#fff;padding:%?3?% %?16?%;margin-right:%?16?%;border-radius:%?6?%}.weitao .w-goods-all .w-goods-box .show-remake[data-v-76942a3e]:before{content:attr(data-remake-title);font-size:%?24?%;color:#fff;padding:%?3?% %?16?%;margin-right:%?16?%;background:var(--remake-color);border-radius:%?6?%}.weitao .w-goods-all .w-goods-box .w-big-pic[data-v-76942a3e]{height:%?654?%}.weitao .w-goods-all .w-goods-box .w-big-pic>uni-image[data-v-76942a3e]{height:100%;width:100%}.weitao .w-goods-all .w-goods-box .w-pic[data-v-76942a3e]{margin:%?10?% %?13?% %?10?%}.weitao .w-goods-all .w-goods-box .w-pic>uni-image[data-v-76942a3e]{margin:%?10.5?%;height:%?204?%;width:%?204?%;border-radius:%?16?%;display:block}.weitao .w-goods-all .w-goods-box .w-pic-four>uni-image[data-v-76942a3e]{height:%?316?%;width:%?316?%}.weitao .w-goods-all .w-goods-box .w-right-goods[data-v-76942a3e]{margin:%?12?% %?24?%;height:%?90?%}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-s[data-v-76942a3e]{width:%?296?%;background:#f6f6f6;border-radius:%?8?%;margin-right:%?18?%}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-s .m-pic[data-v-76942a3e]{height:%?86?%;width:%?86?%;display:block;border-radius:%?8?% 0 0 %?8?%}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-s .m-text[data-v-76942a3e]{padding:0 %?18?%}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-s .m-text .m-text-name[data-v-76942a3e]{display:block;max-width:%?174?%;font-size:%?24?%;color:#333}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-s .m-text .m-d[data-v-76942a3e]{font-size:%?22?%;color:#999;text-decoration:line-through;padding-left:%?10?%}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-1[data-v-76942a3e]{width:100%}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-2[data-v-76942a3e]{width:%?394?%}.weitao .w-goods-all .w-goods-box .w-right-goods .w-m-3[data-v-76942a3e]{width:%?296?%}.weitao .w-goods-all .w-goods-box .w-read[data-v-76942a3e]{padding:%?10?% %?24?% 0;font-size:%?24?%;color:#999}.weitao .w-empty[data-v-76942a3e]{margin-top:%?166?%}.weitao .w-empty>uni-image[data-v-76942a3e]{height:%?240?%;width:%?240?%;display:block}.weitao .w-empty>uni-view[data-v-76942a3e]{padding-top:%?27?%;font-size:%?24?%;color:#999}body.?%PAGE?%[data-v-76942a3e]{background:#f7f7f7}',""])},"5ec5":function(t,e,a){var i=a("49df");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("1a13016c",i,!0,{sourceMap:!1,shadowMode:!1})},"70a5":function(t,e,a){"use strict";a.r(e);var i=a("1490"),o=a("1523");for(var r in o)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(r);a("1ddd");var n,s=a("f0c5"),c=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"01ed1c14",null,!1,i["a"],n);e["default"]=c.exports},8979:function(t,e){t.exports="data:image/png;base64,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"},"9a64":function(t,e,a){"use strict";var i=a("f0f6"),o=a.n(i);o.a},a7d4:function(t,e,a){"use strict";a.r(e);var i=a("3724"),o=a("ca8a");for(var r in o)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(r);a("9a64");var n,s=a("f0c5"),c=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"6b3fae42",null,!1,i["a"],n);e["default"]=c.exports},a836:function(t,e,a){"use strict";a.r(e);var i=a("1abe"),o=a("f43c");for(var r in o)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return o[t]}))}(r);a("f133");var n,s=a("f0c5"),c=Object(s["a"])(o["default"],i["b"],i["c"],!1,null,"76942a3e",null,!1,i["a"],n);e["default"]=c.exports},be3d:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,".text-center[data-v-01ed1c14]{text-align:center}.font-weight[data-v-01ed1c14]{font-weight:700}.page-width[data-v-01ed1c14]{width:100%}.goods-hover-class[data-v-01ed1c14]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-01ed1c14]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-01ed1c14]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-01ed1c14]{width:100%}.u-hover-class[data-v-01ed1c14]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-01ed1c14]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.app-navigation-bar[data-v-01ed1c14]{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;width:100%;bottom:0;left:0;background-color:#fff;z-index:1000;position:fixed;-webkit-box-shadow:0 %?2?% 0 0 #e5e5e5;box-shadow:0 %?2?% 0 0 #e5e5e5}.navbar-item[data-v-01ed1c14]{position:relative}.app-icon[data-v-01ed1c14]{width:%?44?%;height:%?44?%;position:absolute;top:0;left:50%;margin-top:%?16?%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.app-nav-text[data-v-01ed1c14]{font-size:%?22?%;line-height:%?22?%;margin-top:%?60?%}.app-tab-bar-shadow[data-v-01ed1c14]{border-top:%?1?% solid #e2e2e2}body.?%PAGE?%[data-v-01ed1c14]{background:#f7f7f7}",""])},ca8a:function(t,e,a){"use strict";a.r(e);var i=a("485e"),o=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=o.a},cab3:function(t,e,a){e=t.exports=a("24fb")(!1),e.push([t.i,'.text-center[data-v-6b3fae42]{text-align:center}.font-weight[data-v-6b3fae42]{font-weight:700}.page-width[data-v-6b3fae42]{width:100%}.goods-hover-class[data-v-6b3fae42]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-6b3fae42]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-6b3fae42]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-6b3fae42]{width:100%}.u-hover-class[data-v-6b3fae42]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-6b3fae42]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.pre-topic .indicator[data-v-6b3fae42]{margin-top:%?30?%;width:100%}.pre-topic .indicator .circle[data-v-6b3fae42]{height:%?10?%;margin:0 %?7.5?%;width:%?10?%;border-radius:50%}.pre-topic .pri[data-v-6b3fae42]{position:fixed;height:100vh;width:100vw;background:#000;z-index:33333;color:red;top:0;text-align:center}.pre-topic .pri .pri-icon[data-v-6b3fae42]{margin-left:%?8?%;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB8AAAAfBAMAAADtgAsKAAAAKlBMVEUAAAD///////////////////////////////////////////////////+Gu8ovAAAADnRSTlMA/gXrXC6yetYLq1EjGAqR8lgAAAA0SURBVCjPYyAbMB1AE9AyRRNQEw5A05I4mJVoCE9AFSgUQeWzCzoMPgUz0BQw8G5gIB8AAOpEDUxLXkGwAAAAAElFTkSuQmCC");background-size:100% 100%;height:%?31?%;width:%?31?%}.pre-topic .pri .info[data-v-6b3fae42]{height:100%;color:#fff;position:absolute;top:0;right:0;z-index:-1}.pre-topic .pri .info .arrow-right[data-v-6b3fae42]{margin-left:%?10?%;margin-right:%?24?%;width:0;height:0;-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg);border-width:0 %?12?% %?20?%;border-style:solid;border-color:rgba(0,0,0,0) rgba(0,0,0,0) #fff}.pre-topic .pri .pri-btn[data-v-6b3fae42]{color:#fff;font-size:%?32?%;width:%?300?%;height:%?100?%;background:hsla(0,0%,100%,.16);border-radius:%?50?%;margin:%?80?% auto 0}body.?%PAGE?%[data-v-6b3fae42]{background:#f7f7f7}',""])},f0f6:function(t,e,a){var i=a("cab3");"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var o=a("4f06").default;o("88fc5490",i,!0,{sourceMap:!1,shadowMode:!1})},f133:function(t,e,a){"use strict";var i=a("5ec5"),o=a.n(i);o.a},f43c:function(t,e,a){"use strict";a.r(e);var i=a("fb26"),o=a.n(i);for(var r in i)["default"].indexOf(r)<0&&function(t){a.d(e,t,(function(){return i[t]}))}(r);e["default"]=o.a},fb26:function(t,e,a){"use strict";var i=a("4ea4");a("8e6e"),a("ac6a"),a("456d"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0,a("386d");var o=i(a("bd86")),r=a("2f62"),n=i(a("70a5")),s=i(a("a7d4"));function c(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,i)}return a}function d(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?c(Object(a),!0).forEach((function(e){(0,o.default)(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):c(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var l={name:"weitao",components:{mchNavbar:n.default,preTopic:s.default},computed:d(d(d({},(0,r.mapGetters)("mallConfig",{getTheme:"getTheme"})),(0,r.mapState)({systemInfo:function(t){return t.gConfig.systemInfo}})),{},{navbarStatus:function(){return!this.$jwx.isWechat()}}),data:function(){return{page:1,list:[],tags:[],search:{keyword:"",tag_id:""},args:!1,load:!1,mch_id:"",scrollLeft:0,previewItem:null,swiperCurrent:0,previewStatus:!1,startHeight:0}},onLoad:function(t){this.$commonLoad.onload(t),this.mch_id=t.mch_id,this.loadData(),this.getTags()},methods:{headHeight:function(t){this.startHeight=t},openPre:function(t,e){this.previewStatus=!0,this.swiperCurrent=e,this.previewItem=t},loadData:function(){var t=this;this.page=1,this.$showLoading({title:"加载中"}),this.$request({url:this.$api.mch.weitao_list,data:Object.assign({mch_id:this.mch_id,page:this.page},this.search)}).then((function(e){t.$hideLoading(),0===e.code?t.list=e.data.list:uni.showToast({title:e.msg,icon:"none"})})).catch((function(e){t.$hideLoading()}))},getTags:function(){var t=this;this.$request({url:this.$api.mch.diy_tags,data:{mch_id:this.mch_id}}).then((function(e){if(0===e.code){t.tags=e.data.list;var a=t;t.$nextTick((function(e){var i=null;i=uni.createSelectorQuery().in(t),a.tags.map((function(t){i.select("#tag_id_".concat(t.id)).boundingClientRect((function(e){e&&(t["width"]=e.width)})).exec()}))}))}}))},colorRgba:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:.75;return this.$utils.colorRgba(t,e)},searchKeyword:function(t){var e=t.detail;Object.assign(this.search,{keyword:e.value.trim()})},searchTab:function(t){for(var e=t.id,a=0,i=0;i<this.tags.length;i++){if(this.tags[i].id===e){a+=this.tags[i].width/2;break}a+=this.tags[i].width+uni.upx2px(24)}this.scrollLeft=a-uni.upx2px(351)||0,e=this.search.tag_id===e?"":e,Object.assign(this.search,{tag_id:e}),this.loadData()},jumpDetail:function(t){var e=t.id;uni.navigateTo({url:"/plugins/mch/shop/weitao-detail?id=".concat(e,"&mch_id=").concat(this.mch_id)})},jumpGoods:function(t){var e=t.id;uni.navigateTo({url:"/plugins/mch/goods/goods?mch_id=".concat(this.mch_id,"&id=").concat(e)})},previewImage:function(t,e){uni.previewImage({urls:e.map((function(t){return t.pic_url})),current:t})}},onReachBottom:function(){var t=this;if(!t.args&&!t.load){t.load=!0;var e=t.page+1;t.$request({url:t.$api.mch.weitao_list,data:Object.assign({mch_id:this.mch_id,page:e},this.search)}).then((function(a){if(0===a.code){var i=[e,0===a.data.list.length,t.list.concat(a.data.list)];t.page=i[0],t.args=i[1],t.list=i[2]}t.load=!1}))}}};e.default=l}}]);