<template lang="html">
<div class="uk-container">
  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Exercise categories</span></h2>
  <ul class="uk-subnav" uk-margin>
      <li><a href="#">Create exercise</a></li>
  </ul>


  <div class="uk-card uk-card-default uk-grid-collapse uk-margin" uk-grid v-for="category in mainState.categories" :key="category.id">
      <div class="uk-width-1-6@s uk-text-center">
          <img :src="`${category.image_url}`" width="120" height="280" alt="">
      </div>
      <div class="uk-width-expand@s">
          <div class="uk-card-body">
              <h4 class="uk-card-title">{{ category.name }}</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <a @click="showExercises(category)" class="uk-button uk-button-primary" href="#modal-overflow" uk-toggle>Show exercises</a>
          </div>
      </div>
  </div>





<div id="modal-overflow" uk-modal>
    <div class="uk-modal-dialog">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 class="uk-modal-title">{{ selectedCategory }}</h2>
        </div>
        <form class="uk-search uk-search-navbar">
           <span uk-search-icon></span>
           <input @keyup="searchMethod" class="uk-search-input" type="search" placeholder="Search..." v-model="searchQ">
        </form>

        <div class="uk-modal-body uk-padding-remove" uk-overflow-auto>

          <ul class="uk-list uk-list-striped">
            <li v-if="showCategoryExercises" v-for="exercise in showCategoryExercises" :key="exercise.id">
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

        </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
        </div>

    </div>
</div>

</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  data() {
    return {

    }
  },

  created() {

  },

  mounted() {

  },

  computed: {
    ...mapGetters([
    ]),

  },


  methods: {
    ...mapActions([
    ]),


  },

}
</script>

<style lang="css">
</style>
