import { axiosAdmin } from '@axios'

export default {
  state: {
    data: {},
  },
  getters: {
    getSettingsData(state) {
      return state.data
    },
    getTermsCondition(state) {
      return state.data.terms_condition
    },
    getBloggerContent(state) {
      return state.data.blogger_dashboard
    },
    getApplyForAdContent(state) {
      return state.data.apply_ad
    },
  },
  mutations: {
    setSettingsData(state, values) {
      state.data = values
    },
  },
  actions: {
    storeSettings(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.post('api/v1/admin/store-setting', payload)
          .then(res => {
            console.log(res)
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },
    settings(context) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/get-setting')
          .then(res => {
            console.log(res)
            context.commit('setSettingsData', res.data.settings)
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },
  },
}
