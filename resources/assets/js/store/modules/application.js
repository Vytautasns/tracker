import * as types from '../mutation-types'

// initial state
const state = {

  errorMessages: [],
  ajaxQueue: 0,
  loading: false,
  notification: false,
  notificationMessage: '',
  loaded: 0,

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

  clearErrors({commit}) {
    commit(types.CLEAR_ERRORS);
  },
}

// mutations
const mutations = {
  [types.LOAD_MODULE] (state) {
    state.loaded++;
  },

  [types.CLEAR_ERRORS] (state) {
    state.errorMessages = [];
  },

  [types.START_LOADING] (state) {
    state.ajaxQueue += 1;
  },

  [types.STOP_LOADING] (state) {
    if (state.ajaxQueue > 0) {
      state.ajaxQueue -= 1;
    }
  },

  [types.ERROR_TEXT] (state, error) {
    if (error.data instanceof Object) {

      for (var variable in error.data) {
        if (error.data.hasOwnProperty(variable)) {

          if (error.data[variable].length > 1) {
            for (var i = 0; i < error.data[variable].length; i++) {
              state.errorMessages.push(`${error.data[variable][i]}`);
            }
          } else {
            state.errorMessages.push(`${error.data[variable]}`);
          }

        }
      }
    } else {
      state.errorMessages.push(error.statusText.toString());
    }

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
