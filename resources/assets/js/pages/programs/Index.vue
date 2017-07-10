<template lang="html">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Workout programs</span></h2>
    <ul class="uk-subnav" uk-margin>
        <li><a href="#">Create program</a></li>
    </ul>
    <div :class="n == 2 ? 'uk-card-primary' : 'uk-card-default'" class="uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid v-for="n in 5">
        <div class="uk-card-media-left uk-cover-container">
            <img src="http://cdn-mf0.heartyhosting.com/sites/mensfitness.com/files/chairdip_5.jpg" alt="" uk-cover>
            <div class="uk-position-bottom uk-overlay uk-overlay-primary" v-if="n == 2">
                <p class="uk-h4 uk-margin-remove">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  Selected
                </p>
            </div>
            <canvas width="300" height="200"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                <h3 class="uk-card-title">6 weeks abs</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
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
