export default {
  data () {
    return {
      Message: 'Prova',
      snackbarTimeout: 3000,
      Color: 'success',
      snackbar: false

    }
  },
  methods: {
    // SNACKBAR
    showMessage (message) {
      this.Message = message
      this.Color = 'success'
      this.snackbar = true
    },
    showError (error) {
      this.Message = error.message
      this.Color = 'error'
      this.snackbar = true
    }
  }

}
