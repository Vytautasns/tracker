<template lang="html">
<div class="uk-container">
  <div class="uk-margin-top uk-margin-bottom">
    <div class="uk-card uk-card-default uk-padding-small">
      <h3 class="uk-heading-bullet uk-text-left"><span>Create a new program</span></h3>
      <div class="uk-card uk-card-default">
        <div class="uk-card-body">

          <form class="uk-form-stacked">
              <div class="uk-margin">
                  <label class="uk-form-label" for="form-program-name">Program name</label>
                  <div class="uk-form-controls">
                      <input class="uk-input" name="form-program-name" type="text" placeholder="Name" v-model="newProgram.name">
                  </div>
              </div>
<!-- 
              <div class="uk-margin">
                  <div uk-form-custom>

                      <button class="uk-button uk-button-default" type="button" disabled>
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        Upload program photo
                      </button>
                  </div>
              </div> -->

              <div class="uk-margin">
                <label class="uk-form-label" for="form-program-description">Program description</label>
                  <textarea class="uk-textarea" name="form-program-description" rows="5" placeholder="Description" v-model="newProgram.description"></textarea>
              </div>

              <button @click.prevent="performSave(newProgram)" class="uk-button uk-button-primary" :disabled="newProgram.name.length < 3">Save</button>



          </form>

        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import { mapActions } from 'vuex';

export default {

  data() {
    return {
      newProgram: {
        name: '',
        description: '',
      }
    }
  },


  methods: {
    ...mapActions([
      'saveNewPrgoram',
    ]),

    performSave(newProgram) {

      this.saveNewPrgoram(newProgram);
      this.$router.push('/programs');
    },

  }
}
</script>

<style lang="css">
</style>
