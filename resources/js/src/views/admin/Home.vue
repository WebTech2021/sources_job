<template>
  <div>Dashboard</div>
</template>

<script>
import {
  BCard, BCardText, BRow, BCol, BMedia, BMediaBody, BCardHeader, BCardTitle, BCardBody, BAvatar,
} from 'bootstrap-vue'

export default {
  name: 'Home',
  components: {
    BCard,
    BCardText,
    BRow,
    BCol,
    BMediaBody,
    BCardHeader,
    BMedia,
    BCardTitle,
    BCardBody,
    BAvatar,
  },
  data() {
    return {
      records: {},
    }
  },
  created() {
    // this.$store.dispatch('admin/dispatchForDashboardData')
    //   .then(() => {
    //     this.records = this.$store.getters['admin/getDashboardData']
    //   })
  },
}
</script>

<style scoped>

</style>
