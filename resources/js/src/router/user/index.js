export default [
  {
    path: '/auth',
    name: 'auth',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/auth/Auth.vue'),
    meta: {
      layout: 'full',
    },
    redirect: { name: 'user.login' },
    children: [
      {
        path: '/login',
        name: 'user.login',
        // eslint-disable-next-line import/no-unresolved
        component: () => import('@/views/user/auth/Login.vue'),
        meta: {
          guestUserOnly: true,
          layout: 'full',
        },
      },
      {
        path: '/register',
        name: 'user.register',
        // eslint-disable-next-line import/no-unresolved
        component: () => import('@/views/user/auth/Register.vue'),
        meta: {
          guestUserOnly: true,
          layout: 'full',
        },
      },
    ],
  },
  {
    path: '/verify',
    name: 'user.email.verify',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/auth/verify.vue'),
    meta: {
      layout: 'full',
      guestUserOnly: true,
    },
  },
  {
    path: '/',
    name: 'user.homepage',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/Home.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'Home',
    },
  },
  {
    path: '/account',
    name: 'user.accounts',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/account/Index.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'My Accounts',

    },
  },
  {
    path: '/account/create',
    name: 'user.account.create',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/account/Create.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'Add New Bank Account',

    },
  },
  {
    path: '/profile',
    name: 'user.profile',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/account-setting/AccountSetting.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'Profile',

    },
  },
  {
    path: '/new-post',
    name: 'user.new-post',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/post/Create.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'New Post',

    },
  },
  {
    path: '/get-post/:id',
    name: 'user.get-post',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/post/Edit.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'This Post',
    },
  },
  {
    path: '/posts',
    name: 'user.posts',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/post/Index.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'All Posts',
    },
  },
  {
    path: '/apply',
    name: 'user.apply',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/applyForAd.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'Apply',
    },
  },
  {
    path: '/comments',
    name: 'user.comments',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/Comment/Index.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'All Comments',
    },
  },
  {
    path: '/earning-report',
    name: 'user.earning-report',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/earningReport.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'Earning Report',
    },
  },
  {
    path: '/withdraw',
    name: 'user.withdraw',
    // eslint-disable-next-line import/no-unresolved
    component: () => import('@/views/user/WithdrawBalance.vue'),
    meta: {
      authUserOnly: true,
      pageTitle: 'Withdraw Request',
    },
  },

]
