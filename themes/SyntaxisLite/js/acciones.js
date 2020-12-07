/** 
 * https://locutus.io/php/strpos/ 
 * https://locutus.io/php/htmlspecialchars_decode/ 
 * https://locutus.io/php/number_format/ 
 * https://locutus.io/php/empty/ 
*/
function strpos(e,r,t){var n=(e+"").indexOf(r,t||0);return-1!==n&&n}function htmlspecialchars_decode(e,r){var t=0,n=0,i=!1;void 0===r&&(r=2),e=e.toString().replace(/&lt;/g,"<").replace(/&gt;/g,">");var o={ENT_NOQUOTES:0,ENT_HTML_QUOTE_SINGLE:1,ENT_HTML_QUOTE_DOUBLE:2,ENT_COMPAT:2,ENT_QUOTES:3,ENT_IGNORE:4};if(0===r&&(i=!0),"number"!=typeof r){for(r=[].concat(r),n=0;n<r.length;n++)0===o[r[n]]?i=!0:o[r[n]]&&(t|=o[r[n]]);r=t}return r&o.ENT_HTML_QUOTE_SINGLE&&(e=e.replace(/&#0*39;/g,"'")),i||(e=e.replace(/&quot;/g,'"')),e.replace(/&amp;/g,"&")}function number_format(e,r,t,n){e=(e+"").replace(/[^0-9+\-Ee.]/g,"");var i=isFinite(+e)?+e:0,o=isFinite(+r)?Math.abs(r):0,a=void 0===n?",":n,u=void 0===t?".":t,l="";return(l=(o?function(e,r){if(-1===(""+e).indexOf("e"))return+(Math.round(e+"e+"+r)+"e-"+r);var t=(""+e).split("e"),n="";return+t[1]+r>0&&(n="+"),(+(Math.round(+t[0]+"e"+n+(+t[1]+r))+"e-"+r)).toFixed(r)}(i,o).toString():""+Math.round(i)).split("."))[0].length>3&&(l[0]=l[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,a)),(l[1]||"").length<o&&(l[1]=l[1]||"",l[1]+=new Array(o-l[1].length+1).join("0")),l.join(u)}function empty(e){var r,t,n,i=[void 0,null,!1,0,"","0"];for(t=0,n=i.length;t<n;t++)if(e===i[t])return!0;if("object"==typeof e){for(r in e)if(e.hasOwnProperty(r))return!1;return!0}return!1}

/*! Lazy Load 2.0.0-rc.2 - MIT license - Copyright 2007-2019 Mika Tuupola */
!function(t,e){"object"==typeof exports?module.exports=e(t):"function"==typeof define&&define.amd?define([],e):t.LazyLoad=e(t)}("undefined"!=typeof global?global:this.window||this.global,function(t){"use strict";function e(t,e){this.settings=s(r,e||{}),this.images=t||document.querySelectorAll(this.settings.selector),this.observer=null,this.init()}"function"==typeof define&&define.amd&&(t=window);const r={src:"data-src",srcset:"data-srcset",selector:".lazyload",root:null,rootMargin:"0px",threshold:0},s=function(){let t={},e=!1,r=0,o=arguments.length;"[object Boolean]"===Object.prototype.toString.call(arguments[0])&&(e=arguments[0],r++);for(;r<o;r++)!function(r){for(let o in r)Object.prototype.hasOwnProperty.call(r,o)&&(e&&"[object Object]"===Object.prototype.toString.call(r[o])?t[o]=s(!0,t[o],r[o]):t[o]=r[o])}(arguments[r]);return t};if(e.prototype={init:function(){if(!t.IntersectionObserver)return void this.loadImages();let e=this,r={root:this.settings.root,rootMargin:this.settings.rootMargin,threshold:[this.settings.threshold]};this.observer=new IntersectionObserver(function(t){Array.prototype.forEach.call(t,function(t){if(t.isIntersecting){e.observer.unobserve(t.target);let r=t.target.getAttribute(e.settings.src),s=t.target.getAttribute(e.settings.srcset);"img"===t.target.tagName.toLowerCase()?(r&&(t.target.src=r),s&&(t.target.srcset=s)):t.target.style.backgroundImage="url("+r+")"}})},r),Array.prototype.forEach.call(this.images,function(t){e.observer.observe(t)})},loadAndDestroy:function(){this.settings&&(this.loadImages(),this.destroy())},loadImages:function(){if(!this.settings)return;let t=this;Array.prototype.forEach.call(this.images,function(e){let r=e.getAttribute(t.settings.src),s=e.getAttribute(t.settings.srcset);"img"===e.tagName.toLowerCase()?(r&&(e.src=r),s&&(e.srcset=s)):e.style.backgroundImage="url('"+r+"')"})},destroy:function(){this.settings&&(this.observer.disconnect(),this.settings=null)}},t.lazyload=function(t,r){return new e(t,r)},t.jQuery){const r=t.jQuery;r.fn.lazyload=function(t){return t=t||{},t.attribute=t.attribute||"data-src",new e(r.makeArray(this),t),this}}return e});

/* Tipsy */
!function(t,e,i){function s(t,e){return"function"==typeof t?t.call(e):t}function o(t){for(;t=t.parentNode;)if(t==document)return!0;return!1}function n(t){return"object"==typeof HTMLElement?t instanceof HTMLElement:t&&"object"==typeof t&&1===t.nodeType&&"string"==typeof t.nodeName}function l(){return"tipsyuid"+h++}function a(e,i){this.$element=t(e),this.options=i,this.enabled=!0,this.fixTitle()}var h=0;a.prototype={show:function(){if(o(this.$element[0])&&(!n(this.$element)||this.$element.is(":visible"))){var e;if(this.enabled&&(e=this.getTitle())){var i=this.tip();i.find(".tipsy-inner"+this.options.theme)[this.options.html?"html":"text"](e),i[0].className="tipsy"+this.options.theme,this.options.className&&i.addClass(s(this.options.className,this.$element[0])),i.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).prependTo(document.body);var a=t.extend({},this.$element.offset());a=this.$element.parents("svg").length>0?t.extend(a,this.$element[0].getBBox()):t.extend(a,{width:this.$element[0].offsetWidth||0,height:this.$element[0].offsetHeight||0});var h,f=i[0].offsetWidth,r=i[0].offsetHeight,p=s(this.options.gravity,this.$element[0]);switch(p.charAt(0)){case"n":h={top:a.top+a.height+this.options.offset,left:a.left+a.width/2-f/2};break;case"s":h={top:a.top-r-this.options.offset,left:a.left+a.width/2-f/2};break;case"e":h={top:a.top+a.height/2-r/2,left:a.left-f-this.options.offset};break;case"w":h={top:a.top+a.height/2-r/2,left:a.left+a.width+this.options.offset}}if(2==p.length&&("w"==p.charAt(1)?h.left=a.left+a.width/2-15:h.left=a.left+a.width/2-f+15),i.css(h).addClass("tipsy-"+p+this.options.theme),i.find(".tipsy-arrow"+this.options.theme)[0].className="tipsy-arrow"+this.options.theme+" tipsy-arrow-"+p.charAt(0)+this.options.theme,this.options.fade?(this.options.shadow&&t(".tipsy-inner").css({"box-shadow":"0px 0px "+this.options.shadowBlur+"px "+this.options.shadowSpread+"px rgba(0, 0, 0, "+this.options.shadowOpacity+")","-webkit-box-shadow":"0px 0px "+this.options.shadowBlur+"px "+this.options.shadowSpread+"px rgba(0, 0, 0, "+this.options.shadowOpacity+")"}),i.stop().css({opacity:0,display:"block",visibility:"visible"}).animate({opacity:this.options.opacity},this.options.fadeInTime)):i.css({visibility:"visible",opacity:this.options.opacity}),this.options.aria){var d=l();i.attr("id",d),this.$element.attr("aria-describedby",d)}}}},hide:function(){this.options.fade?this.tip().stop().fadeOut(this.options.fadeOutTime,function(){t(this).remove()}):this.tip().remove(),this.options.aria&&this.$element.removeAttr("aria-describedby")},fixTitle:function(){var t=this.$element,e=s(this.options.id,this.$element[0]);(t.prop("title")||"string"!=typeof t.prop("original-title"))&&(t.prop("original-title",t.prop("title")||"").removeAttr("title"),t.attr("aria-describedby",e),t.attr("tabindex")===i&&t.attr("tabindex",0))},getTitle:function(){var t,e=this.$element,i=this.options;return this.fixTitle(),"string"==typeof i.title?t=e.prop("title"==i.title?"original-title":i.title):"function"==typeof i.title&&(t=i.title.call(e[0])),t=(""+t).replace(/(^\s*|\s*$)/,""),t||i.fallback},tip:function(){var e=s(this.options.id,this.$element[0]);return this.$tip||(this.$tip=t('<div class="tipsy'+this.options.theme+'" id="'+e+'" role="tooltip"></div>').html('<div class="tipsy-arrow'+this.options.theme+'"></div><div class="tipsy-inner'+this.options.theme+'"></div>').attr("role","tooltip"),this.$tip.data("tipsy-pointee",this.$element[0])),this.$tip},validate:function(){this.$element[0].parentNode||(this.hide(),this.$element=null,this.options=null)},enable:function(){this.enabled=!0},disable:function(){this.enabled=!1},toggleEnabled:function(){this.enabled=!this.enabled}},t.fn.tipsy=function(e){function i(i){var s=t.data(i,"tipsy");return s||(s=new a(i,t.fn.tipsy.elementOptions(i,e)),t.data(i,"tipsy",s)),s}function s(){if(t.fn.tipsy.enabled===!0){var s=i(this);s.hoverState="in",0===e.delayIn?s.show():(s.fixTitle(),setTimeout(function(){"in"==s.hoverState&&o(s.$element)&&s.show()},e.delayIn))}}function n(){var t=i(this);t.hoverState="out",0===e.delayOut?t.hide():setTimeout(function(){"out"!=t.hoverState&&t.$element&&t.$element.is(":visible")||t.hide()},e.delayOut)}if(t.fn.tipsy.enable(),e===!0)return this.data("tipsy");if("string"==typeof e){var l=this.data("tipsy");return l&&l[e](),this}if(e=t.extend({},t.fn.tipsy.defaults,e),e.theme=e.theme&&""!==e.theme?"-"+e.theme:"",e.on||this.each(function(){i(this)}),"manual"!=e.trigger)if(e.on&&e.on!==!0)"focus"!=e.trigger&&(t(this).on("mouseenter",e.on,s),t(this).on("mouseleave",e.on,n)),"blur"!=e.trigger&&(t(this).on("focus",e.on,s),t(this).on("blur",e.on,n));else{if(e.on&&!t.on)throw"Since jQuery 1.9, pass selector as live argument. eg. $(document).tipsy({live: 'a.live'});";var h=e.on?"live":"bind";"focus"!=e.trigger&&this[h]("mouseenter",s)[h]("mouseleave",n),"blur"!=e.trigger&&this[h]("focus",s)[h]("blur",n)}return this},t.fn.tipsy.defaults={aria:!1,className:null,id:"tipsy",delayIn:0,delayOut:0,fade:!1,fadeInTime:400,fadeOutTime:400,shadow:!1,shadowBlur:8,shadowOpacity:1,shadowSpread:0,fallback:"",gravity:"n",html:!1,live:!1,offset:0,opacity:.8,title:"title",trigger:"interactive",theme:""},t.fn.tipsy.revalidate=function(){t(".tipsy").each(function(){var e=t.data(this,"tipsy-pointee");e&&o(e)||t(this).remove()})},t.fn.tipsy.enable=function(){t.fn.tipsy.enabled=!0},t.fn.tipsy.disable=function(){t.fn.tipsy.enabled=!1},t.fn.tipsy.elementOptions=function(e,i){return t.metadata?t.extend({},i,t(e).metadata()):i},t.fn.tipsy.autoNS=function(){return t(this).offset().top>t(document).scrollTop()+t(e).height()/2?"s":"n"},t.fn.tipsy.autoWE=function(){return t(this).offset().left>t(document).scrollLeft()+t(e).width()/2?"e":"w"},t.fn.tipsy.autoNWNE=function(){return t(this).offset().left>t(document).scrollLeft()+t(e).width()/2?"ne":"nw"},t.fn.tipsy.autoSWSE=function(){return t(this).offset().left>t(document).scrollLeft()+t(e).width()/2?"se":"sw"},t.fn.tipsy.autoBounds=function(i,s,o){return function(){var n={ns:o[0],ew:o.length>1?o[1]:!1},l=t(document).scrollTop()+i,a=t(document).scrollLeft()+s,h=t(this);return h.offset().top<l&&(n.ns="n"),h.offset().left<a&&(n.ew="w"),t(e).width()+t(document).scrollLeft()-h.offset().left<s&&(n.ew="e"),t(e).height()+t(document).scrollTop()-h.offset().top<i&&(n.ns="s"),n.ns+(n.ew?n.ew:"")}},t.fn.tipsy.autoBounds2=function(i,s){return function(){var o={},n=t(document).scrollTop()+i,l=t(document).scrollLeft()+i,a=t(this);return s.length>1?(o.ns=s[0],o.ew=s[1]):"e"==s[0]||"w"==s[0]?o.ew=s[0]:o.ns=s[0],a.offset().top<n&&(o.ns="n"),a.offset().left<l&&(o.ew="w"),t(e).width()+t(document).scrollLeft()-(a.offset().left+a.width())<i&&(o.ew="e"),t(e).height()+t(document).scrollTop()-(a.offset().top+a.height())<i&&(o.ns="s"),o.ns?o.ns+(o.ew?o.ew:""):o.ew}}}(jQuery,window);

/*! pace 1.0.2 */
(function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X=[].slice,Y={}.hasOwnProperty,Z=function(a,b){function c(){this.constructor=a}for(var d in b)Y.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},$=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};for(u={catchupTime:100,initialRate:.03,minTime:250,ghostTime:100,maxProgressPerFrame:20,easeFactor:1.25,startOnPageLoad:!0,restartOnPushState:!0,restartOnRequestAfter:500,target:"body",elements:{checkInterval:100,selectors:["body"]},eventLag:{minSamples:10,sampleCount:3,lagThreshold:3},ajax:{trackMethods:["GET"],trackWebSockets:!0,ignoreURLs:[]}},C=function(){var a;return null!=(a="undefined"!=typeof performance&&null!==performance&&"function"==typeof performance.now?performance.now():void 0)?a:+new Date},E=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame,t=window.cancelAnimationFrame||window.mozCancelAnimationFrame,null==E&&(E=function(a){return setTimeout(a,50)},t=function(a){return clearTimeout(a)}),G=function(a){var b,c;return b=C(),(c=function(){var d;return d=C()-b,d>=33?(b=C(),a(d,function(){return E(c)})):setTimeout(c,33-d)})()},F=function(){var a,b,c;return c=arguments[0],b=arguments[1],a=3<=arguments.length?X.call(arguments,2):[],"function"==typeof c[b]?c[b].apply(c,a):c[b]},v=function(){var a,b,c,d,e,f,g;for(b=arguments[0],d=2<=arguments.length?X.call(arguments,1):[],f=0,g=d.length;g>f;f++)if(c=d[f])for(a in c)Y.call(c,a)&&(e=c[a],null!=b[a]&&"object"==typeof b[a]&&null!=e&&"object"==typeof e?v(b[a],e):b[a]=e);return b},q=function(a){var b,c,d,e,f;for(c=b=0,e=0,f=a.length;f>e;e++)d=a[e],c+=Math.abs(d),b++;return c/b},x=function(a,b){var c,d,e;if(null==a&&(a="options"),null==b&&(b=!0),e=document.querySelector("[data-pace-"+a+"]")){if(c=e.getAttribute("data-pace-"+a),!b)return c;try{return JSON.parse(c)}catch(f){return d=f,"undefined"!=typeof console&&null!==console?console.error("Error parsing inline pace options",d):void 0}}},g=function(){function a(){}return a.prototype.on=function(a,b,c,d){var e;return null==d&&(d=!1),null==this.bindings&&(this.bindings={}),null==(e=this.bindings)[a]&&(e[a]=[]),this.bindings[a].push({handler:b,ctx:c,once:d})},a.prototype.once=function(a,b,c){return this.on(a,b,c,!0)},a.prototype.off=function(a,b){var c,d,e;if(null!=(null!=(d=this.bindings)?d[a]:void 0)){if(null==b)return delete this.bindings[a];for(c=0,e=[];c<this.bindings[a].length;)e.push(this.bindings[a][c].handler===b?this.bindings[a].splice(c,1):c++);return e}},a.prototype.trigger=function(){var a,b,c,d,e,f,g,h,i;if(c=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],null!=(g=this.bindings)?g[c]:void 0){for(e=0,i=[];e<this.bindings[c].length;)h=this.bindings[c][e],d=h.handler,b=h.ctx,f=h.once,d.apply(null!=b?b:this,a),i.push(f?this.bindings[c].splice(e,1):e++);return i}},a}(),j=window.Pace||{},window.Pace=j,v(j,g.prototype),D=j.options=v({},u,window.paceOptions,x()),U=["ajax","document","eventLag","elements"],Q=0,S=U.length;S>Q;Q++)K=U[Q],D[K]===!0&&(D[K]=u[K]);i=function(a){function b(){return V=b.__super__.constructor.apply(this,arguments)}return Z(b,a),b}(Error),b=function(){function a(){this.progress=0}return a.prototype.getElement=function(){var a;if(null==this.el){if(a=document.querySelector(D.target),!a)throw new i;this.el=document.createElement("div"),this.el.className="pace pace-active",document.body.className=document.body.className.replace(/pace-done/g,""),document.body.className+=" pace-running",this.el.innerHTML='<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>',null!=a.firstChild?a.insertBefore(this.el,a.firstChild):a.appendChild(this.el)}return this.el},a.prototype.finish=function(){var a;return a=this.getElement(),a.className=a.className.replace("pace-active",""),a.className+=" pace-inactive",document.body.className=document.body.className.replace("pace-running",""),document.body.className+=" pace-done"},a.prototype.update=function(a){return this.progress=a,this.render()},a.prototype.destroy=function(){try{this.getElement().parentNode.removeChild(this.getElement())}catch(a){i=a}return this.el=void 0},a.prototype.render=function(){var a,b,c,d,e,f,g;if(null==document.querySelector(D.target))return!1;for(a=this.getElement(),d="translate3d("+this.progress+"%, 0, 0)",g=["webkitTransform","msTransform","transform"],e=0,f=g.length;f>e;e++)b=g[e],a.children[0].style[b]=d;return(!this.lastRenderedProgress||this.lastRenderedProgress|0!==this.progress|0)&&(a.children[0].setAttribute("data-progress-text",""+(0|this.progress)+"%"),this.progress>=100?c="99":(c=this.progress<10?"0":"",c+=0|this.progress),a.children[0].setAttribute("data-progress",""+c)),this.lastRenderedProgress=this.progress},a.prototype.done=function(){return this.progress>=100},a}(),h=function(){function a(){this.bindings={}}return a.prototype.trigger=function(a,b){var c,d,e,f,g;if(null!=this.bindings[a]){for(f=this.bindings[a],g=[],d=0,e=f.length;e>d;d++)c=f[d],g.push(c.call(this,b));return g}},a.prototype.on=function(a,b){var c;return null==(c=this.bindings)[a]&&(c[a]=[]),this.bindings[a].push(b)},a}(),P=window.XMLHttpRequest,O=window.XDomainRequest,N=window.WebSocket,w=function(a,b){var c,d,e;e=[];for(d in b.prototype)try{e.push(null==a[d]&&"function"!=typeof b[d]?"function"==typeof Object.defineProperty?Object.defineProperty(a,d,{get:function(){return b.prototype[d]},configurable:!0,enumerable:!0}):a[d]=b.prototype[d]:void 0)}catch(f){c=f}return e},A=[],j.ignore=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],A.unshift("ignore"),c=b.apply(null,a),A.shift(),c},j.track=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],A.unshift("track"),c=b.apply(null,a),A.shift(),c},J=function(a){var b;if(null==a&&(a="GET"),"track"===A[0])return"force";if(!A.length&&D.ajax){if("socket"===a&&D.ajax.trackWebSockets)return!0;if(b=a.toUpperCase(),$.call(D.ajax.trackMethods,b)>=0)return!0}return!1},k=function(a){function b(){var a,c=this;b.__super__.constructor.apply(this,arguments),a=function(a){var b;return b=a.open,a.open=function(d,e){return J(d)&&c.trigger("request",{type:d,url:e,request:a}),b.apply(a,arguments)}},window.XMLHttpRequest=function(b){var c;return c=new P(b),a(c),c};try{w(window.XMLHttpRequest,P)}catch(d){}if(null!=O){window.XDomainRequest=function(){var b;return b=new O,a(b),b};try{w(window.XDomainRequest,O)}catch(d){}}if(null!=N&&D.ajax.trackWebSockets){window.WebSocket=function(a,b){var d;return d=null!=b?new N(a,b):new N(a),J("socket")&&c.trigger("request",{type:"socket",url:a,protocols:b,request:d}),d};try{w(window.WebSocket,N)}catch(d){}}}return Z(b,a),b}(h),R=null,y=function(){return null==R&&(R=new k),R},I=function(a){var b,c,d,e;for(e=D.ajax.ignoreURLs,c=0,d=e.length;d>c;c++)if(b=e[c],"string"==typeof b){if(-1!==a.indexOf(b))return!0}else if(b.test(a))return!0;return!1},y().on("request",function(b){var c,d,e,f,g;return f=b.type,e=b.request,g=b.url,I(g)?void 0:j.running||D.restartOnRequestAfter===!1&&"force"!==J(f)?void 0:(d=arguments,c=D.restartOnRequestAfter||0,"boolean"==typeof c&&(c=0),setTimeout(function(){var b,c,g,h,i,k;if(b="socket"===f?e.readyState<2:0<(h=e.readyState)&&4>h){for(j.restart(),i=j.sources,k=[],c=0,g=i.length;g>c;c++){if(K=i[c],K instanceof a){K.watch.apply(K,d);break}k.push(void 0)}return k}},c))}),a=function(){function a(){var a=this;this.elements=[],y().on("request",function(){return a.watch.apply(a,arguments)})}return a.prototype.watch=function(a){var b,c,d,e;return d=a.type,b=a.request,e=a.url,I(e)?void 0:(c="socket"===d?new n(b):new o(b),this.elements.push(c))},a}(),o=function(){function a(a){var b,c,d,e,f,g,h=this;if(this.progress=0,null!=window.ProgressEvent)for(c=null,a.addEventListener("progress",function(a){return h.progress=a.lengthComputable?100*a.loaded/a.total:h.progress+(100-h.progress)/2},!1),g=["load","abort","timeout","error"],d=0,e=g.length;e>d;d++)b=g[d],a.addEventListener(b,function(){return h.progress=100},!1);else f=a.onreadystatechange,a.onreadystatechange=function(){var b;return 0===(b=a.readyState)||4===b?h.progress=100:3===a.readyState&&(h.progress=50),"function"==typeof f?f.apply(null,arguments):void 0}}return a}(),n=function(){function a(a){var b,c,d,e,f=this;for(this.progress=0,e=["error","open"],c=0,d=e.length;d>c;c++)b=e[c],a.addEventListener(b,function(){return f.progress=100},!1)}return a}(),d=function(){function a(a){var b,c,d,f;for(null==a&&(a={}),this.elements=[],null==a.selectors&&(a.selectors=[]),f=a.selectors,c=0,d=f.length;d>c;c++)b=f[c],this.elements.push(new e(b))}return a}(),e=function(){function a(a){this.selector=a,this.progress=0,this.check()}return a.prototype.check=function(){var a=this;return document.querySelector(this.selector)?this.done():setTimeout(function(){return a.check()},D.elements.checkInterval)},a.prototype.done=function(){return this.progress=100},a}(),c=function(){function a(){var a,b,c=this;this.progress=null!=(b=this.states[document.readyState])?b:100,a=document.onreadystatechange,document.onreadystatechange=function(){return null!=c.states[document.readyState]&&(c.progress=c.states[document.readyState]),"function"==typeof a?a.apply(null,arguments):void 0}}return a.prototype.states={loading:0,interactive:50,complete:100},a}(),f=function(){function a(){var a,b,c,d,e,f=this;this.progress=0,a=0,e=[],d=0,c=C(),b=setInterval(function(){var g;return g=C()-c-50,c=C(),e.push(g),e.length>D.eventLag.sampleCount&&e.shift(),a=q(e),++d>=D.eventLag.minSamples&&a<D.eventLag.lagThreshold?(f.progress=100,clearInterval(b)):f.progress=100*(3/(a+3))},50)}return a}(),m=function(){function a(a){this.source=a,this.last=this.sinceLastUpdate=0,this.rate=D.initialRate,this.catchup=0,this.progress=this.lastProgress=0,null!=this.source&&(this.progress=F(this.source,"progress"))}return a.prototype.tick=function(a,b){var c;return null==b&&(b=F(this.source,"progress")),b>=100&&(this.done=!0),b===this.last?this.sinceLastUpdate+=a:(this.sinceLastUpdate&&(this.rate=(b-this.last)/this.sinceLastUpdate),this.catchup=(b-this.progress)/D.catchupTime,this.sinceLastUpdate=0,this.last=b),b>this.progress&&(this.progress+=this.catchup*a),c=1-Math.pow(this.progress/100,D.easeFactor),this.progress+=c*this.rate*a,this.progress=Math.min(this.lastProgress+D.maxProgressPerFrame,this.progress),this.progress=Math.max(0,this.progress),this.progress=Math.min(100,this.progress),this.lastProgress=this.progress,this.progress},a}(),L=null,H=null,r=null,M=null,p=null,s=null,j.running=!1,z=function(){return D.restartOnPushState?j.restart():void 0},null!=window.history.pushState&&(T=window.history.pushState,window.history.pushState=function(){return z(),T.apply(window.history,arguments)}),null!=window.history.replaceState&&(W=window.history.replaceState,window.history.replaceState=function(){return z(),W.apply(window.history,arguments)}),l={ajax:a,elements:d,document:c,eventLag:f},(B=function(){var a,c,d,e,f,g,h,i;for(j.sources=L=[],g=["ajax","elements","document","eventLag"],c=0,e=g.length;e>c;c++)a=g[c],D[a]!==!1&&L.push(new l[a](D[a]));for(i=null!=(h=D.extraSources)?h:[],d=0,f=i.length;f>d;d++)K=i[d],L.push(new K(D));return j.bar=r=new b,H=[],M=new m})(),j.stop=function(){return j.trigger("stop"),j.running=!1,r.destroy(),s=!0,null!=p&&("function"==typeof t&&t(p),p=null),B()},j.restart=function(){return j.trigger("restart"),j.stop(),j.start()},j.go=function(){var a;return j.running=!0,r.render(),a=C(),s=!1,p=G(function(b,c){var d,e,f,g,h,i,k,l,n,o,p,q,t,u,v,w;for(l=100-r.progress,e=p=0,f=!0,i=q=0,u=L.length;u>q;i=++q)for(K=L[i],o=null!=H[i]?H[i]:H[i]=[],h=null!=(w=K.elements)?w:[K],k=t=0,v=h.length;v>t;k=++t)g=h[k],n=null!=o[k]?o[k]:o[k]=new m(g),f&=n.done,n.done||(e++,p+=n.tick(b));return d=p/e,r.update(M.tick(b,d)),r.done()||f||s?(r.update(100),j.trigger("done"),setTimeout(function(){return r.finish(),j.running=!1,j.trigger("hide")},Math.max(D.ghostTime,Math.max(D.minTime-(C()-a),0)))):c()})},j.start=function(a){v(D,a),j.running=!0;try{r.render()}catch(b){i=b}return document.querySelector(".pace")?(j.trigger("start"),j.go()):setTimeout(j.start,50)},"function"==typeof define&&define.amd?define(["pace"],function(){return j}):"object"==typeof exports?module.exports=j:D.startOnPageLoad&&j.start()}).call(this);

