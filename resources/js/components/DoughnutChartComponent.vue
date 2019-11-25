<script>
  import {Doughnut} from "vue-chartjs";

  export default {
    extends: Doughnut,
    props: {
      chartData: {
        type: Object,
        required: true
      },
      options: {
        type: Object,
        required: true
      }
    },
    mounted() {
      this.renderChart(this.chartData, this.options);
    }
  }
</script>