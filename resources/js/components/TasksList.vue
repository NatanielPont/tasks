<template>
    <span>
        <v-toolbar class="grey darken-4">
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
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
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
                <v-layout row wrap>
                    <v-flex lg2 class="mr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="filter"
                                item-text="name"
                                outline
                        >
                                <!--value="{{filter}}"-->
                        </v-select>
                    </v-flex>
                    <v-flex lg4 class="mr-2">
                        <v-select
                                label="User"
                                :items="dataUsers"
                                v-model="user"
                                item-text="name"
                                clearable>
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
            <v-data-table
                    :headers="headers"
                    :items="filteredTasks"
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
                <template  slot="items" slot-scope="{item: task}"  >
                    <tr >
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
                            <toggle :value="task.completed" uri="/api/v1/completed_task" @change="refresh(false)" active-text="Completada" unactive-text="Pendent" :task="task"></toggle>
                        </td>
                        <td>
                            <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh(false)" @removed="refresh(true)" ></tasks-tags>
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
                            <task-update :users="users" :task="task" @updated="updateTask" :uri="uri"></task-update>
                            <task-destroy :task="task" @removed="removeTask" :uri="uri"></task-destroy>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <data-iterator-tasks :search="search" :tags="tags" @refresh="refresh"  @updated="updateTask" @removed="removeTask" :users=users :uri=uri :tasks=filteredTasks class="hidden-lg-and-up"></data-iterator-tasks>
        </v-card>
    </span>
</template>

<script>
import Toggle from './Toggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'
import DataIteratorTasks from './DataIteratorTasks'
var filters = {

  Totes: function (tasks) {
    // this.filter = ''
    return tasks
  },
  Completades: function (tasks) {
    return tasks.filter(function (task) {
      // console.log('holaCompletades ' + task)
      // this.filter = ''

      return task.completed
      // NO CAL
      // if (task.completed) return true
      // else return false
    })
  },
  Pendents: function (tasks) {
    // this.filter = ''

    return tasks.filter(function (task) {
      // console.log('holaPendents ' + task)
      return !task.completed
    })
  }

}
// var filtersUser = {
//   '':function (tasks) {
//     return tasks.filter(function (task) {
//       return task.user_id == this.user.id
//       // NO CAL
//       // if (task.completed) return true
//       // else return false
//     })
//   }
//
// }
export default {
  name: 'TasksList',
  data () {
    return {
      user: '',
      loading: false,
      dataTasks: this.tasks,
      dataUsers: this.users,
      filter: 'Totes',
      filters: [
        'Completades',
        'Pendents',
        'Totes'
      ],
      search: '',
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
  components: {
    DataIteratorTasks,
    'toggle': Toggle,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'task-show': TaskShow,
    'tasks-tags': TasksTags
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  computed: {
    filteredTasks () {
      // Segons el filtre actiu
      // Alternativa switch/case -> array associatiu
      // return this.dataTasks=this.dataTasks.map(()=>{
      //
      // })
      // this.dataTasks=(filters[this.filter](this.dataTasks))
      // let ids = []
      // this.selectedTags.map((task) => {
      //   if (task.completed) {
      //     ids.push(task)
      //   }
      // })
      return filters[this.filter](this.dataTasks)
    }

  },
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
    }
  },
  methods: {
    // filteredTasks () {
    //   // Segons el filtre actiu
    //   // Alternativa switch/case -> array associatiu
    //   return filters[this.filter](this.dataTasks)
    // },
    // setFilter (newFilter) {
    //   this.filter = newFilter
    // },

    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      // TODO improve refresh()
      this.refresh()
    },
    updateTask (task) {
      // console.log(task)
      // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      // this.tasks = this.dataTasks
      // self.location.reload()
      // this.dataTags.splice(this.dataTags.indexOf(tag), 1, tag)
      this.refresh(false)
    },
    refresh (message = true) {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.dataTasks = response.data
        // this.task.tags = this.tags
        this.loading = false
        this.$emit('change', this.dataTasks)

        if (message) this.$snackbar.showMessage('Tasques actualitzades correctament')
      }).catch(error => {
        console.log(error)
        this.loading = false
      })
    }

  }
}
</script>
