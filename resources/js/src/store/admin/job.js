import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    jobs: [],
  },
  getters: {
    JOBS(state) {
      return state.jobs
    },
  },
  mutations: {
    SET_JOBS(state, values) {
      state.jobs = values
    },
  },
  actions: {
    JOB_LIST(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/job-list', payload)
          .then(response => {
            context.commit('SET_JOBS', response.data.jobs)
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    CHANGE_STATUS(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.put(`api/v1/admin/job/${payload.slug}`, payload)
          .then(response => {
            // console.log(response)
            resolve(response)
          }).catch(error => {
            reject(error)
          })
      })
    },
    DESTROY_JOB(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.delete(`api/v1/admin/job/${payload.slug}`)
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
