<template>
    <v-container fluid grid-list-md>
        <v-data-iterator
                :items="dataTasks"
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
                    <v-card >
                    <v-card-title class="subheading font-weight-bold primary">{{ props.item.name }}</v-card-title>

                    <v-divider></v-divider>

                    <v-list dense>
                    <v-list-tile>
                    <v-list-tile-content>Nom:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ props.item.name }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                    <v-list-tile-content>User:</v-list-tile-content>
                    <v-avatar :title="props.item.user_name">
                    <img v-if="props.item.user_gravatar" :src="props.item.user_gravatar" alt="avatar">
                    <img v-else src="https://www.gravatar.com/avatar/" alt="avatar">
                    </v-avatar>
                    <!--<v-list-tile-content class="align-end">{{ props.item.name }}</v-list-tile-content>-->
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Descripció:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ props.item.description }}</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Estat:</v-list-tile-content>
                    <v-list-tile-content class="align-end">
                    <toggle :value="props.item.completed" uri="/api/v1/completed_task"  active-text="Completada" unactive-text="Pendent" :task="props.item"></toggle>
                    </v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Tags:</v-list-tile-content>
                    <tasks-tags :task="props.item" :task-tags="props.item.tags" :tags="tags" @change="refresh" @removed="refresh" ></tasks-tags>

                    <!--<v-list-tile-content class="align-end">{{ props.item.created_at_human }}</v-list-tile-content>-->
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
                    <task-show :users="users" :task="props.item"></task-show>
                    <task-update :users="users" :task="props.item" @updated="update" :uri="uri"></task-update>
                    <task-destroy :task="props.item" @removed="remove" :uri="uri"></task-destroy>

                    </v-list-tile>

                    </v-list>
                    </v-card>
                </v-flex>
            </template>
        </v-data-iterator>

    </v-container>
</template>

<script>
import Toggle from '../Toggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'

export default {
  name: 'DataIteratorTasks',
  data () {
    return {
      dataTasks: this.tasks,
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

    tasks: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }

  },
  components: {
    'toggle': Toggle,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'task-show': TaskShow,
    'tasks-tags': TasksTags

  },
  watch: {
    tasks (tasks) {
      this.dataTasks = tasks
    }
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
