<template lang="html">
  <div class="uk-offcanvas-content">
      <Navigation></Navigation>
      <router-view></router-view>
  </div>
</template>

<script>
import Navigation from './components/Navigation';
import { mapGetters, mapActions } from 'vuex';

export default {

  components: { Navigation },

  data() {
    return {

    }
  },

  created() {
    this.fetchExercises();
  },

  computed: {
    ...mapGetters([
      'exercisesList',
    ]),

  },

  methods: {
    ...mapActions([
      'fetchExercises',
    ]),

  },


}
</script>

<style lang="css">
</style>
