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

var OEW_WooSlider = /*#__PURE__*/function (_OEW_Carousel) {
  _inherits(OEW_WooSlider, _OEW_Carousel);

  var _super = _createSuper(OEW_WooSlider);

  function OEW_WooSlider() {
    _classCallCheck(this, OEW_WooSlider);

    return _super.apply(this, arguments);
  }

  return OEW_WooSlider;
}(_carousel["default"]);

(0, _utils.registerWidget)(OEW_WooSlider, "oew-woo-slider");

},{"../lib/utils":1,"./base/carousel":2}]},{},[3])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9iYXNlL2Nhcm91c2VsLmpzIiwiYXNzZXRzL3NyYy9qcy93aWRnZXRzL3dvby1zbGlkZXIuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7QUNBTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTZCO0FBQUEsTUFBbkIsUUFBbUIsdUVBQVIsR0FBUTtBQUNsRCxNQUFJLE9BQU8sR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsT0FBL0M7O0FBRUEsTUFBSSxPQUFPLEtBQUssTUFBaEIsRUFBd0I7QUFDcEIsSUFBQSxPQUFPLEdBQUcsT0FBVjtBQUNIOztBQUVELEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxHQUFtQyxRQUFuQztBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxhQUFzQyxRQUF0QztBQUVBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsT0FBeEI7QUFDQSxNQUFJLE1BQU0sR0FBRyxPQUFPLENBQUMsWUFBckI7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxHQUF1QixDQUF2QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFFBQWQsR0FBeUIsUUFBekI7QUFFQSxFQUFBLFVBQVUsQ0FBQyxZQUFNO0FBQ2IsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsYUFBMEIsTUFBMUI7QUFDSCxHQUZTLEVBRVAsQ0FGTyxDQUFWO0FBSUEsRUFBQSxNQUFNLENBQUMsVUFBUCxD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LFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O2VBb1IvQyxZOzs7Ozs7OztBQ3BSZjs7QUFDQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUFFTSxhOzs7Ozs7Ozs7Ozs7RUFBc0Isb0I7O0FBRTVCLDJCQUFlLGFBQWYsRUFBOEIsZ0JBQTlCIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHNsaWRlRG93biA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xuICAgIGxldCBkaXNwbGF5ID0gd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheTtcblxuICAgIGlmIChkaXNwbGF5ID09PSBcIm5vbmVcIikge1xuICAgICAgICBkaXNwbGF5ID0gXCJibG9ja1wiO1xuICAgIH1cblxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gXCJoZWlnaHRcIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheTtcbiAgICBsZXQgaGVpZ2h0ID0gZWxlbWVudC5vZmZzZXRIZWlnaHQ7XG5cbiAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2hlaWdodH1weGA7XG4gICAgfSwgNSk7XG5cbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJoZWlnaHRcIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLXByb3BlcnR5XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3BhY2l0eVwiKTtcbiAgICB9LCBkdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBzbGlkZVVwID0gKGVsZW1lbnQsIGR1cmF0aW9uID0gMzAwKSA9PiB7XG4gICAgZWxlbWVudC5zdHlsZS5ib3hTaXppbmcgPSBcImJvcmRlci1ib3hcIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0LCBtYXJnaW5cIjtcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcbiAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2VsZW1lbnQub2Zmc2V0SGVpZ2h0fXB4YDtcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpblRvcCA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Cb3R0b20gPSAwO1xuICAgIGVsZW1lbnQuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xuXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gMDtcbiAgICB9LCA1KTtcblxuICAgIHdpbmRvdy5zZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJoZWlnaHRcIik7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJtYXJnaW4tdG9wXCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLWJvdHRvbVwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm92ZXJmbG93XCIpO1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1kdXJhdGlvblwiKTtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XG4gICAgfSwgZHVyYXRpb24gKyA1MCk7XG59O1xuXG5leHBvcnQgY29uc3Qgc2xpZGVUb2dnbGUgPSAoZWxlbWVudCwgZHVyYXRpb24pID0+IHtcbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIiA/IHNsaWRlRG93bihlbGVtZW50LCBkdXJhdGlvbikgOiBzbGlkZVVwKGVsZW1lbnQsIGR1cmF0aW9uKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlSW4gPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xuICAgIGNvbnN0IG9wdGlvbnMgPSB7XG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXG4gICAgICAgIG9wYWNpdHk6IDEsXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxuICAgIH07XG5cbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcbiAgICB9LCA1KTtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcbiAgICB9LCBvcHRpb25zLmR1cmF0aW9uICsgNTApO1xufTtcblxuZXhwb3J0IGNvbnN0IGZhZGVPdXQgPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xuICAgIGNvbnN0IG9wdGlvbnMgPSB7XG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXG4gICAgICAgIG9wYWNpdHk6IDAsXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxuICAgIH07XG5cbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcblxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcbiAgICB9LCA1KTtcblxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcbn07XG5cbmV4cG9ydCBjb25zdCBmYWRlVG9nZ2xlID0gKGVsZW1lbnQsIG9wdGlvbnMpID0+IHtcbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIiA/IGZhZGVJbihlbGVtZW50LCBvcHRpb25zKSA6IGZhZGVPdXQoZWxlbWVudCwgb3B0aW9ucyk7XG59O1xuXG5leHBvcnQgY29uc3Qgb2Zmc2V0ID0gKGVsZW1lbnQpID0+IHtcbiAgICBpZiAoIWVsZW1lbnQuZ2V0Q2xpZW50UmVjdHMoKS5sZW5ndGgpIHtcbiAgICAgICAgcmV0dXJuIHsgdG9wOiAwLCBsZWZ0OiAwIH07XG4gICAgfVxuXG4gICAgLy8gR2V0IGRvY3VtZW50LXJlbGF0aXZlIHBvc2l0aW9uIGJ5IGFkZGluZyB2aWV3cG9ydCBzY3JvbGwgdG8gdmlld3BvcnQtcmVsYXRpdmUgZ0JDUlxuICAgIGNvbnN0IHJlY3QgPSBlbGVtZW50LmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpO1xuICAgIGNvbnN0IHdpbiA9IGVsZW1lbnQub3duZXJEb2N1bWVudC5kZWZhdWx0VmlldztcbiAgICByZXR1cm4ge1xuICAgICAgICB0b3A6IHJlY3QudG9wICsgd2luLnBhZ2VZT2Zmc2V0LFxuICAgICAgICBsZWZ0OiByZWN0LmxlZnQgKyB3aW4ucGFnZVhPZmZzZXQsXG4gICAgfTtcbn07XG5cbmV4cG9ydCBjb25zdCB2aXNpYmxlID0gKGVsZW1lbnQpID0+IHtcbiAgICBpZiAoIWVsZW1lbnQpIHtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH1cblxuICAgIHJldHVybiAhIShlbGVtZW50Lm9mZnNldFdpZHRoIHx8IGVsZW1lbnQub2Zmc2V0SGVpZ2h0IHx8IGVsZW1lbnQuZ2V0Q2xpZW50UmVjdHMoKS5sZW5ndGgpO1xufTtcblxuZXhwb3J0IGNvbnN0IGdldFNpYmxpbmdzID0gKGUpID0+IHtcbiAgICAvLyBmb3IgY29sbGVjdGluZyBzaWJsaW5nc1xuICAgIGNvbnN0IHNpYmxpbmdzID0gW107XG5cbiAgICAvLyBpZiBubyBwYXJlbnQsIHJldHVybiBubyBzaWJsaW5nXG4gICAgaWYgKCFlLnBhcmVudE5vZGUpIHtcbiAgICAgICAgcmV0dXJuIHNpYmxpbmdzO1xuICAgIH1cblxuICAgIC8vIGZpcnN0IGNoaWxkIG9mIHRoZSBwYXJlbnQgbm9kZVxuICAgIGxldCBzaWJsaW5nID0gZS5wYXJlbnROb2RlLmZpcnN0Q2hpbGQ7XG5cbiAgICAvLyBjb2xsZWN0aW5nIHNpYmxpbmdzXG4gICAgd2hpbGUgKHNpYmxpbmcpIHtcbiAgICAgICAgaWYgKHNpYmxpbmcubm9kZVR5cGUgPT09IDEgJiYgc2libGluZyAhPT0gZSkge1xuICAgICAgICAgICAgc2libGluZ3MucHVzaChzaWJsaW5nKTtcbiAgICAgICAgfVxuXG4gICAgICAgIHNpYmxpbmcgPSBzaWJsaW5nLm5leHRTaWJsaW5nO1xuICAgIH1cblxuICAgIHJldHVybiBzaWJsaW5ncztcbn07XG5cbi8vIFJldHVybnMgdHJ1ZSBpZiBpdCBpcyBhIERPTSBlbGVtZW50XG5leHBvcnQgY29uc3QgaXNFbGVtZW50ID0gKG8pID0+IHtcbiAgICByZXR1cm4gdHlwZW9mIEhUTUxFbGVtZW50ID09PSBcIm9iamVjdFwiXG4gICAgICAgID8gbyBpbnN0YW5jZW9mIEhUTUxFbGVtZW50IC8vIERPTTJcbiAgICAgICAgOiBvICYmIHR5cGVvZiBvID09PSBcIm9iamVjdFwiICYmIG8gIT09IG51bGwgJiYgby5ub2RlVHlwZSA9PT0gMSAmJiB0eXBlb2Ygby5ub2RlTmFtZSA9PT0gXCJzdHJpbmdcIjtcbn07XG5cbmV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSBcImRlZmF1bHRcIikgPT4ge1xuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xuICAgICAgICByZXR1cm47XG4gICAgfVxuXG4gICAgLyoqXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxuICAgICAqL1xuICAgIGpRdWVyeSh3aW5kb3cpLm9uKFwiZWxlbWVudG9yL2Zyb250ZW5kL2luaXRcIiwgKCkgPT4ge1xuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9O1xuXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcbiAgICB9KTtcbn07XG4iLCJjbGFzcyBPRVdfQ2Fyb3VzZWwgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xuICAgICAgICAgICAgICAgIGNhcm91c2VsOiBcIi5vZXctY2Fyb3VzZWwtY29udGFpbmVyXCIsXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWxOZXh0QnRuOiBgLnN3aXBlci1idXR0b24tbmV4dC0ke3RoaXMuZ2V0SUQoKX1gLFxuICAgICAgICAgICAgICAgIGNhcm91c2VsUHJldkJ0bjogYC5zd2lwZXItYnV0dG9uLXByZXYtJHt0aGlzLmdldElEKCl9YCxcbiAgICAgICAgICAgICAgICBjYXJvdXNlbFBhZ2luYXRpb246IGAuc3dpcGVyLXBhZ2luYXRpb24tJHt0aGlzLmdldElEKCl9YCxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBlZmZlY3Q6IFwic2xpZGVcIixcbiAgICAgICAgICAgIGxvb3A6IGZhbHNlLFxuICAgICAgICAgICAgYXV0b3BsYXk6IDAsXG4gICAgICAgICAgICBzcGVlZDogNDAwLFxuICAgICAgICAgICAgbmF2aWdhdGlvbjogZmFsc2UsXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiBmYWxzZSxcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBmYWxzZSxcbiAgICAgICAgICAgIHBhdXNlT25Ib3ZlcjogZmFsc2UsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiB7XG4gICAgICAgICAgICAgICAgd2lkZXNjcmVlbjogMyxcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAzLFxuICAgICAgICAgICAgICAgIGxhcHRvcDogMyxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXG4gICAgICAgICAgICAgICAgdGFibGV0X2V4dHJhOiAyLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogMSxcbiAgICAgICAgICAgICAgICBtb2JpbGVfZXh0cmE6IDEsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHtcbiAgICAgICAgICAgICAgICB3aWRlc2NyZWVuOiAzLFxuICAgICAgICAgICAgICAgIGRlc2t0b3A6IDMsXG4gICAgICAgICAgICAgICAgbGFwdG9wOiAzLFxuICAgICAgICAgICAgICAgIHRhYmxldDogMixcbiAgICAgICAgICAgICAgICB0YWJsZXRfZXh0cmE6IDIsXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxLFxuICAgICAgICAgICAgICAgIG1vYmlsZV9leHRyYTogMSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IHtcbiAgICAgICAgICAgICAgICB3aWRlc2NyZWVuOiAxMCxcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiAxMCxcbiAgICAgICAgICAgICAgICBsYXB0b3A6IDEwLFxuICAgICAgICAgICAgICAgIHRhYmxldDogMTAsXG4gICAgICAgICAgICAgICAgdGFibGV0X2V4dHJhOiAxMCxcbiAgICAgICAgICAgICAgICBtb2JpbGU6IDEwLFxuICAgICAgICAgICAgICAgIG1vYmlsZV9leHRyYTogMTAsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3dpcGVySW5zdGFuY2U6IG51bGwsXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGNhcm91c2VsOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmNhcm91c2VsKSxcbiAgICAgICAgICAgIGNhcm91c2VsTmV4dEJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4pLFxuICAgICAgICAgICAgY2Fyb3VzZWxQcmV2QnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsUHJldkJ0biksXG4gICAgICAgICAgICBjYXJvdXNlbFBhZ2luYXRpb246IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uKSxcbiAgICAgICAgfTtcbiAgICB9XG5cbiAgICBvbkluaXQoLi4uYXJncykge1xuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XG5cbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcbiAgICAgICAgdGhpcy5pbml0U3dpcGVyKCk7XG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xuICAgICAgICB0aGlzLnVwZGF0ZUNhcm91c2VsU3R5bGVzKHRoaXMuZ2V0U2V0dGluZ3MoKSk7XG4gICAgfVxuXG4gICAgc2V0VXNlclNldHRpbmdzKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcbiAgICAgICAgY29uc3QgdXNlclNldHRpbmdzID0gSlNPTi5wYXJzZSh0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmdldEF0dHJpYnV0ZShcImRhdGEtc2V0dGluZ3NcIikpO1xuXG4gICAgICAgIHRoaXMub3JpZ2luYWxBdXRvcGxheUVuYWJsZWQgPSB1c2VyU2V0dGluZ3MuYXV0b3BsYXkgJiYgTnVtYmVyKHVzZXJTZXR0aW5ncy5hdXRvcGxheSkgPiAwO1xuXG4gICAgICAgIGNvbnN0IGN1cnJlbnRTZXR0aW5ncyA9IHtcbiAgICAgICAgICAgIGVmZmVjdDogISF1c2VyU2V0dGluZ3MuZWZmZWN0ID8gdXNlclNldHRpbmdzLmVmZmVjdCA6IHNldHRpbmdzLmVmZmVjdCxcbiAgICAgICAgICAgIGxvb3A6ICEhdXNlclNldHRpbmdzLmxvb3AgPyBCb29sZWFuKE51bWJlcih1c2VyU2V0dGluZ3MubG9vcCkpIDogc2V0dGluZ3MubG9vcCxcbiAgICAgICAgICAgIGF1dG9wbGF5OiAhIXVzZXJTZXR0aW5ncy5hdXRvcGxheSA/IE51bWJlcih1c2VyU2V0dGluZ3MuYXV0b3BsYXkpIDogc2V0dGluZ3MuYXV0b3BsYXksXG4gICAgICAgICAgICBzcGVlZDogISF1c2VyU2V0dGluZ3Muc3BlZWQgPyBOdW1iZXIodXNlclNldHRpbmdzLnNwZWVkKSA6IHNldHRpbmdzLnNwZWVkLFxuICAgICAgICAgICAgbmF2aWdhdGlvbjogISF1c2VyU2V0dGluZ3MuYXJyb3dzID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmFycm93cykpIDogc2V0dGluZ3MubmF2aWdhdGlvbixcbiAgICAgICAgICAgIHBhZ2luYXRpb246ICEhdXNlclNldHRpbmdzLmRvdHMgPyBCb29sZWFuKE51bWJlcih1c2VyU2V0dGluZ3MuZG90cykpIDogc2V0dGluZ3MucGFnaW5hdGlvbixcbiAgICAgICAgICAgIHBhdXNlT25Ib3ZlcjogISF1c2VyU2V0dGluZ3NbXCJwYXVzZS1vbi1ob3ZlclwiXVxuICAgICAgICAgICAgICAgID8gSlNPTi5wYXJzZSh1c2VyU2V0dGluZ3NbXCJwYXVzZS1vbi1ob3ZlclwiXSlcbiAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnBhdXNlT25Ib3ZlcixcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHtcbiAgICAgICAgICAgICAgICB3aWRlc2NyZWVuOiB1c2VyU2V0dGluZ3NbJ2l0ZW1zLXdpZGVzY3JlZW4nXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtd2lkZXNjcmVlbiddKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXdbJ3dpZGVzY3JlZW4nXSxcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiB1c2VyU2V0dGluZ3NbJ2l0ZW1zJ10gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zJ10pIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1snZGVza3RvcCddLFxuICAgICAgICAgICAgICAgIGxhcHRvcDogdXNlclNldHRpbmdzWydpdGVtcy1sYXB0b3AnXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtbGFwdG9wJ10pIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1snbGFwdG9wJ10sXG4gICAgICAgICAgICAgICAgdGFibGV0OiB1c2VyU2V0dGluZ3NbJ2l0ZW1zLXRhYmxldCddICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzWydpdGVtcy10YWJsZXQnXSkgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Wyd0YWJsZXQnXSxcbiAgICAgICAgICAgICAgICB0YWJsZXRfZXh0cmE6IHVzZXJTZXR0aW5nc1snaXRlbXMtdGFibGV0X2V4dHJhJ10gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbJ2l0ZW1zLXRhYmxldF9leHRyYSddKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXdbJ3RhYmxldF9leHRyYSddLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogdXNlclNldHRpbmdzWydpdGVtcy1tb2JpbGUnXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snaXRlbXMtbW9iaWxlJ10pIDogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1snbW9iaWxlJ10sXG4gICAgICAgICAgICAgICAgbW9iaWxlX2V4dHJhOiB1c2VyU2V0dGluZ3NbJ2l0ZW1zLW1vYmlsZV9leHRyYSddICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzWydpdGVtcy1tb2JpbGVfZXh0cmEnXSkgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Wydtb2JpbGVfZXh0cmEnXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiB7XG4gICAgICAgICAgICAgICAgd2lkZXNjcmVlbjogISF1c2VyU2V0dGluZ3NbJ3NsaWRlcy13aWRlc2NyZWVuJ10gPyBOdW1iZXIodXNlclNldHRpbmdzWydzbGlkZXMtd2lkZXNjcmVlbiddKSA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLndpZGVzY3JlZW4sXG4gICAgICAgICAgICAgICAgZGVza3RvcDogISF1c2VyU2V0dGluZ3NbJ3NsaWRlcyddID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snc2xpZGVzJ10pIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAuZGVza3RvcCxcbiAgICAgICAgICAgICAgICBsYXB0b3A6ICEhdXNlclNldHRpbmdzWydzbGlkZXMtbGFwdG9wJ10gPyBOdW1iZXIodXNlclNldHRpbmdzWydzbGlkZXMtbGFwdG9wJ10pIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAubGFwdG9wLFxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbXCJzbGlkZXMtdGFibGV0XCJdXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcInNsaWRlcy10YWJsZXRcIl0pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAudGFibGV0LFxuICAgICAgICAgICAgICAgIHRhYmxldF9leHRyYTogISF1c2VyU2V0dGluZ3NbXCJzbGlkZXMtdGFibGV0X2V4dHJhXCJdXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcInNsaWRlcy10YWJsZXRfZXh0cmFcIl0pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAudGFibGV0X2V4dHJhLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogISF1c2VyU2V0dGluZ3NbXCJzbGlkZXMtbW9iaWxlXCJdXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcInNsaWRlcy1tb2JpbGVcIl0pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAubW9iaWxlLFxuICAgICAgICAgICAgICAgIG1vYmlsZV9leHRyYTogISF1c2VyU2V0dGluZ3NbXCJzbGlkZXMtbW9iaWxlX2V4dHJhXCJdXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcInNsaWRlcy1tb2JpbGVfZXh0cmFcIl0pXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAubW9iaWxlX2V4dHJhLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xuICAgICAgICAgICAgICAgIHdpZGVzY3JlZW46IHVzZXJTZXR0aW5nc1snbWFyZ2luLXdpZGVzY3JlZW4nXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1snbWFyZ2luLXdpZGVzY3JlZW4nXSkgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4ud2lkZXNjcmVlbixcbiAgICAgICAgICAgICAgICBkZXNrdG9wOiB1c2VyU2V0dGluZ3NbJ21hcmdpbiddICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzWydtYXJnaW4nXSkgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4uZGVza3RvcCxcbiAgICAgICAgICAgICAgICBsYXB0b3A6IHVzZXJTZXR0aW5nc1snbWFyZ2luLWxhcHRvcCddICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzWydtYXJnaW4tbGFwdG9wJ10pIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLmxhcHRvcCxcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IHVzZXJTZXR0aW5nc1tcIm1hcmdpbi10YWJsZXRcIl0gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJtYXJnaW4tdGFibGV0XCJdKSA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi50YWJsZXQsXG4gICAgICAgICAgICAgICAgdGFibGV0X2V4dHJhOiB1c2VyU2V0dGluZ3NbXCJtYXJnaW4tdGFibGV0X2V4dHJhXCJdICE9PSB1bmRlZmluZWQgPyBOdW1iZXIodXNlclNldHRpbmdzW1wibWFyZ2luLXRhYmxldF9leHRyYVwiXSkgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4udGFibGV0X2V4dHJhLFxuICAgICAgICAgICAgICAgIG1vYmlsZTogdXNlclNldHRpbmdzW1wibWFyZ2luLW1vYmlsZVwiXSAhPT0gdW5kZWZpbmVkID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcIm1hcmdpbi1tb2JpbGVcIl0pIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLm1vYmlsZSxcbiAgICAgICAgICAgICAgICBtb2JpbGVfZXh0cmE6IHVzZXJTZXR0aW5nc1tcIm1hcmdpbi1tb2JpbGVfZXh0cmFcIl0gIT09IHVuZGVmaW5lZCA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJtYXJnaW4tbW9iaWxlX2V4dHJhXCJdKSA6IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5tb2JpbGVfZXh0cmEsXG5cbiAgICAgICAgICB9LFxuICAgICAgICB9O1xuXG4gICAgICAgIGN1cnJlbnRTZXR0aW5ncy5jZW50ZXJlZFNsaWRlcyA9IGN1cnJlbnRTZXR0aW5ncy5lZmZlY3QgPT09IFwiY292ZXJmbG93XCIgPyB0cnVlIDogc2V0dGluZ3MuY2VudGVyZWRTbGlkZXM7XG5cbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyhjdXJyZW50U2V0dGluZ3MpO1xuXG4gICAgfVxuXG4gICAgdXBkYXRlQ2Fyb3VzZWxTdHlsZXMoc2V0dGluZ3MpIHtcbiAgICAgIGNvbnN0IHsgc3BhY2VCZXR3ZWVuIH0gPSBzZXR0aW5ncztcblxuICAgICAgLy8gY29uc29sZS5sb2coXCJVcGRhdGluZyBDYXJvdXNlbCBTdHlsZXM6XCIsIHNwYWNlQmV0d2Vlbik7IC8vIEZvciBkZWJ1Z2dpbmdcblxuICAgICAgaWYgKHNwYWNlQmV0d2Vlbi5kZXNrdG9wID09PSAwKSB7XG4gICAgICAgICAgLy8gY29uc29sZS5sb2coXCJTZXR0aW5nIG1hcmdpbi1yaWdodCBmb3IgRGVza3RvcFwiKTsgLy8gRm9yIGRlYnVnZ2luZ1xuICAgICAgICAgIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwucXVlcnlTZWxlY3RvckFsbCgnLm9ldy1jYXJvdXNlbC1zbGlkZScpLmZvckVhY2goc2xpZGUgPT4ge1xuICAgICAgICAgICAgICBzbGlkZS5zdHlsZS5tYXJnaW5SaWdodCA9IFwiMHB4XCI7XG4gICAgICAgICAgfSk7XG4gICAgICB9XG4gICAgICBpZiAoc3BhY2VCZXR3ZWVuLnRhYmxldCA9PT0gMCkge1xuICAgICAgICAgIC8vIGNvbnNvbGUubG9nKFwiU2V0dGluZyBtYXJnaW4tcmlnaHQgZm9yIFRhYmxldFwiKTsgLy8gRm9yIGRlYnVnZ2luZ1xuICAgICAgICAgIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwucXVlcnlTZWxlY3RvckFsbCgnLm9ldy1jYXJvdXNlbC1zbGlkZScpLmZvckVhY2goc2xpZGUgPT4ge1xuICAgICAgICAgICAgICBzbGlkZS5zdHlsZS5tYXJnaW5SaWdodCA9IFwiMHB4XCI7XG4gICAgICAgICAgfSk7XG4gICAgICB9XG4gICAgICBpZiAoc3BhY2VCZXR3ZWVuLm1vYmlsZSA9PT0gMCkge1xuICAgICAgICAgIC8vIGNvbnNvbGUubG9nKFwiU2V0dGluZyBtYXJnaW4tcmlnaHQgZm9yIE1vYmlsZVwiKTsgLy8gRm9yIGRlYnVnZ2luZ1xuICAgICAgICAgIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwucXVlcnlTZWxlY3RvckFsbCgnLm9ldy1jYXJvdXNlbC1zbGlkZScpLmZvckVhY2goc2xpZGUgPT4ge1xuICAgICAgICAgICAgICBzbGlkZS5zdHlsZS5tYXJnaW5SaWdodCA9IFwiMHB4XCI7XG4gICAgICAgICAgfSk7XG4gICAgICB9XG4gIH1cblxuXG4gICAgaW5pdFN3aXBlcigpIHtcbiAgICAgICAgY29uc3Qgc3dpcGVyID0gbmV3IFN3aXBlcih0aGlzLmVsZW1lbnRzLmNhcm91c2VsLCB0aGlzLnN3aXBlck9wdGlvbnMoKSk7XG5cbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyh7XG4gICAgICAgICAgICBzd2lwZXJJbnN0YW5jZTogc3dpcGVyLFxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBzd2lwZXJPcHRpb25zKCkge1xuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcblxuICAgICAgICBjb25zdCBzd2lwZXJPcHRpb25zID0ge1xuICAgICAgICAgICAgZGlyZWN0aW9uOiBcImhvcml6b250YWxcIixcbiAgICAgICAgICAgIGVmZmVjdDogc2V0dGluZ3MuZWZmZWN0LFxuICAgICAgICAgICAgbG9vcDogc2V0dGluZ3MubG9vcCxcbiAgICAgICAgICAgIHNwZWVkOiBzZXR0aW5ncy5zcGVlZCxcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBzZXR0aW5ncy5jZW50ZXJlZFNsaWRlcyxcbiAgICAgICAgICAgIGF1dG9IZWlnaHQ6IHRydWUsXG4gICAgICAgICAgICBhdXRvcGxheTogIXNldHRpbmdzLmF1dG9wbGF5XG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGRlbGF5OiBzZXR0aW5ncy5hdXRvcGxheSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiAhc2V0dGluZ3MubmF2aWdhdGlvblxuICAgICAgICAgICAgICAgID8gZmFsc2VcbiAgICAgICAgICAgICAgICA6IHtcbiAgICAgICAgICAgICAgICAgICAgICBuZXh0RWw6IHNldHRpbmdzLnNlbGVjdG9ycy5jYXJvdXNlbE5leHRCdG4sXG4gICAgICAgICAgICAgICAgICAgICAgcHJldkVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQcmV2QnRuLFxuICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246ICFzZXR0aW5ncy5wYWdpbmF0aW9uXG4gICAgICAgICAgICAgICAgPyBmYWxzZVxuICAgICAgICAgICAgICAgIDoge1xuICAgICAgICAgICAgICAgICAgICAgIGVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uLFxuICAgICAgICAgICAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG5cbiAgICAgICAgLy8gRmV0Y2ggRWxlbWVudG9yJ3MgcmVzcG9uc2l2ZSBicmVha3BvaW50c1xuICAgICAgICB2YXIgYnJlYWtwb2ludHMgPSBlbGVtZW50b3JGcm9udGVuZC5jb25maWcucmVzcG9uc2l2ZS5hY3RpdmVCcmVha3BvaW50cztcbiAgICAgICAgdmFyIGJyZWFrcG9pbnRzQm9vdHN0cmFwID0gZWxlbWVudG9yRnJvbnRlbmQuY29uZmlnLmJyZWFrcG9pbnRzO1xuXG4gICAgICAgIGlmIChzZXR0aW5ncy5lZmZlY3QgPT09IFwiZmFkZVwiKSB7XG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zLml0ZW1zID0gMTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICBzd2lwZXJPcHRpb25zLmJyZWFrcG9pbnRzID0ge307XG5cbiAgICAgICAgICAgIGxldCBkZXZpY2VzQnJlYWtQb2ludHMgPSBbXTtcbiAgICAgICAgICAgIGZvciAobGV0IGRldmljZU5hbWUgaW4gYnJlYWtwb2ludHMpIHtcbiAgICAgICAgICAgICAgbGV0IG1heF93aWR0aCA9IGJyZWFrcG9pbnRzW2RldmljZU5hbWVdWydkZWZhdWx0X3ZhbHVlJ107XG4gICAgICAgICAgICAgIGlmKCBicmVha3BvaW50c1tkZXZpY2VOYW1lXVsndmFsdWUnXSAhPT0gdW5kZWZpbmVkICkge1xuICAgICAgICAgICAgICAgIG1heF93aWR0aCA9IGJyZWFrcG9pbnRzW2RldmljZU5hbWVdWyd2YWx1ZSddO1xuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgIGRldmljZXNCcmVha1BvaW50cy5wdXNoKHtcbiAgICAgICAgICAgICAgICAnbGFiZWwnIDogZGV2aWNlTmFtZSxcbiAgICAgICAgICAgICAgICAnbWF4X3dpZHRoJyA6IG1heF93aWR0aFxuICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGRldmljZXNCcmVha1BvaW50cy5zb3J0KChhLCBiKSA9PiB7XG4gICAgICAgICAgICAgIHJldHVybiBhLm1heF93aWR0aCAtIGIubWF4X3dpZHRoXG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgbGV0IHRtcFNsaWRlc1BlclZpZXcgPSAwO1xuXG4gICAgICAgICAgICBsZXQgZGVza3RvcFdpZHRoID0gYnJlYWtwb2ludHNCb290c3RyYXAubGc7XG4gICAgICAgICAgICBmb3IgKGxldCBkZXZpY2VzQnJlYWtQb2ludEl0ZW0gb2YgZGV2aWNlc0JyZWFrUG9pbnRzKSB7XG5cbiAgICAgICAgICAgICAgbGV0IHJlc3BvbnNpdktleVNldHRpbmcgPSBkZXZpY2VzQnJlYWtQb2ludEl0ZW0ubGFiZWw7XG5cbiAgICAgICAgICAgICAgaWYoIHNldHRpbmdzLnNsaWRlc1BlclZpZXdbcmVzcG9uc2l2S2V5U2V0dGluZ10gIT09IHVuZGVmaW5lZCkge1xuICAgICAgICAgICAgICAgIHN3aXBlck9wdGlvbnMuYnJlYWtwb2ludHNbdG1wU2xpZGVzUGVyVmlld10gPSB7XG4gICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3W3Jlc3BvbnNpdktleVNldHRpbmddLFxuICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwW3Jlc3BvbnNpdktleVNldHRpbmddLFxuICAgICAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiBzZXR0aW5ncy5zcGFjZUJldHdlZW5bcmVzcG9uc2l2S2V5U2V0dGluZ10sXG4gICAgICAgICAgICAgICAgfTtcblxuICAgICAgICAgICAgICAgIGlmKCByZXNwb25zaXZLZXlTZXR0aW5nID09PSAnd2lkZXNjcmVlbicgKSB7XG4gICAgICAgICAgICAgICAgICBkZXNrdG9wV2lkdGggPSB0bXBTbGlkZXNQZXJWaWV3O1xuICAgICAgICAgICAgICAgICAgdG1wU2xpZGVzUGVyVmlldyA9IGRldmljZXNCcmVha1BvaW50SXRlbVsnbWF4X3dpZHRoJ107XG4gICAgICAgICAgICAgICAgICBzd2lwZXJPcHRpb25zLmJyZWFrcG9pbnRzW3RtcFNsaWRlc1BlclZpZXddID0ge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3W3Jlc3BvbnNpdktleVNldHRpbmddLFxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJHcm91cDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXBbcmVzcG9uc2l2S2V5U2V0dGluZ10sXG4gICAgICAgICAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuW3Jlc3BvbnNpdktleVNldHRpbmddLFxuICAgICAgICAgICAgICAgICAgfTtcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgdG1wU2xpZGVzUGVyVmlldyA9IHBhcnNlSW50KGRldmljZXNCcmVha1BvaW50SXRlbVsnbWF4X3dpZHRoJ10pICsgMTtcbiAgICAgICAgICAgICAgICAgIGRlc2t0b3BXaWR0aCA9IHRtcFNsaWRlc1BlclZpZXc7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHN3aXBlck9wdGlvbnMuYnJlYWtwb2ludHNbZGVza3RvcFdpZHRoXSA9IHtcbiAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogc2V0dGluZ3Muc2xpZGVzUGVyVmlld1snZGVza3RvcCddLFxuICAgICAgICAgICAgICBzbGlkZXNQZXJHcm91cDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXBbJ2Rlc2t0b3AnXSxcbiAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiBzZXR0aW5ncy5zcGFjZUJldHdlZW5bJ2Rlc2t0b3AnXSxcbiAgICAgICAgICAgIH07XG5cbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiBzd2lwZXJPcHRpb25zO1xuICAgIH1cblxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICBpZiAodGhpcy5vcmlnaW5hbEF1dG9wbGF5RW5hYmxlZCAmJiB0aGlzLmdldFNldHRpbmdzKFwicGF1c2VPbkhvdmVyXCIpKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwuYWRkRXZlbnRMaXN0ZW5lcihcIm1vdXNlZW50ZXJcIiwgdGhpcy5wYXVzZVN3aXBlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgdGhpcy5lbGVtZW50cy5jYXJvdXNlbC5hZGRFdmVudExpc3RlbmVyKFwibW91c2VsZWF2ZVwiLCB0aGlzLnJlc3VtZVN3aXBlci5iaW5kKHRoaXMpKTtcbiAgICAgIH1cbiAgICB9XG5cbiAgICBwYXVzZVN3aXBlcigpIHtcbiAgICAgIGlmICh0aGlzLmdldFNldHRpbmdzKFwic3dpcGVySW5zdGFuY2VcIikuYXV0b3BsYXkucnVubmluZykge1xuICAgICAgICAgIHRoaXMuZ2V0U2V0dGluZ3MoXCJzd2lwZXJJbnN0YW5jZVwiKS5hdXRvcGxheS5zdG9wKCk7XG4gICAgICB9XG4gICAgfVxuXG4gIHJlc3VtZVN3aXBlcigpIHtcbiAgICAgIGlmICghdGhpcy5nZXRTZXR0aW5ncyhcInN3aXBlckluc3RhbmNlXCIpLmF1dG9wbGF5LnJ1bm5pbmcpIHtcbiAgICAgICAgICB0aGlzLmdldFNldHRpbmdzKFwic3dpcGVySW5zdGFuY2VcIikuYXV0b3BsYXkuc3RhcnQoKTtcbiAgICAgIH1cbiAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBPRVdfQ2Fyb3VzZWw7XG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcbmltcG9ydCBPRVdfQ2Fyb3VzZWwgZnJvbSBcIi4vYmFzZS9jYXJvdXNlbFwiO1xuXG5jbGFzcyBPRVdfV29vU2xpZGVyIGV4dGVuZHMgT0VXX0Nhcm91c2VsIHt9XG5cbnJlZ2lzdGVyV2lkZ2V0KE9FV19Xb29TbGlkZXIsIFwib2V3LXdvby1zbGlkZXJcIik7XG4iXX0=
