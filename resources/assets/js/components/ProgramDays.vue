<template lang="html">
<div>

      <ul class="uk-subnav" uk-margin>
          <li>
            <a @click="openAddDayModal">
              <i class="fa fa-plus uk-text-primary" aria-hidden="true"></i> Add new day
            </a>
          </li>
      </ul>
      <ul class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" v-if="currentProgram.days.length > 0" uk-grid>
          <li class="ppp" @click="$router.push(`days/${day.id}`)" v-for="day in currentProgram.days" :key="day.name">
              <div :class="day.week_days.includes(today) ? 'uk-card-primary' : 'uk-card-secondary'" class="uk-card uk-card-body uk-padding-small">
                  <span class="uk-display-block">{{ day.name }}</span>
                  <span class="uk-text-meta">{{ day.week_days }}</span>
                  <span @click.prevent.stop="confirmDelete(day.id)" class="uk-float-right" uk-icon="icon: trash;"></span>
                  <span @click.prevent.stop="editDay(day)" class="uk-float-right uk-margin-small-right" uk-icon="icon: pencil;"></span>
              </div>
          </li>
      </ul>
      <div class="uk-text-center" v-else>
        <i class="fa fa-info fa-3x uk-text-primary" aria-hidden="true"></i>
        <p>There is no workout days for this program.</p>
      </div>

  <div id="add-new-day" uk-modal>
      <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h2 class="uk-modal-title" v-if="!edit">Add new day</h2>
            <h2 class="uk-modal-title" v-else>Edit day</h2>
          </div>
          <div class="uk-modal-body uk-padding-small">
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
import Stats from '../components/Stats';
export default {
  components: { Stats },

  data() {
    return {
      edit: false,
      today: '',
      newDay: {
        name: '',
        week_days: [],
        id: '',
      },
    }
  },

  created() {
    this.getCurrentProgram();
    this.today = moment().format("ddd").toLowerCase();
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
      'updateDay',

    ]),

    openAddDayModal() {
      this.edit = false;
      this.newDay.name = '';
      this.newDay.week_days = [];
      UIkit.modal('#add-new-day').toggle();
    },

    editDay(day) {
      this.edit = true;
      this.newDay.name = day.name;
      this.newDay.week_days = day.week_days.split(',');
      this.newDay.id = day.id;
      UIkit.modal('#add-new-day').toggle();
    },

    saveNewDay() {

      let day = {
        name: this.newDay.name,
        program_id: this.currentProgram.id,
        week_days: this.newDay.week_days,
        id: this.newDay.id,
      }

      if (!this.edit) {
        this.addDay(day);
      } else {
        day.week_days = day.week_days.join(',');
        this.updateDay(day);
      }

      this.newDay = {
        name: '',
        week_days: [],
        id: '',
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
