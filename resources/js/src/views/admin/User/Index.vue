<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">User List</span>
          <!--          <b-button-->
          <!--            v-ripple.400="'rgba(255, 255, 255, 0.15)'"-->
          <!--            variant="primary"-->
          <!--            :to="{ name:'admin.users' }"-->
          <!--          >-->
          <!--            Add New-->
          <!--          </b-button>-->
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
            :rows="rows.data"
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
                v-if="props.column.field === 'Name'"
                class="text-nowrap"
              >
                <b-avatar
                  :src="props.row.avatar"
                  class="mx-1"
                />
                <span class="text-nowrap">{{ props.row.name }}</span>
              </span>

              <span
                v-if="props.column.field === 'email'"
                class="text-nowrap"
              >
                <span class="text-nowrap">{{ props.row.email }}</span>
                <span
                  v-if="props.row.email_verified"
                  class="text-nowrap"
                >
                  <feather-icon
                    icon="CheckIcon"
                    size="16"
                    class="text-body align-middle mr-25"
                    style="color: #0dd00d !important;"
                  />
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
                    <!--                    <b-dropdown-item :to="{name:'admin.product.edit',params:{id:props.row.id}}">-->
                    <!--                      <feather-icon-->
                    <!--                        icon="Edit2Icon"-->
                    <!--                        class="mr-50"-->
                    <!--                      />-->
                    <!--                      Edit-->
                    <!--                    </b-dropdown-item>-->
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
                  <span class="text-nowrap"> of {{ rows.meta.total }} entries </span>
                </div>
                <div>
                  <b-pagination
                    :value="1"
                    :total-rows="rows.meta.total"
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
  BRow, BCol, BPagination, BDropdownItem, BDropdown, BFormSelect, BFormInput, BFormGroup, BButton,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import '@core/scss/vue/libs/vue-good-table.scss'

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
          label: 'Name',
          field: 'name',
        },
        {
          label: 'Email',
          field: 'email',
        },
        {
          label: 'Phone Number',
          field: 'phone_number',
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
  computed: {
    rows() {
      return this.$store.getters['admin/user/getUsers']
    },
  },
  created() {
    this.getAllUsers()
  },
  methods: {
    getAllUsers(current_page = 1) {
      this.$store.dispatch('admin/user/allUsers', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          searchTerm: this.searchTerm,
        },
      })
    },
    handleChangePage(page) {
      this.getAllUsers(page)
    },
    selectedPage(value) {
      this.getAllUsers(this.page, value)
    },
    searchHandler() {
      this.getAllUsers(this.page, this.pageLength, this.searchTerm)
    },
    // deleteData(id) {
    //   this.$swal({
    //     title: 'Are you sure?',
    //     text: "You won't be able to revert this!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonText: 'Yes, delete it!',
    //     customClass: {
    //       confirmButton: 'btn btn-primary',
    //       cancelButton: 'btn btn-outline-danger ml-1',
    //     },
    //     buttonsStyling: false,
    //   }).then(result => {
    //     if (result.value) {
    //       this.$store.dispatch('admin/product/deleteProduct', id)
    //         .then(() => {
    //           this.getAllProducts()
    //         })
    //       this.$swal({
    //         icon: 'success',
    //         title: 'Deleted!',
    //         text: this.$store.getters['admin/product/getProductMessage'],
    //         customClass: {
    //           confirmButton: 'btn btn-success',
    //         },
    //       })
    //     }
    //   })
    // },

  },
}
</script>

<style scoped>

</style>
