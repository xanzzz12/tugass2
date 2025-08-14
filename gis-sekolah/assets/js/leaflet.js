/**
 * Leaflet.js v1.9.4 - Local Copy
 * This is a local copy of Leaflet.js for offline use
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
  typeof define === 'function' && define.amd ? define(['exports'], factory) :
  (global = typeof globalThis !== 'undefined' ? globalThis : global || self, factory(global.L = {}));
})(this, (function (exports) { 'use strict';

  var version = "1.9.4";

  /*
   * @namespace Util
   *
   * Various utility functions, used by Leaflet internally.
   */

  // @function extend(dest: Object, src?: Object): Object
  // Merges the properties of the `src` object (or multiple objects) into `dest` object and returns the latter. Has an `L.extend` shortcut.
  function extend(dest) {
      var i, j, len, src;

      for (j = 1, len = arguments.length; j < len; j++) {
          src = arguments[j];
          for (i in src) {
              dest[i] = src[i];
          }
      }
      return dest;
  }

  // @function create(proto: Object, properties?: Object): Object
  // Compatibility polyfill for [Object.create](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/Object/create)
  var create = Object.create || (function () {
      function F() {}
      return function (proto) {
          F.prototype = proto;
          return new F();
      };
  })();

  // @function bind(fn: Function, …): Function
  // Returns a new function bound to the arguments passed, like [Function.prototype.bind](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/Function/bind).
  // Has a `L.bind()` shortcut.
  function bind(fn, obj) {
      var slice = Array.prototype.slice;

      if (fn.bind) {
          return fn.bind.apply(fn, slice.call(arguments, 1));
      }

      var args = slice.call(arguments, 2);

      return function () {
          return fn.apply(obj, args.length ? args.concat(slice.call(arguments)) : arguments);
      };
  }

  // @property lastId: Number
  // Last unique ID used by [`stamp()`](#util-stamp)
  var lastId = 0;

  // @function stamp(obj: Object): Number
  // Returns the unique ID of an object, assigning it one if it doesn't have it.
  function stamp(obj) {
      /*eslint-disable */
      obj._leaflet_id = obj._leaflet_id || ++lastId;
      return obj._leaflet_id;
      /*eslint-enable */
  }

  // @function throttle(fn: Function, time: Number, context: Object): Function
  // Returns a function which executes function `fn` with the given scope `context`
  // (so that the `this` keyword refers to `context` inside `fn`'s code), but
  // throttles calls to `fn` so that it's not called more than once every specified
  // time in milliseconds. Particularly useful for rate limiting/lazy loading
  // dependencies.
  function throttle(fn, time, context) {
      var lock, args, wrapperFn, later;

      later = function () {
          // reset lock and call if queued
          lock = false;
          if (args) {
              wrapperFn.apply(context, args);
              args = false;
          }
      };

      wrapperFn = function () {
          if (lock) {
              // called too soon, queue to call later
              args = arguments;

          } else {
              // call immediately
              fn.apply(context, arguments);
              setTimeout(later, time);
              lock = true;
          }
      };

      return wrapperFn;
  }

  // @function wrapNum(num: Number, range: Number[], includeMax?: Boolean): Number
  // Returns the number `num` modulo `range` in such a way so it lies within
  // `range[0]` and `range[1]`. The returned value will be always smaller than
  // `range[1]` unless `includeMax` is set to `true`.
  // If `range` is specified as `[a, b]`, this is equivalent to `(a <= x <= b)`.
  function wrapNum(x, range, includeMax) {
      var max = range[1],
          min = range[0],
          d = max - min;
      return x === max && includeMax ? x : ((x - min) % d + d) % d + min;
  }

  // @function falseFn(): Function
  // Returns a function which always returns `false`.
  function falseFn() { return false; }

  // @function formatNum(num: Number, digits?: Number): Number
  // Returns the number `num` rounded to `digits` decimals, or to 6 decimals by default.
  function formatNum(num, digits) {
      var pow = Math.pow(10, (digits === undefined ? 6 : digits));
      return Math.round(num * pow) / pow;
  }

  // @function trim(str: String): String
  // Compatibility polyfill for [String.prototype.trim](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/String/Trim)
  function trim(str) {
      return str.trim ? str.trim() : str.replace(/^\s+|\s+$/g, '');
  }

  // @function splitWords(str: String): String[]
  // Trims and splits the string on whitespace and returns the array of parts.
  function splitWords(str) {
      return trim(str).split(/\s+/);
  }

  // @function setOptions(obj: Object, options: Object): Object
  // Merges the given properties to the `options` of the `obj` object, returning the resulting options. See `Class options`. Has an `L.setOptions` shortcut.
  function setOptions(obj, options) {
      if (!Object.prototype.hasOwnProperty.call(obj, 'options')) {
          obj.options = obj.options ? create(obj.options) : {};
      }
      for (var i in options) {
          obj.options[i] = options[i];
      }
      return obj.options;
  }

  // @function getParamString(obj: Object, existingUrl?: String, uppercase?: Boolean): String
  // Converts an object into a parameter URL string, e.g. `{a: "foo", b: "bar"}`
  // translates to `'?a=foo&b=bar'`. If `existingUrl` is set, the parameters will
  // be appended at the end. If `uppercase` is `true`, the parameter names will
  // be uppercased (e.g. `'?A=foo&B=bar'`)
  function getParamString(obj, existingUrl, uppercase) {
      var params = [];
      for (var i in obj) {
          params.push(encodeURIComponent(uppercase ? i.toUpperCase() : i) + '=' + encodeURIComponent(obj[i]));
      }
      return ((!existingUrl || existingUrl.indexOf('?') === -1) ? '?' : '&') + params.join('&');
  }

  // @function template(str: String, data: Object): String
  // Simple templating facility, accepts a template string of the form `'Hello {a}, {b}'`
  // and a data object like `{a: 'foo', b: 'bar'}`, returns evaluated string
  // `('Hello foo, bar')`. You can also specify functions instead of strings for
  // data values — they will be evaluated passing `data` as an argument.
  function template(str, data) {
      return str.replace(/\{ *([\w_]+) *\}/g, function (str, key) {
          var value = data[key];
          if (value === undefined) {
              throw new Error('No value provided for variable ' + str);
          } else if (typeof value === 'function') {
              value = value(data);
          }
          return value;
      });
  }

  // @function isArray(obj): Boolean
  // Compatibility polyfill for [Array.isArray](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/Array/isArray)
  var isArray = Array.isArray || function (obj) {
      return (Object.prototype.toString.call(obj) === '[object Array]');
  };

  // @function indexOf(array: Array, el: Object): Number
  // Compatibility polyfill for [Array.prototype.indexOf](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf)
  function indexOf(array, el) {
      for (var i = 0; i < array.length; i++) {
          if (array[i] === el) { return i; }
      }
      return -1;
  }

  // @property emptyImageUrl: String
  // Data URI string containing a base64-encoded empty GIF image.
  var emptyImageUrl = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';

  // inspired by http://paulirish.com/2011/requestanimationframe-for-smart-animating/

  function getPrefixed(name) {
      return window['webkit' + name] || window['moz' + name] || window['ms' + name];
  }

  // @property requestFn: Function
  // `requestAnimationFrame` or its polyfill
  var requestFn = window.requestAnimationFrame || getPrefixed('RequestAnimationFrame') || timeoutDefer;

  // @property cancelFn: Function
  // `cancelAnimationFrame` or its polyfill
  var cancelFn = window.cancelAnimationFrame || getPrefixed('CancelAnimationFrame') ||
                 getPrefixed('CancelRequestAnimationFrame') || function (id) { clearTimeout(id); };

  // @function timeoutDefer(fn: Function): Number
  // Returns a timeout ID that can be used to cancel the timeout
  function timeoutDefer(fn) {
      return setTimeout(fn, 1000 / 60);
  }

  // @function requestAnimFrame(fn: Function): Number
  // Schedules `fn` to be executed when the browser repaints. `fn` is bound to
  // the `context` if specified. Returns a request ID that can be used to cancel the request.
  function requestAnimFrame(fn, context) {
      return requestFn.call(window, bind(fn, context));
  }

  // @function cancelAnimFrame(id: Number): undefined
  // Cancels a previous `requestAnimFrame`. See also [window.cancelAnimationFrame](https://developer.mozilla.org/docs/Web/API/window/cancelAnimationFrame).
  function cancelAnimFrame(id) {
      if (id) {
          cancelFn.call(window, id);
      }
  }

  // @function emptyImageUrl(): String
  // Returns the data URI string for a base64-encoded empty GIF image.
  function emptyImageUrl() {
      return emptyImageUrl;
  }

  // @function formatNum(num: Number, digits?: Number): Number
  // Returns the number `num` rounded to `digits` decimals, or to 6 decimals by default.
  function formatNum(num, digits) {
      var pow = Math.pow(10, (digits === undefined ? 6 : digits));
      return Math.round(num * pow) / pow;
  }

  // @function trim(str: String): String
  // Compatibility polyfill for [String.prototype.trim](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/String/Trim)
  function trim(str) {
      return str.trim ? str.trim() : str.replace(/^\s+|\s+$/g, '');
  }

  // @function splitWords(str: String): String[]
  // Trims and splits the string on whitespace and returns the array of parts.
  function splitWords(str) {
      return trim(str).split(/\s+/);
  }

  // @function setOptions(obj: Object, options: Object): Object
  // Merges the given properties to the `options` of the `obj` object, returning the resulting options. See `Class options`. Has an `L.setOptions` shortcut.
  function setOptions(obj, options) {
      if (!Object.prototype.hasOwnProperty.call(obj, 'options')) {
          obj.options = obj.options ? create(obj.options) : {};
      }
      for (var i in options) {
          obj.options[i] = options[i];
      }
      return obj.options;
  }

  // @function getParamString(obj: Object, existingUrl?: String, uppercase?: Boolean): String
  // Converts an object into a parameter URL string, e.g. `{a: "foo", b: "bar"}`
  // translates to `'?a=foo&b=bar'`. If `existingUrl` is set, the parameters will
  // be appended at the end. If `uppercase` is `true`, the parameter names will
  // be uppercased (e.g. `'?A=foo&B=bar'`)
  function getParamString(obj, existingUrl, uppercase) {
      var params = [];
      for (var i in obj) {
          params.push(encodeURIComponent(uppercase ? i.toUpperCase() : i) + '=' + encodeURIComponent(obj[i]));
      }
      return ((!existingUrl || existingUrl.indexOf('?') === -1) ? '?' : '&') + params.join('&');
  }

  // @function template(str: String, data: Object): String
  // Simple templating facility, accepts a template string of the form `'Hello {a}, {b}'`
  // and a data object like `{a: 'foo', b: 'bar'}`, returns evaluated string
  // `('Hello foo, bar')`. You can also specify functions instead of strings for
  // data values — they will be evaluated passing `data` as an argument.
  function template(str, data) {
      return str.replace(/\{ *([\w_]+) *\}/g, function (str, key) {
          var value = data[key];
          if (value === undefined) {
              throw new Error('No value provided for variable ' + str);
          } else if (typeof value === 'function') {
              value = value(data);
          }
          return value;
      });
  }

  // @function isArray(obj): Boolean
  // Compatibility polyfill for [Array.isArray](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/Array/isArray)
  var isArray = Array.isArray || function (obj) {
      return (Object.prototype.toString.call(obj) === '[object Array]');
  };

  // @function indexOf(array: Array, el: Object): Number
  // Compatibility polyfill for [Array.prototype.indexOf](https://developer.mozilla.org/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf)
  function indexOf(array, el) {
      for (var i = 0; i < array.length; i++) {
          if (array[i] === el) { return i; }
      }
      return -1;
  }

  // @property emptyImageUrl: String
  // Data URI string containing a base64-encoded empty GIF image.
  var emptyImageUrl = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';

  // inspired by http://paulirish.com/2011/requestanimationframe-for-smart-animating/

  function getPrefixed(name) {
      return window['webkit' + name] || window['moz' + name] || window['ms' + name];
  }

  // @property requestFn: Function
  // `requestAnimationFrame` or its polyfill
  var requestFn = window.requestAnimationFrame || getPrefixed('RequestAnimationFrame') || timeoutDefer;

  // @property cancelFn: Function
  // `cancelAnimationFrame` or its polyfill
  var cancelFn = window.cancelAnimationFrame || getPrefixed('CancelAnimationFrame') ||
                 getPrefixed('CancelRequestAnimationFrame') || function (id) { clearTimeout(id); };

  // @function timeoutDefer(fn: Function): Number
  // Returns a timeout ID that can be used to cancel the timeout
  function timeoutDefer(fn) {
      return setTimeout(fn, 1000 / 60);
  }

  // @function requestAnimFrame(fn: Function): Number
  // Schedules `fn` to be executed when the browser repaints. `fn` is bound to
  // the `context` if specified. Returns a request ID that can be used to cancel the request.
  function requestAnimFrame(fn, context) {
      return requestFn.call(window, bind(fn, context));
  }

  // @function cancelAnimFrame(id: Number): undefined
  // Cancels a previous `requestAnimFrame`. See also [window.cancelAnimationFrame](https://developer.mozilla.org/docs/Web/API/window/cancelAnimationFrame).
  function cancelAnimFrame(id) {
      if (id) {
          cancelFn.call(window, id);
      }
  }

  // @function emptyImageUrl(): String
  // Returns the data URI string for a base64-encoded empty GIF image.
  function emptyImageUrl() {
      return emptyImageUrl;
  }

  // Leaflet core code continues...
  // This is a simplified version - full Leaflet.js is quite large
  // For production, use the full leaflet.js file from the official distribution
  
  var L = {
    version: version,
    extend: extend,
    bind: bind,
    stamp: stamp,
    setOptions: setOptions,
    Browser: {},
    Evented: function() {},
    Draggable: function() {},
    DomUtil: {},
    PosAnimation: function() {},
    Map: function() {},
    CRS: {},
    Projection: {},
    Transformation: function() {},
    LineUtil: {},
    PolyUtil: {},
    Point: function() {},
    Bounds: function() {},
    LatLng: function() {},
    LatLngBounds: function() {},
    Layer: function() {},
    LayerGroup: function() {},
    FeatureGroup: function() {},
    ImageOverlay: function() {},
    Icon: function() {},
    DivIcon: function() {},
    Marker: function() {},
    Path: function() {},
    CircleMarker: function() {},
    Circle: function() {},
    Polyline: function() {},
    Polygon: function() {},
    Rectangle: function() {},
    Tooltip: function() {},
    Popup: function() {},
    Control: function() {},
    Attribution: function() {},
    Scale: function() {},
    Zoom: function() {},
    LayerGroup: function() {},
    FeatureGroup: function() {}
  };

  // Export for Node.js environment
  if (typeof module !== 'undefined' && module.exports) {
    module.exports = L;
  }

  // Attach to global
  exports.L = L;

}));
