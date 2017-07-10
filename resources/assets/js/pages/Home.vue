<template lang="html">
<div class="uk-container">
  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Current program</span></h2>
  <div class="uk-card-primary uk-card uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
      <div class="uk-card-media-left uk-cover-container">
          <img src="http://cdn-mf0.heartyhosting.com/sites/mensfitness.com/files/chairdip_5.jpg" alt="" uk-cover>
          <canvas width="300" height="200"></canvas>
      </div>
      <div>
          <div class="uk-card-body">
              <h3 class="uk-card-title">6 weeks abs</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
          </div>
      </div>
  </div>
  <ul class="uk-subnav" uk-margin>
      <li><a @click="$router.push('/programs')">Change</a></li>
  </ul>


  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Todays workout</span></h2>
  <div class="uk-card uk-card-default uk-card-body uk-width-auto">
      <h3 class="uk-card-title">Koju diena</h3>
      <p><span uk-icon="icon: check"></span> 3 Exercises</p>
      <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">Go to workout</button>

  </div>

  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Program days</span></h2>
  <ul class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
      <li v-for="n in 5" :key="n">
          <div class="uk-card uk-card-default uk-card-body uk-padding-small">
              <span class="uk-sortable-handle uk-margin-small-right"></span>Day {{ n }}
              <span class="uk-float-right" uk-icon="icon: trash;"></span>
          </div>
      </li>
  </ul>
  <ul class="uk-subnav" uk-margin>
      <li><a href="#modal-overflow" uk-toggle>Add new</a></li>
  </ul>


  <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>Total progress</span></h2>
  <div class="uk-card uk-card-default uk-card-body uk-width-auto uk-margin-bottom">
      <div class="uk-card-badge uk-label">Badge</div>
      <h3 class="uk-card-title">Title</h3>
      <img src="http://www.excel-easy.com/data-analysis/images/charts/line-chart.png" alt="">

  </div>


  <div id="modal-overflow" uk-modal>
      <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h2 class="uk-modal-title">Add new day</h2>
          </div>
          <div class="uk-modal-body uk-padding-small">

            <form>
                <fieldset class="uk-fieldset">


                    <div class="uk-margin">
                        <input class="uk-input" type="text" placeholder="Day name">
                    </div>


                    <div class="uk-margin uk-grid-small uk-child-width-1-3@s uk-child-width-1-2" uk-grid>
                        <label><input class="uk-checkbox" type="checkbox" checked> Monday</label>
                        <label><input class="uk-checkbox" type="checkbox"> Tuesday</label>
                        <label><input class="uk-checkbox" type="checkbox"> Wednesday</label>
                        <label><input class="uk-checkbox" type="checkbox"> Thursday</label>
                        <label><input class="uk-checkbox" type="checkbox"> Friday</label>
                        <label><input class="uk-checkbox" type="checkbox"> Saturday</label>
                        <label><input class="uk-checkbox" type="checkbox"> Sunday</label>


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

</div>
</template>

<script>
export default {

  data() {
    return {
      edit: true,
    }
  },

  mounted() {

  },
}
</script>

<style lang="css">
</style>
