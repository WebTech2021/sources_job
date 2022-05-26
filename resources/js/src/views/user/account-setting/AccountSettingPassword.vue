<template>
  <b-card>
    <validation-observer ref="passwordForm">
      <!-- form -->
      <b-form>
        <b-row>
          <!-- old password -->
          <b-col md="6">
            <b-form-group
              label="Old Password"
              label-for="account-old-password"
            >
              <validation-provider
                #default="{ errors }"
                name="old_password"
                vid="old_password"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="account-old-password"
                    v-model="passwordValueOld"
                    name="old-password"
                    :type="passwordFieldTypeOld"
                    placeholder="Old Password"
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIconOld"
                      class="cursor-pointer"
                      @click="togglePasswordOld"
                    />
                  </b-input-group-append>
                </b-input-group>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
        <!--/ old password -->
        </b-row>
        <b-row>
          <!-- new password -->
          <b-col md="6">
            <b-form-group
              label-for="account-new-password"
              label="New Password"
            >
              <validation-provider
                #default="{ errors }"
                name="password"
                vid="password"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="account-new-password"
                    v-model="newPasswordValue"
                    :type="passwordFieldTypeNew"
                    name="new-password"
                    placeholder="New Password"
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIconNew"
                      class="cursor-pointer"
                      @click="togglePasswordNew"
                    />
                  </b-input-group-append>
                </b-input-group>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!--/ new password -->

          <!-- retype password -->
          <b-col md="6">
            <b-form-group
              label-for="account-retype-new-password"
              label="Retype New Password"
            >
              <validation-provider
                #default="{ errors }"
                name="password_confirmation"
                vid="password_confirmation"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="account-retype-new-password"
                    v-model="RetypePassword"
                    :type="passwordFieldTypeRetype"
                    name="retype-password"
                    placeholder="New Password"
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIconRetype"
                      class="cursor-pointer"
                      @click="togglePasswordRetype"
                    />
                  </b-input-group-append>
                </b-input-group>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!--/ retype password -->

          <!-- buttons -->
          <b-col cols="12">
            <b-button
              v-ripple.400="'rgba(255, 255, 255, 0.15)'"
              variant="primary"
              class="mt-1 mr-1"
              @click="changePassword"
            >
              Save changes
            </b-button>
            <b-button
              v-ripple.400="'rgba(186, 191, 199, 0.15)'"
              type="reset"
              variant="outline-secondary"
              class="mt-1"
            >
              Reset
            </b-button>
          </b-col>
        <!--/ buttons -->
        </b-row>
      </b-form>
    </validation-observer>
  </b-card>
</template>

<script>
import {
  BButton, BForm, BFormGroup, BFormInput, BRow, BCol, BCard, BInputGroup, BInputGroupAppend,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import { ValidationProvider, ValidationObserver } from 'vee-validate'

export default {
  components: {
    BButton,
    BForm,
    BFormGroup,
    BFormInput,
    BRow,
    BCol,
    BCard,
    BInputGroup,
    BInputGroupAppend,
    ValidationProvider,
    ValidationObserver,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      passwordValueOld: '',
      newPasswordValue: '',
      RetypePassword: '',
      passwordFieldTypeOld: 'password',
      passwordFieldTypeNew: 'password',
      passwordFieldTypeRetype: 'password',
    }
  },
  computed: {
    passwordToggleIconOld() {
      return this.passwordFieldTypeOld === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    passwordToggleIconNew() {
      return this.passwordFieldTypeNew === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    passwordToggleIconRetype() {
      return this.passwordFieldTypeRetype === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  methods: {
    togglePasswordOld() {
      this.passwordFieldTypeOld = this.passwordFieldTypeOld === 'password' ? 'text' : 'password'
    },
    togglePasswordNew() {
      this.passwordFieldTypeNew = this.passwordFieldTypeNew === 'password' ? 'text' : 'password'
    },
    togglePasswordRetype() {
      this.passwordFieldTypeRetype = this.passwordFieldTypeRetype === 'password' ? 'text' : 'password'
    },
    changePassword() {
      this.$store.dispatch('user/updatePassword', {
        old_password: this.passwordValueOld,
        password: this.newPasswordValue,
        password_confirmation: this.RetypePassword,
      }).then(() => {
        this.$bvToast.toast('Updated Successfully', {
          title: 'Account Information',
          variant: 'success',
          solid: true,
        })
        this.passwordValueOld = ''
        this.newPasswordValue = ''
        this.RetypePassword = ''
      })
        .catch(error => {
          this.$refs.passwordForm.setErrors(error.response.data.errors)
        })
    },
  },
}
</script>
