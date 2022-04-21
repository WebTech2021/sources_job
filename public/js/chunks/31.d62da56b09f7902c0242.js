(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[31],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/admin/post/reported.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/admin/post/reported.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(process) {/* harmony import */ var bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap-vue */ "./node_modules/bootstrap-vue/esm/index.js");
/* harmony import */ var vue_good_table__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-good-table */ "./node_modules/vue-good-table/dist/vue-good-table.esm.js");
/* harmony import */ var _core_scss_vue_libs_vue_good_table_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @core/scss/vue/libs/vue-good-table.scss */ "./resources/js/src/@core/scss/vue/libs/vue-good-table.scss");
/* harmony import */ var _core_scss_vue_libs_vue_good_table_scss__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_core_scss_vue_libs_vue_good_table_scss__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var vue_ripple_directive__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vue-ripple-directive */ "./node_modules/vue-ripple-directive/src/ripple.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'Reported',
  components: {
    BCol: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BCol"],
    BRow: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BRow"],
    BFormInput: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BFormInput"],
    BDropdown: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BDropdown"],
    BPagination: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BPagination"],
    BFormGroup: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BFormGroup"],
    VueGoodTable: vue_good_table__WEBPACK_IMPORTED_MODULE_1__["VueGoodTable"],
    BFormSelect: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BFormSelect"],
    BDropdownItem: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BDropdownItem"],
    BForm: bootstrap_vue__WEBPACK_IMPORTED_MODULE_0__["BForm"]
  },
  directives: {
    Ripple: vue_ripple_directive__WEBPACK_IMPORTED_MODULE_3__["default"]
  },
  data: function data() {
    return {
      rows: [],
      link: {},
      meta: {},
      pageLength: 10,
      dir: false,
      columns: [{
        label: 'Title',
        field: 'title',
        thClass: 'text-center'
      }, {
        label: 'Hate Speech',
        field: 'hate_speech',
        thClass: 'text-center'
      }, {
        label: 'Aggressive Content',
        field: 'aggressive_content',
        thClass: 'text-center'
      }, {
        label: 'Stolen Content',
        field: 'stolen_content',
        thClass: 'text-center'
      }, {
        label: 'Spamming Content',
        field: 'spamming_content',
        thClass: 'text-center'
      }, {
        label: 'Nudity',
        field: 'nudity',
        thClass: 'text-center'
      }, {
        label: 'Harassment',
        field: 'harassment',
        thClass: 'text-center'
      }, {
        label: 'Other',
        field: 'other',
        thClass: 'text-center'
      }, {
        label: 'Current Status',
        field: 'approval',
        thClass: 'text-center'
      }, {
        label: 'Action',
        field: 'action',
        thClass: 'text-center'
      }],
      // rows: [],
      searchTerm: '',
      page: 1,
      searchStatus: '',
      searchPublish: '',
      blockReason: '',
      postTitle: '',
      changedStatus: '',
      postID: ''
    };
  },
  created: function created() {
    this.getBlogs();
  },
  methods: {
    getBlogs: function getBlogs() {
      var _this = this;

      var current_page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      this.$store.dispatch('admin/post/reportedPosts', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          title: this.searchTerm,
          status: this.searchStatus,
          published: this.searchPublish
        }
      }).then(function () {
        _this.$nextTick(function () {
          _this.rows = _this.$store.getters['admin/post/getReportedPosts'];
          _this.meta = _this.$store.getters['admin/post/getMetaData'];
          _this.link = _this.$store.getters['admin/post/getLinkData'];
        });
      });
    },
    handleChangePage: function handleChangePage(page) {
      this.getBlogs(page);
    },
    selectedPage: function selectedPage(value) {
      this.getBlogs(this.page, value);
    },
    searchHandler: function searchHandler() {
      this.getBlogs();
    },
    deleteData: function deleteData(id) {
      var _this2 = this;

      this.$swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          _this2.$store.dispatch('user/post/deletePost', id).then(function () {
            _this2.getBlogs();
          })["catch"](function (error) {
            _this2.$refs.postForm.setErrors(error.response.data.errors);
          });

          _this2.$swal({
            icon: 'success',
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            customClass: {
              confirmButton: 'btn btn-success'
            }
          });
        }
      });
    },
    previewPost: function previewPost(slug) {
      window.open("".concat(process.env.MIX_SOURCES_APP_URL, "/preview/").concat(slug));
    },
    filterData: function filterData() {
      this.getBlogs();
    },
    changeStatus: function changeStatus(data, status) {
      var _this3 = this;

      if (status === 'active') {
        this.postID = data.id;
        this.changedStatus = status;
      } // this.changedStatus = status


      this.$store.dispatch('admin/post/changeStatus', {
        id: this.postID,
        status: this.changedStatus,
        reason: this.blockReason
      }).then(function () {
        _this3.getBlogs();

        _this3.$bvModal.hide('modal-reply');
      });
    },
    submitReply: function submitReply() {
      this.changeStatus();
      this.blockReason = '';
      this.postID = '';
    },
    openModal: function openModal(data, status) {
      this.postID = data.id;
      this.changedStatus = status;
      this.postTitle = data.title;
      this.$refs.replyModal.show();
    }
  }
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../node_modules/process/browser.js */ "./node_modules/process/browser.js")))

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/admin/post/reported.vue?vue&type=template&id=ca2266f0&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/admin/post/reported.vue?vue&type=template&id=ca2266f0&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
    "b-row",
    [
      _c("b-col", { attrs: { cols: "12" } }, [
        _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-header" }, [
            _c("span", { staticClass: "card-title" }, [_vm._v("Post List")]),
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "card-body" },
            [
              _c(
                "div",
                { staticClass: "custom-search d-flex justify-content-end" },
                [
                  _c("b-form-group", [
                    _c(
                      "div",
                      { staticClass: "d-flex align-items-center" },
                      [
                        _c("label", { staticClass: "mr-1" }, [
                          _vm._v("Search"),
                        ]),
                        _vm._v(" "),
                        _c("b-form-input", {
                          staticClass: "d-inline-block",
                          attrs: { placeholder: "Search", type: "text" },
                          on: { keyup: _vm.searchHandler },
                          model: {
                            value: _vm.searchTerm,
                            callback: function ($$v) {
                              _vm.searchTerm = $$v
                            },
                            expression: "searchTerm",
                          },
                        }),
                      ],
                      1
                    ),
                  ]),
                ],
                1
              ),
              _vm._v(" "),
              _c("vue-good-table", {
                ref: "productsTable",
                attrs: {
                  columns: _vm.columns,
                  rows: _vm.rows,
                  "search-options": {
                    enabled: true,
                    externalQuery: _vm.searchTerm,
                  },
                  mode: "remote",
                  "pagination-options": {
                    enabled: true,
                    perPage: _vm.pageLength,
                  },
                  "line-numbers": true,
                  "style-class": "vgt-table striped bordered condensed",
                },
                scopedSlots: _vm._u([
                  {
                    key: "table-row",
                    fn: function (props) {
                      return [
                        props.column.field === "approval"
                          ? _c("span", { staticClass: "text-nowrap" }, [
                              props.row.status === "pending"
                                ? _c("span", { staticClass: "text-nowrap" }, [
                                    _c(
                                      "span",
                                      {
                                        staticClass:
                                          "badge badge-light-warning",
                                      },
                                      [_vm._v("Pending")]
                                    ),
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              props.row.status === "active"
                                ? _c("span", { staticClass: "text-nowrap" }, [
                                    _c(
                                      "span",
                                      {
                                        staticClass:
                                          "badge badge-light-success",
                                      },
                                      [_vm._v("Approved")]
                                    ),
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              props.row.status === "inactive"
                                ? _c("span", { staticClass: "text-nowrap" }, [
                                    _c(
                                      "span",
                                      {
                                        staticClass:
                                          "badge badge-light-secondary",
                                      },
                                      [_vm._v("Inactive")]
                                    ),
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              props.row.status === "pause"
                                ? _c("span", { staticClass: "text-nowrap" }, [
                                    _c(
                                      "span",
                                      {
                                        staticClass:
                                          "badge badge-light-secondary",
                                      },
                                      [_vm._v("Paused")]
                                    ),
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              props.row.status === "blocked"
                                ? _c("span", { staticClass: "text-nowrap" }, [
                                    _c(
                                      "span",
                                      {
                                        staticClass: "badge badge-light-danger",
                                      },
                                      [_vm._v("Blocked")]
                                    ),
                                  ])
                                : _vm._e(),
                            ])
                          : props.column.field === "action"
                          ? _c("span", [
                              _c(
                                "span",
                                [
                                  _c(
                                    "b-dropdown",
                                    {
                                      attrs: {
                                        variant: "link",
                                        "toggle-class": "text-decoration-none",
                                        "no-caret": "",
                                      },
                                      scopedSlots: _vm._u(
                                        [
                                          {
                                            key: "button-content",
                                            fn: function () {
                                              return [
                                                _c("feather-icon", {
                                                  staticClass:
                                                    "text-body align-middle mr-25",
                                                  attrs: {
                                                    icon: "MoreVerticalIcon",
                                                    size: "16",
                                                  },
                                                }),
                                              ]
                                            },
                                            proxy: true,
                                          },
                                        ],
                                        null,
                                        true
                                      ),
                                    },
                                    [
                                      _vm._v(" "),
                                      props.row.status === "active"
                                        ? _c(
                                            "b-dropdown-item",
                                            {
                                              on: {
                                                click: function ($event) {
                                                  $event.preventDefault()
                                                  return _vm.openModal(
                                                    props.row,
                                                    "blocked"
                                                  )
                                                },
                                              },
                                            },
                                            [
                                              _c("feather-icon", {
                                                staticClass: "mr-50",
                                                attrs: { icon: "TrashIcon" },
                                              }),
                                              _vm._v(" "),
                                              _c("span", [_vm._v("Block It")]),
                                            ],
                                            1
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      props.row.status === "blocked" ||
                                      props.row.status === "pending"
                                        ? _c(
                                            "b-dropdown-item",
                                            {
                                              on: {
                                                click: function ($event) {
                                                  $event.preventDefault()
                                                  return _vm.changeStatus(
                                                    props.row,
                                                    "active"
                                                  )
                                                },
                                              },
                                            },
                                            [
                                              _c("feather-icon", {
                                                staticClass: "mr-50",
                                                attrs: { icon: "TrashIcon" },
                                              }),
                                              _vm._v(" "),
                                              _c("span", [_vm._v("Active It")]),
                                            ],
                                            1
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _c(
                                        "b-dropdown-item",
                                        {
                                          on: {
                                            click: function ($event) {
                                              $event.preventDefault()
                                              return _vm.previewPost(
                                                props.row.slug
                                              )
                                            },
                                          },
                                        },
                                        [
                                          _c("feather-icon", {
                                            staticClass: "mr-50",
                                            attrs: { icon: "EyeIcon" },
                                          }),
                                          _vm._v(" "),
                                          _c("span", [_vm._v("View Post")]),
                                        ],
                                        1
                                      ),
                                    ],
                                    1
                                  ),
                                ],
                                1
                              ),
                            ])
                          : _c("span", [
                              _vm._v(
                                "\n              " +
                                  _vm._s(
                                    props.formattedRow[props.column.field]
                                  ) +
                                  "\n            "
                              ),
                            ]),
                      ]
                    },
                  },
                  {
                    key: "pagination-bottom",
                    fn: function (props) {
                      return [
                        _c(
                          "div",
                          {
                            staticClass:
                              "d-flex justify-content-between flex-wrap",
                          },
                          [
                            _c(
                              "div",
                              {
                                staticClass:
                                  "d-flex align-items-center mb-0 mt-1",
                              },
                              [
                                _c("span", { staticClass: "text-nowrap " }, [
                                  _vm._v(
                                    "\n                  Showing 1 to\n                "
                                  ),
                                ]),
                                _vm._v(" "),
                                _c("b-form-select", {
                                  staticClass: "mx-1",
                                  attrs: {
                                    options: [
                                      "3",
                                      "5",
                                      "10",
                                      "25",
                                      "100",
                                      "200",
                                      "250",
                                    ],
                                  },
                                  on: {
                                    input: function (value) {
                                      return props.perPageChanged({
                                        currentPerPage: value,
                                      })
                                    },
                                    change: function ($event) {
                                      return _vm.selectedPage(_vm.pageLength)
                                    },
                                  },
                                  model: {
                                    value: _vm.pageLength,
                                    callback: function ($$v) {
                                      _vm.pageLength = $$v
                                    },
                                    expression: "pageLength",
                                  },
                                }),
                                _vm._v(" "),
                                _c("span", { staticClass: "text-nowrap" }, [
                                  _vm._v(
                                    " of " +
                                      _vm._s(_vm.meta.total) +
                                      " entries "
                                  ),
                                ]),
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              [
                                _c("b-pagination", {
                                  staticClass: "mt-1 mb-0",
                                  attrs: {
                                    value: 1,
                                    "total-rows": _vm.meta.total,
                                    "per-page": _vm.pageLength,
                                    "first-number": "",
                                    "last-number": "",
                                    "prev-class": "prev-item",
                                    "next-class": "next-item",
                                  },
                                  on: { change: _vm.handleChangePage },
                                  scopedSlots: _vm._u(
                                    [
                                      {
                                        key: "prev-text",
                                        fn: function () {
                                          return [
                                            _c("feather-icon", {
                                              attrs: {
                                                icon: "ChevronLeftIcon",
                                                size: "18",
                                              },
                                            }),
                                          ]
                                        },
                                        proxy: true,
                                      },
                                      {
                                        key: "next-text",
                                        fn: function () {
                                          return [
                                            _c("feather-icon", {
                                              attrs: {
                                                icon: "ChevronRightIcon",
                                                size: "18",
                                              },
                                            }),
                                          ]
                                        },
                                        proxy: true,
                                      },
                                    ],
                                    null,
                                    true
                                  ),
                                }),
                              ],
                              1
                            ),
                          ]
                        ),
                      ]
                    },
                  },
                ]),
              }),
            ],
            1
          ),
        ]),
      ]),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          ref: "replyModal",
          attrs: {
            id: "modal-reply",
            "cancel-variant": "outline-secondary",
            "ok-title": "Submit",
            "cancel-title": "Close",
            centered: "",
            title: "Blocking Form",
          },
          on: {
            ok: function ($event) {
              $event.preventDefault()
              return _vm.submitReply.apply(null, arguments)
            },
          },
        },
        [
          _c(
            "b-form",
            [
              _c(
                "b-form-group",
                [
                  _c("label", { attrs: { for: "comment" } }, [
                    _vm._v("Post Title:"),
                  ]),
                  _vm._v(" "),
                  _c("b-form-input", {
                    attrs: {
                      id: "comment",
                      type: "text",
                      placeholder: "User Comment",
                      disabled: "",
                    },
                    model: {
                      value: _vm.postTitle,
                      callback: function ($$v) {
                        _vm.postTitle = $$v
                      },
                      expression: "postTitle",
                    },
                  }),
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "b-form-group",
                [
                  _c("label", { attrs: { for: "reply" } }, [_vm._v("Reason")]),
                  _vm._v(" "),
                  _c("b-form-input", {
                    attrs: {
                      id: "reply",
                      type: "text",
                      placeholder: "Enter Block Reason",
                    },
                    model: {
                      value: _vm.blockReason,
                      callback: function ($$v) {
                        _vm.blockReason = $$v
                      },
                      expression: "blockReason",
                    },
                  }),
                ],
                1
              ),
            ],
            1
          ),
        ],
        1
      ),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-ripple-directive/src/ripple.js":
/*!*********************************************************!*\
  !*** ./node_modules/vue-ripple-directive/src/ripple.js ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var Ripple = {
    bind: function(el, binding){

        // Default values.
        var props = {
            event: 'mousedown',
            transition: 600
        };

        setProps(Object.keys(binding.modifiers),props);

        el.addEventListener(props.event, function(event) {
            rippler(event, el, binding.value);
        });

        var bg = binding.value || Ripple.color || 'rgba(0, 0, 0, 0.35)';
        var zIndex = Ripple.zIndex || '9999';

        function rippler(event, el) {
            var target = el;
            // Get border to avoid offsetting on ripple container position
            var targetBorder = parseInt((getComputedStyle(target).borderWidth).replace('px', ''));

            // Get necessary variables
            var rect        = target.getBoundingClientRect(),
                left        = rect.left,
                top         = rect.top,
                width       = target.offsetWidth,
                height      = target.offsetHeight,
                dx          = event.clientX - left,
                dy          = event.clientY - top,
                maxX        = Math.max(dx, width - dx),
                maxY        = Math.max(dy, height - dy),
                style       = window.getComputedStyle(target),
                radius      = Math.sqrt((maxX * maxX) + (maxY * maxY)),
                border      = (targetBorder > 0 ) ? targetBorder : 0;

            // Create the ripple and its container
            var ripple = document.createElement("div"),
                rippleContainer = document.createElement("div");
                rippleContainer.className = 'ripple-container';
                ripple.className = 'ripple';

            //Styles for ripple
            ripple.style.marginTop= '0px';
            ripple.style.marginLeft= '0px';
            ripple.style.width= '1px';
            ripple.style.height= '1px';
            ripple.style.transition= 'all ' + props.transition + 'ms cubic-bezier(0.4, 0, 0.2, 1)';
            ripple.style.borderRadius= '50%';
            ripple.style.pointerEvents= 'none';
            ripple.style.position= 'relative';
            ripple.style.zIndex= zIndex;
            ripple.style.backgroundColor  = bg;

            //Styles for rippleContainer
            rippleContainer.style.position= 'absolute';
            rippleContainer.style.left = 0 - border + 'px';
            rippleContainer.style.top = 0 - border + 'px';
            rippleContainer.style.height = '0';
            rippleContainer.style.width = '0';
            rippleContainer.style.pointerEvents = 'none';
            rippleContainer.style.overflow = 'hidden';

            // Store target position to change it after
            var storedTargetPosition =  ((target.style.position).length > 0) ? target.style.position : getComputedStyle(target).position;
            // Change target position to relative to guarantee ripples correct positioning
            if (storedTargetPosition !== 'relative') {
                target.style.position = 'relative';
            }

            rippleContainer.appendChild(ripple);
            target.appendChild(rippleContainer);

            ripple.style.marginLeft   = dx + "px";
            ripple.style.marginTop    = dy + "px";

            // No need to set positioning because ripple should be child of target and to it's relative position.
            // rippleContainer.style.left    = left + (((window.pageXOffset || document.scrollLeft) - (document.clientLeft || 0)) || 0) + "px";
            // rippleContainer.style.top     = top + (((window.pageYOffset || document.scrollTop) - (document.clientTop || 0)) || 0) + "px";
            rippleContainer.style.width   = width + "px";
            rippleContainer.style.height  = height + "px";
            rippleContainer.style.borderTopLeftRadius  = style.borderTopLeftRadius;
            rippleContainer.style.borderTopRightRadius  = style.borderTopRightRadius;
            rippleContainer.style.borderBottomLeftRadius  = style.borderBottomLeftRadius;
            rippleContainer.style.borderBottomRightRadius  = style.borderBottomRightRadius;

            rippleContainer.style.direction = 'ltr';

            setTimeout(function() {
                ripple.style.width  = radius * 2 + "px";
                ripple.style.height = radius * 2 + "px";
                ripple.style.marginLeft   = dx - radius + "px";
                ripple.style.marginTop    = dy - radius + "px";
            }, 0);

            function clearRipple() {
                setTimeout(function() {
                    ripple.style.backgroundColor = "rgba(0, 0, 0, 0)";
                }, 250);

                // Timeout set to get a smooth removal of the ripple
                setTimeout(function() {
                    rippleContainer.parentNode.removeChild(rippleContainer);
                }, 850);

                el.removeEventListener('mouseup', clearRipple, false);

                // After removing event set position to target to it's original one
                // Timeout it's needed to avoid jerky effect of ripple jumping out parent target
                setTimeout(function () {

                    var clearPosition = true;
                    for(var i = 0; i < target.childNodes.length; i++) {
                        if(target.childNodes[i].className === 'ripple-container') {
                            clearPosition = false;
                        }
                    }

                    if(clearPosition) {
                        if(storedTargetPosition !== 'static') {
                            target.style.position = storedTargetPosition;
                        } else {
                            target.style.position = '';
                        }
                    }

                }, props.transition + 250)
            }

            if(event.type === 'mousedown') {
                el.addEventListener('mouseup', clearRipple, false);
            } else {
                clearRipple();
            }
        }
    }
};

function setProps(modifiers,props) {
    modifiers.forEach(function(item) {
        if(isNaN(Number(item)))
            props.event = item;
        else
            props.transition = item;
    });
}

/* harmony default export */ __webpack_exports__["default"] = (Ripple);

/***/ }),

/***/ "./resources/js/src/views/admin/post/reported.vue":
/*!********************************************************!*\
  !*** ./resources/js/src/views/admin/post/reported.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _reported_vue_vue_type_template_id_ca2266f0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./reported.vue?vue&type=template&id=ca2266f0&scoped=true& */ "./resources/js/src/views/admin/post/reported.vue?vue&type=template&id=ca2266f0&scoped=true&");
/* harmony import */ var _reported_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./reported.vue?vue&type=script&lang=js& */ "./resources/js/src/views/admin/post/reported.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _reported_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _reported_vue_vue_type_template_id_ca2266f0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _reported_vue_vue_type_template_id_ca2266f0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "ca2266f0",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/admin/post/reported.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/admin/post/reported.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/src/views/admin/post/reported.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_reported_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./reported.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/admin/post/reported.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_reported_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/admin/post/reported.vue?vue&type=template&id=ca2266f0&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/src/views/admin/post/reported.vue?vue&type=template&id=ca2266f0&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_reported_vue_vue_type_template_id_ca2266f0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./reported.vue?vue&type=template&id=ca2266f0&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/admin/post/reported.vue?vue&type=template&id=ca2266f0&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_reported_vue_vue_type_template_id_ca2266f0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_reported_vue_vue_type_template_id_ca2266f0_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=31.d62da56b09f7902c0242.js.map