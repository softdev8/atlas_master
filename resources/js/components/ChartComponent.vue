<template>
    <div class="chart">
        <div class="title">
            {{title}}
        </div>
        <doughnut-chart-component
                :chartData="chartData"
                :options="options">
        </doughnut-chart-component>
        <div class="items">
            <ul>
                <li v-for="(rectangle, index) in rectangles">
                    <span class="rectangle"
                          :style="{ background: rectangle }">
                    </span>
                    <span class="label">
                        {{items[index].label}}
                    </span>
                    <span>
                        {{items[index].value}}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
  import DoughnutChartComponent from "./DoughnutChartComponent";

  import colors from "../utils/colors";

  export default {
    components: {
      DoughnutChartComponent
    },
    props: {
      title: {
        type: String,
        required: true
      },
      items: {
        type: Array,
        required: true
      }
    },
    computed: {
      rectangles: function () {
        return this.chartData.datasets[0].backgroundColor;
      }
    },
    data() {
      return {
        chartData: {
          datasets: [{
            data: [],
            backgroundColor: [],
            hoverBackgroundColor: [],
            borderWidth: 0
          }]
        },
        options: {
          legend: {
            display: false
          },
          tooltips: {
            enabled: false
          }
        }
      }
    },
    created() {
      for (let i = 0; i < this.items.length; i++) {
        this.chartData.datasets[0].data.push(this.items[i].value);
        this.chartData.datasets[0].backgroundColor.push(colors[i]);
        this.chartData.datasets[0].hoverBackgroundColor.push(colors[i]);
      }
    },
    mounted() {
    },
    updated() {
    },
    methods: {}
  }
</script>