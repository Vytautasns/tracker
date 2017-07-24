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
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.get('/app/exercises/categories')
        .then((response) => {
          resolve(response.data);
          commit(types.RECEIVE_CATEGORIES, response.data);
          commit(types.STOP_LOADING);
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });

  },

  getExercises({ commit }, categoryId) {
    return new Promise((resolve, reject) => {
      commit(types.RECEIVE_EXERCISES, {});
      axios.get(`/app/exercises/category/${categoryId}`)
        .then((response) => {
          commit(types.RECEIVE_EXERCISES, response.data);
          resolve();
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  getExerciseDetails({ commit }, exerciseId) {
    return new Promise(function(resolve, reject) {
      commit(types.RECEIVE_EXERCISE_DETAILS, {});
      axios.get(`/app/exercises/${exerciseId}`)
        .then((response) => {
          resolve();
          commit(types.RECEIVE_EXERCISE_DETAILS, response.data);
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

   storeExercise({commit, dispatch}, exercise) {
     return new Promise((resolve, reject) => {
       commit(types.START_LOADING);
       axios.post('/app/exercises', exercise)
         .then((response) => {
           resolve(response.data);
           commit(types.STOP_LOADING);
           dispatch('makeNotification', 'Saved!');
         })
         .catch(err => {
           reject();
           commit(types.ERROR_TEXT, err.response);
         });
      });
   },

   updateExercise({commit, dispatch}, exercise) {
     return new Promise((resolve, reject) => {
       commit(types.START_LOADING);
       axios.put(`/app/exercises/${exercise.id}`, exercise)
         .then((response) => {
           resolve(response.data);
           commit(types.STOP_LOADING);
           dispatch('makeNotification', 'Updated!');
         })
         .catch(err => {
           reject();
           commit(types.ERROR_TEXT, err.response);
         });
      });
   },

   removeExercise({commit, dispatch}, exerciseId) {
     return new Promise((resolve, reject) => {
       commit(types.START_LOADING);
       axios.delete(`/app/exercises/${exerciseId}`)
         .then((response) => {
           resolve();
           commit(types.STOP_LOADING);
           dispatch('makeNotification', 'Deleted!');
         })
         .catch(err => {
           reject();
           commit(types.ERROR_TEXT, err.response);
         });
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
