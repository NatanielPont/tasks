<template>
    <span>
        <v-toolbar class="grey darken-2">
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

            <v-expansion-panel class="hidden-lg-and-up">
      <v-expansion-panel-content
      >
        <template v-slot:header>
          <div>Filtres</div>
        </template>
        <v-card>
        <v-flex sm5 md4 class="mr-2">
                        <v-select
                                label="Estat"
                                :items="filters"
                                v-model="filter"
                                item-text="name"
                                outline
                        >
                        </v-select>
                    </v-flex>
                    <v-flex sm6 md5 class="mr-2">
                      <user-select @refresh="refresh(false)"  @cleared="user = null" v-model="user" :users="dataUsers"  label="Usuari" class="py-0"></user-select>
                    </v-flex>
                    <v-flex sm6 md5 >
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
        </v-card>
      </v-expansion-panel-content>
    </v-expansion-panel>
                <v-layout row wrap class="hidden-md-and-down">
                    <v-flex lg2 class="mr-2">
                        <v-select
                                label="Estat"
                                :items="filters"
                                v-model="filter"
                                item-text="name"
                                outline
                        >
                        </v-select>
                    </v-flex>
                    <v-flex  lg4 >
                        <user-select @cleared="user = null" v-model="user" :users="dataUsers"  label="Usuari" class="py-0"></user-select>
                    </v-flex>
                    <v-flex lg5>
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                                class="py-3"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <data-table-tasks :user="this.user" @refresh="refresh" @updated="updateTask" @removed="removeTask" class="hidden-md-and-down" :loading="loading" :tags="tags" :uri="uri" :users="users" :tasks="filteredTasks" :search="search" >
            </data-table-tasks>
            <data-iterator-tasks :user="this.user"  :search="search" :tags="tags" @refresh="refresh"  @updated="updateTask" @removed="removeTask" :users="users" :uri="uri" :tasks="filteredTasks" class="hidden-lg-and-up"></data-iterator-tasks>
        </v-card>
    </span>
</template>

<script>
import DataIteratorTasks from './DataIteratorTasks'
import DataTableTasks from './DataTableTasks'
var filters = {
  Totes: function (tasks) {
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
export default {
  name: 'TasksList',
  data () {
    return {
      currSection: 0,

      user: null,
      loading: false,
      dataTasks: this.tasks,
      dataUsers: this.users,
      filter: 'Totes',
      filters: [
        'Completades',
        'Pendents',
        'Totes'
      ],
      search: ''
    }
  },
  components: {
    DataIteratorTasks,
    'data-table-tasks': DataTableTasks
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
      // if (this.user != null) {
      //   return this.filteredTasksUsers
      // } else {
      if (!this.user) {
        return filters[this.filter](this.dataTasks)
      } else {
        return filters[this.filter](this.filteredTasksUsers)
      }
      // this.finalizeUser()
      // }
    },
    filteredTasksUsers () {
      let tasks = []
      console.log('this. user ' + this.user)
      // if (this.user !== null) {
      this.dataTasks.map((task) => {
        // if (this.dataUser instanceof Object) {
        if (task.user_id == this.user.id) {
          tasks.push(task)
        }
        // }
      })
      // }
      return tasks
    }
  },
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
      // this.dataTasks = this.filteredTasksUsers()
    },
    user (user) {
      if (user == null) { this.user = null }
    }

  },
  methods: {
    finalizeUser () {
      this.user = null
      this.dataTasks.map((task) => {
        console.log('task map ' + task.id)
      })
    },
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
        // if (this.message === 5) {
        // }
      }).catch(error => {
        console.log(error)
        this.loading = false
      })
    }

  }

}
</script>
