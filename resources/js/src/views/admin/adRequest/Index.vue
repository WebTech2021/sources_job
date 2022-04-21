<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Requests List</span>
        </div>
        <div class="card-body">
          <!-- search input -->
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
            :rows="rows"
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
                v-if="props.column.field === 'approval'"
                class="text-nowrap"
              >
                <span
                  v-if="props.row.status === 'pending'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-warning">Pending</span>
                </span>
                <span
                  v-if="props.row.status === 'active'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-success">Approved</span>
                </span>
                <span
                  v-if="props.row.status === 'inactive'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-secondary">Inactive</span>
                </span>
                <span
                  v-if="props.row.status === 'pause'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-secondary">Paused</span>
                </span>
                <span
                  v-if="props.row.status === 'blocked'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-danger">Blocked</span>
                </span>
              </span>

              <span
                v-if="props.column.field === 'stat'"
                class="text-nowrap"
              >
                <span
                  v-if="props.row.published === 'Draft'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-info">Draft</span>
                </span>
                <span
                  v-if="props.row.published === 'Published'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-success">Published</span>
                </span>
              </span>
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
                      v-if="props.row.status === 'approved'"
                      @click.prevent="changeStatus(props.row, 'pending')"
                    >
                      <feather-icon
                        icon="XOctagonIcon"
                        class="mr-50"
                      />
                      <span>Make Pending</span>
                    </b-dropdown-item>
                    <b-dropdown-item
                      v-if="props.row.status === 'pending'"
                      @click.prevent="changeStatus(props.row, 'approved')"
                    >
                      <feather-icon
                        icon="CheckCircleIcon"
                        class="mr-50"
                      />
                      <span>Active It</span>
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
                  <span class="text-nowrap"> of {{ meta.total }} entries </span>
                </div>
                <div>
                  <b-pagination
                    :value="1"
                    :total-rows="meta.total"
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
</template>

<script>
import {
  BCol, BRow, BFormInput, BDropdown, BPagination, BFormGroup, BFormSelect, BDropdownItem, BButton, BForm,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import '@core/scss/vue/libs/vue-good-table.scss'
import Ripple from 'vue-ripple-directive'

export default {
  name: 'Index',
  components: {
    BCol,
    BRow,
    BFormInput,
    BDropdown,
    BPagination,
    BFormGroup,
    VueGoodTable,
    BFormSelect,
    BDropdownItem,
    BButton,
    BForm,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      rows: [],
      link: {},
      meta: {},
      pageLength: 10,
      dir: false,
      columns: [
        {
          label: 'User',
          field: 'user',
        },
        {
          label: 'Email',
          field: 'email',
        },
        {
          label: 'Phone NUmber',
          field: 'phone_number',
        },
        {
          label: 'Requested At',
          field: 'requested_at',
        },
        {
          label: 'Status',
          field: 'status',
        },
        {
          label: 'Action',
          field: 'action',
        },

      ],
      // rows: [],
      searchTerm: '',
      page: 1,
      searchStatus: '',
      searchPublish: '',
      blockReason: '',
      postTitle: '',
      changedStatus: '',
      postID: '',
    }
  },
  mounted() {
    this.getRequests()
  },
  methods: {
    getRequests(current_page = 1) {
      this.$store.dispatch('admin/adrequest/getRequests', {
        params: {
          page: current_page,
          per_page: this.pageLength,
        },
      }).then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['admin/adrequest/getAdRequest']
          this.meta = this.$store.getters['admin/adrequest/getRequestMetaData']
          this.link = this.$store.getters['admin/adrequest/getRequestLinkData']
        })
      })
    },
    handleChangePage(page) {
      this.getRequests(page)
    },
    selectedPage(value) {
      this.getRequests(this.page, value)
    },
    searchHandler() {
      this.getRequests()
    },
    filterData() {
      this.getRequests()
    },
    changeStatus(data, status) {
      this.$store.dispatch('admin/adrequest/changeStatus', { id: data.id, status })
        .then(() => {
          this.getRequests()
        })
    },
  },

}
</script>

<style scoped>

</style>
