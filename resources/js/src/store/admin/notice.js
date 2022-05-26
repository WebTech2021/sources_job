import { axiosAdmin } from '../../libs/axios'

export default {
  namespaced: true,
  state: {
    notices: '',
    success: '',
    message: '',
    errors: [],
  },
  getters: {
    GET_NOTICE(state) {
      return state.notices
    },
  },
  actions: {
    NOTICES(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/notices', payload).then(response => {
          context.commit('SET_NOTICES', response.data.notices)
          resolve('success')
        })
          .catch(error => {
            reject(error)
          })
      })
    },
    ADD_NOTICE(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/notices', payload).then(response => {
          resolve(response)
        })
          .catch(error => {
            reject(error)
          })
      })
    },
    DELETE_NOTICES(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.delete('api/v1/admin/notices-remove', payload).then(response => {
          resolve(response)
        })
          .catch(error => {
            reject(error)
          })
      })
    },
  },

  mutations: {
    SET_NOTICES(state, value) {
      state.notices = value
    },
  },
}
