<template>
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
      Blogger Login
    </b-card-title>
    <b-card-text class="mb-2">
      Please sign-in to your account and start the adventure
    </b-card-text>

    <!-- form -->
    <validation-observer ref="loginValidation">
      <b-form
        class="auth-login-form mt-2"
        @submit.prevent
      >
        <!-- email -->
        <b-form-group
          label="Email"
          label-for="login-email"
        >
          <validation-provider
            #default="{ errors }"
            name="email"
            rules="required|email"
          >
            <b-form-input
              id="login-email"
              v-model="userEmail"
              :state="errors.length > 0 ? false:null"
              name="login-email"
              placeholder="john@example.com"
            />
            <small class="text-danger">{{ errors[0] }}</small>
          </validation-provider>
        </b-form-group>

        <!-- forgot password -->
        <b-form-group>
          <div class="d-flex justify-content-between">
            <label for="login-password">Password</label>
            <!--                  <b-link :to="{name:'auth-forgot-password-v2'}">-->
            <!--                    <small>Forgot Password?</small>-->
            <!--                  </b-link>-->
          </div>
          <validation-provider
            #default="{ errors }"
            name="password"
            rules="required"
          >
            <b-input-group
              class="input-group-merge"
              :class="errors.length > 0 ? 'is-invalid':null"
            >
              <b-form-input
                id="login-password"
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

        <!-- checkbox -->
        <b-form-group>
          <b-form-checkbox
            id="remember-me"
            v-model="status"
            name="checkbox-1"
          >
            Remember Me
          </b-form-checkbox>
        </b-form-group>

        <!-- submit buttons -->
        <b-button
          type="submit"
          variant="primary"
          block
          @click="validationForm"
        >
          Sign in
        </b-button>
      </b-form>
    </validation-observer>

    <b-card-text class="text-center mt-2">
      <span>New on our platform? </span>
      <b-link :to="{name:'user.register'}">
        <span>&nbsp;Create an account</span>
      </b-link>
    </b-card-text>
  </b-col>
</template>

<script>
/* eslint-disable global-require */
import { ValidationObserver, ValidationProvider } from 'vee-validate'
import {
  BButton, BCardText, BCardTitle, BCol, BForm, BFormCheckbox, BFormGroup, BFormInput, BImg, BInputGroup, BInputGroupAppend, BLink, BRow,
} from 'bootstrap-vue'
import { email, required } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import store from '@/store/index'

export default {
  components: {
    BCol,
    BLink,
    BFormGroup,
    BFormInput,
    BInputGroupAppend,
    BInputGroup,
    BFormCheckbox,
    BCardText,
    BCardTitle,
    BImg,
    BForm,
    BButton,
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      status: '',
      password: '',
      userEmail: '',
      topLogo: require('@/assets/images/logo/sources.png'),
      // validation rulesimport store from '@/store/index'
      required,
      email,
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/images/pages/Sign-up-banner.png')
        return this.sideImg
      }
      return this.sideImg
    },
  },
  methods: {
    validationForm() {
      this.$refs.loginValidation.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/userLogin', {
            email: this.userEmail,
            password: this.password,
          }).then(response => {
            if (response === 'verify') {
              this.$router.push({ name: 'user.email.verify', query: { email: this.userEmail } })
            } else {
              this.$router.push({ name: 'user.homepage' })
            }
          }).catch(error => {
            this.$refs.loginValidation.setErrors(error.response.data.errors)
          })
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/pages/page-auth.scss';
</style>
