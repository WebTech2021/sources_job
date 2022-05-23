<template>
  <div>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Withdraw Requests</span>
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
              <!-- Column: Name -->
              <span
                v-if="props.column.field === 'withdraw'"
                class="text-nowrap"
              >
                <span
                  class="text-nowrap"
                >
                  <span class="badge badge-light-info">{{ props.row.account_type }}</span>-<span>{{ props.row.number }}</span>
                </span>
              </span>

              <!-- Column: Action -->
              <span v-else-if="props.column.field === 'action' && props.row.status === 'pending'">
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
                      v-if="props.row.status === 'pending'"
                      @click.prevent="markAsPaid(props.row.id)"
                    >
                      <feather-icon
                        icon="CheckIcon"
                        class="mr-50"
                      />
                      <span>Mark as Paid</span>
                    </b-dropdown-item>
                    <b-dropdown-item
                      v-if="props.row.status === 'pending'"
                      @click.prevent="openModal(props.row.id)"
                    >
                      <feather-icon
                        icon="XIcon"
                        class="mr-50"
                      />
                      <span>Decline Payment</span>
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
    <b-modal
      id="modal-terms&con"
      title="Payment Decline"
      scrollable
      ok-only
      ok-title="submit"
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
                    label="Decline Reason"
                    label-for="reason"
                  >
                    <validation-provider
                      #default="{ errors }"
                      vid="reason"
                      name="reason"
                      rules="required"
                    >
                      <b-form-input
                        v-model="form.reason"
                        :state="errors.length > 0 ? false:null"
                        placeholder="Enter reason here..."
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
  name: 'WithdrawRequests',
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
        id: '',
        reason: '',
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
          label: 'User',
          field: 'user',
        },
        {
          label: 'Withdrawal Number',
          field: 'withdraw',
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
    this.getReqs()
  },
  methods: {
    getReqs() {
      this.$store.dispatch('admin/withdrawal/Requests').then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['admin/withdrawal/getRequestData']
          this.meta = this.$store.getters['admin/withdrawal/getMetaData']
          this.link = this.$store.getters['admin/withdrawal/getLinkData']
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
    markAsPaid(id) {
      this.$swal({
        title: 'Are you sure?',
        text: 'Users wallet amount will be deducted',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Already Paid!',
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          this.$store.dispatch('admin/withdrawal/paidPayment', id)
            .then(() => {
              this.getReqs()
            }).catch(error => {

            })
        }
      })
    },
    openModal(id) {
      this.form.id = id
      this.$bvModal.show('modal-terms&con')
    },
    handleSubmit() {
      this.$store.dispatch('admin/withdrawal/declinePayment', this.form)
        .then(() => {
          this.getReqs()
          this.$bvToast.toast('Request Declined', {
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
  },
}
</script>

<style scoped>

</style>
<style lang="scss">
@import '~@core/scss/vue/libs/vue-select.scss';
</style>
