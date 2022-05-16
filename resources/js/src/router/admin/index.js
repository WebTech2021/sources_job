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
    path: '/admin/job-seeker-list',
    name: 'admin.job-seeker.list',
    component: () => import('@/views/admin/job-seeker-list/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Job Seekers',
    },
  },
  {
    path: '/admin/job-list',
    name: 'admin.job.list',
    component: () => import('@/views/admin/job-list/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Job List',
    },
  },
  {
    path: '/admin/job-categories',
    name: 'admin.job.categories',
    component: () => import('@/views/admin/categories/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Category List',
    },
  },
  {
    path: '/admin/job-education',
    name: 'admin.job.education',
    component: () => import('@/views/admin/education/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Education List',
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
    path: '/admin/withdrawal-request',
    name: 'admin.withdrawal-requests',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/withdrawRequest.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Withdraw Requests',

    },
  },
  {
    path: '/admin/feature-setting',
    name: 'admin.feature.setting',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/feature/Setting.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Setting',
      breadcrumb: [
        {
          text: 'Feature',
          active: true,
        },
        {
          text: 'setting',
          active: true,
        },
      ],

    },
  },
]
