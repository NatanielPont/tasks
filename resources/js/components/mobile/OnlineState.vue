<template>
    <span>
         <v-dialog
                 v-model="dialog"
                 max-width="290"
         >
        <v-card>
          <v-card-title class="headline justify-center">Estat de Red</v-card-title>

          <v-card-text align="center">
              <p >
                You are  : <b id="status">unknown</b>
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
                 @click="online"
         >
        Online ?
      </v-btn>
        </span>
</template>

<script>
// var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator
var state = navigator.onLine ? 'online' : 'offline'
export default {
  name: 'OnlineState.vue',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    online () {
      document.getElementById('status').innerHTML = navigator.onLine ? 'online' : 'offline'

      var target = document.getElementById('target')

      function handleStateChange () {
        var timeBadge = new Date().toTimeString().split(' ')[0]
        var newState = document.createElement('p')
        state = navigator.onLine ? 'online' : 'offline'
        newState.innerHTML = '<span class="badge">' + timeBadge + '</span> Connection state changed to <b>' + state + '</b>.'
        target.appendChild(newState)
      }

      window.addEventListener('online', handleStateChange)
      window.addEventListener('offline', handleStateChange)
    }
  }
}
</script>

<style scoped>

</style>
