<template lang="html">
  <div class="">
    <div id="container" v-show="dataSet.length > 0" style="width:100%; height:400px;"></div>
    <div v-show="dataSet.length <= 0" class="uk-text-center">
      <i class="fa fa-bar-chart-o uk-text-primary fa-3x" aria-hidden="true"></i>
      <h3>Not enough data</h3>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  props: ['dataSet', 'name', 'title', 'subtitle'],
  
  data() {
    return {

    }
  },
  mounted() {

    Highcharts.chart('container', {
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                enabled: false
              }
            }
          }]
          },

          title: {
              text: this.title,
          },

          subtitle: {
              text: this.subtitle,
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

          series: [
            {
              name: this.name,
              data: this.dataSet,
            },
          ]

      });

  },

  computed: {
    ...mapGetters([
    ]),



  },

  methods: {
    ...mapActions([
    ]),
  },

}
</script>

<style lang="css">
</style>
