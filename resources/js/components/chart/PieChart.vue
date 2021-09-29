<script>
import { Pie } from 'vue-chartjs'

export default {
  extends: Pie,
  props: ['chartdata'],
  data:()=>({
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
    }),
  mounted () {
    this.renderChart(this.chartdata, this.options)
  }
}
</script>