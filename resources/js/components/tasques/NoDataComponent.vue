<template>
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs12 md6 offset-md3 class="mt-3">
                <div class="grey lighten-3" style="width: 240px;height: 240px;padding: 60px;border-radius: 50%;display: inline-flex;">
                    <svg :style="'width:120px;height:120px;fill: ' + this.$vuetify.theme.primary + ';'"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><circle cx="15.5" cy="9.5" r="1.5"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm0-6c-2.33 0-4.32 1.45-5.12 3.5h1.67c.69-1.19 1.97-2 3.45-2s2.75.81 3.45 2h1.67c-.8-2.05-2.79-3.5-5.12-3.5z"/></svg>
                </div>
            </v-flex>
            <v-flex xs12 md4 offset-md4 class="mt-3">
                <h1 class="display-1 grey--text text--darken-2">No hi ha tasca a mostrar.</h1>
                <h2 class="display-1 red--text text--darken-2">Creant alguna!</h2>
                <tasks-create  :users="users" :uri="uri" :tags="tags" @created="add" ></tasks-create>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import TasksCreate from './TasksCreate'
export default {
  name: 'NoDataComponent',
  data () {
    return {
      value: ''
    }
  },
  Components: {
    'tasks-create': TasksCreate
  }
}
</script>

<style scoped>

</style>
