<template>
  <validation-observer ref="generalForm">
    <b-card>
      <b-row>
        <b-col sm="6">
          <b-media no-body>
            <b-media-aside>
              <b-link>
                <b-img
                  ref="previewEl"
                  rounded
                  :src="userInfo.avatar"
                  height="80"
                />
              </b-link>
            <!--/ avatar -->
            </b-media-aside>

            <b-media-body class="mt-75 ml-75">
              <!-- upload button -->
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="primary"
                size="sm"
                class="mb-75 mr-75"
                @click="$refs.refInputEl.$el.click()"
              >
                Upload
              </b-button>
              <validation-provider
                #default="{ errors }"
                name="avatar"
                vid="avatar"
              >
                <b-form-file
                  ref="refInputEl"
                  v-model="userInfo.avatar"
                  accept=".jpg, .png, .gif"
                  :hidden="true"
                  plain
                  @input="inputImageRenderer"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
              <!--/ upload button -->
              <b-card-text>Allowed JPG, GIF or PNG. Max size of 800kB</b-card-text>
            </b-media-body>
          </b-media>
        </b-col>
      </b-row>
      <!-- media -->

      <!--/ media -->

      <!-- form -->
      <b-form class="mt-2">
        <b-row>
          <b-col sm="6">
            <b-form-group
              label="Name"
              label-for="account-name"
            >
              <validation-provider
                #default="{ errors }"
                name="name"
                vid="name"
              >
                <b-form-input
                  v-model="userInfo.name"
                  name="name"
                  placeholder="Name"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <b-col sm="6">
            <b-form-group
              label="E-mail"
              label-for="account-e-mail"
            >
              <b-form-input
                v-model="userInfo.email"
                name="email"
                placeholder="Email"
              />

            </b-form-group>
          </b-col>

          <!-- alert -->
          <b-col
            v-if="userInfo.email_verified === false"
            cols="12"
            class="mt-75"
          >
            <b-alert
              show
              variant="warning"
              class="mb-50"
            >
              <h4 class="alert-heading">
                Your email is not confirmed. Please check your inbox.
              </h4>
              <div class="alert-body">
                <b-link class="alert-link">
                  Resend confirmation
                </b-link>
              </div>
            </b-alert>
          </b-col>
          <!--/ alert -->

          <b-col cols="12">
            <b-button
              v-ripple.400="'rgba(255, 255, 255, 0.15)'"
              variant="primary"
              class="mt-2 mr-1"
              @click="updateGeneralInfo"
            >
              Save changes
            </b-button>
          </b-col>
        </b-row>
      </b-form>
    </b-card>
  </validation-observer>
</template>

<script>
import {
  BFormFile, BButton, BForm, BFormGroup, BFormInput, BRow, BCol, BAlert, BCard, BCardText, BMedia, BMediaAside, BMediaBody, BLink, BImg,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import { useInputImageRenderer } from '@core/comp-functions/forms/form-utils'
import { ref } from '@vue/composition-api'
import { ValidationProvider, ValidationObserver } from 'vee-validate'

export default {
  components: {
    BButton,
    BForm,
    BImg,
    BFormFile,
    BFormGroup,
    BFormInput,
    BRow,
    BCol,
    BAlert,
    BCard,
    BCardText,
    BMedia,
    BMediaAside,
    BMediaBody,
    BLink,
    ValidationProvider,
    ValidationObserver,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      profileFile: null,
      userInfo: {},
    }
  },
  created() {
    this.$store.dispatch('admin/getAuthUserInfo')
      .then(() => {
        this.userInfo = this.$store.getters['admin/getAdminInfo']
      })
  },
  methods: {
    updateGeneralInfo() {
      const cleaned = this.clean(this.userInfo)
      const formData = new FormData()
      // formData.id = this.$route.params.id
      formData.append('_method', 'PATCH')
      if (cleaned.avatar && typeof (this.userInfo.avatar) !== 'string') formData.append('avatar', this.userInfo.avatar)
      if (cleaned.name) formData.append('name', this.userInfo.name)
      if (cleaned.email) formData.append('email', this.userInfo.email)
      this.$store.dispatch('admin/updateAuthUserInfo', formData)
        .then(() => {
          this.$bvToast.toast('Updated Successfully', {
            title: 'Account Information',
            variant: 'success',
            solid: true,
          })
          this.$store.dispatch('admin/getAuthUserInfo')
          // this.$router.push({ name: 'user.posts' })
        }).catch(error => {
          this.$refs.generalForm.setErrors(error.response.data.errors)
        })
    },
    clean(obj) {
      // eslint-disable-next-line no-restricted-syntax
      for (const propName in obj) {
        if (obj[propName] === null || obj[propName] === undefined || obj[propName] === []) {
          // eslint-disable-next-line no-param-reassign
          delete obj[propName]
        }
      }
      return obj
    },
  },
  setup() {
    const refInputEl = ref(null)
    const previewEl = ref(null)

    const bannerRefInputEl = ref(null)
    const bannerPreviewEl = ref(null)

    const { inputImageRenderer } = useInputImageRenderer(refInputEl, base64 => {
      previewEl.value.src = base64
    })
    const { moreInputImageRenderer } = useInputImageRenderer(bannerRefInputEl, base64 => {
      bannerPreviewEl.value.src = base64
    })

    return {
      refInputEl,
      previewEl,
      bannerRefInputEl,
      bannerPreviewEl,
      inputImageRenderer,
      moreInputImageRenderer,
    }
  },
}
</script>
