<template>
    <span>
         <v-dialog
                 v-model="dialog"
                 max-width="290"
         >
        <v-card>
          <v-card-title class="headline justify-center">Geolocalització</v-card-title>

          <v-card-text align="center">
               <table class="table table-striped table-bordered">
                              <tr>
                                <td>Inclinacio Left/Right [gamma]</td>
                                <td id="doTiltLR"></td>
                              </tr>
                              <tr>
                                <td>Inclinacio Front/Back [beta]</td>
                                <td id="doTiltFB"></td>
                              </tr>
                              <tr>
                                <td> Direció [alpha]</td>
                                <td id="doDirection"></td>
                              </tr>
                        </table>

              <!--<v-layout id="logoContainer" class="container">-->

                          <img  src="/img/icons/android-chrome-144x144.png" id="imgLogo">
              <!--</v-layout>-->

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
                     @click="deviceOrientation"
             >
        Device Orientation
      </v-btn>
        </span>
</template>

<script>
// var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator

export default {
  name: 'DevicePosition.vue',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    deviceOrientation () {
      if ('DeviceOrientationEvent' in window) {
        window.addEventListener('deviceorientation', deviceOrientationHandler, false)
      } else {
        document.getElementById('logoContainer').innerText = 'Device Orientation API not supported.'
      }

      function deviceOrientationHandler (eventData) {
        var tiltLR = eventData.gamma
        var tiltFB = eventData.beta
        var dir = eventData.alpha

        document.getElementById('doTiltLR').innerHTML = Math.round(tiltLR)
        document.getElementById('doTiltFB').innerHTML = Math.round(tiltFB)
        document.getElementById('doDirection').innerHTML = Math.round(dir)

        var logo = document.getElementById('imgLogo')
        logo.style.webkitTransform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
        logo.style.MozTransform = 'rotate(' + tiltLR + 'deg)'
        logo.style.transform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
      }
    }
  }
}
</script>

<style scoped>

</style>
