<template>
    <span>
         <v-dialog
                 v-model="dialog"
                 max-width="290"
         >
        <v-card>
          <v-card-title class="headline justify-center">Memòria Lliure</v-card-title>

          <v-card-text align="center">

              <p>
                Memòria ~ <b id="result">unknown</b> GB
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
                 @click="memory"
         >
        Memory
      </v-btn>
        </span>
</template>

<script>
// var canVibrate = 'vibrate' in navigator || 'mozVibrate' in navigator

export default {
  name: 'Memory.vue',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    memory () {
      document.getElementById('result').innerHTML = navigator.deviceMemory || 'unknown'
    }
  }
}
</script>

<style scoped>

</style>
