<template>
    <span>
        <v-toolbar color="grey darken-1">
            <v-toolbar-title class="white--text">Users</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex>
                        <v-text-field
                                appedn-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="dataUsers"
                    :search="search"
                    no-results-text="No se ha encontrado ningún registro"
                    no-data-text="No hay datos disponibles"
                    rows-per-page-text="Usuarios por pagina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Todos','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
                    class="hidden-md-and-down"
            >
                 <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item:user}">
                    <tr>
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{ user.email_verified_at }}</td>
                        <td>{{user.admin}}</td>
                        <td>{{user.mobile}}</td>
                        <td>{{user.mobile_verified_at}}</td>
                        <td>
                            <user-emails :user="user"></user-emails>
                            <verify-mobile-form :user="user"></verify-mobile-form>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
    </span>
</template>

<script>
import UserEmailsComponent from './UserEmailsComponent'
import VerifyMobileForm from '../sms/VerifyMobileForm'

export default {
  name: 'Users',
  components: {
    'verify-mobile-form': VerifyMobileForm,
    'user-emails': UserEmailsComponent
  },
  data () {
    return {
      loading: false,
      dataUsers: this.users,
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'NOM', value: 'name' },
        { text: 'EMAIL', value: 'email' },
        { text: 'Email Verified', value: 'email_verified_at' },
        { text: 'ADMIN?', value: 'admin' },
        { text: 'MOBILE', value: 'mobile' },
        { text: 'Phone Verified', value: 'mobile_verified_at' },
        { text: 'Actions', sortable: false, value: 'id' }
      ]
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    }
  }

}
</script>

<style scoped>
</style>
