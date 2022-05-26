import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    educations: [],
  },
  getters: {
    EDUCATIONS(state) {
      return state.educations
    },
  },
  mutations: {
    SET_EDUCATIONS(state, values) {
      state.educations = values
    },
  },
  actions: {
    EDUCATION_LIST(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/educations', payload)
          .then(response => {
            context.commit('SET_EDUCATIONS', response.data.educations)
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    STORE_EDUCATION(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/educations', payload)
          .then(() => {
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    DELETE_EDUCATION(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.delete(`api/v1/admin/educations/${payload}`)
          .then(response => {
            resolve(response)
          }).catch(error => {
            reject(error)
          })
      })
    },
      EDUCATION_DETAIL(context, payload) {
          return new Promise((resolve, reject) => {
              axiosAdmin.get(`api/v1/admin/educations/${payload.id}`)
                  .then(response => {
                      resolve(response.data.education)
                  }).catch(error => {
                  reject(error)
              })
          })
      },
      UPDATE_EDUCATION(context, payload) {
          return new Promise((resolve, reject) => {
              axiosAdmin.put(`api/v1/admin/educations/${payload.id}`, payload)
                  .then(() => {
                      resolve('success')
                  }).catch(error => {
                  reject(error)
              })
          })
      },
  },

}
