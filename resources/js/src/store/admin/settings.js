import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    settings: [],
  },
  getters: {
    SETTINGS(state) {
      return state.settings
    },
  },
  mutations: {
    SET_SETTINGS(state, values) {
      state.settings = values
    },
  },
  actions: {
    SETTING_LIST(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/feature-setting', payload)
          .then(response => {
            context.commit('SET_SETTINGS', response.data.features)
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    STORE_SETTING(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/feature-setting', payload)
          .then(() => {
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    DELETE_SETTING(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.delete(`api/v1/admin/feature-setting/${payload}`)
          .then(response => {
            resolve(response)
          }).catch(error => {
            reject(error)
          })
      })
    },
    UPDATE_SETTING(context, payload) {
        console.log(payload.id)
      return new Promise((resolve, reject) => {
        axiosAdmin.put(`api/v1/admin/feature-setting/${payload.id}`, payload)
          .then(() => {
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
  },

}
