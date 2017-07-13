import * as types from '../mutation-types'

// initial state
const state = {
  categories: '',
  exercisesShown: '',
  exerciseDetails: '',
}

// getters
const getters = {
  categories (state) {
    return state.categories;
  },

  exercises (state) {
    return state.exercisesShown;
  },

  exerciseDetails (state) {
    return state.exerciseDetails;
  },
}

// actions
const actions = {
  getCategories({ commit }) {
    commit(types.START_LOADING);
    axios.get('/app/exercises/categories')
      .then((response) => {
        commit(types.RECEIVE_CATEGORIES, response.data);
        commit(types.STOP_LOADING);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Application couldn\'t start. Try reloading.');
      });
  },

  getExercises({ commit }, categoryId) {
    commit(types.RECEIVE_EXERCISES, {});
    commit(types.START_LOADING);
    axios.post('/app/exercises/show', {category_id: categoryId})
      .then((response) => {
        commit(types.RECEIVE_EXERCISES, response.data);
        commit(types.STOP_LOADING);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Problem getting exercises. Try reloading.');
      });
  },

  getExerciseDetails({ commit }, exerciseId) {
    commit(types.RECEIVE_EXERCISE_DETAILS, {});
    commit(types.START_LOADING);
    axios.post('/app/exercises/details', {exercise_id: exerciseId})
      .then((response) => {
        commit(types.RECEIVE_EXERCISE_DETAILS, response.data);
        commit(types.STOP_LOADING);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Problem getting exercise details. Try reloading.');
      });
  },
}

// mutations
const mutations = {
  [types.RECEIVE_CATEGORIES] (state, categories) {
    state.categories = categories;
  },

  [types.RECEIVE_EXERCISES] (state, exercises) {
    state.exercisesShown = exercises;
  },

  [types.RECEIVE_EXERCISE_DETAILS] (state, details) {
    state.exerciseDetails = details;
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
