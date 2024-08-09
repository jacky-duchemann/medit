(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.registerWidget = exports.isElement = exports.getSiblings = exports.visible = exports.offset = exports.fadeToggle = exports.fadeOut = exports.fadeIn = exports.slideToggle = exports.slideUp = exports.slideDown = void 0;

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var slideDown = function slideDown(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  var display = window.getComputedStyle(element).display;

  if (display === "none") {
    display = "block";
  }

  element.style.transitionProperty = "height";
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.opacity = 0;
  element.style.display = display;
  var height = element.offsetHeight;
  element.style.height = 0;
  element.style.opacity = 1;
  element.style.overflow = "hidden";
  setTimeout(function () {
    element.style.height = "".concat(height, "px");
  }, 5);
  window.setTimeout(function () {
    element.style.removeProperty("height");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
    element.style.removeProperty("opacity");
  }, duration + 50);
};

exports.slideDown = slideDown;

var slideUp = function slideUp(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  element.style.boxSizing = "border-box";
  element.style.transitionProperty = "height, margin";
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.height = "".concat(element.offsetHeight, "px");
  element.style.marginTop = 0;
  element.style.marginBottom = 0;
  element.style.overflow = "hidden";
  setTimeout(function () {
    element.style.height = 0;
  }, 5);
  window.setTimeout(function () {
    element.style.display = "none";
    element.style.removeProperty("height");
    element.style.removeProperty("margin-top");
    element.style.removeProperty("margin-bottom");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
  }, duration + 50);
};

exports.slideUp = slideUp;

var slideToggle = function slideToggle(element, duration) {
  window.getComputedStyle(element).display === "none" ? slideDown(element, duration) : slideUp(element, duration);
};

exports.slideToggle = slideToggle;

var fadeIn = function fadeIn(element) {
  var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var options = {
    duration: 300,
    display: null,
    opacity: 1,
    callback: null
  };
  Object.assign(options, _options);
  element.style.opacity = 0;
  element.style.display = options.display || "block";
  setTimeout(function () {
    element.style.transition = "".concat(options.duration, "ms opacity ease");
    element.style.opacity = options.opacity;
  }, 5);
  setTimeout(function () {
    element.style.removeProperty("transition");
    !!options.callback && options.callback();
  }, options.duration + 50);
};

exports.fadeIn = fadeIn;

var fadeOut = function fadeOut(element) {
  var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var options = {
    duration: 300,
    display: null,
    opacity: 0,
    callback: null
  };
  Object.assign(options, _options);
  element.style.opacity = 1;
  element.style.display = options.display || "block";
  setTimeout(function () {
    element.style.transition = "".concat(options.duration, "ms opacity ease");
    element.style.opacity = options.opacity;
  }, 5);
  setTimeout(function () {
    element.style.display = "none";
    element.style.removeProperty("transition");
    !!options.callback && options.callback();
  }, options.duration + 50);
};

exports.fadeOut = fadeOut;

var fadeToggle = function fadeToggle(element, options) {
  window.getComputedStyle(element).display === "none" ? fadeIn(element, options) : fadeOut(element, options);
};

exports.fadeToggle = fadeToggle;

var offset = function offset(element) {
  if (!element.getClientRects().length) {
    return {
      top: 0,
      left: 0
    };
  } // Get document-relative position by adding viewport scroll to viewport-relative gBCR


  var rect = element.getBoundingClientRect();
  var win = element.ownerDocument.defaultView;
  return {
    top: rect.top + win.pageYOffset,
    left: rect.left + win.pageXOffset
  };
};

exports.offset = offset;

var visible = function visible(element) {
  if (!element) {
    return false;
  }

  return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
};

exports.visible = visible;

var getSiblings = function getSiblings(e) {
  // for collecting siblings
  var siblings = []; // if no parent, return no sibling

  if (!e.parentNode) {
    return siblings;
  } // first child of the parent node


  var sibling = e.parentNode.firstChild; // collecting siblings

  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== e) {
      siblings.push(sibling);
    }

    sibling = sibling.nextSibling;
  }

  return siblings;
}; // Returns true if it is a DOM element


exports.getSiblings = getSiblings;

var isElement = function isElement(o) {
  return (typeof HTMLElement === "undefined" ? "undefined" : _typeof(HTMLElement)) === "object" ? o instanceof HTMLElement // DOM2
  : o && _typeof(o) === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName === "string";
};

exports.isElement = isElement;

var registerWidget = function registerWidget(className, widgetName) {
  var skin = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "default";

  if (!(className || widgetName)) {
    return;
  }
  /**
   * Because Elementor plugin uses jQuery custom event,
   * We also have to use jQuery to use this event
   */


  jQuery(window).on("elementor/frontend/init", function () {
    var addHandler = function addHandler($element) {
      elementorFrontend.elementsHandler.addHandler(className, {
        $element: $element
      });
    };

    elementorFrontend.hooks.addAction("frontend/element_ready/".concat(widgetName, ".").concat(skin), addHandler);
  });
};

