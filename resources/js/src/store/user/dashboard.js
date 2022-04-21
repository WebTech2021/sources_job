import { axiosIns } from '@axios'

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
        axiosIns.get('api/v1/basic')
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
