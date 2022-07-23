(global["webpackJsonp"] = global["webpackJsonp"] || []).push([["pages/order-submit/order-submit"],{

/***/ 425:
/*!****************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/main.js?{"page":"pages%2Forder-submit%2Forder-submit"} ***!
  \****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(createPage) {__webpack_require__(/*! uni-pages */ 5);


var _vue = _interopRequireDefault(__webpack_require__(/*! vue */ 4));
var _orderSubmit = _interopRequireDefault(__webpack_require__(/*! ./pages/order-submit/order-submit.vue */ 426));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };} // @ts-ignore
wx.__webpack_require_UNI_MP_PLUGIN__ = __webpack_require__;createPage(_orderSubmit.default);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["createPage"]))

/***/ }),

/***/ 426:
/*!*********************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/order-submit/order-submit.vue ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./order-submit.vue?vue&type=template&id=349e2166&scoped=true& */ 427);
/* harmony import */ var _order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./order-submit.vue?vue&type=script&lang=js& */ 429);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _order_submit_vue_vue_type_style_index_0_id_349e2166_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./order-submit.vue?vue&type=style&index=0&id=349e2166&scoped=true&lang=scss& */ 431);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/runtime/componentNormalizer.js */ 11);

var renderjs





/* normalize component */

var component = Object(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "349e2166",
  null,
  false,
  _order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"],
  renderjs
)

component.options.__file = "pages/order-submit/order-submit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ 427:
/*!****************************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/order-submit/order-submit.vue?vue&type=template&id=349e2166&scoped=true& ***!
  \****************************************************************************************************************************/
/*! exports provided: render, staticRenderFns, recyclableRender, components */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./order-submit.vue?vue&type=template&id=349e2166&scoped=true& */ 428);
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "recyclableRender", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__["recyclableRender"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "components", function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_uni_app_loader_page_meta_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_template_id_349e2166_scoped_true___WEBPACK_IMPORTED_MODULE_0__["components"]; });



/***/ }),

/***/ 428:
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-uni-app-loader/page-meta.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/order-submit/order-submit.vue?vue&type=template&id=349e2166&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
  var l0 = _vm.previewData
    ? _vm.__map(_vm.previewData.mch_list, function(mch, mchIndex) {
        var $orig = _vm.__get_orig(mch)

        var m0 =
          ((mch.coupon && mch.coupon.enabled) ||
            mch.member_discount > 0 ||
            mch.member_discount < 0 ||
            (mch.integral && mch.integral.can_use) ||
            mch.temp_vip_discount ||
            (mch.insert_rows && mch.insert_rows.length) ||
            mch.full_reduce_discount > 0 ||
            mch.full_reduce_discount < 0) &&
          mch.coupon &&
          mch.coupon.enabled &&
          !mch.coupon.use
            ? _vm.noCouponStatus(mchIndex)
            : null
        return {
          $orig: $orig,
          m0: m0
        }
      })
    : null
  _vm.$mp.data = Object.assign(
    {},
    {
      $root: {
        l0: l0
      }
    }
  )
}
var recyclableRender = false
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ 429:
/*!**********************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/order-submit/order-submit.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/babel-loader/lib!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./order-submit.vue?vue&type=script&lang=js& */ 430);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 430:
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/order-submit/order-submit.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;





























































































































































































































































































































































