<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Blog Category List</span>
          <button
            class="btn btn-primary"
            @click="openModal"
          >
            Add New Category
          </button>
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
      id="modal-category"
      ref="categoryModal"
      cancel-variant="outline-secondary"
      ok-title="Submit"
      cancel-title="Close"
      centered
      title="categoryModal Form"
      @ok.prevent="submitCategory"
    >
      <b-form>
        <b-form-group>
          <label for="reply">Enter Category Name</label>
          <b-form-input
            id="reply"
            v-model="cat_name"
            type="text"
            placeholder="Enter Category Name"
          />
        </b-form-group>
      </b-form>
    </b-modal>
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
  name: 'Category',
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
          label: 'Category',
          field: 'name',
        },
        {
          label: 'Action',
          field: 'action',
        },

      ],
      // rows: [],
      searchTerm: '',
      page: 1,
      cat_name: '',
    }
  },
  created() {
    this.getBlogs()
  },
  methods: {
    getBlogs(current_page = 1) {
      this.$store.dispatch('admin/category/getAllCats', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          title: this.searchTerm,
        },
      }).then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['admin/category/getCategories']
          this.meta = this.$store.getters['admin/category/getCatMetaData']
          this.link = this.$store.getters['admin/category/getCatLinkData']
        })
      })
    },
    handleChangePage(page) {
      this.getBlogs(page)
    },
    selectedPage(value) {
      this.getBlogs(this.page, value)
    },
    searchHandler() {
      this.getBlogs()
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
          this.$store.dispatch('admin/category/deleteCat', id)
            .then(() => {
              this.getBlogs()
            }).catch(error => {
              this.$refs.postForm.setErrors(error.response.data.errors)
            })
          this.$swal({
            icon: 'success',
            title: 'Deleted!',
            text: 'Category deleted.',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })
        }
      })
    },
    submitCategory() {
      this.$store.dispatch('admin/category/StoreCat', {
        name: this.cat_name,
      }).then(() => {
        this.cat_name = ''
        this.$refs.categoryModal.hide()
        this.getBlogs()
      })
    },
    openModal() {
      this.$refs.categoryModal.show()
    },
  },

}
</script>

<style scoped>

</style>
