<template>
    <v-container grid-list-md text-xs-center id="tasks" class="tasks" fill-height >
        <v-layout row wrap>
            <v-flex xs12>
                <v-card dark>
                    <v-card-title class="justify-center">
                        <v-toolbar color="success lighten-1" dark class="toolTitle">
                            <!--<v-toolbar-side-icon></v-toolbar-side-icon>-->

                            <v-toolbar-title>
                                <span class="title">Tasques ({{total}})</span>
                            </v-toolbar-title>

                            <!--<v-toolbar-title>Settings</v-toolbar-title>-->
                        </v-toolbar>

                    </v-card-title>
                    <v-card-text >

                        <div v-if="errorMessage">
                            Ha succeit un error: {{ errorMessage }}
                        </div>
                        <v-list dense >
                            <v-list-tile v-for="task in filteredTasks" :key="task.id">
                                <v-list-tile-content>
                                    <v-list-tile-title>

                                    </v-list-tile-title>
                                </v-list-tile-content>
                                <v-flex v-if="filter=='all'" xs8 >
                                    <v-card dark color="primary">
                                        <span :id="'task' + task.id" :class="{ strike: task.completed==1 }">
                                        <editable-text
                                                :text="task.name"
                                                :data=task
                                                @edited="editName(task, $event)"
                                                v-on:edited="dateSelectedInChild"
                                        ></editable-text>
                                        </span>
                                    </v-card>
                                </v-flex>
                                <v-container v-if="filter!='all'" grid-list text-xs-center ma-0>
                                    <v-layout >
                                    <v-flex  xs10 offset-xs1  >
                                        <v-card dark color="primary" >
                                        <span :id="'task' + task.id" :class="{ strike: task.completed==1 }" >
                                        <editable-text
                                                :text="task.name"
                                                :data=task
                                                @edited="editName(task, $event)"
                                                v-on:edited="dateSelectedInChild"
                                        ></editable-text>
                                        </span>
                                        </v-card>
                                    </v-flex>

                                    </v-layout>

                                </v-container>

                                <v-flex v-if="filter=='all'" xs7>
                                    <!--<v-card dark color="blue" >-->
                                    <v-btn-toggle >

                                    <v-btn id="button_complete" @click="completeTask(task)" small flat>
                                            <v-switch
                                                    :input-value="task.completed==1" @change="task.completed = $event"
                                                    color="grey lighten-1"
                                            ></v-switch>

                                    </v-btn>
                                    <!--<v-btn id="buttonEdit" @click="editName(task, task.name)" small><v-icon color="orange">edit</v-icon></v-btn>-->
                                    <v-btn id="button_remove_task" @click="remove(task)" small flat><v-icon color="error darken-3">delete</v-icon></v-btn>
                                    </v-btn-toggle>
                                    <!--</v-card>-->
                                </v-flex>
                            </v-list-tile>
                        </v-list>
                        <form v-if="filter=='all'">
                            <v-text-field
                                    label="nova tasca (max. 25 ctrs)"
                                    type="text"
                                    v-model="newTask"
                                    @keyup.native.enter="add"
                                    name="name"
                                    required>
                            </v-text-field>

                            <v-btn class="mt-0" id="button_add_task" @click="add">Afegir</v-btn>
                        </form>
                            <v-card color="grey lighten-1" class="mt-5">
                        <span id="filters" v-show="total > 0" >
                                 <v-card-title color="primary" class="justify-center">
                                    <span class="title">Filtros: [{{ filter }}]</span>
                                 </v-card-title>
                                <v-card>
                                    <v-list id="filterList" >
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
      return task.completed == 1
      // NO CAL
      // if (task.completed) return true
      // else return false
    })
  },
  active: function (tasks) {
    return tasks.filter(function (task) {
      return task.completed == 0
    })
  }
}
export default {
  name: 'Tasks',
  components: {
    'editable-text': EditableText
  },
  data () {
    return {
      filter: 'all', // All Completed Active
      newTask: '',
      dataTasks: this.tasks,
      errorMessage: '',
      // completed: false,
      switch1: false
    }
  },
  model: {
    prop: 'inputValue',
    event: 'change'
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
    total () {
      return this.dataTasks.length
    },
    filteredTasks () {
      // Segons el filtre actiu
      // Alternativa switch/case -> array associatiu
      return filters[this.filter](this.dataTasks)
    }
  },
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
    }
  },
  methods: {
    dateSelectedInChild (currentText) {
      console.log(currentText + 'jkhakjhakjha')
    },
    completeTask (task) {
      console.log(task)
      if (!task.completed) {
        console.log('hola' + task.completed)
        this.uncompleteTask(task)
      } else {
        console.log('hola2' + task.completed)
        window.axios.post('/api/v1/completed_task/' + task.id, {
          _method: 'post'
        })
          .then((response) => {
            task.completed = true
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    },
    uncompleteTask (task) {
      window.axios.post('/api/v1/completed_task/' + task.id, {
        _method: 'delete'
      })
        .then((response) => {
          task.completed = false
        })
        .catch(function (error) {
          console.log(error)
        })
    },

    editName (task, text) {
      console.log('text ' + text)
      console.log('textname ' + task.name)
      // response.data = text;
      window.axios.post('/api/v1/tasks/' + task.id, {
        data: text,
        _method: 'put'
      })
        .then((response) => {
          // response.data = text;

          console.log(response.data)
          console.log('jardin' + text)
          task.name = text
        })
        .catch(function (error) {
          console.log(error)
        })
      // window.axios.put('/api/v1/tasks/' + task.id).then((response) => {
      //   console.log('jardin' + text)
      //   task.name = text
      //   // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      // }).catch((error) => {
      //   console.log(error)
      // })
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },
    add () {
      // console.log('hola')
      // function f (e) {
      //   if (e.keyCode === 13) {
      //   }
      //   alert('Enter was pressed')
      // }
      if (this.newTask === '') return
      if (this.newTask.length >= 25) this.newTask = this.newTask.substring(0, 25)
      window.axios.post('/api/v1/tasks', {
        name: this.newTask
      }).then((response) => {
        this.dataTasks.splice(0, 0, { id: response.data.id, name: this.newTask, completed: false })
        this.newTask = ''
      }).catch((error) => {
        console.log(error)
      })
    },
    remove (task) {
      // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      window.axios.delete('/api/v1/tasks/' + task.id).then((response) => {
        this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      }).catch((error) => {
        console.log(error)
      })
    }
  },
  created () {
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
