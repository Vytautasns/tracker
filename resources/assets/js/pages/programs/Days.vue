<template lang="html">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Summer body program</span></h2>
    <div class="uk-card-primary uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
            <img src="http://cdn-mf0.heartyhosting.com/sites/mensfitness.com/files/chairdip_5.jpg" alt="" uk-cover>
            <canvas width="300" height="200"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                <h3 class="uk-card-title">Summer body</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
        </div>
    </div>

    <ul class="uk-subnav" uk-margin>
        <li><a href="#">Edit info</a></li>
        <li><a href="#">Delete</a></li>

    </ul>

    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Workout days</span></h2>

    <ul class="uk-subnav" uk-margin>
        <li><a href="#">Add new day</a></li>
    </ul>
    <ul class="uk-list uk-list-striped">
      <li v-for="n in 5">
        <div class="uk-grid-small" uk-grid>
              <div class="uk-width-auto">
                <i class="fa fa-cloud-download fa-3x" aria-hidden="true"></i>
                  <!-- <img src="assets/exercise_thumbnail/arnold_press_2.png" width="50" height="50" alt=""> -->
              </div>
              <div class="uk-width-expand">
                  <span class="uk-text-lead">Day nr. {{ n }}</span>
                  <span class="uk-float-right" uk-icon="icon: trash;"></span>

              </div>
          </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
}
</script>

<style lang="css">
</style>
