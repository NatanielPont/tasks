<template>
        <v-toolbar dark color="primary">
            <v-toolbar-title>Editable form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="book"
                    name="email"
                    label="Nom de la tasca"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"
            >

            </v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="primary" type="submit"  :disabled="$v.$invalid">Login</v-btn>
        </v-card-actions>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'
export default {
  name: 'EditableForm',
  mixins: [validationMixin],
  validations: {
    dataEmail: { required }
  },
  data () {
    return {
      dataEmail: this.email,
      dataId: this.id
    }
  },
  props: [ 'email', 'csrfToken', 'id'],
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.required && errors.push('El nom de la tasca és obligatori.')
      return errors
    }
  },
  methods: {
    put () {
      window.axios.put('/tasks/' + this.dataid, { _method: 'PUT', foo: 'bar' })
        .then(function (response) { console.log(response) })
        .catch(function (error) { console.log(error) })
    }
  }
}
</script>
