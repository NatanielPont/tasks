<template>
    <span>

    <v-toolbar
            color="grey darken-1"

            app
            clipped-left
            clipped-right
            fixed
            class="white--text"
    >
        <v-toolbar-side-icon class="white--text" @click.stop="$emit('toggle-left')"></v-toolbar-side-icon>
        <v-toolbar-title > Application </v-toolbar-title>
        <v-spacer></v-spacer>
        <users-online-widget></users-online-widget>
        <notifications-widget></notifications-widget>

        <v-avatar @click="$emit('toggle-right')" :title="user.name">
            <img v-if="user.online" style="border: lawngreen 2px solid; margin: 20px;" :src=userAvatar alt="avatar">
            <img v-else :src=userAvatar alt="avatar">
        </v-avatar>
        <span class="hidden-xs-only" v-role="'SuperAdmin'"><git-info></git-info></span>
        <v-form action="logout" method="POST">

            <input type="hidden" name="_token" :value="csrfToken">
            <v-btn small color="grey darken-4" class="white--text" type="submit">Logout</v-btn>
        </v-form>
    </v-toolbar>
    </span>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget.vue'
import GitInfoComponent from './git/GitInfoComponent.vue'
import UsersOnlineWidget from './users/UsersOnlineWidget'
export default {
  name: 'MainToolbar',
  components: {
    'notifications-widget': NotificationsWidget,
    'git-info': GitInfoComponent,
    'users-online-widget': UsersOnlineWidget
  },
  props:{
    csrfToken: {
      Type: String
    }
  },
  data () {
    return {
      userAvatar: window.laravel_user.gravatar
    }
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>
