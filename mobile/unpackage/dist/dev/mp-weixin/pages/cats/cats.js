(global["webpackJsonp"] = global["webpackJsonp"] || []).push([["pages/cats/cats"],{

/***/ 169:
/*!************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/main.js?{"page":"pages%2Fcats%2Fcats"} ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(createPage) {__webpack_require__(/*! uni-pages */ 5);


var _vue = _interopRequireDefault(__webpack_require__(/*! vue */ 4));
var _cats = _interopRequireDefault(__webpack_require__(/*! ./pages/cats/cats.vue */ 170));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };} // @ts-ignore
wx.__webpack_require_UNI_MP_PLUGIN__ = __webpack_require__;createPage(_cats.default);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["createPage"]))

/***/ }),

/***/ 170:
/*!*****************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/cats/cats.vue ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cats.vue?vue&type=template&id=315b3726&scoped=true& */ 171);
/* harmony import */ var _cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./cats.vue?vue&type=script&lang=js& */ 173);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _cats_vue_vue_type_style_index_0_id_315b3726_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./cats.vue?vue&type=style&index=0&id=315b3726&lang=scss&scoped=true& */ 176);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/runtime/componentNormalizer.js */ 11);

var renderjs





/* normalize component */

var component = Object(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "315b3726",
  null,
  false,
  _cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"],
  renderjs
)

component.options.__file = "pages/cats/cats.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ 171:
/*!************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/cats/cats.vue?vue&type=template&id=315b3726&scoped=true& ***!
  \************************************************************************************************************/
/*! exports provided: render, staticRenderFns, recyclableRender, components */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./cats.vue?vue&type=template&id=315b3726&scoped=true& */ 172);
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "recyclableRender", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__["recyclableRender"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "components", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_template_id_315b3726_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"]; });



/***/ }),

/***/ 172:
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/cats/cats.vue?vue&type=template&id=315b3726&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
}
var recyclableRender = false
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ 173:
/*!******************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/cats/cats.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/babel-loader/lib!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./cats.vue?vue&type=script&lang=js& */ 174);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 174:
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/cats/cats.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _regenerator = _interopRequireDefault(__webpack_require__(/*! ./node_modules/@babel/runtime/regenerator */ 25));




















































































































































































var _vuex = __webpack_require__(/*! vuex */ 13);












