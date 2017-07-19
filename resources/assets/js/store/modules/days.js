import * as types from '../mutation-types'

// initial state
const state = {
  dayShown: '',
}

// getters
const getters = {
  dayShown (state) {
    return state.dayShown;
  },

  stepShown (state) {
    return state.stepShown;
  },
}

// actions
const actions = {
  getDayById({ commit }, dayId) {
    commit(types.SET_CURRENT_DAY, {});
    commit(types.START_LOADING);

    axios.post('/app/days/show', { day_id: dayId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.SET_CURRENT_DAY, response.data);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'There was a problem getting day. Try reloading.');
      });
  },

  addStep({ commit }, step) {
    commit(types.START_LOADING);
    axios.post('/app/steps/save', step)
      .then(response => {
        commit(types.STOP_LOADING);
        step.id = response.data;
        commit(types.ADD_STEPS, step);

      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'There was a problem saving step. Try reloading.');
      });
  },

  removeStep({ commit, dispatch }, stepId) {
    commit(types.START_LOADING);
    axios.post('/app/steps/remove', { id: stepId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.REMOVE_STEP, stepId);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'There was a problem saving step. Try reloading.');
      });
  },

}

// mutations
const mutations = {
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
