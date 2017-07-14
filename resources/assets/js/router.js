import Router from 'vue-router';
import Home from './pages/Home';

import Programs from './pages/programs/Programs';
import ProgramShow from './pages/programs/ProgramShow';
import ProgramCreate from './pages/programs/ProgramCreate';

import Exercises from './pages/exercises/Exercises';
import ExerciseBrowse from './pages/exercises/ExerciseBrowse';
import ExerciseDetails from './pages/exercises/ExerciseDetails';

import WorkoutShow from './pages/workouts/WorkoutShow';
import WorkoutLog from './pages/workouts/WorkoutLog';

Vue.use(Router);

export default new Router({

  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  },

  routes: [

    // Main routes
    // **************************************************************************
    {
      path: '/',
      name: 'home',
      component: Home,
    },

    {
      path: '/programs',
      name: 'programs',
      component: Programs,
    },

    // Exercise routes
    // *************************************************************************

    {
      path: '/exercises',
      name: 'exercises',
      component: Exercises,
    },

    {
      path: '/category/:category',
      props: true,
      name: 'show-category',
      component: ExerciseBrowse,
    },

    {
      path: '/exercises/:exercise',
      props: true,
      name: 'show-exercise',
      component: ExerciseDetails,
    },

    // Workout routes
    // *************************************************************************
    {
      path: '/days/:day',
      props: true,
      name: 'show-day',
      component: WorkoutShow,
    },

    {
      path: '/days/:day/step/:step/:stepId',
      props: true,
      name: 'log-step',
      component: WorkoutLog,
    },


    // Programs routes
    // *************************************************************************

    {
      path: '/programs/:program',
      props: true,
      name: 'show-program',
      component: ProgramShow,
    },

    {
      path: '/create/program',
      name: 'program-create',
      component: ProgramCreate,
    },


    // Temp routes
    // *************************************************************************


    {
      path: '/settings',
      name: 'settings',
      component: require('./pages/app/Settings.vue'),
    },

  ],



})
