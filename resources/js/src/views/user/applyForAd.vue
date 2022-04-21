<template>
  <div class="card">
    <div class="card-body">
      <p
        class="text-justify"
        v-html="data"
      />
      <button
        v-if="!applicationStatus"
        class="btn btn-primary"
        @click="apply"
      >
        Apply
      </button>
      <button
        v-else-if="applicationStatus==='pending'"
        class="btn btn-outline-warning"
        disabled
      >
        Request Pending
      </button>
      <button
        v-else-if="applicationStatus==='approved'"
        class="btn btn-outline-success"
        disabled
      >
        Approved
      </button>
    </div>
  </div>
</template>

<script>

import { axiosIns } from '@axios'

export default {
  name: 'ApplyForAd',
  data() {
    return {
      applicationStatus: false,
      data: '',
    }
  },
  created() {
    axiosIns.get('api/v1/profile/checkAds')
      .then(response => {
        // console.log(response.data)
        this.applicationStatus = response.data.status
      })
    this.$store.dispatch('admin/settings')
      .then(() => {
        this.data = this.$store.getters['admin/getApplyForAdContent']
      })
  },
  methods: {
    apply() {
      axiosIns.post('api/v1/profile/applyAds')
        .then(() => {
          this.applicationStatus = 'pending'
        })
    },
  },
}
</script>

<style scoped>

</style>
