<template lang="html">
  <div class="uk-container">

    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>{{ exerciseDetails.name }}</span></h2>
    <ul class="uk-subnav" uk-margin>
        <!-- <li><a href="#edit-exercise" uk-toggle>Edit</a></li>
        <li><a href="#delete-confirm" uk-toggle>Delete</a></li> -->

    </ul>
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
          <div class="uk-card-media-left uk-cover-container">
            <div class="uk-text-center" uk-toggle="target: .toggle; mode: click">
                    <img class="toggle" :src="`assets/exercise_image/${exerciseDetails.image_url}_1.png`" alt="">
                    <img class="toggle" hidden :src="`assets/exercise_image/${exerciseDetails.image_url}_2.png`" alt="">
            </div>
          </div>
          <div>
              <div class="uk-card-body">
                  <h3 class="uk-card-title">Details</h3>
                  <dl class="uk-description-list">
                      <dt>Description</dt>
                      <dd>{{ exerciseDetails.description }}</dd>
                  </dl>
              </div>
          </div>
      </div>

      <!-- <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>History log</span></h2>


      <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div class="uk-card-media-left uk-cover-container">
              <div class="uk-text-center">
                <img src="http://www.excel-easy.com/data-analysis/images/charts/line-chart.png" alt="">
              </div>
            </div>
            <div>
                <div class="uk-card-body">
                    <h3 class="uk-card-title">Statistics</h3>
                    <dl class="uk-description-list">
                        <dt>Description term</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</dd>
                        <dt>Description term</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                        <dt>Description term</dt>
                        <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                    </dl>
                </div>
            </div>
        </div> -->

        <div id="edit-exercise" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                  <h2 class="uk-modal-title">Edit exercise</h2>
                </div>
                <div class="uk-modal-body uk-padding-small">
                  <form>
                      <fieldset class="uk-fieldset">
                          <div class="uk-margin">
                              <input class="uk-input" type="text" placeholder="Day name">
                          </div>

                      </fieldset>
                  </form>
                </div>
                <div class="uk-modal-footer uk-text-right">
                  <button class="uk-button uk-button-primary uk-modal-close" type="button">Save</button>
                  <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
                </div>
            </div>
        </div>

        <div id="delete-confirm" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                  <h2 class="uk-modal-title">Delete this exercise?</h2>
                </div>
                <div class="uk-modal-body uk-padding-small">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="uk-modal-footer uk-text-right">
                  <button class="uk-button uk-button-danger uk-modal-close" type="button">Delete</button>
                  <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
                </div>
            </div>
        </div>

  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  props: ['exercise'],

  created() {
    this.getExerciseDetails(this.exercise);
  },

  mounted() {

  },

  computed: {
    ...mapGetters([
      'exerciseDetails',
    ]),

  },


  methods: {
    ...mapActions([
      'getExerciseDetails'
    ]),

  },
}
</script>

<style lang="css">
</style>
