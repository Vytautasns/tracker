import Vuex from 'vuex';


export default new Vuex.Store({
  actions: {
    initApp({commit}) {
      axios.get('/api/exercises')
      .then((response) => {
        commit('set_app_state', response.data);
      })
      .catch((error) => {
        console.log(error);
      });
    },
  },

  getters: {
    mainState (state) {
      return state.main;
    }
  },

  mutations: {
    set_app_state(state, payload) {
      state.main = payload;
    }
  },


  modules: {

  },

  state: {
    main: '',
  }

})