/* Box login */
function open_login_box(action) {
   if ($('.backLogin').css('display') == 'block' && action != 'open') close_login_box();
   else {
      $('#login_error').css('display', 'none');
      $('#login_cargando').css('display', 'none');
      $('.opciones_usuario').addClass('here');
      $('.backLogin').fadeIn('fast');
      $('#nickname').focus();
   }
}
function close_login_box() {
   $('.opciones_usuario').removeClass('here');
   $('.backLogin').slideUp('fast');
}

function ir_a_categoria(cat) {
   if (cat != 'root' && cat != 'linea')
      if (cat == -1) document.location.href = global_data.url + '/';
      else if (cat == -2) document.location.href = global_data.url + '/' + 'posts/';
   else document.location.href = global_data.url + '/' + 'posts' + '/' + cat + '/';
}
function ScrollToMin(stm, sbm) {
   var scroll = window.scrollTo(stm, sbm);
   return scroll;
}
function ibuscador_intro(e) {
   tecla = (document.all) ? e.keyCode : e.which;
   if (tecla == 13) home_search();
}

function home_search() {
   if ($('#ibuscadorq').val() == '' || $('#ibuscadorq').val() == $('#ibuscadorq').attr('title')) {
      $('#ibuscadorq').focus();
      return;
   }
}
function buscar_en_web(open) {
	if(open == 3) {
		$('.nav-search input').toggleClass('open', 'closed');
		$('.nav-search input').on("keyup", function(){
			var letter = $(this).val();
			$.ajax({
				type: 'POST',
				url: global_data.url + '/buscador-buscar.php',
				data: 'word=' + letter,
				success: function(h) {
					$('#results').addClass('shadow rounded').html(h);
				}
			});
		});
	} else location.href = global_data.url + '/buscador/';	
}
function cerrarBus() {
	$(this).on('click', function(){
		$('#results').removeClass('shadow rounded').html('');
	});
}
/* FIN - Buscador Home */

