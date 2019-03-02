<template>
    <div class="container mx-auto ">
        <!--<div class="flex flex-col ">-->
        <div class=" w-full  rounded overflow-hidden shadow-lg grey darken-4">
            <!--<img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">-->
            <!--<div class="px-6 py-4">-->
                <!--<div class="font-bold text-xl mb-2">The Coldest Sunset</div>-->
                <!--<p class="text-grey-darker text-base">-->
                    <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.-->
                <!--</p>-->
            <!--</div>-->
            <!--<div class="px-6 py-4">-->
                <!--<span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#photography</span>-->
                <!--<span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#travel</span>-->
                <!--<span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker">#winter</span>-->
            <!--</div>-->
                            <span class="title text-center white--text flex justify-center mb-3 mt-3 ">Tasques ({{total}})</span>
        </div>
            <div class="max-w-sm rounded  overflow-hidden shadow-lg">

                <div v-if="errorMessage">
                    Ha succeit un error: {{ errorMessage }}
                </div>
            </div>

            <div class="flex flex-column bg-grey-lighter"  v-for="task in filteredTasks" :key="task.id" >
        <div class="max-w rounded overflow-hidden shadow-lg">

                <div class=" text-center border-2 border-blue hover:bg-blue px-1 py-1 m-2 ">
                    <ul class="list-reset ">
                        <li >

                <span :id="'task' + task.id" :class="{ strike: task.completed==1 }">
                                        <editable-text
                                                class=" hover:bg-blue-light "
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

                <div class="flex justify-center" v-if="filter=='all'">
                    <!--<button class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-4 rounded-l">-->
                        <!--Prev-->
                    <!--</button>-->
                    <button @click="completeTask(task)" class=" hover:bg-orange text-grey-darkest   font-bold rounded-l mr-2 w-1/3" >
                        <div v-if="task.completed==0" class="focus:outline-none focus:shadow-outline ">

                            Completar
                        </div>
                        <div v-if="task.completed==1" class="focus:outline-none focus:shadow-outline">
                            Descompletar
                        </div>

                    </button>
                    <button @click="remove(task)" class=" hover:bg-orange text-blue-dark  hover:text-white   hover:border-transparent rounded w-1/3">
                        <img src="https://img.icons8.com/color/64/000000/cancel.png" title="delete task">

                    </button>
                </div>
        </div>
            </div>
            <div class="flex bg-grey-lighter justify-center ">
            <form class="w-full max-w-sm">
                <div class="flex items-center border-b border-b-2 border-teal py-2">
                    <input v-model="newTask"
                           @keyup.enter="add"
                           name="name" class="mt-2 appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New task (max. 25 ctrs)" required>
                    <button id="button_add_task" @click="add">
                        <img src="https://img.icons8.com/ultraviolet/48/000000/plus.png" title="add task">
                    </button>
                </div>
            </form>

            </div>
        <div class="flex justify-center">

                <span id="filters" v-show="total > 0" align="center" class="">

                                    <span class="font-sans italic text-lg mr-3 border-b-4 border-blue-dark hover:bg-green-light">Filtres: [{{ filter }}]</span>
                     <ul class="list-reset inline-flex mt-5">
                <li><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full" @click="setFilter('all')">Totes</button></li>
                <li><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full" @click="setFilter('completed')">Completades</button></li>
                <li><button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded-full" @click="setFilter('active')">Pendents</button></li>
            </ul>

                            </span>
        </div>

        <!--</div>-->

    </div>

</template>

<script>
import EditableText from '../../EditableText'

var filters = {
  all: function (tasks) {
    return tasks
  },
  completed: function (tasks) {
    return tasks.filter(function (task) {
      return task.completed == 1
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
        name: text,
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
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },
    add () {
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
