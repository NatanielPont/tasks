<template>
    <v-container grid-list-md text-xs-center id="tasks" class="tasks" fill-height>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card dark>
                    <v-card-title color="primary" class="justify-center">
                        <v-toolbar color="teal" dark class="toolTitle">
                            <!--<v-toolbar-side-icon></v-toolbar-side-icon>-->

                            <v-toolbar-title align="center">
                                <span class="title">Tasques ({{total}})</span>
                            </v-toolbar-title>

                            <!--<v-toolbar-title>Settings</v-toolbar-title>-->
                        </v-toolbar>

                    </v-card-title>
                    <v-card-text class="px-0">

                        <div v-if="errorMessage">
                            Ha succeit un error: {{ errorMessage }}
                        </div>
                        <v-list dense>
                            <v-list-tile v-for="task in filteredTasks" :key="task.id">
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        <span :id="'task' + task.id" :class="{ strike: task.completed }">
                                        </span>
                                    </v-list-tile-title>
                                </v-list-tile-content>

                                <v-flex xs3>
                                    <v-card dark color="primary">
                                        <editable-text
                                                :text="task.name"
                                                @edited="editName(task, $event)"
                                        ></editable-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs7>
                                    <!--<v-card dark color="blue" >-->
                                    <v-btn id="button_remove_task" @click="remove(task)" small>Completar</v-btn>
                                    <v-btn id="button_remove_task" @click="remove(task)" small>Modificar</v-btn>
                                    <v-btn id="button_remove_task" @click="remove(task)" small>Eliminar</v-btn>
                                    <!--</v-card>-->
                                </v-flex>
                            </v-list-tile>
                        </v-list>
                        <form>
                            <v-text-field
                                    label="nova tasca"
                                    type="text"
                                    v-model="newTask" @keyup.enter="add"
                                    name="name"
                                    required>
                            </v-text-field>

                            <v-btn id="button_add_task" @click="add">Afegir</v-btn>
                        </form>
                            <v-card color="purple">
                        <span id="filters" v-show="total > 0">
                                 <v-card-title color="primary" class="justify-center">
                                    <span class="title">Filtros: [{{ filter }}]</span>
                                 </v-card-title>
                                <v-card>
                                    <v-list id="filterList">
                                        <v-list-tile @click="setFilter('all')">
                                            <v-list-tile-content>
                                        <button>Totes</button>

                                            </v-list-tile-content>
                                        </v-list-tile>

                                        <v-list-tile @click="setFilter('completed')">
                                            <v-list-tile-content>

                                            <button>Completades</button>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile @click="setFilter('active')">
                                            <v-list-tile-content>

                                            <button>Pendents</button>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>

                                </v-card>
                            </span>
                            </v-card>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
  import EditableText from './EditableText'

  var filters = {
    all: function (tasks) {
      return tasks
    },
    completed: function (tasks) {
      return tasks.filter(function (task) {
        return task.completed
        // NO CAL
        // if (task.completed) return true
        // else return false
      })
    },
    active: function (tasks) {
      return tasks.filter(function (task) {
        return !task.completed
      })
    }
  }
  export default {
    name: 'Tasks',
    components: {
      'editable-text': EditableText
    },
    data() {
      return {
        filter: 'all', // All Completed Active
        newTask: '',
        dataTasks: this.tasks,
        errorMessage: ''
      }
    },
    props: {
      tasks: {
        type: Array,
        default: function () {
          return []
        }
      }
    },
    computed: {
      total() {
        return this.dataTasks.length
      },
      filteredTasks() {
        // Segons el filtre actiu
        // Alternativa switch/case -> array associatiu
        return filters[this.filter](this.dataTasks)
      }
    },
    watch: {
      tasks(newTasks) {
        this.dataTasks = newTasks
      }
    },
    methods: {

      editName(task, text) {
        task.name = text
      },
      setFilter(newFilter) {
        this.filter = newFilter
      },
      add() {
        if (this.newTask === '') return
        window.axios.post('/api/v1/tasks', {
          name: this.newTask
        }).then((response) => {
          this.dataTasks.splice(0, 0, {id: response.data.id, name: this.newTask, completed: false})
          this.newTask = ''
        }).catch((error) => {
          console.log(error)
        })
      },
      remove(task) {
        // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
        window.axios.delete('/api/v1/tasks/' + task.id).then((response) => {
          this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
        }).catch((error) => {
          console.log(error)
        })
      }
    },
    created() {
      if (this.tasks.length === 0) {
        window.axios.get('/api/v1/tasks').then((response) => {
          console.log(response.data)
          this.dataTasks = response.data
        }).catch((error) => {
          this.errorMessage = error.response.data
        })
      }
    }
  }
</script>

<style>
    .strike {
        text-decoration: line-through;
    }

    .toolTitle > div.v-toolbar__content {
        display: block;
        padding-top: 15px;
    }
    #filterList>div>a>div.v-list__tile__content{
        align-items: center;
    }
</style>
