<template>
    <span>
        <v-dialog v-model="deleteDialog">
            <v-card>
            TODO Delete Dialog
            </v-card>
        </v-dialog>
        <v-dialog v-model="createDialog" fullscreen>
            <v-card>
            TODO Create Dialog
            </v-card>
        </v-dialog>
        <v-snackbar :timeout="3000" color="success" v-model="snackBar">
            Snack Bar, drink beer to get the olympus
            <v-btn dark flat @click="snackBar=false">Tancar</v-btn>
        </v-snackbar>
        <v-toolbar color="blue darken-2">
        <v-menu>
            <v-btn slot="activator" icon dark>
            <v-icon>more_vert</v-icon>
            </v-btn>
            <v-list>
            <v-list-tile>
                <v-list-tile-title @click="opcio1">opcio 1</v-list-tile-title>
            </v-list-tile>
                <v-list-tile>
                <v-list-tile-title href="www.google.com">opcio 2. GOOGLE</v-list-tile-title>
            </v-list-tile>
            </v-list>
        </v-menu>
        <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon class="white--text">
            <v-icon>settings</v-icon>
        </v-btn>
        <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
            <v-icon>refresh</v-icon>
        </v-btn>
    </v-toolbar>
        <v-card>
        <v-card-title>
            <v-layout>
                <v-flex lg3 class="mr-2">
                    <v-select
                            label="Filtres"
                            :items="filters"
                            chips
                            v-model="filter">
                    </v-select>
                </v-flex>
                <v-flex lg4 class="mr-2">
                    <v-select
                    label="Users"
                    :items="users"
                    chips
                    v-model="user"
                    clearable>
                    </v-select>

                </v-flex>
                <v-flex lg5 class="pt-2">
                    <v-text-field
                         label="Buscar"
                         append-icon="search"
                         v-model="search">
                    </v-text-field>
                </v-flex>
            </v-layout>

        </v-card-title>
        <v-data-table
                :headers="headers"
                :items="dataTasks"
                :search="search"
                no-results-text="no s'ha trobat la pagina coincident"
                no-data-text="No hi ha dades disponibles"
                rows-per-page-text="Tasques per pagina"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'tots','value': -1}]"
                :loading="loading"
                :pagination.sync="pagination"
        >
            <v-progress-linear slot="progress" color="blue" indeterminate>

            </v-progress-linear>
            <template slot="items" slot-scope="{item: task}">
                <tr>
                    <td>
                        {{task.id}}
                    </td>
                    <td>
                       {{task.name}}
                    </td>
                    <td>
                        {{task.user_id}}
                    </td>
                    <td>
                        {{task.completed}}
                    </td>
                    <td>
                        {{task.created_at}}
                    </td>
                    <td>
                        {{task.updated_at}}
                    </td>
                    <td>
                    <v-btn icon color="primary"
                           flat title="Mostrar snackBar"
                           @click="snackBar=true">
                        <v-icon>delete</v-icon>

                    </v-btn><v-btn icon color="error"
                                   flat title="eliminar tasca"
                                   @click="showDestroy(task)">
                        <v-icon>delete</v-icon>

                    </v-btn>
                        <v-btn icon color="primary"
                               flat title="eliminar tasca"
                               @click="update(task)">
                        <v-icon>delete</v-icon>

                    </v-btn>
                        <v-btn icon color="primary"
                               flat title="eliminar tasca"
                               @click="show(task)">
                        <v-icon>delete</v-icon>

                    </v-btn>
                    </td>
                </tr>
            </template>

        </v-data-table>
    </v-card>
        <v-btn  @click="showCreate"
                fab
                bottom
                right
                fixed
                color="pink"
                class="white--text">
            <v-icon>add</v-icon>
        </v-btn>
    </span>

</template>
<script>

export default {
  name: 'Tasques',
  data () {
    return {
      deleteDialog: false,
      createDialog: false,
      snackBar: true,
      user: 'Nataniel Pont',
      users: [
        'aron',
        'pep',
        'Pop'
      ],
      filter: 'Totes',
      filters: [
        'Totes',
        'Completades',
        'Pendents'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      dataTasks: [
        {
          id: 1,
          name: 'Comprar pa',
          completed: false,
          user_id: 1,
          created_at: 'ara',
          updated_at: 'avui'
        },
        {
          id: 2,
          name: 'Comprar llet',
          completed: false,
          user_id: 1,
          created_at: 'ara',
          updated_at: 'avui'
        },
        {
          id: 3,
          name: 'Comprar sucre',
          completed: true,
          user_id: 2,
          created_at: 'ara',
          updated_at: 'avui'
        }
      ],
      headers: [
        {
          text: 'ID', value: 'id'
        },
        {
          text: 'Name', value: 'name'
        }, {
          text: 'User', value: 'user_id'
        },
        {
          text: 'Completed', value: 'completed'
        },
        {
          text: 'Created_at', value: 'created_at'
        },
        {
          text: 'updated_at', value: 'created_at'
        },
        {
          text: 'Actions', sortable: false
        }
      ]
    }
  },
  methods: {
    opcio1 () {
      console.log('todo opcio1')
    },
    refresh () {
      this.loading = true
      // TODO -> Axios
      setTimeout(() => {
        this.loading = false
      }, 3000)
      console.log('todo refresh')
    },
    showDestroy (task) {
      this.deleteDialog = true
      console.log('destroy Task dialog ')
    },
    destroy (task) {
      console.log('todo destroy task ' + task.id)
    },
    showCreate (task) {
      this.createDialog = true
      console.log('todo create show dialog')
      // console.log('todo destroy task ' + task.id)
    },
    create () {
      console.log('todo create task ')
    },
    show (task) {
      console.log('todo show task ' + task.id)
    },
    update (task) {
      console.log('todo update task ' + task.id)
    },
    showCreateDialog () {
      this.createDialog = true
      console.log('todo create show dialog')
    }

  }

}
</script>
