(global["webpackJsonp"] = global["webpackJsonp"] || []).push([["plugins/mch/mch/add-goods/add-goods"],{

/***/ 1210:
/*!************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/main.js?{"page":"plugins%2Fmch%2Fmch%2Fadd-goods%2Fadd-goods"} ***!
  \************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(createPage) {__webpack_require__(/*! uni-pages */ 5);


var _vue = _interopRequireDefault(__webpack_require__(/*! vue */ 4));
var _addGoods = _interopRequireDefault(__webpack_require__(/*! ./plugins/mch/mch/add-goods/add-goods.vue */ 1211));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };} // @ts-ignore
wx.__webpack_require_UNI_MP_PLUGIN__ = __webpack_require__;createPage(_addGoods.default);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["createPage"]))

/***/ }),

/***/ 1211:
/*!*************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/mch/mch/add-goods/add-goods.vue ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./add-goods.vue?vue&type=template&id=0a5fe6fe&scoped=true& */ 1212);
/* harmony import */ var _add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./add-goods.vue?vue&type=script&lang=js& */ 1214);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _add_goods_vue_vue_type_style_index_0_id_0a5fe6fe_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./add-goods.vue?vue&type=style&index=0&id=0a5fe6fe&scoped=true&lang=scss& */ 1216);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/runtime/componentNormalizer.js */ 11);

var renderjs





/* normalize component */

var component = Object(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0a5fe6fe",
  null,
  false,
  _add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"],
  renderjs
)

component.options.__file = "plugins/mch/mch/add-goods/add-goods.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ 1212:
/*!********************************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/mch/mch/add-goods/add-goods.vue?vue&type=template&id=0a5fe6fe&scoped=true& ***!
  \********************************************************************************************************************************/
/*! exports provided: render, staticRenderFns, recyclableRender, components */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./add-goods.vue?vue&type=template&id=0a5fe6fe&scoped=true& */ 1213);
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "recyclableRender", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["recyclableRender"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "components", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_template_id_0a5fe6fe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"]; });



/***/ }),

/***/ 1213:
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/mch/mch/add-goods/add-goods.vue?vue&type=template&id=0a5fe6fe&scoped=true& ***!
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
      _vm.set_attr = !_vm.set_attr
    }

    _vm.e1 = function($event) {
      _vm.is_default_services = !_vm.is_default_services
    }
  }
}
var recyclableRender = false
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ 1214:
/*!**************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/mch/mch/add-goods/add-goods.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/babel-loader/lib!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./add-goods.vue?vue&type=script&lang=js& */ 1215);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 1215:
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/mch/mch/add-goods/add-goods.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _regenerator = _interopRequireDefault(__webpack_require__(/*! ./node_modules/@babel/runtime/regenerator */ 25));




















































































































































































































































































































