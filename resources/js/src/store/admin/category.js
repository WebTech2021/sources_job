// import axios from 'axios'
// eslint-disable-next-line import/extensions,import/no-unresolved
import { axiosAdmin } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    categories: [],
    meta: {},
    link: {},
  },
  getters: {
    getCategories(state) {
      return state.categories
    },
    getCatMetaData(state) {
      return state.meta
    },
    getCatLinkData(state) {
      return state.link
    },

  },
  mutations: {
    setCategories(state, values) {
      state.categories = values
    },
    setMetaData(state, values) {
      state.meta = values
    },
    setLinkData(state, values) {
      state.link = values
    },
  },
  actions: {
    StoreCat(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/category', payload)
          .then(response => {
            resolve(response.data)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getAllCats(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/category', payload)
          .then(response => {
            context.commit('setCategories', response.data.categories)
            context.commit('setLinkData', response.data.links)
            context.commit('setMetaData', response.data.meta)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateCat(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post(`api/v1/admin/category/${payload.id}`, payload.formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
          .then(response => {
            resolve(response.data)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteCat(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.delete(`api/v1/admin/category/${payload}`)
          .then(() => {
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
  },
}
