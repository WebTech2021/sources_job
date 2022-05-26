<template>
  <ul>
    <!--    <div-->
    <!--      class="text-center mb-1 mt-1"-->
    <!--    >-->
    <!--      Account Balance<br>-->
    <!--      BDT. {{ balance }}-->
    <!--    </div>-->
    <component
      :is="resolveNavItemComponent(item)"
      v-for="item in items"
      :key="item.header || item.title"
      :item="item"
    />
  </ul>
</template>

<script>
import { resolveVerticalNavMenuItemComponent as resolveNavItemComponent } from '@core/layouts/utils'
import { provide, ref } from '@vue/composition-api'
import { axiosAdmin, axiosIns } from '@axios'
import VerticalNavMenuHeader from '../vertical-nav-menu-header'
import VerticalNavMenuLink from '../vertical-nav-menu-link/VerticalNavMenuLink.vue'
import VerticalNavMenuGroup from '../vertical-nav-menu-group/VerticalNavMenuGroup.vue'

export default {
  components: {
    VerticalNavMenuHeader,
    VerticalNavMenuLink,
    VerticalNavMenuGroup,
  },
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      balance: 0,
    }
  },
  setup() {
    provide('openGroups', ref([]))

    return {
      resolveNavItemComponent,
    }
  },
  mounted() {
    // if (this.$route.meta.authUserOnly) {
    //   axiosIns.get('api/v1/profile/current-balance')
    //     .then(response => {
    //       this.balance = response.data.balance
    //     })
    // } else {
    //   axiosAdmin.get('api/v1/admin/current-balance')
    //     .then(response => {
    //       this.balance = response.data.balance
    //     })
    // }
  },
}
</script>
