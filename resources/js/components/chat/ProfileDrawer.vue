<template>
    <v-navigation-drawer
            v-model="drawer"
            absolute
            temporary
            width="450"
    >

        <v-toolbar color="primary">

            <v-layout row>
                <v-flex shrink pa-1>
                    <v-btn class="ml-0" @click.stop="drawer=!drawer" icon >
                        <i class="fas fa-caret-left"></i>
                    </v-btn>
                </v-flex>
                <v-flex grow pa-1>

                    <v-card-text class="text-xs-center white--text">Profile</v-card-text>
                </v-flex>
                <v-flex shrink pa-1>

                    <v-avatar :title="user.name" @click.stop="drawer=!drawer">
                        <v-img v-if="user.gravatar" :src="user.gravatar" alt="avatar"></v-img>
                        <v-img v-else src="https://www.gravatar.com/avatar/" alt="avatar"></v-img>
                    </v-avatar>
                </v-flex>
            </v-layout>

        </v-toolbar>

        <!--scroll, layout, + flex, sols vista mobil-->
        <!--<v-layout row wrap fill-height >-->
        <!--<v-flex >-->

        <v-layout  v-bind="binding">
            <v-flex class="text-xs-center ">
                <material-card class="v-card-profile mb-0">
                    <v-avatar
                            slot="offset"
                            class="mx-auto d-block"
                            size="100"
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
            <v-flex class="text-xs-center">
                <v-card color="primary">

                    <p class="white--text ">Name</p>
                </v-card>
                <h3 class="headline font-weight-light grey--text">{{ user.name }}</h3>
            </v-flex>
            <v-flex class="mb-2 text-xs-center">
                <v-card color="primary">
                    <p class=" white--text">Email</p>
                </v-card>
                <div class=" font-weight-light grey--text">{{ user.email }}</div>

            </v-flex>
            <v-flex class="text-xs-center"  >
                <v-card color="primary">
                    <p class=" white--text">Account type</p>
                </v-card>
                <v-chip class="m-0" outline label color="green" v-if="user.admin">Admin</v-chip>
                <v-chip outline label color="grey" v-else>Regular</v-chip>

                <v-list dense class="scroll-y" >
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
