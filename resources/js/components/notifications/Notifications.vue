<template>
    <v-container grid-list-md text-xs-center fluid >
        <v-layout row wrap fluid>
            <v-flex xs12>
                <user-notifications-list :notifications="userNotifications"></user-notifications-list>
            </v-flex>
            <v-flex xs12 v-if="users.length > 0">
                <simple-notification-send-card :users="users" @sent="forceRefresh = true"></simple-notification-send-card>
            </v-flex>
            <v-flex xs12 v-if="notifications.length > 0">
                <notifications-list :users="users" :notifications="notifications" :force-refresh="forceRefresh" @refreshed="forceRefresh = false"></notifications-list>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import UserNotificationsList from './UserNotificationsList'
import SimpleNotificationSendCard from './SimpleNotificationSendCard'
import NotificationsList from './NotificationsList'
export default {
  name: 'Notifications',
  data () {
    return {
      forceRefresh: false
    }
  },
  components: {
    'user-notifications-list': UserNotificationsList,
    'simple-notification-send-card': SimpleNotificationSendCard,
    'notifications-list': NotificationsList
  },
  props: {
    notifications: {
      type: Array
    },
    userNotifications: {
      type: Array,
      required: true
    },
    users: {
      type: Array
    }
  },
  methods: {
    refresh (message = false) {
      this.loading = true
      window.axios.get('/api/v1/user/unread_notifications/').then((response) => {
        this.dataNotifications = response.data
        this.loading = false
        if (message) this.$snackbar.showMessage('Notificacions actualitzades correctament')
      }).catch(error => {
        this.loading = false
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
