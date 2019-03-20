<template>
<v-card>
    <v-toolbar class="grey darken-2">
        <v-toolbar-title class=" white--text">Mobile Section</v-toolbar-title>
    </v-toolbar>
    <v-btn @click="vibrate">Vibrate</v-btn>
</v-card>
</template>

<script>
var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator

export default {
  name: 'Mobile.vue',
  data () {
    return {
      value: ''
    }
  },
  methods: {
    vibrate () {
      if (canVibrate && !('vibrate' in navigator)) {
        console.log('vibrate')
        navigator.vibrate = navigator.mozVibrate
      }
        console.log('vibrate2')

      navigator.vibrate(1000)
    }
  }
}
</script>

<style scoped>

</style>
