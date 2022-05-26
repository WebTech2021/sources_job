<template>
  <b-row class="justify-content-center">
    <b-col
      cols="6"
      align-self="center"
    >
      <div class="card">
        <div class="card-body">
          <validation-observer ref="paymentMethod">
            <b-form>
              <b-form-group
                label="Select Method"
                label-for="page"
              >
                <validation-provider
                  #default="{ errors }"
                  name="payment type"
                  rules="required"
                >
                  <v-select
                    id="vue-select"
                    v-model="form.payment_type"
                    :state="errors.length > 0 ? false:null"
                    :options="paymentOption"
                    label="name"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-form-group
                label="Account Name"
                label-for="acc_name"
              >
                <validation-provider
                  #default="{ errors }"
                  vid="account_name"
                  name="account name"
                  rules="required"
                >
                  <b-form-input
                    v-model="form.acc_name"
                    :state="errors.length > 0 ? false:null"
                    placeholder="Enter account name"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-form-group
                label="Account Number"
                label-for="acc_num"
              >
                <validation-provider
                  #default="{ errors }"
                  vid="account_number"
                  name="account number"
                  rules="required"
                >
                  <b-form-input
                    v-model="form.acc_num"
                    :state="errors.length > 0 ? false:null"
                    placeholder="Enter account number"
                    type="number"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <div v-if="form.payment_type==='Bank'">
                <b-form-group
                  label="Bank name"
                  label-for="bank-name"
                >
                  <validation-provider
                    #default="{ errors }"
                    vid="bank_name"
                    name="bank name"
                    rules="required"
                  >
                    <b-form-input
                      v-model="form.bank_name"
                      :state="errors.length > 0 ? false:null"
                      placeholder="Enter bank name"
                    />
                    <small class="text-danger">{{ errors[0] }}</small>
                  </validation-provider>
                </b-form-group>
                <b-form-group
                  label="Bank Branch"
                  label-for="bank-branch"
                >
                  <validation-provider
                    #default="{ errors }"
                    vid="bank_branch"
                    name="bank branch"
                    rules="required"
                  >
                    <b-form-input
                      v-model="form.bank_branch"
                      :state="errors.length > 0 ? false:null"
                      placeholder="Enter branch name"
                    />
                    <small class="text-danger">{{ errors[0] }}</small>
                  </validation-provider>
                </b-form-group>
                <b-form-group
                  label="Swift Code"
                  label-for="swift-code"
                >
                  <validation-provider
                    #default="{ errors }"
                    vid="swift_code"
                    name="swift code"
                    rules="required"
                  >
                    <b-form-input
                      v-model="form.swift_code"
                      :state="errors.length > 0 ? false:null"
                      placeholder="Enter swift number"
                    />
                    <small class="text-danger">{{ errors[0] }}</small>
                  </validation-provider>
                </b-form-group>
              </div>

              <b-form-group
                v-if="form.payment_type!=='Bank'"
                label="Select Account Type"
                label-for="account-type"
              >
                <validation-provider
                  #default="{ errors }"
                  name="account type"
                  rules="required"
                >
                  <v-select
                    v-model="form.acc_type"
                    :state="errors.length > 0 ? false:null"
                    :options="accTypeOption"
                    label="name"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-row>
                <b-col md="6">
                  <div class="d-flex">
                    <b-form-group
                      label="Status"
                      label-for="status"
                    >
                      <b-form-checkbox
                        v-model="form.status"
                        checked="true"
                        class="custom-control-success"
                        switch
                      >
                        <span class="switch-icon-left">
                          <feather-icon icon="CheckIcon" />
                        </span>
                        <span class="switch-icon-right">
                          <feather-icon icon="XIcon" />
                        </span>
                      </b-form-checkbox>
                    </b-form-group>
                  </div>
                </b-col>
              </b-row>
              <button
                type="submit"
                class="btn btn-outline-primary mt-2"
                @click.prevent="validationForm"
              >
                Submit
              </button>
            </b-form>
          </validation-observer>
        </div>
      </div>
    </b-col>
  </b-row>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import vSelect from 'vue-select'
import {
  BRow,
  BCol,
  BForm,
  BFormInput,
  BFormGroup,
  BFormCheckbox,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
// eslint-disable-next-line import/extensions
import Toaster from '@core/components/toastification/ToastificationContent'
import { required } from '@validations'

export default {
  name: 'Create',
  components: {
    ValidationProvider,
    ValidationObserver,
    BCol,
    BRow,
    BForm,
    BFormInput,
    BFormGroup,
    BFormCheckbox,
    vSelect,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      form: {
        acc_name: '',
        acc_num: '',
        status: true,
        payment_type: 'Bank',
        acc_type: 'Personal',
        bank_name: '',
        bank_branch: '',
        swift_code: '',

      },
      paymentOption: ['Bank', 'Bkash', 'Nagad', 'Rocket'],
      accTypeOption: ['Personal'],
      required,
    }
  },
  methods: {
    validationForm() {
      this.$refs.paymentMethod.validate().then(success => {
        if (success) {
          this.$store.dispatch('user/account/STORE_ACCOUNT', this.form)
            .then(() => {
              this.$nextTick(() => {
                for (const key in this.form) {
                  this.form[key] = ''
                }
                this.$refs.paymentMethod.reset()
                this.form.acc_type = 'Personal'
                this.form.payment_type = 'Bkash'
                this.$toast({
                  component: Toaster,
                  props: {
                    title: 'Success Notification',
                    icon: 'BellIcon',
                    text: 'Account Added Successfully',
                    variant: 'success',
                  },
                })
              })
              this.$router.push({ name: 'user.accounts' })
            })
            .catch(error => {
              this.$refs.paymentMethod.setErrors(error.response.data.errors)
            })
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '~@core/scss/vue/libs/vue-select.scss';
</style>
