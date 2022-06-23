export default [
  {
    title: 'Home',
    route: 'admin.homepage',
    icon: 'HomeIcon',
  },
  {
    title: 'Job Seeker',
    route: 'admin.job-seeker.list',
    icon: 'UsersIcon',
  },
  {
    title: 'Jobs',
    route: 'admin.job.list',
    icon: 'ServerIcon',
  },
  {
    title: 'Categories',
    route: 'admin.job.categories',
    icon: 'GridIcon',
  },
  {
    title: 'Education',
    route: 'admin.job.education',
    icon: 'BookIcon',
  },
  {
    title: 'Promotions',
    route: 'admin.all.promotion',
    icon: 'LoaderIcon',
  },
  {
    title: 'Pending Request',
    icon: 'AirplayIcon',
    children: [
      {
        title: 'Feature Request',
        route: 'admin.feature.request',
        icon: 'PlayIcon',
      },
      {
        title: 'Urgent Request',
        route: 'admin.urgent.request',
        icon: 'FastForwardIcon',
      },
    ],
  },
  {
    title: 'Setting',
    icon: 'SlidersIcon',
    children: [{
      title: 'Feature/Urgent Cost Setup',
      route: 'admin.feature.urgent.setting',
      icon: 'ToolIcon',
    }],
  },
  {
    title: 'Notice Board',
    icon: 'ListIcon',
    children: [
      {
        title: 'Create New',
        icon: 'PlusIcon',
        route: { name: 'admin.notice.create' },
      },
      {
        title: 'All Notice',
        icon: 'FileIcon',
        route: { name: 'admin.notice.list' },
      },
    ],

  },
]
