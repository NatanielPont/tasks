<template>
    <v-navigation-drawer
            v-model="drawerRight"
            fixed
            right
            clipped
            app
    >
        <v-card>
            <v-card-title class="grey darken-4 white--text"><h4>Perfil</h4></v-card-title>
            <v-layout row wrap>
                <v-flex xs12>
                    <ul>
                        <li>Nom : {{ window.laravel_user.name }}</li>
                        <li>Email : {{window.laravel_user.email }}</li>
                        <li>Admin : {{ window.laravel_user.admin }}</li>
                        <li>Roles : {{ window.laravel_user.roles.join(', ')}}</li>
                        <li>Permissions : {{ window.laravel_user.permissions.join(', ')}}</li>
                        <!--<li>Roles : {{ user.map()['roles'].join(', ')}}</li>-->
                        <!--<li>Permissions : {{ user.map()['permissions'].join(', ')}}</li>-->
                    </ul>
                </v-flex>
            </v-layout>
            <v-card>
                <v-card-title class="grey darken-4 white--text"><h4>Opcions administrador</h4></v-card-title>

                <v-layout row wrap>
                    @impersonating
                    <v-flex xs12>
                        <v-avatar title="{{window.laravel_user.impersonatedBy().name}} {{ window.laravel_user.email }} )">
                            <img src="https://www.gravatar.com/avatar/{{ md5(window.laravel_user.impersonatedBy().email) }}" alt="avatar">
                        </v-avatar>
                    </v-flex>
                    @endImpersonating
                    <v-flex xs12>
                        @canImpersonate
                        <impersonate label="Entrar com..." url="/api/v1/regular_users" ></impersonate>
                        @endCanImpersonate
                        @impersonating
                        {{ user.impersonatedBy().name }} està suplantant {{ user.name }}
                        <a href="impersonate/leave">Abandonar la suplantació</a>
                        @endImpersonating
                    </v-flex>
                </v-layout>
            </v-card>
            <tema></tema>
        </v-card>
    </v-navigation-drawer>
</template>

<script>
export default {
  name: 'NavigationRight',
  data () {
    return {
      dataDrawer: this.drawerRight
    }
  },
  props: {
    drawerRight: {
      type: Boolean,
      default: false
    },
    user: {
      type: Object,
      required: true
    }
  },
  watch: {
    dataDrawer (drawer) {
      this.$emit('input', drawer)
    },
    drawer (drawer) {
      this.dataDrawer = drawer
    }
  },
  model: {
    prop: 'drawer',
    event: 'input'
  }
}
</script>
