/**
 * tutsResize plugin
 *
 * Copyright (c) 2010 Derek Herman (valendesigns.com)
 * 
 *
 */
(function($) {
 
  $.fn.tutsResize = function(o){
    
    // Extend the default settings
    var s = $.extend({}, $.fn.tutsResize.defaults, o);
    
    // Fire window load event
    $.event.add(window, "load", setContent);
    
    // Fire window resize event with setTimeout()
    var TO = false;
    $(window).resize(function(){
      if(TO !== false)
        clearTimeout(TO);
      TO = setTimeout(setContent, 300);
    });
      
    // Resize the content
    function setContent() {
      var w = $(window).width();
      if (w > '1200') {
        $("link[rel=stylesheet][href='"+s.small_css_path+"']").attr({href : ""+s.large_css_path+""});
        $('img', 'a.sessions_image').attr("src",s.large_sessions_path);
        $.cookie('page_size', 'large', { expires: 7 });
        $("#social_networking").tabs();
        $('#facebook_tab').html('<div class="facebook_wrap"><fb:like-box href="'+s.facebook_url+'" width="296" height="300" stream="false" connections="10"></fb:like-box></div>');
        $('#facebook_tab').css({'border':'1px solid #d8d8d8', 'background':'#fff',});
        FB.XFBML.parse();
        return false;
      } else {
        $("link[rel=stylesheet][href='"+s.large_css_path+"']").attr({href : ""+s.small_css_path+""});
        $('img', 'a.sessions_image').attr("src",s.small_sessions_path);
        $.cookie('page_size', 'small', { expires: 7 });
        $("#social_networking").tabs('destroy');
        $('#facebook_tab').html('<fb:like-box href="'+s.facebook_url+'" width="200" height="300" stream="false" connections="6"></fb:like-box>');
        $('#facebook_tab').css({'border':'none', 'background':'none',});
        FB.XFBML.parse();
        return false;
      }  
    }
    
  };
  
  // Defualts
  $.fn.tutsResize.defaults = {
		small_css_path: "",
		large_css_path: "",
		small_sessions_path: "",
		large_sessions_path: "",
		facebook_url: ""
	};
	
})(jQuery);

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
(function($) {
  $.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
      options = options || {};
      if (value === null) {
        value = '';
        options.expires = -1;
      }
      var expires = '';
      if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
        var date;
        if (typeof options.expires == 'number') {
          date = new Date();
          date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
        } else {
          date = options.expires;
        }
        expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
      }
      // CAUTION: Needed to parenthesize options.path and options.domain
      // in the following expressions, otherwise they evaluate to undefined
      // in the packed version for some reason...
      var path = options.path ? '; path=' + (options.path) : '';
      var domain = options.domain ? '; domain=' + (options.domain) : '';
      var secure = options.secure ? '; secure' : '';
      document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
      var cookieValue = null;
      if (document.cookie && document.cookie != '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
          var cookie = jQuery.trim(cookies[i]);
          // Does this cookie string begin with the name we want?
          if (cookie.substring(0, name.length + 1) == (name + '=')) {
            cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
            break;
          }
        }
      }
      return cookieValue;
    }
  };
})(jQuery);