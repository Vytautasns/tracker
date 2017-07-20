<template lang="html">
  <div class="uk-container">
<div class="uk-grid-small uk-margin-top" uk-grid>

  <div class="uk-width-1-1">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
      <h3 class="uk-heading-bullet uk-text-left uk-text-truncate">
        
        <span>
          <strong>{{ parseInt(step)+1 }}</strong>/<small>{{ dayShown.steps.length }}</small> {{ dayShown.steps[step].name }}
        </span>
      </h3>
      <ul class="uk-subnav" uk-margin>
          <li>
            <a @click="$router.push(`/days/${dayShown.id}`)">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Exercises list
            </a>
          </li>
      </ul>
      <div class="uk-grid-collapse uk-child-width-1-3" uk-grid>
        <div class="uk-text-center uk-padding uk-text-primary">
          <i @click.prevent="goBackExercise" class="fa fa-angle-left fa-3x ppp" aria-hidden="true"></i>
        </div>
        <div class="uk-text-center ppp" uk-toggle="target: .toggle; mode: click">
          <img class="toggle" :src="`assets/exercise_image/${dayShown.steps[step].image_url}_1.png`" width="100" height="100" alt="">
          <img class="toggle" hidden :src="`assets/exercise_image/${dayShown.steps[step].image_url}_2.png`" width="100" height="100" alt="">
          <span class="uk-text-meta uk-display-block">Click to see movement!</span>
        </div>
        <div class="uk-text-center uk-padding uk-text-primary">
          <i @click.prevent="goNextExercise"  class="fa fa-angle-right fa-3x ppp" aria-hidden="true"></i>
        </div>
      </div>


    </div>
  </div>


  <div class="uk-width-1-2@m uk-width-1-1">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">



        <div v-if="todaysLogs.length < maxSets">
          <h3 class="uk-text-center">

            <span class="uk-display-block">
              Set
              <strong>
                <span v-if="todaysLogs.length == maxSets">{{ todaysLogs.length }}</span>
                <span v-else> {{ todaysLogs.length+1 }}</span>

              </strong>
                /
                <small>
                  {{ maxSets }}
                </small>
            </span>
          </h3>
        </div>
        <div class="uk-margin-small-bottom uk-text-center" v-else-if="todaysLogs.length >= maxSets">
          <i class="fa fa-check fa-4x uk-text-primary" aria-hidden="true"></i>
          <p>All sets done</p>
        </div>

      <!-- Weight log -->
      <div v-if="todaysLogs.length < maxSets">
        <div class="uk-child-width-1-3 uk-grid-collapse uk-grid-match uk-text-center" uk-grid>
            <div class="uk-width-1-1">
              <span>Weight</span>
            </div>

            <div class="">
              <button @click.prevent="selected.weight > 0 ? selected.weight-- : ''" class="uk-button uk-button-danger uk-button-large">-</button>
            </div>
            <div class="">
              <div class="uk-margin uk-inline">
                 <span class="uk-form-icon uk-form-icon-flip">KG</span>
                   <input class="uk-text-center uk-input uk-form-large" type="number" v-model.number="selected.weight">
               </div>
            </div>
            <div class="">
              <button id="incrementWeight" @click.prevent="selected.weight++" class="uk-button uk-button-primary uk-button-large">+</button>
            </div>
        </div>

        <div class="uk-child-width-1-3 uk-grid-match uk-text-center uk-grid-collapse uk-margin-top" uk-grid>
            <div class="uk-width-1-1">
              <span>Reps</span>
            </div>
            <div class="">
              <button @click.prevent="selected.reps > 0 ? selected.reps-- : ''" class="uk-button uk-button-danger uk-button-large">-</button>
            </div>
            <div class="">
              <div class="uk-margin">
                   <input class="uk-text-center uk-input uk-form-large" type="number" v-model.number="selected.reps">
               </div>
            </div>
            <div class="">
              <button @click.prevent="selected.reps++" class="uk-button uk-button-primary uk-button-large">+</button>
            </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="uk-margin-small-top">

        <button v-if="todaysLogs.length >= maxSets" @click="maxSets = todaysLogs.length+1" class="uk-button uk-width-1-1 uk-button-default uk-margin-small-bottom">
          <i class="fa fa-plus" aria-hidden="true"></i>
          Set
        </button>

        <button @click="logSet" class="uk-button uk-width-1-1 uk-button-primary" v-if="todaysLogs.length < maxSets">
          <i class="fa fa-check" aria-hidden="true"></i>
          <span v-if="todaysLogs.length >= maxSets">Next exercise!</span>
          <span v-else> Log IT!</span>
        </button>

      </div>


    </div>
  </div>

  <div class="uk-width-1-2@m uk-width-1-1 uk-margin-bottom">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
      <h3 class="uk-heading-bullet uk-text-left"><span>Today's sets</span></h3>
      <div class="uk-overflow-auto" v-if="todaysLogs.length">
        <table class="uk-table uk-table-small uk-table-hover uk-table-divider">
          <thead>
              <tr>
                  <th class="uk-width-small">Set</th>
                  <th class="uk-width-small">Weight</th>
                  <th class="uk-width-small">Reps</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="(log, index) in todaysLogs">
                  <td>{{ index+1 }}</td>
                  <td>{{ log.weight }} KG</td>
                  <td>{{ log.reps }}</td>
                  <td>
                    <a @click="removeLog(log.id)" uk-icon="icon: trash"></a>
                  </td>
              </tr>
          </tbody>
      </table>
      </div>
      <div v-else>
        <p class="uk-text-center">
          <i class="fa fa-info fa-3x uk-text-primary uk-display-block" aria-hidden="true"></i>

          No logs
        </p>
      </div>


    </div>
  </div>