/* Editor */
function print_editor() {
}
/* FIN - Editor */
function gget(data, sin_amp) {
   var r = data + '=';
   if (!sin_amp) r = '&' + r;
   switch (data) {
      case 'key':
         if (global_data.user_key != '') return r + global_data.user_key;
      break;
      case 'postid':
         if (global_data.postid != '') return r + global_data.postid;
      break;
      case 'fotoid':
         if (global_data.fotoid != '') return r + global_data.fotoid;
      break;
      case 'temaid':
         if (global_data.temaid != '') return r + global_data.temaid;
      break;
   }
   return '';
}

function keypress_intro(e) {
   tecla = (document.all) ? e.keyCode : e.which;
   return (tecla == 13);
}

function onfocus_input(o) {
   if ($(o).val() == $(o).attr('title')) {
      $(o).val('');
      $(o).removeClass('onblur_effect');
   }
}

function onblur_input(o) {
   if ($(o).val() == $(o).attr('title') || $(o).val() == '') {
      $(o).val($(o).attr('title'));
      $(o).addClass('onblur_effect');
   }
}
function bloquear(user, bloqueado, lugar, aceptar) {
   if (!aceptar && bloqueado) {
      mydialog.show();
      mydialog.title('Bloquear usuario');
      mydialog.body('&iquest;Realmente deseas bloquear a este usuario?');
      mydialog.buttons(true, true, 'SI', "bloquear('" + user + "', true, '" + lugar + "', true)", true, false, true, 'NO', 'close', true, true);
      mydialog.center();
      return;
   }
   if (bloqueado) mydialog.procesando_inicio('Procesando...', 'Bloquear usuario');
   $('#loading').fadeIn(250);
   $.ajax({
      type: 'POST',
      url: global_data.url + '/bloqueos-cambiar.php',
      data: 'user=' + user + (bloqueado ? '&bloquear=1' : '') + gget('key'),
      success: function(h) {
         mydialog.alert('Bloquear Usuarios', h.substring(3));
         //
         if (h.charAt(0) == 1) {
            switch (lugar) {
               case 'perfil':
                  if (bloqueado) $('#bloquear_cambiar').html('Desbloquear').removeClass('btn-gradient-three').addClass('btn-gradient-five').attr('href', "javascript:bloquear('" + user + "', false, '" + lugar + "')");
                  else $('#bloquear_cambiar').html('Bloquear').removeClass('btn-gradient-five').addClass('btn-gradient-three').attr('href', "javascript:bloquear('" + user + "', true, '" + lugar + "')");
               break;
               case 'respuestas':
               case 'comentarios':
                  if (bloqueado) {
                     $('li.desbloquear_' + user).show();
                     $('li.bloquear_' + user).hide();
                  } else {
                     $('li.bloquear_' + user).show();
                     $('li.desbloquear_' + user).hide();
                  }
                  break;
               case 'mis_bloqueados':
                  if (bloqueado) $('.bloquear_usuario_' + user).attr('title', 'Desbloquear Usuario').removeClass('bloqueadosU').addClass('desbloqueadosU').html('Desbloquear').attr('href', "javascript:bloquear('" + user + "', false, '" + lugar + "')");
                  else $('.bloquear_usuario_' + user).attr('title', 'Bloquear Usuario').removeClass('desbloqueadosU').addClass('bloqueadosU').html('Bloquear').attr('href', "javascript:bloquear('" + user + "', true, '" + lugar + "')");
                  break;
               case 'mensajes':
                  if (bloqueado) $('#bloquear_cambiar').html('Desbloquear').attr('href', "javascript:bloquear('" + user + "', false, '" + lugar + "')");
                  else $('#bloquear_cambiar').html('Bloquear').attr('href', "javascript:bloquear('" + user + "', true, '" + lugar + "')");
                  break;
            }
         }
         $('#loading').fadeOut(350);
      },
      error: function() {
         mydialog.error_500("bloquear('" + user + "', '" + bloqueado + "', '" + lugar + "', true)");
         $('#loading').fadeOut(350);
      },
      complete: function() {
         mydialog.procesando_fin();
         $('#loading').fadeOut(350);
      }
   });
}

