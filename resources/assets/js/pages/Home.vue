<template lang="html">
<div class="uk-container">
  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Current program</span></h2>
  <div class="uk-card-primary uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
      <div class="uk-card-media-left uk-cover-container">
          <img src="http://cdn-mf0.heartyhosting.com/sites/mensfitness.com/files/chairdip_5.jpg" alt="" uk-cover>
          <canvas width="300" height="200"></canvas>
      </div>
      <div>
          <div class="uk-card-body">
              <h3 class="uk-card-title">{{ currentProgram.name }}</h3>
              <p>{{ currentProgram.description }}</p>
          </div>
      </div>
  </div>
  <ul class="uk-subnav" uk-margin>
      <li><a @click="$router.push('/programs')">Change</a></li>
  </ul>


  <!-- <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Todays workout</span></h2>
  <div class="uk-card uk-card-default uk-card-body uk-width-auto" v-if="currentProgram.days">
      <h3 class="uk-card-title">{{ currentProgram.days[0].name }}</h3>
      <p><span uk-icon="icon: check"></span> {{ currentProgram.days[0].steps_count }} Exercises</p>
      <button @click="$router.push(`days/${currentProgram.days[0].id}`)" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">Go to workout</button>
  </div> -->
<!-- 
  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Program days</span></h2>
  <ul class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
      <li @click="$router.push(`days/${day.id}`)" v-for="day in currentProgram.days" :key="day.name">
          <div class="uk-card uk-card-default uk-card-body uk-padding-small">
              <span class="uk-sortable-handle uk-margin-small-right"></span>{{ day.name }}
              <span @click.prevent.stop="confirmDelete(day.id)" class="uk-float-right" uk-icon="icon: trash;"></span>
          </div>
      </li>
  </ul>
  <ul class="uk-subnav" uk-margin>
      <li><a href="#add-new-day" uk-toggle>Add new</a></li>
  </ul> -->


  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Total progress</span></h2>
  <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-margin-bottom">
      <div class="uk-card-badge uk-label">Badge</div>
      <h3 class="uk-card-title">Title</h3>
      <img src="http://www.excel-easy.com/data-analysis/images/charts/line-chart.png" alt="">

  </div>


  <div id="add-new-day" uk-modal>
      <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h2 class="uk-modal-title">Add new day</h2>
          </div>
          <div class="uk-modal-body uk-padding-small">

            <!-- <form> -->
                <fieldset class="uk-fieldset">


                    <div class="uk-margin">
                        <input class="uk-input" type="text" placeholder="Day name" v-model="newDay.name" required>
                    </div>


                    <div class="uk-margin uk-grid-small uk-child-width-1-3@s uk-child-width-1-2" uk-grid>
                        <label><input value="mon" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Monday</label>
                        <label><input value="tue" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Tuesday</label>
                        <label><input value="wed" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Wednesday</label>
                        <label><input value="thu" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Thursday</label>
                        <label><input value="fri" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Friday</label>
                        <label><input value="sat" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Saturday</label>
                        <label><input value="sun" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Sunday</label>


                    </div>

                </fieldset>
            <!-- </form> -->

          </div>
          <div class="uk-modal-footer uk-text-right">
            <button @click.prevent="saveNewDay"  class="uk-button uk-modal-close" :class="newDay.name ? 'uk-button-primary' : 'uk-button-primary, uk-disabled'" type="button">Save</button>
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
      edit: true,
      newDay: {
        name: '',
        week_days: [],
      },
    }
  },

  created() {
    this.getCurrentProgram();
  },

  computed: {
    ...mapGetters([
      'currentProgram',
    ]),

  },

  methods: {
    ...mapActions([
      'getCurrentProgram',
      'makeNotification',
      'addDay',
      'removeDay',

    ]),

    saveNewDay() {

      let day = {
        name: this.newDay.name,
        program_id: this.currentProgram.id,
        week_days: this.newDay.week_days,
      }

      this.addDay(day);

      this.newDay = {
        name: '',
        week_days: [],
      }

    },

    confirmDelete(dayId) {
      let self = this;
      UIkit.modal.confirm(`
        <h3>Do you really want to delete this day?</h3>
        <p>All related history and exercises will also be removed.</p>
        `).then(function() {

        self.removeDay(dayId);

      }, function () {


      });
    },

  },


}
</script>

<style lang="css">
</style>
