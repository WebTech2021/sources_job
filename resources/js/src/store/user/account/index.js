// eslint-disable-next-line import/no-unresolved,import/extensions
import { axiosIns } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    accounts: [],
    req: [],
    meta: null,
    link: null,
  },
  getters: {
    getAccounts(state) {
      return state.accounts
    },
    getWithDrawRequests(state) {
      return state.req
    },
    getMetaData(state) {
      return state.meta
    },
    getLinkData(state) {
      return state.link
    },
  },
  mutations: {
    SET_ACCOUNTS(state, values) {
      state.accounts = values
    },
    setReq(state, values) {
      state.req = values
    },
    setMeta(state, values) {
      state.meta = values
    },
    setLink(state, value) {
      state.link = value
    },
  },
  actions: {
    STORE_ACCOUNT(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/profile/account', payload)
          .then(() => {
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    GET_ACCOUNTS(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/profile/account', payload)
          .then(response => {
            context.commit('SET_ACCOUNTS', response.data.accounts)
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    UPDATE_STATUS(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.patch(`api/v1/profile/account/${payload.id}`, payload)
          .then(() => {
            // context.commit('SET_ACCOUNTS', response.data.accounts)
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    DELETE_ACCOUNT(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.delete(`api/v1/profile/account/${payload}`)
          .then(() => {
            // context.commit('SET_ACCOUNTS', response.data.accounts)
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },

    storeWithdrawRequest(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/profile/withdraw-request', payload)
          .then(() => {
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    withdrawRequest(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/profile/withdraw-request', payload)
          .then(response => {
            context.commit('setReq', response.data.requests)
            context.commit('setLink', response.data.links)
            context.commit('setMeta', response.data.meta)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteRequest(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.delete(`api/v1/profile/withdraw-request/${payload}`)
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
