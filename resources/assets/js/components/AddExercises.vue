<template lang="html">
<div class="modal-padding">
  <div class="uk-modal-header uk-position-top">
      <!-- <h2 class="uk-modal-title">Add new exercise</h2> -->
      <form class="uk-search uk-search-navbar">
         <span uk-search-icon></span>
         <input class="uk-search-input" type="search" placeholder="Search..." v-model="searchQ">
      </form>
  </div>

  <ul class="uk-list uk-list-striped" v-if="step == 1">
    <li v-for="(item, index) in liste" :key="index + 'keys'" @click.prevent="selectCategory(item)">
      <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
                <img :src="item.image" width="50" height="50" alt="">
            </div>
            <div class="uk-width-expand">
                <span class="uk-h4">{{ item.title }}</span>

            </div>
        </div>
    </li>
  </ul>

  <ul id="exercisesAccordion" class="uk-list uk-list-striped" uk-accordion="collapsible: true;" v-if="step == 2">

    <li hidden>
      <div class="uk-accordion-title">
      </div>
      <div class="uk-accordion-content">
      </div>
    </li>

    <li v-for="(item, index) in liste" :key="index + 'key'">
      <div class="uk-accordion-title">
        <img :src="item.image" width="50" height="50" alt="">
        <span class="uk-h5">{{ item.title }}</span>
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
                     <input class="uk-input uk-form-width-medium uk-form-large" type="text" v-model="selected.sets">
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
                     <input class="uk-input uk-form-width-medium uk-form-large" type="text" v-model="selected.reps">
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




  <div class="uk-modal-footer uk-text-right uk-position-bottom">
    <button v-show="step == 2" @click.prevent="step = 1" class="uk-button uk-button-primary" type="button">Back to Categories</button>

      <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
  </div>
</div>
</template>

<script>
import Search from './Search';
export default {
  components: {
    Search,
  },
  data() {
    return {
      searchQ: '',
      selected: {
        sets: 0,
        reps: 0,
      },
      step: 1,
      liste: [],
      dataOne: [
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_2.png',
          title: 'Shoulder press',
        },
        {
          image: 'assets/exercise_thumbnail/arnold_press_1.png',
          title: 'Other',
        },
      ],

      dataTwo: [
        {
          image: 'assets/categories/abs.png',
          title: 'Abdominal',
        },
        {
          image: 'assets/categories/back.png',
          title: 'Back',
        },
        {
          image: 'assets/categories/abs.png',
          title: 'Abdominal',
        },
        {
          image: 'assets/categories/back.png',
          title: 'Back',
        },
        {
          image: 'assets/categories/abs.png',
          title: 'Abdominal',
        },
        {
          image: 'assets/categories/back.png',
          title: 'Back',
        },
        {
          image: 'assets/categories/abs.png',
          title: 'Abdominal',
        },
        {
          image: 'assets/categories/back.png',
          title: 'Back',
        },
        {
          image: 'assets/categories/abs.png',
          title: 'Abdominal',
        },
        {
          image: 'assets/categories/back.png',
          title: 'Back',
        },
        {
          image: 'assets/categories/abs.png',
          title: 'Abdominal',
        },
        {
          image: 'assets/categories/back.png',
          title: 'Back',
        },
      ],
    }
  },

  mounted() {
    this.liste = this.dataTwo;
  },

  watch: {
    'searchQ': 'searchMethod',
  },

  methods: {
    searchMethod() {
      if (this.searchQ.length == 0) {
        this.step = 1;
        this.liste = this.dataTwo;
      } else {
        this.step = 2;
        let newArray = this.dataOne.filter((item) => {
          return item.title.toLowerCase().includes(this.searchQ.toLowerCase());
        });
        this.liste = newArray;
      }

    },

    selectExercise(exercise) {
      let temp = {
        title: exercise.title,
        image: exercise.image,
        reps: this.selected.reps,
        sets: this.selected.sets,
      }

      UIkit.accordion('#exercisesAccordion').toggle();
    },

    selectCategory(category) {
      this.liste = this.dataOne;
      this.step = 2;

    },
  }

}
</script>

<style lang="css" scoped>
  .modal-padding {
    padding: 15% 0 15% 0;
  }
</style>
