<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <!-- Left Text-->
      <b-col
        lg="8"
        class="d-none d-lg-flex align-items-center p-5"
      >
        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
          <b-img
            fluid
            :src="imgUrl"
            alt="Login V2"
          />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Login-->
      <b-col
        lg="4"
        class="d-flex align-items-center auth-bg px-2 p-lg-5"
      >
        <b-col
          sm="8"
          md="6"
          lg="12"
          class="px-xl-2 mx-auto"
        >
          <div class="text-center">
            <b-img
              fluid
              :src="appLogoImage"
              alt="Sources Logo"
            />
          </div>
          <b-card-title
            title-tag="h2"
            class="font-weight-bold mb-1 text-center"
          >
            Welcome to Sources Jobs!
          </b-card-title>
          <b-card-text class="mb-2 text-center">
            Please verify your email address
          </b-card-text>
          <!-- form -->
          <validation-observer ref="loginValidation">
            <b-form
              class="auth-login-form mt-2"
              @submit.prevent
            >
              <!-- email -->
              <b-form-group
                label="Verification code"
                label-for="verification_code"
              >
                <validation-provider
                  #default="{ errors }"
                  name="verification_code"
                  rules="required"
                >
                  <b-form-input
                    id="verification_code"
                    v-model="verification_code"
                    :state="errors.length > 0 ? false:null"
                    name="verification_code"
                    placeholder="code"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
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
                <span>Submit</span>
              </b-button>
            </b-form>
          </validation-observer>

          <b-card-text class="text-center mt-2">
            <span>Yet not get code? </span>
            <b-link
              to=""
              @click.prevent="resendCode"
            >
              <span>Resend</span>
            </b-link>
          </b-card-text>
          <b-card-text class="text-center mt-2">
            <span>Already have an account? </span>
            <b-link :to="{name:'user.login'}">
              <span>Sign in here</span>
            </b-link>
          </b-card-text>
        </b-col>
      </b-col>
      <!-- /Login-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { $themeConfig } from '@themeConfig'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BRow, BCol, BLink, BFormGroup, BFormInput, BCardText, BCardTitle, BImg, BForm, BButton, BSpinner,
} from 'bootstrap-vue'
import { required } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import store from '@/store/index'

export default {
  components: {
    BRow,
    BCol,
    BLink,
    BFormGroup,
    BFormInput,
    BCardText,
    BCardTitle,
    BImg,
    BForm,
    BButton,
    BSpinner,
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      verification_code: '',
      loading: false,
      // eslint-disable-next-line import/no-unresolved
      sideImg: require('@/assets/images/pages/Sign-up-banner.png'),
      // validation rules import store from '@/store/index'
      required,
    }
  },
  setup() {
    // App Name
    const { appName, appLogoImage } = $themeConfig.app

    return {
      appName,
      appLogoImage,
    }
  },
  computed: {
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
      this.loading = true
      this.$refs.loginValidation.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/userVerify', {
            email: this.$route.query.email ?? null,
            verification_code: this.verification_code,
          }).then(() => {
            this.$bvToast.toast('Congratulations')
            this.$router.push({ name: 'user.homepage' })
          }).catch(error => {
            this.loading = false
            this.$refs.loginValidation.setErrors(error.response.data.errors)
          })
        }
      })
    },
    resendCode() {
      this.$store.dispatch('user/resendVerificationCode', {
        email: this.$route.query.email,
      }).then(() => {
        this.$bvToast.toast(this.$store.getters['user/getMessage'], {
          title: 'Information',
          variant: 'warning',
          solid: false,
        })
      })
    },
  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/pages/page-auth.scss';
</style>
