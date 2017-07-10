<template lang="html">
<div class="uk-container">
  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Exercise categories</span></h2>
  <ul class="uk-subnav" uk-margin>
      <li><a href="#">Create exercise</a></li>
  </ul>


  <div :class="n == 99 ? 'uk-card-primary' : 'uk-card-default'" class="uk-card uk-grid-collapse uk-margin" uk-grid v-for="n in 5">
      <div class="uk-width-1-6@s uk-text-center">
          <img src="assets/categories/abs.png" width="120" height="280" alt="">
      </div>
      <div class="uk-width-expand@s">
          <div class="uk-card-body">
              <h4 @click="$router.push('/abs')" class="uk-card-title">Abdominals</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
              <a class="uk-button uk-button-primary" href="#modal-overflow" uk-toggle>Show exercises (35)</a>
          </div>
      </div>
  </div>




<div id="modal-overflow" uk-modal>
    <div class="uk-modal-dialog">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Abdominals</h2>
        </div>

        <div class="uk-modal-body uk-padding-remove" uk-overflow-auto>

          <ul class="uk-list uk-list-striped">
            <li v-for="n in 10">
              <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-auto">
                        <img src="assets/exercise_thumbnail/arnold_press_2.png" width="40" height="40" alt="">
                    </div>
                    <div class="uk-width-expand">
                        <span>exercises name</span>
                    </div>
                </div>
            </li>
          </ul>

        </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
        </div>

    </div>
</div>

</div>
</template>

<script>
export default {
}
</script>

<style lang="css">
</style>