/* MyDialog */
var mydialog = {
   is_show: false,
   class_aux: '',
   mask_close: true,
   close_button: false,
   show: function(class_aux){
      if(this.is_show) return;
      else this.is_show = true;
      var PhpostRisus = '';
      PhpostRisus += '<div id="dialog">';
      PhpostRisus += '<div id="title"></div>';
      PhpostRisus += '<div id="cuerpo">';
      PhpostRisus += '<div id="procesando"><div id="mensaje"></div></div>';
      PhpostRisus += '<div id="modalBody">';
      PhpostRisus += '</div>'; // #modalBody
      PhpostRisus += '<div id="buttons" class="d-flex justify-content-between align-items-center w-100"></div>';
      PhpostRisus += '</div>'; // #cuerpo
      PhpostRisus += '</div>'; // #dialog
      if($('#mydialog').html() == '') {
         $('#mydialog').html(PhpostRisus).css('display', 'flex');
         $('#body').addClass('modal-open');
      }
   
      if(class_aux==true) $('#mydialog').addClass(this.class_aux);
      else if(this.class_aux != ''){
         $('#mydialog').removeClass(this.class_aux);
         this.class_aux = '';
      }
   
      if(this.close_button) $('#mydialog #dialog').append('<svg onclick="mydialog.close()" id="i-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M2 30 L30 2 M30 30 L2 2" /></svg>');
      else $('#mydialog #dialog .close_dialog').remove();
   
      $('#mydialog #dialog').fadeIn('fast');
   },
   close: function(){
      //Vuelve todos los parametros por default
      this.class_aux = '';
      this.mask_close = true;
      this.close_button = false;
      this.is_show = false;
      $('#mydialog').css('display', 'none');
      $('#mydialog #dialog').fadeOut('fast', function(){ $(this).remove() });
      $('#body').removeClass('modal-open');
      this.procesando_fin();
   },
   center: function() {
   },
   title: function(title) {
      $('#mydialog #title').html(title);
   },
   body: function(body, width, height) {
      $('#mydialog #modalBody').html(body);
   },
   buttons: function(display_all, btn1_display, btn1_val, btn1_action, btn1_enabled, btn1_focus, btn2_display, btn2_val, btn2_action, btn2_enabled, btn2_focus) {
      if (!display_all) {
         $('#mydialog #buttons').css('display', 'none').html('');
         return;
      }
      if (btn1_action == 'close') btn1_action = 'mydialog.close()';
      if (btn2_action == 'close' || !btn2_val) btn2_action = 'mydialog.close()';
      if (!btn2_val) {
         btn2_val = 'Cancelar';
         btn2_enabled = true;
      }
      var html = '';
      if (btn1_display) html += '<input type="button" class="btn btn-success' + (btn1_enabled ? '' : ' disabled') + '" style="display:' + (btn1_display ? 'inline-block' : 'none') + '"' + (btn1_display ? ' value="' + btn1_val + '"' : '') + (btn1_display ? ' onclick="' + btn1_action + '"' : '') + (btn1_enabled ? '' : ' disabled') + ' />';
      if (btn2_display) html += ' <input type="button" class="btn btn-danger' + (btn1_enabled ? '' : ' disabled') + '" style="display:' + (btn2_display ? 'inline-block' : 'none') + '"' + (btn2_display ? ' value="' + btn2_val + '"' : '') + (btn2_display ? ' onclick="' + btn2_action + '"' : '') + (btn2_enabled ? '' : ' disabled') + ' />';
      $('#mydialog #buttons').html(html).css('display', 'inline-block');
      if (btn1_focus) $('#mydialog #buttons .btn.btn-success').focus();
      else if (btn2_focus) $('#mydialog #buttons .btn.btn-danger').focus();
   },
   buttons_enabled: function(btn1_enabled, btn2_enabled) {
      if ($('#mydialog #buttons .btn.btn-success'))
         if (btn1_enabled) $('#mydialog #buttons .btn.btn-success').removeClass('disabled').removeAttr('disabled');
         else $('#mydialog #buttons .btn.btn-success').addClass('disabled').attr('disabled', 'disabled');
      if ($('#mydialog #buttons .btn.btn-danger'))
         if (btn2_enabled) $('#mydialog #buttons .btn.btn-danger').removeClass('disabled').removeAttr('disabled');
         else $('#mydialog #buttons .btn.btn-danger').addClass('disabled').attr('disabled', 'disabled');
   },
   alert: function(title, body, reload) {
      this.show();
      this.title(title);
      this.body(body);
      this.buttons(true, true, 'Aceptar', 'mydialog.close();' + (reload ? 'location.reload();' : 'close'), true, true, false);
      this.center();
   },
   error_500: function(fun_reintentar) {
      setTimeout(function() {
         mydialog.procesando_fin();
         mydialog.show();
         mydialog.title('Error');
         mydialog.body('Error al intentar procesar lo solicitado');
         mydialog.buttons(true, true, 'Reintentar', 'mydialog.close();' + fun_reintentar, true, true, true, 'Cancelar', 'close', true, false);
         mydialog.center();
      }, 200);
   },
   procesando_inicio: function(value, title) {
      if (!this.is_show) {
         this.show();
         this.title(title);
         this.body('');
         this.buttons(false, false);
         this.center();
      }
      $('#mydialog #procesando #mensaje').html('<span class="d-block postition-relative text-center loading loading-lg success"></span>');
      $('#mydialog #procesando').fadeIn('fast');
   },
   procesando_fin: function() {
      $('#mydialog #procesando').fadeOut('fast');
   }
};
document.onkeydown = function(e) {
   key = (e == null) ? event.keyCode : e.which;
   if (key == 27) //escape, close mydialog
      mydialog.close();
};


