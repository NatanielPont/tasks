<template>
    <v-navigation-drawer
            v-model="drawer"
            absolute
            temporary
            width="900"
    >
        <v-list class="pa-1">
            <v-list-tile avatar>
                <v-list-tile-avatar>
                    <v-img  src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
                </v-list-tile-avatar>

                <v-list-tile-content>
                    <v-list-tile-title>John Leider</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>

        <v-list class="pt-0" dense>
            <v-divider></v-divider>

            <v-list-tile @click="">
                <v-list-tile-action>
                    <v-icon>clse</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Prova asd asdsa asd asd asd asd as dasd asd as dasd asd as </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="">
                <v-list-tile-action>
                    <v-icon>clse</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Prova</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="">
                <v-list-tile-action>
                    <v-icon>clse</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Prova</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="">
                <v-list-tile-action>
                    <v-icon>clse</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Prova</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
  name: 'NewChatDrawer',
  data () {
    return {
      drawer: this.chatDrawer
    }
  },
  props: {
    chatDrawer: {
      type: Boolean,
      required: true
    }
  },
  watch: {
    chatDrawer (chatDrawer) {
      this.drawer = chatDrawer
      if (this.drawer == false) {
        this.$emit('drawerNull')
      }
    }
  }
}
</script>

<style scoped>
</style>