var _routeJump = _interopRequireDefault(__webpack_require__(/*! ../../core/routeJump.js */ 175));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {try {var info = gen[key](arg);var value = info.value;} catch (error) {reject(error);return;}if (info.done) {resolve(value);} else {Promise.resolve(value).then(_next, _throw);}}function _asyncToGenerator(fn) {return function () {var self = this,args = arguments;return new Promise(function (resolve, reject) {var gen = fn.apply(self, args);function _next(value) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);}function _throw(err) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);}_next(undefined);});};}function _toConsumableArray(arr) {return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread();}function _nonIterableSpread() {throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");}function _unsupportedIterableToArray(o, minLen) {if (!o) return;if (typeof o === "string") return _arrayLikeToArray(o, minLen);var n = Object.prototype.toString.call(o).slice(8, -1);if (n === "Object" && o.constructor) n = o.constructor.name;if (n === "Map" || n === "Set") return Array.from(o);if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);}function _iterableToArray(iter) {if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter);}function _arrayWithoutHoles(arr) {if (Array.isArray(arr)) return _arrayLikeToArray(arr);}function _arrayLikeToArray(arr, len) {if (len == null || len > arr.length) len = arr.length;for (var i = 0, arr2 = new Array(len); i < len; i++) {arr2[i] = arr[i];}return arr2;}function ownKeys(object, enumerableOnly) {var keys = Object.keys(object);if (Object.getOwnPropertySymbols) {var symbols = Object.getOwnPropertySymbols(object);if (enumerableOnly) symbols = symbols.filter(function (sym) {return Object.getOwnPropertyDescriptor(object, sym).enumerable;});keys.push.apply(keys, symbols);}return keys;}function _objectSpread(target) {for (var i = 1; i < arguments.length; i++) {var source = arguments[i] != null ? arguments[i] : {};if (i % 2) {ownKeys(Object(source), true).forEach(function (key) {_defineProperty(target, key, source[key]);});} else if (Object.getOwnPropertyDescriptors) {Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));} else {ownKeys(Object(source)).forEach(function (key) {Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));});}}return target;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}var styleOne = function styleOne() {__webpack_require__.e(/*! require.ensure | pages/cats/style-one */ "pages/cats/style-one").then((function () {return resolve(__webpack_require__(/*! ./style-one.vue */ 2442));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleTwo = function styleTwo() {__webpack_require__.e(/*! require.ensure | pages/cats/style-two */ "pages/cats/style-two").then((function () {return resolve(__webpack_require__(/*! ./style-two */ 2449));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleThree = function styleThree() {__webpack_require__.e(/*! require.ensure | pages/cats/style-three */ "pages/cats/style-three").then((function () {return resolve(__webpack_require__(/*! ./style-three.vue */ 2456));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleFour = function styleFour() {__webpack_require__.e(/*! require.ensure | pages/cats/style-four */ "pages/cats/style-four").then((function () {return resolve(__webpack_require__(/*! ./style-four.vue */ 2463));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleFive = function styleFive() {__webpack_require__.e(/*! require.ensure | pages/cats/style-five */ "pages/cats/style-five").then((function () {return resolve(__webpack_require__(/*! ./style-five.vue */ 2470));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleSix = function styleSix() {__webpack_require__.e(/*! require.ensure | pages/cats/style-six */ "pages/cats/style-six").then((function () {return resolve(__webpack_require__(/*! ./style-six.vue */ 2477));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleSeven = function styleSeven() {__webpack_require__.e(/*! require.ensure | pages/cats/style-seven */ "pages/cats/style-seven").then((function () {return resolve(__webpack_require__(/*! ./style-seven.vue */ 2484));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleEight = function styleEight() {__webpack_require__.e(/*! require.ensure | pages/cats/style-eight */ "pages/cats/style-eight").then((function () {return resolve(__webpack_require__(/*! ./style-eight.vue */ 2491));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleNine = function styleNine() {__webpack_require__.e(/*! require.ensure | pages/cats/style-nine */ "pages/cats/style-nine").then((function () {return resolve(__webpack_require__(/*! ./style-nine.vue */ 2498));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleTen = function styleTen() {__webpack_require__.e(/*! require.ensure | pages/cats/style-ten */ "pages/cats/style-ten").then((function () {return resolve(__webpack_require__(/*! ./style-ten.vue */ 2505));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var styleEleven = function styleEleven() {__webpack_require__.e(/*! require.ensure | pages/cats/style-eleven */ "pages/cats/style-eleven").then((function () {return resolve(__webpack_require__(/*! ./style-eleven.vue */ 2512));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var appSearchFor = function appSearchFor() {__webpack_require__.e(/*! require.ensure | components/page-component/app-search-for/app-search-for */ "components/page-component/app-search-for/app-search-for").then((function () {return resolve(__webpack_require__(/*! ../../components/page-component/app-search-for/app-search-for.vue */ 2287));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var appAttr = function appAttr() {Promise.all(/*! require.ensure | components/page-component/app-attr/app-attr */[__webpack_require__.e("common/vendor"), __webpack_require__.e("components/page-component/app-attr/app-attr")]).then((function () {return resolve(__webpack_require__(/*! ../../components/page-component/app-attr/app-attr.vue */ 2259));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var _default =


{
  components: {
    'app-search-for': appSearchFor,
    'style-one': styleOne,
    'style-two': styleTwo,
    'style-three': styleThree,
    'style-four': styleFour,
    'style-five': styleFive,
    'style-six': styleSix,
    'style-seven': styleSeven,
    'style-eight': styleEight,
    'style-nine': styleNine,
    'style-ten': styleTen,
    'style-eleven': styleEleven,
    'app-attr': appAttr },

  data: function data() {
    return {
      search_bool: true,
      list: [],
      goods: [],
      request: true,
      page: 1,
      classId: 0,
      activeIndex: 0,
      activeIndexTwo: 0,
      over: false,
      scrollHeight: 0,
      tabbarbool: true,
      cat_id: 0,
      cat_ids: [],
      againLower: true,

      goods_list: [],
      page_count: 1,

      select_cat_id: 0,
      first_id: 0,
      loading: false,

      selectAttr: {},
      previewUrl: '',
      submitUrl: '',
      show: 0,
      attrGroup: [],
      item: {},
      is_over_goods: true,
      options: {},
      goodsLoading: false };

  },
  computed: _objectSpread(_objectSpread(_objectSpread(_objectSpread(_objectSpread({},
  (0, _vuex.mapGetters)('mallConfig', {
    cat_style: 'getCatStyle',
    getTheme: 'getTheme' })),

  (0, _vuex.mapState)('gConfig', {
    windowHeight: function windowHeight(state) {return state.systemInfo.windowHeight;},
    windowWidth: function windowWidth(state) {return state.systemInfo.windowWidth;} })),

  (0, _vuex.mapGetters)('iPhoneX', {
    botHeight: 'getBotHeight' })),

  (0, _vuex.mapState)('mallConfig', {
    mall: function mall(state) {return state.mall;} })), {}, {

    setHeight: function setHeight() {
      var bottom = 0;
      if (this.tabbarbool) {
        bottom = this.botHeight;
      }
      return this.windowHeight * (750 / this.windowWidth) - bottom - 88;
    } }),

  onReachBottom: function onReachBottom() {var _this = this;
    var cat_style = this.cat_style.cat_style;
    if (cat_style === '3' || cat_style === '1') return;
    if (this.page < this.page_count) {
      this.page++;
      this.$request({
        url: this.$api.default.goods_list,
        method: 'get',
        data: {
          page: this.page,
          cat_id: this.cat_id } }).

      then(function (res) {
        if (res.code === 0) {var _this$goods_list;
          if (cat_style === '8' || cat_style === '5') {
            _this.goodsLoading = true;
          }
          (_this$goods_list = _this.goods_list).push.apply(_this$goods_list, _toConsumableArray(res.data.list));
        }
      });
    } else {
      if (cat_style === '8' || cat_style === '5') {
        this.goodsLoading = false;
      }
      uni.showToast({
        title: '暂无更多商品',
        icon: 'none' });

    }
  },
  methods: {
    onAttr: function onAttr(data) {
      this.selectAttr = data;
    },
    attr: function attr(_ref) {var previewUrl = _ref.previewUrl,submitUrl = _ref.submitUrl,attr_groups = _ref.attr_groups,goods = _ref.goods;
      this.previewUrl = previewUrl;
      this.submitUrl = submitUrl;
      this.attrGroup = attr_groups;
      this.item = goods;
      this.show = Math.random();
    },
    route_advert: function route_advert(data) {
      (0, _routeJump.default)({
        open_type: data.advert_open_type,
        params: data.advert_params,
        page_url: data.advert_url });

    },
    // 点击导航栏
    active: function active(item) {var _this2 = this;
      this.page = 1;
      this.goods_list = [];
      this.cat_id = item.id;
      this.select_cat_id = item.id;
      for (var i = 0; i < this.list.length; i++) {
        this.list[i].active = false;
      }
      for (var _i = 0; _i < this.list.length; _i++) {
        if (this.list[_i].id === item.id) {
          this.list[_i].active = true;
        }
      }
      this.is_over_goods = false;
      this.$request({
        url: "".concat(this.$api.default.goods_list, "&page=").concat(this.page, "&cat_id=").concat(item.id) }).
      then(function (res) {
        if (res.code === 0) {var _this2$goods_list;
          (_this2$goods_list = _this2.goods_list).push.apply(_this2$goods_list, _toConsumableArray(res.data.list));
          _this2.page_count = res.data.pagination.page_count;
          _this2.goodsLoading = _this2.page_count > 1;
          _this2.is_over_goods = true;
        }
      });
    },
    // 下拉分页请求
    req: function req() {var _this3 = this;
      this.$request({
        url: "".concat(this.$api.default.goods_list, "&page=").concat(this.page, "&cat_id=").concat(this.classId) }).
      then(function (response) {
        if (response.data.list.length > 0) {var _this3$goods;
          (_this3$goods = _this3.goods).push.apply(_this3$goods, _toConsumableArray(response.data.list));
        } else {
          _this3.over = true;
        }
      });
    },
    activeOne: function activeOne(item) {var _this4 = this;
      this.page = 1;
      this.activeIndexTwo = 0;
      this.cat_id = item.id;
      this.select_cat_id = item.id;
      this.is_over_goods = false;
      for (var i = 0; i < this.list.length; i++) {
        if (this.list[i].active !== item.active) {
          this.list[i].active = false;
        }
      }
      for (var _i2 = 0; _i2 < this.list.length; _i2++) {
        if (this.list[_i2].id === item.id) {
          this.list[_i2].active = true;
          this.activeIndex = _i2;
        }
      }
      if (this.cat_style.cat_style === '5') this.goods_list = [];

      if (this.list[this.activeIndex].child.length === 0) {
        this.$request({
          url: "".concat(this.$api.default.goods_list, "&page=").concat(this.page, "&cat_id=").concat(item.id) }).
        then(function (res) {var _res$data =
          res.data,list = _res$data.list,pagination = _res$data.pagination;
          _this4.goods_list = list;
          _this4.is_over_goods = true;
          _this4.page = 1;
          _this4.cat_id = item.id;
          _this4.select_cat_id = item.id;
          _this4.page_count = pagination.page_count;
        });

      } else {
        this.$request({
          url: "".concat(this.$api.default.goods_list, "&page=").concat(this.page, "&cat_id=").concat(this.list[this.activeIndex].child[0].id) }).
        then(function (res) {var _res$data2 =
          res.data,list = _res$data2.list,pagination = _res$data2.pagination;
          _this4.goods_list = list;
          _this4.is_over_goods = true;
          _this4.page = 1;
          _this4.cat_id = _this4.list[_this4.activeIndex].child[0].id;
          _this4.select_cat_id = item.id;
          _this4.page_count = pagination.page_count;
        });
      }
    },
    activeTwo: function activeTwo(_ref2) {var _this5 = this;return _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee() {var item, index, res, _res$data3, list, pagination;return _regenerator.default.wrap(function _callee$(_context) {while (1) {switch (_context.prev = _context.next) {case 0:item = _ref2.item, index = _ref2.index;
                _this5.page = 1;
                _this5.activeIndexTwo = index;
                _this5.select_cat_id = item.id;
                _this5.cat_id = item.id;
                _this5.select_cat_id = item.id;
                _this5.is_over_goods = false;_context.next = 9;return (
                  _this5.$request({
                    url: _this5.$api.default.goods_list,
                    method: 'get',
                    data: {
                      page: 1,
                      cat_id: item.id } }));case 9:res = _context.sent;


                if (res.code === 0) {_res$data3 =
                  res.data, list = _res$data3.list, pagination = _res$data3.pagination;
                  _this5.goods_list = [];
                  _this5.goods_list = list;
                  _this5.is_over_goods = true;
                  _this5.page_count = pagination.page_count;
                }case 11:case "end":return _context.stop();}}}, _callee);}))();
    },
    activeThree: function activeThree(item) {
      this.cat_id = item.id;
      this.select_cat_id = item.id;
      for (var i = 0; i < this.list.length; i++) {
        if (this.list[i].active !== item.active) {
          this.list[i].active = false;
        }
        if (this.list[i].id === item.id) {
          this.list[i].active = true;
          this.activeIndex = i;
        }
      }
    },

    catLower: function catLower() {var _this6 = this;return _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee2() {var goods_list, res, _this6$goods_list$goo, i;return _regenerator.default.wrap(function _callee2$(_context2) {while (1) {switch (_context2.prev = _context2.next) {case 0:if (
                _this6.againLower) {_context2.next = 2;break;}return _context2.abrupt("return");case 2:
                _this6.againLower = false;
                goods_list = _this6.goods_list[_this6.goods_list.length - 1];_context2.next = 6;return (
                  _this6.$request({
                    url: _this6.$api.default.cat_goods,
                    method: 'get',
                    data: {
                      cat_ids: JSON.stringify(_this6.cat_ids),
                      cat_id: goods_list.id,
                      offset: goods_list.offset } }));case 6:res = _context2.sent;


                if (res.code === 0) {
                  if (res.data.list[0].id === goods_list.id && res.data.list[0].goods_list.length > 0) {
                    (_this6$goods_list$goo = _this6.goods_list[_this6.goods_list.length - 1].goods_list).push.apply(_this6$goods_list$goo, _toConsumableArray(res.data.list[0].goods_list));
                    _this6.goods_list[_this6.goods_list.length - 1].offset = res.data.list[0].offset;
                  }
                  for (i = 1; i < res.data.list.length; i++) {
                    _this6.goods_list.push(res.data.list[i]);
                  }
                  _this6.againLower = true;
                }case 8:case "end":return _context2.stop();}}}, _callee2);}))();
    },

    activeRequest: function activeRequest(_ref3) {var item = _ref3.item;
      this.goods_list = [];
      console.log(item);
      if (item.child.length !== 0) {
        this.requestCatList({
          item: item.child[0], index: 0 });

      }
    },

    requestCatList: function requestCatList(_ref4) {var _this7 = this;return _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee3() {var item, index, i, res;return _regenerator.default.wrap(function _callee3$(_context3) {while (1) {switch (_context3.prev = _context3.next) {case 0:item = _ref4.item, index = _ref4.index;
                _this7.page = 1;
                _this7.cat_id = item.id;
                _this7.select_cat_id = item.id;
                _this7.activeIndexTwo = index;
                _this7.goods_list = [];if (!(
                item.child.length !== 0)) {_context3.next = 14;break;}
                _this7.is_over_goods = false;
                _this7.cat_ids = [];
                for (i = 0; i < item.child.length; i++) {
                  _this7.cat_ids.push(item.child[i].id);
                }_context3.next = 12;return (
                  _this7.$request({
                    url: _this7.$api.default.cat_goods,
                    method: 'get',
                    data: {
                      cat_ids: JSON.stringify(_this7.cat_ids),
                      cat_id: item.child[0].id,
                      offset: 0 } }));case 12:res = _context3.sent;


                if (res.code === 0) {
                  _this7.is_over_goods = true;
                  _this7.goods_list = res.data.list;
                }case 14:case "end":return _context3.stop();}}}, _callee3);}))();

    },
    // 求情商品列表
    requestGoods: function requestGoods(_ref5) {var _this8 = this;return _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee4() {var item, index, res;return _regenerator.default.wrap(function _callee4$(_context4) {while (1) {switch (_context4.prev = _context4.next) {case 0:item = _ref5.item, index = _ref5.index;
                _this8.page = 1;
                _this8.cat_id = item.id;
                _this8.select_cat_id = item.id;
                _this8.goods_list = [];

                _this8.is_over_goods = false;
                if (_this8.cat_style.cat_style === '10' && index !== undefined && _this8.list[index].child.length !== 0) {
                  _this8.activeIndexTwo = 0;
                  _this8.cat_id = _this8.list[index].child[0].id;
                }_context4.next = 9;return (
                  _this8.$request({
                    url: _this8.$api.default.goods_list,
                    method: 'get',
                    data: {
                      page: _this8.page,
                      cat_id: _this8.cat_id } }));case 9:res = _context4.sent;


                if (res.code === 0) {
                  _this8.is_over_goods = true;
                  _this8.goods_list = res.data.list;
                  _this8.goodsLoading = true;
                  _this8.page_count = res.data.pagination.page_count;
                }case 11:case "end":return _context4.stop();}}}, _callee4);}))();
    },

    // 分页请求商品
    lower: function lower(data) {var _this9 = this;return _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee5() {var res, _this9$goods_list;return _regenerator.default.wrap(function _callee5$(_context5) {while (1) {switch (_context5.prev = _context5.next) {case 0:if (!(
                _this9.page < _this9.page_count)) {_context5.next = 8;break;}
                _this9.page++;_context5.next = 4;return (
                  _this9.$request({
                    url: _this9.$api.default.goods_list,
                    method: 'get',
                    data: {
                      page: _this9.page,
                      cat_id: data.id } }));case 4:res = _context5.sent;


                if (res.code === 0) {
                  (_this9$goods_list = _this9.goods_list).push.apply(_this9$goods_list, _toConsumableArray(res.data.list));
                }_context5.next = 9;break;case 8:

                uni.showToast({
                  title: '暂无更多商品',
                  icon: 'none' });case 9:case "end":return _context5.stop();}}}, _callee5);}))();


    },

    // 处理数据
    dataProcessing: function dataProcessing(list) {
      for (var i = 0; i < list.length; i += 2) {
        if (i + 1 !== list.length) {
          this.goods_list.push([list[i], list[i + 1]]);
        } else {
          this.goods_list.push([list[i]]);
        }
      }
    },

    requestCat: function requestCat(cat_id, select_cat_id) {var _this10 = this;return _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee6() {var res, i, _res2, _i3, _i4, _res, _i5, _res4, _res3;return _regenerator.default.wrap(function _callee6$(_context6) {while (1) {switch (_context6.prev = _context6.next) {case 0:
                _this10.loading = false;_context6.next = 3;return (
                  _this10.$request({
                    url: _this10.$api.default.cat_list,
                    method: 'get',
                    data: {
                      cat_id: cat_id ? cat_id : '',
                      select_cat_id: select_cat_id ? select_cat_id : '' } }));case 3:res = _context6.sent;if (!(


                res.code === 0)) {_context6.next = 64;break;}
                _this10.list = res.data.list;
                // 分类跳转
                if (!(_this10.cat_style.cat_style === '1' && _this10.list.length === 0)) {_context6.next = 9;break;}
                _this10.search_bool = false;return _context6.abrupt("return");case 9:if (!(


                _this10.cat_style.cat_style === '2' || _this10.cat_style.cat_style === '1')) {_context6.next = 11;break;}return _context6.abrupt("return");case 11:if (!(


                _this10.cat_style.cat_style === '3' && _this10.list.length === 0)) {_context6.next = 14;break;}
                _this10.search_bool = false;return _context6.abrupt("return");case 14:if (!(


                cat_id || select_cat_id)) {_context6.next = 42;break;}if (!(
                _this10.cat_style.cat_style === '11')) {_context6.next = 28;break;}
                _this10.cat_ids = [];
                _this10.list.map(function (item, index) {
                  if (item.active) {
                    _this10.activeIndex = index;
                  }
                });if (!(
                _this10.list[_this10.activeIndex].child.length === 0)) {_context6.next = 20;break;}return _context6.abrupt("return");case 20:
                for (i = 0; i < _this10.list[_this10.activeIndex].child[0].child.length; i++) {
                  _this10.cat_ids.push(_this10.list[_this10.activeIndex].child[0].child[i].id);
                }if (!(
                _this10.cat_ids.length === 0)) {_context6.next = 23;break;}return _context6.abrupt("return");case 23:_context6.next = 25;return (
                  _this10.$request({
                    url: _this10.$api.default.cat_goods,
                    method: 'get',
                    data: {
                      cat_ids: JSON.stringify(_this10.cat_ids),
                      cat_id: _this10.cat_ids[0],
                      offset: 0 } }));case 25:_res2 = _context6.sent;


                if (_res2.code === 0) {
                  _this10.goods_list = _res2.data.list;
                }return _context6.abrupt("return");case 28:if (!(


                _this10.cat_style.cat_style === '6' || _this10.cat_style.cat_style === '7')) {_context6.next = 31;break;}
                _this10.list.map(function (item, index) {
                  if (item.active) {
                    _this10.activeIndex = index;
                  }
                });return _context6.abrupt("return");case 31:


                if (_this10.list.length > 0) {
                  for (_i3 = 0; _i3 < _this10.list.length; _i3++) {
                    if (_this10.list[_i3].active) {
                      _this10.cat_id = _this10.list[_i3].id;
                    }
                  }
                }
                if ((_this10.cat_style.cat_style === '5' || _this10.cat_style.cat_style === '10') && _this10.list.length > 0 && _this10.list[0].child.length > 0) {
                  for (_i4 = 0; _i4 < _this10.list.length; _i4++) {
                    if (_this10.list[_i4].active) {
                      _this10.cat_id = _this10.list[_i4].child[0].id;
                    }
                  }
                }if (!(

                _this10.list.length === 0 && _this10.cat_style.cat_style === '4')) {_context6.next = 36;break;}
                _this10.search_bool = false;return _context6.abrupt("return");case 36:_context6.next = 38;return (



                  _this10.$request({
                    url: _this10.$api.default.goods_list,
                    method: 'get',
                    data: {
                      page: 1,
                      cat_id: _this10.cat_id } }));case 38:_res = _context6.sent;


                if (_res.code === 0) {
                  _this10.goods_list = _res.data.list;
                  _this10.page_count = _res.data.pagination.page_count;
                  if (_this10.list.length === 0 && _this10.goods_list.length === 0) {
                    _this10.search_bool = false;
                  }
                }_context6.next = 64;break;case 42:if (!(

                _this10.list.length > 0)) {_context6.next = 63;break;}if (!(
                _this10.cat_style.cat_style === '11')) {_context6.next = 55;break;}
                _this10.cat_ids = [];if (!(
                _this10.list.length === 0 || _this10.list[0].child.length === 0)) {_context6.next = 47;break;}return _context6.abrupt("return");case 47:
                for (_i5 = 0; _i5 < _this10.list[0].child[0].child.length; _i5++) {
                  _this10.cat_ids.push(_this10.list[0].child[0].child[_i5].id);
                }if (!(
                _this10.cat_ids.length === 0)) {_context6.next = 50;break;}return _context6.abrupt("return");case 50:_context6.next = 52;return (
                  _this10.$request({
                    url: _this10.$api.default.cat_goods,
                    method: 'get',
                    data: {
                      cat_ids: JSON.stringify(_this10.cat_ids),
                      cat_id: _this10.cat_ids[0],
                      offset: 0 } }));case 52:_res4 = _context6.sent;


                if (_res4.code === 0) {
                  _this10.goods_list = _res4.data.list;
                }return _context6.abrupt("return");case 55:


                _this10.cat_id = _this10.list[0].id;

                if ((_this10.cat_style.cat_style === '5' || _this10.cat_style.cat_style === '10') && _this10.list[0].child.length > 0) {
                  _this10.cat_id = _this10.list[0].child[0].id;
                }_context6.next = 59;return (
                  _this10.$request({
                    url: _this10.$api.default.goods_list,
                    method: 'get',
                    data: {
                      page: 1,
                      cat_id: _this10.cat_id } }));case 59:_res3 = _context6.sent;


                if (_res3.code === 0) {
                  _this10.goods_list = _res3.data.list;
                  _this10.page_count = _res3.data.pagination.page_count;
                }_context6.next = 64;break;case 63:

                _this10.search_bool = false;case 64:case "end":return _context6.stop();}}}, _callee6);}))();



    } },

  onLoad: function onLoad(options) {var _this11 = this;this.$commonLoad.onload(options);
    this.$commonLoad.onload();

    this.options = options;
    setTimeout(function () {
      _this11.tabbarbool = _this11.$children[0].tabbarbool;
    }, 500);
    this.cat_id = options.cat_id;
    this.first_id = options.cat_id;
    if (options.first_id && options.select_cat_id) {
      this.requestCat(options.first_id, options.select_cat_id).then(function () {
        _this11.loading = true;
      });
    } else if (!options.first_id && options.select_cat_id) {
      this.requestCat('', options.select_cat_id).then(function () {
        _this11.loading = true;
      });
    } else if (!options.first_id && !options.select_cat_id) {
      this.requestCat(options.cat_id).then(function () {
        _this11.loading = true;
      });
    }

    wx.showShareMenu({
      menus: ['shareAppMessage', 'shareTimeline'] });


  },

  onShareAppMessage: function onShareAppMessage() {
    return this.$shareAppMessage({
      path: '/pages/cats/cats',
      title: this.$children[0].navigationBarTitle,
      params: {
        cat_id: this.first_id,
        first_id: this.first_id,
        select_cat_id: this.select_cat_id } });


  },


  onShareTimeline: function onShareTimeline() {var _this$mall$setting =
    this.mall.setting,setting = _this$mall$setting.setting,name = _this$mall$setting.name;
    return this.$shareTimeline({
      title: setting.share_title ? setting.share_title : name,
      query: {
        cat_id: this.first_id,
        first_id: this.first_id,
        select_cat_id: this.select_cat_id } });


  } };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 176:
/*!***************************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/cats/cats.vue?vue&type=style&index=0&id=315b3726&lang=scss&scoped=true& ***!
  \***************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_style_index_0_id_315b3726_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/postcss-loader/src??ref--8-oneOf-1-3!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./cats.vue?vue&type=style&index=0&id=315b3726&lang=scss&scoped=true& */ 177);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_style_index_0_id_315b3726_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_style_index_0_id_315b3726_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_style_index_0_id_315b3726_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_style_index_0_id_315b3726_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_cats_vue_vue_type_style_index_0_id_315b3726_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 177:
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!./node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!./node_modules/postcss-loader/src??ref--8-oneOf-1-3!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/cats/cats.vue?vue&type=style&index=0&id=315b3726&lang=scss&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin
    if(false) { var cssReload; }
  

/***/ })

},[[169,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../../.sourcemap/mp-weixin/pages/cats/cats.js.map