</div>



</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {

  props: ['day','step', 'stepId'],

  data() {
    return {
      selected: {
        weight: 0,
        reps: 0,
      },
      currentSet: 1,
      maxSets: 0,
    }
  },

  created() {
    this.getDayById(this.day);
    this.getTodaysLogs(this.stepId);
    this.updateLastWeight();
  },

  watch: {
    'dayShown': function () {
        this.selected.reps = this.dayShown.steps[this.step].reps;
        this.maxSets = this.dayShown.steps[this.step].sets;
    },
    '$route': 'updateLastWeight',
    'stepLogs': function () {
      if (this.stepLogs.weight) {
        this.selected.weight = this.stepLogs.weight;
      }
    },
  },

  computed: {
    ...mapGetters([
      'dayShown',
      'todaysLogs',
      'stepLogs'
    ]),
  },

  methods: {
    ...mapActions([
      'getDayById',
      'getTodaysLogs',
      'addNewLog',
      'removeLog',
      'getStepLogs'
    ]),

    updateLastWeight() {
      this.getStepLogs(this.stepId);
    },


    logSet() {
      let newLog = {
        step_id: this.stepId,
        weight: this.selected.weight,
        reps: this.selected.reps,
        set: this.todaysLogs.length+1,
        day_id: this.day,
      }

      if ((this.todaysLogs.length + 1) <= this.maxSets) {

        this.addNewLog(newLog);
        this.$store.dispatch('makeNotification', 'Exercise logged!');


      } else {

          this.$store.dispatch('makeNotification', 'Next exercise!');
          this.goNextExercise();

      }

    },


    goBackExercise() {
      let index = parseInt(this.step);
      if ((index - 1) >= 0) {
        this.$router.replace(`/days/${this.day}/step/${index-1}/${this.dayShown.steps[(index-1)].id}`);
        this.getTodaysLogs(this.dayShown.steps[(index-1)].id);
        this.selected.reps = this.dayShown.steps[this.step].reps;
        this.maxSets = this.dayShown.steps[this.step].sets;


      }
    },

    goNextExercise() {
      let index = parseInt(this.step);
      if ((index + 1) <= (this.dayShown.steps.length - 1)) {
        this.$router.replace(`/days/${this.day}/step/${index+1}/${this.dayShown.steps[(index+1)].id}`);
        this.getTodaysLogs(this.dayShown.steps[(index+1)].id);
        this.selected.reps = this.dayShown.steps[this.step].reps;
        this.maxSets = this.dayShown.steps[this.step].sets;

      }
    },

    startIncrement(number) {
      let self = this;
      console.log('started');
      this.interval = setInterval(function(){ number++ }, 30);
    },

    stopIncrement(number) {
      console.log('stopped');
      clearInterval(this.interval);
    },
  },
}
</script>

<style lang="css">
</style>
