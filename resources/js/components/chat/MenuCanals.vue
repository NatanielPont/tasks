<template>
    <v-menu>
        <!--<v-tooltip bottom>-->
            <template #activator="{ on: menu }">
                <v-tooltip bottom>
                    <template #activator="{ on: tooltip }">
                        <v-btn
                                flat
                                v-on="{ ...tooltip, ...menu }"
                        >
                            <v-icon>more_vert</v-icon>

                        </v-btn>
                    </template>
                    <span>Opcions</span>
                </v-tooltip>
            </template>
        <v-list>
            <v-list-tile
                    v-for="(item, index) in items"
                    :key="index"
                    @click=""
            >
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-menu>
</template>

<script>
export default {
  name: 'MenuCanals',
  data () {
    return {
      value: '',
      items: [
        { title: 'Profile' },
        { title: 'Click Me2' },
        { title: 'Click Me3' },
        { title: 'Click Me4' }
      ]
    }
  }
}
</script>

<style scoped>

</style>
