<template lang="html">
  <div class="modal-padding">

    <div class="uk-modal-header uk-position-top uk-box-shadow-medium uk-padding-remove">
      <nav class="uk-navbar-container uk-margin" uk-dark uk-navbar>

          <div class="nav-overlay uk-navbar-left">


              <span class="uk-navbar-item" v-if="step == 2">
                <a @click.prevent="step = 1" uk-icon="icon: chevron-left"></a>
              </span>
              <span class="uk-navbar-item" v-else>Choose category</span>


          </div>

          <div class="nav-overlay uk-navbar-right">

              <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
              <a class="uk-navbar-toggle uk-modal-close" uk-close href="#"></a>


          </div>

          <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>

              <div class="uk-navbar-item uk-width-expand">
                  <form class="uk-search uk-search-navbar uk-width-1-1">
                      <input class="uk-search-input" type="search" placeholder="Search..." v-model="searchQ" autofocus>
                  </form>
              </div>

              <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#" @click="searchQ = ''"></a>

          </div>

      </nav>
    </div>

<!-- Search results -->



<!-- Categories -->

    <ul class="uk-list uk-list-striped" v-if="step === 1">
      <li class="ppp" @click.prevent="selectCategory(category.id)" v-for="(category, index) in categories" :key="category.name">
        <div class="uk-grid-small" uk-grid>
              <div class="uk-width-auto">
                  <img :src="category.image_url" width="50" height="50" alt="">
              </div>
              <div class="uk-width-expand">
                  <span class="uk-h4">{{ category.name }}</span>

              </div>
          </div>
      </li>
    </ul>



  <!-- Exercises -->

    <ul id="exercisesAccordion" class="uk-list uk-list-striped" uk-accordion="collapsible: true;">

      <li hidden>
        <div class="uk-accordion-title">
        </div>
        <div class="uk-accordion-content">
        </div>
      </li>

      <li class="ppp" v-for="(item, index) in exercises" :key="index + 'key'" v-if="step == 2">

        <div class="uk-grid-small uk-padding-small uk-accordion-title" uk-grid>
              <div class="uk-width-auto uk-background-contain" :style="`background-image: url(assets/exercise_thumbnail/${item.image_url}_1.png);`">
                <canvas width="60" height="60"></canvas>
              </div>
              <div class="uk-width-expand">
                  <span class="uk-h5">{{ item.name }}</span>
              </div>
          </div>

        <div class="uk-accordion-content">
          <div class="uk-container">
            <div class="uk-child-width-1-3 uk-grid-match uk-text-center uk-grid-collapse" uk-grid>
                <div class="uk-width-1-1">
                  <span>Sets</span>
                </div>

                <div class="">
                  <button @click.prevent="selected.sets > 1 ? selected.sets-- : ''" class="uk-button uk-button-danger uk-button-large">-</button>
                </div>
                <div class="">
                  <div class="uk-margin">
                       <input class="uk-input uk-form-width-medium uk-form-large uk-text-center" type="text" v-model="selected.sets">
                   </div>
                </div>
                <div class="">
                  <button @click.prevent="selected.sets++" class="uk-button uk-button-primary uk-button-large">+</button>
                </div>
            </div>

            <div class="uk-child-width-1-3 uk-grid-match uk-text-center uk-grid-collapse uk-margin-top" uk-grid>
                <div class="uk-width-1-1">
                  <span>Reps</span>
                </div>
                <div class="">
                  <button @click.prevent="selected.reps > 1 ? selected.reps-- : ''" class="uk-button uk-button-danger uk-button-large">-</button>
                </div>
                <div class="">
                  <div class="uk-margin">
                       <input class="uk-input uk-form-width-medium uk-form-large uk-text-center" type="text" v-model="selected.reps">
                   </div>
                </div>
                <div class="">
                  <button @click.prevent="selected.reps++" class="uk-button uk-button-primary uk-button-large">+</button>
                </div>
            </div>
            <button @click.prevent="selectExercise(item)" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom uk-margin-top">Add exercise</button>
          </div>
        </div>
      </li>

      <div class="uk-align-center uk-margin-top uk-text-center" v-if="!searchResults.length && step == 3">
        <div uk-spinner v-if="searching"></div>
        <h2 class="uk-h2 uk-display-block" v-if="searching">Searching...</h2>
        <h2 class="uk-h2 uk-display-block" v-else>No results...</h2>

      </div>



      <li class="ppp" v-for="(item, index) in searchResults" :key="index + 'key'" v-if="step == 3">



        <div class="uk-grid-small uk-padding-small uk-accordion-title" uk-grid>
              <div class="uk-width-auto uk-background-contain" :style="`background-image: url(assets/exercise_thumbnail/${item.image_url}_1.png);`">
                <canvas width="60" height="60"></canvas>
              </div>
              <div class="uk-width-expand">
                  <span class="uk-h5">{{ item.name }} {{item.id}}</span>
              </div>
          </div>

        <div class="uk-accordion-content">
          <div class="uk-container">
            <div class="uk-child-width-1-3 uk-grid-match uk-text-center uk-grid-collapse" uk-grid>
                <div class="uk-width-1-1">
                  <span>Sets</span>
                </div>

                <div class="">
                  <button @click.prevent="selected.sets > 0 ? selected.sets-- : ''" class="uk-button uk-button-danger uk-button-large">-</button>
                </div>
                <div class="">
                  <div class="uk-margin">
                       <input class="uk-input uk-form-width-medium uk-form-large uk-text-center" type="text" v-model="selected.sets">
                   </div>
                </div>
                <div class="">
                  <button @click.prevent="selected.sets++" class="uk-button uk-button-primary uk-button-large">+</button>
                </div>
            </div>

            <div class="uk-child-width-1-3 uk-grid-match uk-text-center uk-grid-collapse uk-margin-top" uk-grid>
                <div class="uk-width-1-1">
                  <span>Reps</span>
                </div>
                <div class="">
                  <button @click.prevent="selected.reps > 0 ? selected.reps-- : ''" class="uk-button uk-button-danger uk-button-large">-</button>
                </div>
                <div class="">
                  <div class="uk-margin">
                       <input class="uk-input uk-form-width-medium uk-form-large uk-text-center" type="text" v-model="selected.reps">
                   </div>
                </div>
                <div class="">
                  <button @click.prevent="selected.reps++" class="uk-button uk-button-primary uk-button-large">+</button>
                </div>
            </div>
            <button @click.prevent="selectExercise(item)" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom uk-margin-top">Add exercise</button>
          </div>
        </div>
      </li>

  </ul>



