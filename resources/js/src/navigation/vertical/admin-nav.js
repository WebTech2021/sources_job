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
    title: 'Feature',
    icon: 'AwardIcon',
    children: [{
      title: 'Setting',
      route: 'admin.feature.setting',
      icon: 'SlidersIcon',
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
