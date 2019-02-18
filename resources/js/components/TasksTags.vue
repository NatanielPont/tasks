<template>
    <span>
        <v-chip v-for="tag in task.tags" :key="tag.id" v-text="tag.name" :color="tag.color" @dblclick="removeTag(tag)" ></v-chip>
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
        <!--<v-btn icon @click="dialog = true"><v-icon>remove</v-icon></v-btn>-->
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title>Afegiu etiquetes a la tasca</v-card-title>
                <v-card-text>
                    <v-select
                            v-model="selectedTag"
                            :items="tags"
                            item-value="name"
                            item-text="name"
                            label="Select"
                            persistent-hint
                            return-object
                            single-line
                            box
                    ></v-select>
                    <!--<v-select-->
                            <!--v-model="selectedTag"-->
                            <!--:items="tags"-->
                            <!--label="Select"-->
                    <!--&gt;</v-select>-->
                    <!--<v-combobox-->
                            <!--v-model="selectedTag"-->
                            <!--:items="tags"-->
                            <!--chips-->
                            <!--item-text="name"-->
                            <!--type="selected"-->
                    <!--&gt;-->
                        <!--&lt;!&ndash;<template slot="selection"&ndash;&gt;-->
                                  <!--&lt;!&ndash;slot-scope="data">&ndash;&gt;-->
                            <!--&lt;!&ndash;<v-chip&ndash;&gt;-->
                                    <!--&lt;!&ndash;:selected="data.selected"&ndash;&gt;-->
                                    <!--&lt;!&ndash;:disabled="data.disabled"&ndash;&gt;-->
                                    <!--&lt;!&ndash;:key="JSON.stringify(data.item)"&ndash;&gt;-->
                                    <!--&lt;!&ndash;@input="data.parent.selectItem(data.item)"&ndash;&gt;-->
                            <!--&lt;!&ndash;&gt; {{ data.item.name }}&ndash;&gt;-->
                            <!--&lt;!&ndash;</v-chip>&ndash;&gt;-->
                        <!--&lt;!&ndash;</template>&ndash;&gt;-->
                    <!--</v-combobox>-->

                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="dialog = false">Cancel·lar</v-btn>
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
      selectedTag: []
      // tag: {}
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    tags: {
      type: Array,
      required: true
    }
  },
  methods: {
    async removeTag (tag) {
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
        window.axios.delete('/api/v1/tasks/' + this.task.id + '/tag/', { data: { tag: tag } }).then(response => {
          console.log(tag)
          // console.log(response.data.name)
          this.$snackbar.showMessage('Etiqueta eliminada correctament')
          this.$emit('removed')
          // this.removing = false
        }).catch(error => {
          this.$snackbar.showError(error.toString())
          // this.removing = false
        })
      }
    },
    addTag () {
      console.log('TODO ADD TAG')
      // console.log(this.tag)
      // console.log(this.selectedTag)
      if (this.selectedTag == null) {
        return this.$snackbar.showError("Tag invàlid, seleccioni un tag abans d'afegir")
      }
      if (this.selectedTag.length === 0) {
        return this.$snackbar.showError("Tag invàlid, seleccioni un tag abans d'afegir")
      }
      // if (this.selectedTag.id==)
      // console.log(this.selectedTag.id)
      for (let i = 0; i < this.task.tags.length; i++) {
        if (this.selectedTag.id == this.task.tags[i]['id']) {
          return this.$snackbar.showError('Tag invàlid, tag no existent en la tasca')
        }
      }
      // console.log(this.task.tags)
      window.axios.post('/api/v1/tasks/' + this.task.id + '/tag', { tag: this.selectedTag }).then(response => {
        // console.log('tag 0' + this.selectedTag)
        this.selectedTag = null
        this.$snackbar.showMessage('Etiqueta afegida correctament')
        this.$emit('added')
        this.dialog = false
      }).catch(error => {
        // console.log('tag 1' + this.selectedTag.name)
        console.log('tag ')
        // console.log(response.data)

        this.$snackbar.showError(error.data)
      })
      // }
    }
  }
}
</script>
