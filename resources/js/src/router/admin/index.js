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
    path: '/admin/jobs',
    name: 'admin.job.list',
    component: () => import('@/views/admin/job-list/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Job List',
    },
  },
  {
    path: '/admin/jobs/edit/:slug',
    name: 'admin.job.edit',
    component: () => import('@/views/admin/job-list/Edit.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Job Edit',
      breadcrumb: [
        {
          text: 'Jobs',
          to: { name: 'admin.job.list' },
          active: false,
        },
        {
          text: '',
          active: true,
        },
      ],
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
    path: '/admin/feature-urgent-setting',
    name: 'admin.feature.urgent.setting',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/setting/FeatureUrgentCostSetup.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Feature & Urgent',
      breadcrumb: [
        {
          text: 'Cost Setup',
          active: true,
        },
      ],
    },
  },
  {
    path: '/admin/job-promotion',
    name: 'admin.all.promotion',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/promotion/FeatureUrgent.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Promotion',
      breadcrumb: [
        {
          text: 'All',
          active: true,
        },
      ],
    },
  },
  {
    path: '/admin/request/feature',
    name: 'admin.feature.request',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/request/FeatureUrgent.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Feature Request',
      breadcrumb: [
        {
          text: 'Pending Request',
          active: true,
        },
        {
          text: 'Feature',
          active: true,
        },
      ],
    },
  },
  {
    path: '/admin/request/urgent',
    name: 'admin.urgent.request',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/admin/request/FeatureUrgent.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'Urgent Request',
      breadcrumb: [
        {
          text: 'Pending Request',
          active: true,
        },
        {
          text: 'Urgent',
          active: true,
        },
      ],
    },
  },
  {
    path: '/admin/notice-list',
    name: 'admin.notice.list',
    component: () => import('@/views/admin/notice/Index.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'All Notice',
      breadcrumb: [
        {
          text: 'Notice',
          active: true,
        },
        {
          text: 'List',
          active: true,
        },
      ],
    },
  },
  {
    path: '/admin/add-notice',
    name: 'admin.notice.create',
    component: () => import('@/views/admin/notice/Create.vue'),
    meta: {
      authAdminOnly: true,
      pageTitle: 'All Notice',
      breadcrumb: [
        {
          text: 'Notice',
          active: true,
        },
        {
          text: 'List',
          active: true,
        },
      ],
    },
  },
]
