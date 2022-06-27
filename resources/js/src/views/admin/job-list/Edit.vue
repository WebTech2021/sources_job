<template>
  <b-form class="mt-1">
    <validation-observer ref="jobUpdate">
      <div class="card">
        <div class="card-body">
          <!-- Header: Personal Info -->
          <div class="d-flex">
            <feather-icon
              icon="UserIcon"
              size="19"
            />
            <h4 class="mb-0 ml-50">
              Information
            </h4>
          </div>
          <!-- Form: Personal Info Form -->

          <b-row>
            <!-- Field: title -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Title"
                label-for="title"
              >
                <validation-provider
                  #default="{ errors }"
                  name="title"
                  vid="job_title"
                  rules="required"
                >
                  <b-form-input
                    id="title"
                    v-model="form.job_title"
                    :state="errors.length > 0 ? false:null"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>
            <!-- Field: Categories -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Category"
                label-for="category"
              >
                <validation-provider
                  #default="{ errors }"
                  name="category"
                  vid="job_categories"
                  rules="required"
                >
                  <v-select
                    v-model="form.job_categories"
                    :options="categories"
                    label="name"
                    :reduce="categories => categories.id"
                    :state="errors.length > 0 ? false:null"
                    placeholder="Enter Category Name"
                    @search="jobCategories"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>

                </validation-provider></b-form-group>
            </b-col>
            <!-- Field: end-date -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Deadline"
                label-for="deadline"
              >
                <flat-pickr
                  v-model="form.to_date"
                  class="form-control"
                  :config="{ dateFormat: 'Y-m-d'}"
                  placeholder="YYYY-MM-DD"
                />
              </b-form-group>
            </b-col>
            <!-- Field: vacancy -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Vacancy"
                label-for="vacancy"
              >
                <b-form-input
                  id="vacancy"
                  v-model="form.vacancy"
                />
              </b-form-group>
            </b-col>
            <!-- Field: employment status -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Employment Status"
                label-for="emp-status"
              >
                <v-select
                  v-model="form.employment_status"
                  :options="employmentStatus"
                  :clearable="false"
                  label="name"
                  :reduce="option => option.value"
                />
              </b-form-group>
            </b-col>
            <!-- Field: education level -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Education level"
                label-for="edu-level"
              >
                <v-select
                  v-model="form.educational_requirements"
                  :options="eduLevels"
                  :clearable="false"
                  label="name"
                  :reduce="x => x.name"
                />
              </b-form-group>
            </b-col>
            <!-- Field: salary type -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Salary type"
                label-for="salary-type"
                label-class="mb-1"
              >
                <b-form-radio-group
                  v-model="form.salary_type"
                  :options="salaryTypes"
                />
              </b-form-group>
            </b-col>
            <!-- Field: salary fixed -->
            <b-col
              v-if="form.salary_type==='fixed'"
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Salary"
                label-for="salary"
              >
                <b-form-input
                  v-model="form.salary"
                />
              </b-form-group>
            </b-col>
            <!-- Field: salary -->
            <b-col
              v-else-if="form.salary_type==='range'"
              cols="12"
              md="6"
              lg="4"
            >
              <b-row>
                <b-col md="6">
                  <b-form-group
                    label="Salary range"
                    label-for="salary-range"
                  >
                    <b-input-group>
                      <b-form-input
                        v-model="form.min_salary"
                      />
                      <b-form-input
                        v-model="form.max_salary"
                        class="ml-2"
                      />
                    </b-input-group>
                  </b-form-group>
                </b-col>
              </b-row>
            </b-col>
            <!-- Field: min experience -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Minimum experience(year)"
                label-for="salary-type"
              >
                <v-select
                  v-model="form.min_experience"
                  :options="experienceYear"
                  :clearable="false"
                />
              </b-form-group>
            </b-col>
            <!-- Field: min experience -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Age(years)"
                label-for="age"
              >
                <v-select
                  v-model="form.age"
                  :options="age"
                  :clearable="false"
                />
              </b-form-group>
            </b-col>
            <!-- Field: Gender -->
            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group
                label="Gender"
                label-for="gender"
                label-class="mb-1"
              >
                <b-form-radio-group
                  id="gender"
                  v-model="form.gender"
                  :options="gender"
                />
              </b-form-group>
            </b-col>

          </b-row>

        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <!-- Header: Personal Info -->
          <div class="d-flex">
            <feather-icon
              icon="UserIcon"
              size="19"
            />
            <h4 class="mb-0 ml-50">
              Requirements
            </h4>
          </div>
          <b-row>
            <b-col
              cols="12"
              md="6"
              lg="6"
            >
              <b-form-group
                label="Job Context"
                label-for="job-context"
                label-class="mb-1"
              >
                <validation-provider
                  #default="{ errors }"
                  name="Context"
                  vid="job_context"
                  rules="required"
                >
                  <b-form-textarea
                    v-model="form.job_context"
                    placeholder="Job context here...."
                    :state="errors.length > 0 ? false:null"
                    rows="4"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>

                </validation-provider>
              </b-form-group>
            </b-col>
            <b-col
              cols="12"
              md="6"
              lg="6"
            >
              <b-form-group
                label="Notes for apply"
                label-for="notes-apply"
                label-class="mb-1"
              >
                <b-form-textarea
                  v-model="form.job_notes"
                  placeholder="Notes before apply"
                  rows="4"
                />
              </b-form-group>
            </b-col>
            <!--            job responsibilities repeater-->
            <b-col
              cols="12"
              md="6"
              lg="6"
            >
              <b-form-group
                label="Job Responsibilities"
                label-for="job-responsibilities"
                label-class="mb-1"
              >
                <validation-provider
                  v-for="(r, index) in form.job_responsibilities"
                  :id="r+index"
                  :key="index"
                  ref="row"
                  #default="{ errors }"
                  class="repeater-form"
                  name="job responsibility"
                  :vid="`${'job_responsibilities.'+index}`"
                >

                  <b-row>
                    <b-col
                      lg="10"
                      md="9"
                      class="mb-50"
                    >

                      <b-form-input
                        id="item-name"
                        :value="r"
                        type="text"
                        placeholder="Type responsibilities list.."
                        :state="errors.length > 0 ? false:null"
                        @focusout="form.job_responsibilities[index]=$event.target.value"
                      />

                    </b-col>
                    <b-col
                      lg="2"
                      md="3"
                    >
                      <b-button
                        v-ripple.400="'rgba(234, 84, 85, 0.15)'"
                        variant="outline-danger"
                        @click="form.job_responsibilities.splice(index, 1)"
                      >
                        <feather-icon
                          icon="XIcon"
                        />
                      </b-button>
                    </b-col>
                  </b-row>
                  <small class="text-danger">{{ errors[0] }}</small>

                </validation-provider>
              </b-form-group>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="primary"
                @click="form.job_responsibilities.push('')"
              >
                <feather-icon
                  icon="PlusIcon"
                  class="mr-25"
                />
                <span>Add New</span>
              </b-button>
            </b-col>
            <!--            compensation and other benefits-->
            <b-col
              cols="12"
              md="6"
              lg="6"
            >
              <b-form-group
                label="Compensation and Other Benefits"
                label-for="compensation"
                label-class="mb-1"
              >
                <validation-provider
                  v-for="(other, index) in form.other_benefits"
                  :id="other+index"
                  :key="index"
                  ref="rowCom"
                  #default="{ errors }"
                  class="repeater-form"
                  name="job responsibility"
                  :vid="`${'other_benefits.'+index}`"
                >
                  <b-row>
                    <b-col
                      lg="10"
                      md="9"
                      class="mb-50"
                    >

                      <b-form-input
                        id="item-name"
                        type="text"
                        :value="other"
                        :state="errors.length > 0 ? false:null"
                        placeholder="Type compensation/benefit list.."
                        @focusout="form.other_benefits[index]=$event.target.value"
                      />

                    </b-col>
                    <b-col
                      lg="2"
                      md="3"
                    >
                      <b-button
                        v-ripple.400="'rgba(234, 84, 85, 0.15)'"
                        variant="outline-danger"
                        @click="form.other_benefits.splice(index, 1)"
                      >
                        <feather-icon
                          icon="XIcon"
                        />
                      </b-button>
                    </b-col>
                  </b-row>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="primary"
                @click="form.other_benefits.push('')"
              >
                <feather-icon
                  icon="PlusIcon"
                  class="mr-25"
                />
                <span>Add New</span>
              </b-button>
            </b-col>
            <!--            additional requirements-->
            <b-col
              cols="12"
              md="6"
              lg="6"
            >
              <b-form-group
                label="Additional requirement"
                label-for="additional-requirement"
                label-class="mb-1"
              >
                <validation-provider
                  v-for="(additional, index) in form.additional_requirements"
                  :id="additional+index"
                  :key="index"
                  ref="rowCom"
                  #default="{ errors }"
                  class="repeater-form"
                  name="job responsibility"
                  :vid="`${'additional_requirements.'+index}`"
                >
                  <b-row>
                    <b-col
                      lg="10"
                      md="9"
                      class="mb-50"
                    >

                      <b-form-input
                        id="item-name"
                        type="text"
                        :value="additional"
                        :state="errors.length > 0 ? false:null"
                        placeholder="Type additional requirement list.."
                        @focusout="form.additional_requirements[index]=$event.target.value"
                      />

                    </b-col>
                    <b-col
                      lg="2"
                      md="3"
                    >
                      <b-button
                        v-ripple.400="'rgba(234, 84, 85, 0.15)'"
                        variant="outline-danger"
                        @click="form.additional_requirements.splice(index, 1)"
                      >
                        <feather-icon
                          icon="XIcon"
                        />
                      </b-button>
                    </b-col>
                  </b-row>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="primary"
                @click="form.additional_requirements.push('')"
              >
                <feather-icon
                  icon="PlusIcon"
                  class="mr-25"
                />
                <span>Add New</span>
              </b-button>
            </b-col>
          </b-row>
        </div>
      </div>
      <b-button
        v-ripple.400="'rgba(255, 255, 255, 0.15)'"
        variant="primary"
        @click="updateJob"
      >
        <feather-icon
          icon="PlusIcon"
          class="mr-25"
        />
        <span>Update</span>
      </b-button>
    </validation-observer>
  </b-form>
