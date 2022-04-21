export default [
  {
    path: '/admin/login',
    name: 'admin.login',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/auth/Login.vue'),
    meta: {
      guestAdminOnly: true,
      layout: 'full',
    },
  },
  {
    path: '/admin/home',
    name: 'admin.homepage',
    component: () => import('@/views/admin/Home.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Home',
    },
  },
  {
    path: '/admin/users',
    name: 'admin.users',
    component: () => import('@/views/admin/User/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Users',
    },
  },
  {
    path: '/admin/posts',
    name: 'admin.posts',
    component: () => import('@/views/admin/post/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Posts',
    },
  },
  {
    path: '/admin/ad-requests',
    name: 'admin.ad-requests',
    component: () => import('@/views/admin/adRequest/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Ad Requests',
    },
  },
  {
    path: '/admin/profile',
    name: 'admin.profile',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/account-setting/AccountSetting.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Profile',

    },
  },
  {
    path: '/admin/category',
    name: 'admin.categories',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/Category.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Category',

    },
  },
  {
    path: '/admin/posts/reported',
    name: 'admin.reported-posts',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/post/reported.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Reported Post',

    },
  },
  {
    path: '/admin/guide',
    name: 'admin.guide',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/Guide.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Support and Guide',

    },
  },
  {
    path: '/admin/withdrawal-request',
    name: 'admin.withdrawal-requests',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/withdrawRequest.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Withdraw Requests',

    },
  },
]
