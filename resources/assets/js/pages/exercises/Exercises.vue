<template lang="html">
<div class="uk-container">
  <div class="uk-margin-top uk-margin-bottom">
    <div class="uk-card uk-card-default uk-padding-small">
      <h3 class="uk-heading-bullet uk-text-left">
        <i @click="$router.go(-1)" class="ppp fa fa-chevron-left uk-text-primary uk-padding-small uk-position-top-right" aria-hidden="true"></i>

        <span>Browse exercises</span>
      </h3>
      <ul class="uk-subnav" uk-margin>
          <li><a @click="$router.push(`create/exercise`)">
            <i class="fa fa-plus uk-text-primary" aria-hidden="true"></i>
            Create exercise
          </a></li>
      </ul>

      <div class="uk-grid-small uk-child-width-1-2@s uk-grid-match" uk-grid>
        <div @click="$router.push({ path: `category/${category.id}`})" class="uk-box-shadow-hover-large ppp" v-for="category in categories" :key="category.id" v-if="!selectedCategory">
          <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2 uk-margin uk-padding-small" uk-grid>
            <div class="uk-card-media-left uk-cover-container uk-text-center uk-padding-remove">
              <img :src="`${category.image_url}`" width="150" height="300" alt="">
            </div>
            <div>
              <div class="">
                <h3 class="uk-card-title">{{ category.name }}</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex';
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


}
</script>

<style lang="css">
</style>
