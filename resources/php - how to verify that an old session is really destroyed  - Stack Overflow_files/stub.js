window.StackExchange={};if(top!=self){top.location.replace(document.location);alert("For security reasons, framing is not allowed; click OK to remove the frames.")}StackExchange.init=(function(){var a=function(e){if(!window.jQuery){if(document.readyState!="complete"){setTimeout(function(){a(e)},1000);return}var d=document.createElement("div");d.id="noscript-padding";var f=document.createElement("div");f.id="noscript-warning";f.innerHTML=e+" requires external JavaScript from another domain, which is blocked or failed to load.";document.body.insertBefore(d,document.body.firstChild);document.body.appendChild(f)}};var c=function(){$(document).keyup(function(d){if(d.which==27){$("#lightbox, .error-notification, .popup, .share-tip, .esc-remove").fadeOutAndRemove();$(".esc-hide").fadeOut();if(window.genuwine&&genuwine.isVisible()){genuwine.click()}if(window.profileLink){profileLink.hide()}}})};return function(d){StackExchange.options=d;var e=d.serverTime-(new Date()).getTime()/1000;a(d.site.name);$.ajaxSetup({cache:false});StackExchange.init.createJqueryExtensions();$(function(){c();StackExchange.using(StackExchange.options.user.isAnonymous?"anonymous":"loggedIn",function(){StackExchange.initialized.resolve()});StackExchange.ready(function(){genuwine.init(d.user.guid||null,d.user.inboxUnviewedCount);if(d.user.messages){StackExchange.notify.showMessages(d.user.messages,d.mobile)}if(!d.site.globalAuthDisabled){if(!d.site.isChildMeta&&d.user.isAnonymous){gauth.checkStackAuth(d.stackAuthUrl)}gauth.informStackAuth(d.stackAuthUrl)}if(d.user.isAnonymous){StackExchange.notify.showFirstTime(d.site.description)}else{profileLink.init(d.user.gravatar,d.isMobile,d.user.profileUrl+"?tab=activity",e)}if(StackExchange.tagPreferences){StackExchange.tagPreferences.init()}else{StackExchange.tagmenu.init()}})})}})();StackExchange.debug={log:function(a){},init:function(){this.log=function(a){$(function(){var c=$("#debug-messages");if(!c.length){c=$("<div id='debug-messages' style='text-align:left;position:fixed;top:50px;left:50px;z-index:1000;background:white;border:2px solid black;width:300px;padding:10px;' />").append($("<span style='cursor:pointer;color:#999'>(close debug messages)</span>").click(function(){$("#debug-messages").remove()})).appendTo("body")}$("<div style='margin-top:10px' />").text(a).appendTo(c)})}}};StackExchange.initialized=$.Deferred();StackExchange.ready=function(a){StackExchange.initialized.done(a)};StackExchange.using=(function(){var k={prettify:"prettify-full.js",pseudoModerator:"moderator.js",anonymous:"full-anon.js",loggedIn:"full.js",editor:"wmd.js",autocomplete:"third-party/jquery.autocomplete.min.js",mobile:"mobile.js",help:"help.js"},e={},l={},j,a={};var h=function(p,o){return function(q){var r=p[q];if(!r){r=p[q]=o(q)}return r}};var f=function(){if(!j){var o=$("script[src*='/stub.js']:first");if(o.length==0){StackExchange.debug.log("couldn't figure out location of stub.js");j="/content/js/"}else{j=o.attr("src").replace(/\/stub\.js.*$/,"/")}}return j};var n=function(p){var o=a["js/"+p];if(!o){StackExchange.debug.log("no cache breaker for "+p);return""}return"?v="+o};var c=function(p){var o=k[p];if(!o){return $.Deferred().reject().promise()}return d(o)};var d=h(l,function(o){return $.ajax({url:f()+o+n(o),dataType:"script",cache:true}).promise()});var i=h(e,function(s){var p=$.Deferred(),r=StackExchange[s],q=3;function o(){r=StackExchange[s];if(!r){if(q>0){q--;StackExchange.debug.log("retrying "+s);setTimeout(o,20);return}else{StackExchange.debug.log("object "+s+" not available although file was loaded");p.reject();return}}p.resolve()}if(r){p.resolve()}else{c(s).done(o).fail(p.reject)}return p.promise()});var g=function(p,o){i(p).done(function(){o()}).fail(function(){StackExchange.debug.log("failed to provide object "+p)})};g.setCacheBreakers=function(o){a=o};return g})();String.prototype.format=function(){var a=this.toString();if(!arguments.length){return a}var d=typeof arguments[0]=="string"?arguments:arguments[0];for(var c in d){a=a.replace(new RegExp("\\{"+c+"\\}","gi"),d[c])}return a};String.prototype.truncate=function(a,d){var c=this.toString();if(a&&c.length>a){c=c.substr(0,a)+d}return c};StackExchange.init.createJqueryExtensions=function(){var a=StackExchange.helpers;$.fn.extend({fadeOutAndRemove:function(c){return this.each(function(){var d=$(this);d.fadeOut("fast",function(){d.trigger("removing").remove()})})},charCounter:function(c){return this.each(function(){$(this).bind("blur focus keyup",function(){var h=c.min;var j=c.max;var i=c.setIsValid||function(){};var e=this.value?this.value.length:0;var f=e>j*0.8?"supernova":e>j*0.6?"hot":e>j*0.4?"warm":"cool";var d="";if(e==0){d="enter at least "+h+" characters";i(false)}else{if(e<h){d=(h-e)+" more to go..";i(false)}else{d=(j-e)+" character"+(j-e!=1?"s":"")+" left";i(e<=j)}}var g=$(this).parents("form").find("span.text-counter");g.text(d);if(!g.hasClass(f)){g.removeClass("supernova hot warm cool").addClass(f)}})})},selectRange:function(d,c){return this.each(function(){if(this.setSelectionRange){this.focus();this.setSelectionRange(d,c)}else{if(this.createTextRange){var e=this.createTextRange();e.collapse(true);e.moveEnd("character",c);e.moveStart("character",d);e.select()}}})},addSpinner:function(c){return this.each(function(){a.addSpinner(this,c)})},addSpinnerAfter:function(c){return this.each(function(){$(this).after(a.getSpinnerImg(c))})},removeSpinner:function(){return this.each(function(){$(this).find("img.ajax-loader").remove()})},showErrorPopup:function(c,d){return this.each(function(){a.showErrorPopup(this,c,d)})},center:function(){this.css("position","absolute");this.css("top",($(window).height()-this.height())/2+$(window).scrollTop()+"px");this.css("left",($(window).width()-this.width())/2+$(window).scrollLeft()+"px");return this},helpOverlay:function(){a.bindHelpOverlayEvents(this);return this},hideHelpOverlay:function(){a.hideHelpOverlay(this);return this},enable:function(){if(arguments.length==0||arguments[0]){this.removeAttr("disabled").css("cursor","pointer")}else{this.attr("disabled","disabled").css("cursor","default")}return this},disable:function(){return this.enable(false)},loadPopup:function(d){var c=this;c.addSpinnerAfter({padding:"0 3px"});$.ajax({type:"GET",url:d.url,dataType:"html",success:function(f){var h=$(f);h.find(".popup-actions-cancel, .popup-close a").click(function(){h.fadeOutAndRemove()});h.find("input:radio[disabled=disabled] + label.action-label").addClass("action-disabled");if(d.hideDescriptions){h.find("ul.action-list > li:not(.action-selected) .action-desc").hide()}var g=h.find("input:radio:not(.action-subform input)");g.closest("li").bind("hide-action",function(){var j=$(this);var k=".action-subform"+(d.hideDescriptions?", .action-desc":"");j.removeClass("action-selected").find(k).slideUp("fast")}).bind("show-action",function(){var j=$(this);if(j.hasClass("action-selected")){return}j.siblings(".action-selected").trigger("hide-action");j.addClass("action-selected").find(".action-subform").slideDown("fast",function(){if(d.subformShow){d.subformShow($(this))}if(d.subformFocusInput){var k=$(this).find("input[type=text], textarea").not(".actual-edit-overlay").eq(0);if(k.length){k.focus()}}});if(d.hideDescriptions){j.find(".action-desc").slideDown("fast")}if(d.actionSelected){d.actionSelected(j)}h.find(".popup-submit").enable()});g.click(function(){$(this).closest("li").trigger("show-action")});h.appendTo(c.parent());if(d.loaded){d.loaded(h)}var i=function(){};if(d.subformShow){var e=h.find("li.action-selected .action-subform");if(e.length>0){i=function(){e.each(function(){d.subformShow($(this))})}}}h.center().fadeIn("fast",i)},error:function(){c.parent().showErrorPopup("Unable to load popup - please try again")},complete:a.removeSpinner});return c},delayedHover:function(g,e,h,c){if(this.length==0){return this}if(this.length>1){this.each(function(){$(this).delayedHover(g,e,h,c)});return this}var f,i;h=h||0;c=typeof c=="number"?c:h;function d(){if(f){clearTimeout(f)}if(i){clearTimeout(i)}f=i=null}this.hover(function(k){var j=this;d();f=setTimeout(function(){g.call(j,k)},h)},function(k){var j=this;d();i=setTimeout(function(){e.call(j,k)},c)});return this}})};StackExchange.helpers=(function(){var e=function(g){return g.parent().find("span.edit-field-overlay")};function a(g,l,n){for(var h=0;h<n.lenght;h++){var j=n[h];try{l.css(j,g.css(j))}catch(k){}}}function c(k,p){if(!k.is(":visible")){return}if(k.val().length!=0){k.css("opacity",1).css("filter","").removeClass("edit-field-overlayed");return}else{k.css("opacity",p?0.5:0.3);k.addClass("edit-field-overlayed")}var g=k.prev(".actual-edit-overlay");if(g.length==0){var n=e(k).text();g=k.clone().attr("class","actual-edit-overlay").attr("name",null).attr("id",null).attr("disabled","disabled").val(n).css({position:"absolute",backgroundColor:"white",color:"black",opacity:1,width:k.width(),height:k.height()});a(k,g,["font-family","font-size","line-height","text-align"]);k.css({zIndex:1,position:"relative"});g.insertBefore(k);var j=k.offset().top-g.offset().top;if(j!=0){var i=parseInt(g.css("margin-top"));var l=i+j;if(!k.is("textarea")){l=parseInt(g.prevAll(":visible").eq(0).css("margin-bottom"))+i}g.css("margin-top",l)}var o=k.offset().left-g.offset().left;if(o!=0){var h=parseInt(g.css("margin-left"));g.css("margin-left",h+o)}}}function d(h,g){$(h).find("input[type='submit']").attr("disabled",g?"disabled":"")}var f={bindHelpOverlayEvents:function(g){g.bind("keydown contextmenu",function(){f.hideHelpOverlay($(this))}).focus(function(){c($(this),true)}).blur(function(){c($(this))}).each(function(){c($(this))})},hideHelpOverlay:function(g){g.css("opacity",1);g.css("filter","");g.removeClass("edit-field-overlayed")},onClickDraftSave:function(g){$(g).click(function(){var h=this.href;if(!heartbeat.draftSaved()){heartbeat.ping(function(){window.onbeforeunload=null;window.location.href=h});return false}window.onbeforeunload=null;return true});return true},showErrorPopup:function(g,h,i){$(".error-notification").remove();var j=$('<div class="error-notification supernovabg"><h2>'+h+"</h2>"+(i?"":'<span class="error-close">(click on this box to dismiss)</span>')+"</div>");var k=function(){j.fadeOutAndRemove()};$(g).append(j);j.click(k).fadeIn("fast");setTimeout(k,(i?Math.max(2500,h.length*40):1000*30))},addSpinner:function(g,h){$(g).append(f.getSpinnerImg(h))},getSpinnerImg:function(g){var h=$('<img class="ajax-loader" src="/content/img/progress-dots.gif" title="loading..." alt="loading..." />');if(g){h.css(g)}return h},removeSpinner:function(){$("img.ajax-loader").remove()},enableSubmitButton:function(g){d(g,false)},disableSubmitButton:function(g){d(g,true)},loadTicks:function(){var g=$("#edit-block");if(g.find("input[name=i1l]").length==0){$.get("/questions/ticks",function(h){g.append("<input type='hidden' name='i1l' value='"+h+"' />")})}},showFancyOverlay:function(h){h=h||{};var j=$("#overlay-header"),i=h.message||"",g=$.browser.msie?{background:"#fff",opacity:0}:{};if(h.showClose!==false){i+='<br><a class="close-overlay">close this message</a>'}j.html(i).css(g).animate({opacity:"1",height:"show"},"slow",h.complete).find(".close-overlay").click(function(){j.animate({opacity:"0",height:"hide"},"fast")})}};return f})();function prepareEditor(c){var d=c.creationCallback;var l=function(){if(d){d()}StackExchange.editor.initIfShown(c)};if(StackExchange.editor){l();return}if(!c.onDemand){StackExchange.using("editor",l);return}var n="bold-button italic-button spacer1 link-button quote-button code-button image-button spacer2 olist-button ulist-button heading-button hr-button spacer3 undo-button redo-button".split(" ");var e=$('<ul id="wmd-button-row" />').appendTo("#wmd-button-bar");var f=0;for(var a=0;a<n.length;a++){var h=n[a];var j=/spacer/.test(h);var g=$("<li id='wmd-"+h+"' />").attr("class","wmd-"+(j?"spacer":"button")).css("left",a*25).appendTo(e);$("<span />").css("background-position",(f)+"px -20px").appendTo(g);if(!j){f-=20}}var k=false;$("#wmd-input, #title, #tagnames, #edit-comment, #m-address, #display-name").one("focus click keydown",function(){if(k){return}k=true;var i=function(){e.remove();if(c.autoShowMarkdownHelp){c.immediatelyShowMarkdownHelp=true}l()};e.addSpinner({"float":"right"});StackExchange.using("editor",i)})}function lazyEditorReady(d,c,a){prepareEditor({heartbeatType:d,bindNavPrevention:c,onDemand:true})}jQuery.cookie=function(l,a,d){if(typeof a!="undefined"){d=d||{};if(a===null){a="";d.expires=-1}var c="";if(d.expires&&(typeof d.expires=="number"||d.expires.toUTCString)){var g;if(typeof d.expires=="number"){g=new Date();g.setTime(g.getTime()+(d.expires*24*60*60*1000))}else{g=d.expires}c="; expires="+g.toUTCString()}var h=d.path?"; path="+(d.path):"";var k=d.domain?"; domain="+(d.domain):"";var o=d.secure?"; secure":"";document.cookie=[l,"=",encodeURIComponent(a),c,h,k,o].join("")}else{var n=null;if(document.cookie&&document.cookie!=""){var j=document.cookie.split(";");for(var e=0;e<j.length;e++){var f=jQuery.trim(j[e]);if(f.substring(0,l.length+1)==(l+"=")){n=decodeURIComponent(f.substring(l.length+1));break}}}return n}};jQuery.expr[":"].regex=function(a,h,d){var c=d[3].split(","),e=/^(data|css):/,g={method:c[0].match(e)?c[0].split(":")[0]:"attr",property:c.shift().replace(e,"")},f="ig",i=new RegExp(c.join("").replace(/^\s+|\s+$/g,""),f);return i.test(jQuery(a)[g.method](g.property))};$.extend($.expr[":"],{containsExact:function(d,c,e){return $.trim(d.innerHTML.toLowerCase())===e[3].toLowerCase()},containsExactCase:function(d,c,e){return $.trim(d.innerHTML)===e[3]},containsRegex:function(d,c,f){var e=/^\/((?:\\\/|[^\/])+)\/([mig]{0,3})$/,g=e.exec(f[3]);return RegExp(g[1],g[2]).test($.trim(d.innerHTML))}});$.extend({URLEncode:function(i){var g="";var e=0;i=i.toString();var j=/(^[a-zA-Z0-9_.]*)/;while(e<i.length){var f=j.exec(i.substr(e));if(f!=null&&f.length>1&&f[1]!=""){g+=f[1];e+=f[1].length}else{if(i[e]==" "){g+="+"}else{var k=i.charCodeAt(e);var a=k.toString(16);g+="%"+(a.length<2?"0":"")+a.toUpperCase()}e++}}return g},URLDecode:function(d){var a=d;var f,e;var c=/(%[^%]{2})/;while((m=c.exec(a))!=null&&m.length>1&&m[1]!=""){b=parseInt(m[1].substr(1),16);e=String.fromCharCode(b);a=a.replace(m[1],e)}return a}});(function(a){a.fn.typeWatch=function(c){var f=a.extend({wait:750,callback:function(){},highlight:true,captureLength:2},c);function d(g,h){var i=a(g.el).val();if((i.length>f.captureLength&&i.toUpperCase()!=g.text)||(h&&i.length>f.captureLength)){g.text=i.toUpperCase();g.cb(i)}}function e(i){if(i.type.toUpperCase()=="TEXT"||i.nodeName.toUpperCase()=="TEXTAREA"){var g={timer:null,text:a(i).val().toUpperCase(),cb:f.callback,el:i,wait:f.wait};if(f.highlight){a(i).focus(function(){this.select()})}var h=function(n){var k=g.wait;var l=false;if(n.keyCode==13&&this.type.toUpperCase()=="TEXT"){k=1;l=true}var j=function(){d(g,l)};clearTimeout(g.timer);g.timer=setTimeout(j,k)};a(i).keydown(h)}}return this.each(function(g){e(this)})}})(jQuery);(function(e){e.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(g,f){e.fx.step[f]=function(h){if(!h.colorInit){h.start=d(h.elem,f);h.end=c(h.end);h.colorInit=true}h.elem.style[f]="rgb("+[Math.max(Math.min(parseInt((h.pos*(h.end[0]-h.start[0]))+h.start[0]),255),0),Math.max(Math.min(parseInt((h.pos*(h.end[1]-h.start[1]))+h.start[1]),255),0),Math.max(Math.min(parseInt((h.pos*(h.end[2]-h.start[2]))+h.start[2]),255),0)].join(",")+")"}});function c(f){var g;if(f&&f.constructor==Array&&f.length==3){return f}if(g=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(f)){return[parseInt(g[1]),parseInt(g[2]),parseInt(g[3])]}if(g=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(f)){return[parseFloat(g[1])*2.55,parseFloat(g[2])*2.55,parseFloat(g[3])*2.55]}if(g=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(f)){return[parseInt(g[1],16),parseInt(g[2],16),parseInt(g[3],16)]}if(g=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(f)){return[parseInt(g[1]+g[1],16),parseInt(g[2]+g[2],16),parseInt(g[3]+g[3],16)]}if(g=/rgba\(0, 0, 0, 0\)/.exec(f)){return a.transparent}return a[e.trim(f).toLowerCase()]}function d(h,g){var f;do{f=e.curCSS(h,g);if(f!=""&&f!="transparent"||e.nodeName(h,"body")){break}g="backgroundColor"}while(h=h.parentNode);return c(f)}var a={}})(jQuery);