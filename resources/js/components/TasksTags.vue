<template>
    <span>
        <v-chip v-for="tag in this.taskTags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag(tag)"></v-chip>
        <!--<v-chip v-for="tag in task.tags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag(tag)" ></v-chip>-->
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
        <v-btn icon @click="dialogRemove = true"><v-icon>remove</v-icon></v-btn>
                <v-dialog v-model="dialogRemove" width="500">
            <v-card>
                <v-card-title>Elimineu etiquetes de la tasca</v-card-title>
                <v-card-text>
                    <v-select
                            v-model="selectedTag"
                            :items="this.task.tags"
                            item-value="name"
                            item-text="name"
                            label="Select"
                            persistent-hint
                            return-object
                            single-line
                            box
                    ></v-select>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="dialogRemove = false">Cancel·lar</v-btn>
                    <v-btn color="primary" flat @click="removeTag(selectedTag)">Eliminar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title>Afegiu etiquetes a la tasca</v-card-title>
                <v-card-text>
                    <v-combobox
                            v-model="selectedTags"
                            :items="tags"
                            multiple
                            chips
                            item-text="name"
                            @change="formatTag"
                    >
                        <template slot="selection"
                                  slot-scope="data">
                            <v-chip
                                    :color="data.item.color"
                                    :selected="data.selected"
                                    :disabled="data.disabled"
                                    :key="JSON.stringify(data.item)"
                                    class="v-chip--select-multi"
                                    @input="data.parent.selectItem(data.item)"
                            > {{ data.item.name }}
                            </v-chip>
                        </template>
                    </v-combobox>

                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="dialog = false" :loading="loading" :disabled="loading">Cancel·lar</v-btn>
                    <v-btn color="primary" flat @click="addTag">Afegir</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </span>
</template>

<script>
export default {
  name: 'TasksTags',
  data () {
    return {
      selectedTag: null,
      dialog: false,
      dialogRemove: false,
      loading: false,
      selectedTags: [],
      dataTaskTags: this.taskTags
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    taskTags: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    }
  },
  watch: {
    taskTags (taskTags) {
      this.dataTaskTags = taskTags
    }
  },
  methods: {
    formatTag () {
      var value = this.selectedTags[this.selectedTags.length - 1]
      if (typeof value === 'string') {
        this.selectedTags[this.selectedTags.length - 1] = {
          'color': 'grey',
          'name': this.selectedTags[this.selectedTags.length - 1]
        }
      }
    },
    async removeTag (tag) {
      let result
      // if (this.task.tags != null) {
      if ((tag == null || this.task.tags == null)) {
        this.$snackbar.showError('No hi ha etiqueta a esborrar')
      } else {
        // TODO ASYNC PRIMER EXECUTAR UN CONFIRM
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
        window.axios.delete('/api/v1/tasks/' + this.task.id + '/tag/', { data: { tag: tag } }).then(response => {
          console.log(tag)
          console.log(response.data.name)
          this.$snackbar.showMessage('Etiqueta eliminada correctament')
          this.$emit('removed')
          this.removing = false
        }).catch(error => {
          this.$snackbar.showError(error.toString())
          this.removing = false
        })
        this.selectedTag = null
      }
    },
    addTag () {
      // this.task.tags = this.selectedTags
      let ids = []
      this.selectedTags.map((tag) => {
        if (tag.id) {
          this.taskTags.map((tago) => {
            if (tago.id === tag.id) {
              ids.push(tag)
            }
          })
          return tag.id
        } else {
          this.taskTags.map((tago) => {
            if (tago.name === tag.name) {
              ids.push(tag)
            }
          })
          return tag.name
        }
      })
      // console.log(ids)
      for (var id in ids) {
        this.selectedTags = this.selectedTags.filter(function (e) { return e != ids[id] })
      }
      // if (this.s)

      // console.log(this.selectedTags.map(tag => tag.id))
      this.loading = true
      window.axios.put('/api/v1/tasks/' + this.task.id + '/tags', {
        tags: this.selectedTags.map((tag) => {
          if (tag.id) {
            return tag.id
          } else return tag.name
        })
      }).then(response => {
        this.$snackbar.showMessage('Etiqueta/s afegida/es correctament')
        this.dialog = false
        this.loading = false
        this.$emit('change', this.selectedTags)
      }).catch(error => {
        this.$snackbar.showError('Error, seleccioni o crei un tag no existent ja en la tasca')
        this.loading = false
      })
    }
  }
}
</script>
