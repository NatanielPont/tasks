<template>
    <span>
    <v-toolbar color="primary">
        <v-avatar :title="user.name" @click.stop="profileDrawer = !profileDrawer">
            <v-img v-if="user.gravatar" :src="user.gravatar" alt="avatar"></v-img>
            <v-img v-else src="https://www.gravatar.com/avatar/" alt="avatar"></v-img>
        </v-avatar>
        <v-toolbar-title>Channels</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-tooltip bottom>
            <v-btn icon slot="activator" @click="chatDrawer=!chatDrawer">
                <v-icon>turned_in_not</v-icon>
            </v-btn>
            <span>Nova conversació</span>
        </v-tooltip>
        <menu-canals></menu-canals>
    </v-toolbar>
        <new-chat-drawer :chatDrawer="chatDrawer" @drawerNull="chatDrawer=!chatDrawer"></new-chat-drawer>

        <profile-drawer :profileDrawer="profileDrawer" :user="user" @drawerNull="profileDrawer = !profileDrawer">

         </profile-drawer>
    </span>
</template>

<script>
export default {
  name: 'ToolbarCanals',
  data () {
    return {
      chatDrawer: false,

      profileDrawer: false,
      value: ''
    }
  },
  props: {

    user: {
      type: Object,
      required: true

    }
  }
}
</script>

<style scoped>

</style>