<!-- Buttons -->

    <!-- <div class="uk-grid-collapse uk-child-width-1-1@m uk-position-bottom" uk-grid>
      <button type="button" class="uk-button uk-button uk-button-secondary uk-modal-close uk-text-center">
        <i class="fa fa-crosshairs" aria-hidden="true"></i>
        Close
      </button>
    </div> -->

  </div>

</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  props: ['dayId'],

  data() {
    return {
      searchQ: '',
      searchResults: '',
      searching: false,
      step: 1,
      selected: {
        sets: 1,
        reps: 1,
      },
      stepsToCommit: [],
    }
  },

  mounted() {
    UIkit.accordion('#exercisesAccordion');
  },

  watch: {
    'searchQ': 'performSearch'
  },

  computed: {
    ...mapGetters([
      'categories',
      'exercises',
    ]),

  },

  methods: {
    ...mapActions([
      'getExercises',
      'makeNotification',
      'addStep',
    ]),

    selectCategory(categoryId) {
      this.step = 2;
      this.getExercises(categoryId);
    },

    selectExercise(exercise) {
        this.addStep({
          name: exercise.name,
          image_url: exercise.image_url,
          day_id: this.dayId,
          exercise_id: exercise.id,
          reps: this.selected.reps,
          sets: this.selected.sets,
        })
        this.makeNotification('Exercise added.')
        UIkit.accordion('#exercisesAccordion').toggle();
      },

      performSearch() {
        let self = this;
        if (this.searchQ.length < 1) {
          this.step = 1;
        } else if (this.searchQ.length > 2) {
          this.searching = true;
          this.step = 3;

          axios.get(`/app/exercises/search/${this.searchQ}`)
          .then((response) => {
              self.searchResults = response.data;
              self.searching = false;
          })
          .catch((err) => {
            console.log(err);
          });

        }
      },

  },
}
</script>

<style lang="css" scoped>
.modal-padding {
  padding-top: 70px;
  padding-bottom: 35px;
}
</style>
