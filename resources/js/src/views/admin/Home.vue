<template>
  <div>
    <b-row v-if="records">
      <b-col
        v-for="(rec,index) in records"
        :key="index"
        lg="3"
        sm="6"
      >
        <statistic-card-horizontal
          :icon="rec.icon"
          :statistic="rec.count"
          :statistic-title="index"
          :route="rec.route"
        />
      </b-col>
    </b-row>
  </div>
</template>

<script>
import { BRow, BCol } from 'bootstrap-vue'
import statisticCardHorizontal from '../../@core/components/statistics-cards/StatisticCardHorizontal'

export default {
  name: 'Home',
  components: {
    BRow,
    BCol,
    statisticCardHorizontal,
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
  mounted() {
    this.getStats()
  },
  methods: {
    getStats() {
      this.$store.dispatch('admin/dashboard/getRecords').then(response => {
        this.records = response
      })
    },
  },
}
</script>

<style scoped>

</style>
