<template lang="html">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom">
      <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-padding-small">
        <h3 class="uk-heading-bullet uk-text-left">
          <i @click="$router.go(-1)" class="ppp fa fa-chevron-left uk-text-primary uk-padding-small uk-position-top-right" aria-hidden="true"></i>

          <span v-if="!program">Create new program</span>
          <span v-else="!program">Edit program</span>
        </h3>
        <form>
          <fieldset class="uk-fieldset">
              <div class="uk-margin">
                <label for="program_name">Program name <em>*</em></label>
                <input class="uk-input" name="program_name" type="text" placeholder="Eg.: 6 week get fit" v-model="newProgram.name">
              </div>
              <div class="uk-margin">
                <label for="program_description">Description</label>
                <textarea class="uk-textarea" name="program_description" rows="5" placeholder="Program descprition (Optional)" v-model="newProgram.description">
                </textarea>
              </div>

              <div class="uk-margin">
                <button class="uk-button uk-button-primary"
                  v-if="!program"
                  @click.prevent="saveProgram"
                  type="submit"
                  :disabled="buttonEnabled">
                  <i class="fa fa-save" aria-hidden="true"></i>
                  Save
                </button>
                <button class="uk-button uk-button-primary"
                  v-else
                  @click.prevent="saveEdited"
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
import { mapActions, mapGetters } from 'vuex';

export default {

  props: ['program'],

  data() {
    return {
      newProgram: {
        name: '',
        description: '',
      }
    }
  },

  mounted() {
    if (this.program) {
      this.newProgram = this.program;
    }
  },

  computed: {
    ...mapGetters([
      'appState',
    ]),

    buttonEnabled: function () {
      return this.newProgram.name.length < 3 || this.newProgram.description.length < 3 || this.appState.ajaxQueue.length > 0;
    },
  },

  methods: {
    ...mapActions([
      'saveNewPrgoram',
      'updateProgram',
    ]),

    saveProgram() {
      this.saveNewPrgoram(this.newProgram)
        .then(() => {
          this.$router.push('/programs');
        });
    },

    saveEdited() {
      this.updateProgram(this.newProgram)
        .then(() => {
          this.$router.push('/programs');
        });
    },

  },
}
</script>

<style lang="css">
</style>
