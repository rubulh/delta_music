// jsUri library http://code.google.com/p/jsuri/
jsUri=function(a){if(a==undefined){a=""}this._uri=this.parseUri(a);this._query=new jsUri.query(this._uri.query)};jsUri.options={strictMode:false,key:["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],q:{name:"queryKey",parser:/(?:^|&)([^&=]*)=?([^&]*)/g},parser:{strict:/^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,loose:/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/}};jsUri.prototype={};jsUri.prototype.parseUri=function(e){var d=jsUri.options,a=d.parser[d.strictMode?"strict":"loose"].exec(e),c={},b=14;while(b--){c[d.key[b]]=a[b]||""}c[d.q.name]={};c[d.key[12]].replace(d.q.parser,function(g,f,h){if(f){c[d.q.name][f]=h}});return c};jsUri.prototype.toString=function(){var a="";var b=function(c){return(c!=null&&c!="")};if(b(this.protocol)){a+=this.protocol;if(this.protocol.indexOf(":")!=this.protocol.length-1){a+=":"}a+="//"}else{if(this.hasAuthorityPrefix&&b(this.host)){a+="//"}}if(b(this.userInfo)&&b(this.host)){a+=this.userInfo;if(this.userInfo.indexOf("@")!=this.userInfo.length-1){a+="@"}}if(b(this.host)){a+=this.host;if(b(this.port)){a+=":"+this.port}}if(b(this.path)){a+=this.path}else{if(b(this.host)&&(b(this.query.toString())||b(this.anchor))){a+="/"}}if(b(this.query.toString())){if(this.query.toString().indexOf("?")!=0){a+="?"}a+=this.query.toString()}if(b(this.anchor)){if(this.anchor.indexOf("#")!=0){a+="#"}a+=this.anchor}return a};jsUri.prototype.__defineGetter__("protocol",function(){return this._uri.protocol});jsUri.prototype.__defineSetter__("protocol",function(a){this._uri.protocol=a});jsUri.prototype.__defineGetter__("hasAuthorityPrefix",function(){if(this._hasAuthorityPrefix==null){return(this._uri.source.indexOf("//")!=-1)}return this._hasAuthorityPrefix});jsUri.prototype.__defineSetter__("hasAuthorityPrefix",function(a){this._hasAuthorityPrefix=a});jsUri.prototype.__defineGetter__("userInfo",function(){return this._uri.userInfo});jsUri.prototype.__defineSetter__("userInfo",function(a){this._uri.userInfo=a});jsUri.prototype.__defineGetter__("host",function(){return this._uri.host});jsUri.prototype.__defineSetter__("host",function(a){this._uri.host=a});jsUri.prototype.__defineGetter__("port",function(){return this._uri.port});jsUri.prototype.__defineSetter__("port",function(a){this._uri.port=a});jsUri.prototype.__defineGetter__("path",function(){return this._uri.path});jsUri.prototype.__defineSetter__("path",function(a){this._uri.path=a});jsUri.prototype.__defineGetter__("query",function(){return this._query});jsUri.prototype.__defineSetter__("query",function(a){this._query=new jsUri.query(a)});jsUri.prototype.__defineGetter__("anchor",function(){return this._uri.anchor});jsUri.prototype.__defineSetter__("anchor",function(a){this._uri.anchor=a});jsUri.prototype.setProtocol=function(a){this.protocol=a;return this};jsUri.prototype.setHasAuthorityPrefix=function(a){this.hasAuthorityPrefix=a;return this};jsUri.prototype.setUserInfo=function(a){this.userInfo=a;return this};jsUri.prototype.setHost=function(a){this.host=a;return this};jsUri.prototype.setPort=function(a){this.port=a;return this};jsUri.prototype.setPath=function(a){this.path=a;return this};jsUri.prototype.setQuery=function(a){this.query=a;return this};jsUri.prototype.setAnchor=function(a){this.anchor=a;return this};jsUri.query=function(a){this.params=this.parseQuery(a)};jsUri.query.prototype={};jsUri.query.prototype.toString=function(){var a="";for(var c in this.params){var d=this.params[c];var b=d.join("=");if(a.length>0){a+="&"}a+=d.join("=")}return a};jsUri.query.prototype.parseQuery=function(c){var a=[];if(c==null||c==""){return a}var f=c.toString().split(/[&;]/);for(var d in f){var e=f[d];var b=e.split("=");a.push([b[0],b[1]])}return a};jsUri.query.prototype.decode=function(a){a=decodeURIComponent(a);a=a.replace("+"," ");return a};jsUri.prototype.getQueryParamValue=function(a){for(var b in this.query.params){var c=this.query.params[b];if(this.query.decode(a)==this.query.decode(c[0])){return c[1]}}};jsUri.prototype.getQueryParamValues=function(b){var a=[];for(var c in this.query.params){var d=this.query.params[c];if(this.query.decode(b)==this.query.decode(d[0])){a.push(d[1])}}return a};jsUri.prototype.deleteQueryParam=function(b,e){var a=[];for(var c in this.query.params){var d=this.query.params[c];if(arguments.length==2&&this.query.decode(d[0])==this.query.decode(b)&&this.query.decode(d[1])==this.query.decode(e)){continue}else{if(arguments.length==1&&this.query.decode(d[0])==this.query.decode(b)){continue}}a.push(d)}this.query.params=a;return this};jsUri.prototype.addQueryParam=function(b,c,a){if(arguments.length==3&&a!=-1){a=Math.min(a,this.query.params.length);this.query.params.splice(a,0,[b,c])}else{if(arguments.length>0){this.query.params.push([b,c])}}return this};jsUri.prototype.replaceQueryParam=function(d,c,a){if(arguments.length==3){var b=-1;for(var e in this.query.params){var f=this.query.params[e];if(this.query.decode(f[0])==this.query.decode(d)&&decodeURIComponent(f[1])==this.query.decode(a)){b=e;break}}return this.deleteQueryParam(d,a).addQueryParam(d,c,b)}else{var b=-1;for(var e in this.query.params){var f=this.query.params[e];if(this.query.decode(f[0])==this.query.decode(d)){b=e;break}}return this.deleteQueryParam(d).addQueryParam(d,c,b)}};jsUri.prototype.clone=function(){return new jsUri(this.toString())};

// custom url rewriter (marketplace referral tracking) for tuts+ blog network, usage:
//   MarketplaceUrlRewriter.rewrite_urls({host: 'a blog hostname', target: dom_element_reference})
//
// author: ryan allen (ryan@envato.com)
var MarketplaceUrlRewriter = (function() {
  a = 1
  return {
    marketplaces: [
      'activeden.net', 
      'audiojungle.net',
      'graphicriver.net',
      'themeforest.net',
      'videohive.net',
      '3docean.net',
      'codecanyon.net',
      'marketplace.tutsplus.com'
    ],

    blogs: {
      'psd.tutsplus.com'       : 'PsdPremium',
      'net.tutsplus.com'       : 'NetPremium',
      'vector.tutsplus.com'    : 'VectorPremium',
      'audio.tutsplus.com'     : 'AudioPremium',
      'ae.tutsplus.com'        : 'AePremium',
      'cg.tutsplus.com'        : 'CgPremium',
      'active.tutsplus.com'    : 'ActivePremium',
      'photo.tutsplus.com'     : 'PhotoPremium',
      'mobile.tutsplus.com'    : 'MobilePremium',
      'webdesign.tutsplus.com' : 'WebPremium'
    },

    links: function() {
      return $(this.target).find('a')
    },

    marketplace_links: function() {
      var matches = [] // no collect
      var that = this // lol jquery this fail
      this.links().each(function(i, link) {
        var href = $(link).attr('href')
        $(that.marketplaces).each(function(j, marketplace) {
          if (new RegExp('^http://' + marketplace, 'i').test(href)) {
            matches.push(link)
          }
        })
      })
      return $(matches)
    },

    on_a_blog: function() {
      return Boolean(this.referral_username())
    },

    add_refferal_username_to_link: function(link) {
      var link = $(link)
      var uri = new jsUri(link.attr('href'))
      link.attr('href', uri.replaceQueryParam('ref', this.referral_username()).toString())
    },

    referral_username: function() {
      return this.blogs[this.host]
    },

    rewrite_urls: function(config) {
      this.host = config.host
      this.target = config.target
      var that = this // ugh, functional fail, again

      if (this.on_a_blog()) {
        this.marketplace_links().each(function(n, link) {
          that.add_refferal_username_to_link(link)
        })
      }
    },
  }
})()
