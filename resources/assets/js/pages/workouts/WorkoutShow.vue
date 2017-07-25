<template lang="html">
<div class="uk-container" v-if="loaded">
  <div class="uk-margin-top uk-margin-bottom">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-remove">
      <div class="uk-padding-small">
        <h3 class="uk-heading-bullet uk-text-left">
          <i @click="$router.go(-1)" class="ppp fa fa-chevron-left uk-text-primary uk-padding-small uk-position-top-right" aria-hidden="true"></i>
          <span>{{ dayShown.name }}</span>
        </h3>
        <ul class="uk-subnav" uk-margin>
            <li>
              <a @click="confirmDelete(dayShown.id)">
                <i class="fa fa-trash-o uk-text-primary" aria-hidden="true"></i> Delete day
              </a>
            </li>
            <li>
              <a href="#add-exercise" uk-toggle>
                <i class="fa fa-plus uk-text-primary" aria-hidden="true"></i> Add new exercise
              </a>
            </li>
        </ul>
      </div>
      <div class="uk-grid-small uk-child-width-1-2@m uk-padding-small uk-grid-match uk-padding-remove-top" uk-grid v-if="dayShown.steps.length > 0">
        <div class="ppp" @click="$router.push(`/days/${day}/step/${index}/${step.id}`)" v-for="(step, index) in dayShown.steps" :key="step.id">
          <div class="uk-box-shadow-hover-large uk-card uk-card-default uk-grid-collapse uk-child-width-1-2 uk-margin uk-padding-small" uk-grid>
                <div class="uk-width-auto uk-background-contain uk-margin-right" :style="`background-image: url(assets/exercise_thumbnail/${step.image_url}_1.png);`">
                  <canvas width="60" height="60"></canvas>
                </div>
                <div class="uk-width-expand">
                    <span class="uk-h4">{{ step.name }}</span>
                    <span class="uk-display-block uk-text-meta">{{ step.sets }} x {{ step.reps }}</span>
                    <span @click.prevent.stop="deleteStep(step.id)" class="uk-position-bottom-right uk-padding-small" uk-icon="icon: trash;"></span>
                </div>
            </div>
        </div>
      </div>
      <div class="uk-text-center" v-else>
        <i class="fa fa-info fa-3x uk-text-primary" aria-hidden="true"></i>
        <p>There is no exercises added.</p>
      </div>
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

  data() {
    return {
      loaded: false,
    }
  },

  created() {
      this.getDayById(this.day).then(() => {
        this.loaded = true;
      });
  },

  computed: {
    ...mapGetters([
      'dayShown',
    ]),

  },

  methods: {
    ...mapActions([
      'getDayById',
      'removeDay',
      'removeStep',
    ]),

    confirmDelete(dayId) {
      let self = this;
      UIkit.modal.confirm(`
        <h3>Do you really want to delete this day?</h3>
        <p>All related history and exercises will also be removed.</p>
        `).then(function() {

        self.removeDay(dayId).then(() => {
          self.$router.push('/');
        });

      });
    },

    deleteStep(stepId) {
      let self = this;
      UIkit.modal.confirm(`
        <h3>Do you really want to remove this exercise?</h3>
      `)
      .then(function() {
        self.removeStep(stepId);
      });
    },
  },

}
</script>

<style lang="css">
</style>
