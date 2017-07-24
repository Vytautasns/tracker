<template lang="html">
<div class="uk-container">


  <div class="uk-margin-top"  v-if="todaysWorkouts.length > 0">
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
      <Stats
        subtitle="Your workout volume progress"
        name="Progress"
        :dataSet="progressData"
        v-if="statsReady"
        >
        </Stats>
        <!-- <div v-else class="uk-text-center">
          <i class="fa fa-bar-chart-o uk-text-primary fa-3x" aria-hidden="true"></i>
          <h3>Not enough data</h3>
        </div> -->
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
      todaysWorkouts: [],
      progressData: [],
      statsReady: false,
    }
  },

  created() {

    // this.getCurrentProgram().then((currentProgram) => {
    //   for (var i = 0; i < currentProgram.days.length; i++) {
    //     if (currentProgram.days[i].week_days.includes(this.today) && currentProgram.days[i].steps.length > 0) {
    //       this.todaysWorkouts.push(currentProgram.days[i]);
    //     }
    //   }
    // });
    //
    // this.today = moment().format("ddd").toLowerCase();
    // this.getTotalProgress().then((totalProgress) => {
    //   this.statsReady = true;
    //   for (var variable in totalProgress) {
    //     let sum = 0;
    //     for (var i = 0; i < totalProgress[variable].length; i++) {
    //       // console.log(totalProgress[variable][i].weight);
    //       sum += parseInt(totalProgress[variable][i].weight);
    //
    //     }
    //     totalProgress[variable].total = sum;
    //     this.progressData.push(sum);
    //   }
    //
    // });
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
      'getTotalProgress',
    ]),
  },

}
</script>

<style lang="css">
</style>
