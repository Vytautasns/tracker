import Router from 'vue-router';

Vue.use(Router);

export default new Router({
  mode: 'history',

  routes: [

    // Main routes
    // **************************************************************************
    {
      path: '/',
      name: 'home',
      component: require('./pages/Home.vue'),
    },



    {
      path: '/programs',
      name: 'programs',
      component: require('./pages/programs/Index.vue'),
    },


    {
      path: '/exercises',
      name: 'exercises',
      component: require('./pages/exercises/Index.vue'),
    },

    {
      path: '/details',
      name: 'details',
      component: require('./pages/exercises/Details.vue'),
    },

    {
      path: '/workout',
      name: 'workout',
      component: require('./pages/workouts/Show.vue'),
    },

    {
      path: '/log',
      name: 'log',
      component: require('./pages/workouts/Logger.vue'),
    },

    {
      path: '/days',
      name: 'days',
      component: require('./pages/programs/Days.vue'),
    },

    {
      path: '/settings',
      name: 'settings',
      component: require('./pages/app/Settings.vue'),
    },

  ],

  scrollBehavior (to, from, savedPosition) {

    return { x: 0, y: 0 }

  },
})
