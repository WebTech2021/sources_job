<template>
  <div>
    <b-col
      sm="8"
      md="6"
      lg="12"
      class="px-xl-2 mx-auto"
    >
      <div class="text-center">
        <b-img
          fluid
          :src="topLogo"
          alt="Sources Logo"
        />
      </div>
      <b-card-title
        title-tag="h2"
        class="font-weight-bold mb-1 ont-weight-bold mb-1 text-center login-title h2"
        style="text-decoration: underline"
      >
        Blogger Registration
      </b-card-title>
      <b-card-text class="mb-2">
        Please sign-in to your account and start the adventure
      </b-card-text>

      <!-- form -->
      <validation-observer ref="registerForm">
        <b-form
          class="auth-login-form mt-2"
          @submit.prevent
        >
          <b-form-group
            label="Name"
            label-for="login-name"
          >
            <validation-provider
              #default="{ errors }"
              name="name"
              vid="name"
              rules="required"
            >
              <b-form-input
                id="login-name"
                v-model="name"
                :state="errors.length > 0 ? false:null"
                name="login-name"
                placeholder="Enter your name"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <!-- email -->
          <b-form-group
            label="Email"
            label-for="login-email"
          >
            <validation-provider
              #default="{ errors }"
              vid="email"
              name="email"
              rules="required|email"
            >
              <b-form-input
                id="login-email"
                v-model="regEmail"
                :state="errors.length > 0 ? false:null"
                name="login-email"
                placeholder="john@example.com"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>

          <b-form-group
            label="Country"
            label-for="country"
          >
            <validation-provider
              #default="{ errors }"
              vid="country_id"
              name="country"
              rules="required"
            >
              <b-form-select
                id="country"
                v-model="country"
                :options="countries"
                value-field="id"
                text-field="name"
                :state="errors.length > 0 ? false:null"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group
            v-if="country===20"
            label="Division"
            label-for="division"
          >
            <validation-provider
              #default="{ errors }"
              vid="division_id"
              name="division"
              rules="required"
            >
              <b-form-select
                id="division"
                v-model="division"
                :options="divisions"
                value-field="id"
                text-field="name"
                :state="errors.length > 0 ? false:null"
                @change="getDistricts"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group
            v-if="division"
            label="District"
            label-for="district"
          >
            <validation-provider
              #default="{ errors }"
              vid="district_id"
              name="district"
              rules="required"
            >
              <b-form-select
                id="district"
                v-model="district"
                :options="districts"
                value-field="id"
                text-field="name"
                :state="errors.length > 0 ? false:null"
                @change="getUpazilas"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group
            v-if="district"
            label="Upazila"
            label-for="upazila"
          >
            <validation-provider
              #default="{ errors }"
              name="upazila"
              vid="upazila_id"
              rules="required"
            >
              <b-form-select
                id="upazila"
                v-model="upazila"
                :options="upazilas"
                value-field="id"
                text-field="name"
                :state="errors.length > 0 ? false:null"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>

          <!-- forgot password -->
          <b-form-group>
            <div class="d-flex justify-content-between">
              <label for="loginpassword">Password</label>
              <!--                  <b-link :to="{name:'auth-forgot-password-v2'}">-->
              <!--                    <small>Forgot Password?</small>-->
              <!--                  </b-link>-->
            </div>
            <validation-provider
              #default="{ errors }"
              vid="password"
              name="password"
              rules="required"
            >
              <b-input-group
                class="input-group-merge"
                :class="errors.length > 0 ? 'is-invalid':null"
              >
                <b-form-input
                  id="loginpassword"
                  v-model="password"
                  :state="errors.length > 0 ? false:null"
                  class="form-control-merge"
                  :type="passwordFieldType"
                  name="login-password"
                  placeholder="············"
                />
                <b-input-group-append is-text>
                  <feather-icon
                    class="cursor-pointer"
                    :icon="passwordToggleIcon"
                    @click="togglePasswordVisibility"
                  />
                </b-input-group-append>
              </b-input-group>
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group>
            <validation-provider
              #default="{ errors }"
              vid="password"
              name="confirm_password"
              rules="required"
            >
              <label for="confirm_password">Confirm Password</label>
              <b-input-group
                class="input-group-merge"
                :class="errors.length > 0 ? 'is-invalid':null"
              >
                <b-form-input
                  id="confirm_password"
                  v-model="password_confirmation"
                  :state="errors.length > 0 ? false:null"
                  class="form-control-merge"
                  :type="confirmPasswordFieldType"
                  name="password_confirmation"
                  placeholder="············"
                />
                <b-input-group-append is-text>
                  <feather-icon
                    class="cursor-pointer"
                    :icon="confirmPasswordToggleIcon"
                    @click="toggleConfirmPasswordVisibility"
                  />
                </b-input-group-append>
              </b-input-group>
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <!--          <b-form-group-->
          <!--            label="Refer Code"-->
          <!--            label-for="refer_code"-->
          <!--          >-->
          <!--            <validation-provider-->
          <!--              #default="{ errors }"-->
          <!--              vid="user_id"-->
          <!--              name="refer_code"-->
          <!--            >-->
          <!--              <b-form-input-->
          <!--                id="refer_code"-->
          <!--                v-model="refer_code"-->
          <!--                :state="errors.length > 0 ? false:null"-->
          <!--                name="refer_code"-->
          <!--                placeholder="Enter your Refer Code"-->
          <!--              />-->
          <!--              <small class="text-danger">{{ errors[0] }}</small>-->
          <!--            </validation-provider>-->
          <!--          </b-form-group>-->
          <!-- checkbox -->
          <b-form-group>
            <b-form-checkbox
              id="remember-me"
              v-model="status"
              name="remember_me"
            >
              Accept All <a
                href=""
                @click.prevent="$bvModal.show('modal-terms&con')"
              >Terms and
                Condition</a>
              <i
                class="fas fa-info-circle"
                data-toggle="tooltip"
                data-placement="top"
                title=""
                data-original-title="Must be check in or visit"
              />
            </b-form-checkbox>
          </b-form-group>

          <!-- submit buttons -->
          <b-button
            v-if="loading"
            type="submit"
            variant="primary"
            block
          >
            <b-spinner
              small
            />
          </b-button>
          <b-button
            v-else
            type="submit"
            variant="primary"
            block
            @click="validationForm"
          >
            <span>Register</span>
          </b-button>
        </b-form>
      </validation-observer>

      <b-card-text class="text-center mt-2">
        <span>Have an Account? </span>
        <b-link :to="{name:'user.login'}">
          <span>&nbsp;Sign In</span>
        </b-link>
      </b-card-text>
    </b-col>
    <b-modal
      id="modal-terms&con"
      title="Terms & Condition"
      scrollable
      ok-only
      ok-title="Accept"
    >
      <b-card-text v-html="tos" />
    </b-modal>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BLink,
  BCardTitle,
  BCardText,
  BForm,
  BButton,
  BFormInput,
  BFormGroup,
  BInputGroup,
  BInputGroupAppend,
  BFormCheckbox,
  BImg,
  BCol,
  BSpinner,
  BFormSelect, BModal,
} from 'bootstrap-vue'
import { required, email } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'

