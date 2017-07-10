import Vuex from 'vuex';


export default new Vuex.Store({
  actions: {
    fetchExercises({commit}) {
      axios.get('/api/exercises')
      .then((response) => {
        commit('set_exercises', response.data);
      })
      .catch((error) => {
        console.log(error);
      });
    },
  },

  getters: {
    exercisesList (state) {
      return state.exercises;
    }
  },

  mutations: {
    set_exercises(state, payload) {
      state.exercises = payload;
    }
  },


  modules: {

  },

  state: {
    exercises: '',
  }

})
