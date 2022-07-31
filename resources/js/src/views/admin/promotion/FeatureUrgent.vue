<template>
  <div>
    <b-row class="d-flex justify-content-center">
      <b-col cols="12">
        <div class="card">
          <div class="card-header">
            <span class="card-title" />
            <div>
              <b-button
                v-ripple.400="'rgba(40, 199, 111, 0.15)'"
                variant="outline-primary"
                @click="setType('all')"
              >
                All
              </b-button>
              <b-button
                v-ripple.400="'rgba(40, 199, 111, 0.15)'"
                variant="outline-success"
                @click="setType('feature')"
              >
                Feature
              </b-button>
              <b-button
                v-ripple.400="'rgba(234, 84, 85, 0.15)'"
                variant="outline-danger"
                @click="setType('urgent')"
              >
                Urgent
              </b-button>
            </div>
            <span class="card-title" />
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
                  v-if="props.column.field === 'title'"
                  class="text-nowrap"
                >
                  <a
                    :href="main_url+'/jobs/'+props.row.job.slug"
                  >{{ props.row.job.title }}</a>
                </span>
                <!-- Column: Type -->
                <span
                  v-if="props.column.label === 'Type'"
                  class="text-nowrap"
                >
                  <b-badge
                    :variant="props.row.type==='feature'?'secondary':'dark'"
                  >
                    {{ props.row.type }}
                  </b-badge>
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
                        @click.prevent="approveDecline(props.row.id, 'unapproved')"
                      >
                        <feather-icon
                          icon="EditIcon"
                          class="mr-50"
                        />
                        <span>UnApprove</span>
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
  BButton,
  BBadge,

} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import Ripple from 'vue-ripple-directive'

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
    BButton,
    BBadge,
  },
  directives: {
    Ripple,
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
          label: 'Type',
          field: 'ptype',
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
          label: 'Remaining days',
          field: 'remaining_days',
          thClass: 'text-center',
          tdClass: 'text-center',
          sortable: false,
        },
        {
          label: 'Expire on',
          field: 'expire_date',
          thClass: 'text-center',
          tdClass: 'text-center',
          sortable: false,
        },
        {
          label: 'Action',
          field: 'action',
          thClass: 'text-center',
          sortable: false,
        },
      ],
      pageLength: 10,
      searchTerm: '',
      page: 1,
      typeData: 'all',
    }
  },
  computed: {
    rows() {
      return this.$store.getters['admin/promotion/PROMOTIONS']
    },
    main_url() {
      return process.env.MIX_SOURCES_APP_URL
    },
  },
  created() {
    this.getPromotion()
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
        this.getPromotion()
      })
    },
    setType(type) {
      this.typeData = type
      this.$route.meta.breadcrumb[0].text = type.charAt(0).toUpperCase() + type.slice(1)
      this.$router.replace({ query: { t: this.typeData } })
      this.getPromotion()
    },
    getPromotion(current_page = 1) {
      this.$store.dispatch('admin/promotion/JOB_PROMOTION_LIST', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
          type: this.typeData,
        },
      })
    },
    handleChangePage(page) {
      this.getPromotion(page)
    },
    selectedPage(value) {
      this.getPromotion(this.page, value)
    },
    searchHandler() {
      this.getPromotion(this.page, this.pageLength, this.searchTerm)
    },
  },
}
</script>

<style scoped>

</style>
