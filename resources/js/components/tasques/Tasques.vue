<template>
    <span>
        <tasks-list v-show="dataTasks.length>0" @change="killEventBus" :users="users" :uri="uri" :tasks="dataTasks" :tags="tags"></tasks-list>
        <no-data-component v-show="dataTasks.length==0" @change="killEventBus" :users="users" :uri="uri" :tasks="dataTasks" :tags="tags"></no-data-component>
        <tasks-create :users="users" :uri="uri" @created="add" ></tasks-create>
    </span>
</template>

<script>
import TasksCreate from './TasksCreate'
import TasksList from './TasksList'
// import EventBus from './../../eventBus'

export default {
  name: 'Tasques',
  components: {
    'tasks-list': TasksList,
    'tasks-create': TasksCreate
  },
  data () {
    return {
      dataTasks: this.tasks
    }
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
  watch: {
    tasks (tasks) {
      this.dataTasks = tasks
    }

  },
  methods: {
    killEventBus () {
      // EventBus.$off()
    },

    add (task) {
      this.dataTasks.push(task)
      // self.location.reload()
    }
  }
}
</script>
