<template>
    <v-navigation-drawer
            v-model="dataDrawer"
            fixed
            app
            clipped
            class="grey darken-1"

    >
        <v-list dense>
            <template v-for="item in items">
                <v-layout
                        v-if="item.heading"
                        :key="item.heading"
                        row
                        align-center

                >
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-flex>
                </v-layout>
                <v-list-group
                        v-else-if="item.children"
                        v-model="item.model"
                        :key="item.text"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']"
                        append-icon=""
                        class="white--text"
                >
                    <v-list-tile slot="activator" :href="item.url">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                            v-for="(child, i) in item.children"
                            :key="i"
                            :href="child.url"
                    >
                        <v-list-tile-action v-if="child.icon">
                            <v-icon color="white">{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ child.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile v-else :key="item.text" :href="item.url" class="white--text">
                    <v-list-tile-action>
                        <v-icon color="white">{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
  name: 'Navigation',
  data () {
    return {
      dataDrawer: this.drawer,
      items: [
        { icon: 'home', text: 'Welcome', url: '/' },
        // { icon: 'home', text: 'Home', url: '/home' },
        { icon: 'notifications', text: 'Notificacions', url: '/notifications' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasques',
          model: false,
          children: [
            { icon: 'build', text: 'PHP', url: '/tasks' },
            { icon: 'build', text: 'Tailwind', url: '/tasks_tailwind' },
            { icon: 'build', text: 'Vue', url: '/tasks_vue' },

            { icon: 'build', text: 'Tasques', url: '/tasques' },
            { icon: 'build', text: 'Tags', url: '/tags' }
          ]
        },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Extres',
          model: false,
          children: [
            // { icon: 'help', text: 'Telescope', url: '/telescope' },
            { icon: 'help', text: 'Changelog', url: '/changelog' },
            { icon: 'build', text: 'Mobile', url: '/mobile' },
            { icon: 'public', text: 'Clock', url: '/clock' },
            { icon: 'help', text: 'Chat', url: '/chat' },
            { icon: 'help', text: 'Newsletters', url: '/newsletters' },
            { icon: 'public', text: 'Users', url: '/users' }
          ]
        },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Perfil',
          model: false,
          children: [
            { icon: 'help', text: 'Profile', url: '/profile' },
            { icon: 'help', text: 'Contact', url: '/contact' },
            { icon: 'public', text: 'About', url: '/about' }
          ]
        }

      ]
    }
  },
  props: {
    drawer: {
      Type: Boolean,
      default: false
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
