<template>
  <div>
    <b-row class="d-flex justify-content-center">
      <b-col cols="12">
        <div class="card">
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
                  v-if="props.column.field === 'title'"
                  class="text-nowrap"
                >
                  <a
                    :href="main_url+'/jobs/'+props.row.job.slug"
                  >{{ props.row.job.title }}</a>
                </span>
                <!-- Column: Name -->
                <span
                  v-if="props.column.field === 'cost'"
                  class="text-nowrap"
                >
                  <!-- link avatar -->
                  <span>{{ props.row.cost }} BDT</span>

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
                        @click.prevent="approveDecline(props.row.id, 'approved')"
                      >
                        <feather-icon
                          icon="EditIcon"
                          class="mr-50"
                        />
                        <span>Approve</span>
                      </b-dropdown-item>
                      <b-dropdown-item
                        @click.prevent="approveDecline(props.row.id, 'unapproved')"
                      >
                        <feather-icon
                          icon="TrashIcon"
                          class="mr-50"
                        />
                        <span>Decline</span>
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
  </div>
</template>

<script>
import {
  BCol,
  BFormSelect,
  BPagination,
  BDropdown,
  BDropdownItem,
  BRow,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'

export default {
  name: 'FeatureUrgent',
  components: {
    VueGoodTable,
    BCol,
    BFormSelect,
    BPagination,
    BDropdown,
    BDropdownItem,
    BRow,
  },
  data() {
    return {
      columns: [
        {
          label: 'Title',
          field: 'title',
          thClass: 'text-center',
          tdClass: 'text-center',
          sortable: false,
        },
        {
          label: 'Organization',
          field: 'job.organization_name',
          thClass: 'text-center',
          tdClass: 'text-center',
          sortable: false,
        },
        {
          label: 'Days',
          field: 'days',
          thClass: 'text-center',
          tdClass: 'text-center',
          sortable: true,
        },
        {
          label: 'Cost',
          field: 'cost',
          thClass: 'text-center',
          tdClass: 'text-center',
          sortable: false,
        },
        {
          label: 'Action',
          field: 'action',
          thClass: 'text-center',
          tdClass: 'text-center',
          sortable: false,
        },
      ],
      pageLength: 10,
      searchTerm: '',
      page: 1,
    }
  },
  computed: {
    rows() {
      return this.$store.getters['admin/request/REQUESTS']
    },
    main_url() {
      return process.env.MIX_SOURCES_APP_URL
    },
  },
  watch: {
    $route() {
      this.getRequest()
    },
  },
  created() {
    this.getRequest()
  },
  methods: {
    approveDecline(id, status) {
      this.$store.dispatch('admin/request/CHANGE_STATUS', {
        id,
        status,
      }).then(response => {
        this.$swal({
          icon: response.data.success ? 'success' : 'error',
          title: response.data.subject,
          text: response.data.message,
          customClass: {
            confirmButton: response.data.success ? 'btn btn-success' : 'btn btn-danger',
          },
        })
        this.getRequest()
      })
    },
    getRequest(current_page = 1) {
      this.$store.dispatch('admin/request/REQUEST_LIST', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
          type: this.$route.name === 'admin.feature.request' ? 'feature' : 'urgent',
        },
      })
    },
    handleChangePage(page) {
      this.getRequest(page)
    },
    selectedPage(value) {
      this.getRequest(this.page, value)
    },
    searchHandler() {
      this.getRequest(this.page, this.pageLength, this.searchTerm)
    },
  },
}
</script>

<style scoped>

</style>
