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
  makeNotification({commit}, payload) {
    commit(types.MAKE_NOTIFICATION, payload);
  },
}

// mutations
const mutations = {
  [types.START_LOADING] (state) {
    state.ajaxQueue += 1;
  },

  [types.STOP_LOADING] (state) {
    if (state.ajaxQueue > 0) {
      state.ajaxQueue -= 1;
    }
  },

  [types.ERROR_TEXT] (state, error) {
    // Set error message
    state.errorMessage = error;
  },

  [types.MAKE_NOTIFICATION] (state, text) {
    state.notification = true;
    state.notificationMessage = text;
    setTimeout(() => {
      state.notification = false;
    },500);
  },

}

export default {
  state,
  getters,
  actions,
  mutations
}
