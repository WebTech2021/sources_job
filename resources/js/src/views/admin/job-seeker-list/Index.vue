<template>
  <div>
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
  </div>
</template>

<script>
import {
  BCol, BButton, BFormSelect, BPagination, BDropdown, BDropdownItem, BAvatar,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import ToastificationContent from '../../../@core/components/toastification/ToastificationContent'

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
    BAvatar,
  },
  data() {
    return {
      columns: [
        {
          label: 'Contact',
          field: 'contact',
          thClass: 'text-center',
          tdClass: 'text-center',
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
      return this.$store.getters['admin/jobSeeker/SEEKERS']
    },
  },
  created() {
    this.getJobSeekers()
  },
  methods: {
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
