(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-app_admin-comment-comment"],{"430c":function(t,i,e){"use strict";e.r(i);var o=e("4341"),a=e.n(o);for(var n in o)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return o[t]}))}(n);i["default"]=a.a},4341:function(t,i,e){"use strict";var o=e("4ea4");Object.defineProperty(i,"__esModule",{value:!0}),i.default=void 0;var a=o(e("75fc")),n={name:"comment",data:function(){return{list:[],over:!1,page:1,is_reply:2,score:3,first:!0}},onLoad:function(){var t=this;this.$commonLoad.onload(),this.$showLoading({type:"global",text:"加载中..."}),this.$request({url:this.$api.app_admin.comments,data:{score:3,is_reply:2,page:1}}).then((function(i){t.$hideLoading(),0===i.code&&(t.first=!1,t.list=i.data.list)}))},onReachBottom:function(){this.over||(this.page++,this.request())},onShow:function(){var t=this;if(this.first)return!1;this.$request({url:this.$api.app_admin.comments,data:{score:this.score,is_reply:this.is_reply,page:this.page}}).then((function(i){if(0===i.code)for(var e in i.data.list)for(var o in t.list)t.list=i.data.list}))},methods:{setActiveNav:function(t){var i=this;this.page=1,this.score=t,this.is_reply=2,this.over=!1,uni.pageScrollTo({scrollTop:0}),uni.showLoading({title:"加载中..."}),this.$request({url:this.$api.app_admin.comments,data:{score:this.score,is_reply:this.is_reply,page:this.page}}).then((function(t){uni.hideLoading(),0===t.code&&(i.list=t.data.list)}))},setActiveReply:function(t){var i=this;this.page=1,this.is_reply=t,this.over=!1,uni.showLoading({title:"加载中..."}),this.$request({url:this.$api.app_admin.comments,data:{score:this.score,is_reply:this.is_reply,page:this.page}}).then((function(t){uni.hideLoading(),0===t.code&&(i.list=t.data.list)}))},request:function(){var t=this;this.$request({url:this.$api.app_admin.comments,data:{score:this.score,is_reply:this.is_reply,page:this.page}}).then((function(i){0===i.code&&(i.data.list.length>0?t.list=[].concat((0,a.default)(t.list),(0,a.default)(i.data.list)):t.over=!0)}))},isTop:function(t,i){var e=this,o=1==t.is_top?0:1;e.$request({url:e.$api.app_admin.comments_top,method:"POST",data:{status:o,id:t.id}}).then((function(a){0===a.code&&(t.is_top=o,e.list.splice(i,1,t),uni.showToast({title:a.msg,icon:"none"}))}))},isShow:function(t){var i=this;0===t.is_show?this.$request({url:this.$api.app_admin.comments_show,method:"POST",data:{is_show:1,id:t.id}}).then((function(e){if(0===e.code)for(var o=0;o<i.list.length;o++)t.id===i.list[o].id&&(i.list[o].is_show=1)})):this.$request({url:this.$api.app_admin.comments_show,method:"POST",data:{is_show:0,id:t.id}}).then((function(e){if(0===e.code)for(var o=0;o<i.list.length;o++)t.id===i.list[o].id&&(i.list[o].is_show=0)}))}}};i.default=n},"4ad7":function(t,i,e){"use strict";var o;e.d(i,"b",(function(){return a})),e.d(i,"c",(function(){return n})),e.d(i,"a",(function(){return o}));var a=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("app-layout",[e("v-uni-view",{staticClass:"comment"},[e("v-uni-view",{staticClass:"navigator dir-left-nowrap"},[e("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.setActiveNav(3)}}},[e("v-uni-text",{class:{"active-nav":3===t.score}},[t._v("好评")])],1),e("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.setActiveNav(2)}}},[e("v-uni-text",{class:{"active-nav":2===t.score}},[t._v("中评")])],1),e("v-uni-view",{on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.setActiveNav(1)}}},[e("v-uni-text",{class:{"active-nav":1===t.score}},[t._v("差评")])],1)],1),e("v-uni-view",{staticClass:"replyStatus dir-left-nowrap main-center cross-center"},[e("v-uni-view",{class:{"active-reply":2===t.is_reply},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.setActiveReply(2)}}},[t._v("未回复")]),e("v-uni-view",{class:{"active-reply":1===t.is_reply},on:{click:function(i){arguments[0]=i=t.$handleEvent(i),t.setActiveReply(1)}}},[t._v("已回复")])],1),0===t.list.length?e("v-uni-view",{staticClass:"tip"},[e("v-uni-image",{attrs:{src:"https://v4test.zjhejiang.com/web/statics/img/app/app_admin/no-comment.png"}}),e("v-uni-view",[t._v("没有任何评论哦~")])],1):t._e(),e("v-uni-view",{staticClass:"content"},t._l(t.list,(function(i,o){return e("v-uni-view",{key:o,staticClass:"item dir-top-nowrap",class:{"is-top-box-bg":1===i.is_top}},[e("v-uni-view",{staticClass:"top dir-left-nowrap"},[e("v-uni-image",{staticClass:"image",attrs:{src:i.cover_pic,"lazy-load":!0}}),e("v-uni-view",{staticClass:"text",class:{"is-top-center-bg":1===i.is_top}},[e("v-uni-view",{staticClass:"name"},[t._v(t._s(i.name))]),e("v-uni-view",{staticClass:"from"},[t._v("来自用户 "+t._s(i.nickname))])],1)],1),e("v-uni-view",{staticClass:"bottom dir-left-nowrap main-between"},[e("v-uni-view",{staticClass:"performed dir-left-nowrap cross-center"},[e("v-uni-image",{staticClass:"icon",attrs:{src:3===i.score?"../image/praise.png":2===i.score?"../image/average.png":"../image/bad-review.png"}}),e("v-uni-view",{staticClass:"evaluation"},[t._v(t._s(3===i.score?"好评":2===i.score?"中评":1===i.score?"差评":""))]),t._e()],1),e("v-uni-view",{staticClass:"button dir-left-nowrap"},[e("v-uni-view",{staticClass:"reply",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.isTop(i,o)}}},[t._v(t._s(1===i.is_top?"取消置顶":"置顶"))]),e("v-uni-view",{staticClass:"show-button",staticStyle:{"margin-left":"16rpx"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.isShow(i)}}},[t._v(t._s(1===i.is_show?"隐藏评论":"取消隐藏"))]),e("app-jump-button",{attrs:{form:!0,url:"/pages/app_admin/comment-detail/comment-detail?id="+i.id}},[e("v-uni-view",{staticClass:"reply"},[t._v(t._s(""===i.reply_content?"回复":"修改回复"))])],1)],1)],1)],1)})),1)],1)],1)},n=[]},"75fc":function(t,i,e){"use strict";e.r(i),e.d(i,"default",(function(){return b}));var o=e("a745"),a=e.n(o),n=e("db2a");function d(t){if(a()(t))return Object(n["a"])(t)}var r=e("67bb"),s=e.n(r),c=e("5d58"),l=e.n(c),u=e("774e"),v=e.n(u);function p(t){if("undefined"!==typeof s.a&&null!=t[l.a]||null!=t["@@iterator"])return v()(t)}var h=e("e630");function f(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}function b(t){return d(t)||p(t)||Object(h["a"])(t)||f()}},9971:function(t,i,e){var o=e("c2013");"string"===typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);var a=e("4f06").default;a("66bb666b",o,!0,{sourceMap:!1,shadowMode:!1})},b56c:function(t,i,e){"use strict";e.r(i);var o=e("4ad7"),a=e("430c");for(var n in a)["default"].indexOf(n)<0&&function(t){e.d(i,t,(function(){return a[t]}))}(n);e("ce19");var d,r=e("f0c5"),s=Object(r["a"])(a["default"],o["b"],o["c"],!1,null,"0dd832c2",null,!1,o["a"],d);i["default"]=s.exports},c2013:function(t,i,e){i=t.exports=e("24fb")(!1),i.push([t.i,".text-center[data-v-0dd832c2]{text-align:center}.font-weight[data-v-0dd832c2]{font-weight:700}.page-width[data-v-0dd832c2]{width:100%}.goods-hover-class[data-v-0dd832c2]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-0dd832c2]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-0dd832c2]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-0dd832c2]{width:100%}.u-hover-class[data-v-0dd832c2]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-0dd832c2]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.comment[data-v-0dd832c2]{background-color:#f7f7f7}.navigator[data-v-0dd832c2]{width:%?750?%;height:%?100?%;background-color:#fff;border-bottom:%?1?% solid #e2e2e2;position:fixed;top:0;left:0;z-index:1000}.navigator>uni-view[data-v-0dd832c2]{width:%?250?%;height:%?100?%;text-align:center}.navigator>uni-view>uni-text[data-v-0dd832c2]{display:inline-block;height:%?100?%;line-height:%?98?%;font-size:%?28?%;border-bottom-style:solid;border-bottom-width:%?2?%;border-bottom-color:rgba(0,0,0,0)}.navigator>uni-view .active-nav[data-v-0dd832c2]{color:#446dfd;border-bottom-color:#446dfd}.replyStatus[data-v-0dd832c2]{margin-top:%?124?%;width:%?750?%;height:%?56?%;background-color:#f7f7f7}.replyStatus[data-v-0dd832c2] :first-child{border-top-left-radius:%?28?%;border-bottom-left-radius:%?28?%}.replyStatus[data-v-0dd832c2] :last-child{border-top-right-radius:%?28?%;border-bottom-right-radius:%?28?%}.replyStatus>uni-view[data-v-0dd832c2]{width:%?160?%;height:%?56?%;line-height:%?56?%;font-size:%?24?%;text-align:center;background-color:#fff;border:%?1?% solid #446dfd}.replyStatus .active-reply[data-v-0dd832c2]{background-color:#446dfd;color:#fff}.tip[data-v-0dd832c2]{position:fixed;top:%?300?%;left:0;right:0;margin:0 auto;color:#666;font-size:%?24?%;width:%?240?%;text-align:center}.tip>uni-image[data-v-0dd832c2]{height:%?240?%;width:%?240?%;margin-bottom:%?20?%}.content[data-v-0dd832c2]{width:%?750?%;padding:%?24?%;-webkit-box-sizing:border-box;box-sizing:border-box}.content .item[data-v-0dd832c2]{background-color:#fff;width:%?702?%;-webkit-box-sizing:border-box;box-sizing:border-box;padding:%?24?%;margin-bottom:%?24?%;border-radius:%?16?%}.content .item .top .image[data-v-0dd832c2]{width:%?144?%;height:%?144?%;border-top-left-radius:%?8?%;border-bottom-left-radius:%?8?%}.content .item .top .text[data-v-0dd832c2]{width:%?510?%;height:%?144?%;padding:%?20?% %?24?% %?20?% %?20?%;-webkit-box-sizing:border-box;box-sizing:border-box;border-top-right-radius:%?8?%;border-bottom-right-radius:%?8?%}.content .item .top .text .name[data-v-0dd832c2]{width:%?466?%;height:%?57?%;line-height:%?28?%;font-size:%?24?%;color:#353535;word-break:break-all;-o-text-overflow:ellipsis;text-overflow:ellipsis;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden}.content .item .top .text .from[data-v-0dd832c2]{width:%?466?%;font-size:%?24?%;color:#999;margin-top:%?24?%}.content .item .bottom[data-v-0dd832c2]{padding-top:%?20?%;-webkit-box-sizing:border-box;box-sizing:border-box;height:%?80?%}.content .item .bottom .performed[data-v-0dd832c2]{margin-top:%?6?%;height:%?48?%}.content .item .bottom .performed .icon[data-v-0dd832c2]{width:%?48?%;height:%?48?%}.content .item .bottom .performed .evaluation[data-v-0dd832c2]{width:%?50?%;color:#353535;font-size:%?22?%;margin-left:%?16?%}.content .item .bottom .performed .show[data-v-0dd832c2]{width:%?88?%;height:%?36?%;line-height:%?36?%;border-radius:%?18?%;background-color:#ff9000;font-size:%?22?%;color:#fff;text-align:center;margin-left:%?16?%}.content .item .bottom .button[data-v-0dd832c2]{height:%?60?%}.content .item .bottom .button .show-button[data-v-0dd832c2],.content .item .bottom .button uni-view.reply[data-v-0dd832c2]{display:inline-block;height:%?60?%;line-height:%?60?%;padding:0 %?20?%;min-width:%?120?%;border-style:solid;border-width:%?1?%;border-radius:%?30?%;font-size:%?28?%;text-align:center;-webkit-flex-shrink:0;-ms-flex-negative:0;flex-shrink:0}.content .item .bottom .button .show-button[data-v-0dd832c2]{border-color:#bbb;color:#353535}.content .item .bottom .button .reply[data-v-0dd832c2]{border-color:#446dfd;color:#446dfd;margin-left:%?16?%}.is-top-box-bg[data-v-0dd832c2]{background:#e5e5e5!important}.is-top-center-bg[data-v-0dd832c2]{background:#dedede!important}body.?%PAGE?%[data-v-0dd832c2]{background:#f7f7f7}",""])},ce19:function(t,i,e){"use strict";var o=e("9971"),a=e.n(o);a.a}}]);