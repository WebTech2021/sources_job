<template>
  <div>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Withdraw Requests</span>
          <button
            class="btn btn-bitbucket"
            @click.prevent="$bvModal.show('modal-terms&con')"
          >
            Request Withdraw
          </button>
        </div>
        <div class="card-body">
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
                  v-if="props.row.status === 'approved'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-success">Paid</span>
                </span>
                <span
                  v-if="props.row.status === 'declined'"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-danger">declined</span>-<span>{{ props.row.reason }}</span>
                </span>
              </span>

              <!-- Column: Action -->
              <span v-else-if="props.column.field === 'action'">
                <a
                  v-if="props.row.status==='pending'"
                  @click.prevent="deleteData(props.row.id)"
                >
                  <feather-icon
                    icon="TrashIcon"
                    class="mr-50"
                  />
                  <span>Delete</span>
                </a>
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
    <b-modal
      id="modal-terms&con"
      title="Withdraw Request"
      scrollable
      ok-only
      ok-title="Accept"
      @ok="handleSubmit"
    >
      <b-row class="justify-content-center">
        <b-col
          align-self="center"
        >
          <div class="card">
            <div class="card-body">
              <validation-observer ref="paymentMethod">
                <b-form>
                  <b-form-group
                    label="Select Account"
                    label-for="account"
                  >
                    <validation-provider
                      #default="{ errors }"
                      name="account"
                      rules="required"
                    >
                      <v-select
                        id="vue-select"
                        v-model="form.account"
                        :state="errors.length > 0 ? false:null"
                        :options="accounts"
                        label="account_number"
                        :reduce="acc=> acc.id"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                  <b-form-group
                    label="Withdrawal Amount"
                    label-for="amount"
                  >
                    <validation-provider
                      #default="{ errors }"
                      vid="amount"
                      name="amount"
                      rules="required"
                    >
                      <b-form-input
                        v-model="form.amount"
                        :state="errors.length > 0 ? false:null"
                        placeholder="Enter account name"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-form>
              </validation-observer>
            </div>
          </div>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>

<script>
import {
  BCol,
  BRow,
  BForm,
  BFormInput,
  BFormGroup,
  BFormSelect,
  BPagination,
  BDropdown,
  BDropdownItem,
} from 'bootstrap-vue'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import vSelect from 'vue-select'
import { required } from '@validations'
import { VueGoodTable } from 'vue-good-table'
import '@core/scss/vue/libs/vue-good-table.scss'

export default {
  name: 'WithdrawBalance',
  components: {
    BCol,
    BRow,
    BForm,
    BFormInput,
    BFormGroup,
    ValidationProvider,
    ValidationObserver,
    vSelect,
    VueGoodTable,
    BFormSelect,
    BPagination,
    BDropdown,
    BDropdownItem,
  },
  data() {
    return {
      form: {
        account: '',
        amount: '',
      },
      accounts: [],
      required,
      rows: [],
      link: {},
      meta: {},
      pageLength: 10,
      dir: false,
      columns: [
        {
          label: 'Number',
          field: 'number',
        },
        {
          label: 'Amount',
          field: 'amount',
        },
        {
          label: 'Requested At',
          field: 'requested_at',
        },
        {
          label: 'Approval',
          field: 'approval',
        },
        {
          label: 'Action',
          field: 'action',
        },

      ],
      // rows: [],
      searchTerm: '',
      page: 1,
    }
  },
  created() {
    this.$store.dispatch('user/account/GET_ACCOUNTS').then(() => {
      this.accounts = this.$store.getters['user/account/getAccounts'].data
    })
    this.getReqs()
  },
  methods: {
    handleSubmit() {
      this.$store.dispatch('user/account/storeWithdrawRequest', this.form)
        .then(() => {
          this.getReqs()
          this.$bvToast.toast('Request Submitted', {
            title: 'Information',
            variant: 'success',
            solid: true,
          })
        }).catch(error => {
          this.$bvToast.toast(error.response.data.message, {
            title: 'Information',
            variant: 'danger',
            solid: true,
          })
        })
    },
    getReqs() {
      this.$store.dispatch('user/account/withdrawRequest').then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['user/account/getWithDrawRequests']
          this.meta = this.$store.getters['user/account/getMetaData']
          this.link = this.$store.getters['user/account/getLinkData']
        })
      })
    },
    handleChangePage(page) {
      this.getReqs(page)
    },
    selectedPage(value) {
      this.getReqs(this.page, value)
    },
    searchHandler() {
      this.getReqs()
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
          this.$store.dispatch('user/account/deleteRequest', id)
            .then(() => {
              this.getReqs()
            }).catch(error => {

            })
          this.$swal({
            icon: 'success',
            title: 'Deleted!',
            text: 'Your request has been deleted.',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })
        }
      })
    },
  },
}
</script>

<style scoped>

</style>
<style lang="scss">
@import '~@core/scss/vue/libs/vue-select.scss';
</style>