var _vuex = __webpack_require__(/*! vuex */ 13);
var _upload = _interopRequireDefault(__webpack_require__(/*! ../../../../core/upload.js */ 515));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {try {var info = gen[key](arg);var value = info.value;} catch (error) {reject(error);return;}if (info.done) {resolve(value);} else {Promise.resolve(value).then(_next, _throw);}}function _asyncToGenerator(fn) {return function () {var self = this,args = arguments;return new Promise(function (resolve, reject) {var gen = fn.apply(self, args);function _next(value) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);}function _throw(err) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);}_next(undefined);});};}function _createForOfIteratorHelper(o, allowArrayLike) {var it;if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {if (it) o = it;var i = 0;var F = function F() {};return { s: F, n: function n() {if (i >= o.length) return { done: true };return { done: false, value: o[i++] };}, e: function e(_e) {throw _e;}, f: F };}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");}var normalCompletion = true,didErr = false,err;return { s: function s() {it = o[Symbol.iterator]();}, n: function n() {var step = it.next();normalCompletion = step.done;return step;}, e: function e(_e2) {didErr = true;err = _e2;}, f: function f() {try {if (!normalCompletion && it.return != null) it.return();} finally {if (didErr) throw err;}} };}function _unsupportedIterableToArray(o, minLen) {if (!o) return;if (typeof o === "string") return _arrayLikeToArray(o, minLen);var n = Object.prototype.toString.call(o).slice(8, -1);if (n === "Object" && o.constructor) n = o.constructor.name;if (n === "Map" || n === "Set") return Array.from(o);if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);}function _arrayLikeToArray(arr, len) {if (len == null || len > arr.length) len = arr.length;for (var i = 0, arr2 = new Array(len); i < len; i++) {arr2[i] = arr[i];}return arr2;}function ownKeys(object, enumerableOnly) {var keys = Object.keys(object);if (Object.getOwnPropertySymbols) {var symbols = Object.getOwnPropertySymbols(object);if (enumerableOnly) symbols = symbols.filter(function (sym) {return Object.getOwnPropertyDescriptor(object, sym).enumerable;});keys.push.apply(keys, symbols);}return keys;}function _objectSpread(target) {for (var i = 1; i < arguments.length; i++) {var source = arguments[i] != null ? arguments[i] : {};if (i % 2) {ownKeys(Object(source), true).forEach(function (key) {_defineProperty(target, key, source[key]);});} else if (Object.getOwnPropertyDescriptors) {Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));} else {ownKeys(Object(source)).forEach(function (key) {Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));});}}return target;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}var _default =

{
  data: function data() {
    return {
      id: 0,
      postageIndex: -1,
      deliveryIndex: -1,
      height: 0,
      beSubmit: false,
      form: {
        cats: [],
        mchCats: [],
        name: '',
        cost_price: '',
        price: '',
        original_price: '',
        type: 'goods',
        attr_default_name: '默认规格' },

      forehead: -1,
      unit: '件',
      set_attr: false,
      iphone_x: false,
      modal: false,
      error: false,
      set_cat: false,
      set_mch_cat: false,
      set_postage: false,
      set_delivery: false,
      set_service: false,
      is_default_services: true,
      confine: false,
      is_service: false,
      img: [],
      cat: [],
      mch: 0,
      mch_cat: [],
      goods_detail: [],
      beMove: false,
      service: [],
      postage: [],
      beCat: [],
      beMchCat: [],
      isChooseCat: ['未选择'],
      delivery: [],
      bePostage: '',
      beDelivery: '',
      beService: [],
      newIndex: '0',
      index: '0',
      attr: false,
      have_children: false,
      disabled: true,
      imgHidden: true,
      flag: false,
      x: 0,
      y: 0,
      first_service: true,
      choose_list: [],
      elements: [],
      img_src: '',
      dialogType: '',
      dialog: false,
      inputName: true,
      beginIndex: null,
      loading: false,
      limit_buy_status: 0,
      min_number: 1,
      limit_buy_first: true,
      limit_buy_second: true,
      limit_buy_type: 'day',
      limit_buy_value: -1 };

  },

  computed: _objectSpread({},
  (0, _vuex.mapState)({
    userInfo: function userInfo(state) {return state.user.info;},
    adminImg: function adminImg(state) {return state.mallConfig.__wxapp_img.app_admin;} })),


  methods: {
    bindChange: function bindChange(e) {
      this.newIndex = e.detail.value[0];
    },
    toggle: function toggle(status) {
      this.choose_list = [];
      this.dialog = false;
      this.set_cat = false;
      if (this.dialogType == 'postage') {
        if (status == 1) {
          if (this.set_postage) {
            this.bePostage = this.postage[this.newIndex];
          }
        } else {
          this.set_postage = false;
        }
      }
      if (this.dialogType == 'delivery') {
        if (status == 1) {
          if (this.set_delivery) {
            this.beDelivery = this.delivery[this.newIndex];
          }
        } else {
          this.set_delivery = false;
        }
      }
      this.dialogType = '';
    },
    money: function money(val) {
      var num = val.toString(); //先转换成字符串类型
      if (num.indexOf('.') == 0) {//第一位就是 .
        num = '0' + num;
      }
      num = num.replace(/[^\d.]/g, ""); //清除“数字”和“.”以外的字符
      num = num.replace(/\.{2,}/g, "."); //只保留第一个. 清除多余的
      num = num.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
      num = num.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3'); //只能输入两个小数
      if (num.indexOf(".") < 0 && num != "") {
        num = parseFloat(num);
      }
      return +num;
    },
    costChange: function costChange(e) {
      this.form.cost_price = this.money(e.detail.value);
    },
    originalChange: function originalChange(e) {
      this.form.original_price = this.money(e.detail.value);
    },
    priceChange: function priceChange(e) {
      this.form.price = this.money(e.detail.value);
    },
    nameBlur: function nameBlur() {
      this.inputName = !this.inputName;
    },
    changeConfine: function changeConfine() {
      this.confine = !this.confine;
      if (this.confine && this.form.confine_count == -1) {
        this.form.confine_count = '';
      }
    },
    chooseAttr: function chooseAttr() {
      uni.navigateTo({
        url: '/plugins/mch/mch/goods-attr/goods-attr' });

      this.$storage.setStorageSync('goods_unit', this.unit);
    },
    toSubmit: function toSubmit() {
      var that = this;
      if (that.loading) {
        return false;
      }
      uni.showLoading({
        title: '提交中...' });

      that.beSubmit = false;
      that.loading = true;
      that.$request({
        url: that.$api.mch.edit,
        data: {
          form: JSON.stringify(that.form),
          mch_id: that.mch_id },

        method: 'post' }).
      then(function (response) {
        that.loading = false;
        that.$hideLoading();
        if (response.code == 0) {
          that.$hideLoading();
          uni.hideLoading();
          if (response.code == 0) {
            uni.showToast({
              title: response.msg,
              duration: 1000 });

            setTimeout(function () {
              uni.navigateBack();
            }, 500);
          } else {
            uni.showToast({
              title: response.msg,
              icon: 'none',
              duration: 1000 });

          }
        } else {
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        that.loading = false;
        that.$hideLoading();
        uni.hideLoading();
      });
    },

    submit: function submit() {
      var pass = false;
      var that = this;
      var form = that.form;
      form.status = this.form.status ? this.form.status : 1;
      form.cats = [];
      form.mchCats = [];
      if (that.beCat.length == 0) {
        that.error = '请设置商品分类';
        return false;
      } else {
        that.beCat.forEach(function (row) {
          form.cats.push(row.value);
        });
      }
      if (that.beMchCat.length == 0) {
        that.error = '请设置多商户分类';
        return false;
      } else {
        that.beMchCat.forEach(function (row) {
          form.mchCats.push(row.value);
        });
      }
      if (that.img.length > 0) {
        form.pic_url = that.img;
      } else {
        that.error = '请上传商品图片';
        return false;
      }
      if (!form.name) {
        that.error = '请设置商品名称';
        return false;
      }
      if (!that.unit) {
        that.error = '请设置商品单位';
        return false;
      } else {
        form.unit = that.unit;
      }
      if (form.cost_price != 0 && !form.cost_price) {
        that.error = '请设置商品成本价';
        return false;
      }
      if (form.cost_price < 0) {
        that.error = '成本价不得小于零';
        return false;
      }
      if (form.original_price != 0 && !form.original_price) {
        that.error = '请设置商品原价';
        return false;
      }
      if (form.original_price < 0) {
        that.error = '商品原价不得小于零';
        return false;
      }
      if (form.price != 0 && !form.price) {
        that.error = '请设置商品售价';
        return false;
      }
      if (!that.set_attr) {
        form.use_attr = 0;
        form.attr = [];
        if (!form.goods_num) {
          that.error = '商品库存不得为空';
          return false;
        } else if (form.goods_num < 0) {
          that.error = '商品库存不得小于零';
          return false;
        } else {
          pass = true;
        }
      } else {
        form.use_attr = 1;
        form.goods_num = 0;
        if (!form.attr_groups || form.attr_groups.length == 0) {
          that.error = '请设置商品规格';
          return false;
        } else {
          pass = true;
        }
      }
      form.cards = that.goods_card;
      form.is_default_services = 1;
      form.services = [];
      that.form.limit_buy_status = that.confine ? 1 : 0;
      if (that.is_default_services == 0) {
        form.is_default_services = 0;
        if (that.beService.length > 0) {
          form.services = that.beService;
        }
      }
      if (that.goods_detail.length > 0) {
        form.detail = '';
        for (var i in that.goods_detail) {
          if (that.goods_detail[i].type == "img") {
            form.detail += '<p><img src="' + that.goods_detail[i].pic_url + '"/></p>';
          } else if (that.goods_detail[i].type == "line") {
            form.detail += '<p><img src="' + that.adminImg.line + '"/></p>';
          } else if (that.goods_detail[i].type == "text") {
            form.detail += '<p>' + that.goods_detail[i].text + '</p>';
          }
        }
      } else {
        that.error = '请设置图文描述';
        return false;
      }
      if (that.forehead_integral) {
        if (that.forehead_integral > 0) {
          form.forehead_integral_type = 1;
          form.forehead_integral = that.forehead_integral;
        } else {
          form.forehead_integral_type = 2;
          form.forehead_integral = that.forehead_integral.replace('%', '');
        }
      }
      if (that.give_integral) {
        if (that.give_integral > 0) {
          form.give_integral_type = 1;
          form.give_integral = that.give_integral;
        } else {
          form.give_integral_type = 2;
          form.give_integral = that.give_integral.replace('%', '');
        }
      }
      if (!form.virtual_sales) {
        form.virtual_sales = 0;
      }
      if (!form.cover_pic) {
        form.cover_pic = '';
      }
      if (!form.sort) {
        form.sort = 100;
      }
      if (!form.accumulative) {
        form.accumulative = 1;
      }
      if (!form.member_price) {
        form.member_price = {};
      }
      form.freight_id = that.bePostage.id;
      form.freight = that.bePostage;
      form.shipping_id = that.beDelivery.id;
      form.shipping = that.beDelivery;
      if (!form.individual_share) {
        form.individual_share = 0;
      }
      if (!form.is_level) {
        form.is_level = 0;
      }
      if (!form.individual_share) {
        form.individual_share = 0;
      }
      if (!form.video_url) {
        form.video_url = '';
      }
      form.mch_id = that.mch_id;
      form.sign = 'mch';
      if (pass) {
        that.form = form;
        if (that.id > 0) {
          that.form.id = that.id;
          that.toSubmit();
        } else {
          that.beSubmit = true;
        }
      }
    },

    close: function close() {
      this.error = null;
      this.set_cat = false;
      this.set_mch_cat = false;
      this.set_postage = false;
      this.set_service = false;
      this.modal = false;
    },

    inputAttr: function inputAttr(index) {
      this.attr[index].attr_list[0].attr_id = (+index + 2).toString();
    },

    _longtap: function _longtap(img_src, index, e) {
      var that = this;
      var query = uni.createSelectorQuery();
      var nodesRef = query.selectAll(".move-img");
      nodesRef.fields({
        dataset: true,
        rect: true },

      function (result) {
        that.elements = result;
      }).exec();
      // const detail = e.detail;
      that.img[index].pic_url = '';
      that.x = e.currentTarget.offsetLeft;
      that.y = e.currentTarget.offsetTop;
      that.imgHidden = false;
      that.flag = true;
      that.beMove = true;
      that.img_src = img_src;
      that.beginIndex = index;
    },
    //触摸结束
    touchend: function touchend(e) {
      var that = this;
      if (!that.flag) {
        return;
      }
      var x = e.changedTouches[0].pageX;
      var y = e.changedTouches[0].pageY;
      var list = that.elements;
      var data = that.img;
      var beginIndex = that.beginIndex;
      for (var j = 0; j < list.length; j++) {
        var item = list[j];
        if (x > item.left && x < item.right && y > item.top && y < item.bottom) {
          var endIndex = item.dataset.index;
          //向后移动
          if (beginIndex < endIndex) {
            var tem = data[beginIndex];
            for (var i = beginIndex; i < endIndex; i++) {
              data[i] = data[i + 1];
            }
            data[endIndex] = tem;
          }
          //向前移动
          if (beginIndex > endIndex) {
            var _tem = data[beginIndex];
            for (var _i = beginIndex; _i > endIndex; _i--) {
              data[_i] = data[_i - 1];
            }
            data[endIndex] = _tem;
          }
          data[endIndex].pic_url = that.img_src;
          that.img = data;
        }
      }
      if (!that.img[beginIndex].pic_url) {
        that.img[beginIndex].pic_url = that.img_src;
      }
      that.imgHidden = true;
      that.flag = false;
      that.beMove = false;
      that.beginIndex = null;
    },
    //滑动
    touchm: function touchm(e) {
      if (this.flag) {
        var x = e.touches[0].pageX;
        var y = e.touches[0].pageY;
        this.x = x - 60;
        this.y = y - 129;
      }
    },
    cancelService: function cancelService() {
      var beService = this.beService;
      var service = this.service;
      if (beService.length > 0) {
        service.forEach(function (res) {
          res.isChoose = false;
          beService.forEach(function (row) {
            if (row.id == res.id) {
              res.isChoose = true;
            }
          });
        });
      } else {
        service.forEach(function (res) {
          res.isChoose = false;
        });
      }
      this.beService = beService;
      this.service = service;
      this.set_service = false;
      this.is_service = false;
    },

    submitService: function submitService() {
      var beService = [];
      this.service.forEach(function (row) {
        if (row.isChoose) {
          beService.push(row);
        }
      });
      this.beService = beService;
      this.set_service = false;
      this.is_service = false;
    },
    choose: function choose(item) {
      var that = this;
      that.service.forEach(function (row) {
        if (row.id == item.id) {
          row.isChoose = !row.isChoose;
          that.$forceUpdate();
        }
      });
    },
    toGoodsDetail: function toGoodsDetail() {
      uni.navigateTo({
        url: '/plugins/mch/mch/goods-detail/goods-detail?mch_id=' + this.mch_id });

    },
    add_img: function add_img() {
      var that = this;
      var num = 9 - that.img.length;

      uni.chooseImage({
        count: num,
        sizeType: ['original', 'compressed'],
        sourceType: ['album', 'camera'],
        success: function success(res) {
          // tempFilePath可以作为img标签的src属性显示图片
          var tempFilePaths = res.tempFilePaths;
          var img = that.img;
          tempFilePaths.forEach(function (row, index) {
            uni.showLoading({
              title: '上传中...' });

            var fileName = '';




            (0, _upload.default)({
              url: that.$api.upload.file,
              filePath: row,
              fileType: 'image',
              fileName: fileName,
              mch_id: that.mch_id }).
            then(function (res) {

              var imgInfo = JSON.parse(res.data);




              var para = {
                pic_url: imgInfo.data.url,
                id: imgInfo.data.id };

              if (imgInfo.code == 0) {
                img.push(para);
              }
              that.img = img;
              if (index == tempFilePaths.length - 1) {
                uni.hideLoading();
              }
            });
          });
        } });





























































    },
    del_img: function del_img(index) {
      this.img.splice(index, 1);
    },
    chooseCat: function chooseCat(type) {
      uni.navigateTo({
        url: '/pages/goods-edit/goods-cat/goods-cat?type=' + type + '&mch_id=' + this.mch_id });

    },
    chooseService: function chooseService() {
      var that = this;
      if (that.first_service) {
        that.$request({
          url: that.$api.mch.service,
          data: {
            mch_id: that.mch_id } }).

        then(function (response) {
          that.$hideLoading();
          if (response.code == 0) {
            that.service = response.data.list;
            if (response.data.list.length == 0) {
              that.modal = true;
            } else {
              that.is_service = true;
            }
            var beService = [];var _iterator = _createForOfIteratorHelper(
            response.data.list),_step;try {for (_iterator.s(); !(_step = _iterator.n()).done;) {var row = _step.value;
                row.isChoose = false;
                if (that.is_default_services == 1) {
                  if (row.is_default == 1) {
                    beService.push(row);
                    row.isChoose = true;
                  }
                } else {var _iterator2 = _createForOfIteratorHelper(
                  that.beService),_step2;try {for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {var item = _step2.value;
                      if (row.id == item.id) {
                        row.isChoose = true;
                      }
                    }} catch (err) {_iterator2.e(err);} finally {_iterator2.f();}
                }
              }} catch (err) {_iterator.e(err);} finally {_iterator.f();}
            that.set_service = true;
            if (that.is_default_services == 1) {
              that.beService = beService;
              that.default_service = beService;
            }
            that.first_service = false;
          } else {
            uni.showToast({
              title: response.msg,
              icon: 'none',
              duration: 1000 });

          }
        }).catch(function () {
          that.$hideLoading();
        });
      } else {
        if (that.service.length == 0) {
          that.modal = true;
        } else {
          that.is_service = true;
        }
      }
    },
    chooseExpress: function chooseExpress() {
      var that = this;
      that.$request({
        url: that.$api.mch.postage,
        data: {
          mch_id: that.mch_id } }).

      then(function (response) {
        that.$hideLoading();
        if (response.code == 0) {
          if (response.data.list.length == 0) {
            that.set_postage = true;
            that.modal = true;
            that.postage = response.data.list;
          } else {
            var arr = [];
            response.data.list.forEach(function (row, index) {
              arr.push(response.data.list[index].id);
            });
            var index = arr.indexOf(that.bePostage.id);
            if (index > -1) {
              that.postageIndex = +index;
              that.newIndex = +index;
            } else {
              that.bePostage = '';
            }
            that.set_postage = true;
            that.dialog = true;
            that.dialogType = 'postage';
            that.postage = response.data.list;
          }
        } else {
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        that.$hideLoading();
      });
    },
    chooseDelivery: function chooseDelivery() {
      var that = this;
      that.$request({
        url: that.$api.mch.delivery_rules,
        data: {
          mch_id: that.mch_id } }).

      then(function (response) {
        that.$hideLoading();
        if (response.code == 0) {
          if (response.data.list.length == 0) {
            that.set_delivery = true;
            that.modal = true;
            that.delivery = response.data.list;
          } else {
            var arr = [];
            response.data.list.forEach(function (row, index) {
              arr.push(response.data.list[index].id);
            });
            var index = arr.indexOf(that.beDelivery.id);
            if (index > -1) {
              that.deliveryIndex = +index;
              that.newIndex = +index;
            } else {
              that.beDelivery = '';
            }
            that.set_delivery = true;
            that.dialog = true;
            that.dialogType = 'delivery';
            that.delivery = response.data.list;
          }
        } else {
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        that.$hideLoading();
      });
    },
    getService: function getService() {
      var that = this;
      that.$request({
        url: that.$api.mch.service,
        data: {
          mch_id: that.mch_id } }).

      then(function (response) {
        that.$hideLoading();
        if (response.code == 0) {
          that.service = response.data.list;
          for (var i in that.service) {
            that.service[i].isChoose = false;
          }
          if (id > 0) {
            for (var j in that.beService) {
              for (var _i2 in that.service) {
                if (that.service[_i2].id == that.beService[j].id) {
                  that.service[_i2].isChoose = true;
                  that.first_service = false;
                }
              }
            }
          } else {
            that.beService = [];
            data.list.forEach(function (row) {
              row.isChoose = false;
              if (row.is_default == 1) {
                that.beService.push(row);
                row.isChoose = true;
              }
            });
          }
        } else {
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        that.$hideLoading();
      });
    },
    getPostage: function getPostage(id) {
      var that = this;
      that.$request({
        url: that.$api.mch.postage,
        data: {
          mch_id: that.mch_id } }).

      then(function (response) {
        that.$hideLoading();
        if (response.code == 0) {
          that.postage = response.data.list;
          if (id > 0) {
            return false;
          } else {
            that.bePostage = '';
            that.bePostage = response.data.list[0];
          }
        } else {
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        that.$hideLoading();
      });
    },
    getDelivery: function getDelivery(id) {
      var that = this;
      this.$request({
        url: this.$api.mch.delivery_rules,
        data: {
          mch_id: that.mch_id } }).

      then(function (response) {
        that.$hideLoading();
        if (response.code == 0) {
          that.delivery = response.data.list;
          if (id > 0) {
            return false;
          } else {
            that.beDelivery = '';
            that.beDelivery = response.data.list[0];
          }
        } else {
          uni.showToast({
            title: response.msg,
            icon: 'none',
            duration: 1000 });

        }
      }).catch(function () {
        that.$hideLoading();
      });
    },
    getDetail: function getDetail(id) {var _this = this;return _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee() {var res, code, data, msg, _this$form, pic_url, cats, use_attr, mchCats, services, freight, cards, confine_count, is_default_services, forehead_integral, forehead_integral_type, give_integral, give_integral_type, attr_groups, attr, detail, unit, shipping, min_number, limit_buy_status, limit_buy_type, limit_buy_value, form_detail, good_detail, para, i, end, _i3;return _regenerator.default.wrap(function _callee$(_context) {while (1) {switch (_context.prev = _context.next) {case 0:_context.next = 2;return (
                  _this.$request({
                    url: _this.$api.mch.goods_edit,
                    data: {
                      id: id,
                      mch_id: _this.mch_id } }));case 2:res = _context.sent;


                code = res.code, data = res.data, msg = res.msg;_context.next = 6;return (
                  _this.$hideLoading());case 6:
                _this.getService(id);
                _this.getPostage(id);
                _this.getDelivery(id);
                if (code === 0) {
                  _this.form = data.detail;_this$form =







                  _this.form, pic_url = _this$form.pic_url, cats = _this$form.cats, use_attr = _this$form.use_attr, mchCats = _this$form.mchCats, services = _this$form.services, freight = _this$form.freight, cards = _this$form.cards, confine_count = _this$form.confine_count, is_default_services = _this$form.is_default_services, forehead_integral = _this$form.forehead_integral, forehead_integral_type = _this$form.forehead_integral_type, give_integral = _this$form.give_integral, give_integral_type = _this$form.give_integral_type, attr_groups = _this$form.attr_groups, attr = _this$form.attr, detail = _this$form.detail, unit = _this$form.unit, shipping = _this$form.shipping, min_number = _this$form.min_number, limit_buy_status = _this$form.limit_buy_status, limit_buy_type = _this$form.limit_buy_type, limit_buy_value = _this$form.limit_buy_value;
                  _this.img = pic_url;
                  _this.beCat = cats;
                  _this.beMchCat = mchCats;
                  _this.set_attr = use_attr == 1 ? true : false;
                  _this.beService = services;
                  _this.bePostage = freight;
                  _this.goods_card = cards;
                  _this.beDelivery = shipping;
                  _this.unit = unit;
                  _this.min_number = min_number;

                  if (limit_buy_status == 1) {
                    _this.confine = true;
                  }

                  if (confine_count > 0) {
                    _this.limit_buy_first = false;
                  }
                  if (limit_buy_value > 0) {
                    _this.limit_buy_second = false;
                  }

                  if (is_default_services == 0) _this.is_default_services = false;

                  _this.forehead_integral = +forehead_integral;
                  if (forehead_integral_type == 2) _this.forehead_integral = forehead_integral + '%';

                  _this.give_integral = +give_integral;
                  if (give_integral_type == 2) _this.give_integral = give_integral + '%';

                  if (attr_groups.length > 0 && attr.length > 0) {
                    _this.attr = true;
                    _this.$storage.setStorageSync('goods_attr_groups', attr_groups);
                    _this.$storage.setStorageSync('goods_attr', attr);
                  }
                  form_detail = detail.split(/<\/p>|<br\/>|<img /);
                  good_detail = [];

                  para = undefined;

                  for (i in form_detail) {
                    form_detail[i] = form_detail[i].replace(/<p>/g, '').replace(/<\/p>/g, '');
                    para = { type: '' };
                    if (form_detail[i].indexOf('src') > -1) {
                      para.type = 'img';
                      para.id = '';
                      end = form_detail[i].indexOf('.png') > -1 ? form_detail[i].indexOf('.png') + 4 : form_detail[i].length - 1;
                      if (form_detail[i].indexOf('.jpg') > -1) {
                        end = form_detail[i].indexOf('.jpg') + 4;
                      }
                      if (form_detail[i].indexOf('.jpeg') > -1) {
                        end = form_detail[i].indexOf('.jpeg') + 5;
                      }
                      if (form_detail[i].indexOf('.gif') > -1) {
                        end = form_detail[i].indexOf('.gif') + 4;
                      }
                      para.pic_url = form_detail[i].slice(form_detail[i].indexOf('http'), end);
                    } else {
                      para.type = 'text';
                      para.text = form_detail[i];
                    }
                    good_detail[i] = para;
                  }

                  for (_i3 in good_detail) {
                    if (good_detail[_i3].text === '') {
                      good_detail.splice(_i3, 1);
                    }
                  }
                  _this.goods_detail = good_detail;
                  _this.$storage.setStorageSync('goods_card', cards);
                  _this.$storage.setStorageSync('mch_goods_cat', _this.beCat);
                  _this.$storage.setStorageSync('mch_goods_mch_cat', _this.beMchCat);
                  _this.$storage.setStorageSync('goods_detail', good_detail);
                } else {
                  uni.showToast({
                    title: msg,
                    icon: 'none',
                    duration: 1000 });

                }case 10:case "end":return _context.stop();}}}, _callee);}))();
    },
    limitBuyFirstChange: function limitBuyFirstChange(e) {
      if (e.target.value === '1') {
        this.limit_buy_first = true;
        this.form.confine_count = -1;
      } else {
        this.limit_buy_first = false;
        this.form.confine_count = '';
      }
    } },


  onLoad: function onLoad(options) {this.$commonLoad.onload(options);
    var that = this;
    uni.getSystemInfo({
      success: function success(res) {
        if (res.model.indexOf('iPhone X') > -1 || res.model.indexOf('iPhone 11') > -1 || res.model.indexOf('iPhone11') > -1 || res.model.indexOf('iPhone12') > -1 || res.model.indexOf('Unknown Device') > -1) {
          that.iphone_x = true;
        }
      } });

    that.mch_id = options.mch_id;
    uni.getSystemInfo({
      success: function success(res) {
        var clientHeight = res.windowHeight;
        var clientWidth = res.windowWidth;
        var ratio = 750 / clientWidth;
        that.height = clientHeight * ratio;
      } });

    this.$storage.removeStorageSync('mch_goods_cat');
    this.$storage.removeStorageSync('mch_goods_mch_cat');
    this.$storage.removeStorageSync('goods_unit');
    this.$storage.removeStorageSync('goods_attr_groups');
    this.$storage.removeStorageSync('goods_attr');
    this.$storage.removeStorageSync('temp_attr');
    this.$storage.removeStorageSync('temp_attr_info');
    this.$storage.removeStorageSync('goods_detail');
    that.goods_card = [];
    that.goods_detail = [];
    if (options.id > 0) {
      that.$showLoading({
        type: 'global',
        text: '加载中...' });

      that.id = options.id;
      setTimeout(function () {
        uni.setNavigationBarTitle({
          title: '编辑商品' });

        that.getDetail(options.id);
      }, 500);
    } else {
      that.getService();
      that.getPostage();
      that.getDelivery();
    }
  },
  onShow: function onShow() {
    this.goods_card = this.$storage.getStorageSync('goods_card') ? this.$storage.getStorageSync('goods_card') : [];
    this.beCat = this.$storage.getStorageSync('mch_goods_cat') ? this.$storage.getStorageSync('mch_goods_cat') : [];
    this.beMchCat = this.$storage.getStorageSync('mch_goods_mch_cat') ? this.$storage.getStorageSync('mch_goods_mch_cat') : [];
    this.goods_detail = this.$storage.getStorageSync('goods_detail') ? this.$storage.getStorageSync('goods_detail') : [];
    this.form.attr = this.$storage.getStorageSync('goods_attr') ? this.$storage.getStorageSync('goods_attr') : [];
    if (this.$storage.getStorageSync('goods_attr_groups')) {
      this.form.attr_groups = this.$storage.getStorageSync('goods_attr_groups');
      this.attr = true;
    }
    this.$storage.removeStorageSync('temp_attr');
    this.$storage.removeStorageSync('temp_attr_info');
  } };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 1216:
/*!***********************************************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/mch/mch/add-goods/add-goods.vue?vue&type=style&index=0&id=0a5fe6fe&scoped=true&lang=scss& ***!
  \***********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_style_index_0_id_0a5fe6fe_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/postcss-loader/src??ref--8-oneOf-1-3!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./add-goods.vue?vue&type=style&index=0&id=0a5fe6fe&scoped=true&lang=scss& */ 1217);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_style_index_0_id_0a5fe6fe_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_style_index_0_id_0a5fe6fe_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_style_index_0_id_0a5fe6fe_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_style_index_0_id_0a5fe6fe_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_add_goods_vue_vue_type_style_index_0_id_0a5fe6fe_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 1217:
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!./node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!./node_modules/postcss-loader/src??ref--8-oneOf-1-3!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/plugins/mch/mch/add-goods/add-goods.vue?vue&type=style&index=0&id=0a5fe6fe&scoped=true&lang=scss& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin
    if(false) { var cssReload; }
  

/***/ })

},[[1210,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../../../../.sourcemap/mp-weixin/plugins/mch/mch/add-goods/add-goods.js.map