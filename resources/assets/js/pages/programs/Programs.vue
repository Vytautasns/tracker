<template lang="html">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Workout programs</span></h2>
    <ul class="uk-subnav" uk-margin>
        <li><router-link to="/create/program" tag="a">Create program</router-link></li>
    </ul>
    <div :class="program.id == settings.selected_program ? 'uk-card-primary' : 'uk-card-default'" class="uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid v-for="program in availableProgramsList" :key="program.id">
        <div class="uk-card-media-left uk-cover-container">
            <img :src="program.image_url" alt="" uk-cover>
            <div class="uk-position-bottom uk-overlay uk-overlay-primary" v-if="program.id == settings.selected_program ">
                <p class="uk-h4 uk-margin-remove">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  Selected
                </p>
            </div>
            <canvas width="300" height="200"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
              <span @click.prevent.stop="deleteProgram(program.id)" class="uk-float-right" uk-icon="icon: trash;"></span>
                <h3 class="uk-card-title">{{ program.name }}</h3>
                <p>{{ program.description }}</p>
            </div>
            <div class="uk-card-footer">
               <button @click="changeProgram(program)" class="uk-button uk-button-default uk-width-1-1 uk-margin-bottom" v-if="program.id != settings.selected_program ">
                 <i class="fa fa-star" aria-hidden="true"></i>
                 Select program
               </button>
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

  mounted() {
    this.getAvailablePrograms();
  },


  computed: {
    ...mapGetters([
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
      });
      this.makeNotification('Workout program changed!');
      this.$router.push('/');

    },

    deleteProgram(programId) {
      let self = this;
      UIkit.modal.confirm(`
        <h3>Do you really want to delete this program?</h3>
        <p class="uk-text-center"><i class="fa fa-warning fa-3x" aria-hidden="true"></i></p>
        <p>All related history, days and exercises will also be removed.</p>
        `).then(function() {

        self.removeProgram(programId);
        self.$router.push('/programs');

      }, function () {


      });
    },

  },
}
</script>

<style lang="css">
</style>
