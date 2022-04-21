<template>
  <b-card>
    <!-- form -->
    <b-form>
      <b-row>
        <!-- bio -->
        <b-col cols="12">
          <b-form-group
            label="About You"
            label-for="bio-area"
          >
            <b-form-textarea
              id="bio-area"
              v-model="userData.bio"
              rows="4"
              placeholder="Your bio data here..."
            />
          </b-form-group>
        </b-col>
        <!--/ bio -->

        <!-- birth date -->
        <b-col md="6">
          <b-form-group
            label-for="example-datepicker"
            label="Birth date"
          >
            <flat-pickr
              v-model="userData.dob"
              class="form-control"
              name="date"
              placeholder="Birth date"
            />
          </b-form-group>
        </b-col>
        <!--/ birth date -->

        <!-- phone -->
        <b-col md="6">
          <b-form-group
            label-for="phone"
            label="Phone"
          >
            <b-form-input
              v-model="userData.phone_number"
              placeholder="Phone number"
            />
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
  </b-card>
</template>

<script>
import {
  BButton, BForm, BFormGroup, BFormInput, BRow, BCol, BCard, BFormTextarea,
} from 'bootstrap-vue'
import flatPickr from 'vue-flatpickr-component'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
    BButton,
    BForm,
    BFormGroup,
    BFormInput,
    BRow,
    BCol,
    BCard,
    BFormTextarea,
    flatPickr,
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
  methods: {
    resetForm() {
      this.localOptions = JSON.parse(JSON.stringify(this.informationData))
    },
    updateInfo() {
      delete this.userData.avatar
      delete this.userData.banner
      this.$store.dispatch('user/updatePassword',
        this.clean(this.userData))
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
