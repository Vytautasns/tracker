<template lang="html">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom">
      <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
        <h3 class="uk-heading-bullet uk-text-left">
          <span>Progress</span>
        </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi tempora, rem ipsa dolores quaerat. Suscipit illum, tenetur sequi fuga veritatis sunt dolorem beatae itaque, exercitationem, sit earum saepe numquam commodi.</p>
      </div>
    </div>
    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Program details</span></h2>
    <div class="uk-card-primary uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
            <img :src="programShown.image_url" alt="" uk-cover>
            <canvas width="300" height="200"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                <h3 class="uk-card-title">{{ programShown.name }}</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
        </div>
    </div>

    <ul class="uk-subnav" uk-margin>
        <li><a href="#">Edit info</a></li>
        <li><a href="#">Delete</a></li>

    </ul>

    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Workout days</span></h2>

    <ul class="uk-subnav" uk-margin>
        <li><a href="#">Add new day</a></li>
    </ul>
    <ul class="uk-list uk-list-striped">
      <li v-for="n in 5">
        <div class="uk-grid-small" uk-grid>
              <div class="uk-width-auto">
                <i class="fa fa-cloud-download fa-3x" aria-hidden="true"></i>
              </div>
              <div class="uk-width-expand">
                  <span class="uk-text-lead">Day nr. {{ n }}</span>
                  <span class="uk-float-right" uk-icon="icon: trash;"></span>

              </div>
          </div>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  props: ['program'],

  created() {
    if (!this.availableProgramsList) {
      this.getAvailablePrograms();
    }
  },

  computed: {
    ...mapGetters([
      'availableProgramsList'
    ]),

    programShown: function () {
      let result;
      for (var i = 0; i < this.availableProgramsList.length; i++) {
        if (this.availableProgramsList[i].id == this.program) {
          result = this.availableProgramsList[i];
        }
      }
      return result;
    },

  },

  methods: {
    ...mapActions([
      'getAvailablePrograms'
    ]),
  },
}
</script>

<style lang="css">
</style>
