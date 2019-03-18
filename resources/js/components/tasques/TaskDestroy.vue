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
    }
  },
  methods: {
    async destroy (task) {
      // ES6 async await
      let result = await this.$confirm('Les tasques esborrades no es poden recuperar',
        {
          title: 'Esteu segurs?',
          buttonTruetext: 'Eliminar',
          buttonFalsetext: 'Cancel·lar',
          color: 'error'
        })
      if (result) {
        this.removing = true
        window.axios.delete(this.uri + '/' + task.id).then(() => {
          this.removing = false
          this.$snackbar.showMessage("S'ha esborrat correctament la tasca")
          // if (EventBus) {
          // }
          this.$emit('removed', task)
          if (!this.touchFunction) {
            // this.$emit('removedWithTouchLeft')
            // this.task=null
          }

          // result = null
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.$snackbar.showError('task error '+task.name)
          this.removing = false
        }).then(() => {
          result = false
          if (this.touchFunction) {
            if (task == null) {
              this.$snackbar.showError('task NULLL')
            }

            this.$emit('refresh')
          }
        })
      }
    }
  },
  mounted () {
    // if (this.touchFunction) {
    var self = this
    if (this.touchFunction) {
      EventBus.$on('destroy', (task) => {
        console.log('---------')
        console.log('eventbus ')
        console.log('eventbus event name ' + task.name)
        console.log('eventbus task name from task destroy' + this.task.name)
        console.log('---------')
        if (task.id === this.task.id && this.touchFunction) {
          self.destroy(this.task)
          // this.$emit('call')
          // this.removing=false
          // event.id = 79
          // this.event = event
        }
        // EventBus.$off()
      })
    }
  },
  destroyed () {
    // EventBus.$off('destroy')
  }
  // }

}
</script>
