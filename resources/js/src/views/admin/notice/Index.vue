<template>
  <div>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">All Notices</span>
          <span>

            <b-button
              variant="primary"
              @click="$router.push({name:'admin.notice.create'})"
            >
              <span class="text-nowrap">Send Notice</span>
            </b-button>
            <b-button
              variant="danger"
              @click.prevent="deleteNotice"
            >
              <span class="text-nowrap">Clear</span>
            </b-button>

          </span>
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
  BCol, BButton, BFormSelect, BPagination, BDropdown, BDropdownItem,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'

export default {
  name: 'Index',
  components: {
    VueGoodTable,
    BCol,
    BButton,
    BFormSelect,
    BPagination,
    BDropdown,
    BDropdownItem,
  },
  data() {
    return {
      columns: [
        {
          label: 'Subject',
          field: 'subject',
          thClass: 'text-center',
        },
        {
          label: 'Details',
          field: 'data',
          thClass: 'text-center',
        },
        {
          label: 'Sent Count',
          field: 'sent_count',
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          label: 'Created',
          field: 'created_at',
          thClass: 'text-center',
        },
      ],
      pageLength: 10,
      searchTerm: '',
      page: 1,
    }
  },
  computed: {
    rows() {
      return this.$store.getters['admin/notice/GET_NOTICE']
    },
  },
  created() {
    this.getNotices()
  },
  methods: {
    getNotices(current_page = 1) {
      this.$store.dispatch('admin/notice/NOTICES', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
        },
      })
    },
    handleChangePage(page) {
      this.getNotices(page)
    },
    selectedPage(value) {
      this.getNotices(this.page, value)
    },
    searchHandler() {
      this.getNotices(this.page, this.pageLength, this.searchTerm)
    },
    deleteNotice(id) {
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
            this.$store.dispatch('admin/notice/DELETE_NOTICES', id)
              .then(response => {
                if (response.data.success) {
                  this.getNotices()
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
  },
}
</script>

<style scoped>

</style>
