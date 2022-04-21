<template>
  <section id="dashboard-ecommerce">
    <b-row class="match-height">
      <b-col
        v-for="(data, index) in records"
        :key="index"
        lg="3"
        sm="6"
      >
        <b-card
          no-body
          class="card-statistics"
        >
          <b-card-body class="d-flex justify-content-between align-items-center">
            <div class="truncate">
              <h2 class="mb-25 font-weight-bolder">
                {{ data.count }}
              </h2>
              <span>{{ index }}</span>
            </div>
            <b-avatar
              variant="light-primary"
              size="45"
            >
              <feather-icon
                size="21"
                :icon="data.icon"
              />
            </b-avatar>
          </b-card-body>
        </b-card>
      </b-col>
      <b-col
        lg="4"
        md="6"
      />
    </b-row>
  </section>
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
    this.$store.dispatch('admin/dispatchForDashboardData')
      .then(() => {
        this.records = this.$store.getters['admin/getDashboardData']
      })
  },
}
</script>

<style scoped>

</style>
