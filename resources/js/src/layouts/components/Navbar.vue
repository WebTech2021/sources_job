<template>
  <div class="navbar-container d-flex content align-items-center">

    <!-- Nav Menu Toggler -->
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item">
        <b-link
          class="nav-link"
          @click="toggleVerticalMenuActive"
        >
          <feather-icon
            icon="MenuIcon"
            size="21"
          />
        </b-link>
      </li>
    </ul>

    <!-- Left Col -->
    <div class="bookmark-wrapper align-items-center flex-grow-1 d-none d-lg-flex">
      <dark-Toggler class="d-none d-lg-block" />
    </div>

    <b-navbar-nav class="nav align-items-center ml-auto">
      <b-nav-item-dropdown
        right
        toggle-class="d-flex align-items-center dropdown-user-link"
        class="dropdown-user"
      >
        <template #button-content>
          <div class="d-sm-flex d-none user-nav">
            <p class="user-name font-weight-bolder mb-0">
              {{ userData.name }}
            </p>
            <span class="user-status">{{ $route.meta.authUserOnly ? 'user' : 'admin' }}</span>
          </div>
          <b-avatar
            size="40"
            variant="light-primary"
            badge
            :src="userData.avatar"
            class="badge-minimal"
            badge-variant="success"
          />
        </template>

        <b-dropdown-item
          :to="$route.meta.authUserOnly ? { name: 'user.profile' } :{ name: 'admin.profile' }"
          link-class="d-flex align-items-center"
        >
          <feather-icon
            size="16"
            icon="UserIcon"
            class="mr-50"
          />
          <span>Profile</span>
        </b-dropdown-item>

        <b-dropdown-item
          link-class="d-flex align-items-center"
          @click="logout"
        >
          <feather-icon
            size="16"
            icon="LogOutIcon"
            class="mr-50"
          />
          <span>Logout</span>
        </b-dropdown-item>
      </b-nav-item-dropdown>
    </b-navbar-nav>
  </div>
</template>

<script>
import {
  BLink, BNavbarNav, BNavItemDropdown, BDropdownItem, BAvatar,
} from 'bootstrap-vue'
import DarkToggler from '@core/layouts/components/app-navbar/components/DarkToggler.vue'
// import { axiosIns } from '../../libs/axios'

export default {
  components: {
    BLink,
    BNavbarNav,
    BNavItemDropdown,
    BDropdownItem,
    BAvatar,

    // Navbar Components
    DarkToggler,
  },
  props: {
    toggleVerticalMenuActive: {
      type: Function,
      default: () => {},
    },
  },
  data() {
    return {
      logoutUrl: '',
      loginRouteName: '',
    }
  },
  computed: {
    userData() {
      if (this.$route.meta.authUserOnly) {
        return this.$store.getters['user/getUserInfo']
      }
      return this.$store.getters['admin/getAdminInfo']
    },
  },
  mounted() {
    this.$store.dispatch('admin/getAuthUserInfo')

    // console.log(this.$store.getters['admin/getAdminInfo'])
    // if both admin and user have vue panels
    // if (this.$route.meta.authAdminOnly) {
    //   this.$store.dispatch('admin/getAuthUserInfo')
    // } else {
    //   this.$store.dispatch('user/getAuthUserInfo')
    // }
  },
  methods: {
    logout() {
      if (this.$route.meta.authUserOnly) {
        this.$store.dispatch('user/userLogout').then(() => {
          this.$router.push({ name: 'user.login' })
        })
      } else if (this.$route.meta.authAdminOnly) {
        // console.log('admin logout start')
        this.$store.dispatch('admin/adminLogout').then(() => {
          this.$router.push({ name: 'admin.login' })
        })
      } else {
        // to-do: toaster message show
        console.log('Unable to logout')
      }
      // axiosIns.post(this.logoutUrl).then(response => {
      //   localStorage.clear()
      //   this.$router.push({ name: this.loginRouteName })
      // }).catch(() => {
      //   localStorage.clear()
      // })
    },
  },
}
</script>
