<template>
    <span>
    <v-toolbar class="grey darken-2">
        <v-toolbar-title class=" white--text">Mobile Section</v-toolbar-title>
    </v-toolbar>
                <v-btn
                        color="primary"
                        dark
                        @click.stop="dialog = true"
                        @click="vibrate"
                >
        Vibrate
      </v-btn>
                <battery></battery>
                 <memory></memory>
                <network-speed></network-speed>
        <online-state></online-state>
        <geolocation></geolocation>
        <device-position></device-position>

        </span>
</template>

<script>
var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator

export default {
  name: 'Mobile.vue',
  data () {
    return {
      dialog: false,
      dialogMemory: false
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
