import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    promotions: [],
  },
  getters: {
    PROMOTIONS(state) {
      return state.promotions
    },
  },
  mutations: {
    SET_PROMOTIONS(state, values) {
      state.promotions = values
    },
  },
  actions: {
    JOB_PROMOTION_LIST(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/job-promotion-list', payload)
          .then(response => {
            context.commit('SET_PROMOTIONS', response.data.promotions)
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
  },
}
