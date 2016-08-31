/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/app/themes/sage/dist/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/*!******************!*\
  !*** multi main ***!
  \******************/
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(/*! ./scripts/util/public-path.js */3);
	__webpack_require__(/*! ./scripts/main.js */4);
	module.exports = __webpack_require__(/*! ./styles/main.scss */9);


/***/ },
/* 1 */,
/* 2 */
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ function(module, exports) {

	module.exports = jQuery;

/***/ },
/* 3 */
/*!*************************************!*\
  !*** ./scripts/util/public-path.js ***!
  \*************************************/
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	
	/* globals WEBPACK_PUBLIC_PATH */
	
	// Dynamically set absolute public path from current protocol and host
	if (false) {
	  /* eslint-disable no-undef */
	  __webpack_public_path__ = location.protocol + '//' + location.host + WEBPACK_PUBLIC_PATH;
	  /*eslint-enable no-undef*/
	}

/***/ },
/* 4 */
/*!*************************!*\
  !*** ./scripts/main.js ***!
  \*************************/
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';
	
	__webpack_require__(/*! jquery */ 2);
	
	var _router = __webpack_require__(/*! ./util/router */ 5);
	
	var _router2 = _interopRequireDefault(_router);
	
	var _Common = __webpack_require__(/*! ./routes/Common */ 6);
	
	var _Common2 = _interopRequireDefault(_Common);
	
	var _Home = __webpack_require__(/*! ./routes/Home */ 7);
	
	var _Home2 = _interopRequireDefault(_Home);
	
	var _About = __webpack_require__(/*! ./routes/About */ 8);
	
	var _About2 = _interopRequireDefault(_About);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	// Use this variable to set up the common and page specific functions. If you
	// rename this variable, you will also need to rename the namespace below.
	
	
	// import local dependencies
	var routes = {
	  // All pages
	  common: _Common2.default,
	  // Home page
	  home: _Home2.default,
	  // About us page, note the change from about-us to about_us.
	  about_us: _About2.default
	};
	
	// Load Events
	// import external dependencies
	$(document).ready(function () {
	  return new _router2.default(routes).loadEvents();
	});
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(/*! jquery */ 2)))

/***/ },
/* 5 */
/*!********************************!*\
  !*** ./scripts/util/router.js ***!
  \********************************/
/***/ function(module, exports) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	
	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();
	
	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
	
	/* ========================================================================
	 * DOM-based Routing
	 * Based on http://goo.gl/EUTi53 by Paul Irish
	 *
	 * Only fires on body classes that match. If a body class contains a dash,
	 * replace the dash with an underscore when adding it to the object below.
	 * ======================================================================== */
	
	// The routing fires all common scripts, followed by the page specific scripts.
	// Add additional events for more control over timing e.g. a finalize event
	var Router = function () {
	  function Router(routes) {
	    _classCallCheck(this, Router);
	
	    this.routes = routes;
	  }
	
	  _createClass(Router, [{
	    key: 'fire',
	    value: function fire(route) {
	      var fn = arguments.length <= 1 || arguments[1] === undefined ? 'init' : arguments[1];
	      var args = arguments[2];
	
	      var fire = route !== '' && this.routes[route] && typeof this.routes[route][fn] === 'function';
	      if (fire) {
	        this.routes[route][fn](args);
	      }
	    }
	  }, {
	    key: 'loadEvents',
	    value: function loadEvents() {
	      var _this = this;
	
	      // Fire common init JS
	      this.fire('common');
	
	      // Fire page-specific init JS, and then finalize JS
	      document.body.className.replace(/-/g, '_').split(/\s+/).forEach(function (className) {
	        _this.fire(className);
	        _this.fire(className, 'finalize');
	      });
	
	      // Fire common finalize JS
	      this.fire('common', 'finalize');
	    }
	  }]);
	
	  return Router;
	}();
	
	exports.default = Router;

/***/ },
/* 6 */
/*!**********************************!*\
  !*** ./scripts/routes/Common.js ***!
  \**********************************/
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.default = {
	  init: function init() {
	    // JavaScript to be fired on all pages
	
	    // Remove empty p tags
	    $('p:empty').remove();
	
	    // External links
	    $('a').filter(function () {
	      return this.hostname && this.hostname !== location.hostname;
	    }).addClass('external').attr('target', '_blank');
	  },
	  finalize: function finalize() {
	    // JavaScript to be fired on all pages, after page specific JS is fired
	  }
	};
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(/*! jquery */ 2)))

/***/ },
/* 7 */
/*!********************************!*\
  !*** ./scripts/routes/Home.js ***!
  \********************************/
/***/ function(module, exports) {

	"use strict";
	
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.default = {
	  init: function init() {
	    // JavaScript to be fired on the home page
	  },
	  finalize: function finalize() {
	    // JavaScript to be fired on the home page, after the init JS
	  }
	};

/***/ },
/* 8 */
/*!*********************************!*\
  !*** ./scripts/routes/About.js ***!
  \*********************************/
/***/ function(module, exports) {

	"use strict";
	
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.default = {
	  init: function init() {
	    // JavaScript to be fired on the about us page
	  }
	};

/***/ },
/* 9 */
/*!**************************!*\
  !*** ./styles/main.scss ***!
  \**************************/
/***/ function(module, exports) {

	// removed by extract-text-webpack-plugin

/***/ }
/******/ ]);
//# sourceMappingURL=main.js.map