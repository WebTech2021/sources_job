<template>
  <b-tabs
    vertical
    content-class="col-12 col-md-9 mt-1 mt-md-0"
    pills
    nav-wrapper-class="col-md-3 col-12"
    nav-class="nav-left"
  >

    <!-- general tab -->
    <b-tab active>

      <!-- title -->
      <template #title>
        <feather-icon
          icon="UserIcon"
          size="18"
          class="mr-50"
        />
        <span class="font-weight-bold">General</span>
      </template>

      <account-setting-general />
    </b-tab>
    <!--/ general tab -->

    <!-- change password tab -->
    <b-tab>

      <!-- title -->
      <template #title>
        <feather-icon
          icon="LockIcon"
          size="18"
          class="mr-50"
        />
        <span class="font-weight-bold">Change Password</span>
      </template>

      <account-setting-password />
    </b-tab>
    <!--/ change password tab -->

    <!-- info -->
    <b-tab>

      <!-- title -->
      <template #title>
        <feather-icon
          icon="InfoIcon"
          size="18"
          class="mr-50"
        />
        <span class="font-weight-bold">Information</span>
      </template>

      <account-setting-information />
    </b-tab>

    <!--    &lt;!&ndash; social links &ndash;&gt;-->
    <!--    <b-tab>-->

    <!--      &lt;!&ndash; title &ndash;&gt;-->
    <!--      <template #title>-->
    <!--        <feather-icon-->
    <!--          icon="LinkIcon"-->
    <!--          size="18"-->
    <!--          class="mr-50"-->
    <!--        />-->
    <!--        <span class="font-weight-bold">Social</span>-->
    <!--      </template>-->

    <!--      <account-setting-social-->
    <!--        v-if="options.social"-->
    <!--        :social-data="options.social"-->
    <!--      />-->
    <!--    </b-tab>-->

    <!--    &lt;!&ndash; notification &ndash;&gt;-->
    <!--    <b-tab>-->

    <!--      &lt;!&ndash; title &ndash;&gt;-->
    <!--      <template #title>-->
    <!--        <feather-icon-->
    <!--          icon="BellIcon"-->
    <!--          size="18"-->
    <!--          class="mr-50"-->
    <!--        />-->
    <!--        <span class="font-weight-bold">Notifications</span>-->
    <!--      </template>-->

    <!--      <account-setting-notification-->
    <!--        v-if="options.notification"-->
    <!--        :notification-data="options.notification"-->
    <!--      />-->
    <!--    </b-tab>-->
  </b-tabs>
</template>

<script>
import { BTabs, BTab } from 'bootstrap-vue'
import AccountSettingGeneral from './AccountSettingGeneral.vue'
import AccountSettingPassword from './AccountSettingPassword.vue'
import AccountSettingInformation from './AccountSettingInformation.vue'

export default {
  components: {
    BTabs,
    BTab,
    AccountSettingGeneral,
    AccountSettingPassword,
    AccountSettingInformation,
  },
  data() {
    return {
      options: {},
    }
  },
  // beforeCreate() {
  //   // this.$http.get('/account-setting/data').then(res => { this.options = res.data })
  //   this.$store.dispatch('user/getAuthUserInfo')
  // },
}
</script>
