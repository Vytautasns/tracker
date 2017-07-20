<template lang="html">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom">
      <div class="uk-card uk-card-default uk-padding-remove">
        <h3 class="uk-heading-bullet uk-text-left uk-padding-small">
          <i @click="$router.go(-1)" class="ppp fa fa-chevron-left uk-text-primary uk-padding-small uk-position-top-right" aria-hidden="true"></i>
          <span>{{ categories[category-1].name }}</span>
        </h3>
        <img :src="categories[category-1].image_url" width="120" height="280" alt="" class="uk-align-center uk-display-block">
        <div class="uk-card-default uk-padding-small uk-align-center uk-text-center" uk-sticky="top: 100; animation: uk-animation-slide-top; cls-active:sticky-back;">
          <button @click="$router.go(-1)" type="button" class="uk-button uk-button-secondary uk-margin-remove">
            <i class="fa fa-step-backward" aria-hidden="true"></i>
            Categories
          </button>
        </div>
        <div class="uk-grid-small uk-child-width-2-3@m uk-padding-small uk-grid-match uk-padding-remove-top uk-margin-top" uk-grid>
          <div @click="$router.push(`/exercises/${exercise.id}`)" class="uk-box-shadow-hover-large ppp" v-if="exercises" v-for="exercise in exercises" :key="exercise.id">
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2 uk-margin uk-padding-small" uk-grid>
              <div class="uk-width-auto uk-background-contain uk-margin-right" :style="`background-image: url(assets/exercise_thumbnail/${exercise.image_url}_1.png);`">
                <canvas width="60" height="60"></canvas>
              </div>
              <div class="uk-width-expand">
                <span class="uk-h4">{{ exercise.name }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  mapGetters,
  mapActions
} from 'vuex';
export default {

  props: ['category'],

  created() {},

  mounted() {
    this.getExercises(this.category);
  },

  computed: {
    ...mapGetters([
      'exercises',
      'categories',
    ]),

  },


  methods: {
    ...mapActions([
      'getExercises',
    ]),

  },
}
</script>

<style lang="css" scoped>
.image {
  height: 80px;
  width: 80px;
}

.sticky-back {
  z-index: 1;
}
</style>
