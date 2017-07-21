<template lang="html">
<div class="uk-container">
  <div class="uk-margin-top" uk-overflow-auto uk-height-viewport="offset-bottom: 36px; offset-top: 36px;">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
      <h3 class="uk-heading-bullet uk-text-left">
        <span>Welcome!</span>
        <i class="fa fa-smile-o uk-text-primary" aria-hidden="true"></i>
      </h3>
      <div class="uk-card-default uk-padding-small uk-margin-bottom">
        <p class="uk-margin-remove">
          <span class="uk-h5 uk-margin-remove uk-padding-remove">Beta 0.1</span>
          <p class="uk-text-meta uk-margin-remove uk-padding-remove">Thank you for registering. Please note that this web app is still in <strong>beta</strong> version.
          There might be some bugs. Please use <strong class="uk-text-uppercase">bug report</strong> option from menu.</p>
        </p>
      </div>

      <div class="uk-card-default uk-padding-small uk-margin-bottom">
        <p class="uk-margin-remove">
          <span class="uk-h5 uk-margin-remove uk-padding-remove">Your workout program</span>
          <p class="uk-text-meta uk-margin-remove uk-padding-remove">Here you can choose your starting workout program. Later you can <strong>change</strong>, <strong>edit</strong>, <strong>delete</strong> or <strong>create</strong> workout programs as you wish.</p>
        </p>
      </div>

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

  created() {
      this.getAvailablePrograms();
  },

  computed: {
    ...mapGetters([
      'availableProgramsList',
      'user',
      'settings',
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
      // this.makeNotification('Workout program changed!');
      location.reload();

    },
  },
}
</script>

<style lang="css">
</style>
