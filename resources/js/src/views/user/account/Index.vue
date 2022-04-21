<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">My Account List</span>
          <b-button
            v-ripple.400="'rgba(255, 255, 255, 0.15)'"
            variant="primary"
            :to="{ name:'user.account.create' }"
          >
            Add New Account
          </b-button>
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
              <!-- Column: Action -->
              <span v-if="props.column.field === 'action'">
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
                      v-if="props.row.status === 'Active'"
                      @click="changeStatus(props.row.id, false)"
                    >
                      <feather-icon
                        icon="XIcon"
                        class="mr-50"
                      />
                      Inactive
                    </b-dropdown-item>
                    <b-dropdown-item
                      v-else
                      @click="changeStatus(props.row.id,true)"
                    >
                      <feather-icon
                        icon="CheckIcon"
                        class="mr-50"
                      />
                      Active
                    </b-dropdown-item>
                    <b-dropdown-item @click.prevent="deleteData(props.row.id)">
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
                  <span class="text-nowrap"> of {{ rows.meta ? rows.meta.total : 0 }} entries </span>
                </div>
                <div>
                  <b-pagination
                    :value="1"
                    :total-rows="rows.meta ? rows.meta.total : 0"
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
import { VueGoodTable } from 'vue-good-table'
import {
  BButton,
  BCol,
  BDropdown,
  BDropdownItem,
  BFormGroup,
  BFormInput,
  BFormSelect,
  BPagination,
  BRow,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import Toaster from '@core/components/toastification/ToastificationContent'

export default {
  name: 'Index',
  components: {
    VueGoodTable,
    BRow,
    BDropdownItem,
    BFormSelect,
    BFormGroup,
    BFormInput,
    BCol,
    BPagination,
    BDropdown,
    BButton,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      pageLength: 10,
      dir: false,
      columns: [
        {
          label: 'Type',
          field: 'type',
        },
        {
          label: 'Account Number',
          field: 'account_number',
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
      items: [],
    }
  },
  computed: {
    rows() {
      return this.$store.getters['user/account/getAccounts']
    },
  },
  created() {
    this.getAllAccounts()
  },
  methods: {
    getAllAccounts(current_page = 1) {
      this.$store.dispatch('user/account/GET_ACCOUNTS', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
        },
      })
    },
    handleChangePage(page) {
      this.getAllAccounts(page)
    },
    selectedPage(value) {
      this.getAllAccounts(this.page, value)
    },
    searchHandler() {
      this.getAllAccounts(this.page, this.pageLength, this.searchTerm)
    },
    changeStatus(id, state) {
      this.$store.dispatch('user/account/UPDATE_STATUS', { id, status: state })
        .then(() => {
          this.getAllAccounts()
        })
    },
    deleteData(id) {
      this.$swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          this.$store.dispatch('user/account/DELETE_ACCOUNT', id)
            .then(() => {
              this.getAllAccounts()
            })
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/vue-good-table.scss';
</style>
