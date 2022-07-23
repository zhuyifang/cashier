(global["webpackJsonp"] = global["webpackJsonp"] || []).push([["plugins/community/activity/activity"],{

/***/ 1763:
/*!**********************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/main.js?{"page":"plugins%2Fcommunity%2Factivity%2Factivity"} ***!
  \**********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(createPage) {__webpack_require__(/*! uni-pages */ 5);


var _vue = _interopRequireDefault(__webpack_require__(/*! vue */ 4));
var _activity = _interopRequireDefault(__webpack_require__(/*! ./plugins/community/activity/activity.vue */ 1764));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };} // @ts-ignore
wx.__webpack_require_UNI_MP_PLUGIN__ = __webpack_require__;createPage(_activity.default);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["createPage"]))

/***/ }),

/***/ 1764:
/*!*************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/community/activity/activity.vue ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./activity.vue?vue&type=template&id=12733f48&scoped=true& */ 1765);
/* harmony import */ var _activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./activity.vue?vue&type=script&lang=js& */ 1767);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _activity_vue_vue_type_style_index_0_id_12733f48_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./activity.vue?vue&type=style&index=0&id=12733f48&scoped=true&lang=scss& */ 1769);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/runtime/componentNormalizer.js */ 11);

var renderjs





/* normalize component */

var component = Object(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "12733f48",
  null,
  false,
  _activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"],
  renderjs
)

component.options.__file = "plugins/community/activity/activity.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ 1765:
/*!********************************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/community/activity/activity.vue?vue&type=template&id=12733f48&scoped=true& ***!
  \********************************************************************************************************************************/
/*! exports provided: render, staticRenderFns, recyclableRender, components */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./activity.vue?vue&type=template&id=12733f48&scoped=true& */ 1766);
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "recyclableRender", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__["recyclableRender"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "components", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_template_id_12733f48_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"]; });



/***/ }),

/***/ 1766:
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/community/activity/activity.vue?vue&type=template&id=12733f48&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns, recyclableRender, components */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "recyclableRender", function() { return recyclableRender; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "components", function() { return components; });
var components
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  if (!_vm._isMounted) {
    _vm.e0 = function($event) {
      _vm.inputRemark = false
    }

    _vm.e1 = function($event) {
      _vm.inputRemark = true
    }

    _vm.e2 = function($event) {
      _vm.recommendDialog = !_vm.recommendDialog
    }

    _vm.e3 = function($event) {
      _vm.recommendDialog = !_vm.recommendDialog
    }
  }
}
var recyclableRender = false
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ 1767:
/*!**************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/community/activity/activity.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/babel-loader/lib!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./activity.vue?vue&type=script&lang=js& */ 1768);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 1768:
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/community/activity/activity.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;

















































































































































































































































