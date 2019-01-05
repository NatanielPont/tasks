<template>
    <div class="container mx-auto ">
        <div class="flex flex-col ">
                            <span class="title text-center ">Tasques ({{total}})</span>
            <div class="max-w-sm rounded  overflow-hidden shadow-lg">

                <div v-if="errorMessage">
                    Ha succeit un error: {{ errorMessage }}
                </div>
            </div>
            <div class="inline-flex bg-grey-lighter .items-center"  v-for="task in filteredTasks" :key="task.id" >
                <div class="flex-1  text-center border-2 border-blue hover:bg-blue px-4 py-4 m-3">
                    <ul class="list-reset">
                        <li >

                <span :id="'task' + task.id" :class="{ strike: task.completed==1 }">
                                        <editable-text
                                                class=" hover:bg-blue-light"
                                                :text="task.name"
                                                :data=task
                                                @edited="editName(task, $event)"
                                                v-on:edited="dateSelectedInChild"
                                        ></editable-text>
                                        </span>
                        </li>

                    </ul>
                </div>
                <!--<div class="flex-1 border-2 border-blue text-center rounded-full  px-4 py-2 m-3">-->
                                <div  class="focus:shadow-outline">

                                    <button @click="completeTask(task)" class=" flex-1 bg-purple-light hover:bg-yellow text-grey-darkest font-bold px-4 py-4 m-3 rounded-r">
                                        <div v-if="task.completed==0" class="focus:outline-none focus:shadow-outline ">

                                            Completar
                                        </div>
                                        <div v-if="task.completed==1" class="focus:outline-none focus:shadow-outline">
                                            Descompletar
                                        </div>

                                    </button>
                                </div>
                        <button id="button_remove_task" @click="remove(task)" class=" flex-initial hover:bg-blue text-blue-dark font-semibold hover:text-white px-2 py-2 m-3  hover:border-transparent rounded">
                            <!--<img src="https://img.icons8.com/material-rounded/64/000000/cancel.png" title="delete task">-->
                            <img src="https://img.icons8.com/color/64/000000/cancel.png" title="delete task">
                            <!--<img src="https://img.icons8.com/material-two-tone/64/000000/cancel.png" title="delete task">-->
                            <!--<img src="https://img.icons8.com/office/64/000000/delete.png" title="delete task">-->
                        </button>

            </div>
            <div class="flex bg-grey-lighter justify-center ">
            <form class="w-full max-w-sm">
                <div class="flex items-center border-b border-b-2 border-teal py-2">
                    <input v-model="newTask"
                           @keyup.enter="add"
                           name="name" class=" appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New task" required>
                    <button id="button_add_task" @click="add">
                        <img src="https://img.icons8.com/ultraviolet/48/000000/plus.png" title="add task">
                    </button>
                </div>
            </form>
            <!--<div class="flex-1 text-grey-darker text-center bg-grey-light px-4 py-2 m-2">-->

            <!--<form>-->
                <!--<input type="text"-->
                       <!--v-model="newTask"-->
                       <!--@keyup.enter="add"-->
                       <!--name="name"-->
                       <!--class="appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none"-->
                       <!--placeholder="New task"-->
                       <!--required-->
                <!--&gt;-->
                <!--<button id="button_add_task" @click="add">-->
                    <!--<img src="https://img.icons8.com/ultraviolet/48/000000/plus.png" title="add task">-->
                    <!--&lt;!&ndash;<img src="https://img.icons8.com/nolan/48/000000/plus.png">&ndash;&gt;-->
                <!--</button>-->
            <!--</form>-->
                <!--</div>-->
            </div>

            <!--<div class="flex bg-grey-lighter">-->

                <!--<div class="flex-grow text-grey-darkest text-center  px-4 py-2 m-2">-->
                <!--</div>-->

            <!--</div>-->

                <span id="filters" v-show="total > 0" align="center">

                                    <span class="title">Filtros: [{{ filter }}]</span>
                     <ul class="list-reset inline-flex mt-5">
                <li><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full" @click="setFilter('all')">Totes</button></li>
                <li><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full" @click="setFilter('completed')">Completades</button></li>
                <li><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full" @click="setFilter('active')">Pendents</button></li>
            </ul>
                                 <!--<v-card-title color="primary" class="justify-center">-->
                                 <!--</v-card-title>-->
                                <!--<v-card>-->
                                    <!--<v-list id="filterList">-->
                                        <!--<v-list-tile @click="setFilter('all')">-->
                                            <!--<v-list-tile-content>-->
                                        <!--<button>Totes</button>-->

                                            <!--</v-list-tile-content>-->
                                        <!--</v-list-tile>-->

                                        <!--<v-list-tile @click="setFilter('completed')">-->
                                            <!--<v-list-tile-content>-->

                                            <!--<button>Completades</button>-->
                                            <!--</v-list-tile-content>-->
                                        <!--</v-list-tile>-->
                                        <!--<v-list-tile @click="setFilter('active')">-->
                                            <!--<v-list-tile-content>-->

                                            <!--<button>Pendents</button>-->
                                            <!--</v-list-tile-content>-->
                                        <!--</v-list-tile>-->
                                    <!--</v-list>-->

                                <!--</v-card>-->
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
