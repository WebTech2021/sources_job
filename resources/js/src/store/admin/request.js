import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    requests: [],
  },
  getters: {
    REQUESTS(state) {
      return state.requests
    },
  },
  mutations: {
    SET_REQUESTS(state, values) {
      state.requests = values
    },
  },
  actions: {
    REQUEST_LIST(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/request-list', payload)
          .then(response => {
            context.commit('SET_REQUESTS', response.data.requests)
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    CHANGE_STATUS(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.put(`api/v1/admin/feature-request/${payload.id}`, payload)
          .then(response => {
            resolve(response)
          }).catch(error => {
            reject(error)
          })
      })
    },
  },

}
