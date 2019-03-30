<template>
    <v-navigation-drawer
            v-model="drawer"
            absolute
            temporary
    >

        <v-layout justify-center align-center row>
            <v-toolbar color="primary">

                <v-layout row>
                    <v-flex shrink pa-1>
                            <v-btn class="ml-0" @click.stop="drawerNull" icon >
                                <i class="fas fa-caret-left"></i>
                            </v-btn>
                    </v-flex>
                    <v-flex grow pa-1>

                            <v-card-text class="text-xs-center white--text">Profile</v-card-text>
                    </v-flex>
                    <v-flex shrink pa-1>

                            <v-avatar :title="user.name" @click.stop="drawerNull">
                            <v-img v-if="user.gravatar" :src="user.gravatar" alt="avatar"></v-img>
                            <v-img v-else src="https://www.gravatar.com/avatar/" alt="avatar"></v-img>
                            </v-avatar>
                    </v-flex>
                </v-layout>

            </v-toolbar>

            <v-card-title primary-title class="text-xs-center">

                <v-layout align-center justify-start column>
                    <v-flex>
                        <material-card class="v-card-profile">
                            <v-avatar
                                    slot="offset"
                                    class="mx-auto d-block"
                                    size="130"
                            >
                                <img
                                        src="/user/photo"
                                >
                            </v-avatar>
                            <v-card-text class="text-xs-center">
                                <v-btn
                                        color="primary"
                                        round
                                        class="font-weight-light"
                                >Upload Photo</v-btn>
                            </v-card-text>
                        </material-card>
                    </v-flex>
                </v-layout>
                <v-layout column >
                    <v-flex xs  class="mb-2">
                        <p class="primary white--text">Name</p>
                        <h3 class="headline font-weight-light grey--text">{{ user.name }}</h3>
                    </v-flex>

                    <v-flex xs class="mb-3">
                        <p class="primary white--text">Email</p>
                        <div class=" font-weight-light grey--text">{{ user.email }}</div>
                    </v-flex>
                    <v-flex xs  class="mb-2">
                        <p class="primary white--text">Account type</p>
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
