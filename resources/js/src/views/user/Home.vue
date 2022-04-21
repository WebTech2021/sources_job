<template>
  <div>
    <b-row>
      <div class="col-md-12">
        Notification area
      </div>
      <hr style="color: #0b5661">
      <div
        v-if="records"
        class="col-md-9"
      >
        <div class="row">
          <b-col
            v-for="(data, index) in records"
            :key="index"
            sm="3"
          >
            <b-card no-body>
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
        </div>
      </div>
      <div
        v-if="data"
        class="col-md-3"
      >
        <div class="card">
          <div
            class="card-body"
            v-html="data"
          />
        </div>
        <b-col
          sm="12"
        />
      </div>
    </b-row>

  </div>
</template>

<script>
import {
  BCard, BCardText, BLink, BCardBody, BAvatar, BRow, BCol, BAlert,
} from 'bootstrap-vue'

export default {
  components: {
    BCard,
    BCardText,
    BLink,
    BCardBody,
    BAvatar,
    BRow,
    BCol,
    BAlert,
  },
  data() {
    return {
      records: {},
      data: '',
    }
  },
  created() {
    this.$store.dispatch('user/dispatchForDashboardData')
      .then(() => {
        this.records = this.$store.getters['user/getDashboardData']
      })
    this.$store.dispatch('admin/settings')
      .then(() => {
        this.data = this.$store.getters['admin/getBloggerContent']
      })
  },
}
</script>

<style>

</style>
