import Vue from 'vue'

// axios
import axios from 'axios'

const axiosIns = axios.create({
  baseURL: process.env.MIX_APP_URL,
  timeout: 90000,
  headers: {
    Accept: 'application/json',
    Authorization: {
      toString() {
        return `Bearer ${localStorage.getItem('uat')}`
      },
    },
  },
})

const axiosAdmin = axios.create({
  baseURL: process.env.MIX_APP_URL,
  timeout: 90000,
  headers: {
    Accept: 'application/json',
    Authorization: {
      toString() {
        return `Bearer ${localStorage.getItem('aat')}`
      },
    },
  },
})

Vue.prototype.$http = axiosIns

export { axiosIns, axiosAdmin }
