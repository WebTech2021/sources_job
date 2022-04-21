import { axiosAdmin } from '@axios'

export default {
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
    dispatchForDashboardData(context) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/basic')
          .then(res => {
            context.commit('setDashboardData', res.data)
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },
  },
}
