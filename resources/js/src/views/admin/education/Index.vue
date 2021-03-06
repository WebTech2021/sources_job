<template>
  <div>
    <b-row class="d-flex justify-content-center">
      <b-col cols="6">
        <div class="card">
          <div class="card-header">
            <span class="card-title" />
            <b-button
              variant="primary"
              @click.prevent="openModal"
            >
              <span class="text-nowrap">Add Education</span>
            </b-button>
          </div>
          <div class="card-body">
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
                        @click.prevent="openEditModal(props.row, true)"
                      >
                        <feather-icon
                          icon="EditIcon"
                          class="mr-50"
                        />
                        <span>Edit</span>
                      </b-dropdown-item>
                      <b-dropdown-item
                        @click.prevent="deleteData(props.row.id)"
                      >
                        <feather-icon
                          icon="TrashIcon"
                          class="mr-50"
                        />
                        <span>Delete</span>
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
    </b-row>
    <b-modal
      id="modal-add-education"
      ref="education-add-modal"
      title="Add Education"
      ok-title="submit"
      cancel-variant="outline-secondary"
      @ok.prevent="handleSubmit"
      @cancel="$refs['education-add-modal'].hide()"
    >
      <validation-observer ref="addEducation">
        <b-form>
          <b-form-group
            label="Name"
            label-for="login-name"
          >
            <validation-provider
              #default="{ errors }"
              vid="name"
              name="name"
              rules="required"
            >
              <b-form-input
                v-model="form.name"
                :state="errors.length > 0 ? false:null"
                name="login-name"
                placeholder="Enter your name"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
        </b-form>
      </validation-observer>
      <template #modal-footer>
        <b-button
          size="md"
          variant="outline-secondary"
          @click.prevent="$bvModal.hide('modal-add-education')"
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
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BCol, BFormSelect, BPagination, BDropdown, BDropdownItem, BAvatar, BRow, BButton, BModal,
  BForm,
  BFormInput,
  BFormGroup, VBModal,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import Ripple from 'vue-ripple-directive'
import { required } from '@core/utils/validations/validations'
import ToastificationContent from '../../../@core/components/toastification/ToastificationContent'

export default {
  name: 'Index',
  components: {
    VueGoodTable,
    BCol,
    BFormSelect,
    BPagination,
    BDropdown,
    BDropdownItem,
    BAvatar,
    BRow,
    BButton,
    ValidationProvider,
    ValidationObserver,
    BModal,
    BForm,
    BFormInput,
    BFormGroup,
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  data() {
    return {
      required,
      form: {
        name: '',
      },
      columns: [
        {
          label: 'Name',
          field: 'name',
          thClass: 'text-center',
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
    }
  },
  computed: {
    rows() {
      return this.$store.getters['admin/education/EDUCATIONS']
    },
  },
  created() {
    this.getEducations()
  },
  methods: {
    clearForm() {
      for (const key in this.form) {
        this.form[key] = ''
      }
    },
    openModal() {
      this.edit = false
      this.clearForm()
      this.$bvModal.show('modal-add-education')
    },
    openEditModal(item) {
      this.clearForm()
      this.edit = true
      this.$store.dispatch('admin/education/EDUCATION_DETAIL', {
        id: item.id,
      }).then(response => {
        this.form.id = response.id
        this.form.name = response.name
        this.$bvModal.show('modal-add-education')
      })
    },
    editEducation() {
      this.$refs.addEducation.validate().then(success => {
        if (success) {
          this.$store.dispatch('admin/education/UPDATE_EDUCATION', this.form)
            .then(() => {
              this.$bvModal.hide('modal-add-education')
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: 'Success',
                  icon: 'BellIcon',
                  text: 'Education updated',
                  variant: 'success',
                },
              })
              this.edit = false
              this.$refs.addEducation.reset()
              this.getEducations()
            })
            .catch(error => {
              this.$refs.addEducation.setErrors(error.response.data.errors)
            })
        }
      })
    },
    handleSubmit(edit) {
      if (edit) {
        this.editEducation()
        return
      }
      this.$refs.addEducation.validate().then(success => {
        if (success) {
          this.$store.dispatch('admin/education/STORE_EDUCATION', this.form)
            .then(() => {
              this.$nextTick(() => {
                this.$refs['education-add-modal'].hide()
                for (const key in this.form) {
                  this.form[key] = ''
                }
                this.$refs.addEducation.reset()
              })
              this.getEducations()
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: 'Success',
                  icon: 'BellIcon',
                  text: 'Education added',
                  variant: 'success',
                },
              })
            })
            .catch(error => {
              this.$refs.addEducation.setErrors(error.response.data.errors)
            })
        }
      })
    },
    getEducations(current_page = 1) {
      this.$store.dispatch('admin/education/EDUCATION_LIST', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
        },
      })
    },
    handleChangePage(page) {
      this.getEducations(page)
    },
    selectedPage(value) {
      this.getEducations(this.page, value)
    },
    searchHandler() {
      this.getEducations(this.page, this.pageLength, this.searchTerm)
    },
    deleteData(slug) {
      this.$swal({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      })
        .then(result => {
          if (result.value) {
            this.$store.dispatch('admin/education/DELETE_EDUCATION', slug)
              .then(response => {
                if (response.data.success) {
                  this.getEducations()
                  this.$swal({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Education removed',
                    customClass: {
                      confirmButton: 'btn btn-success',
                    },
                  })
                }
              })
          }
        })
    },
  },
}
</script>

<style scoped>

</style>
