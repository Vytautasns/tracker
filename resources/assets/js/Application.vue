<template lang="html">
  <div class="uk-offcanvas-content">
    <Navigation></Navigation>
    <div class="uk-alert-danger" uk-alert v-if="appState.errorMessage">
        <a class="uk-alert-close" uk-close></a>
        <p>{{ appState.errorMessage }}</p>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
import Navigation from './components/Navigation';
import FirstRun from './components/FirstRun';

import { mapGetters, mapActions } from 'vuex';

export default {

  components: { Navigation, FirstRun, },

  data() {
    return {
    }
  },

  created() {
    this.getUser();
  },

  mounted() {

  },

  computed: {
    ...mapGetters([
      'appState',
      'user',
    ]),

  },

  methods: {
    ...mapActions([
      'getUser'
    ]),




  },


}
</script>

<style lang="css">
</style>
