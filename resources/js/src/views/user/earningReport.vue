<template>
  <b-row>
    <b-col cols="12">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Reports</span>
        </div>
        <div class="card-body">
          <!-- search input -->
          <!--          <div class="custom-search d-flex justify-content-end">-->
          <!--            <b-form-group>-->
          <!--              <div class="d-flex align-items-center">-->
          <!--                <label class="mr-1">Search</label>-->
          <!--                <b-form-input-->
          <!--                  v-model="searchTerm"-->
          <!--                  placeholder="Search"-->
          <!--                  type="text"-->
          <!--                  class="d-inline-block"-->
          <!--                  @keyup="searchHandler"-->
          <!--                />-->
          <!--              </div>-->
          <!--            </b-form-group>-->
          <!--          </div>-->
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
                    <b-dropdown-item :to="{ name: 'user.get-post', params: { id: props.row.id, slug: props.row.slug } }">
                      <feather-icon
                        icon="Edit2Icon"
                        class="mr-50"
                      />
                      Edit
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
  BCol, BRow, BDropdown, BPagination, BFormSelect, BDropdownItem,
} from 'bootstrap-vue'
import { VueGoodTable } from 'vue-good-table'
import '@core/scss/vue/libs/vue-good-table.scss'
import Ripple from 'vue-ripple-directive'

export default {
  name: 'EarningReport',
  components: {
    BCol,
    BRow,
    BDropdown,
    BPagination,
    VueGoodTable,
    BFormSelect,
    BDropdownItem,
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
          label: 'Amount',
          field: 'amount',
          thClass: 'text-center',
        },
      ],
      searchTerm: '',
      page: 1,
    }
  },
  created() {
    this.getBlogs()
  },
  methods: {
    getBlogs(current_page = 1) {
      this.$store.dispatch('user/post/getEarningReports', {
        params: {
          page: current_page,
          per_page: this.pageLength,
        },
      }).then(() => {
        this.$nextTick(() => {
          this.rows = this.$store.getters['user/post/getEarnedPost']
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
  },

}
</script>

<style scoped>

</style>
