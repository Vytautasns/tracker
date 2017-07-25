<template lang="html">
  <div class="uk-container uk-margin-bottom">
    <div class="uk-margin-top">
      <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-remove">
        <div class="uk-padding-small">
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
        </div>
        <div class="uk-grid-small uk-child-width-1-3@m uk-padding-small uk-grid-match uk-padding-remove-top" uk-grid>
          <div class="ppp" @click="$router.push({ path: `category/${category.id}`})" v-for="category in categories" :key="category.id" v-if="!selectedCategory">
            <div class="uk-box-shadow-hover-large  uk-card uk-card-default uk-margin uk-padding-small">
                  <div class="uk-width-small uk-align-center">
                    <img :src="`${category.image_url}`" alt="category image">

                  </div>
                  <div class="uk-overlay uk-overlay-default uk-position-bottom">
                      <h3 class="uk-card-title">{{ category.name }}</h3>
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

  data() {
    return {
      selectedCategory: '',
    }
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
