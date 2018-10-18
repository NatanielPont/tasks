<template>
    <div id="tasks" class="tasks">
        <h1>Tasques ({{total}}):</h1>
        <input type="text"
               v-model="newTask" @keyup.enter="add" name="name">
        <div v-if="errorMessage">
            Ha succeit un error: {{ errorMessage }}

        </div>

        <button @click="add" id="button_add_task">Afegir</button>
        <button @click="complet">Completar</button>

        <!--// SINTAX SUGAR-->

        <!--<input :value="newTask" @input="newTask = $event.target.value">-->
        <ul>
            <li v-for="task in filteredTasks" :key="task.id">
                <span  id="'task'+task.id" :class="{ strike: task.completed }">
                    <editable-text
                            :text="task.name"
                            @edited="editName(task, $event)"
                    ></editable-text>
                </span>
                &nbsp;
                <span :id="'delete_task'+task.id" @click="remove(task)">&#215;</span>
            </li>
        </ul>

        <h3>Filtres:</h3>
        Activa filter: {{ filter }}
        <ul>
            <li>
                <button @click="setFilter('all')">Totes</button>
            </li>
            <li>
                <button @click="setFilter('completed')">Completades</button>
            </li>
            <li>
                <button @click="setFilter('active')">Pendents</button>
            </li>
        </ul>
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
  data () {
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
    editName (task, text) {
      task.name = text
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },
    add () {
      window.axios.post('/api/v1/tasks', { name: this.newTask }).then((response) => {
        // if (this.newTask != null || this.newTask !== '') {
        console.log('RESPONSE')
        console.log(response.data)
        let task = { id: response.data.id, name: this.newTask, completed: false }
        console.log('task')
        console.log(task)
        this.dataTasks.splice(0, 0, { id: response.data.id, name: this.newTask, completed: false })
        this.dataTasks = ''
        // }
        // console.log(response);

        // console.log(response.data);
      }).catch((error) => {
        console.log(error)
      })
      this.newTask = ''
    },
    remove (task) {
      window.axios.delete('/api/v1/tasks/{task}').then((response) => {
        console.log(response)

        console.log(response.data)
        this.dataTasks.splice(this.dataTasks.indexOf(task), task.id)
      }).catch((error) => {
        console.log(error)
      })
    },
    complet () {

    }
  },
  created () {
    if (this.tasks.length === 0) {
      // console.log('entra en if')
      window.axios.get('/api/v1/tasks').then((response) => {
        this.dataTasks = response.data
      }).catch((error) => {
        // console.log('Error EXECUTED!')
        // console.log(error.response.data)
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
</style>
