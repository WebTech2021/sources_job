// import axios from 'axios'
// eslint-disable-next-line import/extensions,import/no-unresolved
import { axiosIns } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    comments: [],
    meta: {},
    link: {},
  },
  getters: {
    getAllComments(state) {
      return state.comments
    },
    getCommentMeta(state) {
      return state.meta
    },
    getCommentLink(state) {
      return state.link
    },
  },
  mutations: {
    SET_COMMENTS(state, values) {
      state.comments = values
    },
    SET_METADATA(state, values) {
      state.meta = values
    },
    SET_LINKDATA(state, values) {
      state.link = values
    },
  },
  actions: {
    GET_COMMENTS(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/comment', payload)
          .then(response => {
            context.commit('SET_COMMENTS', response.data.comments)
            context.commit('SET_LINKDATA', response.data.links)
            context.commit('SET_METADATA', response.data.meta)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    DeleteComment(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.delete(`api/v1/comment/${payload}`)
          .then(() => {
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    replyOnComment(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/comment', payload)
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
