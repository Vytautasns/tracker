<template lang="html">
<div class="uk-container">
  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Leg day</span></h2>
  <ul class="uk-subnav" uk-margin>
      <li><a href="#delete-confirm" uk-toggle>Delete day</a></li>
  </ul>
  <ul class="uk-list uk-list-striped">
    <li v-for="n in 5">
      <div class="uk-grid-small" uk-grid>
            <div class="uk-width-auto">
                <img src="assets/exercise_thumbnail/arnold_press_2.png" width="50" height="50" alt="">
            </div>
            <div class="uk-width-expand">
                <span class="uk-text-lead">Shoulder press</span>
                <span class="uk-float-right" uk-icon="icon: trash;"></span>

            </div>
        </div>
    </li>

    <li>
      <div class="uk-grid-small" uk-grid>
            <!-- <div class="uk-width-auto">
                <img src="assets/exercise_thumbnail/arnold_press_2.png" alt="">
            </div> -->
            <div class="uk-width-expand">
              <a class="uk-button uk-button-primary uk-width-1-1 uk-margin-remove" href="#modal-overflow" uk-toggle>Add new exercise</a>

            </div>
        </div>
    </li>
  </ul>


  <div id="modal-overflow" uk-modal>
      <div class="uk-modal-dialog">

          <button class="uk-modal-close-default" type="button" uk-close></button>



          <div class="uk-modal-body uk-padding-remove" uk-overflow-auto>

            <!-- <ul class="uk-list uk-list-striped">
              <li v-for="n in 25">
                <div class="uk-grid-small" uk-grid>
                      <div class="uk-width-auto">
                          <img src="assets/exercise_thumbnail/arnold_press_2.png" width="50" height="50" alt="">
                      </div>
                      <div class="uk-width-expand">
                          <span class="uk-text-lead">Shoulder press</span>

                      </div>
                  </div>
              </li>
            </ul> -->
            <AddExercises></AddExercises>

          </div>



      </div>
  </div>

  <div id="delete-confirm" uk-modal>
      <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h2 class="uk-modal-title">Delete this workout day?</h2>
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
import AddExercises from '../../components/AddExercises';
export default {
  components: { AddExercises },
}
</script>

<style lang="css">
</style>
