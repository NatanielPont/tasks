<template>
    <v-layout
            v-touch="{
        left: () => swipe('Left'),
        right: () => swipe('Right'),
        up: () => swipe('Up'),
        down: () => swipe('Down')
      }"
            column
            align-center
            justify-center
            style="height: 100px"
            class="hidden"
    >
        <v-subheader>Swipe Direction</v-subheader>
        {{ 'Direction: '+swipeDirection }}
        <v-spacer></v-spacer>
        {{ '( <-- ) Left to remove task'}}
        <v-spacer></v-spacer>
        {{ 'Task:  '+this.task.name }}
    </v-layout>
</template>

<script>
import EventBus from './../../eventBus'

export default {
  name: 'SwipeComponent',
  data () {
    return {
      swipeDirection: 'None'
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    tasks: {
      type: Array,
      required: true

    }
  },
  watch: {
    task (task) {
      this.task = task
    },
    tasks (tasks) {
      this.tasks = tasks
    }
  },
  methods: {
    swipe (direction) {
      // let once = false
      if (direction == 'Left') {
        console.log('task from swipe component ' + this.task.name)
        if (this.task.name) {
          if (this.tasks.length > 0) {
            EventBus.$emit('destroy', this.task)
          // once = true
          // this.$emit('removed', this.task)
          }
        }
      }
      this.swipeDirection = direction
    }
  }
}
</script>

<style scoped>

</style>
