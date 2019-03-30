<template>
    <v-navigation-drawer
            v-model="drawer"
            absolute
            temporary
    >

        <v-layout justify-center align-center row>
            <v-card-title primary-title class="text-xs-center">
                <v-layout align-center justify-start column>
                    <v-avatar :title="user.name" @click.stop="drawerNull">
                        <v-img v-if="user.gravatar" :src="user.gravatar" alt="avatar"></v-img>
                        <v-img v-else src="https://www.gravatar.com/avatar/" alt="avatar"></v-img>
                    </v-avatar>
                    <v-flex xs>
                        <h3 class="headline font-weight-light">{{ user.name }}</h3>
                    </v-flex>

                    <v-flex xs>
                        <div class="font-weight-medium grey--text text--lighten-1">{{ user.email }}</div>
                    </v-flex>
                    <v-flex xs>
                        <v-chip class="m-0" outline label color="green" v-if="user.admin">Admin</v-chip>
                        <v-chip outline label color="grey" v-else>Regular</v-chip>
                    </v-flex>
                </v-layout>

                <v-layout align-center justify-start column>
                    <v-list >
                        <v-list-group v-ripple prepend-icon="account_circle" no-action>
                            <v-list-tile slot="activator">
                                <v-list-tile-content>Rols</v-list-tile-content>
                            </v-list-tile>

                            <v-list-tile v-for="rol in user.roles" :key="rol" no-data-text="No te cap rol.">
                                <v-list-tile-content>
                                    <v-list-tile-title>{{ rol }}</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list-group>
                        <v-list-group v-ripple prepend-icon="lock" no-action >
                            <v-list-tile slot="activator">
                                <v-list-tile-content>Permissos</v-list-tile-content>
                            </v-list-tile>

                            <v-list-tile v-for="permis in user.permissions" :key="permis" no-data-text="No te cap permís.">
                                <v-list-tile-content>
                                    <v-list-tile-title>{{ permis }}</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list-group>
                    </v-list>
                </v-layout>
            </v-card-title>
        </v-layout>
    </v-navigation-drawer>
</template>

<script>
export default {
  name: 'ProfileDrawer',
  data () {
    return {
      drawer: this.profileDrawer,
      value: ''
    }
  },
  props: {
    profileDrawer: {
      type: Boolean,
      required: true

    },
    user: {
      type: Object,
      required: true

    }
  },
  watch: {
    profileDrawer (profileDrawer) {
      this.drawer = profileDrawer
    }
  },
  methods: {
    drawerNull () {
      this.drawer = !this.drawer
      this.$emit('drawerNull')
    }
  }
}
</script>

<style scoped>

</style>
