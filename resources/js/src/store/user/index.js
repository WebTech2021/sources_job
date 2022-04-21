import account from './account'
import post from './post'
import comment from './comment'
import dashboard from './dashboard'
// eslint-disable-next-line import/extensions,import/no-unresolved
import { axiosIns } from '@/libs/axios'

export default {
  namespaced: true,
  modules: {
    account,
    post,
    comment,
    dashboard,
  },
  state: {
    user: null,
    apiResponse: {
      errors: [],
      message: '',
    },
    userInfo: null,
  },
  getters: {
    getMessage(state) {
      return state.apiResponse.message
    },
    getUserInfo(state) {
      return state.userInfo
    },
  },
  mutations: {
    setUser(state, val) {
      state.user = val
    },
    setMessage(state, msg) {
      state.apiResponse.message = msg
    },
    setError(state, errors) {
      state.apiResponse.errors = errors
    },
    setUserInfo(state, values) {
      state.userInfo = values
    },
    clearUserInfo(state) {
      state.userInfo = null
    },
  },
  actions: {
    userLogin(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/login', payload)
          .then(response => {
            if (response.data.verify_link) {
              resolve('verify')
            }
            if (response.data.success) {
              context.commit('setUser', response.data.data.userData)
              localStorage.setItem('uat', response.data.data.access_token)
              localStorage.setItem('userData', JSON.stringify(response.data.data.userData))
              resolve('Success')
            }
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    userRegistration(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/register', payload)
          .then(response => {
            context.commit('setMessage', response.data.message)
            if (response.data.success) {
              resolve('Success')
            }
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    userVerify(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/verify', payload)
          .then(response => {
            localStorage.setItem('uat', response.data.access_token)
            localStorage.setItem('userData', JSON.stringify(response.data.userData))
            context.commit('setMessage', response.data.message)
            resolve('Success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    resendVerificationCode(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/resend/verification-code', payload)
          .then(response => {
            context.commit('setMessage', response.data.message)
            resolve('Success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    userLogout({ commit }) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/profile/logout')
          .then(response => {
            commit('clearUserInfo')
            console.log(response)
            localStorage.removeItem('userData')
            localStorage.removeItem('uat')
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getAuthUserInfo(context) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/profile/my-info')
          .then(response => {
            // console.log(response.data.data)
            context.commit('setUserInfo', response.data.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateAuthUserInfo(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/profile/update-my-info', payload)
          .then(response => {
            // console.log(response.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updatePassword(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.patch('api/v1/profile/update-my-info', payload)
          .then(response => {
            // console.log(response.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
  },
}
