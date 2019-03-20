<template>
    <span>
         <v-dialog
                 v-model="dialog"
                 max-width="290"
         >
        <v-card>
          <v-card-title class="headline justify-center">Red i velocitat de red</v-card-title>

          <v-card-text align="center">

              <p>
                Tipus red ~ <b id="networkType">unknown</b>
            </p>
              <p>
                Tipus red efectiva actual ~ <b id="effectiveNetworkType">unknown</b>

              </p>
              <p>
                Velocitat de baixada actual ~ <b id="downlinkMax">unknown</b>

              </p>
            </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
                    color="green darken-1"
                    flat="flat"
                    @click="dialog = false"
            >
              Dislike
            </v-btn>

            <v-btn
                    color="green darken-1"
                    flat="flat"
                    @click="dialog = false"
            >
              Like
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
         <v-btn
                 color="primary"
                 dark
                 @click.stop="dialog = true"
                 @click="networkAndSpeed"
         >
        Network And Speed
      </v-btn>
        </span>
</template>

<script>
// var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator

export default {
  name: 'NetworkAndSpeeed.vue',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    networkAndSpeed () {
      function getConnection () {
        return navigator.connection || navigator.mozConnection ||
          navigator.webkitConnection || navigator.msConnection
      }

      function updateNetworkInfo (info) {
        document.getElementById('networkType').innerHTML = info.type
        document.getElementById('effectiveNetworkType').innerHTML = info.effectiveType
        document.getElementById('downlinkMax').innerHTML = info.downlinkMax
      }

      var info = getConnection()
      if (info) {
        info.addEventListener('change', updateNetworkInfo)
        updateNetworkInfo(info)
      }
    }
  }
}
</script>

<style scoped>

</style>
