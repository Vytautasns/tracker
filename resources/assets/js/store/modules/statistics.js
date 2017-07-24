import * as types from '../mutation-types'

// initial state
const state = {
  exerciseStats: '',
  totalProgress: '',
}

// getters
const getters = {

  exerciseStats (state) {
    return state.exerciseStats;
  },

  totalProgress (state) {
    return state.totalProgress;
  }

}

// actions
const actions = {

  getExerciseHistory({commit, dispatch}, exerciseId) {
    return new Promise ((resolve,reject) => {
      commit(types.START_LOADING);
      commit(types.RECEIVE_EXERCISE_STATS, {});
      axios.post(`/app/statistics/exercise`, { id: exerciseId })
      .then((response) => {
        resolve();
        commit(types.STOP_LOADING);
        commit(types.RECEIVE_EXERCISE_STATS, response.data);
      })
      .catch((err) => {
        // commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Error getting exercise statistics.');
      });
    });
  },

  getTotalProgress({commit, dispatch}) {
    return new Promise ((resolve,reject) => {
      commit(types.START_LOADING);
      commit(types.RECEIVE_EXERCISE_STATS, {});
      axios.get(`/app/statistics/total`)
      .then((response) => {
        resolve(response.data);
        commit(types.STOP_LOADING);
        // commit(types.RECEIVE_TOTAL_PROGRESS, response.data);
      })
      .catch((err) => {
        // commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Error getting exercise statistics.');
      });
    });
  },



}

// mutations
const mutations = {

  [types.RECEIVE_EXERCISE_STATS] (state, payload) {
    let casted = [];

    if (payload) {
      for (var i = 0; i < payload.length; i++) {
        casted.push(parseInt(payload[i]));
      }
    }

    state.exerciseStats = casted;
  },

  [types.RECEIVE_TOTAL_PROGRESS] (state, payload) {
    state.totalProgress = payload;
  },

}

export default {
  state,
  getters,
  actions,
  mutations
}
