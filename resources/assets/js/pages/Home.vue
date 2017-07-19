<template lang="html">
<div class="uk-container">



  <div class="uk-margin-top"  v-if="currentProgram.days.length > 0">
    <div class="uk-card uk-card-default uk-card-body uk-padding-small">
      <div class="uk-grid-collapse" uk-grid>
        <div class="uk-text-center uk-margin-top uk-align-center" v-if="day.week_days.includes(today) && day.steps.length > 0" v-for="day in currentProgram.days" :key="day.name">
          <h2 class="uk-margin-remove"><span>{{ day.name }}</span></h2>
          <span class="uk-text-meta uk-display-block">Start workout</span>
          <i @click="$router.push(`days/${day.id}/step/0/${day.steps[0].id}`)" class="fa fa-play-circle fa-4x uk-text-primary" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="uk-margin-top">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
      <h3 @click="$router.push(`/programs`)" class="uk-heading-bullet uk-text-left uk-text-truncate ppp"><span>{{ currentProgram.name }}</span></h3>
      <ProgramDays></ProgramDays>
    </div>
  </div>

  <div class="uk-margin-top uk-margin-bottom">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
      <h3 class="uk-heading-bullet uk-text-left"><span>Progress</span></h3>
      <Stats></Stats>
    </div>
  </div>

</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Stats from '../components/Stats';
import ProgramDays from '../components/ProgramDays';
export default {

  components: {
    ProgramDays,
    Stats
   },

  data() {
    return {
      today: '',
    }
  },

  created() {
    this.getCurrentProgram();
    this.today = moment().format("ddd").toLowerCase();
  },

  computed: {
    ...mapGetters([
      'currentProgram',
    ]),
  },

  methods: {
    ...mapActions([
      'getCurrentProgram',
      'makeNotification',
    ]),
  },

}
</script>

<style lang="css">
</style>
