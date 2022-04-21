import { axiosAdmin } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    adRequests: [],
    meta: {},
    link: {},
  },
  getters: {
    getAdRequest(state) {
      return state.adRequests
    },
    getRequestMetaData(state) {
      return state.meta
    },
    getRequestLinkData(state) {
      return state.link
    },
  },
  mutations: {
    setAdRequests(state, values) {
      state.adRequests = values
    },
    setMetaData(state, values) {
      state.meta = values
    },
    setLinkData(state, values) {
      state.link = values
    },
  },
  actions: {
    getRequests(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/ad-request', payload)
          .then(response => {
            context.commit('setAdRequests', response.data.adrequests)
            context.commit('setLinkData', response.data.links)
            context.commit('setMetaData', response.data.meta)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    changeStatus(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.patch(`api/v1/admin/ad-request/${payload.id}/status`, payload)
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
