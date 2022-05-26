import { axiosAdmin } from '@axios'

export default {
  namespaced: true,
  state: {
    data: {},
    meta: null,
    link: null,
  },
  getters: {
    getRequestData(state) {
      return state.data
    },
    getMetaData(state) {
      return state.meta
    },
    getLinkData(state) {
      return state.link
    },
  },
  mutations: {
    setReqsData(state, values) {
      state.data = values
    },
    setMetaData(state, value) {
      state.meta = value
    },
    setLinkData(state, values) {
      state.link = values
    },
  },
  actions: {
    Requests(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/get-withdraw-requests', payload)
          .then(response => {
            context.commit('setReqsData', response.data.requests)
            context.commit('setMetaData', response.data.meta)
            context.commit('setLinkData', response.data.links)
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },
    declinePayment(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.patch(`api/v1/admin/decline-payment/${payload.id}`, payload)
          .then(() => {
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },
    paidPayment(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.patch(`api/v1/admin/mark-paid/${payload}`)
          .then(() => {
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },
  },
}
