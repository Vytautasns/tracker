<template lang="html">
    <div v-if="loaded">
      <div class="uk-card uk-card-default uk-card-body uk-padding-small uk-margin-top" v-if="todaysWorkout.length">
          <div class="uk-grid-divider uk-flex-center" uk-grid>
            <div class="uk-text-center" v-for="day in todaysWorkout" :key="day.name">
              <h2 class="uk-margin-remove"><span>{{ day.name }}</span></h2>
              <span class="uk-text-meta uk-display-block">Start workout</span>
              <i @click="$router.push(`days/${day.id}/step/0/${day.steps[0].id}`)" class="fa fa-play-circle fa-4x uk-text-primary" aria-hidden="true"></i>
            </div>
          </div>
      </div>
      <div v-if="!loaded">
        <w-loading></w-loading>
      </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  data() {
    return {
      loaded: false,
    }
  },

  created() {
    this.getTodaysWorkout().then(() => {
      this.loaded = true;
    });
  },

  computed: {
    ...mapGetters([
      'todaysWorkout',

    ]),

  },

  methods: {
    ...mapActions([
      'getTodaysWorkout',
    ]),

  },

}
</script>

<style lang="css">
</style>
