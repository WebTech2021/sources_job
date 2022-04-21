(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[22],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/user/auth/Register.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vee_validate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vee-validate */ "./node_modules/vee-validate/dist/vee-validate.esm.js");
/* harmony import */ var bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! bootstrap-vue */ "./node_modules/bootstrap-vue/esm/index.js");
/* harmony import */ var _validations__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @validations */ "./resources/js/src/@core/utils/validations/validations.js");
/* harmony import */ var _core_mixins_ui_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @core/mixins/ui/forms */ "./resources/js/src/@core/mixins/ui/forms.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    // BSV
    BLink: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BLink"],
    BCardTitle: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BCardTitle"],
    BCardText: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BCardText"],
    BForm: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BForm"],
    BButton: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BButton"],
    BFormInput: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BFormInput"],
    BFormGroup: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BFormGroup"],
    BInputGroup: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BInputGroup"],
    BInputGroupAppend: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BInputGroupAppend"],
    BFormCheckbox: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BFormCheckbox"],
    BImg: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BImg"],
    BCol: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BCol"],
    BSpinner: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BSpinner"],
    BFormSelect: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BFormSelect"],
    BModal: bootstrap_vue__WEBPACK_IMPORTED_MODULE_1__["BModal"],
    // validations
    ValidationProvider: vee_validate__WEBPACK_IMPORTED_MODULE_0__["ValidationProvider"],
    ValidationObserver: vee_validate__WEBPACK_IMPORTED_MODULE_0__["ValidationObserver"]
  },
  mixins: [_core_mixins_ui_forms__WEBPACK_IMPORTED_MODULE_3__["togglePasswordVisibility"]],
  data: function data() {
    return {
      loading: false,
      // Form Data
      regEmail: '',
      name: '',
      password: '',
      status: '',
      country: 20,
      division: 6,
      district: null,
      upazila: null,
      refer_code: this.$route.query.u,
      password_confirmation: '',
      confirmPasswordFieldType: 'password',
      // eslint-disable-next-line global-require,import/no-unresolved
      topLogo: __webpack_require__(/*! @/assets/images/logo/sources.png */ "./resources/js/src/assets/images/logo/sources.png"),
      // Fetched Data
      countries: [{
        id: 20,
        name: 'Bangladesh'
      }],
      divisions: [],
      districts: [],
      upazilas: [],
      // validation rules
      required: _validations__WEBPACK_IMPORTED_MODULE_2__["required"],
      email: _validations__WEBPACK_IMPORTED_MODULE_2__["email"],
      tos: ''
    };
  },
  computed: {
    passwordToggleIcon: function passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon';
    },
    confirmPasswordToggleIcon: function confirmPasswordToggleIcon() {
      return this.confirmPasswordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon';
    },
    imgUrl: function imgUrl() {
      // eslint-disable-next-line no-undef
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = __webpack_require__(/*! @/assets/images/logo/sources.png */ "./resources/js/src/assets/images/logo/sources.png");
        return this.sideImg;
      }

      return this.sideImg;
    }
  },
  mounted: function mounted() {
    var _this = this;

    // this.$store.dispatch('location/Countries')
    //   .then(() => {
    //     this.countries = this.$store.getters['location/getCountries']
    //   })
    this.$store.dispatch('location/Divisions').then(function () {
      _this.divisions = _this.$store.getters['location/getDivisions'];
    });

    if (this.division) {
      this.getDistricts();
    }

    this.$store.dispatch('admin/settings').then(function () {
      _this.tos = _this.$store.getters['admin/getTermsCondition'];
    });
  },
  methods: {
    validationForm: function validationForm() {
      var _this2 = this;

      this.loading = true;
      this.$refs.registerForm.validate().then(function (success) {
        if (success) {
          _this2.$store.dispatch('user/userRegistration', {
            name: _this2.name,
            email: _this2.regEmail,
            password: _this2.password,
            password_confirmation: _this2.password_confirmation,
            country_id: _this2.country,
            division_id: _this2.division,
            district_id: _this2.district,
            upazila_id: _this2.upazila,
            refer_code: _this2.refer_code
          }).then(function (response) {
            if (response === 'Success') {
              _this2.$bvToast.toast(_this2.$store.getters['user/getMessage'], {
                title: 'Information',
                variant: 'success',
                solid: false
              });

              _this2.$router.push({
                name: 'user.email.verify',
                query: {
                  email: _this2.regEmail
                }
              });
            }

            _this2.loading = false;
          })["catch"](function (error) {
            _this2.loading = false;

            _this2.$refs.registerForm.setErrors(error.response.data.errors);
          });
        }
      });
    },
    resetForm: function resetForm() {
      this.name = '';
      this.regEmail = '';
      this.password = '';
      this.password_confirmation = '';
    },
    toggleConfirmPasswordVisibility: function toggleConfirmPasswordVisibility() {
      this.confirmPasswordFieldType = this.confirmPasswordFieldType === 'password' ? 'text' : 'password';
    },
    getDistricts: function getDistricts() {
      var _this3 = this;

      this.$store.dispatch('location/Districts', this.division).then(function () {
        _this3.districts = _this3.$store.getters['location/getDistricts'];
        _this3.district = _this3.districts[0].id;

        _this3.getUpazilas();
      });
    },
    getUpazilas: function getUpazilas() {
      var _this4 = this;

      this.$store.dispatch('location/Upazilas', this.district).then(function () {
        _this4.upazilas = _this4.$store.getters['location/getUpazilas'];
        _this4.upazila = _this4.upazilas[0].id;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/sass-loader/dist/cjs.js??ref--11-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// Imports
var ___CSS_LOADER_API_IMPORT___ = __webpack_require__(/*! ../../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
exports = ___CSS_LOADER_API_IMPORT___(false);
// Module
exports.push([module.i, ".auth-wrapper {\n  display: flex;\n  flex-basis: 100%;\n  min-height: 100vh;\n  min-height: calc(var(--vh, 1vh) * 100);\n  width: 100%;\n}\n.auth-wrapper .auth-inner {\n  width: 100%;\n  position: relative;\n}\n.auth-wrapper.auth-v1 {\n  align-items: center;\n  justify-content: center;\n  overflow: hidden;\n}\n.auth-wrapper.auth-v1 .auth-inner:before {\n  width: 244px;\n  height: 243px;\n  content: \" \";\n  position: absolute;\n  top: -54px;\n}\n[dir] .auth-wrapper.auth-v1 .auth-inner:before {\n  background-image: url(\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPQAAADzCAMAAACG9Mt0AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAA9KADAAQAAAABAAAA8wAAAADhQHfUAAAAyVBMVEUAAAD///+AgP+AgP9mZv+AgNWAgP9tbf9gYP+AgP9xcf9mZv+AZuaAgP9dXf90dOhiYv92dv9mZu5mZv93d+53d/9paf94afCAcfFrXvJra/9mZvJzZvJzc/JoaP96b/Rqav91aupsYvV2bOt2bPVxaPZ7cfZqavZyau1waPd4aO9xafBxafh4afB1bfh4avFuZ/F2afJzZvJzZ/N0aPN0bvN3bPR0ae5yZ/R3be93bfR1au9zafBxbPVzavV0a/F0a/ZyafFwaPKZm3nTAAAAQ3RSTlMAAQIEBQYGBwgICQoKCgsLDQ0PDw8PERESExMUFBQWFxgYGhoaGxsdHSAgIiIiIyQlJygqLCwtLi8vLzAzNDU3Nzg7h9vbHgAAA9RJREFUeNrt3ftS2kAUx/Fc1gSyWsErtuJdRDQiiteolb7/QzUoTm07k4AzObuu3/MCez45yWbzT36eZ6b8erO1e1B97baadd+zocJWmg0HaXe/+uqmg2GWtkLT5Lle1m9LdhG2+1lvzuiUO1knEF81yFc1N+35m15kZOGodz1vyLx+v2Lseq/erxtZd/NuweCTtfiwaWLOD5FnsqI7+VnP3y8afnEs3Es/1+H1qvETwuq18B7e6VlwLup1ZM8kWWQBOsrmHL7GVtxvYRZYgQ4ywae61ffsqH5Lbq20bQm6ncp9P2ehJegwE/u+rl95ttSwLrVSc2ANetAU28dSa9Cp2E623bUG3d2VWmn/wBq0XCugQYMGLdVKoOJaoiuok1NdXSW1WAUfRPtRUllflaJf5ZE/O9pXVbZUPTov5c+IDqvtRwStdTgLutoxy6GnGfYb2o+1I2gd+1OiqzfLocvVE7TSDqG1mgodaqfQZbvZC9rXjqG1X45WzqFVKVpk0LLo4lGP0ZGD6KgMnTiITkrQgXYQrYNitHISrYrRsZPouBhdcxJdK0YnTqKTYrR2Eq1BgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRoh9DH59ag86ACoSYOL61B55EUQk1s3VqDzsNHhJpYe7QGncfMSHUxaliCHgcKSXVxeWQJehwdJdXF4dAS9DgkTKqLxuibFeiXODixNi7OrEC/BP+JtbE0WrYA/RrxKNfH2YUF6NegSbk+Gk87xtErN6EsWm88fzeMXpwE9EruLns/l42io4dJFLPo2/Po1w+D6IW7t9Bt2SPx3vOOMfS7eHVZtN54ulg2go56138Ct4XRunE2Ovsmjg46WeddUoUWr6WL0fCoIYgO2/2s91fstDZQjcPL0ePt5flpdXUwqW46uMrS1j95JNpQrW0dHp9UV/uT2m416/8HVGg3qzhpBjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KC/FDpx0pwUo2tOomvF6NhJdFyMVk6iVTE6cBIdeF9vJyvZx/I/AzuIjsrQvoNovwzt4FamSs0Ojrp80PmvoB0zh940pb7azf1yg7t0LIt978uppzbnalfucDW92ZndLPRmKweGPduYJ+zoM5/Dk+gD5NdvLhXXPp88qcUqmEH5G5JZRs6cuxwIAAAAAElFTkSuQmCC\");\n}\n[dir=ltr] .auth-wrapper.auth-v1 .auth-inner:before {\n  left: -46px;\n}\n[dir=rtl] .auth-wrapper.auth-v1 .auth-inner:before {\n  right: -46px;\n}\n@media (max-width: 575.98px) {\n.auth-wrapper.auth-v1 .auth-inner:before {\n    display: none;\n}\n}\n.auth-wrapper.auth-v1 .auth-inner:after {\n  width: 272px;\n  height: 272px;\n  content: \" \";\n  position: absolute;\n  bottom: -55px;\n  z-index: -1;\n}\n[dir] .auth-wrapper.auth-v1 .auth-inner:after {\n  background-image: url(\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARAAAAEQCAMAAABP1NsnAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAABEKADAAQAAAABAAABEAAAAAAQWxS2AAAAwFBMVEUAAAD///+AgICAgP9VVaqqVf+qqv+AgL+AgP9mZsxmZv+ZZv+AgNWAgP9tbdttbf+Sbf+AYN+AgN+AgP9xceNmZv+AZuaAZv90dOh0dP9qav+AauqAav+AgP92dv9tbf+Abe2Abf93Zu53d+6AcO94afCAcfF5a+R5a/JzZuaAZvKAc/J5bed5bfOAaPN6b/R1auqAavR6ZvV6cPV2bOuAbPV7aPZ2be2AbfZ7au17avZ3Zu53b+57a+97a/d4aO9J6CoeAAAAQHRSTlMAAQICAwMDBAQFBQUGBgcHBwgICAkKCgoLCwwMDAwNDg4ODw8QERITExQUFBUVFhcYGBkZGhobHBwdHR4eHx8gJ5uMWwAAA/FJREFUeNrt2G1XEkEYxvHZNk2xHGzdbKFl0cTwgdSkCKzu7/+t4pw6sAjtjIueE/f8r3fMO35nZnbuy5gVGcvfzJe0rnTfGI+MggGJRUZnbpPIhJKt88nU53JnFULvyISY6KAv8vPj0vr2rYwiE2Z2B9J+uNYcyyQxwWZvaeGH3G4bMjsvI/kcwTC/V+7kLoahlITzQojP3ZFgsJCh7IJQzpX0QFj4uMiY18eDMZ9bZCF9OQahnK6cm/Y7js0sh/LF3Auv1PlQd3MxbdXYIQspV44EEEAAAWTNDAYYkKdJbNMsLzYueZbaZ2iM46RVbHBaiZ9Js+nHEdli42N9XuSen5hGp1CQTuOJQDRsD99N4gMSpYWapNH6IJo83CIeILZQFesEaber79NCWRoukOpNEnW0gXQqD81w6ACxhbrYde7VuFCYeA2QRCNIsgZISyNIqz6IyhPjOjNVIFYniK3dmKU6QdLaJUimEySrDZLrBMlrgxRKU7sxCw/EMe0CAggggADySJCqxixIkKpNEh6IozELD8RxjQACCCCAAPJIkKrGLEgQXqqAAEJjxrQLCCCAAEJjRmNGY8a0CwgggABCYwYIfQgggNCYMe0CAggggNCY0ZjRmDHtAgIIIIAAQmNGHwIIIDRmTLuAAAIIIDRmNGY0Zky7gAACCCCA0JjRhwACCI0Z0y4ggAACCI0ZjRmNGdMuIIAAAgggNGb0IYAAQmPGtAsIIIAAQmNGY0ZjxrQLCCCAAAIIjRl9CCCA0Jgx7QICCCCA0JjRmNGYMe0CAggggABCY0YfAgggNGZMu4AAAgggNGY0ZjRmTLuAAAIIIIDQmNGHAAIIjRnTLiCAAAIIjRmNGY0ZIEy7gAACCCA0ZvQhgABCY8a0CwgggABCY0ZjBgiNGdMuIIAAAgiN2f/Sh+Q6PfLaIJlOkKw2SKoTJK3dmFmdILb2tBvrBIlrg5iWRo+WqQ+SaARJ1gCJAzsxThCN16p1vNurGjNjoo42j07kAHFskoY2kEbl33U0ZgoPjXW+Rl0gkarnahqtDaJKxMPDDWIiNafGenh4gExvVhXfmk7Da6L1AVGxSby2h6MxK79Zk42ea1pJbJ48sU2zDezQ8iy1z6BBwoyjMQsvXp8YQAAhgADilRfyy+wf8WqZZUfGZihvgZiB3FybC+kCUU5XLkAo50C+gbBQdUzkAIVyejIAYfFTI1solHP2HgNCnHn5AYNy4jvpoVB6fVzL91cwzLJ9Lfd7S0jhehxO5H5/yePr1W6gHonI7fJ5ORSR/n6Q2yQanq763zuXU5LJZRKiyD/W9/pjkdPZz0/yJ8fqVyry+qQZDMjJKoDfy8bRVhHhQTwAAAAASUVORK5CYII=\");\n}\n[dir=ltr] .auth-wrapper.auth-v1 .auth-inner:after {\n  right: -75px;\n}\n[dir=rtl] .auth-wrapper.auth-v1 .auth-inner:after {\n  left: -75px;\n}\n@media (max-width: 575.98px) {\n.auth-wrapper.auth-v1 .auth-inner:after {\n    display: none;\n}\n}\n.auth-wrapper.auth-v2 {\n  align-items: flex-start;\n}\n.auth-wrapper.auth-v2 .auth-inner {\n  height: 100vh;\n  overflow-y: auto;\n  height: calc(var(--vh, 1vh) * 100);\n}\n.auth-wrapper.auth-v2 .brand-logo {\n  position: absolute;\n  top: 2rem;\n  z-index: 1;\n}\n[dir] .auth-wrapper.auth-v2 .brand-logo {\n  margin: 0;\n}\n[dir=ltr] .auth-wrapper.auth-v2 .brand-logo {\n  left: 2rem;\n}\n[dir=rtl] .auth-wrapper.auth-v2 .brand-logo {\n  right: 2rem;\n}\n.auth-wrapper.auth-v1 .auth-inner {\n  max-width: 400px;\n}\n.auth-wrapper .brand-logo {\n  display: flex;\n  justify-content: center;\n}\n[dir] .auth-wrapper .brand-logo {\n  margin: 1rem 0 2rem 0;\n}\n.auth-wrapper .brand-logo .brand-text {\n  font-weight: 600;\n}\n[dir] .auth-wrapper .auth-footer-btn .btn {\n  padding: 0.6rem !important;\n}\n[dir=ltr] .auth-wrapper .auth-footer-btn .btn:not(:last-child) {\n  margin-right: 1rem;\n}\n[dir=rtl] .auth-wrapper .auth-footer-btn .btn:not(:last-child) {\n  margin-left: 1rem;\n}\n@media (min-width: 1200px) {\n.auth-wrapper.auth-v2 .auth-card {\n    width: 400px;\n}\n}\n[dir] .auth-wrapper .auth-bg {\n  background-color: #fff;\n}\n[dir] .dark-layout .auth-wrapper .auth-bg {\n  background-color: #283046;\n}\n.brand-logo svg {\n  height: 28px;\n  width: 40.95px;\n}\nhtml[dir=rtl] svg.feather {\n  transform: rotate(180deg);\n}", ""]);
// Exports
module.exports = exports;


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/sass-loader/dist/cjs.js??ref--11-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader/dist/cjs.js!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--11-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Register.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=template&id=30669990&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/user/auth/Register.vue?vue&type=template&id=30669990& ***!
  \********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "b-col",
        {
          staticClass: "px-xl-2 mx-auto",
          attrs: { sm: "8", md: "6", lg: "12" },
        },
        [
          _c(
            "div",
            { staticClass: "text-center" },
            [
              _c("b-img", {
                attrs: { fluid: "", src: _vm.topLogo, alt: "Sources Logo" },
              }),
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-card-title",
            {
              staticClass:
                "font-weight-bold mb-1 ont-weight-bold mb-1 text-center login-title h2",
              staticStyle: { "text-decoration": "underline" },
              attrs: { "title-tag": "h2" },
            },
            [_vm._v("\n      Blogger Registration\n    ")]
          ),
          _vm._v(" "),
          _c("b-card-text", { staticClass: "mb-2" }, [
            _vm._v(
              "\n      Please sign-in to your account and start the adventure\n    "
            ),
          ]),
          _vm._v(" "),
          _c(
            "validation-observer",
            { ref: "registerForm" },
            [
              _c(
                "b-form",
                {
                  staticClass: "auth-login-form mt-2",
                  on: {
                    submit: function ($event) {
                      $event.preventDefault()
                    },
                  },
                },
                [
                  _c(
                    "b-form-group",
                    { attrs: { label: "Name", "label-for": "login-name" } },
                    [
                      _c("validation-provider", {
                        attrs: { name: "name", vid: "name", rules: "required" },
                        scopedSlots: _vm._u([
                          {
                            key: "default",
                            fn: function (ref) {
                              var errors = ref.errors
                              return [
                                _c("b-form-input", {
                                  attrs: {
                                    id: "login-name",
                                    state: errors.length > 0 ? false : null,
                                    name: "login-name",
                                    placeholder: "Enter your name",
                                  },
                                  model: {
                                    value: _vm.name,
                                    callback: function ($$v) {
                                      _vm.name = $$v
                                    },
                                    expression: "name",
                                  },
                                }),
                                _vm._v(" "),
                                _c("small", { staticClass: "text-danger" }, [
                                  _vm._v(_vm._s(errors[0])),
                                ]),
                              ]
                            },
                          },
                        ]),
                      }),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    { attrs: { label: "Email", "label-for": "login-email" } },
                    [
                      _c("validation-provider", {
                        attrs: {
                          vid: "email",
                          name: "email",
                          rules: "required|email",
                        },
                        scopedSlots: _vm._u([
                          {
                            key: "default",
                            fn: function (ref) {
                              var errors = ref.errors
                              return [
                                _c("b-form-input", {
                                  attrs: {
                                    id: "login-email",
                                    state: errors.length > 0 ? false : null,
                                    name: "login-email",
                                    placeholder: "john@example.com",
                                  },
                                  model: {
                                    value: _vm.regEmail,
                                    callback: function ($$v) {
                                      _vm.regEmail = $$v
                                    },
                                    expression: "regEmail",
                                  },
                                }),
                                _vm._v(" "),
                                _c("small", { staticClass: "text-danger" }, [
                                  _vm._v(_vm._s(errors[0])),
                                ]),
                              ]
                            },
                          },
                        ]),
                      }),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    { attrs: { label: "Country", "label-for": "country" } },
                    [
                      _c("validation-provider", {
                        attrs: {
                          vid: "country_id",
                          name: "country",
                          rules: "required",
                        },
                        scopedSlots: _vm._u([
                          {
                            key: "default",
                            fn: function (ref) {
                              var errors = ref.errors
                              return [
                                _c("b-form-select", {
                                  attrs: {
                                    id: "country",
                                    options: _vm.countries,
                                    "value-field": "id",
                                    "text-field": "name",
                                    state: errors.length > 0 ? false : null,
                                  },
                                  model: {
                                    value: _vm.country,
                                    callback: function ($$v) {
                                      _vm.country = $$v
                                    },
                                    expression: "country",
                                  },
                                }),
                                _vm._v(" "),
                                _c("small", { staticClass: "text-danger" }, [
                                  _vm._v(_vm._s(errors[0])),
                                ]),
                              ]
                            },
                          },
                        ]),
                      }),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _vm.country === 20
                    ? _c(
                        "b-form-group",
                        {
                          attrs: { label: "Division", "label-for": "division" },
                        },
                        [
                          _c("validation-provider", {
                            attrs: {
                              vid: "division_id",
                              name: "division",
                              rules: "required",
                            },
                            scopedSlots: _vm._u(
                              [
                                {
                                  key: "default",
                                  fn: function (ref) {
                                    var errors = ref.errors
                                    return [
                                      _c("b-form-select", {
                                        attrs: {
                                          id: "division",
                                          options: _vm.divisions,
                                          "value-field": "id",
                                          "text-field": "name",
                                          state:
                                            errors.length > 0 ? false : null,
                                        },
                                        on: { change: _vm.getDistricts },
                                        model: {
                                          value: _vm.division,
                                          callback: function ($$v) {
                                            _vm.division = $$v
                                          },
                                          expression: "division",
                                        },
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "small",
                                        { staticClass: "text-danger" },
                                        [_vm._v(_vm._s(errors[0]))]
                                      ),
                                    ]
                                  },
                                },
                              ],
                              null,
                              false,
                              4095055837
                            ),
                          }),
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.division
                    ? _c(
                        "b-form-group",
                        {
                          attrs: { label: "District", "label-for": "district" },
                        },
                        [
                          _c("validation-provider", {
                            attrs: {
                              vid: "district_id",
                              name: "district",
                              rules: "required",
                            },
                            scopedSlots: _vm._u(
                              [
                                {
                                  key: "default",
                                  fn: function (ref) {
                                    var errors = ref.errors
                                    return [
                                      _c("b-form-select", {
                                        attrs: {
                                          id: "district",
                                          options: _vm.districts,
                                          "value-field": "id",
                                          "text-field": "name",
                                          state:
                                            errors.length > 0 ? false : null,
                                        },
                                        on: { change: _vm.getUpazilas },
                                        model: {
                                          value: _vm.district,
                                          callback: function ($$v) {
                                            _vm.district = $$v
                                          },
                                          expression: "district",
                                        },
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "small",
                                        { staticClass: "text-danger" },
                                        [_vm._v(_vm._s(errors[0]))]
                                      ),
                                    ]
                                  },
                                },
                              ],
                              null,
                              false,
                              1238837358
                            ),
                          }),
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.district
                    ? _c(
                        "b-form-group",
                        { attrs: { label: "Upazila", "label-for": "upazila" } },
                        [
                          _c("validation-provider", {
                            attrs: {
                              name: "upazila",
                              vid: "upazila_id",
                              rules: "required",
                            },
                            scopedSlots: _vm._u(
                              [
                                {
                                  key: "default",
                                  fn: function (ref) {
                                    var errors = ref.errors
                                    return [
                                      _c("b-form-select", {
                                        attrs: {
                                          id: "upazila",
                                          options: _vm.upazilas,
                                          "value-field": "id",
                                          "text-field": "name",
                                          state:
                                            errors.length > 0 ? false : null,
                                        },
                                        model: {
                                          value: _vm.upazila,
                                          callback: function ($$v) {
                                            _vm.upazila = $$v
                                          },
                                          expression: "upazila",
                                        },
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "small",
                                        { staticClass: "text-danger" },
                                        [_vm._v(_vm._s(errors[0]))]
                                      ),
                                    ]
                                  },
                                },
                              ],
                              null,
                              false,
                              419487968
                            ),
                          }),
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    [
                      _c(
                        "div",
                        { staticClass: "d-flex justify-content-between" },
                        [
                          _c("label", { attrs: { for: "loginpassword" } }, [
                            _vm._v("Password"),
                          ]),
                        ]
                      ),
                      _vm._v(" "),
                      _c("validation-provider", {
                        attrs: {
                          vid: "password",
                          name: "password",
                          rules: "required",
                        },
                        scopedSlots: _vm._u([
                          {
                            key: "default",
                            fn: function (ref) {
                              var errors = ref.errors
                              return [
                                _c(
                                  "b-input-group",
                                  {
                                    staticClass: "input-group-merge",
                                    class:
                                      errors.length > 0 ? "is-invalid" : null,
                                  },
                                  [
                                    _c("b-form-input", {
                                      staticClass: "form-control-merge",
                                      attrs: {
                                        id: "loginpassword",
                                        state: errors.length > 0 ? false : null,
                                        type: _vm.passwordFieldType,
                                        name: "login-password",
                                        placeholder: "············",
                                      },
                                      model: {
                                        value: _vm.password,
                                        callback: function ($$v) {
                                          _vm.password = $$v
                                        },
                                        expression: "password",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c(
                                      "b-input-group-append",
                                      { attrs: { "is-text": "" } },
                                      [
                                        _c("feather-icon", {
                                          staticClass: "cursor-pointer",
                                          attrs: {
                                            icon: _vm.passwordToggleIcon,
                                          },
                                          on: {
                                            click: _vm.togglePasswordVisibility,
                                          },
                                        }),
                                      ],
                                      1
                                    ),
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c("small", { staticClass: "text-danger" }, [
                                  _vm._v(_vm._s(errors[0])),
                                ]),
                              ]
                            },
                          },
                        ]),
                      }),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    [
                      _c("validation-provider", {
                        attrs: {
                          vid: "password",
                          name: "confirm_password",
                          rules: "required",
                        },
                        scopedSlots: _vm._u([
                          {
                            key: "default",
                            fn: function (ref) {
                              var errors = ref.errors
                              return [
                                _c(
                                  "label",
                                  { attrs: { for: "confirm_password" } },
                                  [_vm._v("Confirm Password")]
                                ),
                                _vm._v(" "),
                                _c(
                                  "b-input-group",
                                  {
                                    staticClass: "input-group-merge",
                                    class:
                                      errors.length > 0 ? "is-invalid" : null,
                                  },
                                  [
                                    _c("b-form-input", {
                                      staticClass: "form-control-merge",
                                      attrs: {
                                        id: "confirm_password",
                                        state: errors.length > 0 ? false : null,
                                        type: _vm.confirmPasswordFieldType,
                                        name: "password_confirmation",
                                        placeholder: "············",
                                      },
                                      model: {
                                        value: _vm.password_confirmation,
                                        callback: function ($$v) {
                                          _vm.password_confirmation = $$v
                                        },
                                        expression: "password_confirmation",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c(
                                      "b-input-group-append",
                                      { attrs: { "is-text": "" } },
                                      [
                                        _c("feather-icon", {
                                          staticClass: "cursor-pointer",
                                          attrs: {
                                            icon: _vm.confirmPasswordToggleIcon,
                                          },
                                          on: {
                                            click:
                                              _vm.toggleConfirmPasswordVisibility,
                                          },
                                        }),
                                      ],
                                      1
                                    ),
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c("small", { staticClass: "text-danger" }, [
                                  _vm._v(_vm._s(errors[0])),
                                ]),
                              ]
                            },
                          },
                        ]),
                      }),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "b-form-group",
                    [
                      _c(
                        "b-form-checkbox",
                        {
                          attrs: { id: "remember-me", name: "remember_me" },
                          model: {
                            value: _vm.status,
                            callback: function ($$v) {
                              _vm.status = $$v
                            },
                            expression: "status",
                          },
                        },
                        [
                          _vm._v("\n            Accept All "),
                          _c(
                            "a",
                            {
                              attrs: { href: "" },
                              on: {
                                click: function ($event) {
                                  $event.preventDefault()
                                  return _vm.$bvModal.show("modal-terms&con")
                                },
                              },
                            },
                            [_vm._v("Terms and\n              Condition")]
                          ),
                          _vm._v(" "),
                          _c("i", {
                            staticClass: "fas fa-info-circle",
                            attrs: {
                              "data-toggle": "tooltip",
                              "data-placement": "top",
                              title: "",
                              "data-original-title":
                                "Must be check in or visit",
                            },
                          }),
                        ]
                      ),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _vm.loading
                    ? _c(
                        "b-button",
                        {
                          attrs: {
                            type: "submit",
                            variant: "primary",
                            block: "",
                          },
                        },
                        [_c("b-spinner", { attrs: { small: "" } })],
                        1
                      )
                    : _c(
                        "b-button",
                        {
                          attrs: {
                            type: "submit",
                            variant: "primary",
                            block: "",
                          },
                          on: { click: _vm.validationForm },
                        },
                        [_c("span", [_vm._v("Register")])]
                      ),
                ],
                1
              ),
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-card-text",
            { staticClass: "text-center mt-2" },
            [
              _c("span", [_vm._v("Have an Account? ")]),
              _vm._v(" "),
              _c("b-link", { attrs: { to: { name: "user.login" } } }, [
                _c("span", [_vm._v(" Sign In")]),
              ]),
            ],
            1
          ),
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          attrs: {
            id: "modal-terms&con",
            title: "Terms & Condition",
            scrollable: "",
            "ok-only": "",
            "ok-title": "Accept",
          },
        },
        [_c("b-card-text", { domProps: { innerHTML: _vm._s(_vm.tos) } })],
        1
      ),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/@core/mixins/ui/forms.js":
/*!***************************************************!*\
  !*** ./resources/js/src/@core/mixins/ui/forms.js ***!
  \***************************************************/
/*! exports provided: togglePasswordVisibility, _ */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "togglePasswordVisibility", function() { return togglePasswordVisibility; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "_", function() { return _; });
// We haven't added icon's computed property because it makes this mixin coupled with UI
var togglePasswordVisibility = {
  data: function data() {
    return {
      passwordFieldType: 'password'
    };
  },
  methods: {
    togglePasswordVisibility: function togglePasswordVisibility() {
      this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
    }
  }
};
var _ = null;

/***/ }),

/***/ "./resources/js/src/@core/utils/validations/validations.js":
/*!*****************************************************************!*\
  !*** ./resources/js/src/@core/utils/validations/validations.js ***!
  \*****************************************************************/
/*! exports provided: required, email, min, confirmed, regex, between, alpha, integer, digits, alphaDash, alphaNum, length, positive, credit, password, url */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "required", function() { return required; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "email", function() { return email; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "min", function() { return min; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "confirmed", function() { return confirmed; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "regex", function() { return regex; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "between", function() { return between; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "alpha", function() { return alpha; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "integer", function() { return integer; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "digits", function() { return digits; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "alphaDash", function() { return alphaDash; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "alphaNum", function() { return alphaNum; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "length", function() { return length; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "positive", function() { return positive; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "credit", function() { return credit; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "password", function() { return password; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "url", function() { return url; });
/* harmony import */ var vee_validate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vee-validate */ "./node_modules/vee-validate/dist/vee-validate.esm.js");
/* harmony import */ var vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vee-validate/dist/rules */ "./node_modules/vee-validate/dist/rules.js");
/* harmony import */ var vee_validate_dist_locale_ar_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vee-validate/dist/locale/ar.json */ "./node_modules/vee-validate/dist/locale/ar.json");
var vee_validate_dist_locale_ar_json__WEBPACK_IMPORTED_MODULE_2___namespace = /*#__PURE__*/__webpack_require__.t(/*! vee-validate/dist/locale/ar.json */ "./node_modules/vee-validate/dist/locale/ar.json", 1);
/* harmony import */ var vee_validate_dist_locale_en_json__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vee-validate/dist/locale/en.json */ "./node_modules/vee-validate/dist/locale/en.json");
var vee_validate_dist_locale_en_json__WEBPACK_IMPORTED_MODULE_3___namespace = /*#__PURE__*/__webpack_require__.t(/*! vee-validate/dist/locale/en.json */ "./node_modules/vee-validate/dist/locale/en.json", 1);
/* harmony import */ var _validators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./validators */ "./resources/js/src/@core/utils/validations/validators.js");



 // eslint-disable-next-line object-curly-newline

 // ////////////////////////////////////////////////////////
// General
// ////////////////////////////////////////////////////////

var required = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('required', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["required"]);
var email = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('email', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["email"]);
var min = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('min', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["min"]);
var confirmed = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('confirmed', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["confirmed"]);
var regex = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('regex', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["regex"]);
var between = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('between', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["between"]);
var alpha = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('alpha', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["alpha"]);
var integer = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('integer', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["integer"]);
var digits = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('digits', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["digits"]);
var alphaDash = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('alpha-dash', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["alpha_dash"]);
var alphaNum = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('alpha-num', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["alpha_num"]);
var length = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('length', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["length"]);
var positive = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('positive', {
  validate: _validators__WEBPACK_IMPORTED_MODULE_4__["validatorPositive"],
  message: 'Please enter positive number!'
});
var credit = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('credit-card', {
  validate: _validators__WEBPACK_IMPORTED_MODULE_4__["validatorCreditCard"],
  message: 'It is not valid credit card!'
});
var password = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('password', {
  validate: _validators__WEBPACK_IMPORTED_MODULE_4__["validatorPassword"],
  message: 'Your {_field_} must contain at least one uppercase, one lowercase, one special character and one digit'
});
var url = Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('url', {
  validate: _validators__WEBPACK_IMPORTED_MODULE_4__["validatorUrlValidator"],
  message: 'URL is invalid'
}); // Install English and Arabic localizations.

Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["localize"])({
  en: {
    messages: vee_validate_dist_locale_en_json__WEBPACK_IMPORTED_MODULE_3__.messages,
    names: {
      email: 'Email',
      password: 'Password'
    },
    fields: {
      password: {
        min: '{_field_} is too short, you want to get hacked?'
      }
    }
  },
  ar: {
    messages: vee_validate_dist_locale_ar_json__WEBPACK_IMPORTED_MODULE_2__.messages,
    names: {
      email: 'البريد الإلكتروني',
      password: 'كلمة السر'
    },
    fields: {
      password: {
        min: 'كلمة السر قصيرة جداً سيتم اختراقك'
      }
    }
  }
}); // ////////////////////////////////////////////////////////
// NOTE:
// Quasar validation for reference only
// Remove this note once development is finished and make sure to
// to convert all of them in veevalidate version
// ////////////////////////////////////////////////////////
// export const required = (val) => {
//   return (val && val.length > 0) || '*Field is required'
// }
// export const required_obj = (obj) => {
//   if (obj === null || obj === undefined) return '*Field is required'
//   return (Object.entries(obj).length > 0 && obj.constructor === Object) || '*Field is required'
// }
// export const no_blank_spaces_arr = (arr) => {
//   return arr.every(val => (val.trim() && val.trim().length > 0)) || 'Blank Spaces are not allowed'
// }
// export const url = val => {
//   // If blank return
//   if (val === undefined || val === null || val.length === 0) return true
//   // Used
//   // https://stackoverflow.com/questions/4314741/url-regex-validation
//   // Other
//   // https://stackoverflow.com/questions/5717093/check-if-a-javascript-string-is-a-url
//   // https://www.w3resource.com/javascript-exercises/javascript-regexp-exercise-9.php
//   // https://www.geeksforgeeks.org/how-to-validate-url-using-regular-expression-in-javascript/
//   /* eslint-disable no-useless-escape */
//   const re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/
//   /* eslint-enable no-useless-escape */
//   return re.test(val) || 'URL is invalid'
// }
// export const date = val => {
//   // If blank return
//   if (val === undefined || val === null || val.length === 0) return true
//   // https://github.com/quasarframework/quasar/blob/dev/ui/src/utils/patterns.js
//   return /^-?[\d]+\/[0-1]\d\/[0-3]\d$/.test(val) || 'Date is invalid'
// }
// export const max = (val, max) => {
//   // If blank return
//   if (val === undefined || val === null) return true
//   return val.length <= max || `More than ${max} characters are not allowed`
// }
// export const max_arr = (val, max) => {
//   return val.length <= max || `More than ${max} values are not allowed`
// }
// export const min = (val, min) => {
//   // If blank return
//   if (val === undefined || val === null || val.length === 0) return true
//   return val.length >= min || `Minimum ${min} characters are required`
// }
// export const num_range = (val, min, max) => {
//   // If blank return
//   if (val === undefined || val === null || val.length === 0) return true
//   const msg = 'Value is invalid'
//   if (min === null) return val <= max || msg
//   else if (max === null) return val >= min || msg
//   else return (val >= min && val <= max) || msg
// }

/***/ }),

/***/ "./resources/js/src/@core/utils/validations/validators.js":
/*!****************************************************************!*\
  !*** ./resources/js/src/@core/utils/validations/validators.js ***!
  \****************************************************************/
/*! exports provided: validatorPositive, validatorPassword, validatorCreditCard, validatorUrlValidator */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validatorPositive", function() { return validatorPositive; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validatorPassword", function() { return validatorPassword; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validatorCreditCard", function() { return validatorCreditCard; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validatorUrlValidator", function() { return validatorUrlValidator; });
var validatorPositive = function validatorPositive(value) {
  if (value >= 0) {
    return true;
  }

  return false;
};
var validatorPassword = function validatorPassword(password) {
  /* eslint-disable no-useless-escape */
  var regExp = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*()]).{8,}/;
  /* eslint-enable no-useless-escape */

  var validPassword = regExp.test(password);
  return validPassword;
};
var validatorCreditCard = function validatorCreditCard(creditnum) {
  /* eslint-disable no-useless-escape */
  var cRegExp = /^(?:3[47][0-9]{13})$/;
  /* eslint-enable no-useless-escape */

  var validCreditCard = cRegExp.test(creditnum);
  return validCreditCard;
};
var validatorUrlValidator = function validatorUrlValidator(val) {
  if (val === undefined || val === null || val.length === 0) {
    return true;
  }
  /* eslint-disable no-useless-escape */


  var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
  /* eslint-enable no-useless-escape */

  return re.test(val);
};

/***/ }),

/***/ "./resources/js/src/views/user/auth/Register.vue":
/*!*******************************************************!*\
  !*** ./resources/js/src/views/user/auth/Register.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Register_vue_vue_type_template_id_30669990___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Register.vue?vue&type=template&id=30669990& */ "./resources/js/src/views/user/auth/Register.vue?vue&type=template&id=30669990&");
/* harmony import */ var _Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Register.vue?vue&type=script&lang=js& */ "./resources/js/src/views/user/auth/Register.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Register_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Register.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Register_vue_vue_type_template_id_30669990___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Register_vue_vue_type_template_id_30669990___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/user/auth/Register.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/user/auth/Register.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/src/views/user/auth/Register.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Register.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss& ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_sass_loader_dist_cjs_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader!../../../../../../node_modules/css-loader/dist/cjs.js!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--11-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Register.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/dist/cjs.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_sass_loader_dist_cjs_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_sass_loader_dist_cjs_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_sass_loader_dist_cjs_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_dist_cjs_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_sass_loader_dist_cjs_js_ref_11_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/src/views/user/auth/Register.vue?vue&type=template&id=30669990&":
/*!**************************************************************************************!*\
  !*** ./resources/js/src/views/user/auth/Register.vue?vue&type=template&id=30669990& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_30669990___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Register.vue?vue&type=template&id=30669990& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/user/auth/Register.vue?vue&type=template&id=30669990&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_30669990___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_30669990___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=22.126fc756afe408d28ee9.js.map