<template>
    <v-card >
        <v-card-title class="grey darken-2"><h4>Tema</h4></v-card-title>
        <v-expansion-panel >
            <v-expansion-panel-content
            >
                <template v-slot:header>
                    <div>Primary Color</div>
                </template>
                <v-card>
                    <swatches v-model="colorPrincipal" inline></swatches>
                </v-card>
            </v-expansion-panel-content>
        </v-expansion-panel>

        <v-expansion-panel >
            <v-expansion-panel-content
            >
                <template v-slot:header>
                    <div>Accent Color</div>
                </template>
                <v-card>

                    <swatches v-model="colorAccent" inline></swatches>
                </v-card>
            </v-expansion-panel-content>
        </v-expansion-panel>
        <v-expansion-panel >
            <v-expansion-panel-content
            >
                <template v-slot:header>
                    <div>Navigation Color</div>
                </template>
                <v-card>

                    <swatches v-model="colorGrey" inline></swatches>
                </v-card>
            </v-expansion-panel-content>
        </v-expansion-panel>

        <v-btn @click="principalDefault">DEFAULT</v-btn>
    </v-card>
</template>

<script>
import Swatches from 'vue-swatches'
// Import the styles too, globally
import 'vue-swatches/dist/vue-swatches.min.css'
export default {
  name: 'Tema',
  components: { Swatches },
  data () {
    return {
      colorPrincipal: window.localStorage.getItem('PRIMARY_COLOR_KEY'),
      finalColorPrincipal: this.$vuetify.theme.primary,
      colorGrey: window.localStorage.getItem('GREY_COLOR_KEY'),
      finalColorGrey: this.$vuetify.theme.grey,
      colorAccent: window.localStorage.getItem('ACCENT_COLOR_KEY'),
      finalColorAccent: this.$vuetify.theme.accent
    }
  },
  watch: {
    colorPrincipal () {
      window.localStorage.setItem('PRIMARY_COLOR_KEY', this.colorPrincipal)
      this.$vuetify.theme.primary = this.colorPrincipal
    },
    colorGrey () {
      window.localStorage.setItem('GREY_COLOR_KEY', this.colorGrey)
      this.$vuetify.theme.grey = this.colorGrey
    },
    colorAccent () {
      window.localStorage.setItem('ACCENT_COLOR_KEY', this.colorAccent)
      this.$vuetify.theme.accent = this.colorAccent
    }
  },
  methods: {
    principalDefault () {
      window.localStorage.setItem('PRIMARY_COLOR_KEY', this.finalColorPrincipal)
      this.$vuetify.theme.primary = this.finalColorPrincipal
      window.localStorage.setItem('GREY_COLOR_KEY', this.finalColorGrey)
      this.$vuetify.theme.grey = this.finalColorGrey
      window.localStorage.setItem('ACCENT_COLOR_KEY', this.colorAccent)
      this.$vuetify.theme.accent = this.finalColorAccent
    }
  }
}
</script>

<style scoped>
</style>
