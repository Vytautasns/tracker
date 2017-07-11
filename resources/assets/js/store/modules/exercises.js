import * as types from '../mutation-types'

// initial state
const state = {
  categories: '',

}

// getters
const getters = {
}

// actions
const actions = {

}

// mutations
const mutations = {
  [types.RECEIVE_CATEGORIES] (state, categories) {
    state.categories = categories;
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
