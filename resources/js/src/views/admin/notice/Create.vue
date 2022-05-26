<template>
  <div>
    <b-row>
      <b-col cols="12">
        <div class="card">
          <div class="card-body">
            <validation-observer ref="addNotice">
              <b-form>
                <b-row>
                  <b-col cols="4">
                    <b-form-group
                      label="Select Type"
                      label-for="role"
                    >
                      <validation-provider
                        #default="{ errors }"
                        name="role"
                        rules="required"
                      >
                        <b-input-group class="=input-group-merge">
                          <b-form-select
                            v-model="form.type"
                            :options="options"
                            size="md"
                          />
                        </b-input-group>
                        <small class="text-danger">{{ errors[0] }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>
                  <b-col
                    v-if="form.type === 'select'"
                    cols="4"
                  >
                    <b-form-group
                      label="Search for seeker"
                      label-for="seeker"
                    >
                      <validation-provider
                        #default="{ errors }"
                        name="searchSeeker"
                        rules="required"
                      >
                        <b-form-input
                          v-model="searchSeeker"
                          placeholder="Search seeker..."
                          :state="errors.length > 0 ? false:null"
                          type="text"
                          class="d-inline-block"
                          @keyup="searchHandler"
                        />
                        <small class="text-danger">{{ errors[0] }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>
                </b-row>

                <!-- table -->
                <vue-good-table
                  v-if="users.length>0 && form.type === 'select'"
                  ref="seekerTable"
                  :columns="columns"
                  :rows="users.length ? users :0"
                  mode="remote"
                  :line-numbers="true"
                  style-class="vgt-table striped bordered condensed"
                >
                  <template
                    slot="table-row"
                    slot-scope="props"
                  >
                    <!-- Column: Name -->
                    <span v-if="props.column.field === 'name'">
                      <span>{{ props.row.first_name }} {{ props.row.last_name }}</span>
                    </span>
                    <!-- Column: Action -->
                    <span v-if="props.column.field === 'action'">
                      <b-button
                        variant="primary"
                        @click.prevent="selectSeeker(props.row)"
                      >
                        <span class="text-nowrap">Select</span>
                      </b-button>
                    </span>

                    <!-- Column: Common -->
                    <span v-else>
                      {{ props.formattedRow[props.column.field] }}
                    </span>
                  </template>
                </vue-good-table>
                <br>
                <span v-if="selectedUsers.length>0">Selected Job Seekers:</span>
                <!-- selected user table -->
                <vue-good-table
                  v-if="selectedUsers.length>0"
                  ref="selectedTable"
                  :columns="columns"
                  :rows="selectedUsers.length ? selectedUsers :0"
                  mode="remote"
                  :line-numbers="true"
                  style-class="vgt-table striped bordered condensed"
                >
                  <template
                    slot="table-row"
                    slot-scope="props"
                  >
                    <!-- Column: Name -->
                    <span v-if="props.column.field === 'name'">
                      <span>{{ props.row.first_name }} {{ props.row.last_name }}</span>
                    </span>
                    <!-- Column: Action -->
                    <span v-if="props.column.field === 'action'">
                      <b-button
                        variant="danger"
                        @click.prevent="removeCompany(props.row)"
                      >
                        <span class="text-nowrap">Remove</span>
                      </b-button>
                    </span>
                    <!-- Column: Common -->
                    <span v-else>
                      {{ props.formattedRow[props.column.field] }}
                    </span>
                  </template>
                </vue-good-table>
                <b-row>
                  <b-col
                    cols="12"
                  >
                    <b-form-group
                      label="Subject"
                      label-for="company"
                    >
                      <validation-provider
                        #default="{ errors }"
                        name="subject"
                        rules="required"
                      >
                        <b-form-input
                          v-model="form.subject"
                          placeholder="write subject..."
                          :state="errors.length > 0 ? false:null"
                          type="text"
                          class="d-inline-block"
                        />
                        <small class="text-danger">{{ errors[0] }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>
                  <b-col
                    cols="12"
                  >
                    <b-form-group
                      label="Notice Detail"
                      label-for="detail"
                    >
                      <validation-provider
                        #default="{ errors }"
                        name="notice detail"
                        vid="data"
                        rules="required"
                      >
                        <b-form-textarea
                          id="textarea-state"
                          v-model="form.data"
                          :state="errors.length > 0 ? false:null"
                          placeholder="Enter more than 10 characters"
                          rows="3"
                        />
                        <small class="text-danger">{{ errors[0] }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-form>
            </validation-observer>
          </div>
          <b-button
            variant="primary"
            @click.prevent="handleSend()"
          >
            <span class="text-nowrap">Send Notice</span>
          </b-button>
        </div>
      </b-col>
    </b-row>
  </div>

</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BInputGroup,
  BFormSelect,
  BForm,
  BFormInput,
  BFormGroup,
  BCol,
  BRow,
  BButton,
  BFormTextarea,

} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import { required } from '@core/utils/validations/validations'
import ToastificationContent from '../../../@core/components/toastification/ToastificationContent'

export default {
  name: 'Create',
  components: {
    VueGoodTable,
    ValidationProvider,
    ValidationObserver,
    BInputGroup,
    BFormSelect,
    BForm,
    BFormInput,
    BFormGroup,
    BCol,
    BRow,
    BButton,
    BFormTextarea,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      required,
      users: {},

      searchSeeker: '',
      selectedUsers: [],
      form: {
        users: [],
        subject: '',
        data: '',
        type: 'all',
      },
      options: [
        { value: 'all', text: 'All job seeker ' },
        { value: 'select', text: 'Select Job Seeker' },
      ],
      columns: [
        {
          label: 'Name',
          field: 'name',
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
          label: 'Online',
          field: 'online_status',
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
    }
  },
  methods: {
    handleSend() {
      this.$refs.addNotice.validate().then(success => {
        if (success) {
          if (this.form.type === 'all') {
            delete this.form.users
          }
          this.$store.dispatch('admin/notice/ADD_NOTICE', this.form).then(response => {
            if (response.data.success) {
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: 'Success',
                  icon: 'BellIcon',
                  text: 'Notice Sent!',
                  variant: 'success',
                },
              })
              this.$router.push({ name: 'admin.notice.list' })
            }
          }).catch(error => {
            this.$refs.addNotice.setErrors(error.response.data.errors)
          })
        }
      })
    },
    selectSeeker(data) {
      const index = this.selectedUsers.findIndex(object => object.email === data.email)
      if (index === -1) {
        this.selectedUsers.push(data)
        this.form.users.push(data.id)
        console.log(this.form.users)
      } else {
        this.$toast({
          component: ToastificationContent,
          props: {
            title: 'Warning',
            icon: 'BellIcon',
            text: 'Already selected!',
            variant: 'warning',
          },
        })
      }
    },
    removeCompany(data) {
      const index = this.selectedUsers.findIndex(object => object.email === data.email)
      this.selectedUsers.splice(index, 1)

      this.form.users.splice(this.form.users.indexOf(data.id), 1)
    },

    searchHandler() {
      this.getSeekers()
    },
    getSeekers() {
      this.$store.dispatch('admin/jobSeeker/SEEKER_LIST', {
        params: {
          searchTerm: this.searchSeeker,
        },
      }).then(response => {
        this.users = response.data.seekers.data
        console.log(response.data.seekers)
      })
    },
  },

}
</script>

<style scoped>

</style>
