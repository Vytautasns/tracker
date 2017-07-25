<template lang="html">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom">
      <div class="uk-card uk-card-default uk-padding-small">
        <h3 class="uk-heading-bullet uk-text-left">
          <i @click="$router.go(-1)" class="ppp fa fa-chevron-left uk-text-primary uk-padding-small uk-position-top-right" aria-hidden="true"></i>

          <span>Workout programs</span>
        </h3>
        <ul class="uk-subnav" uk-margin>
            <li>
              <router-link to="/create/program" tag="a">
                <i class="fa fa-plus uk-text-primary" aria-hidden="true"></i>
                Create program
              </router-link>
            </li>
        </ul>
        <w-loading v-if="!loaded && !availableProgramsList.length"></w-loading>
        <div class="uk-grid-small uk-grid-match uk-child-width-1-2@m" uk-grid>
          <div v-for="program in availableProgramsList" :key="program.name">

            <div class="uk-box-shadow-hover-large uk-card" :class="program.id == settings.selected_program ? 'uk-card-primary' : 'uk-card-default'">
              <div class="uk-card-media-left uk-cover-container">
                  <img :src="`assets/programs/${program.image_url}.jpg`" alt="" uk-cover>
                  <div class="uk-position-bottom uk-overlay uk-overlay-primary" v-if="program.id == settings.selected_program ">
                      <p class="uk-h4 uk-margin-remove">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        Selected
                      </p>
                  </div>
                  <canvas width="300" height="200"></canvas>
              </div>
              <div>
                  <div class="uk-card-body uk-margin-large-bottom">
                    <span v-if="program.id != settings.selected_program"  @click.prevent.stop="deleteProgram(program.id)" class="uk-float-right" uk-icon="icon: trash;"></span>
                    <span @click="$router.push({ name: 'program-create', params: { program }})" class="uk-float-right uk-margin-small-right" uk-icon="icon: pencil;"></span>

                      <h3 class="uk-card-title">{{ program.name }}</h3>
                      <p>{{ program.description }}</p>
                  </div>
                   <button
                    class="uk-button uk-button-primary uk-margin-small-right uk-margin-small-bottom uk-position-bottom-right"
                    v-if="program.id != settings.selected_program"
                    @click="changeProgram(program)"
                    :disabled="appState.ajaxQueue > 0">
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
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {

  data() {
    return {
      loaded: false,
    }
  },

  mounted() {
    this.getAvailablePrograms().then(() => {
      this.loaded = true;
    });
  },


  computed: {
    ...mapGetters([
      'appState',
      'settings',
      'availableProgramsList',
    ]),

  },

  methods: {
    ...mapActions([
      'getAvailablePrograms',
      'changeSetting',
      'makeNotification',
      'removeProgram',
    ]),

    changeProgram(program) {
      this.changeSetting({
        name: 'selected_program',
        value: program.id,
      }).then(() => {
        this.makeNotification('Workout program changed!');
        this.$router.push('/');
      });
    },

    deleteProgram(programId) {
      let self = this;

      UIkit.modal.confirm(`
        <h3>Do you really want to delete this program?</h3>
        <p class="uk-text-center"><i class="fa fa-warning fa-3x" aria-hidden="true"></i></p>
        <p>All related history, days and exercises will also be removed.</p>
        `).then(function() {
          self.removeProgram(programId).then(() => {
            self.$router.push('/programs');
          });
      });
    },

  },
}
</script>

<style lang="css">
</style>
