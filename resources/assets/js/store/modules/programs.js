import * as types from '../mutation-types'

// initial state
const state = {
  currentProgram: '',
  availableProgramsList: '',
}

// getters
const getters = {

  availableProgramsList (state) {
    return state.availableProgramsList;
  },

}

// actions
const actions = {
  getAvailablePrograms({ commit }) {
    commit(types.START_LOADING);

    axios.get('/app/programs')
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.RECEIVE_PROGRAMS, response.data);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'There was problem getting programs. Try reloading.');
      });
  },
}

// mutations
const mutations = {

  [types.RECEIVE_PROGRAMS] (state, programs) {
    state.availableProgramsList = programs;
  },

  [types.SET_CURRENT_PROGRAM] (state, id) {
    state.currentProgram = id;
  },

}

export default {
  state,
  getters,
  actions,
  mutations
}
