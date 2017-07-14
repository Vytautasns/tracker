<template lang="html">
<div class="uk-container">

  <button @click="$router.go(-1)" class="uk-button uk-width-1-1 uk-button-default uk-margin-small-top">
    <i class="fa fa-arrow-left" aria-hidden="true"></i>
    Back to workout
  </button>

  <h3 class="uk-heading-line uk-text-center uk-margin-top">
    <span>
      <a @click.prevent="goBackExercise" uk-slidenav-previous></a>
      Ex. <strong>{{ parseInt(step)+1 }}</strong>/<small>{{ dayShown.steps.length }}</small> - {{ dayShown.name }}
      <a @click.prevent="goNextExercise" uk-slidenav-next></a>
    </span>
  </h3>

  <!-- <ul class="uk-subnav" uk-margin>
      <li><a href="#edit-exercise" uk-toggle>Edit</a></li>
      <li><a href="#delete-confirm" uk-toggle>Delete</a></li>
  </ul> -->


  <div class="uk-card uk-card-default uk-margin-remove uk-padding-small" uk-grid>


    <div class="uk-width-1-3@m uk-width-1-1 uk-padding-remove">

        <div class="uk-margin-small-bottom" v-if="todaysLogs.length < maxSets">
          <h3 class="uk-text-center">
            <span>
              {{ dayShown.steps[step].name }}
            </span>
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
        <div class="uk-margin-small-bottom uk-text-center" v-else>
          <i class="fa fa-check fa-3x uk-text-primary" aria-hidden="true"></i>
          <p>All sets done</p>
        </div>

        <!-- Weight log -->
        <div v-if="todaysLogs.length < maxSets">
          <div class="uk-child-width-1-3 uk-grid-collapse uk-grid-match uk-text-center" uk-grid>
              <div class="uk-width-1-1">
                <span>Weight</span>
              </div>

              <div class="">
                <button @click.prevent="selected.weight > 0 ? selected.weight++ : ''" class="uk-button uk-button-danger uk-button-large">-</button>
              </div>
              <div class="">
                <div class="uk-margin uk-inline">
                   <span class="uk-form-icon uk-form-icon-flip">KG</span>
                     <input class="uk-text-center uk-input uk-form-large" type="number" v-model.number="selected.weight">
                 </div>
              </div>
              <div class="">
                <button @click.prevent="selected.weight++" class="uk-button uk-button-primary uk-button-large">+</button>
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

          <button @click="logSet" class="uk-button uk-width-1-1 uk-button-primary">
            <i class="fa fa-check" aria-hidden="true"></i>
            <span v-if="todaysLogs.length >= maxSets">Next exercise!</span>
            <span v-else> Log IT!</span>
          </button>

        </div>

    </div>





    <div class="uk-width-1-3@m uk-width-1-1 uk-padding-small">
        <div class="">
            <h3 class="uk-card-title uk-text-center">Today's sets</h3>
            <div class="uk-overflow-auto">
              <table class="uk-table uk-table-small uk-table-hover uk-table-divider" v-if="todaysLogs.length">
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
            <div class="uk-text-center" v-else>
              <p>No logs</p>
            </div>
            </div>
        </div>
    </div>


        <div class=" uk-width-1-3@m uk-width-1-1 uk-padding-small">
          <!-- <h3 class="uk-card-title">Example</h3> -->

          <div class="uk-text-center" uk-toggle="target: .toggle; mode: click">
                  <img class="toggle" :src="`assets/exercise_image/${dayShown.steps[step].image_url}_1.png`" alt="">
                  <img class="toggle" hidden :src="`assets/exercise_image/${dayShown.steps[step].image_url}_2.png`" alt="">
          </div>
        </div>



    </div>


    <!-- <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>History log</span></h2>


    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
          <div class="uk-card-media-left uk-cover-container">
            <div class="uk-text-center" uk-toggle="target: .toggle; mode: click">
              <img src="http://www.excel-easy.com/data-analysis/images/charts/line-chart.png" alt="">
            </div>
          </div>
          <div>
              <div class="uk-card-body">
                  <h3 class="uk-card-title">Statistics</h3>
                  <dl class="uk-description-list">
                      <dt>Description term</dt>
                      <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</dd>
                      <dt>Description term</dt>
                      <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                      <dt>Description term</dt>
                      <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                  </dl>
              </div>
          </div>
      </div> -->
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
  },

  watch: {
    'dayShown': function () {
        this.selected.reps = this.dayShown.steps[this.step].reps;
        this.maxSets = this.dayShown.steps[this.step].sets;
    },
    'todaysLogs': function () {
      this.selected.weight = this.todaysLogs[this.todaysLogs.length-1].weight;
    },
  },

  computed: {
    ...mapGetters([
      'dayShown',
      'todaysLogs',
    ]),
  },

  methods: {
    ...mapActions([
      'getDayById',
      'getTodaysLogs',
      'addNewLog',
      'removeLog'
    ]),


    logSet() {
      // this.$store.dispatch('makeNotification', this.selected);
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
  },
}
</script>

<style lang="css">
</style>
