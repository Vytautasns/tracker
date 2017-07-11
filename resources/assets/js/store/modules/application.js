import * as types from '../mutation-types'

// initial state
const state = {

  errorMessage: '',
  ajaxQueue: 0,
  loading: false,
  notification: false,
  notificationMessage: '',

}

// getters
const getters = {
  appState (state) {
    return state;
  },
}

// actions
const actions = {

}

// mutations
const mutations = {
  [types.START_LOADING] (state) {
    // Add ajax to queue
    state.ajaxQueue++;
    // Set loading to true
    state.loading = true;
  },

  [types.STOP_LOADING] (state) {
    // Remove one from queue
    state.ajaxQueue--;
    // Check if it was the last request in queue
    if (state.ajaxQueue == 0) {
      state.loading = false;
    }
  },

  [types.ERROR_TEXT] (state, error) {
    // Set error message
    state.errorMessage = error;
  },

}

export default {
  state,
  getters,
  actions,
  mutations
}
