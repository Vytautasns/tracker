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
export default {
  data() {
    return {
      points: {
        name: 'Progress',
        data: [],
      },
    }
  },
  created() {

    axios.get('/app/logs/stats')
      .then((response) => {
        for (var variable in response.data) {
          if (response.data.hasOwnProperty(variable)) {
            let temp = 0;
            for (var i = 0; i < response.data[variable].length; i++) {
              temp += parseInt(response.data[variable][i].weight);
            }
            this.points.data.push(temp);

          }
        }


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
                    pointStart: response.data[0]
                }
            },

            series: [this.points]

        });

      });





  },
}
</script>

<style lang="css">
</style>
