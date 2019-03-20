<template>
    <span>
         <v-dialog
                 v-model="dialog"
                 max-width="290"
         >
        <v-card>
          <v-card-title class="headline justify-center">Geolocalització</v-card-title>

          <v-card-text align="center">
              <!--<v-layout  class=" justify-center">-->

                                     <v-btn color="primary" id="askButton">Localització</v-btn>
              <!--</v-layout>-->

                                     <div id="target"></div>

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
                     @click="geolocation"
             >
        Geolocation
      </v-btn>
        </span>
</template>

<script>
// var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator

export default {
  name: 'Geolocation.vue',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    geolocation () {
      var target = document.getElementById('target')
      var watchId

      function appendLocation (location, verb) {
        verb = verb || 'updated'
        var newLocation = document.createElement('p')
        newLocation.innerHTML = 'Location ' + verb + ': <a href="https://maps.google.com/maps?&z=15&q=' + location.coords.latitude + '+' + location.coords.longitude + '&ll=' + location.coords.latitude + '+' + location.coords.longitude + '" target="_blank">' + location.coords.latitude + ', ' + location.coords.longitude + '</a>'
        target.appendChild(newLocation)
      }

      if ('geolocation' in navigator) {
        document.getElementById('askButton').addEventListener('click', function () {
          navigator.geolocation.getCurrentPosition(function (location) {
            appendLocation(location, 'fetched')
          })
          watchId = navigator.geolocation.watchPosition(appendLocation)
        })
      } else {
        target.innerText = 'Geolocation API not supported.'
      }
    }
  }
}
</script>

<style scoped>

</style>