var _vuex = __webpack_require__(/*! vuex */ 13);function _createForOfIteratorHelper(o, allowArrayLike) {var it;if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {if (it) o = it;var i = 0;var F = function F() {};return { s: F, n: function n() {if (i >= o.length) return { done: true };return { done: false, value: o[i++] };}, e: function e(_e) {throw _e;}, f: F };}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");}var normalCompletion = true,didErr = false,err;return { s: function s() {it = o[Symbol.iterator]();}, n: function n() {var step = it.next();normalCompletion = step.done;return step;}, e: function e(_e2) {didErr = true;err = _e2;}, f: function f() {try {if (!normalCompletion && it.return != null) it.return();} finally {if (didErr) throw err;}} };}function _unsupportedIterableToArray(o, minLen) {if (!o) return;if (typeof o === "string") return _arrayLikeToArray(o, minLen);var n = Object.prototype.toString.call(o).slice(8, -1);if (n === "Object" && o.constructor) n = o.constructor.name;if (n === "Map" || n === "Set") return Array.from(o);if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);}function _arrayLikeToArray(arr, len) {if (len == null || len > arr.length) len = arr.length;for (var i = 0, arr2 = new Array(len); i < len; i++) {arr2[i] = arr[i];}return arr2;}function ownKeys(object, enumerableOnly) {var keys = Object.keys(object);if (Object.getOwnPropertySymbols) {var symbols = Object.getOwnPropertySymbols(object);if (enumerableOnly) symbols = symbols.filter(function (sym) {return Object.getOwnPropertyDescriptor(object, sym).enumerable;});keys.push.apply(keys, symbols);}return keys;}function _objectSpread(target) {for (var i = 1; i < arguments.length; i++) {var source = arguments[i] != null ? arguments[i] : {};if (i % 2) {ownKeys(Object(source), true).forEach(function (key) {_defineProperty(target, key, source[key]);});} else if (Object.getOwnPropertyDescriptors) {Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));} else {ownKeys(Object(source)).forEach(function (key) {Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));});}}return target;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}var AppDiyForm = function AppDiyForm() {__webpack_require__.e(/*! require.ensure | components/page-component/app-diy-form/app-diy-form */ "components/page-component/app-diy-form/app-diy-form").then((function () {return resolve(__webpack_require__(/*! ../../components/page-component/app-diy-form/app-diy-form.vue */ 2695));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var appSubmitGoods = function appSubmitGoods() {__webpack_require__.e(/*! require.ensure | pages/order-submit/app-submit-goods */ "pages/order-submit/app-submit-goods").then((function () {return resolve(__webpack_require__(/*! ./app-submit-goods.vue */ 2709));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var AppCouponPick = function AppCouponPick() {__webpack_require__.e(/*! require.ensure | pages/order-submit/app-coupon-pick */ "pages/order-submit/app-coupon-pick").then((function () {return resolve(__webpack_require__(/*! ./app-coupon-pick */ 2716));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var AppBottomModal = function AppBottomModal() {__webpack_require__.e(/*! require.ensure | pages/order-submit/app-bottom-modal */ "pages/order-submit/app-bottom-modal").then((function () {return resolve(__webpack_require__(/*! ./app-bottom-modal */ 2723));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var AppAddressBar = function AppAddressBar() {__webpack_require__.e(/*! require.ensure | pages/order-submit/app-address-bar */ "pages/order-submit/app-address-bar").then((function () {return resolve(__webpack_require__(/*! ./app-address-bar */ 2730));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var AppSubmitCheckbox = function AppSubmitCheckbox() {__webpack_require__.e(/*! require.ensure | pages/order-submit/app-submit-checkbox */ "pages/order-submit/app-submit-checkbox").then((function () {return resolve(__webpack_require__(/*! ./app-submit-checkbox */ 2735));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var AppClose = function AppClose() {__webpack_require__.e(/*! require.ensure | components/basic-component/app-close/app-close */ "components/basic-component/app-close/app-close").then((function () {return resolve(__webpack_require__(/*! ../../components/basic-component/app-close/app-close.vue */ 2399));}).bind(null, __webpack_require__)).catch(__webpack_require__.oe);};var _default =








{
  name: 'order-submit',
  components: {
    AppSubmitCheckbox: AppSubmitCheckbox,
    AppAddressBar: AppAddressBar,
    AppBottomModal: AppBottomModal,
    AppCouponPick: AppCouponPick,
    AppDiyForm: AppDiyForm,
    appSubmitGoods: appSubmitGoods,
    AppClose: AppClose },

  data: function data() {
    return {
      totalTitle: '合计',
      check: false,
      previewData: {
        mch_list: [],
        total_price: 0,
        vip_card_discount_total_price: null,
        custom_currency_all: [] },

      getLocationFail: false,
      previewUrl: null,
      submitUrl: null,
      plugin: null,
      orderPageUrl: null,
      submitLock: false,
      getPayDataTimer: null,
      userTheme: null,
      is_gift: false,
      payDataUrl: null,
      showPayResult: true,
      payCancelUrl: null,
      loadingPreviewData: true,
      showClose: false,
      is_open: false,
      mchList: '',
      p_pay_id: '' //重新提交处理
    };
  },
  computed: _objectSpread(_objectSpread(_objectSpread({},
  (0, _vuex.mapState)({
    appImg: function appImg(state) {return state.mallConfig.__wxapp_img;} })), {}, {

    theme: function theme() {
      return this.userTheme ? this.userTheme : this.getTheme;
    } },
  (0, _vuex.mapGetters)('mallConfig', {
    getTheme: 'getTheme' })), {}, {

    themeBgClass: function themeBgClass() {
      if (this.userTheme && this.userTheme.indexOf('gift') >= 0) {
        return "".concat(this.theme, " ").concat(this.theme, "-background");
      }
    },
    themeTextClass: function themeTextClass() {
      if (this.userTheme && this.userTheme.indexOf('gift') >= 0) {
        return "".concat(this.theme, " ").concat(this.theme, "-color");
      }
    } }),

  onLoad: function onLoad(options) {var _this = this;this.$commonLoad.onload(options);
    var mchList = JSON.parse(options.mch_list);
    var list = [];var _iterator = _createForOfIteratorHelper(
    mchList),_step;try {for (_iterator.s(); !(_step = _iterator.n()).done;) {var item = _step.value;
        if (item.mch_id > 0) {
          list.push(item.mch_id);
        }
      }} catch (err) {_iterator.e(err);} finally {_iterator.f();}
    this.is_gift = this.userTheme && this.userTheme.indexOf('gift') >= 0 ? true : false;
    this.mchList = list.length > 0 ? JSON.stringify(list) : '0';
    if (this.submitLock) return;
    this.setFormData(options);
    this.$event.on(this.$const.EVENT_USER_LOGIN).then(function () {
      _this.loadPreviewData();
    });





























  },
  onShow: function onShow() {var _this2 = this;
    this.showClose = false;
    setTimeout(function () {
      _this2.showClose = true;



    });
  },
  onUnload: function onUnload() {
    if (this.getPayDataTimer) {
      clearTimeout(this.getPayDataTimer);
    }
  },
  watch: {
    'previewData.address.name': {
      handler: function handler() {
        this.changeZitiAddress();
      } },

    'previewData.address.mobile': {
      handler: function handler() {
        this.changeZitiAddress();
      } } },


  methods: {
    getMall: function getMall(e) {
      console.log(e);
      if (e != undefined) {
        this.is_open = e && e.is_open == 1 ? true : false;
        if (this.is_open) {

          if (this.submitLock) return;






          this.loadPreviewData();

        }
      }
    },

    noCouponStatus: function noCouponStatus(mchIndex) {
      var mchNoCouponStatusList = this.$store.getters['orderSubmit/getMchNoCouponStatusList'];
      if (mchNoCouponStatusList[mchIndex])
      return true;else

      return false;
    },
    navigateVipCardPrivilege: function navigateVipCardPrivilege() {
      uni.navigateTo({
        url: '/plugins/vip_card/rights/rights?id=1' });

    },
    showCouponPicker: function showCouponPicker(index) {
      this.previewData.mch_list[index].showCouponPicker = true;
    },
    reversalShowInsertRows: function reversalShowInsertRows(index) {
      this.previewData.mch_list[index].showInsertRows = !this.previewData.mch_list[index].showInsertRows;
    },
    updateList: function updateList(e, index) {
      this.previewData.mch_list[index] = e;
      this.$forceUpdate();
    },
    setParams: function setParams(options) {
      if (options.total_title) {
        this.totalTitle = options.total_title;
      }
    },
    handleOrderFormInput: function handleOrderFormInput(_ref) {var data = _ref.data,sign = _ref.sign;
      var result = [];
      for (var i in data) {
        result[i] = {
          key: data[i].key,
          label: data[i].name,
          value: data[i].value,
          required: data[i].is_required };

      }
      var formData = this.$store.state.orderSubmit.formData;
      formData.list[sign].order_form = result;
      this.$store.commit('orderSubmit/mutSetFormData', formData);
    },
    handleOrderFormValidate: function handleOrderFormValidate(_ref2) {var result = _ref2.result,sign = _ref2.sign;
      var formData = this.$store.state.orderSubmit.formData;
      formData.list[sign].order_form_validate_result = result;
      this.$store.commit('orderSubmit/mutSetFormData', formData);
    },
    setFormData: function setFormData(options) {
      this.previewUrl = decodeURIComponent(options.preview_url || this.$api.order.preview);
      this.submitUrl = decodeURIComponent(options.submit_url || this.$api.order.submit);
      this.plugin = options.plugin || null;
      this.orderPageUrl = decodeURIComponent(options.order_page_url || '/pages/order/index/index?status=0');
      this.userTheme = options.theme || null;
      this.payDataUrl = decodeURIComponent(options.pay_data_url || this.$api.order.pay_data);
      this.payCancelUrl = options.pay_cancel_url ? decodeURIComponent(options.pay_cancel_url) : null;
      this.showPayResult = options.show_pay_result || true;
      if (this.showPayResult === 'true') this.showPayResult = true;
      if (this.showPayResult === 'false') this.showPayResult = false;
      var list = JSON.parse(options.mch_list);

      // 商户列表先做下排序，主商城必须在最前
      for (var i in list) {
        if (parseInt(list[i].mch_id) === 0) {
          var _mchItem = list[i];
          list.splice(i, 1);
          list.unshift(_mchItem);
          break;
        }
      }

      for (var _i in list) {
        list[_i].distance = 0;
        list[_i].remark = '';
        list[_i].order_form = [];
        list[_i].use_integral = 0;
        list[_i].user_coupon_id = 0;
        for (var j in list[_i].goods_list) {
          list[_i].goods_list[j].cart_id = list[_i].goods_list[j].cart_id || 0;
        }
        if (this.plugin === 'booking') {
          var store_id = this.bookStorage('get');
          list[_i]['store_id'] = store_id ? store_id : '';
        }
      }
      this.$store.commit('orderSubmit/mutSetFormData', {
        list: list,
        address_id: 0,
        send_type: options.send_type || '' });

    },
    bookStorage: function bookStorage(type) {var store_id = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      var key = '_book_storage_order_preview';
      if (type === 'get') {
        return this.$storage.getStorageSync(key);
      }
      if (type === 'save') {
        this.$storage.setStorageSync(key, store_id ? store_id : 0);
      }
    },
    loadPreviewData: function loadPreviewData() {var _this3 = this;
      this.loadingPreviewData = true;
      uni.showLoading({
        mask: true,
        title: '加载中' });

      this.$request({
        url: this.previewUrl,
        method: 'post',
        data: {
          form_data: JSON.stringify(this.$store.state.orderSubmit.formData) } }).

      then(function (response) {
        _this3.loadingPreviewData = false;
        uni.hideLoading();
        if (response.code === 0) {
          if (response.data.allZiti && !response.data.address) {
            response.data.address = {
              name: '',
              mobile: '' };

          }
          for (var i in response.data.mch_list) {
            response.data.mch_list[i].showCouponPicker = false;
            response.data.mch_list[i].noCoupons = false;
            response.data.mch_list[i].showInsertRows = false;
          }
          _this3.previewData = response.data;
          _this3.setDiyFormScrollStatus();
          _this3.checkCouponError();
          _this3.updateStoreDistance();
          _this3.updateGoodsCount();
        } else {
          uni.showModal({
            title: '提示',
            content: response.msg,
            showCancel: false,
            success: function success() {
              uni.navigateBack();
            } });

        }
      }).catch(function () {
        _this3.loadingPreviewData = false;
        uni.hideLoading();
      });
    },
    navigateStore: function navigateStore(mchIndex) {
      if (this.previewData.mch_list[mchIndex].mch.id != 0) {
        return;
      }
      var firstGoodsId = '';
      if (this.plugin === 'booking') {
        firstGoodsId = this.previewData.mch_list[0].goods_list[0].id;
      }
      var plugin = this.plugin || '';
      uni.navigateTo({
        url: "/pages/order-submit/store-pick?mchIndex=".concat(mchIndex, "&plugin=").concat(plugin, "&firstGoodsId=").concat(firstGoodsId) });

    },
    navigateCoupon: function navigateCoupon(mchIndex) {
      uni.navigateTo({
        url: "/pages/order-submit/coupon-pick?mchIndex=".concat(mchIndex) });

    },
    navigateSvip: function navigateSvip(mchIndex) {
      uni.navigateTo({
        url: "/pages/order-submit/vip-card?mchIndex=".concat(mchIndex) });

    },
    changeZitiAddress: function changeZitiAddress() {
      var formData = this.$store.state.orderSubmit.formData;
      formData.address = {
        name: this.previewData.address ? this.previewData.address.name : '',
        mobile: this.previewData.address ? this.previewData.address.mobile : '' };

      this.$store.commit('orderSubmit/mutSetFormData', formData);
    },
    changeSendType: function changeSendType(mchIndex, value) {
      if (this.previewData.mch_list[mchIndex].delivery.send_type == value) return;
      var formData = this.$store.state.orderSubmit.formData;
      formData.list[mchIndex].send_type = value;
      this.$store.commit('orderSubmit/mutSetFormData', formData);
      this.previewData.mch_list[mchIndex].delivery.send_type = value;
      this.loadPreviewData();
    },
    updateStoreDistance: function updateStoreDistance() {var _this4 = this;
      if (!this.previewData) return;
      if (!this.previewData.has_ziti && this.plugin != 'booking') {
        return;
      }

      uni.getLocation({
        success: function success(res) {
          for (var i in _this4.previewData.mch_list) {
            if (!_this4.previewData.mch_list[i].store) {
              continue;
            }
            if (_this4.previewData.mch_list[i].store.distance &&
            _this4.previewData.mch_list[i].store.distance != '-m') {
              continue;
            }
            if (
            _this4.previewData.mch_list[i].store.latitude == '' ||
            _this4.previewData.mch_list[i].store.longitude == '' ||
            isNaN(_this4.previewData.mch_list[i].store.latitude) ||
            isNaN(_this4.previewData.mch_list[i].store.longitude))
            {
              continue;
            }
            var distance = _this4.$utils.earthDistance({
              lat: res.latitude,
              lng: res.longitude },
            {
              lat: _this4.previewData.mch_list[i].store.latitude,
              lng: _this4.previewData.mch_list[i].store.longitude });

            var distanceStr = '-m';
            if (distance > 1000) {
              distanceStr = (distance / 1000).toFixed(2) + 'km';
            } else {
              distanceStr = distance.toFixed(0) + 'm';
            }
            _this4.previewData.mch_list[i].store.distance = distanceStr;
          }
        },
        fail: function fail() {
          _this4.getLocationFail = true;
        } });



















































































    },
    openLocationSetting: function openLocationSetting() {
      this.getLocationFail = false;
      uni.openSetting({});
    },
    showIntegralTip: function showIntegralTip() {
      uni.showModal({
        title: '积分抵扣说明',
        content: this.$store.state.mallConfig.mall.setting.member_integral_rule,
        showCancel: false });

    },
    changeIntegral: function changeIntegral(mchIndex) {
      var formData = this.$store.state.orderSubmit.formData;
      var use = !this.previewData.mch_list[mchIndex].integral.use;
      formData.list[mchIndex].use_integral = use ? 1 : 0;
      this.previewData.mch_list[mchIndex].integral.use = use;
      this.loadPreviewData();
    },
    inputRemark: function inputRemark(mchIndex) {
      var formData = this.$store.state.orderSubmit.formData;
      formData.list[mchIndex].remark = this.previewData.mch_list[mchIndex].remark;
      this.$store.commit('orderSubmit/mutSetFormData', formData);
    },
    submit: function submit() {var _this5 = this;
      uni.showLoading({
        mask: true,
        title: '提交中' });

      this.$request({
        url: this.submitUrl,
        method: 'post',
        data: {
          form_data: JSON.stringify(this.$store.state.orderSubmit.formData) } }).

      then(function (response) {
        if (response.code === 0) {
          _this5.getPayOrderId(response.data.queue_id, response.data.token);
        } else {
          _this5.submitLock = false;
          uni.hideLoading();
          uni.showModal({
            title: '',
            content: response.msg,
            showCancel: false });

        }
      }).catch(function (e) {
        _this5.submitLock = false;
        uni.hideLoading();
        uni.showModal({
          title: '提示',
          content: e.errMsg,
          showCancel: false });

      });
    },
    getPayOrderId: function getPayOrderId(queue_id, token) {var _this6 = this;
      this.$request({
        url: this.payDataUrl,
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
      this.p_pay_id = data.id;
      this.$payment.pay(data.id).then(function (res) {
        if (_this7.showPayResult) {
          uni.redirectTo({
            url: "/pages/order-submit/pay-result?payment_order_union_id=".concat(data.id, "&order_page_url=").concat(encodeURIComponent(_this7.orderPageUrl)) });

        } else {

          var page_url = _this7.orderPageUrl;
          if (page_url.indexOf('?') === -1) {
            page_url += '?';
          } else {
            page_url += '&';
          }

          delete data.id;

          page_url += "pay_data=".concat(JSON.stringify(data));

          uni.redirectTo({
            url: page_url });

        }
      }).catch(function (e) {
        if (_this7.payCancelUrl) {
          var page_url = _this7.payCancelUrl;
          if (page_url.indexOf('?') === -1) {
            page_url += '?';
          } else {
            page_url += '&';
          }
          page_url += "pay_data=".concat(JSON.stringify(data));
          uni.redirectTo({
            url: page_url });

        } else {
          if (e.errMsg === '5b03b6e009796c698d132908cb635fca') {
            //重新发起支付
            _this7.submitLock = false;
          } else {
            uni.showModal({
              title: '提交失败',
              content: e.errMsg,
              showCancel: false,
              success: function success() {
                uni.redirectTo({
                  url: _this7.orderPageUrl });

              } });

          }
        }
      });
    },
    jump: function jump() {
      uni.navigateTo({
        url: "/pages/order-submit/map" });

    },
    checkCouponError: function checkCouponError() {
      for (var i in this.previewData.mch_list) {
        if (this.previewData.mch_list[i].coupon && this.previewData.mch_list[i].coupon.coupon_error) {
          uni.showModal({
            title: '',
            content: this.previewData.mch_list[i].coupon.coupon_error,
            showCancel: false });

          return;
        }
      }
    },
    setDiyFormScrollStatus: function setDiyFormScrollStatus() {
      for (var i in this.previewData.mch_list) {
        var order_form = this.previewData.mch_list[i].order_form;
        if (order_form) {
          if (order_form.value && order_form.value.length && order_form.value.length >= 5) {
            order_form.show_scroll = true;
          } else {
            order_form.show_scroll = false;
          }
        }
      }
    },
    subscribe: function subscribe() {var _this8 = this;
      if (this.p_pay_id) {
        this.pay({
          id: this.p_pay_id });

        return true;
      } else {
        this.p_pay_id = '';
      }
      for (var i in this.$store.state.orderSubmit.formData.list) {
        var item = this.$store.state.orderSubmit.formData.list[i];
        if (!item.order_form_validate_result) continue;
        if (item.order_form_validate_result.hasError) {
          uni.showModal({
            title: '提示',
            content: item.order_form_validate_result.errors[0].msg,
            showCancel: false });

          return;
        }
      }
      for (var _i2 in this.$store.state.orderSubmit.formData.list) {
        for (var j in this.$store.state.orderSubmit.formData.list[_i2].goods_list) {
          var _item = this.$store.state.orderSubmit.formData.list[_i2].goods_list[j];
          if (!_item.goods_form_validate_result) continue;
          if (_item.goods_form_validate_result.hasError) {
            uni.showModal({
              title: '提示',
              content: _item.goods_form_validate_result.errors[0].msg,
              showCancel: false });

            return;
          }
        }
        if (this.plugin === 'booking' && this.$store.state.orderSubmit.formData.list[_i2]) {
          this.bookStorage('save', this.$store.state.orderSubmit.formData.list[_i2].store_id);
        }
      }
      if (this.submitLock) return;
      this.submitLock = true;
      this.$subscribe(this.previewData.template_message_list).then(function (res) {
        _this8.submit();
      }).catch(function () {
        _this8.submit();
      });
    },
    handleGoodsFormInput: function handleGoodsFormInput(_ref3) {var data = _ref3.data,sign = _ref3.sign;
      var signArr = sign.split(',');
      var mchIndex = parseInt(signArr[0]);
      var goodsIndex = parseInt(signArr[1]);
      // const formId = parseInt(signArr[2]);
      var result = [];
      for (var i in data) {
        result[i] = {
          key: data[i].key,
          label: data[i].name,
          value: data[i].value,
          required: data[i].is_required };

      }
      var formData = this.$store.state.orderSubmit.formData;
      formData.list[mchIndex].goods_list[goodsIndex].form_data = result;
      this.$store.commit('orderSubmit/mutSetFormData', formData);
    },
    handleGoodsFormValidate: function handleGoodsFormValidate(_ref4) {var result = _ref4.result,sign = _ref4.sign;
      if (!sign) return;
      var signArr = sign.split(',');
      var mchIndex = parseInt(signArr[0]);
      var goodsIndex = parseInt(signArr[1]);
      var formData = this.$store.state.orderSubmit.formData;
      formData.list[mchIndex].goods_list[goodsIndex].goods_form_validate_result = result;
      this.$store.commit('orderSubmit/mutSetFormData', formData);
    },
    updateGoodsCount: function updateGoodsCount() {
      for (var i in this.previewData.mch_list) {
        var count = 0;
        for (var j in this.previewData.mch_list[i].goods_list) {
          count += parseInt(this.previewData.mch_list[i].goods_list[j].num);
        }
        this.previewData.mch_list[i].goods_count = count;
      }
    },
    handleAddressInput: function handleAddressInput(e) {
      if (typeof e.name !== 'undefined') this.previewData.address.name = e.name;
      if (typeof e.mobile !== 'undefined') this.previewData.address.mobile = e.mobile;
    } } };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 431:
/*!*******************************************************************************************************************************************!*\
  !*** /Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/order-submit/order-submit.vue?vue&type=style&index=0&id=349e2166&scoped=true&lang=scss& ***!
  \*******************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_style_index_0_id_349e2166_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/postcss-loader/src??ref--8-oneOf-1-3!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!../../../../../../../../Applications/HBuilderX.app/Contents/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./order-submit.vue?vue&type=style&index=0&id=349e2166&scoped=true&lang=scss& */ 432);
/* harmony import */ var _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_style_index_0_id_349e2166_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_style_index_0_id_349e2166_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_style_index_0_id_349e2166_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_style_index_0_id_349e2166_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_dist_cjs_js_ref_8_oneOf_1_1_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_loaders_stylePostLoader_js_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_2_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_sass_loader_dist_cjs_js_ref_8_oneOf_1_4_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_vue_loader_lib_index_js_vue_loader_options_Applications_HBuilderX_app_Contents_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_order_submit_vue_vue_type_style_index_0_id_349e2166_scoped_true_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 432:
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!./node_modules/css-loader/dist/cjs.js??ref--8-oneOf-1-1!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-2!./node_modules/postcss-loader/src??ref--8-oneOf-1-3!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/sass-loader/dist/cjs.js??ref--8-oneOf-1-4!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!/Users/yfzhu/客户资料/小豆芽/零售宝-2022/mobile/pages/order-submit/order-submit.vue?vue&type=style&index=0&id=349e2166&scoped=true&lang=scss& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin
    if(false) { var cssReload; }
  

/***/ })

},[[425,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../../.sourcemap/mp-weixin/pages/order-submit/order-submit.js.map