import { axiosAdmin } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    users: [],
  },
  getters: {
    getUsers(state) {
      return state.users
    },
  },
  mutations: {
    setUsers(state, values) {
      state.users = values
    },
  },
  actions: {
    allUsers(context, payload) {
      return new Promise((resolve, reject) => {
        axiosAdmin.get('api/v1/admin/user', payload)
          .then(response => {
            // console.log(response.data.users)
            context.commit('setUsers', response.data.users)
            resolve('success')
          })
          .catch(error => {
            reject(error)
          })
      })
    },
  },

}
