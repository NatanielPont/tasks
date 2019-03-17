<template xmlns:v-touch="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid grid-list-md>
            <span v-touch:swipe.left="swipeHandler">Swipe Here</span>
        <v-data-table
                :headers="headers"
                :items="dataTasks"
                :search="search"
                no-results-text="No s'ha trobat cap registre coincident"
                no-data-text="No hi han dades disponibles"
                rows-per-page-text="Tasques per pàgina"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :loading="loading"
                :pagination.sync="pagination"
                class="hidden-md-and-down"

        >
            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>

            <template  slot="items" slot-scope="{item: task}" v-touch:swipe.left="swipeHandler" >
                <tr  >
                    <td>{{ task.id }}</td>
                    <td>
                        <span :title="task.description">{{ task.name}} </span>
                    </td>
                    <td>
                        <v-avatar :title="task.user_name">
                            <img v-if="task.user_gravatar" :src="task.user_gravatar" alt="avatar">
                            <img v-else src="https://www.gravatar.com/avatar/" alt="avatar">
                        </v-avatar>
                    </td>
                    <td >
                        <toggle :value="task.completed" uri="/api/v1/completed_task" @change="refresh" active-text="Completada" unactive-text="Pendent" :task="task"></toggle>
                    </td>
                    <td>
                        <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh" @removed="refresh" ></tasks-tags>
                        <!--<tasks-tags :task="task" :tags="tags" @removed="refresh" @added="refresh"></tasks-tags>-->
                    </td>
                    <td>
                        <span :title="task.created_at_formatted">{{ task.created_at_human}}</span>
                    </td>
                    <td>
                        <span :title="task.updated_at_formatted">{{ task.updated_at_human}}</span>
                    </td>
                    <td>
                        <task-show :users="users" :task="task"></task-show>
                        <task-update :users="users" :task="task" @updated="update" :uri="uri"></task-update>
                        <task-destroy :task="task" @removed="remove" :uri="uri"></task-destroy>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import Toggle from '../Toggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'

export default {
  name: 'DataTableTasks',
  data () {
    return {
      dataTasks: this.tasks,
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'User', value: 'user_id' },
        { text: 'Completat', value: 'completed' },
        { text: 'Etiquetes', value: 'tags' },
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
    },
    loading: {
      type: Boolean,
      required: true
    }
  },
  watch: {
    tasks (tasks) {
      this.dataTasks = tasks
    }
  },
  components: {
    'toggle': Toggle,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'task-show': TaskShow,
    'tasks-tags': TasksTags

  },
  methods: {
    swipeHandler (direction) {
      console.log(direction)
    },
    remove (task) {
      console.log('hola remove ')
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