exports.registerWidget = registerWidget;

},{}],2:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var OEW_Carousel = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_Carousel, _elementorModules$fro);

  var _super = _createSuper(OEW_Carousel);

  function OEW_Carousel() {
    _classCallCheck(this, OEW_Carousel);

    return _super.apply(this, arguments);
  }

  _createClass(OEW_Carousel, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          carousel: ".oew-carousel-container",
          carouselNextBtn: ".swiper-button-next-".concat(this.getID()),
          carouselPrevBtn: ".swiper-button-prev-".concat(this.getID()),
          carouselPagination: ".swiper-pagination-".concat(this.getID())
        },
        effect: "slide",
        loop: false,
        autoplay: 0,
        speed: 400,
        navigation: false,
        pagination: false,
        centeredSlides: false,
        pauseOnHover: false,
        slidesPerView: {
          widescreen: 3,
          desktop: 3,
          laptop: 3,
          tablet: 2,
          tablet_extra: 2,
          mobile: 1,
          mobile_extra: 1
        },
        slidesPerGroup: {
          widescreen: 3,
          desktop: 3,
          laptop: 3,
          tablet: 2,
          tablet_extra: 2,
          mobile: 1,
          mobile_extra: 1
        },
        spaceBetween: {
          widescreen: 10,
          desktop: 10,
          laptop: 10,
          tablet: 10,
          tablet_extra: 10,
          mobile: 10,
          mobile_extra: 10
        },
        swiperInstance: null
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        carousel: element.querySelector(selectors.carousel),
        carouselNextBtn: element.querySelectorAll(selectors.carouselNextBtn),
        carouselPrevBtn: element.querySelectorAll(selectors.carouselPrevBtn),
        carouselPagination: element.querySelectorAll(selectors.carouselPagination)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(OEW_Carousel.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.initSwiper();
      this.setupEventListeners();
      this.updateCarouselStyles(this.getSettings());
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var userSettings = JSON.parse(this.elements.carousel.getAttribute("data-settings"));
      this.originalAutoplayEnabled = userSettings.autoplay && Number(userSettings.autoplay) > 0;
      var currentSettings = {
        effect: !!userSettings.effect ? userSettings.effect : settings.effect,
        loop: !!userSettings.loop ? Boolean(Number(userSettings.loop)) : settings.loop,
        autoplay: !!userSettings.autoplay ? Number(userSettings.autoplay) : settings.autoplay,
        speed: !!userSettings.speed ? Number(userSettings.speed) : settings.speed,
        navigation: !!userSettings.arrows ? Boolean(Number(userSettings.arrows)) : settings.navigation,
        pagination: !!userSettings.dots ? Boolean(Number(userSettings.dots)) : settings.pagination,
        pauseOnHover: !!userSettings["pause-on-hover"] ? JSON.parse(userSettings["pause-on-hover"]) : settings.pauseOnHover,
        slidesPerView: {
          widescreen: userSettings['items-widescreen'] !== undefined ? Number(userSettings['items-widescreen']) : settings.slidesPerView['widescreen'],
          desktop: userSettings['items'] !== undefined ? Number(userSettings['items']) : settings.slidesPerView['desktop'],
          laptop: userSettings['items-laptop'] !== undefined ? Number(userSettings['items-laptop']) : settings.slidesPerView['laptop'],
          tablet: userSettings['items-tablet'] !== undefined ? Number(userSettings['items-tablet']) : settings.slidesPerView['tablet'],
          tablet_extra: userSettings['items-tablet_extra'] !== undefined ? Number(userSettings['items-tablet_extra']) : settings.slidesPerView['tablet_extra'],
          mobile: userSettings['items-mobile'] !== undefined ? Number(userSettings['items-mobile']) : settings.slidesPerView['mobile'],
          mobile_extra: userSettings['items-mobile_extra'] !== undefined ? Number(userSettings['items-mobile_extra']) : settings.slidesPerView['mobile_extra']
        },
        slidesPerGroup: {
          widescreen: !!userSettings['slides-widescreen'] ? Number(userSettings['slides-widescreen']) : settings.slidesPerGroup.widescreen,
          desktop: !!userSettings['slides'] ? Number(userSettings['slides']) : settings.slidesPerGroup.desktop,
          laptop: !!userSettings['slides-laptop'] ? Number(userSettings['slides-laptop']) : settings.slidesPerGroup.laptop,
          tablet: !!userSettings["slides-tablet"] ? Number(userSettings["slides-tablet"]) : settings.slidesPerGroup.tablet,
          tablet_extra: !!userSettings["slides-tablet_extra"] ? Number(userSettings["slides-tablet_extra"]) : settings.slidesPerGroup.tablet_extra,
          mobile: !!userSettings["slides-mobile"] ? Number(userSettings["slides-mobile"]) : settings.slidesPerGroup.mobile,
          mobile_extra: !!userSettings["slides-mobile_extra"] ? Number(userSettings["slides-mobile_extra"]) : settings.slidesPerGroup.mobile_extra
        },
        spaceBetween: {
          widescreen: userSettings['margin-widescreen'] !== undefined ? Number(userSettings['margin-widescreen']) : settings.spaceBetween.widescreen,
          desktop: userSettings['margin'] !== undefined ? Number(userSettings['margin']) : settings.spaceBetween.desktop,
          laptop: userSettings['margin-laptop'] !== undefined ? Number(userSettings['margin-laptop']) : settings.spaceBetween.laptop,
          tablet: userSettings["margin-tablet"] !== undefined ? Number(userSettings["margin-tablet"]) : settings.spaceBetween.tablet,
          tablet_extra: userSettings["margin-tablet_extra"] !== undefined ? Number(userSettings["margin-tablet_extra"]) : settings.spaceBetween.tablet_extra,
          mobile: userSettings["margin-mobile"] !== undefined ? Number(userSettings["margin-mobile"]) : settings.spaceBetween.mobile,
          mobile_extra: userSettings["margin-mobile_extra"] !== undefined ? Number(userSettings["margin-mobile_extra"]) : settings.spaceBetween.mobile_extra
        }
      };
      currentSettings.centeredSlides = currentSettings.effect === "coverflow" ? true : settings.centeredSlides;
      this.setSettings(currentSettings);
    }
  }, {
    key: "updateCarouselStyles",
    value: function updateCarouselStyles(settings) {
      var spaceBetween = settings.spaceBetween; // console.log("Updating Carousel Styles:", spaceBetween); // For debugging

      if (spaceBetween.desktop === 0) {
        // console.log("Setting margin-right for Desktop"); // For debugging
        this.elements.carousel.querySelectorAll('.oew-carousel-slide').forEach(function (slide) {
          slide.style.marginRight = "0px";
        });
      }

      if (spaceBetween.tablet === 0) {
        // console.log("Setting margin-right for Tablet"); // For debugging
        this.elements.carousel.querySelectorAll('.oew-carousel-slide').forEach(function (slide) {
          slide.style.marginRight = "0px";
        });
      }

      if (spaceBetween.mobile === 0) {
        // console.log("Setting margin-right for Mobile"); // For debugging
        this.elements.carousel.querySelectorAll('.oew-carousel-slide').forEach(function (slide) {
          slide.style.marginRight = "0px";
        });
      }
    }
  }, {
    key: "initSwiper",
    value: function initSwiper() {
      var swiper = new Swiper(this.elements.carousel, this.swiperOptions());
      this.setSettings({
        swiperInstance: swiper
      });
    }
  }, {
    key: "swiperOptions",
    value: function swiperOptions() {
      var settings = this.getSettings();
      var swiperOptions = {
        direction: "horizontal",
        effect: settings.effect,
        loop: settings.loop,
        speed: settings.speed,
        centeredSlides: settings.centeredSlides,
        autoHeight: true,
        autoplay: !settings.autoplay ? false : {
          delay: settings.autoplay
        },
        navigation: !settings.navigation ? false : {
          nextEl: settings.selectors.carouselNextBtn,
          prevEl: settings.selectors.carouselPrevBtn
        },
        pagination: !settings.pagination ? false : {
          el: settings.selectors.carouselPagination,
          clickable: true
        }
      }; // Fetch Elementor's responsive breakpoints

      var breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
      var breakpointsBootstrap = elementorFrontend.config.breakpoints;

      if (settings.effect === "fade") {
        swiperOptions.items = 1;
      } else {
        swiperOptions.breakpoints = {};
        var devicesBreakPoints = [];

        for (var deviceName in breakpoints) {
          var max_width = breakpoints[deviceName]['default_value'];

          if (breakpoints[deviceName]['value'] !== undefined) {
            max_width = breakpoints[deviceName]['value'];
          }

          devicesBreakPoints.push({
            'label': deviceName,
            'max_width': max_width
          });
        }

        devicesBreakPoints.sort(function (a, b) {
          return a.max_width - b.max_width;
        });
        var tmpSlidesPerView = 0;
        var desktopWidth = breakpointsBootstrap.lg;

        for (var _i = 0, _devicesBreakPoints = devicesBreakPoints; _i < _devicesBreakPoints.length; _i++) {
          var devicesBreakPointItem = _devicesBreakPoints[_i];
          var responsivKeySetting = devicesBreakPointItem.label;

          if (settings.slidesPerView[responsivKeySetting] !== undefined) {
            swiperOptions.breakpoints[tmpSlidesPerView] = {
              slidesPerView: settings.slidesPerView[responsivKeySetting],
              slidesPerGroup: settings.slidesPerGroup[responsivKeySetting],
              spaceBetween: settings.spaceBetween[responsivKeySetting]
            };

            if (responsivKeySetting === 'widescreen') {
              desktopWidth = tmpSlidesPerView;
              tmpSlidesPerView = devicesBreakPointItem['max_width'];
              swiperOptions.breakpoints[tmpSlidesPerView] = {
                slidesPerView: settings.slidesPerView[responsivKeySetting],
                slidesPerGroup: settings.slidesPerGroup[responsivKeySetting],
                spaceBetween: settings.spaceBetween[responsivKeySetting]
              };
            } else {
              tmpSlidesPerView = parseInt(devicesBreakPointItem['max_width']) + 1;
              desktopWidth = tmpSlidesPerView;
            }
          }
        }

        swiperOptions.breakpoints[desktopWidth] = {
          slidesPerView: settings.slidesPerView['desktop'],
          slidesPerGroup: settings.slidesPerGroup['desktop'],
          spaceBetween: settings.spaceBetween['desktop']
        };
      }

      return swiperOptions;
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      if (this.originalAutoplayEnabled && this.getSettings("pauseOnHover")) {
        this.elements.carousel.addEventListener("mouseenter", this.pauseSwiper.bind(this));
        this.elements.carousel.addEventListener("mouseleave", this.resumeSwiper.bind(this));
      }
    }
  }, {
    key: "pauseSwiper",
    value: function pauseSwiper() {
      if (this.getSettings("swiperInstance").autoplay.running) {
        this.getSettings("swiperInstance").autoplay.stop();
      }
    }
  }, {
    key: "resumeSwiper",
    value: function resumeSwiper() {
      if (!this.getSettings("swiperInstance").autoplay.running) {
        this.getSettings("swiperInstance").autoplay.start();
      }
    }
  }]);

  return OEW_Carousel;
}(elementorModules.frontend.handlers.Base);

