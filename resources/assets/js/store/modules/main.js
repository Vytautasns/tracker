import * as types from '../mutation-types'

// initial state
const state = {
  user: {},
}

// getters
const getters = {

  user (state) {
    return state.user;
  },


}

// actions
const actions = {

  // Get initial user data from database
  getUser({ commit }) {
    commit(types.START_LOADING);

    axios.get('/app/user')
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.RECEIVE_USER, response.data);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Application couldn\'t start. Try reloading.');
      });
  },

  saveSetting({ commit }, settings) {
    // commit(types.START_LOADING);
    //
    // axios.post('app/user', settings)
    //   .then(response => {
    //     commit(types.STOP_LOADING);
    //     commit(types.CHANGE_SETTING, settings);
    //   })
    //   .catch(err => {
    //     commit(types.STOP_LOADING);
    //     commit(types.ERROR_TEXT, 'Application couldn\'t start. Try reloading.');
    //   });
    commit(types.CHANGE_SETTING, { id: 1, value: false });
  },

}

// mutations
const mutations = {
  [types.RECEIVE_USER] (state, user) {

    let changedUserObject = {};

    changedUserObject.name = user.name;
    changedUserObject.email = user.email;
    changedUserObject.settings = {};

    for (var i = 0; i < user.settings.length; i++) {
      changedUserObject.settings[user.settings[i].name] = user.settings[i].value;
    }

    state.user = changedUserObject;

  },

  [types.CHANGE_SETTING] (state, settings) {
    state.user.settings.find((element) => {
      return element.id === settings.id;
    }).value = settings.value;
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
