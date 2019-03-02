<template>
    <span>
        <v-toolbar color="grey darken-4">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Etiquetes</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
                 <v-expansion-panel class="hidden-lg-and-up">
      <v-expansion-panel-content

      >
        <template v-slot:header>
          <div>Filtres</div>
        </template>
        <v-card>
                <v-layout row wrap>
        <v-flex  class="mr-2">
                        <v-select
                                :items="filters"
                                v-model="filter"
                                item-text="name"
                        >
                        </v-select>
                    </v-flex>
                    <v-flex >
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
        </v-card>
      </v-expansion-panel-content>
    </v-expansion-panel>
                <v-layout  row wrap class="hidden-md-and-down">
                    <v-flex lg3 class="mr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="filter"
                                item-text="name"
                        >
                        </v-select>
                    </v-flex>
                    <v-flex lg5>
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <data-table-tags class="hidden-md-and-down" :tags="dataTags" :search="search" :loading="loading" @updated="updateTag" @removed="removeTag" >
            </data-table-tags>
            <data-iterator-tags @updated="updateTag" @removed="removeTag" class="hidden-lg-and-up" :tags="dataTags" :search="search" :loading="loading" >
            </data-iterator-tags>
        </v-card>
    </span>
</template>

<script>
import TagDestroy from './TagDestroy'
import TagUpdate from './TagUpdate'
import TagShow from './TagShow'
import DataIteratorTags from './DataIteratorTags'
import DataTableTags from './DataTableTags'

export default {
  name: 'TagsList',
  data () {
    return {
      user: '',
      loading: false,
      dataTags: this.tags,
      filter: 'Totes',
      filters: [
        'Totes'
      ],
      search: ''

    }
  },
  components: {
    'tag-destroy': TagDestroy,
    'tag-update': TagUpdate,
    'tag-show': TagShow,
    'data-iterator-tags': DataIteratorTags,
    'data-table-tags': DataTableTags

  },
  props: {
    tags: {
      type: Array,
      required: true
    }
  },
  watch: {
    tags (newTags) {
      this.dataTags = newTags
    }
  },
  methods: {
    updateTag (tag) {
      this.refresh()
    },
    removeTag (tag) {
      this.dataTags.splice(this.dataTags.indexOf(tag), 1)
    },
    refresh () {
      this.loading = true
      window.axios.get('/api/v1/tags').then(response => {
        this.dataTags = response.data
        this.loading = false
        this.$snackbar.showMessage('Etiquetes actualitzades correctament')
      }).catch(error => {
        this.loading = false
        this.$snackbar.showError(error)
      })
    }
  }
}
</script>
