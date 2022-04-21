<template>
  <b-card>
    <validation-observer ref="informationForm">
      <!-- form -->
      <b-form>
        <b-row>
          <!-- bio -->
          <b-col cols="12">
            <b-form-group
              label="About You"
              label-for="bio-area"
            >
              <validation-provider
                #default="{ errors }"
                name="bio"
                vid="bio"
              >
                <b-form-textarea
                  id="bio-area"
                  v-model="userData.bio"
                  rows="4"
                  placeholder="Your bio data here..."
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!--/ bio -->

          <!-- birth date -->
          <b-col md="6">
            <b-form-group
              label-for="example-datepicker"
              label="Birth date"
            >
              <validation-provider
                #default="{ errors }"
                name="dob"
                vid="dob"
              >
                <flat-pickr
                  v-model="userData.dob"
                  class="form-control"
                  name="date"
                  placeholder="Birth date"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!--/ birth date -->

          <!-- Country -->
          <!--        <b-col md="6">-->
          <!--          <b-form-group-->
          <!--            label-for="countryList"-->
          <!--            label="Country"-->
          <!--          >-->
          <!--            <v-select-->
          <!--              id="countryList"-->
          <!--              v-model="userData.country"-->
          <!--              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"-->
          <!--              label="title"-->
          <!--              :options="countryOption"-->
          <!--            />-->
          <!--          </b-form-group>-->
          <!--        </b-col>-->
          <!--/ Country -->

          <!-- phone -->
          <b-col md="6">
            <b-form-group
              label-for="phone"
              label="Phone"
            >
              <validation-provider
                #default="{ errors }"
                name="phone_number"
                vid="phone_number"
              >
                <b-form-input
                  v-model="userData.phone_number"
                  placeholder="Phone number"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!-- phone -->

          <b-col cols="12">
            <b-button
              v-ripple.400="'rgba(255, 255, 255, 0.15)'"
              variant="primary"
              class="mt-1 mr-1"
              @click="updateInfo"
            >
              Save changes
            </b-button>
            <b-button
              v-ripple.400="'rgba(186, 191, 199, 0.15)'"
              type="reset"
              class="mt-1"
              variant="outline-secondary"
              @click.prevent="resetForm"
            >
              Reset
            </b-button>
          </b-col>
        </b-row>
      </b-form>
    </validation-observer>
  </b-card>
</template>

<script>
import {
  BButton, BForm, BFormGroup, BFormInput, BRow, BCol, BCard, BFormTextarea,
} from 'bootstrap-vue'
import flatPickr from 'vue-flatpickr-component'
import Ripple from 'vue-ripple-directive'
import { ValidationProvider, ValidationObserver } from 'vee-validate'

export default {
  components: {
    BButton,
    BFormInput,
    BForm,
    BFormGroup,
    BRow,
    BCol,
    BCard,
    BFormTextarea,
    flatPickr,
    ValidationProvider,
    ValidationObserver,
  },
  directives: {
    Ripple,
  },
  data() {
    return {}
  },
  computed: {
    userData() {
      return this.$store.getters['user/getUserInfo']
    },
  },
  beforeCreate() {
    this.$store.dispatch('user/getAuthUserInfo')
      .then(() => {
        this.userInfo = this.$store.getters['user/getUserInfo']
      })
  },
  methods: {
    resetForm() {
      this.localOptions = JSON.parse(JSON.stringify(this.informationData))
    },
    updateInfo() {
      delete this.userData.avatar
      delete this.userData.banner
      this.$store.dispatch('user/updatePassword',
        this.clean(this.userData))
        .then(() => {
          this.$bvToast.toast('Updated Successfully', {
            title: 'Account Information',
            variant: 'success',
            solid: true,
          })
        }).catch(error => {
          this.$refs.informationForm.setErrors(error.response.data.errors)
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
}
</script>

<style lang="scss">
@import '~@core/scss/vue/libs/vue-select.scss';
@import '~@core/scss/vue/libs/vue-flatpicker.scss';
</style>
