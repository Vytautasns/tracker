import * as types from '../mutation-types'

// initial state
const state = {
  totalProgress: '',
  todaysLogs: [],
  dayLog: '',
  statistics: '',
  stepLogs: '',
}

// getters
const getters = {
  todaysLogs (state) {
    return state.todaysLogs;
  },
  dayLog (state) {
    return state.dayLog;
  },
  statistics (state) {
    return state.statistics;
  },
  stepLogs (state) {
    return state.stepLogs;
  }

}

// actions
const actions = {

  getStatistics({ commit }) {
    commit(types.START_LOADING);
    axios.get('/app/logs/stats')
      .then((response) => {
        commit(types.STOP_LOADING);

        let tempStats = [];

        for (var variable in response.data) {
          if (response.data.hasOwnProperty(variable)) {
            let temp = 0;
            for (var i = 0; i < response.data[variable].length; i++) {
              temp += parseInt(response.data[variable][i].weight);
            }
            tempStats.push(temp);
          }
        }

        commit(types.RECEIVE_STATS, tempStats);

      });

  },

  getTodaysLogs({ commit }, stepId) {
    commit(types.RECEIVE_TODAYS_LOGS, {});
    commit(types.START_LOADING);

    axios.post('/app/logs/today', { id: stepId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.RECEIVE_TODAYS_LOGS, response.data);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'There was a problem todays log entries. Try reloading.');
      });
  },

  addNewLog({ commit, rootState }, log) {
    commit(types.START_LOADING);
    log.program_id = rootState.main.settings.selected_program;
    axios.post('/app/logs/save', log)
      .then(response => {
        commit(types.STOP_LOADING);
        log.id = response.data;
        commit(types.ADD_NEW_LOG, log);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'There was a problem todays log entries. Try reloading.');
      });
  },

  removeLog({ commit }, logId) {
    commit(types.START_LOADING);
    axios.post('/app/logs/remove', { id: logId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.REMOVE_LOG, logId);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Cannot delete log. Try reloading.');
      });
  },

  getDayLogs({ commit }, dayId) {
    commit(types.RECEIVE_DAY_LOG, {});
    commit(types.START_LOADING);
    axios.post('/app/logs/day', { day_id: dayId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.RECEIVE_DAY_LOG, response.data);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Cannot get todays log. Try reloading.');
      });
  },

  getStepLogs({ commit, dispatch }, stepId) {
    commit(types.RECEIVE_STEP_LOGS, {});
    commit(types.START_LOADING);
    axios.post('/app/logs/step', { step_id: stepId })
      .then(response => {
        commit(types.STOP_LOADING);
        commit(types.RECEIVE_STEP_LOGS, response.data);
      })
      .catch(err => {
        commit(types.STOP_LOADING);
        commit(types.ERROR_TEXT, 'Cannot get this step logs. Try reloading.');
      });
  },

}

// mutations
const mutations = {

  [types.RECEIVE_STEP_LOGS] (state, stepLogs) {
    state.stepLogs = stepLogs;
  },

  [types.RECEIVE_STATS] (state, statsData) {
    state.statistics = statsData;
  },

  [types.RECEIVE_DAY_LOG] (state, dayLogs) {
    state.dayLog = dayLogs;
  },

  [types.RECEIVE_TODAYS_LOGS] (state, logs) {
    state.todaysLogs = logs;
  },

  [types.ADD_NEW_LOG] (state, log) {
    state.todaysLogs.push(log);
  },

  [types.REMOVE_LOG] (state, logId) {
    if (state.todaysLogs.length) {
      for (var i = 0; i < state.todaysLogs.length; i++) {
        if (state.todaysLogs[i].id == logId) {
          state.todaysLogs.splice(i, 1);
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
