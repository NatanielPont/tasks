<template>
    <v-btn v-can="'tasks.destroy'" icon color="error" flat title="Eliminar la tasca"
           :loading="removing" :disabled="removing"
           @click="destroy(task)">
        <v-icon>delete</v-icon>
    </v-btn>
</template>

<script>
import EventBus from './../../eventBus'
// var event
var taskEvent
export default {
  'name': 'TaskDestroy',
  data () {
    return {
      removing: false

    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    taskMobile: {
      type: Object,
      required: false
    },
    tasks: {
      type: Array,
      required: false
    },
    uri: {
      type: String,
      required: true
    },
    touchFunction: {
      type: Boolean,
      default: false
    }
  },
  watch: {
    task (task) {
      this.task = task
    },
    taskMobile (task) {
      this.taskMobile = task
    },
    tasks (tasks) {
      this.tasks = tasks
    }

  },
  methods: {
    async destroy (task) {
      // ES6 async await
      let result
      if (taskEvent.id === this.task.id) {
        result = await this.$confirm('Les tasques esborrades no es poden recuperar',
          {
            title: 'Esteu segurs?',
            buttonTruetext: 'Eliminar',
            buttonFalsetext: 'Cancel·lar',
            color: 'error'
          })
      }
      if (result) {
        this.removing = true
        // if (!this.touchFunction) {
        //   EventBus.$off('destroy')
        //   result = false
        //   // this.task=null
        // }
        this.tasks.map((task0) => {
          if (task0.id == task.id) {
            task = task0
            console.log('taska0 ' + task0.name)
            console.log('taska1 ' + task.name)
          }
          console.log('taska ' + task.name)
        })
        // if (this.tasks.length > 0) {
        // if (task!=null){

        window.axios.delete(this.uri + '/' + task.id).then(() => {
          this.removing = false
          this.$snackbar.showMessage("S'ha esborrat correctament la tasca")
          this.$emit('removed', task)

          // result = null
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.$snackbar.showError('task error ' + task.name)
          this.removing = false
        }).then(() => {
          result = false
          if (this.touchFunction) {
            this.$emit('refresh')
          }
        })
        // }
        // } else {
        //   EventBus.$off('destroy')
        //   result.$off()
        // }
      }
    }
  },
  mounted () {
    // if (this.touchFunction) {
    var self = this
    var auxBol = false
    if (this.touchFunction && !auxBol) {
      EventBus.$on('destroy', (task) => {
        console.log('---------')
        // console.log('eventbus ')
        // console.log('eventbus event name ' + task.name)
        console.log('eventbus task name from task destroy' + this.task.name)
        console.log('---------')
        console.log('tasca captured from eventbus1 ' + task.name)
        if (this.tasks.length > 0) {
          if (task.id === this.task.id && this.touchFunction) {
            taskEvent = task
            console.log('tasca captured from eventbus2 ' + task.name)
            self.destroy(task)
          // this.$emit('call')
          // this.removing=false
          // event.id = 79
          // this.event = event
          }
        }
        // EventBus.$off()
      })
      auxBol = true
    }
  },
  destroyed () {
    taskEvent = null
    // EventBus.$off('destroy')
  }
  // }

}
</script>
