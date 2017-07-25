<template lang="html">
<div class="uk-container">
  <div class="uk-margin-top uk-margin-bottom">
    <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
      <h3 class="uk-heading-bullet uk-text-left">
        <i @click="$router.go(-1)" class="ppp fa fa-chevron-left uk-text-primary uk-padding-small uk-position-top-right" aria-hidden="true"></i>

        <span v-if="!exercise">Create new exercise</span>
        <span v-else="!exercise">Edit exercise</span>
      </h3>
      <form>
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
              <label for="exercise_name">Exercise name <em>*</em></label>
              <input class="uk-input" name="exercise_name" type="text" placeholder="Eg.: Leg press" v-model="newExercise.name">
            </div>
            <div class="uk-margin">
              <label for="exercise_category">Category <em>*</em></label>
              <select class="uk-select" name="exercise_category" v-model="newExercise.category_id">
                <option value="99" selected disabled>Select category</option>
                <option :value="category.id" v-for="category in categories" :key="category.id">
                  {{ category.name }}
                </option>
              </select>
            </div>
            <div class="uk-margin">
              <label for="exercise_description">Description</label>
              <textarea class="uk-textarea" name="exercise_description" rows="5" placeholder="Exercise descprition (Optional)" v-model="newExercise.description">
              </textarea>
            </div>

            <div class="uk-margin">

              <button class="uk-button uk-button-primary"
                v-if="!exercise"
                @click.prevent="saveExercise"
                type="submit"
                :disabled="buttonEnabled">
                <i class="fa fa-save" aria-hidden="true"></i>
                Save
              </button>
              <button class="uk-button uk-button-primary"
                v-else
                @click.prevent="update"
                type="submit"
                :disabled="buttonEnabled">
                <i class="fa fa-save" aria-hidden="true"></i>
                Update
              </button>
            </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  props: ['exercise'],

  data() {
    return {
      newExercise: {
        name: '',
        description: '',
        category_id: '99',
      }
    }
  },

  mounted() {
    if (this.exercise) {
      this.newExercise = this.exercise;
    }
  },

  computed: {
    ...mapGetters([
      'categories',
      'appState',
    ]),

    buttonEnabled: function () {
      return this.newExercise.name.length < 3
          || this.newExercise.category_id == 99
          || this.appState.ajaxQueue.length > 0;
    },

  },


  methods: {
    ...mapActions([
      'storeExercise',
      'updateExercise',
    ]),

    saveExercise() {
      this.storeExercise(this.newExercise).then((id) => {
        this.$router.push(`/exercises/${id}`);
      });
    },

    update() {
      this.updateExercise(this.newExercise).then((id) => {
        this.$router.push(`/exercises/${id}`);
      });
    },

  },


}
</script>

<style lang="css">
</style>