$(document).ready(function() {
   $('body').click(function(e) {
      if ($('#mon_list').css('display') != 'none' && $(e.target).closest('#mon_list').length == 0 && $(e.target).closest('a[name=Monitor]').length == 0) notifica.last();
      if ($('#mp_list').css('display') != 'none' && $(e.target).closest('#mp_list').length == 0 && $(e.target).closest('a[name=Mensajes]').length == 0) mensaje.last();
      if ($('#menu_list').css('display') != 'none' && $(e.target).closest('#menu_list').length == 0 && $(e.target).closest('a[name=Menu]').length == 0) menu.last();
   });
   print_editor();
});
var notifica = {
   cache: {},
   retry: Array(),
   userMenuPopup: function(obj) {
      var id = $(obj).attr('userid');
      var cache_id = 'following_' + id,
         list = $(obj).children('ul');
      $(list).children('li.check').slideUp();
      if (this.cache[cache_id] == 1) {
         $(list).children('li.follow').slideUp();
         $(list).children('li.unfollow').slideDown();
      } else {
         $(list).children('li.unfollow').slideUp();
         $(list).children('li.follow').slideDown();
      }
   },
   userInMencionHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) {
         var fid = x[1];
         $('a.mf_' + fid + ', a.mf_' + fid).each(function() {
            $(this).toggle();
         });
         $('.mft_' + fid).html(number_format(parseInt(x[2])));
         vcard_cache['mf' + fid] = '';
      } else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   userMenuHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) {
         var cache_id = 'following_' + x[1];
         notifica.cache[cache_id] = parseInt(x[0]);
         $('div.avatar-box').children('ul').hide();
      } else if (x.length == 4) mydialog.alert('Notificaciones', x[4]);
   },
   userInPostHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) {
         $('a.follow_user_post, a.unfollow_user_post').toggle();
         $('div.metadata-usuario > span.nData.user_follow_count').html(number_format(parseInt(x[2])));
         notifica.userMenuHandle(r);
      } else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   userInMonitorHandle: function(r, obj) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) $(obj).fadeOut(function() {
         $(obj).remove();
      });
      else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   inPostHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) {
         $('a.follow_post, a.unfollow_post').parent('li').toggle();
         $('ul.post-estadisticas > li > span.icons.monitor').html(number_format(parseInt(x[2])));
      } else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   inComunidadHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) {
         $('a.follow_comunidad, a.unfollow_comunidad').toggle();
         $('li.comunidad_seguidores').html(number_format(parseInt(x[2])) + ' Seguidores');
      } else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   temaInComunidadHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) {
         $('div.followBox > a.follow_tema, a.unfollow_tema').toggle();
         $('span.tema_notifica_count').html(number_format(parseInt(x[2])) + ' Seguidores');
      } else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   ruserInAdminHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) $('.ruser' + x[1]).toggle();
      else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   listInAdminHandle: function(r) {
      var x = r.split('-');
      if (x.length == 3 && x[0] == 0) {
         $('.list' + x[1]).toggle();
         $('.list' + x[1] + ':first').parent('div').parent('li').children('div:first').fadeTo(0, $('.list' + x[1] + ':first').css('display') == 'none' ? 0.5 : 1);
      } else if (x.length == 4) mydialog.alert('Notificaciones', x[3]);
   },
   spamPostHandle: function(r) {
      var x = r.split('-');
      if (x.length == 2) mydialog.alert('Notificaciones', x[1]);
      else mydialog.close();
   },
   spamTemaHandle: function(r) {
      var x = r.split('-');
      if (x.length == 2) mydialog.alert('Notificaciones', x[1]);
      else mydialog.close();
   },
   ajax: function(param, cb, obj) {
      if ($(obj).hasClass('spinner')) return;
      notifica.retry.push(param);
      notifica.retry.push(cb);
      var error = param[0] != 'action=count';
      $(obj).addClass('spinner');
      $('#loading').fadeIn(250);
      $.ajax({
         url: global_data.url + '/notificaciones-ajax.php',
         type: 'post',
         data: param.join('&') + gget('key'),
         success: function(r) {
            $(obj).removeClass('spinner');
            cb(r, obj);
            $('#loading').fadeOut(350);
         },
         error: function() {
            if (error) mydialog.error_500('notifica.ajax(notifica.retry[0], notifica.retry[1])');
            $('#loading').fadeOut(350);
         }
      });
   },
   follow: function(type, id, cb, obj) {
      this.ajax(Array('action=follow', 'type=' + type, 'obj=' + id), cb, obj);
   },
   unfollow: function(type, id, cb, obj) {
      this.ajax(Array('action=unfollow', 'type=' + type, 'obj=' + id), cb, obj);
   },
   spam: function(id, cb) {
      this.ajax(Array('action=spam', 'postid=' + id), cb);
   },
   c_spam: function(id, cb) {
      this.ajax(Array('action=c_spam', 'temaid=' + id), cb);
   },
   sharePost: function(id) {
      mydialog.show();
      mydialog.title('Recomendar');
      mydialog.body('¿Quieres recomendar este post a tus seguidores?');
      mydialog.buttons(true, true, 'Recomendar', 'notifica.spam(' + id + ', notifica.spamPostHandle)', true, true, true, 'Cancelar', 'close', true, false);
      mydialog.center();
   },
   shareTema: function(id) {
      mydialog.show();
      mydialog.title('Recomendar');
      mydialog.body('¿Quieres recomendar este tema a tus seguidores?');
      mydialog.buttons(true, true, 'Recomendar', 'notifica.c_spam(' + id + ', notifica.spamTemaHandle)', true, true, true, 'Cancelar', 'close', true, false);
      mydialog.center();
   },
   last: function() {
      var c = parseInt($('#alerta_mon > a > span').html());
      mensaje.close();
      if ($('#mon_list').css('display') != 'none') {
         $('#mon_list').fadeOut();
         $('a[name=Monitor]').parent('li').removeClass('monitor-notificaciones');
      } else {
         if (($('#mon_list').css('display') == 'none' && c > 0) || typeof notifica.cache.last == 'undefined') {
            $('#mon_list').slideDown();
            notifica.ajax(Array('action=last'), function(r) {
               notifica.cache['last'] = r;
               notifica.show();
            });
         } else notifica.show();
      }
   },
   check: function() {
      notifica.ajax(Array('action=count'), notifica.popup);
   },
   popup: function(r) {
      var c = parseInt($('#alerta_mon > a > span').html());
      if (r != c && r > 0) {
         if (r != 1) var not_total = ' notificaciones';
         else var not_total = ' notificaci&oacute;n';
         if (!$('#alerta_mon').length) $('div.nav-user > div.monitor').append('<div class="alertas" id="alerta_mon"><a title="' + r + not_total + '"><span></span></a></div>');
         $('#alerta_mon > a > span').html(r);
         $('#alerta_mon').animate({
            top: '-=5px'
         }, 100, null, function() {
            $('#alerta_mon').animate({
               top: '+=5px'
            }, 100)
         });
      } else if (r == 0) $('#alerta_mon').remove();
   },
   show: function() {
      if (typeof notifica.cache.last != 'undefined') {
         $('#alerta_mon').remove();
         $('#mon_list').show().children('ul').html(notifica.cache.last);
      }
   },
   filter: function(x, obj) {
      $.ajax({
         url: global_data.url + '/notificaciones-filtro.php',
         type: 'post',
         data: 'fid=' + x
      });
      var v = $(obj).prop('checked') ? 1 : 0;
   },
   close: function() {
      $('#mon_list').hide();
      $('a[name=Monitor]').parent('li').removeClass('monitor-notificaciones');
   }
}
/* Mensajes */
var mensaje = {
   cache: {},
   vars: Array(),
   // CREAR HTML
   form: function() {
      var html = '';
      if (this.vars['error']) html += '<div class="alert alert-warning">' + this.vars['error'] + '</div><br style="clear:both">'
      html += '<div class="form-group"><label class="form-label" for="msg_to">Para:</label>'
      html += '<input type="text" placeholder="Ingrese el nombre de usuario" class="form-input" value="' + this.vars['to'] + '" maxlength="16" tabindex="0" size="20" id="msg_to" name="msg_to"/></div>'
      html += '<div class="form-group"><label class="form-label" for="msg_subject">Asunto:</label>'
      html += '<input type="text" placeholder="Asunto del mensaje" class="form-input" value="' + this.vars['sub'] + '" maxlength="100" tabindex="0" size="50" id="msg_subject" name="msg_subject"/></div>'
      html += '<div class="form-group"><label class="form-label" for="msg_body">Mensaje:</label>'
      html += '<textarea tabindex="0" placeholder="El mensaje a enviar" rows="2" id="msg_body" name="msg_body" class="form-input">' + this.vars['msg'] + '</textarea></div>'
      return html;
   },
   // FUNCIONES AUX
   checkform: function(h) {
      if (parseInt(h) == 0) mensaje.enviar(1);
      else if (parseInt(h) == 1) {
         mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'No es posible enviarse mensajes a s&iacute; mismo.');
      } else if (parseInt(h) == 2) {
         mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'Este usuario no existe. Por favor, verif&iacute;calo.');
      }
   },
   alert: function(h) {
      mydialog.procesando_fin();
      mydialog.alert('Aviso', '<div class="alert alert-primary">' + h + '</div>');
   },
   mostrar: function(show, obj) {
      //
      $('.GBTabset a').removeClass('here');
      //
      if (show == 'all') {
         $('#mensajes div').show();
         $(obj).addClass('here');
      } else if (show == 'unread') {
         $('#mensajes div.GBThreadRow').hide();
         $('#mensajes table.unread').parent().show();
         $(obj).addClass('here');
      }
   },
   select: function(act) {
      //
      var inputs = $('#mensajes .GBThreadRow :input');
      inputs.each(function() {
         if (act == 'all') {
            $(this).attr({
               checked: 'checked'
            });
         } else if (act == 'read') {
            if ($(this).attr('class') != 'inread') {
               $(this).attr({
                  checked: 'checked'
               });
            } else $(this).attr({
               checked: ''
            });
         } else if (act == 'unread') {
            if ($(this).attr('class') == 'inread') {
               $(this).prop({checked: 'checked'});
            } else $(this).attr({
               checked: ''
            });
         } else if (act == 'none') {
            $(this).attr({
               checked: ''
            });
         }
      });
   },
   modificar: function(act) {
      var inputs = $('#mensajes .GBThreadRow :input');
      var ids = new Array();
      var i = 0;
      //
      inputs.each(function() {
         var este = $(this).prop('checked');
         //
         if (este != false) {
            // AGREGAR EL ID
            ids[i] = $(this).val();
            i++;
            // PARA LOS ESTILOS
            var cid = $(this).val().split(':');
            // MARCAR LEIDO
            if (act == 'read') {
               $('#' + cid[0]).removeClass('unread');
               $(this).removeClass('inread');
               // MARCAR NO LEIDO
            } else if (act == 'unread') {
               $('#' + cid[0]).addClass('unread');
               $(this).addClass('inread');
               // ELIMINAR
            } else if (act == 'delete') {
               $('#' + cid[0]).parent().remove();
            }
         }
      });
      // ENVIAR CAMBIOS
      if (ids.length > 0) {
         var params = ids.join(',');
         mensaje.ajax('editar', 'ids=' + params + '&act=' + act, function(r) {
            //
         });
      }
   },
   eliminar: function(id, type) {
      mensaje.ajax('editar', 'ids=' + id + '&act=delete', function(r) {
         if (type == 1) {
            var cid = id.split(':');
            $('#mp_' + cid[0]).remove();
         } else if (type == 2) {
            location.href = global_data.url + '/mensajes/';
         }
      });
   },
   marcar: function(id, a, type, obj) {
      var act = (a == 0) ? 'read' : 'unread';
      var show = (act == 'read') ? 'unread' : 'read';
      //
      mensaje.ajax('editar', 'ids=' + id + '&act=' + act, function(r) {
         // CAMBIAR ENTRE LEIDO Y NO LEIDO
         if (type == 1) {
            var cid = id.split(':');
            if (act == 'read') $('#mp_' + cid[0]).removeClass('unread');
            else $('#mp_' + cid[0]).addClass('unread');
            //
            $(obj).parent().find('a').hide();
            $(obj).parent().find('.' + show).show();
         } else {
            location.href = global_data.url + '/mensajes/';
         }
      });
   },
   // POST
   ajax: function(action, params, fn) {
      $('#loading').fadeIn(250);
      $.ajax({
         type: 'POST',
         url: global_data.url + '/mensajes-' + action + '.php',
         data: params,
         success: function(h) {
            fn(h);
            $('#loading').fadeOut(350);
         }
      });
   },
   // PREPARAR EL ENVIO
   nuevo: function(para, asunto, body, error) {
      // GUARDAR
      this.vars['to'] = para;
      this.vars['sub'] = asunto;
      this.vars['msg'] = body;
      this.vars['error'] = error;
      //
      mydialog.procesando_fin();
      mydialog.show(true);
      mydialog.title('Nuevo mensaje');
      mydialog.body(this.form());
      mydialog.buttons(true, true, 'Enviar', 'mensaje.enviar(0)', true, true, true, 'Cancelar', 'close', true, false);
      mydialog.center();
   },
   // ENVIAR...
   enviar: function(enviar) {
      // DATOS
      this.vars['to'] = $('#msg_to').val();
      this.vars['sub'] = $('#msg_subject').val();
      this.vars['msg'] = $('#msg_body').val();
      // COMPROBAR
      if (enviar == 0) { // VERIFICAR...
         if (this.vars['to'] == '') mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'Por favor, especific&aacute; el destinatario.');
         if (this.vars['msg'] == '') mensaje.nuevo(mensaje.vars['to'], mensaje.vars['sub'], mensaje.vars['msg'], 'El mensaje esta vac&iacute;o.');
         //
         mydialog.procesando_inicio('Verificando...', 'Nuevo Mensaje');
         this.ajax('validar', 'para=' + this.vars['to'], mensaje.checkform);
      } else if (enviar == 1) {
         mydialog.procesando_inicio('Enviando...', 'Nuevo Mensaje');
         // ENVIAR
         this.ajax('enviar', 'para=' + mensaje.vars['to'] + '&asunto=' + mensaje.vars['sub'] + '&mensaje=' + mensaje.vars['msg'], mensaje.alert);
      }
   },
   // RESPONDER
   responder: function(mp_id) {
      this.vars['mp_id'] = $('#mp_id').val();
      this.vars['mp_body'] = $('#respuesta').val();
      if (this.vars['mp_body'] == '') {
         $('#respuesta').focus();
         return;
      }
      //
      this.ajax('respuesta', 'id=' + this.vars['mp_id'] + '&body=' + this.vars['mp_body'], function(h) {
         $('#respuesta').val(''); // LIMPIAMOS
         $('.wysibb-body').html('');
         switch (h.charAt(0)) {
            case '0':
               mydialog.alert("Error", h.substring(3));
               break;
            case '1':
               $('#historial').append($(h.substring(3)).fadeIn('slow'));
               break;
         }
         $('#respuesta').focus();
      });
   },
   last: function() {
      var c = parseInt($('#alerta_mps > a > span').html());
      notifica.close();
      //
      if ($('#mp_list').css('display') != 'none') {
         $('#mp_list').hide();
         $('a[name=Mensajes]').parent('li').removeClass('monitor-notificaciones');
      } else {
         if (($('#mp_list').css('display') == 'none' && c > 0) || typeof mensaje.cache.last == 'undefined') {
            $('#mp_list').show();
            mensaje.ajax('lista', '', function(r) {
               mensaje.cache['last'] = r;
               mensaje.show();
            });
         } else mensaje.show();
      }
   },
   popup: function(mps) {
      var c = parseInt($('#alerta_mps > a > span').html());
      if (mps != c && mps > 0) {
         if (mps != 1) var mps_total = ' mensajes';
         else var mps_total = ' mensaje';
         if (!$('#alerta_mps').length) $('div.nav-user > div.mensajes').append('<div class="alertas" id="alerta_mps"><a title="' + mps + mps_total + '"><span></span></a></div>');
         $('#alerta_mps > a > span').html(mps);
         $('#alerta_mps').animate({
            top: '-=5px'
         }, 100, null, function() {
            $('#alerta_mps').animate({
               top: '+=5px'
            }, 100)
         });
      } else if (mps == 0) $('#alerta_mps').remove();
   },
   show: function() {
      if (typeof mensaje.cache.last != 'undefined') {
         $('#alerta_mps').remove();
         $('#mp_list').show().children('ul').html(mensaje.cache.last);
      }
   },
   close: function() {
      $('#mp_list').slideUp();
      $('a[name=Mensajes]').parent('li').removeClass('monitor-notificaciones');
   }
}

