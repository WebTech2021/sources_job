import { axiosAdmin } from '@/libs/axios'
import user from './user'
import post from './post'
import adrequest from './adrequest'
import category from './category'
import dashboard from './dashboard'
import settings from './settings'
import withdrawal from './withdrawal'

export default {
  namespaced: true,
  modules: {
    user,
    post,
    adrequest,
    category,
    dashboard,
    settings,
    withdrawal,
  },
  state: {
    admin: null,
    apiResponse: {
      success: '',
      message: '',
      errors: [],
    },
    adminInfo: null,
  },
  getters: {
    getMessage(state) {
      return state.apiResponse.message
    },
    getAdminInfo(state) {
      return state.adminInfo
    },
  },
  mutations: {
    setAdmin(state, value) {
      state.admin = value
    },
    setResponses(state, value) {
      state.apiResponse.success = value.success
      state.apiResponse.message = value.message
      state.apiResponse.errors = value.errors
    },
    setAdminInfo(state, values) {
      state.adminInfo = values
    },
    clearAdminInfo(state) {
      state.adminInfo = null
    },
  },
  actions: {
    adminLogin(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/login', payload)
          .then(response => {
            context.commit('setResponses', response.data)
            context.commit('setAdmin', response.data.data.adminData)
            localStorage.setItem('aat', response.data.data.access_token)
            localStorage.setItem('adminData', JSON.stringify(response.data.data.adminData))
            resolve('Success')
          })
          .catch(error => {
            context.commit('setResponses', error.response)
            reject(error)
          })
      })
    },
    adminLogout({ commit }) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/logout')
          .then(response => {
            commit('clearAdminInfo')
            console.log(response)
            localStorage.removeItem('adminData')
            localStorage.removeItem('aat')
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getAuthUserInfo(context) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/my-info')
          .then(response => {
            context.commit('setAdminInfo', response.data.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateAuthUserInfo(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/update-my-info', payload)
          .then(() => {
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updatePassword(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.patch('api/v1/admin/update-my-info', payload)
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
