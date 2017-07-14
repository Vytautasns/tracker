<template lang="html">
<div class="uk-container">
  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Browse exercises</span></h2>
  <ul class="uk-subnav" uk-margin>
      <li><a href="#">Create exercise</a></li>
  </ul>


  <div class="uk-card uk-card-default uk-grid-collapse uk-margin" uk-grid v-for="category in categories" :key="category.id" v-if="!selectedCategory">
      <div class="uk-width-1-6@s uk-text-center">
          <img :src="`${category.image_url}`" width="120" height="280" alt="">
      </div>
      <div class="uk-width-expand@s">
          <div class="uk-card-body">
              <h4 class="uk-card-title">{{ category.name }}</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <a @click="showExercises(category)" class="uk-button uk-button-primary">Show exercises</a>
          </div>
      </div>
  </div>

  <!-- <div class="uk-card uk-card-default" v-if="selectedCategory">
    <ul class="uk-list uk-list-striped">
      <li @click="checkDetails(exercise.id)" v-if="exercises" v-for="exercise in exercises" :key="exercise.id">
        <div class="uk-grid-small" uk-grid>
              <div class="uk-width-auto">
                  <img class="uk-icon-image" :src="`assets/exercise_thumbnail/${exercise.image_url}_1.png`" width="60" height="60" alt="">
              </div>
              <div class="uk-width-expand">
                  <span>{{ exercise.name }}</span>
              </div>
          </div>
      </li>
    </ul>
  </div> -->




</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {

  components: {
  },

  data() {
    return {
      selectedCategory: '',
    }
  },

  created() {
  },

  mounted() {

  },

  computed: {
    ...mapGetters([
      'categories',
    ]),

  },


  methods: {
    ...mapActions([
    ]),

    // getExercisesForCategory(category) {
    //
    //   this.selectedCategory = category;
    //
    //   this.getExercises(category.id);
    //
    // },

    showExercises(category) {

      this.$router.push({ path: `category/${category.id}`});
      // UIkit.modal('#exercises-list').toggle();

    },

  },

}
</script>

<style lang="css">
</style>
