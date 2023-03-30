'use strict';

(function() {
  var convertStr = function(str) {
    if (typeof str === 'undefined') return;
    var _str = str.toLowerCase();
    return _str.replace(/\s/g, '');
  };
  var Detect = function() {
    var _parser = new UAParser();
    this.parser = _parser.getResult();
  };
  Detect.prototype.getBrowserName = function() {
    var _str = convertStr(this.parser.browser.name);
    return _str;
  };
  Detect.prototype.getBrowserVer = function() {
    return this.parser.browser.major;
  };
  Detect.prototype.getDeviceType = function() {
    var _str = convertStr(this.parser.device.type);
    if (typeof _str === 'undefined') {
      _str = 'pc';
    }
    return _str;
  };
  Detect.prototype.getOsName = function() {
    var _str = convertStr(this.parser.os.name);
    return _str;
  };
  Detect.prototype.getOsVer = function() {
    return this.parser.os.version;
  };
  Detect.prototype.createUaObj = function() {
    var _ua = {};
    _ua.device = this.getDeviceType();
    _ua.os = this.getOsName();
    _ua.osVer = this.getOsVer();
    _ua.browser = this.getBrowserName();
    _ua.browserVer = this.getBrowserVer();
    return _ua;
  };
  Detect.prototype.setAttribute = function(uaObj) {
    var _rootElm = document.documentElement;
    Object.keys(uaObj).forEach(function(key) {
      var _attr = 'data-' + key.replace('Ver', '-ver');
      _rootElm.setAttribute(_attr, uaObj[key]);
    });
  };
  Detect.prototype.init = function() {
    var _ua = this.createUaObj();
    window.ua = _ua;
    this.setAttribute(_ua);
  };
  var detect = new Detect();
  detect.init();
})();

