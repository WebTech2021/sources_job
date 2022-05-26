<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">

      <!-- Brand logo-->
      <b-link
        class="brand-logo"
      >
        <vuexy-logo />
        <h2 class="brand-text text-primary ml-1">
          Blogs - Sources
        </h2>
      </b-link>
      <!-- /Brand logo-->
      <!-- Left Text-->
      <b-col
        lg="8"
        class="d-none d-lg-flex align-items-center p-5"
      >
        <div class="d-lg-flex align-items-center justify-content-center px-5">
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
        <router-view />
      </b-col>
      <!-- /Login-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import {
  BCol, BImg, BRow, BLink,
} from 'bootstrap-vue'
import VuexyLogo from '@core/layouts/components/Logo.vue'
import store from '@/store/index'

export default {
  name: 'Auth',
  components: {
    BRow,
    BCol,
    BImg,
    BLink,
    VuexyLogo,
  },
  data() {
    return {
      sideImg: require('@/assets/images/pages/Sign-up-banner.png'),
      // validation rulesimport store from '@/store/index'
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
}
</script>

<style lang="scss">
@import '@core/scss/vue/pages/page-auth.scss';
</style>
