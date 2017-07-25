<template lang="html">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom">
      <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
        <h3 class="uk-heading-bullet uk-text-left">
          <i @click="$router.go(-1)" class="ppp fa fa-chevron-left uk-text-primary uk-padding-small uk-position-top-right" aria-hidden="true"></i>

          <span>{{ exerciseDetails.name }}</span>
        </h3>

        <ul class="uk-subnav" uk-margin v-if="exerciseDetails.default == 0">
          <li>
            <a @click="$router.push({ name: 'create-exercise', params: { exercise: exerciseDetails }})">
              <i class="fa fa-edit uk-text-primary" aria-hidden="true"></i>
              Edit
            </a>
          </li>
          <li>
            <a @click="deleteThis(exerciseDetails.id)">
              <i class="fa fa-trash-o uk-text-primary" aria-hidden="true"></i>
              Delete
            </a>
          </li>
        </ul>
        <w-loading v-if="!loaded || !exerciseDetails"></w-loading>
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid v-if="loaded">
          <div class="uk-card-media-left uk-cover-container">
            <div class="uk-text-center" uk-toggle="target: .toggle; mode: click;">
              <img class="toggle" :src="`assets/exercise_image/${exerciseDetails.image_url}_1.png`" alt="">
              <img class="toggle" hidden :src="`assets/exercise_image/${exerciseDetails.image_url}_2.png`" alt="">
              <span class="ppp uk-position-absolute uk-transform-center uk-text-meta uk-card-default" style="bottom: 5%; right: 5%;">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                Click to see movements
              </span>
            </div>
          </div>
          <div>
            <div class="uk-card-body uk-card-default">
              <h3 class="uk-card-title">Details</h3>
              <dl class="uk-description-list">
                <dt>Description</dt>
                <dd>
                  {{ exerciseDetails.description }}
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- 
    <div class="uk-margin-top uk-margin-bottom">
      <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
        <h3 class="uk-heading-bullet uk-text-left"><span>History</span></h3>
        <Stats
          subtitle="Weight history in all workouts"
          name="Progress"
          :dataSet="exerciseStats"
          v-if="statsReady">
          </Stats>
      </div>
    </div> -->

  </div>
</template>

<script>
import {
  mapGetters,
  mapActions
} from 'vuex';
import Stats from '../../components/Stats';
export default {
  data() {
    return {
      statsReady: false,
      loaded: false,
    }
  },
  components: {
    Stats,
  },

  props: ['exercise'],

  created() {
    this.getExerciseDetails(this.exercise).then(() => {
      this.loaded = true;
    });
    // this.getExerciseHistory(this.exercise).then(() => {
    //   this.statsReady = true;
    // });
  },

  mounted() {

  },

  computed: {
    ...mapGetters([
      'exerciseDetails',
      'exerciseStats',
    ]),

  },


  methods: {
    ...mapActions([
      'getExerciseDetails',
      'removeExercise',
      'getExerciseHistory',
    ]),

    deleteThis(id) {

      let template =
      `
      <h2 class="uk-modal-title">Delete this exercise?</h2>
      <p class="uk-text-center">
      <i class="fa fa-warning fa-3x uk-text-danger" aria-hidden="true"></i>
      </p>
      <p>Exercise will be deleted from exercises list.</p>
      <p>But all workouts will retain this exercise and it's history data.</p>
      `;

      UIkit.modal.confirm(template)
      .then(() => {
        this.removeExercise(id)
        .then(() => {
          this.$router.push('/exercises');
        });
      });
    },

  },
}
</script>

<style lang="css">
</style>
