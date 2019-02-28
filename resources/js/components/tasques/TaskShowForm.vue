<template>
    <v-form>
        <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="El nom de la tasca..."
                placeholder="Nom de la tasca"
                :readonly="true"
        ></v-text-field>

        <v-switch :readonly="true" v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea
                v-model="description"
                label="Descripció"
                hint="Escriu la descripció de la tasca..."
                :readonly="true"
        ></v-textarea>

        <user-select v-model="user" :readonly="true" :users="dataUsers" label="Usuari"></user-select>

    </v-form>
</template>

<script>
export default {
  data () {
    return {
      name: this.task.name,
      completed: this.task.completed,
      description: this.task.description,
      dataUsers: this.users,
      // user: this.user = this.users.find((user) => {
      //   return parseInt(user.id) === parseInt(this.task.user_id)
      // })
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    users: {
      type: Array,
      required: true
    }
  },
  watch: {
    task (task) {
      this.updateUser(task)
      this.name = task.name
      this.completed = task.completed
      this.description = task.description
    }
  },
  methods: {
    updateUser (task) {
      this.user = this.users.find((user) => {
        return parseInt(user.id) === parseInt(task.user_id)
      })
    }
  },
  created () {
    this.updateUser(this.task)
  }
}
</script>
