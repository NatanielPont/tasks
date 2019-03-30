<template>
    <span>

        <toolbar-canals :user="user">

        </toolbar-canals>
        <v-container fluid text-xs-center class="ma-0 pa-0">
          <v-layout row wrap class="mx-0">
            <v-flex xs12 style="height: 64px;">
              <v-card dark color="cyan" style="height: 64px;">
                <v-card-text class="px-0">TODO activar notificacions d'escriptori</v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs12>
              <v-card dark style="height: 64px;">
                  search here
              </v-card>
            </v-flex>
            <v-flex xs12 class="scroll-y" style="max-height: calc(100vh - 64px - 64px - 64px - 64px)">
                <v-list subheader>
                    <v-subheader>Recent channels</v-subheader>
                    <v-list-tile
                            v-for="channel in dataChannels"
                            :key="channel.id"
                            avatar
                            @click="$emit('input',channel)"
                    >
                      <v-list-tile-avatar>
                          <v-img :src="channel.image"></v-img>
                      </v-list-tile-avatar>

                      <v-list-tile-content>
                        <v-list-tile-title v-html="channel.name"></v-list-tile-title>
                      </v-list-tile-content>

                      <v-list-tile-action>
                        <v-icon color="primary">chat_bubble</v-icon>
                      </v-list-tile-action>
                    </v-list-tile>
                  </v-list>
            </v-flex>
          </v-layout>
        </v-container>
    </span>
</template>

<script>
export default {
  name: 'ChatChannels',
  data () {
    return {
      profileDrawer: false,
      dataChannels: this.channels
    }
  },
  model: {
    prop: 'channel',
    event: 'input'
  },
  props: {
    channels: {
      type: Array,
      required: true
    },
    channel: {}
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>
