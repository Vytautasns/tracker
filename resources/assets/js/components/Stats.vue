<template lang="html">
  <div class="">
    <div v-show="points.data.length > 0" id="container" style="width:100%; height:400px;"></div>
    <div v-show="points.data.length <= 0" class="uk-text-center">
      <i class="fa fa-bar-chart-o uk-text-primary fa-3x" aria-hidden="true"></i>
      <h3>Not enough data</h3>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  data() {
    return {
      points: {
        name: 'Progress',
        data: [],
      },
    }
  },
  mounted() {
    this.getStatistics();



    Highcharts.chart('container', {

          title: {
              text: ''
          },

          subtitle: {
              text: 'Counted by total workouts volume by day'
          },

          yAxis: {
              title: {
                  text: 'Weight lifted'
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle'
          },

          plotOptions: {
              series: {
                  pointStart: 0
              }
          },

          series: [0,5,3,6]

      });

  },

  computed: {
    ...mapGetters([
      'statistics',
    ]),



  },

  methods: {
    ...mapActions([
      'getStatistics',
    ]),
  },

}
</script>

<style lang="css">
</style>
