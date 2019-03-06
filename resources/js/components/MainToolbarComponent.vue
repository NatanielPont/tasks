<template>
    <v-toolbar
            color="grey darken-1"

            app
            clipped-left
            clipped-right
            fixed>
        <v-toolbar-side-icon class="white--text" @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title class="white--text">Application</v-toolbar-title>
        <v-spacer></v-spacer>
        <notifications-widget></notifications-widget>

        <v-avatar @click.stop="drawerRight = !drawerRight" title="{{ user.name }} ( {{ user.email }} )">
            <img src="https://www.gravatar.com/avatar/{{ md5(user.email) }}" alt="avatar">
        </v-avatar>
        <v-form action="logout" method="POST">
            @csrf
            <v-btn color="grey darken-4" class="white--text" type="submit">Logout</v-btn>
        </v-form>
    </v-toolbar>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget'
export default {
  name: 'MainToolbarComponent',
  data () {
    return {
      value: ''
      // dataUser: window.laravel_user
    }
  },
  components: {
    'notifications-widget': NotificationsWidget

  },
  props: {
    drawer: {
      type: Boolean,
      required: true
    },
    title: {
      type: String,
      required: true
    }
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>

<style scoped>

</style>
