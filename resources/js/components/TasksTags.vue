<template>
    <span>
        <v-chip v-for="tag in taskTags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag(tag)"></v-chip>
        <!--<v-chip v-for="tag in task.tags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag(tag)" ></v-chip>-->
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
        <!--<v-btn icon @click="dialog = true"><v-icon>remove</v-icon></v-btn>-->
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
      dialog: false,
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
      type: Object,
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
      // TODO ASYNC PRIMER EXECUTAR UN CONFIRM
      let result = await this.$confirm('Les tasques esborrades no es poden recuperar',
        {
          title: 'Esteu segurs?',
          buttonTruetext: 'Eliminar',
          buttonFalsetext: 'Cancel·lar',
          color: 'error'
        })
      // if (result) {
      //   window.axios.delete('/api/v1/tasks/' + this.task.id + '/tag/' + this.tag, { data: { tag: tag } }).then(response => {
      //     this.$snackbar.showMessage('Etiqueta eliminada correctament')
      //   }).catch(error => {
      //     this.$snackbar.showError(error)
      //   })
      // }
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
      }
    },
    addTag () {
      // pluck colleccion Laravel
      // this.selectedTags
      // console.log(this.selectedTags)
      // console.log(this.selectedTags.map(tag => tag.id))
      this.loading = true
      window.axios.put('/api/v1/tasks/' + this.task.id + '/tags', {
        tags: this.selectedTags.map((tag) => {
          if (tag.id) return tag.id
          else return tag.name
        })
      }).then(response => {
        this.$snackbar.showMessage('Etiqueta/s afegida/es correctament')
        this.dialog = false
        this.loading = false
        this.$emit('change', this.selectedTags)
      }).catch(error => {
        this.$snackbar.showError(error)
        this.loading = false
      })
    }
  }
}
</script>

<!--<template>-->
    <!--<span>-->
        <!--<v-chip v-for="tag in task.tags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag(tag)" ></v-chip>-->
        <!--<v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>-->
        <!--&lt;!&ndash;<v-btn icon @click="dialog = true"><v-icon>remove</v-icon></v-btn>&ndash;&gt;-->
        <!--<v-dialog v-model="dialog" width="500">-->
            <!--<v-card>-->
                <!--<v-card-title>Afegiu etiquetes a la tasca</v-card-title>-->
                <!--<v-card-text>-->
                    <!--<v-select-->
                            <!--v-model="selectedTag"-->
                            <!--:items="tags"-->
                            <!--item-value="name"-->
                            <!--item-text="name"-->
                            <!--label="Select"-->
                            <!--persistent-hint-->
                            <!--return-object-->
                            <!--single-line-->
                            <!--box-->
                    <!--&gt;</v-select>-->

                <!--</v-card-text>-->
                <!--<v-divider></v-divider>-->
                <!--<v-card-actions>-->
                    <!--<v-spacer></v-spacer>-->
                    <!--<v-btn flat @click="dialog = false">Cancel·lar</v-btn>-->
                    <!--<v-btn color="primary" flat @click="addTag">Afegir</v-btn>-->
                <!--</v-card-actions>-->
            <!--</v-card>-->
        <!--</v-dialog>-->
    <!--</span>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
  <!--name: 'TasksTags',-->
  <!--data () {-->
    <!--return {-->
      <!--dialog: false,-->
      <!--selectedTag: []-->
      <!--// tag: {}-->
    <!--}-->
  <!--},-->
  <!--props: {-->
    <!--task: {-->
      <!--type: Object,-->
      <!--required: true-->
    <!--},-->
    <!--tags: {-->
      <!--type: Array,-->
      <!--required: true-->
    <!--}-->
  <!--},-->
  <!--methods: {-->
    <!--async removeTag (tag) {-->
      <!--// ES6 async await-->
      <!--let result = await this.$confirm('Les tasques esborrades no es poden recuperar',-->
        <!--{-->
          <!--title: 'Esteu segurs?',-->
          <!--buttonTruetext: 'Eliminar',-->
          <!--buttonFalsetext: 'Cancel·lar',-->
          <!--color: 'error'-->
        <!--})-->
      <!--if (result) {-->
        <!--this.removing = true-->
        <!--window.axios.delete('/api/v1/tasks/' + this.task.id + '/tag/', { data: { tag: tag } }).then(response => {-->
          <!--console.log(tag)-->
          <!--// console.log(response.data.name)-->
          <!--this.$snackbar.showMessage('Etiqueta eliminada correctament')-->
          <!--this.$emit('removed')-->
          <!--// this.removing = false-->
        <!--}).catch(error => {-->
          <!--this.$snackbar.showError(error.toString())-->
          <!--// this.removing = false-->
        <!--})-->
      <!--}-->
    <!--},-->
    <!--addTag () {-->
      <!--console.log('TODO ADD TAG')-->
      <!--// console.log(this.tag)-->
      <!--// console.log(this.selectedTag)-->
      <!--if (this.selectedTag == null) {-->
        <!--return this.$snackbar.showError("Tag invàlid, seleccioni un tag abans d'afegir")-->
      <!--}-->
      <!--if (this.selectedTag.length === 0) {-->
        <!--return this.$snackbar.showError("Tag invàlid, seleccioni un tag abans d'afegir")-->
      <!--}-->
      <!--// if (this.selectedTag.id==)-->
      <!--// console.log(this.selectedTag.id)-->
      <!--for (let i = 0; i < this.task.tags.length; i++) {-->
        <!--if (this.selectedTag.id == this.task.tags[i]['id']) {-->
          <!--return this.$snackbar.showError('Tag invàlid, seleccioni un tag no existent en la tasca')-->
        <!--}-->
      <!--}-->
      <!--// console.log(this.task.tags)-->
      <!--window.axios.post('/api/v1/tasks/' + this.task.id + '/tag', { tag: this.selectedTag }).then(response => {-->
        <!--// console.log('tag 0' + this.selectedTag)-->
        <!--this.selectedTag = null-->
        <!--this.$snackbar.showMessage('Etiqueta afegida correctament')-->
        <!--this.$emit('added')-->
        <!--this.dialog = false-->
      <!--}).catch(error => {-->
        <!--// console.log('tag 1' + this.selectedTag.name)-->
        <!--console.log('tag ')-->
        <!--// console.log(response.data)-->

        <!--this.$snackbar.showError(error.data)-->
      <!--})-->
      <!--// }-->
    <!--}-->
  <!--}-->
<!--}-->
<!--</script>-->
