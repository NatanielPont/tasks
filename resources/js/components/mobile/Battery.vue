<template>
    <span>
         <v-dialog
                 v-model="dialog"
                 max-width="290"
         >
        <v-card>
          <v-card-title class="headline justify-center">Estat Bateria</v-card-title>

          <v-card-text align="center">

             <p>
                Estat <b id="charging">unknown</b>
            </p>
              <p>
                Temps de càrrega <b id="chargingTime">unknown</b>
              </p>
              <p>
                Temps de descàrrega <b id="dischargingTime">unknown</b>
              </p>
              <p>
                Nivell bateria <b id="level">unknown</b>

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
                     @click="battery"
             >
        Battery
      </v-btn>
        </span>
</template>

<script>
// var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator

export default {
  name: 'Battery.vue',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    battery () {
      if ('getBattery' in navigator || ('battery' in navigator && 'Promise' in window)) {
        var target = document.getElementById('target')

        function handleChange (change) {
          var timeBadge = new Date().toTimeString().split(' ')[0]
          var newState = document.createElement('p')
          newState.innerHTML = '<span class="badge">' + timeBadge + '</span> ' + change + '.'
          target.appendChild(newState)
        }

        function onChargingChange () {
          handleChange('Battery charging changed to <b>' + (this.charging ? 'charging' : 'discharging') + '</b>')
        }
        function onChargingTimeChange () {
          handleChange('Battery charging time changed to <b>' + this.chargingTime + ' s</b>')
        }
        function onDischargingTimeChange () {
          handleChange('Battery discharging time changed to <b>' + this.dischargingTime + ' s</b>')
        }
        function onLevelChange () {
          handleChange('Battery level changed to <b>' + this.level + '</b>')
        }

        var batteryPromise

        if ('getBattery' in navigator) {
          batteryPromise = navigator.getBattery()
        } else {
          batteryPromise = Promise.resolve(navigator.battery)
        }

        batteryPromise.then(function (battery) {
          document.getElementById('charging').innerHTML = battery.charging ? 'charging' : 'discharging'
          document.getElementById('chargingTime').innerHTML = battery.chargingTime + ' s'
          document.getElementById('dischargingTime').innerHTML = battery.dischargingTime + ' s'
          document.getElementById('level').innerHTML = battery.level

          battery.addEventListener('chargingchange', onChargingChange)
          battery.addEventListener('chargingtimechange', onChargingTimeChange)
          battery.addEventListener('dischargingtimechange', onDischargingTimeChange)
          battery.addEventListener('levelchange', onLevelChange)
        })
      }
    }
  }
}
</script>

<style scoped>

</style>
