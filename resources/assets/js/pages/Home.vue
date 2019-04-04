<template lang="html">
<div class="uk-container">


<StartWorkout></StartWorkout>
<ProgramDays class="uk-margin-bottom"></ProgramDays>
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
    </div>
</div>

</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Stats from '../components/Stats';
import StartWorkout from '../components/StartWorkout';
import ProgramDays from '../components/ProgramDays';
export default {

  components: {
    ProgramDays,
    Stats,
    StartWorkout,
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

    this.getCurrentProgram().then((currentProgram) => {
      for (var i = 0; i < currentProgram.days.length; i++) {
        if (currentProgram.days[i].week_days.includes(this.today) && currentProgram.days[i].steps.length > 0) {
          this.todaysWorkouts.push(currentProgram.days[i]);
        }
      }
    });

    this.today = moment().format("ddd").toLowerCase();
    this.getTotalProgress().then((totalProgress) => {
      this.statsReady = true;
      for (var variable in totalProgress) {
        let sum = 0;
        for (var i = 0; i < totalProgress[variable].length; i++) {
          // console.log(totalProgress[variable][i].weight);
          sum += parseInt(totalProgress[variable][i].weight);

        }
        totalProgress[variable].total = sum;
        this.progressData.push(sum);
      }

    });
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
