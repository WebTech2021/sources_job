export const isUserLoggedIn = () => localStorage.getItem('userData') && localStorage.getItem('uat')
export const isAdminLoggedIn = () => localStorage.getItem('adminData') && localStorage.getItem('aat')

export const getUserData = () => JSON.parse(localStorage.getItem('userData'))
export const getAdminData = () => JSON.parse(localStorage.getItem('adminData'))

// export const getHomeRouteForLoggedInUser = userRole => {
//   if (userRole === 'admin') return '/'
//   if (userRole === 'client') return { name: 'access-control' }
//   return { name: 'auth-login' }
// }
