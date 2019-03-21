<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container fluid grid-list-md>
        <v-data-iterator
                :items="dataTasks"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
                :search="search"

                row
                wrap
        >
            <!--<template v-slot:item="props" >-->
                <v-flex slot="item"
                        slot-scope="{item:task}">

                <!--</v-flex>-->
                <!--<v-flex-->
                        <!--xs12-->
                        <!--sm6-->
                        <!--md4-->
                        <!--lg3-->

                <!--&gt;-->

                    <v-card

                            >
                    <v-card-title class="subheading font-weight-bold primary">{{ task.name }}</v-card-title>
                        <swipe-component :tasks="tasks" :task="task" >

                        </swipe-component>
                    <v-divider></v-divider>

                    <v-list dense >
                    <v-list-tile>
                    <v-list-tile-content>Nom:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ task.name }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                    <v-list-tile-content>User:</v-list-tile-content>
                    <v-avatar :title="task.user_name">
                    <img v-if="task.user_gravatar" :src="task.user_gravatar" alt="avatar">
                    <img v-else src="https://www.gravatar.com/avatar/" alt="avatar">
                    </v-avatar>
                    <!--<v-list-tile-content class="align-end">{{ task.name }}</v-list-tile-content>-->
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Descripció:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ task.description }}</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Estat:</v-list-tile-content>
                    <v-list-tile-content class="align-end">
                    <toggle :value="task.completed" uri="/api/v1/completed_task"  active-text="Completada" unactive-text="Pendent" :task="task"></toggle>
                    </v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Tags:</v-list-tile-content>
                    <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh" @removed="refresh" ></tasks-tags>

                    <!--<v-list-tile-content class="align-end">{{ task.created_at_human }}</v-list-tile-content>-->
                    </v-list-tile>
                    <v-list-tile>
                    <v-list-tile-content>Creat:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ task.created_at_human }}</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile>
                    <v-list-tile-content>Actualitzat:</v-list-tile-content>
                    <v-list-tile-content class="align-end">{{ task.updated_at_human }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                    <v-list-tile-content>Acccions:</v-list-tile-content>
                    <task-show :users="users" :task="task"></task-show>
                    <task-update :users="users" :task="task" @updated="update" :uri="uri"></task-update>
                    <task-destroy :tasks="tasks" @refresh="refresh" @removedWithTouchLeft="refresh"  :touchFunction="true" :task="task" @removed="remove" :uri="uri"></task-destroy>

                    </v-list-tile>

                    </v-list>
                    </v-card>
                </v-flex>
                <!--</v-flex>-->
            <!--</template>-->
        </v-data-iterator>

    </v-container>
</template>

<script>
import Toggle from '../Toggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'
// import EventBus from '../../eventBus'
import EventBus from './../../eventBus'

export default {
  name: 'DataIteratorTasks',
  data () {
    return {
      auxTask: null,
      dataTasks: this.tasks,
      rowsPerPageItems: [4, 8, 12],
      removing: false,
      pagination: {
        rowsPerPage: 4
      }
    }
  },
  props: {
    search: {
      type: String,
      required: true
    },

    tasks: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }

  },
  components: {
    'toggle': Toggle,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'task-show': TaskShow,
    'tasks-tags': TasksTags

  },
  watch: {
    tasks (tasks) {
      this.dataTasks = tasks
      if (this.dataTasks.length === 0) {
        // EventBus.$off('destroy')
        console.log('ultima tasca')
      }
      console.log('watch ' + this.dataTasks.map((task) => {
        console.log(task.name)
      }))
    }

  },
  methods: {
    call () {
      this.$emit('refresh')
    },
    call2 (tasks) {
      this.tasks = tasks
    },
    refreshONTouch () {
      // this.$off('call')
      // if (this.dataTasks == 0) { EventBus.$off('destroy') }

      // self.location.reload()
    },
    remove (task) {
      this.$emit('removed', task)
    },
    update (task) {
      // console.log(task)
      // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      // this.tasks = this.dataTasks
      this.$emit('updated', task)
    },
    refresh () {
      this.$emit('refresh', true)
    }
  }
}
</script>

<style scoped>

</style>
