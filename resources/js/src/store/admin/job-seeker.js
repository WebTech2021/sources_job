import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    seekers: [],
  },
  getters: {
    SEEKERS(state) {
      return state.seekers
    },
  },
  mutations: {
    SET_SEEKERS(state, values) {
      state.seekers = values
    },
  },
  actions: {
    SEEKER_LIST(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/job-seeker-list', payload)
          .then(response => {
            console.log(response)
            context.commit('SET_SEEKERS', response.data.seekers)
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    CHANGE_STATUS(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.put(`api/v1/admin/job-seeker/${payload.id}`, payload)
          .then(response => {
            // console.log(response)
            resolve(response)
          }).catch(error => {
            reject(error)
          })
      })
    },
  },

}
