import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    categories: [],
  },
  getters: {
    CATEGORIES(state) {
      return state.categories
    },
  },
  mutations: {
    SET_CATEGORIES(state, values) {
      state.categories = values
    },
  },
  actions: {
    CATEGORY_LIST(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/categories', payload)
          .then(response => {
            context.commit('SET_CATEGORIES', response.data.categories)
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    CATEGORY_DETAIL(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get(`api/v1/admin/categories/${payload.id}`)
          .then(response => {
            resolve(response.data.category)
          }).catch(error => {
            reject(error)
          })
      })
    },
    STORE_CATEGORY(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/categories', payload)
          .then(() => {
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    UPDATE_CATEGORY(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.put(`api/v1/admin/categories/${payload.id}`, payload)
          .then(() => {
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
    DELETE_CATEGORY(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.delete(`api/v1/admin/categories/${payload}`)
          .then(() => {
            resolve('success')
          }).catch(error => {
            reject(error)
          })
      })
    },
  },

}
