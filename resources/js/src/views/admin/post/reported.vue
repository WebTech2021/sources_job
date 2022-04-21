<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Post List</span>
        </div>
        <div class="card-body">
          <!--          <div class="d-flex justify-content-center">-->
          <!--            <button-->
          <!--              class="btn btn-outline-success"-->
          <!--              @click="filterData(searchPublish=1)"-->
          <!--            >-->
          <!--              Published-->
          <!--            </button>-->
          <!--            <button-->
          <!--              class="btn btn-outline-info ml-1"-->
          <!--              @click="filterData(searchPublish=0)"-->
          <!--            >-->
          <!--              Draft-->
          <!--            </button>-->
          <!--            <button-->
          <!--              class="btn btn-outline-warning ml-1"-->
          <!--              @click="filterData(searchStatus='pending')"-->
          <!--            >-->
          <!--              Pending-->
          <!--            </button>-->
          <!--            &lt;!&ndash;            <button&ndash;&gt;-->
          <!--            &lt;!&ndash;              class="btn btn-gradient-success ml-1"&ndash;&gt;-->
          <!--            &lt;!&ndash;              @click="filterData(searchStatus='active')"&ndash;&gt;-->
          <!--            &lt;!&ndash;            >&ndash;&gt;-->
          <!--            &lt;!&ndash;              Approved&ndash;&gt;-->
          <!--            &lt;!&ndash;            </button>&ndash;&gt;-->
          <!--          </div>-->
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
                      v-if="props.row.status === 'active'"
                      @click.prevent="openModal(props.row, 'blocked')"
                    >
                      <feather-icon
                        icon="TrashIcon"
                        class="mr-50"
                      />
                      <span>Block It</span>
                    </b-dropdown-item>
                    <b-dropdown-item
                      v-if="props.row.status === 'blocked' || props.row.status === 'pending'"
                      @click.prevent="changeStatus(props.row, 'active')"
                    >
                      <feather-icon
                        icon="TrashIcon"
                        class="mr-50"
                      />
                      <span>Active It</span>
                    </b-dropdown-item>
                    <b-dropdown-item @click.prevent="previewPost(props.row.slug)">
                      <feather-icon
                        icon="EyeIcon"
                        class="mr-50"
                      />
                      <span>View Post</span>
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
      id="modal-reply"
      ref="replyModal"
      cancel-variant="outline-secondary"
      ok-title="Submit"
      cancel-title="Close"
      centered
      title="Blocking Form"
      @ok.prevent="submitReply"
    >
      <b-form>
        <b-form-group>
          <label for="comment">Post Title:</label>
          <b-form-input
            id="comment"
            v-model="postTitle"
            type="text"
            placeholder="User Comment"
            disabled=""
          />
        </b-form-group>
        <b-form-group>
          <label for="reply">Reason</label>
          <b-form-input
            id="reply"
            v-model="blockReason"
            type="text"
            placeholder="Enter Block Reason"
          />
        </b-form-group>
      </b-form>
    </b-modal>
  </b-row>
</template>

<script>
import {
  BCol, BRow, BFormInput, BDropdown, BPagination, BFormGroup, BFormSelect, BDropdownItem, BForm,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import '@core/scss/vue/libs/vue-good-table.scss'
import Ripple from 'vue-ripple-directive'

export default {
  name: 'Reported',
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
          label: 'Title',
          field: 'title',
          thClass: 'text-center',
        },
        {
          label: 'Hate Speech',
          field: 'hate_speech',
          thClass: 'text-center',
        },
        {
          label: 'Aggressive Content',
          field: 'aggressive_content',
          thClass: 'text-center',
        },
        {
          label: 'Stolen Content',
          field: 'stolen_content',
          thClass: 'text-center',
        },
        {
          label: 'Spamming Content',
          field: 'spamming_content',
          thClass: 'text-center',
        },
        {
          label: 'Nudity',
          field: 'nudity',
          thClass: 'text-center',
        },
        {
          label: 'Harassment',
          field: 'harassment',
          thClass: 'text-center',
        },
        {
          label: 'Other',
          field: 'other',
          thClass: 'text-center',
        },
        {
          label: 'Current Status',
          field: 'approval',
          thClass: 'text-center',
        },
        {
          label: 'Action',
          field: 'action',
          thClass: 'text-center',
        },

      ],
      // rows: [],
      searchTerm: '',
      page: 1,
      searchStatus: '',
      searchPublish: '',
      blockReason: '',
      postTitle: '',
      changedStatus: '',
      postID: '',
    }
  },
  created() {
    this.getBlogs()
  },
  methods: {
    getBlogs(current_page = 1) {
      this.$store.dispatch('admin/post/reportedPosts', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          title: this.searchTerm,
          status: this.searchStatus,
          published: this.searchPublish,
        },
      }).then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['admin/post/getReportedPosts']
          this.meta = this.$store.getters['admin/post/getMetaData']
          this.link = this.$store.getters['admin/post/getLinkData']
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
    changeStatus(data, status) {
      if (status === 'active') {
        this.postID = data.id
        this.changedStatus = status
      }
      // this.changedStatus = status
      this.$store.dispatch('admin/post/changeStatus', { id: this.postID, status: this.changedStatus, reason: this.blockReason })
        .then(() => {
          this.getBlogs()
          this.$bvModal.hide('modal-reply')
        })
    },
    submitReply() {
      this.changeStatus()
      this.blockReason = ''
      this.postID = ''
    },
    openModal(data, status) {
      this.postID = data.id
      this.changedStatus = status
      this.postTitle = data.title
      this.$refs.replyModal.show()
    },
  },

}
</script>

<style scoped>

</style>
