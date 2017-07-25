import * as types from '../mutation-types'

// initial state
const state = {
  user: {},
  settings: {},
}

// getters
const getters = {

  user (state) {
    return state.user;
  },

  settings (state) {
    return state.settings;
  }

}

// actions
const actions = {



  // Get initial user data from database
  getUser({ commit }) {
    return new Promise ((resolve, reject) => {
      // commit(types.START_LOADING);
      axios.get('/app/user')
        .then(response => {
          commit(types.STOP_LOADING);
          resolve();
          commit(types.RECEIVE_USER, response.data);
        })
        .catch(err => {
          commit(types.STOP_LOADING);
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  changeSetting({ commit }, settings) {
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.post('app/settings/change', settings)
        .then(response => {
          resolve();
          commit(types.STOP_LOADING);
          commit(types.CHANGE_SETTING, settings);
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response);
        });
    });

  },

}

// mutations
const mutations = {

  [types.RECEIVE_USER] (state, user) {
    let changedUserObject = {};
    changedUserObject.name = user.name;
    changedUserObject.email = user.email;
    for (var i = 0; i < user.settings.length; i++) {
      state.settings[user.settings[i].name] = user.settings[i].value;
    }
    state.user = changedUserObject;
  },

  [types.CHANGE_SETTING] (state, newSetting) {
    state.settings[newSetting.name] = newSetting.value;
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