var _vuex = __webpack_require__(/*! vuex */ 13);function _createForOfIteratorHelper(o, allowArrayLike) {var it;if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {if (it) o = it;var i = 0;var F = function F() {};return { s: F, n: function n() {if (i >= o.length) return { done: true };return { done: false, value: o[i++] };}, e: function e(_e) {throw _e;}, f: F };}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");}var normalCompletion = true,didErr = false,err;return { s: function s() {it = o[Symbol.iterator]();}, n: function n() {var step = it.next();normalCompletion = step.done;return step;}, e: function e(_e2) {didErr = true;err = _e2;}, f: function f() {try {if (!normalCompletion && it.return != null) it.return();} finally {if (didErr) throw err;}} };}function _unsupportedIterableToArray(o, minLen) {if (!o) return;if (typeof o === "string") return _arrayLikeToArray(o, minLen);var n = Object.prototype.toString.call(o).slice(8, -1);if (n === "Object" && o.constructor) n = o.constructor.name;if (n === "Map" || n === "Set") return Array.from(o);if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);}function _arrayLikeToArray(arr, len) {if (len == null || len > arr.length) len = arr.length;for (var i = 0, arr2 = new Array(len); i < len; i++) {arr2[i] = arr[i];}return arr2;}function ownKeys(object, enumerableOnly) {var keys = Object.keys(object);if (Object.getOwnPropertySymbols) {var symbols = Object.getOwnPropertySymbols(object);if (enumerableOnly) symbols = symbols.filter(function (sym) {return Object.getOwnPropertyDescriptor(object, sym).enumerable;});keys.push.apply(keys, symbols);}return keys;}function _objectSpread(target) {for (var i = 1; i < arguments.length; i++) {var source = arguments[i] != null ? arguments[i] : {};if (i % 2) {ownKeys(Object(source), true).forEach(function (key) {_defineProperty(target, key, source[key]);});} else if (Object.getOwnPropertyDescriptors) {Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));} else {ownKeys(Object(source)).forEach(function (key) {Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));});}}return target;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}var appHead = function appHead() {__webpack_require__.e(/*! require.ensure | plugins/community/components/app-head */ "plugins/community/components/app-head").then((function () {return resolve(__webpack_require__(/*! ../components/app-head.vue */ 3267));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var appShareQrCode = function appShareQrCode() {__webpack_require__.e(/*! require.ensure | components/page-component/app-share-qr-code-poster/app-share-qr-code-poster */ "components/page-component/app-share-qr-code-poster/app-share-qr-code-poster").then((function () {return resolve(__webpack_require__(/*! ../../../components/page-component/app-share-qr-code-poster/app-share-qr-code-poster.vue */ 2273));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var uAttr = function uAttr() {Promise.all(/*! require.ensure | components/page-component/goods/u-attr */[__webpack_require__.e("common/vendor"), __webpack_require__.e("components/page-component/goods/u-attr")]).then((function () {return resolve(__webpack_require__(/*! ../../../components/page-component/goods/u-attr.vue */ 2343));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var AppClose = function AppClose() {__webpack_require__.e(/*! require.ensure | components/basic-component/app-close/app-close */ "components/basic-component/app-close/app-close").then((function () {return resolve(__webpack_require__(/*! ../../../components/basic-component/app-close/app-close.vue */ 2399));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var _default =





{
  data: function data() {
    return {
      activeIndex: 0,
      nav_list: [],
      cat_id: -1,
      id: null,
      showCart: false,
      is_loading: false,
      submitLock: false,
      recommendDialog: false,
      showShare: false,
      stopLoad: false,
      showOther: false,
      more: false,
      is_middleman: false,
      share: false,
      default: false,
      inputRemark: true,
      cartLength: 0,
      windowHeight: 0,
      is_exist: 0,
      page: 1,
      poster: '',
      mobile: '',
      remark: '',
      d: '',
      h: '',
      m: '',
      s: '',
      selectAttr: {},
      animationData: {},
      animation: {},
      attr_price: '0.00',
      number: 1,
      space: '0m',
      display: 'none',
      // attrShow: 0,
      attrShow: false,
      scrollTop: 0,
      scrollHeight: 0,
      goods: null,
      timeInterval: null,
      buyBool: true,
      longitude: '',
      latitude: '',
      activity: {
        rate: 0 },

      middleman: {},
      setting: {},
      recommend: {},
      list: [],
      cart: [],
      user_list: [],
      template_message_list: [],
      end_time: '1小时前',
      title: '',
      total: '0.00',
      minus: '0.00',
      middleman_id: 0,
      first: true,
      showClose: false,
      is_open: false,
      disable: 'disable' };

  },
  components: {
    appShareQrCode: appShareQrCode,
    appHead: appHead,
    uAttr: uAttr,
    AppClose: AppClose },

  computed: _objectSpread(_objectSpread({},
  (0, _vuex.mapGetters)('mallConfig', {
    getTheme: 'getTheme' })),

  (0, _vuex.mapState)({
    community: function community(state) {return state.mallConfig.__wxapp_img.community;},
    bonusImg: function bonusImg(state) {return state.mallConfig.__wxapp_img.bonus;},
    appImg: function appImg(state) {return state.mallConfig.__wxapp_img.mall;},
    appSetting: function appSetting(state) {return state.mallConfig.mall.setting;},
    userInfo: function userInfo(state) {return state.user.info;} })),


  onLoad: function onLoad(options) {var _this = this;this.$commonLoad.onload(options);
    var that = this;
    if (options.activity_id) {
      this.id = options.activity_id;
    }
    if (options.id) {
      this.id = options.id;
    }
    this.title = options.title;
    uni.setNavigationBarTitle({
      title: options.title });

    uni.getSystemInfo({
      success: function success(res) {
        that.windowHeight = res.windowHeight;
      } });


    uni.getLocation({
      success: function success(e) {
        uni.hideLoading();
        that.longitude = e.longitude;
        that.latitude = e.latitude;
        if (_this.$storage.getStorageSync('middleman_info')) {
          var middleman = _this.$storage.getStorageSync('middleman_info');
          if (middleman.id > 0) {
            if (options.middleman_id) {
              that.middleman_id = options.middleman_id;
              that.share = true;
            } else {
              that.middleman_id = middleman.user_id;
            }
          }
        } else {
          if (options.middleman_id) {
            that.middleman_id = options.middleman_id;
            that.share = true;
          }
        }
        that.$showLoading({
          type: 'global',
          text: '加载中...' });

        that.getSetting();
      },
      fail: function fail() {
        uni.hideLoading();
        uni.showModal({
          title: '提示',
          content: '获取位置信息失败，需要授权获取您的位置信息',
          showCancel: false,
          confirmText: '打开授权',
          success: function success(e) {
            if (e.confirm) {
              uni.openSetting({});
            }
          } });

      } });
















































































































    wx.showShareMenu({
      menus: ['shareAppMessage', 'shareTimeline'] });


  },
  onUnload: function onUnload() {
    this.stopLoad = true;
    clearInterval(this.timeInterval);
  },
  onHide: function onHide() {
    this.stopLoad = true;
    clearInterval(this.timeInterval);
  },
  onShow: function onShow() {
    var that = this;
    if (this.stopLoad) {
      this.stopLoad = false;
      if (this.$storage.getStorageSync('bind')) {
        var bindInfo = this.$storage.getStorageSync('bind');
        if (bindInfo > 0) {
          that.$showLoading({
            type: 'global',
            text: '加载中...' });

          that.middleman = {};
          that.middleman_id = 0;
          if (this.$storage.getStorageSync('middleman_info')) {
            var middleman = this.$storage.getStorageSync('middleman_info');
            if (middleman.id > 0) {
              that.middleman_id = middleman.user_id;
            }
            that.getActivity('reload');
          } else {
            that.getActivity('reload');
          }
          this.$storage.removeStorageSync('bind');
        } else {
          that.getActivity('reload');
        }
      } else {
        if (that.id > 0) {
          that.getActivity();
        }
      }
    }
  },

  onShareAppMessage: function onShareAppMessage() {
    return this.hShareAppMessage();
  },

  methods: {
    hShareAppMessage: function hShareAppMessage() {var s = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      return this.$shareAppMessage({
        title: this.setting.app_share_title ? this.setting.app_share_title : this.title,
        imageUrl: this.setting.app_share_pic ? this.setting.app_share_pic : this.list[0].cover_pic,
        path: "/plugins/community/activity/activity",
        params: {
          id: this.id,
          user_id: this.userInfo.options.user_id,
          middleman_id: this.middleman.user_id } },

      s);
    },
    changeStatus: function changeStatus(id, index) {
      this.cat_id = id;
      this.page = 1;
      if (index < 2) {
        this.activeIndex = 0;
      } else {
        this.activeIndex = index - 2;
      }
      uni.showLoading({
        mask: true,
        title: '加载中' });

      this.getList(this.middleman.user_id);
    },
    requestCats: function requestCats(middleman_id) {var _this2 = this;
      this.$request({
        url: this.$api.community.cats,
        data: {
          id: this.id,
          middleman_id: middleman_id ? middleman_id : this.middleman.user_id } }).

      then(function (res) {
        if (res.code === 0) {
          _this2.nav_list = res.data.list;
          _this2.getList(middleman_id);
        }
      });
    },
    toSubmit: function toSubmit() {var _this3 = this;
      this.showClose = false;
      setTimeout(function () {
        _this3.showClose = true;
      });
    },
    getMall: function getMall(e) {
      this.is_open = e.is_open == 1 ? true : false;
      if (this.is_open) {
        this.allBuy();
      }
    },
    scroll: function scroll(e) {
      this.scrollHeight = e.detail.scrollTop;
    },
    getMore: function getMore() {
      if (this.more) {
        this.page++;
        uni.showLoading({
          mask: true,
          title: '加载更多' });

        this.getOther();
        this.more = false;
      }
    },
    getOther: function getOther() {
      var that = this;
      var para = {
        id: that.id,
        middleman_id: that.middleman.user_id,
        page: that.page };

      if (that.cat_id > 0) {
        para.cat_id = that.cat_id;
      }
      that.$request({
        url: that.$api.community.activity_goods,
        data: para }).
      then(function (response) {
        uni.hideLoading();
        that.$hideLoading();
        if (response.code === 0) {
          if (response.data.list.length === 20) {
            that.more = true;
          }
          that.list = that.list.concat(response.data.list);
        }
      });
    },
    openCart: function openCart() {
      this.showCart = !this.showCart;
      this.stopLoad = true;
      if (this.showCart == false) {
        this.stopLoad = false;
        this.getActivity();
      }
    },
    toList: function toList() {
      if (this.middleman.is_allow_change === '0') {
        return false;
      }
      uni.navigateTo({
        url: '/plugins/community/captain/captain?longitude=' + this.longitude + '&latitude=' + this.latitude });

    },
    showHiddenClick: function showHiddenClick() {
      this.showShare = !this.showShare;
    },
    toGoods: function toGoods(item) {
      this.stopLoad = true;
      uni.navigateTo({
        url: '/plugins/community/goods/goods?goods_id=' + item.id + '&middleman_id=' + this.middleman.user_id });

    },
    toIndex: function toIndex() {
      this.stopLoad = true;
      uni.navigateTo({
        url: '/plugins/community/index/index' });

    },
    toOrder: function toOrder() {
      this.stopLoad = true;
      uni.navigateTo({
        url: '/plugins/community/order/order?is_user=1' });

    },
    toUser: function toUser() {
      this.stopLoad = true;
      uni.navigateTo({
        url: '/pages/user-center/user-center' });

    },
    toActivity: function toActivity() {
      this.stopLoad = true;
      uni.redirectTo({
        url: '/plugins/community/activity/activity?id=' + this.recommend.activity_id });

    },
    attr: function attr(e) {
      this.selectAttr = e.item;
      this.number = e.number;
      this.attr_price = (+this.selectAttr.price * +this.number).toFixed(2);
    },
    imgLoad: function imgLoad() {
      this.is_loading = true;
    },
    allBuy: function allBuy() {var _this4 = this;
      if (this.submitLock) {
        return false;
      }
      this.showCart = false;
      this.scrollTop = this.scrollHeight;
      if (this.default) {
        this.$nextTick().then(function () {
          _this4.scrollTop = 9999999;
          _this4.default = false;
        });
        uni.showToast({
          title: '请确认手机号',
          icon: 'none',
          duration: 1000 });

        return false;
      }
      if (this.mobile.length == 11 && /0?(1)[0-9]{10}/.test(this.mobile)) {
        this.$subscribe(this.template_message_list).then(function (res) {
          _this4.submit();
        }).catch(function () {
          _this4.submit();
        });
      } else {
        this.$nextTick().then(function () {
          _this4.scrollTop = 9999999;
        });
        this.stopLoad = false;
        this.getActivity();
        uni.showToast({
          title: '请输入正确的手机号码',
          icon: 'none',
          duration: 1000 });

      }
    },
    submit: function submit() {var _this5 = this;
      uni.showLoading({
        mask: true,
        title: '提交订单...' });

      this.stopLoad = true;
      this.submitLock = true;
      var goods_list = [];
      for (var i in this.cart) {
        if (this.cart[i].is_exist == 1) {
          var para = {};
          para.id = this.cart[i].goods_id;
          para.goods_attr_id = this.cart[i].goods_attr_id;
          para.num = this.cart[i].num;
          para.cart_id = this.cart[i].id;
          para.attr = this.cart[i].attr_list;
          para.cat_id = 0;
          para.form_data = [];
          goods_list.push(para);
        }
      }
      if (goods_list.length === 0) {
        uni.showToast({
          title: '请添加有效商品',
          icon: 'none',
          duration: 1000 });

        return false;
      }
      var mch_list = [{
        mch_id: 0,
        activity_id: this.id,
        middleman_id: this.middleman.user_id,
        goods_list: goods_list,
        distance: 0,
        remark: this.remark,
        order_form: [],
        use_integral: 0,
        user_coupon_id: 0 }];

      var form = {};
      form.list = mch_list;
      form.address_id = 0;
      form.address = {
        name: this.userInfo.nickname,
        mobile: this.mobile };

      this.$request({
        url: this.$api.community.order_submit,
        data: {
          form_data: JSON.stringify(form) },

        method: 'post' }).
      then(function (response) {
        if (response.code === 0) {
          _this5.getPayOrderId(response.data.queue_id, response.data.token);
        } else {
          _this5.submitLock = false;
          _this5.stopLoad = false;
          uni.hideLoading();
          uni.showModal({
            title: '提示',
            content: response.msg,
            showCancel: false });

        }
      }).catch(function (e) {
        _this5.submitLock = false;
        _this5.stopLoad = false;
        uni.hideLoading();
        uni.showModal({
          title: '提示',
          content: e.errMsg,
          showCancel: false });

      });
    },
    getPayOrderId: function getPayOrderId(queue_id, token) {var _this6 = this;
      this.$request({
        url: this.$api.order.pay_data,
        method: 'post',
        data: {
          queue_id: queue_id,
          token: token } }).

      then(function (response) {
        if (response.code === 0) {
          if (response.data.retry && response.data.retry === 1) {
            _this6.getPayDataTimer = setTimeout(function () {
              _this6.getPayOrderId(queue_id, token);
            }, 1000);
          } else {
            uni.hideLoading();
            _this6.cart = [];
            _this6.pay(response.data);
          }
        } else {
          _this6.submitLock = false;
          uni.hideLoading();
          uni.showModal({
            title: '提示',
            content: response.msg,
            showCancel: false });

        }
      }).catch(function (e) {
        _this6.submitLock = false;
        uni.hideLoading();
        uni.showModal({
          title: '提示',
          content: e.errMsg,
          showCancel: false });

      });
    },
    pay: function pay(data) {var _this7 = this;
      this.$storage.removeStorageSync('middleman_info');
      this.$payment.pay(data.id).then(function () {
        _this7.submitLock = false;
        var url = '/plugins/community/order/order';
        uni.navigateTo({
          url: "/pages/order-submit/pay-result?payment_order_union_id=".concat(data.id, "&order_page_url=").concat(url) });

      }).catch(function () {
        _this7.submitLock = false;
        _this7.toOrder();
      });
    },
    _calcValue: function _calcValue(index, type) {
      if (type === 'minus') {
        this.cart[index].num--;
      } else if (type === 'plus') {
        this.cart[index].num++;
      }
      this._onBlur(index);
    },
    _onBlur: function _onBlur(index) {
      this.total = 0;
      this.cartLength = 0;
      for (var i in this.cart) {
        this.total = +this.total + +this.cart[i].price * this.cart[i].num;
        this.cartLength += +this.cart[i].num;
      }
      var minus = 0;
      for (var _i in this.activity.full_price) {
        if (+this.activity.full_price[_i].full_price < +this.total || +this.activity.full_price[_i].full_price == +this.total) {
          if (this.activity.full_price[_i].reduce_price > minus) {
            minus = +this.activity.full_price[_i].reduce_price;
          }
        }
      }
      this.total = (+this.total - minus).toFixed(2);
      this.minus = minus.toFixed(2);
      if (this.cart[index].num == 0) {
        this.delCart(index);
      } else {
        this.$request({
          url: this.$api.community.cart_edit,
          data: {
            list: JSON.stringify(this.cart) } });


      }
    },
    clearAll: function clearAll() {var _this8 = this;
      var cart = [];
      for (var i in this.cart) {
        cart.push(this.cart[i].id);
      }
      this.cart = [];
      this.showCart = false;
      this.$request({
        url: this.$api.community.cart_delete,
        data: {
          cart_id_list: JSON.stringify(cart) } }).

      then(function () {
        _this8.stopLoad = false;
        _this8.getActivity();
      });
    },
    delCart: function delCart(index) {var _this9 = this;
      var list = [];
      list.push(this.cart[index].id);
      this.cart.splice(index, 1);
      this.total = 0;
      this.cartLength = 0;
      for (var i in this.cart) {
        this.total = +this.total + +this.cart[i].price * this.cart[i].num;
        this.cartLength += +this.cart[i].num;
      }
      var minus = 0;
      for (var _i2 in this.activity.full_price) {
        if (+this.activity.full_price[_i2].full_price < +this.total || +this.activity.full_price[_i2].full_price == +this.total) {
          if (this.activity.full_price[_i2].reduce_price > minus) {
            minus = +this.activity.full_price[_i2].reduce_price;
          }
        }
      }
      this.total = (+this.total - minus).toFixed(2);
      this.minus = minus.toFixed(2);
      if (this.cart.length === 0) {
        this.showCart = false;
      }
      this.$request({
        url: this.$api.community.cart_delete,
        data: {
          cart_id_list: list } }).

      then(function () {
        _this9.stopLoad = false;
        _this9.getActivity();
      }).catch(function () {
        _this9.attrShow = false;
        uni.hideLoading();
      });
    },
    add: function add() {var _this10 = this;
      uni.showLoading({
        mask: true,
        title: '加入购物车' });

      var para = {
        activity_id: this.id,
        goods_id: this.selectAttr.goods_id,
        goods_attr_id: this.selectAttr.id,
        num: this.number };

      this.$request({
        url: this.$api.community.cart_add,
        data: para,
        method: 'post' }).
      then(function (response) {
        if (response.code === 0) {
          _this10.addResult(response.data.queue_id, response.data.token);
        } else {
          uni.hideLoading();
          _this10.attrShow = false;
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        _this10.attrShow = false;
        uni.hideLoading();
      });
    },
    addResult: function addResult(queue_id, token) {var _this11 = this;
      this.$request({
        url: this.$api.community.cart_result,
        method: 'post',
        data: {
          queue_id: queue_id,
          token: token } }).

      then(function (response) {
        if (response.code === 0) {
          if (response.data && response.data.retry === 1) {
            _this11.getResult = setTimeout(function () {
              _this11.addResult(queue_id, token);
            }, 1000);
          } else {
            _this11.attrShow = false;
            var index = -1;
            for (var i in _this11.cart) {
              if (_this11.cart[i].goods_id == _this11.selectAttr.goods_id && _this11.cart[i].goods_attr_id == _this11.selectAttr.id) {
                index = i;
              }
            }
            if (index > -1) {
              _this11.cart[index].num += +_this11.number;
            } else {
              var para = {
                activity_id: _this11.id,
                community_goods_id: _this11.goods.id,
                goods_id: _this11.selectAttr.goods_id,
                goods_attr_id: _this11.selectAttr.id,
                num: _this11.number,
                name: _this11.goods.name,
                attr_list: _this11.selectAttr.attr_list,
                pic_url: _this11.selectAttr.pic_url,
                id: 0,
                price: _this11.selectAttr.price,
                is_exist: 1 };

              _this11.cart.push(para);
            }
            _this11.total = 0;
            _this11.cartLength = 0;var _iterator = _createForOfIteratorHelper(
            _this11.cart),_step;try {for (_iterator.s(); !(_step = _iterator.n()).done;) {var item = _step.value;
                _this11.total = +_this11.total + +item.price * item.num;
                _this11.cartLength += +item.num;
              }} catch (err) {_iterator.e(err);} finally {_iterator.f();}
            var minus = 0;
            for (var _i3 in _this11.activity.full_price) {
              if (+_this11.activity.full_price[_i3].full_price < +_this11.total || +_this11.activity.full_price[_i3].full_price == +_this11.total) {
                if (_this11.activity.full_price[_i3].reduce_price > minus) {
                  minus = +_this11.activity.full_price[_i3].reduce_price;
                }
              }
            }
            _this11.total = (+_this11.total - minus).toFixed(2);
            _this11.minus = minus.toFixed(2);
            uni.hideLoading();
            setTimeout(function () {
              _this11.goods = null;
            });
          }
        } else {
          uni.hideLoading();
          uni.showModal({
            title: '提示',
            content: response.msg,
            showCancel: false });

        }
      }).catch(function (e) {
        _this11.attrShow = false;
        uni.hideLoading();
        uni.showModal({
          title: '提示',
          content: e.errMsg,
          showCancel: false });

      });
    },
    toBuy: function toBuy(item) {
      if (!item.buy_goods_auth) {
        this.$tips.showToast({
          title: '您暂无权限购买该商品',
          icon: 'none' });

        return;
      }
      this.selectAttr = null;
      this.goods = item;
      this.attrShow = true;
    },
    getCart: function getCart() {
      var that = this;
      if (that.stopLoad) {
        return false;
      }
      that.$request({
        url: that.$api.community.cart,
        data: {
          middleman_id: that.middleman.user_id,
          activity_id: that.activity.id } }).

      then(function (response) {
        if (that.stopLoad) {
          return false;
        }
        if (response.code === 0) {
          that.total = 0;
          that.cartLength = 0;
          that.cart = response.data.list;
          that.is_exist = 0;
          for (var i in that.cart) {
            if (that.cart[i].is_exist == 0) {
              that.is_exist++;
            }
            that.total = +that.total + +that.cart[i].price * that.cart[i].num;
            that.cartLength += +that.cart[i].num;
          }
          var minus = 0;
          for (var _i4 in that.activity.full_price) {
            if (+that.activity.full_price[_i4].full_price < +that.total || +that.activity.full_price[_i4].full_price == +that.total) {
              if (that.activity.full_price[_i4].reduce_price > minus) {
                minus = +that.activity.full_price[_i4].reduce_price;
              }
            }
          }
          that.total = (+that.total - minus).toFixed(2);
          that.minus = minus.toFixed(2);

        } else {
          that.stopLoad = true;
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

          if (response.msg === '所选活动已下架') {
            setTimeout(function () {
              uni.navigateBack({});
            }, 1000);
          }
        }
      }).catch(function () {
        that.$hideLoading();
      });
    },
    getTime: function getTime(time) {
      if (time > 86399) {
        this.d = Math.floor(time / 86400);
        time = time - 86400 * this.d;
      } else {
        this.d = 0;
      }
      if (time > 3599) {
        this.h = Math.floor(time / 3600);
        if (this.h < 10) {
          this.h = '0' + this.h;
        }
        time = time - 3600 * this.h;
      } else {
        this.h = '00';
      }
      if (time > 59) {
        this.m = Math.floor(time / 60);
        if (this.m < 10) {
          this.m = '0' + this.m;
        }
        time = time - 60 * this.m;
      } else {
        this.m = '00';
      }
      if (time < 60) {
        this.s = time;
        if (this.s < 10) {
          this.s = '0' + this.s;
        }
      }
    },
    getSetting: function getSetting() {
      var that = this;
      that.$request({
        url: that.$api.community.setting }).
      then(function (response) {
        if (response.code === 0) {
          that.head = that.community.a;
          switch (that.getTheme.key) {
            case 'b':
              that.head = that.community.b;
              break;
            case 'c':
              that.head = that.community.c;
              break;
            case 'd':
              that.head = that.community.d;
              break;
            case 'e':
              that.head = that.community.e;
              break;
            case 'g':
              that.head = that.community.g;
              break;
            case 'h':
              that.head = that.community.h;
              break;
            case 'i':
              that.head = that.community.i;
              break;}

          that.setting = response.data;
          that.getActivity();
        } else {
          that.$hideLoading();
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        that.$hideLoading();
      });
    },
    getList: function getList(middleman_id) {
      var that = this;
      var para = {
        type: 1,
        id: that.id };

      para.middleman_id = middleman_id ? middleman_id : that.middleman.user_id;
      if (that.cat_id > 0) {
        para.cat_id = that.cat_id;
      }
      that.$request({
        url: that.$api.community.activity_goods,
        data: para }).
      then(function (response) {
        uni.hideLoading();
        that.$hideLoading();
        if (response.data.list.length === 0) {
          that.page = 1;
          that.stopLoad = true;
          uni.showToast({
            title: '活动商品异常，正在返回活动主页',
            icon: 'none',
            duration: 1000 });

          setTimeout(function () {
            uni.redirectTo({
              url: '/plugins/community/list/list' });

          }, 1000);
          return false;
        }
        that.list = response.data.list;
        response.data.list.length < 20 ? that.more = false : that.more = true;
      });
    },
    getActivity: function getActivity(string) {var _this12 = this;
      var that = this;
      var para = {
        id: that.id,
        longitude: that.longitude,
        latitude: that.latitude };

      if (that.middleman_id > 0) {
        para.middleman_id = that.middleman_id;
      }
      that.$request({
        url: that.$api.community.user_activity,
        data: para }).
      then(function (response) {
        if (response.code === 0) {
          if (that.nav_list.length == 0 || string == 'reload') {
            that.requestCats(response.data.middleman_info.user_id);
          }
          if (!that.mobile && response.data.last_mobile) {
            that.mobile = response.data.last_mobile;
            that.default = true;
          }
          that.activity = response.data.activity;
          that.is_middleman = response.data.is_middleman;
          that.middleman = response.data.middleman_info;
          if (that.middleman_id == 0) {
            if (_this12.$storage.getStorageSync('middleman_info')) {
              var middleman = _this12.$storage.getStorageSync('middleman_info');
              if (middleman.id > 0) {
                that.middleman = middleman;
              }
            }
          }
          that.space = ~~that.middleman.distance + 'm';
          if (that.middleman.distance > 1000) {
            that.space = (that.middleman.distance / 1000).toFixed(1) + 'km';
          }
          if (that.share) {
            _this12.$storage.setStorageSync('middleman_info', that.middleman);
          }
          that.user_list = response.data.user_list;
          if (that.user_list.length > that.activity.user_num) {
            that.user_list = that.user_list.slice(0, that.activity.user_num);
          }
          that.template_message_list = response.data.template_message_list;
          if (that.activity.activity_status == 1) {
            if (!that.stopLoad) {
              setTimeout(function () {
                that.getActivity();
              }, 8000);
            }
            that.getCart();
            var end_time = Math.floor(that.user_list[that.user_list.length - 1].time / 60);
            if (end_time > 60) {
              that.end_time = '1小时前';
            } else if (end_time == 0) {
              that.end_time = '刚刚';
            } else {
              that.end_time = end_time + '分钟前';
            }
          }
          if (that.activity.activity_status == 2 && response.data.recommend_activity.activity_id > 0) {
            setTimeout(function () {
              that.recommend = response.data.recommend_activity;
              that.recommendDialog = true;
              var animation = uni.createAnimation({
                duration: 1000,
                timingFunction: 'ease' });

              that.animation = animation;

              setTimeout(function () {
                animation.bottom(0).step();
                that.animationData = animation.export();
                setTimeout(function () {
                  that.showOther = true;
                }, 1500);
              }, 200);
            }, 800);
          }
          if (that.activity.time > 0) {
            var time = that.activity.time;
            that.timeInterval = setInterval(function () {
              that.getTime(time);
              time--;
              if (time == 0) {
                clearInterval(that.timeInterval);
                that.getActivity();
              }
            }, 1000);
          }
        } else {
          that.stopLoad = true;
          if (response.msg === '周边没有活动可参加') {
            uni.showToast({
              title: '周边没有活动可参加，正在返回活动主页',
              icon: 'none',
              duration: 1000 });

            setTimeout(function () {
              uni.redirectTo({
                url: '/plugins/community/list/list' });

            }, 1000);
          } else {
            uni.showToast({
              title: response.msg,
              icon: 'none',
              duration: 1000 });

          }
        }
      }).catch(function () {
        uni.hideLoading();
        that.$hideLoading();
      });
    } },


  onShareTimeline: function onShareTimeline() {
    return this.$shareTimeline({
      title: this.share_title ? this.share_title : this.title,
      query: {
        id: this.id,
        user_id: this.userInfo.options.user_id,
        middleman_id: this.middleman.user_id } });


  } };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 1769:
/*!***********************************************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/community/activity/activity.vue?vue&type=style&index=0&id=12733f48&scoped=true&lang=scss& ***!
  \***********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_style_index_0_id_12733f48_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/postcss-loader/src??ref--8-oneOf-1-3!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./activity.vue?vue&type=style&index=0&id=12733f48&scoped=true&lang=scss& */ 1770);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_style_index_0_id_12733f48_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_style_index_0_id_12733f48_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_style_index_0_id_12733f48_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_style_index_0_id_12733f48_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_activity_vue_vue_type_style_index_0_id_12733f48_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 1770:
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!./node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!./node_modules/postcss-loader/src??ref--8-oneOf-1-3!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/community/activity/activity.vue?vue&type=style&index=0&id=12733f48&scoped=true&lang=scss& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin
    if(false) { var cssReload; }
  

/***/ })

},[[1763,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../../../.sourcemap/mp-weixin/plugins/community/activity/activity.js.map