var _default = OEW_Carousel;
exports["default"] = _default;

},{}],3:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var _utils = require("../lib/utils");

var _carousel = _interopRequireDefault(require("./base/carousel"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var OEW_MemberCarousel = /*#__PURE__*/function (_OEW_Carousel) {
  _inherits(OEW_MemberCarousel, _OEW_Carousel);

  var _super = _createSuper(OEW_MemberCarousel);

  function OEW_MemberCarousel() {
    _classCallCheck(this, OEW_MemberCarousel);

    return _super.apply(this, arguments);
  }

  return OEW_MemberCarousel;
}(_carousel["default"]);

(0, _utils.registerWidget)(OEW_MemberCarousel, "oew-member-carousel");

},{"../lib/utils":1,"./base/carousel":2}]},{},[3])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9iYXNlL2Nhcm91c2VsLmpzIiwiYXNzZXRzL3NyYy9qcy93aWRnZXRzL21lbWJlci1jYXJvdXNlbC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7OztBQ0FPLElBQU0sU0FBUyxHQUFHLFNBQVosU0FBWSxDQUFDLE9BQUQsRUFBNkI7QUFBQSxNQUFuQixRQUFtQix1RUFBUixHQUFRO0FBQ2xELE1BQUksT0FBTyxHQUFHLE1BQU0sQ0FBQyxnQkFBUCxDQUF3QixPQUF4QixFQUFpQyxPQUEvQzs7QUFFQSxNQUFJLE9BQU8sS0FBSyxNQUFoQixFQUF3QjtBQUNwQixJQUFBLE9BQU8sR0FBRyxPQUFWO0FBQ0g7O0FBRUQsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGtCQUFkLEdBQW1DLFFBQW5DO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGtCQUFkLGFBQXNDLFFBQXRDO0FBRUEsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsQ0FBeEI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixPQUF4QjtBQUNBLE1BQUksTUFBTSxHQUFHLE9BQU8sQ0FBQyxZQUFyQjtBQUVBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxNQUFkLEdBQXVCLENBQXZCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsQ0FBeEI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsUUFBZCxHQUF5QixRQUF6QjtBQUVBLEVBQUEsVUFBVSxDQUFDLFlBQU07QUFDYixJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxhQUEwQixNQUExQjtBQUNILEdBRlMsRUFFUCxDQUZPLENBQVY7QUFJQSxFQUFBLE1BQU0sQ0FBQyxV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LENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7ZUFvUi9DLFk7Ozs7Ozs7O0FDcFJmOztBQUNBOzs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQUVNLGtCOzs7Ozs7Ozs7Ozs7RUFBMkIsb0I7O0FBRWpDLDJCQUFlLGtCQUFmLEVBQW1DLHFCQUFuQyIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCBzbGlkZURvd24gPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcbiAgICBsZXQgZGlzcGxheSA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXk7XG5cbiAgICBpZiAoZGlzcGxheSA9PT0gXCJub25lXCIpIHtcbiAgICAgICAgZGlzcGxheSA9IFwiYmxvY2tcIjtcbiAgICB9XG5cbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0XCI7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXk7XG4gICAgbGV0IGhlaWdodCA9IGVsZW1lbnQub2Zmc2V0SGVpZ2h0O1xuXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XG4gICAgZWxlbWVudC5zdHlsZS5vdmVyZmxvdyA9IFwiaGlkZGVuXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtoZWlnaHR9cHhgO1xuICAgIH0sIDUpO1xuXG4gICAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLWR1cmF0aW9uXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1wcm9wZXJ0eVwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm9wYWNpdHlcIik7XG4gICAgfSwgZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3Qgc2xpZGVVcCA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xuICAgIGVsZW1lbnQuc3R5bGUuYm94U2l6aW5nID0gXCJib3JkZXItYm94XCI7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodCwgbWFyZ2luXCI7XG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtlbGVtZW50Lm9mZnNldEhlaWdodH1weGA7XG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Ub3AgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luQm90dG9tID0gMDtcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XG4gICAgfSwgNSk7XG5cbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLXRvcFwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm1hcmdpbi1ib3R0b21cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLXByb3BlcnR5XCIpO1xuICAgIH0sIGR1cmF0aW9uICsgNTApO1xufTtcblxuZXhwb3J0IGNvbnN0IHNsaWRlVG9nZ2xlID0gKGVsZW1lbnQsIGR1cmF0aW9uKSA9PiB7XG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBzbGlkZURvd24oZWxlbWVudCwgZHVyYXRpb24pIDogc2xpZGVVcChlbGVtZW50LCBkdXJhdGlvbik7XG59O1xuXG5leHBvcnQgY29uc3QgZmFkZUluID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcbiAgICBjb25zdCBvcHRpb25zID0ge1xuICAgICAgICBkdXJhdGlvbjogMzAwLFxuICAgICAgICBkaXNwbGF5OiBudWxsLFxuICAgICAgICBvcGFjaXR5OiAxLFxuICAgICAgICBjYWxsYmFjazogbnVsbCxcbiAgICB9O1xuXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XG4gICAgfSwgNSk7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcbiAgICBjb25zdCBvcHRpb25zID0ge1xuICAgICAgICBkdXJhdGlvbjogMzAwLFxuICAgICAgICBkaXNwbGF5OiBudWxsLFxuICAgICAgICBvcGFjaXR5OiAwLFxuICAgICAgICBjYWxsYmFjazogbnVsbCxcbiAgICB9O1xuXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XG5cbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XG4gICAgfSwgNSk7XG5cbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uXCIpO1xuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3QgZmFkZVRvZ2dsZSA9IChlbGVtZW50LCBvcHRpb25zKSA9PiB7XG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBmYWRlSW4oZWxlbWVudCwgb3B0aW9ucykgOiBmYWRlT3V0KGVsZW1lbnQsIG9wdGlvbnMpO1xufTtcblxuZXhwb3J0IGNvbnN0IG9mZnNldCA9IChlbGVtZW50KSA9PiB7XG4gICAgaWYgKCFlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKSB7XG4gICAgICAgIHJldHVybiB7IHRvcDogMCwgbGVmdDogMCB9O1xuICAgIH1cblxuICAgIC8vIEdldCBkb2N1bWVudC1yZWxhdGl2ZSBwb3NpdGlvbiBieSBhZGRpbmcgdmlld3BvcnQgc2Nyb2xsIHRvIHZpZXdwb3J0LXJlbGF0aXZlIGdCQ1JcbiAgICBjb25zdCByZWN0ID0gZWxlbWVudC5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKTtcbiAgICBjb25zdCB3aW4gPSBlbGVtZW50Lm93bmVyRG9jdW1lbnQuZGVmYXVsdFZpZXc7XG4gICAgcmV0dXJuIHtcbiAgICAgICAgdG9wOiByZWN0LnRvcCArIHdpbi5wYWdlWU9mZnNldCxcbiAgICAgICAgbGVmdDogcmVjdC5sZWZ0ICsgd2luLnBhZ2VYT2Zmc2V0LFxuICAgIH07XG59O1xuXG5leHBvcnQgY29uc3QgdmlzaWJsZSA9IChlbGVtZW50KSA9PiB7XG4gICAgaWYgKCFlbGVtZW50KSB7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9XG5cbiAgICByZXR1cm4gISEoZWxlbWVudC5vZmZzZXRXaWR0aCB8fCBlbGVtZW50Lm9mZnNldEhlaWdodCB8fCBlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKTtcbn07XG5cbmV4cG9ydCBjb25zdCBnZXRTaWJsaW5ncyA9IChlKSA9PiB7XG4gICAgLy8gZm9yIGNvbGxlY3Rpbmcgc2libGluZ3NcbiAgICBjb25zdCBzaWJsaW5ncyA9IFtdO1xuXG4gICAgLy8gaWYgbm8gcGFyZW50LCByZXR1cm4gbm8gc2libGluZ1xuICAgIGlmICghZS5wYXJlbnROb2RlKSB7XG4gICAgICAgIHJldHVybiBzaWJsaW5ncztcbiAgICB9XG5cbiAgICAvLyBmaXJzdCBjaGlsZCBvZiB0aGUgcGFyZW50IG5vZGVcbiAgICBsZXQgc2libGluZyA9IGUucGFyZW50Tm9kZS5maXJzdENoaWxkO1xuXG4gICAgLy8gY29sbGVjdGluZyBzaWJsaW5nc1xuICAgIHdoaWxlIChzaWJsaW5nKSB7XG4gICAgICAgIGlmIChzaWJsaW5nLm5vZGVUeXBlID09PSAxICYmIHNpYmxpbmcgIT09IGUpIHtcbiAgICAgICAgICAgIHNpYmxpbmdzLnB1c2goc2libGluZyk7XG4gICAgICAgIH1cblxuICAgICAgICBzaWJsaW5nID0gc2libGluZy5uZXh0U2libGluZztcbiAgICB9XG5cbiAgICByZXR1cm4gc2libGluZ3M7XG59O1xuXG4vLyBSZXR1cm5zIHRydWUgaWYgaXQgaXMgYSBET00gZWxlbWVudFxuZXhwb3J0IGNvbnN0IGlzRWxlbWVudCA9IChvKSA9PiB7XG4gICAgcmV0dXJuIHR5cGVvZiBIVE1MRWxlbWVudCA9PT0gXCJvYmplY3RcIlxuICAgICAgICA/IG8gaW5zdGFuY2VvZiBIVE1MRWxlbWVudCAvLyBET00yXG4gICAgICAgIDogbyAmJiB0eXBlb2YgbyA9PT0gXCJvYmplY3RcIiAmJiBvICE9PSBudWxsICYmIG8ubm9kZVR5cGUgPT09IDEgJiYgdHlwZW9mIG8ubm9kZU5hbWUgPT09IFwic3RyaW5nXCI7XG59O1xuXG5leHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gXCJkZWZhdWx0XCIpID0+IHtcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8qKlxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcbiAgICAgKi9cbiAgICBqUXVlcnkod2luZG93KS5vbihcImVsZW1lbnRvci9mcm9udGVuZC9pbml0XCIsICgpID0+IHtcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfTtcblxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XG4gICAgfSk7XG59O1xuIiwiY2xhc3MgT0VXX0Nhcm91c2VsIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBjYXJvdXNlbDogXCIub2V3LWNhcm91c2VsLWNvbnRhaW5lclwiLFxuICAgICAgICAgICAgICAgIGNhcm91c2VsTmV4dEJ0bjogYC5zd2lwZXItYnV0dG9uLW5leHQtJHt0aGlzLmdldElEKCl9YCxcbiAgICAgICAgICAgICAgICBjYXJvdXNlbFByZXZCdG46IGAuc3dpcGVyLWJ1dHRvbi1wcmV2LSR7dGhpcy5nZXRJRCgpfWAsXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWxQYWdpbmF0aW9uOiBgLnN3aXBlci1wYWdpbmF0aW9uLSR7dGhpcy5nZXRJRCgpfWAsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgZWZmZWN0OiBcInNsaWRlXCIsXG4gICAgICAgICAgICBsb29wOiBmYWxzZSxcbiAgICAgICAgICAgIGF1dG9wbGF5OiAwLFxuICAgICAgICAgICAgc3BlZWQ6IDQwMCxcbiAgICAgICAgICAgIG5hdmlnYXRpb246IGZhbHNlLFxuICAgICAgICAgICAgcGFnaW5hdGlvbjogZmFsc2UsXG4gICAgICAgICAgICBjZW50ZXJlZFNsaWRlczogZmFsc2UsXG4gICAgICAgICAgICBwYXVzZU9uSG92ZXI6IGZhbHNlLFxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzoge1xuICAgICAgICAgICAgICAgIHdpZGVzY3JlZW46IDMsXG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcbiAgICAgICAgICAgICAgICBsYXB0b3A6IDMsXG4gICAgICAgICAgICAgICAgdGFibGV0OiAyLFxuICAgICAgICAgICAgICAgIHRhYmxldF9leHRyYTogMixcbiAgICAgICAgICAgICAgICBtb2JpbGU6IDEsXG4gICAgICAgICAgICAgICAgbW9iaWxlX2V4dHJhOiAxLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiB7XG4gICAgICAgICAgICAgICAgd2lkZXNjcmVlbjogMyxcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAzLFxuICAgICAgICAgICAgICAgIGxhcHRvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgdGFibGV0X2V4dHJhOiAyLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogMSxcbiAgICAgICAgICAgICAgICBtb2JpbGVfZXh0cmE6IDEsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiB7XG4gICAgICAgICAgICAgICAgd2lkZXNjcmVlbjogMTAsXG4gICAgICAgICAgICAgICAgZGVza3RvcDogMTAsXG4gICAgICAgICAgICAgICAgbGFwdG9wOiAxMCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDEwLFxuICAgICAgICAgICAgICAgIHRhYmxldF9leHRyYTogMTAsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxMCxcbiAgICAgICAgICAgICAgICBtb2JpbGVfZXh0cmE6IDEwLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHN3aXBlckluc3RhbmNlOiBudWxsLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xuXG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBjYXJvdXNlbDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5jYXJvdXNlbCksXG4gICAgICAgICAgICBjYXJvdXNlbE5leHRCdG46IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxOZXh0QnRuKSxcbiAgICAgICAgICAgIGNhcm91c2VsUHJldkJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbFByZXZCdG4pLFxuICAgICAgICAgICAgY2Fyb3VzZWxQYWdpbmF0aW9uOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsUGFnaW5hdGlvbiksXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xuXG4gICAgICAgIHRoaXMuc2V0VXNlclNldHRpbmdzKCk7XG4gICAgICAgIHRoaXMuaW5pdFN3aXBlcigpO1xuICAgICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgICAgICAgdGhpcy51cGRhdGVDYXJvdXNlbFN0eWxlcyh0aGlzLmdldFNldHRpbmdzKCkpO1xuICAgIH1cblxuICAgIHNldFVzZXJTZXR0aW5ncygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG4gICAgICAgIGNvbnN0IHVzZXJTZXR0aW5ncyA9IEpTT04ucGFyc2UodGhpcy5lbGVtZW50cy5jYXJvdXNlbC5nZXRBdHRyaWJ1dGUoXCJkYXRhLXNldHRpbmdzXCIpKTtcblxuICAgICAgICB0aGlzLm9yaWdpbmFsQXV0b3BsYXlFbmFibGVkID0gdXNlclNldHRpbmdzLmF1dG9wbGF5ICYmIE51bWJlcih1c2VyU2V0dGluZ3MuYXV0b3BsYXkpID4gMDtcblxuICAgICAgICBjb25zdCBjdXJyZW50U2V0dGluZ3MgPSB7XG4gICAgICAgICAgICBlZmZlY3Q6ICEhdXNlclNldHRpbmdzLmVmZmVjdCA/IHVzZXJTZXR0aW5ncy5lZmZlY3QgOiBzZXR0aW5ncy5lZmZlY3QsXG4gICAgICAgICAgICBsb29wOiAhIXVzZXJTZXR0aW5ncy5sb29wID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmxvb3ApKSA6IHNldHRpbmdzLmxvb3AsXG4gICAgICAgICAgICBhdXRvcGxheTogISF1c2VyU2V0dGluZ3MuYXV0b3BsYXkgPyBOdW1iZXIodXNlclNldHRpbmdzLmF1dG9wbGF5KSA6IHNldHRpbmdzLmF1dG9wbGF5LFxuICAgICAgICAgICAgc3BlZWQ6ICEhdXNlclNldHRpbmdzLnNwZWVkID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5zcGVlZCkgOiBzZXR0aW5ncy5zcGVlZCxcbiAgICAgICAgICAgIG5hdmlnYXRpb246ICEhdXNlclNldHRpbmdzLmFycm93cyA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5hcnJvd3MpKSA6IHNldHRpbmdzLm5hdmlnYXRpb24sXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiAhIXVzZXJTZXR0aW5ncy5kb3RzID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmRvdHMpKSA6IHNldHRpbmdzLnBhZ2luYXRpb24sXG4gICAgICAgICAgICBwYXVzZU9uSG92ZXI6ICEhdXNlclNldHRpbmdzW1wicGF1c2Utb24taG92ZXJcIl1cbiAgICAgICAgICAgICAgICA/IEpTT04ucGFyc2UodXNlclNldHRpbmdzW1wicGF1c2Utb24taG92ZXJcIl0pXG4gICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5wYXVzZU9uSG92ZXIsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiB7XG4gICAgICAgICAgICAgICAgd2lkZXNjcmVlbjogdXNlclNldHRpbmdzWydpdGVtcy13aWRlc2NyZWVuJ10gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zLXdpZGVzY3JlZW4nXSkgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Wyd3aWRlc2NyZWVuJ10sXG4gICAgICAgICAgICAgICAgZGVza3RvcDogdXNlclNldHRpbmdzWydpdGVtcyddICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzWydpdGVtcyddKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXdbJ2Rlc2t0b3AnXSxcbiAgICAgICAgICAgICAgICBsYXB0b3A6IHVzZXJTZXR0aW5nc1snaXRlbXMtbGFwdG9wJ10gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zLWxhcHRvcCddKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXdbJ2xhcHRvcCddLFxuICAgICAgICAgICAgICAgIHRhYmxldDogdXNlclNldHRpbmdzWydpdGVtcy10YWJsZXQnXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtdGFibGV0J10pIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1sndGFibGV0J10sXG4gICAgICAgICAgICAgICAgdGFibGV0X2V4dHJhOiB1c2VyU2V0dGluZ3NbJ2l0ZW1zLXRhYmxldF9leHRyYSddICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzWydpdGVtcy10YWJsZXRfZXh0cmEnXSkgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Wyd0YWJsZXRfZXh0cmEnXSxcbiAgICAgICAgICAgICAgICBtb2JpbGU6IHVzZXJTZXR0aW5nc1snaXRlbXMtbW9iaWxlJ10gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zLW1vYmlsZSddKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXdbJ21vYmlsZSddLFxuICAgICAgICAgICAgICAgIG1vYmlsZV9leHRyYTogdXNlclNldHRpbmdzWydpdGVtcy1tb2JpbGVfZXh0cmEnXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtbW9iaWxlX2V4dHJhJ10pIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1snbW9iaWxlX2V4dHJhJ11cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzbGlkZXNQZXJHcm91cDoge1xuICAgICAgICAgICAgICAgIHdpZGVzY3JlZW46ICEhdXNlclNldHRpbmdzWydzbGlkZXMtd2lkZXNjcmVlbiddID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snc2xpZGVzLXdpZGVzY3JlZW4nXSkgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC53aWRlc2NyZWVuLFxuICAgICAgICAgICAgICAgIGRlc2t0b3A6ICEhdXNlclNldHRpbmdzWydzbGlkZXMnXSA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ3NsaWRlcyddKSA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgbGFwdG9wOiAhIXVzZXJTZXR0aW5nc1snc2xpZGVzLWxhcHRvcCddID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snc2xpZGVzLWxhcHRvcCddKSA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLmxhcHRvcCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzW1wic2xpZGVzLXRhYmxldFwiXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJzbGlkZXMtdGFibGV0XCJdKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLnRhYmxldCxcbiAgICAgICAgICAgICAgICB0YWJsZXRfZXh0cmE6ICEhdXNlclNldHRpbmdzW1wic2xpZGVzLXRhYmxldF9leHRyYVwiXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJzbGlkZXMtdGFibGV0X2V4dHJhXCJdKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLnRhYmxldF9leHRyYSxcbiAgICAgICAgICAgICAgICBtb2JpbGU6ICEhdXNlclNldHRpbmdzW1wic2xpZGVzLW1vYmlsZVwiXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJzbGlkZXMtbW9iaWxlXCJdKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLm1vYmlsZSxcbiAgICAgICAgICAgICAgICBtb2JpbGVfZXh0cmE6ICEhdXNlclNldHRpbmdzW1wic2xpZGVzLW1vYmlsZV9leHRyYVwiXVxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJzbGlkZXMtbW9iaWxlX2V4dHJhXCJdKVxuICAgICAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLm1vYmlsZV9leHRyYSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IHtcbiAgICAgICAgICAgICAgICB3aWRlc2NyZWVuOiB1c2VyU2V0dGluZ3NbJ21hcmdpbi13aWRlc2NyZWVuJ10gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ21hcmdpbi13aWRlc2NyZWVuJ10pIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLndpZGVzY3JlZW4sXG4gICAgICAgICAgICAgICAgZGVza3RvcDogdXNlclNldHRpbmdzWydtYXJnaW4nXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snbWFyZ2luJ10pIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLmRlc2t0b3AsXG4gICAgICAgICAgICAgICAgbGFwdG9wOiB1c2VyU2V0dGluZ3NbJ21hcmdpbi1sYXB0b3AnXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snbWFyZ2luLWxhcHRvcCddKSA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5sYXB0b3AsXG4gICAgICAgICAgICAgICAgdGFibGV0OiB1c2VyU2V0dGluZ3NbXCJtYXJnaW4tdGFibGV0XCJdICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzW1wibWFyZ2luLXRhYmxldFwiXSkgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4udGFibGV0LFxuICAgICAgICAgICAgICAgIHRhYmxldF9leHRyYTogdXNlclNldHRpbmdzW1wibWFyZ2luLXRhYmxldF9leHRyYVwiXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcIm1hcmdpbi10YWJsZXRfZXh0cmFcIl0pIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLnRhYmxldF9leHRyYSxcbiAgICAgICAgICAgICAgICBtb2JpbGU6IHVzZXJTZXR0aW5nc1tcIm1hcmdpbi1tb2JpbGVcIl0gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJtYXJnaW4tbW9iaWxlXCJdKSA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5tb2JpbGUsXG4gICAgICAgICAgICAgICAgbW9iaWxlX2V4dHJhOiB1c2VyU2V0dGluZ3NbXCJtYXJnaW4tbW9iaWxlX2V4dHJhXCJdICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzW1wibWFyZ2luLW1vYmlsZV9leHRyYVwiXSkgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4ubW9iaWxlX2V4dHJhLFxuXG4gICAgICAgICAgfSxcbiAgICAgICAgfTtcblxuICAgICAgICBjdXJyZW50U2V0dGluZ3MuY2VudGVyZWRTbGlkZXMgPSBjdXJyZW50U2V0dGluZ3MuZWZmZWN0ID09PSBcImNvdmVyZmxvd1wiID8gdHJ1ZSA6IHNldHRpbmdzLmNlbnRlcmVkU2xpZGVzO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3MoY3VycmVudFNldHRpbmdzKTtcblxuICAgIH1cblxuICAgIHVwZGF0ZUNhcm91c2VsU3R5bGVzKHNldHRpbmdzKSB7XG4gICAgICBjb25zdCB7IHNwYWNlQmV0d2VlbiB9ID0gc2V0dGluZ3M7XG5cbiAgICAgIC8vIGNvbnNvbGUubG9nKFwiVXBkYXRpbmcgQ2Fyb3VzZWwgU3R5bGVzOlwiLCBzcGFjZUJldHdlZW4pOyAvLyBGb3IgZGVidWdnaW5nXG5cbiAgICAgIGlmIChzcGFjZUJldHdlZW4uZGVza3RvcCA9PT0gMCkge1xuICAgICAgICAgIC8vIGNvbnNvbGUubG9nKFwiU2V0dGluZyBtYXJnaW4tcmlnaHQgZm9yIERlc2t0b3BcIik7IC8vIEZvciBkZWJ1Z2dpbmdcbiAgICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLnF1ZXJ5U2VsZWN0b3JBbGwoJy5vZXctY2Fyb3VzZWwtc2xpZGUnKS5mb3JFYWNoKHNsaWRlID0+IHtcbiAgICAgICAgICAgICAgc2xpZGUuc3R5bGUubWFyZ2luUmlnaHQgPSBcIjBweFwiO1xuICAgICAgICAgIH0pO1xuICAgICAgfVxuICAgICAgaWYgKHNwYWNlQmV0d2Vlbi50YWJsZXQgPT09IDApIHtcbiAgICAgICAgICAvLyBjb25zb2xlLmxvZyhcIlNldHRpbmcgbWFyZ2luLXJpZ2h0IGZvciBUYWJsZXRcIik7IC8vIEZvciBkZWJ1Z2dpbmdcbiAgICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLnF1ZXJ5U2VsZWN0b3JBbGwoJy5vZXctY2Fyb3VzZWwtc2xpZGUnKS5mb3JFYWNoKHNsaWRlID0+IHtcbiAgICAgICAgICAgICAgc2xpZGUuc3R5bGUubWFyZ2luUmlnaHQgPSBcIjBweFwiO1xuICAgICAgICAgIH0pO1xuICAgICAgfVxuICAgICAgaWYgKHNwYWNlQmV0d2Vlbi5tb2JpbGUgPT09IDApIHtcbiAgICAgICAgICAvLyBjb25zb2xlLmxvZyhcIlNldHRpbmcgbWFyZ2luLXJpZ2h0IGZvciBNb2JpbGVcIik7IC8vIEZvciBkZWJ1Z2dpbmdcbiAgICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLnF1ZXJ5U2VsZWN0b3JBbGwoJy5vZXctY2Fyb3VzZWwtc2xpZGUnKS5mb3JFYWNoKHNsaWRlID0+IHtcbiAgICAgICAgICAgICAgc2xpZGUuc3R5bGUubWFyZ2luUmlnaHQgPSBcIjBweFwiO1xuICAgICAgICAgIH0pO1xuICAgICAgfVxuICB9XG5cblxuICAgIGluaXRTd2lwZXIoKSB7XG4gICAgICAgIGNvbnN0IHN3aXBlciA9IG5ldyBTd2lwZXIodGhpcy5lbGVtZW50cy5jYXJvdXNlbCwgdGhpcy5zd2lwZXJPcHRpb25zKCkpO1xuXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xuICAgICAgICAgICAgc3dpcGVySW5zdGFuY2U6IHN3aXBlcixcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgc3dpcGVyT3B0aW9ucygpIHtcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XG5cbiAgICAgICAgY29uc3Qgc3dpcGVyT3B0aW9ucyA9IHtcbiAgICAgICAgICAgIGRpcmVjdGlvbjogXCJob3Jpem9udGFsXCIsXG4gICAgICAgICAgICBlZmZlY3Q6IHNldHRpbmdzLmVmZmVjdCxcbiAgICAgICAgICAgIGxvb3A6IHNldHRpbmdzLmxvb3AsXG4gICAgICAgICAgICBzcGVlZDogc2V0dGluZ3Muc3BlZWQsXG4gICAgICAgICAgICBjZW50ZXJlZFNsaWRlczogc2V0dGluZ3MuY2VudGVyZWRTbGlkZXMsXG4gICAgICAgICAgICBhdXRvSGVpZ2h0OiB0cnVlLFxuICAgICAgICAgICAgYXV0b3BsYXk6ICFzZXR0aW5ncy5hdXRvcGxheVxuICAgICAgICAgICAgICAgID8gZmFsc2VcbiAgICAgICAgICAgICAgICA6IHtcbiAgICAgICAgICAgICAgICAgICAgICBkZWxheTogc2V0dGluZ3MuYXV0b3BsYXksXG4gICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgbmF2aWdhdGlvbjogIXNldHRpbmdzLm5hdmlnYXRpb25cbiAgICAgICAgICAgICAgICA/IGZhbHNlXG4gICAgICAgICAgICAgICAgOiB7XG4gICAgICAgICAgICAgICAgICAgICAgbmV4dEVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxOZXh0QnRuLFxuICAgICAgICAgICAgICAgICAgICAgIHByZXZFbDogc2V0dGluZ3Muc2VsZWN0b3JzLmNhcm91c2VsUHJldkJ0bixcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiAhc2V0dGluZ3MucGFnaW5hdGlvblxuICAgICAgICAgICAgICAgID8gZmFsc2VcbiAgICAgICAgICAgICAgICA6IHtcbiAgICAgICAgICAgICAgICAgICAgICBlbDogc2V0dGluZ3Muc2VsZWN0b3JzLmNhcm91c2VsUGFnaW5hdGlvbixcbiAgICAgICAgICAgICAgICAgICAgICBjbGlja2FibGU6IHRydWUsXG4gICAgICAgICAgICAgICAgICB9LFxuICAgICAgICB9O1xuXG4gICAgICAgIC8vIEZldGNoIEVsZW1lbnRvcidzIHJlc3BvbnNpdmUgYnJlYWtwb2ludHNcbiAgICAgICAgdmFyIGJyZWFrcG9pbnRzID0gZWxlbWVudG9yRnJvbnRlbmQuY29uZmlnLnJlc3BvbnNpdmUuYWN0aXZlQnJlYWtwb2ludHM7XG4gICAgICAgIHZhciBicmVha3BvaW50c0Jvb3RzdHJhcCA9IGVsZW1lbnRvckZyb250ZW5kLmNvbmZpZy5icmVha3BvaW50cztcblxuICAgICAgICBpZiAoc2V0dGluZ3MuZWZmZWN0ID09PSBcImZhZGVcIikge1xuICAgICAgICAgICAgc3dpcGVyT3B0aW9ucy5pdGVtcyA9IDE7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgc3dpcGVyT3B0aW9ucy5icmVha3BvaW50cyA9IHt9O1xuXG4gICAgICAgICAgICBsZXQgZGV2aWNlc0JyZWFrUG9pbnRzID0gW107XG4gICAgICAgICAgICBmb3IgKGxldCBkZXZpY2VOYW1lIGluIGJyZWFrcG9pbnRzKSB7XG4gICAgICAgICAgICAgIGxldCBtYXhfd2lkdGggPSBicmVha3BvaW50c1tkZXZpY2VOYW1lXVsnZGVmYXVsdF92YWx1ZSddO1xuICAgICAgICAgICAgICBpZiggYnJlYWtwb2ludHNbZGV2aWNlTmFtZV1bJ3ZhbHVlJ10gIT09IHVuZGVmaW5lZCApIHtcbiAgICAgICAgICAgICAgICBtYXhfd2lkdGggPSBicmVha3BvaW50c1tkZXZpY2VOYW1lXVsndmFsdWUnXTtcbiAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICBkZXZpY2VzQnJlYWtQb2ludHMucHVzaCh7XG4gICAgICAgICAgICAgICAgJ2xhYmVsJyA6IGRldmljZU5hbWUsXG4gICAgICAgICAgICAgICAgJ21heF93aWR0aCcgOiBtYXhfd2lkdGhcbiAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBkZXZpY2VzQnJlYWtQb2ludHMuc29ydCgoYSwgYikgPT4ge1xuICAgICAgICAgICAgICByZXR1cm4gYS5tYXhfd2lkdGggLSBiLm1heF93aWR0aFxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIGxldCB0bXBTbGlkZXNQZXJWaWV3ID0gMDtcblxuICAgICAgICAgICAgbGV0IGRlc2t0b3BXaWR0aCA9IGJyZWFrcG9pbnRzQm9vdHN0cmFwLmxnO1xuICAgICAgICAgICAgZm9yIChsZXQgZGV2aWNlc0JyZWFrUG9pbnRJdGVtIG9mIGRldmljZXNCcmVha1BvaW50cykge1xuXG4gICAgICAgICAgICAgIGxldCByZXNwb25zaXZLZXlTZXR0aW5nID0gZGV2aWNlc0JyZWFrUG9pbnRJdGVtLmxhYmVsO1xuXG4gICAgICAgICAgICAgIGlmKCBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3W3Jlc3BvbnNpdktleVNldHRpbmddICE9PSB1bmRlZmluZWQpIHtcbiAgICAgICAgICAgICAgICBzd2lwZXJPcHRpb25zLmJyZWFrcG9pbnRzW3RtcFNsaWRlc1BlclZpZXddID0ge1xuICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1tyZXNwb25zaXZLZXlTZXR0aW5nXSxcbiAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cFtyZXNwb25zaXZLZXlTZXR0aW5nXSxcbiAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuW3Jlc3BvbnNpdktleVNldHRpbmddLFxuICAgICAgICAgICAgICAgIH07XG5cbiAgICAgICAgICAgICAgICBpZiggcmVzcG9uc2l2S2V5U2V0dGluZyA9PT0gJ3dpZGVzY3JlZW4nICkge1xuICAgICAgICAgICAgICAgICAgZGVza3RvcFdpZHRoID0gdG1wU2xpZGVzUGVyVmlldztcbiAgICAgICAgICAgICAgICAgIHRtcFNsaWRlc1BlclZpZXcgPSBkZXZpY2VzQnJlYWtQb2ludEl0ZW1bJ21heF93aWR0aCddO1xuICAgICAgICAgICAgICAgICAgc3dpcGVyT3B0aW9ucy5icmVha3BvaW50c1t0bXBTbGlkZXNQZXJWaWV3XSA9IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1tyZXNwb25zaXZLZXlTZXR0aW5nXSxcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwW3Jlc3BvbnNpdktleVNldHRpbmddLFxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2VlbltyZXNwb25zaXZLZXlTZXR0aW5nXSxcbiAgICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgIHRtcFNsaWRlc1BlclZpZXcgPSBwYXJzZUludChkZXZpY2VzQnJlYWtQb2ludEl0ZW1bJ21heF93aWR0aCddKSArIDE7XG4gICAgICAgICAgICAgICAgICBkZXNrdG9wV2lkdGggPSB0bXBTbGlkZXNQZXJWaWV3O1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zLmJyZWFrcG9pbnRzW2Rlc2t0b3BXaWR0aF0gPSB7XG4gICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXdbJ2Rlc2t0b3AnXSxcbiAgICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwWydkZXNrdG9wJ10sXG4gICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuWydkZXNrdG9wJ10sXG4gICAgICAgICAgICB9O1xuXG4gICAgICAgIH1cblxuICAgICAgICByZXR1cm4gc3dpcGVyT3B0aW9ucztcbiAgICB9XG5cbiAgICBzZXR1cEV2ZW50TGlzdGVuZXJzKCkge1xuICAgICAgaWYgKHRoaXMub3JpZ2luYWxBdXRvcGxheUVuYWJsZWQgJiYgdGhpcy5nZXRTZXR0aW5ncyhcInBhdXNlT25Ib3ZlclwiKSkge1xuICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmFkZEV2ZW50TGlzdGVuZXIoXCJtb3VzZWVudGVyXCIsIHRoaXMucGF1c2VTd2lwZXIuYmluZCh0aGlzKSk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwuYWRkRXZlbnRMaXN0ZW5lcihcIm1vdXNlbGVhdmVcIiwgdGhpcy5yZXN1bWVTd2lwZXIuYmluZCh0aGlzKSk7XG4gICAgICB9XG4gICAgfVxuXG4gICAgcGF1c2VTd2lwZXIoKSB7XG4gICAgICBpZiAodGhpcy5nZXRTZXR0aW5ncyhcInN3aXBlckluc3RhbmNlXCIpLmF1dG9wbGF5LnJ1bm5pbmcpIHtcbiAgICAgICAgICB0aGlzLmdldFNldHRpbmdzKFwic3dpcGVySW5zdGFuY2VcIikuYXV0b3BsYXkuc3RvcCgpO1xuICAgICAgfVxuICAgIH1cblxuICByZXN1bWVTd2lwZXIoKSB7XG4gICAgICBpZiAoIXRoaXMuZ2V0U2V0dGluZ3MoXCJzd2lwZXJJbnN0YW5jZVwiKS5hdXRvcGxheS5ydW5uaW5nKSB7XG4gICAgICAgICAgdGhpcy5nZXRTZXR0aW5ncyhcInN3aXBlckluc3RhbmNlXCIpLmF1dG9wbGF5LnN0YXJ0KCk7XG4gICAgICB9XG4gIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgT0VXX0Nhcm91c2VsO1xuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5pbXBvcnQgT0VXX0Nhcm91c2VsIGZyb20gXCIuL2Jhc2UvY2Fyb3VzZWxcIjtcblxuY2xhc3MgT0VXX01lbWJlckNhcm91c2VsIGV4dGVuZHMgT0VXX0Nhcm91c2VsIHt9XG5cbnJlZ2lzdGVyV2lkZ2V0KE9FV19NZW1iZXJDYXJvdXNlbCwgXCJvZXctbWVtYmVyLWNhcm91c2VsXCIpO1xuIl19
