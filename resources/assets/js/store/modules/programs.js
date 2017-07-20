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

      axios.post('/app/programs/selected')
        .then(response => {
          resolve(response.data);
          commit(types.STOP_LOADING);
          commit(types.SET_CURRENT_PROGRAM, response.data);
        })
        .catch(err => {
          commit(types.STOP_LOADING);
          commit(types.ERROR_TEXT, 'There was problem getting current program. Try reloading.');
        });
    });
  },

  getAvailablePrograms({ commit, rootState }) {
    commit(types.START_LOADING);

    axios.post('/app/programs')
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.RECEIVE_PROGRAMS, response.data);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'There was problem getting programs. Try reloading.');
      });
  },

  addDay({ commit, dispatch }, day) {
    commit(types.START_LOADING);
    axios.post('/app/days/add', day)
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.ADD_NEW_DAY, response.data);
        dispatch('makeNotification', 'New day added');
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        dispatch('makeNotification', 'There was a problem while adding a new day.');
      });
  },

  updateDay({ commit, dispatch }, day) {
    commit(types.UPDATE_DAY, day);
    commit(types.START_LOADING);
    axios.post('/app/days/update', day)
      .then(response => {
        commit(types.STOP_LOADING);
        dispatch('makeNotification', 'Information updated.');
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        dispatch('makeNotification', 'There was a problem updating day.');
      });
  },

  removeDay({ commit, dispatch }, dayId) {
    commit(types.START_LOADING);
    axios.post('/app/days/remove', { id: dayId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.REMOVE_DAY, dayId);
        dispatch('makeNotification', 'Day removed.');
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        dispatch('makeNotification', 'There was a problem while deleting day.');
      });
  },

  saveNewPrgoram({ commit, dispatch }, newProgram) {
    return new Promise((resolve, reject) => {
      commit(types.START_LOADING);
      axios.post(`/app/programs/save`, newProgram)
        .then((response) => {
          resolve();
          commit(types.STOP_LOADING);
          dispatch('makeNotification', 'Saved!');
        })
        .catch(err => {
          reject();
          commit(types.STOP_LOADING);
          commit(types.ERROR_TEXT, 'Couldn\'t save program');
        });
     });

  },

  removeProgram({ commit, dispatch }, programId) {
    commit(types.START_LOADING);
    axios.post('/app/programs/remove', { id: programId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.REMOVE_PROGRAM, programId);
        dispatch('makeNotification', 'Program deleted!');
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        dispatch('makeNotification', 'There was a problem while deleting program.');
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

  [types.ADD_NEW_DAY] (state, newDay) {
    if (state.currentProgram) {
      state.currentProgram.days.push(newDay);
    }
  },

  [types.REMOVE_DAY] (state, dayId) {
    if (state.currentProgram) {
      for (var i = 0; i < state.currentProgram.days.length; i++) {
        if (state.currentProgram.days[i].id == dayId) {
          state.currentProgram.days.splice(i, 1);
        }
      }
    }
  },

  [types.UPDATE_DAY] (state, day) {
    if (state.currentProgram) {
      for (var i = 0; i < state.currentProgram.days.length; i++) {
        if (state.currentProgram.days[i].id == day.id) {
          state.currentProgram.days[i] = day;
        }
      }
    }
  },

  // [types.ADD_NEW_PROGRAM] (state, newProgram) {
  //   state.availableProgramsList.push(newProgram);
  // },

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
