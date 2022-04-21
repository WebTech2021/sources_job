import { axiosIns } from '@/libs/axios'

export default {
  namespaced: true,
  state: {
    countries: [],
    upazilas: [],
    divisions: [],
    districts: [],
  },
  getters: {
    getCountries(state) {
      // console.log(state.countries)
      return state.countries
    },
    getDivisions(state) {
      return state.divisions
    },
    getDistricts(state) {
      return state.districts
    },
    getUpazilas(state) {
      return state.upazilas
    },
  },
  mutations: {
    setCountries(state, values) {
      state.countries = values
    },
    setDivisions(state, values) {
      state.divisions = values
    },
    setDistricts(state, values) {
      state.districts = values
    },
    setUpazilas(state, values) {
      state.upazilas = values
    },
  },
  actions: {
    Countries(context) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/get-countries')
          .then(response => {
            context.commit('setCountries', response.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    Divisions(context) {
      return new Promise((resolve, reject) => {
        axiosIns.get('api/v1/get-divisions')
          .then(response => {
            context.commit('setDivisions', response.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    Districts(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get(`api/v1/get-districts/${payload}`)
          .then(response => {
            context.commit('setDistricts', response.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    Upazilas(context, payload) {
      return new Promise((resolve, reject) => {
        axiosIns.get(`api/v1/get-upazilas/${payload}`)
          .then(response => {
            context.commit('setUpazilas', response.data)
            resolve()
          })
          .catch(error => {
            reject(error)
          })
      })
    },
  },
}
