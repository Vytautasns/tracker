<template lang="html">
<div class="uk-container">

  <h2 class="uk-heading-line uk-text-center uk-margin-top" v-if="dayLog"><span>Todays stats</span></h2>
  <div class="uk-section uk-section-muted uk-padding-small" v-if="dayLog">
    <div class="uk-container">
        <div class="uk-grid-match uk-child-width-1-2 uk-text-center" uk-grid>
            <div>
                <span>Workout volume:</span><strong> {{ dayLog.volume }} KG</strong>
            </div>
            <div>
                <span>Average exercise:</span><strong> {{ Math.round(dayLog.average) }} KG</strong>
            </div>
        </div>

    </div>
</div>


  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>{{ dayShown.name }}</span></h2>
  <ul class="uk-subnav" uk-margin>

      <li>
        <a @click="confirmDelete(dayShown.id)">
          <i class="fa fa-trash-o" aria-hidden="true"></i> Delete day
        </a>
      </li>

      <li>
        <a href="#add-exercise" uk-toggle>
          <i class="fa fa-plus" aria-hidden="true"></i> Add new exercise
        </a>
      </li>

  </ul>

  <p class="uk-position-center uk-text-lead uk-text-center uk-padding" v-if="!dayShown.steps.length">
    There is no exercises for this day.
    <a href="#add-exercise" class="uk-display-block" uk-toggle>Add new exercise</a>
  </p>

  <div class="uk-card uk-card-default">
    <ul class="uk-list uk-list-striped">
      <li class="ppp" @click="$router.push(`/days/${day}/step/${index}/${step.id}`)" v-for="(step, index) in dayShown.steps" :key="step.id">
        <div class="uk-grid-small uk-padding-small" uk-grid>
              <div class="uk-width-auto uk-background-contain" :style="`background-image: url(assets/exercise_thumbnail/${step.image_url}_1.png);`">
                <canvas width="60" height="60"></canvas>
              </div>
              <div class="uk-width-expand">
                  <span class="uk-h4">{{ step.name }}</span>
                  <span class="uk-display-block uk-text-meta">{{ step.sets }} x {{ step.reps }}</span>
                  <span @click.prevent.stop="deleteStep(step.id)" class="uk-float-right" uk-icon="icon: trash;"></span>
              </div>
          </div>
      </li>
    </ul>
  </div>




  <div id="add-exercise" uk-modal>
      <div class="uk-modal-dialog">
          <!-- <button class="uk-modal-close-default" type="button" uk-close></button> -->
          <div class="uk-modal-body uk-padding-remove" uk-overflow-auto>
            <AddExercises :dayId="day"></AddExercises>
          </div>
      </div>
  </div>

</div>
</template>

<script>
import AddExercises from '../../components/AddExercises';
import { mapGetters, mapActions } from 'vuex';

export default {
  components: { AddExercises },

  props: ['day'],

  created() {
      this.getDayById(this.day);
      this.getDayLogs(this.day);
  },

  computed: {
    ...mapGetters([
      'dayShown',
      'dayLog',
    ]),

  },

  methods: {
    ...mapActions([
      'getDayById',
      'removeDay',
      'removeStep',
      'getDayLogs',
    ]),

    confirmDelete(dayId) {
      let self = this;
      UIkit.modal.confirm(`
        <h3>Do you really want to delete this day?</h3>
        <p>All related history and exercises will also be removed.</p>
        `).then(function() {

        self.removeDay(dayId);
        self.$router.push('/');

      }, function () {


      });
    },

    deleteStep(stepId) {
      let self = this;
      UIkit.modal.confirm(`
        <h3>Do you really want to remove this exercise?</h3>
      `)
      .then(function() {
        self.removeStep(stepId);
        self.getDayLogs(self.day);
      });
    },
  },

}
</script>

<style lang="css">
</style>
