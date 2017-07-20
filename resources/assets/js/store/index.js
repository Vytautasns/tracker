import Vuex from 'vuex';
import days from './modules/days';
import main from './modules/main';
import exercises from './modules/exercises';
import logs from './modules/logs';
import programs from './modules/programs';
import application from './modules/application';
import statistics from './modules/statistics';


import * as types from './mutation-types';


export default new Vuex.Store({
  actions: {

  },
  getters: {

  },
  modules: {
    application,
    days,
    exercises,
    logs,
    main,
    programs,
    statistics,
  },
});