/* DENUNCIAS */
var denuncia = {
   nueva: function(type, obj_id, obj_title, obj_user){
      // PLANTILLA
		$('#loading').fadeIn(250); 
      $.ajax({
			type: 'POST',
			url: global_data.url + '/denuncia-' + type + '.php',
			data: 'obj_id=' + obj_id + '&obj_title=' + obj_title + '&obj_user=' + obj_user,
			success: function(h){
            denuncia.set_dialog(h, obj_id, type);
            $('#loading').fadeOut(350);                                 
			}
		});
   },
   set_dialog: function(html, obj_id, type){
      var d_title = 'Denunciar ' + type;
      // MYDIALOG
      mydialog.mask_close = false;
      mydialog.close_button = true;		                                        
		mydialog.show();
      mydialog.title(d_title);
		mydialog.body(html);
		mydialog.buttons(true, true, 'Enviar', "denuncia.enviar(" + obj_id + ", '" + type + "')", true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
   },
   enviar: function(obj_id, type){
      var razon = $('select[name=razon]').val();
      var extras = $('textarea[name=extras]').val();
      //
      $('#loading').fadeIn(250);                         
		$.ajax({
			type: 'POST',
			url: global_data.url + '/denuncia-' + type + '.php',
			data: 'obj_id=' + obj_id + '&razon=' + razon + '&extras=' + extras,
			success: function(h){
            switch(h.charAt(0)){
               case '0':
                  mydialog.alert("Error",'<div class="alert alert-warning">' + h.substring(3) +  '</div>');
               break;
               case '1':
                  mydialog.alert("Bien", '<div class="alert alert-warning">' + h.substring(3) + '</div>');
               break;
            }
            $('#loading').fadeOut(350);                                                 
			}
		});
   }
}
/* AFILIACION */
var afiliado = {
   vars: Array(),
   nuevo: function(){
      // CARGAMOS Y BORRAMOS
      var form = '';
      form += '<div id="AFormInputs">'
      form += '<div class="form-group">'
      form += '<label class="form-label" for="atitle">T&iacute;tulo</label>'
      form += '<input type="text" tabindex="1" name="atitle" id="atitle" class="form-input" maxlength="35"/>'
  		form += '</div>'
      form += '<div class="form-group">'
      form += '<label class="form-label" for="aurl">Direcci&oacute;n</label>'
      form += '<input type="text" tabindex="2" name="aurl" id="aurl" class="form-input" value="https://"/>'
  		form += '</div>'
      form += '<div class="form-group">'
      form += '<label class="form-label" for="aimg">Banner <small>(216x42px)</small></label>'
      form += '<input type="text" tabindex="3" name="aimg" id="aimg" class="form-input" value="https://"/>'
  		form += '</div>'
      form += '<div class="form-group">'
      form += '<label class="form-label" for="atxt">Descripci&oacute;n</label>'
      form += '<textarea tabindex="4" rows="10" name="atxt" id="atxt" class="form-input" style="height:60px;"></textarea>'
  		form += '</div>'
      form += '</div>'
      //
      mydialog.class_aux = 'registro';
      mydialog.mask_close = false;
      mydialog.close_button = true;
		mydialog.show(true);
		mydialog.title('Nueva Afiliaci&oacute;n');
		mydialog.body(form);
		mydialog.buttons(true, true, 'Enviar', 'afiliado.enviar(0)', true, true, true, 'Cancelar', 'close', true, false);
		mydialog.center();
   },
   enviar: function(){
      var inputs = $('#AFormInputs :input');
      var status = true;
      var params = '';
      //
      inputs.each(function(){
         var val = $(this).val();
         // EL CAMPO AID NO ES NECESARIO
         if($(this).attr('name') == 'aID') val = '0'; 
         // COMPROBAMOS CAMPOS VACIOS
        	if(status == true) params += $(this).attr('name') + '=' + val + '&';
		});
      //
      if(status == true){
         mydialog.procesando_inicio('Enviando...', 'Nueva Afiliaci&oacute;n');
         afiliado.enviando(params);
      }
   },
   enviando: function(params){
   	//
      $('#loading').fadeIn(250); 
   	$.ajax({
   		type: 'POST',
   		url: global_data.url + '/afiliado-nuevo.php',
   		data: params,
   		success: function(h){
   		  	mydialog.procesando_fin();
   		  	switch(h.charAt(0)){
   		      case '0':
               	$('#AFStatus > span').fadeOut().text('La URL es incorrecta').fadeIn();
               break;
               case '1':
                  mydialog.body(h.substring(3));
                  mydialog.buttons(true, true, 'Aceptar', 'mydialog.close()', true, true);
               break;
               case '2':
               	$('#AFStatus > span').fadeOut().text('Faltan datos').fadeIn();
               break;
   		  	}
            mydialog.center();
            $('#loading').fadeOut(350); 
   		}
   	});
   },
   detalles: function(aid){
      $('#loading').fadeIn(250); 
   	$.ajax({
   		type: 'POST',
   		url: global_data.url + '/afiliado-detalles.php',
   		data: 'ref=' + aid,
   		success: function(h){
   		   mydialog.class_aux = '';
       		mydialog.show(true);
       		mydialog.title('Detalles');
       		mydialog.body(h);
            mydialog.buttons(true, true, 'Aceptar', 'mydialog.close()', true, true);
            mydialog.center();
            $('#loading').fadeOut(350); 
         }
   	});   
   }
}
var news = {
   total: 0,
   count: 1,
   slider: function(){
      if(news.total > 1){
         if(news.count < news.total) news.count++;
         else news.count = 1;
         //
         $('#top_news > li').hide();
         $('#new_' + news.count).fadeIn();
         // INFINITO :D
         setTimeout("news.slider()",7000);
      }
   }       
}
// READY
$(document).ready(function(){
   /* NOTICIAS */
   news.total = $('#top_news > li').length;
   news.slider();
   // Moderacion
   $('#stickymsg').on('onmouseover', function() {
      $('#brandday').css('opacity',0.5);
   }).on('onmouseout', function() {
      $('#brandday').css('opacity',1);
   }).on('onclick', function() {
   	var enlace = $(this).attr('data-url');
      location.href = enlace;
   });

   // Versión 1: Buscar usuarios [BETA]
   $('#buscarusuario input[name=usuario]').on('keyup', function(e){
		var usuario = $(this).val(), id = $(this).data('user');
		all = (usuario == 'all') ? 'todos' : usuario;
		$.ajax({
			type: 'POST',
			url: global_data.url + '/buscador-usuario.php',
			data: 'users=' + usuario + '&s=' + all + '&id=' + id,
			success: function(usuarios) {
				// Donde queremos visualizar el resultado!
				$('#resUser').html(usuarios);
			}
		});
   });

});

var menu = {
   cache: {},
   last: function() {
      //
      if ($('#menu_list').css('display') != 'none') $('#menu_list').hide();
      else {
         if (($('#menu_list').css('display') == 'none') || typeof favorito.cache.last == 'undefined') $('#menu_list').show();
      }
   },
   close: function(){
      $('#menu_list').slideUp();
   }
}
