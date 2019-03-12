<template>
    <canvas id="canvas" ref="canvas" width="400" height="400" style="background-color: #333"></canvas>
</template>

<script>
export default {
  name: 'Clock',
  data () {
    return {
      // value: ''
    }
  },
  methods: {
    drawClock () {
      console.log('drawclock')
      let context = this.canvas.getContext('2d')
      console.log('drawclock context ' + context)
      let radius = this.canvas.height / 2
      console.log('drawclock radius ' + radius)
      radius = 0 * 90
      context.translate(radius, radius)
      context.arc(0, 0, radius, 0, 2 * Math.PI)
      context.fillStyle = 'white'
      context.fill()
    }

  },
  mounted () {
    'refs '
    console.log(this.$refs)
    this.canvas = this.$refs.canvas
    this.drawClock()
  }

}
</script>

<!--<style scoped>-->

<!--</style>-->