</template>

<script>
import VSelect from 'vue-select'
import {
  BForm,
  BFormGroup,
  BFormRadioGroup,
  BRow,
  BCol,
  BFormInput,
  BInputGroup,
  BFormTextarea,
  BButton,
} from 'bootstrap-vue'
import flatPickr from 'vue-flatpickr-component'
import { heightTransition } from '@core/mixins/ui/transition'
import Ripple from 'vue-ripple-directive'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { required } from '@core/utils/validations/validations'
import ToastificationContent from '../../../@core/components/toastification/ToastificationContent'

export default {
  name: 'Edit',
  components: {
    ValidationProvider,
    ValidationObserver,
    VSelect,
    BForm,
    BFormGroup,
    BFormRadioGroup,
    BRow,
    BCol,
    BFormInput,
    BInputGroup,
    flatPickr,
    BFormTextarea,
    BButton,
  },
  directives: {
    Ripple,
  },
  mixins: [heightTransition],
  data() {
    return {
      required,
      form: {
        job_title: '',
        slug: '',
        vacancy: '',
        status: '',
        to_date: '',
        job_location: '',
        salary: '',
        salary_type: '',
        job_responsibilities: [],
        other_benefits: [],
        additional_requirements: [],
        educational_requirements: '',
        job_context: '',
        job_notes: '',
        age: '',
        job_categories: '',
        min_experience: '',
        min_salary: '',
        max_Salary: '',
      },
      salaryTypes: ['fixed', 'negotiable', 'range'],
      employmentStatus: [
        { name: 'Internship', value: 'internship' },
        { name: 'Online', value: 'online' },
        { name: 'Freelance', value: 'freelance' },
        { name: 'Contract', value: 'contract' },
        { name: 'Part Time', value: 'part-time' },
        { name: 'Full Time', value: 'full-time' },
      ],
      gender: ['male', 'female', 'both'],
      eduLevels: [],
      age: ['18-20', '21-25', '26-30', '31-35', '36-40', '41-45', '46-50', '51-55', '56-60'],
      experienceYear: ['Fresher', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
      categories: [],
      job: [],
      min_salary: 0,
      max_salary: 0,

      items: [{
        id: 1,
        selected: 'male',
        selected1: 'designer',
        prevHeight: 0,
      }],
      itemC: [{
        id: 1,
        selected: 'male',
        selected1: 'designer',
        prevHeight: 0,
      }],
      itemAdditional: [{
        id: 1,
        selected: 'male',
        selected1: 'designer',
        prevHeight: 0,
      }],
      nextTodoId: 2,
    }
  },
  created() {
    this.jobCategories()
    this.getEducation()
    this.jobDetail()
  },
  methods: {
    setValue(event, data, index) {
      this.data[index] = event.target.value
      console.log(this.form.job_responsibilities)
    },
    updateJob() {
      this.$refs.jobUpdate.validate().then(success => {
        if (success) {
          this.$store.dispatch('admin/jobs/JOB_UPDATE', {
            form: this.form,
          }).then(response => {
            console.log(response)
            this.$toast({
              component: ToastificationContent,
              props: {
                title: 'Updated!',
                icon: 'BellIcon',
                text: 'Job Updated Successfully!',
                variant: 'success',
              },
            })
          }).catch(error => {
            this.$refs.jobUpdate.setErrors(error.response.data.errors)
          })
        }
      })
    },
    jobDetail() {
      this.$store.dispatch('admin/jobs/JOB_DETAIL', {
        slug: this.$route.params.slug,
      }).then(response => {
        this.form = response.data.job
        // dynamic breadcrumb
        this.$route.meta.breadcrumb[1].text = this.form.job_title
        this.$router.replace({ query: { t: this.typeData } })
        if (response.data.job.salary_type === 'range') {
          const arr = response.data.job.salary.split('-')
          // eslint-disable-next-line prefer-destructuring
          this.min_salary = arr[0]
          // eslint-disable-next-line prefer-destructuring
          this.max_salary = arr[1]
        }
      })
    },
    jobCategories(data) {
      this.$store.dispatch('admin/category/CATEGORY_LIST', { params: { key: data } })
        .then(() => {
          this.categories = this.$store.getters['admin/category/CATEGORIES'].data
        })
    },
    getEducation(data) {
      this.$store.dispatch('admin/education/EDUCATION_LIST', { params: { key: data } })
        .then(() => {
          this.eduLevels = this.$store.getters['admin/education/EDUCATIONS'].data
          console.log(this.eduLevels)
        })
    },
  },
}
</script>

<style lang="scss">
@import '~@core/scss/vue/libs/vue-select.scss';
@import '~@core/scss/vue/libs/vue-flatpicker.scss';
</style>
