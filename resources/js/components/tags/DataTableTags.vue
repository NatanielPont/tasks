<template>
    <v-container fluid grid-list-md>
        <v-data-table
                :headers="headers"
                :items="tags"
                :search="search"
                no-results-text="No s'ha trobat cap registre coincident"
                no-data-text="No hi han dades disponibles"
                rows-per-page-text="Etiquetes per pàgina"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :loading="loading"
                :pagination.sync="pagination"
                class="hidden-md-and-down"
        >
            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
            <template slot="items" slot-scope="{item: tag}">
                <tr>
                    <td>{{ tag.id }}</td>
                    <td>
                        <span :title="tag.description">{{ tag.name }}</span>
                    </td>
                    <td>
                        <v-icon x-large :color="tag.color">memory</v-icon>
                    </td>

                    <td>
                        <span :title="tag.created_at_formatted">{{ tag.created_at_human}}</span>
                    </td>
                    <td>
                        <span :title="tag.updated_at_formatted">{{ tag.updated_at_human}}</span>
                    </td>
                    <td>
                        <tag-show :tag="tag"></tag-show>
                        <tag-update :tag="tag" @updated="update"></tag-update>
                        <tag-destroy :tag="tag" @removed="remove"></tag-destroy>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import TagDestroy from './TagDestroy'
import TagUpdate from './TagUpdate'
import TagShow from './TagShow'
// import DataIteratorTags from './DataIteratorTags'

export default {
  name: 'DataTableTags',
  data () {
    return {

      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Color', value: 'color' },
        { text: 'Creat', value: 'created_at_timestamp' },
        { text: 'Modificat', value: 'updated_at_timestamp' },
        { text: 'Accions', sortable: false, value: 'full_search' }
      ]
    }
  },
  props: {
    search: {
      type: String,
      required: true
    },
    loading: {
      type: Boolean,
      required: true
    },
    tags: {
      type: Array,
      required: true
    }
  },
  components: {
    'tag-destroy': TagDestroy,
    'tag-update': TagUpdate,
    'tag-show': TagShow
    // 'data-iterator-tags': DataIteratorTags

  },
  methods: {
    remove (task) {
      this.$emit('removed', task)
    },
    update (task) {
      // console.log(task)
      // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      // this.tasks = this.dataTasks
      this.$emit('updated', task)
    },
    refresh () {
      this.$emit('refresh', true)
    }
  }
}
</script>

<style scoped>

</style>
