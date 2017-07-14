<template lang="html">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>{{ categories[category-1].name }}</span></h2>

    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>

        <div class="uk-width-auto@s uk-padding-small uk-text-center uk-box-shadow-small">
            <img :src="categories[category-1].image_url" width="120" height="280" alt="" class="uk-align-center uk-display-block">
            <button @click="$router.go(-1)" type="button" class="uk-button uk-button-default">
              <i class="fa fa-step-backward" aria-hidden="true"></i>
              Categories
            </button>
        </div>

        <div class="uk-width-expand@s ">
            <div class="uk-card-body uk-padding-remove">
                <ul class="uk-list uk-list-striped">
                  <li class="ppp" @click="$router.push(`/exercises/${exercise.id}`)" v-if="exercises" v-for="exercise in exercises" :key="exercise.id">
                    <div class="uk-grid-small uk-padding-small" uk-grid>
                          <div class="uk-width-auto uk-background-contain" :style="`background-image: url(assets/exercise_thumbnail/${exercise.image_url}_1.png);`">
                            <canvas width="60" height="60"></canvas>
                          </div>
                          <div class="uk-width-expand">
                              <span class="uk-h4">{{ exercise.name }}</span>
                          </div>
                      </div>
                  </li>
                </ul>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {

  props: ['category'],

  created() {
    this.getExercises(this.category);
  },

  mounted() {

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

<style lang="css">
  .image {
    height: 80px;
    width: 80px;
  }
</style>
