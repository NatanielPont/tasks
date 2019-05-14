<template>
    <v-navigation-drawer
            v-model="drawer"
            absolute
            temporary
            width="450"
    >

        <v-toolbar color="primary">

            <v-layout row class="mt-2">
                <v-flex shrink pa-1>
                    <v-btn class="ml-0" @click.stop="drawer=!drawer" icon >
                        <i class="fas fa-caret-left"></i>
                    </v-btn>
                </v-flex>
                <v-flex grow pa-1>

                    <v-card-text class=" white--text">Profile</v-card-text>
                </v-flex>
                <!--<v-flex shrink pa-1>-->

                    <!--<v-avatar :title="user.name" @click.stop="drawer=!drawer">-->
                        <!--<v-img v-if="user.gravatar" :src="user.gravatar" alt="avatar"></v-img>-->
                        <!--<v-img v-else src="https://www.gravatar.com/avatar/" alt="avatar"></v-img>-->
                    <!--</v-avatar>-->
                <!--</v-flex>-->
            </v-layout>

        </v-toolbar>

        <!--scroll, layout, + flex, sols vista mobil-->
        <!--<v-layout row wrap fill-height >-->
        <!--<v-flex >-->

        <v-layout  v-bind="binding" >
            <v-flex class="text-xs-center mb-2">
                <material-card class="v-card-profile mb-0">
                    <!--//slot="offset"-->

                    <v-avatar
                            class="mx-auto d-block"
                            size="90"
                    >
                        <img
                                src="/user/photo"
                                class="mt-4"
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
            <v-flex class="align-items-start ">
                <v-card class="pl-3 pb-2">

                    <p class="primary--text pt-1" >Name</p>
                    <h3 class="headline font-weight-light grey--text">{{ user.name }}</h3>

                </v-card>
            </v-flex>
            <v-flex class=" align-items-start">
                <v-card class="pl-3 pb-2">
                    <p class="primary--text pt-1">Email</p>
                <div class=" font-weight-light grey--text">{{ user.email }}</div>
                    </v-card>

            </v-flex>
            <v-flex class="align-items-start "  >
                <v-card class="pl-3 pb-2">
                    <p class=" primary--text pt-1">Account type</p>
                <v-chip class="m-0" outline label color="primary" v-if="user.admin">Admin</v-chip>
                <v-chip outline label color="grey" v-else>Regular</v-chip>
                    </v-card>
                <v-card class="pl-3 pb-2">
                    <v-list dense class="scroll-y pt-1" >
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
                        <v-list-group v-ripple prepend-icon="lock" no-action  >
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
                </v-card>

            </v-flex>
        </v-layout>
        <!--scroll, end tags-->
        <!--</v-flex>-->

        <!--</v-layout>-->

    </v-navigation-drawer>
</template>

<script>
import MaterialCard from '../ui/MaterialCard'
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
      if (this.drawer == false) {
        this.$emit('drawerNull')
      }
      if (this.drawer == true) {
        this.$emit('chatDrawerNull')
      }
    }
  },
  methods: {
    // drawerNull () {
    //   this.drawer = !this.drawer
    //   // this.$emit('drawerNull')
    // }
  },
  components: {
    'material-card': MaterialCard
  },
  computed: {
    binding () {
      const binding = {}
      // if (this.$vuetify.breakpoint.mdAndUp) binding.column = true
      binding.column = true
      return binding
    }
  }
}
</script>

<style scoped>
</style>
