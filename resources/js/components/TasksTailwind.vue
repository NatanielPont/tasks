<template>
    <div class="container mx-auto ">
        <div class="flex flex-col ">
            <div class="max-w-sm rounded overflow-hidden shadow-lg">

                            <span class="title">Tasques ({{total}})</span>

                <div v-if="errorMessage">
                    Ha succeit un error: {{ errorMessage }}
                </div>
            </div>
                <v-list dense>
                    <v-list-tile v-for="task in filteredTasks" :key="task.id">
                        <v-list-tile-content>
                            <v-list-tile-title>

                            </v-list-tile-title>
                        </v-list-tile-content>
                        <v-flex xs3>
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

                        <v-flex xs7>

                            <div class="inline-flex">

                                <div class="inline-block relative w-64">
                                    <div class="inline-flex">
                                        <!--<div v-if="task.completed==0" class="focus:outline-none focus:shadow-outline">-->

                                        <!--<button class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-2 rounded-l">-->
                                            <!--Completar-->
                                        <!--</button>-->
                                        <!--</div>-->
                                        <div  class="focus:shadow-outline">

                                        <button @click="completeTask(task)" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-2 rounded-r">
                                            <div v-if="task.completed==0" class="focus:outline-none focus:shadow-outline">

                                            Completar
                                            </div>
                                            <div v-if="task.completed==1" class="focus:outline-none focus:shadow-outline">
                                                Descompletar
                                            </div>

                                        </button>
                                        </div>
                                    </div>
                                    <!--<button class="bg-blue hover:bg-blue-dark text-white font-bold py-1 px-0 border border-blue-darker ">-->
                                        <!--<v-switch-->
                                        <!--:label="`Completada: ${task.completed==1}`"-->
                                        <!--:input-value="task.completed==1" @change="task.completed = $event"-->
                                <!--&gt;</v-switch>-->

                                    <!--</button>-->

                                </div>

                            <button id="button_remove_task" @click="remove(task)" class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                                <svg class="h-6 w-6 fill-current text-red w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                    <path d="M53.122 48.88L36.243 32l16.878-16.878a3 3 0 0 0-4.242-4.242L32 27.758l-16.878-16.88a3 3 0 0 0-4.243 4.243l16.878 16.88-16.88 16.88a3 3 0 0 0 4.243 4.241L32 36.243l16.878 16.88a3 3 0 0 0 4.244-4.243z"/>
                                </svg>
                            </button>
                            </div>

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
        </div>

    </div>

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
  name: 'TasksTailwind',
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
    // toggleSwitch (task) {
    //   return task.completed
    //   // if (!task.completed) {
    //   //   this.completeTask(task)
    //   // }
    // },
    dateSelectedInChild (currentText) {
      console.log(currentText + 'jkhakjhakjha')
    },
    completeTask (task) {
      console.log(task)
      if (task.completed) {
        console.log('hola' + task.completed)
        this.uncompleteTask(task)
      } else {
        console.log('hola2 ' + task.completed)
        window.axios.post('/api/v1/completed_task/' + task.id, {
          _method: 'post'
        })
          .then((response) => {
          // response.data = text;
          // task.name = text
            task.completed = true
          console.log('jardin' + task.completed)
          //   this.dataTasks = null
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
          // console.log('hola')
          // this.dataTasks = null
          // this.dataTasks.splice(0, 0, { id: response.data.id, name: task.name, completed: completed })
          // response.data = text;
          // console.log('jardin' + text)
          // task.name = text
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
      if (this.newTask === '') return
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
