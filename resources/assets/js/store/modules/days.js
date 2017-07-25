import * as types from '../mutation-types'

// initial state
const state = {
  dayShown: '',
  todaysWorkout: '',
  allDays: '',
}

// getters
const getters = {

  dayShown (state) {
    return state.dayShown;
  },

  stepShown (state) {
    return state.stepShown;
  },

  todaysWorkout (state) {
    return state.todaysWorkout;
  },

  allDays (state) {
    return state.allDays;
  },

}

// actions
const actions = {

  addDay({ commit, dispatch }, day) {
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.post('/app/days', day)
        .then(response => {
          resolve();
          commit(types.STOP_LOADING);
          commit(types.ADD_NEW_DAY, response.data);
          dispatch('getTodaysWorkout');
          dispatch('makeNotification', 'New day added');
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  removeDay({ commit, dispatch }, dayId) {
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.delete(`/app/days/${dayId}`)
        .then((response) => {
          commit(types.STOP_LOADING);
          dispatch('getTodaysWorkout');
          resolve();
          commit(types.REMOVE_DAY, dayId);
          dispatch('makeNotification', 'Deleted');
        })
        .catch((err) => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  updateDay({commit, dispatch}, editedDay) {
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.put(`/app/days/${editedDay.id}`, editedDay)
        .then((response) => {
          commit(types.UPDATE_DAY, response.data)
          commit(types.STOP_LOADING);
          resolve();
          dispatch('getTodaysWorkout');
          dispatch('makeNotification', 'Updated');
        })
        .catch((err) => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  getDayById({ commit }, dayId) {
    return new Promise(function(resolve, reject) {
      commit(types.SET_CURRENT_DAY, {});
      // commit(types.START_LOADING);
      axios.get(`/app/days/${dayId}`)
        .then((response) => {
          resolve();
          // commit(types.STOP_LOADING);
          commit(types.SET_CURRENT_DAY, response.data);
        })
        .catch((err) => {
          // commit(types.STOP_LOADING);
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  addStep({ commit }, step) {
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.post('/app/steps', step)
        .then(response => {
          commit(types.STOP_LOADING);
          step.id = response.data;
          commit(types.ADD_STEPS, step);
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  removeStep({ commit, dispatch }, stepId) {
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.delete(`/app/steps/${stepId}`)
        .then(response => {
          resolve();
          commit(types.STOP_LOADING);
          commit(types.REMOVE_STEP, stepId);
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  getTodaysWorkout({ commit }) {
    return new Promise(function(resolve, reject) {
      axios.get('/app/days/today')
        .then(response => {
          resolve();
          commit(types.RECEIVE_TODAYS_WORKOUT, response.data);
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  getAllDays({commit}) {
    return new Promise(function(resolve, reject) {
      axios.get('/app/days')
        .then(response => {
          resolve();
          commit(types.RECEIVE_PROGRAM_DAYS, response.data);
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

}

// mutations
const mutations = {

  [types.ADD_NEW_DAY] (state, newDay) {
    state.allDays.push(newDay);
  },

  [types.REMOVE_DAY] (state, dayId) {
    if (state.allDays.length > 0) {
      for (var i = 0; i < state.allDays.length; i++) {
        if (state.allDays[i].id == dayId) {
          state.allDays.splice(i, 1);
        }
      }
    }
  },

  [types.UPDATE_DAY] (state, updatedDay) {
    if (state.allDays.length > 0) {
      for (var i = 0; i < state.allDays.length; i++) {
        if (state.allDays[i].id == updatedDay.id) {
          state.allDays[i].name = updatedDay.name;
          state.allDays[i].week_days = updatedDay.week_days;
        }
      }
    }
  },

  [types.RECEIVE_PROGRAM_DAYS] (state, allProgramDays) {
    state.allDays = allProgramDays;
  },

  [types.RECEIVE_TODAYS_WORKOUT] (state, todaysWorkout) {
      state.todaysWorkout = todaysWorkout;
  },

  [types.SET_CURRENT_DAY] (state, day) {
    state.dayShown = day;
  },

  [types.ADD_STEPS] (state, step) {
    state.dayShown.steps.push(step);
  },

  [types.REMOVE_STEP] (state, stepId) {
    if (state.dayShown) {
      for (var i = 0; i < state.dayShown.steps.length; i++) {
        if (state.dayShown.steps[i].id == stepId) {
          state.dayShown.steps.splice(i, 1);
        }
      }
    }
  },

}

export default {
  state,
  getters,
  actions,
  mutations
}
