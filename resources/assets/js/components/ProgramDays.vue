<template lang="html">
  <div class="uk-card uk-card-default uk-card-body uk-padding-small uk-margin-top" v-if="loaded">
    <h3 @click="$router.push(`/programs`)" class="uk-heading-bullet uk-text-left uk-text-truncate ppp"><span>{{ currentProgram.name }}</span></h3>
    <ul class="uk-subnav" uk-margin>
        <li>
          <a href="#add-new-day" uk-toggle>
            <i class="fa fa-plus uk-text-primary" aria-hidden="true"></i> Add new day
          </a>
        </li>
    </ul>
    <div v-if="allDays.length > 0">
      <div class="uk-grid-match uk-grid-small" uk-grid>
        <div class="ppp uk-width-1-2@s uk-margin-small-bottom" @click="$router.push(`days/${day.id}`)" v-for="day in allDays" :key="day.id">
          <div class="uk-box-shadow-hover-large uk-card uk-card-default uk-padding-small">
                <div class="uk-width-1-1">
                    <span class="uk-h4" :class="day.week_days.includes(today) ? 'uk-text-primary' : ''">
                      <i class="fa fa-star uk-text-primary" aria-hidden="true" v-if="day.week_days.includes(today)"></i>
                      {{ day.name }}
                    </span>
                    <span class="uk-display-block uk-text-meta">{{ day.week_days }}</span>
                    <span @click.prevent.stop="confirmRemove(day)" class="uk-position-bottom-right uk-padding-small" uk-icon="icon: trash;"></span>
                    <span @click.prevent.stop="editDay(day)" class="uk-position-top-right uk-padding-small" uk-icon="icon: pencil;"></span>

                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="uk-text-center" v-else>
      <i class="fa fa-info-circle fa-3x uk-text-primary" aria-hidden="true"></i>
      <h3 class="uk-margin-remove">There is no days for this program</h3>
    </div>

    <div v-if="!loaded">
      <w-loading></w-loading>
    </div>

    <div id="add-new-day" uk-modal>
        <div class="uk-modal-dialog">
            <div class="uk-modal-header uk-padding-small">
              <h2 class="uk-modal-title">
                <i class="fa fa-plus-square-o uk-text-primary" aria-hidden="true"></i>
                Add new day
              </h2>
              <!-- <h2 class="uk-modal-title" v-if="!edit">Add new day</h2>
              <h2 class="uk-modal-title" v-else>Edit day</h2> -->
            </div>
            <div class="uk-modal-body uk-padding-small">
              <span class="uk-text-lead">Name of workout day</span>
              <div class="uk-margin uk-margin-remove-top">
                  <input class="uk-input uk-form-large" type="text" placeholder="Day name" v-model="newDay.name" required autofocus>
              </div>
                  <fieldset class="uk-fieldset">
                    <span class="uk-text-lead">Choose week days</span>
                      <div class="uk-animation-toggle uk-tile uk-tile-muted uk-padding-small">
                        <!-- <div @click="checkDay(day)" v-for="day in daysList" :key="day.name" class="uk-grid-small uk-text-left uk-flex" uk-grid>

                          <i class="fa fa-square fa-2x uk-text-primary" aria-hidden="true" v-if="!day.checked"></i>
                          <i class="fa fa-check-square fa-2x uk-text-success" aria-hidden="true" v-else></i>

                          <span class="ppp uk-text-lead">{{ day.name }}</span>
                        </div> -->
                        <div class="uk-margin uk-grid-small uk-child-width-1-3@s uk-child-width-1-2" uk-grid>
                            <label><input value="mon" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Monday</label>
                            <label><input value="tue" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Tuesday</label>
                            <label><input value="wed" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Wednesday</label>
                            <label><input value="thu" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Thursday</label>
                            <label><input value="fri" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Friday</label>
                            <label><input value="sat" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Saturday</label>
                            <label><input value="sun" class="uk-checkbox" type="checkbox" v-model="newDay.week_days"> Sunday</label>
                        </div>
                      </div>
                  </fieldset>
            </div>
            <div class="uk-modal-footer uk-text-right">
              <button
               @click.prevent="saveNewDay"
               class="uk-modal-close uk-button uk-button-primary" type="button"
               :disabled="validate">
               <i class="fa fa-save" aria-hidden="true"></i>
               Save
              </button>
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
      loaded: false,
      edit: false,
      newDay: {
        name: '',
        week_days: [],
      },
      daysList: [
        { name: 'Monday', checked: false, index: null },
        { name: 'Tuesday', checked: false, index: null },
        { name: 'Wednesday', checked: false, index: null },
        { name: 'Thursday', checked: false, index: null },
        { name: 'Friday', checked: false, index: null },
        { name: 'Saturday', checked: false, index: null },
        { name: 'Sunday', checked: false, index: null }
      ],
    }
  },

  created() {
    this.getAllDays().then(() => {
      this.loaded = true;
    });
  },

  computed: {
    ...mapGetters([
      'allDays',
      'currentProgram',
    ]),

    today: function () {
      return moment().format("ddd").toLowerCase();
    },

    validate: function () {
      return this.newDay.name.length < 3;
    },

  },

  methods: {
    ...mapActions([
      'getAllDays',
      'addDay',
      'removeDay',
      'updateDay',
    ]),

    editDay(day) {
      UIkit.modal('#add-new-day').toggle();
      let editable = {
        id: day.id,
        name: day.name,
        week_days: day.week_days.length > 0 ? day.week_days.split(',') : [],
      }
      this.newDay = editable;

      this.edit = true;
    },

    checkDay(weekDay) {
      weekDay.checked = !weekDay.checked;
      if (weekDay.index === null) {
        let index = this.newDay.week_days.push(weekDay.name.slice(0,3).toLowerCase());
        weekDay.index = index - 1;
      } else {
        this.newDay.week_days.splice(weekDay.index, 1);
        weekDay.index = null;
      }
    },

    saveNewDay() {
      // Create this day
      let day = {
        name: this.newDay.name,
        program_id: this.currentProgram.id,
        week_days: this.newDay.week_days,
      }

      // Perform save
      if (this.edit) {
        this.updateDay(this.newDay);
      } else {
        this.addDay(day);
      }

      // Clear fields
      this.newDay = {
        name: '',
        week_days: [],
      }
      for (var i = 0; i < this.daysList.length; i++) {
        this.daysList[i].checked = false;
      }

      // Close modal
      UIkit.modal('#add-new-day').toggle();

    },

    confirmRemove(day) {
      let self = this;
      UIkit.modal.confirm(`
        <div class="uk-text-center">
          <h3>Do you really want to delete this day?</h3>
          <i class="fa fa-warning fa-3x uk-text-danger" aria-hidden="true"></i>
          <p>All related history and exercises will also be removed.</p>
        </div>
        `).then(function() {
          self.removeDay(day.id).then(() => {
            self.$router.push('/');
          });
      });
    },

  },

}
</script>

<style lang="css">

</style>
