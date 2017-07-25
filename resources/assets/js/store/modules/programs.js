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

  currentProgram (state) {
    return state.currentProgram;
  },

}

// actions
const actions = {

  getCurrentProgram({ commit, rootState }) {
    return new Promise((resolve,reject) => {
      commit(types.START_LOADING);
      axios.get('/app/programs/current')
        .then(response => {
          resolve(response.data);
          commit(types.STOP_LOADING);
          commit(types.SET_CURRENT_PROGRAM, response.data);
        })
        .catch((err) => {
          // commit(types.STOP_LOADING);
          commit(types.ERROR_TEXT, err.response);

        });
    });
  },

  getAvailablePrograms({ commit, rootState }) {
    return new Promise ((resolve, reject) => {
      // commit(types.START_LOADING);
      axios.get('/app/programs')
        .then(response => {
          // commit(types.STOP_LOADING);
          resolve(response.data);
          commit(types.RECEIVE_PROGRAMS, response.data);
        })
        .catch(err => {
          // commit(types.STOP_LOADING);
          commit(types.ERROR_TEXT, err.response);
        });
    });
  },

  saveNewPrgoram({ commit, dispatch }, newProgram) {
    return new Promise((resolve, reject) => {
      commit(types.START_LOADING);
      axios.post(`/app/programs`, newProgram)
        .then((response) => {
          resolve();
          commit(types.STOP_LOADING);
          dispatch('makeNotification', 'Saved!');
        })
        .catch(err => {
          reject();
          commit(types.ERROR_TEXT, err.response);

        });
     });
  },

  updateProgram({ commit, dispatch }, updatedProgram) {
    return new Promise((resolve, reject) => {
      commit(types.START_LOADING);
      axios.put(`/app/programs/${updatedProgram.id}`, updatedProgram)
        .then((response) => {
          resolve();
          commit(types.STOP_LOADING);
          dispatch('makeNotification', 'Updated!');
        })
        .catch(err => {
          reject();
          commit(types.ERROR_TEXT, err.response);
        });
     });
  },

  removeProgram({ commit, dispatch }, programId) {
    return new Promise(function(resolve, reject) {
      commit(types.START_LOADING);
      axios.delete(`/app/programs/${programId}`)
        .then(response => {
          commit(types.STOP_LOADING);
          commit(types.REMOVE_PROGRAM, programId);
          dispatch('makeNotification', 'Program deleted!');
        })
        .catch(err => {
          commit(types.ERROR_TEXT, err.response );
        });
    });
  },

}

// mutations
const mutations = {

  [types.RECEIVE_PROGRAMS] (state, programs) {
    state.availableProgramsList = programs;
  },

  [types.SET_CURRENT_PROGRAM] (state, program) {
    state.currentProgram = program;
  },

  [types.REMOVE_PROGRAM] (state, programId) {
    if (state.availableProgramsList) {
      for (var i = 0; i < state.availableProgramsList.length; i++) {
        if (state.availableProgramsList[i].id == programId) {
          state.availableProgramsList.splice(i, 1);
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
