export default [
  {
    title: 'Home',
    route: 'user.homepage',
    icon: 'HomeIcon',
  },
  {
    title: 'View Blog',
    href: `${process.env.MIX_SOURCES_APP_URL}/blogger/${localStorage.getItem('userData') ? JSON.parse(localStorage.getItem('userData')).username : '#'}`,
    icon: 'GlobeIcon',
  },
  {
    title: 'New Post',
    route: 'user.new-post',
    icon: 'PlusIcon',
  },
  {
    title: 'All Post',
    route: 'user.posts',
    icon: 'ListIcon',
  },
  {
    title: 'Comments',
    route: 'user.comments',
    icon: 'MessageCircleIcon',
  },
  {
    title: 'Apply For Ads',
    route: 'user.apply',
    icon: 'NavigationIcon',
  },
  {
    title: 'Earning Report',
    route: 'user.earning-report',
    icon: 'DollarSignIcon',
  },
  {
    title: 'Withdraw Balance',
    route: 'user.withdraw',
    icon: 'DollarSignIcon',
  },
  {
    title: 'Payments',
    route: '',
    icon: 'TrelloIcon',
    children: [
      {
        title: 'Add Account',
        route: 'user.accounts',
        icon: 'TrelloIcon',
      },
      // {
      //   title: 'Payment History',
      //   route: '',
      //   icon: 'TrelloIcon',
      // },
    ],
  },
]
