<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Comment List</span>
          <!--          <b-button-->
          <!--            class="btn btn-secondary"-->
          <!--            :to="{ name:'user.new-post' }"-->
          <!--          >-->
          <!--            New Post-->
          <!--          </b-button>-->
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
          <!--            <button-->
          <!--              class="btn btn-gradient-success ml-1"-->
          <!--              @click="filterData(searchStatus='active')"-->
          <!--            >-->
          <!--              Approved-->
          <!--            </button>-->
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
                v-if="props.column.field === 'publish_status'"
                class="text-nowrap"
              >
                <span
                  v-if="props.row.published"
                  class="text-nowrap"
                >
                  <span class="badge badge-light-success">Published</span>
                </span>
                <span
                  v-else
                  class="text-nowrap"
                >
                  <span class="badge badge-light-secondary">Pending</span>
                </span>
              </span>

              <!-- Column: Action -->
              <span v-else-if="props.column.field === 'action'">
                <span>
                  <b-dropdown
                    v-if="props.row.reply === '--'"
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
                      @click="replyOfComment(props.row)"
                    >
                      <feather-icon
                        icon="MessageSquareIcon"
                        class="mr-50"
                      />
                      <span>Reply</span>
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
      title="Reply Form"
      @ok.prevent="submitReply"
    >
      <b-form>
        <b-form-group>
          <label for="comment">User Comment:</label>
          <b-form-input
            id="comment"
            v-model="userComment"
            type="text"
            placeholder="User Comment"
            disabled=""
          />
        </b-form-group>
        <b-form-group>
          <label for="reply">Reply</label>
          <b-form-input
            id="reply"
            v-model="myReply"
            type="text"
            placeholder="Enter your reply"
          />
        </b-form-group>
      </b-form>
    </b-modal>

  </b-row>
</template>

<script>
import {
  BCol, BRow, BFormInput, BDropdown, BPagination, BFormGroup, BFormSelect, BDropdownItem, BButton, BModal, BForm,
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
    BModal,
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
          label: 'Post',
          field: 'post',
        },
        {
          label: 'Comment',
          field: 'comment',
        },
        {
          label: 'Reply',
          field: 'reply',
        },
        {
          label: 'Commented',
          field: 'commented_at',
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
      userComment: '',
      myReply: '',
      commentId: '',
    }
  },
  created() {
    this.getComments()
  },
  methods: {
    getComments(current_page = 1) {
      this.$store.dispatch('user/comment/GET_COMMENTS', {
        params: {
          page: current_page,
          per_page: this.pageLength,
          title: this.searchTerm,
          status: this.searchStatus,
          published: this.searchPublish,
        },
      }).then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['user/comment/getAllComments']
          this.meta = this.$store.getters['user/comment/getCommentMeta']
          this.link = this.$store.getters['user/comment/getCommentLink']
        })
      })
    },
    handleChangePage(page) {
      this.getComments(page)
    },
    selectedPage(value) {
      this.getComments(this.page, value)
    },
    searchHandler() {
      this.getComments()
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
          this.$store.dispatch('user/comment/DeleteComment', id)
            .then(() => {
              this.getComments()
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
    replyOfComment(comment) {
      this.commentId = comment.id
      this.userComment = comment.comment
      this.$refs.replyModal.show()
    },
    submitReply() {
      this.$store.dispatch('user/comment/replyOnComment', {
        comment_id: this.commentId,
        reply: this.myReply,
      })
        .then(() => {
          this.myReply = ''
          this.$refs.replyModal.hide()
          this.getComments()
        })
    },
  },
}
</script>

<style scoped>

</style>
