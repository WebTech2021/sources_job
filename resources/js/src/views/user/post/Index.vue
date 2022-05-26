<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Post List</span>
          <b-button
            class="btn btn-secondary"
            :to="{ name:'user.new-post' }"
          >
            New Post
          </b-button>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <button
              class="btn btn-outline-warning"
              @click="filterData(searchPublish='all')"
            >
              All
            </button>
            <button
              class="btn btn-outline-success ml-1"
              @click="filterData(searchPublish=1)"
            >
              Published
            </button>
            <button
              class="btn btn-outline-info ml-1"
              @click="filterData(searchPublish=0)"
            >
              Draft
            </button>
            <!--            <button-->
            <!--              class="btn btn-gradient-success ml-1"-->
            <!--              @click="filterData(searchStatus='active')"-->
            <!--            >-->
            <!--              Approved-->
            <!--            </button>-->
          </div>
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

              <span
                v-if="props.column.field === 'titleWithLink'"
                class="text-nowrap"
              >
                <span
                  v-if="props.row.published === 'Draft'"
                  class="text-nowrap"
                >
                  <span>{{ props.row.title }}</span>
                </span>
                <span
                  v-if="props.row.published === 'Published'"
                  class="text-nowrap"
                >
                  <a
                    :href="sourceBlog+props.row.slug"
                    target="_blank"
                  >{{ props.row.title }}</a>
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
                    <b-dropdown-item :to="{ name: 'user.get-post', params: { id: props.row.id, slug: props.row.slug } }">
                      <feather-icon
                        icon="Edit2Icon"
                        class="mr-50"
                      />
                      Edit
                    </b-dropdown-item>
                    <b-dropdown-item @click.prevent="deleteData(props.row.id)">
                      <feather-icon
                        icon="TrashIcon"
                        class="mr-50"
                      />
                      <span>Delete</span>
                    </b-dropdown-item>
                    <b-dropdown-item @click.prevent="previewPost(props.row.slug)">
                      <feather-icon
                        icon="EyeIcon"
                        class="mr-50"
                      />
                      <span>Preview</span>
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
  BCol, BRow, BFormInput, BDropdown, BPagination, BFormGroup, BFormSelect, BDropdownItem, BButton,
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
          label: 'Title',
          field: 'titleWithLink',
        },
        {
          label: 'Category',
          field: 'category',
        },
        {
          label: 'UV',
          field: 'unique_views',
        },
        {
          label: 'TV',
          field: 'total_views',
        },
        {
          label: 'Status',
          field: 'stat',
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
      searchStatus: '',
      searchPublish: '',
      sourceBlog: `${process.env.MIX_SOURCES_APP_URL}/blog/`,
    }
  },
  created() {
    this.getBlogs()
  },
  methods: {
    getBlogs(current_page = 1) {
      this.$store.dispatch('user/post/getPosts', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          title: this.searchTerm,
          status: this.searchStatus,
          published: this.searchPublish,
        },
      }).then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['user/post/getPosts']
          this.meta = this.$store.getters['user/post/getPostMetaData']
          this.link = this.$store.getters['user/post/getPostLinkData']
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
          this.$store.dispatch('user/post/deletePost', id)
            .then(() => {
              this.getBlogs()
            }).catch(error => {
              this.$refs.postForm.setErrors(error.response.data.errors)
            })
          this.$swal({
            icon: 'success',
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })
        }
      })
    },
    previewPost(slug) {
      window.open(`${process.env.MIX_SOURCES_APP_URL}/preview/${slug}`)
    },
    filterData() {
      this.getBlogs()
    },
  },

}
</script>

<style scoped>

</style>
