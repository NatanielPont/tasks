<template>
    <v-container fluid grid-list-md>
        <v-data-iterator
                :items="tags"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
                :search="search"
                content-tag="v-layout"
                row
                wrap
        >
            <template v-slot:item="props">
                <v-flex
                        xs12
                        sm6
                        md4
                        lg3
                >
                    <v-card>
                    <v-card-title class="subheading font-weight-bold primary">{{ props.item.name }}</v-card-title>

                    <v-divider></v-divider>

                    <v-list dense>
                    <v-list-tile>
                    <v-list-tile-content>Nom:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ props.item.name }}</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Id:</v-list-tile-content>
                    {{props.item.id}}

                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Descripció:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ props.item.description }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                    <v-list-tile-content>Color:</v-list-tile-content>
                    <v-icon x-large :color="props.item.color">memory</v-icon>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Creat:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ props.item.created_at_human }}</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Actualitzat:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ props.item.updated_at_human }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                    <v-list-tile-content>Acccions:</v-list-tile-content>
                    <!--<v-list-tile-content class="align-end">-->
                    <tag-show :tag="props.item"></tag-show>
                    <tag-update :tag="props.item" @updated="update"></tag-update>
                    <tag-destroy :tag="props.item" @removed="remove"></tag-destroy>
                    <!--</v-list-tile-content>-->

                    </v-list-tile>

                    </v-list>
                    </v-card>
                </v-flex>
            </template>
        </v-data-iterator>
        <!--<v-data-iterator-->
                <!--:items="tags"-->
                <!--:rows-per-page-items="rowsPerPageItems"-->
                <!--:pagination.sync="pagination"-->
                <!--:search="search"-->
                <!--content-tag="v-layout"-->
                <!--hide-actions-->
                <!--row-->
                <!--wrap-->
        <!--&gt;-->
            <!--&lt;!&ndash;<v-toolbar&ndash;&gt;-->
                    <!--&lt;!&ndash;slot="header"&ndash;&gt;-->
                    <!--&lt;!&ndash;class="mb-2"&ndash;&gt;-->
                    <!--&lt;!&ndash;color="primary darken-4"&ndash;&gt;-->
                    <!--&lt;!&ndash;dark&ndash;&gt;-->
                    <!--&lt;!&ndash;flat&ndash;&gt;-->
            <!--&lt;!&ndash;&gt;&ndash;&gt;-->
                <!--&lt;!&ndash;<v-toolbar-title >Tags</v-toolbar-title>&ndash;&gt;-->
            <!--&lt;!&ndash;</v-toolbar>&ndash;&gt;-->

            <!--<v-flex-->
                    <!--slot="item"-->
                    <!--slot-scope="props"-->
                    <!--xs12-->
                    <!--sm6-->
                    <!--md4-->
                    <!--lg3-->
            <!--&gt;-->
                <!--<v-card>-->
                    <!--<v-card-title class="subheading font-weight-bold primary">{{ props.item.name }}</v-card-title>-->

                    <!--<v-divider></v-divider>-->

                    <!--<v-list dense>-->
                        <!--<v-list-tile>-->
                            <!--<v-list-tile-content>Nom:</v-list-tile-content>-->
                            <!--<v-list-tile-content class="align-end">{{ props.item.name }}</v-list-tile-content>-->
                        <!--</v-list-tile>-->

                        <!--<v-list-tile>-->
                            <!--<v-list-tile-content>Id:</v-list-tile-content>-->
                            <!--{{props.item.id}}-->

                        <!--</v-list-tile>-->

                        <!--<v-list-tile>-->
                            <!--<v-list-tile-content>Descripció:</v-list-tile-content>-->
                            <!--<v-list-tile-content class="align-end">{{ props.item.description }}</v-list-tile-content>-->
                        <!--</v-list-tile>-->
                        <!--<v-list-tile>-->
                            <!--<v-list-tile-content>Color:</v-list-tile-content>-->
                            <!--<v-icon x-large :color="props.item.color">memory</v-icon>-->
                        <!--</v-list-tile>-->

                        <!--<v-list-tile>-->
                            <!--<v-list-tile-content>Creat:</v-list-tile-content>-->
                            <!--<v-list-tile-content class="align-end">{{ props.item.created_at_human }}</v-list-tile-content>-->
                        <!--</v-list-tile>-->

                        <!--<v-list-tile>-->
                            <!--<v-list-tile-content>Actualitzat:</v-list-tile-content>-->
                            <!--<v-list-tile-content class="align-end">{{ props.item.updated_at_human }}</v-list-tile-content>-->
                        <!--</v-list-tile>-->
                        <!--<v-list-tile>-->
                            <!--<v-list-tile-content>Acccions:</v-list-tile-content>-->
                            <!--&lt;!&ndash;<v-list-tile-content class="align-end">&ndash;&gt;-->
                            <!--<tag-show :tag="props.item"></tag-show>-->
                            <!--<tag-update :tag="props.item" @updated="update"></tag-update>-->
                            <!--<tag-destroy :tag="props.item" @removed="remove"></tag-destroy>-->
                            <!--&lt;!&ndash;</v-list-tile-content>&ndash;&gt;-->

                        <!--</v-list-tile>-->

                    <!--</v-list>-->
                <!--</v-card>-->
            <!--</v-flex>-->

            <!--&lt;!&ndash;<v-toolbar&ndash;&gt;-->
                    <!--&lt;!&ndash;slot="footer"&ndash;&gt;-->
                    <!--&lt;!&ndash;class="mt-2"&ndash;&gt;-->
                    <!--&lt;!&ndash;color="grey darken-1"&ndash;&gt;-->
                    <!--&lt;!&ndash;dark&ndash;&gt;-->
                    <!--&lt;!&ndash;dense&ndash;&gt;-->
                    <!--&lt;!&ndash;flat&ndash;&gt;-->
            <!--&lt;!&ndash;&gt;&ndash;&gt;-->
                <!--&lt;!&ndash;<v-toolbar-title class="subheading">Nataniel Pont Tasks</v-toolbar-title>&ndash;&gt;-->
            <!--&lt;!&ndash;</v-toolbar>&ndash;&gt;-->
        <!--</v-data-iterator>-->
    </v-container>
</template>

<script>
import TagDestroy from './TagDestroy'
import TagUpdate from './TagUpdate'
import TagShow from './TagShow'
// import DataIteratorTags from './DataIteratorTags'

export default {
  name: 'DataIteratorTasks',
  data () {
    return {

      // tasks: this.tasks,
      rowsPerPageItems: [4, 8, 12],
      pagination: {
        rowsPerPage: 4
      }
    }
  },
  props: {
    search: {
      type: String,
      required: true
    },
    // users: {
    //   type: Array,
    //   required: true
    // },
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
