import { axiosIns } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    posts: [],
    meta: {},
    link: {},
  },
  getters: {
    getReportedPosts(state) {
      return state.posts
    },
    getMetaData(state) {
      return state.meta
    },
    getLinkData(state) {
      return state.link
    },
  },
  mutations: {
    setPosts(state, values) {
      state.posts = values
    },
    setLinkData(state, values) {
      state.meta = values
    },
    setMetaData(state, values) {
      state.link = values
    },
  },
  actions: {
    changeStatus(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post(`api/v1/admin/post/${payload.id}/status`, payload)
          .then(() => {
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    reportedPosts(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/admin/reported-posts', payload)
          .then(response => {
            context.commit('setPosts', response.data.posts)
            context.commit('setLinkData', response.data.links)
            context.commit('setMetaData', response.data.meta)
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },
  },

}
