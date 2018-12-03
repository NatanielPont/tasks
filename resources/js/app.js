import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks.vue'
import Tasques from './components/Tasques.vue'
import LoginForm from './components/LoginForm.vue'
// import EditableForm from './components/EditableForm'
import RegisterForm from './components/RegisterForm.vue'
import UserList from './components/UserList'
import UserSelect from './components/UserSelect'
// import Snackbar from './components/ui/SnackBar'
import snackbar from './plugins/snackbar'
import permissions from './plugins/permissions'
window.Vue = Vue
window.Vue.use(Vuetify)
window.Vue.use(permissions)
window.Vue.use(snackbar)

window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('tasques', Tasques)
window.Vue.component('login-form', LoginForm)
window.Vue.component('register-form', RegisterForm)
// window.Vue.component('editable-form', EditableForm)
window.Vue.component('user-list', UserList)
window.Vue.component('user-select', UserSelect)
// window.Vue.component('snackbar', Snackbar)

// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)
