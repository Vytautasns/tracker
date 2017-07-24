<template lang="html">
  <div class="uk-container">
    <div class="uk-margin-top" uk-overflow-auto uk-height-viewport="offset-bottom: 36px; offset-top: 36px;">
      <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
        <h1 class="uk-heading-bullet uk-text-left">
          <span>Welcome!</span>
        </h1>
        <div class="uk-card-default uk-padding-small uk-margin-bottom">
          <p class="uk-margin-remove">
            <span class="uk-h4 uk-margin-remove uk-padding-remove">First program</span>
            <p class="uk-text-meta uk-margin-remove uk-padding-remove">Here you can choose your starting workout program. Later you can <strong>change</strong>, <strong>edit</strong>, <strong>delete</strong> or <strong>create</strong> workout programs as you wish.</p>
          </p>
        </div>
        <w-loading v-if="!loaded && !availableProgramsList.length"></w-loading>
        <div class="uk-grid-small uk-child-width-1-2@s" uk-grid>
          <div v-for="program in availableProgramsList" :key="program.name">
            <div class="uk-card-default">
              <div class="uk-card-media-left uk-cover-container">
                <img :src="`assets/programs/${program.image_url}.jpg`" alt="" uk-cover>
                <canvas width="300" height="200"></canvas>
              </div>
              <div>
                <div class="uk-card-body uk-margin-large-bottom">
                  <h3 class="uk-card-title">{{ program.name }}</h3>
                  <p>{{ program.description }}</p>
                </div>
                <div class="uk-card-footer">
                  <button @click="chooseProgram(program)" class="uk-button uk-button-primary uk-margin-small-right uk-margin-small-bottom">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    Select program
                  </button>
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
import Programs from '../programs/Programs';
import { mapGetters, mapActions } from 'vuex';

export default {
  components: { Programs, },

  data() {
    return {
      loaded: false,
    }
  },

  created() {
      this.getAvailablePrograms().then(() => {
        this.loaded = true;
      });
  },

  computed: {
    ...mapGetters([
      'availableProgramsList',
    ]),

  },

  methods: {
    ...mapActions([
      'getAvailablePrograms',
      'changeSetting',

    ]),

    chooseProgram(program) {
      this.changeSetting({
        name: 'selected_program',
        value: program.id,
      });
      this.changeSetting({
        name: 'first_login',
        value: 0,
      });
      location.reload();
    },

  },
}
</script>

<style lang="css">
</style>
