// import axios from 'axios'
// eslint-disable-next-line import/extensions,import/no-unresolved
import { axiosIns } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    categories: [],
    tags: [],
    post: {},
    posts: [],
    meta: {},
    link: {},
    adShowPosts: [],
  },
  getters: {
    getCategories(state) {
      return state.categories
    },
    getTags(state) {
      return state.tags
    },
    getPostDetails(state) {
      return state.post
    },
    getPosts(state) {
      return state.posts
    },
    getPostMetaData(state) {
      return state.meta
    },
    getPostLinkData(state) {
      return state.link
    },
    getEarnedPost(state) {
      return state.adShowPosts
    },

  },
  mutations: {
    setCategories(state, values) {
      state.categories = values
    },
    setTags(state, values) {
      state.tags = values
    },
    setPost(state, value) {
      state.post = value
    },
    setPosts(state, values) {
      state.posts = values
    },
    setMetaData(state, values) {
      state.meta = values
    },
    setLinkData(state, values) {
      state.link = values
    },
    setEarnPostData(state, values) {
      state.adShowPosts = values
    },
  },
  actions: {
    StorePost(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post('api/v1/post', payload, {
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
    getBlogCategories(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get(`${process.env.MIX_SOURCES_APP_URL}/api/v1/blog-categories?blogger=true`, payload)
          .then(response => {
            context.commit('setCategories', response.data.categories.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getAllTags(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/tags', payload)
          .then(response => {
            context.commit('setTags', response.data.tags)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getPosts(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/post', payload)
          .then(response => {
            context.commit('setPosts', response.data.posts)
            context.commit('setLinkData', response.data.links)
            context.commit('setMetaData', response.data.meta)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getPost(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get(`api/v1/post/${payload}`)
          .then(response => {
            // console.log(response.data)
            context.commit('setPost', response.data.post)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updatePost(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.post(`api/v1/post/${payload.id}`, payload.formData, {
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
    deletePost(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.delete(`api/v1/post/${payload}`)
          .then(() => {
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getEarningReports(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/earning-posts', payload)
          .then(response => {
            context.commit('setEarnPostData', response.data.items)
            context.commit('setLinkData', response.data.links)
            context.commit('setMetaData', response.data.meta)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
  },
}
