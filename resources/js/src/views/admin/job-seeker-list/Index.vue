<template>
  <div>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title" />
          <b-button
            variant="primary"
            @click.prevent="openModal"
          >
            <span class="text-nowrap">Job Seeker</span>
          </b-button>
        </div>
        <div class="card-body">
          <div class="custom-search d-flex justify-content-end">
            <b-form-group>
              <div class="d-flex align-items-center">
                <label class="mr-1">Search</label>
                <b-form-input
                  v-model="searchTerm"
                  placeholder="Search"
                  type="text"
                  class="d-inline-block"
                  @keyup="searchHandler"
                />
              </div>
            </b-form-group>
          </div>
          <!-- table -->
          <vue-good-table
            ref="productsTable"
            :columns="columns"
            :rows="rows.data ? rows.data :0"
            :search-options="{
              enabled: true,
              externalQuery: searchTerm
            }"
            mode="remote"
            :pagination-options="{
              enabled: true,
              perPage:pageLength
            }"
            :line-numbers="true"
            style-class="vgt-table striped bordered condensed"
          >
            <template
              slot="table-row"
              slot-scope="props"
            >
              <!-- Column: Name -->
              <span
                v-if="props.column.field === 'contact'"
                class="text-nowrap"
              >
                <!-- link avatar -->
                <b-avatar
                  href="#foobar"
                  :src="props.row.image"
                />
                <span>{{ props.row.first_name +' '+props.row.last_name }}</span>

              </span>
              <!-- Column: ads count -->

              <!-- Column: Action -->
              <span v-else-if="props.column.field === 'action'">
                <span>
                  <b-dropdown
                    variant="link"
                    toggle-class="text-decoration-none"
                    no-caret
                  >
                    <template v-slot:button-content>
                      <feather-icon
                        icon="MoreVerticalIcon"
                        size="16"
                        class="text-body align-middle mr-25"
                      />
                    </template>
                    <b-dropdown-item
                      @click.prevent="openEditModal(props.row)"
                    >
                      <feather-icon
                        icon="EditIcon"
                        class="mr-50"
                      />
                      <span>Edit</span>
                    </b-dropdown-item>
                    <b-dropdown-item
                      @click.prevent="changeStatus(props.row.id, props.row.status === 'active' ? 'blocked' : 'active')"
                    >
                      <feather-icon
                        :icon="props.row.status === 'active' ? 'AlertTriangleIcon' : 'CheckIcon'"
                        class="mr-50"
                      />
                      <span>{{ props.row.status === 'active' ? 'Blocked' : 'Active' }}</span>
                    </b-dropdown-item>

                  </b-dropdown>
                </span>
              </span>

              <!-- Column: Common -->
              <span v-else>
                {{ props.formattedRow[props.column.field] }}
              </span>
            </template>

            <!-- pagination -->
            <template
              slot="pagination-bottom"
              slot-scope="props"
            >
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-center mb-0 mt-1">
                  <span class="text-nowrap ">
                    Showing 1 to
                  </span>
                  <b-form-select
                    v-model="pageLength"
                    :options="['3','5','10', '25', '100', '200', '250']"
                    class="mx-1"
                    @input="(value)=>props.perPageChanged({currentPerPage:value})"
                    @change="selectedPage(pageLength)"
                  />
                  <span class="text-nowrap"> of {{ rows.meta && rows.meta.total }} entries </span>
                </div>
                <div>
                  <b-pagination
                    :value="1"
                    :total-rows="rows.meta && rows.meta.total"
                    :per-page="pageLength"
                    first-number
                    last-number
                    prev-class="prev-item"
                    next-class="next-item"
                    class="mt-1 mb-0"
                    @change="handleChangePage"
                  >
                    <template #prev-text>
                      <feather-icon
                        icon="ChevronLeftIcon"
                        size="18"
                      />
                    </template>
                    <template #next-text>
                      <feather-icon
                        icon="ChevronRightIcon"
                        size="18"
                      />
                    </template>
                  </b-pagination>
                </div>
              </div>
            </template>
          </vue-good-table>
        </div>
      </div>
    </b-col>
    <b-modal
      id="modal-add-seeker"
      ref="seeker-add-modal"
      title="Add Job Seeker"
      ok-title="submit"
      cancel-variant="outline-secondary"
      @ok.prevent="handleSubmit"
      @cancel="$refs['seeker-add-modal'].hide()"
    >
      <validation-observer ref="addSeeker">
        <b-form>
          <b-form-group
            label="First Name"
            label-for="first name"
          >
            <validation-provider
              #default="{ errors }"
              vid="first_name"
              name="first-name"
              rules="required"
            >
              <b-form-input
                v-model="form.first_name"
                :state="errors.length > 0 ? false:null"
                placeholder="Enter first name"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group
            label="Last Name"
            label-for="last-name"
          >
            <validation-provider
              #default="{ errors }"
              vid="last_name"
              name="last name"
              rules="required"
            >
              <b-form-input
                v-model="form.last_name"
                :state="errors.length > 0 ? false:null"
                placeholder="Enter last name"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group
            label="Phone number"
            label-for="phone-number"
          >
            <validation-provider
              #default="{ errors }"
              vid="phone_number"
              name="phone number"
              rules="required"
            >
              <b-form-input
                v-model="form.phone_number"
                :state="errors.length > 0 ? false:null"
                placeholder="Enter phone number"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group
            label="Email"
            label-for="email"
          >
            <validation-provider
              #default="{ errors }"
              vid="email"
              name="email address"
              rules="required"
            >
              <b-form-input
                v-model="form.email"
                type="email"
                :state="errors.length > 0 ? false:null"
                placeholder="Enter valid email address"
                autocomplete="off"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <!-- forgot password -->
          <b-form-group>
            <div class="d-flex justify-content-between">
              <label for="loginpassword">Password</label>
              <!--                  <b-link :to="{name:'auth-forgot-password-v2'}">-->
              <!--                    <small>Forgot Password?</small>-->
              <!--                  </b-link>-->
            </div>
            <validation-provider
              #default="{ errors }"
              name="Password"
              :rules="edit ? '' : 'required'"
              vid="password"
            >
              <b-input-group
                class="input-group-merge"
                :class="errors.length > 0 ? 'is-invalid':null"
              >
                <b-form-input
                  v-model="form.password"
                  :state="errors.length > 0 ? false:null"
                  class="form-control-merge"
                  :disabled="disabled"
                  :type="passwordFieldType"
                  name="login-password"
                  placeholder="············"
                  autocomplete="off"
                />
                <b-input-group-append is-text>
                  <feather-icon
                    class="cursor-pointer"
                    :icon="passwordToggleIcon"
                    @click="togglePasswordVisibility"
                  />
                </b-input-group-append>
              </b-input-group>
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group>
            <validation-provider
              #default="{ errors }"
              vid="confirm_password"
              name="confirm password"
              :rules="edit ? '' : 'required'"
            >
              <label for="confirm_password">Confirm Password</label>
              <b-input-group
                class="input-group-merge"
                :class="errors.length > 0 ? 'is-invalid':null"
              >
                <b-form-input
                  v-model="form.password_confirmation"
                  :state="errors.length > 0 ? false:null"
                  class="form-control-merge"
                  :disabled="disabled"
                  :type="passwordFieldType"
                  name="password_confirmation"
                  placeholder="············"
                  autocomplete="off"
                />
                <b-input-group-append is-text>
                  <feather-icon
                    class="cursor-pointer"
                    :icon="passwordToggleIcon"
                    @click="togglePasswordVisibility"
                  />
                </b-input-group-append>
              </b-input-group>
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <a
            v-if="edit"
            style="font-size: 10px !important; color: #0d6aad"
            @click.prevent="disabled ? disabled = false : disabled =true"
          >Change password</a>
        </b-form>
      </validation-observer>
      <template #modal-footer>
        <b-button
          size="md"
          variant="outline-secondary"
          @click.prevent="$bvModal.hide('modal-add-seeker')"
        >
          Cancel
        </b-button>
        <b-button
          size="md"
          variant="primary"
          @click.prevent="handleSubmit(edit)"
        >
          Submit
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
import {
  BCol, BButton, BFormSelect, BPagination, BDropdown, BDropdownItem, BAvatar, VBModal,
  BForm, BFormGroup, BFormInput, BInputGroupAppend, BInputGroup,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import Ripple from 'vue-ripple-directive'
import { required } from '@core/utils/validations/validations'
import { ValidationObserver, ValidationProvider } from 'vee-validate'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import ToastificationContent from '../../../@core/components/toastification/ToastificationContent'

export default {
  name: 'Index',
  components: {
    ValidationProvider,
    ValidationObserver,
    VueGoodTable,
    BCol,
    BButton,
    BFormSelect,
    BPagination,
    BDropdown,
    BDropdownItem,
    BAvatar,
    BForm,
    BFormGroup,
    BFormInput,
    BInputGroupAppend,
    BInputGroup,
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      columns: [
        {
          label: 'Contact',
          field: 'contact',
          thClass: 'text-center',
        },
        {
          label: 'Email',
          field: 'email',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Phone',
          field: 'phone',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Online Status',
          field: 'online_status',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Profile Status',
          field: 'status',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Registered',
          field: 'created_at',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Action',
          field: 'action',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
      ],
      pageLength: 10,
      searchTerm: '',
      page: 1,
      edit: false,
      disabled: false,
      required,
      form: {},
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    rows() {
      return this.$store.getters['admin/jobSeeker/SEEKERS']
    },
  },
  created() {
    this.getJobSeekers()
  },
  methods: {
    clearForm() {
      for (const key in this.form) {
        this.form[key] = ''
      }
    },
    openModal() {
      this.edit = false
      this.disabled = false
      this.clearForm()
      this.$bvModal.show('modal-add-seeker')
    },
    openEditModal(item) {
      this.clearForm()
      this.edit = true
      this.disabled = true
      // this.$store.dispatch('admin/jobSeeker/SEEKER_DETAIL', {
      //   id: item.id,
      // }).then(response => {
      this.form.id = item.id
      this.form.first_name = item.first_name
      this.form.last_name = item.last_name
      this.form.email = item.email
      this.form.phone_number = item.phone
      this.$bvModal.show('modal-add-seeker')
      // })
    },
    editSeeker() {
      this.$refs.addSeeker.validate().then(success => {
        if (success) {
          if (this.disabled) {
            delete this.form.password
            delete this.form.password_confirmation
          }
          this.$store.dispatch('admin/jobSeeker/UPDATE_SEEKER', this.form)
            .then(() => {
              this.$bvModal.hide('modal-add-seeker')
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: 'Success',
                  icon: 'BellIcon',
                  text: 'Seeker updated',
                  variant: 'success',
                },
              })
              this.edit = false
              this.$refs.addSeeker.reset()
              this.getJobSeekers()
            })
            .catch(error => {
              this.$refs.addSeeker.setErrors(error.response.data.errors)
            })
        }
      })
    },
    handleSubmit(edit) {
      if (edit) {
        this.editSeeker()
        return
      }
      this.$refs.addSeeker.validate().then(success => {
        if (success) {
          this.$store.dispatch('admin/jobSeeker/STORE_SEEKER', this.form)
            .then(response => {
              if (response.data.success) {
                this.$nextTick(() => {
                  this.$refs['seeker-add-modal'].hide()
                  this.clearForm()
                  this.$refs.addSeeker.reset()
                })
                this.getJobSeekers()
                this.$toast({
                  component: ToastificationContent,
                  props: {
                    title: 'Success',
                    icon: 'BellIcon',
                    text: 'Job seeker added',
                    variant: 'success',
                  },
                })
              }
            })
            .catch(error => {
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: 'Error',
                  icon: 'BellIcon',
                  text: 'Job seeker failed to add',
                  variant: 'danger',
                },
              })
              this.$refs.addSeeker.setErrors(error.response.data.errors)
            })
        }
      })
    },
    getJobSeekers(current_page = 1) {
      this.$store.dispatch('admin/jobSeeker/SEEKER_LIST', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
        },
      })
    },
    changeStatus(id, status) {
      this.$store.dispatch('admin/jobSeeker/CHANGE_STATUS', {
        id,
        status,
      }).then(response => {
        if (response.data.success) {
          this.getJobSeekers()
          this.$toast({
            component: ToastificationContent,
            props: {
              title: 'Success',
              icon: 'BellIcon',
              text: 'Status Changed!',
              variant: 'success',
            },
          })
        }
      })
    },
    handleChangePage(page) {
      this.getJobSeekers(page)
    },
    selectedPage(value) {
      this.getJobSeekers(this.page, value)
    },
    searchHandler() {
      this.getJobSeekers(this.page, this.pageLength, this.searchTerm)
    },

  },
}
</script>

<style scoped>

</style>
