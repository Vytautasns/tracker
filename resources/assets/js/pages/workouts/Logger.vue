<template lang="html">
<div class="uk-container">
  <h3 class="uk-heading-line uk-text-center uk-margin-top">
    <span>
      <a href="" uk-slidenav-previous></a>
      Ex. <strong>2</strong>/<small>8</small> - Leg day
      <a href="" uk-slidenav-next></a>
    </span>
  </h3>
  <ul class="uk-subnav" uk-margin>
      <li><a href="#edit-exercise" uk-toggle>Edit</a></li>
      <li><a href="#delete-confirm" uk-toggle>Delete</a></li>
  </ul>
  <div class="uk-card uk-card-default uk-margin-remove uk-padding-small" uk-grid>

    <div class="uk-width-1-3@l uk-width-3-4 uk-padding-remove uk-padding-small@l">
        <div>
            <h3 class="uk-card-title uk-text-center">Today's sets</h3>
            <div class="uk-overflow-auto">
              <table class="uk-table uk-table-small uk-table-hover uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-width-small">Set</th>
                        <th class="uk-width-small">Weight</th>
                        <th class="uk-width-small">Reps</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="n in 5">
                        <td>{{ n }}</td>
                        <td>{{ n * 17 }}</td>
                        <td>{{ n * 3 }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>


        <div class=" uk-width-1-3@l uk-width-1-4 uk-padding-remove">
          <!-- <h3 class="uk-card-title">Example</h3> -->

          <div class="uk-text-center" uk-toggle="target: .toggle; mode: click">
                  <img class="toggle" src="assets/exercise_image/biceps_curl_v_sit_on_dome_with_dumbbells_1.png" alt="">
                  <img class="toggle" hidden src="assets/exercise_image/biceps_curl_v_sit_on_dome_with_dumbbells_2.png" alt="">
          </div>
        </div>


        <div class="uk-width-1-3@l uk-width-1-1 uk-padding-remove">
            <div class="">
              <h3 class="uk-text-center">
                <span>
                  <a href="" uk-slidenav-previous></a>
                  Set <strong>2</strong>/<small>3</small> - Squats
                  <a href="" uk-slidenav-next></a>
                </span>
              </h3>
                <div class="uk-child-width-1-3 uk-grid-collapse uk-grid-match uk-text-center" uk-grid>
                    <div class="uk-width-1-1">
                      <span>Weight</span>
                    </div>

                    <div class="">
                      <button @click.prevent="selected.sets > 0 ? selected.sets -= 2.5 : ''" class="uk-button uk-button-danger uk-button-large">-</button>
                    </div>
                    <div class="">
                      <div class="uk-margin uk-inline">
                         <span class="uk-form-icon uk-form-icon-flip">KG</span>
                           <input class="uk-text-center uk-input uk-width-1-1 uk-form-large" type="number" v-model="selected.sets">
                       </div>
                    </div>
                    <div class="">
                      <button @click.prevent="selected.sets += 2.5" class="uk-button uk-button-primary uk-button-large">+</button>
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
                           <input class="uk-text-center uk-input uk-width-1-1 uk-form-large" type="number" v-model="selected.reps">
                       </div>
                    </div>
                    <div class="">
                      <button @click.prevent="selected.reps++" class="uk-button uk-button-primary uk-button-large">+</button>
                    </div>
                </div>

                <div class="uk-grid-small" uk-grid>
                  <div class="uk-width-1-2">
                    <button @click="toast" class="uk-width-1-1 uk-button uk-button-default" disabled>
                      <i class="fa fa-plus" aria-hidden="true"></i>
                      Set
                    </button>
                  </div>

                  <div class="uk-width-expand">
                    <button @click.prevent="selectExercise(item)" class="uk-button uk-button-primary uk-width-1-1">
                      <i class="fa fa-check" aria-hidden="true"></i>
                      Log
                    </button>
                  </div>
                </div>

            </div>
        </div>
    </div>


    <h2 class="uk-heading-line uk-text-center uk-margin-top"><span>History log</span></h2>


    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
          <div class="uk-card-media-left uk-cover-container">
            <div class="uk-text-center" uk-toggle="target: .toggle; mode: click">
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
      </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      selected: {
        sets: 0,
        reps: 0,
      },
      step: 1,
    }
  },

  methods: {
    toast() {
      UIkit.notification({
          message: 'New set added!',
          status: 'primary',
          pos: 'top-center',
          timeout: 2000,
      });
    },
  }

}
</script>

<style lang="css">
</style>
