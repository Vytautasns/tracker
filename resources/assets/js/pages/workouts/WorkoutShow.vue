<template lang="html">
<div class="uk-container">

  <div class="uk-margin-top">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-remove">
      <div class="uk-padding-small">
        <h3 class="uk-heading-bullet uk-text-left"><span>{{ dayShown.name }}</span></h3>
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
      </div>
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
  </div>

  <div id="add-exercise" uk-modal>
      <div class="uk-modal-dialog">
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
