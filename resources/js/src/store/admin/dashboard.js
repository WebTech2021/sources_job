import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    data: {},
  },
  getters: {
    getDashboardData(state) {
      return state.data
    },
  },
  mutations: {
    setDashboardData(state, values) {
      state.data = values
    },
  },
  actions: {
    getRecords() {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/home')
          .then(response => {
            // context.commit('setDashboardData', res.data)
            resolve(response.data.data)
          }).catch(error => {
            reject(error)
          })
      })
    },
  },
}