(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], function($) {
      return factory(root, $);
    });
  } else if (typeof exports === 'object') {
    factory(root, require('jquery'));
  } else {
    root.Shared = factory(root, root.jQuery);
  }
})(this, function(global, $) {
  var _browser = (function() {
    var _passiveSupported = false;
    var _passiveOption;
    try {
      global.addEventListener(
        'test',
        null,
        Object.defineProperty({}, 'passive', {
          // eslint-disable-next-line getter-return
          get: function() {
            _passiveSupported = true;
          },
        })
      );
      // eslint-disable-next-line no-empty
    } catch (err) {}
    _passiveOption = _passiveSupported ? { passive: false } : false;

    return {
      passiveSupported: _passiveSupported,
      passiveOption: _passiveOption,
    };
  })();

  var _util = (function() {
    var _string = (function() {
      var _zeroPad = function(number, digit) {
        var _str;
        var _len;
        if (typeof number === 'number' && typeof digit === 'number') {
          _len = (number + '').length;
          _str = _len < digit ? (Array(digit + 1).join('0') + number).slice(-digit) : number + '';
        }
        return _str;
      };
      var _unique = function(len, prefix) {
        var _str = '';
        var _len = len === undefined ? 24 : len;
        var _prefix = prefix === undefined ? '_' : prefix;
        for (var i = 1; i < _len + 1; i += 8) {
          _str += Math.random()
            .toString(36)
            .substr(2, 10);
        }
        return (_prefix + _str).substr(0, _len);
      };
      var _zen2han = function(str) {
        var _str = typeof str === 'undefined' ? '' : str;
        var alphanumeric = function(s) {
          return String.fromCharCode(s.charCodeAt(0) - 0xfee0);
        };
        _str = _str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, alphanumeric);
        _str = _str.replace(/[−―‐ー]/g, '-');
        _str = _str.replace(/[～〜]/g, '~');
        _str = _str.replace(/＠/g, '@');
        _str = _str.replace(/[\t\s　]/g, ' ');
        return _str;
      };
      var _ellipsis = function(str, limit) {
        var _str = typeof str === 'undefined' ? '' : str;
        var _result = _str.replace(/[\n|\r\n|\r]/g, '');
        var _width = 0;
        var _len = _result.length;

        for (var i = 0; i < _len; i++) {
          if (!(_result.charAt(i).match(/[ -~]/) || _result.charAt(i).match(/^[ｦ-ﾟ]/))) {
            _width += 2;
          } else {
            _width += 1;
          }
          if (_width > limit) {
            _result = _result.substr(0, i) + '...';
            break;
          }
        }
        return _result;
      };
      var _escape = function(str) {
        return str
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#39;')
          .replace(/`/g, '&#x60;');
      };
      var _unescape = function(str) {
        return str
          .replace(/&lt;/g, '<')
          .replace(/&gt;/g, '>')
          .replace(/&quot;/g, '"')
          .replace(/&#39;/g, "'")
          .replace(/&#x60;/g, '`')
          .replace(/&amp;/g, '&');
      };
      return {
        zeroPad: _zeroPad,
        unique: _unique,
        zen2han: _zen2han,
        ellipsis: _ellipsis,
        escape: _escape,
        unescape: _unescape,
      };
    })();

    var _url = (function() {
      var _parse = function(arg) {
        var _p = [
          'source',
          'protocol',
          'authority',
          'userInfo',
          'user',
          'password',
          'host',
          'port',
          'relative',
          'path',
          'directory',
          'file',
          'query',
          'anchor',
        ];
        var _r = /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/;
        var _m = _r.exec(arg || global.location.href);
        var _u = {};
        var i = _p.length;

        while (i--) {
          _u[_p[i]] = _m[i] || '';
        }
        return _u;
      };
      var _parseParam = function(arg) {
        var _param = {};
        var _arg = typeof arg === 'undefined' ? global.location.search : arg;
        if (_arg && _arg.indexOf('?') !== -1) {
          _arg = _arg.split('?')[1];
        } else {
          _arg = false;
        }
        if (_arg) {
          var _f = _arg.replace('&amp;', '&').split('&');

          for (var i = 0; i < _f.length; i++) {
            if (_f[i].indexOf('=') !== -1) {
              var _p = _f[i].split('=');
              _param[_p[0]] = _p[1];
            } else {
              _param[_f[i]] = '';
            }
          }
        }
        return _param;
      };
      var _fixedEncodeURIComponent = function(str) {
        return encodeURIComponent(str).replace(/[!'()*]/g, function(s) {
          return '%' + s.charCodeAt(0).toString(16);
        });
      };
      var _getCurrentDir = function(baseName) {
        var _directory = _parse().directory;
        var _baseDir;
        var _rStart = /^\//;
        var _rLast = /\/$/;
        var _s;
        var _l;
        if (baseName) {
          _s = _rStart.test(baseName) ? '' : '/';
          _l = _rLast.test(baseName) ? '' : '/';
          _baseDir = _s + baseName + _l;
          if (_directory.indexOf(_baseDir) !== -1) {
            _directory = '/' + _directory.split(_baseDir)[1];
          }
        }
        var _r = /^\/(.*?)\//;
        var _m = _r.exec(_directory);
        var _name;
        if (_m === null) {
          _name = '';
        } else {
          _name = _m[1];
        }
        return _name;
      };
      return {
        parse: _parse,
        parseParam: _parseParam,
        fixedEncodeURIComponent: _fixedEncodeURIComponent,
        getCurrentDir: _getCurrentDir,
      };
    })();

    var _getWindowSize = function() {
      var _w = 0;
      var _h = 0;
      if (typeof global.innerWidth === 'number') {
        _w = Math.min(global.innerWidth, global.document.documentElement.clientWidth);
        _h = global.innerHeight;
      } else {
        _w = global.document.documentElement.clientWidth;
        _h = global.document.documentElement.clientHeight;
      }
      return { w: _w, h: _h };
    };
    var _getScrollBarSize = function() {
      var _scrollbarWidth;
      var _outerDummy = window.document.createElement('div');
      var _innerDummy = window.document.createElement('div');
      var _outerDummyWidth;
      var _innerDummyWidth;
      window.document.body.appendChild(_outerDummy);
      _outerDummy.style.visibility = 'hidden';
      _outerDummy.style.width = '100px';
      _outerDummy.style.border = 'none';
      _outerDummy.style.overflow = 'scroll';
      _innerDummy.style.width = '100%';
      _outerDummy.appendChild(_innerDummy);
      _outerDummyWidth = _outerDummy.offsetWidth;
      _innerDummyWidth = _innerDummy.offsetWidth;
      _outerDummy.parentNode.removeChild(_outerDummy);
      _scrollbarWidth = _outerDummyWidth - _innerDummyWidth;
      _scrollbarWidth = _scrollbarWidth || 0;
      return _scrollbarWidth;
    };

    var _getScrollTop = function() {
      var st = 0;
      if ('scrollingElement' in global.document) {
        if (global.document.scrollingElement) {
          st = global.document.scrollingElement.scrollTop;
        }
      } else {
        st = global.document.body.scrollTop || global.document.documentElement.scrollTop;
      }
      return st;
    };
    var _getScrollLeft = function() {
      var sl = 0;
      if ('scrollingElement' in global.document) {
        if (global.document.scrollingElement) {
          sl = global.document.scrollingElement.scrollLeft;
        }
      } else {
        sl = global.document.body.scrollLeft || global.document.documentElement.scrollLeft;
      }
      return sl;
    };
    var _getDocumentHeight = function() {
      return Math.max(
        global.document.body.scrollHeight,
        global.document.documentElement.scrollHeight,
        global.document.body.offsetHeight,
        global.document.documentElement.offsetHeight,
        global.document.body.clientHeight,
        global.document.documentElement.clientHeight
      );
    };
    return {
      string: _string,
      url: _url,
      getWindowSize: _getWindowSize,
      getScrollTop: _getScrollTop,
      getScrollLeft: _getScrollLeft,
      getScrollBarSize: _getScrollBarSize,
      getDocumentHeight: _getDocumentHeight,
    };
  })();

  var _easing = {
    iX2: function(x) {
      return x * x;
    },
    oX2: function(x) {
      return -x * (x - 2);
    },
    ioX2: function(x) {
      return x < 0.5 ? 2 * x * x : 1 - 2 * --x * x;
    },
    oiX2: function(x) {
      return x < 0.5 ? -2 * x * (x - 1) : 1 + 2 * x * (x - 1);
    },
    iX3: function(x) {
      return x * x * x;
    },
    oX3: function(x) {
      return 1 + --x * x * x;
    },
    ioX3: function(x) {
      return x < 0.5 ? 4 * x * x * x : 1 + 4 * --x * x * x;
    },
    iX4: function(x) {
      return x * x * x * x;
    },
    oX4: function(x) {
      return 1 - --x * x * x * x;
    },
    ioX4: function(x) {
      return x < 0.5 ? 8 * x * x * x * x : 1 - 8 * --x * x * x * x;
    },
    iX5: function(x) {
      return x * x * x * x * x;
    },
    oX5: function(x) {
      return 1 + --x * x * x * x * x;
    },
    ioX5: function(x) {
      return x < 0.5 ? 16 * x * x * x * x * x : 1 + 16 * --x * x * x * x * x;
    },
    iExp: function(x) {
      return Math.exp(10 * (x - 1));
    },
    oExp: function(x) {
      return 1 - Math.exp(-10 * x);
    },
    ioExp: function(x) {
      return x < 0.5 ? 0.5 * Math.exp(10 * (x * 2 - 1)) : 1 - 0.5 * Math.exp(-10 * (x - 0.5) * 2);
    },
    iSin: function(x) {
      return 1 - Math.cos((x * Math.PI) / 2);
    },
    oSin: function(x) {
      return Math.sin((x * Math.PI) / 2);
    },
    ioSin: function(x) {
      return 0.5 - 0.5 * Math.cos(x * Math.PI);
    },
    iBack: function(x) {
      var s = 1.8;
      return x * x * ((s + 1) * x - s);
    },
    oBack: function(x) {
      var s = 1.8;
      return 1 + (x - 1) * (x - 1) * ((s + 1) * (x - 1) + s);
    },
    ioBack: function(x) {},
    iCirc: function(x, t, b, c, d) {
      return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b;
    },
    oCirc: function(x, t, b, c, d) {
      return c * Math.sqrt(1 - (t = t / d - 1) * t) + b;
    },
    ioCirc: function(x, t, b, c, d) {
      if ((t /= d / 2) < 1) return (-c / 2) * (Math.sqrt(1 - t * t) - 1) + b;
      return (c / 2) * (Math.sqrt(1 - (t -= 2) * t) + 1) + b;
    },
  };

  if ($) {
    $.extend($.easing, _easing);
  }

  var _event = (function() {
    var Resize = (function() {
      var Resize = function() {
        if (!(this instanceof Resize)) {
          return new Resize();
        }
        var self = this;
        this._listeners = {};
        this._w = 0;
        this._h = 0;
        this._handler = function() {
          var _this = this;
          _this._size = _util.getWindowSize();
          _this._w = _this._size.w;
          _this._h = _this._size.h;
          Object.keys(self._listeners).forEach(function(id) {
            self._listeners[id].callback.call(global, _this._w, _this._h);
          });
        };
        if (global.ua.os === 'ios') {
          global.addEventListener(
            'orientationchange',
            function() {
              setTimeout(this._handler, 400);
            },
            _browser.passiveSupported
          );
        } else {
          global.addEventListener('resize', this._handler, _browser.passiveOption);
        }
      };

      Resize.prototype.add = function(fn, init) {
        if (typeof fn === 'function') {
          this._id = _util.string.unique();
          this._size = _util.getWindowSize();
          this._w = this._size.w;
          this._h = this._size.h;
          this._listeners[this._id] = { callback: fn };
          if (init === undefined || init) {
            fn.call(global, this._w, this._h);
          }
        }
        return this._id;
      };

      Resize.prototype.remove = function(id) {
        if (this._listeners !== null && id in this._listeners) {
          delete this._listeners[id];
        }
      };

      Resize.prototype.trigger = function() {
        var self = this;
        if (self._listeners !== null) {
          self._size = _util.getWindowSize();
          self._w = self._size.w;
          self._h = self._size.h;
          Object.keys(self._listeners).forEach(function(id) {
            self._listeners[id].callback.call(global, self._w, self._h);
          });
        }
      };

      return Resize;
    })();

    var Scroll = (function() {
      var Scroll = function() {
        if (!(this instanceof Scroll)) {
          return new Scroll();
        }
        var self = this;
        this._listeners = {};
        this._t = 0;
        this._b = 0;
        this._l = 0;
        this._r = 0;
        this._handler = function() {
          var _this = this;
          _this._size = _util.getWindowSize();
          _this._t = _util.getScrollTop();
          _this._b = _this._t + _this._size.h;
          _this._l = _util.getScrollLeft();
          _this._r = _this._l + _this._size.w;
          Object.keys(self._listeners).forEach(function(id) {
            self._listeners[id].callback.call(global, _this._t, _this._b, _this._l, _this._r);
          });
        };
        if (global.ua.os === 'ios') {
          global.addEventListener(
            'orientationchange',
            function() {
              setTimeout(this._handler, 400);
            },
            _browser.passiveOption
          );
          global.addEventListener('scroll', this._handler, _browser.passiveOption);
        } else {
          global.addEventListener('resize', this._handler, _browser.passiveOption);
          global.addEventListener('scroll', this._handler, _browser.passiveOption);
        }
        if (Modernizr.touchevents) {
          global.addEventListener('touchmovie', this._handler, _browser.passiveOption);
        }
      };
      Scroll.prototype.add = function(fn, init) {
        if (typeof fn === 'function') {
          this._id = _util.string.unique();
          this._size = _util.getWindowSize();
          this._t = _util.getScrollTop();
          this._b = this._t + this._size.h;
          this._l = _util.getScrollLeft();
          this._r = this._l + this._size.w;
          this._listeners[this._id] = { callback: fn };
          if (init === undefined || init) {
            fn.call(global, this._t, this._b, this._l, this._r);
          }
        }
        return this._id;
      };

      Scroll.prototype.remove = function(id) {
        if (this._listeners !== null && id in this._listeners) {
          delete this._listeners[id];
        }
      };

      Scroll.prototype.trigger = function() {
        var self = this;
        if (self._listeners !== null) {
          self._size = _util.getWindowSize();
          self._t = _util.getScrollTop();
          self._b = self._t + self._size.h;
          self._l = _util.getScrollLeft();
          self._r = self._l + self._size.w;
          Object.keys(self._listeners).forEach(function(id) {
            self._listeners[id].callback.call(global, self._t, self._b, self._l, self._r);
          });
        }
      };

      return Scroll;
    })();

    var Raf = (function() {
      var Raf = function() {
        if (!(this instanceof Raf)) {
          return new Raf();
        }
        var self = this;
        this._listeners = null;
        this._id;
        this._timer = null;
        this._interval = 1000 / 60;
      };
      Raf.prototype.add = function(fn) {
        if (typeof fn === 'function') {
          if (this._listeners === null) {
            this._listeners = {};
          }
          this._id = _util.string.unique();
          this._listeners[this._id] = {
            t0: 0,
            t1: 0,
            anime: true,
            callback: fn,
          };
          var self = this;
          for (var id in this._listeners) {
            this._listeners[id].t0 = +new Date();
            this._listeners[id].t1 = +new Date();
          }
          var tick = function() {
            var ct = +new Date();
            var dt;
            var pt;
            var cnt = 0;
            for (var id in self._listeners) {
              dt = ct - self._listeners[id].t1;
              pt = ct - self._listeners[id].t0;
              self._listeners[id].t1 = ct;
              if (self._listeners[id].anime) {
                if (self._listeners[id].callback.call(global, ct, dt, pt) === false) {
                  delete self._listeners[id];
                }
              }
            }
            for (var id in self._listeners) cnt++;
            if (cnt === 0) {
              global.cancelAnimationFrame(self._timer);
              self._listeners = null;
            } else {
              self._timer = global.requestAnimationFrame(tick, self._interval);
            }
          };

          this._timer = global.requestAnimationFrame(tick, this._interval);
        }
        return this._id;
      };
      Raf.prototype.start = function(id) {
        if (this._listeners !== null && id in this._listeners) {
          this._listeners[id].anime = true;
        }
      };
      Raf.prototype.pause = function(id) {
        if (this._listeners !== null && id in this._listeners) {
          this._listeners[id].anime = false;
        }
      };
      Raf.prototype.off = function(id) {
        if (this._listeners !== null && id in this._listeners) {
          delete this._listeners[id];
        }
      };
      return Raf;
    })();

    var _transitionEnd = function() {
      var transitionEndEvents = ['webkitTransitionEnd', 'mozTransitionEnd', 'oTransitionEnd', 'transitionend'];
      var transitionEndStr = transitionEndEvents.join(' ');
      return transitionEndStr;
    };

    var _animationEnd = function() {
      var animationEndEvents = ['webkitAnimationEnd', 'mozAnimationEnd', 'oAnimationEnd', 'animationend'];
      var animationEndStr = animationEndEvents.join(' ');
      return animationEndStr;
    };

    return {
      resize: new Resize(),
      scroll: new Scroll(),
      raf: new Raf(),
      tEnd: _transitionEnd(),
      aEnd: _animationEnd(),
    };
  })();

  return {
    util: _util,
    event: _event,
  };
});

(function($) {
  $.fn.smoothScroll = function(options) {
    var defaults = {
      duration: 1000,
      easing: 'ioX4',
    };
    var settings = $.extend(defaults, options);

    return this.each(function() {
      var scrolling = false;
      var event = Modernizr.touchevents ? 'touchend' : 'click';

      $(this).on(event, function(e) {
        e.preventDefault();
        scrolling = true;

        var href = $(this).attr('href');
        var target = $(href === '#' || href === '#top' ? $('html,body') : $(href));
        var top = href === '#' || href === '#top' ? 0 : target.offset().top;
        var dur = Math.abs(top - (document.body.scrollTop || document.documentElement.scrollTop));

        if (dur > settings.duration) dur = settings.duration;

        $('html,body')
          .stop()
          .animate(
            { scrollTop: top },
            {
              duration: dur,
              easing: settings.easing,
              always: function() {
                scrolling = false;
              },
            }
          );
      });
    });
  };
  $(function() {
    if ($('.js-scroll')[0]) {
      $('.js-scroll').smoothScroll();
    }
  });
})(jQuery);