export default {
  components: {
    // BSV
    BLink,
    BCardTitle,
    BCardText,
    BForm,
    BButton,
    BFormInput,
    BFormGroup,
    BInputGroup,
    BInputGroupAppend,
    BFormCheckbox,
    BImg,
    BCol,
    BSpinner,
    BFormSelect,
    BModal,
    // validations
    ValidationProvider,
    ValidationObserver,

  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      loading: false,
      // Form Data
      regEmail: '',
      name: '',
      password: '',
      status: '',
      country: 20,
      division: 6,
      district: null,
      upazila: null,
      refer_code: this.$route.query.u,
      password_confirmation: '',
      confirmPasswordFieldType: 'password',
      // eslint-disable-next-line global-require,import/no-unresolved
      topLogo: require('@/assets/images/logo/sources.png'),

      // Fetched Data
      countries: [{
        id: 20,
        name: 'Bangladesh',
      }],
      divisions: [],
      districts: [],
      upazilas: [],
      // validation rules
      required,
      email,
      tos: '',
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    confirmPasswordToggleIcon() {
      return this.confirmPasswordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    imgUrl() {
      // eslint-disable-next-line no-undef
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/images/logo/sources.png')
        return this.sideImg
      }
      return this.sideImg
    },
  },
  mounted() {
    // this.$store.dispatch('location/Countries')
    //   .then(() => {
    //     this.countries = this.$store.getters['location/getCountries']
    //   })
    this.$store.dispatch('location/Divisions')
      .then(() => {
        this.divisions = this.$store.getters['location/getDivisions']
      })
    if (this.division) {
      this.getDistricts()
    }
    this.$store.dispatch('admin/settings')
      .then(() => {
        this.tos = this.$store.getters['admin/getTermsCondition']
      })
  },
  methods: {
    validationForm() {
      this.loading = true
      this.$refs.registerForm.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/userRegistration', {
            name: this.name,
            email: this.regEmail,
            password: this.password,
            password_confirmation: this.password_confirmation,
            country_id: this.country,
            division_id: this.division,
            district_id: this.district,
            upazila_id: this.upazila,
            refer_code: this.refer_code,
          }).then(response => {
            if (response === 'Success') {
              this.$bvToast.toast(this.$store.getters['user/getMessage'], {
                title: 'Information',
                variant: 'success',
                solid: false,
              })
              this.$router.push({ name: 'user.email.verify', query: { email: this.regEmail } })
            }
            this.loading = false
          })
            .catch(error => {
              this.loading = false
              this.$refs.registerForm.setErrors(error.response.data.errors)
            })
        }
      })
    },
    resetForm() {
      this.name = ''
      this.regEmail = ''
      this.password = ''
      this.password_confirmation = ''
    },
    toggleConfirmPasswordVisibility() {
      this.confirmPasswordFieldType = this.confirmPasswordFieldType === 'password' ? 'text' : 'password'
    },
    getDistricts() {
      this.$store.dispatch('location/Districts', this.division)
        .then(() => {
          this.districts = this.$store.getters['location/getDistricts']
          this.district = this.districts[0].id
          this.getUpazilas()
        })
    },
    getUpazilas() {
      this.$store.dispatch('location/Upazilas', this.district)
        .then(() => {
          this.upazilas = this.$store.getters['location/getUpazilas']
          this.upazila = this.upazilas[0].id
        })
    },
  },
}
</script>

<style lang="scss">
@import '~@core/scss/vue/pages/page-auth.scss';
</style>
