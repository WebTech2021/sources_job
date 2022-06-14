<template>
  <div>
    <b-col cols="12">
      <div class="card">
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
                v-if="props.column.field === 'title'"
                class="text-nowrap"
              >
                <!-- link avatar -->
                <a
                  :href="main_url+'/jobs/'+props.row.slug"
                >{{ props.row.title }}</a>

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
                      v-if="props.row.ads_count<1"
                      @click.prevent="deleteData(props.row.id)"
                    >
                      <feather-icon
                        icon="TrashIcon"
                        class="mr-50"
                      />
                      <span>Delete</span>
                    </b-dropdown-item>
                    <b-dropdown-item
                      v-if="props.row.status==='pending'"
                      @click.prevent="changeStatus(props.row.slug)"
                    >
                      <feather-icon
                        icon="EditIcon"
                        class="mr-50"
                      />
                      <span>Publish</span>
                    </b-dropdown-item>
                    <b-dropdown-item
                      v-if="props.row.status!=='expired' && props.row.status !=='declined'"
                      @click.prevent="changeStatus(props.row.slug, 'declined')"
                    >
                      <feather-icon
                        icon="XIcon"
                        class="mr-50"
                      />
                      <span>Decline</span>
                    </b-dropdown-item>
                    <b-dropdown-item
                      @click.prevent="deleteJob(props.row.slug)"
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
  </div>
</template>

<script>
import {
  BCol, BFormSelect, BPagination, BDropdown, BDropdownItem, BAvatar, BFormInput, BFormGroup,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import ToastificationContent from '../../../@core/components/toastification/ToastificationContent'

export default {
  name: 'Index',
  components: {
    VueGoodTable,
    BCol,
    BFormGroup,
    BFormSelect,
    BPagination,
    BDropdown,
    BDropdownItem,
    BAvatar,
    BFormInput,
  },
  data() {
    return {
      columns: [
        {
          label: 'Title',
          field: 'title',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Organization name',
          field: 'organization_name',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Vacancy',
          field: 'vacancy',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Deadline',
          field: 'end_date',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Status',
          field: 'status',
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
    }
  },
  computed: {
    rows() {
      return this.$store.getters['admin/jobs/JOBS']
    },
    main_url() {
      return process.env.MIX_SOURCES_APP_URL
    },
  },
  created() {
    this.getJobs()
  },
  methods: {
    getJobs(current_page = 1) {
      this.$store.dispatch('admin/jobs/JOB_LIST', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
        },
      })
    },
    changeStatus(slug, status = 'publish') {
      this.$store.dispatch('admin/jobs/CHANGE_STATUS', {
        slug,
        status,
      }).then(response => {
        if (response.data.success) {
          this.getJobs()
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
    deleteJob(slug) {
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
            this.$store.dispatch('admin/jobs/DESTROY_JOB', {
              slug,
            }).then(response => {
              if (response.data.success) {
                this.getJobs()
              }
              this.$swal({
                icon: response.data.success ? 'success' : 'error',
                title: response.data.subject,
                text: response.data.message,
                customClass: {
                  confirmButton: response.data.success ? 'btn btn-success' : 'btn btn-danger',
                },
              })
            })
          }
        })
    },
    handleChangePage(page) {
      this.getJobs(page)
    },
    selectedPage(value) {
      this.getJobs(this.page, value)
    },
    searchHandler() {
      this.getJobs(this.page, this.pageLength, this.searchTerm)
    },
    deleteData(id) {
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
            this.$store.dispatch('user/AgencyCompanies/DELETE_COMPANY', id)
              .then(response => {
                if (response.data.success) {
                  this.getJobs()
                  this.$swal({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Your company removed',
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
