(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-article-article-detail-article-detail"],{"023f":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("4917"),a("7f7f"),a("a481"),a("28a5");var r=/^<([-A-Za-z0-9_]+)((?:\s+[a-zA-Z0-9_:][-a-zA-Z0-9_:.]*(?:\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|[^>\s]+))?)*)\s*(\/?)>/,n=/^<\/([-A-Za-z0-9_]+)[^>]*>/,i=/([a-zA-Z0-9_:][-a-zA-Z0-9_:.]*)(?:\s*=\s*(?:(?:"((?:\\.|[^"])*)")|(?:'((?:\\.|[^'])*)')|([^>\s]+)))?/g;function l(e){for(var t={},a=e.split(","),r=0;r<a.length;r+=1)t[a[r]]=!0;return t}var c=l("area,base,basefont,br,col,frame,hr,img,input,link,meta,param,embed,command,keygen,source,track,wbr"),o=l("address,code,article,applet,aside,audio,blockquote,button,canvas,center,dd,del,dir,div,dl,dt,fieldset,figcaption,figure,footer,form,frameset,h1,h2,h3,h4,h5,h6,header,hgroup,hr,iframe,ins,isindex,li,map,menu,noframes,noscript,object,ol,output,p,pre,section,script,table,tbody,td,tfoot,th,thead,tr,ul,video"),s=l("a,abbr,acronym,applet,b,basefont,bdo,big,br,button,cite,del,dfn,em,font,i,iframe,img,input,ins,kbd,label,map,object,q,s,samp,script,select,small,span,strike,strong,sub,sup,textarea,tt,u,var"),p=l("colgroup,dd,dt,li,options,p,td,tfoot,th,thead,tr"),d=l("checked,compact,declare,defer,disabled,ismap,multiple,nohref,noresize,noshade,nowrap,readonly,selected");function g(e,t){var a,l,g,u=e,f=[];function h(e,a){var r;if(a){for(a=a.toLowerCase(),r=f.length-1;r>=0;r-=1)if(f[r]===a)break}else r=0;if(r>=0){for(var n=f.length-1;n>=r;n-=1)t.end&&t.end(f[n]);f.length=r}}function m(e,a,r,n){if(a=a.toLowerCase(),o[a])while(f.last()&&s[f.last()])h("",f.last());if(p[a]&&f.last()===a&&h("",a),n=c[a]||!!n,n||f.push(a),t.start){var l=[];r.replace(i,(function(e,t){var a=arguments[2]||arguments[3]||arguments[4]||(d[t]?t:"");l.push({name:t,value:a,escaped:a.replace(/(^|[^\\])"/g,'$1\\"')})})),t.start&&t.start(a,l,n)}}f.last=function(){return f[f.length-1]};while(e){if(l=!0,0===e.indexOf("</")?(g=e.match(n),g&&(e=e.substring(g[0].length),g[0].replace(n,h),l=!1)):0===e.indexOf("<")&&(g=e.match(r),g&&(e=e.substring(g[0].length),g[0].replace(r,m),l=!1)),l){a=e.indexOf("<");var b="";while(0===a)b+="<",e=e.substring(1),a=e.indexOf("<");b+=a<0?e:e.substring(0,a),e=a<0?"":e.substring(a),t.chars&&t.chars(b)}if(e===u)throw new Error("Parse Error: ".concat(e));u=e}h()}var u=g;t.default=u},"056f":function(e,t,a){"use strict";var r=a("4ea4");Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r(a("5c35")),i=r(a("8085")),l={name:"wxParse",props:{userSelect:{type:String,default:"text"},imgOptions:{type:[Object,Boolean],default:function(){return{loop:!1,indicator:"number",longPressActions:!1}}},loading:{type:Boolean,default:!1},background:{type:String,default:"#ffffff"},className:{type:String,default:""},content:{type:String,default:""},noData:{type:String,default:""},startHandler:{type:Function,default:function(){return function(e){e.attr.class=null,e.attr.style=null}}},endHandler:{type:Function,default:null},charsHandler:{type:Function,default:null},imageProp:{type:Object,default:function(){return{mode:"aspectFit",padding:0,lazyLoad:!1,domain:"",paddinglimit:48}}}},components:{wxParseTemplate:i.default},data:function(){return{nodes:{},imageUrls:[],wxParseWidth:{value:0}}},mounted:function(){this.setHtml()},methods:{setHtml:function(){var e=this.content,t=this.noData,a=this.imageProp,r=this.startHandler,i=this.endHandler,l=this.charsHandler,c=e||t,o={start:r,end:i,chars:l},s=(0,n.default)(c,o,a,this);this.imageUrls=s.imageUrls,this.nodes=s.nodes},navigate:function(e,t){this.$emit("navigate",e,t)},preview:function(e,t){this.imageUrls.length&&"boolean"!==typeof this.imgOptions&&uni.previewImage({current:e,urls:this.imageUrls,loop:this.imgOptions.loop,indicator:this.imgOptions.indicator,longPressActions:this.imgOptions.longPressActions}),this.$emit("preview",e,t)},removeImageUrl:function(e){var t=this.imageUrls;t.splice(t.indexOf(e),1)}},watch:{content:function(){this.setHtml()}}};t.default=l},"0f3c":function(e,t,a){"use strict";var r=a("96db"),n=a.n(r);n.a},"144d":function(e,t,a){"use strict";a.r(t);var r=a("6f0d"),n=a.n(r);for(var i in r)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return r[e]}))}(i);t["default"]=n.a},"2d0f":function(e,t,a){"use strict";a.r(t);var r=a("f78d"),n=a("144d");for(var i in n)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(i);a("0f3c");var l,c=a("f0c5"),o=Object(c["a"])(n["default"],r["b"],r["c"],!1,null,"51898378",null,!1,r["a"],l);t["default"]=o.exports},"4eae":function(e,t,a){"use strict";a.r(t);var r=a("056f"),n=a.n(r);for(var i in r)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return r[e]}))}(i);t["default"]=n.a},"5b3c":function(e,t,a){"use strict";function r(e){return e=e.replace(/&forall;/g,"∀"),e=e.replace(/&part;/g,"∂"),e=e.replace(/&exist;/g,"∃"),e=e.replace(/&empty;/g,"∅"),e=e.replace(/&nabla;/g,"∇"),e=e.replace(/&isin;/g,"∈"),e=e.replace(/&notin;/g,"∉"),e=e.replace(/&ni;/g,"∋"),e=e.replace(/&prod;/g,"∏"),e=e.replace(/&sum;/g,"∑"),e=e.replace(/&minus;/g,"−"),e=e.replace(/&lowast;/g,"∗"),e=e.replace(/&radic;/g,"√"),e=e.replace(/&prop;/g,"∝"),e=e.replace(/&infin;/g,"∞"),e=e.replace(/&ang;/g,"∠"),e=e.replace(/&and;/g,"∧"),e=e.replace(/&or;/g,"∨"),e=e.replace(/&cap;/g,"∩"),e=e.replace(/&cup;/g,"∪"),e=e.replace(/&int;/g,"∫"),e=e.replace(/&there4;/g,"∴"),e=e.replace(/&sim;/g,"∼"),e=e.replace(/&cong;/g,"≅"),e=e.replace(/&asymp;/g,"≈"),e=e.replace(/&ne;/g,"≠"),e=e.replace(/&le;/g,"≤"),e=e.replace(/&ge;/g,"≥"),e=e.replace(/&sub;/g,"⊂"),e=e.replace(/&sup;/g,"⊃"),e=e.replace(/&nsub;/g,"⊄"),e=e.replace(/&sube;/g,"⊆"),e=e.replace(/&supe;/g,"⊇"),e=e.replace(/&oplus;/g,"⊕"),e=e.replace(/&otimes;/g,"⊗"),e=e.replace(/&perp;/g,"⊥"),e=e.replace(/&sdot;/g,"⋅"),e}function n(e){return e=e.replace(/&Alpha;/g,"Α"),e=e.replace(/&Beta;/g,"Β"),e=e.replace(/&Gamma;/g,"Γ"),e=e.replace(/&Delta;/g,"Δ"),e=e.replace(/&Epsilon;/g,"Ε"),e=e.replace(/&Zeta;/g,"Ζ"),e=e.replace(/&Eta;/g,"Η"),e=e.replace(/&Theta;/g,"Θ"),e=e.replace(/&Iota;/g,"Ι"),e=e.replace(/&Kappa;/g,"Κ"),e=e.replace(/&Lambda;/g,"Λ"),e=e.replace(/&Mu;/g,"Μ"),e=e.replace(/&Nu;/g,"Ν"),e=e.replace(/&Xi;/g,"Ν"),e=e.replace(/&Omicron;/g,"Ο"),e=e.replace(/&Pi;/g,"Π"),e=e.replace(/&Rho;/g,"Ρ"),e=e.replace(/&Sigma;/g,"Σ"),e=e.replace(/&Tau;/g,"Τ"),e=e.replace(/&Upsilon;/g,"Υ"),e=e.replace(/&Phi;/g,"Φ"),e=e.replace(/&Chi;/g,"Χ"),e=e.replace(/&Psi;/g,"Ψ"),e=e.replace(/&Omega;/g,"Ω"),e=e.replace(/&alpha;/g,"α"),e=e.replace(/&beta;/g,"β"),e=e.replace(/&gamma;/g,"γ"),e=e.replace(/&delta;/g,"δ"),e=e.replace(/&epsilon;/g,"ε"),e=e.replace(/&zeta;/g,"ζ"),e=e.replace(/&eta;/g,"η"),e=e.replace(/&theta;/g,"θ"),e=e.replace(/&iota;/g,"ι"),e=e.replace(/&kappa;/g,"κ"),e=e.replace(/&lambda;/g,"λ"),e=e.replace(/&mu;/g,"μ"),e=e.replace(/&nu;/g,"ν"),e=e.replace(/&xi;/g,"ξ"),e=e.replace(/&omicron;/g,"ο"),e=e.replace(/&pi;/g,"π"),e=e.replace(/&rho;/g,"ρ"),e=e.replace(/&sigmaf;/g,"ς"),e=e.replace(/&sigma;/g,"σ"),e=e.replace(/&tau;/g,"τ"),e=e.replace(/&upsilon;/g,"υ"),e=e.replace(/&phi;/g,"φ"),e=e.replace(/&chi;/g,"χ"),e=e.replace(/&psi;/g,"ψ"),e=e.replace(/&omega;/g,"ω"),e=e.replace(/&thetasym;/g,"ϑ"),e=e.replace(/&upsih;/g,"ϒ"),e=e.replace(/&piv;/g,"ϖ"),e=e.replace(/&middot;/g,"·"),e}function i(e){return e=e.replace(/&nbsp;/g," "),e=e.replace(/&ensp;/g," "),e=e.replace(/&emsp;/g,"　"),e=e.replace(/&quot;/g,"'"),e=e.replace(/&amp;/g,"&"),e=e.replace(/&lt;/g,"<"),e=e.replace(/&gt;/g,">"),e=e.replace(/&#8226;/g,"•"),e}function l(e){return e=e.replace(/&OElig;/g,"Œ"),e=e.replace(/&oelig;/g,"œ"),e=e.replace(/&Scaron;/g,"Š"),e=e.replace(/&scaron;/g,"š"),e=e.replace(/&Yuml;/g,"Ÿ"),e=e.replace(/&fnof;/g,"ƒ"),e=e.replace(/&circ;/g,"ˆ"),e=e.replace(/&tilde;/g,"˜"),e=e.replace(/&ensp;/g,""),e=e.replace(/&emsp;/g,""),e=e.replace(/&thinsp;/g,""),e=e.replace(/&zwnj;/g,""),e=e.replace(/&zwj;/g,""),e=e.replace(/&lrm;/g,""),e=e.replace(/&rlm;/g,""),e=e.replace(/&ndash;/g,"–"),e=e.replace(/&mdash;/g,"—"),e=e.replace(/&lsquo;/g,"‘"),e=e.replace(/&rsquo;/g,"’"),e=e.replace(/&sbquo;/g,"‚"),e=e.replace(/&ldquo;/g,"“"),e=e.replace(/&rdquo;/g,"”"),e=e.replace(/&bdquo;/g,"„"),e=e.replace(/&dagger;/g,"†"),e=e.replace(/&Dagger;/g,"‡"),e=e.replace(/&bull;/g,"•"),e=e.replace(/&hellip;/g,"…"),e=e.replace(/&permil;/g,"‰"),e=e.replace(/&prime;/g,"′"),e=e.replace(/&Prime;/g,"″"),e=e.replace(/&lsaquo;/g,"‹"),e=e.replace(/&rsaquo;/g,"›"),e=e.replace(/&oline;/g,"‾"),e=e.replace(/&euro;/g,"€"),e=e.replace(/&trade;/g,"™"),e=e.replace(/&larr;/g,"←"),e=e.replace(/&uarr;/g,"↑"),e=e.replace(/&rarr;/g,"→"),e=e.replace(/&darr;/g,"↓"),e=e.replace(/&harr;/g,"↔"),e=e.replace(/&crarr;/g,"↵"),e=e.replace(/&lceil;/g,"⌈"),e=e.replace(/&rceil;/g,"⌉"),e=e.replace(/&lfloor;/g,"⌊"),e=e.replace(/&rfloor;/g,"⌋"),e=e.replace(/&loz;/g,"◊"),e=e.replace(/&spades;/g,"♠"),e=e.replace(/&clubs;/g,"♣"),e=e.replace(/&hearts;/g,"♥"),e=e.replace(/&diams;/g,"♦"),e=e.replace(/&#39;/g,"'"),e}function c(e){return e=r(e),e=n(e),e=i(e),e=l(e),e}function o(e,t){return/^\/\//.test(e)?"https:".concat(e):/^\//.test(e)?"https://".concat(t).concat(e):Array.isArray(e)?s(e,t):e}function s(e,t){for(var a=0;a<e.length;a++)if(""!==e[a])return/^\/\//.test(e[a])?"https:".concat(e[a]):/^\//.test(e[a])?"https://".concat(t).concat(e[a]):e[a]}Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("a481");var p={strDiscode:c,urlToHttpUrl:o};t.default=p},"5c35":function(e,t,a){"use strict";var r=a("4ea4");Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0,a("456d"),a("ac6a"),a("4917"),a("7f7f"),a("a481"),a("3b2b"),a("28a5");var n=r(a("5b3c")),i=r(a("023f"));function l(e){for(var t={},a=e.split(","),r=0;r<a.length;r+=1)t[a[r]]=!0;return t}var c=l("br,code,address,article,applet,aside,audio,blockquote,button,canvas,center,dd,del,dir,div,dl,dt,fieldset,figcaption,figure,footer,form,frameset,h1,h2,h3,h4,h5,h6,header,hgroup,hr,iframe,ins,isindex,li,map,menu,noframes,noscript,object,ol,output,p,pre,section,script,table,tbody,td,tfoot,th,thead,tr,ul,video"),o=l("a,abbr,acronym,applet,b,basefont,bdo,big,button,cite,del,dfn,em,font,i,iframe,img,input,ins,kbd,label,map,object,q,s,samp,script,select,small,span,strike,strong,sub,sup,textarea,tt,u,var"),s=l("colgroup,dd,dt,li,options,p,td,tfoot,th,thead,tr");function p(e){return/<body.*>([^]*)<\/body>/.test(e)?RegExp.$1:e}function d(e){return e.replace(/<!--.*?-->/gi,"").replace(/\/\*.*?\*\//gi,"").replace(/[ ]+</gi,"<").replace(/<script[^]*<\/script>/gi,"").replace(/<style[^]*<\/style>/gi,"")}function g(){var e={};return wx.getSystemInfo({success:function(t){e.width=t.windowWidth,e.height=t.windowHeight}}),e}function u(e,t,a,r){e=p(e),e=d(e),e=n.default.strDiscode(e);var l=[],u={nodes:[],imageUrls:[]},f=g();function h(e){this.node="element",this.tag=e,this.$screen=f}return(0,i.default)(e,{start:function(e,r,i){var p=new h(e);if(0!==l.length){var d=l[0];void 0===d.nodes&&(d.nodes=[])}if(c[e]?p.tagType="block":o[e]?p.tagType="inline":s[e]&&(p.tagType="closeSelf"),p.attr=r.reduce((function(e,t){var a=t.name,r=t.value;return"class"===a&&(p.classStr=r),"style"===a&&(p.styleStr=r),r.match(/ /)&&(r=r.split(" ")),e[a]?Array.isArray(e[a])?e[a].push(r):e[a]=[e[a],r]:e[a]=r,e}),{}),p.classStr?p.classStr+=" ".concat(p.tag):p.classStr=p.tag,"inline"===p.tagType&&(p.classStr+=" inline"),"img"===p.tag){var g=p.attr.src;g=n.default.urlToHttpUrl(g,a.domain),Object.assign(p.attr,a,{src:g||""}),g&&u.imageUrls.push(g)}if("a"===p.tag&&(p.attr.href=p.attr.href||""),"font"===p.tag){var f=["x-small","small","medium","large","x-large","xx-large","-webkit-xxx-large"],m={color:"color",face:"font-family",size:"font-size"};p.styleStr||(p.styleStr=""),Object.keys(m).forEach((function(e){if(p.attr[e]){var t="size"===e?f[p.attr[e]-1]:p.attr[e];p.styleStr+="".concat(m[e],": ").concat(t,";")}}))}if("source"===p.tag&&(u.source=p.attr.src),t.start&&t.start(p,u),i){var b=l[0]||u;void 0===b.nodes&&(b.nodes=[]),b.nodes.push(p)}else l.unshift(p)},end:function(e){var a=l.shift();if(a.tag!==e&&console.error("invalid state: mismatch end tag"),"video"===a.tag&&u.source&&(a.attr.src=u.source,delete u.source),t.end&&t.end(a,u),0===l.length)u.nodes.push(a);else{var r=l[0];r.nodes||(r.nodes=[]),r.nodes.push(a)}},chars:function(e){if(e.trim()){var a={node:"text",text:e};if(t.chars&&t.chars(a,u),0===l.length)u.nodes.push(a);else{var r=l[0];void 0===r.nodes&&(r.nodes=[]),r.nodes.push(a)}}}}),u}var f=u;t.default=f},"6f0d":function(e,t,a){"use strict";var r=a("4ea4");Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=r(a("cb0e")),i=(a("2f62"),{data:function(){return{imageProp:{mode:"aspectFit",padding:0,lazyLoad:!1,domain:"",paddinglimit:""},page:2,loading:!0,list:{content:" "}}},components:{appRichText:n.default},methods:{getList:function(){var e=this;this.$request({url:e.$api.article.detail,data:{article_id:e.id}}).then((function(t){e.$hideLoading(),0==t.code&&(e.loading=!1,e.list=t.data.article,setTimeout((function(){uni.setNavigationBarTitle({title:e.list.title})}),0))})).catch((function(t){e.$hideLoading()}))}},onLoad:function(e){this.$commonLoad.onload(e),this.$showLoading({type:"global",text:"加载中..."}),this.id=e.id,this.getList(),this.$store.dispatch("gConfig/setImageWidth",48),this.shareTimelineData={title:this.list.title,query:{id:this.id}}}});t.default=i},"96db":function(e,t,a){var r=a("f805");"string"===typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);var n=a("4f06").default;n("350ff8de",r,!0,{sourceMap:!1,shadowMode:!1})},"9f0f":function(e,t,a){"use strict";var r;a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return i})),a.d(t,"a",(function(){return r}));var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-uni-view",{staticClass:"wxParse",class:e.className,style:"user-select:"+e.userSelect+";background-color: "+e.background},[e.loading?e._e():[e._l(e.nodes,(function(t,r){return[a("wxParseTemplate",{key:r+"_0",attrs:{node:t,"parent-node":e.nodes}})]}))]],2)},i=[]},cb0e:function(e,t,a){"use strict";a.r(t);var r=a("9f0f"),n=a("4eae");for(var i in n)["default"].indexOf(i)<0&&function(e){a.d(t,e,(function(){return n[e]}))}(i);var l,c=a("f0c5"),o=Object(c["a"])(n["default"],r["b"],r["c"],!1,null,null,null,!1,r["a"],l);t["default"]=o.exports},f78d:function(e,t,a){"use strict";var r;a.d(t,"b",(function(){return n})),a.d(t,"c",(function(){return i})),a.d(t,"a",(function(){return r}));var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("app-layout",[a("v-uni-view",{staticClass:"page"},[a("app-rich-text",{attrs:{"image-prop":e.imageProp,background:"#ffffff",loading:e.loading,content:e.list.content}})],1)],1)},i=[]},f805:function(e,t,a){t=e.exports=a("24fb")(!1),t.push([e.i,".text-center[data-v-51898378]{text-align:center}.font-weight[data-v-51898378]{font-weight:700}.page-width[data-v-51898378]{width:100%}.goods-hover-class[data-v-51898378]{opacity:.9;background-color:#f7f7f7}.background-image[data-v-51898378]{background-repeat:no-repeat;background-size:100% 100%;background-position:50%}uni-page-body[data-v-51898378]{font-size:%?32?%;background:#f7f7f7}.page-width[data-v-51898378]{width:100%}.u-hover-class[data-v-51898378]{opacity:.9;background-color:#f7f7f7}.safe-area-inset-bottom[data-v-51898378]{padding-bottom:0;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.page[data-v-51898378]{padding:0 %?24?%;position:absolute;top:0;left:0;min-height:100%;width:100%;background-color:#fff}body.?%PAGE?%[data-v-51898378]{background:#f7f7f7}",""])}}]);